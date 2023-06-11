<?php

namespace App\Http\Controllers;


use App\Classes\Activity;
use App\Classes\GoogleAnalytics4API;
use App\Console\Commands\UpdateSocialAccountAllData;
use App\Events\SocialAccountConnectedEvent;
use App\Jobs\UpdateSocialAccountUserData;
use App\Models\GoogleAnalyticsAccount;
use App\Models\GoogleAnalyticsProperty;
use App\Models\GoogleAnalyticsPropertyData;
use App\Models\Page;
use App\Models\SocialAccount;
use App\Services\Social\GoogleAnalyticsService;
use App\Traits\DatePick;
use Carbon\Carbon;
use Exception;
use Google_Client;
use Google_Service_Oauth2;
use App\Classes\IntercomAPI;
use App\Http\Controllers\ActiveCampaitngController;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Dashboard;
use App\Models\Seo;
use phpDocumentor\Reflection\Types\Boolean;
use Carbon\CarbonInterval;
use Http;
class GoogleAnalyticsController extends Controller
{
    use DatePick;

    protected $config;

    public function __construct()
    {
        $this->config = [
            'client_id' => env('GOOGLE_ANALYTICS_CLIENT_ID'),
            'client_secret' => env('GOOGLE_ANALYTICS_CLIENT_SECRET'),
            'redirect_url' => env('APP_URL') .'google-analytics/callback',
        ];
    }

    public function login() {
        header("Location: https://accounts.google.com/o/oauth2/auth?client_id=".$this->config['client_id']."&redirect_uri=".$this->config['redirect_url']."&scope=https://www.googleapis.com/auth/analytics+https://www.googleapis.com/auth/analytics.readonly+https://www.googleapis.com/auth/userinfo.profile+https://www.googleapis.com/auth/userinfo.email&response_type=code&access_type=offline&prompt=consent");
    }

