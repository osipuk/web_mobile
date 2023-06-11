<?php

namespace App\Http\Controllers\v2;

use App\Helpers\UserPlanHelper;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\BillingHistory;
use App\Models\Permission;
use App\Models\Plans;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;
use App\Traits\DatePick;

class BillingController extends Controller
{
    use DatePick;
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
        $new_billing_date=null;

        $subscription_info = null;


        $consultingSubscription = $company->subscriptions()->where('name', 'Analytics Consulting')->orderBy('id', 'desc')->latest()->first();
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
                $new_billing_date = __(date('F', $consulting_subscription_data->current_period_end)) . ' ' . date('j,Y', $consulting_subscription_data->current_period_end);


                $consulting_subscription_info = [
                    'next_payment' => $consulting_subscription_data->plan->amount / 100 . '/' . __($consulting_subscription_data->plan->interval) . ' ' . $billing_date,
                    'ends_at' => date('Y-m-d', $consulting_subscription_data->cancel_at),
                    'next_payment_full' => $consulting_subscription_data->plan->amount / 100 . '/' . __($consulting_subscription_data->plan->interval) .
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
                $new_billing_date = __(date('F', $subscription_data->current_period_end)) . ' ' . date('j,Y', $subscription_data->current_period_end);

                $subscription_info = [
                    'only_payment' => $subscription_data->plan->amount / 100 . '/' . __($subscription_data->plan->interval),
                    'only_next_payment' => __(' Next payment on ') . $billing_date . ' ' . ($subscription_data->plan->interval == 'month' ?
                        __('Paid monthly') : __('Annual plan')),
                    'next_payment' => $subscription_data->plan->amount / 100 . '/' . __($subscription_data->plan->interval) . ' ' . $billing_date,
                    'next_payment_full' => $subscription_data->plan->amount / 100 . '/' . __($subscription_data->plan->interval) .
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
                $new_billing_date = __(date('F', strtotime($subscription_data['start_time'] . ' + 1 month'))) . ' ' . date('j,Y', strtotime($subscription_data['start_time'] . ' + 1 month'));

                $isPaypal = true;

                $subscription_info = [
                    'only_payment' => $plan_data['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'] . '/' .
                        __(strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])),
                    'only_next_payment' => __(' Next payment on ') . ' ' . $billing_date,
                    'next_payment' => $plan_data['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'] . '/' .
                        __(strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])) . ' ' . $billing_date,
                    'next_payment_full' => $plan_data['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'] . '/' .
                        __(strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit'])) .
                        __(' Next payment on ') . $billing_date . ' ' . (strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit']) == 'month' ?
                            __('Paid monthly') : __('Annual plan')),
                    'interval' => strtolower($plan_data['billing_cycles'][0]['frequency']['interval_unit']),
                    'new_billing_date'=>$new_billing_date
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
        if ($user_plan_name == 'Essentials Plan') {
            $number_of_links = 1;
        } elseif ($user_plan_name == 'Plus Plan') {
            $number_of_links = 5;
        } elseif ($user_plan_name == 'Enterprise Plan') {
            $number_of_links = 20;
        }

        return view('tenant/v2/user_billing', compact([
            'billing_history', 'payment_methods', 'default_payment_method', 'user_company',
            'user_plan_name', 'subscription_data', 'intent', 'status', 'isPaypal', 'isPaypalDefault', 'seo', 'user_permissions',
            'subscription_info', 'ends_at', 'paypalPlanId', 'nextPaymentDate', 'nextConsultingPaymentDate', 'consulting_subscription_info', 'number_of_links','new_billing_date'
        ]));
    }

    
    public function user_profile(Request $request)
    {
        $user = Auth::user();
        $user_permissions = $user->permissions;

        $seo = Seo::where('route', $request->getRequestUri())->first();
        return view('tenant/v2/user_profile', compact('user', 'user_permissions', 'seo'));
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

        return view('tenant/v2/user_team', compact('activities', 'all_permissions', 'user_permissions',
            'max_user_count', 'current_user_count', 'seo', 'add_new_user', 'localization', 'date_from', 'date_to'));
    }
}
