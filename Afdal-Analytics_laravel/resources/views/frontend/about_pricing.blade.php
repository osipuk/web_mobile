
@include('layout.userhead')


@include('frontend.components.header-menu')


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
    
        .plan-features-list-text {
            color: #000 !important;
            align-items: flex-start !important;
        }

        .fa-check{
            color:#f7993a!important;
        }    

</style>


<main class="about-pricing">
    <div class="about-pricing-header">
        <h2 class="about-pricing-title font-64-lh-135-semi-bold">
            {{__("Right plan for your growth")}}
        </h2>

        <p class="about-pricing-text font-22-lh-25-light">
            {{__("Get started for free and we'll be with you as you grow.")}}
        </p>

        {{-- <div class="promo-alert">
            <span class="font-20-lh-42-semi-bold">
                {{__('50% off on the first month subscription (monthly plan) or 50% off on annual plan')}}
            </span>
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
                            /{{__("month per connection")}}
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
                        {{__("Unlimited Pre-Built Dashboards")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Minimum 1 Connection")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Learning Base")}}
                    </p>

                    <p class="plan-features-list-text font-20-lh-42-regular">
                        <i class="fas fa-check mx-2"></i>
                        {{__("1-hour of Analytics Consulting")}}
                    </p>
                </div>
            </div>
            <div class="text-center card-footer border-0 pt-0">
                @if(auth()->user() && auth()->user()->essentials())
                    <p class="pricing-card-description font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                @else
                    @if(auth()->user())
                        <a href="{{url('dashboard/pricing/essentials')}}"
                           class="btn ml-0 btn-warning font-20-lh-42-semi-bold">{{__("14 DAYS FREE TRIAL")}}</a>
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
                            /{{__("month per connection")}}
                        </p>
                    </div>
                    <p class='price-two font-16-lh-22-semi-bold' style="margin: 40px 0 35px;">
                        {{__("Comprehensive data collection and transformation for teams to connect to any platform, any where")}}
                    </p>
                </div>
                <div class="plan-features-list pb-4">
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Everything In Essential")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Minimum 5 Connection")}}
                    </p>
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Unlimited Users")}}
                    </p>
                    
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Custom Dashboard Per Connection & profile")}}
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
            <div class="text-center card-footer border-0 pt-3">
                @if(auth()->user() && auth()->user()->plus())
                    <p class="pricing-card-description font-18-lh-25-semi-bold">{{__('Your current plan')}}</p>
                @else
                    <a href="{{auth()->user() ? url('dashboard/pricing/plus') : url('login')}}"
                       class="btn ml-0 btn-warning font-20-lh-42-semi-bold">{{__("CHOOSE")}}</a>
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
                            /{{__("month per connection")}}
                        </p>
                    </div>
                    <p class='font-16-lh-22-semi-bold' style="margin: 40px 0 35px;">
                        {{__("Unified marketing reporting for international brands, or teams. Robust support with enterprise security")}}
                    </p>
                </div>
                <div class="plan-features-list">
                    <p class="plan-features-list-text font-20-lh-42-medium">
                        <i class="fas fa-check mx-2"></i>
                        {{__("Everything In Plus")}}
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
                       class="btn ml-0 btn-warning font-20-lh-42-semi-bold">{{__("CHOOSE")}}</a>
                @endif
            </div>
        </div>
    </div>

    <section class="about-pricing-compare-plans">
        <h2 class="about-pricing-compare-plans-title font-64-lh-135-semi-bold">{{__("Compare Plans")}}</h2>
        <div class="about-pricing-compare-plans-wrapper font-24-lh-50-medium">
            <div class="about-pricing-compare-plans-row my-3">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">

                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="font-24-lh-50-bold">{{__("Essentials")}}</div>
                    <div>{{$prices_for_frontend['essentials']}}</div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    <div class="font-24-lh-50-bold">{{__("Plus")}}</div>
                    <div>{{$prices_for_frontend['plus']}}</div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    <div class="font-24-lh-50-bold">{{__("Enterprise")}}</div>
                    <div>{{$prices_for_frontend['enterprise']}}</div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Minimum Number of Connections/Per Profile")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    1
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    5
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    20
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
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
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Data Volume")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    {{__("10 Gig")}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    {{__("Unlimited")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Data history ")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    {{__("Up to 1 Year")}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    {{__("Up to 2 Year")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Custom Dashboard")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    {{__("Per Connection")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Prebuilt Templates")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    {{__("Unlimited")}}
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    {{__("Unlimited")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Knowledge Base")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Guided Setup ")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Live Chat")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Email")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Video Support")}}
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
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("1 hour Marketing Analytics Consultation per Month")}}
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
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Number of Users")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    5
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    {{__("Unlimited")}}
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    {{__("Unlimited")}}
                </div>
            </div>
            <div class="about-pricing-compare-plans-row ">
                <div class="about-pricing-compare-plans-name-slot text-left-en pr-20-en">
                    {{__("Roles & Permissions Control")}}
                </div>
                <div class="about-pricing-compare-plans-name-essential-slot">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-plus-slot">
                    <div class="about-pricing-compare-plans-icon-cross"></div>
                </div>
                <div class="about-pricing-compare-plans-name-enterprise-slot">
                    <div class="about-pricing-compare-plans-icon-checked"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-pricing-faq-block">
        <h2 class="about-pricing-faq-title font-48-lh-100-semi-bold">
            {{__("Frequently Asked Questions")}}
        </h2>

        <ul class="about-pricing-faq-list">
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
                <div class="about-pricing-faq-list-item-main-content">
                    <p class="about-pricing-faq-list-item-title font-24-lh-50-regular">
                        {{__("Can I try Afdal Analytics for free?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed"></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-18-lh-25-semi-bold text-left-en">
                        {{__("Yes, we offer a 2 week trial period. You will have access to all the features available in the Essentials plan. All your data will be saved if you decide to upgrade your subcription. You can read more about the trial period and the plans that we offer in this Help Center.")}}
                        <a target='_blank' class='about-pricing-faq-link'
                           href="https://intercom.help/afdal-analytics/ar/articles/6074929-%D9%85%D8%A7-%D9%87%D9%8A-%D8%A7%D9%84%D9%85%D9%8A%D8%B2%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%AA%D9%88%D9%81%D8%B1%D8%A9-%D9%81%D9%8A-%D8%A7%D9%84%D9%81%D8%AA%D8%B1%D8%A9-%D8%A7%D9%84%D8%AA%D8%AC%D8%B1%D9%8A%D8%A8%D9%8A%D8%A9-%D8%A7%D9%84%D9%85%D8%AC%D8%A7%D9%86%D9%8A%D8%A9">
                           {{__("about the trial period ")}}
                        </a>
                        {{__("in our Help Center.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
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
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
                <div class="about-pricing-faq-list-item-main-content">
                    <p class="about-pricing-faq-list-item-title font-24-lh-50-regular">
                        {{__("Can I connect to any platform?")}}
                    </p>
                    <div class="about-pricing-faq-list-item-icon closed "></div>
                </div>
                <div class="about-pricing-faq-list-item-text-wrapper hide">
                    <div class="about-pricing-faq-list-item-text font-18-lh-25-semi-bold text-left-en">
                        {{__("We provide data collection service from most of the platforms, you can check the full list of available platforms in")}}
                        <a target='_blank' class='about-pricing-faq-link'
                           href="https://intercom.help/afdal-analytics/ar/articles/6074899-%D9%85%D8%A7-%D9%87%D9%8A-%D8%A7%D9%84%D9%85%D9%86%D8%B5%D8%A7%D8%AA-%D8%A7%D9%84%D8%AA%D9%8A-%D9%8A%D9%85%D9%83%D9%86%D9%86%D9%8A-%D8%AA%D9%88%D8%B5%D9%8A%D9%84-%D9%85%D8%B5%D8%A7%D8%AF%D8%B1-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-%D9%85%D9%86%D9%87%D8%A7">
                           {{__(" the help center.")}}
                        </a>
                        {{__("If you need any help connecting your data sources, feel free to contact us and we will guide you through the process.")}}
                    </div>
                </div>
            </li>
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
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
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
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
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
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
            <li class="about-pricing-faq-list-item"
                onclick="openFaq(this)"
            >
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

<script
    src="{{'https://www.paypal.com/sdk/js?client-id=' . (env('PAYPAL_MODE') === 'live' ? env('PAYPAL_LIVE_CLIENT_ID') : env('PAYPAL_SANDBOX_CLIENT_ID')) . '&vault=true&intent=subscription'}}"
    data-sdk-integration-source="button-factory"></script>

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
