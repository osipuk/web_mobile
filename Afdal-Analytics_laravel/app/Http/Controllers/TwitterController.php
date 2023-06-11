<?php

namespace App\Http\Controllers;

use App\Classes\Activity;
use App\Events\SocialAccountConnectedEvent;
use App\Classes\IntercomAPI;
use App\Http\Controllers\ActiveCampaitngController;
use App\Models\Dashboard;
use App\Models\Seo;
use App\Models\SocialAccount;
use App\Models\SocialAccountData;
use App\Models\Tweet;
use App\Models\TweetData;
use App\Traits\DatePick;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\One\TwitterProvider;
use Laravel\Socialite\Two\FacebookProvider;
use App\Models\User;
use App\Models\Tenant;
use App\Models\TenantTwitterDetail;
use App\Models\TwitterFollowerDetail;
use App\Models\TwitterPublicMetricesDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Twitter;
use Cookie;
use Symfony\Component\HttpFoundation\File\File;
use Abraham\TwitterOAuth\TwitterOAuth;
use GenderDetector\Gender;
use App\Classes\TwitterApi;

class TwitterController extends Controller
{
    use DatePick;
    /**
     * Where to redirect users after login.
     *
     * @var string
    */
   // protected $redirectTo = '/home';

    /**
     * Call the view
    */
    public function index()
    {
        return view('tenant/login');
    }

    public function twitterLogin(Request $request){
        return Socialite::driver('twitter')->redirect();
    }




