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
        {{--
        <meta name="description" content="{{!empty($seo->description) ? $seo->description : ''}}"> --}}
        <meta name="keywords" content="{{!empty($seo->keywords) ? $seo->keywords : ''}}">
        <meta name="author" content="{{!empty($seo->author) ? $seo->author : ''}}">
        <link rel="icon" type="image/png" href="">

        <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}" />
        <link rel="preload" href="{{ asset('css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

        <noscript>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        </noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        @if($get_locale=='ar')
        <style>
            .iti--allow-dropdown .iti__flag-container,
            .iti--separate-dial-code .iti__flag-container {
                right: 0;
                left: auto;
            }

            .iti__arrow {
                margin-right: 6px;
            }

            .iti__selected-flag {
                padding: 0 6px 0 0px;
            }
        </style>
        @endif
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
            <div class="loader" hidden>
                <div class="loader-background"></div>
                <div class="loader-logo"></div>
                <p class="loader-text font-18-lh-22-regular">{{__('Loading...')}}</p>
            </div>
            <div class="row">
                <div class="d-none d-lg-inline col-lg-8 p-0" style="background-color: #F2F4F8;">
                    @include('frontend.v2.sign-up-slider')
                </div>
                <div class="col-lg-4 p-0">
                    <div class="text-center mt-5">
                        <p class="my-5 pt-5 signup-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"> {{__('New Password')}}</p>
                        <div class="mt-3 mb-5">
                            <p class="create-password-email mb-2 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Create a new password')}}</p>
                            <p class="create-password-user-email">{{$email}}</p>
                        </div>

                    </div>

                    <div class="">
                        <form id="signup-form" onsubmit="submitForm(event)" class="reset-password-email">
                            <input type="hidden" id="token" name="token" value="{{$token}}">
                            <div class="mb-2" style="@if($get_locale=='ar') text-align: start; @endif">
                                <label class="primary-text-color  set-forgot-modal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Password')}}
                                    <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z"
                                              fill="#EB001B" />
                                    </svg>
                                </label>
                                <div class="position-relative">
                                    <input type="password" id="password" name="password" class="email-set-password-input px-3" placeholder="***************">
                                    <span onclick="showPassword('password')" class="@if(checkLangaugeGlobaly()=='ar') eye-icon-email-pp-set-ar @else eye-icon-email-pp-set @endif">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.666626 5.99935C0.666626 5.99935 3.33329 0.666016 7.99996 0.666016C12.6666 0.666016 15.3333 5.99935 15.3333 5.99935C15.3333 5.99935 12.6666 11.3327 7.99996 11.3327C3.33329 11.3327 0.666626 5.99935 0.666626 5.99935Z"
                                                  stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 6C10 6.39556 9.8827 6.78224 9.66294 7.11114C9.44318 7.44004 9.13082 7.69638 8.76537 7.84776C8.39992 7.99913 7.99778 8.03874 7.60982 7.96157C7.22186 7.8844 6.86549 7.69392 6.58579 7.41421C6.30608 7.13451 6.1156 6.77814 6.03843 6.39018C5.96126 6.00222 6.00087 5.60008 6.15224 5.23463C6.30362 4.86918 6.55996 4.55682 6.88886 4.33706C7.21776 4.1173 7.60444 4 8 4C8.53043 4 9.03914 4.21071 9.41422 4.58579C9.78929 4.96086 10 5.46957 10 6Z"
                                                  stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="position-relative mt-3">
                                    <input type="password" id="confirm_password" name="confirm_password" class="email-set-password-input px-3" placeholder="***************">
                                    <span onclick="showPassword('confirm_password')"
                                          class="@if(checkLangaugeGlobaly()=='ar') eye-icon-email-pp-set-ar @else eye-icon-email-pp-set @endif">
                                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.666626 5.99935C0.666626 5.99935 3.33329 0.666016 7.99996 0.666016C12.6666 0.666016 15.3333 5.99935 15.3333 5.99935C15.3333 5.99935 12.6666 11.3327 7.99996 11.3327C3.33329 11.3327 0.666626 5.99935 0.666626 5.99935Z"
                                                  stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 6C10 6.39556 9.8827 6.78224 9.66294 7.11114C9.44318 7.44004 9.13082 7.69638 8.76537 7.84776C8.39992 7.99913 7.99778 8.03874 7.60982 7.96157C7.22186 7.8844 6.86549 7.69392 6.58579 7.41421C6.30608 7.13451 6.1156 6.77814 6.03843 6.39018C5.96126 6.00222 6.00087 5.60008 6.15224 5.23463C6.30362 4.86918 6.55996 4.55682 6.88886 4.33706C7.21776 4.1173 7.60444 4 8 4C8.53043 4 9.03914 4.21071 9.41422 4.58579C9.78929 4.96086 10 5.46957 10 6Z"
                                                  stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <p id="password-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                            </div>
                            <div class=" d-flex justify-content-between my-4">
                                <div class="d-flex align-items-center" style="gap: 5px;">
                                    <input class="modal-keep-signed-input signin-signed-input" type="checkbox" id="keep-signed-in-new" name="keep-signed-in-new">
                                    <label class="signin-keep-signed primary-text-color @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Keep me signed
                                        in')}}</label>
                                </div>
                                <div>
                                    <!-- " -->
                                    <a href="{{url('/login')}}"
                                       class="border-0 p-0 bg-transparent text-decoration-underline secondary-text-color forgot-password-link @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Sign
                                        in')}} </a>
                                </div>
                            </div>
                            <div class="alert alert-warning warning-alert-div  @if($get_locale=='en') text-left @else text-right @endif d-none" id="alert-div" role="alert"
                                 style="margin:0 auto">

                            </div>
                            <div class="mt-3 mb-5 text-center">
                                <button type="submit" class="signin-button" style="@if($get_locale=='ar') width:179px; @endif">
                                    <span class="signin-button-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Submit')}}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" style="overflow: auto !important;" id="success_reset_modal" data-backdrop="static" data-keyboard="false" aria-hidden="true"
                 aria-labelledby="email_sent_password_model" tabindex="-1">
                <div class="modal-dialog " style="max-width: 452px;margin: auto;">
                    <div class="modal-content " style="padding: 0px;height:auto;width: max-content;">
                        <div class="updated_password-text-wrapper">
                            <p d="success_reset_text" class="updated_password-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Password Updated')}}</p>
                        </div>
                        <div class="text-center updated_password-button-wrapper d-flex justify-content-center align-items-center">
                            <a href="{{url('/login')}}"
                               class="d-flex justify-content-center align-items-center @if($get_locale=='en') updated_password-button @else updated_password-button-ar @endif"
                               style="text-decoration: none;">
                                <span
                                      class=" @if($get_locale=='ar') updated_password-button-text-ar font-NotoSansArabic-Regular @else updated_password-button-text @endif">{{__('See
                                    Your Dashboard ')}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('frontend.components.footer')
        </div>
        @include('frontend.components.cookie')
        @include('frontend.components.loader')
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        @if($get_locale == 'ar')
        <script>
            toastr.options = {
            "positionClass": "toast-top-center",
            "rtl": true,
        }
        </script>
        @else
        <script>
            toastr.options = {
            "positionClass": "toast-top-center",
            "rtl": false,
        }
        </script>
        @endif
        <script>
            // $('#success_reset_modal').modal('show');
        function toggleLoader(loaderStatus) {
            const loader = document.querySelector('.loader');
            if (loaderStatus) {
                loader.removeAttribute('hidden');
            } else {
                loader.setAttribute('hidden', '');
            }
        };
        </script>

        <script>
            function showPassword(password_type) {
            if (password_type == 'password') {
                var x = document.getElementById("password");
            } else {
                var x = document.getElementById("confirm_password");
            }

            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function submitForm(event){
            event.preventDefault();
            var set_password_confirm=$('#password').val();
            var set_password=$('#confirm_password').val();
            var token=$('#token').val();
            
            if(!set_password){
                $("#password").addClass('input-error-border');
                $("#password-error").text("{{__('This field is required')}}");
                $('#password-error-set').removeClass('d-none');
                return;
            }
            if(!set_password_confirm){
                $("#confirm_password").addClass('input-error-border');
                $("#password-error").text("{{__('This field is required')}}");
                $('#password-error').removeClass('d-none');
                return;
            }
            var remember_me=false;
            if ($("#keep-signed-in-new").is(":checked"))
            {
                remember_me=true;
            }
            $.ajax({
                type: 'POST',
                url: "{{ url('/reset-password-new') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    password: set_password,
                    password_confirmed: set_password_confirm,
                    token:token,
                    remember_me:remember_me
                },
                beforeSend: function () {
                    toggleLoader(true);
                },
                success: function(data) {
                    if(data.status==true){
                        $('#success_reset_text').text(data.message);
                        $('#success_reset_modal').modal("show");
                        toggleLoader(false);
                    }else{
                        $("#password-error").text(data.message);
                        $('#password-error').removeClass('d-none');
                        toggleLoader(false);
                    }
                },
                error: function(error) {
                    var html = '<ul>';
                    $.each(error.responseJSON.errors, function (key, value) {
                        if(key=='password'){
                            $("#password").addClass('input-error-border');
                            $("#password-error").text(value[0]);
                            $('#password-error').removeClass('d-none');
                        }
                        if(key=='password_confirmed'){
                            $("#confirm_password_new").addClass('input-error-border');
                            $("#password-error").text(value[0]);
                            $('#password-error').removeClass('d-none');
                        }
                        html += '<li>'+value[0]+'</li>';
                    });
                    html += '</ul>';
                    toggleLoader(false);
                }
            })
        }
        </script>

    </body>

</html>