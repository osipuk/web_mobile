<?php

namespace App\Http\Controllers;

use App\Classes\Activity;
use App\Classes\FacebookAPI;
use App\Classes\IntercomAPI;
use App\Http\Controllers\ActiveCampaitngController;
use App\Events\SocialAccountConnectedEvent;
use App\Models\CtaData;
use App\Models\Dashboard;
use App\Models\Page;
use App\Models\PageData;
use App\Models\PageLike;
use App\Models\Post;
use App\Models\Seo;
use App\Models\SocialAccount;
use App\Traits\DatePick;
use Carbon\Carbon;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\PagePost;
use GuzzleHttp\Client;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\FacebookProvider;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Session;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use stdClass;
use App\Jobs\FacebookEachPagePosts;


class FacebookController extends Controller
{
    use DatePick;
    public function facebookLogin(Request $request)
    {
        $permissions = ['email', 'read_insights', 'ads_management', 'pages_show_list', 'pages_read_engagement', 'pages_read_user_content', 'public_profile', 'instagram_basic', 'instagram_manage_comments', 'read_insights'];
        $user = Socialite::driver('facebook')->stateless()->scopes($permissions)->asPopup();
        return $user->redirect();
    }

    public function facebook_test(){


        try {

            $num_of_days = 30;
            $token = 'EAACFZCwk0InsBABewZAc6zsKeiDTbBMMQEZC6SuZCFZAlOvfP2nvhYiYDLfpCmjSWg3CfApIeNP1urOZBc2zLyKrTB4DoBvsd0ZBCI7rWTC17A2ZAcamQPO97fQAjx9TlmuUsEmcrlZBiTkJZCAvwGdd7pB2GIjBDs4EGHaO7ZBXTQ852kqtorKUugreN9CbBVIn34ZD';
            $user_id = '265417892230407';
            $facebookAPI = new FacebookAPI($num_of_days);
            //$token = $facebookAPI->get_long_lived_token($token);
            $user = $facebookAPI->get_user_data($user_id, $token);

            $account_pages = $facebookAPI->get_user_page($user_id, $token);

            $facebookAPI->set_id('108210311715797');
            $facebookAPI->set_access_token('EAACFZCwk0InsBAIeOZCSLMqlXr9ZBWma09jZCFEUBP5E6QUtFZBi4fCKI0mBzzVc103rnKaPsQrq5yUJpi1UOiyZC6SRgnr7cGCAQJTJHlXKCRncDB93vdhSrsyuTlBdnS3p4mIu70vQeZB4wPwOgGZC4sjwlqdeL3ihZCbgKQkZCAZCx3ekuiOWM1HrRn0Ykn2hZA0iwiGEmvmdjwZDZD');
                        


            $page_like = $facebookAPI->get_page_like_unlike_per_day();
            $page_data = $facebookAPI->get_page_data();
            $posts = $facebookAPI->get_page_post();


            dd($account_pages, $page_data);

                        $save_data = [];
                        for ($i = 0; $i < $num_of_days; $i++) {
                           
                            /*PageLike::create([
                                'page_id'      => $new_page->id,
                                'likes'        => !empty($page_like->data[0]->values[$i]->value->like) ? $page_like->data[0]->values[$i]->value->like : 0,
                                'unlikes'      => !empty($page_like->data[1]->values[$i]->value->hide_clicks) ? $page_like->data[1]->values[$i]->value->hide_clicks : 0,
                                'paid_likes'   => !empty($page_like->data[2]->values[$i]->value->paid) ? $page_like->data[2]->values[$i]->value->paid : 0,
                                'unpaid_likes' => !empty($page_like->data[2]->values[$i]->value->unpaid) ? $page_like->data[2]->values[$i]->value->unpaid : 0,
                                'date'         => !empty($page_like->data[0]->values[$i]->end_time) ? date("Y-m-d", strtotime($page_like->data[0]->values[$i]->end_time)) : null,
                            ]);

                            */

                            

                            foreach ($page_data->data as $item) {
                                if (!empty($item->values[$i]->end_time)){
                                    $item_date = date("Y-m-d", strtotime($item->values[$i]->end_time));
                                    if ($item->name == 'page_fans_online') {
                                        $time_online_array = (array)$item->values[$i]->value;
                                        if (count($time_online_array) > 0 && $item_date) {
                                            $total_hour_online = max($time_online_array);
                                            $total_day_online = array_sum($time_online_array);
                                            $top_hour_online = array_search($total_hour_online, $time_online_array);

                                            $save_data[$item_date]['total_day_online'] = $total_day_online;
                                            $save_data[$item_date]['total_hour_online'] = $total_hour_online;
                                            $save_data[$item_date]['top_hour_online'] = $top_hour_online;
                                        }
                                    } else {
                                        $field_name = !empty($item->name) ? $item->name : null;
                                        $save_data[$item_date][$field_name] = !empty($item->values[$i]->value) ? intval($item->values[$i]->value) : 0;
                                    }
                                }
                            }
                        }


                            $posts = $facebookAPI->get_page_post();

                        $cta_data = $facebookAPI->get_cta_data();



            dd($user, $account_pages, $page_like, $page_data, $save_data, $posts, $cta_data);
        } catch (RequestException $e) {
            return $e;
        }


    }

