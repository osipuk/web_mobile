@extends('layout.userhead')
@section('metahead')

    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>

    <style type="text/css">
        .fa-check {
            color: #f7993a !important;
        }
        .about-pricing .pricing-card, .dashboard-not-found .pricing-card, .settings-change-plan .pricing-card {
            max-width: 440px;
            box-shadow: 0 20px 40px rgb(36 38 114 / 11%);
            padding: 30px 34px 44px 40px;
            border: 0.5px solid #C1C1C1 !important;
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: 0.25rem;
        }

    </style>
@endsection
@php

$get_locale = NULL;

if( null !== session()->get('locale') ):
if(session()->get('locale') == 'en'):
$get_locale = 'en';
else:
$get_locale = 'ar';
endif;

else:
$get_locale = 'ar';
endif;

@endphp
@if($get_locale=='ar')
<style>
    input[type="radio"]:checked:before {
        width: 13px;
        height: 13px;
        top: 0px;
        left: 0px;
        position: relative;
        content: "";
        display: inline-block;
        visibility: visible;
        border-radius: 47px;
        border: 1px solid #E4EAF2;
        background-color: #fff;
    }

    input[type="radio"]:checked:after {
        width: 8px;
        height: 8px;
        top: -2.5px;
        left: 10.5px;
        position: relative;
        content: "";
        display: inline-block;
        visibility: visible;
        border: 1px solid #E4EAF2;
    }

    input[type="radio"]:after {
        width: 13px;
        height: 13px;
        top: 0px;
        left: 0px;
        position: relative;
        border: 1px solid #E4EAF2;
        border-radius: 47px;
        background-color: #fff;
        content: "";
        display: inline-block;
        visibility: visible;
    }
</style>
@else
<style>
    input[type="radio"]:checked:before {
        width: 13px;
        height: 13px;
        top: 0px;
        left: 11px;
        position: relative;
        content: "";
        display: inline-block;
        visibility: visible;
        border-radius: 47px;
        border: 1px solid #E4EAF2;
        background-color: #fff;
    }

    input[type="radio"]:checked:after {
        width: 8px;
        height: 8px;
        top: -2.5px;
        left: 0px;
        position: relative;
        content: "";
        background-color: #f58b1e;
        display: inline-block;
        visibility: visible;
        border: 1px solid #E4EAF2;
    }

    input[type="radio"]:after {
        width: 13px;
        height: 13px;
        top: 0px;
        left: 11px;
        position: relative;
        border: 1px solid #E4EAF2;
        border-radius: 47pt;
        background-color: #fff;
        content: "";
        display: inline-block;
        visibility: visible;
    }
</style>
@endif
@php
    $has_plan_active=false;
    $plan_name_actived='';
    if(auth()->user()){
        if(auth()->user()->essentials()){
            $plan_name_actived='essentials';
            $has_plan_active=true;
        }elseif(auth()->user()->plus()){
            $plan_name_actived='plus';
            $has_plan_active=true;
        }elseif(auth()->user()->enterprise()){
            $plan_name_actived='enterprise';
            $has_plan_active=true;
        }
    }
    @endphp
