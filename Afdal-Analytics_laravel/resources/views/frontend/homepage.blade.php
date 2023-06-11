@section('metahead')

<link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="facebook-domain-verification" content="walnb0xottzsgeojmjijl8cc14wsha" />
<meta name="title" content="تحليل بيانات الحملات التسويقية | وسائل التواصل | منصة أفضل">
<meta name="description" content="منصة أفضل التحليلات هي وسيلتك للتعرف على كل ماتبحث عنه لقياس مؤشرات أداء وبيانات مشروعك على شبكة الإنترنت وشبكات التواصل الاجتماعي بطريقة سهلة وواضحة">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://afdalanalytics.com/">
<meta property="og:title" content="تحليل بيانات الحملات التسويقية | وسائل التواصل | منصة أفضل">
<meta property="og:description" content="منصة أفضل التحليلات هي وسيلتك للتعرف على كل ماتبحث عنه لقياس مؤشرات أداء وبيانات مشروعك على شبكة الإنترنت وشبكات التواصل الاجتماعي بطريقة سهلة وواضحة">
<meta property="og:image" content="{{url('/assets/image/link.png')}}" />
<meta property="og:image:secure_url" content="{{url('/assets/image/link.png')}}" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- -->
<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="https://afdalanalytics.com/">
<meta name="twitter:title" content="تحليل بيانات الحملات التسويقية | وسائل التواصل | منصة أفضل">
<meta name="twitter:description" content="منصة أفضل التحليلات هي وسيلتك للتعرف على كل ماتبحث عنه لقياس مؤشرات أداء وبيانات مشروعك على شبكة الإنترنت وشبكات التواصل الاجتماعي بطريقة سهلة وواضحة">
<meta name="twitter:image" content="{{url('/assets/image/link.png')}}">
<!-- -->
@endsection
@include('layout.userhead')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lite-youtube-embed/0.2.0/lite-yt-embed.min.css" />
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

@include('frontend.components.header-menu')