    public function customcodeget(Request $request)
    {
        try{

            dd(0);

            $response = Http::get('https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=ya29.a0AVvZVsrcEIeE9D234JLUE2cofXe-wSi7puNl9tHDAVsTCoI7T7XpRDXYSh80Fu6bIiVCb_eBZxPAkBuhYVLvqa_XVSnMxUPwoas9zPxJw1EvUoW76-rFqkuPQzyBzJuW6j00kWr7al5HyGVftZseT5-iCD41IOvFaCgYKAY8SAQASFQGbdwaIEx_6VYzsXcd0Bm69HeG9ew0167d');


            $data = (json_decode($response->body()));
            if(isset($data->error) && $data->error == 'invalid_token'){
    
                 echo 'error  ';

                $getRefreshToken = '1//09s8w9IKCQIHOCgYIARAAGAkSNwF-L9Irw2z6NepEECAi0CT-t2O2UZrZ2_Q3-EQ-O0cHw_lVySLGIHLEMZSaIwRT71PeNBmFW4M';

                $response2 = Http::post('https://oauth2.googleapis.com/token', [
                    'client_id' => env('GOOGLE_ANALYTICS_CLIENT_ID'),
                    'client_secret' => env('GOOGLE_ANALYTICS_CLIENT_SECRET'),
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $getRefreshToken,
                ]);

                $getNewAccessToken = json_decode($response2->body());

                if(isset($getNewAccessToken->expires_in) && $getNewAccessToken->expires_in > 1000 ) {

                    dd($getNewAccessToken->access_token);
                }
            }

            /*
            $client = new Google_Client();
            $client->setClientId($this->config['client_id']);
            $client->setClientSecret($this->config['client_secret']);
            //$client->setRedirectUri($this->config['redirect_url']);
            $client->fetchAccessTokenWithAuthCode($_GET['code']);

            $accessToken = $client->getAccessToken();
            $client->setAccessToken($accessToken);
            $client->setAccessType("offline");
            $refreshToken = $client->getRefreshToken();

            $accessToken = $accessToken["access_token"];

            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();


            */


            $googleAnalytics4API = new GoogleAnalytics4API();
            $googleAnalytics4API->set_access_token($_GET['code']);
            $userAccounts = $googleAnalytics4API->get_user_accounts();

            dd($userAccounts);

            if (empty($userAccounts)) {
                return $this->view('no_accounts');
            }

            $social_account = $this->createSocialAccount($userInfo, $accessToken, $refreshToken);
            $hasGA4Account = false;
            foreach ($userAccounts as $account) {
                $accountId = $this->getCustomerId($account->name);
                //all properties accosiated with this user account(e.g websites, mobile applications, blogs etc)
                $analyticAccountProperties = $googleAnalytics4API->get_account_properties($accountId);
                if (empty($analyticAccountProperties)) {
                    continue;
                }

                $analyticAccount = $this->createGoogleAnalyticAccount($account , $social_account->id);
                foreach ($analyticAccountProperties as $property) {
                    $newProperty = $this->createGoogleAnalyticProperty($property, $analyticAccount->id);
                    (new GoogleAnalyticsService($social_account))->getAndSavePropertyData($newProperty, "create");
                    
                }
                $hasGA4Account = true;
            }
            
            if (!$hasGA4Account) {
                if ($this->hasGoogleAnalyticsAccountsUA($client)) {
                    $errorMessage = "There is no GA4 account, try to connect UA accounts";
                } else {
                    $errorMessage = "We can not find account properties, fill you account on Google";
                }
            }

            if (isset($errorMessage)) {
                return $this->view(__($errorMessage));
            }
            //dispatch job to get previous data if we only get 3 days data;
            UpdateSocialAccountUserData::dispatch($social_account,Carbon::now()->subDays(30)->format("Y-m-d"));
            //create dashboard
            Dashboard::firstOrCreate([
                'company_id' => Auth::user()->company_id,
                'name' => 'google-analytics-overview',
            ],[
                'name' => 'google-analytics-overview',
                'social_account_id' => $social_account->id,
                'company_id' => Auth::user()->company_id,
                'page_id' => 1,
            ]);
            $intercom = new IntercomAPI();
            $intercom->addConnection('Google Analytics');

            $ActiveCampaitng = new ActiveCampaitngController();
            $ActiveCampaitng->EventTrackingCreation('Google Analytics');
            $ActiveCampaitng->EventTrackingAPI('Google Analytics','','');

            
            //return $this->view('success');

        } catch (RequestException $e) {
            dd($e);
            return $this->view('error');
        }
    }




    public function handleProviderCallback(Request $request)
    {
        try{
            $client = new Google_Client();
            $client->setClientId($this->config['client_id']);
            $client->setClientSecret($this->config['client_secret']);
            $client->setRedirectUri($this->config['redirect_url']);
            $client->fetchAccessTokenWithAuthCode($_GET['code']);

            $accessToken = $client->getAccessToken();
            $client->setAccessToken($accessToken);
            $client->setAccessType("offline");
            $refreshToken = $client->getRefreshToken();

            $accessToken = $accessToken["access_token"];

            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $googleAnalytics4API = new GoogleAnalytics4API();
            $googleAnalytics4API->set_access_token($accessToken);
            $userAccounts = $googleAnalytics4API->get_user_accounts();


            if (empty($userAccounts)) {
                return $this->view('no_accounts');
            }

            $social_account = $this->createSocialAccount($userInfo, $accessToken, $refreshToken);
            $hasGA4Account = false;
            foreach ($userAccounts as $account) {
                $accountId = $this->getCustomerId($account->name);
                //all properties accosiated with this user account(e.g websites, mobile applications, blogs etc)
                $analyticAccountProperties = $googleAnalytics4API->get_account_properties($accountId);
                if (empty($analyticAccountProperties)) {
                    continue;
                }

                $analyticAccount = $this->createGoogleAnalyticAccount($account , $social_account->id);
                foreach ($analyticAccountProperties as $property) {
                    $newProperty = $this->createGoogleAnalyticProperty($property, $analyticAccount->id);
                    (new GoogleAnalyticsService($social_account))->getAndSavePropertyData($newProperty, "create");
                    
                }
                $hasGA4Account = true;
            }
            
            if (!$hasGA4Account) {
                if ($this->hasGoogleAnalyticsAccountsUA($client)) {
                    $errorMessage = "There is no GA4 account, try to connect UA accounts";
                } else {
                    $errorMessage = "We can not find account properties, fill you account on Google";
                }
            }

            if (isset($errorMessage)) {
                return $this->view(__($errorMessage));
            }
            //dispatch job to get previous data if we only get 3 days data;
            UpdateSocialAccountUserData::dispatch($social_account,Carbon::now()->subDays(30)->format("Y-m-d"));
            //create dashboard
            Dashboard::updateOrCreate([
                'company_id' => Auth::user()->company_id,
                'name' => 'google-analytics-overview',
            ],[
                'name' => 'google-analytics-overview',
                'social_account_id' => $social_account->id,
                'company_id' => Auth::user()->company_id,
                'page_id' => 1,
            ]);
            $intercom = new IntercomAPI();
            $intercom->addConnection('Google Analytics');

            $ActiveCampaitng = new ActiveCampaitngController();
            $ActiveCampaitng->EventTrackingCreation('Google Analytics');
            $ActiveCampaitng->EventTrackingAPI('Google Analytics','','');

            


            return $this->view('success');

        } catch (RequestException $e) {
            return $this->view('error');
        }
    }