<body class="dashboard">
@include('layout.usersidenav')
<div class="main-content about-pricing">
    @include('tenant.components.subscription-header')

    <div class="about-pricing-header">
        @include('tenant.components.trial-banner')
        <h2 class="userchoosesubscription">
            {{__("Choose your subscription")}}
        </h2>
    </div>
    <div class="card-group new-pricing-desktop mb-5">
        <div id="tabs" class="nav nav-tabs new-pricing-section-tab-div" data-tabs="tabs">
            <a data-toggle="tab" href="#essential" class="new-pricing-section-tab-link-promo @if(!$has_plan_active || $plan_name_actived=='essentials') active @endif">
                <svg class="new-pricing-section-promo-icon @if($get_locale=='en') new-pricing-section-promo-icon-en @else new-pricing-section-promo-icon-ar @endif" width="40" height="50" viewBox="0 0 40 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.8383 0C26.0659 0.234775 27.2983 0.418014 28.5163 0.715778C34.7402 2.23895 39.106 7.97663 39.7938 15.5295C39.918 16.8924 39.9897 18.2667 39.9897 19.6352C40.004 37.3865 39.9992 30.2086 39.9992 47.9599V49.0765C34.8071 43.5794 29.7487 38.2139 24.6664 32.8312C19.5793 38.2196 14.5256 43.5736 9.33347 49.0765V48C9.33347 30.7068 9.33347 38.3428 9.33347 21.0496C9.33347 17.6711 9.23794 14.3156 8.48802 11.023C7.30342 5.8293 4.67151 2.21605 0.458553 0.292037C0.296149 0.217597 0.152851 0.0973458 0 0H24.8383Z" fill="#EF3054" />
                </svg>
                <div class="row m-0">
                    <div class="col-xs-4 col-sm-4 new-pricing-section-plan-name-wrapper p-inline-0" style="padding-inline-start: 52px;">
                        <p class="new-pricing-section-plan-name" style="text-align: start;">{{__('Essentials')}}</p>
                    </div>
                    <div class="col-xs-6 col-sm-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price-promo">
                                {{$prices_new['essentials']}}
                            </div>
                            <div class="new-pricing-section-plan-per-month">
                                <p style="text-align: start;">/{{__("month")}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 new-pricing-section-plan-name-wrapper">
                        <div>
                            @if($get_locale=='en')
                            <svg width="43" height="35" viewBox="0 0 43 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="9.5" y1="17.5" x2="33.5" y2="17.5" stroke="#EF3054" stroke-width="3" stroke-linecap="round" />
                                <path d="M25.2422 8L34.7985 17.5563L25.2422 27.1125" stroke="#EF3054" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            @else
                            <svg width="43" height="35" viewBox="0 0 43 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="33.5" y1="17.5" x2="9.5" y2="17.5" stroke="#EF3054" stroke-width="3" stroke-linecap="round" />
                                <path d="M17.7578 27L8.20154 17.4437L17.7578 7.88745" stroke="#EF3054" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            @endif
                        </div>
                    </div>
                </div>

            </a>
            <a data-toggle="tab" href="#plus" class="new-pricing-section-tab-link @if($plan_name_actived=='plus') active @endif">
                <div class="row m-0">
                    <div class="col-xs-4 col-sm-4 new-pricing-section-plan-name-wrapper p-inline-0" style="padding-inline-start: 52px;">
                        <p class="new-pricing-section-plan-name" style="text-align: start;">{{__('Plus')}}</p>
                    </div>
                    <div class="col-xs-6 col-sm-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price">
                                {{$prices_new['plus']}}
                            </div>
                            <div class="new-pricing-section-plan-per-month">
                                <p style="text-align: start;">/{{__("month")}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 new-pricing-section-plan-name-wrapper">
                        <div>
                            @if($get_locale=='en')
                            <svg class="pricing-black-arrow" width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="1.5" y1="11.5" x2="25.5" y2="11.5" stroke="#0B243A" stroke-width="3" stroke-linecap="round" />
                                <path d="M17.2422 2L26.7985 11.5563L17.2422 21.1125" stroke="#0B243A" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            <svg class="pricing-white-arrow" width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="1.5" y1="11.5" x2="25.5" y2="11.5" stroke="#E4EAF2" stroke-width="3" stroke-linecap="round" />
                                <path d="M17.2422 2L26.7985 11.5563L17.2422 21.1125" stroke="#E4EAF2" stroke-width="3" stroke-linecap="round" />
                            </svg>

                            @else
                            <svg class="pricing-black-arrow" width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="27.5" y1="11.5" x2="3.5" y2="11.5" stroke="#0B243A" stroke-width="3" stroke-linecap="round" />
                                <path d="M11.7578 21L2.20154 11.4437L11.7578 1.88745" stroke="#0B243A" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            <svg class="pricing-white-arrow" width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="27.5" y1="11.5" x2="3.5" y2="11.5" stroke="#E4EAF2" stroke-width="3" stroke-linecap="round" />
                                <path d="M11.7578 21L2.20154 11.4437L11.7578 1.88745" stroke="#E4EAF2" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            @endif
                        </div>
                    </div>
                </div>

            </a>
            <a data-toggle="tab" href="#enterprise" class="new-pricing-section-tab-link @if($plan_name_actived=='enterprise') active @endif">
                <div class="row m-0">
                    <div class="col-xs-4 col-sm-4 new-pricing-section-plan-name-wrapper p-inline-0" style="padding-inline-start: 52px;">
                        <p class="new-pricing-section-plan-name" style="text-align: start;">{{__("Enterprise")}}</p>
                    </div>
                    <div class="col-xs-6 col-sm-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price">
                                {{$prices_new['enterprise']}}
                            </div>
                            <div class="new-pricing-section-plan-per-month">
                                <p style="text-align: start;">/{{__("month")}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 new-pricing-section-plan-name-wrapper">
                        <div>
                            @if($get_locale=='en')
                            <svg class="pricing-black-arrow" width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="1.5" y1="11.5" x2="25.5" y2="11.5" stroke="#0B243A" stroke-width="3" stroke-linecap="round" />
                                <path d="M17.2422 2L26.7985 11.5563L17.2422 21.1125" stroke="#0B243A" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            <svg class="pricing-white-arrow" width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="1.5" y1="11.5" x2="25.5" y2="11.5" stroke="#E4EAF2" stroke-width="3" stroke-linecap="round" />
                                <path d="M17.2422 2L26.7985 11.5563L17.2422 21.1125" stroke="#E4EAF2" stroke-width="3" stroke-linecap="round" />
                            </svg>

                            @else
                            <svg class="pricing-black-arrow" width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="27.5" y1="11.5" x2="3.5" y2="11.5" stroke="#0B243A" stroke-width="3" stroke-linecap="round" />
                                <path d="M11.7578 21L2.20154 11.4437L11.7578 1.88745" stroke="#0B243A" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            <svg class="pricing-white-arrow" width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="27.5" y1="11.5" x2="3.5" y2="11.5" stroke="#E4EAF2" stroke-width="3" stroke-linecap="round" />
                                <path d="M11.7578 21L2.20154 11.4437L11.7578 1.88745" stroke="#E4EAF2" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            @endif
                        </div>
                    </div>
                </div>

            </a>
        </div>
        <div id="my-tab-content" class="tab-content new-pricing-section-content-wraper">
            <div id="essential" class="tab-pane  active m-inline-start-80">
                <p class="mb-4 ">&nbsp;</p>
                <p class="new-pricing-section-plan-description">{{__("For freelancers and small businesses who need basic reporting options")}} </p>

                <div class="py-4">
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("1 Connection")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("5 users")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Unlimited Pre-Built Dashboards")}}
                    </p>
                    @if($get_locale=='ar')
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        بيانات سابقة أقصاها سنة
                    </p>

                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("1-hour of Analytics Consulting")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Learning Base")}}
                    </p>
                    @else

                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Knowledge Base")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("1-hour of Analytics Consulting")}}
                    </p>
                    @endif

                </div>
                <div class="mt-4" style="text-align: start;">
                    @if(auth()->user() && auth()->user()->essentials())
                    <p class="font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                    @else
                    <a @if(auth()->user()) href="{{url('dashboard/pricing/essentials')}}" @else href="{{url('signup')}}" @endif class="btn-warning @if($get_locale=='en') new-pricing-section-choose-btn @else new-pricing-section-choose-btn-trail @endif" >
                        {{__("CHOOSE")}}
                    </a>
                    <p class="mt-4 no-credit-card">{{__('No credit card required')}}</p>
                    @endif
                </div>

            </div>
            <div id="plus" class="tab-pane m-inline-start-80">
                <p class="mb-4 ">&nbsp;</p>
                <p class="new-pricing-section-plan-description">{{__("Comprehensive data collection and transformation for teams to connect to any platform, any where")}} </p>

                <div class="py-4">
                    @if($get_locale=='en')
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("5 Connections")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("$10 per Additional Connection")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Everything in Essential")}}
                    </p>

                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Unlimited Users")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Custom Dashboard Per Connection & profile")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Monthly Analytics Consutls")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Chat & Video Support")}}
                    </p>
                    @else
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        $10 لكل رابط
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        5 روابط
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        عدد مستخدمين غير محدود
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        لوحات تحكم مخصصة غير محدودة
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        بيانات سابقة غير محدودة
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        إدارة حساب مخصصة
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        تدريب شهري للفريق
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        التحكم في صلاحيات و أذونات المستخدم
                    </p>
                    @endif
                </div>
                <div class="mt-4" style="text-align: start;">
                    @if(auth()->user())
                    @if(auth()->user()->plus())
                    <p class="font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                    @else
                    <a href="{{ url('dashboard/pricing/plus')}}" class="btn-warning new-pricing-section-choose-btn">
                        {{__("CHOOSE")}}
                    </a>
                    @endif
                    @else
                    <a href="{{url('signup')}}" class="btn-warning new-pricing-section-choose-btn">
                        {{__("Sign Up")}}
                    </a>
                    @endif
                </div>
            </div>
            <div id="enterprise" class="tab-pane m-inline-start-80">
                <p class="mb-4 ">&nbsp;</p>
                <p class="new-pricing-section-plan-description">{{__("Unified marketing reporting for international brands, or teams. Robust support with enterprise security")}} </p>

                <div class="py-4">
                    @if($get_locale=='en')
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("20 Connections")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("$5 per Additional Connection")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Everything In plus")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Unlimited Custom Dashboards")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Unlimited Historical Data")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Dedicated Account Manager")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Monthly team Training")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("User Roles & permisions")}}
                    </p>
                    @else
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        $5 لكل رابط
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        20 رابط
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        عدد مستخدمين غير محدود
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        لوحة تحكم مخصصة لكل رابط وملف تعريف
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        بيانات سابقة أقصاها سنتين
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        استشارات تحليلات شهرية
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        دعم الدردشة والفيديو
                    </p>
                    @endif
                </div>
                <div class="mt-4" style="text-align: start;">
                    @if(auth()->user())
                    @if(auth()->user()->enterprise())
                    <p class="font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                    @else
                    <a href="{{ url('dashboard/pricing/enterprise')}}" class="btn-warning new-pricing-section-choose-btn">
                        {{__("CHOOSE")}}
                    </a>
                    @endif
                    @else
                    <a href="{{url('signup')}}" class="btn-warning new-pricing-section-choose-btn">
                        {{__("Sign Up")}}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- mobile version -->
    <div class="card-group new-pricing-reponsive mb-5">
        <div class=" new-pricing-section-tab-div">
            <a href="#" onclick="openDetails(this,'essential-mobile')" class="remove-active new-pricing-section-tab-link-promo @if(!$has_plan_active || $plan_name_actived=='essentials') active @endif">
                <svg class="new-pricing-section-promo-icon @if($get_locale=='en') new-pricing-section-promo-icon-en @else new-pricing-section-promo-icon-ar @endif" width="40" height="50" viewBox="0 0 40 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.8383 0C26.0659 0.234775 27.2983 0.418014 28.5163 0.715778C34.7402 2.23895 39.106 7.97663 39.7938 15.5295C39.918 16.8924 39.9897 18.2667 39.9897 19.6352C40.004 37.3865 39.9992 30.2086 39.9992 47.9599V49.0765C34.8071 43.5794 29.7487 38.2139 24.6664 32.8312C19.5793 38.2196 14.5256 43.5736 9.33347 49.0765V48C9.33347 30.7068 9.33347 38.3428 9.33347 21.0496C9.33347 17.6711 9.23794 14.3156 8.48802 11.023C7.30342 5.8293 4.67151 2.21605 0.458553 0.292037C0.296149 0.217597 0.152851 0.0973458 0 0H24.8383Z" fill="#EF3054" />
                </svg>
                <div class="row m-0">
                    <div class="col-4 new-pricing-section-plan-name-wrapper p-inline-0" style="padding-inline-start: 52px;">
                        <p class="new-pricing-section-plan-name" style="text-align: start;">{{__('Essentials')}}</p>
                    </div>
                    <div class="col-6  p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price-promo">
                                {{$prices_new['essentials']}}
                            </div>
                            <div class="new-pricing-section-plan-per-month">
                                <p style="text-align: start;">/{{__("month")}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 new-pricing-section-plan-name-wrapper">
                        <div>
                            <svg width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="8" y1="1" x2="8" y2="18" stroke="#EF3054" stroke-width="2" stroke-linecap="round" />
                                <path d="M15 12.0674L8.44373 18.6237L1.88745 12.0674" stroke="#EF3054" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                </div>

            </a>
            <div id="essential-mobile" class="@if($has_plan_active && $plan_name_actived!='essentials') d-none @endif" style="margin-inline-start: 18px;">
                <p class="new-pricing-section-plan-description mt-2">{{__("For freelancers and small businesses who need basic reporting options")}} </p>

                <div class="py-2">
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("1 Connection")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("5 users")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Unlimited Pre-Built Dashboards")}}
                    </p>
                    @if($get_locale=='ar')
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        بيانات سابقة أقصاها سنة
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("1-hour of Analytics Consulting")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Learning Base")}}
                    </p>
                    @else
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Knowledge Base")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("1-hour of Analytics Consulting")}}
                    </p>
                    @endif
                </div>
                <div class="mt-4" style="text-align: start;">
                    @if(auth()->user() && auth()->user()->essentials())
                    <p class="font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                    @else
                    <a @if(auth()->user()) href="{{url('dashboard/pricing/essentials')}}" @else href="{{url('signup')}}" @endif class="btn-warning @if($get_locale=='en') new-pricing-section-choose-btn @else new-pricing-section-choose-btn-trail @endif" >
                        {{__("CHOOSE")}}
                    </a>
                    <p class="mt-4" style="font-style: normal;font-weight: 400;font-size: 12px;line-height: 25px;color: #8797AF;">{{__('No credit card required')}}</p>
                    @endif
                </div>

            </div>
            <a href="#" onclick="openDetails(this,'plus-mobile')" class="remove-active new-pricing-section-tab-link @if($plan_name_actived=='plus') active @endif">
                <div class="row m-0">
                    <div class="col-4 new-pricing-section-plan-name-wrapper p-inline-0" style="padding-inline-start: 52px;">
                        <p class="new-pricing-section-plan-name" style="text-align: start;">{{__('Plus')}}</p>
                    </div>
                    <div class="col-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price">
                                {{$prices_new['plus']}}
                            </div>
                            <div class="new-pricing-section-plan-per-month">
                                <p style="text-align: start;">/{{__("month")}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 new-pricing-section-plan-name-wrapper">
                        <div>
                            <svg class="pricing-black-arrow" width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="8" y1="1" x2="8" y2="18" stroke="#0B243A" stroke-width="2" stroke-linecap="round" />
                                <path d="M15 12.0674L8.44373 18.6237L1.88745 12.0674" stroke="#0B243A" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <svg class="pricing-white-arrow" width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="8" y1="1" x2="8" y2="18" stroke="#E4EAF2" stroke-width="2" stroke-linecap="round" />
                                <path d="M15 12.0674L8.44373 18.6237L1.88745 12.0674" stroke="#E4EAF2" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                </div>

            </a>
            <div id="plus-mobile" class=" @if($plan_name_actived!='plus') d-none @endif"" style=" margin-inline-start: 18px;">
                <p class="new-pricing-section-plan-description mt-2">{{__("Comprehensive data collection and transformation for teams to connect to any platform, any where")}} </p>

                <div class="py-4">
                    @if($get_locale=='en')
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("5 Connections")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("$10 per Additional Connection")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Everything in Essential")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Unlimited Users")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Custom Dashboard Per Connection & profile")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Monthly Analytics Consutls")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Chat & Video Support")}}
                    </p>
                    @else
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        $10 لكل رابط    
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        5 روابط
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        عدد مستخدمين غير محدود
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        لوحات تحكم مخصصة غير محدودة
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        بيانات سابقة غير محدودة
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        إدارة حساب مخصصة
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        تدريب شهري للفريق
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        التحكم في صلاحيات و أذونات المستخدم
                    </p>
                    @endif
                </div>
                <div class="my-2" style="text-align: start;">
                    @if(auth()->user())
                    @if(auth()->user()->plus())
                    <p class="font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                    @else
                    <a href="{{ url('dashboard/pricing/plus')}}" class="btn-warning new-pricing-section-choose-btn">
                        {{__("CHOOSE")}}
                    </a>
                    @endif
                    @else
                    <a href="{{url('signup')}}" class="btn-warning new-pricing-section-choose-btn">
                        {{__("Sign Up")}}
                    </a>
                    @endif
                </div>
            </div>
            <a href="#" onclick="openDetails(this,'enterprise-mobile')" class="remove-active new-pricing-section-tab-link @if($plan_name_actived=='enterprise') active @endif">
                <div class="row m-0">
                    <div class="col-4 new-pricing-section-plan-name-wrapper p-inline-0" style="padding-inline-start: 52px;">
                        <p class="new-pricing-section-plan-name" style="text-align: start;">{{__("Enterprise")}}</p>
                    </div>
                    <div class="col-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price">
                                {{$prices_new['enterprise']}}
                            </div>
                            <div class="new-pricing-section-plan-per-month">
                                <p style="text-align: start;">/{{__("month")}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 new-pricing-section-plan-name-wrapper">
                        <div>
                            <svg class="pricing-black-arrow" width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="8" y1="1" x2="8" y2="18" stroke="#0B243A" stroke-width="2" stroke-linecap="round" />
                                <path d="M15 12.0674L8.44373 18.6237L1.88745 12.0674" stroke="#0B243A" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <svg class="pricing-white-arrow" width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="8" y1="1" x2="8" y2="18" stroke="#E4EAF2" stroke-width="2" stroke-linecap="round" />
                                <path d="M15 12.0674L8.44373 18.6237L1.88745 12.0674" stroke="#E4EAF2" stroke-width="2" stroke-linecap="round" />
                            </svg>

                        </div>
                    </div>
                </div>

            </a>
            <div id="enterprise-mobile" class="@if($plan_name_actived!='enterprise') d-none @endif" style="margin-inline-start: 18px;">
                <p class="new-pricing-section-plan-description mt-2">{{__("Unified marketing reporting for international brands, or teams. Robust support with enterprise security")}} </p>

                <div class="py-4">
                    @if($get_locale=='en')
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("20 Connections")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("$5 per Additional Connection")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Everything In plus")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Unlimited Custom Dashboards")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Unlimited Historical Data")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Dedicated Account Manager")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Monthly team Training")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("User Roles & permisions")}}
                    </p>
                    @else
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        $5 لكل رابط
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        20 رابط
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        عدد مستخدمين غير محدود
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        لوحة تحكم مخصصة لكل رابط وملف تعريف
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        بيانات سابقة أقصاها سنتين
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        استشارات تحليلات شهرية
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        دعم الدردشة والفيديو
                    </p>
                    @endif
                </div>
                <div class="my-2" style="text-align: start;">
                    @if(auth()->user())
                    @if(auth()->user()->enterprise())
                    <p class="font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                    @else
                    <a href="{{ url('dashboard/pricing/enterprise')}}" class="btn-warning new-pricing-section-choose-btn">
                        {{__("CHOOSE")}}
                    </a>
                    @endif
                    @else
                    <a href="{{url('signup')}}" class="btn-warning new-pricing-section-choose-btn">
                        {{__("Sign Up")}}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class='loader-wrap'>
    <div id="main-loader" class="preloader">
        <div class="loading"></div>
        <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>
    </div>