    public function facebookCallback(Request $request)
    {

        try {

            $num_of_days = 90;
            $facebookAPI = new FacebookAPI($num_of_days);
            $token = $facebookAPI->get_long_lived_token($request->token);
            //dd($token, $request->id);
            $user = $facebookAPI->get_user_data($request->id, $request->token);
            $company_id = Auth::user()->company->id;
            $social_account = SocialAccount::updateOrCreate(
                ['company_id' => $company_id, 'provider_id'   => $request->id, 'provider_name' => 'facebook'],
                [
                    'provider_name' => 'facebook',
                    'company_id' => $company_id,
                    'provider_id'   => $request->id,
                    'full_name'     => $user->name,
                    'email'         => !empty($user->email) ? $user->email : '',
                    'avatar'        => !empty($user->picture->data->url) ? $user->picture->data->url  : '',
                    'token'         => $token->access_token,
                    'expires_at'    => Carbon::now()->addDay(59),
                ]);

            DB::table('company_social_account')->updateOrInsert(
                ['company_id' => $company_id, 'social_account_id' => $social_account->id],
                ['company_id' => $company_id, 'social_account_id' => $social_account->id]
            );

            $activity = new Activity();
            $activity->addActivity('add_connection', __('Facebook') . ' ' . $user->name);
            SocialAccountConnectedEvent::dispatch(Auth::user(), "Facebook", $user->name ?? '', $user->email ?? '');

            $account_pages = $facebookAPI->get_user_page($request->id, $token->access_token);
            //dd($account_pages);

            if(!empty($account_pages->data)){
                foreach ($account_pages->data as $page) {
                    $is_connected = Page::where('page_id', $page->id)->where('social_account_id', $social_account->id)->count();
                    if (!$is_connected){
                        $new_page = $this->create_page($social_account, $page);
                        $facebookAPI->set_id($page->id);
                        $facebookAPI->set_access_token($page->access_token);
                        
                    
                        $newPageId = $new_page->id;

                       // dd($page->id, $newPageId, $newPage->token);

                        FacebookEachPagePosts::dispatch($social_account, $page->id, $newPageId, $new_page->token)->onQueue('FacebookNewPostsFetch');


                        ## 1
/*
                        $page_like = $facebookAPI->get_page_like_unlike_per_day();
                        $page_data = $facebookAPI->get_page_data();

                        $save_data = [];
                        for ($i = 0; $i < $num_of_days; $i++) {
                            PageLike::create([
                                'page_id'      => $new_page->id,
                                'likes'        => !empty($page_like->data[0]->values[$i]->value->like) ? $page_like->data[0]->values[$i]->value->like : 0,
                                'unlikes'      => !empty($page_like->data[1]->values[$i]->value->hide_clicks) ? $page_like->data[1]->values[$i]->value->hide_clicks : 0,
                                'paid_likes'   => !empty($page_like->data[2]->values[$i]->value->paid) ? $page_like->data[2]->values[$i]->value->paid : 0,
                                'unpaid_likes' => !empty($page_like->data[2]->values[$i]->value->unpaid) ? $page_like->data[2]->values[$i]->value->unpaid : 0,
                                'date'         => !empty($page_like->data[0]->values[$i]->end_time) ? date("Y-m-d", strtotime($page_like->data[0]->values[$i]->end_time)) : null,
                            ]);

                            foreach ($page_data->data as $item) {
                                if (!empty($item->values[$i]->end_time)){
                                    $item_date = date("Y-m-d", strtotime($item->values[$i]->end_time));
                                    if ($item->name == 'page_fans_online') {
                                        $time_online_array = (array)$item->values[$i]->value;
                                        if (count($time_online_array) > 0 && $item_date) {
                                            $total_hour_online = max($time_online_array);
                                            $total_day_online = array_sum($time_online_array);
                                            $top_hour_online = array_search($total_hour_online, $time_online_array);

                                            $save_data[$item_date]['total_day_online'] = $total_day_online;
                                            $save_data[$item_date]['total_hour_online'] = $total_hour_online;
                                            $save_data[$item_date]['top_hour_online'] = $top_hour_online;
                                        }
                                    } else {
                                        $field_name = !empty($item->name) ? $item->name : null;
                                        $save_data[$item_date][$field_name] = !empty($item->values[$i]->value) ? intval($item->values[$i]->value) : 0;
                                    }
                                }
                            }
                        }
                        $this->save_page_data($save_data, $new_page->id);


*/


                        ## 1 
                        // try {
                            
                            ## 2 start 
                           /* $posts = $facebookAPI->get_page_post();
                            if (!empty($posts->data)){
                                
                                foreach ($posts->data as $post) {
                                    Post::create([
                                        'post_id'        => $post->id,
                                        'image'          => !empty($post->full_picture) ? $post->full_picture : '',
                                        'text'           => !empty($post->message) ? $post->message : '',
                                        'created_date'   => !empty($post->created_time) ? date("Y-m-d", strtotime($post->created_time)) : null,
                                        'likes_count'    => !empty($post->likes->summary->total_count) ? $post->likes->summary->total_count : 0,
                                        'shares_count'   => !empty($post->shares->count) ? $post->shares->count : 0,
                                        'comments_count' => !empty($post->comments->summary->total_count) ? $post->comments->summary->total_count : 0,
                                        'impressions'    => !empty($post->insights->data[0]->values[0]->value) ? $post->insights->data[0]->values[0]->value : 0,
                                        'engaged'        => !empty($post->insights->data[1]->values[0]->value) ? $post->insights->data[1]->values[0]->value : 0,
                                        'clicks'         => !empty($post->insights->data[2]->values[0]->value) ? $post->insights->data[2]->values[0]->value : 0,
                                        'page_id'        => $new_page->id,
                                    ]);
                                }

                                
                            }

                            */

                            ## 2 end 



                        // }catch (RequestException $e){}
                        
                            ## 3 start 

                        $cta_data = $facebookAPI->get_cta_data();
                        if (!empty($cta_data->data[0]->values) && count($cta_data->data[0]->values) > 0){
                            
                            foreach ($cta_data->data[0]->values as $item){
                                $data_array = (array)$item->value;
                                foreach ($data_array as $key => $value) {
                                    CtaData::create([
                                        'city' => explode(",", $key)[0],
                                        'reach' => $value,
                                        'date' => !empty($item->end_time) ? date("Y-m-d", strtotime($item->end_time)) : null,
                                        'page_id'        => $new_page->id,
                                    ]);
                                }
                            }

                            
                        }
                        

                            ## 3 end 

                    }
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => __('No pages')
                ], 200);
            }
        } catch (RequestException $e) {
            return $e;
        }
        $intercom = new IntercomAPI();
        $ActiveCampaitng = new ActiveCampaitngController();

