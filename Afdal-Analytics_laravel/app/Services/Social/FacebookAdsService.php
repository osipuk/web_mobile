<?php

namespace App\Services\Social;

use App\Classes\FacebookAdsApi;
use App\Models\AdsAccount;
use App\Models\AdsData;
use App\Models\Post;
use App\Models\SocialAccount;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;

class FacebookAdsService extends BasicService implements SocialService
{
    use FacebookGraphErrorHandler;

    public function __construct(SocialAccount $socialAccount)
    {
        $this->api = new FacebookAdsApi();
        $this->socialAccount = $socialAccount;
    }

    public function updateUserData()
    {
        $this->log("Start update");
        $socialAccount = $this->socialAccount;
        if (!$this->checkSinceDate($socialAccount->last_imported_at)) {
            return false;
        }

        if (!empty($socialAccount->last_imported_at)) {
            $this->api->setTimeRange(Carbon::parse($socialAccount->last_imported_at)->format("Y-m-d"), Carbon::now()->format("Y-m-d"));
        }

        $this->api->set_access_token($socialAccount->token);
        $actAccounts = $this->api->get_ad_accounts($socialAccount->provider_id);

        if (empty($actAccounts->data)) {
            $this->log("Error. No facebook ads account data");
            return false;
        }

        foreach ($actAccounts->data as $actAccount) {
            $adsAccount = $this->updateOrCreateAdsAccount($actAccount, $socialAccount->id);

            if (!$adsAccount) {
                continue;
            }

            $this->updateInsights($actAccount->id, $adsAccount->id);
            $this->updatePosts($actAccount->id, $adsAccount->id);
        }

        $socialAccount->last_imported_at = Carbon::now();
        $socialAccount->save();
        $this->log("Finish update");
    }

    public function callback() {

    }

    private function updateOrCreateAdsAccount($actAccount, $socialAccountId)
    {
        $this->log("Start account info update");
        $isConnected = AdsAccount::where('social_account_id', $socialAccountId)->where('act_id', $actAccount->id)->count();

        if (!$isConnected) {
            $this->log("Error. Page is already connected");
            return false;
        }

        $result = AdsAccount::updateOrCreate(
            [
                'act_id' => $actAccount->id,
                'social_account_id' => $socialAccountId
            ],
            [
                'act_id' => $actAccount->id,
                'account_id' => $actAccount->account_id,
                'name' => $actAccount->name,
                'social_account_id' => $socialAccountId,
            ]
        );
        $this->log("Finish account info update");
        return $result;
    }

    private function updatePosts($actAccountId, $adsAccountId)
    {
        $this->log("Start posts update");
        $posts_id = [];
        $creatives = $this->api->get_ad_creatives($actAccountId);
        foreach ($creatives->data as $creative) {
            $creative_data = $this->api->get_creative_data($creative->id);
            if (!isset($creative_data->effective_object_story_id)) {
                $this->log("Undefined `effective_object_story_id` in data = " . json_encode($creative_data));
                continue;
            }
            $posts_id[] = $creative_data->effective_object_story_id;
        }

        $posts_id = array_unique($posts_id);
        if (count($posts_id) > 0) {
            foreach ($posts_id as $post_id) {
                $page_id = explode( '_', $post_id)[0];
                $page_token =  $this->api->get_page_token($page_id);
                try {
                    $post_data =  $this->api->get_post_data($post_id, $page_token->access_token);

                    if (isset($post_data->insights)) {
                        foreach ($post_data->insights->data as $postInsight) {
                            if ($postInsight->name == 'post_clicks') $clicks = $postInsight->values[0]->value;
                            if ($postInsight->name == 'post_engaged_users') $engagement = $postInsight->values[0]->value;
                        }
                    }

                    Post::updateOrCreate(
                    [
                        'post_id' => $post_data->id,
                        'ads_account_id' => $adsAccountId
                    ],
                    [
                        'post_id'        => $post_data->id,
                        'image'          => !empty($post_data->full_picture) ? $post_data->full_picture : null,
                        'text'           => !empty($post_data->message) ? $post_data->message : null,
                        'created_date'   => !empty($post_data->created_time) ? date("Y-m-d", strtotime($post_data->created_time)) : null,
                        'likes_count'    => !empty($post_data->likes->summary->total_count) ? $post_data->likes->summary->total_count : 0,
                        'comments_count' => !empty($post_data->comments->summary->total_count) ? $post_data->comments->summary->total_count : 0,
                        'engaged'        => $engagement ?? 0,
                        'clicks'         => $clicks ?? 0,
                        'ads_account_id' => $adsAccountId,
                    ]);
                } catch (RequestException $e) {
                }
            }
        }
        $this->log("Finish posts update");
    }

    private function updateInsights($actAccountId, $adsAccountId)
    {
        $this->log("Start insights update");
        $insights = $this->api->get_ad_account_insight($actAccountId);

        $adsDataList = [];
        foreach ($insights->data as $insight) {
            $campaignId = !empty($insight->campaign_id) ? $insight->campaign_id : null;
            $date = $insight->date_start ?? null;

            $data = [
                'campaign_id' => $campaignId,
                'campaign_name' => !empty($insight->campaign_name) ? $insight->campaign_name : null,
                'impressions' => !empty($insight->impressions) ? $insight->impressions : 0,
                'ctr' => !empty($insight->ctr) ? $insight->ctr : 0,
                'cpc' => !empty($insight->cpc) ? $insight->cpc : 0,
                'account_currency' => !empty($insight->account_currency) ? $insight->account_currency : null,
                'clicks' => !empty($insight->clicks) ? $insight->clicks : 0,
                'inline_link_clicks' => !empty($insight->inline_link_clicks) ? $insight->inline_link_clicks : 0,
                'ads_account_id' => $adsAccountId,
                'date' => $date
            ];

            if (is_null($campaignId) || is_null($date)) {
                $adsData = AdsData::create($data);
            } else {
                $adsData = AdsData::updateOrCreate(['campaign_id' => $campaignId, 'date' => $date], $data);
            }

            $key = $insight->campaign_id . ($insight->date_start ?? '');
            $adsDataList[$key] = $adsData;
        }

        $insights_2 = $this->api->get_ad_account_insight_2($actAccountId);
        foreach ($insights_2->data as $insight) {
            $key = $insight->campaign_id . ($insight->date_start ?? '');
            if (empty($adsDataList[$key])) {
                continue;
            }

            $adsDataList[$key]->update([
                'cpp' => !empty($insight->cpp) ? $insight->cpp : 0,
                'cpm' => !empty($insight->cpm) ? $insight->cpm : 0,
                'spend' => !empty($insight->spend) ? $insight->spend : 0,
                'reach' => !empty($insight->reach) ? $insight->reach : 0,
                'converted_product_value' => !empty($insight->converted_product_value) ? $insight->converted_product_value : 0,
            ]);
        }
        $this->log("Finish insights update");
    }

    public function delete() {
        $this->socialAccount->ads_account->each(function ($account){
            AdsData::where('ads_account_id', $account->id)->delete();
            Post::where('ads_account_id', $account->id)->delete();
            $account->delete();
        });
        $this->socialAccount->forceDelete();
    }
}
