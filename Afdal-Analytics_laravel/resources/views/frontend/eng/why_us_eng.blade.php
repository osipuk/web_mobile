<head>
{{--    <title>{{__("Product ")}}</title>--}}
{{--    <meta name="description"--}}
{{--          content="لماذا عليك اختيار منصة أفضل للبدء فى أدارة حملاتك التسويقية">--}}
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
</head>
@include('layout.userhead')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lite-youtube-embed/0.2.0/lite-yt-embed.min.css" />
<style type="text/css">
    

.order-2-en{
    order: 2;
}

.mission-page-why-afdal-list-item-icon {
    width: 52px;
    height: 52px;
    position: unset!important;
    top: 11px;
    right: unset!important;
    background-image: url(../image_new/svg/colored/mission-feature-bussines-data.svg);
}
</style>

@include('frontend.components.header-menu')
<main class="mission-page">
  <div class="eng">
    
    <div class="mission-page-header">
      <div style='width: 1920px; display:flex; margin: 0 auto;justify-content: center;'>
      <div class='mission-page-title-wrapper'>
    <h2 class="mission-page-title mission-page-mob-title font-64-lh-75-semi-bold text-left-en">
        {{__("Our Mission")}}
    </h2>
    <p class="mission-page-subtitle mission-page-mob-text font-22-lh-26-regular text-left-en">
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

                        <h2 class="product-page-grow-title mission-t-w font-64-lh-75-semi-bold text-left-en">
                            {{__("Our Vision")}}
                        </h2>
                        <p class="product-page-grow-subtitle mission-t-w font-20-lh-23-regular text-left-en">
                            {{__("Create a world where Arabs can use the technology they need in their native language")}}
                        </p>
                        {{-- <a href="" class="product-page-grow-try-button orange-button font-20-lh-23-semi-bold">{{__("Learn More ")}}</a> --}}
                      </div>
                      <div class='mission-page-vision-img'></div>
                {{-- </div>
            </div>
        </div> --}}
    </div>
    <div class='why-avdal-oval'></div>
    <div class="why-avdal-titles">
                <h2 class="product-page-video-title black font-64-lh-89-semi-bold">{{__("Get Insight.  ")}}</h2>
                <h2 class="product-page-video-title orange font-64-lh-89-semi-bold">{{__("Drive Growth.  ")}}</h2>
            </div>
                <div style='padding: 0 20px'>
                    <div class="discover-video-wrapper why-afdal-video">
                        <!-- <iframe class="discover-video" src="https://www.youtube.com/embed/iyk7qEdMjYI?rel=0"></iframe> -->
                            <lite-youtube class="discover-video" videoid="iyk7qEdMjYI" style="background-image: url('https://i.ytimg.com/vi_webp/iyk7qEdMjYI/maxresdefault.webp');max-width: inherit !important;">
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
            <li class="mission-page-why-afdal-list-item">
                <div class="mission-page-why-afdal-list-item-icon order-2-en in-way-you-need"></div>
                <div class="mission-page-why-afdal-list-item-content">
                    <p class="mission-page-why-afdal-list-item-content-title mission-w font-25-lh-29-semi-bold">
                        {{__("In the way you need")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-flexible font-20-lh-23-medium">
                        We know you need to be flexible, so we are too. Create reports and dashboards in a few steps that take seconds!

                    </p>
                </div>
            </li>
            <li class="mission-page-why-afdal-list-item">
                <div class="mission-page-why-afdal-list-item-icon order-2-en bussiness-data"></div>
                <div class="mission-page-why-afdal-list-item-content">
                    <p class="mission-page-why-afdal-list-item-content-title font-25-lh-29-semi-bold">
                        {{__("Pre-made templates")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-get font-20-lh-23-medium">
                        use our ready-made dashboard templates, and you won't have to do any work from scratch. Build dashbaords that your clients and manager will actually read.

                    </p>
                </div>
            </li>

            <li class="mission-page-why-afdal-list-item">
                <div class="mission-page-why-afdal-list-item-icon order-2-en data-collection"></div>
                <div class="mission-page-why-afdal-list-item-content">
                    <p class="mission-page-why-afdal-list-item-content-title mission-page-auto-title  font-25-lh-29-semi-bold">
                        {{__("Monitor multiple channels")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-platforms font-20-lh-23-medium">
                        Analyze and monitor the performance of multiple channels and campaigns at once. Add all your data sources and view them in one dashboard.
                    </p>
                </div>
            </li>

            <li class="mission-page-why-afdal-list-item">
                <div class="mission-page-why-afdal-list-item-icon order-2-en support"></div>
                <div class="mission-page-why-afdal-list-item-content">
                    <p class="mission-page-why-afdal-list-item-content-title font-25-lh-29-semi-bold">
                        {{__("24/7 Support")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-help font-20-lh-23-medium">
                        We are ready to help in solving your problem during the day and night, just create a ticket.
                    </p>
                </div>
            </li>
            <li class="mission-page-why-afdal-list-item">
                <div class="mission-page-why-afdal-list-item-icon order-2-en knowledge-base"></div>
                <div class="mission-page-why-afdal-list-item-content">
                    <p class="mission-page-why-afdal-list-item-content-title font-25-lh-29-semi-bold">
                        {{__("Knowledge base")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-answers font-20-lh-23-medium">
                        Get answers to your questions and inquiries, and learn more about specific topics using our many resources.

                    </p>
                </div>
            </li>
            <li class="mission-page-why-afdal-list-item">
                <div class="mission-page-why-afdal-list-item-icon order-2-en historical-data"></div>
                <div class="mission-page-why-afdal-list-item-content">
                    <p class="mission-page-why-afdal-list-item-content-title font-25-lh-29-semi-bold">
                        {{__("Historical data")}}
                    </p>
                    <p class="mission-page-why-afdal-list-item-content-text mission-collects font-20-lh-23-medium">
                        Afdal Analytics collects data from 2 years back and keeps it safe for you. The longer you use Afdal Analytics, the more data you have.
                    </p>
                </div>
            </li>
            
            

        </ul>
    </div>




    {{-- <div class="mission-page-guides-block">
        <div class="mission-page-guides-info-block">
            <h2 class="mission-page-guides-info-title font-48-lh-100-semi-bold">
                {{__("Guides  ")}}
            </h2>
            <p class="mission-page-guides-info-text mission-artur-w font-18-lh-25-light">
                {{__("In Arthur Conan Doyle's 1887 book 'A Study in Scarlet,' iconic detective Sherlock Holmes makes a comment that still applies today: \"It is a capital mistake to theorize before one has data.\"")}}
            </p>

        </div>
        @if(!empty($guides))
            <ul class="mission-page-guides-list">
                @foreach($guides as $guide)
                    <li class="mission-page-guides-list-item first">
                        <div class="mission-page-guides-list-item-title font-29-lh-40-bold">
                            {{$guide->title}}
                        </div>
                        <img src="{{url(!empty($guide->image) ? '/storage/' . $guide->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}"
                             alt="placeholder"
                             class="mission-page-guides-list-item-image">
                        <a href="{{url('/guides/' . $guide->seo_url)}}" class="mission-page-guides-list-item-go-to-guide-link font-26-lh-55-semi-bold">
                            < {{__("Get the guide")}}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{url('/guides')}}" class="mission-page-guides-view-button font-20-lh-42-semi-bold">
                {{__("View All")}}
            </a>
    </div> --}}

    <div class="product-page-wrapper-position-relative why-afdal-footer-circle-wrap">
        @include('frontend.components.footer-circle')
        @include('frontend.components.get-started')
    </div>

    @include('frontend.components.loader')

@include('frontend.components.topup')
</div>
</main>


@include('frontend.components.footer')
@include('frontend.components.cookie')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lite-youtube-embed/0.2.0/lite-yt-embed.min.js"></script>