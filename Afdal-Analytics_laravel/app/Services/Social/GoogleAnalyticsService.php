<?php

namespace App\Services\Social;

use App\Classes\GoogleAnalytics4API;
use App\Models\Dashboard;
use App\Models\GoogleAnalyticsAccount;
use App\Models\GoogleAnalyticsProperty;
use App\Models\GoogleAnalyticsPropertyData;
use App\Models\SocialAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Http; 

class GoogleAnalyticsService extends BasicService implements SocialService
{
    const PROVIDER_NAME = "googleAnalytics";

    public function __construct(SocialAccount $socialAccount)
    {
        $this->api = new GoogleAnalytics4API();
        $this->socialAccount = $socialAccount;

        $socialAccountToken = $this->socialAccount->token;

            $response = Http::get('https://www.googleapis.com/oauth2/v1/tokeninfo?access_token='.$this->socialAccount->token);


            $data = (json_decode($response->body()));
            if(isset($data->error) && $data->error == 'invalid_token'){
    
                $response2 = Http::post('https://oauth2.googleapis.com/token', [
                    'client_id' => env('GOOGLE_ANALYTICS_CLIENT_ID'),
                    'client_secret' => env('GOOGLE_ANALYTICS_CLIENT_SECRET'),
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $this->socialAccount->refresh_token,
                ]);

                $getNewAccessToken = json_decode($response2->body());

                if(isset($getNewAccessToken->expires_in) && $getNewAccessToken->expires_in > 1000 ) {                   

                    $socialAccountToken = $getNewAccessToken->access_token;
                    $this->socialAccount->token = $socialAccountToken;
                    $this->socialAccount->save();
                }
            }


        $this->api->set_access_token($socialAccountToken);
    }

    /**
     * Update Google Analytics dimensions and metrics data
     * @return false|void
     */
    public function updateUserData($set_date=null)
    {
        $this->log("Start update");
        if($set_date){
            $this->api->setSinceDate(Carbon::parse($set_date)->format("Y-m-d"));
        }else{
            if (!$this->checkSinceDate($this->socialAccount->last_imported_at)) {
                return false;
            }
    
            if (!empty($this->socialAccount->last_imported_at)) {
                $this->api->setSinceDate(Carbon::parse($this->socialAccount->last_imported_at)->format("Y-m-d"));
            }
        }
        

        GoogleAnalyticsAccount::where('social_account_id', $this->socialAccount->id)->get()->each(function($account) {
            GoogleAnalyticsProperty::where('google_analytics_account_id', $account->id)->get()->each(function($property) {
                $this->getAndSavePropertyData($property, "update");
            });
        });

        $this->socialAccount->last_imported_at = Carbon::now();
        $this->socialAccount->save();
        $this->log("Finish update");
    }

    public function callback() {

    }

    public function getAndSavePropertyData($property, $type = "update")
    {
        $timeStart = microtime(true);
        $this->log("Start $type property " . json_encode($property));
        $googleAnalytics4API = $this->api;
        $property_card_data =  $googleAnalytics4API->get_property_card_data($property->provider_id);

        $this->save_property_card_data($property_card_data, $property->id, $type);

        $session_by_channel_data =  $googleAnalytics4API->get_property_sessions_by_channel($property->provider_id);
        $this->save_property_sessions_by_channel($session_by_channel_data, $property->id, $type);

        $session_by_device_data =  $googleAnalytics4API->get_property_sessions_by_devices($property->provider_id);
        $this->save_property_sessions_by_device($session_by_device_data, $property->id, $type);

        $property_data_by_country =  $googleAnalytics4API->get_property_data_by_country($property->provider_id);
        $this->save_property_data_by_country($property_data_by_country, $property->id, $type);

        $returning_vs_new_users_by_country_data =  $googleAnalytics4API->get_property_returning_vs_new_users_by_country($property->provider_id);
        $this->save_property_returning_vs_new_users_by_country($returning_vs_new_users_by_country_data, $property->id, $type);

        $page_views_by_page_path_data =  $googleAnalytics4API->get_property_page_views_by_page_path($property->provider_id);
        $this->save_property_page_views_by_page_path($page_views_by_page_path_data, $property->id, $type);

        $page_views_by_page_title_data =  $googleAnalytics4API->get_property_page_views_by_page_title($property->provider_id);
        $this->save_property_page_views_by_page_title($page_views_by_page_title_data, $property->id, $type);

        $property_data_by_keyword =  $googleAnalytics4API->get_property_data_by_keyword($property->provider_id);
        $this->save_property_data_by_keyword($property_data_by_keyword, $property->id, $type);

        $property_returning_vs_new_users_per_day_data =  $googleAnalytics4API->get_property_returning_vs_new_users_per_day($property->provider_id);
        $this->save_property_returning_vs_new_users_per_day($property_returning_vs_new_users_per_day_data, $property->id, $type);

        $property_data_by_source =  $googleAnalytics4API->get_property_data_by_source($property->provider_id);
        $this->save_property_data_by_source($property_data_by_source, $property->id, $type);

        $timeEnd = microtime(true);
        $executionTime = $timeEnd - $timeStart;
        $this->log("End $type property " . json_encode($property) . " Execution Time: " . $executionTime . " sec.");
    }

