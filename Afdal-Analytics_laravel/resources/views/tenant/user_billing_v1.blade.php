@extends('layout.userhead')
@section('metahead')
    <title>{{__("User Billing")}}</title>
    <link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}"/>
@endsection
<body class="user-billing-page">
<div class="user-billing-content-wrapper">
    @include('tenant.components.settings-header')
    @include('tenant.components.trial-banner')


    
    <main class="user-billing-main">
        <div class="user-billing-history">
            <h2 class="user-billing-history-title font-24-lh-28-medium">
                {{__('Billing History')}}
            </h2>
            @if($billing_history->isNotEmpty())
                <table cols="6" class="user-billing-spreadsheet">
                <thead>
                <tr class="user-billing-spreadsheet-titles">
                    <th class="user-billing-spreadsheet-title user-billing-spreadsheet-title-name font-18-lh-21-medium">
                        {{__('Name')}}
                    </th>

                    <th class="user-billing-spreadsheet-title user-billing-spreadsheet-title-transaction font-18-lh-21-medium">
                        {{__('Transaction')}}
                    </th>

                    <th class="user-billing-spreadsheet-title user-billing-spreadsheet-title-amount font-18-lh-21-medium">
                        {{__('Amount')}}
                    </th>

                    <th class="user-billing-spreadsheet-title user-billing-spreadsheet-title-date font-18-lh-21-medium">
                        {{__('Date Created')}}
                    </th>

                    <th class="user-billing-spreadsheet-title user-billing-spreadsheet-title-ID font-18-lh-21-medium">
                        {{__('Transaction ID')}}
                    </th>
                    <th></th>
                </tr>
                </thead>

                <tbody class="user-billing-transactions-list">
                @foreach($billing_history as $item)
                    <tr class="user-billing-transaction-item">
                        <td class="user-billing-transaction-name font-14-lh-16-light">
                            {{ $item->customer_name }}
                        </td>

                        <td class="user-billing-transaction-subscription font-14-lh-16-light">
                            {{ __($item->description) }}
                        </td>

                        <td class="user-billing-transaction-amount font-14-lh-16-light">
                            ${{ $item->amount }}
                        </td>

                        <td class="user-billing-transaction-date font-14-lh-16-light">
                            {{ $item->date }}
                        </td>

                        <td class="user-billing-transaction-id font-14-lh-16-light">
                            {{ $item->transaction_id }}
                        </td>

                        <td class="user-billing-transaction-status">
                            @if($item->invoice_pdf !== 'test')
                                <a href="{{ $item->invoice_pdf }}" class="user-billing-invoice-button"></a>
                            @else
                                <a href="{{ url('/invoice/' . $item->transaction_id) }}" target="_blank" class="user-billing-invoice-button"></a>
                            @endif

                            @if($item->status === 'paid' || 'APPROVED')
                                <div class="user-billing-status user-billing-status-successful font-13-lh-15-medium mr-auto">
                                    {{__('SUCCESSFUL')}}
                                </div>
                            @else
                                <div class="user-billing-status user-billing-status-failed font-13-lh-15-medium mr-auto">
                                    {{__('FAILED')}}
                                </div>
                            @endif
                              <div class='user-billing-status-green-circle'></div>
                              <div class='user-billing-status-grey-line'></div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            @else
                <span class="empty-billing">{{__('You have not made any payments')}}</span>
            @endif
        </div>

        <div class="user-billing-details">
            <div class="user-billing-subscription-details">
                <h3 class="user-billing-subscription-title font-24-lh-28-medium">
                    {{__('Your Subscription')}}
                </h3>

                @if($subscription_data || Auth::user()->trial())
                    <div class="user-billing-subscription-package">
                        <div class="user-billing-subscription-package-image"></div>
                        <p class="user-billing-subscription-text font-16-lh-19-light">
                            {{__($user_plan_name)}}
                        </p>
                    </div>

                    <div class="user-billing-subscription-connections">
                        <div class="user-billing-subscription-connections-image"></div>
                        <p class="user-billing-subscription-text font-16-lh-19-ligh">
                            {{__('Data Connections') . ' ' . UserPlanHelper::subscription_info()->connections}}
                        </p>
                    </div>

                    <div class="user-billing-subscription-users">
                        <div class="user-billing-subscription-users-image"></div>
                        <p class="user-billing-subscription-text font-16-lh-19-ligh">
                            {{__('Users') . ' ' . UserPlanHelper::subscription_info()->users}}
                        </p>
                    </div>
                @else
                    <div class="user-billing-subscription-package">
                        <div class="user-billing-subscription-package-image"></div>
                        <p class="user-billing-subscription-text font-16-lh-19-light">
                            {{__('No plan')}}
                        </p>
                    </div>
                @endif

                <button data-toggle="modal" data-target="#edit-subscription"
                        class="user-billing-subscription-button font-18-lh-21-regular" type="button">
                    {{__('Edit Subscription')}}
                </button>
            </div>

            <div class="user-billing-payment-details">
                <h3 class="user-billing-payment-title font-24-lh-28-medium">
                    {{__('Billing & Payment')}}
                </h3>
                <div class="user-billing-payment-paypal d-flex align-items-center">
                    @if($default_payment_method && !$user_company->paypal_default)
                        <div class="user-billing-payment-visa-image"></div>
                        <div class="user-billing-payment-mc-image"></div>
                        <p class="user-billing-payment-text font-16-lh-19-ligh">
                            {{ ucfirst($default_payment_method->card->brand) }} {{__('card')}}
                        </p>
                    @elseif($user_company->paypal_method && $user_company->paypal_default)
                        <div class="user-billing-payment-paypal-image"></div>
                        <p class="user-billing-payment-text font-16-lh-19-ligh">
                            {{__('PayPal')}}
                        </p>
                    @else
                        <div class="user-billing-nopayment-image"></div>
                        <p class="user-billing-payment-text font-16-lh-19-ligh">
                            {{__('No payment method')}}
                        </p>
                    @endif
                </div>

                <div class="user-billing-payment-date d-flex align-items-center">
                    <div class="user-billing-payment-date-image"></div>
                    @if($subscription_info)
                        <p class="user-billing-payment-text font-16-lh-19-ligh">
                            ${{$subscription_info['next_payment_full']}}
                        </p>
                    @elseif(auth()->user()->company->onTrial())
                        <p class="user-billing-payment-text font-16-lh-19-ligh">{{__('The trial period will end in ')}} {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }} {{__('days')}}</p>
                    @else
                        <p class="user-billing-payment-text font-16-lh-19-ligh">{{__('No plan')}}</p>
                    @endif
                </div>

                <button data-toggle="modal" data-target="#payment-method"
                        class="user-billing-payment-button font-18-lh-21-regular" type="button">
                    {{__('Edit Billing & Payment')}}
                </button>
            </div>
        </div>
    </main>
