<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\GoogleAdsAccount;
use App\Services\Social\GoogleAdsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\UserPlanHelper;
use App\Models\SocialAccount;
use Illuminate\Support\Carbon;

class ConnectionController extends Controller
{
    public function getConnections()
    {
        if (Auth::user()->company->social_account()->count() > 0) {
            $returnHTML = view('tenant.v2.response-view.report-connections')->render();
            $returnHTML2 = view('tenant.v2.response-view.report-template')->render();
            return response()->json([
                'success' => true,
                'html' => $returnHTML,
                'html2' => $returnHTML2
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }
    public function countConnections()
    {
        $count = 0;
        if (Auth::check()) {
            $count = Auth::user()->company->social_account()->count();
        }
        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }
    public function checkConnections()
    {
        if (Auth::check()) {
            $dashboard = Dashboard::where('company_id', Auth::user()->company_id)->first();
            if (!empty($dashboard)) {
                return response()->json([
                    'success' => true,
                    'count' => true
                ]);
            }
        }
        return response()->json([
            'success' => true,
            'count' => false
        ]);
    }
    public function googleAddsReport()
    {
        $type = 'google-ads-overview';
        $dashboard = Auth::user()->company->dashboard->where('name', $type)->first();
        $providerName = GoogleAdsService::PROVIDER_NAME;
        $social_accounts = Auth::user()->company->social_accounts->where('provider_name', $providerName);
        foreach ($social_accounts as $account) {
            if ($account->provider_name == 'googleAds' && count($account->google_ads_account)) {
                foreach ($account->google_ads_account as $adsAccount) {
                    $google_ads_account_id = $adsAccount->id;
                    break;
                }
            }
        }

        $googleAdsAccount = GoogleAdsAccount::findOrFail($google_ads_account_id);
        $socialAccountId = $googleAdsAccount->social_account_id;
        $pageId = $google_ads_account_id;
        //start here
        if (!$this->checkSocialAccountOwner($socialAccountId)) {
            return response()->json([
                'status' => false,
                'message' => 'Wrong data'
            ]);
        }
        Dashboard::updateOrCreate([
            'company_id' => Auth::user()->company_id,
            'name' => $type,
        ],[
            'name' => $type,
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
    public function searchUserConnections(Request $request)
    {
        $social_accounts = SocialAccount::with('page', 'ads_account', 'google_analytics_account.properties.profiles', 'google_ads_account')
            ->where('company_id', Auth::user()->company_id)
            ->where('disabled', false)
            ->where('provider_name', $request->provider_name);
        if(!empty($request->search)){
            $social_accounts->where('full_name', 'LIKE', '%' . $request->search . '%');
        }
        if($request->date == 'week'){
            $social_accounts->where('created_at', '>=', Carbon::now()->subDays(7) );
        }else if($request->date == 'month'){
            $social_accounts->where('created_at', '>=', Carbon::now()->subMonth() );
        }else if($request->date == '6month'){
            $social_accounts->where('created_at', '>=', Carbon::now()->subMonths(6) );
        }
        else if($request->date == 'year'){
            $social_accounts->where('created_at', '>=', Carbon::now()->subYear());
        }
        $social_accounts = $social_accounts->get();
        if($social_accounts->isNotEmpty()){
            $social_accounts->toArray();
        }else{
            $social_accounts=null;
        }

        $returnHTML = view('tenant.v2.response-view.conenctions-account',['social_accounts'=>$social_accounts,'provider_name'=>$request->provider_name])->render();
        $returnHTML2 = view('tenant.v2.response-view.conenctions-account-footer',['social_accounts'=>$social_accounts,'provider_name'=>$request->provider_name])->render();
        return response()->json([
            'success' => true,
            'provider_name'=>$request->provider_name,
            'html' => $returnHTML,
            'html2' => $returnHTML2,
        ]);
    }
    public function getReportsHtml(Request $request,$provider){

        $returnHTML = view('tenant.v2.response-view.connection-report-popup',['provider_name'=>$provider])->render();
        return response()->json([
            'success' => true,
            'html' => $returnHTML,
        ]);
    }
}
