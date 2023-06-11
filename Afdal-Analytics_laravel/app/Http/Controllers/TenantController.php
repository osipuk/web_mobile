<?php

namespace App\Http\Controllers;

use App\Helpers\UserPlanHelper;
use App\Models\ActivityLog;
use App\Models\BillingHistory;
use App\Models\Dashboard;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Plans;
use App\Models\Seo;
use App\Models\SocialAccount;
use App\Services\Social\GoogleAnalyticsService;
use App\Traits\DatePick;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;
use Symfony\Component\HttpFoundation\Session\Session;
use Socialite;
use Twitter;
use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\HttpFoundation\File\File;
use Validator;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\knowledgeBase;
use App\Models\Support;
use App\Models\UserSubscription;
use App\Models\TenantUser;
use function PHPUnit\Framework\isEmpty;

class TenantController extends Controller
{
    use DatePick;

    //
    public function userhome(Request $request)
    {
        return view('tenant/userhome');
    }


    public function upgradeplan(Request $request)
    {
        $getUserData = User::where('id', Auth::user()->id)->first();
        $trial_subscription = UserSubscription::getTrialSubscription(Auth::User()->id);
        $paid_subscription = UserSubscription::getPaidSubscription(Auth::User()->id);
        $data = ['getUserData' => $getUserData, 'trial_subscription' => $trial_subscription, 'paid_subscription' => $paid_subscription];
        return view('tenant/upgradeplan', $data);
    }

    public function userreview(Request $request)
    {
        return view('tenant/userreview');
    }

    public function dashboard(Request $request)
    {
        return view('tenant/dashboard');
    }

    public function dashboard2(Request $request)
    {
        return view('tenant/dashboard2');
    }

    public function connections(Request $request)
    {
        if (!auth()->user()->company->subscriptions()->first()
            && !auth()->user()->company->onTrial()
            && auth()->user()->email !== 'demo@afdal.com'
            && !auth()->user()->gift) {
            return redirect('/dashboard/no-subscription');
        }

        if (!Auth::user()->permissions->contains('code', 'manage_connections')) {
            return redirect('/dashboard/no-permission');
        }
        $enable_connections = Auth::user()->company->social_account()->count() < UserPlanHelper::subscription_info()->connections;
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('tenant/connections', compact(['enable_connections', 'seo']));
    }

    public function delPages($page, $social_account)
    {
        $page->post()->each(function ($post) {
            $post->delete();
        });
        $page->follower()->each(function ($follower) {
            $follower->delete();
        });
        $page->likeinfo()->each(function ($like) {
            $like->delete();
        });
        $page->data()->each(function ($data) {
            $data->delete();
        });
        $page->cta_data()->each(function ($cta_data) {
            $cta_data->delete();
        });
        $dashboards = Dashboard::where('social_account_id', $social_account->getKey())->where('page_id', $page->getKey())->get();
        $dashboards->map(function ($dash) {
            $dash->delete();
        });
        $page->delete();
    }

    public function delAccount($acc)
    {
        $acc->social_account_data()->each(function ($data) {
            $data->delete();
        });
        $acc->ads_account()->each(function ($acc) {
            $acc->delete();
        });
        $acc->tweet()->each(function ($tweet) {
            $tweet->delete();
        });
        $acc->delete();
    }
    public function deleteDashboards($account_id, $template_name)
    {
        $dashboard = Dashboard::query()
            ->where('social_account_id', $account_id)
            ->where('name', $template_name)
            ->first();

        $dashboard?->delete();
    }

    public function removeTwitterConnection($accounts, $page_ids)
    {
        if ($page_ids) {
            foreach ($accounts as $account) {
                if (!in_array($account->getKey(), $page_ids)) {
                    $this->deleteDashboards($account->getKey(), 'twitter-overview');
                    $this->delAccount($account);
                }
            }
        } else {
            foreach ($accounts as $account) {
                $this->deleteDashboards($account->getKey(), 'twitter-overview');
                $this->delAccount($account);
            }
        }
    }

