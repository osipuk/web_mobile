<?php

namespace App\Classes;

use Carbon\Carbon;
use GuzzleHttp\Client;

class InstagramAPIMock extends InstagramAPI
{
    public function get_user_data($id , $token)
    {
        return [];
    }

    public function get_user_page($id , $token)
    {
        return [];
    }

    public function get_page_instagram($page_id)
    {
        return [];
    }

    public function get_instagram_account($instagram_id)
    {
        return $this->__getData(__FUNCTION__);
    }

    public function get_instagram_insights($instagram_id, $token)
    {
        return $this->__getData(__FUNCTION__);
    }

    public function get_instagram_follower_insights($instagram_id, $token)
    {
        return $this->__getData(__FUNCTION__);
    }

    public function get_instagram_posts()
    {
        return $this->__getData(__FUNCTION__);
    }

    public function get_instagram_post_insights($post_id)
    {
        return $this->__getData(__FUNCTION__);
    }

    private function __getData($fileName) {
        $data = file_get_contents(resource_path('test/services/instagram/'.$fileName.'.json'));
        return json_decode($data);
    }
}
