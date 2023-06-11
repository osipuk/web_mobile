
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lite-youtube-embed/0.2.0/lite-yt-embed.min.css" />
@include('frontend.components.header-menu')
<div class="eng">
<main class="product-page product-page-reletive">

    <div class="product-page-header">
      <div class="about-afdal-hero-wrap">
        <div class="product-page-header-text"><div class="about-afdal-hero-text-wrap">
            <h2 class="product-page-title font-64-lh-75-semi-bold text-left-en">
                {{__('All Your Marketing')}}
                <br>
                {{__('Data In One Place')}}
            </h2>

            <h3 class="product-page-subtitle product-page-let font-22-lh-25-light text-left-en">
                {{__('Let Afdal Analytics take care of your marketing data so you can focus on actually using it.')}}
            </h3>
            <a href="/signup" class="product-page-how-it-work-button orange-button font-20-lh-23-semi-bold float-left-en">
                {{__('Try For Free ')}}
            </a></div>
        </div>
        <div class="product-page-header-image">
{{--            <img class="product-header-image-base"--}}
{{--                src="{{url('/assets/image_new/svg/colored/product-header-image-base.svg')}}"--}}
{{--                alt="">--}}
{{--            <img class="product-header-image-gear-top gear-icon-animation"--}}
{{--                src="{{url('/assets/image_new/svg/colored/product-header-image-gear-top.svg')}}"--}}
{{--                alt="">--}}
{{--            <img class="product-header-image-gear-mid-left gear-icon-animation"--}}
{{--                src="{{url('/assets/image_new/svg/colored/product-header-image-gear-mid-left.svg')}}"--}}
{{--                alt="">--}}
{{--            <img class="product-header-image-gear-mid-right gear-icon-animation"--}}
{{--                src="{{url('/assets/image_new/svg/colored/product-header-image-gear-mid-right.svg')}}"--}}
{{--                alt="">--}}
{{--            <img class="product-header-image-gear-bot-left gear-icon-animation"--}}
{{--                src="{{url('/assets/image_new/svg/colored/product-header-image-gear-bot-left.svg')}}"--}}
{{--                alt="">--}}
{{--            <img class="product-header-image-gear-bot-mid gear-icon-animation"--}}
{{--                src="{{url('/assets/image_new/svg/colored/product-header-image-gear-bot-mid.svg')}}"--}}
{{--                alt="">--}}
{{--            <img class="product-header-image-gear-bot-right gear-icon-animation"--}}
{{--                src="{{url('/assets/image_new/svg/colored/product-header-image-gear-bot-right.svg')}}"--}}
{{--                alt="">--}}
        </div>
      </div>
      </div>
    <div class="product-page-how-it-work-block">
        <h2 class="product-page-how-it-work-title font-64-lh-75-semi-bold">
            {{__('How it works?')}}</span>
        </h2>
        <p class="product-page-how-it-work-subtitle font-22-lh-25-light">
            {{__('Afdal Analytics is an ETL platform that extracts data from various data sources, transforms the data, and loads the results into multilingual ready dashboards.')}}
        </p>
        <div class="product-page-how-it-work-wrapper">
            <ul class="product-page-how-it-work-list">
                <li class="product-page-how-it-work-list-item order-3-en">
                    <div class="product-page-how-it-work-list-item-icon third"></div>
                    <p class="product-page-how-it-work-list-item-top-text product-text-w font-22-lh-25-semi-bold">
                        {{__('Connect your data sources to Afdal Analytics')}}
                    </p>
                    <p class="product-page-how-it-work-list-item-bottom-text product-growing font-22-lh-25-light">
                        {{__('Growing library of data sources for all your needs')}}
                    </p>
                </li>
                <li class="product-page-how-it-work-list-item order-2-en">
                    <div class="product-page-how-it-work-list-item-icon second"></div>
                    <p class="product-page-how-it-work-list-item-top-text font-22-lh-25-semi-bold">
                        {{__('Automate your proactive dashboards')}}
                    </p>
                    <p class="product-page-how-it-work-list-item-bottom-text font-22-lh-25-light">
                        {{__('Insightful Arabic Dashboards with just a few clicks')}}
                    </p>
                </li>
                <li class="product-page-how-it-work-list-item order-1-en">
                    <div class="product-page-how-it-work-list-item-icon first"></div>
                    <p class="product-page-how-it-work-list-item-top-text product-text--th-w font-22-lh-25-semi-bold">
                        {{__('Get insights. Deliver Growth')}}
                    </p>
                    <p class="product-page-how-it-work-list-item-bottom-text font-22-lh-25-light">
                        {{__('Uncover new insights on performance & help drive ROI')}}
                    </p>
                </li>
            </ul>
            <div class="product-page-how-it-work-steps-block ">
                <p class="product-page-how-it-work-step font-22-lh-30-light">3</p>
                
                <div class="product-page-how-it-work-step-line"></div>
                <p class="product-page-how-it-work-step font-22-lh-30-light">2</p>
                <div class="product-page-how-it-work-step-line"></div>
                <p class="product-page-how-it-work-step font-22-lh-30-light">1</p>

            </div>
        </div>
        <a href="/about-dashboards" class="product-page-how-it-work-learn-more-btn dashboards-btn orange-button font-20-lh-42-semi-bold">
            {{__('Learn More  ')}}
        </a>

        <section class="dashboards-section">
            <div class="dashboards-content-wrapper">
                <div class="dashboards-content">
                    <div class="dashboards-text about-dashboard">
                        <h2 class="dashboards-title font-60-lh-70-semi-bold">
                            <span class="dashboard-title-orange">{{__('Connect Your')}}</span>
                            <br>
                            <span class=""> {{__('Marketing Data')}}</span>
                        </h2>
                        <p class="dashboards-info dashboard-gather font-22-lh-25-light">
                            Connect all your marketing data from multiple sources - <span>Facebook, Instagram, Twitter, Google Ads, Facebook Ads,</span> Google Analytics..You name it, we've got it. Build a single source of business and marketing insight.
                        </p>

                        <a href="/about-connections" class="orange-button dashboards-btn-collect font-20-lh-23-semi-bold"> {{__('Connect Now')}} </a>
                    </div>

                    <div class="about-afdal-dashboards-content-services">
                        <img loading="lazy" class="about-afdal-dashboards-content-services-base" src="{{url('/assets/image_new/svg/colored/about-afdal-service-base.svg')}}" alt="base">
                        <div class="about-afdal-dashboards-content-services-block about-afdal-dashboards-content-services-block-diagram">
                            <img loading="lazy" class="about-afdal-diagram" src="{{url('/assets/image_new/svg/colored/about-afdal-service-diagram.svg')}}" alt="diagram">
                        </div>
                        <div class="about-afdal-dashboards-content-services-block about-afdal-dashboards-content-services-block-instagram">
                            <img loading="lazy" class="about-afdal-dashboards-content-services-icons about-afdal-instagram" src="{{url('/assets/image_new/svg/colored/about-afdal-service-instagram.svg')}}" alt="instagram">
                        </div>
                        <div class="about-afdal-dashboards-content-services-block about-afdal-dashboards-content-services-block-woo">
                            <img loading="lazy" class="about-afdal-dashboards-content-services-icons about-afdal-woo"
                                src="{{url('/assets/image_new/svg/colored/about-afdal-service-woo.svg')}}" alt="woo">
                        </div>
                        <div class="about-afdal-dashboards-content-services-block about-afdal-dashboards-content-services-block-google-play">
                            <img loading="lazy" class="about-afdal-dashboards-content-services-icons about-afdal-google-play" src="{{url('/assets/image_new/svg/colored/about-afdal-service-google-play.svg')}}"
                                alt="google-play">
                        </div>
                        <div class="about-afdal-dashboards-content-services-block about-afdal-dashboards-content-services-block-twitter">
                            <img loading="lazy" class="about-afdal-dashboards-content-services-icons about-afdal-twitter" src="{{url('/assets/image_new/svg/colored/about-afdal-service-twitter.svg')}}" alt="twitter">
                        </div>
                    </div>
                </div>
            </div>
        </section>






        <section class="dashboards-section dashboards-section-midle">
            <div class="dashboards-content-wrapper">
                <div class="dashboards-content midle-wrap">

                    <div class="about-afdal-dashboards-content-analytics">
                        <div class="about-afdal-dashboards-content-analytics-block about-afdal-dashboards-content-analytics-block-base">
                            <img loading="lazy" class="about-afdal-analytics-base"
                                src="{{url('/assets/image_new/svg/colored/about-afdal-analytics-base.svg')}}"
                                alt="afdal-analytics-base">
                        </div>
                        <div class="about-afdal-dashboards-content-analytics-block about-afdal-dashboards-content-analytics-block-top">
                            <img loading="lazy" class="about-afdal-analytics-top"
                                src="{{url('/assets/image_new/svg/colored/about-afdal-analytics-top.svg')}}" alt="afdal-analytics-top">
                        </div>
                        <div class="about-afdal-dashboards-content-analytics-block about-afdal-dashboards-content-analytics-block-mid">
                            <img loading="lazy" class="about-afdal-analytics-mid" src="{{url('/assets/image_new/svg/colored/about-afdal-analytics-mid.svg')}}"
                                alt="afdal-analytics-mid">
                        </div>
                        <div class="about-afdal-dashboards-content-analytics-block about-afdal-dashboards-content-analytics-block-bot">
                            <img loading="lazy" class="about-afdal-analytics-bot" src="{{url('/assets/image_new/svg/colored/about-afdal-analytics-bot.svg')}}"
                                alt="afdal-analytics-bot">
                        </div>
                    </div>

                    <div class="dashboards-text about-dashboard text-left">
                        <h2 class="dashboards-title about-afdal-third-block-title font-60-lh-70-semi-bold">
                            <span class="dashboard-title-orange">{{__('Choose Your')}}</span>
                            <br>
                            <span class="">{{__('Dashboard')}}</span>
                        </h2>
                        <p class="dashboards-info dashboard-insights font-22-lh-25-light text-left-en">
                            {{__('Get a complete overview of your marketing and sales performance in a single place and quickly find the answers you are looking for. Translate your data into impactful stories through intelligent dashboards anyone can easily understand')}}
                        </p>

                        <a href="/about-dashboards" class="orange-button  dashboards-btn-our-dashboard font-20-lh-23-semi-bold float-left-en"><u>
                            {{__('See Our Dashboards')}}</u>
                        </a>
                    </div>
                </div>
            </div>
        </section>




        <section class="dashboards-section">
            <div class="dashboards-content-wrapper">
                <div class="dashboards-content">
                    <div class="dashboards-text about-dashboard">
                        <h2 class="dashboards-title font-60-lh-70-semi-bold">
                            <span class="">{{__('Data Analytics')}}</span>
                            <br>
                            <span class="dashboard-title-orange"> {{__('Consulting')}}</span>
                        </h2>
                        <p class="dashboards-info dashboard-gather font-22-lh-25-light">
                            {{__('Improve your ROI with data analytics consulting that will help you identify actionable insights you can immediately use to optimize performance and improve results. Our data experts will help you identify the best-performing marketing channels and give you recommendations on how to optimize your channel strategy to maximize ROI.')}}
                        </p>

                        <a href="/about-connections" class="orange-button dashboards-btn-collect font-20-lh-23-semi-bold">
                            {{__('Connect Now')}}
                        </a>
                    </div>

                    <div class="about-afdal-dashboards-content-services">
                        <img loading="lazy" class="about-afdal-dashboards-content-services-base" src="{{url('/assets/image_new/svg/colored/dataanalysisimg.png')}}" alt="base">
                    </div>
                </div>
            </div>
        </section>



        <section class="dashboards-section mb-ch">
            <div class="dashboards-content-wrapper">
                <div class="dashboards-content">


                    <div class="about-afdal-dashboards-content-laptop">
                        <div class="about-afdal-dashboards-content-resources-block-base">
                            <img loading="lazy" class="about-afdal-analytics-base" src="{{url('/assets/image_new/svg/colored/about-afdal-MacBook.svg')}}" alt="afdal-resources-base" >
                        </div>
                        <div>
                        <div class="about-afdal-dashboards-content-resources-block-top">
                            <img loading="lazy" class="about-afdal-resources-top"
                                 src="{{url('/assets/image_new/svg/colored/about-afdal-instagram.svg')}}"
                                 alt="afdal-resources-top"
                            >
                        </div>
                        <div class="about-afdal-dashboards-content-resources-block-mid">
                            <img loading="lazy" class="about-afdal-resources-mid" src="{{url('/assets/image_new/svg/colored/about-afdal-linkedin.svg')}}" alt="afdal-resources-mid">
                        </div>
                        <div class="about-afdal-dashboards-content-resources-block-second-mid">
                            <img loading="lazy" class="about-afdal-resources-second-mid"
                                 src="{{url('/assets/image_new/svg/colored/about-afdal-facebook.svg')}}"
                                 alt="afdal-resources-mid"
                            >
                        </div>
                        <div class="about-afdal-dashboards-content-resources-block-bot">
                            <img loading="lazy" class="about-afdal-resources-bot"
                                 src="{{url('/assets/image_new/svg/colored/about-afdal-twitter.svg')}}"
                                 alt="afdal-resources-bot"
                            >
                        </div>
                        </div>
                    </div>

                    <div class="dashboards-text dashboards-resources">
                        <h2 class="dashboards-title font-60-lh-70-semi-bold">
                            <span class="dashboard-title-orange">{{__('Resources That')}}</span>
                            <br>
                            <span class="">{{__('Get Things Done')}}</span>
                        </h2>
                        <p class="dashboards-info dashboards-analyticts font-22-lh-25-light">
                            {{__('How-to guides, a glossary, a blog and much more for your data analytics needs')}}
                        </p>

                        <a href="/signup" class="orange-button dashboards-btn-all-guides font-20-lh-23-semi-bold">
                            {{__('View All Guides')}}
                        </a>
                    </div>


                </div>
            </div>
        </section>

        <div class="product-page-video-block">
            <div class="product-page-video-title">
                <h2 class="product-page-video-title black  font-64-lh-75-semi-bold order-2-en">{{__("Get Insight.")}}</h2>
                <h2 class="product-page-video-title orange font-64-lh-75-semi-bold">{{__("Drive Growth.")}}</h2>
            </div>
            <p class="product-page-video-subtitle font-22-lh-25-light text-center">
                Collect, prepare and analyze all your marketing data with ease
            </p>

            <div class="product-page-video-wrapper">
                <!-- <iframe class="product-page-video" src="https://www.youtube.com/embed/PX8yRF9Hu8E?rel=0"></iframe> -->
                <lite-youtube class="product-page-video" videoid="PX8yRF9Hu8E" style="background-image: url('https://i.ytimg.com/vi_webp/PX8yRF9Hu8E/maxresdefault.webp');max-width: inherit !important;">
                    <button type="button" class="lty-playbtn">
                        <span class="lyt-visually-hidden">Play</span>
                    </button>
                </lite-youtube>
            </div>
        </div>

