<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdsAccount;
use App\Models\Dashboard;
use App\Models\GoogleAdsAccount;
use App\Models\GoogleAnalyticsAccount;
use App\Models\GoogleAnalyticsProperty;
use App\Models\Page;
use App\Models\SocialAccount;
use App\Services\Social\GoogleAdsService;
use App\Services\Social\GoogleAnalyticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function store(Request $request){
        $social_account_id = Auth::user()->company->social_account_facebook->last()->id;
        $page = Page::where('social_account_id', $social_account_id)->orderBy('created_at', 'desc')->first();
        Dashboard::updateOrCreate([
            'company_id' => Auth::user()->company_id,
            'name' => $request->name,
        ],[
            'name' => $request->name,
            'social_account_id' => $social_account_id,
            'company_id' => Auth::user()->company_id,
            'page_id' => $page->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Template added successfully'
        ]);
    }

    public function switchAccount(Request $request,$template, $account_id, $page_id = null) {
        $dashboard = Dashboard::where('company_id', Auth::user()->company_id)
            ->where('name', $template)
            ->firstOrFail();
        $dashboard->social_account_id = $account_id;
        if($template == 'google-ads-overview' && $page_id == null){
            $first_page = GoogleAdsAccount::where('social_account_id', $account_id)->first();
            $dashboard->page_id = $first_page->id;
        }else if($template == 'google-analytics-overview' && $page_id == null){
            $first_page = GoogleAnalyticsAccount::where('social_account_id', $account_id)->first();
            $dashboard->page_id = $first_page->id;
        }
        elseif ($page_id && $template !== 'twitter-overview' && $template !== 'facebook-ads-overview'){
            $dashboard->page_id = $page_id;
        } elseif ($template !== 'twitter-overview' && $template !== 'facebook-ads-overview'){
            $first_page = Page::where('social_account_id', $account_id)->first();
            $dashboard->page_id = $first_page->id;
        } elseif ($template === 'facebook-ads-overview'){
            $first_page = AdsAccount::where('id', $page_id)->first();
            $dashboard->page_id = $first_page->id;
        }
        $dashboard->save();
        if($request->get('date1') && $request->get('date2')){
            return redirect('/dashboard/'.$template.'?date1='.$request->get('date1').'&date2='.$request->get('date2'));
        }
        return redirect('/dashboard/'.$template);
    }

    public function storeDashboard(Request $request)
    {
        if($request->google_ads_account_id){
            $googleAdsAccount = GoogleAdsAccount::findOrFail($request->google_ads_account_id);
            $socialAccountId = $googleAdsAccount->social_account_id;
            $pageId = $request->google_ads_account_id;
        }else if ($request->google_analytics_property_id) {
            $googleAnalyticsProperty = GoogleAnalyticsProperty::where('id', $request->google_analytics_property_id)->first();
            $googleAnalyticsAccount = GoogleAnalyticsAccount::where('id', $googleAnalyticsProperty->google_analytics_account_id)->first();
            $socialAccountId = $googleAnalyticsAccount->social_account_id;
            $pageId = $request->google_analytics_property_id;
        } else if ($request->ads_account_id) {
            $adsAccount = AdsAccount::where('id', $request->ads_account_id)->first();
            $socialAccountId = $adsAccount->social_account_id;
            $pageId = $request->ads_account_id;
        } else if ($request->page_id) {
            $pageId = $request->page_id;
            $page = Page::where('id', $pageId)->first();
            $socialAccountId = $page->social_account_id;
        } elseif ($request->social_account_id) {
            $pageId = 0;
            $socialAccountId = $request->social_account_id;
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error saving. Need more data'
            ]);
        }

        // todo: replace to model
        if (!$this->checkSocialAccountOwner($socialAccountId)) {
            return response()->json([
                'status' => false,
                'message' => 'Wrong data'
            ]);
        }

        Dashboard::updateOrCreate([
            'company_id' => Auth::user()->company_id,
            'name' => $request->name,
        ],[
            'name' => $request->name,
            'company_id' => Auth::user()->company_id,
            'social_account_id' => $socialAccountId,
            'page_id' => $pageId,
        ]);

        return response()->json([
            'status' => true,
            'message' => __('Dashboard saved successfully')
        ]);
    }

    private function checkSocialAccountOwner($socialAccountId)
    {
        return ($socialAccountId && in_array($socialAccountId, Auth::user()->company->social_accounts->pluck('id')->toArray()));
    }

    public function show($type)
    {
//        adblock fix
        if($type == 'googlea-overview'){
            $type = 'google-ads-overview';
        }
        $dashboard = Auth::user()->company->dashboard->where('name', $type)->first();
        $providerName = $this->getProviderByDashboardType($type);
        try {
            return view('tenant/dashboard_template/modal/' . $type, [
                'type' => $type,
                'dashboard_page_id' => $dashboard->page_id ?? 0,
                'social_account_id' => $dashboard->social_account_id ?? 0,
                'social_accounts' => Auth::user()->company->social_accounts->where('provider_name', $providerName)
            ]);
        } catch (\Exception $e) {
            return view('tenant/dashboard_template/modal/undefined');
        }
    }

    // TODO:: refactor if-else
    private function getProviderByDashboardType($dashboardType) : string
    {
        if ($dashboardType == 'facebook-overview') $providerName = 'facebook';
        elseif ($dashboardType == 'facebook-ads-overview') $providerName = 'facebookAds';
        elseif ($dashboardType == 'facebook-engagement') $providerName = 'facebook';
        elseif ($dashboardType == 'instagram-overview') $providerName = 'instagram';
        elseif ($dashboardType == 'twitter-overview') $providerName = 'twitter';
        elseif ($dashboardType == 'google-analytics-overview') $providerName = GoogleAnalyticsService::PROVIDER_NAME;
        elseif ($dashboardType == 'google-analytics-ua-overview') $providerName = 'google-analytics-ua';
        elseif ($dashboardType == 'google-ads-overview') $providerName = GoogleAdsService::PROVIDER_NAME;
        else $providerName = "";
        return $providerName;
    }
}