    public function twittercustom(Request $request)
    {
        $provider = "twitter";
        $oauth_token = '1437634956319248387-dgLN7Xsnb3egDQqk22pY02OAn9w5So';
        $oauth_verifier = 'bLagjrmOQNxZZjW2S0cGqjo4NqamRALfJs0CqhSXg032P';

        $api = new TwitterApi($request->token, $request->vtoken);

        $userMetric = $api->getUserMetrics($request->uid);
        $twitterUser = $api->getUser();

            dd($twitterUser, $userMetric);

        $status = 'empty';
        $company_id = 155;
        try {
            $tokens = $this->access_token($oauth_token, $oauth_verifier);
            $user = Socialite::driver('twitter')->userFromTokenAndSecret($tokens->oauth_token, $tokens->oauth_token_secret);
            $connection = new TwitterOAuth(env('TWITTER_API_KEY'), env('TWITTER_API_SECRET_KEY'),$tokens->oauth_token, $tokens->oauth_token_secret);
            $connection->setApiVersion('2');
            $user_metric = $connection->get('users/' . $user->id, ["user.fields" => 'public_metrics']);

            dd($user_metric);

            $is_connect = SocialAccount::where('provider_name', 'twitter')->where('provider_id', $user->id)->where('company_id', $company_id)->first();
            if($is_connect){
                $status = 'error_account_connected';
            }else{
                $social_account = SocialAccount::updateOrCreate(
                    [
                        'provider_name' => 'twitter',
                        'provider_id'   => $user->id,
                        'company_id' => $company_id,
                    ],
                    [
                        'company_id' => $company_id,
                        'provider_name' => 'twitter',
                        'provider_id'   => $user->id,
                        'full_name'     => $user->name,
                        'email'         => !empty($user->email) ? $user->email : '',
                        'avatar'        => $user->avatar,
                        'token'         => $user->token,
                        'refresh_token' => $user->tokenSecret,
                        'expires_at'    => Carbon::now()->addDay(59),
                    ]
                );
                DB::table('company_social_account')->updateOrInsert(
                    ['company_id' => $company_id, 'social_account_id' => $social_account->id],
                    ['company_id' => $company_id, 'social_account_id' => $social_account->id]
                );

                $activity = new Activity();
                $activity->addActivity('add_connection', __('Twitter') . ' ' . $user->name);
                SocialAccountConnectedEvent::dispatch(Auth::user(), "Twitter", $user->name??'', $user->email??'');

                Dashboard::firstOrCreate([
                    'company_id' => Auth::user()->company_id,
                    'name' => 'twitter-overview',
                ],[
                    'name' => 'twitter-overview',
                    'social_account_id' => $social_account->id,
                    'company_id' => Auth::user()->company_id,
//                    'page_id' => $new_page->id,
                ]);

                SocialAccountData::create([
                    'social_account_id' => $social_account->id,
                    'followers' => !empty($user_metric->data->public_metrics->followers_count) ? $user_metric->data->public_metrics->followers_count : null,
                    'total_tweets' => !empty($user_metric->data->public_metrics->tweet_count) ? $user_metric->data->public_metrics->tweet_count : null,
                    'date' => Carbon::now()->format('Y-m-d')
                ]);
                $tweets_created_last_30_days = $connection->get('users/' . $user->id . '/tweets', ['start_time' => Carbon::now()->subDays(30)->format(\DateTime::RFC3339), 'end_time'=> Carbon::now()->format(\DateTime::RFC3339)]);
                if(!empty($tweets_created_last_30_days->meta->result_count) && $tweets_created_last_30_days->meta->result_count > 0){
                    foreach ($tweets_created_last_30_days->data as $tweet){
                        $tweet_data = $connection->get('tweets/' . $tweet->id,  ["tweet.fields" => "public_metrics,organic_metrics,created_at"]);
                        $new_tweet = Tweet::create([
                            'tweet_id' => !empty($tweet_data->data->id) ? $tweet_data->data->id : null,
                            'text' => !empty($tweet_data->data->text) ? $tweet_data->data->text : null,
                            'created' => !empty($tweet_data->data->created_at) ? date("Y-m-d", strtotime($tweet_data->data->created_at)) : null,
                            'social_account_id' => $social_account->id,
                        ]);
                        TweetData::create([
                            'tweet_id' => $new_tweet->id,
                            'reply_count' => !empty($tweet_data->data->organic_metrics->reply_count) ? $tweet_data->data->organic_metrics->reply_count : 0,
                            'impression_count' => !empty($tweet_data->data->organic_metrics->impression_count) ? $tweet_data->data->organic_metrics->impression_count : 0,
                            'user_profile_clicks' => !empty($tweet_data->data->organic_metrics->user_profile_clicks) ? $tweet_data->data->organic_metrics->user_profile_clicks : 0,
                            'like_count' => !empty($tweet_data->data->organic_metrics->like_count) ? $tweet_data->data->organic_metrics->like_count : 0,
                            'retweet_count' => !empty($tweet_data->data->organic_metrics->retweet_count) ? $tweet_data->data->organic_metrics->retweet_count : 0,
                            'quote_count' => !empty($tweet_data->data->public_metrics->quote_count) ? $tweet_data->data->public_metrics->quote_count : 0,
                            'date' => Carbon::now()->format('Y-m-d')
                        ]);
                    }
                }
                $status = 'success';

                $connection = 'twitter';
                $intercom = new IntercomAPI();
                $intercom->addConnection('Twitter');
                $ActiveCampaitng = new ActiveCampaitngController();
                $ActiveCampaitng->EventTrackingCreation('Twitter');
                $ActiveCampaitng->EventTrackingAPI('Twitter','','');
        
                // $intercom->EventTrackingAPI('Twitter','abc');
            }
            $connection = 'twitter';
            return view('tenant.custom-sdk', compact('status', 'connection'));
        }catch (RequestException $e) {
            $status = 'error';
            $connection = 'twitter';
            return view('tenant.custom-sdk', compact('status', 'connection'));
        }
    }





