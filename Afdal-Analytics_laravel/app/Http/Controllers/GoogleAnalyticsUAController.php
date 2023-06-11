<?php

namespace App\Http\Controllers;


use App\Classes\GoogleAnalytics4API;
use App\Models\GoogleAnalyticsAccount;
use App\Models\GoogleAnalyticsProperty;
use App\Models\GoogleAnalyticsPropertyData;
use App\Models\GoogleAnalyticsPropertyProfile;
use App\Models\Page;
use App\Models\SocialAccount;
use App\Traits\DatePick;
use Carbon\Carbon;
use Exception;
use Google_Client;
use Google_Service_Oauth2;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Dashboard;
use App\Models\Seo;
use phpDocumentor\Reflection\Types\Boolean;

class GoogleAnalyticsUAController extends Controller
{
    use DatePick;

    protected $config;

    public function __construct()
    {
        $this->config = [
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect' => env('APP_URL') .'google-analytics/callback',
        ];
    }

    public function login() {
        header("Location: https://accounts.google.com/o/oauth2/auth?client_id=862858277201-m7us88ufp3219nbiedbe34sog77832fb.apps.googleusercontent.com&redirect_uri=https://dev.afdalanalytics.com/google-analytics/callback&scope=https://www.googleapis.com/auth/analytics+https://www.googleapis.com/auth/analytics.readonly+https://www.googleapis.com/auth/userinfo.profile+https://www.googleapis.com/auth/userinfo.email&response_type=code&access_type=offline&prompt=consent");
    }

    public function handleProviderCallback(Request $request)
    {
        try{
            $client = new Google_Client();
            $client->setAuthConfig('client_analytics_secret.json');
            $client->fetchAccessTokenWithAuthCode($_GET['code']);
            //need check if user has all permission
            $accessToken = $client->getAccessToken();

            $client->setAccessToken($accessToken);
            $refreshToken = $client->getRefreshToken();

            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();
            $socialAccount = $this->createSocialAccount($userInfo, $accessToken, $refreshToken);

            $analytics = new \Google_Service_Analytics($client);
            $googleAnalyticsUAAccounts = $analytics->management_accountSummaries->listManagementAccountSummaries();
            foreach ($googleAnalyticsUAAccounts as $account) {
                if (empty($account->webProperties)) {
                    continue;
                }

                $newAccount = $this->createGoogleAnalyticAccount($account->id , $account->name, $socialAccount->id);
                foreach($account->webProperties as $property) {
                    if (empty ($property->profiles)) {
                        continue;
                    }
                    $newProperty = $this->createGoogleAnalyticProperty($property->id, $property->name, $newAccount->id);
                    foreach ($property->profiles as $profile) {
                        $this->createGoogleAnalyticProfile($profile->id, $profile->name, $newProperty->id);
                    }

                }
            }

            return response()->json([
                'status' => true,
                'message' => __('Connection connected successfully')
            ], 200);

        } catch (RequestException $e) {
            $status = 'error';
            $connection = 'google-analytics';
            return view('tenant.custom-sdk', compact('status', 'connection'));
        }
    }

    public function createSocialAccount($data, $accessToken, $refreshToken){
        $company_id = Auth::user()->company->id;
        $social_account = SocialAccount::updateOrCreate(
            ['company_id' => $company_id, 'provider_id'   => $data->id, 'provider_name' => 'google-analytics'],
            [
                'provider_name' => 'google-analytics-ua',
                'company_id' => $company_id,
                'provider_id'   => $data->id,
                'full_name'     => $data->name,
                'email'         => !empty($data->email) ? $data->email : '',
                'avatar'        => !empty($data->picture) ? $data->picture  : '',
                'token'         => $accessToken,
                'refresh_token' => $refreshToken,
                'expires_at'    => Carbon::now()->addDay(59),
            ]);

        DB::table('company_social_account')->updateOrInsert(
            ['company_id' => $company_id, 'social_account_id' => $social_account->id],
            ['company_id' => $company_id, 'social_account_id' => $social_account->id]
        );

        return $social_account;
    }

    public function createGoogleAnalyticAccount($accountId, $accountName, $socialAccountId){
        $newAccount = GoogleAnalyticsAccount::updateOrCreate(
            [
                'provider_id' => $accountId,
                'social_account_id' => $socialAccountId
            ],
            [
                'provider_id' => $accountId,
                'name' => $accountName,
                'social_account_id' => $socialAccountId
            ]
        );

        return $newAccount;
    }

    private function createGoogleAnalyticProperty($propertyId, $propertyName, $accountId){
        $newProperty = GoogleAnalyticsProperty::updateOrCreate(
            [
                'provider_id' => $propertyId,
                'google_analytics_account_id' => $accountId
            ],
            [
                'provider_id' => $propertyId,
                'name' => $propertyName,
                'google_analytics_account_id' => $accountId
            ]
        );
        return $newProperty;
    }

    private function createGoogleAnalyticProfile($profileId, $profileName, $propertyId){
        $newProfile = GoogleAnalyticsPropertyProfile::updateOrCreate(
            [
                'profile_id' => $profileId,
                'property_id' => $propertyId
            ],
            [
                'profile_id' => $propertyId,
                'name' => $profileName,
                'property_id' => $propertyId
            ]
        );
        return $newProfile;
    }

    public function googleAnalyticsProfileOverview(Request $request)
    {
    }
}
