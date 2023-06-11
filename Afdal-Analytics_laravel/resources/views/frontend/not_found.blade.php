@include('layout.userhead')

@section('metahead')
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
@endsection


<main class="not-found-page">
    <div class="circle-wrapper-block">
        <div class="circle-wrapper">
            <div class="inner-circle"></div>
        </div>
        @include('frontend.components.header-menu')
        <section class="not-found-page-main-content">
            <div class="not-found-page-circle first">
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
            </div>

            <section class="not-found-page-content">
                <div class="not-found-page-content-title font-18-lh-24-regular">
                    {{__("page not found")}}
                </div>
                <h2 class="not-found-page-content-404 font-74-lh-120-semi-bold">
                    404
                </h2>
                <p class="not-found-page-content-text font-22-lh-30-regular">
                    {{__("Page not found. Please try to go home.")}}
                </p>
                <a href="{{url('/')}}" class="not-found-page-content-return-home-btn orange-button font-18-lh-24-regular">
                    {{__("Return home")}}
                </a>
            </section>
        </section>


    </div>

@include('frontend.components.loader')

</main>

@include('frontend.components.footer')
@include('frontend.components.cookie')
