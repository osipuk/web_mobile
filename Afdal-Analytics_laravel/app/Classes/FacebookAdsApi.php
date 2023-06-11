<?php

namespace App\Classes;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class FacebookAdsApi
{
    private $access_token;
    private $id;
    private $api_url = 'https://graph.facebook.com/v15.0/';
    private $timeRange = [];

    public function __construct($num_of_days = 92)
    {
        $sinceDate = Carbon::now()->subDays($num_of_days)->format('Y-m-d');
        $untilDate = Carbon::now()->format('Y-m-d');
        $this->setTimeRange($sinceDate, $untilDate);
    }

    public function setTimeRange($sinceDate = null, $untilDate = null)
    {
        if (is_null($sinceDate)) {
            $sinceDate = Carbon::now()->subDays($num_of_days)->format('Y-m-d');
        }
        if (is_null($untilDate)) {
            $untilDate = Carbon::now()->format('Y-m-d');
        }
        $this->timeRange = ["since" => $sinceDate, "until" => $untilDate];
    }

    public function getTimeRange() : array
    {
        return $this->timeRange;
    }

    public function get_access_token()
    {
        return $this->access_token;
    }

    public function set_access_token($access_token)
    {
        $this->access_token = $access_token;
    }

    public function get_long_lived_token($token)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . 'oauth/access_token'
            .'?grant_type=fb_exchange_token'
            .'&client_id=' . env('FACEBOOK_APP_ID')
            .'&client_secret=' . env('FACEBOOK_APP_SECRET')
            . '&fb_exchange_token=' . $token
        );
        return json_decode($response->getBody()->getContents());
    }

    public function get_user_data($id)
    {
        return $this->send_request($id, '?fields=email,name,picture&');
    }

    public function get_ad_accounts($id)
    {
        return $this->send_request($id, 'adaccounts?fields=name,account_id&');
    }
    //cpp,cpm,spend,reach,converted_product_value

    public function get_ad_account_insight($act_id)
    {
        return $this->send_request($act_id, 'insights?level=campaign'
            .'&fields=impressions,ctr,clicks,cpc,inline_link_clicks,account_currency,campaign_id,campaign_name'
            .'&time_increment=1'
            . $this->timeRangeParameterOrEmptyString()
            .'&'
        );
    }

    public function get_ad_account_insight_2($act_id)
    {
        return $this->send_request($act_id, 'insights?level=campaign'
            .'&fields=campaign_id,cpp,cpm,spend,reach,converted_product_value'
            .'&time_increment=1'
            .$this->timeRangeParameterOrEmptyString()
            .'&'
        );
    }

    public function get_ad_creatives($act_id)
    {
        return $this->send_request($act_id, 'adcreatives?');
    }

    public function get_creative_data($creative_id)
    {
        return $this->send_request($creative_id, '?fields=effective_object_story_id,object_story_id,name,object_type,status,actor_id,title&');
    }

    public function get_page_token($page_id)
    {
        return $this->send_request($page_id, '?fields=access_token&');
    }

    public function get_post_data($post_id , $page_token)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url
            . $post_id
            . '?fields=created_time,message,full_picture,insights.metric(post_engaged_users,post_clicks),comments.summary(true),likes.summary(true)'
            . '&period=day'
            . '&access_token=' . $page_token
            . $this->timeRangeParameterOrEmptyString()
        );
        return json_decode($response->getBody()->getContents());
    }

    public function send_request($id, $parameters)
    {
        $client = new Client();
        $url = $this->api_url . $id . '/' . $parameters . 'access_token=' . $this->get_access_token();
        $response = $client->request('GET', $url);
        $data = $response->getBody()->getContents();
        Log::info("Facebook Ads Request Url: " . $url);
        Log::info("Facebook Ads Response: " . $data);
        return json_decode($data);
    }

    private function timeRangeParameterOrEmptyString() : string
    {
        return !empty($this->timeRange) ? "&time_range=".json_encode($this->timeRange) : "";
    }
}
