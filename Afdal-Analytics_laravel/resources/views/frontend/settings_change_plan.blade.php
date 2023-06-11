@extends('layout.userhead')
<main class="settings-change-plan">
    <div class="settings-change-plan-header">
        <a href="/user-profile" class="settings-change-plan-back-btn font-16-lh-26-medium">
            {{__("Back")}}
        </a>
        <h3 class="settings-change-plan-header-title font-28-lh-42-semi-bold">
            {{__("Change Subscription")}}
        </h3>
        <div class="settings-change-plan-header-empty-block"></div>
    </div>

    <h2 class="settings-change-plan-header-title font-48-lh-64-semi-bold">
        {{__("Pick the plan that's right for you.")}}
    </h2>

    @include('frontend.components.subscribe-pay-range')
    <div class="card-group">
        <div class="card pricing-card mt-5 ">
            <div class="card-body ">
                <div class="text-center">
                    <p class="font-32-lh-68-semi-bold">{{__('Essentials')}}</p>
                    <div class='card-pricing-price-wrap'>
                        <h3 class="font-64-lh-75-medium essentials-plan-price px-3">$5</h3>
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
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("5 users")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("Minimum 1 Connection")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("Unlimited Pre-Built Dashboards")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("Historical data up to one year")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("1-hour of Analytics Consulting")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("Learning Base")}}
                    </p>
                </div>
            </div>
            <div class="text-center card-footer border-0 pt-0">
                <button class="btn ml-0 btn-warning font-20-lh-24-semi-bold">{{__("CHOOSE")}}</button>
            </div>
        </div>
        <div class="card pricing-card mt-5 price-two">
            <div class="card-body ">
                <div class="text-center">
                    <p class="font-32-lh-68-semi-bold">{{__('Plus')}}</p>
                    <div class='card-pricing-price-wrap'>
                        <h3 class="font-64-lh-75-medium essentials-plan-price px-3">$10</h3>
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
                <div class="plan-features-list">
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
                <button class="btn ml-0 btn-white theme-color font-20-lh-24-semi-bold">{{__("CHOOSE")}}</button>
            </div>
        </div>
        <div class="card pricing-card mt-5 price-one">
            <div class="card-body ">
                <div class="text-center">
                    <p class="font-32-lh-68-semi-bold">{{__("Enterprise")}}</p>
                    <div class='card-pricing-price-wrap card-pricing-enterprise'>
                        <h3 class="font-64-lh-75-medium essentials-plan-price px-3">$15</h3>
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
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("Unlimited Users")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("Minimum 20 Connection")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("Unlimited Custom Dashboards")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("Unlimited Historical Data")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("Dedicated Account Manager")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("Monthly team Training")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check text-warning mx-2"></i>
                        {{__("User Roles & permisions")}}
                    </p>
                </div>
            </div>
            <div class="text-center card-footer border-0 pt-0">
                <button class="btn ml-0 btn-warning font-20-lh-24-semi-bold">{{__("CHOOSE")}}</button>
            </div>
        </div>
    </div>
    {{-- <div class='settings-change-wrap'>
      <div><div class='settings-change-cirkle-white'>kolo</div>
      <p>إنهاء</p></div>

      <div class='settings-change-line'></div>
    </div>
<a href="" class='skip-link-trial font-16-lh-26-medium'>Skip Subscription Choice - Stat your 14-Day Trial instead</a> --}}

@include('frontend.components.loader')

</main>