        $intercom->addConnection('Facebook');
        $ActiveCampaitng->EventTrackingCreation('Adding Facebook Connection');
        $ActiveCampaitng->EventTrackingAPI('dding Facebook Connection','','');

        
        return response()->json([
            'status' => true,
            'message' => __('Connection connected successfully')
        ], 200);

    }
    public function save_page_data($data, $page_id){
        $model_fields = ['page_impressions_unique','page_impressions','page_impressions_paid_unique',
            'page_impressions_organic_unique','page_impressions_viral_unique','page_impressions_nonviral_unique',
            'page_posts_impressions_unique','page_posts_impressions_paid_unique','page_posts_impressions_organic_unique',
            'page_posts_impressions_viral_unique','page_posts_impressions_nonviral_unique','post_impressions_fan_unique',
            'page_post_engagements','page_cta_clicks_logged_in_by_city_unique',
            'page_call_phone_clicks_logged_in_by_city_unique','page_get_directions_clicks_logged_in_by_city_unique',
            'page_website_clicks_logged_in_by_city_unique','page_engaged_users','page_impressions_paid',
            'page_impressions_organic','page_fans', 'date', 'total_day_online', 'top_hour_online', 'total_hour_online',
            'page_reach', 'page_views', 'page_id'];
        $save_data = [];
        foreach ($data as $key => $item){
            $item['page_id'] = $page_id;
            $item['date'] = $key;
            $item['created_at'] = now()->toDateTimeLocalString();
            $item['updated_at'] = now()->toDateTimeLocalString();
            foreach ($model_fields as $field){
                if (!array_key_exists($field, $item)){
                    $item[$field] = 0;
                }
            }
            $save_data[] = $item;
        }
        $this->save_data($save_data, 'page_data');
    }

    public function save_data($data, $table_name){
        $chunks = array_chunk($data, 100);
        foreach ($chunks as $chunk){
            DB::table($table_name)->insert($chunk);
        }
    }

    public function create_page($social_account, $page){
        $new_page = Page::updateOrCreate(
            ['page_id' => $page->id, 'social_account_id' => $social_account->id],
            [
                'page_id'           => $page->id,
                'name'              => $page->name,
                'token'             => $page->access_token,
                'social_account_id' => $social_account->id,
            ]);
        return $new_page;
    }

    public function facebookPageOverview(Request $request)
    {
        if (Auth::user()->company->dashboard->where('name','facebook-overview')->isNotEmpty()) {
            $this->PickDate($request->get('date_from'), $request->get('date_to'));
            $date_from = $this->date_from;
            $date_to = $this->date_to;

            $dashboard = Dashboard::where('company_id', Auth::user()->company_id)
                ->where('name', 'facebook-overview')
                ->first();
            $social_accounts = Auth::user()->company->social_account_facebook->where('id', '!=', $dashboard->social_account_id);
            $page = Page::with('post')->findOrFail($dashboard->page_id);
            $pages = Page::where('social_account_id', $dashboard->social_account_id)->where('id', '!=', $page->id)->get();
            $page_data = PageData::where('page_id', $page->id)->first();
            //like graph
            $like_per_day = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->limit(20)->pluck('likes');
            $unlike_per_day = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->limit(20)->pluck('unlikes');
            $likeDate = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->limit(20)->pluck('date');
            //total likes
            $total_likes_data = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->first();
            $total_likes = $total_likes_data?->page_fans;
            //likes from news feed
            $news_feed_likes = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('unpaid_likes');
            //likes from ads
            $ads_likes = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('paid_likes');
            //unique post impression
            $unique_post_impression = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_posts_impressions_unique');
            //unique page impression
            $unique_page_impression = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_unique');
            //unique post impression by type graph
            $unique_post_impression_paid = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_posts_impressions_paid_unique');
            $unique_post_impression_organic = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_posts_impressions_organic_unique');
            $unique_post_impression_viral = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_posts_impressions_viral_unique');
            //unique page impression by type graph
            $unique_page_impression_paid = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_paid_unique');
            $unique_page_impression_organic = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_organic_unique');
            $unique_page_impression_viral = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_viral_unique');
            $unique_page_impression_noviral = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_nonviral_unique');
            //funnel graph
            $page_impression = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions');
            $page_clicks = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_paid');
            //post distribution graph
            $date_created_post_array = Post::select('created_date')->where('page_id', $page->id)->where('created_date', '>=', $date_from)->where('created_date', '<=', $date_to)->distinct('created_date')->orderBy('created_date', 'desc')->limit(15)->pluck('created_date');
            if ($date_created_post_array->count() > 0)
            foreach ($date_created_post_array as $date) {
                $posts_created_per_day[] = Post::where('page_id', $page->id)->where('created_date', $date)->orderBy('created_date', 'asc')->count();
            } else {
                $posts_created_per_day = [];
            }
            $posts_engaged_per_day = PageData::where('page_id', $page->id)->whereIn('date', $date_created_post_array)->orderBy('date', 'asc')->pluck('page_post_engagements');

            //average post data
            $posts_average_likes = Post::where('page_id', $page->id)->where('created_date', '>=', $date_from)->where('created_date', '<=', $date_to)->avg('likes_count');
            $posts_average_comments = Post::where('page_id', $page->id)->where('created_date', '>=', $date_from)->where('created_date', '<=', $date_to)->avg('comments_count');
            $posts_average_shares = Post::where('page_id', $page->id)->where('created_date', '>=', $date_from)->where('created_date', '<=', $date_to)->avg('shares_count');
            $posts_average_likes = round($posts_average_likes);
            $posts_average_comments = round($posts_average_comments);
            $posts_average_shares = round($posts_average_shares);
            //page impression paid
            $page_impression_paid = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_paid');
            $page_impression_organic = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_organic');
            //page engagement
            $page_engagement = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_post_engagements');
            $post_reach_by_fans = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('post_impressions_fan_unique');
            //page engagement user graph
            $page_engagement_per_day_date = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->distinct('date')->orderBy('date', 'desc')->limit(20)->pluck('date');
            $page_engagement_per_day = PageData::where('page_id', $page->id)->whereIn('date', $page_engagement_per_day_date)->orderBy('date', 'desc')->limit(20)->pluck('page_engaged_users');
            //top posting time
            $page_top_time_post_data = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('total_hour_online', 'desc')->first('top_hour_online');
            $page_top_time_post = $page_top_time_post_data?->top_hour_online;
            //top posting day
            $page_top_day_post_data = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('total_day_online', 'desc')->first('date');
            $page_top_day_post = date("l", strtotime($page_top_day_post_data?->date));
            $cta_data = CtaData::select('city')
                ->where('page_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->select(DB::raw('SUM(reach) as total_reach'),'city')
                ->groupBy('city')
                ->orderBy('total_reach', 'desc')
                ->take(10)
                ->get();

            $connect_name = $page?->name;
            $template_name = 'facebook-overview';
            $dashId = $dashboard->getKey();

            $seo = Seo::where('route', $request->getRequestUri())->first();

            if(!empty($dashboard)) {
                $user = Auth::user();
                $user->last_visited_dashboard = 'facebook-overview';
                $user->save();
            }

            return view('tenant.home_screen', compact(['connect_name', 'template_name','page', 'like_per_day',
                'unlike_per_day', 'likeDate', 'social_accounts','pages', 'dashboard',
                 'page_data', 'date_created_post_array', 'posts_created_per_day', 'posts_engaged_per_day', 'ads_likes',
                 'posts_average_likes', 'posts_average_comments', 'posts_average_shares', 'total_likes', 'news_feed_likes',
                 'unique_post_impression', 'unique_page_impression', 'unique_post_impression_paid', 'unique_post_impression_organic',
                 'unique_post_impression_viral', 'unique_page_impression_paid', 'unique_page_impression_organic',
                 'unique_page_impression_viral', 'unique_page_impression_noviral', 'page_impression', 'page_clicks',
                 'page_impression_paid', 'page_impression_organic', 'page_engagement', 'post_reach_by_fans', 'page_engagement_per_day',
                 'page_engagement_per_day_date', 'page_top_time_post', 'page_top_day_post', 'date_to', 'date_from', 'cta_data', 'dashId','seo'
            ]));
        } else {
            return view('tenant.home_screen');
        }
    }

    public function facebookPageEngagement(Request $request)
    {
        if (Auth::user()->company->dashboard->where('name','facebook-engagement')->isNotEmpty()) {
            $this->PickDate($request->get('date_from'), $request->get('date_to'));
            $date_from = $this->date_from;
            $date_to = $this->date_to;

            $dashboard = Dashboard::where('company_id', Auth::user()->company_id)
                ->where('name', 'facebook-engagement')
                ->first();
            $social_accounts = Auth::user()->company->social_account_facebook->where('id', '!=', $dashboard->social_account_id);
//            $page = Page::where('social_account_id', $dashboard->social_account_id)->where('id', $dashboard->page_id)->first();
            $page = Page::with('post')->findOrFail($dashboard->page_id);
            $pages = Page::where('social_account_id', $dashboard->social_account_id)->where('id', '!=', $page->id)->get();
            $page_data = PageData::where('page_id', $page->id)->first();
            //page impression and reach graph
            $impression_per_day = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->pluck('page_impressions');
            $reach_per_day = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->pluck('page_impressions_unique');
            $impressionDate = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->pluck('date');
            //total likes
            $total_likes = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('likes');
            //likes from news feed
            $news_feed_likes = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('unpaid_likes');
            //likes from ads
            $ads_likes = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('paid_likes');
            //unique post impression
            $unique_post_impression = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_posts_impressions_unique');
            //unique page impression
            $unique_page_impression = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_unique');
            //unique post impression by type graph
            $unique_post_impression_paid = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_posts_impressions_paid_unique');
            $unique_post_impression_organic = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_posts_impressions_organic_unique');
            $unique_post_impression_viral = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_posts_impressions_viral_unique');
            //unique page impression by type graph
            $unique_page_impression_paid = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_paid_unique');
            $unique_page_impression_organic = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_organic_unique');
            $unique_page_impression_viral = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_viral_unique');
            $unique_page_impression_noviral = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_nonviral_unique');
            //funnel graph
            $page_impression = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions');
            $page_clicks = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_paid');
            //post distribution graph
            $date_created_post_array = Post::select('created_date')->where('page_id', $page->id)->where('created_date', '>=', $date_from)->where('created_date', '<=', $date_to)->distinct('created_date')->orderBy('created_date', 'desc')->pluck('created_date');
            if (count($date_created_post_array) > 0){
                foreach ($date_created_post_array as $date) {
                    $posts_created_per_day[] = Post::where('page_id', $page->id)->where('created_date', $date)->count();
                }
            }else{
                $posts_created_per_day = [];
            }
            $posts_engaged_per_day = PageData::where('page_id', $page->id)->whereIn('date', $date_created_post_array)->orderBy('date', 'desc')->pluck('page_post_engagements');

            //average post data
            $posts_average_likes = Post::where('page_id', $page->id)->where('created_date', '>=', $date_from)->where('created_date', '<=', $date_to)->avg('likes_count');
            $posts_average_comments = Post::where('page_id', $page->id)->where('created_date', '>=', $date_from)->where('created_date', '<=', $date_to)->avg('comments_count');
            $posts_average_shares = Post::where('page_id', $page->id)->where('created_date', '>=', $date_from)->where('created_date', '<=', $date_to)->avg('shares_count');
            $posts_average_likes = round($posts_average_likes);
            $posts_average_comments = round($posts_average_comments);
            $posts_average_shares = round($posts_average_shares);
            //page impression paid
            $page_impression_paid = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_paid');
            $page_impression_organic = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions_organic');
            //page engagement
            $page_engagement = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_post_engagements');
            $post_reach_by_fans = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('post_impressions_fan_unique');
            //page engagement user graph
            $page_engagement_per_day = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->pluck('page_engaged_users');
            $page_engagement_per_day_date = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->pluck('date');
            //top posting time
            $page_top_time_post_data = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('total_hour_online', 'desc')->first('top_hour_online');
            $page_top_time_post = $page_top_time_post_data?->top_hour_online;
            //top posting day
            $page_top_day_post_data = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('total_day_online', 'desc')->first('date');
            $page_top_day_post = date("l", strtotime($page_top_day_post_data?->date));
            $connect_name = $page?->name;
            $cta_data = CtaData::select('city')
                ->where('page_id', $page->id)
                ->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to)
                ->select(DB::raw('SUM(reach) as total_reach'),'city')
                ->groupBy('city')
                ->orderBy('total_reach', 'desc')
                ->take(10)
                ->get();
            $template_name = 'facebook-engagement';
            $dashId = $dashboard->getKey();

            $seo = Seo::where('route', $request->getRequestUri())->first();

            if(!empty($dashboard)) {
                $user = Auth::user();
                $user->last_visited_dashboard = 'facebook-engagement';
                $user->save();
            }

            return view('tenant.home_screen', compact(['template_name','connect_name', 'page', 'impression_per_day', 'reach_per_day', 'impressionDate',
                'page_data', 'date_created_post_array', 'posts_created_per_day', 'posts_engaged_per_day', 'ads_likes',
                'posts_average_likes', 'posts_average_comments', 'posts_average_shares', 'total_likes', 'news_feed_likes',
                'unique_post_impression', 'unique_page_impression', 'unique_post_impression_paid', 'unique_post_impression_organic',
                'unique_post_impression_viral', 'unique_page_impression_paid', 'unique_page_impression_organic',
                'unique_page_impression_viral', 'unique_page_impression_noviral', 'page_impression', 'page_clicks',
                'page_impression_paid', 'page_impression_organic', 'page_engagement', 'post_reach_by_fans', 'page_engagement_per_day',
                'page_engagement_per_day_date', 'page_top_time_post', 'page_top_day_post', 'date_to', 'date_from', 'cta_data', 'social_accounts', 'seo',
                'pages', 'dashId'
            ]));
        } else {
            return view('tenant.home_screen');
        }
    }

