@section('metahead')

    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
    <meta property="og:type"          content="article" />
    <meta property="og:title"     content="{{!empty($guide->meta_title) ? $guide->meta_title : ''}}">
    <meta property="og:url"           content="{{Request::url()}}" />
    <meta property="og:image"         content="{{url(!empty($guide->image) ? '/storage/' . $guide->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}" />
    <meta name="author"                 content=" {{!empty($blog->author_name) ? $blog->author_name : ''}}"/>
    <meta property="og:image:width"     content="1200" />
    <meta property="og:image:height"    content="630" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{!empty($guide->meta_title) ? $guide->meta_title : ''}}">
    <meta name="twitter:creator" content="{{!empty($guide->author_name) ? $guide->author_name : ''}}">
    <meta name="twitter:image" content="{{url(!empty($guide->image) ? '/storage/' . $guide->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}">
@endsection
  @include('layout.userhead')


<main class="blog-page">
    @include('frontend.components.header-circle')
    @include('frontend.components.header-menu')
<div class='guide-page-wrap-title'>
    <h1 class="guide-page-title font-64-lh-89-semi-bold">
         {{!empty($guide->title) ? $guide->title : ''}}
    </h1>
    <a href="#guide" class='guides-button-under-title font-20-lh-23-semi-bold orange-button' type='button'>{{__('Explore it')}}</a>
    </div>

    <section class='guide-page-section'>
    <img class="guide-page-image"
        src="{{url(!empty($guide->image) ? '/storage/' . $guide->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}"
        alt="Placeholder image"
    >
    <div class='guide-page-text font-20-lh-23-regular' id="guidesText">
        {!! $guide->text !!}
    </div>

    <p class='font-13-lh-15-semi-bold'>{{__('SHARE THIS PAGE')}}</p>
    <div id="guide" class="guide-page-share-links">
        @if(!empty($socialShare))
            <a class="guide-page-share-icon-mail"
              href="mailto:?subject={{!empty($guide->title) ? $guide->title : ''}}&amp;body={{__('Hey! I thought you might be interested to read this')}}%0D%0A {{urlencode(Request::url())}}"
              target="_blanc"
            ></a>
            @foreach($socialShare as $key => $value)
                @switch($key)

                    @case($key == "linkedin")
                    <a href="{{$value}}" class="guide-page-share-icon-linkedin" target="_blanc"></a>
                    @break

                    @case($key == "twitter")
                    <a href="{{$value}}" class="guide-page-share-icon-twitter" target="_blanc"></a>
                    @break

                    @case($key == "facebook")
                    <a href="{{$value}}" class="guide-page-share-icon-facebook" target="_blanc"></a>
                    @break
                @endswitch
            @endforeach
        @endif
          </div>
    </section>

    <div class="guide-page-form-wrap">

        @if(empty(!Auth::user()) || !empty(Request::get('email')))
            <div class='guides-auth-wrap'>
                <h4 class='guides-auth-title font-22-lh-28-medium'>{{__("Click below to download")}}</h4>
                <a download="{{$guide->title}}" href="{{url('/storage/' . $guide->file)}}" type="button" class="guides-form-btn">{{__('Read')}}</a>
            </div>
{{--             btn for auth users --}}
        @else
            <form class='guides-form'>

                <input class='text-field first_name guides-form-input font-20-lh-42-regular' placeholder="{{__('First Name')}}" type="text" name="first_name">

                <input class='text-field last_name guides-form-input font-20-lh-42-regular' placeholder="{{__('Last Name')}}" type="text" name="last_name">

                <input class='text-field company guides-form-input font-20-lh-42-regular' placeholder="{{__('Company Name')}}" type="text" name="company">

                <input class='email guides-form-input font-20-lh-42-regular' placeholder="{{__('Email address')}}" type="email" name="email">

                <button class='guides-form-btn font-24-lh-28-medium send disabled orange-button' disabled>{{__('Download the guide')}}</button>
            </form>
        @endif
    </div>
