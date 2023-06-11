<?php

namespace App\Http\Controllers;

use App\Models\AdsAccount;
use App\Models\AdsData;
use App\Models\CtaData;
use App\Models\Dashboard;
use App\Models\GoogleAdsAccount;
use App\Models\GoogleAdsAccountData;
use App\Models\GoogleAdsCampaign;
use App\Models\GoogleAdsCampaignData;
use App\Models\GoogleAdsGroup;
use App\Models\GoogleAdsGroupData;
use App\Models\GoogleAnalyticsAccount;
use App\Models\GoogleAnalyticsProperty;
use App\Models\GoogleAnalyticsPropertyData;
use App\Models\Page;
use App\Models\PageData;
use App\Models\PageFollower;
use App\Models\PageLike;
use App\Models\Post;
use App\Models\Seo;
use App\Models\SocialAccount;
use App\Models\SocialAccountData;
use App\Models\Tweet;
use App\Models\TweetData;
use App\Traits\DatePick;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PdfController extends Controller
{
    use DatePick;

    public function genPdf(Request $request, string $template, string $dashboardId)
    {
        try {


            $get_locale = NULL;

            if( null !== session()->get('locale') ):
                if(session()->get('locale') == 'en'):
                    $get_locale = 'en';
                    else:
                    $get_locale = 'ar';
                endif;
            endif;

            

            $this->PickDate($request->get('date1'), $request->get('date2'));
            $date_from = $this->date_from;
            $date_to = $this->date_to;
            $url = url('/pdf/' . $template . '/' . $dashboardId.'?lang='.$get_locale);
            $doc_name = $template . '_' . $date_from . '_' . $date_to;

            if ($request->get('date1') && $request->get('date2')) {
                $url = url('/pdf/' . $template . '/' . $dashboardId . '?date1=' . $date_from . '&lang='.$get_locale.'&date2=' . $date_to);
            }

            if ($request->get('account')) {
                $doc_name = $request->get('account') . '_' . $template . '_' . $date_from . '_' . $date_to;
            }
            $doc_name = str_replace([' ', '/', '-'], '_', $doc_name);
            // dd($url);
            return response()->streamDownload(function () use ($template, $dashboardId, $url) {
                $r = Http::withHeaders([
                    'accept' => 'application/pdf',
                    'content-type' => 'application/json',
                    'X-RapidAPI-Host' => 'url-html-to-pdf.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'edba4f62femsh3613dadeb443ad3p14a3b7jsn5b7c0336c4b4'
                ])->post('https://url-html-to-pdf.p.rapidapi.com/api/v1/pdf/url-to-pdf', [
                    'url' => $url,
                ]);

                echo $r->body();
            }, $doc_name . '.pdf', ['content-type' => 'application/pdf',]);

        } catch (Exception $ex) {
            echo $ex;
        }
    }


    public function index(Request $request, $template, $dashboardId)
    {
        switch ($template) {
            case 'facebook-overview':
                return $this->facebookPageOverview($dashboardId, $request->get('date1'), $request->get('date2'), 'd');
            case 'facebook-engagement':
                return $this->facebookPageEngagement($dashboardId, $request->get('date1'), $request->get('date2'));
            case 'twitter-overview':
                return $this->twitterOverview($dashboardId, $request->get('date1'), $request->get('date2'));
            case 'instagram-overview':
                return $this->instagramOverview($dashboardId, $request->get('date1'), $request->get('date2'));
            case 'facebook-ads-overview':
                return $this->facebookAdsOverview($dashboardId, $request->get('date1'), $request->get('date2'));
            case 'google-ads-overview':
                return $this->googleAdsOverview($dashboardId, $request->get('date1'), $request->get('date2'));
            case 'google-analytics-overview':
                return $this->googleAnalyticsPropertyOverview($dashboardId, $request->get('date1'), $request->get('date2'));
        }
    }

    public function googleAnalyticsPropertyOverview($dashboardId, $date1, $date2)
    {
        $this->PickDate($date1, $date2);
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        $dashboard = Dashboard::where('id', $dashboardId)
            ->where('name', 'google-analytics-overview')
            ->first();

        $googleAnalyticsAccounts = GoogleAnalyticsAccount::where('social_account_id', $dashboard->social_account_id);
        $gaAccountsIDs = $googleAnalyticsAccounts->pluck('id')->toArray();
        $page = GoogleAnalyticsProperty::findOrFail($dashboard->page_id);
        $pages = GoogleAnalyticsProperty::whereIn('google_analytics_account_id', $gaAccountsIDs)->where('id', '!=', $page->id)->get();

        $connect_name = $page?->name;
        $template_name = 'google-analytics-overview';
        $dashId = $dashboard->getKey();

        $sessionsTotal = GoogleAnalyticsPropertyData::where('property_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->avg('sessions_per_user');
        $activeUsers = round(GoogleAnalyticsPropertyData::where('property_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('active_users'));
        $newUsersPerDay = DB::table('ga_property_returning_vs_new_user_per_day')
            ->where('property_id', $page->id)
            ->where('type', 'new')
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->orderBy('date', 'desc')
            ->limit(20)
            ->pluck('number');

        $returningUsersPerDay = DB::table('ga_property_returning_vs_new_user_per_day')
            ->where('property_id', $page->id)
            ->where('type', 'returning')
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->orderBy('date', 'desc')
            ->limit(20)
            ->pluck('number');

        $usersDates = DB::table('ga_property_returning_vs_new_user_per_day')
            ->whereIn('type', ['new'])
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->orderBy('date', 'desc')
            ->limit(20)
            ->pluck('date');

        $averageTimeOnPage = round(GoogleAnalyticsPropertyData::where('property_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->avg('average_session_duration'));
        $pageViewsPerSession = round(GoogleAnalyticsPropertyData::where('property_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('screen_page_views_per_session'));

        $mostPopularPages = DB::table('ga_property_page_views_by_page_path')
            ->where('property_id', $page->id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->groupBy('page_path')
            ->selectRaw('page_path, sum(views) as views')
            ->orderByDesc('views')
            ->limit(8)
            ->get()
            ->toArray();

        $countriesSessions = DB::table('ga_property_data_by_country')
            ->where('property_id', $page->id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->groupBy('country')
            ->selectRaw('country, sum(sessions) as sessions')
            ->orderByDesc('sessions')
            ->limit(8)
            ->get()
            ->toArray();

        $colorsList = ["#FF9A41", "#F9C292", "#356792", "#16CE89", "#153A5A", "#356792", "#cfcfcf", "#232323"];

        // DEVICE SESSIONS //
        $deviceSessions = DB::table('ga_property_sessions_by_device')
            ->where('property_id', $page->id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->groupBy('device')
            ->selectRaw('device, sum(value) as sessions')
            ->orderByDesc('sessions')
            ->limit(8)
            ->get();
        $allSessions = array_sum(array_column($deviceSessions->toArray(), 'sessions'));
        $deviceSessions->each(function ($device) use ($allSessions) {
            $device->percentage = round($device->sessions * 100 / $allSessions, 2);
        });
        $devicesList = array_column($deviceSessions->toArray(), 'device');
        $devicesPercentageList = array_column($deviceSessions->toArray(), 'percentage');

        // CONVERSIONS BY COUNTRY //
        $countryConversions = DB::table('ga_property_data_by_country')
            ->where('property_id', $page->id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->groupBy('country')
            ->selectRaw('country, sum(conversions) as conversions')
            ->orderByDesc('conversions')
            ->limit(8)
            ->get();
        $allConversions = array_sum(array_column($countryConversions->toArray(), 'conversions'));
        $countryConversions->each(function ($item) use ($allConversions) {
            $item->percentage = round($item->conversions * 100 / $allConversions, 2);
        });
        $countryList = array_column($countryConversions->toArray(), 'country');
        $countryPercentageList = array_column($countryConversions->toArray(), 'percentage');


        $channelsUsers = DB::table('ga_property_sessions_by_channel')
            ->where('property_id', $page->id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->groupBy('channel')
            ->selectRaw('channel, sum(total_users) as total_users')
            ->orderByDesc('total_users')
            ->limit(8)
            ->get();
        $allChannelsUsers = array_sum(array_column($channelsUsers->toArray(), 'total_users'));
        $channelsUsers->each(function ($channel) use ($allChannelsUsers) {
            $channel->percentage = round($channel->total_users * 100 / $allChannelsUsers, 2);
        });
        $channelsList = array_column($channelsUsers->toArray(), 'channel');
        $channelsPercentageList = array_column($deviceSessions->toArray(), 'percentage');


        $sources = DB::table('ga_property_data_by_source')
            ->where('property_id', $page->id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->groupBy('source')
            ->selectRaw('source, sum(sessions) as sessions, sum(users) as users, sum(new_users) as new_users, sum(conversions) as conversions')
            ->orderByDesc('users')
            ->limit(8)
            ->get();


        $mostPopularPageTitles = DB::table('ga_property_page_views_by_page_title')
            ->where('property_id', $page->id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->groupBy('page_title')
            ->selectRaw('page_title, sum(views) as views, sum(sessions) as sessions')
            ->orderByDesc('views')
            ->limit(8)
            ->get()
            ->toArray();


        $propertyData = DB::table('google_analytics_property_data')
            ->where('property_id', $page->id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->selectRaw('sum(total_users) as total_users, avg(engagement_rate) as engagement_rate, sum(user_engagement_duration) as user_engagement_duration')
            ->first();

        $totalUsers = $propertyData->total_users;
        $engagementRate = round($propertyData->engagement_rate, 2);
        $userEngagement = CarbonInterval::seconds($propertyData->user_engagement_duration)->cascade()->forHumans(null, true);

        $conversionsPerDay = DB::table('google_analytics_property_data')
            ->where('property_id', $page->id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->orderBy('date', 'desc')
            ->limit(20)
            ->pluck('conversions');

        $conversionsDates = DB::table('google_analytics_property_data')
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->orderBy('date', 'desc')
            ->limit(20)
            ->pluck('date');

        return view('tenant.pdf', compact([
            'connect_name',
            'template_name',
            'page',
            'pages',
            'newUsersPerDay', 'returningUsersPerDay', 'usersDates',
            'sessionsTotal',
            'activeUsers',
            'engagementRate',
            'averageTimeOnPage',
            'pageViewsPerSession',
            'userEngagement',
            'mostPopularPages',
            'countriesSessions',
            'colorsList',
            'allSessions', 'deviceSessions', 'devicesList', 'devicesPercentageList',
            'allConversions', 'countryConversions', 'countryList', 'countryPercentageList',
            'allChannelsUsers', 'channelsUsers', 'channelsList', 'channelsPercentageList',
            'mostPopularPageTitles',
            'sources',
            'dashId',
            'date_to', 'date_from',
            'totalUsers',
            'conversionsPerDay', 'conversionsDates'
        ]));
    }

    public function facebookPageOverview($dashboardId, $date1, $date2, $str)
    {
        $this->PickDate($date1, $date2);
        $date_from = $this->date_from;
        $date_to = $this->date_to;

        $dashboard = Dashboard::where('id', $dashboardId)
            ->where('name', 'facebook-overview')
            ->first();
        $page = Page::where('social_account_id', $dashboard->social_account_id)->where('id', $dashboard->page_id)->first();
        $page_data = PageData::where('page_id', $page->id)->first();
        //like graph
        $like_per_day = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->limit(20)->pluck('likes');
        $unlike_per_day = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->limit(20)->pluck('unlikes');
        $likeDate = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->orderBy('date', 'desc')->limit(20)->pluck('date');
        //total likes
        // $total_likes = PageLike::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('likes');
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
            ->select(DB::raw('SUM(reach) as total_reach'), 'city')
            ->groupBy('city')
            ->orderBy('total_reach', 'desc')
            ->take(10)
            ->get();

        $connect_name = $page?->name;
        $template_name = 'facebook-overview';

        return view('tenant.p' . $str . 'f', compact(['connect_name', 'template_name', 'page', 'like_per_day', 'unlike_per_day', 'likeDate',
            'page_data', 'date_created_post_array', 'posts_created_per_day', 'posts_engaged_per_day', 'ads_likes',
            'posts_average_likes', 'posts_average_comments', 'posts_average_shares', 'total_likes', 'news_feed_likes',
            'unique_post_impression', 'unique_page_impression', 'unique_post_impression_paid', 'unique_post_impression_organic',
            'unique_post_impression_viral', 'unique_page_impression_paid', 'unique_page_impression_organic',
            'unique_page_impression_viral', 'unique_page_impression_noviral', 'page_impression', 'page_clicks',
            'page_impression_paid', 'page_impression_organic', 'page_engagement', 'post_reach_by_fans', 'page_engagement_per_day',
            'page_engagement_per_day_date', 'page_top_time_post', 'page_top_day_post', 'date_to', 'date_from', 'cta_data'
        ]));
    }

    public function facebookPageEngagement($dashboardId, $date1, $date2)
    {
        $this->PickDate($date1, $date2);
        $date_from = $this->date_from;
        $date_to = $this->date_to;

        $dashboard = Dashboard::where('id', $dashboardId)
            ->where('name', 'facebook-engagement')
            ->first();

        $page = Page::where('social_account_id', $dashboard->social_account_id)->where('id', $dashboard->page_id)->first();
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
        if (count($date_created_post_array) > 0) {
            foreach ($date_created_post_array as $date) {
                $posts_created_per_day[] = Post::where('page_id', $page->id)->where('created_date', $date)->count();
            }
        } else {
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
            ->select(DB::raw('SUM(reach) as total_reach'), 'city')
            ->groupBy('city')
            ->orderBy('total_reach', 'desc')
            ->take(10)
            ->get();
        $template_name = 'facebook-engagement';

        return view('tenant.pdf', compact(['template_name', 'connect_name', 'page', 'impression_per_day', 'reach_per_day', 'impressionDate',
            'page_data', 'date_created_post_array', 'posts_created_per_day', 'posts_engaged_per_day', 'ads_likes',
            'posts_average_likes', 'posts_average_comments', 'posts_average_shares', 'total_likes', 'news_feed_likes',
            'unique_post_impression', 'unique_page_impression', 'unique_post_impression_paid', 'unique_post_impression_organic',
            'unique_post_impression_viral', 'unique_page_impression_paid', 'unique_page_impression_organic',
            'unique_page_impression_viral', 'unique_page_impression_noviral', 'page_impression', 'page_clicks',
            'page_impression_paid', 'page_impression_organic', 'page_engagement', 'post_reach_by_fans', 'page_engagement_per_day',
            'page_engagement_per_day_date', 'page_top_time_post', 'page_top_day_post', 'date_to', 'date_from', 'cta_data'
        ]));
    }

    public function twitterOverview($dashboardId, $date1, $date2)
    {
        $this->PickDate($date1, $date2);
        $date_from = $this->date_from;
        $date_to = $this->date_to;

        $dashboard = Dashboard::where('id', $dashboardId)
            ->where('name', 'twitter-overview')
            ->first();

        $twitter_social_account = SocialAccount::where('id', $dashboard->social_account_id)->where('provider_name', 'twitter')->first();
        $social_account_data_last = SocialAccountData::where('social_account_id', $twitter_social_account->id)
            ->where('date', '>=', $date_from)->where('date', '<=', $date_to)
            ->orderBy('date', 'desc')
            ->first();
        $total_followers = !empty($social_account_data_last->followers) ? $social_account_data_last->followers : 0;
        $total_tweets = !empty($social_account_data_last->total_tweets) ? $social_account_data_last->total_tweets : 0;
        $new_followers = SocialAccountData::select('new_followers')
            ->where('social_account_id', $twitter_social_account->id)
            ->where('date', '>=', $date_from)->where('date', '<=', $date_to)
            ->sum('new_followers');
        $user_tweets_id = Tweet::select('id')->where('social_account_id', $twitter_social_account->id)->pluck('id');
        $engagement = TweetData::select('new_engagement_count')->whereIn('id', $user_tweets_id)->sum('new_engagement_count');;
        $total_retweets = TweetData::select('new_retweet_count')->whereIn('id', $user_tweets_id)->sum('new_retweet_count');
        $total_favorites = TweetData::select('new_like_count')->whereIn('id', $user_tweets_id)->sum('new_like_count');
        $total_impressions = TweetData::select('new_impression_count')->whereIn('id', $user_tweets_id)->sum('new_impression_count');
        $engagement_rate = 0;
        if ($total_impressions !== 0) {
            $engagement_rate = $engagement / $total_impressions * 100;
        }
        $tweets = Tweet::where('social_account_id', $twitter_social_account->id)->where('created', '>=', $date_from)
            ->where('created', '<=', $date_to)
            ->get()->map(function ($item) use ($date_from, $date_to) {
                $item->favorites = TweetData::select('new_like_count')->where('id', $item->id)
                    ->where('date', '>=', $date_from)->where('date', '<=', $date_to)
                    ->sum('new_like_count');
                $item->retweet = TweetData::select('new_retweet_count')->where('id', $item->id)
                    ->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('new_retweet_count');
                $item->engagement = TweetData::select('new_engagement_count')->where('id', $item->id)
                    ->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('new_engagement_count');
                return $item;
            }
            );
        $new_followers_per_day = SocialAccountData::select('new_followers', 'date')
            ->where('social_account_id', $twitter_social_account->id)->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)->pluck('new_followers', 'date')->toArray();
        $connect_name = $twitter_social_account->full_name;
        $template_name = 'twitter-overview';

        return view('tenant.pdf', compact(['template_name', 'connect_name', 'total_followers',
            'new_followers', 'total_tweets', 'engagement', 'total_retweets', 'total_favorites', 'engagement_rate',
            'tweets', 'new_followers_per_day', 'date_from', 'date_to']));

    }

    public function instagramOverview($dashboardId, $date1, $date2)
    {
        $this->PickDate($date1, $date2);
        $date_from = $this->date_from;
        $date_to = $this->date_to;

//            $connections_list = SocialAccount::select('id', 'name')->where('provider_name', 'instagram')->where('user_id', Auth::id())->pluck('id', 'name');
        $dashboard = Dashboard::where('id', $dashboardId)
            ->where('name', 'instagram-overview')
            ->first();

        $page = Page::with(['post', 'data', 'follower'])->where('id', $dashboard->page_id)
            ->where('social_account_id', $dashboard->social_account_id)
            ->first();
        $page_impression = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_impressions');
        $posts = Post::where('page_id', $page->id)->get();
        $likes = Post::select('likes_count')->where('page_id', $page->id)->sum('likes_count');
        $followers_by_country = PageFollower::where('page_id', $page->id)->get();
        // $total_followers = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->sum('page_fans');
        $total_followers = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->max('total_followers');
        $dates = PageData::where('page_id', $page->id)->where('date', '>=', $date_from)->where('date', '<=', $date_to)->distinct()->orderBy('date', 'desc')->pluck('date');
        if ($dates->count() > 0) {
            $reach_per_day = PageData::where('page_id', $page->id)->whereIn('date', $dates)->orderBy('date', 'desc')->pluck('page_reach');
            $impression_per_day = PageData::where('page_id', $page->id)->whereIn('date', $dates)->orderBy('date', 'desc')->pluck('page_impressions');
            $new_followers_per_day = PageData::where('page_id', $page->id)->whereIn('date', $dates)->orderBy('date', 'desc')->pluck('page_fans');
        } else {
            $reach_per_day = [];
            $impression_per_day = [];
            $new_followers_per_day = [];
        }
        $connect_name = $page?->name;
        $template_name = 'instagram-overview';
        return view('tenant.pdf', compact(['likes', 'template_name', 'connect_name', 'page', 'page_impression', 'posts', 'followers_by_country',
            'dates', 'reach_per_day', 'impression_per_day', 'new_followers_per_day', 'total_followers', 'date_from', 'date_to']));
    }

    public function facebookAdsOverview($dashboardId, $date1, $date2)
    {
        $this->PickDate($date1, $date2);
        $date_from = $this->date_from;
        $date_to = $this->date_to;

        $dashboard = Dashboard::where('id', $dashboardId)
            ->where('name', 'facebook-ads-overview')
            ->first();

        $ads_account = AdsAccount::where('id', $dashboard->page_id)
            ->where('social_account_id', $dashboard->social_account_id)
            ->first();
        //dd($ads_account, $dashboard->page_id,  $dashboard->social_account_id);
        $ads_account_id = $ads_account->id;

        $pages = AdsAccount::where('social_account_id', $dashboard->social_account_id)->where('id', '!=', $ads_account_id)->get();

        $graph_data_click_vs_impression = AdsData::select('impressions', 'clicks', 'date')
            ->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->orderBy('date', 'desc')
            ->get()->toArray();
        $total_impression = AdsData::select('impressions')
            ->where('ads_account_id', $ads_account_id)->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->sum('impressions');
        $total_reach = AdsData::select('reach')->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->sum('reach');
        $total_inline_link_clicks = AdsData::select('inline_link_clicks')->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->sum('inline_link_clicks');
        $avg_ctr = AdsData::select('ctr')
            ->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->avg('ctr');
        $avg_ctr = round($avg_ctr, 2);
        $total_clicks = AdsData::select('clicks')
            ->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->sum('clicks');
        $cost_per_link = AdsData::select('cpc')
            ->where('ads_account_id', $ads_account_id)->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->avg('cpc');
        $cost_per_link = round($cost_per_link, 2);
        $avg_cpm = AdsData::select('cpm')
            ->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->avg('cpm');
        $avg_cpp = AdsData::select('cpp')
            ->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)->where('date', '<=', $date_to)
            ->avg('cpp');
        $avg_cpc = AdsData::select('cpp')
            ->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)->where('date', '<=', $date_to)
            ->avg('cpc');
        $avg_cpc = round($avg_cpc, 2);
        $total_spend = AdsData::select('spend')
            ->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->sum('spend');
        $graph_data_spend_vs_revenue = AdsData::select('spend', 'converted_product_value', 'date')
            ->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->orderBy('date', 'desc')
            ->get()->toArray();
        $graph_advertising_spend = AdsData::select('converted_product_value', 'date')
            ->where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->orderBy('date', 'desc')
            ->pluck('converted_product_value', 'date')
            ->toArray();
        $ads_campaign = AdsData::where('ads_account_id', $ads_account_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->select(
                DB::raw('SUM(impressions) as total_impressions'),
                DB::raw('SUM(clicks) as total_clicks'),
                DB::raw('SUM(cpc) as total_cpc'),
                DB::raw('SUM(ctr) as total_ctr'),
                DB::raw('SUM(spend) as total_spend'),
                'campaign_id', 'campaign_name')
            ->groupBy('campaign_id', 'campaign_name')
            ->orderBy('campaign_name')
            ->get();
        $posts = Post::where('ads_account_id', $ads_account_id)->get();
        $connect_name = $ads_account->name;
        $template_name = 'facebook-ads-overview';
        return view('tenant.pdf', compact(['template_name', 'connect_name', 'total_inline_link_clicks',
            'graph_data_click_vs_impression', 'total_impression', 'total_reach', 'avg_ctr', 'total_clicks',
            'cost_per_link', 'avg_cpm', 'avg_cpp', 'total_spend', 'graph_data_spend_vs_revenue',
            'graph_advertising_spend', 'ads_campaign', 'posts', 'avg_cpc', 'date_from', 'date_to', 'pages']));
    }

    public function googleAdsOverview($dashboardId, $date1, $date2)
    {
        $this->PickDate($date1, $date2);
        $date_from = $this->date_from;
        $date_to = $this->date_to;

        $dashboard = Dashboard::where('id', $dashboardId)
            ->where('name', 'google-ads-overview')
            ->first();

        $google_ads_account = GoogleAdsAccount::findOrFail($dashboard->page_id);
        $pages = GoogleAdsAccount::where('social_account_id', $dashboard->social_account_id)->where('id', '!=', $google_ads_account->id)->get();
        $page = $google_ads_account;

        $impressions_per_day = GoogleAdsAccountData::select('impressions', 'date')
            ->where('google_ads_account_id', $google_ads_account->id)
            ->whereBetween('date', [$date_from, $date_to])
            ->distinct('date')
            ->orderBy('date', 'desc')
            ->pluck('impressions', 'date');

        $clicks_per_day = GoogleAdsAccountData::select('clicks', 'date')
            ->where('google_ads_account_id', $google_ads_account->id)
            ->whereBetween('date', [$date_from, $date_to])
            ->distinct('date')
            ->orderBy('date', 'desc')
            ->pluck('clicks', 'date');

        $data = GoogleAdsAccountData::where('google_ads_account_id', $google_ads_account->id)
            ->whereBetween('date', [$date_from, $date_to])
            ->selectRaw('sum(impressions) as impressions, sum(ctr) as ctr, sum(clicks) as clicks, sum(conversions) as conversions')
            ->get();

        $data = $data[0];

        $campaigns = GoogleAdsCampaign::where('google_ads_account_id', $google_ads_account->id)->pluck('id');

        $campaign_data = GoogleAdsCampaignData::whereIn('google_ads_campaign_id', $campaigns)
            ->whereBetween('date', [$date_from, $date_to])
            ->leftJoin('google_ads_campaigns', 'google_ads_campaign_data.google_ads_campaign_id', '=', 'google_ads_campaigns.id')
            ->groupBy('google_ads_campaign_id')
            ->selectRaw('google_ads_campaigns.name, google_ads_campaigns.device, google_ads_campaigns.network_type, '
                . 'sum(clicks) as clicks, sum(impressions) as impressions, sum(ctr) as ctr, sum(cost) as cost, '
                . 'sum(conversions) as conversions')
            ->orderByDesc('clicks')
            ->limit(5)
            ->get();

        $groups = GoogleAdsGroup::where('google_ads_account_id', $google_ads_account->id)->pluck('id');

        $group_data = GoogleAdsGroupData::whereIn('google_ads_group_id', $groups)
            ->whereBetween('date', [$date_from, $date_to])
            ->leftJoin('google_ads_groups', 'google_ads_group_data.google_ads_group_id', '=', 'google_ads_groups.id')
            ->groupBy('google_ads_group_id')
            ->selectRaw('google_ads_groups.base_ad_group, google_ads_groups.campaign_resource_name, google_ads_groups.device, google_ads_groups.network_type, '
                . 'sum(clicks) as clicks, sum(impressions) as impressions, sum(ctr) as ctr, sum(cost) as cost, '
                . 'sum(conversions) as conversions')
            ->orderByDesc('clicks')
            ->limit(5)
            ->get();

        $connect_name = $google_ads_account->name != "" || $google_ads_account->name != null ? $google_ads_account->name : $google_ads_account->provider_id;
        $template_name = 'google-ads-overview';
        $dashId = $dashboard->getKey();

        return view('tenant.pdf', compact(['dashId', 'template_name', 'connect_name', 'group_data',
            'campaign_data', 'data', 'clicks_per_day', 'impressions_per_day', 'page', 'pages',
            'dashboard', 'date_to', 'date_from', 'google_ads_account']));

    }
}
