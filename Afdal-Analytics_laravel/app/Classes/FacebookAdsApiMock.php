<?php

namespace App\Classes;

use Carbon\Carbon;
use GuzzleHttp\Client;

class FacebookAdsApiMock extends FacebookAdsApi
{
    public function get_user_data($id)
    {
        return [];
    }

    public function get_ad_accounts($id)
    {
        return $this->__getData(__FUNCTION__);
    }

    public function get_ad_account_insight($act_id)
    {
        return $this->__getData(__FUNCTION__ . "_" . $act_id);
    }

    public function get_ad_account_insight_2($act_id)
    {
        return $this->__getData(__FUNCTION__ . "_" . $act_id);
    }

    public function get_ad_creatives($act_id)
    {
        return $this->__getData(__FUNCTION__ . "_" . $act_id);
    }

    public function get_creative_data($creative_id)
    {
        return $this->__getData(__FUNCTION__ . "_" . $creative_id);
    }

    public function get_page_token($page_id)
    {
        return json_decode(json_encode(['access_token' => 'asdadasfaddf']));
    }

    public function get_post_data($post_id , $page_token)
    {
        return $this->__getData(__FUNCTION__ . "_" . $post_id);
    }

    private function __getData($fileName) {
        $data = file_get_contents(resource_path('test/services/facebook_ads/'.$fileName.'.json'));
        return json_decode($data);
    }

}
