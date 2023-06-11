@include('layout.userhead')
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

<main class="about-connections">
    {{-- <div class="header-circle-wrapper connections-circle">
        <div class="header-circle"></div> --}}
    </div>
    @include('frontend.components.header-menu')
    <div class="about-connections-all-data-block">
        <div class="about-connections-all-data-info-wrapper">
            <h1 class="about-connections-all-data-title font-64-lh-89-semi-bold text-left-en">
                {{__("Get all the Data you need")}}
            </h1>
            <div class="about-connections-all-data-subtitle font-18-lh-25-medium text-left-en">
                {{__("With an always growing list of integrations, we get the data you need, and if it’s not there, request it and we will make it happen.")}}
            </div>
            <a href="/signup" class="about-connections-all-data-try-button orange-button font-20-lh-42-semi-bold">
                {{__("Try For Free")}}
            </a>
        </div>
        <div class="about-connections-hero-img"></div>
    </div>
    {{-- <div class="about-connections-hover-connector-block">
        <h3 class="about-connections-hover-connector-title font-53-lh-100-semi-bold">
            {{__("Hover over your connector of choice")}}
        </h3>
        <p class="about-connections-hover-connector-text font-24-lh-40-semi-bold">
            {{__("Find out why Afdal Analytics is the top pick for you and your business to grow")}}
        </p>
        <a href="#story-block" class="about-connections-connector-icon"></a>
    </div> --}}
    <div id="story-block" class="about-connections-tell-story-block about-tell-story">
        <h2 class="about-connections-tell-story-title about-tell-title font-64-lh-89-semi-bold">
            {{__("Tell a Story With Your Social Media Data Now")}}
        </h2>
        <p class="about-connections-tell-story-text about-social font-18-lh-25-semi-bold">
            {{__("Social media analytics can get a bit data-heavy sometimes but that doesn't mean tracking social media strategy performance has to be a time-consuming chore. Why
            not combine all the social media tools you're using so you can easily report on your data sources to tell a story?")}}
        </p>
    </div>
    <div class="about-connections-tell-story-icons">
        <div class="about-connections-tell-story-icons-mblock order-6-en">
            <img class="about-connections-tell-story-icons-icon" src="{{url('/assets/image_new/svg/logos/tiktok-3.svg')}}" alt="tiktok">
        </div>
        <div class="about-connections-tell-story-icons-mblock order-5-en">
            <img class="about-connections-tell-story-icons-icon" src="{{url('/assets/image_new/svg/logos/instagram-3.svg')}}" alt="instagram">
        </div>
        <div class="about-connections-tell-story-icons-mblock order-4-en">
            <img class="about-connections-tell-story-icons-icon" src="{{url('/assets/image_new/svg/logos/facebook-3.svg')}}" alt="facebook">
        </div>
        <div class="about-connections-tell-story-icons-mblock order-3-en">
            <img class="about-connections-tell-story-icons-icon" src="{{url('/assets/image_new/svg/logos/twitter-3.svg')}}" alt="twitter">
        </div>
        <div class="about-connections-tell-story-icons-mblock order-2-en">
            <img class="about-connections-tell-story-icons-icon" src="{{url('/assets/image_new/svg/logos/linkedin-3.svg')}}" alt="linkedin">
        </div>
        <div class="about-connections-tell-story-icons-mblock order-1-en">
            <img class="about-connections-tell-story-icons-icon" src="{{url('/assets/image_new/svg/logos/snapchat-3.svg')}}" alt="snapchat">
        </div>
    </div>


    <div class="about-connections-data-stories-block">
        <h2 class="about-connections-data-stories-title font-64-lh-135-semi-bold">
            {{__("Data Stories Coming")}}
        </h2>
        <p class="about-connections-data-stories-text about-features font-18-lh-25-semi-bold">
            {{__("We are always adding new features, connections, and integrations to help you get away from your daily spreadsheets and manual CSV downloads to achieve peace of
            mind.")}}
        </p>

        <div class="about-connections-data-stories-icons-block">
            <div class="about-connections-data-stories-icon logo-amazon-second order-5-en"></div>
            <div class="about-connections-data-stories-icon logo-woocommerce woocommerce-hov order-4-en"></div>
            <div class="about-connections-data-stories-icon logo-shopify-second order-3-en"></div>
            <div class="about-connections-data-stories-icon logo-google-play-data order-2-en"></div>
            <div class="about-connections-data-stories-icon logo-meta-data order-1-en"></div>
        </div>


    </div>

    <section class="dashboards-section about-connections-botom-section">
        <div class="dashboards-content-wrapper">
            <div class="dashboards-content about-connections-content">
                <div class="dashboards-text about-connections-bottom-wrap-content">
                    <h2 class="dashboards-title about-connections-bottom-title font-60-lh-84-semi-bold text-left-en">
                        <span @if($get_locale=='ar' ) class="dashboard-title-orange" @endif>
                            {{__('Build trust with')}}
                        </span>
                        <br>
                        @if($get_locale=='ar')
                        <span>{{__('data')}}</span>
                        <span>{{__('quality')}}</span>
                        @else
                        <span>{{__('quality')}}</span>
                        <span class="dashboard-title-orange">
                            {{__('data')}}
                        </span>
                        @endif

                    </h2>
                    <p class="dashboards-info font-18-lh-25-light text-left-en">
                        {{__('Make bold marketing decisions with full confidence in data quality')}}
                    </p>

                    <a href="/signup" style="padding-inline-end: 65px;"
                       class="@if($get_locale=='ar') arabic-arrow @else english-arrow @endif orange-button about-connections-btn-dash-section font-20-lh-42-semi-bold">
                        {{__('Learn More ')}}
                    </a>
                </div>
                <div style="max-width: 689px;width: 100%;">
                    {{-- <div class="about-connections-trust-icon-layer0 ">--}}
                        {{-- <img class="" --}} {{-- src="{{url('../../assets/image_new/svg/colored/trust-icon-new.svg')}}" --}} {{-- alt="image-animation-1" --}} {{-->--}}
                        {{-- </div>--}}

                    <div class="about-connections-dashboards-trust">
                        <div class="about-connections-dashboards-content-trust-base">
                            <img class="about-connections-trust-base" src="{{url('../../assets/image_new/svg/colored/trust-background.svg')}}" alt="about-connections-trust-base">
                        </div>
                        <div class="about-connections-dashboards-content-center about-connections-dashboards-content-trust">
                            <img class="about-connections-trust-center" src="{{url('../../assets/image_new/svg/colored/trust-lock.svg')}}" alt="about-connections-trust-center">
                        </div>
                    </div>
                </div>

                {{-- <div class="about-connections-trust-icon-layer1">--}}
                    {{-- <img class="" --}} {{-- src="{{url('../../assets/image_new/svg/colored/trust-icon-new.svg')}}" --}} {{-- alt="image-animation-2" --}} {{-->--}}
                    {{-- </div>--}}
            </div>
        </div>
        </div>
    </section>



    <div class="product-page-wrapper-position-relative about-connections-wrap-reletive">
        <div class="footer-animation animated-circle-wrapper about-afdal-circle-wrap">
            <div class="footer-circle"></div>
            <div class="footer-circle-orange-small">
            </div>
            <div class="footer-circle-orange-medium">
            </div>
            <div class="footer-circle-orange-large">
            </div>
        </div>
        {{-- @include('frontend.components.footer-circle')--}}
        <!-- @include('frontend.components.get-started') -->
        @include('frontend.components.subscription')
    </div>

    @include('frontend.components.loader')
    @include('frontend.components.topup')
</main>



@include('frontend.components.footer')
@include('frontend.components.cookie')