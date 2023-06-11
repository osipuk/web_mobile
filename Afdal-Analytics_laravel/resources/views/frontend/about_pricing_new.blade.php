@include('layout.userhead')


@include('frontend.components.header-menu')
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

<style type="text/css">
    .about-pricing .pricing-card,
    .dashboard-not-found .pricing-card,
    .settings-change-plan .pricing-card {
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
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: 0.25rem;
    }

    .plan-features-list-text {
        color: #000 !important;
        align-items: flex-start !important;
    }

    .fa-check {
        color: #f7993a !important;
    }
</style>
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

<main class="about-pricing">
    <div class="about-pricing-header">
        <h2 class="about-pricing-title-new font-64-lh-135-semi-bold new-pricing-heading-mobile @if($get_locale=='en') font-family-Gilroy-SemiBold @endif">
            {{__("Right plan for your growth")}}
        </h2>

        <p class="about-pricing-text new-pricing-sub-heading-mobile  @if($get_locale=='en') font-22-lh-25-light font-family-Gilroy-Light @else font-18-lh-25-semi-bold  @endif">
            {{__("Start trying Afdal Analytics for free and we'll be with you as you grow.")}}
        </p>

        {{-- <div class="promo-alert">
            <span class="font-20-lh-42-semi-bold">
                {{__('50% off on the first month subscription (monthly plan) or 50% off on annual plan')}}
        </span>
    </div> --}}
    </div>
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
    <div class="card-group new-pricing-desktop">
        <div id="tabs" class="nav nav-tabs new-pricing-section-tab-div" data-tabs="tabs">
            <a data-toggle="tab" href="#essential" class="new-pricing-section-tab-link-promo @if(!$has_plan_active || $plan_name_actived=='essentials') active @endif">
                <svg class="new-pricing-section-promo-icon @if($get_locale=='en') new-pricing-section-promo-icon-en @else new-pricing-section-promo-icon-ar @endif" width="40" height="50" viewBox="0 0 40 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.8383 0C26.0659 0.234775 27.2983 0.418014 28.5163 0.715778C34.7402 2.23895 39.106 7.97663 39.7938 15.5295C39.918 16.8924 39.9897 18.2667 39.9897 19.6352C40.004 37.3865 39.9992 30.2086 39.9992 47.9599V49.0765C34.8071 43.5794 29.7487 38.2139 24.6664 32.8312C19.5793 38.2196 14.5256 43.5736 9.33347 49.0765V48C9.33347 30.7068 9.33347 38.3428 9.33347 21.0496C9.33347 17.6711 9.23794 14.3156 8.48802 11.023C7.30342 5.8293 4.67151 2.21605 0.458553 0.292037C0.296149 0.217597 0.152851 0.0973458 0 0H24.8383Z" fill="#EF3054" />
                </svg>
                <div class="row m-0">
                    <div class="col-xs-4 col-sm-4 new-pricing-section-plan-name-wrapper p-inline-0" style="padding-inline-start: 52px;">
                        <p class="@if($get_locale=='en') new-pricing-section-plan-name @else new-pricing-section-plan-name-ar @endif" style="@if($get_locale=='en') font-size: 21px; @endif text-align: start;">{{__('Essentials')}}</p>
                    </div>
                    <div class="col-xs-6 col-sm-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price-promo">
                                {{$prices_for_frontend['essentials']}}
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
                        <p class="@if($get_locale=='en') new-pricing-section-plan-name @else new-pricing-section-plan-name-ar @endif" style="text-align: start;">{{__('Plus')}}</p>
                    </div>
                    <div class="col-xs-6 col-sm-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price">
                                {{$prices_for_frontend['plus']}}
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
                        <p class="@if($get_locale=='en') new-pricing-section-plan-name @else new-pricing-section-plan-name-ar @endif" style="text-align: start;">{{__("Enterprise")}}</p>
                    </div>
                    <div class="col-xs-6 col-sm-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price">
                                {{$prices_for_frontend['enterprise']}}
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
                    <a @if(auth()->user()) href="{{url('dashboard/pricing/essentials')}}" @else href="{{url('signup')}}" @endif class="@if($get_locale=='en') new-pricing-section-choose-btn @else new-pricing-section-choose-btn-trail @endif" >
                        @if($get_locale=='en')
                        {{__("Free Trial")}}
                        @else
                        {{__("14 DAYS FREE TRIAL")}}
                        @endif
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
                    <a href="{{ url('dashboard/pricing/plus')}}" class="new-pricing-section-choose-btn-plus">
                        {{__("CHOOSE")}}
                    </a>
                    @endif
                    @else
                    <a href="{{url('signup')}}" class="new-pricing-section-choose-btn-plus">
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
                    <a href="{{ url('dashboard/pricing/enterprise')}}" class="new-pricing-section-choose-btn-enterprise">
                        {{__("CHOOSE")}}
                    </a>
                    @endif
                    @else
                    <a href="{{url('signup')}}" class="new-pricing-section-choose-btn-enterprise">
                        {{__("Sign Up")}}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- mobile version -->
    <div class="card-group new-pricing-reponsive">
        <div class=" new-pricing-section-tab-div">
            <a href="#" onclick="openDetails(this,'essential-mobile')" class="remove-active new-pricing-section-tab-link-promo @if(!$has_plan_active || $plan_name_actived=='essentials') active @endif">
                <svg class="new-pricing-section-promo-icon @if($get_locale=='en') new-pricing-section-promo-icon-en @else new-pricing-section-promo-icon-ar @endif" width="40" height="50" viewBox="0 0 40 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.8383 0C26.0659 0.234775 27.2983 0.418014 28.5163 0.715778C34.7402 2.23895 39.106 7.97663 39.7938 15.5295C39.918 16.8924 39.9897 18.2667 39.9897 19.6352C40.004 37.3865 39.9992 30.2086 39.9992 47.9599V49.0765C34.8071 43.5794 29.7487 38.2139 24.6664 32.8312C19.5793 38.2196 14.5256 43.5736 9.33347 49.0765V48C9.33347 30.7068 9.33347 38.3428 9.33347 21.0496C9.33347 17.6711 9.23794 14.3156 8.48802 11.023C7.30342 5.8293 4.67151 2.21605 0.458553 0.292037C0.296149 0.217597 0.152851 0.0973458 0 0H24.8383Z" fill="#EF3054" />
                </svg>
                <div class="row m-0">
                    <div class="col-4 new-pricing-section-plan-name-wrapper p-inline-0" style="padding-inline-start: 52px;">
                        <p class="@if($get_locale=='en') new-pricing-section-plan-name @else new-pricing-section-plan-name-ar @endif" style="@if($get_locale=='en') font-size: 21px; @endif text-align: start;">{{__('Essentials')}}</p>
                    </div>
                    <div class="col-6  p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price-promo">
                                {{$prices_for_frontend['essentials']}}
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
                    <a @if(auth()->user()) href="{{url('dashboard/pricing/essentials')}}" @else href="{{url('signup')}}" @endif class=" @if($get_locale=='en') new-pricing-section-choose-btn @else new-pricing-section-choose-btn-trail @endif" >
                        @if($get_locale=='en')
                        {{__("Free Trial")}}
                        @else
                        {{__("14 DAYS FREE TRIAL")}}
                        @endif
                    </a>
                    <p class="mt-4" style="font-style: normal;font-weight: 400;font-size: 12px;line-height: 25px;color: #8797AF;">{{__('No credit card required')}}</p>
                    @endif
                </div>

            </div>
            <a href="#" onclick="openDetails(this,'plus-mobile')" class="remove-active new-pricing-section-tab-link @if($plan_name_actived=='plus') active @endif">
                <div class="row m-0">
                    <div class="col-4 new-pricing-section-plan-name-wrapper p-inline-0" style="padding-inline-start: 52px;">
                        <p class="@if($get_locale=='en') new-pricing-section-plan-name @else new-pricing-section-plan-name-ar @endif" style="text-align: start;">{{__('Plus')}}</p>
                    </div>
                    <div class="col-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price">
                                {{$prices_for_frontend['plus']}}
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
                    <a href="{{ url('dashboard/pricing/plus')}}" class="new-pricing-section-choose-btn-plus">
                        {{__("CHOOSE")}}
                    </a>
                    @endif
                    @else
                    <a href="{{url('signup')}}" class="new-pricing-section-choose-btn-plus">
                        {{__("Sign Up")}}
                    </a>
                    @endif
                </div>
            </div>
            <a href="#" onclick="openDetails(this,'enterprise-mobile')" class="remove-active new-pricing-section-tab-link @if($plan_name_actived=='enterprise') active @endif">
                <div class="row m-0">
                    <div class="col-4 new-pricing-section-plan-name-wrapper p-inline-0" style="padding-inline-start: 52px;">
                        <p class="@if($get_locale=='en') new-pricing-section-plan-name @else new-pricing-section-plan-name-ar @endif" style="text-align: start;">{{__("Enterprise")}}</p>
                    </div>
                    <div class="col-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price">
                                {{$prices_for_frontend['enterprise']}}
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
                    <a href="{{ url('dashboard/pricing/enterprise')}}" class="new-pricing-section-choose-btn-enterprise">
                        {{__("CHOOSE")}}
                    </a>
                    @endif
                    @else
                    <a href="{{url('signup')}}" class="new-pricing-section-choose-btn-enterprise">
                        {{__("Sign Up")}}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <section class="about-pricing-compare-plans">
        <h2 class="about-pricing-compare-plans-title font-64-lh-135-semi-bold">{{__("Compare Plans")}}</h2>
        <div class="about-pricing-compare-plans-wrapper font-24-lh-50-medium">
            <div class="about-pricing-compare-plans-row about-pricing-compare-plans-row-package-heading">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en top-heading-new-price"></div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="new-pricing-top-heading-fonts font-24-lh-50-bold @if($get_locale=='en') fontface-Gilroy-Medium @endif">{{__("Essentials")}}</div>
                    <div><input type="radio" name="compare-plan-radio" checked value="essential" class="cursor-p mt-1 compare-plan-radio"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    <div class="new-pricing-top-heading-fonts font-24-lh-50-bold @if($get_locale=='en') fontface-Gilroy-Medium @endif">{{__("Plus")}}</div>
                    <div><input type="radio" name="compare-plan-radio" value="plus" class="cursor-p mt-1 compare-plan-radio"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    <div class="new-pricing-top-heading-fonts font-24-lh-50-bold @if($get_locale=='en') fontface-Gilroy-Medium @endif">{{__("Enterprise")}}</div>
                    <div><input type="radio" name="compare-plan-radio" value="enterprise" class="cursor-p mt-1 compare-plan-radio"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Price Per Connection")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot font-family-Gilroy-Bold essential-compare">
                    {{$prices['essentials']}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot font-family-Gilroy-Bold plus-compare">
                    {{$prices['plus']}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot font-family-Gilroy-Bold enterprise-compare">
                    {{$prices['enterprise']}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Minimum Number of Connections/Per Profile")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    1
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    5
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    20
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Data Guarantee")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot  plus-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    <div class="about-pricing-compare-plans-icon-checked "></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Data Volume")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    {{__("10 Gig")}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    {{__("Unlimited")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Roles & Permissions Control")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Data history ")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    {{__("Up to 1 Year")}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    {{__("Up to 2 Year")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__('Custom Dashboards')}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    {{__('Per Connection')}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Prebuilt Templates")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    {{__("Unlimited")}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    {{__("Unlimited")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Knowledge Base")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Guided Setup ")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot  @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Live chat and Email Support")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Number of Users")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    5
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    {{__("Unlimited")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Video Support")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("1 hour Marketing Analytics Consultation per Month")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot @if($get_locale=='en') font-family-Gilroy-SemiBold @endif text-left-en pr-20-en">
                    {{__("Monthly 1 hour Team Training Sessions")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot essential-compare">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot plus-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot enterprise-compare">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-pricing-faq-block">
        <h2 class="about-pricing-faq-title font-48-lh-100-semi-bold">
            {{__("Frequently Asked Questions")}}
        </h2>
        <p class="about-pricing-text  @if($get_locale=='en') font-22-lh-25-light font-family-Gilroy-Light @else font-18-lh-25-semi-bold  @endif">
            {{__("Start trying Afdal Analytics for free and we'll be with you as you grow.")}}
        </p>
        <ul class="about-pricing-faq-list">
            <li class="about-pricing-faq-list-item" onclick="openFaq(this)">
                <div class="about-pricing-faq-list-item-main-content">
                    <p class="about-pricing-faq-list-item-title font-24-lh-50-regular">
                        {{__("Can I get a free trial?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed"></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-18-lh-25-semi-bold text-left-en">
                        {{__("Yes, we offer a 2 week trial period. You will have access to all the features available in the Essentials plan. All your data will be saved if you decide to upgrade your subcription. You can read more about the trial period and the plans that we offer in this Help Center.")}}
                        <a target='_blank' class='about-pricing-faq-link' href="https://intercom.help/afdal-analytics/ar/articles/6074929-%D9%85%D8%A7-%D9%87%D9%8A-%D8%A7%D9%84%D9%85%D9%8A%D8%B2%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%AA%D9%88%D9%81%D8%B1%D8%A9-%D9%81%D9%8A-%D8%A7%D9%84%D9%81%D8%AA%D8%B1%D8%A9-%D8%A7%D9%84%D8%AA%D8%AC%D8%B1%D9%8A%D8%A8%D9%8A%D8%A9-%D8%A7%D9%84%D9%85%D8%AC%D8%A7%D9%86%D9%8A%D8%A9">
                            {{__("about the trial period ")}}
                        </a>
                        {{__("in our Help Center.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item" onclick="openFaq(this)">
                <div class="about-pricing-faq-list-item-main-content">
                    <p class="about-pricing-faq-list-item-title font-24-lh-50-regular">
                        {{__("Do you have pricing for agencies?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed"></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-18-lh-25-semi-bold text-left-en">
                        {{__("Yes, we have special prices for different businesses to suit their needs. We understand that companies and corporations deal with a higher flow of data and information, so we offer additional features that allows them to better deal with that at a reasonable price.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item" onclick="openFaq(this)">
                <div class="about-pricing-faq-list-item-main-content">
                    <p class="about-pricing-faq-list-item-title font-24-lh-50-regular">
                        {{__("Can I connect to any platform?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed "></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-18-lh-25-semi-bold text-left-en">
                        {{__("We provide data collection service from most of the platforms, you can check the full list of available platforms in")}}
                        <a target='_blank' class='about-pricing-faq-link' href="https://intercom.help/afdal-analytics/ar/articles/6074899-%D9%85%D8%A7-%D9%87%D9%8A-%D8%A7%D9%84%D9%85%D9%86%D8%B5%D8%A7%D8%AA-%D8%A7%D9%84%D8%AA%D9%8A-%D9%8A%D9%85%D9%83%D9%86%D9%86%D9%8A-%D8%AA%D9%88%D8%B5%D9%8A%D9%84-%D9%85%D8%B5%D8%A7%D8%AF%D8%B1-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-%D9%85%D9%86%D9%87%D8%A7">
                            {{__(" the help center.")}}
                        </a>
                        {{__("If you need any help connecting your data sources, feel free to contact us and we will guide you through the process.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item" onclick="openFaq(this)">
                <div class="about-pricing-faq-list-item-main-content">

                    <p class="about-pricing-faq-list-item-title font-24-lh-50-regular">
                        {{__("Is the data really unlimited?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed "></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-18-lh-25-semi-bold text-left-en">
                        {{__("The volume of imported data is unlimited for subscribers of the Plus and Enterprise plans, it is limited only to subscribers of the Essentials Plan.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item" onclick="openFaq(this)">
                <div class="about-pricing-faq-list-item-main-content">
                    <p class="about-pricing-faq-list-item-title font-24-lh-50-regular">
                        {{__("Do I get Dashboard Templates?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed"></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-18-lh-25-semi-bold text-left-en">
                        {{__("Yes, once you connect your data sources to Afdal Analytics, we will automatically create you a dashboard with all the necessary marketing metrics. You will have the choice of choosing the template that suits your marketing needs the most.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item" onclick="openFaq(this)">
                <div class="about-pricing-faq-list-item-main-content">

                    <p class="about-pricing-faq-list-item-title font-24-lh-50-regular">
                        {{__("What do i get in the 1 Hour Analytics consulting")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed "></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-18-lh-25-semi-bold text-left-en">
                        {{__("Our data experts will help you set up your dashboard and introduce you to all the features of Afdal Analytics as well as help you understand all the metrics of your dashboards and assist your in finding the templates that suites your type of business the most.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item" onclick="openFaq(this)">
                <div class="about-pricing-faq-list-item-main-content">

                    <p class="about-pricing-faq-list-item-title font-24-lh-50-regular">
                        {{__("What is monthly Training")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed "></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-18-lh-25-semi-bold text-left-en">
                        {{__("During the monthly training sessions, we will refresh your memory about the essential data skills, give you an in-depth understanding of the marketing terminology that is used on various social media platforms and e-commerce websites.")}}
                    </div>
                </div>
            </li>

        </ul>
    </section>

    {{-- <section class="dashboards-section p-auto">
        <div class="dashboards-content-wrapper">
            <div class="dashboards-content">
                <div class="dashboards-text about-pricing-bottom-text">
                    <h2 class="dashboards-title about-pr-bottom-title font-60-lh-84-semi-bold">
                        <span class="dashboard-title-orange">
                            {{__('Resources That ')}}
    </span>
    <br>
    <span>
        {{__('Get Things Done ')}}
    </span>
    </h2>
    <p class="dashboards-info font-18-lh-25-light">
        {{__('Gather all your data from any platform you are using - Google Ads, Bing, Facebook Ads, Google Analytics. You name it - we’ve got it!  ')}}
    </p>

    <a href="{{ url('/guides') }}" class="orange-button view-all-guides-btn font-20-lh-42-semi-bold">
        {{__('View All Guides  ')}}
    </a>
    </div>
    <div>
        <div class="anim-layer2 about-price-img-wrap">
            <img class="anim-layer-img2 about-price-img" src="{{url('../../assets/image_new/svg/colored/pricingImg.svg')}}" alt="image-animation-2">
        </div>
    </div>
    </div>
    </div>
    </section> --}}

    <div class="product-page-wrapper-position-relative pricing-circle">
        <div class="footer-animation animated-circle-wrapper footer-botom">
            <div class="footer-circle"></div>
            <div class="footer-circle-orange-small">
            </div>
            <div class="footer-circle-orange-medium">
            </div>
            <div class="footer-circle-orange-large">
            </div>
        </div>

        @include('frontend.components.get-started')
    </div>

    <div class='loader-wrap'>
        <div id="main-loader" class="preloader">
            <div class="heartbeat">
                <div class="loading"></div>
                <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>
            </div>
        </div>
    </div>

    @include('frontend.components.topup')

</main>

@include('frontend.components.footer')
@include('frontend.components.cookie')

<script src="{{'https://www.paypal.com/sdk/js?client-id=' . (env('PAYPAL_MODE') === 'live' ? env('PAYPAL_LIVE_CLIENT_ID') : env('PAYPAL_SANDBOX_CLIENT_ID')) . '&vault=true&intent=subscription'}}" data-sdk-integration-source="button-factory"></script>

<script>
    setTimeout(function() {
        const preloader = document.getElementById('main-loader');
        if (!preloader.classList.contains('done')) {
            preloader.classList.add('done');
        }

        $('.radio').click(() => {
            switchPlans();
        })
    }, 400);

    function openFaq(event) {
        let textWrapper = event.querySelector('.about-pricing-faq-list-item-text-wrapper');
        let icon = event.querySelector('.about-pricing-faq-list-item-icon');

        textWrapper.classList.toggle('hide')
        icon.classList.toggle('closed')
    }

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