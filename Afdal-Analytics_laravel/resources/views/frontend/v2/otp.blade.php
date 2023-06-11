<!DOCTYPE html>
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
<html lang="ar" dir="{{ $get_locale == 'ar' ? 'rtl':'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{!empty($seo->title) ? $seo->title : ''}}</title>
    <meta name="description" content="{{!empty($seo->description) ? $seo->description : ''}}">
    <meta name="keywords" content="{{!empty($seo->keywords) ? $seo->keywords : ''}}">
    <meta name="author" content="{{!empty($seo->author) ? $seo->author : ''}}">
    <link rel="icon" type="image/png" href="">

    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}" />
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </noscript>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-54B2DBW');
    </script>
    <!-- End Google Tag Manager -->

    <script>
        window.intercomSettings = {
            app_id: "wnracdlh"
        };
    </script>

    <script>
        // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/wnracdlh'
        (function() {
            var w = window;
            var ic = w.Intercom;
            if (typeof ic === "function") {
                ic('reattach_activator');
                ic('update', w.intercomSettings);
            } else {
                var d = document;
                var i = function() {
                    i.c(arguments);
                };
                i.q = [];
                i.c = function(args) {
                    i.q.push(args);
                };
                w.Intercom = i;
                var l = function() {
                    var s = d.createElement('script');
                    s.type = 'text/javascript';
                    s.async = true;
                    s.src = 'https://widget.intercom.io/widget/wnracdlh';
                    var x = d.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                };
                if (document.readyState === 'complete') {
                    l();
                } else if (w.attachEvent) {
                    w.attachEvent('onload', l);
                } else {
                    w.addEventListener('load', l, false);
                }
            }
        })();
    </script>
     <!-- active compaign -->
     <script type="text/javascript">
    (function(e,t,o,n,p,r,i){e.visitorGlobalObjectAlias=n;e[e.visitorGlobalObjectAlias]=e[e.visitorGlobalObjectAlias]||function(){(e[e.visitorGlobalObjectAlias].q=e[e.visitorGlobalObjectAlias].q||[]).push(arguments)};e[e.visitorGlobalObjectAlias].l=(new Date).getTime();r=t.createElement("script");r.src=o;r.async=true;i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)})(window,document,"https://diffuser-cdn.app-us1.com/diffuser/diffuser.js","vgo");
    vgo('setAccount', '254549829');
    vgo('setTrackByDefault', true);

    vgo('process');
</script>
</head>

