<?php

namespace App\Classes;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class GoogleAnalytics4API
{
    private $access_token;
    private $id;
    private $admin_api_url = 'https://analyticsadmin.googleapis.com/v1alpha/';
    private $data_api_url = 'https://content-analyticsdata.googleapis.com/v1beta/';

    private $sinceDate = null;

    public function __construct($num_of_days = 3)
    {
        // $this->sinceDate = Carbon::now()->subDays(30)->format("Y-m-d");
        $this->sinceDate = Carbon::now()->subDays($num_of_days)->format("Y-m-d");
    }

    public function setSinceDate($date) {
        $this->sinceDate = $date;
    }

    public function getSinceDate() {
        return $this->sinceDate;
    }

    public function get_access_token()
    {
        return $this->access_token;
    }

    public function set_access_token($access_token)
    {
        $this->access_token = $access_token;
    }

    public function get_user_accounts()
    {
        $data =  $this->send_request_admin_api('GET', 'accounts');
        return $data->accounts ?? [];
    }

    public function get_account_properties($account_id)
    {
        $data =  $this->send_request_admin_api('GET', 'properties?filter=ancestor:accounts/' . $account_id);
        return $data?->properties;
    }
    public function get_property_card_data($property_id) {
        $body = [
            "dimensions" =>  [["name" => "date"]],
            "dateRanges" => [["startDate" =>  $this->getSinceDate(), "endDate" => "today"]],
            "metrics"=> [
                ["name"  => "conversions"],
                ["name" => "totalUsers"],
                ["name" => "averageSessionDuration"],
                ["name" => "bounceRate"],
                ["name" => "screenPageViewsPerSession"],
                ["name" => "sessions"],
                ["name" => "engagementRate"],
                ["name" => "userEngagementDuration"],
                ["name" => "sessionsPerUser"],
                ["name" => "activeUsers"],
            ]
            ];
        $parameter = 'properties/' . $property_id . ':runReport?alt=json';
        $data =  $this->send_request_data_api('POST', $parameter,  $body);
        return !empty($data->rows) ? $data->rows : [];
    }

    public function get_property_sessions_by_channel($property_id) {
        $body = [
            "dimensions" =>  [["name" => "date"], ['name' => 'sessionDefaultChannelGrouping']],
            "dateRanges" => [["startDate" =>  $this->getSinceDate(), "endDate" => "today"]],
            "metrics"=> [["name"  => "sessions"], ["name"  => "totalUsers"]]
        ];
        $parameter = 'properties/' . $property_id . ':runReport?alt=json';
        $data =  $this->send_request_data_api('POST', $parameter,  $body);
        return !empty($data->rows) ? $data->rows : [];
    }

    public function get_property_sessions_by_devices($property_id) {
        $body = [
            "dimensions" =>  [["name" => "date"], ['name' => 'mobileDeviceBranding']],
            "dateRanges" => [["startDate" =>  $this->getSinceDate(), "endDate" => "today"]],
            "metrics"=> [["name"  => "sessions"]]
        ];
        $parameter = 'properties/' . $property_id . ':runReport?alt=json';
        $data =  $this->send_request_data_api('POST', $parameter,  $body);
        return !empty($data->rows) ? $data->rows : [];
    }

    public function get_property_data_by_country($property_id) {
        $body = [
            "dimensions" =>  [["name" => "date"], ['name' => 'country']],
            "dateRanges" => [["startDate" =>  $this->getSinceDate(), "endDate" => "today"]],
            "metrics"=> [["name"  => "sessions"], ["name" => "conversions"]]
        ];
        $parameter = 'properties/' . $property_id . ':runReport?alt=json';
        $data =  $this->send_request_data_api('POST', $parameter,  $body);
        return !empty($data->rows) ? $data->rows : [];
    }

