@section('metahead')
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
    <meta property="og:type"            content="article" />
    <meta property="og:title"           content="{{!empty($blog->meta_title) ? $blog->meta_title : ''}}">
    <meta property="og:url"             content="{{Request::url()}}" />
    <meta property="og:image"           content="{{url(!empty($blog->image) ? '/storage/' . $blog->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}" />
    <meta name="author"                 content=" {{!empty($blog->author_name) ? $blog->author_name : ''}}"/>
    <meta property="og:image:width"     content="1200" />
    <meta property="og:image:height"    content="630" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{!empty($blog->meta_title) ? $blog->meta_title : ''}}">
    <meta name="twitter:creator" content="{{!empty($blog->author_name) ? $blog->author_name : ''}}">
    <meta name="twitter:image" content="{{url(!empty($blog->image) ? '/storage/' . $blog->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}">
@endsection
@include('layout.userhead')

<main class="blog-page" style="position: relative;" onscroll="myFunction()">
    <div class="blog-circle"></div>
    @include('frontend.components.header-menu')

    <h1 class="blog-page-title font-80-lh-106-semi-bold blog-title">
        {{!empty($blog->title) ? $blog->title : ''}}
    </h1>
    <p class="blog-page-text font-19-lh-25-semi-bold">
        @if(!empty($blog->date) && !empty($blog->category->name))
                {{\Carbon\Carbon::parse($blog->date)->translatedFormat('j F Y') . " - " }}
                {{$blog->category->name}}
            @elseif(!empty($blog->date))
                {{\Carbon\Carbon::parse($blog->date)->translatedFormat('j F Y')}}
            @elseif(!empty($blog->category->name))
                {{$blog->category->name}}
        @endif
    </p>
    <p class="blog-page-author font-19-lh-25-semi-bold">
        {{!empty($blog->author_name) ? $blog->author_name : ''}}
    </p>
    <img class="blog-page-image"
         src="{{url(!empty($blog->image) ? '/storage/' . $blog->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}"
         alt="Placeholder image"
    >

    <div class="blog-page-big-content">
        <div class="blog-page-big-content-sections-title-wrapper">
            @foreach($blog_titles as $title)
                @if($title['type'] == 'h2')
                    <a
                        class="blog-page-big-content-sections-title font-22-lh-28-bold"
                        onclick="goToH2Paragraph(this, '{{$title['text']}}')"
                    >
                        {!! !empty($title['text']) ? $title['text'] : '' !!}
                    </a>
                @else
                    <a
                        class="blog-page-big-content-sections-subtitle font-18-lh-22-semi-bold"
                        onclick="goToH3Paragraph(this, '{{$title['text']}}')"
                    >
                        {!! !empty($title['text']) ? $title['text'] : '' !!}
                    </a>
                @endif
            @endforeach

            <div class="blog-page-info-block">
                <p class="blog-page-info-block-marketing-text font-22-lh-28-semi-bold" style="text-align: left;">
                    {{__("Empower your Marketing")}}
                </p>
                <a href="{{url('/signup')}}" class="blog-page-info-block-free-trial orange-button font-20-lh-24-semi-bold">
                    {{__("FREE TRIAL")}}
                </a>
                <p class="blog-page-info-block-share-post-text font-13-lh-17-semi-bold" style="text-align: left;">
                    {{__("SHARE THIS POST")}}
                </p>
                <div class="glossary-page-glossary-bar-share-page-icons-block">
                    <a href="mailto:?subject={{!empty($blog->title) ? $blog->title : ''}}&amp;body={{__('Hey! I thought you might be interested to read this')}}%0D%0A {{urlencode(Request::url())}}" class="glossary-page-glossary-bar-share-page-icon email"></a>
                    @foreach($socialShare as $key => $value)
                        @switch($key)

                            @case($key == "linkedin")
                            <a href="{{$value . "?linkedin=0"}}" class="glossary-page-glossary-bar-share-page-icon linkedin" target="_blanc"></a>
                            @break

                            @case($key == "twitter")
                            <a href="{{$value}}" class="glossary-page-glossary-bar-share-page-icon twitter" target="_blanc"></a>
                            @break

                            @case($key == "facebook")
                            <a href="{{$value}}" class="glossary-page-glossary-bar-share-page-icon facebook" target="_blanc"></a>
                            @break
                        @endswitch
                    @endforeach
                </div>
            </div>
        </div>
        <div class="blog-page-big-content-list">
            <div class="blog-page-big-content-list-item">
                {!! !empty($blog->description) ? $blog->description : '' !!}
            </div>
        </div>
    </div>
    <div class="blog-latest-news-title">
        <h1>{{__('Related articles')}}</h1>
    </div>
    <ul class="latest-news-list  blog-latest">
        @foreach($last_blogs as $last_blog)
            <li class="latest-news-card">
                <a href="{{url('/blog/'.$last_blog->category->seo_url.'/' . $last_blog->seo_url)}}" style="text-decoration: none">
                    <img class="latest-news-card-image"
                         src="{{url(!empty($last_blog->image) ? '/storage/' . $last_blog->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}"
                         alt="Image placeholder"
                    >

                    <div class="latest-news-card-text">
                        <p class="latest-news-card-info font-13-lh-17-semi-bold blog-latest-news-card-text">
                            @if(!empty($last_blog->date) && !empty($last_blog->category->name))
                                {{\Carbon\Carbon::parse($blog->date)->translatedFormat('j F Y') . " - " }}
                                {{$last_blog->category->name}}
                            @elseif(!empty($last_blog->date))
                                {{\Carbon\Carbon::parse($last_blog->date)->translatedFormat('j F Y')}}
                            @elseif(!empty($last_blog->category->name))
                                {{$last_blog->category->name}}
                            @endif
                            {{--                                    {{ !empty($blog->date) ? date('F j, Y', strtotime($blog->date)) . ' - ' : '' . __(strtoupper($blog->category->name))}}--}}
                        </p>

                        <h3 class="font-22-lh-28-bold" style="padding-bottom: 20px;">
                            {{$last_blog->title}}
                        </h3>

                        <p class="latest-news-card-subtitle font-15-lh-17-medium">
                            {!! Str::limit($last_blog->description, 250) !!}
                        </p>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>