    private function save_property_card_data($data, $property_id, $type)
    {
        $table = "google_analytics_property_data";
        $insertData = [];
        foreach ($data as $item) {
            $saveData = [
                'property_id' => $property_id,
                'conversions' => $item->metricValues[0]->value ?: 0,
                'total_users' => $item->metricValues[1]->value ?: 0,
                'average_session_duration' => $item->metricValues[2]->value ?: 0,
                'bounce_rate' => $item->metricValues[3]->value ?: 0,
                'screen_page_views_per_session' => $item->metricValues[4]->value ?: 0,
                'sessions' => $item->metricValues[5]->value ?: 0,
                'engagement_rate' => $item->metricValues[6]->value ?: 0,
                'user_engagement_duration' => $item->metricValues[7]->value ?: 0,
                'sessions_per_user' => $item->metricValues[8]->value ?? 0,
                'active_users' => $item->metricValues[9]->value ?? 0,
                'date' => $item->dimensionValues[0]->value ? date("Y-m-d", strtotime($item->dimensionValues[0]->value)) : null,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];

            if ($type == "create") {
                $insertData[] = $saveData;
            } else {
                DB::table($table)->updateOrInsert(
                    ['property_id' => $property_id, 'date' => $saveData['date']],
                    $saveData
                );
            }
        }
        if (!empty($insertData)) {
            DB::table($table)->insert($insertData);
        }
    }

    private function save_property_sessions_by_channel($data, $property_id, $type)
    {
        $table = 'ga_property_sessions_by_channel';
        $insertData = [];
        foreach ($data as $item) {
            $saveData = [
                'channel' => $item->dimensionValues[1]->value ?: null,
                'sessions' => $item->metricValues[0]->value ?: null,
                'total_users' => $item->metricValues[1]->value ?: null,
                'date' => $item->dimensionValues[0]->value ?  date("Y-m-d", strtotime($item->dimensionValues[0]->value)) : null,
                'property_id' => $property_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];

            if ($type == "create") {
                $insertData[] = $saveData;
            } else {
                DB::table($table)->updateOrInsert(
                    ['property_id' => $property_id, 'channel' => $saveData['channel'], 'date' => $saveData['date']],
                    $saveData
                );
            }
        }
        if (!empty($insertData)) {
            DB::table($table)->insert($insertData);
        }
    }

    private function save_property_sessions_by_device($data, $property_id, $type)
    {
        $table = "ga_property_sessions_by_device";
        $insertData = [];
        foreach ($data as $item) {
            $saveData = [
                'device' => $item->dimensionValues[1]->value ?: null,
                'value' => $item->metricValues[0]->value ?: null,
                'date' => $item->dimensionValues[0]->value ?  date("Y-m-d", strtotime($item->dimensionValues[0]->value)) : null,
                'property_id' => $property_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];

            if ($type == "create") {
                $insertData[] = $saveData;
            } else {
                DB::table($table)->updateOrInsert(
                    ['property_id' => $property_id, 'device' => $saveData['device'], 'date' => $saveData['date']],
                    $saveData
                );
            }
        }
        if (!empty($insertData)) {
            DB::table($table)->insert($insertData);
        }
    }

