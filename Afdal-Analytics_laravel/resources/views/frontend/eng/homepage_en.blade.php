<head>
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="facebook-domain-verification" content="walnb0xottzsgeojmjijl8cc14wsha"/>
</head>
@include('layout.userhead')

@include('frontend.components.header-menu')

<div class="eng">
    <main class="homepage-main">
        @include('frontend.components.header-circle')
        <section class="discover-section discover-section-add">
            <div style="height: 291px;" class='homepage-title-wrap'>
                <h1 class="discover-title homepage-title-w font-64-lh-89-semi-bold">
                    {{__('Discover Arabic Analytics')}}
                </h1>
                <p class="discover-subtitle homepage-text-w font-18-lh-25-medium">
                    {{__('Make insights-driven decisions faster and easier with')}} <br>
                    {{__('the intelligent data and analytics platform,')}} <br>
                    {{__('for marketing, sales, and ecommerce teams.')}}
                </p>
                <a class="orange-button font-20-lh-42-semi-bold" href="/signup">
                    {{__('Try For Free')}}
                </a>
            </div>
            <div class="discover-video-wrapper homepage-video-hero">
                <iframe class="discover-video"
                        src="https://www.youtube.com/embed/wRDWhkD24KM?rel=0"
                ></iframe>
            </div>
        </section>

        <section class="dashboards-section homepage-dashboard-sec">
            <div class="dashboards-content-wrapper">
                <div class="dashboards-content">
                    <div>
                        <div class="anim-layer1">
                            <img class="anim-layer-img1"
                                 src="{{url('../../assets/image_new/home-animation-1.png')}}"
                                 alt="image-animation-1"
                            >
                        </div>
                        <div class="anim-layer2">
                            <img class="anim-layer-img2"
                                 src="{{url('../../assets/image_new/home-animation-2.png')}}"
                                 alt="image-animation-2"
                            >
                        </div>
                    </div>
                    <div class="connect-text-block">
                        <h2 class="dashboards-title font-60-lh-84-semi-bold">
            <span class="dashboard-title-orange">
              {{__('Beautiful Arabic ')}}
            </span>
                            <br>
                            <span>
              {{__(' Dashboards')}}
            </span>
                        </h2>
                        <p class="dashboards-info dashboards-simple-text font-18-lh-25-light">
                            {{__('Simple and elegant visualizations that leverage colors, consistency, and our Arab culture to help you easily understand and act upon the insight you get.')}}
                        </p>

                        <a href="/about-dashboards" class="homepage-orange-button-dashboard font-20-lh-42-semi-bold">
                            {{__('See Our Dashboards')}}
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="connect-section">
            <div class="connect-content-wrapper">
                <div class="connect-content">
                    <div class="connect-text-block">
                        <h2 class="connect-title font-60-lh-84-semi-bold">
            <span class="connect-title-orange">
              {{__('Easily Connect')}}
            </span>
                            <br>
                            <span>
              {{__('Your Data')}}
            </span>
                        </h2>
                        <p class="connect-info font-18-lh-25-light">
                            {{__("Connect all your data sources in minutes. Afdal Analytics is always integrating new connections to add to the list. Something missing? We'll build it - that's our guarantee.")}}
                        </p>
                    </div>

                    <ul class="connect-list">
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-youtube"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Youtube Insight')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-apple"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Apple App Store')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-google-ads"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Google Ads')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-amazon"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Amazon Ads')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-facebook"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Facebook Ads')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-tiktok"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('TikTok Insight')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-twitter"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Twitter Ads')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-google"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Google Search')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-bing"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Bing Ads')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-shopify"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Shopify')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-woocommerce"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Woocommerce')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-linkedin"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('LinkedIn Page Insight')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-instagram"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Instagram Insight')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-facebook"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Facebook Page Insight')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-instagram"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Instagram Ads')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-amazon"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Amazon Insight')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-linkedin"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('LinkedIn Ads')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-tiktok"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('TikTok Ads')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-pinterest"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Pinterest Insight')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-google-play"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Google Play')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-twitter"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Twitter Insight')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-google-analytics"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Google Analytics')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-pinterest"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Pinterest Ads')}}
                            </p>
                        </li>
                        <li class="connect-list-item">
                            <div class="connect-item-image logo-snapchat"></div>
                            <p class="connect-item-text font-8-lh-10-medium">
                                {{__('Snapchat Ads')}}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="benefits-section">
            <div class="benefits-background-circle">

            </div>
            <div>
                <div class="benefits-background-ring"></div>
                <div class="benefits-background-ring"></div>
                <div class="benefits-background-ring"></div>
                <div class="benefits-background-ring"></div>
                <div class="benefits-background-ring"></div>
            </div>
            <div class='benefits-section-content-wrap'>
                <h2 class="benefits-title font-64-lh-89-semi-bold">
                    <span class="benefits-title-orange">{{__('Drive Growth. ')}}</span>
                    <br>
                    <span class="">{{__('Get Insight. ')}}</span>
                </h2>

                <div class="benefits-video-wrapper">
                    <iframe class="benefits-video"
                            src="https://www.youtube.com/embed/PX8yRF9Hu8E?rel=0"
                    ></iframe>
                </div>

                <ul class="benefits-list">
                    <li class="benefits-list-item">
                        <div class="benefits-list-item-logo benefits-list-item-logo-device"></div>

                        <div class="benefits-list-item-text">
                            <p class="benefits-list-item-title font-24-lh-33-semi-bold">
                                {{__('Save time and resources')}}
                            </p>

                            <p class="benefits-list-item-info font-18-lh-25-light">
                                {{__('Eliminate manual reporting by automating data integration from all channels')}}
                            </p>
                        </div>
                    </li>

                    <li class="benefits-list-item">
                        <div class="benefits-list-item-logo benefits-list-item-logo-bucket"></div>

                        <div class="benefits-list-item-text">
                            <p class="benefits-list-item-title  font-24-lh-33-semi-bold">
                                {{__('Improve marketing performance')}}
                            </p>

                            <p class="benefits-list-item-info font-18-lh-25-light">
                                {{__('Optimize future campaign results with predictive insights')}}
                            </p>
                        </div>
                    </li>

                    <li class="benefits-list-item">
                        <div class="benefits-list-item-logo benefits-list-item-logo-document"></div>

                        <div class="benefits-list-item-text benefits-list-item-text-wrap">
                            <p class="benefits-list-item-title benefits-width-title font-24-lh-33-semi-bold">
                                {{__('Demonstrate clear value')}}
                            </p>

                            <p class="benefits-list-item-info font-18-lh-25-light">
                                {{__('Get actionable suggestions how to improve marketing ROI and drive business growth')}}
                            </p>
                        </div>
                    </li>
                </ul>
                <a href="/why-us" class="orange-button font-21-lh-44-semi-bold">
                    {{__('Explore Our Platform')}}
                </a>
            </div>
        </section>
        @include('frontend.components.latest-news')
        <div class="wrapper-position-relative homepage-wrapper-relative">
            @include('frontend.components.footer-circle')
            {{-- <section class="get-started-section">
          <h2 class="get-started-title font-48-lh-100-semi-bold">
            {{__('Get Started Today')}}
          </h2>
          <p class="get-started-text w-10 font-18-lh-25-light">
            {{__('Afdal Analytics is all about helping marketing and analytics teams build better businesses with data.')}}
          </p>
          <a href="/signup" class="orange-button get-started-orange-button font-20-lh-42-semi-bold">
            {{__('Try For Free ')}}
          </a>
        </section> --}}
            @include('frontend.components.subscription')
        </div>


        @include('frontend.components.loader')
        @include('frontend.components.topup')
    </main>
</div>

@include('frontend.components.footer')
@include('frontend.components.cookie')



