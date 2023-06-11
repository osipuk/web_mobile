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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
                    <p class="mt-3 signup-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"> {{__(' Sign Up')}}</p>
                    <div class="mt-3 mb-5">
                        <p class="d-inline signup-sub-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__(' Already have an account?')}}</p>
                        <a class="d-inline signup-singin-link @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" href="{{url('/login')}}">{{__('Sign In')}}</a>
                    </div>

                </div>
                <div class="my-5">
                    <div class="google-linkedin-signup">
                        <div class="text-center google-linkedin-signup-box py-3 px-4">
                            <a href="#" id="googleAuth">
                                <div class="mt-3">
                                    <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1932_2892)">
                                            <path d="M39.6099 20.9604C39.6099 19.6009 39.4997 18.234 39.2645 16.8965H20.3999V24.5981H31.2028C30.7545 27.082 29.3141 29.2794 27.205 30.6756V35.6729H33.65C37.4347 32.1895 39.6099 27.0453 39.6099 20.9604Z" fill="#4285F4" />
                                            <path d="M20.3998 40.5015C25.7939 40.5015 30.3429 38.7305 33.6572 35.6733L27.2123 30.6761C25.4191 31.896 23.1042 32.5868 20.4072 32.5868C15.1895 32.5868 10.7654 29.0667 9.17809 24.334H2.52734V29.4856C5.92253 36.2392 12.8378 40.5015 20.3998 40.5015Z" fill="#34A853" />
                                            <path d="M9.1708 24.3345C8.33303 21.8506 8.33303 19.1609 9.1708 16.677V11.5254H2.52741C-0.309265 17.1767 -0.309265 23.8348 2.52741 29.4861L9.1708 24.3345Z" fill="#FBBC04" />
                                            <path d="M20.3998 8.4161C23.2512 8.37201 26.007 9.44494 28.0721 11.4144L33.7822 5.70436C30.1665 2.30917 25.3677 0.442557 20.3998 0.501348C12.8378 0.501348 5.92253 4.7637 2.52734 11.5247L9.17074 16.6763C10.7507 11.9362 15.1821 8.4161 20.3998 8.4161Z" fill="#EA4335" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1932_2892">
                                                <rect width="40" height="40" fill="white" transform="translate(0 0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <p class="google-signup-text @if($get_locale=='ar') google-signup-text-ar @endif" style="width: 128px;">{{__('Sign up with Google')}}</p>
                            </a>
                        </div>
                        <div class="text-center google-linkedin-signup-box py-3  @if($get_locale=='ar') px-3 @else px-4 @endif">
                            <a href="#" id="linkedIn">
                                <div class="mt-3">
                                    <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 20.5C0 31.5457 8.95431 40.5 20 40.5C31.0457 40.5 40 31.5457 40 20.5C40 9.45431 31.0457 0.5 20 0.5C8.95431 0.5 0 9.45431 0 20.5Z" fill="#2867B2" />
                                        <path d="M14.5 30.5H10.25V17.125H14.5V30.5ZM12.375 15.25C11 15.25 10 14.25 10 12.875C10 11.5 11.125 10.5 12.375 10.5C13.75 10.5 14.75 11.5 14.75 12.875C14.75 14.25 13.75 15.25 12.375 15.25ZM30 30.5H25.75V23.25C25.75 21.125 24.875 20.5 23.625 20.5C22.375 20.5 21.125 21.5 21.125 23.375V30.5H16.875V17.125H20.875V19C21.25 18.125 22.75 16.75 24.875 16.75C27.25 16.75 29.75 18.125 29.75 22.25V30.5H30Z" fill="white" />
                                    </svg>
                                </div>
                                <p class="linkedin-signup-text @if($get_locale=='ar') linkedin-signup-text-ar @endif">{{__('Sign up with Linkedin')}}</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="signup-line-divider"></div>
                    <p class="signup-divider-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="@if($get_locale=='ar') width: 125px; @endif">{{__('Sign up with Phone number')}}</p>
                </div>

                <div class="text-center ">
                    <form id="signup-form" onsubmit="submitForm(event)" style="width: 375px;margin: 0 auto;">
                        <div class="mb-5">
                            <input type="text" id="phone" name="phone" class="signup-input-box px-5 @if($get_locale=='ar') signup-input-box-ar @endif">
                            <p id="phone-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                        </div>

                        <div class="mb-2">
                            <div class="signup-line-divider"></div>
                            <p class="signup-divider-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="@if($get_locale=='ar') width: 110px; @else width: 125px; @endif">{{__('Sign up with Email')}}</p>
                        </div>
                        <div class="mb-2">
                            <input type="email" id="email" name="email" class="signup-input-box px-3" placeholder="email@companyexample.com">
                            <p id="email-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                        </div>
                        <div class="signup-terms-wrapper mt-3">
                            <input class="signup-checkbox" required  checked type="checkbox" id="checkbox-terms" name="terms">
                            <label style="@if($get_locale=='ar') font-size: 10px; @endif" class="@if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('I agree to Afdal Analytics ')}} <a href="http://afdal-analytics.local/privacy-policy" target="_blank">{{__('Privacy Policy')}}</a> {{__('and')}}
                                <a href="http://afdal-analytics.local/cookie-policy" target="_blank">{{__('Cookie Policy')}}</a></label>
                        </div>
                        <div class="alert alert-warning text-left d-none" id="alert-div" role="alert" style="width: 375px; margin:0 auto">
                            
                        </div>
                        <div class="mt-3 mb-5">
                            <button type="submit" class="signup-button @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Sign Up')}}</button>
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
    <script type="text/javascript" src="{!!asset('js/components/auth.js')!!}"></script>
    <script>
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
        const googleAuthUrl = "{{route('auth.google')}}";
        const linkedInAuthUrl = "{{route('auth.linkedIn')}}";
        const appleAuthUrl = "{{route('auth.apple')}}";
    </script>
    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ["sa", "eg", "ae", "qa", "kw"],
            initialCountry: "sa",
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        function submitForm(event) {
            
            event.preventDefault();
            $('#alert-div').addClass('d-none');
            $("#alert-div").text("");
            $("#email").removeClass('input-error-border');
            $("#phone").removeClass('input-error-border');
            $('#phone-error').addClass('d-none');
            $('#email-error').addClass('d-none');
            event.preventDefault();
            if (!$("#checkbox-terms").is(":checked"))
            {
                $("#alert-div").text("{{__('Please indicate that you agree to the Terms')}}");
                $('#alert-div').removeClass('d-none');
                return;
            }
            const phoneNumber = phoneInput.getNumber();
            let email=$('#email').val();
            if(!email && !phoneNumber){
                $("#email").addClass('input-error-border');
                $("#phone").addClass('input-error-border');
                $("#alert-div").text("{{__('Phone or Email is required')}}");
                $('#alert-div').removeClass('d-none');
                return;
            }
            if(email){
                let is_valid=ValidateEmail(email);
                if(!is_valid){
                    $("#email").addClass('input-error-border');
                    $("#email-error").text("{{__('Invalid email format')}}");
                    $('#email-error').removeClass('d-none');
                    return;
                }
            }
            if(phoneNumber!=''){
                if (!phoneInput.isValidNumber()) {
                    $("#phone").addClass('input-error-border');
                    $("#phone-error").text("{{__('Invalid Phone Number')}}");
                    $('#phone-error').removeClass('d-none');
                    return;
                }
            }
            toggleLoader(true);
            $.ajax({
                type: 'POST',
                url: '{{ url('/signup-new') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    phone: phoneNumber,
                    email: email,
                    terms:$("#checkbox-terms").val()
                },
                success: function(data) {
                    if(data.status==true){
                        window.location.replace("{{ url('/demo-dashboard') }}");
                    }else if(data.status==false){
                        $("#email").addClass('input-error-border');
                        $("#email-error").text("{{__('Email is not Valid')}}");
                        $('#email-error').removeClass('d-none');
                        toggleLoader(false);
                    }
                    
                },
                error: function(error) {
                    var html = '<ul>';
                    
                    $.each(error.responseJSON.errors, function (key, value) {
                        if(key=='phone'){
                            $("#phone").addClass('input-error-border');
                            $("#phone-error").text(value[0]);
                            $('#phone-error').removeClass('d-none');
                        }
                        if(key=='email'){
                            $("#email").addClass('input-error-border');
                            $("#email-error").text(value[0]);
                            $('#email-error').removeClass('d-none');
                        }
                        html += '<li>'+value[0]+'</li>';
                    });
                    html += '</ul>';
                    toggleLoader(false);
                    // $('#alert-div').append(html);
                    // $('#alert-div').removeClass('d-none');
                }
            })
        }
        function ValidateEmail(mail) {
            if (/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))+$/.test(mail))
            {
                return (true)
            }
            return (false)
        }
    </script>
</body>

</html>