</div>
@include('layout.usersidenav')


<div class='loader-wrap'>
    <div id="main-loader" class="preloader">
        <div class="heartbeat">
          <div class="loading"></div>
          <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>
        </div>
    </div>
</div>
{{-- INVOICE MODAL --}}
{{-- <div id='modal' class="invoice-modal">
  <div id='back' class="invoice-modal-background"></div>
  <div class="invoice-modal-content">
    <div class='invoice-modal-header-wrap'>
    <button id="close" type="button" class="invoice-modal-close"></button>
<h3 class="invoice-modal-title font-28-lh-42-semi-bold">Invoice DH626EN602</h3>
</div>
<hr>
<div class='invoice-modal-invoice'>
<h4 class='font-24-lh-28-medium'>{{__('Invoice To')}}</h4>
<div class='invoice-modal-invoice-info-wrap'>
<div>
<h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Date Created')}}</h5>
<p class='font-14-lh-16-light'>25-06-2021</p>
</div>
<div>
<h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Address')}}</h5>
<p class='font-14-lh-16-light'>Street Name Nr. 69</p>
</div>
<div>
<h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Company')}}</h5>
<p class='font-14-lh-16-light'>ACME LLC</p>
</div>

{{-- INVOICE MODAL --}}
{{--<div id='invoice' class="invoice-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="paymentMethodLabel" aria-hidden="true">--}}
{{--    <div id='back' class="invoice-modal-background"></div>--}}
{{--    <div class="invoice-modal-content">--}}
{{--        <div class='invoice-modal-header-wrap'>--}}
{{--            <button id="close" type="button" class="invoice-modal-close"></button>--}}
{{--            <h3 class="invoice-modal-title font-28-lh-42-semi-bold">Invoice DH626EN602</h3>--}}
{{--        </div>--}}
{{--        <hr>--}}
{{--        <div class='invoice-modal-invoice'>--}}
{{--            <h4 class='font-24-lh-28-medium'>{{__('Invoice To')}}</h4>--}}
{{--            <div class='invoice-modal-invoice-info-wrap'>--}}
{{--                <div>--}}
{{--                    <h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Date Created')}}</h5>--}}
{{--                    <p class='font-14-lh-16-light'>25-06-2021</p>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Address')}}</h5>--}}
{{--                    <p class='font-14-lh-16-light'>Street Name Nr. 69</p>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Company')}}</h5>--}}
{{--                    <p class='font-14-lh-16-light'>ACME LLC</p>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Name')}}</h5>--}}
{{--                    <p class='font-14-lh-16-light'>Seid Takroni</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <h4 class='font-24-lh-28-medium'>{{__('Payment method')}}</h4>--}}
{{--            <div class='invoice-modal-invoice-payMethod'>--}}
{{--                <div>--}}
{{--                    <p class='font-15-lh-20-semi-medium '>{{__('Paypal signed in as seid@gmail.com')}}</p>--}}
{{--                    <p class='invoice-modal-invoice-payMethod-name font-15-lh-20-semi-medium '>Seid Takroni</p>--}}
{{--                </div>--}}
{{--                <div class='invoice-modal-invoice-payMethod-icon'></div>--}}
{{--            </div>--}}
{{--            <button class='invoice-modal-invoice-payMethod-btn font-16-lh-26-bold '--}}
{{--                    type='button'>{{__('Change')}}</button>--}}
{{--            <hr>--}}
{{--            <div class='invoice-modal-details'>--}}
{{--                <h4 class='invoice-modal-details-title-main font-24-lh-28-medium'>{{__('Details')}}</h4>--}}
{{--                <div class='invoice-modal-details-info-wrap'>--}}
{{--                    <div>--}}
{{--                        <h5 class='invoice-modal-details-title font-18-lh-21-medium'>{{__('Amount')}}</h5>--}}
{{--                        <p class='font-14-lh-16-light'>$39.00</p>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <h5 class='invoice-modal-details-title font-18-lh-21-medium'>{{__('Transaction')}}</h5>--}}
{{--                        <p class='font-14-lh-16-light'>{{__('Monthly Subscription Payment')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <button class='invoice-modal-btn font-18-lh-21-medium'>{{__('Download')}}--}}
{{--                    <div class='invoice-modal-btn-icon'></div>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{-- PAYMENT METHOD --}}
<div id='payment-method' class="paymant-method-modal modal fade" tabindex="-1" role="dialog"
     aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="paymant-method-modal-content modal-dialog" role="document">
        <div class='paymant-method-modal-header-wrap'>
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
            <h3 class="paymant-method-modal-title font-28-lh-42-semi-bold">{{__('Manage payment method')}}</h3>
{{--            <div>--}}
{{--                <button type="button" class="paymant-method-modal-back font-22-lh-27-bold ">{{__('Back')}}</button>--}}
{{--            </div>--}}
{{--            <div class='paymant-method-modal-back-arrow'></div>--}}
        </div>
        <hr class='paymant-method-modal-line'>
        <div class='paymant-method-modal-wrap'>
            <div class='paymant-method-modal-left-side'>
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium'>{{__('Your Subscription')}}</h3>
                <div class='paymant-method-modal-left-side-info'>
                    <div class='paymant-method-modal-left-side-wrap-title'>
                        <div class='paymant-method-modal-left-side-logo'></div>
                        <h4 class='paymant-method-modal-left-side-card-title font-22-lh-25-medium'>{{__('Afdal Analytics') . ' ' . __($user_plan_name) }}</h4>
                    </div>
                    @if($subscription_info)
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light'>{{__('Commitment')}}</p>
                        @if($subscription_info['interval'] == 'month')
                            <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>{{ __('Paid monthly') }}</p>
                        @elseif($subscription_info['interval'] == 'year')
                            <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>{{ __('Annual plan') }}</p>
                        @endif
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light'>{{__('Next regular payment*')}}</p>
                        <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>${{$subscription_info['next_payment']}}</p>
                    @elseif(auth()->user()->company->onTrial())
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light'>{{__('The trial period will end in ')}} {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }} {{__('days')}}</p>
                    @else
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light'>{{__('No plan')}}</p>
                    @endif
                    <hr>
                    <div class='paymant-method-modal-left-side-card-bottom-text'>
                        <p class='paymant-method-modal-left-side-card-text-medium font-17-lh-19-medium'>{{__('Requires use with only one account*')}}</p>
                        <div class='paymant-method-modal-left-side-card-text-icon'></div>
                    </div>

                </div>
            </div>

            <div id="current-payment-method" class='paymant-method-modal-right-side'>
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium'>{{__('Your payment method')}}</h3>

                @if($subscription_info)
                    <div id="confirm-paypal" style="display: none">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light'>{{ __('Confirm new payment method:') }}</p>
                            <a href="" onclick="backPaymentMethod(event)">{{ __('Back') }}</a>
                        </div>
                        <div class="monthly-pp-btn mt-2" id="{{ $paypalPlanId }}"></div>
                    </div>
                @endif

                <div id="current-payment-method-inner">
                    @if(!$payment_methods->isEmpty() || $user_company->paypal_method)
                        @foreach($payment_methods as $payment_method)
                            <div class="paymant-method-modal-right-side-info-wrap {{!$isPaypalDefault && ($payment_method == $default_payment_method) ? 'default-method' : 'additional-method'}}"
                                 id="{{ $payment_method->id }}">
                                <div class='paymant-method-modal-right-side-info d-flex justify-content-between align-items-center'
                                     style="width: 405px;">
                                    <div class="mr-3">
                                        <p class='paymant-method-modal-right-side-card-title font-15-lh-20-semi-medium '>
                                            {{__('Your')}} {{ $payment_method->card->brand }} {{__('card signed in as')}} {{ $user_company->name }}</p>
                                    </div>
                                    <div class='paymant-method-modal-right-side-first-field-{{$payment_method->card->brand}}'></div>
                                </div>
                                @if(($payment_method != $default_payment_method) || $isPaypalDefault)
                                    <a href="" class="delete-method" onclick="deletePM(event, '{{ $payment_method->id }}')">
                                        <img src="{{url('assets/image_new/svg/colored/close.svg')}}" alt="">
                                    </a>
                                @endif
                            </div>
                        @endforeach

                        @if($user_company->paypal_method)
                            <div class="paymant-method-modal-right-side-info-wrap {{$isPaypalDefault ? 'default-method' : 'additional-method'}}"
                                 id="paypal-method">
                                <div class='paymant-method-modal-right-side-info' style="width: 405px;">
                                    <div class="mr-3">
                                        <p class='paymant-method-modal-right-side-card-title font-15-lh-20-semi-medium '>
                                            {{__('PayPal')}} {{ $user_company->name}}</p>
                                    </div>
                                    <div class='paymant-method-modal-right-side-first-field-paypal ml-auto'></div>
                                </div>
                                @if(!$isPaypalDefault)
                                    <a href="" class="delete-method" onclick="deletePM(event, 'paypal-method')">
                                        <img src="{{url('assets/image_new/svg/colored/close.svg')}}" alt="">
                                    </a>
                                @endif
                            </div>
                        @endif

                    @else

                        <span>{{__('No payment methods')}}</span>

                    @endif

                    <div class='paymant-method-modal-right-side-boottom'>
                        <div class='paymant-method-modal-right-side-btn-wrap'>
                            <button type="button" id="savePM" disabled onclick="saveDefaultPM()"
                                    class="paymant-method-modal-right-side-btn font-18-lh-21-regular">{{__('Save')}}</button>
                            <div class='paymant-method-modal-right-side-lock'></div>
                        </div>
                        <div></div>
                        <div class='paymant-method-modal-right-side-edad-wrap'>
                            @if((count($payment_methods) > 1) || ($user_company->paypal_method && (count($payment_methods) == 1)))
                                <a href="" onclick="managePM(event)" class='paymant-method-modal-right-side-ed font-16-lh-26-medium'>{{__('Edit')}}</a>
                            @endif
                            <a href="" onclick="addPaymentMethod(event)" id="add-payment-method-btn"
                               class='paymant-method-modal-right-side-edad font-16-lh-26-medium'>{{__('Add New')}}</a>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ADD PAYMENT --}}

            <div id="add-payment-method" class='paymant-method-modal-right-side'>
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium'>{{__('Add Payment Method')}}</h3>
                <div class='paymant-method-modal-right-side-first-wrap'>
                    <div class='paymant-method-modal-right-side-first-field-paypal'></div>
                    <div class='paymant-method-modal-right-side-first-field-mastercard'></div>
                    <div class='paymant-method-modal-right-side-first-field-visa'></div>
                    <select onchange="selectPaymentMethod()" class='paymant-method-modal-right-side-first-field' name="select" id="payment-selector">
                        <option class='paymant-method-modal-right-side-first-field-option font-15-lh-20-semi-bold'
                                value="paypal">{{__('PayPal')}}
                        </option>
                        <option class='paymant-method-modal-right-side-first-field-option font-15-lh-20-semi-bold'
                                value="card" selected>{{__('Visa/Mastercard')}}
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

{{-- EDIT SUBSCRIPTION --}}

<div id='edit-subscription' class="paymant-method-modal modal fade" tabindex="-1" role="dialog"
     aria-labelledby="editSubscriptionLabel" aria-hidden="true">
    <div class="paymant-method-modal-content modal-dialog" role="document">
        <div class='paymant-method-modal-header-wrap'>
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
            <h3 class="paymant-method-modal-title font-28-lh-42-semi-bold">{{__('Manage your subscription')}}</h3>
{{--            <div>--}}
{{--                <button type="button" class="paymant-method-modal-back font-22-lh-27-bold ">{{__('Back')}}</button>--}}
{{--            </div>--}}
{{--            <div class='paymant-method-modal-back-arrow'></div>--}}
        </div>
        {{-- <div class='paymant-method-modal-header-wrap'>
          <button type="button" class="paymant-method-modal-close"></button>
<h3 class="paymant-method-modal-title font-28-lh-42-semi-bold">{{__('We will be waiting you back')}}</h3>
        </div> --}}
        <hr class='paymant-method-modal-line'>
        <div class='paymant-method-modal-wrap' style="position: relative">
            <div class='overlay'></div>
            {{-- SUBSCRIPTION SUCCESSFUL --}}
            {{--             <div>--}}
            {{--            <div class='paymant-method-modal-succes-wrap'>--}}
            {{--            <h3 class='paymant-method-modal-succes-title font-20-lh-24-semi-bold '>{{__('Your subscription was successfully cancelled!')}}</h3>--}}
            {{--            <div class='paymant-method-modal-succes-icon'></div>--}}
            {{--            </div>--}}
            {{--            <div class="paymant-method-modal-succes-link-wrap">--}}
            {{--              <a class="paymant-method-modal-succes-link-left font-14-lh-26-bold" href="/">{{__('Chose another subscription')}}</a>--}}
            {{--              <a class="paymant-method-modal-succes-link-right font-14-lh-26-bold" href="/">{{__('Get free 14-day trial')}}</a>--}}
            {{--            </div>--}}
            {{--            </div>--}}
            {{-- YOUR Subscription --}}
            <div class='paymant-method-modal-left-side'>
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium'>{{__('Your Subscription')}}</h3>
                <div class='paymant-method-modal-left-side-info'>
                    <div class='paymant-method-modal-left-side-wrap-title'>
                        <div class='paymant-method-modal-left-side-logo'></div>
                        <h4 class='paymant-method-modal-left-side-card-title font-22-lh-25-medium'>{{__('Afdal Analytics') . ' ' . $user_plan_name }}</h4>
                    </div>
                    @if($subscription_info)
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light'>{{__('Commitment')}}</p>
                        @if($subscription_info['interval'] == 'month')
                            <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>{{ __('Paid monthly') }}</p>
                        @elseif($subscription_info['interval'] == 'year')
                            <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>{{ __('Annual plan') }}</p>
                        @endif
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light'>{{__('Next regular payment*')}}</p>
                        <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>${{$subscription_info['next_payment']}}</p>
                    @elseif(auth()->user()->company->onTrial())
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light'>
                            {{__('The trial period will end in ')}} {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }} {{__('days')}}
                        </p>
                    @else
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light'>{{__('No plan')}}</p>
                    @endif
                    <hr>
                    <div class='paymant-method-modal-left-side-card-bottom-text'>
                        <p class='paymant-method-modal-left-side-card-text-medium font-17-lh-19-medium'>{{__('Requires use with only one account*')}}</p>
                        <div class='paymant-method-modal-left-side-card-text-icon'></div>
                    </div>

                </div>
            </div>

            {{-- AVAIBLE ACTIONS --}}

            <div class='paymant-method-modal-right-side'>
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium'>{{__('Available Actions')}}</h3>
                <div class='paymant-method-modal-right-side-wrap'>
                    <div class='paymant-method-modal-right-side-wrap-title'>
                        <h4 class='paymant-method-modal-right-side-card-title font-22-lh-25-medium'>{{__('Find a Better Plan')}}</h4>
                        <div class='paymant-method-modal-right-side-icon'></div>
                    </div>
                    <p class='paymant-method-modal-text font-16-lh-19-regular'>{{__('Not enough connections in your plan? Let us help you find the right plan for your needs, and make the switch quick and easy.')}}</p>
                    <a href="{{ url('/dashboard/subscribe-plan') }}"
                       class="paymant-method-modal-right-side-card-btn">{{__('Change')}}</a>
                </div>

                @if($subscription_data && empty($ends_at))
                    <div class='paymant-method-modal-right-side-wrap'>
                        <div class='paymant-method-modal-right-side-wrap-title'>
                            <h4 class='paymant-method-modal-right-side-card-title font-22-lh-25-medium'>{{__('End Your Subscription')}}</h4>
                            <div class='paymant-method-modal-right-side-icon-cross'></div>
                        </div>
                        <p class='paymant-method-modal-text font-16-lh-19-regular'>{{__('Sometimes you just need to call it quits. We get it and would love to have you back. Make sure to keep an eye out on our offers!')}}</p>
                        <button type="button" onclick="endSubBlock()"
                                class="paymant-method-modal-right-side-card-btn">{{__('End Service')}}</button>
                    </div>
                @endif
            </div>

        </div>

        {{-- END THE Subscription --}}

        <div id="endSubscription">
            <hr class='paymant-method-modal-line-bottom'>
            <div class='paymant-method-modal-bottom-side'>
                <div class='paymant-method-modal-bottom-side-left-wrap'>
                    <p class='paymant-method-modal-bottom-side-left-title font-17-lh-20-medium'>{{__('Need Help?')}}</p>
                    <div class='paymant-method-modal-bottom-side-left-text'>
                        <a class='font-14-lh-16-light payment-method-modal-bottom-side-left-link' href="/">{{__('Watch Video')}}</a>
                        <div class='paymant-method-modal-bottom-side-delta'></div>
                    </div>
                    <div class='paymant-method-modal-bottom-side-left-text'>
                        <a class='font-14-lh-16-light payment-method-modal-bottom-side-left-link' href="/">{{__('View Demo')}}</a>
                        <div class='paymant-method-modal-bottom-side-search'></div>
                    </div>
                    <div class='paymant-method-modal-bottom-side-left-text'>
                        <a class='font-14-lh-16-light payment-method-modal-bottom-side-left-link' href="/">{{__('Read Help Article')}}</a>
                        <div class='paymant-method-modal-bottom-side-info'></div>
                    </div>
                </div>
                <div>
                    <p class='paymant-method-modal-bottom-side-right-title font-28-lh-42-semi-bold'>{{__('Are you sure to end the subscription?')}}</p>
                    <div class='paymant-method-modal-bottom-side-right-wrap-btn'>
                        <button onclick="endSubBlock()"
                            class='paymant-method-modal-bottom-side-right-back font-18-lh-21-regular'>{{__('Back')}}</button>
                        <button onclick="cancelSubscription()"
                            class='paymant-method-modal-bottom-side-right-end font-18-lh-21-regular'>{{__('End Subscription')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script src="{{'https://www.paypal.com/sdk/js?client-id=' . (env('PAYPAL_MODE') === 'live' ? env('PAYPAL_LIVE_CLIENT_ID') : env('PAYPAL_SANDBOX_CLIENT_ID')) . '&vault=true&intent=subscription'}}" data-sdk-integration-source="button-factory"></script>

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
                plan_id: '{{ $paypalPlanId }}',
                start_time: '{{ $nextPaymentDate }}T00:00:00Z'
            });
        },
        onApprove: function(data, actions) {
            updatePMReq(data.subscriptionID, data.orderID);
        }
    }).render('#{{ $paypalPlanId }}');
</script>

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
    ifSubEnd = false;

    function selectPaymentMethod() {
        if ($('#payment-selector').val() === 'card') {
            $('#paypalMethod').hide();
            $('#cardMethod').show();
        } else {
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
                location.reload()
            }
        })
    }

    function addPaymentMethod(event) {
        event.preventDefault();
        $('#current-payment-method').hide();
        $('#add-payment-method').show();
    }

    function backPaymentMethod(event) {
        event.preventDefault();
        $('#current-payment-method').show();
        $('#add-payment-method').hide();

        $('#confirm-paypal').hide();
        $('#current-payment-method-inner').show();
    }

    function endSubBlock () {
        if (!ifSubEnd) {
            $('#endSubscription').show();
            document.querySelector('.overlay').style.display = "block";
            document.querySelectorAll('.paymant-method-modal-title')[1].innerHTML = "{{__('End Your Subscription')}}"
        } else {
            $('#endSubscription').hide()
            document.querySelector('.overlay').style.display = "none";
            document.querySelectorAll('.paymant-method-modal-title')[1].innerHTML = "{{__('Manage your subscription')}}"
        }
        ifSubEnd = !ifSubEnd
    }

    function cancelSubscription() {
        toggleLoader(true);

        $.ajax({
            type: 'POST',
            url: '{{ $isPaypal ? url('/cancel-paypal-subscription') : url('/cancel-subscription') }}',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: res => {
                console.log(res);
                if (res.subscriptionCanceled) {
                    location.reload()
                }
            }
        })
    }
</script>


<script>
    const stripe = Stripe('{{ config('cashier.key') }}')

    const elements = stripe.elements()
    const cardElement = elements.create('card')

    cardElement.mount('#card-element')

    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')

    let isEditing = false;
    let selectedPM = null;

    function toggleLoader(loaderStatus) {
        const preloader = $('#main-loader');
        if (loaderStatus) {
            preloader.removeClass('done');
        } else {
            preloader.addClass('done');
        };
    };

    function managePM(event) {
        event.preventDefault();
        isEditing = !isEditing;

        if (isEditing) {
            $('.paymant-method-modal-right-side-info').css({'width': '375px'});
            $('.delete-method').show();

            const additionalMethods = $('.additional-method');
            $.each(additionalMethods, (i, item) => {
                $(`#${item.id} .paymant-method-modal-right-side-info`).attr('onclick', `selectPM('${item.id}')`).addClass('selectable-PM');
            })

        } else {
            $('.paymant-method-modal-right-side-info').css({'width': '405px'});
            setTimeout(() => $('.delete-method').hide(), 300);
            $('.additional-method .paymant-method-modal-right-side-info').removeClass('selectable-PM').removeClass('selected-PM').removeAttr('onclick');
            $('#savePM').removeClass('active-btn').attr('disabled', 'true');
            $('.paymant-method-modal-right-side-lock').css({'right': '-15px'});
            selectedPM = null;
        }
    }

    function selectPM(id) {
        $('.additional-method .paymant-method-modal-right-side-info').removeClass('selected-PM');
        $(`#${id} .paymant-method-modal-right-side-info`).addClass('selected-PM');
        selectedPM = id;

        $('#savePM').addClass('active-btn').removeAttr('disabled');
        $('.paymant-method-modal-right-side-lock').css({'right': '15px'});
    }

    function updatePMReq(subscriptionID = null, orderID = null) {
        $.ajax({
            type: 'POST',
            url: '{{ url('/update-payment-method') }}',
            data: {
                _token: '{{ csrf_token() }}',
                pm_id: selectedPM,
                subscriptionID: subscriptionID,
                orderID: orderID
            },
            success: res => {

                setTimeout(() => {
                    isEditing = !isEditing;

                    $('.default-method').removeClass('default-method');
                    $(`#${selectedPM}`).addClass('default-method').css({'opacity': '1'});
                    $('.paymant-method-modal-right-side-info').css({'width': '405px'});
                    $('.additional-method .paymant-method-modal-right-side-info').removeClass('selectable-PM').removeClass('selected-PM').removeAttr('onclick');
                    $('.delete-method').css({'pointer-events': 'all'}).hide();
                    selectedPM = null;

                    toggleLoader(true);
                    location.reload();
                }, 300)
            }
        })
    }

    function saveDefaultPM() {
        event.preventDefault();

        $('#savePM').removeClass('active-btn').attr('disabled', 'true');
        $('.paymant-method-modal-right-side-lock').css({'right': '-15px'});

        $('.delete-method').css({'pointer-events': 'none'});
        $(`#${selectedPM}`).css({'opacity': '.6'});

        if ('{{ json_encode($subscription_info) }}' !== 'null' && !+'{{ $user_company->paypal_default }}' && selectedPM === 'paypal-method') {
            $('#confirm-paypal').show();
            $('#current-payment-method-inner').hide();
            return;
        }

        updatePMReq();
    }

    function deletePM(event, id) {
        event.preventDefault();

        $('#savePM').removeClass('active-btn').attr('disabled', 'true');
        $('.paymant-method-modal-right-side-lock').css({'right': '-15px'});

        $('.delete-method').css({'pointer-events': 'none'});
        $(`#${id}`).css({'opacity': '.6'});

        $.ajax({
            type: 'POST',
            url: '{{ url('/delete-payment-method') }}',
            data: {
                _token: '{{ csrf_token() }}',
                pm_id: id
            },
            success: res => {
                $(`#${id}`).css({'opacity': '0'});

                setTimeout(() => {
                    $(`#${id}`).css({'display': 'none'});
                    if (res.paymentMethods.length < 2) {
                        isEditing = !isEditing;

                        if (isEditing) {
                            $('.paymant-method-modal-right-side-info').css({'width': '375px'});
                            $('.delete-method').show();
                        } else {
                            $('.paymant-method-modal-right-side-info').css({'width': '405px'});
                            setTimeout(() => $('.delete-method').hide(), 300);
                        }
                    } else {
                        $('.delete-method').css({'pointer-events': 'all'});
                    }
                    selectedPM = null;
                }, 300)
            }
        })
    }

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

</body>