    public function removeFacebookAdsConnection($accounts, $page_ids)
    {
        if ($page_ids) {
            foreach ($accounts as $account) {
                if (!in_array($account->getKey(), $page_ids)) {
                    $this->deleteDashboards($account->getKey(), 'facebook-ads-overview');
                    $this->delAccount($account);
                }
            }
        } else {
            foreach ($accounts as $account) {
                $this->deleteDashboards($account->getKey(), 'facebook-ads-overview');
                $this->delAccount($account);
            }
        }
    }

    public function deleteGoogleAdsAccountData($adsAccount, $socialAccount = null)
    {
        $account_data = $adsAccount->account_data;
        foreach ($account_data as $data){
            $data->delete();
        }
        if($socialAccount){
            $dashboard = Auth::user()->company->dashboard->where('name','google-ads-overview')->first();
            if($dashboard->social_account_id === $socialAccount->getKey() && $dashboard->page_id === $adsAccount->getKey()){
                $adsAccounts = $socialAccount->google_ads_account;
                foreach ($adsAccounts as $acc){
                    if($acc !== $adsAccount){
                        $dashboard->page_id = $acc->getKey();
                        $dashboard->save();
                        break;
                    }
                }
            }
        }
        $adsAccount->delete();
    }

    public function deleteGoogleAdsAccount($account)
    {
        $account->google_ads_account()->each(function ($data) {
            $data->delete();
        });

        $account->delete();
    }

    public function removeGoogleAdsConnection($accounts, $page_ids)
    {
        if ($page_ids) {
            foreach ($accounts as $account) {
                $adsAccounts = $account->google_ads_account;
                $count = count($adsAccounts);

                if ($adsAccounts) {
                    foreach ($adsAccounts as $page) {

                        if (!in_array($page->getKey(), $page_ids)) {
                            $this->deleteGoogleAdsAccountData($page, $account);
                            $count--;
                        }

                    }
                }

                if ($count == 0) {
                    $this->deleteDashboards($account->getKey(), 'google-ads-overview');
                    $this->deleteGoogleAdsAccount($account);
                }
            }

        } else {
            foreach ($accounts as $account) {
                $adsAccounts = $account->google_ads_account;
                foreach ($adsAccounts as $page) {
                        $this->deleteGoogleAdsAccountData($page);
                }
                $this->deleteDashboards($account->getKey(), 'google-ads-overview');
                $this->deleteGoogleAdsAccount($account);
            }
        }
    }
    public function removeConnection(Request $request)
    {
        $page_ids = $request->get('connect');
        $acc_type = $request->get('account');

        $company = Auth::user()->company;
        $accounts = [];
        switch ($acc_type) {
            case 'facebook':
                $accounts = $company->social_account_facebook;
                break;
            case 'instagram':
                $accounts = $company->social_account_instagram;
                break;
            case 'facebookAds':
                $accounts = $company->social_account_facebook_ads;
                break;
            case 'twitter':
                $accounts = $company->social_account_twitter;
                break;
            case 'googleAnalytics':
                $accounts = $company->social_account_google_analytics;
                break;
            case 'google_ads':
                $accounts = $company->social_account_google_ads;
                break;
        }

        if ($acc_type === 'twitter') {
            $this->removeTwitterConnection($accounts, $page_ids);
        } elseif ($acc_type === 'google_ads') {
            $this->removeGoogleAdsConnection($accounts, $page_ids);
        } elseif ($acc_type === 'googleAnalytics') {
            foreach ($accounts as $account) {
                $googleAnalyticsService = new GoogleAnalyticsService($account);
                $googleAnalyticsService->deleteAllWithExcludedProperties($page_ids ?? []);
            }
        }// elseif($acc_type === 'facebookAds') {
           // $this->removeFacebookAdsConnection($accounts, $page_ids);
        //}
        else {
            if($page_ids){
                foreach ($accounts as $account){
                    if($acc_type === 'facebookAds'){
                        $pages = $account->ads_account;
                    } else {
                        $pages = $account->page;
                    }
                    $count = count($pages);
                    if($pages){
                        foreach ($pages as $page){
                            if(!in_array($page->getKey(),$page_ids)){
                                if($acc_type === 'facebookAds'){
                                    $page->delete();

                                } else {
                                    $this->delPages($page, $account);
                                }
                                $count--;
                            }
                        }
                    }
                    if ($count == 0) {
                        $this->delAccount($account);
                        $this->deleteDashboards($account->social_account_id, 'facebook-ads-overview');
                    }
                }
            } else {
                foreach ($accounts as $acc){
                    $pages = $acc->page;
                    $count = count($pages);
                    foreach ($pages as $page) {
                        $this->delPages($page, $acc);
                        $count--;
                    }

                    if ($count == 0) {
                        $this->deleteDashboards($acc->id, 'facebook-ads-overview');
                        $this->delAccount($acc);
                    }

                }
            }
        }

        return redirect('/dashboard/connections')->with('modal_name', $acc_type);
    }

