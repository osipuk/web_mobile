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
                <div class="text-center mt-5">
                    <p class="mt-3 signup-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__(' Welcome')}}</p>
                    <div class="mt-3 mb-5">
                        <p class="d-inline signup-sub-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Almost there, tell more about your self!!')}}</p>
                    </div>

                </div>
                @if ($errors->any())
                <div class="alert alert-warning text-left" role="alert" style="width: 375px; margin:0 auto">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="my-5">
                    <div class="text-center ">
                        <form method="POST" action="{{url('signup-step-2-new')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="signup-2-label mb-3 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('First Name')}}</label>
                                <div>
                                    <input type="text" autocomplete="off" name="first_name" value="{{old('first_name')}}" class="signup-input-box px-3" placeholder="{{__('First Name')}}">
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="signup-2-label mb-3 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Last Name')}}</label>
                                <div>
                                    <input type="text" autocomplete="off" name="last_name" value="{{old('last_name')}}" class="signup-input-box px-3" placeholder="{{__('Last Name')}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="signup-2-label mb-3 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Password')}}</label>
                                <div>
                                    <input type="password" autocomplete="off" maxlength="30" name="password" id="password" class="signup-input-box px-3 mb-3" placeholder="****************">
                                    <span onclick="showPassword('password')" class="signup-eye-icon">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.666626 5.99935C0.666626 5.99935 3.33329 0.666016 7.99996 0.666016C12.6666 0.666016 15.3333 5.99935 15.3333 5.99935C15.3333 5.99935 12.6666 11.3327 7.99996 11.3327C3.33329 11.3327 0.666626 5.99935 0.666626 5.99935Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 6C10 6.39556 9.8827 6.78224 9.66294 7.11114C9.44318 7.44004 9.13082 7.69638 8.76537 7.84776C8.39992 7.99913 7.99778 8.03874 7.60982 7.96157C7.22186 7.8844 6.86549 7.69392 6.58579 7.41421C6.30608 7.13451 6.1156 6.77814 6.03843 6.39018C5.96126 6.00222 6.00087 5.60008 6.15224 5.23463C6.30362 4.86918 6.55996 4.55682 6.88886 4.33706C7.21776 4.1173 7.60444 4 8 4C8.53043 4 9.03914 4.21071 9.41422 4.58579C9.78929 4.96086 10 5.46957 10 6Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <input type="password" autocomplete="off" name="confirm_password" id="confirm_password" id="confirm-password" class="signup-input-box px-3" placeholder="****************">
                                    <span onclick="showPassword('confirm')" class="signup-eye-icon">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.666626 5.99935C0.666626 5.99935 3.33329 0.666016 7.99996 0.666016C12.6666 0.666016 15.3333 5.99935 15.3333 5.99935C15.3333 5.99935 12.6666 11.3327 7.99996 11.3327C3.33329 11.3327 0.666626 5.99935 0.666626 5.99935Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 6C10 6.39556 9.8827 6.78224 9.66294 7.11114C9.44318 7.44004 9.13082 7.69638 8.76537 7.84776C8.39992 7.99913 7.99778 8.03874 7.60982 7.96157C7.22186 7.8844 6.86549 7.69392 6.58579 7.41421C6.30608 7.13451 6.1156 6.77814 6.03843 6.39018C5.96126 6.00222 6.00087 5.60008 6.15224 5.23463C6.30362 4.86918 6.55996 4.55682 6.88886 4.33706C7.21776 4.1173 7.60444 4 8 4C8.53043 4 9.03914 4.21071 9.41422 4.58579C9.78929 4.96086 10 5.46957 10 6Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="signup-terms-wrapper mt-3 " style="justify-content: space-between;">
                                <div>
                                    <input class="signup-checkbox" type="checkbox" name="terms">
                                    <label class="@if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Keep me signed in')}}</label>
                                </div>
                                <div>
                                    <a href="#" class="signup-Signin-option @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Sign In ')}}</a>
                                </div>
                            </div>
                            <div class="mt-5 pb-3">
                                <button class="signup-step2-button mt-3 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Create an account')}}</button>
                            </div>
                        </form>
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


            </div>
        </div>
        @include('frontend.components.footer')
    </div>
    @include('frontend.components.cookie')
    @include('frontend.components.loader')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script>
        function showPassword(password_type) {
            if (password_type == 'password') {
                var x = document.getElementById("password");
            } else {
                var x = document.getElementById("confirm-password");
            }

            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>