    private function save_property_data_by_country($data, $property_id, $type)
    {
        $table = "ga_property_data_by_country";
        $insertData = [];
        foreach ($data as $item) {
            $saveData = [
                'country' => $item->dimensionValues[1]->value ?: null,
                'sessions' => $item->metricValues[0]->value ?: null,
                'conversions' => $item->metricValues[0]->value ?: null,
                'date' => $item->dimensionValues[0]->value ?  date("Y-m-d", strtotime($item->dimensionValues[0]->value)) : null,
                'property_id' => $property_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];

            if ($type == "create") {
                $insertData[] = $saveData;
            } else {
                DB::table($table)->updateOrInsert(
                    ['property_id' => $property_id, 'country' => $saveData['country'], 'date' => $saveData['date']],
                    $saveData
                );
            }
        }
        if (!empty($insertData)) {
            DB::table($table)->insert($insertData);
        }
    }

    private function save_property_returning_vs_new_users_by_country($data, $property_id, $type)
    {
        $table = 'ga_property_returning_vs_new_user_by_country';
        $insertData = [];
        foreach ($data as $item) {
            $saveData = [
                'country' => $item->dimensionValues[1]->value ?: null,
                'type' => $item->dimensionValues[2]->value ?: null,
                'number' => $item->metricValues[0]->value ?: null,
                'date' => $item->dimensionValues[0]->value ?  date("Y-m-d", strtotime($item->dimensionValues[0]->value)) : null,
                'property_id' => $property_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];

            if ($type == "create") {
                $insertData[] = $saveData;
            } else {
                DB::table($table)
                    ->updateOrInsert(
                        [
                            'property_id' => $property_id,
                            'type' => $saveData['type'],
                            'country' => $saveData['country'],
                            'date' => $saveData['date']
                        ],
                        $saveData
                    );
            }
        }
        if (!empty($insertData)) {
            DB::table($table)->insert($insertData);
        }
    }

    private function save_property_page_views_by_page_path($data, $property_id, $type)
    {
        $table = "ga_property_page_views_by_page_path";
        $insertData = [];
        foreach ($data as $item) {
            $saveData = [
                'page_path' => $item->dimensionValues[1]->value ?: null,
                'views' => $item->metricValues[0]->value ?: null,
                'date' => $item->dimensionValues[0]->value ?  date("Y-m-d", strtotime($item->dimensionValues[0]->value)) : null,
                'property_id' => $property_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];

            if ($type == "create") {
                $insertData[] = $saveData;
            } else {
                DB::table($table)
                    ->updateOrInsert(
                        ['property_id' => $property_id, 'page_path' => $saveData['page_path'], 'date' => $saveData['date']],
                        $saveData
                    );
            }
        }
        if (!empty($insertData)) {
            DB::table($table)->insert($insertData);
        }
    }

    private function save_property_page_views_by_page_title($data, $property_id, $type)
    {
        $table = 'ga_property_page_views_by_page_title';
        $insertData = [];
        foreach ($data as $item) {
            $saveData = [
                'page_title' => $item->dimensionValues[1]->value ?: null,
                'views' => $item->metricValues[0]->value ?: null,
                'sessions' => $item->metricValues[1]->value ?: null,
                'date' => $item->dimensionValues[0]->value ?  date("Y-m-d", strtotime($item->dimensionValues[0]->value)) : null,
                'property_id' => $property_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];

            if ($type == "create") {
                $insertData[] = $saveData;
            } else {
                DB::table($table)->updateOrInsert(
                    ['property_id' => $property_id, 'page_title' => $saveData['page_title'], 'date' => $saveData['date']],
                    $saveData
                );
            }
        }
        if (!empty($insertData)) {
            DB::table($table)->insert($insertData);
        }
    }

    private function save_property_data_by_keyword($data, $property_id, $type)
    {
        $table = 'ga_property_data_by_keyword';
        $insertData = [];
        foreach ($data as $item) {
            $saveData = [
                'keyword' => $item->dimensionValues[1]->value ?: null,
                'sessions' => $item->metricValues[0]->value ?: null,
                'page_views' => $item->metricValues[1]->value ?: 0,
                'date' => $item->dimensionValues[0]->value ?  date("Y-m-d", strtotime($item->dimensionValues[0]->value)) : null,
                'property_id' => $property_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];

            if ($type == "create") {
                $insertData[] = $saveData;
            } else {
                DB::table($table)->updateOrInsert(
                    ['property_id' => $property_id, 'keyword' => $saveData['keyword'], 'date' => $saveData['date']],
                    $saveData
                );
            }
        }
        if (!empty($insertData)) {
            DB::table($table)->insert($insertData);
        }
    }

