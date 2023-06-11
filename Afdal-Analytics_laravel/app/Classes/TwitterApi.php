<?php

namespace App\Classes;

use Abraham\TwitterOAuth\TwitterOAuth;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;

class TwitterApi
{
    private $client;
    private $token;
    private $refreshToken;
    private bool $writeLogs = false;

    public function __construct($token, $refreshToken)
    {
        $this->token = $token;
        $this->refreshToken = $refreshToken;
        $this->client = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET_KEY'),
            $token,
            $refreshToken);
        $this->client->setApiVersion('2');
    }

    public function setWriteLogs(bool $value) : void
    {
        $this->writeLogs = $value;
    }

    public function getUser()
    {
        $data = Socialite::driver('twitter')->userFromTokenAndSecret($this->token, $this->refreshToken);
        //$this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function getUserMetrics($twitterUserId)
    {
        $data = $this->client->get('users/' . $twitterUserId, ["user.fields" => 'public_metrics']);
        //$this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function getTweets($twitterUserId, $startTime, $endTime)
    {
        $data = $this->client->get(
            'users/' . $twitterUserId . '/tweets',
            [
                'start_time' => $startTime,
                'end_time'=> $endTime
            ]
        );
        //$this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    public function getTweetData($tweetId)
    {
        $data = $this->client->get('tweets/' . $tweetId,  ["tweet.fields" => "public_metrics,organic_metrics,created_at"]);
        //$this->log(__FUNCTION__ . ".log", var_export($data, 1));
        return $data;
    }

    private function log($fileName, $text) : void
    {
        if ($this->writeLogs) {
            $dir = storage_path() . '/logs/twitter_api/' . date("Y-m-d");
            if (!file_exists($dir)) {
               // mkdir($dir, 0777, true);
            }
            //$path = $dir . "/" . date("Y_m_d_H_i_s") . "_" . $fileName;
            //file_put_contents($path, $text . PHP_EOL . PHP_EOL, FILE_APPEND);
        }
    }

}