<body class="sign-up-page" style="background-color: #FFFFFF;">
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-54B2DBW" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    @include('frontend.components.header-menu')
    <div>
        <div class="row">
            <div class="d-none d-lg-inline col-lg-8 p-0" style="background-color: #F2F4F8;">
                @include('frontend.v2.sign-up-slider')
            </div>
            <div class="col-lg-4 p-0">
                <div>
                    <form id="signup-form" onsubmit="submitForm(event)">
                        <div class="text-center mt-5">
                            <p class="my-3 signup-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Last step')}}</p>
                            <div class="my-3">
                                <svg width="35" height="43" viewBox="0 0 35 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M34.4791 23.0189C34.4655 20.0553 32.5921 17.5379 29.8116 16.5751C29.2241 16.3726 28.1446 16.2519 28.0879 15.9742C28.0085 15.5918 28.0402 14.6882 28.0221 14.0372C27.9722 12.1708 28.1899 10.2907 27.7817 8.44023C26.6931 3.51239 22.0754 -0.193154 16.7547 0.189237C12.0055 0.530657 7.84821 4.22255 7.13152 8.90456C6.80266 11.051 7.00905 13.2087 6.99771 15.362C6.99318 16.0653 6.74596 16.2679 6.1336 16.3862C2.70891 17.0508 0.529362 19.6661 0.513486 23.1441C0.495342 27.4004 0.495342 31.6591 0.513486 35.9155C0.529362 39.9465 3.40292 42.819 7.41729 42.8326C10.783 42.8463 14.1487 42.8349 17.5144 42.8326C20.9369 42.8326 24.3593 42.8508 27.7794 42.8258C31.5126 42.7985 34.4564 39.8645 34.4814 36.1294C34.5086 31.7592 34.5041 27.3868 34.4814 23.0166L34.4791 23.0189ZM11.189 10.0495C11.5269 6.95163 14.0285 4.49568 17.0518 4.3318C20.2565 4.15882 23.1867 6.29838 23.7016 9.42807C24.0463 11.5198 23.7787 13.6708 23.8127 15.7967C23.8218 16.3475 23.4158 16.2428 23.096 16.2428C21.2045 16.2496 19.3107 16.2451 17.4192 16.2451C15.5277 16.2451 13.6339 16.236 11.7424 16.2519C11.3024 16.2565 11.0552 16.1745 11.0756 15.6533C11.1482 13.7869 10.9826 11.9159 11.1867 10.0495H11.189ZM30.3718 35.5968C30.3672 37.618 29.2808 38.706 27.2827 38.7083C20.7532 38.7105 14.2213 38.7105 7.69172 38.7083C5.70495 38.7083 4.62084 37.6021 4.62084 35.5831C4.61857 31.5544 4.61857 27.5256 4.62084 23.4969C4.62084 21.5075 5.65959 20.4742 7.6645 20.4696C10.944 20.465 14.2236 20.4696 17.5031 20.4696C20.8099 20.4696 24.1189 20.465 27.4256 20.4696C29.3081 20.4742 30.3672 21.528 30.3718 23.424C30.3831 27.4801 30.3808 31.5384 30.3718 35.5945V35.5968Z" fill="#F58B1E" />
                                </svg>
                            </div>
                            <div>
                                <p class="otp-secure-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Secure your account')}}</p>
                                <p class="mt-1 otp-code-sent @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                    {{__('a code is sent to')}} 
                                    <span style="@if($get_locale=='ar') unicode-bidi: embed;direction: ltr; @endif">{{substr(session('user_phone'), 0, 6)}} *** ***</span>
                                </p>
                            </div>
                            <div class="mt-3" style="@if($get_locale=='ar') unicode-bidi: embed;direction: ltr; @endif">
                                <input class="text-center border-0 signup-otp otp-input1-border-radius" required type="text" id="first" maxlength="1">
                                <input class="text-center border-0 signup-otp rounded-0" type="text" required id="second" maxlength="1">
                                <input class="text-center border-0 signup-otp rounded-0" type="text" required id="third" maxlength="1">
                                <input class="text-center border-0 signup-otp rounded-0" type="text" required id="four" maxlength="1">
                                <input class="text-center border-0 signup-otp rounded-0" type="text" required id="five" maxlength="1">
                                <input class="text-center border-0 signup-otp otp-input-last-border-radius" required type="text" id="six" maxlength="1">
                            </div>
                        </div>
                        <div class="alert alert-warning text-left d-none" id="alert-div" role="alert" style="width: 375px; margin:0 auto"></div>
                        <div class="my-3">
                            <div class="text-center ">
                                <div class="mt-3 pb-3">
                                    <button type="submit" class="signup-step3-button mt-3 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Submit')}}</button>
                                </div>
                                <div class="my-3">
                                    <p class="d-inline otp-didnot-get-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Didn’t get the code?')}}</p>
                                    <a class="d-inline otp-resend @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" href="#">{{__('Resend')}}</a>
                                </div>
                                <div class="mt-4">
                                    <a href="#" class="signup-step2-skip @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                        @if($get_locale=='ar')
                                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 1L5.00006 5.00006L1 9.00012" stroke="#7E92AC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        @endif
                                        {{__('Skip to demo page')}}
                                        @if($get_locale=='en')
                                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 1L5.00006 5.00006L1 9.00012" stroke="#7E92AC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        @endif
                                    </a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('frontend.components.footer')
    </div>
    @include('frontend.components.cookie')
    @include('frontend.components.loader')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script>
        function submitForm(event) {
            event.preventDefault();
            const first=$('#first').val();
            const second=$('#second').val();
            const third=$('#third').val();
            const four=$('#four').val();
            const five=$('#five').val();
            const six=$('#six').val();

            const otp=first+second+third+four+five+six;
            $.ajax({
                type: 'POST',
                url: '{{ url('/signup-step-3-new') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    otp: otp
                },
                success: function(data) {
                    if(data.status==false){
                        var html = '<ul>';
                            html += '<li>'+data.message+'</li>';
                        html += '</ul>';
                        $('#alert-div').append(html);
                        $('#alert-div').removeClass('d-none');
                    }else{
                        window.location.replace('{{ url('/dashboard') }}');
                    }
                    
                },
                error: function(error) {
                    var html = '<ul>';
                    
                    console.log(error);
                    $.each(error.responseJSON.errors, function (key, value) {
                        html += '<li>'+value[0]+'</li>';
                    });
                    html += '</ul>';
                    $('#alert-div').append(html);
                    $('#alert-div').removeClass('d-none');
                }
            })
        }
    </script>
</body>

</html>