<div class="product-page-wrapper-position-relative">
        @include('frontend.components.footer-circle')
        @include('frontend.components.subscription')
    </div>

@include('frontend.components.loader')


</main>


@include('frontend.components.footer')
@include('frontend.components.cookie')
<script>
    let form = document.querySelector('.guides-form');
    let download = document.querySelector('.hidden');
    let send = document.querySelector('.send');
    let isValidEmail = false;
    let isValidFirstName = false;
    let isValidLastName = false;
    let isValidCompany = false;
    let H2size = '{{$guide->h2_size}}'
    let H3size = '{{$guide->h3_size}}'
    let H4size = '{{$guide->h4_size}}'
    let textSize = '{{$guide->text_size}}'

    function setFontSize(items, size){
        if(size === 0 || size ==='0') return;

        for(let i = 0; i < items.length; i++){
            items[i].style.fontSize = size + 'px';
        }
    }

    setFontSize(document.querySelectorAll('.guide-page-text h2'), H2size)
    setFontSize(document.querySelectorAll('.guide-page-text h3'), H3size)
    setFontSize(document.querySelectorAll('.guide-page-text h4'), H4size)
    setFontSize(document.querySelectorAll('.guide-page-text p'), textSize)

    let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    $('.guides-form .email').on('change' , function (){
        if($(this).val().match(mailformat) && $(this).val().length > 2 && $(this).val().length < 42){
            isValidEmail = true;
            $(this).removeClass('invalid-input-mailchimp');
        }else{
            isValidEmail = false;
            $(this).addClass('invalid-input-mailchimp');
        }
        validate();
    });

    $('.guides-form .first_name').on('change' , function (){
        if($(this).val().length > 2 && $(this).val().length < 42){
            isValidFirstName = true;
            $(this).removeClass('invalid-input-mailchimp');
        }else{
            isValidFirstName = false;
            $(this).addClass('invalid-input-mailchimp');
        }
        validate();
    });

    $('.guides-form .last_name').on('change' , function (){
        if($(this).val().length > 2 && $(this).val().length < 42){
            isValidLastName = true;
            $(this).removeClass('invalid-input-mailchimp');
        }else{
            isValidLastName = false;
            $(this).addClass('invalid-input-mailchimp');
        }
        validate();
    });

    $('.guides-form .company').on('change' , function (){
        if($(this).val().length > 2 && $(this).val().length < 42){
            isValidCompany = true;
            $(this).removeClass('invalid-input-mailchimp');
        }else{
            isValidCompany = false;
            $(this).addClass('invalid-input-mailchimp');
        }
        validate();
    });

    function  validate(){
        if(isValidEmail && isValidFirstName && isValidLastName && isValidCompany){
            send.disabled = false;
            send.classList.remove('disabled');
        } else {
            send.disabled = true;
            send.classList.add('disabled');
        }
    }

    send.addEventListener('click', function(){
        const sendetData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: $(".guides-form-input.first_name")[0].value + $(".guides-form-input.last_name")[0].value,
            email: $(".guides-form-input.email")[0].value,
            company: $(".guides-form-input.company")[0].value,
        }

        fetch('/subscribe-mailchimp', {
            method: 'post',
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify(sendetData)
        })
        form.style.display = 'none';
        download.style.display = 'block';
    });
</script>

<script>
    let isClicked = false;
    let timer = null;

    function goToSection(event) {
        isClicked  = true;
        timer = setTimeout(()=> {
            isClicked = false
        },150)

        document.querySelector(".current").classList.remove('current')
        event.classList.add('current')
    }
    function goToParagraph(test,text) {
        $('.blog-page-big-content-sections-title').removeClass('current');
        $(test).addClass('current');
        $('.blog-page-big-content-list-item h2').removeClass('current');
        $(`*:contains('${text}'):last`).addClass('current');
        $('html, body').animate({
            scrollTop: $(`*:contains('${text}'):last`).offset().top - 200
        }, 400);
    }

</script>
