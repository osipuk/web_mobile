<?php

namespace App\Services\Social;

use App\Classes\FacebookAPI;
use App\Models\CtaData;
use App\Models\Page;
use App\Models\PageData;
use App\Models\PageLike;
use App\Models\Post;
use App\Models\SocialAccount;
use Carbon\Carbon;
use App\Jobs\FacebookEachPagePosts;

class FacebookService extends BasicService implements SocialService
{
    use FacebookGraphErrorHandler;

    public function __construct(SocialAccount $socialAccount)
    {
        $this->api = new FacebookAPI(60);
        $this->api->setWriteLogs(true);
        $this->socialAccount = $socialAccount;
    }

    public function updateUserData()
    {
          //  $this->updatePosts(904);
          //  $this->updatePosts(896);

        $this->log("Start update");
        $socialAccount = $this->socialAccount;
        if (!$this->checkSinceDate($socialAccount->last_imported_at)) {
            return false;
        }

        if (!empty($socialAccount->last_imported_at)) {
            $this->api->setSinceDate($socialAccount->last_imported_at);
        }

        $accountPages = $this->api->get_user_page($socialAccount->provider_id, $socialAccount->token);

        if (empty($accountPages->data)) {
            $this->log("Finish update - no account pages");
            return false;
        }

        foreach ($accountPages->data as $page) {
            $newPage = $this->updateOrCreatePage($page, $socialAccount->id);

            if (!$newPage) {
                continue;
            }

            $newPageId = $newPage->id;
            $this->api->set_id($page->id);
            $this->api->set_access_token($newPage->token);

            $this->updatePageData($newPageId, $page->id, $newPage->token);
            $this->updateCtaData($newPageId);
        }

        $socialAccount->last_imported_at = Carbon::now();
        $socialAccount->save();
        $this->log("Finish update");
    }






    public function callback() {

    }

    private function updateOrCreatePage($page, $socialAccountId)
    {
        $this->log("Start update page");
     //   $isConnected = Page::where('page_id', $page->id)->where('social_account_id', $socialAccountId)->count();
        //if (!$isConnected) {
            //return false;
       // }
        $newPage = Page::updateOrCreate(
            [
                'page_id' => $page->id,
                'social_account_id' => $socialAccountId
            ],
            [
                'page_id'           => $page->id,
                'name'              => $page->name,
                'token'             => $page->access_token,
                'social_account_id' => $socialAccountId,
            ]
        );
        $this->log("Finish update page");
        return $newPage;
    }

    private function updatePageData($newPageId, $page_id, $page_token)
    {
        $this->log("Start update page data and likes");
        
        $this->api->set_id($page_id);
        $this->api->set_access_token($page_token);


        $pageLike = $this->api->get_page_like_unlike_per_day();
        $pageData = $this->api->get_page_data();

        $numberOfDays = Carbon::parse($this->api->getSinceDate())->diffInDays(Carbon::now());

        for ($i = 0; $i < ($numberOfDays - 1); $i++) {
            $date = !empty($pageLike->data[0]->values[$i]->end_time) ? date("Y-m-d", strtotime($pageLike->data[0]->values[$i]->end_time)) : null;
            PageLike::updateOrCreate(
            [
                'page_id' => $newPageId,
                'date' => $date
            ],
            [
                'page_id'      => $newPageId,
                'likes'        => $pageLike->data[0]->values[$i]->value->like ?? 0,
                'unlikes'      => $pageLike->data[1]->values[$i]->value->hide_clicks ?? 0,
                'paid_likes'   => $pageLike->data[2]->values[$i]->value->paid ?? 0,
                'unpaid_likes' => $pageLike->data[2]->values[$i]->value->unpaid ?? 0,
                'date'         => $date,
            ]);

            $dataForUpdate = [];
            foreach ($pageData->data as $item) {
                if (!isset($item->values[$i])) {
                    continue;
                }

                $dataForUpdate['page_id'] = $newPageId;
                if ($item->name == 'page_fans_online') {
                    $timeOnlineArray = (array)$item->values[$i]->value;
                    if (count((array)$item->values[$i]->value) > 0) {
                        $totalHourOnline = max($timeOnlineArray);
                        $totalDayOnline = array_sum($timeOnlineArray);
                        $topHourOnline = array_search($totalHourOnline, $timeOnlineArray);
                        $dataForUpdate['total_day_online'] = $totalDayOnline;
                        $dataForUpdate['total_hour_online'] = $totalHourOnline;
                        $dataForUpdate['top_hour_online'] = $topHourOnline;
                    }
                } else {
                    $field_name = !empty($item->name) ? $item->name : null;
                    $dataForUpdate[$field_name] = !empty($item->values[$i]->value) ? intval($item->values[$i]->value) : 0;
                    if ($item->name == 'page_impressions') {
                        if (!empty($item->values[$i]->end_time)) {
                            $dataForUpdate['date'] = date("Y-m-d", strtotime($item->values[$i]->end_time));
                        }
                    }
                }
            }

            if (!empty($dataForUpdate)) {
                if (!isset($dataForUpdate['date'])) {
                    throw new \Exception("Error. Update page data. Empty `end_time` on facebook");
                }
                PageData::updateOrCreate(
                    [
                        'page_id' => $dataForUpdate['page_id'],
                        'date' => $dataForUpdate['date']
                    ],
                    $dataForUpdate
                );
            }
        }
        $this->log("Finish update page data and likes");
    }