    public function handleProviderCallback(Request $request)
    {
        $provider = "twitter";
        $oauth_token = $_GET['oauth_token'];
        $oauth_verifier = $_GET['oauth_verifier'];
        $status = 'empty';
        $company_id = Auth::user()->company->id;
        try {
            $tokens = $this->access_token($oauth_token, $oauth_verifier);
            $user = Socialite::driver('twitter')->userFromTokenAndSecret($tokens->oauth_token, $tokens->oauth_token_secret);
            $connection = new TwitterOAuth(env('TWITTER_API_KEY'), env('TWITTER_API_SECRET_KEY'),$tokens->oauth_token, $tokens->oauth_token_secret);
            $connection->setApiVersion('2');
            $user_metric = $connection->get('users/' . $user->id, ["user.fields" => 'public_metrics']);

            $is_connect = SocialAccount::where('provider_name', 'twitter')->where('provider_id', $user->id)->where('company_id', $company_id)->first();
            if($is_connect){
                $status = 'error_account_connected';
            }else{
                $social_account = SocialAccount::updateOrCreate(
                    [
                        'provider_name' => 'twitter',
                        'provider_id'   => $user->id,
                        'company_id' => $company_id,
                    ],
                    [
                        'company_id' => $company_id,
                        'provider_name' => 'twitter',
                        'provider_id'   => $user->id,
                        'full_name'     => $user->name,
                        'email'         => !empty($user->email) ? $user->email : '',
                        'avatar'        => $user->avatar,
                        'token'         => $user->token,
                        'refresh_token' => $user->tokenSecret,
                        'expires_at'    => Carbon::now()->addDay(59),
                    ]
                );
                DB::table('company_social_account')->updateOrInsert(
                    ['company_id' => $company_id, 'social_account_id' => $social_account->id],
                    ['company_id' => $company_id, 'social_account_id' => $social_account->id]
                );

                $activity = new Activity();
                $activity->addActivity('add_connection', __('Twitter') . ' ' . $user->name);
                SocialAccountConnectedEvent::dispatch(Auth::user(), "Twitter", $user->name??'', $user->email??'');

                Dashboard::firstOrCreate([
                    'company_id' => Auth::user()->company_id,
                    'name' => 'twitter-overview',
                ],[
                    'name' => 'twitter-overview',
                    'social_account_id' => $social_account->id,
                    'company_id' => Auth::user()->company_id,
//                    'page_id' => $new_page->id,
                ]);

                SocialAccountData::create([
                    'social_account_id' => $social_account->id,
                    'followers' => !empty($user_metric->data->public_metrics->followers_count) ? $user_metric->data->public_metrics->followers_count : null,
                    'total_tweets' => !empty($user_metric->data->public_metrics->tweet_count) ? $user_metric->data->public_metrics->tweet_count : null,
                    'date' => Carbon::now()->format('Y-m-d')
                ]);
                $tweets_created_last_30_days = $connection->get('users/' . $user->id . '/tweets', ['start_time' => Carbon::now()->subDays(30)->format(\DateTime::RFC3339), 'end_time'=> Carbon::now()->format(\DateTime::RFC3339)]);
                if(!empty($tweets_created_last_30_days->meta->result_count) && $tweets_created_last_30_days->meta->result_count > 0){
                    foreach ($tweets_created_last_30_days->data as $tweet){
                        $tweet_data = $connection->get('tweets/' . $tweet->id,  ["tweet.fields" => "public_metrics,organic_metrics,created_at"]);
                        $new_tweet = Tweet::create([
                            'tweet_id' => !empty($tweet_data->data->id) ? $tweet_data->data->id : null,
                            'text' => !empty($tweet_data->data->text) ? $tweet_data->data->text : null,
                            'created' => !empty($tweet_data->data->created_at) ? date("Y-m-d", strtotime($tweet_data->data->created_at)) : null,
                            'social_account_id' => $social_account->id,
                        ]);
                        TweetData::create([
                            'tweet_id' => $new_tweet->id,
                            'reply_count' => !empty($tweet_data->data->organic_metrics->reply_count) ? $tweet_data->data->organic_metrics->reply_count : 0,
                            'impression_count' => !empty($tweet_data->data->organic_metrics->impression_count) ? $tweet_data->data->organic_metrics->impression_count : 0,
                            'user_profile_clicks' => !empty($tweet_data->data->organic_metrics->user_profile_clicks) ? $tweet_data->data->organic_metrics->user_profile_clicks : 0,
                            'like_count' => !empty($tweet_data->data->organic_metrics->like_count) ? $tweet_data->data->organic_metrics->like_count : 0,
                            'retweet_count' => !empty($tweet_data->data->organic_metrics->retweet_count) ? $tweet_data->data->organic_metrics->retweet_count : 0,
                            'quote_count' => !empty($tweet_data->data->public_metrics->quote_count) ? $tweet_data->data->public_metrics->quote_count : 0,
                            'date' => Carbon::now()->format('Y-m-d')
                        ]);
                    }
                }
                $status = 'success';

                $connection = 'twitter';
                $intercom = new IntercomAPI();
                $intercom->addConnection('Twitter');
                $ActiveCampaitng = new ActiveCampaitngController();
                $ActiveCampaitng->EventTrackingCreation('Twitter');
                $ActiveCampaitng->EventTrackingAPI('Twitter','','');
        
                // $intercom->EventTrackingAPI('Twitter','abc');
            }
            $connection = 'twitter';
            return view('tenant.custom-sdk', compact('status', 'connection'));
        }catch (RequestException $e) {
            $status = 'error';
            $connection = 'twitter';
            return view('tenant.custom-sdk', compact('status', 'connection'));
        }
    }