</div>


<script>
    document.body.onload = function () {
        setTimeout(function () {
            const preloader = document.getElementById('main-loader');
            if (!preloader.classList.contains('done')) {
                preloader.classList.add('done');
            }

            $('.radio').click(() => {
                switchPlans();
            })
        }, 1000);
    };
    function openDetails(event, element_id) {
        let current_item;
        let other_item_1;
        let other_item_2;
        if (element_id == 'essential-mobile') {
            current_item = '#essential-mobile';
            other_item_1 = '#plus-mobile';
            other_item_2 = '#enterprise-mobile';

        } else if (element_id == 'plus-mobile') {
            current_item = '#plus-mobile';
            other_item_1 = '#essential-mobile';
            other_item_2 = '#enterprise-mobile';
        } else if (element_id == 'enterprise-mobile') {
            current_item = '#enterprise-mobile';
            other_item_1 = '#essential-mobile';
            other_item_2 = '#plus-mobile';
        }
        $('.remove-active').not(event).removeClass('active');
        $(current_item).removeClass('d-none');
        $(other_item_1).addClass('d-none');
        $(other_item_2).addClass('d-none');
    }
    if ($(window).width() <= 568) {
        $(function() {
            $('.plus-compare').hide();
            $('.enterprise-compare').hide();
        })
        $("input[name$='compare-plan-radio']").click(function() {
            var compare_plan_radio_val = $(this).val();
            if (compare_plan_radio_val == 'essential') {
                $('.essential-compare').show();
                $('.plus-compare').hide();
                $('.enterprise-compare').hide();
            } else if (compare_plan_radio_val == 'plus') {
                $('.essential-compare').hide();
                $('.plus-compare').show();
                $('.enterprise-compare').hide();
            } else if (compare_plan_radio_val == 'enterprise') {
                $('.essential-compare').hide();
                $('.plus-compare').hide();
                $('.enterprise-compare').show();
            }
        });
    }
</script>

</body>
