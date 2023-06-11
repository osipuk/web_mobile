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
    <div class="pricing-period-page-body d-flex align-items-center flex-column">
        <span class="font-48-lh-56-semi-bold text-center">{{__("You're switching from ") . __($user_plan_name) . __(" to ") . __($wanted_plan_name)}}</span>
        <div class="subscription-data text-right row">
            <div class="col-12 col-md-6 pr-0 d-flex flex-column align-items-start">
                <span class="font-15-lh-20-semi-bold">{{__('What happens next')}}:</span>
                <div class="right-data-wrapper">
                    <div class="d-flex align-items-center">
                        <img src="{{url('assets/image_new/svg/info.svg')}}" style="margin-left: 15px;" alt="">
                        <div class="d-flex flex-column align-items-start">
                            <span class="font-15-lh-20-semi-bold">{{__('Your current plan will end')}}</span>
                            <p class="font-15-lh-20-semi-bold text-grey">{{__('Your subscription to ') . __("$user_plan_name") . __(' will end today and your new plan will start effective immediately')}}.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center" style="margin-top: 38px;">
                        <img src="{{url('assets/image_new/svg/money.svg')}}" style="margin-left: 15px; height: 20px; width: 20px;" alt="">
                        <div class="d-flex flex-column align-items-start">
                            <span class="font-15-lh-20-semi-bold">{{__('Billing details')}}</span>
                            <div class="d-flex align-items-center">
                                
                                
                                @if($default_payment_method && !$user_company->paypal_default)
                                <p class="font-15-lh-20-semi-bold text-grey mr-1">{{__('Your payment method will be ')}} 
                                    <div class="user-billing-payment-visa-image"></div>
                                    <div class="user-billing-payment-mc-image"></div>
                                    <!-- <p class="user-billing-payment-text font-16-lh-19-ligh">
                                        {{ ucfirst($default_payment_method->card->brand) }} {{__('card')}}
                                    </p> -->
                                    </p>
                                @elseif($user_company->paypal_method && $user_company->paypal_default)
                                <p class="font-15-lh-20-semi-bold text-grey mr-1">{{__('Your payment method will be ')}} 
                                    <div class="user-billing-payment-paypal-image"></div>
                                    <!-- <p class="user-billing-payment-text font-16-lh-19-ligh">
                                        {{__('PayPal')}}
                                    </p> -->
                                    </p>
                                @else
                                    <p class="font-15-lh-20-semi-bold text-grey mr-1">
                                        {{__('No payment method')}}
                                    </p>
                                @endif
                                
                                <a class="text-orange-hover text-orange font-15-lh-20-semi-bold ml-1" href="{{url('dashboard/user-billing')}}">{{__('Edit')}}. </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('privacy-policy')}}" class="btn-gray">{{__('Subscription and Cancellation Terms')}}</a>
                </div>
            </div>
            <div class="col-12 col-md-6 px-0 d-flex flex-column align-items-start">
                <span class="font-15-lh-20-semi-bold">{{__('Your new subscription details')}}:</span>
                <div class="left-data-wrapper">
                    <div class="subscribe-data-wrapper">
                        <div class="subscribe-data-header">
                            <span class="font-15-lh-18-medium">{{__('Your Subscription')}}</span>
                        </div>
                        <div class="subscribe-data-body">
                            <div class="subscribe-inner-data-body d-flex flex-column align-items-start">
                                <div class="d-flex align-items-center">
                                    <img style="width: 20px; margin-left: 27px;" src="{{url('assets/image_new/svg/header-icon.svg')}}" alt="">
                                    <span class="font-15-lh-18-medium text-grey">{{__($wanted_plan_name)}}</span>
                                </div>
                                <div class="dropdown-wrapper d-flex flex-column align-items-start">
                                    <span class="font-15-lh-18-medium text-grey">{{__('Commitment')}}</span>
                                    <div id="plans-period-dropdown" onclick="clickDropdown()" class="d-flex align-items-center justify-content-between">
                                        <span id="current-period">{{__('Paid monthly') . ' - '.$price_currency . $price_month . '/' . __('month')}}</span>
                                        <img style="width: 12px;" src="{{url('assets/image_new/svg/colored/chevron-down-black.svg')}}" alt="">
                                        <div class="plans-period-popup" style="display:none;">
                                            <ul class="dashboard-settings-list">
                                                <li class="">
                                                    <a href="javascript:;" onclick="setPeriod('month', this)" class="dashboard-settings-link">{{__('Paid monthly') . ' - '.$price_currency  . $price_month . '/' .__('month')}}</a>
                                                </li>
                                               {{--<li class="">
                                                    <a href="javascript:;" onclick="setPeriod('year', this)" class="dashboard-settings-link">{{__('Annual plan') . ' - '.$price_currency  . $price_year . '/' .__('year')}}</a>
                                                </li>--}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <span class="font-15-lh-18-medium text-grey">{{__('Some of the services included with this plan')}}:</span>
                                <div class="d-flex align-items-center" style="margin-top: 10px;">
                                    <img style="width: 20px; margin-left: 27px;" src="{{url('assets/image_new/svg/database-arrow-down.svg')}}" alt="">
                                    <span class="font-15-lh-18-medium text-grey">{{__('Data Connections') . ' ' . $wanted_plan_info->connections}}</span>
                                </div>
                                <div class="d-flex align-items-center" style="margin-top: 10px;">
                                    <img style="width: 20px; margin-left: 27px;" src="{{url('assets/image_new/svg/account-arrow-right.svg')}}" alt="">
                                    <span class="font-15-lh-18-medium text-grey">{{__('Users') . ' ' . $wanted_plan_info->users}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="subscribe-data-footer">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-column">
                                      {{--  <span class="font-15-lh-20-semi-medium">{{__('Tax')}} 21%</span>--}}
                                    </div>
                                    <div class="d-flex flex-column" style="margin-top: 28px;">
                                        <span class="font-20-lh-25-medium">{{__('TOTAL')}}</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    {{--<div class="d-flex flex-column">
                                        <span class="font-15-lh-20-semi-medium price-period">{{$price_currency }}{{$price_month}}/{{__('month')}}</span>
                                        <span class="font-15-lh-20-semi-medium">{{$price_currency }}45/{{__('month')}}</span>
                                    </div>--}}
                                    <div class="d-flex flex-column" style="margin-top: 28px;">
                                        <span class="font-20-lh-25-medium price-period">{{$price_currency }}{{$price_month}}/{{__('month')}}</span>
                                        <span class="font-15-lh-20-semi-medium text-grey">{{__('Includes tax')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pricing-period-page-footer">
        <div class="pricing-period-page-footer-wrapper d-flex justify-content-between align-items-center">
            <a href="{{url('pricing')}}" class="btn btn-transparent font-20-lh-25-medium pricing-btn-period-grey">{{__('Close')}}</a>
            @if(auth()->user() && auth()->user()->company->paypal_method && auth()->user()->company->paypal_default)
                <div class="monthly-pp-btn" id="{{\App\Models\Plans::where('identifier', $plan_ident . '_pp')->first()->stripe_id}}"></div>
                {{--<div class="yearly-pp-btn" style="display:none;" id="{{\App\Models\Plans::where('identifier', $plan_ident . '_pp')->first()->stripe_id}}"></div>--}}
            @else
                <button onclick="subscribeNewPlan('{{$plan_ident}}')" class="btn btn-orange font-20-lh-25-medium pricing-btn-period">{{__('Proceed to pay')}}</button>
            @endif
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

<script src="{{'https://www.paypal.com/sdk/js?client-id=' . (env('PAYPAL_MODE') === 'live' ? env('PAYPAL_LIVE_CLIENT_ID') : env('PAYPAL_SANDBOX_CLIENT_ID')) . '&vault=true&intent=subscription'}}" data-sdk-integration-source="button-factory"></script>


<?php 
   // $usrip =  isset($_GET['ip']) ? $_GET['ip']: request()->ip();
   // $usrcurrency = geoip($usrip)->currency;
?>
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

/*
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

*/
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
</script>
