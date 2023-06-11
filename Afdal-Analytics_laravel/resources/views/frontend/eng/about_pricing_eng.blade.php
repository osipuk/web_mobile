
@include('layout.userhead')


@include('frontend.components.header-menu-eng')
<div class='eng'>
<main class="about-pricing">
    <div class="about-pricing-header">
        <h2 class="about-pricing-title font-64-lh-75-semi-bold">
            {{__("Right plan for your growth")}}
        </h2>

        <p class="about-pricing-text font-22-lh-25-light">
            {{__("Get started for free and we'll be with you as you grow. ")}}
        </p>
    </div>

    {{-- <div class="subscribe-pay-range-block">
        @include('frontend.components.subscribe-pay-range')
    </div> --}}

    <div class="card-group about-pricing-card-group">
        <div class="card pricing-card">
            <div class="card-body ">
                <div class="text-center">
                    <p class="theme-color font-30-lh-35-medium">{{__('Essentials')}}</p>
                    <div class='card-pricing-price-wrap'>
                    <h3 class="font-64-lh-75-medium essentials-plan-price">$299</h3>
                    <p class="theme-color card-pricing-monthly-text font-12-lh-14-medium direction plan-period">{{__("/Monthly billed annually")}}</p>
                    </div>
                    <p class='font-16-lh-19-medium'>{{__('Or')}} $359 {{__('Billed Monthly')}}</p>
                    <p class="pricing-card-description pricing-essent-w font-18-lh-25-semi-bold ">{{__("Everything you need as a marketer to quickly analyze marketing data from all common marketing apps and platforms.")}}</p>
                </div>
                <div class="plan-features-list plan-include">

                    <p class="plan-features-list-text font-20-lh-42-medium">{{__("Insights")}} <i
                            class="fas fa-check ml-2"></i></p>
                    <p class="plan-features-list-text font-20-lh-42-medium">{{__("Dashboards")}} <i
                            class="fas fa-check ml-2"></i></p>
                    <p class="plan-features-list-text font-20-lh-42-medium">{{__("3 Connections")}} <i
                            class="fas fa-check ml-2"></i></p>
                    <p class="plan-features-list-text font-20-lh-42-medium">{{__("Learnings Base")}}<i
                            class="fas fa-check ml-2"></i></p>
                    <p class="plan-features-list-text font-20-lh-42-medium">{{__("Email Support")}} <i
                            class="fas fa-check ml-2"></i></p>
                </div>
            </div>
            <div class="text-center card-footer border-0 pt-0">
                @if(auth()->user() && auth()->user()->essentials())
                    <p class="pricing-card-description font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                @else
                    @if(auth()->user())
                        <a href="{{url('dashboard/pricing/essentials')}}" class="btn ml-0 btn-warning font-20-lh-42-semi-bold">{{__("CHOOSE")}}</a>
                    @else
                        <a href="{{url('signup')}}" style="width: initial;" class="btn ml-0 btn-warning font-20-lh-42-semi-bold">{{__("14 DAYS FREE TRIAL")}}</a>
                    @endif
                @endif
            </div>
        </div>
        <div class="card pricing-card price-two midle-price">
            <div class="card-body ">
                <div class="text-center">
                    <p class="font-30-lh-35-medium">{{__('Plus')}}</p>
                    <div class='card-pricing-price-wrap'>
                    <h3 class="font-64-lh-75-medium essentials-plan-price">$715</h3>
                    <p class="card-pricing-monthly-text font-12-lh-14-medium direction plan-period">{{__("/Monthly billed annually")}}</p>
                    </div>
                    <p class='price-two font-16-lh-19-medium'>{{__('Or')}} $859 {{__('Billed Monthly')}}</p>
                    <p class="pricing-card-description pricing-plus-w font-18-lh-25-semi-bold pricing-info-text">{{__("Comprehensive data collection and transformation for teams to connect to any platform, anywhere.")}}</p>
                </div>
                <div class="plan-features-list">
                    <p class="font-20-lh-42-medium">{{__("Everything In Essential")}}<i
                            class="fas fa-check theme-color ml-2"></i></p>
                    <p class="font-20-lh-42-medium">{{__("Proactive Dashboards")}}<i
                            class="fas fa-check theme-color ml-2"></i></p>
                    <p class="font-20-lh-42-medium">{{__("5 Connections")}}<i class="fas fa-check theme-color ml-2"></i>
                    </p>
                    <p class="font-20-lh-42-medium">{{__("Roles & permissions")}}<i
                            class="fas fa-check theme-color ml-2"></i></p>
                    <p class="font-20-lh-42-medium">{{__("Phone Support")}}<i class="fas fa-check theme-color ml-2"></i>
                    </p>
                </div>
            </div>
            <div class="text-center card-footer border-0 pt-0">
                @if(auth()->user() && auth()->user()->plus())
                    <p class="pricing-card-description font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                @else
                    <a href="{{auth()->user() ? url('dashboard/pricing/plus') : url('login')}}" class="btn ml-0 btn-warning midle-btn-choose font-20-lh-42-semi-bold">{{__("CHOOSE")}}</a>
                @endif
            </div>
        </div>
        <div class="card pricing-card price-one">
            <div class="card-body ">
                <div class="text-center">
                    <p class="font-30-lh-35-medium">{{__("Enterprise")}}</p>
                    <div class='card-pricing-price-wrap card-pricing-enterprise'>
                    <h3 class="font-64-lh-75-medium essentials-plan-price">$1465</h3>
                    <p class="card-pricing-monthly-text font-12-lh-14-medium direction plan-period">{{__("/Monthly billed annually")}}</p>
                    </div>
                    <p class='font-16-lh-19-medium'>{{__('Or')}} $1759 {{__('Billed Monthly')}}</p>
                    <p class="pricing-card-description pricing-enterp-w font-18-lh-25-semi-bold">{{__("Unified marketing reporting for international brands, or teams. Robust support with enterprise security.")}}</p>
                </div>
                <div class="plan-features-list">
                    <p class="font-20-lh-42-medium">{{__("Everything In Plus")}} <i
                            class="fas fa-check text-warning ml-2"></i></p>
                    <p class="font-20-lh-42-medium">{{__("Custom Dashboards")}} <i
                            class="fas fa-check text-warning ml-2"></i></p>
                    <p class="font-20-lh-42-medium">{{__('Unlimited Connections')}} <i
                            class="fas fa-check text-warning ml-2"></i></p>
                    <p class="font-20-lh-42-medium">{{__("2 years Data History")}} <i
                            class="fas fa-check text-warning ml-2"></i></p>
                    <p class="font-20-lh-42-medium">{{__("Guided Setup")}} <i
                            class="fas fa-check text-warning ml-2"></i></p>
                </div>
            </div>
            <div class="text-center card-footer border-0 pt-0">
                @if(auth()->user() && auth()->user()->enterprise())
                    <p class="pricing-card-description font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                @else
                    <a href="{{auth()->user() ? url('dashboard/pricing/enterprise') : url('login')}}" class="btn ml-0 btn-warning font-20-lh-42-semi-bold">{{__("CHOOSE")}}</a>
                @endif
            </div>
        </div>
    </div>

    <section class="about-pricing-compare-plans">
        <h2 class="about-pricing-compare-plans-title font-64-lh-135-semi-bold">{{__("Compare Plans")}}</h2>
        <div class="about-pricing-compare-plans-wrapper font-24-lh-28-medium">
            <div class="about-pricing-compare-plans-row">
                <div class="about-pricing-compare-plans-name-slot">

                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    {{__("Essentials")}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    {{__("Plus")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Enterprise")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot font-24-lh-28-semi-bold">
                    {{__("Number of Connections")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    3
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    5
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot font-24-lh-28-semi-bold">
                    {{__("Data Guarantee")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot font-24-lh-28-semi-bold">
                    {{__("Unlimited Data Volume")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot font-24-lh-28-semi-bold">
                    {{__("Dashboard ")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    {{__("Standard")}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    {{__("Proactive")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Custom")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot font-24-lh-28-semi-bold">
                    {{__("Data history")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    {{__("1 year")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("2 years")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot font-24-lh-28-semi-bold">
                    {{__("Users")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    1
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    5
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot font-24-lh-28-semi-bold">
                    {{__("User Roles and Permissions")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot font-24-lh-28-semi-bold">
                    {{__("Support")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    {{__("Email ")}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    {{__("Phone and Email")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Phone and Email")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot font-24-lh-28-semi-bold">
                    {{__("Setup & configuration")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    {{__("Self-service")}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    {{__("Self-service")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Guided setup")}}
                </div>
            </div>
        </div>
    </section>

    <section class="about-pricing-faq-block">
        <h2 class="about-pricing-faq-title font-48-lh-56-semi-bold">
            {{__("Frequently Asked Questions")}}
        </h2>
        <p class="about-pricing-faq-text font-18-lh-38-semi-bold">
            {{__("We will be by your side step by step towards a better future")}}
        </p>
        <ul class="about-pricing-faq-list">
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
                <div class="about-pricing-faq-list-item-main-content">
                    <p class="about-pricing-faq-list-item-title font-24-lh-50-medium">
                        {{__("Can I try the best analytics for free?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed"></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-20-lh-25-semi-bold">
                        {{__("Yes, when you subscribe to one of our packages, you will get a free trial period. If you have any questions or would like to know more about it, you can contact us or read more ")}} <a target='_blank' class='about-pricing-faq-link' href="https://intercom.help/afdal-analytics/ar/articles/6074929-%D9%85%D8%A7-%D9%87%D9%8A-%D8%A7%D9%84%D9%85%D9%8A%D8%B2%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%AA%D9%88%D9%81%D8%B1%D8%A9-%D9%81%D9%8A-%D8%A7%D9%84%D9%81%D8%AA%D8%B1%D8%A9-%D8%A7%D9%84%D8%AA%D8%AC%D8%B1%D9%8A%D8%A8%D9%8A%D8%A9-%D8%A7%D9%84%D9%85%D8%AC%D8%A7%D9%86%D9%8A%D8%A9">{{__("about the trial period ")}}</a>{{__("in our Help Center.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
                <div class="about-pricing-faq-list-item-main-content">
                    <p class="about-pricing-faq-list-item-title font-24-lh-50-medium">
                        {{__("Is there a special price for companies?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed"></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-20-lh-25-semi-bold">
                        {{__("Yes, we have special prices for different customers to suit their different needs. The package available for enterprises, for example, has more features than the basic and additional packages to better deal with the massive flow of data and information.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
                <div class="about-pricing-faq-list-item-main-content">
                    <p class="about-pricing-faq-list-item-title font-24-lh-50-regular">
                        {{__("What are the available payment methods?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed"></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-20-lh-25-semi-bold">
                        {{__("Currently, we offer two payment methods: Using a Visa or a Mastercard or through PayPal.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
                <div class="about-pricing-faq-list-item-main-content">
                    <p class="about-pricing-faq-list-item-title font-24-lh-50-medium">
                        {{__("Can I add a data source from any platform?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed "></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-20-lh-25-semi-bold">
                        {{__("We provide data collection service from most of the platforms, you can check the full list of available platforms in")}} <a target='_blank' class='about-pricing-faq-link' href="https://intercom.help/afdal-analytics/ar/articles/6074899-%D9%85%D8%A7-%D9%87%D9%8A-%D8%A7%D9%84%D9%85%D9%86%D8%B5%D8%A7%D8%AA-%D8%A7%D9%84%D8%AA%D9%8A-%D9%8A%D9%85%D9%83%D9%86%D9%86%D9%8A-%D8%AA%D9%88%D8%B5%D9%8A%D9%84-%D9%85%D8%B5%D8%A7%D8%AF%D8%B1-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-%D9%85%D9%86%D9%87%D8%A7">{{__(" the help center.")}}</a>  {{__("If you need any help connecting your data sources, feel free to contact us and we will guide you through the process.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
                <div class="about-pricing-faq-list-item-main-content">

                    <p class="about-pricing-faq-list-item-title font-24-lh-50-medium">
                        {{__("Is the volume of imported data limited?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed "></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-20-lh-25-semi-bold">
                        {{__("The volume of imported data is unlimited for subscribers of the two packages, the additional package and the package for the organizations, it is limited only to subscribers of the basic package.")}}
                    </div>
                </div>
            </li>

        </ul>
    </section>

    {{-- <section class="dashboards-section p-auto">
        <div class="dashboards-content-wrapper">
            <div class="dashboards-content about-pricing-start-block">
                <div class="dashboards-text">
                    <h2 class="dashboards-title">
                        <span class="dashboard-title-orange font-64-lh-75-semi-bold">
                            {{__('Get started')}}
                        </span>
                        <br>
                        <span class="font-64-lh-75-semi-bold">
                            {{__(' for free')}}
                        </span>
                    </h2>
                    <p class="dashboards-info about-pricing-dashboard-text font-18-lh-25-light">
                        {{__('Gather all your data from any platform you are using - Google Ads, Bing, Facebook Ads, Google Analytics. You name it - we’ve got it!  ')}}
                    </p>

                    <a href="{{ url('/signup') }}" class="orange-button view-all-guides-btn font-20-lh-23-semi-bold">
                        {{__('Free Sign Up')}}
                    </a>
                </div>
                <div>
                    <div class="anim-layer2 about-price-img-wrap">
                        <img class="anim-layer-img2 about-price-img"
                             src="{{url('../../assets/image_new/svg/colored/pricingImg.svg')}}"
                             alt="image-animation-2"
                        >
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

        @include('frontend.components.get-started-eng')
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

</main></div>

@include('frontend.components.footer')
@include('frontend.components.cookie')

<script src="{{'https://www.paypal.com/sdk/js?client-id=' . (env('PAYPAL_MODE') === 'live' ? env('PAYPAL_LIVE_CLIENT_ID') : env('PAYPAL_SANDBOX_CLIENT_ID')) . '&vault=true&intent=subscription'}}" data-sdk-integration-source="button-factory"></script>

<script>
    setTimeout(function () {
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
</script>
