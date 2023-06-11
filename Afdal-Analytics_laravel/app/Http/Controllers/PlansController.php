<?php

namespace App\Http\Controllers;

use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Classes\Activity;
use App\Events\SubscriptionPlanCreatedEvent;
use App\Classes\IntercomAPI;
use App\Http\Controllers\ActiveCampaitngController;
use App\Helpers\UserPlanHelper;
use App\Models\BillingHistory;
use App\Models\Dashboard;
use App\Models\Plans;
use App\Models\SocialAccount;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;
use Stripe\StripeClient;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Symfony\Component\Intl\Currencies;
use Symfony\Polyfill\Intl\Icu\NumberFormatter;

class PlansController extends Controller
{
    public function checkoutChangeDefaultMethod(Request $request){
        $this->validate($request, [
            'payment_id' => 'required'
        ]);
        $company = auth()->user()->company;
        if($request->payment_id=='paypal-method'){
            $company->paypal_default = true;
            $company->save();
            $company->updateDefaultPaymentMethodFromStripe();
        }else{
            $company->paypal_default = false;
            $company->save();
            $paymentMethod = $company->findPaymentMethod($request->payment_id);
            $company->updateDefaultPaymentMethod($paymentMethod->id);
        }
    }
    public function index()
    {
        return view('frontend.test-payment-form');
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'token' => 'required'
        ]);

        $stripe = new StripeClient(
            env('STRIPE_SECRET')
        );

        $company = Auth::user()->company;
        $company->createOrGetStripeCustomer();
        $company->paypal_default = false;
        $paymentMethod = $stripe->paymentMethods->retrieve(
            $request->token,
            []
        );
        $company->updateDefaultPaymentMethod($paymentMethod);
        
        return back()->with('paymentMethodAdded', true);
    }

    public function deletePaymentMethod(Request $request)
    {

        $company = auth()->user()->company;

        if ($request->pm_id == 'paypal-method') {
            $company->paypal_method = false;
            $company->save();
        } else {
            $company->deletePaymentMethod($request->pm_id);
        }

        return response()->json(['paymentMethods' => Auth::user()->company->paymentMethods()]);
    }

    public function updatePaymentMethod(Request $request)
    {
        $company = auth()->user()->company;
        $provider = new PayPalClient;
        $provider->getAccessToken();

        
        // dd($activeSubscription);
        if ($request->pm_id == 'paypal-method') {
            $company->paypal_default = true;
            $company->save();
            $activeSubscription = $company->subscriptions()->where('stripe_status','active')->where('name','!=','Analytics Consulting')->first();
            if ($activeSubscription) {
                $activeSubscription->cancelNow();
                
                //cancel paypal subscription if exists
                // $this->unsubscribePlan($request, 'paypal');
                $subscription = $provider->showSubscriptionDetails($request->subscriptionID);
                DB::table('subscriptions')->where('id', $activeSubscription->id)->update([
                    'paypal_id' => $request->subscriptionID,
                    'paypal_plan' => $subscription['plan_id'],
                    'paypal_status' => 'active',
                    'quantity' => $subscription['quantity']
                ]);
            }

            $company->updateDefaultPaymentMethodFromStripe();
        } else {
            $company->paypal_default = false;
            $company->save();
            $activeSubscription = $company->subscriptions()->where('paypal_status','active')->where('name','!=','Analytics Consulting')->first();
            if ($activeSubscription) {
                $plan = Plans::where('identifier', substr(Plans::where('stripe_id', $activeSubscription->paypal_plan)->first()->identifier, 0, -3))->first();
                $anchor = Carbon::parse($provider->showSubscriptionDetails($activeSubscription->paypal_id)['billing_info']['next_billing_time']);

                $provider->cancelSubscription($activeSubscription->paypal_id, 'Cancel subscription');

                DB::table('subscriptions')->where('company_id', $company->id)
                    ->where('paypal_id', $activeSubscription->paypal_id)->update([
                        'paypal_status' => 'canceled'
                    ]);
                //cancel stripe subscription if exists
                // $this->unsubscribePlan($request, 'stripe');
                $company->newSubscription($plan->identifier, $plan->stripe_id)
                    ->anchorBillingCycleOn($anchor->startOfDay())
                    ->create($request->pm_id);
                    //cancel payapl subscription if exists in affect of change plan
                    // $this->unsubscribePlan($request, 'paypal');
            }
            // $payment_history = $company->invoices();

            // foreach ($payment_history as $item) {
            //     BillingHistory::updateOrCreate([
            //         'transaction_id' => $item->id,
            //         'company_id' => $company->id,
            //     ], [
            //         'transaction_id' => $item->id,
            //         'company_id' => $company->id,
            //         'status' => $item->status,
            //         'customer_name' => $company->name,
            //         'description' => $item->billing_reason,
            //         'date' => date('Y-m-d', $item->created),
            //         'amount' => $item->amount_paid / 100,
            //         'invoice_pdf' => $item->invoice_pdf
            //     ]);
            // }
            $paymentMethod = $company->findPaymentMethod($request->pm_id);
            $company->updateDefaultPaymentMethod($paymentMethod->id);
        }

        $request->session()->put('pmUpdated', true);
        return response()->json(['paymentMethods' => $company->defaultPaymentMethod()]);
    }

    public function setPaypalMethod(Request $request)
    {
        $company = Auth::user()->company;
        // if($company->paypal_method || empty())
        // $activeSubscription = $company->subscriptions()->where('paypal_status','active')->where('name','!=','Analytics Consulting')->first();
        $company->paypal_default = true;
       
        $company->paypal_method = true;
        $company->save();
        $request->session()->put('paymentMethodAdded', true);
        return response()->json('');
    }

    protected function getHardcodedPrice($currency, $plan, $type)
    {

        $hardCodedCurrencyAmount = [
            'essentials' => [
                'KWD' => 5,
                'SAR' => 60,
                'EGP' => 300,
                'DZD' => 2250,
                'BHD' => 6,
                'KMF' => 7500,
                'IQD' => 22800,
                'DJF' => 2750,
                'JOD' => 12,
                'LBP' => 23900,
                'LYD' => 75,
                'MAD' => 160,
                'OMR' => 7,
                'QAR' => 60,
                'SOS' => 8750,
                'SDG' => 8750,
                'SYP' => 39573,
                'TND' => 50,
                'AED' => 60,
                'YER' => 3938,
                'USD' => 5,
                'ILS' => 53,


            ],
            'plus' => [
                'KWD' => 4,
                'SAR' => 40,
                'EGP' => 200,
                'DZD' => 1500,
                'BHD' => 4,
                'KMF' => 5000,
                'IQD' => 1520,
                'DJF' => 1850,
                'JOD' => 8,
                'LBP' => 16000,
                'LYD' => 50,
                'MAD' => 108,
                'OMR' => 5,
                'QAR' => 40,
                'SOS' => 5900,
                'SDG' => 5900,
                'SYP' => 26382,
                'TND' => 33,
                'AED' => 40,
                'YER' => 2625,
                'USD' => 10,
                'ILS' => 175,


            ],
            'enterprise' => [
                'KWD' => 2,
                'SAR' => 20,
                'EGP' => 100,
                'DZD' => 750,
                'BHD' => 2,
                'KMF' => 2500,
                'IQD' => 7600,
                'DJF' => 925,
                'JOD' => 4,
                'LBP' => 8000,
                'LYD' => 25,
                'MAD' => 54,
                'OMR' => 3,
                'QAR' => 20,
                'SOS' => 3000,
                'SDG' => 3000,
                'SYP' => 13191,
                'TND' => 17,
                'AED' => 20,
                'YER' => 1313,
                'USD' => 15,
                'ILS' => 360
            ]
        ];

        //  dd($hardCodedCurrencyAmount[$plan][$currency], $type);
        if (array_key_exists($currency, $hardCodedCurrencyAmount[$plan])) {
            //echo "The key 'France' is exists in the cities array";
            //dd($currency, $plan, $hardCodedCurrencyAmount[$plan]);
            if ($type == 'amount') {

                return ($hardCodedCurrencyAmount[$plan][$currency]);
            } else {

                return $currency;
            }
        } else {
            // dd($currency, $type, $plan);
            // return ($hardCodedCurrencyAmount[$plan]['USD']);
            if ($type == 'amount') {
                // dd($hardCodedCurrencyAmount[$plan]['USD']);
                return ($hardCodedCurrencyAmount[$plan]['USD']);
            } else {
                return 'USD';
            }
        }
    }

    public function subscribe(Request $request)
    {
        $company = Auth::user()->company;
        $plan = Plans::where('identifier', $request->plan)->first();

        $intercom = new IntercomAPI();
        $ActiveCampaitng = new ActiveCampaitngController();
        $activity = new Activity();
        $subsc = null;

        // $ip =  isset($request->usragentip) ? $request->usragentip: request()->ip() ;
        // $currency = isset($request->currency) ? $request->currency: 'USD' ;
        //  if($currency == 'MRO'){
        // $currency = 'USD';
        // }

        $payment_method = $company->defaultPaymentMethod();

        if ($payment_method) {
            $activeSubscription = $this->getActiveSubscription();

            if ($activeSubscription) {
                $activeSubscription->name = $plan->identifier;
                $activeSubscription->swapAndInvoice($plan->stripe_id);
                $activeSubscription = $this->getActiveSubscription();
                
                $intercom->changePlan($plan->title);
                //active campaign change plan tracking:
                $ActiveCampaitng->EventTrackingCreation($plan->title);
                $ActiveCampaitng->EventTrackingAPI($plan->title,'changePlan','');



                $type = 'change_plan';
            } else {
                //check request data
                $this->unsubscribePlan($request, 'paypal');
                $company->update([
                    'trial_ends_at' => null
                ]);
                $subsc = $company->newSubscription($request->plan, $plan->stripe_id)->create(
                    $payment_method->token,
                    [
                        'name' => $company->name,

                    ]
                    //['currency' => $this->getHardcodedPrice($currency, 'essentials', 'name')]

                    //$this->getHardcodedPrice($currency, 'essentials', 'name')

                );
                $intercom->changePlan($plan->title);
                $ActiveCampaitng->EventTrackingCreation($plan->title);
                $ActiveCampaitng->EventTrackingAPI($plan->title,'changePlan','');

                $activeSubscription = $this->getActiveSubscription();
                $type = 'subscribe';
            }
            $stripe = new StripeClient(
                env('STRIPE_SECRET')
            );
            $subscription_data = $stripe->subscriptions->retrieve(
                $activeSubscription->stripe_id,
                []
            );
            $subscription_data->plan->name = $activeSubscription->name;
            $subscription_data->plan->price = $subscription_data->plan->amount / 100;
            $subscription_data->plan->current_period_end = date('Y-m-d', $subscription_data->plan->current_period_end);
            $subscription_data->plan->current_period_start = date('Y-m-d', $subscription_data->plan->current_period_start);
            $activity->addActivity($type, $activeSubscription->name, $subscription_data->plan);
            $payment_history = $company->invoices();

            foreach ($payment_history as $item) {
                BillingHistory::updateOrCreate([
                    'transaction_id' => $item->id,
                    'company_id' => $company->id,
                ], [
                    'transaction_id' => $item->id,
                    'company_id' => $company->id,
                    'status' => $item->status,
                    'customer_name' => $company->name,
                    'description' => $item->billing_reason,
                    'date' => date('Y-m-d', $item->created),
                    'amount' => $item->amount_paid / 100,
                    'invoice_pdf' => $item->invoice_pdf
                ]);
            }
        } else {
            $request->session()->put('noPaymentMethod', true);
            return ['noPaymentMethod' => true];
        }

        SubscriptionPlanCreatedEvent::dispatch(
            Auth::user(),
            $subscription_data->plan->name,
            $subscription_data->plan->amount / 100
        );
        $this->checkSubscriptionLimitations();
        $request->session()->put('subscriptionCreated', true);



        return json_encode([
            'stripe_id' => $activeSubscription->stripe_id,
            'charge_id' => $subscription_data->customer,
            'amount' => $subscription_data->plan->price,
        ]);
    }

    public function subscribe_consulting(Request $request)
    {
        $company = Auth::user()->company;
        $plan = Plans::where('identifier', 'consulting')->first();

        $intercom = new IntercomAPI();
        $activity = new Activity();
        $subsc = null;

        $payment_method = $company->defaultPaymentMethod();
        if ($payment_method) {
            $activeSubscription = $this->getActiveConsultingSubscription();
            //return json_encode($activeSubscription);


            /*

             if ($activeSubscription) {
                            $activeSubscription->name = $plan->identifier;
                            $activeSubscription->swapAndInvoice($plan->stripe_id);
                            $activeSubscription = $this->getActiveConsultingSubscription();

                            $intercom->changePlan($plan->title);
                            $type = 'change_plan';
                        } else
            */


            if (!$activeSubscription) {
                $company->update([
                    'trial_ends_at' => null
                ]);

                $subsc = $company->newSubscription($plan->title, $plan->stripe_id)->create($payment_method->token, [
                    'name' => $company->name
                ]);

                $intercom->changePlan($plan->title);
                //$ActiveCampaitng->EventTrackingCreation($plan->title);
                //$ActiveCampaitng->EventTrackingAPI($plan->title,'changePlan','');
                $activeSubscription = $this->getActiveConsultingSubscription();
                $type = 'subscribe';
            }

            $stripe = new StripeClient(
                env('STRIPE_SECRET')
            );

            //return json_encode($activeSubscription);
            $subscription_data = $stripe->subscriptions->retrieve(
                $activeSubscription->stripe_id,
                []
            );
            $subscription_data->plan->name = $activeSubscription->name;
            $subscription_data->plan->price = $subscription_data->plan->amount / 100;
            $subscription_data->plan->current_period_end = date('Y-m-d', $subscription_data->plan->current_period_end);
            $subscription_data->plan->current_period_start = date('Y-m-d', $subscription_data->plan->current_period_start);
            $activity->addActivity($type, $activeSubscription->name, $subscription_data->plan);
            $payment_history = $company->invoices();

            foreach ($payment_history as $item) {
                BillingHistory::updateOrCreate([
                    'transaction_id' => $item->id,
                    'company_id' => $company->id,
                ], [
                    'transaction_id' => $item->id,
                    'company_id' => $company->id,
                    'status' => $item->status,
                    'customer_name' => $company->name,
                    'description' => $item->billing_reason,
                    'date' => date('Y-m-d', $item->created),
                    'amount' => $item->amount_paid / 100,
                    'invoice_pdf' => $item->invoice_pdf
                ]);
            }
        } else {
            $request->session()->put('noPaymentMethod', true);
            return ['noPaymentMethod' => true];
        }

        SubscriptionPlanCreatedEvent::dispatch(
            Auth::user(),
            $subscription_data->plan->name,
            $subscription_data->plan->amount / 100
        );
        //$this->checkSubscriptionLimitations();
        $request->session()->put('subscriptionCreated', true);



        return json_encode([
            'stripe_id' => $activeSubscription->stripe_id,
            'charge_id' => $subscription_data->customer,
            'amount' => $subscription_data->plan->price,
        ]);
    }

    public function unsubscribePlan($request, $which_plan = null)
    {
        $company = Auth::user()->company;
        if ($which_plan == 'paypal') {
            $activeSubscription = $company->subscriptions()
            ->where('paypal_status', 'active')->first();
            if($activeSubscription){
                $activity = new Activity();
                $activity->addActivity('cancel_subscription', $activeSubscription->name);
                $provider = new PayPalClient;
                $provider->getAccessToken();
                $provider->cancelSubscription($activeSubscription->paypal_id, 'Cancel subscription');
    
                DB::table('subscriptions')->where('company_id', $company->id)
                    ->where('paypal_id', $activeSubscription->paypal_id)->update([
                        'paypal_status' => 'canceled'
                    ]);
                    
            }
            
        } elseif ($which_plan == 'stripe') {
            //unsubscribe stripe
            $activity = new Activity();
            $activeSubscription = $company->subscriptions()->where('name', '!=', 'Analytics Consulting')->where('stripe_status', 'active')->first();
            if ($activeSubscription) {
                    // $activity->addActivity('cancel_subscription', $as->name);
                $activeSubscription->cancelNow();
                    // $request->session()->put('subscriptionCanceled', true);
                    // $company->updateDefaultPaymentMethodFromStripe();
            }
            
        }
        return;
    }

    public function unsubscribe(Request $request)
    {
        $activity = new Activity();
        $activeSubscription = auth()->user()->company->subscriptions()->where('name', '!=', 'Analytics Consulting')->get()->sortByDesc('id')->first();
        $activity->addActivity('cancel_subscription', $activeSubscription->name);


        $given_subscription_id = $activeSubscription->stripe_id;
        $get_tapfilliate_id_of_subscription = [];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.tapfiliate.com/1.6/conversions/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-API-Key:0b78bd667348f09f1544fb2204ed476bdb278d8c",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
        } else {
            $data = (json_decode($response));

            foreach ($data as $d) {
                if ($d->external_id == $given_subscription_id) {
                    $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => "https://api.tapfiliate.com/1.6/conversions/" . $d->id . "/",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "DELETE",
                        CURLOPT_HTTPHEADER => [
                            "X-API-Key:0b78bd667348f09f1544fb2204ed476bdb278d8c",
                            "content-type: application/json"
                        ],

                    ]);

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                        //echo "cURL Error #:" . $err;
                    } else {
                        DB::table('tapfiliate_conversions')->where([['user_id', Auth::id()], ['subscription_id', $d->external_id]])->update(['subscription_status' => 0]);
                    }
                }
            } //endforeach
        }

        $activeSubscription->cancelNow();
        $request->session()->put('subscriptionCanceled', true);
        return ['subscriptionCanceled' => true];
    }

    public function unsubscribeConsulting(Request $request)
    {
        $activity = new Activity();
        $activeSubscription = auth()->user()->company->subscriptions()->where('name', 'Analytics Consulting')->first();
        $activity->addActivity('cancel_consulting_subscription', $activeSubscription->name);


        $given_subscription_id = $activeSubscription->stripe_id;
        $get_tapfilliate_id_of_subscription = [];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.tapfiliate.com/1.6/conversions/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-API-Key:0b78bd667348f09f1544fb2204ed476bdb278d8c",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
        } else {
            $data = (json_decode($response));

            foreach ($data as $d) {
                if ($d->external_id == $given_subscription_id) {
                    $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => "https://api.tapfiliate.com/1.6/conversions/" . $d->id . "/",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "DELETE",
                        CURLOPT_HTTPHEADER => [
                            "X-API-Key:0b78bd667348f09f1544fb2204ed476bdb278d8c",
                            "content-type: application/json"
                        ],

                    ]);

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                        //echo "cURL Error #:" . $err;
                    } else {
                        DB::table('tapfiliate_conversions')->where([['user_id', Auth::id()], ['subscription_id', $d->external_id]])->update(['subscription_status' => 0]);
                    }
                }
            } //endforeach




        }



        $activeSubscription->cancelNow();







        $request->session()->put('subscriptionCanceled', true);
        return ['subscriptionCanceled' => true];
    }

    public function paypalDetails()
    {

        /*
        $company = Auth::user()->company;

        $intercom = new IntercomAPI();
        $provider = new PayPalClient;
        $provider->getAccessToken();
       // $plans = $provider->listPlans();

       // $subscription = $provider->showPlanDetails('P-1X598837EK161015BMI2DAKA');


$response = $provider->addProduct('Enterprise', 'Enterprise', 'SERVICE', 'SOFTWARE')

            ->addMonthlyPlan('Enterprise', 'Enterprise', 100);


$response = $provider->addProduct('Plus', 'Plus', 'SERVICE', 'SOFTWARE')

            ->addMonthlyPlan('Plus', 'Plus', 50);



$response = $provider->addProduct('Essentails Product', 'Essentails Product', 'SERVICE', 'SOFTWARE')
->addPlanTrialPricing('DAY', 7)

            ->addMonthlyPlan('EssentailsPlan', 'EssentailsPlan', 15);


    //        ->setReturnAndCancelUrl('/subscription-successful', '/cancel-paypal-subscription');
            //->setupSubscription('John Doe', 'john@example.com', '2021-12-10');
        $plans = $provider->listPlans(2);

        dd($plans, $response);
        $subscription = $provider->showSubscriptionDetails($request->subscriptionID);
        $plan = $provider->showPlanDetails($subscription['plan_id']);
        $order = $provider->showOrderDetails($request->orderID);
*/
    }

    public function subscribePaypal(Request $request)
    {
        $company = $request->user()->company;

        $intercom = new IntercomAPI();
        $provider = new PayPalClient;
        $provider->getAccessToken();

        $subscription = $provider->showSubscriptionDetails($request->subscriptionID);

        $plan = $provider->showPlanDetails($subscription['plan_id']);
        $order = $provider->showOrderDetails($request->orderID);

        $this->unsubscribePlan($request, 'stripe');

        $activeSubscription = $company->subscriptions()
            ->where('paypal_status', 'active')->first();

        // dd($activeSubscription, $request);

        if ($activeSubscription) {
            $this->unsubscribePaypal($request);

            $company->subscriptions()->where('paypal_status', 'canceled')->orWhere('paypal_status', 'active')->update([
                'name' => $plan['name'],
                'paypal_id' => $request->subscriptionID,
                'paypal_plan' => $subscription['plan_id'],
                'paypal_status' => 'active'
            ]);

            $intercom->changePlan($plan['name'] . ' Plan');
            $ActiveCampaitng = new ActiveCampaitngController();
            $ActiveCampaitng->EventTrackingCreation($plan['name'] . ' Plan');
            $ActiveCampaitng->EventTrackingAPI($plan['name'] . ' Plan','changePlan','');
            // $intercom->EventTrackingAPI('ACEvent','abc"');
            $type = 'change_plan';
        } else {
            $company->update([
                'trial_ends_at' => null
            ]);

            DB::table('subscriptions')->insert([
                'company_id' => $company->id,
                'name' => $plan['name'],
                'paypal_id' => $request->subscriptionID,
                'paypal_plan' => $subscription['plan_id'],
                'paypal_status' => 'active',
                'quantity' => $subscription['quantity']
            ]);

            $intercom->changePlan($plan['name'] . ' Plan');
            $ActiveCampaitng = new ActiveCampaitngController();
            $ActiveCampaitng->EventTrackingCreation($plan['name'] . ' Plan');
            $ActiveCampaitng->EventTrackingAPI($plan['name'] . ' Plan','changePlan','');

            $type = 'subscribe';
        }
        $price = rtrim(rtrim($plan['billing_cycles'][0]['pricing_scheme']['fixed_price']['value'], '0'), '.');
        $period = strtolower($plan['billing_cycles'][0]['frequency']['interval_unit']);
        $subscription_info = new stdClass();
        $subscription_info->name = __(ucfirst($plan['name']));
        $subscription_info->price = $price;
        $subscription_info->period = $period;
        $subscription_info->current_period_start = date('Y-m-d', strtotime($subscription['start_time']));
        $subscription_info->current_period_end = date('Y-m-d', strtotime($subscription['start_time'] . ' + 1 ' . $period));

        BillingHistory::updateOrCreate([
            'transaction_id' => $request->orderID,
            'company_id' => $company->id,
        ], [
            'transaction_id' => $request->orderID,
            'company_id' => $company->id,
            'status' => $order['status'],
            'customer_name' => $company->name,
            'description' => $activeSubscription ? 'subscription_update' : 'subscription_create',
            'date' => date('Y-m-d', strtotime($order['create_time'])),
            'amount' => $price,
            'invoice_pdf' => 'test',
            'service_name' => $plan['name'] . ' Plan'
        ]);

        $activity = new Activity();
        $activity->addActivity($type, $plan['name'], $subscription_info);

        SubscriptionPlanCreatedEvent::dispatch(
            Auth::user(),
            $plan['name'],
            $subscription_info->price
        );

        $this->checkSubscriptionLimitations();
        $request->session()->put('subscriptionCreated', true);



        return json_encode([
            'stripe_id' => $request->subscriptionIDD,
            'charge_id' => $request->orderID,
            'amount' => $subscription_info->price,
        ]);
    }

    public function unsubscribePaypal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->getAccessToken();
        $company = auth()->user()->company;

        $activeSubscription = $company->subscriptions()
            ->where('paypal_status', 'active')->get()->sortByDesc('id')->first();

        $activity = new Activity();
        $activity->addActivity('cancel_subscription', $activeSubscription->name);

        $provider->cancelSubscription($activeSubscription->paypal_id, 'Cancel subscription');

        DB::table('subscriptions')->where('company_id', $company->id)
            ->where('paypal_id', $activeSubscription->paypal_id)->update([
                'paypal_status' => 'canceled'
            ]);
        $given_subscription_id = $activeSubscription->paypal_id;
        $get_tapfilliate_id_of_subscription = [];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.tapfiliate.com/1.6/conversions/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-API-Key:0b78bd667348f09f1544fb2204ed476bdb278d8c",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
        } else {
            $data = (json_decode($response));

            foreach ($data as $d) {
                if ($d->external_id == $given_subscription_id) {
                    $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => "https://api.tapfiliate.com/1.6/conversions/" . $d->id . "/",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "DELETE",
                        CURLOPT_HTTPHEADER => [
                            "X-API-Key:0b78bd667348f09f1544fb2204ed476bdb278d8c",
                            "content-type: application/json"
                        ],

                    ]);

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                        //echo "cURL Error #:" . $err;
                    } else {
                        DB::table('tapfiliate_conversions')->where([['user_id', Auth::id()], ['subscription_id', $d->external_id]])->update(['subscription_status' => 0]);
                    }
                }
            } //endforeach




        }

        $request->session()->put('subscriptionCanceled', true);
        return ['subscriptionCanceled' => true];
    }

    public function getPaypalInvoice($id)
    {
        $provider = new PayPalClient;

        $provider->getAccessToken();

        $order = BillingHistory::where('transaction_id', $id)->firstOrFail();

        $pdfData = [
            'order' => $provider->showOrderDetails($id),
            'amount' => $order->amount,
            'service_name' => $order->service_name,
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('tenant/components/paypal-pdf', $pdfData);
        return $pdf->stream();
    }

    public function getActiveSubscription()
    {
        return auth()->user()->company->subscriptions()
            ->where([['stripe_status', 'active'], ['name', '!=', 'Analytics Consulting']])->first();
    }

    public function getActiveConsultingSubscription()
    {
        return auth()->user()->company->subscriptions()
            ->where('name', 'Analytics Consulting')->where('stripe_status', 'active')->first();
    }

    public function checkSubscriptionLimitations()
    {
        $company_id = Auth::user()->company_id;
        $subscription_info = UserPlanHelper::subscription_info();
        $social_accounts = SocialAccount::where('company_id', $company_id)->where('disabled', false);
        $connections_number = $social_accounts->count();
        if ($connections_number > $subscription_info->connections) {
            $disabled_number = $connections_number - $subscription_info->connections;
            $social_accounts->orderBy('created_at', 'desc')->limit($disabled_number)->get()
                ->map(function ($item) use ($company_id) {
                    $item->update(['disabled' => true]);
                    Dashboard::where('company_id', $company_id)->where('social_account_id', $item->id)->delete();
                });
        } else {
            $social_accounts->orderBy('created_at', 'asc')
                ->limit($subscription_info->connections)
                ->update(['disabled' => false]);
        }
        $company_users = User::where('company_id', $company_id)->where('disabled', false);
        $user_number = $company_users->count();
        if ($user_number > $subscription_info->users) {
            $disabled_user = $user_number - $subscription_info->users;
            $company_users->orderBy('created_at', 'desc')
                ->limit($disabled_user)
                ->update(['disabled' => true]);
        } else {
            $company_users
                ->orderBy('created_at', 'asc')
                ->limit($subscription_info->users)
                ->update(['disabled' => false]);
        }
    }

    public function test()
    {
        $provider = new PayPalClient;

        $provider->getAccessToken();

        //        $data = json_decode('{
        //  "plan_id": "P-1X598837EK161015BMI2DAKA",
        //  "start_time": "2022-06-02T18:15:00Z",
        //  "quantity": "1",
        //  "subscriber": {
        //    "name": {
        //      "given_name": "Ed",
        //      "surname": "Yerastov"
        //    },
        //    "email_address": "customer@example.com"
        //  },
        //  "application_context": {
        //    "brand_name": "walmart",
        //    "locale": "en-US",
        //    "user_action": "SUBSCRIBE_NOW",
        //    "return_url": "https://example.com/returnUrl",
        //    "cancel_url": "https://example.com/cancelUrl"
        //  }
        //}', true);
        //
        //        $dataAr = [
        //            'plan_id' => "P-9GV44546LH315292LMI2DCSA",
        //            'start_time' => "2022-06-02T18:25:00Z",
        //            "quantity" => "1",
        //            "subscriber" => [
        //                'name' => [
        //                    "given_name" => "Ed",
        //                    "surname" => "Yerastov"
        //                ],
        //                "email_address" => "customer@example.com"
        //            ]
        //        ];
        //
        //
        //        $subscription = $provider->createSubscription($data);
        //        dd($subscription);


        return view('frontend/dashboard_pricing');
    }
}
