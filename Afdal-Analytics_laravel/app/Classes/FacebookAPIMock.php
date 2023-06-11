<?php

namespace App\Classes;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class FacebookAPIMock extends FacebookAPI
{
    public function get_long_lived_token($token)
    {
        return [];
    }

    public function get_user_data($id , $token)
    {
        return [];
    }

    public function get_user_page($id , $token)
    {
        return $this->__getData(__FUNCTION__);
    }

    public function get_page_post()
    {
        return $this->__getData(__FUNCTION__);
    }

    public function get_page_like_unlike_per_day()
    {
        return $this->__getData(__FUNCTION__);
    }

    public function get_page_data()
    {
        return $this->__getData(__FUNCTION__);
    }

    public function get_cta_data()
    {
        return $this->__getData(__FUNCTION__);
    }

    private function __getData($fileName) {
        $data = file_get_contents(resource_path('test/services/facebook/'.$fileName.'.json'));
        return json_decode($data);
    }

}
