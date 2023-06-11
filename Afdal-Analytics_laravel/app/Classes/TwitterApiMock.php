<?php

namespace App\Classes;

use App\Classes\TwitterApi;
use Laravel\Socialite\Facades\Socialite;

class TwitterApiMock extends TwitterApi
{
    public function __construct()
    {
        // constructor without parent parameters
    }

    public function getUser()
    {
        return $this->__getData(__FUNCTION__);
    }

    public function getUserMetrics($twitterUserId)
    {
        return $this->__getData(__FUNCTION__);
    }

    public function getTweets($twitterUserId, $startTime, $endTime)
    {
        return $this->__getData(__FUNCTION__);
    }

    public function getTweetData($tweetId)
    {
        return $this->__getData(__FUNCTION__ . "_" . $tweetId);
    }

    private function __getData($fileName) {
        $path = resource_path('test/services/twitter/'.$fileName.'.json');
        if (file_exists($path)) {
            $data = file_get_contents($path);
            return json_decode($data);
        }
        return [];
    }
}