@include('frontend.components.loader')


</main>

@include('frontend.components.footer')
@include('frontend.components.cookie')


<script>
  document.body.onload = function () {
  setTimeout(function () {
    const preloader = document.getElementById('main-loader');
    if (!preloader.classList.contains('done')) {
      preloader.classList.add('done');
    }
  }, 1000);
};
</script>
<script>
    let H2size = '{{$blog->h2_size}}'
    let H3size = '{{$blog->h3_size}}'
    let H4size = '{{$blog->h4_size}}'
    let textSize = '{{$blog->text_size}}'
    let isClicked = false;
    let timer = null;

    //console.log(H2size, H3size, H4size, '{{$blog->h2_size}}')

    function setFontSize(items, size){
        if(size === 0 || size ==='0' || size===null) return;
        //console.log(items, size)
        for(let i = 0; i < items.length; i++){
            items[i].style.fontSize = size + 'px';
        }
    }

    setFontSize(document.querySelectorAll('.blog-page-big-content-list-item h2'), H2size)
    setFontSize(document.querySelectorAll('.blog-page-big-content-list-item h3'), H3size)
    setFontSize(document.querySelectorAll('.blog-page-big-content-list-item h4'), H4size)
    setFontSize(document.querySelectorAll('.blog-page-big-content-list-item p'), textSize)

    function goToSection(event) {
        isClicked  = true;
        timer = setTimeout(()=> {
            isClicked = false
        },150)

        document.querySelector(".current").classList.remove('current')
        event.classList.add('current')
    }
    let a = document.querySelectorAll('.blog-page-big-content-sections-title');
    let h3_a = document.querySelectorAll('.blog-page-big-content-sections-subtitle');
    let h2 = document.querySelectorAll('.blog-page-big-content-list-item h2');

    let body = document.querySelector('body');

    body.addEventListener('scroll', function() {
        for(let i = 0; i<a.length;i++){
            a[i].classList.remove('current');
        }
        for(let i = 0; i<h2.length-1;i++){
            if(h2[h2.length-1].getBoundingClientRect().y-500 < 0){
                a[h2.length-1].classList.add('current');
                return;
            }
                if(h2[i].getBoundingClientRect().y-500 < 0 && h2[i+1].getBoundingClientRect().y-500 >= 0){
                    a[i].classList.add('current');
                }

        }
    });

    function goToH2Paragraph(test,text) {
        for(let i = 0; i<h2.length;i++){
            h2[i].classList.remove('current');
        }
        for(let i = 0; i<h3_a.length;i++){
            h3_a[i].classList.remove('current');
        }
        for(let i = 0; i<a.length;i++){
            a[i].classList.remove('current');
        }
        for(let i = 0; i<h2.length;i++){
            if(h2[i].innerHTML === text){
                h2[i].scrollIntoView({block: "center", behavior: "smooth"})
                test.classList.add('current');
                return;
            }
        }
    }


    function goToH3Paragraph(test,text) {
        let h3 = document.querySelectorAll('h3');
        for(let i = 0; i<h3.length;i++){
            h3[i].classList.remove('current');
        }
        for(let i = 0; i<a.length;i++){
            a[i].classList.remove('current');
        }
        for(let i = 0; i<h3_a.length;i++){
            h3_a[i].classList.remove('current');
        }
        for(let i = 0; i<h3.length;i++){
            if(h3[i].innerHTML === text){
                h3[i].scrollIntoView({block: "center", behavior: "smooth"})
                return;
            }
        }
    }

    let options = {
        rootMargin: '0px',
    }

    // let target = document.querySelectorAll('.blog-page-big-content-list-item h2');
    // let observers = []
    // for(let i = 0; i<target.length;i++){
    //     observers.push(new IntersectionObserver(function (entries, observer){
    //         entries.forEach(entry => {
    //             if(entry.isIntersecting){
    //                 for(let i = 0; i<a.length;i++){
    //                     a[i].classList.remove('current');
    //                 }
    //                 a[i].classList.add('current');
    //             }
    //
    //         });
    //     }, options));
    // }
    // for(let i = 0; i<observers.length;i++){
    //     observers[i].observe(target[i]);
    // }


    // $(window).scroll(function () {
    //
    //     if(isClicked) {
    //         clearTimeout(timer);
    //         timer = setTimeout(()=>{
    //             isClicked = false
    //         },150)
    //
    //         return
    //     }
    //
    //     const id = ['#1', '#1-1', '#2']
    //
    //
    //     id.forEach((id) => {
    //         var hT = $(id).offset().top,
    //             hH = $(id).outerHeight(),
    //             wH = $(window).height(),
    //             wS = $(this).scrollTop();
    //
    //         let searchedClass = '.' + id.slice(1)
    //
    //
    //         if (id === '#1') {
    //             if (wS > (hT + hH - wH) && wS - (hT + hH - wH) < 1000) {
    //
    //                 $('.current')[0].classList.remove('current')
    //                 $(searchedClass)[0].classList.add('current')
    //             }
    //         } else if (wS > (hT + hH - wH) && wS - (hT + hH - wH) < 150) {
    //             $('.current')[0].classList.remove('current')
    //             $(searchedClass)[0].classList.add('current')
    //         }
    //     })
    // });
</script>