    public function get_property_returning_vs_new_users_by_country($property_id) {
        $body = [
            "dimensions" =>  [["name" => "date"], ['name' => 'country'], ['name' => 'newVsReturning']],
            "dateRanges" => [["startDate" =>  $this->getSinceDate(), "endDate" => "today"]],
            "metrics"=> [["name"  => "sessions"]]
        ];
        $parameter = 'properties/' . $property_id . ':runReport?alt=json';
        $data =  $this->send_request_data_api('POST', $parameter,  $body);
        return !empty($data->rows) ? $data->rows : [];
    }

    public function get_property_page_views_by_page_path($property_id) {
        $body = [
            "dimensions" =>  [["name" => "date"], ['name' => 'pagePath']],
            "dateRanges" => [["startDate" =>  $this->getSinceDate(), "endDate" => "today"]],
            "metrics"=> [["name"  => "screenPageViews"]]
        ];
        $parameter = 'properties/' . $property_id . ':runReport?alt=json';
        $data =  $this->send_request_data_api('POST', $parameter,  $body);
        return !empty($data->rows) ? $data->rows : [];
    }

    public function get_property_page_views_by_page_title($property_id) {
        $body = [
            "dimensions" =>  [["name" => "date"], ['name' => 'pageTitle']],
            "dateRanges" => [["startDate" =>  $this->getSinceDate(), "endDate" => "today"]],
            "metrics"=> [["name"  => "screenPageViews"], ["name"  => "sessions"]]
        ];
        $parameter = 'properties/' . $property_id . ':runReport?alt=json';
        $data =  $this->send_request_data_api('POST', $parameter,  $body);
        return !empty($data->rows) ? $data->rows : [];
    }

    public function get_property_data_by_keyword($property_id) {
        $body = [
            "dimensions" =>  [["name" => "date"], ['name' => 'googleAdsKeyword']],
            "dateRanges" => [["startDate" =>  $this->getSinceDate(), "endDate" => "today"]],
            "metrics"=> [["name"  => "sessions"], ["name"  => "screenPageViews"]]
        ];
        $parameter = 'properties/' . $property_id . ':runReport?alt=json';
        $data =  $this->send_request_data_api('POST', $parameter,  $body);
        return !empty($data->rows) ? $data->rows : [];
    }

    public function get_property_returning_vs_new_users_per_day($property_id) {
        $body = [
            "dimensions" =>  [["name" => "date"], ['name' => 'newVsReturning']],
            "dateRanges" => [["startDate" =>  $this->getSinceDate(), "endDate" => "today"]],
            "metrics"=> [["name"  => "sessions"]]
        ];
        $parameter = 'properties/' . $property_id . ':runReport?alt=json';
        $data =  $this->send_request_data_api('POST', $parameter,  $body);
        return !empty($data->rows) ? $data->rows : [];
    }

    public function get_property_data_by_source($property_id) {
        $body = [
            "dimensions" =>  [["name" => "date"], ['name' => 'sessionSource']],
            "dateRanges" => [["startDate" =>  $this->getSinceDate(), "endDate" => "today"]],
            "metrics"=> [["name"  => "sessions"], ["name"  => "totalUsers"], ["name"  => "newUsers"], ["name" => "conversions"]
            ]
        ];
        $parameter = 'properties/' . $property_id . ':runReport?alt=json';
        $data =  $this->send_request_data_api('POST', $parameter,  $body);
        return !empty($data->rows) ? $data->rows : [];
    }

    public function send_request_admin_api($method, $parameters)
    {
        try {
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->get_access_token(),
                ]
            ]);
            $response = $client->request($method, $this->admin_api_url . $parameters);
            return json_decode($response->getBody()->getContents());
        }catch (RequestException $e){
            return null;
        }
    }

    public function send_request_data_api($method, $parameters, $body = [])
    {
        try {
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->get_access_token(),
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($body)
            ]);
            $response = $client->request($method, $this->data_api_url . $parameters);
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            Log::warning("Google Analytics Client Error:" . $e->getMessage() . " token = " . $this->get_access_token());
            return null;
        }
    }

}