    public function updatePosts($newPageId)
    {
        $this->log("Start update posts");
        $posts = $this->api->get_page_post();
        //dd($posts);
        if (empty($posts->data)) {
            return false;
        }
        $batch_number = time();



        foreach ($posts->data as $post) {
            Post::updateOrCreate([
                'post_id' => $post->id,
                'page_id' => $newPageId
            ],
            [
                'post_id'        => $post->id,
                'image'          => $post->full_picture ?? '',
                'text'           => $post->message ?? '',
                'created_date'   => !empty($post->created_time) ? date("Y-m-d", strtotime($post->created_time)) : null,
                'likes_count'    => $post->likes->summary->total_count ?? 0,
                'shares_count'   => $post->shares->count ?? 0,
                'comments_count' => $post->comments->summary->total_count ?? 0,
                'impressions'    => $post->insights->data[0]->values[0]->value ?? 0,
                'engaged'        => $post->insights->data[1]->values[0]->value ?? 0,
                'clicks'         => $post->insights->data[2]->values[0]->value ?? 0,
                'page_id'        => $newPageId,
                'batch_number'=>$batch_number,

            ]);
        }

        //Post::where('batch_number', '!=', $batch_number)->delete();

        $this->log("Finish update posts");
    }


    public function NewupdatePosts($newPageId, $pageId, $pageToken)
    {
  
        $this->api->set_id($pageId);
        $this->api->set_access_token($pageToken);

        $posts = $this->api->get_page_post();

        if (empty($posts->data)) {
            return false;
        }
        $batch_number = time();

        foreach ($posts->data as $post) {
            Post::updateOrCreate([
                'post_id' => $post->id,
                'page_id' => $newPageId
            ],
            [
                'post_id'        => $post->id,
                'image'          => $post->full_picture ?? '',
                'text'           => $post->message ?? '',
                'created_date'   => !empty($post->created_time) ? date("Y-m-d", strtotime($post->created_time)) : null,
                'likes_count'    => $post->likes->summary->total_count ?? 0,
                'shares_count'   => $post->shares->count ?? 0,
                'comments_count' => $post->comments->summary->total_count ?? 0,
                'impressions'    => $post->insights->data[0]->values[0]->value ?? 0,
                'engaged'        => $post->insights->data[1]->values[0]->value ?? 0,
                'clicks'         => $post->insights->data[2]->values[0]->value ?? 0,
                'page_id'        => $newPageId,
                'batch_number'=>$batch_number,

            ]);
        }



        $this->updatePageData($newPageId, $pageId, $pageToken);
        //$this->updateCtaData($newPageId);



    }

    private function updateCtaData($newPageId)
    {
        $this->log("Start update cta data");
        $ctaData = $this->api->get_cta_data();
        if (!empty($ctaData->data[0]->values) && count($ctaData->data[0]->values) > 0){
            foreach ($ctaData->data[0]->values as $item){
                $data_array = (array)$item->value;

                if (empty($item->end_time)) {
                    continue;
                }

                $date = date("Y-m-d", strtotime($item->end_time));

                foreach ($data_array as $key => $value) {
                    $city = explode(",", $key)[0];
                    CtaData::updateOrCreate(
                    [
                        'city' => $city,
                        'page_id' => $newPageId,
                        'date' => $date
                    ],
                    [
                        'city' => $city,
                        'reach' => $value,
                        'date' => $date,
                        'page_id' => $newPageId,
                    ]);
                }
            }
        }
        $this->log("Finish update cta data");
    }

    public function delete() {
        $this->socialAccount->page->each(function ($page){
            PageLike::where('page_id', $page->id)->delete();
            PageData::where('page_id', $page->id)->delete();
           // Post::where('page_id', $page->id)->delete();
            CtaData::where('page_id', $page->id)->delete();
            $page->forceDelete();
        });
        $this->socialAccount->forceDelete();
    }
}
