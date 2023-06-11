<?php

namespace App\Http\Controllers;

use App\Classes\Activity;
use App\Classes\InstagramAPI;
use App\Classes\IntercomAPI;
use App\Http\Controllers\ActiveCampaitngController;
use App\Events\SocialAccountConnectedEvent;
use App\Models\Dashboard;
use App\Models\Page;
use App\Models\PageData;
use App\Models\PageFollower;
use App\Models\Post;
use App\Models\Seo;
use App\Models\SocialAccount;
use App\Traits\DatePick;
use Carbon\Carbon;
use FacebookAds\Api;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\FacebookProvider;
use function PHPUnit\Framework\isEmpty;

class InstagramController extends Controller
{
    use DatePick;

    public function instagramCallback(Request $request)
    {
//        $request->id = 469113781542743;
//        $request->token = 'EAACFZCwk0InsBANI53XroB5QG9ZBIJgM7ZCWFQZBGZC0iG0HcscZCTZBG8fiCYzOUA6ZBZCEfGYduBB2TAUyN4CCmgd3PYSyZB6iZAbWDZBZB5mq5UF20Otg8eZA8AnhPL7IonfZAUXmbJA9A5b6PmAApJEUqXJDgZAevT3oWhauncIuKqEP5HZBVTf8fS3ACaYQBf2vJiaO0u77lNp7bI7kD5LzmKfnY';
        $company_id = Auth::user()->company->id;
        try {
            $num_of_days = 30;

            $instagramAPI = new InstagramAPI($num_of_days);
            $account_pages = $instagramAPI->get_user_page($request->id, $request->token);
                if (!empty($account_pages->data && count($account_pages->data) > 0)){
                    foreach ($account_pages->data as $page) {
                        $token = $instagramAPI->get_long_lived_token($request->token);
                        $instagramAPI->set_access_token($token->access_token);
                        $user = $instagramAPI->get_user_data($request->id, $request->token);
                        $page_instagram = $instagramAPI->get_page_instagram($page->id);
                        if (!empty($page_instagram->instagram_business_account->id)){
                            $instagram_account = $instagramAPI->get_instagram_account($page_instagram->instagram_business_account->id);
                            $is_connect = SocialAccount::where('provider_name', 'instagram')->where('provider_id', $instagram_account->id)->where('company_id', $company_id)->first();
                            if($is_connect){
                                return response()->json([
                                    'status' => false,
                                    'message' => __('This instagram is already connected')
                                ], 200);
                            }
                            $social_account = SocialAccount::updateOrCreate(
                                ['provider_name' => 'instagram', 'provider_id'   => $instagram_account->id, 'company_id' => $company_id],
                                [
                                'provider_name' => 'instagram',
                                    'company_id' => $company_id,
                                'provider_id'   => $instagram_account->id,
                                'full_name'     => $instagram_account->name,
                                'email'         => !empty($user->email) ? $user->email : '',
                                'avatar'        => !empty($instagram_account->profile_picture_url) ?$instagram_account->profile_picture_url : Null,
                                'token'         => $token->access_token,
                                'expires_at'    => Carbon::now()->addDay(59),
                            ]);

                            DB::table('company_social_account')->updateOrInsert(
                                ['company_id' => $company_id, 'social_account_id' => $social_account->id],
                                ['company_id' => $company_id, 'social_account_id' => $social_account->id]
                            );

                            $activity = new Activity();
                            $activity->addActivity('add_connection', __('Instagram') . ' ' . $instagram_account->name);
                            SocialAccountConnectedEvent::dispatch(Auth::user(), "Instagram", $instagram_account->name??'', $user->email??'');

                            $new_page = Page::updateOrCreate(
                                ['page_id' => $social_account->provider_id, 'social_account_id' => $social_account->id],
                                [
                                'page_id'           => $social_account->provider_id,
                                'name'              => $social_account->full_name,
                                'token'             => $token->access_token,
                                'social_account_id' => $social_account->id,
                            ]);
                            $instagramAPI->set_id($instagram_account->id);
                            $instagram_insight = $instagramAPI->get_instagram_insights($instagram_account->id, $page->access_token);
                            for ($i = 0; $i <= $num_of_days; $i++) {
                                PageData::create([
                                    'page_impressions' => !empty($instagram_insight->data[0]->values[$i]->value) ? $instagram_insight->data[0]->values[$i]->value : 0,
                                    'page_reach'       => !empty($instagram_insight->data[1]->values[$i]->value) ? $instagram_insight->data[1]->values[$i]->value : 0,
                                    'page_views'       => !empty($instagram_insight->data[2]->values[$i]->value) ? $instagram_insight->data[2]->values[$i]->value : 0,
                                    'page_fans'        => !empty($instagram_insight->data[3]->values[$i]->value) ? $instagram_insight->data[3]->values[$i]->value : 0,
                                    'total_followers'        => !empty($instagram_account->followers_count) ? $instagram_account->followers_count : 0,
                                    'date'             => !empty($instagram_insight->data[2]->values[$i]->end_time) ? date("Y-m-d", strtotime($instagram_insight->data[2]->values[$i]->end_time)) : null,
                                    'page_id'          => $new_page->id,
                                ]);
                            }

                            PageData::updateOrCreate([
                                'page_id' => $new_page->id,
                                'date' => Carbon::now()->subDay()->format('Y-m-d')
                            ],[
                                'page_id' => $new_page->id,
                                'date' => Carbon::now()->subDay()->format('Y-m-d')
                            ]);

                            $instagram_follower_insight = $instagramAPI->get_instagram_follower_insights($instagram_account->id, $page->access_token);
                            if (!empty($instagram_follower_insight->data)){
                                $page_followers_by_countries = (array)$instagram_follower_insight->data[0]->values[0]->value;
                                foreach ($page_followers_by_countries as $key => $value){
                                    PageFollower::create([
                                        'country' => $key,
                                        'number_followers' => $value,
                                        'page_id' => $new_page->id,
                                    ]);
                                }
                            }
                            $instagram_posts = $instagramAPI->get_instagram_posts();
                            foreach ($instagram_posts->data as $post) {
                                try {
                                    $post_insight = $instagramAPI->get_instagram_post_insights($post->id);
                                    Post::create([
                                        'post_id'        => $post->id,
                                        'image'          => !empty($post->media_url) ? $post->media_url : '',
                                        'text'           => !empty($post->caption) ? $post->caption : '',
                                        'created_date'   => !empty($post->timestamp) ? date("Y-m-d", strtotime($post->timestamp)) : null,
                                        'likes_count'    => !empty($post->like_count) ? $post->like_count: 0,
                                        'comments_count' => !empty($post->comments_count) ? $post->comments_count : 0,
                                        'media_type' => !empty($post->media_type) ? $post->media_type : null,
                                        'reach'          => !empty($post_insight->data[0]->values[0]->value) ? $post_insight->data[0]->values[0]->value : 0,
                                        'engaged'        => !empty($post_insight->data[1]->values[0]->value) ? $post_insight->data[1]->values[0]->value : 0,
                                        'page_id'        => $new_page->id,
                                    ]);
                                }catch (RequestException $e){
                                }
                            }
                            //create dashboard
                            Dashboard::updateOrCreate([
                                'company_id' => Auth::user()->company_id,
                                'name' => 'instagram-overview',
                            ],[
                                'name' => 'instagram-overview',
                                'social_account_id' => $social_account->id,
                                'company_id' => Auth::user()->company_id,
                                'page_id' => $new_page->id,
                            ]);
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
        $intercom->addConnection('Instagram');
        $ActiveCampaitng = new ActiveCampaitngController();
        $ActiveCampaitng->EventTrackingCreation('Instagram');
        $ActiveCampaitng->EventTrackingAPI('Instagram','','');

        // $intercom->EventTrackingAPI('Instagram','abc');
        return response()->json([
            'status' => true,
            'message' => __('Connection connected successfully')
        ], 200);
    }

    public function instagramOverview(Request $request)
    {
        if (Auth::user()->company->dashboard->where('name','instagram-overview')->isNotEmpty()) {
            $this->PickDate($request->get('date_from'), $request->get('date_to'));
            $date_from = $this->date_from;
            $date_to = $this->date_to;
            $dashboard = Dashboard::where('company_id', Auth::user()->company_id)
                ->where('name', 'instagram-overview')
                ->first();
            $social_accounts = Auth::user()->company->social_account_instagram->where('id', '!=', $dashboard->social_account_id);
            $page = Page::with(['post', 'data', 'follower'])->where('id', $dashboard->page_id)
                ->where('social_account_id', $dashboard->social_account_id)
                ->first();
            $pages = Page::where('social_account_id', $dashboard->social_account_id)->where('id', '!=', $page->id)->get();
            $page_impression = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions');
            $posts = Post::where('page_id', $page->id)->get();
            $likes = Post::select('likes_count')->where('page_id', $page->id)->sum('likes_count');
            $followers_by_country = PageFollower::where('page_id', $page->id)->get();
            $total_followers = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->max('total_followers');
            $dates = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->distinct()->orderBy('date', 'desc')->pluck('date');
            if ($dates->count() > 0){
                $reach_per_day = PageData::where('page_id', $page->id)->whereIn('date', $dates)->orderBy('date', 'desc')->pluck('page_reach');
                $impression_per_day = PageData::where('page_id', $page->id)->whereIn('date', $dates)->orderBy('date', 'desc')->pluck('page_impressions');
                $new_followers_per_day = PageData::where('page_id', $page->id)->whereIn('date', $dates)->orderBy('date', 'desc')->pluck('page_fans');
            }else {
                $reach_per_day = [];
                $impression_per_day = [];
                $new_followers_per_day = [];
            }
            $connect_name = $page?->name;
            $template_name = 'instagram-overview';
            $dashId = $dashboard->getKey();

            $seo = Seo::where('route', $request->getRequestUri())->first();

            if(!empty($dashboard)) {
                $user = Auth::user();
                $user->last_visited_dashboard = 'instagram-overview';
                $user->save();
            }

            return view('tenant.home_screen', compact(['likes','template_name','connect_name','page', 'page_impression',
                'posts', 'followers_by_country', 'dates', 'reach_per_day', 'impression_per_day', 'new_followers_per_day',
                'total_followers', 'date_from', 'seo', 'date_to', 'social_accounts', 'pages', 'dashId']));
        } else {
            return view('tenant.home_screen');
        }
    }
    public function instagramOverviewV2(Request $request)
    {
        if (Auth::user()->company->dashboard->where('name','instagram-overview')->isNotEmpty()) {
            $this->PickDate($request->get('date_from'), $request->get('date_to'));
            $date_from = $this->date_from;
            $date_to = $this->date_to;
            $dashboard = Dashboard::where('company_id', Auth::user()->company_id)
                ->where('name', 'instagram-overview')
                ->first();
            $social_accounts = Auth::user()->company->social_account_instagram->where('id', '!=', $dashboard->social_account_id);
            $page = Page::with(['post', 'data', 'follower'])->where('id', $dashboard->page_id)
                ->where('social_account_id', $dashboard->social_account_id)
                ->first();
            $pages = Page::where('social_account_id', $dashboard->social_account_id)->where('id', '!=', $page->id)->get();
            $page_impression = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions');
            $posts = Post::where('page_id', $page->id)->get();
            $likes = Post::select('likes_count')->where('page_id', $page->id)->sum('likes_count');
            $followers_by_country = PageFollower::where('page_id', $page->id)->get();
            $total_followers = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->max('total_followers');
            $dates = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->distinct()->orderBy('date', 'desc')->pluck('date');
            if ($dates->count() > 0){
                $reach_per_day = PageData::where('page_id', $page->id)->whereIn('date', $dates)->orderBy('date', 'desc')->pluck('page_reach');
                $impression_per_day = PageData::where('page_id', $page->id)->whereIn('date', $dates)->orderBy('date', 'desc')->pluck('page_impressions');
                $new_followers_per_day = PageData::where('page_id', $page->id)->whereIn('date', $dates)->orderBy('date', 'desc')->pluck('page_fans');
            }else {
                $reach_per_day = [];
                $impression_per_day = [];
                $new_followers_per_day = [];
            }
            $connect_name = $page?->name;
            $template_name = 'instagram-overview';
            $dashId = $dashboard->getKey();

            $seo = Seo::where('route', $request->getRequestUri())->first();

            if(!empty($dashboard)) {
                $user = Auth::user();
                $user->last_visited_dashboard = 'instagram-overview';
                $user->save();
            }

            return view('tenant.v2.dashboards.instagram', compact(['likes','template_name','connect_name','page', 'page_impression',
                'posts', 'followers_by_country', 'dates', 'reach_per_day', 'impression_per_day', 'new_followers_per_day',
                'total_followers', 'date_from', 'seo', 'date_to', 'social_accounts', 'pages', 'dashId']));
            // return view('tenant.home_screen', compact(['likes','template_name','connect_name','page', 'page_impression',
            //     'posts', 'followers_by_country', 'dates', 'reach_per_day', 'impression_per_day', 'new_followers_per_day',
            //     'total_followers', 'date_from', 'seo', 'date_to', 'social_accounts', 'pages', 'dashId']));
        } else {
            return view('tenant.home_screen');
        }
    }
}
