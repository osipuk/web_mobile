@include('layout.userhead')

@include('frontend.components.header-menu')
<div>
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

    <main class="guides">
        <div class="guides-circle"></div>
        <div class="guides-header">
            <h1 class="guides-title font-64-lh-135-semi-bold">
                {{__("Guides that help you grow")}}
            </h1>
            <p class="guides-text font-18-lh-38-semi-bold">
                {{__("Need a manual how to grow your business?Download our free marketing and growth resources.")}}
            </p>
            <a onClick="scroll()" class="guides-explore-btn guides-btn orange-button font-20-lh-42-semi-bold">
                {{__("Explore it")}}
            </a>
        </div>
        <div id="guide-list"></div>
        @if(!empty($guides))
        <ul class="guides-list-gide" id="guides-list">
            @foreach($guides as $guide)
            <li class="guides-page-guides-list-item first" style="background: {{$guide->background ? : '#B0BBCB'}}; color: {{$guide->font_color ? : '#000'}};">
                <a style="color: {{$guide->font_color ? : '#000'}};" href="{{url('/guides/' . $guide->seo_url)}}" class="mission-page-guides-list-item-title font-29-lh-40-bold">
                    {{$guide->title}}
                </a>
                <a href="{{url('/guides/' . $guide->seo_url)}}">
                    <img src="{{url(!empty($guide->image) ? '/storage/' . $guide->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}" alt="placeholder"
                         class="mission-page-guides-list-item-image">
                </a>
                <div class="guides-list-item-text font-18-lh-25-light">
                    {!! $guide->text !!}
                </div>
                <a style="color: {{$guide->font_color ? : '#000'}};" href="{{url('/guides/' . $guide->seo_url)}}"
                   class="font-28-lh-42-semi-bold mission-page-guides-list-item-go-to-guide-link guide-link">
                    @if($get_locale=='en')
                    {{__("Get the guide")}}
                    @if($guide->font_color)
                    <p class="white-play-arrow"></p>
                    @else
                    <div></div>
                    @endif
                    @else

                    @if($guide->font_color)
                    <p class="white-play-arrow"></p>
                    @else
                    <div></div>
                    @endif
                    {{__("Get the guide")}}
                    @endif
                </a>
            </li>

            @endforeach
        </ul>
        @endif
        <div class="product-page-wrapper-position-relative">
            @include('frontend.components.footer-circle')
            @include('frontend.components.subscription')
        </div>

        @include('frontend.components.loader')
        <div class="guides-circle-bottom"></div>
        @include('frontend.components.topup')
    </main>
    <script>
        let a = document.querySelector('.guides-explore-btn').addEventListener('click', scroll)
    function scroll(){
        console.log('qw')
        let q = document.querySelector('#guides-list');
        q.scrollIntoView({block: "center", behavior: "smooth"});
    }
    </script>


    @include('frontend.components.footer')
    @include('frontend.components.cookie')