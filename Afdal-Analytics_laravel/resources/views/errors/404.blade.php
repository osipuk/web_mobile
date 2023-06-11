<head>
  <title>{{__("Not Found")}}</title>
  <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}" />
</head>
@include('layout.userhead')

@include('frontend.components.header-menu')
<main class="not-found-page">
  <div class="not-found-h">
    {{-- <div class="circle-wrapper">
      <div class="inner-circle"></div>
    </div> --}}
    <section class="not-found-page-main-content-sec">
      {{-- <div class="not-found-page-circle first">
        <div class="not-found-page-ball first"></div>
      </div>
      <div class="not-found-page-circle second">
        <div class="not-found-page-ball second"></div>
      </div>
      <div class="not-found-page-circle third">
        <div class="not-found-page-ball third"></div>
      </div>
      <div class="not-found-page-circle fourth">
        <div class="not-found-page-ball fourth"></div>
      </div> --}}

      <section class="not-found-page-content">
        <h2 class="not-found-page-content-404 font-64-lh-135-semi-bold">
          404 {{__('Page Not Found.')}}
        </h2>
        <div class='not-found-page-img'></div>
      </section>
      <p class='not-found-page-content-text text-color font-22-lh-46-semi-bold'>{{__("We can't find the page you're looking for.")}}</p>

      {{--<section class="not-found-page-content">
        <h2 class="not-found-page-content-404 font-64-lh-135-semi-bold">
          @if($locale=='ar')
          404 الصفحة غير موجودة.
          @else
          404 Page Not Found.
          @endif
        </h2>
        <div class='not-found-page-img'></div>
      </section>
      <p class='not-found-page-content-text text-color font-22-lh-46-semi-bold'>
        @if($locale=='ar')
        لا يمكننا العثور على الصفحة التي تبحث عنها.
        @else
        We can't find the page you're looking for
        @endif
        {{-- {{__("We can't find the page you're looking for.")}} --}}
      </p> --}}
      <div class="not-found-page-social-links">

        <a class="footer-social-link footer-social-link--twitter" href="https://twitter.com/afdalanalytics" target="_blanc">Our Twitter account</a>

        <a class="footer-social-link footer-social-link--instagram" href="https://www.instagram.com/afdalanalytics" target="_blanc">Our Instagram account</a>

        <a class="footer-social-link footer-social-link--facebook" href="https://www.facebook.com/Afdal.Analytics" target="_blanc">Our Facebook account</a>

        <a class="footer-social-link footer-social-link--linkedin" href="https://www.linkedin.com/company/afdalanalytics" target="_blanc">Our Linkedin account</a>
      </div>
    </section>


  </div>

  @include('frontend.components.footer')

</main>

@include('frontend.components.loader')
@include('frontend.components.cookie')


@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))