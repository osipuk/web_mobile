<?php

namespace App\Classes;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ClientErrorResponseException;

class FacebookAPI
{
    private $access_token;
    private $id;
    private $api_url = 'https://graph.facebook.com/';
    private $page_data_metrics = 'page_impressions_unique,page_impressions,page_impressions_paid_unique,page_impressions_organic_unique,page_impressions_viral_unique,page_impressions_nonviral_unique,page_impressions_paid,page_impressions_organic, page_posts_impressions_unique,page_posts_impressions_paid_unique,page_posts_impressions_organic_unique,page_posts_impressions_viral_unique,page_posts_impressions_nonviral_unique,post_impressions_fan_unique,page_post_engagements,page_cta_clicks_logged_in_by_city_unique,page_call_phone_clicks_logged_in_by_city_unique,page_get_directions_clicks_logged_in_by_city_unique,page_website_clicks_logged_in_by_city_unique,page_engaged_users,page_fans,page_fans_online';
    private $sinceDate;
    private $untilDate;
    private bool $writeLogs = false;

    public function __construct($num_of_days = 90)
    {

        //$num_of_days = 15;
        $this->sinceDate = Carbon::now()->subDays($num_of_days);
        $this->untilDate = Carbon::now();
    }

    public function setWriteLogs(bool $value) : void
    {
        $this->writeLogs = $value;
    }

    public function getSinceDate()
    {
        return $this->sinceDate;
    }

    public function getUntilDate()
    {
        return $this->untilDate;
    }

    public function setSinceDate($sinceDate)
    {
        $this->sinceDate = $sinceDate;
    }

    public function setUntilDate($untilDate)
    {
        $this->untilDate = $untilDate;
    }

    public function get_access_token()
    {
        return $this->access_token;
    }

    public function set_access_token($access_token)
    {
        $this->access_token = $access_token;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }
    public function get_long_lived_token($token)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . 'oauth/access_token?grant_type=fb_exchange_token&client_id=' . env('FACEBOOK_APP_ID') .'&client_secret=' . env('FACEBOOK_APP_SECRET') . '&fb_exchange_token=' . $token);
        $data = json_decode($response->getBody()->getContents());
        //$this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_user_data($id , $token)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . $id . '?fields=email,name,picture&access_token=' . $token);
        $data = json_decode($response->getBody()->getContents());
        //$this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_user_page($id , $token)
    {
        try {

            
        $client = new Client();
        $response = $client->request('GET', $this->api_url . $id . '/accounts?access_token=' . $token);

        $data = json_decode($response->getBody()->getContents());

        return $data;

        } catch (RequestException $exception) {
            
          //  print_r($exception->getMessage());
            return false;
        }

    }

    public function get_page_post()
    {
        $data = $this->send_request('posts?fields=created_time,message,shares,full_picture,insights.metric(post_impressions,post_engaged_users,post_clicks),Shares.summary(true)%2Clikes.summary(true)%2Ccomments.summary(true)&limit=20');
        //$this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_page_like_unlike_per_day()
    {
        $data = $this->send_request('insights?metric=page_positive_feedback_by_type_unique,page_negative_feedback_by_type_unique,page_fan_adds_by_paid_non_paid_unique&period=day' . '&since=' . $this->sinceDate . '&until=' . $this->untilDate);
        //$this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_page_data()
    {
        $data = $this->send_request('insights?metric=' . $this->page_data_metrics . '&period=day' . '&since=' . $this->sinceDate . '&until=' . $this->untilDate);
        //$this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_cta_data()
    {
        $data = $this->send_request('insights?metric=page_impressions_by_city_unique&period=day' . '&since=' . $this->sinceDate . '&until=' . $this->untilDate);
        //$this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function send_request($parameters)
    {
        try {
            $client = new Client();
            $response = $client->request('GET', $this->api_url . $this->get_id() . '/' . $parameters . '&access_token=' . $this->get_access_token());
            return json_decode($response->getBody()->getContents());
        }catch (RequestException $e){
            return null;
        }
    }

    private function log($fileName, $text) : void
    {
        if ($this->writeLogs) {
            $dir = storage_path() . '/logs/facebook_api/' . date("Y-m-d");
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = $dir . "/" . date("Y_m_d_H_i_s") . "_" . $fileName;
            file_put_contents($path, $text . PHP_EOL . PHP_EOL, FILE_APPEND);
        }
    }
}