{{--        --}}{{----}}
{{--        <div class="product-page-grow-block first">--}}
{{--            <div class="product-page-grow-block second">--}}
{{--                <div class="product-page-grow-block third">--}}
{{--        --}}
                    <div class="about-afdal-grow-wrap">
                        <div class='about-afdal-top-oval'></div>
                        <h2 class="product-page-grow-title font-48-lh-56-semi-bold">
                            {{__("Grow with Afdal")}}
                        </h2>
                        <p class="product-page-grow-subtitle product-page-ch font-22-lh-25-light">
                            {{__("Afdal Analytics is all about helping marketing and analytics teams build better businesses with data. ")}}
                        </p>
                        <a href="/signup" class="product-page-grow-try-button product-page-grow-try-btn orange-button font-20-lh-23-semi-bold">
                            {{__("Try For Free ")}}
                        </a>
                        <div class='about-afdal-down-oval'></div>
                    </div>
        {{--
                </div>
            </div>
        </div>
        --}}

    </div>
    @if($get_locale == 'ar')
    @include('frontend.components.latest-news-eng')
    @endif
    <div class="product-page-wrapper-position-relative about-afdal-wrap-reletive">
        <div class="footer-animation animated-circle-wrapper about-afdal-circle-wrap">
            <div class="footer-circle"></div>
            <div class="footer-circle-orange-small">
            </div>
            <div class="footer-circle-orange-medium">
            </div>
            <div class="footer-circle-orange-large">
            </div>
        </div>
        @include('frontend.components.subscription-eng')
    </div>
@include('frontend.components.loader')
@include('frontend.components.topup')
</main>
</div>

@include('frontend.components.footer')
@include('frontend.components.cookie')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lite-youtube-embed/0.2.0/lite-yt-embed.min.js"></script>
