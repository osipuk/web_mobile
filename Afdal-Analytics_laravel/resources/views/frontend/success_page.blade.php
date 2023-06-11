@section('metahead')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{!empty($seo->title) ? $seo->title : ''}}</title>
    <meta name="description" content="{{!empty($seo->description) ? $seo->description : ''}}">
    <meta name="keywords" content="{{!empty($seo->keywords) ? $seo->keywords : ''}}">
    <meta name="author" content="{{!empty($seo->author) ? $seo->author : ''}}">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

    <div class="success-page">
      @include('layout.userhead')

      @include('frontend.components.header-menu')
        <main class="main-content success-main">
            <div class="circle-left-orange-large"></div>
            <div class="circle-left-orange-midle"></div>
            <div class="circle-left-orange-small"></div>
            <div class="circle-right-orange-midle"></div>
            <div class="circle-right-orange-small"></div>
            <h2 class="title font-92-lh-194-semi-bold success-title">{{__('Thank you')}}</h2>
            <p class="subtitle font-48-lh-101-light">{{__("We appreciate your contacting us")}}</p>
            <p class="text first font-22-lh-46-semi-bold">{{__('One of our colleagues will contact you soon')}}</p>
            <p class="text second font-22-lh-46-semi-bold">
              {{__('Want to keep up to date with the latest developments?')}}
              <br>
              {{__("Follow us on our social media channels")}}
              </p>
            <div class="social-block">
              <a href="https://twitter.com/afdalanalytics" class="icon-wrapper">
                <span class="icon twitter"></span>
              </a>
              <a href="https://www.linkedin.com/company/afdalanalytics" class="icon-wrapper">
                  <span class="icon linkedin"></span>
              </a>
                <a href="https://www.instagram.com/afdalanalytics" class="icon-wrapper">
                  <span class="icon instagram"></span>
                </a>
                <a href="https://www.facebook.com/Afdal.Analytics" class="icon-wrapper">
                    <span class="icon facebook"></span>
                </a>
            </div>
                <div class="product-page-wrapper-position-relative success-page-footer-circle-wrap">
        <div class="footer-animation animated-circle-wrapper successfull-page-circle">



  <div class="footer-circle"></div>
  <div class="footer-circle-orange-small">
  </div>
  <div class="footer-circle-orange-medium">
  </div>
  <div class="footer-circle-orange-large">
  </div>
</div>
    </div>

    @include('frontend.components.loader')

@include('frontend.components.topup')
</main>


@include('frontend.components.footer')
{{-- @include('frontend.components.cookie') --}}
        {{-- </main>
        <footer class="footer">
            <div class="circle-wrapper">
                <div class="footer__circles-wrapper first">
                    <div class="footer__ball first"></div>
                    <div class="footer__circles-wrapper second">
                        <div class="footer__ball second"></div>
                        <div class="footer__circles-wrapper third">
                            <div class="footer__circles-wrapper orange">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__content-wrapper ">
                <div class="footer__main-content container-1368px">
                    <p class="footer__main-content-title font-35-lh-74-semi-bold">
                        أفضل التحليلات
                    </p>
                    <p class="footer__main-content-sub-title font-18-lh-28-regular">
                      أفضل التحليلات هي منصة لتحليل البيانات التسويقية باللغة الالعربية؛ تهدف لتطوير مجال التسويق الالكتروني بالعالم العربي ومنح الفرصة لأبنائه لتطوير ونمو أعمالهم
                      .مهمتنا هي توفير مساحة شاملة ومتكاملة لتحليل وقياس كافة البيانات التسويقية مختلفة المصادر، في مكان واحد حيث الوضوح والدقة والاتقان
                    </p>
                    <p class="footer__main-content-contacts font-18-lh-28-regular">
                      تحتاج للمساعدة أكثر؟
                      <br/>
                      تواصل معنا عبر البريد الإلكتروني
                    </p>
                    <a class="footer__main-content-email font-15-lh20-light white-no-underline text-orange-hover mt-2" href="mailto:info@afdalanalytics.com">
                      info@afdalanalytics.com
                    </a>
                    <p class="footer__main-content-address font-15-lh20-light">1201 Peachtree Street NE, Floor 1, 2, and
                        3, Atlanta, Georgia, 30361, USA</p>
                </div>
            </div>
            <div class="footer-wrapper">
                <div class="footer__final-info container-1368px">
                    <div class="footer__final-info-social-block ">
                        <a class="icon linkedin" href="https://www.linkedin.com/company/afdalanalytics"></a>
                        <a class="icon facebook" href="https://www.facebook.com/Afdal.Analytics"></a>
                        <a class="icon instagram" href="https://twitter.com/afdalanalytics"></a>
                        <a class="icon twitter" href="https://www.instagram.com/afdalanalytics"></a>
                    </div>
                    <a href="/privacy-policy" class="footer__final-info-data-security font-13-lh-20-medium text-orange-hover">
                      {{__('Privacy Policy')}}
                    </a>
                    <p class="footer__final-info-right-reserved font-13-lh-20-medium">
                      <span>{{__('©2022 Afdal Analytics Inc. All Rights Reserved.')}}</span>
                  </p>
                </div>
            </div>
        </footer> --}}
    </div>


@include('frontend.components.cookie')
