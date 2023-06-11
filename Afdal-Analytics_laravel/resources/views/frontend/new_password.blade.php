<!DOCTYPE html>
<html lang="en" dir="rtl">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{!empty($seo->title) ? $seo->title : ''}}</title>
        {{--
        <meta name="description" content="{{!empty($seo->description) ? $seo->description : ''}}">
        <meta name="keywords" content="{{!empty($seo->keywords) ? $seo->keywords : ''}}">
        <meta name="author" content="{{!empty($seo->author) ? $seo->author : ''}}"> --}}
        <meta name="_token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="{!!asset('assets/css/bootstrap.min.css')!!}" rel="stylesheet">
        <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}" />
        <link href="{!!asset('assets/css/style.css')!!}" rel="stylesheet">
        <style>
            body {
                overflow-x: hidden;
            }

            input::-ms-reveal,
            input::-ms-clear {
                display: none;
            }

            input[data-rule].valid {
                border: 2px solid green !important;
            }
        </style>

        <script>
            window.intercomSettings = {
            app_id: "wnracdlh"
        };
        </script>

        <script>
            // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/wnracdlh'
        (function () {
            var w = window;
            var ic = w.Intercom;
            if (typeof ic === "function") {
                ic('reattach_activator');
                ic('update', w.intercomSettings);
            } else {
                var d = document;
                var i = function () {
                    i.c(arguments);
                };
                i.q = [];
                i.c = function (args) {
                    i.q.push(args);
                };
                w.Intercom = i;
                var l = function () {
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

    {{--@extends('layout.userhead')--}}

    <body class="reset-page new-password">
        @include('frontend.components.header-menu')
        <div class="circle-wrapper-block">
            <div class="inner-circle"></div>

            <div class="container circle-content p-0">


                <form class="reset-form" action="{{url('/reset-password')}}" method="post" id="form">
                    @csrf

                    <h3 class="font-64-lh-75-semi-bold text-white text-center text-nowrap mt-4 mb-2">{{__('New Password')}}</h3>

                    <div class="form-group text-right">
                        <label class="d-block text-white font-14-lh-16-light mt-4" id="password-label">
                            {{__('Password')}}
                            <span class="float-left">
                                <a href="javascript:void(0);" class="text-warning show-text">
                                    <p id='text'>{{__('Show')}}</p>
                                    <i id='icon' class="fas eye-open mr-2"></i>
                                </a>
                            </span>
                        </label>
                        <input type="password" name="password" data-rule="password" maxlength="30" id="password-input"
                               class="form-control text-right font-14-lh-16-light show-input" placeholder="{{__('****************')}}">
                        @error('password')
                        <div class="center-error">
                            <p class="error-p-new-pass padding-p">{{__($message)}}</p>
                        </div>
                        @enderror
                        {{-- <div class="tooltip password-tooltip font-16-lh-19-regular">
                            يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
                        </div> --}}
                    </div>

                    <div class="form-group text-right">
                        <label class="d-block text-white font-14-lh-16-light" id="password-confirm-label">
                            {{__('Confirm Password')}}
                            {{-- <span class="float-left">--}}
                                {{-- <a href="javascript:void(0);" class="text-warning show-text">--}}
                                    {{-- <p id='text'>{{__('Show')}}</p>--}}
                                    {{-- <i id='icon' class="fas eye-open mr-2"></i>--}}
                                    {{-- </a>--}}
                                {{-- </span>--}}
                        </label>
                        <input type="password" name="password_confirmed" maxlength="30" data-rule="password-confirm" id="password-confirm"
                               class="form-control text-right font-14-lh-16-light show-input" placeholder="{{__('****************')}}">
                        @error('password_confirmed')
                        <div class="center-error">
                            <p class="error-p-new-pass padding-p">{{__($message)}}</p>
                        </div>
                        @enderror
                        {{-- <div class="tooltip password-tooltip font-16-lh-19-regular">
                            يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
                        </div> --}}
                        {{-- <p id='msg'></p>--}}
                        <input type="hidden" name="token" value="{{$token}}">
                        {{-- <input type="hidden" id="confirmed" name="password_confirmed">--}}
                    </div>
                    <p class="error-p" id="message"></p>

                    <div class="form-group text-center mt-3">
                        <button type="submit" onclick='checkPassword()' class="btn btn-warning btn-md font-24-lh-28-medium" id="submit-button">
                            {{__('Reset Password')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @include('frontend.components.loader')
        <script>
            let inputs = document.querySelectorAll('input[data-rule]');
    let password_min_message = "{{__('Password must be at least 8 characters long')}}";
    let passwords_match = "{{__('Passwords match')}}";
    let passwords_not_match = "{{__('Passwords dont match')}}";

    const buttonD = document.querySelector('.btn-warning')

    buttonD.disabled = true

    for(let input of inputs){
        input.addEventListener('blur' , function (){
            let password = document.getElementById("password-input").value;
            let cnfrmPassword = document.getElementById("password-confirm").value;
            let message = document.getElementById("message");
            let check;

            this.classList.remove('invalid');
            this.classList.remove('valid');

            if(password.length != 0 && password.length >= 8){
                if(password == cnfrmPassword){
                    let pass = document.querySelector('#password-input');
                    let cnfrmp = document.querySelector('#password-confirm');

                    message.classList.remove('padding-p');
                    message.textContent = '';
                    buttonD.disabled = false;
                    message.style.backgroundColor = "#f48a1d";

                    pass.classList.add('valid')
                    cnfrmp.classList.add('valid')
                }else{
                    message.classList.add('padding-p');
                    message.textContent = passwords_not_match;
                    buttonD.disabled = true;
                    message.style.backgroundColor = "#f48a1d";

                    pass.classList.add('invalid')
                    cnfrmp.classList.add('invalid')
                }
            }else{
                message.classList.add('padding-p');
                message.textContent = password_min_message;
                message.style.backgroundColor = "#f48a1d";
            }

            if(check){
                this.classList.add('valid');
            }else{
                this.classList.add('invalid');
            }

        });
    }

        </script>

        @if (env('APP_ENV') == 'staging')
        @extends('layout.language-picker')
        @endif

        <script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>
        <script type="text/javascript" src="{!!asset('assets/js/popper.min.js')!!}"></script>
        <script type="text/javascript" src="{!!asset('assets/js/bootstrap.min.js')!!}"></script>
        <script type="text/javascript" src="{!!asset('js/components/auth.js')!!}"></script>
        <script>
            const googleAuthUrl = "{{route('auth.google')}}";
    const linkedInAuthUrl = "{{route('auth.linkedIn')}}";
    const appleAuthUrl = "{{route('auth.apple')}}";
        </script>
        <script>
            $('navbar-nav li.dropdown').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });

    // $(".float-left a.text-warning").click(function () {
    //     $(this).find('i').toggleClass("eye-close");
    //     input = $(this).parent().parent().parent().find("input");
    //     if (input.attr("type") == "password") {
    //         input.attr("type", "text");
    //     } else {
    //         input.attr("type", "password");
    //     }
    // });

    // form validation

    const passwordTooltip = document.querySelector('.password-tooltip');
    const password = document.querySelector('#password-input');
    const submitButton = document.querySelector('#submit-button');

    submitButton.addEventListener('click', submitHandler);
    password.addEventListener('focus', removePasswordTooltip);
    password.addEventListener('blur', validatePassword);

    function removePasswordTooltip() {
        passwordTooltip.classList.remove('show-tooltip');
    }

    function isPasswordValid() {
        return password.value.length;
    }

    function validatePassword() {
        if (!isPasswordValid()) {
            passwordTooltip.classList.add('show-tooltip');
        }
        ;
    }

    function submitHandler(event) {
        validatePassword();
    };
        </script>
        <script>
            function checkPassword(){
  let password = document.querySelector('#password-input').value;
  let cnfrm = document.querySelector('#password-confirm').value;
  let confirmed = document.querySelector('#confirmed');
  console.log(password, cnfrm);
  let message = document.querySelector('#msg')
  if (password.length != 0){
    if( password == cnfrm){
      message.textContent = 'Passwords Match';
      message.style.backgroundColor = '#3ae374'
      confirmed.value = true
    }
    else {
      message.textContent = "Passwords don't match";
      message.style.backgroundColor = '#ff4d4d'
        confirmed.value = false
    }
  }
}
        </script>
        <script>
            $('navbar-nav li.dropdown').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });

    $(".float-left a.text-warning").click(function () {
        $(this).find('i').toggleClass(" eye-close");
        input = $('.show-input');
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    // form validation
    $(document).ready(() => {
        $('.header-menu-middle-side')[0].setAttribute('style', 'visibility: visible')
    })
    $('.email').change(function() {
        $('.email-error').hide();
    });
    $('.password').change(function() {
        $('.password-error').hide();
    });
        </script>
        <script>
            const textShow = document.querySelector('#text');
    const icon = document.querySelector('#icon');
    const wrap = document.querySelector('.float-left');

    function changeText() {
        if(icon.classList.contains('eye-close')){
            textShow.textContent = "{{__('Hide')}}"
        }else {
            textShow.textContent = "{{__('Show')}}"
        }
    }
    wrap.addEventListener('click', changeText);
        </script>
    </body>
    @include('frontend.components.footer')
    @include('frontend.components.cookie')

</html>