    private function save_property_returning_vs_new_users_per_day($data, $property_id, $type)
    {
        $table = 'ga_property_returning_vs_new_user_per_day';
        $insertData = [];
        foreach ($data as $item) {
            $saveData = [
                'type' => $item->dimensionValues[1]->value ?: null,
                'number' => $item->metricValues[0]->value ?: null,
                'date' => $item->dimensionValues[0]->value ?  date("Y-m-d", strtotime($item->dimensionValues[0]->value)) : null,
                'property_id' => $property_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];

            if ($type == "create") {
                $insertData[] = $saveData;
            } else {
                DB::table($table)->updateOrInsert(
                    ['property_id' => $property_id, 'type' => $saveData['type'], 'date' => $saveData['date']],
                    $saveData
                );
            }
        }
        if (!empty($insertData)) {
            DB::table($table)->insert($insertData);
        }
    }

    private function save_property_data_by_source($data, $property_id, $type)
    {
        $table = 'ga_property_data_by_source';
        $insertData = [];
        foreach ($data as $item) {
            $saveData = [
                'source' => $item->dimensionValues[1]->value ?: null,
                'sessions' => $item->metricValues[0]->value ?: null,
                'users' => $item->metricValues[1]->value ?: null,
                'new_users' => $item->metricValues[2]->value ?: null,
                'conversions' => $item->metricValues[3]->value ?: 0,
                'date' => $item->dimensionValues[0]->value ?  date("Y-m-d", strtotime($item->dimensionValues[0]->value)) : null,
                'property_id' => $property_id,
                'created_at' => now()->toDateTimeLocalString(),
                'updated_at' => now()->toDateTimeLocalString(),
            ];

            if ($type == "create") {
                $insertData[] = $saveData;
            } else {
                DB::table($table)->updateOrInsert(
                    ['property_id' => $property_id, 'source' => $saveData['source'], 'date' => $saveData['date']],
                    $saveData
                );
            }
        }
        if (!empty($insertData)) {
            DB::table($table)->insert($insertData);
        }
    }

    public function deleteAllWithExcludedProperties(array $excludedProperties = [])
    {
        $googleAccounts = $this->socialAccount->google_analytics_account;
        $countGoogleAccounts = count($googleAccounts);

        foreach ($googleAccounts as $account) {

            $properties = $account->properties;
            $countProperties = count($properties);

            $dashboardDeleted = false;
            foreach ($properties as $property) {
                if (!in_array($property->id, $excludedProperties)) {
                    $property->delete();
                    $countProperties--;

                    if (!$dashboardDeleted) {
                        $this->deleteDashboard();
                        $dashboardDeleted = true;
                    }
                }
            }

            if ($countProperties == 0) {
                $account->delete();
                $countGoogleAccounts--;
            }
        }

        if ($countGoogleAccounts == 0) {
            $this->socialAccount->delete();
        }
    }

    public function deleteDashboard()
    {
        $dashboard = Dashboard::query()
            ->where('social_account_id', $this->socialAccount->id)
            ->where('name', 'google-analytics-overview')
            ->first();
        $dashboard?->delete();
    }

    public function delete() {
        $this->socialAccount->google_analytics_account->each(function ($account){
            GoogleAnalyticsProperty::where('google_analytics_account_id', $account->id)->each(function ($property){
                GoogleAnalyticsPropertyData::where('property_id', $property->id)->delete();
                DB::table('ga_property_sessions_by_channel')->where('property_id', $property->id)->delete();
                DB::table('ga_property_sessions_by_device')->where('property_id', $property->id)->delete();
                DB::table('ga_property_data_by_country')->where('property_id', $property->id)->delete();
                DB::table('ga_property_returning_vs_new_user_by_country')->where('property_id', $property->id)->delete();
                DB::table('ga_property_page_views_by_page_path')->where('property_id', $property->id)->delete();
                DB::table('ga_property_page_views_by_page_title')->where('property_id', $property->id)->delete();
                DB::table('ga_property_data_by_keyword')->where('property_id', $property->id)->delete();
                DB::table('ga_property_returning_vs_new_user_per_day')->where('property_id', $property->id)->delete();
                DB::table('ga_property_data_by_source')->where('property_id', $property->id)->delete();
                $property->delete();
            });
            $account->delete();
        });
        $this->socialAccount->forceDelete();
    }
}
