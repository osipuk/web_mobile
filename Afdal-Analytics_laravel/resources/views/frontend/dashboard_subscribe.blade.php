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

    <div class="card-group">
        <div class="pricing-card promo-card">
            <img id="promo-icon" src="{{url('/assets/image_new/svg/colored/promo.svg')}}" alt="">
            <div class="card-body h-100">
                <div class="text-center">
                    <p class="font-32-lh-68-semi-bold">{{__('Essentials')}}</p>
                    <div class='card-pricing-price-wrap'>
                        <h3 class="font-64-lh-75-medium essentials-plan-price px-3">{{$prices_for_frontend['essentials']}}</h3>
                        <p class="theme-color card-pricing-monthly-text font-14-lh-20-regular direction plan-period">
                            {{__("per month/")}}
                            <br/>
                            {{__("per connection & profile")}}
                        </p>
                    </div>
                    <p class='font-16-lh-22-semi-bold' style="margin: 40px 0 35px;">
                        {{__("For freelancers and small businesses who need basic reporting options")}}
                    </p>
                </div>
                <div class="plan-features-list">

                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check mx-2"></i>
                        {{__("5 users")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Minimum 1 Connection")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Unlimited Pre-Built Dashboards")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Historical data up to one year")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check mx-2"></i>
                        {{__("1-hour of Analytics Consulting")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Learning Base")}}
                    </p>
                </div>
            </div>
            <div class="text-center card-footer border-0 pt-0">

                <?php 
                ?>
                @if(auth()->user() && auth()->user()->essentials())
                    <p class="pricing-card-description font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                @else
                    @if(auth()->user())
                        <a href="{{url('dashboard/pricing/essentials')}}"
                           class="btn ml-0 btn-warning font-20-lh-42-semi-bold new-choose-btn">{{__("CHOOSE")}}</a>
                    @else
                        <div class="d-flex flex-column align-items-center">
                            <a href="{{url('signup')}}" style="width: initial;"
                               class="btn pricing-btn-free-trial ml-0 btn-warning font-20-lh-42-semi-bold">{{__("14 DAYS FREE TRIAL")}}</a>
                            <span class="font-12-lh-17-semi-bold mt-3" style="color: #7E92AC;">{{__('No credit card required')}}</span>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="pricing-card">
            <div class="card-body h-100">
                <div class="text-center">
                    <p class="font-32-lh-68-semi-bold">{{__('Plus')}}</p>
                    <div class='card-pricing-price-wrap'>
                        <h3 class="font-64-lh-75-medium essentials-plan-price px-3">{{$prices_for_frontend['plus']}}</h3>
                        <p class="card-pricing-monthly-text font-14-lh-20-regular direction plan-period">
                            {{__("per month/")}}
                            <br/>
                            {{__("per connection & profile")}}
                        </p>
                    </div>
                    <p class='price-two font-16-lh-22-semi-bold' style="margin: 40px 0 35px;">
                        {{__("Comprehensive data collection and transformation for teams to connect to any platform, any where")}}
                    </p>
                </div>
                <div class="plan-features-list pb-4">
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Unlimited Users")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Minimum 5 Connection")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Custom Dashboard Per Connection & profile")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Historical data for a maximum of two years")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Monthly Analytics Consulting")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Chat & Video Support")}}
                    </p>
                </div>
            </div>
            <div class="text-center card-footer border-0 pt-0">
                @if(auth()->user() && auth()->user()->plus())
                    <p class="pricing-card-description font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                @else
                    <a href="{{auth()->user() ? url('dashboard/pricing/plus') : url('login')}}"
                       class="btn ml-0 btn-warning font-20-lh-42-semi-bold new-choose-btn">{{__("CHOOSE")}}</a>
                @endif
            </div>
        </div>
        <div class="pricing-card">
            <div class="card-body h-100">
                <div class="text-center">
                    <p class="font-32-lh-68-semi-bold">{{__("Enterprise")}}</p>
                    <div class='card-pricing-price-wrap card-pricing-enterprise'>
                        <h3 class="font-64-lh-75-medium essentials-plan-price px-3">{{$prices_for_frontend['enterprise']}}</h3>
                        <p class="card-pricing-monthly-text font-14-lh-20-regular direction plan-period">
                            {{__("per month/")}}
                            <br/>
                            {{__("per connection & profile")}}
                        </p>
                    </div>
                    <p class='font-16-lh-22-semi-bold' style="margin: 40px 0 35px;">
                        {{__("Unified marketing reporting for international brands, or teams. Robust support with enterprise security")}}
                    </p>
                </div>
                <div class="plan-features-list">
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Unlimited Users")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Minimum 20 Connection")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Unlimited Custom Dashboards")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Unlimited Historical Data")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Dedicated Account Manager")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Monthly team Training")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("User Roles & permisions")}}
                    </p>
                </div>
            </div>
            <div class="text-center card-footer border-0 pt-0">
                @if(auth()->user() && auth()->user()->enterprise())
                    <p class="pricing-card-description font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                @else
                    <a href="{{auth()->user() ? url('dashboard/pricing/enterprise') : url('login')}}"
                       class="btn ml-0 btn-warning font-20-lh-42-semi-bold new-choose-btn">{{__("CHOOSE")}}</a>
                @endif
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