    private function access_token($oauth_token, $oauth_verifier)
    {

        $config = config('services')['twitter'];

        $connection = new TwitterOAuth($config['client_id'], $config['client_secret']);

        $tokens = $connection->oauth("oauth/access_token", ["oauth_verifier" => $oauth_verifier, "oauth_token" => $oauth_token]);

        return (object) $tokens;
    }

    public function twitterOverview(Request $request){
        if (Auth::user()->company->dashboard->where('name','twitter-overview')->isNotEmpty()) {
            $this->PickDate($request->get('date_from'), $request->get('date_to'));
            $date_from = $this->date_from;
            $date_to = $this->date_to;

            $dashboard = Dashboard::where('company_id', Auth::user()->company_id)
                ->where('name', 'twitter-overview')
                ->first();

            $social_accounts = Auth::user()->company->social_account_twitter->where('id', '!=', $dashboard->social_account_id);

            $twitter_social_account = SocialAccount::where('id', $dashboard->social_account_id)->where('provider_name', 'twitter')->first();
            $social_account_data_last = SocialAccountData::where('social_account_id', $twitter_social_account->id)
                ->whereBetween('date', [$date_from, $date_to])
                ->orderBy('date', 'desc')
                ->first();
            $total_followers = !empty($social_account_data_last?->followers) ? $social_account_data_last->followers : 0;
            $total_tweets = !empty( $social_account_data_last?->total_tweets) ?  $social_account_data_last->total_tweets : 0;
            $new_followers = SocialAccountData::select('new_followers')
                ->where('social_account_id', $twitter_social_account?->id)
                ->whereBetween('date', [$date_from, $date_to])
                ->sum('new_followers');

            $user_tweets_id = Tweet::where('social_account_id', $twitter_social_account?->id)->pluck('id');

            $account_data = TweetData::whereIn('id', $user_tweets_id)
                ->whereBetween('date', [$date_from, $date_to])
                ->groupBy('date')->select(
                DB::raw('SUM(engagement_count) as engagement'),
                DB::raw('SUM(retweet_count) as total_retweets'),
                DB::raw('SUM(like_count) as total_favorites'),
                DB::raw('SUM(impression_count) as total_impressions'),
                DB::raw('SUM(quote_count) as total_quotes'),
                DB::raw('SUM(reply_count) as total_replies'),
            )->orderBy('date')->first();






//
            $engagement = $account_data?->engagement;
            $total_retweets =  $account_data?->total_retweets;
            $total_favorites =  $account_data?->total_favorites;
            $total_impressions =  $account_data?->total_impressions;
            $total_quotes =  $account_data?->total_quotes;
            $total_replies =  $account_data?->total_replies;

            $engagement_rate = 0;
            $engagement_rate = ($total_favorites+$total_retweets+$total_quotes+$total_replies);
            $engagement_rate = ($engagement_rate/$total_tweets);
            //$engagement_rate = ($engagement_rate/$total_followers);

            if($total_followers != 0){    
                $engagement_rate = $engagement_rate / $total_followers;  
            }else{     
                $engagement_rate = 0;
            }

            $engagement_rate = ($engagement_rate*100);
            $engagement_rate = number_format((float)$engagement_rate, 2, '.', '');

//dd($total_favorites, $total_retweets, $total_quotes, $total_replies, $total_tweets, $total_followers);
           /* $engagement_rate = 0;
            if ($total_impressions){
                $engagement_rate = $engagement/$total_impressions*100;
            }*/

            $new_followers_per_day = SocialAccountData::select('new_followers', 'date')
                ->where('social_account_id', $twitter_social_account?->id)
                ->whereBetween('date', [$date_from, $date_to])
                ->pluck('new_followers', 'date')
                ->toArray();

            $tweets = Tweet::where('social_account_id', $twitter_social_account?->id)->where('created', '>=', $date_from)
                ->where('created', '<=', $date_to)
                ->get()->map(function ($item) use ($date_from, $date_to){
                    $last_tweet_data = TweetData::where('tweet_id', $item->id)
                        ->whereBetween('date', [$date_from, $date_to])
                        ->orderBy('date', 'desc')
                        ->first();
                    $item->favorites = !empty($last_tweet_data->like_count) ? $last_tweet_data->like_count : 0;
                    $item->retweet = !empty($last_tweet_data->retweet_count) ? $last_tweet_data->retweet_count : 0;
                    $item->engagement = !empty($last_tweet_data->engagement_count) ? $last_tweet_data->engagement_count : 0;
                return $item;
                }
            );

            $connect_name = $twitter_social_account->full_name;
            $template_name = 'twitter-overview';
            $dashId = $dashboard->getKey();

            $seo = Seo::where('route', $request->getRequestUri())->first();

            if(!empty($dashboard)) {
                $user = Auth::user();
                $user->last_visited_dashboard = 'twitter-overview';
                $user->save();
            }

            return view('tenant.home_screen', compact(['template_name','connect_name','total_followers',
                'new_followers', 'total_tweets', 'engagement', 'total_retweets', 'total_favorites', 'engagement_rate',
                'tweets', 'new_followers_per_day', 'date_from', 'date_to', 'social_accounts', 'seo', 'dashId']));
        }else {
            return view('tenant.home_screen');
        }

    }


//    public function twitterperformance(Request $request){
//        $publicmetricdata = [];
//        $metricesdetails = [];
//
//        if (Auth::user() && Auth::user()->social_account_twitter->count() != 0) {
//            $twitter_account = Auth::user()->social_account_twitter->last();
//            $twitter_user_id = $twitter_account->provider_id;
//            $followerdetails = $this->userTwitterFollowerDetails($twitter_user_id);
//            $followerslist = json_decode($followerdetails);
//            $totalfollowers = $followerslist->meta->result_count;
//            $tweetsdetails = $this->fetchUserTotalTweets($twitter_user_id);
//            $tweetslist = json_decode($tweetsdetails);
//            $totaltweets = $tweetslist->meta->result_count;
//            $fetchfavourites = $this->fetchUserLikedTweets($twitter_user_id);
//            $favouriteslist = json_decode($fetchfavourites);
//            $favourites_count = $favouriteslist->meta->result_count;
//            $engagementdata = $this->getTwitterEngagementData();
//
//            $details = [
//                'tenant_twitter_id' => session()->get('twitter_id'),
//                'twitter_name' => session()->get('twittername'),
//                'twitter_nickname' => session()->get('nickname'),
//                'avatar' => session()->get('avatar'),
//                'totalfollowers' => $totalfollowers,
//                'totaltweets' => $totaltweets,
//                'favourites' => $favourites_count
//
//
//            ];
//
//            if ($totaltweets > 0) {
//                foreach ($tweetslist->data as $val) {
//                    $tweet_id = $val->id;
//                    $publicmetric = $this->getTwitterPublicMetric($tweet_id);
//                    $publicmetricdata[] = json_decode($publicmetric);
//                }
//                foreach ($publicmetricdata as $val) {
//                    $detailsdata[] = $val->data;
//                }
//                foreach ($detailsdata as $value) {
//
//                    $metrices = [
//                        'tenant_twitter_id' => session()->get('twitter_id'),
//                        'tweet_id' => $value[0]->id,
//                        'tweet_text' => $value[0]->text,
//                        'retweet_count' => $value[0]->public_metrics->retweet_count,
//                        'reply_count' => $value[0]->public_metrics->reply_count,
//                        'like_count' => $value[0]->public_metrics->like_count,
//                        'quote_count' => $value[0]->public_metrics->quote_count,
//                        'date' => date('Y-m-d')
//                    ];
//                    $metricesdetails[] = $metrices;
//
//                }
//            }
//
//            $totalengagement = 0;
//            $totalretweets = 0;
//            if (!empty($metricesdetails) && count($metricesdetails) > 0) {
//                foreach ($metricesdetails as $keyss) {
//                    $retweetkey = $keyss['retweet_count'];
//                    $totalretweets = array_sum(array_column($keyss, $retweetkey));
//
//
//                    $engkey = $keyss['quote_count'];
//                    $totalengagement = array_sum(array_column($keyss, $engkey));
//
//
//                    $rlykey = $keyss['reply_count'];
//                    $totalreplycount = array_sum(array_column($keyss, $rlykey));
//
//                    $lykkey = $keyss['like_count'];
//                    $totallikecount = array_sum(array_column($keyss, $lykkey));
//                }
//            }
//
//            return view('tenant/twitterperformance', compact(['details', 'metricesdetails', 'totalretweets', 'totalengagement', 'totalfollowers', 'favourites_count']));
//        } else {
//            return redirect('/connections');
//        }
//    }