    public function help(Request $request)
    {
        $email = session()->get('email');
        $details = knowledgeBase::orderBy('id', 'desc')->get();
        $ticketdetails = Support::where('user_id', $email)->orderBy('id', 'desc')->get()->toArray();
        //dd($ticketdetails);die;
        return view('tenant/help', compact('details', 'ticketdetails'));
    }

    public function settings(Request $request)
    {

        $email = session()->get('email');
        $database = session()->get('database');
        $conn = makeDBConnection($database);
        $userdetails = TenantUser::where('email', $email)->first();
        // print_r($userdetails);die;
        return view('tenant/settings', compact('userdetails'));
    }

    public function template(Request $request)
    {
        return view('tenant/template');
    }
    public function demoDashboard(Request $request){

        if(!Auth::check()){
            if(empty(session('user_email')) && empty(session('user_phone'))){
                return redirect('/login');
            }
        }else{
            
        }
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('tenant.v2.demo-dashboard-new', compact('seo'));
        // return view('tenant.v2.demo-dashboard', compact('seo'));
    }
    public function home_screen(Request $request)
    {
        if (!auth()->user()->company->subscriptions()->first()
            && !auth()->user()->company->onTrial()
            && auth()->user()->email !== 'demo@afdal.com'
            && !auth()->user()->gift) {
            return redirect('/dashboard/no-subscription');
        }

        $seo = Seo::where('route', $request->getRequestUri())->first();

        $dasboards = Auth::user()->company->dashboard->pluck('name')->toArray();

        if (in_array(Auth::user()->last_visited_dashboard, $dasboards)) {
            return redirect('/dashboard/' . Auth::user()->last_visited_dashboard);
        }

        if (Auth::user()->company?->dashboard->isNotEmpty()) {
            $first_dashboard = Auth::user()->company->dashboard->first();
//            if (env('APP_ENV') === 'production'){
//                return redirect()->route( $first_dashboard->name, ['subdomain' => $request->session()->get('subdomain')]);
//            }
            return redirect('/dashboard/' . $first_dashboard->name);
        }

        return view('tenant/home_screen', compact('seo'));
    }

    public function user_profile(Request $request)
    {
        $user = Auth::user();
        $user_permissions = $user->permissions;

        $seo = Seo::where('route', $request->getRequestUri())->first();
        return view('tenant/user_profile', compact('user', 'user_permissions', 'seo'));
    }

