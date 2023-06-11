@section('metahead')
<link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}" />
@endsection
@include('layout.userhead')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lite-youtube-embed/0.2.0/lite-yt-embed.min.css" />
@include('frontend.components.header-menu')
<main class="mission-page">

    <div class="mission-page-header">
        <div style='width: 1920px; display:flex; margin: 0 auto;justify-content: center;'>
            <div class='mission-page-title-wrapper'>
                <h1 class="mission-page-title mission-page-mob-title font-64-lh-135-semi-bold">
                    {{__("Our Mission")}}
                </h1>
                <p class="mission-page-subtitle mission-page-mob-text font-18-lh-38-medium">
                    {{__("Empower Arab marketers with data and insight about their marketing efforts.")}}
                </p>
                {{-- <a class="mission-page-button orange-button font-20-lh-42-semi-bold" href="/signup">{{__('Try For Free ')}}</a> --}}
            </div>
            <div class='mission-page-hero-img'></div>
        </div>
    </div>

    <div class="mission-page-overflow-wrapper">
        {{-- <div class="product-page-grow-block first">
            <div class="product-page-grow-block second">
                <div class="product-page-grow-block third"> --}}
                    <div class="product-page-grow-block block-fourth fourth">

                        <h2 class="product-page-grow-title mission-t-w font-64-lh-135-semi-bold">
                            {{__("Our Vision")}}
                        </h2>
                        <p class="product-page-grow-subtitle mission-t-w font-18-lh-25-light">
                            {{__("Create a world where Arabs do not need to learn English to do Technology")}}
                        </p>
                        {{-- <a href="" class="product-page-grow-try-button orange-button font-20-lh-23-semi-bold">{{__("Learn More ")}}</a> --}}
                    </div>
                    <div class='mission-page-vision-img'></div>
                    {{--
                </div>
            </div>
        </div> --}}
    </div>
    <div class='why-avdal-oval'></div>
    <div class="why-avdal-titles">
        <h2 class="product-page-video-title why-us-video-title black font-64-lh-89-semi-bold">{{__("Get Insight. ")}}</h2>
        <h2 class="product-page-video-title why-us-video-title orange font-64-lh-89-semi-bold">{{__("Drive Growth. ")}}</h2>
    </div>
    <div style='padding: 0 20px'>
        <div class="discover-video-wrapper">
            <!-- <iframe class="discover-video" src="https://www.youtube.com/embed/iyk7qEdMjYI?rel=0"></iframe> -->
            <lite-youtube class="discover-video" videoid="iyk7qEdMjYI"
                          style="background-image: url('https://i.ytimg.com/vi_webp/iyk7qEdMjYI/maxresdefault.webp');max-width: inherit !important;">
                <button type="button" class="lty-playbtn">
                    <span class="lyt-visually-hidden">Play</span>
                </button>
            </lite-youtube>
        </div>
    </div>
    <div class="mission-page-why-afdal-block">
        {{-- <h2 class="mission-page-why-afdal-title font-70-lh-100-semi-bold">
            {{__("Why Afdal Analytics?")}}
        </h2>
        <p class="mission-page-why-afdal-subtitle font-24-lh-40-light">
            {{__("Afdal Analytics makes it effortless to work with marketing data.")}}
        </p> --}}
        <ul class="mission-page-why-afdal-list">
            <li class="mission-page-why-afdal-list-item order-1-en">
                <div class="mission-page-why-afdal-list-item-icon data-collection"></div>
                <div class="mission-page-why-afdal-list-item-content">
                    <p class="mission-page-why-afdal-list-item-content-title font-28-lh-59-semi-bold">
                        {{__("Automated data collection")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text font-18-lh-38-light">
                        {{__("With integrations to over many marketing platforms, getting your data into Afdal Analytics is a breeze.")}}
                    </p>
                </div>
            </li>
            <li class="mission-page-why-afdal-list-item order-2-en">
                <div class="mission-page-why-afdal-list-item-icon bussiness-data"></div>
                <div class="mission-page-why-afdal-list-item-content mission-page-why-afdal-list-item-content-bussiness-data">
                    <p class="mission-page-why-afdal-list-item-content-title font-28-lh-59-semi-bold">
                        {{__("Business-Ready Data")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-get font-18-lh-38-light">
                        {{__("Get your own, no-code rules to segment your data based on your specific needs. Get custom groupings and metrics.")}}
                    </p>
                </div>
            </li>
            <li class="mission-page-why-afdal-list-item order-3-en">
                <div class="mission-page-why-afdal-list-item-icon in-way-you-need"></div>
                <div class="mission-page-why-afdal-list-item-content mission-page-why-afdal-list-item-content-in-way-you-need">
                    <p class="mission-page-why-afdal-list-item-content-title mission-w font-28-lh-59-semi-bold">
                        {{__("In the way you need")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-flexible font-18-lh-38-light">
                        {{__("We know you need to be flexible, so we are too! Create reports and dashboards that are easy and take seconds.")}}
                    </p>
                </div>
            </li>
            <li class="mission-page-why-afdal-list-item order-4-en">
                <div class="mission-page-why-afdal-list-item-icon historical-data"></div>
                <div class="mission-page-why-afdal-list-item-content mission-page-why-afdal-list-item-content-historical-data">
                    <p class="mission-page-why-afdal-list-item-content-title font-28-lh-59-semi-bold">
                        {{__("Historical data")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-collects font-18-lh-38-light">
                        {{__("Afdal Analytics collects data from 2 years back and keeps it safe for you. The longer you use Afdal Analytics, the more data you have.")}}
                    </p>
                </div>
            </li>
            <li class="mission-page-why-afdal-list-item order-5-en">
                <div class="mission-page-why-afdal-list-item-icon knowledge-base"></div>
                <div class="mission-page-why-afdal-list-item-content mission-page-why-afdal-list-item-content-knowledge-base">
                    <p class="mission-page-why-afdal-list-item-content-title font-28-lh-59-semi-bold">
                        {{__("Knowledge base")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-answers font-18-lh-38-light">
                        {{__("Get Answers to the question you have learn or find documentations on a specific subject")}}
                    </p>
                </div>
            </li>
            <li class="mission-page-why-afdal-list-item order-6-en">
                <div class="mission-page-why-afdal-list-item-icon support"></div>
                <div class="mission-page-why-afdal-list-item-content">
                    <p class="mission-page-why-afdal-list-item-content-title font-28-lh-59-semi-bold">
                        {{__("24/7 Support")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-help font-18-lh-38-light">
                        {{__("We are ready to help in solving your problem during the day and night, just create a ticket.")}}
                    </p>
                </div>
            </li>

        </ul>
    </div>




    {{-- <div class="mission-page-guides-block">
        <div class="mission-page-guides-info-block">
            <h2 class="mission-page-guides-info-title font-48-lh-100-semi-bold">
                {{__("Guides ")}}
            </h2>
            <p class="mission-page-guides-info-text mission-artur-w font-18-lh-25-light">
                {{__("In Arthur Conan Doyle's 1887 book 'A Study in Scarlet,' iconic detective Sherlock Holmes makes a comment that still applies today: \"It is a capital mistake
                to theorize before one has data.\"")}}
            </p>

        </div>
        @if(!empty($guides))
        <ul class="mission-page-guides-list">
            @foreach($guides as $guide)
            <li class="mission-page-guides-list-item first">
                <div class="mission-page-guides-list-item-title font-29-lh-40-bold">
                    {{$guide->title}}
                </div>
                <img src="{{url(!empty($guide->image) ? '/storage/' . $guide->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}" alt="placeholder"
                     class="mission-page-guides-list-item-image">
                <a href="{{url('/guides/' . $guide->seo_url)}}" class="mission-page-guides-list-item-go-to-guide-link font-26-lh-55-semi-bold">
                    < {{__("Get the guide")}} </a>
            </li>
            @endforeach
        </ul>
        @endif
        <a href="{{url('/guides')}}" class="mission-page-guides-view-button font-20-lh-42-semi-bold">
            {{__("View All")}}
        </a>
    </div> --}}

    <div class="product-page-wrapper-position-relative why-afdal-footer-circle-wrap">
        <div class="footer-animation animated-circle-wrapper why-us-mobscreen">
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

    @include('frontend.components.loader')

    @include('frontend.components.topup')
</main>


@include('frontend.components.footer')
@include('frontend.components.cookie')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lite-youtube-embed/0.2.0/lite-yt-embed.min.js"></script>