    private function view($status)
    {
        $connection = "google-analytics";
        return view('tenant.custom-sdk', compact('status', 'connection'));
    }

    private function hasGoogleAnalyticsAccountsUA(Google_Client $client) : bool
    {
        $analytics = new \Google_Service_Analytics($client);
        $googleAnalyticsUAAccounts = $analytics->management_accountSummaries->listManagementAccountSummaries();
        foreach ($googleAnalyticsUAAccounts as $account) {
            if (!empty($account->webProperties)) return true;
        }
        return false;
    }

    public function createSocialAccount($data, $accessToken, $refreshToken){
        $company_id = Auth::user()->company->id;
        $social_account = SocialAccount::updateOrCreate(
            ['company_id' => $company_id, 'provider_id'   => $data->id, 'provider_name' => GoogleAnalyticsService::PROVIDER_NAME],
            [
                'provider_name' => GoogleAnalyticsService::PROVIDER_NAME,
                'company_id' => $company_id,
                'provider_id'   => $data->id,
                'full_name'     => $data->name,
                'email'         => !empty($data->email) ? $data->email : '',
                'avatar'        => !empty($data->picture) ? $data->picture  : '',
                'token'         => $accessToken,
                'refresh_token' => $refreshToken
                //'expires_at'    => Carbon::now()->addDay(59)->format("Y-m-d")
            ]);

        DB::table('company_social_account')->updateOrInsert(
            ['company_id' => $company_id, 'social_account_id' => $social_account->id],
            ['company_id' => $company_id, 'social_account_id' => $social_account->id]
        );

        $activity = new Activity();
        $activity->addActivity('add_connection', 'Google Analytics' . ' ' . $data->name);
        SocialAccountConnectedEvent::dispatch(Auth::user(), "Google Analytics", $data->name ?? '', $data->email ?? '');

        return $social_account;
    }

    public function createGoogleAnalyticAccount($data, $social_account_id){
        $account_id = $this->getCustomerId($data->name);
        $newAccount = GoogleAnalyticsAccount::updateOrCreate(
            [
                'provider_id' => $account_id,
                'social_account_id' => $social_account_id
            ],
            [
                'provider_id' => $account_id,
                'name' => $data->displayName,
                'social_account_id' => $social_account_id
            ]
        );

        return $newAccount;
    }

    public function createGoogleAnalyticProperty($data, $google_analytics_account_id){
        $property_id = $this->getCustomerId($data->name);
        $newProperty = GoogleAnalyticsProperty::updateOrCreate(
            [
                'provider_id' => $property_id,
                'google_analytics_account_id' => $google_analytics_account_id
            ],
            [
                'provider_id' => $property_id,
                'name' => $data->displayName,
                'google_analytics_account_id' => $google_analytics_account_id
            ]
        );
        return $newProperty;
    }

