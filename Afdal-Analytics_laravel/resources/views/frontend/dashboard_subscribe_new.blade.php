@extends('layout.userhead')
@section('metahead')

    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>

    <style type="text/css">
        
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
        .fa-check{
            color:#f7993a!important;
        }

    </style>
@endsection
<body class="dashboard">
@include('layout.usersidenav')
<div class="main-content about-pricing">
    @include('tenant.components.subscription-header')

    <div class="about-pricing-header">

    @include('tenant.components.trial-banner')


        <h2 class="userchoosesubscription">
            {{__("Choose your subscription")}}
        </h2>

        {{--<p class="about-pricing-text font-22-lh-25-light">
            {{__("Get started for free and we'll be with you as you grow.")}}
        </p>--}}

        {{-- <div class="promo-alert">
            <span
                class="font-20-lh-42-semi-bold">{{__('50% off on the first month subscription (monthly plan) or 50% off on annual plan')}}</span>
        </div> --}}
    </div>

    @php
    $get_locale = NULL;

    if(null !== session()->get('locale') ):
    if(session()->get('locale') == 'en'):
    $get_locale = 'en';
    else:
    $get_locale = 'ar';
    endif;

    else:
    $get_locale = 'ar';
    endif;

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
    <div class="card-group">
        <div id="tabs" class="nav nav-tabs new-pricing-section-tab-div" data-tabs="tabs">
            <a data-toggle="tab" href="#essential" class="new-pricing-section-tab-link-promo @if(!$has_plan_active || $plan_name_actived=='essentials') active @endif" style="width: 530px;">
                <svg class="new-pricing-section-promo-icon" style="@if($get_locale=='en') left: 25.44%;right: 68.75%; @else right: 25.44%;left: 68.75%; @endif " width="40" height="50" viewBox="0 0 40 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.8383 0C26.0659 0.234775 27.2983 0.418014 28.5163 0.715778C34.7402 2.23895 39.106 7.97663 39.7938 15.5295C39.918 16.8924 39.9897 18.2667 39.9897 19.6352C40.004 37.3865 39.9992 30.2086 39.9992 47.9599V49.0765C34.8071 43.5794 29.7487 38.2139 24.6664 32.8312C19.5793 38.2196 14.5256 43.5736 9.33347 49.0765V48C9.33347 30.7068 9.33347 38.3428 9.33347 21.0496C9.33347 17.6711 9.23794 14.3156 8.48802 11.023C7.30342 5.8293 4.67151 2.21605 0.458553 0.292037C0.296149 0.217597 0.152851 0.0973458 0 0H24.8383Z" fill="#EF3054"/>
                </svg>
                <div class="row m-0">
                    <div class="col-sm-4 new-pricing-section-plan-name-wrapper">
                        <p class="new-pricing-section-plan-name">{{__('Essentials')}}</p>
                    </div>
                    <div class="col-sm-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price-promo">
                                {{$prices_for_frontend['essentials']}}
                            </div>
                            <div class="new-pricing-section-plan-per-month">
                                <p style="text-align: start;">/{{__("month")}}</p>  <p>{{__("per connection")}}</p> 
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 new-pricing-section-plan-name-wrapper">
                        <div>
                            @if($get_locale=='en')
                            <svg width="43" height="35" viewBox="0 0 43 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="9.5" y1="17.5" x2="33.5" y2="17.5" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                                <path d="M25.2422 8L34.7985 17.5563L25.2422 27.1125" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                            @else
                            <svg width="43" height="35" viewBox="0 0 43 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="33.5" y1="17.5" x2="9.5" y2="17.5" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                                <path d="M17.7578 27L8.20154 17.4437L17.7578 7.88745" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                            @endif
                        </div>
                    </div>
                </div>
                
            </a>
            <a data-toggle="tab" href="#plus" class="new-pricing-section-tab-link @if($plan_name_actived=='plus') active @endif" style="width: 530px;">
                <div class="row m-0">
                    <div class="col-sm-4 new-pricing-section-plan-name-wrapper">
                        <p class="new-pricing-section-plan-name">{{__('Plus')}}</p>
                    </div>
                    <div class="col-sm-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price">
                            {{$prices_for_frontend['plus']}}
                            </div>
                            <div class="new-pricing-section-plan-per-month">
                                <p style="text-align: start;">/{{__("month")}}</p>  <p>{{__("per connection")}}</p> 
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 new-pricing-section-plan-name-wrapper">
                        <div>
                            @if($get_locale=='en')
                            <svg width="43" height="35" viewBox="0 0 43 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="9.5" y1="17.5" x2="33.5" y2="17.5" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                                <path d="M25.2422 8L34.7985 17.5563L25.2422 27.1125" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                            @else
                            <svg width="43" height="35" viewBox="0 0 43 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="33.5" y1="17.5" x2="9.5" y2="17.5" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                                <path d="M17.7578 27L8.20154 17.4437L17.7578 7.88745" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                            @endif
                        </div>
                    </div>
                </div>
                
            </a>
            <a data-toggle="tab" href="#enterprise" class="new-pricing-section-tab-link @if($plan_name_actived=='enterprise') active @endif" style="width: 530px;">
                <div class="row m-0">
                    <div class="col-sm-4 new-pricing-section-plan-name-wrapper">
                        <p class="new-pricing-section-plan-name">{{__("Enterprise")}}</p>
                    </div>
                    <div class="col-sm-6 p-inline-start-0 p-inline-end-0">
                        <div class="new-pricing-section-plan-price-wrapper">
                            <div class="new-pricing-section-plan-price">
                                {{$prices_for_frontend['enterprise']}}
                            </div>
                            <div class="new-pricing-section-plan-per-month">
                                <p style="text-align: start;">/{{__("month")}}</p>  <p>{{__("per connection")}}</p> 
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 new-pricing-section-plan-name-wrapper">
                        <div>
                            @if($get_locale=='en')
                            <svg width="43" height="35" viewBox="0 0 43 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="9.5" y1="17.5" x2="33.5" y2="17.5" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                                <path d="M25.2422 8L34.7985 17.5563L25.2422 27.1125" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                            @else
                            <svg width="43" height="35" viewBox="0 0 43 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="33.5" y1="17.5" x2="9.5" y2="17.5" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                                <path d="M17.7578 27L8.20154 17.4437L17.7578 7.88745" stroke="#EF3054" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                            @endif
                        </div>
                    </div>
                </div>
                
            </a>
        </div>
        <div id="my-tab-content" class="tab-content new-pricing-section-content-wraper" style="width: 550px;">
            <div  id="essential" class="tab-pane  active m-inline-start-80">
                <p class="mb-4 ">&nbsp;</p>
                <p class="new-pricing-section-plan-description">{{__("For freelancers and small businesses who need basic reporting options")}} </p>
                
                <div class="py-4">
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Minimum 1 Connection")}}
                    </p>
                    <p  class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark" ></i>
                        {{__("5 users")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Unlimited Pre-Built Dashboards")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Learning Base")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("1-hour of Analytics Consulting")}}
                    </p>
                </div>
                <div class="mt-4" style="text-align: start;">
                    @if(auth()->user() && auth()->user()->essentials())
                        <p class="font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                    @else
                        @if(auth()->user())
                        <a href="{{url('dashboard/pricing/essentials')}}" class="btn-warning new-pricing-section-choose-btn" >
                        {{__("14 DAYS FREE TRIAL")}}
                        </a>
                        @else
                            <a href="{{url('signup')}}" class="btn-warning new-pricing-section-choose-btn" >
                                {{__("14 DAYS FREE TRIAL")}}
                            </a>
                            <p class="mt-4" style="font-style: normal;font-weight: 400;font-size: 20px;line-height: 42px;color: #8797AF;">{{__('No credit card required')}}</p>
                        
                        @endif
                    @endif
                </div>
                
            </div>
            <div id="plus" class="tab-pane m-inline-start-80"> 
                <p class="mb-4 new-pricing-section-payable">{{__("You will be paying $50")}}</p>
                <p class="new-pricing-section-plan-description">{{__("Comprehensive data collection and transformation for teams to connect to any platform, any where")}} </p>
                
                <div class="py-4">
                    <p  class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i  class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Minimum 5 Connection")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i  class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Everything In Essential")}}
                    </p>
                    <p  class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Unlimited Users")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Custom Dashboard Per Connection & profile")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Monthly Analytics Consulting")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Chat & Video Support")}}
                    </p>
                </div>
                <div class="mt-4" style="text-align: start;">
                    @if(auth()->user() && auth()->user()->plus())
                        <p class="font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                    @else
                        <a href="{{auth()->user() ? url('dashboard/pricing/plus') : url('login')}}" class="btn-warning new-pricing-section-choose-btn">
                        {{__("CHOOSE")}}
                        </a>
                    @endif
                </div>
            </div>
            <div id="enterprise" class="tab-pane m-inline-start-80"> 
                <p class="mb-4 new-pricing-section-payable">{{__("You will be paying $100")}}</p>
                <p class="new-pricing-section-plan-description">{{__("Unified marketing reporting for international brands, or teams. Robust support with enterprise security")}} </p>
                
                <div class="py-4">
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Minimum 20 Connection")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark" ></i>
                        {{__("Everything In Plus")}}
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
                        <i  class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Dedicated Account Manager")}}
                    </p>
                    <p  class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i  class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("Monthly team Training")}}
                    </p>
                    <p class="font-20-lh-42-medium new-pricing-section-plan-points">
                        <i class="fas fa-check new-pricing-section-check-mark"></i>
                        {{__("User Roles & permisions")}}
                    </p>
                </div>
                <div class="mt-4" style="text-align: start;">
                    @if(auth()->user() && auth()->user()->enterprise())
                        <p class="font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                    @else
                        <a href="{{auth()->user() ? url('dashboard/pricing/plus') : url('login')}}" class="btn-warning new-pricing-section-choose-btn">
                        {{__("CHOOSE")}}
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
</script>

</body>
