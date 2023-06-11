<?php

namespace App\Http\Controllers;

use App\Classes\Activity;
use App\Classes\FacebookAdsApi;
use App\Classes\IntercomAPI;
use App\Events\SocialAccountConnectedEvent;
use App\Models\AddAccount;
use App\Models\AdsAccount;
use App\Models\AdsData;
use App\Models\Dashboard;
use App\Models\Post;
use App\Models\Seo;
use App\Models\SocialAccount;
use App\Traits\DatePick;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacebookAdsController extends Controller
{
    // comment
    use DatePick;




    public function adstest(Request $request)
    {
        try {
            $company_id = 155;
            $FacebookAdsApi = new FacebookAdsApi();
            $token = 'EAACFZCwk0InsBAD4KCnkiaSOzhOzZC6CUkABHzlRVkFr57gHTSWKjCVTrMHUpwbUZBy3gLGsDVdbJHJnCLHA8NFUoEVb7rzv8pkKC61IUD0Q6wAKokgjZAnUnD9kC3ZAWji51xJlGZBr6fYK4uqhEkL0YGHIZC4vYMGc0TZCw5ybyuein9YtT2pAe9AW6DG45soZD'; 

            //$FacebookAdsApi->get_long_lived_token('EAACFZCwk0InsBAJNVZCaoDWvg9cLKNKqKS7wZA43EhZASfgUBaFhrUorDvlEPZCBVYXUKooEZBwQsH7281OgogtrjCS8Ug72ZBkNiD64OH779ZBanscVXuNaWWMcns98uK26UWboTI4nruqeQLlGoXZCM5ejWEBHwhEMhJQRK0o5f65q2PAun7PFKyWNbAeW2O2gZD');
            
            $FacebookAdsApi->set_access_token($token);
            $user = $FacebookAdsApi->get_user_data('265417892230407');
            $act_accounts = $FacebookAdsApi->get_ad_accounts('265417892230407');

                if(!empty($act_accounts->data)) {
                    

/*
                    $social_account = SocialAccount::updateOrCreate(
                        ['company_id' => $company_id, 'provider_id'   => '6569094949771401', 'provider_name' => 'facebookAds'],
                        [
                            'provider_name' => 'facebookAds',
                            'provider_id' => '6569094949771401',
                            'full_name' => $user->name,
                            'email' => !empty($user->email) ? $user->email : '',
                            'avatar' => $user->picture->data->url,
                            'token' => $token,
                            'expires_at' => Carbon::now()->addDay(58),
                            'company_id' => $company_id,
                        ]);
                    DB::table('company_social_account')->updateOrInsert(
                        ['company_id' => $company_id, 'social_account_id' => $social_account->id],
                        ['company_id' => $company_id, 'social_account_id' => $social_account->id]
                    );


                    */

                  //  $activity = new Activity();
                    //$activity->addActivity('add_connection', __('Facebook Ads') . ' ' . $user->name);
                    //SocialAccountConnectedEvent::dispatch(Auth::user(), "Facebook Ads", $user->name??'', $user->email??'');

                    foreach ($act_accounts->data as $act_account) {
                        $is_connected = false; //AdsAccount::where('social_account_id', $social_account->id)->where('act_id', $act_account->id)->count();
                        if(!$is_connected){


                            /*


                            $ads_account = AdsAccount::create(
                                [
                                    'act_id' => $act_account->id,
                                    'account_id' => $act_account->account_id,
                                    'name' => $act_account->name,
                                    'social_account_id' => $social_account->id,
                                ]);


                            */





                            $insights = $FacebookAdsApi->get_ad_account_insight($act_account->id);
                            $insights_2 = $FacebookAdsApi->get_ad_account_insight_2($act_account->id);
                            //cpp,cpm,spend,reach,converted_product_value
                            


/*
                            foreach ($insights->data as $insight){
                                $ads_data = AdsData::create([
                                    'campaign_id' => !empty($insight->campaign_id) ? $insight->campaign_id : null,
                                    'campaign_name' => !empty($insight->campaign_name) ? $insight->campaign_name : null,
                                    'impressions' => !empty($insight->impressions) ? $insight->impressions : 0,
                                    'ctr' => !empty($insight->ctr) ? $insight->ctr : 0,
                                    'cpc' => !empty($insight->cpc) ? $insight->cpc : 0,
//                                    'cpp' => !empty($insight->cpp) ? $insight->cpp : 0,
//                                    'cpm' => !empty($insight->cpm) ? $insight->cpm : 0,
//                                    'spend' => !empty($insight->spend) ? $insight->spend : 0,
                                    'account_currency' => !empty($insight->account_currency) ? $insight->account_currency : null,
//                                    'reach' => !empty($insight->reach) ? $insight->reach : 0,
                                    'clicks' => !empty($insight->clicks) ? $insight->clicks : 0,
                                    'inline_link_clicks' => !empty($insight->inline_link_clicks) ? $insight->inline_link_clicks : 0,
//                                    'converted_product_value' => !empty($insight->converted_product_value) ? $insight->converted_product_value : 0,
                                    'ads_account_id' => $ads_account->id,
                                    'date' => !empty($insight->date_start) ? $insight->date_start : null
                                ]);
                            }
                            foreach ($insights_2->data as $insight){
                                $ads_data->update([
                                    'cpp' => !empty($insight->cpp) ? $insight->cpp : 0,
                                    'cpm' => !empty($insight->cpm) ? $insight->cpm : 0,
                                    'spend' => !empty($insight->spend) ? $insight->spend : 0,
                                    'reach' => !empty($insight->reach) ? $insight->reach : 0,
                                    'converted_product_value' => !empty($insight->converted_product_value) ? $insight->converted_product_value : 0,
                                ]);
                            }

*/

                            $posts_id = [];
                            $creatives = $FacebookAdsApi->get_ad_creatives($act_account->id);

                               // $creative_data = $FacebookAdsApi->get_creative_data($creatives->data[24]->id);




                            foreach ($creatives->data as $creative) {
                                $creative_data = $FacebookAdsApi->get_creative_data($creative->id);

                                if(isset($creative_data) && isset($creative_data->effective_object_story_id)){
                                    $getPostID = $creative_data->effective_object_story_id;
                                    $posts_id[] = explode( '_', $getPostID)[0];

                                }
                            }
$post_data =  $FacebookAdsApi->get_post_data('108132398116318', 'EAACFZCwk0InsBAEJFZBW4reEQEaY604lDnpSSZC8TRmZA2zi8KeCudJP92ZA9Jhu59RO0NDBXWXlvGKgkJycOLmNi7DohkRmXHBqEG1CRrncVDJvDBEVZByBcETcx54REFZBoMCVReBrZA9vKGBiUrh20TRXYmXGCOFH3jq8yPACNjzy8mXwLeAsgj78hRJN2W8ZD');
dd($post_data);

                            $posts_id = array_unique($posts_id);
                            if (count($posts_id) > 0)
                            {
                                foreach ($posts_id as $post_id){
                                    $page_id = $post_id;

                                    try {
                                        $page_token =  $FacebookAdsApi->get_page_token($page_id);
                                            
                                        try {
                                            if(isset($page_token) && isset($page_token->access_token)){
                                                $post_data =  $FacebookAdsApi->get_post_data($post_id, $page_token->access_token);
                                               
                                                dd($post_data);
                                               /* Post::create([
                                                    'post_id'        => $post_data->id,
                                                    'image'          => !empty($post_data->full_picture) ? $post_data->full_picture : null,
                                                    'text'           => !empty($post_data->message) ? $post_data->message : null,
                                                    'created_date'   => !empty($post_data->created_time) ? date("Y-m-d", strtotime($post_data->created_time)) : null,
                                                    'likes_count'    => !empty($post_data->likes->summary->total_count) ? $post_data->likes->summary->total_count : 0,
                                                    'comments_count' => !empty($post_data->comments->summary->total_count) ? $post_data->comments->summary->total_count : 0,
                                                    'engaged'        => !empty($post_data->insights->data[1]->values[0]->value) ? $post_data->insights->data[1]->values[0]->value : 0,
                                                    'clicks'         => !empty($post_data->insights->data[2]->values[0]->value) ? $post_data->insights->data[2]->values[0]->value : 0,
                                                    'ads_account_id'        => $ads_account->id,
                                                ]);

                                                */
                                            }
                                        }catch (RequestException $e) {

                                            //dd($page_token ,$e);
                                        }



                                    } catch (RequestException $e) {
                                           // dd($page_token ,$e);

                                    }


                                    
                                }
                            }
                            //create dashboard
                            /*

                            Dashboard::firstOrCreate([
                                'company_id' => Auth::user()->company_id,
                                'name' => 'facebook-ads-overview',
                            ],[
                                'name' => 'facebook-ads-overview',
                                'social_account_id' => $social_account->id,
                                'company_id' => Auth::user()->company_id,
                                'page_id' => $ads_account->id,
                            ]);


                            */
                        }
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => __('No ads accounts')
                    ], 200);
                }
        }catch (RequestException $e) { 
            dd($e);
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 200);
        }

        $intercom = new IntercomAPI();
        $ActiveCampaitng = new ActiveCampaitngController();
        $intercom->addConnection('Facebook Ads');
        // $intercom->EventTrackingAPI('facebook ads','abc');
        $ActiveCampaitng->EventTrackingCreation('Facebook Ads');
        $ActiveCampaitng->EventTrackingAPI('Facebook Ads','',$user->email);
        return response()->json([
            'status' => true,
            'message' => __('Connection connected successfully')
        ], 200);
    }









    public function facebookAdsCallback(Request $request)
    {
        try {
            $company_id = Auth::user()->company->id;
            $FacebookAdsApi = new FacebookAdsApi();
            $token = $FacebookAdsApi->get_long_lived_token($request->token);
            $FacebookAdsApi->set_access_token($token->access_token);
            $user = $FacebookAdsApi->get_user_data($request->id);
            $act_accounts = $FacebookAdsApi->get_ad_accounts($request->id);
                if(!empty($act_accounts->data)) {
                    $social_account = SocialAccount::updateOrCreate(
                        ['company_id' => $company_id, 'provider_id'   => $request->id, 'provider_name' => 'facebookAds'],
                        [
                            'provider_name' => 'facebookAds',
                            'provider_id' => $request->id,
                            'full_name' => $user->name,
                            'email' => !empty($user->email) ? $user->email : '',
                            'avatar' => $user->picture->data->url,
                            'token' => $token->access_token,
                            'expires_at' => Carbon::now()->addDay(58),
                            'company_id' => $company_id,
                        ]);
                    DB::table('company_social_account')->updateOrInsert(
                        ['company_id' => $company_id, 'social_account_id' => $social_account->id],
                        ['company_id' => $company_id, 'social_account_id' => $social_account->id]
                    );

                    $activity = new Activity();
                    $activity->addActivity('add_connection', __('Facebook Ads') . ' ' . $user->name);
                    SocialAccountConnectedEvent::dispatch(Auth::user(), "Facebook Ads", $user->name??'', $user->email??'');

                    foreach ($act_accounts->data as $act_account) {
                        $is_connected = AdsAccount::where('social_account_id', $social_account->id)->where('act_id', $act_account->id)->count();
                        if(!$is_connected){
                            $ads_account = AdsAccount::create(
                                [
                                    'act_id' => $act_account->id,
                                    'account_id' => $act_account->account_id,
                                    'name' => $act_account->name,
                                    'social_account_id' => $social_account->id,
                                ]);
                            $insights = $FacebookAdsApi->get_ad_account_insight($act_account->id);
                            $insights_2 = $FacebookAdsApi->get_ad_account_insight_2($act_account->id);
                            //cpp,cpm,spend,reach,converted_product_value
                            foreach ($insights->data as $insight){
                                $ads_data = AdsData::create([
                                    'campaign_id' => !empty($insight->campaign_id) ? $insight->campaign_id : null,
                                    'campaign_name' => !empty($insight->campaign_name) ? $insight->campaign_name : null,
                                    'impressions' => !empty($insight->impressions) ? $insight->impressions : 0,
                                    'ctr' => !empty($insight->ctr) ? $insight->ctr : 0,
                                    'cpc' => !empty($insight->cpc) ? $insight->cpc : 0,
//                                    'cpp' => !empty($insight->cpp) ? $insight->cpp : 0,
//                                    'cpm' => !empty($insight->cpm) ? $insight->cpm : 0,
//                                    'spend' => !empty($insight->spend) ? $insight->spend : 0,
                                    'account_currency' => !empty($insight->account_currency) ? $insight->account_currency : null,
//                                    'reach' => !empty($insight->reach) ? $insight->reach : 0,
                                    'clicks' => !empty($insight->clicks) ? $insight->clicks : 0,
                                    'inline_link_clicks' => !empty($insight->inline_link_clicks) ? $insight->inline_link_clicks : 0,
//                                    'converted_product_value' => !empty($insight->converted_product_value) ? $insight->converted_product_value : 0,
                                    'ads_account_id' => $ads_account->id,
                                    'date' => !empty($insight->date_start) ? $insight->date_start : null
                                ]);
                            }
                            foreach ($insights_2->data as $insight){
                                $ads_data->update([
                                    'cpp' => !empty($insight->cpp) ? $insight->cpp : 0,
                                    'cpm' => !empty($insight->cpm) ? $insight->cpm : 0,
                                    'spend' => !empty($insight->spend) ? $insight->spend : 0,
                                    'reach' => !empty($insight->reach) ? $insight->reach : 0,
                                    'converted_product_value' => !empty($insight->converted_product_value) ? $insight->converted_product_value : 0,
                                ]);
                            }
                            $posts_id = [];
                            $creatives = $FacebookAdsApi->get_ad_creatives($act_account->id);
                            foreach ($creatives->data as $creative) {
                                $creative_data = $FacebookAdsApi->get_creative_data($creative->id);

                                if(isset($creative_data) && isset($creative_data->effective_object_story_id)){
                                    $getPostID = $creative_data->effective_object_story_id;
                                    $posts_id[] = explode( '_', $getPostID)[0];

                                }
                            }

                            $posts_id = array_unique($posts_id);

                            if (count($posts_id) > 0)
                            {
                                foreach ($posts_id as $post_id){
                                    $page_id = $post_id;

                                    try {
                                        $page_token =  $FacebookAdsApi->get_page_token($page_id);
                                            
                                        try {
                                            if(isset($page_token) && isset($page_token->access_token)){


                                                $post_data =  $FacebookAdsApi->get_post_data($post_id, $page_token->access_token);

                                                Post::create([
                                                    'post_id'        => $post_data->id,
                                                    'image'          => !empty($post_data->full_picture) ? $post_data->full_picture : null,
                                                    'text'           => !empty($post_data->message) ? $post_data->message : null,
                                                    'created_date'   => !empty($post_data->created_time) ? date("Y-m-d", strtotime($post_data->created_time)) : null,
                                                    'likes_count'    => !empty($post_data->likes->summary->total_count) ? $post_data->likes->summary->total_count : 0,
                                                    'comments_count' => !empty($post_data->comments->summary->total_count) ? $post_data->comments->summary->total_count : 0,
                                                    'engaged'        => !empty($post_data->insights->data[1]->values[0]->value) ? $post_data->insights->data[1]->values[0]->value : 0,
                                                    'clicks'         => !empty($post_data->insights->data[2]->values[0]->value) ? $post_data->insights->data[2]->values[0]->value : 0,
                                                    'ads_account_id'        => $ads_account->id,
                                                ]);
                                            }
                                            
                                        }catch (RequestException $e) {
                                        }



                                    } catch (RequestException $e) {

                                    }


                                    
                                }
                            }
                            //create dashboard
                            Dashboard::updateOrCreate([
                                'company_id' => Auth::user()->company_id,
                                'name' => 'facebook-ads-overview',
                            ],[
                                'name' => 'facebook-ads-overview',
                                'social_account_id' => $social_account->id,
                                'company_id' => Auth::user()->company_id,
                                'page_id' => $ads_account->id,
                            ]);
                        }
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => __('No ads accounts')
                    ], 200);
                }
        }catch (RequestException $e) { 
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 200);
        }

        $intercom = new IntercomAPI();
        $ActiveCampaitng = new ActiveCampaitngController();
        $intercom->addConnection('Facebook Ads');
        $ActiveCampaitng->EventTrackingCreation('Facebook Ads');
        $ActiveCampaitng->EventTrackingAPI('Facebook Ads','',$user->email);
        return response()->json([
            'status' => true,
            'message' => __('Connection connected successfully')
        ], 200);
    }

    public function facebookAdsOverview(Request $request) {
        $this->PickDate($request->get('date_from'), $request->get('date_to'));
        $date_from = $this->date_from;
        $date_to = $this->date_to;

        if (Auth::user()->company->dashboard->where('name','facebook-ads-overview')->isNotEmpty()) {
            $dashboard = Dashboard::where('company_id', Auth::user()->company_id)
                ->where('name', 'facebook-ads-overview')
                ->first();

            $ads_account = AdsAccount::where('id', $dashboard->page_id)
                ->where('social_account_id',$dashboard->social_account_id)
                ->first();

            //dd($dashboard, $ads_account);
            if(null == $ads_account){
                $dashboard = Dashboard::where('company_id', Auth::user()->company_id)
                ->where('name', 'facebook-ads-overview')
                ->delete();

                if(!empty($dashboard)){
                    $user = Auth::user();
                    $user->last_visited_dashboard = null;
                    $user->save();
                }
                return redirect('/dashboard');
            }

            $ads_account_id = $ads_account->id;
            $social_accounts = Auth::user()->company->social_account_facebook_ads->where('id', '!=', $dashboard->social_account_id);
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
            $avg_cpm= AdsData::select('cpm')
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
            $dashId = $dashboard->getKey();
            $page = $ads_account;

            $seo = Seo::where('route', $request->getRequestUri())->first();

            if(!empty($dashboard)){
                $user = Auth::user();
                $user->last_visited_dashboard = 'facebook-ads-overview';
                $user->save();
            }

            return view('tenant.home_screen', compact(['template_name','connect_name','total_inline_link_clicks',
                'graph_data_click_vs_impression', 'total_impression', 'total_reach', 'avg_ctr', 'total_clicks',
                'cost_per_link', 'avg_cpm', 'avg_cpp', 'total_spend', 'graph_data_spend_vs_revenue', 'social_accounts',
                'graph_advertising_spend', 'ads_campaign', 'posts', 'avg_cpc', 'date_from', 'date_to', 'seo', 'pages',
                'dashId', 'page']));
        }
        return view('tenant.home_screen');
    }
}
