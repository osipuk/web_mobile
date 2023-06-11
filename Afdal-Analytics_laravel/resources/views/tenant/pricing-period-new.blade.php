@section('metahead')
    <title>{{__("Pricing")}}</title>
    <meta name="description"
          content="تعرف على خطط منصة أفضل التحليلات المتنوعة">
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
@endsection
@include('layout.userhead')
<div class="pricing-period-page">
    <div class="pricing-period-page-header d-flex align-items-center justify-content-center">
        <a href="{{url('pricing')}}" class="pricing-period-page-header-back d-flex align-items-center">
            <img class="mr-1" src="{{url('assets/image_new/svg/colored/arrow-right.svg')}}" alt="">
            <span class="font-16-lh-26-bold">{{__('Back')}}</span>
        </a>
        <span class="font-28-lh-42-semi-bold mx-auto">{{__('Review Your Choice')}}</span>
        <div></div>
    </div>
    <div class="pricing-period-page-body d-flex align-items-center flex-column" >
        <span class="font-48-lh-56-semi-bold text-center">
        @if($user_plan_name=='')    
        {{__("You're switching ") . __(" to ") . __($wanted_plan_name)}}
        @else
        {{__("You're switching ") . __("from "). __($user_plan_name) . __(" to ") . __($wanted_plan_name)}}
        @endif
        </span>
        <div class="subscription-data text-right row">
            <div class="col-12 col-md-6 pr-0 d-flex flex-column align-items-start">
                <span class="text-dark font-16-lh-26-bold">{{__('Check out')}}</span>
                <!-- <span class="font-15-lh-20-semi-bold">{{__('What happens next')}}:</span> -->
                
                <div class="right-data-wrapper">
                    <div class="align-items-center">
                        <div class="d-flex flex-column align-items-start mb-3">
                            <span class="font-15-lh-20-semi-bold">1.{{__('Billing Cycle')}}</span>
                        </div>
                        <div class="d-flex justify-content-between my-1 checkout-availble-plans" style="background: #E4EAF2;">
                            <div class="flex-fill flex-grow-1 mt-2" style="margin-inline-start: 1.5rem;">
                                <div class="row">
                                    <input type="radio" name="selected_plan" checked class="cursor-p">
                                    <label class="ml-1"><p class="mr-1 mb-0 cursor-p">{{__('Paid monthly')}}</p></label>
                                </div>
                            </div>
                            <div class="flex-fill text-left mt-2" style="margin-inline-end: 1rem;">
                            {{$price_currency  . $price_month . '/' .__('month')}}
                            </div>
                        </div>
                        {{--<div class="d-flex justify-content-between my-1 checkout-availble-plans" style="background: #FFFFFF;">
                            <div class="flex-fill flex-grow-1 mt-2" style="margin-inline-start: 1.5rem;">
                                <div class="row">
                                    <input type="radio" name="abc" class="cursor-p">
                                    <label class="ml-1"><p class="mr-1 mb-0 cursor-p">{{__('Annual plan')}}</p></label>
                                    <span class="two-month-free-badge">{{__('2 month for free')}}</span>
                                </div>
                            </div>
                            <div class="flex-fill text-left mt-2 mr-3">
                            {{$price_currency  . $price_year . '/' .__('year')}}
                            </div>
                        </div>--}}
                    </div>
                    <hr>
                    <div class="align-items-center" style="margin-top: 38px;">
                        <div class="d-flex flex-column align-items-start mb-3"">
                            <span class="font-15-lh-20-semi-bold">2. {{__('Billing information')}}</span>
                        </div>
                        <div class="d-flex justify-content-between my-1">
                            <div class="flex-fill flex-grow-1 checkout-billing-inforamtion">
                            {{__('Name')}}:<br>
                            {{__('Address')}}:
                            </div>
                            <div class="flex-fill checkout-billing-inforamtion">
                            {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                            <br>
                            {{Auth::user()->company->name}}
                            <br>
                            {{Auth::user()->address}},{{Auth::user()->city}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="align-items-center" style="margin-top: 38px;">
                        <div class="d-flex flex-column align-items-start mb-3">
                            <span class="font-15-lh-20-semi-bold">3. {{__('Payment method')}}</span>
                        </div>
                        <div class="d-flex">
                            <button onclick="openAddPaymentMethod('stripe')" data-toggle="modal"  data-target="#payment-method" class="flex-fill checkut-add-card-buttons">
                                {{__('Add credit card')}}
                            </button>
                            <div class="d-flex flex-fill px-4">
                                <div class="flex-fill user-billing-payment-mc-image" style="margin-inline-end: 0.5rem;"></div>
                                <div class="flex-fill user-billing-payment-visa-image"></div>
                            </div>
                            <button onclick="openAddPaymentMethod('paypal')" data-toggle="modal" data-target="#payment-method" class="flex-fill checkut-add-card-buttons">
                                {{__('Add PayPal')}} 
                            </button>
                            <div class="flex-fill">
                                <div class="user-billing-payment-paypal-image " style="margin-inline-start: 0.5rem;"></div>
                            </div>
                        </div>
                        @if(!$payment_methods->isEmpty() || $user_company->paypal_method)
                        
                            @foreach($payment_methods as $payment_method)
                            <div class="d-flex justify-content-between my-1 align-items-center checkout-available-cards" style=" @if(!$isPaypalDefault && ($payment_method == $default_payment_method)) background: #E4EAF2 @else background: #FFFFFF @endif">
                                <div class="flex-fill" style="margin-inline-start: 1.5rem;">
                                    <div class="row">
                                        <input type="radio" @if(!$isPaypalDefault && ($payment_method == $default_payment_method)) checked @endif name="select_default_payment_method" onclick="changedefaultMethodCheckout('{{ $payment_method->id }}')" class="cursor-p mt-1">
                                        @if($payment_method->card->brand==='visa')
                                        <div class="user-billing-payment-visa-image" style="margin-inline-start: 0.5rem;"></div>
                                        @else
                                        <div class="ml-2 user-billing-payment-mc-image"></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-fill">
                                Ending: **** **** **** {{ $payment_method->card->last4 }}
                                <br>
                                Expires: {{ $payment_method->card->exp_month }}/{{ $payment_method->card->exp_year }}
                                </div>
                                
                                @if(!$isPaypalDefault && ($payment_method == $default_payment_method))
                                <div class="flex-fill text-left" style="margin-inline-end: 1rem;">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.66634 10.333L2.33301 6.99967L3.27301 6.05301L5.66634 8.44634L10.7263 3.38634L11.6663 4.33301L5.66634 10.333ZM6.99968 0.333008C5.68114 0.333008 4.3922 0.724001 3.29588 1.45654C2.19955 2.18909 1.34506 3.23028 0.840481 4.44845C0.335896 5.66663 0.203874 7.00707 0.461109 8.30028C0.718344 9.59348 1.35328 10.7814 2.28563 11.7137C3.21798 12.6461 4.40587 13.281 5.69908 13.5382C6.99228 13.7955 8.33273 13.6635 9.5509 13.1589C10.7691 12.6543 11.8103 11.7998 12.5428 10.7035C13.2754 9.60715 13.6663 8.31822 13.6663 6.99967C13.6663 6.1242 13.4939 5.25729 13.1589 4.44845C12.8238 3.63961 12.3328 2.90469 11.7137 2.28563C11.0947 1.66657 10.3597 1.17551 9.5509 0.840478C8.74206 0.505446 7.87516 0.333008 6.99968 0.333008Z" fill="#28D0AF"/>
                                    </svg>
                                    <span style="font-size: 13px;">{{__('Primary')}}</span>
                                </div>
                                @else
                                <div class="flex-fill text-left mr-3" style="opacity: 0;">
                                    n primary
                                </div>
                                @endif
                            
                            </div>
                            <!-- <div class="d-flex justify-content-between my-1 align-items-center checkout-available-cards" style="background: #FFFFFF">
                                <div class="flex-fill ml-4">
                                    <div class="row">
                                        <input type="radio" name="abc" class="cursor-p mt-1">
                                        <div class="user-billing-payment-visa-image ml-2"></div>
                                    </div>
                                </div>
                                <div class="flex-fill">
                                Ending: **** **** **** 5516
                                <br>
                                Expires: 01/2024
                                </div>
                                <div class="flex-fill text-left mr-3">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.66634 10.333L2.33301 6.99967L3.27301 6.05301L5.66634 8.44634L10.7263 3.38634L11.6663 4.33301L5.66634 10.333ZM6.99968 0.333008C5.68114 0.333008 4.3922 0.724001 3.29588 1.45654C2.19955 2.18909 1.34506 3.23028 0.840481 4.44845C0.335896 5.66663 0.203874 7.00707 0.461109 8.30028C0.718344 9.59348 1.35328 10.7814 2.28563 11.7137C3.21798 12.6461 4.40587 13.281 5.69908 13.5382C6.99228 13.7955 8.33273 13.6635 9.5509 13.1589C10.7691 12.6543 11.8103 11.7998 12.5428 10.7035C13.2754 9.60715 13.6663 8.31822 13.6663 6.99967C13.6663 6.1242 13.4939 5.25729 13.1589 4.44845C12.8238 3.63961 12.3328 2.90469 11.7137 2.28563C11.0947 1.66657 10.3597 1.17551 9.5509 0.840478C8.74206 0.505446 7.87516 0.333008 6.99968 0.333008Z" fill="#28D0AF"/>
                                    </svg>
                                    <span style="font-size: 13px;">Primary</span>
                                </div>
                            </div> -->
                            <!-- <div class="d-flex justify-content-between my-1 align-items-center checkout-available-cards" style="background: #FFFFFF;">
                                <div class="flex-fill ml-4">
                                    <div class="row">
                                        <input type="radio" name="abc" class="cursor-p mt-1">
                                        <div class="user-billing-payment-paypal-image ml-2"></div>
                                    </div>
                                </div>
                                <div class="flex-fill">
                                Signed  as seid@gmail.com
                                <br>
                                Seid Takroni
                                </div>
                                <div class="flex-fill text-left mr-3" style="opacity: 0;">
                                    n primary
                                </div>
                            </div> -->
                            @endforeach
                            @if($user_company->paypal_method)
                                <div class="d-flex justify-content-between my-1 align-items-center checkout-available-cards" style="@if($isPaypalDefault) background: #E4EAF2; @else background: #FFFFFF @endif">
                                    <div class="flex-fill" style="margin-inline-start: 1.5rem;">
                                        <div class="row">
                                            <input type="radio" onclick="changedefaultMethodCheckout('paypal-method')" @if($isPaypalDefault) checked @endif name="select_default_payment_method" class="cursor-p mt-1">
                                            <div class="user-billing-payment-paypal-image ml-2" style="margin-inline-start: 0.5rem;"></div>
                                        </div>
                                    </div>
                                    <div class="flex-fill">
                                    Signed  as {{ $user_company->name}}
                                    </div>
                                    @if(!$isPaypalDefault)
                                    <div class="flex-fill text-left mr-3" style="opacity: 0;margin-inline-end: 1rem;">
                                        n primary
                                    </div>
                                    @else
                                    <div class="flex-fill text-left " style="margin-inline-end: 1rem;">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.66634 10.333L2.33301 6.99967L3.27301 6.05301L5.66634 8.44634L10.7263 3.38634L11.6663 4.33301L5.66634 10.333ZM6.99968 0.333008C5.68114 0.333008 4.3922 0.724001 3.29588 1.45654C2.19955 2.18909 1.34506 3.23028 0.840481 4.44845C0.335896 5.66663 0.203874 7.00707 0.461109 8.30028C0.718344 9.59348 1.35328 10.7814 2.28563 11.7137C3.21798 12.6461 4.40587 13.281 5.69908 13.5382C6.99228 13.7955 8.33273 13.6635 9.5509 13.1589C10.7691 12.6543 11.8103 11.7998 12.5428 10.7035C13.2754 9.60715 13.6663 8.31822 13.6663 6.99967C13.6663 6.1242 13.4939 5.25729 13.1589 4.44845C12.8238 3.63961 12.3328 2.90469 11.7137 2.28563C11.0947 1.66657 10.3597 1.17551 9.5509 0.840478C8.74206 0.505446 7.87516 0.333008 6.99968 0.333008Z" fill="#28D0AF"/>
                                        </svg>
                                        <span style="font-size: 13px;">{{__('Primary')}}</span>
                                    </div>
                                    @endif
                                </div>
                            @endif

                        @else
                            <span class="my-2 font-15-lh-20-semi-bold position-absolute" style="color:#F58B1E;">{{__('No payment methods')}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 px-0 d-flex flex-column align-items-start">
                <div class="left-data-wrapper">
                    <div class="subscribe-data-wrapper" >
                        <div class="subscribe-data-header">
                            <p class="font-15-lh-18-medium">
                            {{__('Your Subscription')}}</p>
                        </div>
                        <div class="subscribe-data-body">
                            <div class="d-flex flex-column align-items-start">
                                <div class="d-flex align-items-center">
                                    <img style="width: 20px;" src="{{url('assets/image_new/svg/header-icon.svg')}}" alt="">
                                    <span class="font-15-lh-18-medium text-grey" style="margin-inline-start: 0.5rem;">{{__($wanted_plan_name)}}</span>
                                </div>
                                <span class="mt-3 font-15-lh-18-medium text-grey">{{__('Some of the services included with this plan')}}:</span>
                                <div class="d-flex align-items-center" style="margin-top: 10px;">
                                    <img style="width: 20px; " src="{{url('assets/image_new/svg/database-arrow-down.svg')}}" alt="">
                                    <span class="font-15-lh-18-medium text-grey" style="margin-inline-start: 0.5rem;">{{__('Data Connections') . ' ' . $wanted_plan_info->connections}}</span>
                                </div>
                                <div class="d-flex align-items-center" style="margin-top: 10px;">
                                    <img style="width: 20px;" src="{{url('assets/image_new/svg/account-arrow-right.svg')}}" alt="">
                                    <span class="font-15-lh-18-medium text-grey" style="margin-inline-start: 0.5rem;">{{__('Users') . ' ' . $wanted_plan_info->users}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-fill flex-column">
                                <div class="d-flex flex-column" style="margin-top: 28px;">
                                    <span class="font-20-lh-25-medium">{{__('TOTAL')}}</span>
                                </div>
                            </div>
                            <div class="d-flex flex-fill flex-column">
                                {{--<div class="d-flex flex-column">
                                    <span class="font-15-lh-20-semi-medium price-period">{{$price_currency }}{{$price_month}}/{{__('month')}}</span>
                                    <span class="font-15-lh-20-semi-medium">{{$price_currency }}45/{{__('month')}}</span>
                                </div>--}}
                                <div class="flex-fill text-left" style="margin-top: 28px;">
                                    
                                    <span class="font-20-lh-25-medium price-period">
                                    <span class="font-15-lh-20-semi-medium text-grey">{{__('Includes tax')}}</span>    
                                    {{$price_currency }}{{$price_month}}</span>
                                </div>
                            </div>
                        </div>
                        @if(auth()->user() && auth()->user()->company->paypal_method && auth()->user()->company->paypal_default)
                            <div class="monthly-pp-btn mt-4" id="{{\App\Models\Plans::where('identifier', $plan_ident . '_pp')->first()->stripe_id}}"></div>
                            {{--<div class="yearly-pp-btn" style="display:none;" id="{{\App\Models\Plans::where('identifier', $plan_ident . '_pp')->first()->stripe_id}}"></div>--}}
                        @else
                        
                            <button onclick="subscribeNewPlan('{{$plan_ident}}')" class="mt-4" style="width: 351px;height: 48px;background: #F58B1E;border-radius: 8px;font-family: 'Segoe UI';font-style: normal;font-weight: 400;font-size: 20px;color: #FFFFFF;">{{__('Confirm and Pay')}}</button>
                        @endif
                    </div>
                </div>
                <div class="my-4 text-center w-100" style="max-width: 455px;">
                    <a href="{{url('privacy-policy')}}" class="text-center cursor-p" style="text-decoration-line: underline;">
                    {{__('Subscription and Cancellation Terms')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- PAYMENT METHOD --}}
<div id='payment-method' class="paymant-method-modal modal fade" tabindex="-1" role="dialog"
     aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="checkout-paymant-method-modal-content modal-dialog" role="document">
        <div class='paymant-method-modal-header-wrap'>
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
            <h3 class="paymant-method-modal-title font-28-lh-42-semi-bold">{{__('Add Payment Method')}}</h3>
        </div>
        <hr class='paymant-method-modal-line'>
        <div class='paymant-method-modal-wrap'>

            {{-- ADD PAYMENT --}}

            <div class='paymant-method-modal-right-side'>
                <div class='paymant-method-modal-right-side-first-wrap'>
                    <div id="paypal-img" class='paymant-method-modal-right-side-first-field-paypal'></div>
                    <div id="master-card-img" class='paymant-method-modal-right-side-first-field-mastercard'></div>
                    <div id="visa-card-img" class='paymant-method-modal-right-side-first-field-visa'></div>
                    <select disabled onchange="selectPaymentMethod()" class='checkout-paymant-method-modal-right-side-first-field' style="color:black;cursor:default" name="select" id="payment-selector">
                        <option class='paymant-method-modal-right-side-first-field-option font-15-lh-20-semi-bold'
                            value="paypal">{{__('PayPal')}}
                        </option>
                        <option class='paymant-method-modal-right-side-first-field-option font-15-lh-20-semi-bold'
                            value="card" >{{__('Visa/Mastercard')}}
                        </option>
                    </select>
                </div>

                <div class="paymant-method-modal-right-side-second-wrap" id="cardMethod">
                    <form id="payment-form" action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" id="plan" value="{{ request('plan') }}">
                        <div class="form-group">
                            <label for="">{{__('Name')}} <span class='user-billing-star'>*</span></label>
                            <input type="text" name="name" id="card-holder-name" class="form-control" value=""
                                   placeholder="{{__('Name on the card')}}">
                        </div>
                        <div class="form-group">
                            <label for="">{{__("Card details")}}<span class='user-billing-star'>*</span> </label>
                            <div id="card-element"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn paymant-method-modal-right-side-btn" id="card-button"
                                    data-secret="{{ $intent->client_secret }}">{{__("Add new payment method")}}
                            </button>
                            <a href="" onclick="backPaymentMethod(event)">{{ __('Back') }}</a>
                        </div>

                    </form>
                </div>

                <div class="paymant-method-modal-right-side-second-wrap mt-3" id="paypalMethod" style="display:none;">
                    <div class="d-flex flex-column">
                        <span class="paypal-label">{{__("Use PayPal payment method by default:")}}</span>
                        <button class="btn paymant-method-modal-right-side-btn paypal ml-auto w-auto mt-3 mr-0"
                                onclick="setPaypalMethod()">{{__('Add new payment method')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='loader-wrap'>
    <div id="main-loader" class="preloader">
        <div class="heartbeat">
            <div class="loading"></div>
            <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script src="{{'https://www.paypal.com/sdk/js?client-id=' . (env('PAYPAL_MODE') === 'live' ? env('PAYPAL_LIVE_CLIENT_ID') : env('PAYPAL_SANDBOX_CLIENT_ID')) . '&vault=true&intent=subscription'}}" data-sdk-integration-source="button-factory"></script>

<script>
    var noPaymentMethod = '{{ session()->get('noPaymentMethod') }}';
    var paymentMethodAdded = '{{ session()->get('paymentMethodAdded') }}';
    var subscriptionCanceled = '{{ session()->get('subscriptionCanceled') }}';
    var subscriptionCreated = '{{ session()->get('subscriptionCreated') }}';
    var pmUpdated = '{{ session()->get('pmUpdated') }}';

    document.body.onload = function () {
        setTimeout(function () {
            const preloader = document.getElementById('main-loader');
            if (!preloader.classList.contains('done')) {
                preloader.classList.add('done');
            }

            if (noPaymentMethod) {
                toastr.warning('{{__('Add a new payment method')}}');

                @php
                    request()->session()->forget('noPaymentMethod');
                @endphp
            }
            if (paymentMethodAdded) {
                toastr.success('{{__('A new payment method was added')}}');

                @php
                    request()->session()->forget('paymentMethodAdded');
                @endphp
            }
            if (subscriptionCanceled) {
                toastr.success('{{__('Your subscription has been canceled')}}');

                @php
                    request()->session()->forget('subscriptionCanceled');
                @endphp
            }
            if (subscriptionCreated) {
                toastr.success('{{__('Your subscription has been created')}}');

                @php
                    request()->session()->forget('subscriptionCreated');
                @endphp
            }
            if (pmUpdated) {
                toastr.success('{{__('The new payment method is set')}}');

                @php
                    request()->session()->forget('pmUpdated');
                @endphp
            }
        }, 1000);
    };
</script>
<script>
    const stripe = Stripe('{{ config('cashier.key') }}')

    const elements = stripe.elements()
    const cardElement = elements.create('card')

    cardElement.mount('#card-element')

    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')

    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        const {setupIntent, error} = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        )

        if (error) {
            toastr.error(error.message);
        } else {
            let token = document.createElement('input')

            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)

            form.appendChild(token)

            form.submit();

            toggleLoader(true);

            $('#current-payment-method').show();
            $('#add-payment-method').hide();
        }
    })
</script>
<script>
    paypal.Buttons({
        style: {
            shape: 'pill',
            color: 'gold',
            layout: 'horizontal',
            label: 'subscribe',
            tagline: false
        },
        createSubscription: function(data, actions) {
            return actions.subscription.create({
                /* Creates the subscription */
                plan_id: '{{\App\Models\Plans::where('identifier', $plan_ident . '_pp')->first()->stripe_id}}'
            });
        },
        onApprove: function(data, actions) {
            toggleLoader(true);

            $.ajax({
                type: 'POST',
                url: '{{ url('/subscribe-new-plan-paypal') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    orderID: data.orderID,
                    subscriptionID: data.subscriptionID,
                    service_name: '{{ $wanted_plan_name }}'
                },
                success: () => {
                    window.location.replace('{{ url('/dashboard/user-billing') }}');
                }
            })
        }
    }).render('#{{\App\Models\Plans::where('identifier', $plan_ident . '_pp')->first()->stripe_id}}'); // Renders the PayPal button

    function selectPaymentMethod() {
        if ($('#payment-selector').val() === 'card') {
            $('#paypalMethod').hide();
            $('#cardMethod').show();

            $('#paypal-img').hide();
            $('#master-card-img').show();
            $('#visa-card-img').show();
        } else {
            $('#paypalMethod').show();
            $('#cardMethod').hide();
            $('#paypal-img').show();
            $('#master-card-img').hide();
            $('#visa-card-img').hide();
            
        }
    }
    function openAddPaymentMethod(payment_type){
        
        if(payment_type=='stripe'){
            
            $('#payment-selector').val('card');
            $('#paypal-img').hide();
            $('#master-card-img').show();
            $('#visa-card-img').show();

            $('#paypalMethod').hide();
            $('#cardMethod').show();
        }
        else {
            $('#payment-selector').val('paypal');
            $('#paypal-img').show();
            $('#master-card-img').hide();
            $('#visa-card-img').hide();

            $('#paypalMethod').show();
            $('#cardMethod').hide();
        }
    }

    function setPaypalMethod() {
        toggleLoader(true);
        $.ajax({
            type: 'POST',
            url: '{{ url('/set-paypal') }}',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: () => {
                // location.href=location.href;
                setTimeout(function () {
                    location.reload();
                }, 400);
               
            }
        })
    }


    setTimeout(function () {
        const preloader = document.getElementById('main-loader');
        if (!preloader.classList.contains('done')) {
            preloader.classList.add('done');
        }
    }, 400);

    let dropdownOpen = false;
    let currentPeriod = 'month';

    function clickDropdown() {
        dropdownOpen ? $('.plans-period-popup').hide() : $('.plans-period-popup').show();
        dropdownOpen = !dropdownOpen;
    }

    function setPeriod(period, event) {
        $('#current-period').text(event.innerHTML);
        currentPeriod = period;
        if (currentPeriod === 'month') {
            $('.price-period').text('$' + '{{$price_month}}' + '/' + '{{__('month')}}');
            $('.monthly-pp-btn').show();
            $('.yearly-pp-btn').hide();
        } else {
            $('.price-period').text('$' + '{{$price_year}}' + '/' + '{{__('year')}}');
            $('.monthly-pp-btn').hide();
            $('.yearly-pp-btn').show();
        }
    }

    function toggleLoader(loaderStatus) {
        const preloader = $('#main-loader');
        if (loaderStatus) {
            preloader.removeClass('done');
        } else {
            preloader.addClass('done');
        }
    }

    function subscribeNewPlan(plan) {
        console.log(plan);
        if ('{{auth()->user()}}') {
            toggleLoader(true);

            $.ajax({
                type: 'POST',
                url: '{{ url('/subscribe-new-plan') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    plan: plan,
                },
                success: function (data) {
                    console.log(data.noPaymentMethod);
                    if (typeof data.noPaymentMethod !== 'undefined') {
                        toggleLoader(false);
                        toastr.warning('{{__("No payment method defined")}}');
                    } else {
                        data = JSON.parse(data);
                        console.log(data);

                        window.location.replace('{{ url('/dashboard/user-billing') }}?st_id='+data.stripe_id+'&amt='+data.amount+'&cus='+data.charge_id);
                    }
                }
            })
        } else window.location.replace('{{ url('/login') }}');
    }

    function changedefaultMethodCheckout(payment_id){
        toggleLoader(true);
        $.ajax({
            type: 'POST',
            url: '{{ url('/checkout-change-default-mehtod') }}',
            data: {
                _token: '{{ csrf_token() }}',
                payment_id: payment_id
            },
            success: () => {
                setTimeout(function () {
                    location.reload();
                }, 400);
            }
        })
    }
</script>
