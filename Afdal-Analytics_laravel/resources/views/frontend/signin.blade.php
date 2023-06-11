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
<html lang="ar" dir="{{ $get_locale == 'ar' ? 'rtl':'ltr' }}"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{!empty($seo->title) ? $seo->title : ''}}</title>
    <meta name="description" content="{{!empty($seo->description) ? $seo->description : ''}}">
    <meta name="keywords" content="{{!empty($seo->keywords) ? $seo->keywords : ''}}">
    <meta name="author" content="{{!empty($seo->author) ? $seo->author : ''}}">
{{--    <meta name="_token" content="{{ csrf_token() }}">--}}
    <link rel="icon" type="image/png" href="">
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{!!asset('assets/css/bootstrap.min.css')!!}" rel="stylesheet">
    <link href="{!!asset('assets/css/style.css')!!}" rel="stylesheet"> -->
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('css/app.css') }}"></noscript>
    <style>
        body {
            overflow-x: hidden;
        }

        input::-ms-reveal,
        input::-ms-clear {
        display: none;
      }

        .form-check-input {
            position: absolute;
            margin-top: 0rem;
            width: 1.3em;
            height: 1.3em;
            background-color: white;
            border-radius: 4px;
            vertical-align: middle;
            border: 1px solid #ddd;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #f48a1d;
            border: 1px solid #f48a1d;
        }

        input[data-rule].valid {
            border: 2px solid green !important;
        }

        /*input[data-rule] {*/
        /*    border: 2px solid red;*/
        /*}*/

    </style>

    @if($get_locale == 'en')
        <style type="text/css">
            .text-left-en{
                text-align: left!important;
            }

            .float-left{
                float: right!important;
            }

            .float-right-en{
                float: right;
                margin-right: 0px;
            }
        </style>
    @endif

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

{{--   @extends('layout.userhead')--}}

<body class="signin-page">
@include('frontend.components.header-menu')
<div class="sign-in-4k">
<div class="circle-wrapper-block">
    <div class="inner-circle signin-circle"></div>

    <div class="container circle-content p-0">
        @if ($message = Session::get('success'))
            <div class="w-100 p-2">
                <div class="alert alert-success alert-block mb-0">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="w-100 p-2">
                <div class="alert alert-danger alert-block mb-0">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
        @endif
        <form class="signin-form" action="{{url('login')}}" method="post" id="form">
            @csrf

            <h3 class="sign-in-title font-64-lh-135-semi-bold text-white text-center text-nowrap mt-4 mb-2">{{__('Sign In')}}</h3>
            <p class="sign-in-subtitle text-center text-white signin-page-link-signup sign-in-sub font-20-lh-42-semi-bold">
                <a href="{{ url('signup') }}" class="text-white sign-up-link">
                    <u style="color:#f48a1d; text-decoration: none;">{{__('Sign up')}}</u>
                </a>
                {{__('New to Afdal Analytics?')}}
            </p>

            <div class="form-group signin-ch text-right">
                <label class="d-block text-white font-14-lh-16-light text-left-en">{{__('Email')}}/{{__('Phone')}}</label>
                <input type="text" required name="email" maxlength="40" id="email" data-rule="email" class="form-control text-right font-14-lh-16-light text-left-en"
                       placeholder="{{__('Email')}}/{{__('Phone')}}">
                <div class="tooltip email-tooltip font-16-lh-19-regular">
                    يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
                </div>
            </div>

            <div class="form-group signin-ch text-right">
                <label class="d-block text-white font-14-lh-16-light text-left-en" id="password">
                    {{__('Password')}}
                    <span class="float-left">
                        <a href="javascript:void(0);" class="text-warning show-text" style="position: absolute; right: 0px; top: 36px; z-index: 99999;">
                          <p id='text'></p>
                          <i id='icon' class="fas eye-open mr-2"></i>
                        </a>
                    </span>
                </label>
                <input type="password" required name="password" maxlength="30" data-rule="password"
                      class="form-control password text-right font-14-lh-16-light text-left-en" placeholder="{{__('****************')}}">
                      @error('password')
                <div class="tooltip password-tooltip font-16-lh-19-regular">{{__($message)}}</div>
                @enderror
            </div>

            <div class="form-group signin-ch form-check text-right text-left-en mt-2">
                <input type="checkbox" name="terms" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label signin-form-check-label text-white font-14-lh-16-light"
                       for="exampleCheck1">{{__('Keep me signed in.')}}


                   </label>

                   <a href="{{ url('reset-password') }}" class="text-white sign-up-link float-right-en">
                    <u style="color:#f48a1d; text-decoration: none;">{{__('Forgot your password?')}}</u>
                </a>
            </div>


            <div class="text-center">
                <button type="submit" style="width: 380px;" class="sign-in-btn btn btn-warning btn-md font-24-lh-28-medium"
                        id="submit-button">{{__('Sign In')}}</button>
            </div>
  
        </form>
    </div>
    <div class="row mt-3 signin-auth-service">
        @include('frontend/components/auth-services-login')
    </div>
</div>
@include('frontend.components.footer')
</div>
@include('frontend.components.cookie')
@include('frontend.components.loader')
<script>
    let message = '{{$mess}}';
    window.onload = function(){
        if(message !== null && message !== ''){
            toastr.success(message);
        }
    }
    let inputs = document.querySelectorAll('input[data-rule]');
    let validate_interaval = false;

    // for(let input of inputs){
    //     input.addEventListener('keyup' , function (){
    //         if(validate_interaval){
    //             clearTimeout(validate_interaval);
    //         }
    //         validate_interaval = setTimeout(()=>{
    //             let rule = this.dataset.rule;
    //             let value = this.value;
    //             let check;
    //             switch (rule){
    //                 case "email":
    //                     check = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))+$/.test(value);
    //                     break;
    //                 case "password":
    //                     check = /^.{8,}$/.test(value);
    //                     break;
    //             }

    //             this.classList.remove('invalid');
    //             this.classList.remove('valid');

    //             if(check){
    //                 this.classList.add('valid');
    //             }else{
    //                 this.classList.add('invalid');
    //             }
    //             validate_interaval = false;
    //         }, 1000);

    //     });
    // }
</script>
<script>
    const buttonD = document.querySelector('.btn-warning')
    let password = document.querySelector('.password')

    // buttonD.disabled = true;

password.addEventListener('keyup', () =>{
if (password.value.length >= 6) {
    buttonD.disabled = false
}else buttonD.disabled = true})

</script>

@if (env('APP_ENV') == 'staging')
    @extends('layout.language-picker')
@endif
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{!!asset('assets/js/popper.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('assets/js/bootstrap.min.js')!!}"></script> -->
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

    $(".float-left a.text-warning").click(function () {
        $(this).find('i').toggleClass(" eye-close");
        input = $(this).parent().parent().parent().find("input");
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
    textShow.textContent = ""
  }else {
     textShow.textContent = ""
  }
}
wrap.addEventListener('click', changeText);
</script>
</body>
</html>
