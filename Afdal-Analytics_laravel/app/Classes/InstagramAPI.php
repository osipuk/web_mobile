<?php

namespace App\Classes;

use Carbon\Carbon;
use GuzzleHttp\Client;

class InstagramAPI
{
    private $access_token;
    private $id;
    private $api_url = 'https://graph.facebook.com/v12.0/';
    private $sinceDate;
    private $untilDate;
    private bool $writeLogs = false;

    public function __construct($num_of_days = 30)
    {
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

    public function get_long_lived_token($token)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . 'oauth/access_token?grant_type=fb_exchange_token&client_id=' . env('FACEBOOK_APP_ID') .'&client_secret=' . env('FACEBOOK_APP_SECRET') . '&fb_exchange_token=' . $token);

        return json_decode($response->getBody()->getContents());
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

    public function get_user_data($id , $token)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . $id . '?fields=email,name,picture&access_token=' . $token);
        $data = json_decode($response->getBody()->getContents());
        $this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_user_page($id , $token)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . $id . '/accounts?access_token=' . $token);
        $data = json_decode($response->getBody()->getContents());
        $this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_page_instagram($page_id)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . $page_id . '?fields=instagram_business_account&access_token=' . $this->get_access_token());
        $data = json_decode($response->getBody()->getContents());
        $this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_instagram_account($instagram_id)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . $instagram_id . '?fields=id,name,profile_picture_url,followers_count&access_token=' . $this->get_access_token());
        $data = json_decode($response->getBody()->getContents());
        $this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_instagram_insights($instagram_id, $token)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . $instagram_id . '/insights?metric=impressions,reach,profile_views,follower_count&period=day&since=' . $this->sinceDate . '&until=' . $this->untilDate . '&access_token=' . $token);
        $data = json_decode($response->getBody()->getContents());
        $this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_instagram_follower_insights($instagram_id, $token)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . $instagram_id . '/insights?metric=audience_country,audience_gender_age&period=lifetime' . '&access_token=' . $token);
        $data = json_decode($response->getBody()->getContents());
        $this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_instagram_posts()
    {
        $data = $this->send_request('media?fields=like_count,comments_count,media_url,media_type,caption,timestamp,shortcode,children.fields(media_type,media_url)');
        $this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function get_instagram_post_insights($post_id)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . $post_id . '/insights?metric=engagement,reach&access_token=' . $this->get_access_token());
        $data = json_decode($response->getBody()->getContents());
        $this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function send_request($parameters)
    {
        $client = new Client();
        $response = $client->request('GET', $this->api_url . $this->get_id() . '/' . $parameters . '&access_token=' . $this->get_access_token());
        return json_decode($response->getBody()->getContents());
    }

    private function log($fileName, $text) : void
    {
        if ($this->writeLogs) {
            $dir = storage_path() . '/logs/instagram_api/' . date("Y-m-d");
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = $dir . "/" . date("Y_m_d_H_i_s") . "_" . $fileName;
            file_put_contents($path, $text . PHP_EOL . PHP_EOL, FILE_APPEND);
        }
    }
}
