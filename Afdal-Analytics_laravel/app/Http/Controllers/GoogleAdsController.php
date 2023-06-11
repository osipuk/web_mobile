<?php

namespace App\Http\Controllers;

use App\Classes\Activity;
use App\Classes\IntercomAPI;
use App\Http\Controllers\ActiveCampaitngController;
use App\Events\SocialAccountConnectedEvent;
use App\Models\Dashboard;
use App\Models\GoogleAdsAccount;
use App\Models\GoogleAdsAccountData;
use App\Models\GoogleAdsCampaign;
use App\Models\GoogleAdsCampaignData;
use App\Models\GoogleAdsGroup;
use App\Models\GoogleAdsGroupData;
use App\Models\Seo;
use App\Models\SocialAccount;
use App\Services\Social\GoogleAdsService;
use App\Traits\DatePick;
use Carbon\Carbon;
use Exception;
use Google_Client;
use Google_Service_Oauth2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GoogleAdsController extends Controller
{
    use DatePick;

    protected array $config = [];

    private static array $REPORT_TYPE_TO_DEFAULT_SELECTED_FIELDS = [
        'campaign' => ['campaign.id', 'campaign.name', 'campaign.status'],
        'customer' => ['customer.id']
    ];

    public function __construct()
    {
        $this->config = [
            'client_id' => env('GOOGLE_ADS_CLIENT_ID'),
            'client_secret' => env('GOOGLE_ADS_CLIENT_SECRET'),
            'redirect_url' => env('APP_URL') .'google-ads/callback',
        ];
    }

    public function login()
    {
        header("Location: https://accounts.google.com/o/oauth2/auth?client_id=".$this->config['client_id']."&redirect_uri=" . $this->config['redirect_url'] . "&scope=https://www.googleapis.com/auth/adwords+https://www.googleapis.com/auth/userinfo.profile&response_type=code&access_type=offline&prompt=consent");
    }

    public function callback(Request $request){
        if (empty($_GET['code'])){
            return $this->view('error');
        }
        try{
            $client = new Google_Client();
            $client->setClientId($this->config['client_id']);
            $client->setClientSecret($this->config['client_secret']);
            $client->setRedirectUri($this->config['redirect_url']);
            $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $refreshToken = $client->getRefreshToken();
            $accessToken = $client->getAccessToken();
            $client->setAccessToken($accessToken);

            if (!strpos($accessToken["scope"], 'adwords') && !strpos($accessToken["scope"], 'profile')){
                return $this->view('error_no_permissions');
            }

            $accessToken = $accessToken["access_token"];

            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();

            $is_connected = $this->checkIfAccountIsConnected($userInfo);

            if ($is_connected){
                return $this->view('error_account_connected');
            }

            $social_account = $this->createSocialAccount($userInfo, $accessToken, $refreshToken);

            $status = (new GoogleAdsService($social_account))->callback();
            $activity = new Activity();
            $activity->addActivity('add_connection', 'Google Ads' . ' ' . $userInfo->name);
            SocialAccountConnectedEvent::dispatch(Auth::user(), "Google Ads", $userInfo->name ?? '', $userInfo->email ?? '');
            $intercom = new IntercomAPI();
            $ActiveCampaitng = new ActiveCampaitngController();
            $intercom->addConnection('Google Ads');
            //adding active campaign event tracking for google ads
            $ActiveCampaitng->EventTrackingCreation('Google Ads');
            $ActiveCampaitng->EventTrackingAPI('Google Ads','','');
           
            return $this->view($status);
        } catch (Exception $e) {
            return $this->view('error');
        }
    }

    private function view($status)
    {
        $connection = 'googleAds';
        return view('tenant.custom-sdk', compact('status', 'connection'));
    }


    public function checkIfAccountIsConnected($data){
        $is_connected = SocialAccount::where('company_id', Auth::user()->company->id)
            ->where('provider_id', $data->id)
            ->where('provider_name', 'googleAds')
            ->count();
        return $is_connected;
    }

    public function createSocialAccount($data, $accessToken, $refreshToken){
        $company_id = Auth::user()->company->id;
        $social_account = SocialAccount::updateOrCreate(
            ['company_id' => $company_id, 'provider_id'   => $data->id, 'provider_name' => 'googleAds'],
            [
                'provider_name' => 'googleAds',
                'company_id' => $company_id,
                'provider_id'   => $data->id,
                'full_name'     => $data->name,
                'email'         => !empty($data->email) ? $data->email : '',
                'avatar'        => !empty($data->picture) ? $data->picture  : '',
                'token'         => $accessToken,
                'refresh_token' => $refreshToken,
                'last_imported_at' => Carbon::now()
//                'expires_at'    => Carbon::now()->addDays(59),
            ]);

        DB::table('company_social_account')->updateOrInsert(
            ['company_id' => $company_id, 'social_account_id' => $social_account->id],
            ['company_id' => $company_id, 'social_account_id' => $social_account->id]
        );

        return $social_account;
    }

    public function googleAdsOverview(Request $request)
    {
        if (Auth::user()->company->dashboard->where('name','google-ads-overview')->isNotEmpty()) {
            $this->PickDate($request->get('date_from'), $request->get('date_to'));
            $date_from = $this->date_from;
            $date_to = $this->date_to;

            $dashboard = Auth::user()->company->dashboard->where('name','google-ads-overview')->first();
            $social_accounts = Auth::user()->company->social_account_google_ads->where('id', '!=', $dashboard->social_account_id);
            $google_ads_account = GoogleAdsAccount::findOrFail($dashboard->page_id);
            $pages = GoogleAdsAccount::where('social_account_id', $dashboard->social_account_id)->where('id', '!=', $google_ads_account->id)->get();
            $page = $google_ads_account;

            $impressions_per_day = GoogleAdsAccountData::select('impressions', 'date')
                ->where('google_ads_account_id', $google_ads_account->id)
                ->whereBetween('date', [$date_from, $date_to])
                ->distinct('date')
                ->orderBy('date', 'desc')
                ->pluck('impressions','date');

            $clicks_per_day = GoogleAdsAccountData::select('clicks', 'date')
                ->where('google_ads_account_id', $google_ads_account->id)
                ->whereBetween('date', [$date_from, $date_to])
                ->distinct('date')
                ->orderBy('date', 'desc')
                ->pluck('clicks','date');

            $data = GoogleAdsAccountData::where('google_ads_account_id', $google_ads_account->id)
                ->whereBetween('date', [$date_from, $date_to])
                ->selectRaw('sum(impressions) as impressions, sum(ctr) as ctr, sum(clicks) as clicks, sum(conversions) as conversions' )
                ->get();

            $data = $data[0];

            $campaigns = GoogleAdsCampaign::where('google_ads_account_id', $google_ads_account->id)->pluck('id');

            $campaign_data = GoogleAdsCampaignData::whereIn('google_ads_campaign_id', $campaigns)
                ->whereBetween('date', [$date_from, $date_to])
                ->leftJoin('google_ads_campaigns', 'google_ads_campaign_data.google_ads_campaign_id', '=', 'google_ads_campaigns.id')
                ->groupBy('google_ads_campaign_id')
                ->selectRaw('google_ads_campaigns.name, google_ads_campaigns.device, google_ads_campaigns.network_type, '
                    . 'sum(clicks) as clicks, sum(impressions) as impressions, sum(ctr) as ctr, sum(cost) as cost, '
                        . 'sum(conversions) as conversions')
                ->orderByDesc('clicks')
                ->limit(5)
                ->get();

            $groups = GoogleAdsGroup::where('google_ads_account_id', $google_ads_account->id)->pluck('id');

            $group_data = GoogleAdsGroupData::whereIn('google_ads_group_id', $groups)
                ->whereBetween('date', [$date_from, $date_to])
                ->leftJoin('google_ads_groups', 'google_ads_group_data.google_ads_group_id', '=', 'google_ads_groups.id')
                ->groupBy('google_ads_group_id')
                ->selectRaw('google_ads_groups.base_ad_group, google_ads_groups.campaign_resource_name, google_ads_groups.device, google_ads_groups.network_type, '
                    . 'sum(clicks) as clicks, sum(impressions) as impressions, sum(ctr) as ctr, sum(cost) as cost, '
                    . 'sum(conversions) as conversions')
                ->orderByDesc('clicks')
                ->limit(5)
                ->get();

            $connect_name = $google_ads_account->name != "" || $google_ads_account->name != null ? $google_ads_account->name : $google_ads_account->provider_id;
            $template_name = 'google-ads-overview';
            $dashId = $dashboard->getKey();

            $seo = Seo::where('route', $request->getRequestUri())->first();

            if(!empty($dashboard)) {
                $user = Auth::user();
                $user->last_visited_dashboard = 'google-ads-overview';
                $user->save();
            }

            return view('tenant.home_screen', compact(['seo','dashId','template_name','connect_name','group_data',
                'campaign_data', 'data','clicks_per_day','impressions_per_day', 'page', 'pages', 'social_accounts',
                'dashboard', 'date_to', 'date_from', 'google_ads_account']));
        } else {
            return view('tenant.home_screen');
        }
    }

    public function changeProviderName(){
        SocialAccount::onlyTrashed()->forceDelete();
        DB::table('social_accounts')->where('provider_name', 'google-ads')->orderBy('created_at')->each(function ($account) {
            $account->update(['provider_name' => 'googleAds']);
        });
        dd('update name');
    }

    public function testUpdateAds(){
        $account = SocialAccount::find(964);
        $test = (new GoogleAdsService($account))->updateUserData();
        dd('done');
    }


}
