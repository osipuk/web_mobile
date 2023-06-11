@section('metahead')
<title>المدونة</title>
<link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}" />
<meta property="og:title" content="{{!empty($category) ? $category->meta_title : ''}}">
<meta property="og:keywords" content="{{!empty($category) ? $category->meta_keywords : ''}}">
<meta property="og:description" content="{{!empty($category) ? $category->meta_description : ''}}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{!empty($category) ? $category->meta_title : ''}}">

@endsection
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
<main class="analytics-blog">
    {{-- @include('frontend.components.header-circle') --}}
    @include('frontend.components.header-menu')

    <h1 class="analytics-blog-title font-64-lh-135-semi-bold">
        {{__("Afdal Analytics Blog")}}
    </h1>
    <form class="analytics-blog-search-form" action="{{ route('blog-search') }}" method="GET">
        @if(!empty($search))
        <input class="analytics-blog-search-input font-20-lh-42-regular" maxlength="40" id="search" name="search" type="text" placeholder="{{__(" Search")}}" value="{{$search}}"
               oninput="search(this)" />
        @else
        <input class="analytics-blog-search-input font-20-lh-42-regular" maxlength="40" id="search" name="search" type="text" placeholder="{{__(" Search")}}"
               oninput="search(this)" />
        @endif
        <button type="submit" class="@if($get_locale=='ar') analytics-blog-search-button @else analytics-blog-search-button-eng @endif font-20-lh-42-semi-bold">
            {{__("Search")}}
            @if($get_locale=='ar')
            <div class=" blog-page-search-icon"></div>
            @else
            <svg style="margin-left: 30px;" width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 18C0 27.665 7.83502 35.5 17.5 35.5C27.165 35.5 35 27.665 35 18C35 8.33502 27.165 0.5 17.5 0.5C7.83502 0.5 0 8.33502 0 18Z" fill="#F58B1E" />
                <path d="M13.2438 17.998H21.751" stroke="#E4EAF2" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M17.4977 13.7455L21.751 17.9987L17.4977 22.252" stroke="#E4EAF2" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            @endif

        </button>
    </form>
    <div class="analytics-blog-button-list">
        <a href="{{url('/blog')}}" class="analytics-blog-button font-20-lh-42-semi-bold {{Request::segment(2) === null ? 'blog-category-picked' : '' }}">
            {{__("All")}}
        </a>
        @foreach($categories as $category)
        <a href="{{url('/blog/'.$category->seo_url)}}"
           class="analytics-blog-button font-20-lh-42-semi-bold {{  Request::segment(2) == $category->seo_url ? 'blog-category-picked' : '' }}">
            {{__($category->name)}}
        </a>
        @endforeach
    </div>

    <section>
        <div class="container blog-latest-container">
            <ul class="latest-news-list">
                @forelse($blogs as $blog)
                <li class="latest-news-card">
                    <a href="{{url('/blog/'.$blog->category->seo_url.'/'. $blog->seo_url)}}" style="text-decoration: none">
                        <img onerror="this.onerror=null;this.src='{{url('assets/image_new/svg/colored/not-found-img.svg')}}';" class="latest-news-card-image"
                             src="{{url(!empty($blog->image) ? '/storage/' . $blog->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}" alt="Image placeholder">


                        <div class="latest-news-card-text">
                            <p class="latest-news-card-info font-13-lh-27-regular blog-latest-news-card-text">
                                @if(!empty($blog->date) && !empty($blog->category->name))
                                {{\Carbon\Carbon::parse($blog->date)->translatedFormat('j F Y') . " - " }}
                                {{$blog->category->name}}
                                @elseif(!empty($blog->date))
                                {{\Carbon\Carbon::parse($blog->date)->translatedFormat('j F Y')}}
                                @elseif(!empty($blog->category->name))
                                {{$blog->category->name}}
                                @endif
                                {{-- {{ !empty($blog->date) ? date('F j, Y', strtotime($blog->date)) . ' - ' : '' . __(strtoupper($blog->category->name))}}--}}
                            </p>

                            <h3 class="font-22-lh-30-medium blog-title" style="padding-bottom: 20px;">
                                {{$blog->title}}
                            </h3>

                            <div class="latest-news-card-subtitle font-15-lh-21-regular blog-subtitle">
                                {!! Str::limit($blog->description, 250) !!}
                            </div>
                        </div>
                    </a>
                </li>
                @empty
                <p class="text-center blog-notfound">
                    {{__("No results found for query")}} <strong>{{ request()->query('search') }}</strong>
                </p>
                @endforelse
            </ul>
        </div>
    </section>
    <section class="analytics-blog-pagination">
        {{ $blogs->links('frontend.blog-pagination') }}
    </section>
    <div class="mission-page-guides-block">
        <div class="guides-background-circle"></div>
        <div class="mission-page-guides-info-block">
            <h2 class="mission-page-guides-info-title font-48-lh-101-semi-bold">
                {{__("Guides ")}}
            </h2>
            <p class="mission-page-guides-info-text font-18-lh-25-light">
                {{__("In Arthur Conan Doyle's 1887 book 'A Study in Scarlet,' iconic detective Sherlock Holmes makes a comment that still applies today: \"It is a capital mistake
                to theorize before one has data.\"")}}
            </p>
        </div>
        @if(!empty($guides))
        <ul class="mission-page-guides-list">
            @foreach($guides as $guide)
            <li class="mission-page-guides-list-item first" style="background: {{$guide->background ? : '#B0BBCB'}}; color: {{$guide->font_color ? : '#000'}};">
                <a style="color: {{$guide->font_color ? : '#000'}};" href="{{url('/guides/' . $guide->seo_url)}}">
                    <div class="mission-page-guides-list-item-title font-22-lh-27-bold">
                        {{$guide->title}}
                    </div>
                    <img loading="lazy" onerror="this.onerror=null;this.src='{{url('assets/image_new/svg/colored/not-found-img.svg')}}';"
                         src="{{url(!empty($guide->image) ? '/storage/' . $guide->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}" alt="placeholder"
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
        <a href="{{url('/guides')}}" class="mission-page-guides-view-button font-18-lh-38-semi-bold">
            {{__("View All")}}
        </a>
    </div>

    <div class="product-page-wrapper-position-relative">
        @include('frontend.components.footer-circle')
        @include('frontend.components.subscription')
    </div>

    @include('frontend.components.loader')
    @include('frontend.components.topup')
</main>


@include('frontend.components.footer')
@include('frontend.components.cookie')