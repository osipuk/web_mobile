<?php

namespace App\Services\Social;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Classes\TwitterApi;
use App\Models\SocialAccount;
use App\Models\SocialAccountData;
use App\Models\Tweet;
use App\Models\TweetData;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;

class TwitterService extends BasicService implements SocialService
{
    private $sinceDate;
    private $untilDate;

    public function __construct(SocialAccount $socialAccount)
    {
        $this->sinceDate = Carbon::now()->subDays(30);
        $this->untilDate = Carbon::now();
        $this->socialAccount = $socialAccount;
        $this->api = new TwitterApi($socialAccount->token, $socialAccount->refresh_token);
        $this->api->setWriteLogs(true);
    }

    public function updateUserData()
    {
        $this->log("Start update");
        $socialAccount = $this->socialAccount;
        if (!$this->checkSinceDate($socialAccount->last_imported_at)) {
            return false;
        }

        $twitterUser = $this->api->getUser();
        if (!isset($twitterUser)) {
            $this->log("Error. Unable connect twitter account");
            return false;
        }

        $this->updateSocialAccount($socialAccount, $twitterUser);
        $this->updateSocialAccountData($socialAccount->id, $twitterUser);
        $this->updateTweetData($socialAccount->id, $twitterUser->id);

        $socialAccount->last_imported_at = Carbon::now();
        $socialAccount->save();
        $this->log("Finish update");
    }

    public function callback() {

    }

    private function updateSocialAccount(SocialAccount $socialAccount, $twitterUser)
    {
        $this->log("Start update account info");
        $socialAccount->full_name = $twitterUser->name;
        $socialAccount->email = $twitterUser->email ?? '';
        $socialAccount->avatar = $twitterUser->avatar;
        $socialAccount->save();
        $this->log("Finish update account info");
    }

    private function updateSocialAccountData($socialAccountId, $twitterUser)
    {
        $this->log("Start update social account data");
        $userMetric = $this->api->getUserMetrics($twitterUser->id);
        $newSocialAccountData = SocialAccountData::updateOrCreate(
            [
                'social_account_id' => $socialAccountId,
                'date' => Carbon::now()->format('Y-m-d')
            ],
            [
                'social_account_id' => $socialAccountId,
                'followers' => $userMetric->data->public_metrics->followers_count ?? null,
                'total_tweets' => $userMetric->data->public_metrics->tweet_count ?? null,
                'date' => Carbon::now()->format('Y-m-d')
            ]
        );
        $this->calculateDifferenceSocialAccountData($socialAccountId, $newSocialAccountData);
        $this->log("Finish update social account data");
    }
    public function calculateDifferenceSocialAccountData($socialAccountId, $newSocialAccountData){
        $oldSocialAccountData = SocialAccountData::where('social_account_id', $socialAccountId)->where('date', Carbon::now()->subDay()->format('Y-m-d'))->first();
        if ($oldSocialAccountData){
            $oldSocialAccountData->new_followers = $newSocialAccountData->followers - $oldSocialAccountData->followers;
            $oldSocialAccountData->new_tweets = $newSocialAccountData->total_tweets - $oldSocialAccountData->total_tweets;
            $oldSocialAccountData->update();
        }
    }

    private function updateTweetData($socialAccountId, $twitterUserId)
    {
        $this->log("Start update tweets");
        $tweets = $this->api->getTweets(
            $twitterUserId,
            Carbon::parse($this->sinceDate)->format(\DateTime::RFC3339),
            Carbon::parse($this->untilDate)->format(\DateTime::RFC3339)
        );

        if (!empty($tweets->meta->result_count) && $tweets->meta->result_count > 0) {
            foreach ($tweets->data as $tweet){
                $tweetData = $this->api->getTweetData($tweet->id);

                if (!isset($tweetData->data->id)) {
                    continue;
                }

                $newTweet = Tweet::updateOrCreate(
                    [
                        'tweet_id' => $tweetData->data->id,
                        'social_account_id' => $socialAccountId
                    ],
                    [
                        'tweet_id' => $tweetData->data->id ?? null,
                        'text' => $tweetData->data->text ?? null,
                        'created' => !empty($tweetData->data->created_at) ? date("Y-m-d", strtotime($tweetData->data->created_at)) : null,
                        'social_account_id' => $socialAccountId,
                    ]
                );

                $newTweetData = TweetData::updateOrCreate(
                    [
                        'tweet_id' => $newTweet->id,
                        'date' => Carbon::now()->format('Y-m-d')
                    ],
                    [
                        'tweet_id' => $newTweet->id,
                        'reply_count' => $tweetData->data->organic_metrics->reply_count ?? 0,
                        'impression_count' => $tweetData->data->organic_metrics->impression_count ?? 0,
                        'user_profile_clicks' => $tweetData->data->organic_metrics->user_profile_clicks ?? 0,
                        'like_count' => $tweetData->data->organic_metrics->like_count ?? 0,
                        'retweet_count' => $tweetData->data->organic_metrics->retweet_count ?? 0,
                        'quote_count' => $tweetData->data->public_metrics->quote_count ?? 0,
                        'date' => Carbon::now()->format('Y-m-d')
                    ]
                );
                $this->calculateDifferenceTweetData($newTweet, $newTweetData);
            }
        }
        $this->log("Finish update tweets");
    }

    public function calculateDifferenceTweetData($newTweet, $newTweetData){
        $oldTweetData = TweetData::where('tweet_id', $newTweet->id)->where('date', Carbon::now()->subDay()->format('Y-m-d'))->first();
        if ($oldTweetData){
            $oldTweetData->new_reply_count = $newTweetData->reply_count -  $oldTweetData->reply_count;
            $oldTweetData->new_impression_count = $newTweetData->impression_count -  $oldTweetData->impression_count;
            $oldTweetData->new_user_profile_clicks = $newTweetData->user_profile_clicks -  $oldTweetData->user_profile_clicks;
            $oldTweetData->new_like_count = $newTweetData->like_count -  $oldTweetData->like_count;
            $oldTweetData->new_retweet_count = $newTweetData->retweet_count -  $oldTweetData->retweet_count;
            $oldTweetData->new_quote_count = $newTweetData->quote_count -  $oldTweetData->quote_count;
            $oldTweetData->update();
        }
    }

    public function delete()
    {
        $this->socialAccount->tweet->each(function ($tweet){
            TweetData::where('tweet_id', $tweet->id)->delete();
            $tweet->delete();
        });
        SocialAccountData::where('social_account_id',  $this->socialAccount->id)->delete();
        $this->socialAccount->forceDelete();

    }
}