    private function getToken(){
         $access_token = session()->get('token');
         $access_token_secret = session()->get('tokensecret');
         $apikey = 'ZcBsNRYjXQskH5RR735rSELJG';
         $apisecret = 'BZnhpxPikQMUqoEJmZGeXPrEcYbpUgYbCa1PfONXEnmWfacnuH';
         $connection = new TwitterOAuth($apikey, $apisecret, $access_token, $access_token_secret);
         return $connection;
    }

    private function getTwitterPublicMetric($tweet_id){
         $headers = [
            'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAGEPTwEAAAAAS5I8ra7dySg%2BHw18WEd0ioWR7Ag%3DCH0yRcezKF4CruWJXv0BQx4YlS5LF5DCFIHS9uJYnnc0BJ9pW6',
            'accept-encoding: gzip',
            'content-type: application/json',
           ];

           $url = 'https://api.twitter.com/2/tweets?ids='.$tweet_id.'&tweet.fields=public_metrics&expansions=attachments.media_keys&media.fields=public_metrics';

        $curl = curl_init();
         curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_HTTPHEADER => $headers,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

    private function getTwitterPrivateMetric(){
        $headers = [
            'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAGEPTwEAAAAAS5I8ra7dySg%2BHw18WEd0ioWR7Ag%3DCH0yRcezKF4CruWJXv0BQx4YlS5LF5DCFIHS9uJYnnc0BJ9pW6',
            'accept-encoding: gzip',
            'content-type: application/json',
           ];



           $url = 'https://api.twitter.com/2/tweets/1308294977814814720?tweet.fields=non_public_metrics,organic_metrics&media.fields=non_public_metrics,organic_metrics&expansions=attachments.media_keys';

        $curl = curl_init();
         curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_HTTPHEADER => $headers,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    private function getTwitterEngagementData(){
         $headers = [
            'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAGEPTwEAAAAAS5I8ra7dySg%2BHw18WEd0ioWR7Ag%3DCH0yRcezKF4CruWJXv0BQx4YlS5LF5DCFIHS9uJYnnc0BJ9pW6',
            'accept-encoding: gzip',
            'content-type: application/json',
           ];
           $url = 'https://data-api.twitter.com/insights/engagement/totals';

            $arrayToSend = [
                "tweet_ids" => [
                    "1308294977814814720"
                ],
                "engagement_types" => [
                    "favorites","retweets","replies","quote_tweets","video_views"
                ],
            ];
         $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_HTTPHEADER => $headers,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_POSTFIELDS => json_encode($arrayToSend),
          CURLOPT_CUSTOMREQUEST => 'POST',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    private function subscriptionList(){

         $apikey = 'ZcBsNRYjXQskH5RR735rSELJG';
         $apisecret = 'BZnhpxPikQMUqoEJmZGeXPrEcYbpUgYbCa1PfONXEnmWfacnuH';
        $connection = new TwitterOAuth($apikey, $apisecret);

        $request_token = $connection->oauth2('oauth2/token', ['grant_type' => 'client_credentials']);
        $connection = new TwitterOAuth($apikey, $apisecret, $request_token->access_token);
        $content = $connection->get("account_activity/all/development/subscriptions/list");

       return $content;
    }

    public function userTwitterDetails(Request $request){

        $connection = $this->getToken();
        $content = $connection->get("account/verify_credentials");
        return view('tenant/twitter_user_details', compact('content'));
    }

    private function userTwitterFollowerDetails($twitter_user_id){
         $headers = [
            'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAGEPTwEAAAAAS5I8ra7dySg%2BHw18WEd0ioWR7Ag%3DCH0yRcezKF4CruWJXv0BQx4YlS5LF5DCFIHS9uJYnnc0BJ9pW6',
           ];
           $url = 'https://api.twitter.com/2/users/'.$twitter_user_id.'/followers';
         $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_HTTPHEADER => $headers,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }


     private function fetchUserTotalTweets($twitter_user_id){
          $headers = [
            'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAGEPTwEAAAAAS5I8ra7dySg%2BHw18WEd0ioWR7Ag%3DCH0yRcezKF4CruWJXv0BQx4YlS5LF5DCFIHS9uJYnnc0BJ9pW6',
           ];
           $url = 'https://api.twitter.com/2/users/'.$twitter_user_id.'/tweets';
        $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_HTTPHEADER => $headers,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
    }

    private function fetchTweetLikes($tweet_id){
       $headers = [
            'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAGEPTwEAAAAAS5I8ra7dySg%2BHw18WEd0ioWR7Ag%3DCH0yRcezKF4CruWJXv0BQx4YlS5LF5DCFIHS9uJYnnc0BJ9pW6',
           ];
           $url = 'https://api.twitter.com/2/tweets/'.$tweet_id.'/liking_users';
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_HTTPHEADER => $headers,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
    }

    private function fetchUserLikedTweets($twitter_user_id){
       $headers = [
            'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAGEPTwEAAAAAS5I8ra7dySg%2BHw18WEd0ioWR7Ag%3DCH0yRcezKF4CruWJXv0BQx4YlS5LF5DCFIHS9uJYnnc0BJ9pW6',
           ];
           $url = 'https://api.twitter.com/2/users/'.$twitter_user_id.'/liked_tweets';
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_HTTPHEADER => $headers,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
    }

    /**
     * Redirect the user to the Twitter authentication page.
     *
     * @return Response
    */
    public function redirectToProvider(Request $request,$provider)
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from Twitter.
     *
     * @return Response
     */
//    public function handleProviderCallback($provider)
//    {
//        $user = Socialite::driver($provider)->user();
//        $authUser = $this->findOrCreateUser($user, $provider);
//        Auth::login($authUser, true);
//        session()->put('token',$user->token);
//        session()->put('tokensecret',$user->tokenSecret);
//        session()->put('twitter_id',$user->id);
//        session()->put('name',$user->name);
//        session()->put('nickname',$user->nickname);
//        session()->put('avatar',$user->avatar);
//        $company = session()->get('company');
//        return redirect()->route('tenant.twitterperformance', ['subdomain' => $company]);
//    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }


    public function userTweets(Request $request,$id)
{
    $connection = $this->getToken();
    $content = $connection->get("account/verify_credentials");
    $statuses = $connection->get("statuses/user_timeline", ["count" => 25, "exclude_replies" => false]);
    print_r($statuses);die;
    $data = Twitter::getUserTimeline(['count' => 10, 'format' => 'array']);
    print_r($data);die;

}

  public function accountActivity(){
//    $twitter_id = Session::get('twitter_id');

     $access_token = '1437634956319248387-sYJywAjIcR9YZwkkiKgJOyCIGauSYZ';
    $access_token_secret = 'HPIH1c0ykSGEYb3tcbgMVXtqBworl7wLCj9QNHyaGxfDs';
    $apikey = 'ZcBsNRYjXQskH5RR735rSELJG';
    $apisecret = 'BZnhpxPikQMUqoEJmZGeXPrEcYbpUgYbCa1PfONXEnmWfacnuH';
    $connection = new TwitterOAuth($apikey, $apisecret, $access_token, $access_token_secret);
    $res = $this->getWebhookStatus($apikey,$apisecret);
    if(!empty($res->subscriptions[0]->user_id)){
        return $twitter_user_id = $res->subscriptions[0]->user_id;
    }else{
      $result = $this->RegisterWebhook($apikey, $apisecret, $access_token, $access_token_secret);
    $content = $connection->post("account_activity/all/development/subscriptions");   //Subscribe User to Webhook
    return $content;
    }
  }

   private function RegisterWebhook($apikey, $apisecret, $access_token, $access_token_secret){

    $connection = new TwitterOAuth($apikey, $apisecret, $access_token, $access_token_secret);
    $url = "https://afdalanalytics.com/AfdalAnalytics/twitterwebhook";
    $content = $connection->post("account_activity/all/development/webhooks", ["url" => $url]);
    return $content;
   }

   private function getWebhookStatus($apikey,$apisecret){

        $connection = new TwitterOAuth($apikey, $apisecret);
        dump($connection);

        $request_token = $connection->oauth2('oauth2/token', ['grant_type' => 'client_credentials']);
        dump($request_token);
        $connection = new TwitterOAuth($apikey, $apisecret, $request_token->access_token);
        dd($connection);
        $content = $connection->get("account_activity/all/development/subscriptions/list");
       return $content;
   }



}
