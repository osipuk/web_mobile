
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
    @include('frontend.components.header-menu')

    <section class="discover-section about-dashboard-hero">
        <div class="row discover-mob">
            <div class="col-xl-6 col-12 pr-0 dashboard-hero-text">
                <div class="d-flex flex-column text-center text-xl-right">
                    <h1 class="discover-title discover-black about-dashboards-hero-title font-64-lh-89-semi-bold text-left-en">
                        {{__('Beautiful Arabic and English Dashboards')}}
                    </h1>
                    <p class="discover-subtitle about-dashboards-hero-subtitle discover-black font-18-lh-25-medium text-left-en">
                        {{__('Drive Sales for your product & services with insight that is made for Arab businesses - Small, Medium or Large businesses, Startups and independent Arab marketers.')}}
                    </p>
                    <a class="orange-button discover-for-free-btn mt-5 mt-xl-0 font-20-lh-42-semi-bold"
                       href="{{url('/signup')}}">{{__('Try For Free')}}</a>
                </div>
            </div>
            <div class="col-xl-6 col-12 pr-0 d-flex justify-content-center">
                <div class="discover-video-wrapper about-dashboards-hero-video">
                    <iframe class="discover-video"
                            src="https://www.youtube.com/embed/PX8yRF9Hu8E?rel=0"
                    ></iframe>
                </div>
            </div>
        </div>
    </section>
    <div class="about-dashboards-features-border-wrapper fourth">
        <section class="dashboards-section">
            <div class="dashboards-content-wrapper">
                <div class="dash-f row">
                    <div class="col-xl-6 col-12">
                        <div class="dashboards-content-icon-block-figures"></div>
                    </div>
                    <div class="col-xl-6 col-12">
                        <div class="dashboards-text">
                            <h2 class="dashboards-title about-dashboards-features-top-sec-title font-60-lh-84-semi-bold text-left-en">
                                <span class="dashboard-title-orange">{{__('Turn complex data')}}</span>
                                <br/>
                                <span class="discover-black">{{__('into actionable insights')}}</span>
                            </h2>
                            <p class="dashboards-info dashboard-text-f font-18-lh-25-light discover-black text-left-en">
                                {{__('Data doesn’t have to be boring, and hard to understand. Connecting all your data from any platform - Google Ads, Bing, Facebook Ads, Google Analytics, and many more, into Afdal Analytics will make data visualization and recommendations easy.')}}
                            </p>

                            <a href="/signup"
                               class="@if($get_locale == 'ar') arabic-arrow @else english-arrow @endif orange-button dashboards-info-learn-btn font-20-lh-42-semi-bold">
                                {{__('Learn More')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="dashboards-section">
            <div class="dashboards-content-wrapper">
                <div class="row flex-column-reverse flex-xl-row">
                    <div class="col-xl-6 col-12">
                        <div class="dashboards-text dash-w-s-t">
                            <h2 class="dashboards-title dashboard-section-midle-title font-60-lh-84-semi-bold text-left-en">
                                <span class="dashboard-title-orange">{{__('Simple Arabic')}}</span>
                                <br/>
                                <span class="discover-black">{{__('Interactions')}}</span>
                            </h2>
                            <p class="dashboards-info dashboard-text-s font-18-lh-25-light discover-black text-left-en">
                                {{__('Make insights-driven decisions faster and easier with the intelligent data and analytics platform for marketing, sales, and ecommerce teams.')}}
                            </p>
                            <div style="width: 467px;margin-right: auto;">
                            <a href="/signup"
                               class="@if($get_locale == 'ar') arabic-arrow @else english-arrow @endif orange-button dashboards-info-learn-btn font-20-lh-42-semi-bold">
                                {{__('Learn More')}}
                            </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12 d-flex justify-content-end dashboards-content-icon-block-arabic-wrap">
                        <div class="dashboards-content-icon-block-arabic"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="dashboards-section mb-0">
            <div class="dashboards-content-wrapper">
                <div class="row">
                    <div class="col-xl-6 col-12 pr-0">
                        <div class="dashboards-content-icon-block-map"></div>
                    </div>
                    <div class="col-xl-6 col-12">
                        <div class="dashboards-text">
                            <h2 class="dashboards-title dashboard-section-bottom-title font-60-lh-84-semi-bold text-left-en">
                                <span class=" dashboard-title-orange">{{__('Built For Arabic')}}</span>
                                <br>
                                <span class="discover-black">{{__('Businesses')}}</span>
                            </h2>
                            <p class="dashboards-info dashboard-text-th font-18-lh-25-light discover-black w-100 text-left-en">
                                {{__('With custom Arabic dashboards, interactions and data sources, Afdal Analytics delivers tools & resources to help Arabic business grow.')}}
                            </p>

                            <a href="/signup"
                               class="@if($get_locale == 'ar') arabic-arrow @else english-arrow @endif orange-button dashboards-info-learn-btn font-20-lh-42-semi-bold">
                                {{__('Learn More')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @if($get_locale == 'ar')
    @include('frontend.components.latest-news')
    @endif
    <div class="product-page-wrapper-position-relative dashboard-section-bottom-mob">
        @include('frontend.components.footer-circle')
        @include('frontend.components.subscription')
    </div>

    @include('frontend.components.loader')
    @include('frontend.components.topup')

</main>



@include('frontend.components.footer')
@include('frontend.components.cookie')
