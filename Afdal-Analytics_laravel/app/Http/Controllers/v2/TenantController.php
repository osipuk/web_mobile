<?php

namespace App\Http\Controllers\v2;

use App\Helpers\UserPlanHelper;
use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\Seo;
use App\Models\SocialAccount;
use App\Services\Social\GoogleAnalyticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;

class TenantController extends Controller
{
    public function connections(Request $request)
    {
        if (
            !auth()->user()->company->subscriptions()->first()
            && !auth()->user()->company->onTrial()
            && auth()->user()->email !== 'demo@afdal.com'
            && !auth()->user()->gift
        ) {
            return redirect('/dashboard/no-subscription');
        }

        if (!Auth::user()->permissions->contains('code', 'manage_connections')) {
            return redirect('/dashboard/no-permission');
        }
        $enable_connections = Auth::user()->company->social_account()->count() < UserPlanHelper::subscription_info()->connections;
        $seo = Seo::where('route', $request->getRequestUri())->first();
        $tab_type="my";
        if($request->type=='all'){
            $tab_type="all";
        }
        return view('tenant/v2/connections', compact(['enable_connections', 'seo','tab_type']));
    }
    public function removeConnection(Request $request)
    {
        $page_ids = $request->get('connect');
        $acc_type = $request->get('account');

        $company = Auth::user()->company;
        $accounts = [];
        switch ($acc_type) {
            case 'facebook':
                $accounts = $company->social_account_facebook;
                break;
            case 'instagram':
                $accounts = $company->social_account_instagram;
                break;
            case 'facebookAds':
                $accounts = $company->social_account_facebook_ads;
                break;
            case 'twitter':
                $accounts = $company->social_account_twitter;
                break;
            case 'googleAnalytics':
                $accounts = $company->social_account_google_analytics;
                break;
            case 'googleAds':
                $accounts = $company->social_account_google_ads;
                break;
        }

        if ($acc_type === 'twitter') {
            $this->removeTwitterConnection($accounts, $page_ids);
        } elseif ($acc_type === 'googleAds') {
            $this->removeGoogleAdsConnection($accounts, $page_ids);
        } elseif ($acc_type === 'googleAnalytics') {
            foreach ($accounts as $account) {
                $googleAnalyticsService = new GoogleAnalyticsService($account);
                $googleAnalyticsService->deleteAllWithExcludedProperties($page_ids ?? []);
            }
        } 
        else {
            if ($page_ids) {
                foreach ($accounts as $account) {
                    if ($acc_type === 'facebookAds') {
                        $pages = $account->ads_account;
                    } else {
                        $pages = $account->page;
                    }
                    $count = count($pages);
                    if ($pages) {
                        foreach ($pages as $page) {
                            if (!in_array($page->getKey(), $page_ids)) {
                                if ($acc_type === 'facebookAds') {
                                    $page->delete();
                                } else {
                                    $this->delPages($page, $account);
                                }
                                $count--;
                            }
                        }
                    }
                    if ($count == 0) {
                        $this->delAccount($account);
                        $this->deleteDashboards($account->social_account_id, 'facebook-ads-overview');
                    }
                }
            } else {
                foreach ($accounts as $acc) {
                    $pages = $acc->page;
                    $count = count($pages);
                    foreach ($pages as $page) {
                        $this->delPages($page, $acc);
                        $count--;
                    }

                    if ($count == 0) {
                        $this->deleteDashboards($acc->id, 'facebook-ads-overview');
                        $this->delAccount($acc);
                    }
                }
            }
        }
        $all_accounts = SocialAccount::with('page', 'ads_account', 'google_analytics_account.properties.profiles', 'google_ads_account')
            ->where('company_id', Auth::user()->company_id)
            ->where('disabled', false);
        $social_accounts = $all_accounts->where('provider_name', $acc_type);
        $social_accounts = $social_accounts->get();
        if($social_accounts->isNotEmpty()){
            $social_accounts->toArray();
        }else{
            $social_accounts=null;
        }
        $has_connections=false;
        if(Auth::user()->company->social_account()->count() > 0){
            $has_connections=true;
        }
        if(!empty($social_accounts)){
            return response()->json([
                'success' => true,
                'provider_name'=>$acc_type,
                'social_accounts'=> true,
                'has_connections'=>$has_connections,
                'page_ids'=>$page_ids
            ]);
        }
        return response()->json([
            'success' => true,
            'provider_name'=>$acc_type,
            'social_accounts'=> false,
            'has_connections'=>$has_connections,
            'page_ids'=>$page_ids
        ]);
        
    }
    public function deleteDashboards($account_id, $template_name)
    {
        $dashboard = Dashboard::query()
            ->where('social_account_id', $account_id)
            ->where('name', $template_name)
            ->first();

        $dashboard?->delete();
    }
    public function delAccount($acc)
    {
        $acc->social_account_data()->each(function ($data) {
            $data->delete();
        });
        $acc->ads_account()->each(function ($acc) {
            $acc->delete();
        });
        $acc->tweet()->each(function ($tweet) {
            $tweet->delete();
        });
        $acc->delete();
    }
    public function delPages($page, $social_account)
    {
        $page->post()->each(function ($post) {
            $post->delete();
        });
        $page->follower()->each(function ($follower) {
            $follower->delete();
        });
        $page->likeinfo()->each(function ($like) {
            $like->delete();
        });
        $page->data()->each(function ($data) {
            $data->delete();
        });
        $page->cta_data()->each(function ($cta_data) {
            $cta_data->delete();
        });
        $dashboards = Dashboard::where('social_account_id', $social_account->getKey())->where('page_id', $page->getKey())->get();
        $dashboards->map(function ($dash) {
            $dash->delete();
        });
        $page->delete();
    }
    public function removeGoogleAdsConnection($accounts, $page_ids)
    {
        if ($page_ids) {
            foreach ($accounts as $account) {
                $adsAccounts = $account->google_ads_account;
                $count = count($adsAccounts);

                if ($adsAccounts) {
                    foreach ($adsAccounts as $page) {

                        if (!in_array($page->getKey(), $page_ids)) {
                            $this->deleteGoogleAdsAccountData($page, $account);
                            $count--;
                        }

                    }
                }

                if ($count == 0) {
                    $this->deleteDashboards($account->getKey(), 'google-ads-overview');
                    $this->deleteGoogleAdsAccount($account);
                }
            }

        } else {
            foreach ($accounts as $account) {
                $adsAccounts = $account->google_ads_account;
                foreach ($adsAccounts as $page) {
                    $this->deleteGoogleAdsAccountData($page);
                }
                $this->deleteDashboards($account->getKey(), 'google-ads-overview');
                $this->deleteGoogleAdsAccount($account);
            }
        }
    }
    public function removeTwitterConnection($accounts, $page_ids)
    {
        if ($page_ids) {
            foreach ($accounts as $account) {
                if (!in_array($account->getKey(), $page_ids)) {
                    $this->deleteDashboards($account->getKey(), 'twitter-overview');
                    $this->delAccount($account);
                }
            }
        } else {
            foreach ($accounts as $account) {
                $this->deleteDashboards($account->getKey(), 'twitter-overview');
                $this->delAccount($account);
            }
        }
    }
    public function deleteGoogleAdsAccountData($adsAccount, $socialAccount = null)
    {
        $account_data = $adsAccount->account_data;
        foreach ($account_data as $data){
            $data->delete();
        }
        if($socialAccount){
            $dashboard = Auth::user()->company->dashboard->where('name','google-ads-overview')->first();
            if($dashboard->social_account_id === $socialAccount->getKey() && $dashboard->page_id === $adsAccount->getKey()){
                $adsAccounts = $socialAccount->google_ads_account;
                foreach ($adsAccounts as $acc){
                    if($acc !== $adsAccount){
                        $dashboard->page_id = $acc->getKey();
                        $dashboard->save();
                        break;
                    }
                }
            }
        }
        $adsAccount->delete();
    }
    public function deleteGoogleAdsAccount($account)
    {
        $account->google_ads_account()->each(function ($data) {
            $data->delete();
        });

        $account->delete();
    }
   
}