<main class="homepage-main">
    @include('frontend.components.header-circle')
    <section class="discover-section discover-section-add">
        <div class='homepage-title-wrap'>
            <h1 class="discover-title homepage-title-w font-64-lh-89-semi-bold" style="line-height: 70px;">
                {{__('Unleash The Real Power of Marketing Data')}}
            </h1>
            <p class="discover-subtitle homepage-text-w font-18-lh-25-medium">
                {{__('Use Afdal Analytics to track campaigns across different ')}} <br>
                {{__('channels. Gain more insight about your customer. Visualize')}} <br>
                {{__('data from versatile reporting and dashboards.')}}
            </p>
            <a class="orange-button homepage-hero-btn font-20-lh-42-semi-bold" href="/signup">
                {{__('Try free for 14 days')}}
            </a>
        </div>
        <div class="discover-video-wrapper homepage-video-hero">
            <!-- <iframe class="discover-video" src="https://www.youtube.com/embed/wRDWhkD24KM?rel=0"></iframe> -->
            <!-- <lite-youtube class="discover-video" videoid="wRDWhkD24KM" params="controls=1&modestbranding=2&rel=0&enablejsapi=1" style="background-image: url('https://i.ytimg.com/vi_webp/wRDWhkD24KM/maxresdefault.webp');"></lite-youtube> -->
            @if($get_locale == 'ar')
            <lite-youtube class="discover-video" videoid="wRDWhkD24KM" style="background-image: url('https://i.ytimg.com/vi_webp/wRDWhkD24KM/maxresdefault.webp');">
                <button type="button" class="lty-playbtn">
                    <span class="lyt-visually-hidden">Play</span>
                </button>
            </lite-youtube>
            @else
            <lite-youtube class="discover-video" videoid="mjKYwITarPM" style="background-image: url('https://i.ytimg.com/vi_webp/mjKYwITarPM/maxresdefault.webp');">
                <button type="button" class="lty-playbtn">
                    <span class="lyt-visually-hidden">Play</span>
                </button>
            </lite-youtube>
            @endif
        </div>

    </section>

    <section class="dashboards-section homepage-dashboard-sec">
        <div class="dashboards-content-wrapper">
            <div class="dashboards-content">
                <div class="dashboards-text order-2-en">
                    <h2 class="dashboards-title homepage-dashboard-sec-title font-60-lh-84-semi-bold text-left-en">
                        <span class="dashboard-title-orange">
                            {{__('Intelligent')}}
                        </span>
                        <br>
                        <span>
                            {{__(' Dashboards')}}
                        </span>
                    </h2>
                    <p class="dashboards-info dashboards-simple-text font-18-lh-25-light text-left-en">
                        {{__('Discover what is happening on your business. Track key performance indicators. Identify trends with the analytics dashboards. Multilingual dashboards supporting both English and Arabic.')}}
                    </p>

                    <a href="/about-dashboards" class="orange-button font-20-lh-42-semi-bold">
                        {{__('See Our Dashboards')}}
                    </a>
                </div>
                <div>
                    <div class="anim-layer1">
                        <img class="anim-layer-img1"  src="{{url('../../assets/image_new/home-animation-1.webp')}}" alt="image-animation-1">
                    </div>
                    <div class="anim-layer2">
                        <img class="anim-layer-img2"  src="{{url('../../assets/image_new/home-animation-2.webp')}}" alt="image-animation-2">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="connect-section homepage-second-sec">
        <div class="connect-content-wrapper">
            <div class="connect-content">
                <ul class="connect-list order-2-en">
                    <li style='padding: 18px 10px 19px;' class="connect-list-item">
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

                <div class="connect-text-block homepage-section-sec-text-wrap">
                    <h2 class="connect-title font-60-lh-84-semi-bold text-left-en">
                        <span class="connect-title-orange">
                            {{__('Bring your channels')}}
                        </span>
                        <br>
                        <span>
                            {{__('in one place')}}
                        </span>
                    </h2>
                    <p class="connect-info font-18-lh-25-light text-left-en">
                        {{__("Afdal Analytics makes the process of connecting your data sources easy for anyone to do. Once imported, you can visualize your data into ready dashboards without any technical help.")}}
                    </p>
                </div>
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
                <span class="">{{__('Get Insight. ')}}</span>
                <br>
                <span class="benefits-title-orange">{{__('Drive Growth. ')}}</span>
            </h2>

            <div class="benefits-video-wrapper">
                <!-- <iframe class="benefits-video" src="https://www.youtube.com/embed/PX8yRF9Hu8E?rel=0"></iframe> -->
                <lite-youtube class="benefits-video" videoid="PX8yRF9Hu8E" style="background-image: url('https://i.ytimg.com/vi_webp/PX8yRF9Hu8E/maxresdefault.webp');max-width:100%">
                    <button type="button" class="lty-playbtn">
                        <span class="lyt-visually-hidden">Play</span>
                    </button>
                </lite-youtube>
            </div>

            <ul class="benefits-list" style="max-width: 1200px">
                <li class="benefits-list-item benefits-list-item-device order-3-en" style="margin-top:75px; ">
                    <div class="benefits-list-item-logo benefits-list-item-logo-device"></div>


                    <div class="benefits-list-item-text">
                        <p class="benefits-list-item-title font-24-lh-33-semi-bold">
                            {{__('Save time and resources')}}
                        </p>
                        <p class="benefits-list-item-info font-18-lh-25-light  ml-64-en">
                            {{__('Eliminate manual reporting by automating data integration from all channels')}}
                        </p>
                    </div>
                </li>

                <li class="benefits-list-item benefits-list-item-bucket  order-2-en" style="margin-top:75px; ">
                    <div class="benefits-list-item-logo benefits-list-item-logo-bucket"></div>


                    <div class="benefits-list-item-text">
                        <p class="benefits-list-item-title  font-24-lh-33-semi-bold">
                            {{__('Improve marketing performance')}}
                        </p>
                        <p class="benefits-list-item-info font-18-lh-25-light  ml-64-en">
                            {{__('Optimize future campaign results with predictive insights')}}
                        </p>
                    </div>
                </li>

                <li class="benefits-list-item benefits-list-item-document order-1-en" style="margin-top:75px; ">
                    <div class="benefits-list-item-logo benefits-list-item-logo-document"></div>


                    <div class="benefits-list-item-text benefits-list-item-text-wrap">
                        <p class="benefits-list-item-title benefits-width-title font-24-lh-33-semi-bold">
                            {{__('Demonstrate clear value')}}
                        </p>

                        <p class="benefits-list-item-info benefits-mr-info font-18-lh-25-light mt-35-en ml-64-en">
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


    @if($get_locale == 'ar')

        @include('frontend.components.latest-news')
    @endif

    <div class="wrapper-position-relative homepage-wrapper-relative">
        <div class="footer-animation animated-circle-wrapper homepage-circle-animated">
            <div class="footer-circle"></div>
            <div class="footer-circle-orange-small"></div>
            <div class="footer-circle-orange-medium"></div>
            <div class="footer-circle-orange-large"></div>
        </div>
        @include('frontend.components.subscription')
    </div>

    @include('frontend.components.loader')
    @include('frontend.components.topup')
</main>

@include('frontend.components.footer')
@include('frontend.components.cookie')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lite-youtube-embed/0.2.0/lite-yt-embed.min.js"></script>