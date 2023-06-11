<?php

namespace App\Services\Social;

use App\Classes\Activity;
use App\Classes\IntercomAPI;
use App\Http\Controllers\ActiveCampaitngController;
use App\Events\SocialAccountConnectedEvent;
use App\Models\GoogleAdsAccount;
use App\Models\GoogleAdsAccountData;
use App\Models\GoogleAdsCampaign;
use App\Models\GoogleAdsCampaignData;
use App\Models\GoogleAdsGroup;
use App\Models\GoogleAdsGroupData;
use App\Models\SocialAccount;
use Carbon\Carbon;
use Google\Ads\GoogleAds\Lib\V10\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\V10\Enums\AdNetworkTypeEnum\AdNetworkType;
use Google\Ads\GoogleAds\V10\Enums\DeviceEnum\Device;
use Google\Ads\GoogleAds\V10\Services\CustomerServiceClient;
use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google_Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GoogleAdsService extends BasicService implements SocialService
{
    const PROVIDER_NAME = "googleAds";

    private $callback_date_from;
    private $callback_date_to;

    public function __construct(SocialAccount $socialAccount)
    {
        $this->socialAccount = $socialAccount;
        $this->callback_date_from = Carbon::now()->subMonths(3)->format('Y-m-d');
        $this->callback_date_to = Carbon::now()->subDay()->format('Y-m-d');
    }

    private function setDateFrom($date){
        $this->callback_date_from = $date;
    }

    public function updateUserData()
    {
        $this->log("Start update");
        if (!$this->checkSinceDate($this->socialAccount->last_imported_at)) {
            return false;
        }

        if (!empty($this->socialAccount->last_imported_at)) {
            $this->setDateFrom(Carbon::parse($this->socialAccount->last_imported_at)->format("Y-m-d"));
        }

        $customerServiceClient = $this->setupGoogleAdsClient($this->socialAccount->refresh_token);
        $accessibleCustomers = $customerServiceClient->listAccessibleCustomers();
        $customers = $accessibleCustomers->getResourceNames();
        $this->getAndSaveCustomerStatistics($customers, 'update');

        $this->socialAccount->last_imported_at = Carbon::now();
        $this->socialAccount->save();
        $this->log("Finish update");
        return 'done';
    }

    public function callback(){
        try {
            $customerServiceClient = $this->setupGoogleAdsClient($this->socialAccount->refresh_token);
            $accessibleCustomers = $customerServiceClient->listAccessibleCustomers();
            $customers = $accessibleCustomers->getResourceNames();

            if (count($customers) > 0){
                $this->getAndSaveCustomerStatistics($customers, 'create');
                $status = 'success';
                $intercom = new IntercomAPI();
                $intercom->addConnection('Google Ads');
                $ActiveCampaitng = new ActiveCampaitngController();
                $ActiveCampaitng->EventTrackingCreation('Google Ads');
                $ActiveCampaitng->EventTrackingAPI('Google Ads','',$user->email);
        
                // $intercom->EventTrackingAPI('Google_Ads','abc');
            }else{
                $status = 'no_accounts';
            }
            return $status;
        }catch (RequestException $e){
            Log::warning("Google Ads Client Error:" . $e->getMessage());
            return 'error';
        }

    }

    public function getAndSaveCustomerStatistics($customers, $type){
        foreach ($customers as $customerResourceName) {
            $customer = CustomerServiceClient::parseName($customerResourceName)['customer_id'];
            $googleAdsServiceClient = $this->setupGoogleAdsClient($this->socialAccount->refresh_token, $customer);
            $stream = $this->getGoogleAdsAccounts($googleAdsServiceClient, $customer);
            foreach ($stream as $googleAdsRow) {
                $customerClient = $googleAdsRow->getCustomerClient();
                $googleAdsAccount = $this->createGoogleAdsAccount($customerClient, $this->socialAccount->id, $type);
                $customerId = $customerClient->getId();

                if (!$customerClient->getManager()){
                    $customer_data = $this->getAccountStatistics($googleAdsServiceClient, $customerId);
                    $this->saveGoogleAdsAccountData($customer_data->iterateAllElements(), $googleAdsAccount->id);

                    $customer_campaigns = $this->getAccountCampaigns($googleAdsServiceClient, $customerId);

                    foreach ($customer_campaigns as $googleAdsRow) {
                        $campaign = $this->createGoogleAdsCampaign($googleAdsRow, $googleAdsAccount->id, $type);
                        $campaign_data = $this->getCampaignStatistics($googleAdsServiceClient, $customerId, $campaign, $googleAdsRow);
                        $this->saveCampaignData($campaign_data , $campaign->id);
                    }

                    $customer_groups = $this->getAccountGroups($googleAdsServiceClient, $customerId);

                    foreach ($customer_groups as $googleAdsRow) {
                        $ad_group = $this->createGoogleAdsGroup($googleAdsRow, $googleAdsAccount->id, $type);
                        $group_data = $this->getGroupStatistics($googleAdsServiceClient, $customerId, $ad_group, $googleAdsRow);
                        $this->saveGroupData($group_data, $ad_group->id);
                    }
                }
            }
        }
    }

    public function setupGoogleAdsClient($refreshToken, $customer = null) {
        try {
            $oAuth2Credential = (new OAuth2TokenBuilder())
                ->withClientId(env('GOOGLE_ADS_CLIENT_ID'))
                ->withClientSecret(env('GOOGLE_ADS_CLIENT_SECRET'))
                ->withRefreshToken($refreshToken)
                ->build();

            if ($customer) {
                $googleAdsClient = (new GoogleAdsClientBuilder())
                    ->withOAuth2Credential($oAuth2Credential)
                    ->withDeveloperToken(env('GOOGLE_ADS_DEVELOPER_TOKEN'))
                    ->withLoginCustomerId($customer)
                    ->build();
                $response = $googleAdsClient->getGoogleAdsServiceClient();
            }else{
                $googleAdsClient = (new GoogleAdsClientBuilder())
                    ->withOAuth2Credential($oAuth2Credential)
                    ->withDeveloperToken(env('GOOGLE_ADS_DEVELOPER_TOKEN'))
                    ->build();
                $response = $googleAdsClient->getCustomerServiceClient();
            }

            return $response;
        }catch (\Exception $e){
            Log::warning("Google Ads Client Error:" . $e->getMessage());
            return null;
        }

    }

    public function getGoogleAdsAccounts($googleAdsServiceClient, $customer){
        $query = 'SELECT customer_client.client_customer, customer_client.level,'
            . ' customer_client.manager, customer_client.descriptive_name,'
            . ' customer_client.currency_code, customer_client.time_zone,'
            . ' customer_client.id FROM customer_client WHERE customer_client.level <= 2';

        $response = $googleAdsServiceClient->searchStream(
            $customer,
            $query
        );

        return $response->iterateAllElements();
    }

    public function getAccountStatistics($googleAdsServiceClient, $customerId){
        $customer_query = 'SELECT segments.date, customer.id, customer.descriptive_name, metrics.clicks,
                        metrics.conversions, metrics.ctr, metrics.impressions FROM customer WHERE segments.date
                        BETWEEN "' . $this->callback_date_from .'" AND "' . $this->callback_date_to . '" ORDER BY customer.id';
        $customer_data = $googleAdsServiceClient->searchStream($customerId, $customer_query);

        return $customer_data;
    }

    public function getAccountCampaigns($googleAdsServiceClient, $customerId){
        $campaign_query = 'SELECT campaign.id, campaign.name, segments.device, segments.ad_network_type
                            FROM campaign WHERE segments.date BETWEEN "' . $this->callback_date_from .'" AND "' . $this->callback_date_to . '"';
        $customer_campaigns = $googleAdsServiceClient->searchStream($customerId, $campaign_query);
        return $customer_campaigns->iterateAllElements();
    }

    public function getAccountGroups($googleAdsServiceClient, $customerId){
        $group_query = 'SELECT campaign.resource_name, ad_group.id, ad_group.base_ad_group, segments.device,
                            segments.ad_network_type FROM ad_group WHERE segments.date BETWEEN "' . $this->callback_date_from .'" AND "' . $this->callback_date_to . '"';

        $customer_groups = $googleAdsServiceClient->search($customerId, $group_query, ['pageSize' => 500]);
        return $customer_groups->iterateAllElements();
    }

    public function getCampaignStatistics($googleAdsServiceClient, $customerId, $campaign, $googleAdsRow){
        $campaign_data_query = 'SELECT segments.date, segments.device, segments.ad_network_type, campaign.id, campaign.name, metrics.clicks, metrics.impressions,
                                metrics.ctr, metrics.conversions, metrics.cost_micros FROM campaign WHERE campaign.id = '. $googleAdsRow->getCampaign()->getId()
            . ' AND segments.device = "' . $campaign->device
            . '" AND segments.ad_network_type = "' . $campaign->network_type
            . '" AND segments.date BETWEEN "' .  $this->callback_date_from .'" AND "' . $this->callback_date_to . '"';

        $campaign_data = $googleAdsServiceClient->searchStream($customerId, $campaign_data_query);
        return $campaign_data->iterateAllElements();
    }

    public function getGroupStatistics($googleAdsServiceClient, $customerId, $ad_group, $googleAdsRow){
        $group_data_query = 'SELECT segments.date, campaign.id, campaign.resource_name, ad_group.id, ad_group.base_ad_group,
                                segments.device, segments.ad_network_type, metrics.clicks, metrics.impressions, metrics.ctr,
                                metrics.conversions, metrics.cost_micros FROM ad_group
                                WHERE ad_group.base_ad_group = "' . $ad_group->base_ad_group
            . '" AND campaign.resource_name = "' . $ad_group->campaign_resource_name
            . '" AND segments.device = "' . $ad_group->device
            . '" AND segments.ad_network_type = "' . $ad_group->network_type
            . '" AND segments.date BETWEEN "' . $this->callback_date_from .'" AND "' . $this->callback_date_to . '"';

        $group_data = $googleAdsServiceClient->search($customerId, $group_data_query, ['pageSize' => 500]);
        return $group_data->iterateAllElements();
    }

    public function saveGroupData($data, $google_ads_group_id) {
        $save_data = [];
        foreach ($data as $item){
            $save_data[] = [
                'clicks' => $item->getMetrics()->getClicks(),
                'conversions' => $item->getMetrics()->getConversions(),
                'cost' => $item->getMetrics()->getCostMicros(),
                'impressions' => $item->getMetrics()->getImpressions(),
                'ctr' => $item->getMetrics()->getCtr(),
                'date' => $item->getSegments()->getDate(),
                'google_ads_group_id' => $google_ads_group_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];
        }
        $this->save_data($save_data, 'google_ads_group_data');
    }

    public function createGoogleAdsGroup($data, $google_ads_account_id, $type){
        $saveData = [
            'provider_id'            => $data->getAdGroup()->getId(),
            'base_ad_group'          => $data->getAdGroup()->getBaseAdGroup(),
            'campaign_resource_name' => $data->getCampaign()->getResourceName(),
            'device'                 => Device::name($data->getSegments()->getDevice()),
            'network_type'           => AdNetworkType::name($data->getSegments()->getAdNetworkType()),
            'google_ads_account_id'  => $google_ads_account_id,
        ];

        if ($type == 'create'){
            $googleAdsCampaign = GoogleAdsGroup::create($saveData);
        }else{
            $googleAdsCampaign = GoogleAdsGroup::updateOrCreate(
                [
                    'provider_id' => $saveData['provider_id'],
                    'google_ads_account_id' =>  $saveData['google_ads_account_id'],
                    'base_ad_group'          =>  $saveData['base_ad_group'],
                    'campaign_resource_name' =>  $saveData['campaign_resource_name'],
                    'device'                 =>  $saveData['device'],
                    'network_type'           =>  $saveData['network_type'],
                ],
                $saveData
            );
        }

        return $googleAdsCampaign;
    }

    public function saveCampaignData($data, $google_ads_campaign_id) {
        $save_data = [];
        foreach ($data as $item){
            $save_data[] = [
                'clicks' => $item->getMetrics()->getClicks(),
                'conversions' => $item->getMetrics()->getConversions(),
                'ctr' => $item->getMetrics()->getCtr(),
                'cost' => $item->getMetrics()->getCostMicros(),
                'impressions' => $item->getMetrics()->getImpressions(),
                'date' => $item->getSegments()->getDate(),
                'google_ads_campaign_id' => $google_ads_campaign_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];
        }
        $this->save_data($save_data, 'google_ads_campaign_data');
    }

    public function createGoogleAdsCampaign($data, $google_ads_account_id, $type){
        $saveData = [
            'provider_id'           => $data->getCampaign()->getId(),
            'name'                  => $data->getCampaign()->getName(),
            'device'                => Device::name($data->getSegments()->getDevice()),
            'network_type'          => AdNetworkType::name($data->getSegments()->getAdNetworkType()),
            'google_ads_account_id' => $google_ads_account_id,
        ];

        if ($type == 'create'){
            $googleAdsCampaign = GoogleAdsCampaign::create($saveData);
        }else{
            $googleAdsCampaign = GoogleAdsCampaign::updateOrCreate(
                [
                    'provider_id' => $saveData['provider_id'],
                    'name'                  => $saveData['name'],
                    'device'                => $saveData['device'],
                    'network_type'          => $saveData['network_type'],
                    'google_ads_account_id' => $saveData['google_ads_account_id'],
                ],
                $saveData
            );
        }

        return $googleAdsCampaign;
    }

    public function saveGoogleAdsAccountData($data, $google_ads_account_id){
        $save_data = [];
        foreach ($data as $item){
            $save_data[] = [
                'clicks' => $item->getMetrics()->getClicks(),
                'conversions' => $item->getMetrics()->getConversions(),
                'ctr' => $item->getMetrics()->getCtr(),
                'impressions' => $item->getMetrics()->getImpressions(),
                'date' => $item->getSegments()->getDate(),
                'google_ads_account_id' => $google_ads_account_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];
        }
        $this->save_data($save_data, 'google_ads_account_data');
    }

    public function save_data($data, $table_name){
        DB::table($table_name)->insert($data);
    }

    public function createGoogleAdsAccount($data, $social_account_id, $type){
        $saveData = [
            'provider_id'       => $data->getId(),
            'name'              => $data->getDescriptiveName(),
            'is_manager'        => $data->getManager(),
            'currency_code'     => $data->getCurrencyCode(),
            'social_account_id' => $social_account_id,
        ];

        if ($type == 'create'){
            $googleAdsAccount = GoogleAdsAccount::create($saveData);
        }else{
            $googleAdsAccount = GoogleAdsAccount::updateOrCreate(
                ['provider_id' => $saveData['provider_id'], 'social_account_id' => $saveData['social_account_id']],
                $saveData
            );
        }

        return $googleAdsAccount;
    }

    public function delete() {
        $this->socialAccount->google_ads_account->each(function ($account){
            GoogleAdsAccountData::where('google_ads_account_id', $account->id)->delete();
            GoogleAdsCampaign::where('google_ads_account_id', $account->id)->each(function ($campaign){
                GoogleAdsCampaignData::where('google_ads_campaign_id', $campaign->id)->delete();
                $campaign->delete();
            });
            GoogleAdsGroup::where('google_ads_account_id', $account->id)->each(function ($group){
                GoogleAdsGroupData::where('google_ads_group_id', $group->id)->delete();
                $group->delete();
            });
            $account->delete();
        });
        $this->socialAccount->forceDelete();
    }
}