    public function getCustomerId(string $customerStr)
    {
        preg_match('/\/(.*)$/', $customerStr, $matches);
        return $matches[1];
    }

    public function googleAnalyticsPropertyOverview(Request $request)
    {
        if (Auth::user()->company->dashboard->where('name','google-analytics-overview')->isNotEmpty()) {
            $dashboard = Dashboard::where('company_id', Auth::user()->company_id)
                ->where('name', 'google-analytics-overview')
                ->first();
            $social_accounts = Auth::user()->company->social_account_google_analytics->where('id', '!=', $dashboard->social_account_id);
            $first_social=Auth::user()->company->social_account_google_analytics->where('id', $dashboard->social_account_id)->first();
            if(!empty($first_social->last_imported_at)){
                $this->PickDate($request->get('date_from'), $request->get('date_to'));
            }else{
                $this->PickDate($request->get('date_from'), $request->get('date_to'),'90');
            }
            
            $date_from = $this->date_from;
            $date_to = $this->date_to;

            $googleAnalyticsAccounts = GoogleAnalyticsAccount::where('social_account_id', $dashboard->social_account_id);
            $gaAccountsIDs = $googleAnalyticsAccounts->pluck('id')->toArray();
            $page = GoogleAnalyticsProperty::findOrFail($dashboard->page_id);
            $pages = GoogleAnalyticsProperty::whereIn('google_analytics_account_id', $gaAccountsIDs)->where('id', '!=', $page->id)->get();

            $connect_name = $page?->name;
            $template_name = 'google-analytics-overview';
            $dashId = $dashboard->getKey();

            $seo = Seo::where('route', $request->getRequestUri())->first();

            if(!empty($dashboard)) {
                $user = Auth::user();
                $user->last_visited_dashboard = 'google-analytics-overview';
                $user->save();
            }

            $sessionsTotal = round(GoogleAnalyticsPropertyData::where('property_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->avg('sessions_per_user'), 2);
            $activeUsers = round(GoogleAnalyticsPropertyData::where('property_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('active_users'));
            $newUsersPerDay = DB::table('ga_property_returning_vs_new_user_per_day')
                ->where('property_id', $page->id)
                ->where('type', 'new')
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->orderBy('date', 'desc')
                ->limit(20)
                ->pluck('number');

            $returningUsersPerDay = DB::table('ga_property_returning_vs_new_user_per_day')
                ->where('property_id', $page->id)
                ->where('type', 'returning')
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->orderBy('date', 'desc')
                ->limit(20)
                ->pluck('number');

            $usersDates = DB::table('ga_property_returning_vs_new_user_per_day')
                ->whereIn('type', ['new'])
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->orderBy('date', 'desc')
                ->limit(20)
                ->pluck('date');

            $averageTimeOnPage = round(GoogleAnalyticsPropertyData::where('property_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->avg('average_session_duration'));
            $pageViewsPerSession = round(GoogleAnalyticsPropertyData::where('property_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('screen_page_views_per_session'));

            $mostPopularPages = DB::table('ga_property_page_views_by_page_path')
                ->where('property_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->groupBy('page_path')
                ->selectRaw('page_path, sum(views) as views')
                ->orderByDesc('views')
                ->limit(8)
                ->get()
                ->toArray();

            $countriesSessions = DB::table('ga_property_data_by_country')
                ->where('property_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->groupBy('country')
                ->selectRaw('country, sum(sessions) as sessions')
                ->orderByDesc('sessions')
                ->limit(8)
                ->get()
                ->toArray();

            $colorsList = ["#FF9A41", "#F9C292", "#356792", "#16CE89", "#153A5A", "#356792", "#cfcfcf", "#232323"];

            // DEVICE SESSIONS //
            $deviceSessions = DB::table('ga_property_sessions_by_device')
                ->where('property_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->groupBy('device')
                ->selectRaw('device, sum(value) as sessions')
                ->orderByDesc('sessions')
                ->limit(8)
                ->get();
            $allSessions = array_sum(array_column($deviceSessions->toArray(), 'sessions'));
            $deviceSessions->each(function ($device) use ($allSessions) {
                $device->percentage = round($device->sessions * 100 / $allSessions, 2);
            });
            $devicesList = array_column($deviceSessions->toArray(), 'device');
            $devicesPercentageList = array_column($deviceSessions->toArray(), 'percentage');

            // CONVERSIONS BY COUNTRY //
            $countryConversions = DB::table('ga_property_data_by_country')
                ->where('property_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->groupBy('country')
                ->selectRaw('country, sum(conversions) as conversions')
                ->orderByDesc('conversions')
                ->limit(8)
                ->get();
            $allConversions = array_sum(array_column($countryConversions->toArray(), 'conversions'));
            $countryConversions->each(function ($item) use ($allConversions) {
                $item->percentage = round($item->conversions * 100 / $allConversions, 2);
            });
            $countryList = array_column($countryConversions->toArray(), 'country');
            $countryPercentageList = array_column($countryConversions->toArray(), 'percentage');


            $channelsUsers = DB::table('ga_property_sessions_by_channel')
                ->where('property_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->groupBy('channel')
                ->selectRaw('channel, sum(total_users) as total_users')
                ->orderByDesc('total_users')
                ->limit(8)
                ->get();
            $allChannelsUsers = array_sum(array_column($channelsUsers->toArray(), 'total_users'));
            $channelsUsers->each(function ($channel) use ($allChannelsUsers) {
                $channel->percentage = round($channel->total_users * 100 / $allChannelsUsers, 2);
            });
            $channelsList = array_column($channelsUsers->toArray(), 'channel');
            $channelsPercentageList = array_column($deviceSessions->toArray(), 'percentage');


            $sources = DB::table('ga_property_data_by_source')
                ->where('property_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->groupBy('source')
                ->selectRaw('source, sum(sessions) as sessions, sum(users) as users, sum(new_users) as new_users, sum(conversions) as conversions')
                ->orderByDesc('users')
                ->limit(8)
                ->get();


            $mostPopularPageTitles = DB::table('ga_property_page_views_by_page_title')
                ->where('property_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->groupBy('page_title')
                ->selectRaw('page_title, sum(views) as views, sum(sessions) as sessions')
                ->orderByDesc('views')
                ->limit(8)
                ->get()
                ->toArray();


            $propertyData = DB::table('google_analytics_property_data')
                ->where('property_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->selectRaw('sum(total_users) as total_users, avg(engagement_rate) as engagement_rate, sum(user_engagement_duration) as user_engagement_duration')
                ->first();

            $totalUsers = intval($propertyData->total_users);
            $engagementRate = round($propertyData->engagement_rate, 2);

            $userEngagement = 0;
            if ($propertyData->user_engagement_duration) {
                $userEngagement = CarbonInterval::seconds($propertyData->user_engagement_duration)->cascade()->forHumans(null, true);
            }

            $conversionsPerDay = DB::table('google_analytics_property_data')
                ->where('property_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->orderBy('date', 'desc')
                ->limit(20)
                ->pluck('conversions');

            $conversionsDates = DB::table('google_analytics_property_data')
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->orderBy('date', 'desc')
                ->limit(20)
                ->pluck('date');

            return view('tenant.home_screen', compact([
                'connect_name',
                'template_name',
                'page',
                'pages',
                'social_accounts',
                'newUsersPerDay', 'returningUsersPerDay', 'usersDates',
                'sessionsTotal',
                'activeUsers',
                'engagementRate',
                'averageTimeOnPage',
                'pageViewsPerSession',
                'userEngagement',
                'mostPopularPages',
                'countriesSessions',
                'colorsList',
                'allSessions', 'deviceSessions', 'devicesList', 'devicesPercentageList',
                'allConversions', 'countryConversions', 'countryList', 'countryPercentageList',
                'allChannelsUsers', 'channelsUsers', 'channelsList', 'channelsPercentageList',
                'mostPopularPageTitles',
                'sources',
                'dashId',
                'date_to', 'date_from',
                'totalUsers',
                'conversionsPerDay', 'conversionsDates'
            ]));
        } else {
            return view('tenant.home_screen');
        }
    }
}