//    public function getPostLikes($id)
//    {
//        $client = new Client();
//        $res = $client->request('GET', 'https://graph.facebook.com/v12.0/101712171685882_183860843471014?fields=shares%2Clikes.summary(true)%2Ccomments.summary(true)&&access_token=EAAExWOKRoGQBAMPMZBqbd7tYes5cgZC8ZAY8EYDOxDiz8FGafZANofstAU38GMHL6rpgVZCVVrU6u48OtIMLDGzB6MM98dQNvJGtqcNnYgQOuRXuw0WZC1wsz2ml2zt8s36pRICn7YkXxTtcoiS8RIdPY1ns1XVeNBV85AgMP9vketTF7vs5IrSeI6oTZB8VfZAV6LxTgLuf8QPpTMgw8LRNzH2og4UMNSuCNGo7ZCoOHaQZDZD');
//        return json_decode($res->getBody()->getContents());
//    }
//
//
//    private function facebookTotalPageViews($pageId, $foreverPageAccessToken)
//    {
//        $url = 'https://graph.facebook.com/v12.0/110471198139309/insights?access_token=' . $foreverPageAccessToken . '&since=2021-12-03&until=2021-12-03&metric=page_views_total,page_views_logout,page_views_logged_in_total,page_views_logged_in_unique,page_views_external_referrals,page_views_by_profile_tab_total,page_views_by_profile_tab_logged_in_unique,page_views_by_internal_referer_logged_in_unique,page_views_by_site_logged_in_unique,page_views_by_age_gender_logged_in_unique,page_views_by_referers_logged_in_unique&period=day';
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $result = curl_exec($ch);
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close($ch);
//        return $result;
//    }
//
//    private function facebookPageCTAClicks($pageId, $foreverPageAccessToken)
//    {
//        $url = 'https://graph.facebook.com/v12.0/110471198139309/insights?access_token=' . $foreverPageAccessToken . '&since=1636876800&until=1636963200&metric=page_total_actions,page_cta_clicks_logged_in_total,page_cta_clicks_logged_in_unique,page_website_clicks_by_site_logged_in_unique,page_website_clicks_logged_in_by_city_unique,page_website_clicks_logged_in_by_country_unique,page_website_clicks_by_age_gender_logged_in_unique,page_website_clicks_logged_in_unique,page_get_directions_clicks_by_site_logged_in_unique,page_get_directions_clicks_logged_in_by_city_unique,page_get_directions_clicks_logged_in_by_country_unique,page_get_directions_clicks_by_age_gender_logged_in_unique,page_get_directions_clicks_logged_in_unique,page_call_phone_clicks_by_site_logged_in_unique,page_call_phone_clicks_logged_in_by_city_unique,page_call_phone_clicks_logged_in_by_country_unique,page_call_phone_clicks_by_age_gender_logged_in_unique,page_call_phone_clicks_logged_in_unique,page_cta_clicks_logged_in_by_city_unique,page_cta_clicks_logged_in_by_country_unique,page_cta_clicks_by_age_gender_logged_in_unique,page_cta_clicks_by_site_logged_in_unique&period=day';
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $result = curl_exec($ch);
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close($ch);
//        return $result;
//    }
//
//    private function facebookPageCountryMetrices($foreverPageAccessToken)
//    {
//        $url = 'https://graph.facebook.com/v12.0/110471198139309/insights?access_token=' . $foreverPageAccessToken . '&since=1637481600&until=1637568000&metric=page_tab_views_login_top_unique,page_tab_views_login_top,page_tab_views_logout_top,page_total_actions,page_cta_clicks_logged_in_total,page_cta_clicks_logged_in_unique,page_website_clicks_by_site_logged_in_unique,page_website_clicks_logged_in_by_city_unique,page_website_clicks_logged_in_by_country_unique,page_website_clicks_by_age_gender_logged_in_unique,page_website_clicks_logged_in_unique,page_get_directions_clicks_by_site_logged_in_unique,page_get_directions_clicks_logged_in_by_city_unique,page_get_directions_clicks_logged_in_by_country_unique,page_get_directions_clicks_by_age_gender_logged_in_unique,page_get_directions_clicks_logged_in_unique,page_call_phone_clicks_by_site_logged_in_unique,page_call_phone_clicks_logged_in_by_city_unique,page_call_phone_clicks_logged_in_by_country_unique,page_call_phone_clicks_by_age_gender_logged_in_unique,page_call_phone_clicks_logged_in_unique,page_cta_clicks_logged_in_by_city_unique,page_cta_clicks_logged_in_by_country_unique,page_cta_clicks_by_age_gender_logged_in_unique,page_cta_clicks_by_site_logged_in_unique,page_engaged_users,page_post_engagements,page_fan_adds_by_paid_non_paid_unique,page_fans_online_per_day,page_fans_online,page_positive_feedback_by_type_unique,page_positive_feedback_by_type,page_negative_feedback_by_type_unique,page_negative_feedback_by_type,page_negative_feedback_unique,page_negative_feedback,page_places_checkins_by_country,page_places_checkins_by_locale,page_places_checkins_by_age_gender,page_places_checkin_mobile_unique,page_places_checkin_mobile,page_places_checkin_total_unique,page_places_checkin_total,page_consumptions_by_consumption_type_unique,page_consumptions_by_consumption_type,page_consumptions_unique,page_consumptions,page_impressions,page_impressions_unique,page_impressions_viral_frequency_distribution,page_impressions_frequency_distribution,page_impressions_by_age_gender_unique,page_impressions_by_locale_unique,page_impressions_by_country_unique,page_impressions_by_city_unique,page_impressions_by_story_type_unique,page_impressions_by_story_type,page_impressions_nonviral_unique,page_impressions_nonviral,page_impressions_viral_unique,page_impressions_viral,page_impressions_organic_unique,page_impressions_organic,page_impressions_paid_unique,page_impressions_paid,page_posts_impressions,page_posts_impressions_unique,page_posts_impressions_frequency_distribution,page_posts_impressions_nonviral_unique,page_posts_impressions_nonviral,page_posts_impressions_viral_unique,page_posts_impressions_viral,page_posts_served_impressions_organic_unique,page_posts_impressions_organic_unique,page_posts_impressions_organic,page_posts_impressions_paid_unique,page_posts_impressions_paid,page_actions_post_reactions_like_total,page_actions_post_reactions_love_total,page_actions_post_reactions_wow_total,page_actions_post_reactions_haha_total,page_actions_post_reactions_sorry_total,page_actions_post_reactions_anger_total,page_actions_post_reactions_total,page_fans,page_fans_locale,page_fans_city,page_fans_country,page_fans_gender_age,page_fan_adds,page_fan_adds_unique,page_fans_by_like_source,page_fans_by_like_source_unique,page_fan_removes,page_fan_removes_unique,page_fans_by_unlike_source_unique,page_video_views,page_video_views_paid,page_video_views_organic,page_video_views_by_paid_non_paid,page_video_views_autoplayed,page_video_views_click_to_play,page_video_views_unique,page_video_repeat_views,page_video_complete_views_30s,page_video_complete_views_30s_paid,page_video_complete_views_30s_organic,page_video_complete_views_30s_autoplayed,page_video_complete_views_30s_click_to_play,page_video_complete_views_30s_unique,page_video_complete_views_30s_repeat_views,page_video_views_10s,page_video_view_time,page_video_views_10s_repeat,page_video_views_10s_unique,page_video_views_10s_click_to_play,page_video_views_10s_autoplayed,page_video_views_10s_organic,page_video_views_10s_paid,page_views_total,page_views_logout,page_views_logged_in_total,page_views_logged_in_unique,page_views_external_referrals,page_views_by_profile_tab_total,page_views_by_profile_tab_logged_in_unique,page_views_by_internal_referer_logged_in_unique,page_views_by_site_logged_in_unique,page_views_by_age_gender_logged_in_unique,page_views_by_referers_logged_in_unique,page_content_activity_by_action_type_unique,page_content_activity_by_age_gender_unique,page_content_activity_by_city_unique,page_content_activity_by_country_unique,page_content_activity_by_locale_unique,page_content_activity,page_content_activity_by_action_type&period=day';
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $result = curl_exec($ch);
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close($ch);
//        return $result;
//    }
//
//    private function facebookPostImpression($foreverPageAccessToken)
//    {
//        $url = 'https://graph.facebook.com/v12.0/110471198139309_110473071472455/insights?access_token=' . $foreverPageAccessToken . '&since=2021-12-03&until=2021-12-03&metric=post_impressions,post_impressions_unique,post_impressions_by_story_type_unique,post_impressions_by_story_type,post_impressions_nonviral_unique,post_impressions_nonviral,post_impressions_viral_unique,post_impressions_viral,post_impressions_organic_unique,post_impressions_organic,post_impressions_fan_paid_unique,post_impressions_fan_paid,post_impressions_fan_unique,post_impressions_fan,post_impressions_paid_unique,post_impressions_paid&period=lifetime';
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $result = curl_exec($ch);
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close($ch);
//        return $result;
//    }
//
//    private function facebookPageImpression($foreverPageAccessToken)
//    {
//        $url = 'https://graph.facebook.com/v12.0/110471198139309/insights?access_token=' . $foreverPageAccessToken . '&since=2021-12-03&until=2021-12-03&metric=page_impressions_unique,page_posts_impressions,page_impressions,page_engaged_users,page_post_engagements&period=lifetime';
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $result = curl_exec($ch);
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close($ch);
//        return $result;
//    }
//
//    private function facebookPagePostCountryMetrices($foreverPageAccessToken)
//    {
//        $url = 'https://graph.facebook.com/v12.0/110471198139309_110473071472455/insights?access_token=' . $foreverPageAccessToken . '&metric=post_engaged_users,post_negative_feedback,post_clicks_by_type_unique,post_clicks_by_type,post_clicks_unique,post_clicks,post_engaged_fan,post_negative_feedback_by_type_unique,post_negative_feedback_by_type,post_negative_feedback_unique,post_impressions,post_impressions_unique,post_impressions_by_story_type_unique,post_impressions_by_story_type,post_impressions_nonviral_unique,post_impressions_nonviral,post_impressions_viral_unique,post_impressions_viral,post_impressions_organic_unique,post_impressions_organic,post_impressions_fan_paid_unique,post_impressions_fan_paid,post_impressions_fan_unique,post_impressions_fan,post_impressions_paid_unique,post_impressions_paid,post_reactions_like_total,post_reactions_love_total,post_reactions_wow_total,post_reactions_haha_total,post_reactions_sorry_total,post_reactions_anger_total,post_reactions_by_type_total,post_video_avg_time_watched,post_video_complete_views_organic,post_video_complete_views_organic_unique,post_video_complete_views_paid,post_video_complete_views_paid_unique,post_video_retention_graph,post_video_retention_graph_clicked_to_play,post_video_retention_graph_autoplayed,post_video_views_organic,post_video_views_organic_unique,post_video_views_paid,post_video_views_paid_unique,post_video_length,post_video_views,post_video_views_unique,post_video_views_autoplayed,post_video_views_clicked_to_play,post_video_views_15s,post_video_views_60s_excludes_shorter,post_video_views_10s,post_video_views_10s_unique,post_video_views_10s_autoplayed,post_video_views_10s_clicked_to_play,post_video_views_10s_organic,post_video_views_10s_paid,post_video_views_10s_sound_on,post_video_views_sound_on,post_video_view_time,post_video_view_time_organic,post_video_view_time_by_age_bucket_and_gender,post_video_view_time_by_region_id,post_video_views_by_distribution_type,post_video_view_time_by_distribution_type,post_video_view_time_by_country_id,post_video_complete_views_30s_autoplayed,post_video_complete_views_30s_unique,post_video_complete_views_30s_paid,post_video_complete_views_30s_organic,post_video_complete_views_30s_clicked_to_play,post_activity,post_activity_unique,post_activity_by_action_type,post_activity_by_action_type_unique&period=lifetime';
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $result = curl_exec($ch);
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close($ch);
//        return $result;
//    }
//
//    private function facebookPostReaction($foreverPageAccessToken)
//    {
//        $url = 'https://graph.facebook.com/v12.0/110471198139309_110473071472455/insights?access_token=' . $foreverPageAccessToken . '&since=2021-12-03&until=2021-12-03&metric=post_reactions_like_total,post_reactions_love_total,post_reactions_wow_total,post_reactions_haha_total,post_reactions_sorry_total,post_reactions_anger_total,post_reactions_by_type_total&period=lifetime';
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $result = curl_exec($ch);
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close($ch);
//        return $result;
//    }
//
//    private function facebookPostActivity($foreverPageAccessToken)
//    {
//        $url = 'https://graph.facebook.com/v12.0/110471198139309_110473071472455/insights?access_token=' . $foreverPageAccessToken . '&since=2021-12-03&until=2021-12-03&metric=post_activity,post_activity_unique,post_activity_by_action_type,post_activity_by_action_type_unique&period=lifetime';
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $result = curl_exec($ch);
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close($ch);
//        return $result;
//    }
//
//    private function getPages($accessToken)
//    {

//        $fbuser = Socialite::driver('facebook')->scopes(['email','read_insights','ads_management','pages_show_list','pages_read_engagement','pages_read_user_content', 'public_profile']);
//        $pages = $this->facebook->get('/me/accounts?type=page', $accessToken);
//        dd($fbuser);
        // print_r($pages);die;
//        $pages = $pages->getGraphEdge()->asArray();
        // print_r($pages);die;
//        return array_map(function ($item) {
//            return [
//                'access_token' => $item['access_token'],
//                'id' => $item['id'],
//                'name' => $item['name'],
//                'image' => "https://graph.facebook.com/{$item['id']}/picture?type=large"
//            ];
//        }, $pages);
//    }


}