    public function user_billing(Request $request)
    {
        $company = auth()->user()->company;
        // $payment_methods = $company->paymentMethods();
        // dd($payment_methods);
        if (!Auth::user()->permissions->contains('code', 'manage_payments')) {
            return redirect('/dashboard/no-permission');
        }

        $user_permissions = Auth::user()->permissions;
        $stripe = new StripeClient(
            env('STRIPE_SECRET')
        );

        

        $intent = $company->createSetupIntent();

        $billing_history = BillingHistory::where('company_id', $company->id)->get();
        $default_payment_method = $company->defaultPaymentMethod();

        
        $payment_methods = $company->paymentMethods();
        // dd($company->subscriptions());
        $subscription = $company->subscriptions()->where('name', '!=', 'Analytics Consulting')->get()->sortByDesc('id')->first();
       
        $paypalPlanId = null;

        $user_plan_name = 'Trial';
        $subscription_data = null;
        $isPaypal = false;
        $isPaypalDefault = $company->paypal_default;
        $nextPaymentDate = null;


        $subscription_info = null;


        $consultingSubscription = $company->subscriptions()->where('name','Analytics Consulting')->orderBy('id', 'desc')->latest()->first();
        $nextConsultingPaymentDate = null;
        $consulting_subscription_info = null;


        if ($consultingSubscription) {

            if ($consultingSubscription->stripe_status === 'active' && $consultingSubscription->name == 'Analytics Consulting') {

                    $consulting_subscription_data = $stripe->subscriptions->retrieve(
                        $consultingSubscription->stripe_id,
                        []
                    ); 

                    $nextConsultingPaymentDate = date('Y-m-d', $consulting_subscription_data->current_period_end);

                    $billing_date = __(date('F', $consulting_subscription_data->current_period_end)) . ' ' . date('j/Y', $consulting_subscription_data->current_period_end);


                    $consulting_subscription_info = [
                        'next_payment' => $consulting_subscription_data->plan->amount/100 . '/' . __($consulting_subscription_data->plan->interval) . ' ' . $billing_date,
                        'ends_at' => date('Y-m-d', $consulting_subscription_data->cancel_at),
                        'next_payment_full' => $consulting_subscription_data->plan->amount/100 . '/' . __($consulting_subscription_data->plan->interval) .
                            __(' Next payment on ') . $billing_date . ' ' . ($consulting_subscription_data->plan->interval == 'month' ?
                            __('Paid monthly') : __('Annual plan')),
                        'interval' => $consulting_subscription_data->plan->interval
                    ];
            }
        }
        if ($subscription) {

            if ($subscription->stripe_status === 'active' && $subscription->name != 'Analytics Consulting') {


                $user_plan_name = Plans::where('identifier', $subscription->name)->first()->title;

                $paypalPlanId = Plans::where('identifier', $subscription->name . '_pp')->first()->stripe_id;

                $subscription_data = $stripe->subscriptions->retrieve(
                    $subscription->stripe_id,
                    []
                ); 

                $nextPaymentDate = date('Y-m-d', $subscription_data->current_period_end);

                $billing_date = __(date('F', $subscription_data->current_period_end)) . ' ' . date('j/Y', $subscription_data->current_period_end);

                $subscription_info = [
                    'only_payment'=>$subscription_data->plan->amount/100 . '/' . __($subscription_data->plan->interval),
                    'only_next_payment'=>__(' Next payment on ') . $billing_date . ' ' . ($subscription_data->plan->interval == 'month' ?
                    __('Paid monthly') : __('Annual plan')),
                    'next_payment' => $subscription_data->plan->amount/100 . '/' . __($subscription_data->plan->interval) . ' ' . $billing_date,
                    'next_payment_full' => $subscription_data->plan->amount/100 . '/' . __($subscription_data->plan->interval) .
                        __(' Next payment on ') . $billing_date . ' ' . ($subscription_data->plan->interval == 'month' ?
                        __('Paid monthly') : __('Annual plan')),
                    'interval' => $subscription_data->plan->interval
                ];

            } elseif ($subscription->paypal_status === 'active') {

                $provider = \PayPal::setProvider();
                $provider->getAccessToken();
                $plan_data = $provider->showPlanDetails($subscription->paypal_plan);
                $user_plan_name = $plan_data['name'];
                $subscription_data = $provider->showSubscriptionDetails($subscription->paypal_id);

                $billing_date = __(date('F', strtotime($subscription_data['start_time'] . ' + 1 month'))) . ' ' . date('j/Y', strtotime($subscription_data['start_time'] . ' + 1 month'));

                $isPaypal = true;

                $subscription_info = [
                    'only_payment'=>$plan_data['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'] . '/' .
                    __(strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])),
                    'only_next_payment'=>__(' Next payment on ') . ' ' . $billing_date,
                    'next_payment' => $plan_data['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'] . '/' .
                        __(strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])) . ' ' . $billing_date,
                    'next_payment_full' => $plan_data['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'] . '/' .
                        __(strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])) .
                        __(' Next payment on ') . $billing_date . ' ' . (strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit']) == 'month' ?
                        __('Paid monthly') : __('Annual plan')),
                    'interval' => strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])
                ];
            }
        }
        // dd($subscription_info);
        $ends_at = $subscription?->ends_at;
        // dd($ends_at);
        $status = false;
        $user_company = $company;

        $seo = Seo::where('route', $request->getRequestUri())->first();
       // dd($consulting_subscription_info);
        $number_of_links = 1;
        if($user_plan_name == 'Essentials Plan'){
            $number_of_links = 1;
        }elseif($user_plan_name == 'Plus Plan'){
            $number_of_links = 5;
        }elseif($user_plan_name == 'Enterprise Plan'){
            $number_of_links = 20;
        }

        return view('tenant/user_billing', compact(['billing_history', 'payment_methods', 'default_payment_method', 'user_company',
            'user_plan_name', 'subscription_data', 'intent', 'status', 'isPaypal', 'isPaypalDefault', 'seo', 'user_permissions',
            'subscription_info', 'ends_at', 'paypalPlanId', 'nextPaymentDate', 'nextConsultingPaymentDate', 'consulting_subscription_info', 'number_of_links']));
    }


    public function user_billing_v1(Request $request)
    {
        if (!Auth::user()->permissions->contains('code', 'manage_payments')) {
            return redirect('/dashboard/no-permission');
        }

        $user_permissions = Auth::user()->permissions;
        $stripe = new StripeClient(
            env('STRIPE_SECRET')
        );

        $company = auth()->user()->company;

        $intent = $company->createSetupIntent();

        $billing_history = BillingHistory::where('company_id', $company->id)->get();
        $default_payment_method = $company->defaultPaymentMethod();
        $payment_methods = $company->paymentMethods();

        $subscription = $company->subscriptions()->orderBy('id', 'desc')->latest()->first();

        $paypalPlanId = null;

        $user_plan_name = 'Trial';
        $subscription_data = null;
        $isPaypal = false;
        $isPaypalDefault = $company->paypal_default;
        $nextPaymentDate = null;


        $subscription_info = null;



        if ($subscription) {
            if ($subscription->stripe_status === 'active') {
                $user_plan_name = Plans::where('identifier', $subscription->name)->first()->title;

                $paypalPlanId = Plans::where('identifier', $subscription->name . '_pp')->first()->stripe_id;

                $subscription_data = $stripe->subscriptions->retrieve(
                    $subscription->stripe_id,
                    []
                ); 

                $nextPaymentDate = date('Y-m-d', $subscription_data->current_period_end);

                $billing_date = __(date('F', $subscription_data->current_period_end)) . ' ' . date('j/Y', $subscription_data->current_period_end);

                $subscription_info = [
                    'only_payment'=>$subscription_data->plan->amount/100 . '/' . __($subscription_data->plan->interval),
                    'next_payment' => $subscription_data->plan->amount/100 . '/' . __($subscription_data->plan->interval) . ' ' . $billing_date,
                    'next_payment_full' => $subscription_data->plan->amount/100 . '/' . __($subscription_data->plan->interval) .
                        __(' Next payment on ') . $billing_date . ' ' . ($subscription_data->plan->interval == 'month' ?
                        __('Paid monthly') : __('Annual plan')),
                    'interval' => $subscription_data->plan->interval
                ];
            } elseif ($subscription->paypal_status === 'active') {

                $provider = \PayPal::setProvider();
                $provider->getAccessToken();
                $plan_data = $provider->showPlanDetails($subscription->paypal_plan);
                $user_plan_name = $plan_data['name'];
                $subscription_data = $provider->showSubscriptionDetails($subscription->paypal_id);

                $billing_date = __(date('F', strtotime($subscription_data['start_time'] . ' + 1 month'))) . ' ' . date('j/Y', strtotime($subscription_data['start_time'] . ' + 1 month'));

                $isPaypal = true;

                $subscription_info = [
                    'only_payment'=>$plan_data['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'] . '/' .
                    __(strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])),
                    'next_payment' => $plan_data['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'] . '/' .
                        __(strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])) . ' ' . $billing_date,
                    'next_payment_full' => $plan_data['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'] . '/' .
                        __(strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])) .
                        __(' Next payment on ') . $billing_date . ' ' . (strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit']) == 'month' ?
                        __('Paid monthly') : __('Annual plan')),
                    'interval' => strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])
                ];
            }
        }
        $ends_at = $subscription?->ends_at;
        $status = false;
        $user_company = $company;

        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('tenant/user_billing_v1', compact(['billing_history', 'payment_methods', 'default_payment_method', 'user_company',
            'user_plan_name', 'subscription_data', 'intent', 'status', 'isPaypal', 'isPaypalDefault', 'seo', 'user_permissions',
            'subscription_info', 'ends_at', 'paypalPlanId', 'nextPaymentDate']));
    }

    public function user_team(Request $request)
    {
        if (!auth()->user()->company->subscriptions()->first()
            && !auth()->user()->company->onTrial()
            && auth()->user()->email !== 'demo@afdal.com'
            && !auth()->user()->gift) {
            return redirect('/dashboard/no-subscription');
        }

        if (!Auth::user()->permissions->contains('code', 'manage_users')) {
            return redirect('/dashboard/no-permission');
        }

        $this->PickDate();
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        $activities = ActivityLog::where('company_id', Auth::user()->company_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->orderByDesc('date')
            ->get();

        $all_permissions = Permission::get();
        $user_permissions = Auth::user()->permissions;
        $max_user_count = UserPlanHelper::subscription_info()->users;
        $current_user_count = Auth::user()->company->user()->count();
        $add_new_user = $current_user_count < $max_user_count;

        $seo = Seo::where('route', $request->getRequestUri())->first();
        $localization = session()->get('locale');

        return view('tenant/user_team', compact('activities', 'all_permissions', 'user_permissions',
            'max_user_count', 'current_user_count', 'seo', 'add_new_user', 'localization', 'date_from', 'date_to'));
    }

    public function getActivityByDate(Request $request)
    {
        $this->PickDate($request->get('date_from'), $request->get('date_to'));
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        $activities = ActivityLog::where('company_id', Auth::user()->company_id)
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->orderByDesc('date')
            ->get();
        return response()->json([
            'activities' => $activities,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
    }

    public function resource(Request $request)
    {
        return view('tenant/resource');
    }

    public function resource2(Request $request)
    {
        return view('tenant/resource2');
    }

    public function contactus(Request $request)
    {
        return view('tenant/contactus');
    }

    public function pricing(Request $request)
    {
        return view('tenant/pricing');
    }


    public function googleplaystore(Request $request)
    {
        return view('tenant/googleplaystore');
    }


    public function instagraminsight(Request $request)
    {
        return view('tenant/instagraminsight');
    }

    public function facebookAds(Request $request)
    {
        return view('tenant/facebook_ads_new');
    }

    public function facebookPage(Request $request)
    {
        return view('tenant/facebook_page');
    }

    public function facebookEngagement(Request $request)
    {
        return view('tenant/facebook_engagement');
    }

    public function instagramDashboard(Request $request)
    {
        return view('tenant/instagram_dashboard');
    }

    public function noSubscription(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('tenant/locked-screen', compact('seo'));
    }

    public function noPermission(Request $request)
    {
        $seo = Seo::where('route', $request->getRequestUri())->first();

        return view('tenant/permission-locked-screen', compact('seo'));
    }
}
