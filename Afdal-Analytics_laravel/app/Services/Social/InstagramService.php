<?php

namespace App\Services\Social;

use App\Classes\InstagramAPI;
use App\Models\ActivityLog;
use App\Models\Page;
use App\Models\PageData;
use App\Models\PageFollower;
use App\Models\Post;
use App\Models\CronChecker;
use App\Models\SocialAccount;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class InstagramService extends BasicService implements SocialService
{

    use FacebookGraphErrorHandler;

    public function __construct(SocialAccount $socialAccount)
    {
        $this->api = new InstagramAPI();
        $this->api->setWriteLogs(true);
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
            $this->api->setSinceDate($socialAccount->last_imported_at);
        }

        $this->api->set_access_token($socialAccount->token);
        $instagramAccount = $this->api->get_instagram_account($socialAccount->provider_id);

        if (!isset($instagramAccount->id)) {
            $this->log("Undefined instagram account = " . var_export($instagramAccount, 1));
            return false;
        }

        $socialAccount->full_name = $instagramAccount->name ?? '';
        $socialAccount->email = $instagramAccount->email ?? '';
        $socialAccount->avatar = $instagramAccount->profile_picture_url ?? '';
        $socialAccount->save();

        $pageSite = Page::where(['page_id' => $socialAccount->provider_id, 'social_account_id' => $socialAccount->id])->first();

        $this->updatePageData($instagramAccount->id, $pageSite->id);
        $this->updateFollowers($instagramAccount->id, $pageSite->id);


        $this->updatePosts($pageSite->id);

        $socialAccount->last_imported_at = Carbon::now();
        $socialAccount->save();
        $this->log("Finish update");
    }

    public function callback() {

    }

    private function updatePageData($instagramAccountId, $newPageId)
    {
        $this->log("Start update page data");
        $this->api->set_id($instagramAccountId);
        $instagram_insight = $this->api->get_instagram_insights($instagramAccountId, $this->api->get_access_token());
        for ($i = 0; $i <= 29; $i++) {
            $date = !empty($instagram_insight->data[2]->values[$i]->end_time) ? date("Y-m-d", strtotime($instagram_insight->data[2]->values[$i]->end_time)) : null;
            PageData::updateOrCreate(
            [
                'page_id' => $newPageId,
                'date' => $date
            ],
            [
                'page_impressions' => $instagram_insight->data[0]->values[$i]->value ?? 0,
                'page_reach' => $instagram_insight->data[1]->values[$i]->value ?? 0,
                'page_views' =>  $instagram_insight->data[2]->values[$i]->value ?? 0,
                'page_fans' =>  $instagram_insight->data[3]->values[$i]->value ?? 0,
                'date' =>  $date,
                'page_id' => $newPageId,
            ]);
        }
        $this->log("Finish update page data");
    }

    private function updateFollowers($instagramAccountId, $newPageId)
    {
        $this->log("Start update followers");

        $instagramFollowerInsight = $this->api->get_instagram_follower_insights($instagramAccountId, $this->api->get_access_token());
        if (!empty($instagramFollowerInsight->data)) {
            $pageFollowersByCountries = (array)$instagramFollowerInsight->data[0]->values[0]->value;
            foreach ($pageFollowersByCountries as $key => $value) {
                PageFollower::updateOrCreate(
                [
                    'country' => $key,
                    'page_id' => $newPageId
                ],
                [
                    'country' => $key,
                    'number_followers' => $value,
                    'page_id' => $newPageId,
                ]);
            }
        }

        $this->log("Finish update followers");
    }

    private function updatePosts($newPageId)
    {



        $this->log("Start update posts");
        $instagramPosts = $this->api->get_instagram_posts();
        $batch_number = time();
        foreach ($instagramPosts->data as $post) {
            try {
                $postInsights = $this->api->get_instagram_post_insights($post->id);
                foreach ($postInsights->data as $postInsight) {
                    if ($postInsight->name == 'reach') $reach = $postInsight->values[0]->value;
                    if ($postInsight->name == 'engagement') $engagement = $postInsight->values[0]->value;
                }

                Post::updateOrCreate(
                    [
                        'post_id' => $post->id,
                        'page_id' => $newPageId
                    ],
                    [
                        'post_id' => $post->id,
                        'image' => !empty($post->media_url) ? $post->media_url : '',
                        'text' => !empty($post->caption) ? $post->caption : '',
                        'created_date' => !empty($post->timestamp) ? date("Y-m-d", strtotime($post->timestamp)) : null,
                        'likes_count' => !empty($post->like_count) ? $post->like_count : 0,
                        'comments_count' => !empty($post->comments_count) ? $post->comments_count : 0,
                        'reach' => $reach ?? 0,
                        'engaged' => $engagement ?? 0,
                        'page_id' => $newPageId,
                        'media_type' => !empty($post->media_type) ? $post->media_type : null,
                        'batch_number'=>$batch_number,
                    ]
                );

            } catch (RequestException $e) {
            }
        }


        //Post::where('batch_number', '!=', $batch_number)->delete();

        $this->log("Finish update posts");
    }

    public function delete(){
        $this->socialAccount->page->each(function ($page){
            PageData::where('page_id', $page->id)->delete();
            Post::where('page_id', $page->id)->delete();
            $page->forceDelete();
        });
        $this->socialAccount->forceDelete();
    }
}
