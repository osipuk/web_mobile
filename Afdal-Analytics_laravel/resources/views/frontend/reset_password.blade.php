<!DOCTYPE html>

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

        /*input[data-rule] {*/
        /*    border: 2px solid red;*/
        /*}*/
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
@extends('layout.userhead')

<body class="forgotpass-page">
    @include('frontend.components.header-menu')
    <div class="reset-4k">
        <div class="circle-wrapper-block">
            <div class="inner-circle "></div>
            <div class="container circle-content p-0">
                <form class="forgotpass-form" action="{{url('/forget-password')}}" method="post" id="form">
                    @csrf

                    <h3 class="font-64-lh-75-semi-bold text-white text-center text-nowrap text-wrap mt-4 mb-2">{{__('Reset password')}}</h3>
                    <p class="text-center text-white forgotpass-page-link-signup forgotpass-sub font-20-lh-30-medium">
                        {{__('Enter your email and we will send you instructions on how to reset your password.')}}
                    </p>

                    <div class="form-group text-right text-left-en">
                        <label class="d-block text-white font-14-lh-16-light mt-4 pr-3">{{__('Email')}}</label>
                        <input type="text" name="email" id="email" maxlength="40" data-rule="email" class="form-control text-left-en font-14-lh-16-light"
                               placeholder="{{__('email@example.com')}}">
                        @error('email')
                        <div class="center-error">
                            <p class="error-p-reset padding-p">{{__($message)}}</p>
                        </div>
                        {{-- <div class="tooltip email-tooltip font-16-lh-19-regular">--}}
                            {{-- {{$message}}--}}
                            {{-- </div>--}}
                        @enderror
                    </div>

                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-warning btn-md font-24-lh-28-medium" id="submit-button">{{__('Send Instructions')}}</button>
                    </div>
                    <p class="text-center text-white signin-page-link-signup sign-in-forgotpass font-17-lh-20-regular">
                        <a href="{{ url('login') }}" class="text-white sign-up-link">
                            <u style="color:#f48a1d;">{{__('Sign In')}}</u>
                        </a>
                        {{__('Back to')}}
                    </p>
                </form>
            </div>
        </div>
    </div>
    @include('frontend.components.loader')
    <script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        let successMessage = "{{Session::get('success')}}";
    let errorMessage = @error('email')'{{$message}}'@enderror
    document.body.onload = function () {
        if(successMessage){
            toastr.success(successMessage);
        }
    }

    let inputs = document.querySelectorAll('input[data-rule]');
    let password_min_message = "{{__('Password must be at least 8 characters long')}}";
    let passwords_match = "{{__('Passwords match')}}";
    let passwords_not_match = "{{__('Passwords dont match')}}";
    let validate_interaval = false;

    for(let input of inputs){
        input.addEventListener('keyup' , function (){
            if(validate_interaval)
                clearTimeout(validate_interaval);
            validate_interaval = setTimeout(()=>{
            let rule = this.dataset.rule;
            let value = this.value;
            let check;


            switch (rule){
                case "email":
                    check = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))+$/.test(value);
                    break;
            }

            this.classList.remove('invalid');
            this.classList.remove('valid');

            if(check){
                this.classList.add('valid');
            }else{
                this.classList.add('invalid');
            }
            validate_interaval = false;
            }, 1000);

        });
    }

 const buttonD = document.querySelector('.btn-warning');
 let email = document.querySelector('#email');

 buttonD.disabled = true

email.addEventListener('keyup', () =>{
if (email.value.length > 3) {buttonD.disabled = false}
else buttonD.disabled = true
})
    </script>

    @if (env('APP_ENV') == 'staging')
    @extends('layout.language-picker')
    @endif

    <script type="text/javascript" src="{!!asset('assets/js/popper.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('assets/js/bootstrap.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('js/components/auth.js')!!}"></script>
    <script>
        const googleAuthUrl = "{{route('auth.google')}}";
    const linkedInAuthUrl = "{{route('auth.linkedIn')}}";
    const appleAuthUrl = "{{route('auth.apple')}}";
    </script>
</body>
@include('frontend.components.footer')
@include('frontend.components.cookie')

</html>