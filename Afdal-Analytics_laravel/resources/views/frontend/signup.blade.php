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
    <link rel="icon" type="image/png" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
    <link href="{!!asset('assets/css/bootstrap.min.css')!!}" rel="stylesheet">
    <link href="{!!asset('assets/css/style.css')!!}" rel="stylesheet">

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-54B2DBW');</script>
    <!-- End Google Tag Manager -->

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

        .form-check-input:checked {
            background-color: #f48a1d;
            border: 1px solid #f48a1d;
        }

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
            
            .sign-up-page .form-check-input {
                margin-left: -1.28rem!important;
            }
            
            .ml-15-en{
                margin-left:15px!important;
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
<body class="sign-up-page">
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-54B2DBW"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
@include('frontend.components.header-menu')
<div class="sign-up-4k">
    <div class="circle-wrapper-block">
        <div class="inner-circle signup-inner"></div>

        <div class="container mr-cont circle-content p-0">
            @if ($message = Session::get('success'))
                <div class="w-100 p-2">
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
        </div>
        @endif
        <form class="sign-up-form" action="{{url('register')}}" method="post" name="signupForm">
            @csrf

            <h3 class="sign-up-title font-64-lh-135-semi-bold text-white text-center text-nowrap">{{__('Sign Up')}}</h3>
            <p class="sign-up-subtitle text-center text-white signup-page-link-signin sign-up-sub signup-rev font-20-lh-42-semi-bold">
                {{__('Already have an account?')}}
                <a href="{{ url('login') }}" class="text-white sign-in-link ">
                    <u style="color:#f48a1d;margin-inline-start: 5px;">
                        {{__('Login')}}
                    </u>
                </a>
            </p>
            <div class="forms-container">
                <div class="forms-wrapper small text-right">

                    <label class="d-block text-white font-14-lh-30-medium text-left-en">{{__('First Name')}} <span
                            class='signup-star'>*</span></label>
                    <input type="text" name="first_name" maxlength="50" data-rule="first-name"
                           class="form-input first_name text-right text-left-en font-14-lh-30-light mb-3"
                           placeholder="{{__('Name ')}}" value="{{old('first_name')}}"
                           oninput="onFieldInput('first_name', this)">
                    @error('first_name')
                    <div class="center-error"><p class="error-p padding-p">{{__($message)}}</p></div>
                    {{--                    /<div class="tooltip first_name first_name-error font-30-lh-19-regular validation-page">{{__($message)}}</div>--}}
                    @enderror
                </div>
                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-30-medium text-left-en">{{__('Last Name')}} <span
                            class='signup-star'>*</span></label>
                    <input type="text" name="last_name" maxlength="50" data-rule="last-name"
                           class="form-input last_name text-right text-left-en font-14-lh-30-light mb-3"
                           placeholder="{{__('Surname')}}" value="{{old('last_name')}}"
                           oninput="onFieldInput('last_name', this)">

                    @error('last_name')
                    <div class="center-error"><p class="error-p padding-p">{{__($message)}}</p></div>
                    {{--                        <div class="tooltip last_name last_name-error font-30-lh-19-regular validation-page">{{__($message)}}</div>--}}
                    @enderror
                </div>
            </div>
            <div class="forms-wrapper big text-right">
                <label class="d-block text-white font-14-lh-30-medium text-left-en">{{__('Email')}} <span
                        class='signup-star'>*</span></label>
                <input type="text" name="email" data-rule="email" maxlength="40"
                       class="form-input email text-right text-left-en font-14-lh-30-light mb-3"
                       placeholder="email@companyexample.com" value="{{old('email')}}"
                       oninput="onFieldInput('email', this)">

                @error('email')
                <div class="center-error"><p class="error-p padding-p">{{__($message)}}</p></div>
                {{--                <div class="tooltip email email-error font-30-lh-19-regular validation-page">{{__($message)}}</div>--}}
                @enderror
            </div>
            <div class="forms-container">


                <div class="forms-wrapper big-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-30-medium text-left-en">{{__('Position')}} <span
                            class='signup-star'>*</span></label>
                    <input name="working_as" type="hidden" id="role" value="{{old('working_as')}}">
                    <div id='select-role' class="role-selector font-14-lh-30-light role-selector-part mb-3">
                        <div class="role-selector-value role-selector-part">{{__('Choose Your Profession')}}</div>
                        <div id='role-icon' class="role-selector-icon role-selector-part"></div>
                        <ul id='list-role' class="role-selector-list hidden role-selector-part">
                            <li class="role-selector-list-item role-selector-part text-left-en ml-15-en">{{__('Social Media Manager')}}</li>
                            <li class="role-selector-list-item role-selector-part text-left-en ml-15-en">{{__('Marketing Manager')}}</li>
                            <li class="role-selector-list-item role-selector-part text-left-en ml-15-en">{{__('Developer')}}</li>
                            <li class="role-selector-list-item role-selector-part text-left-en ml-15-en">{{__('Other')}}</li>
                        </ul>
                    </div>
                    @error('working_as')
                    <div class="center-error"><p class="error-p padding-p">{{__($message)}}</p></div>
                    {{--                    <div class="tooltip working_as working_as-error font-30-lh-19-regular validation-page">{{__($message)}}</div>--}}
                    @enderror
                </div>

                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-30-medium text-left-en">{{__('Company')}} <span
                            class='signup-star'>*</span></label>
                    <input type="text" name="company" maxlength="40" data-rule="company"
                           class="form-input company text-right text-left-en font-14-lh-30-light mb-3"
                           placeholder="{{__('Company Name')}}" value="{{old('company')}}"
                           oninput="onFieldInput('company', this)">

                    @error('company')
                    <div class="center-error"><p class="error-p padding-p">{{__($message)}}</p></div>
                    {{--                    <div class="tooltip company company-error font-30-lh-19-regular validation-page">{{__($message)}}</div>--}}
                    @enderror
                </div>

            </div>
            <div class="forms-container">

                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-30-medium text-left-en">{{__('Password')}} <span class='signup-star'>*</span></label>
                    <input type="password" maxlength="30" name="password" id="password"
                           class="form-input password text-right text-left-en font-14-lh-30-light mb-3"
                           placeholder="{{__('Password')}}" oninput="onFieldInput('password', this)" onkeyup='check();'>
                    @error('password')
                    <p class="error-p padding-p">{{__($message)}}</p>
                    {{--                    <div class="tooltip password password-error font-30-lh-19-regular validation-page">{{__($message)}}</div>--}}
                    @enderror
                </div>

                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-30-medium text-left-en">
                        {{__('Confirm Password')}}<span class='signup-star'>*</span>
                        <span class="float-left">
                            <a href="javascript:void(0);" class="text-warning show-text font-14-lh-30-light" style="position: absolute; right: 0px; top: 57px;">
                                <p id='text'></p>
                                <i id='icon' class="fas eye-open mr-2"></i>
                            </a>
                        </span>
                    </label>
                    <input type="password" maxlength="30" name="confirm_password" id="confirm_password"
                           class="form-input cnf-password text-right text-left-en font-14-lh-30-light mb-3"
                           placeholder="{{__('Confirm Password')}}" onkeyup='check();'>
                    @error('confirm_password')
                    <p class="error-p padding-p">{{__($message)}}</p>
                    {{--                    <div class="tooltip password password-error tooltip password password-error font-16-lh-19-regular validation-page">{{__($message)}}</div>--}}
                    @enderror
                </div>
            </div>
            <p class="error-p" id="message"></p>

            <div class="forms-wrapper big form-check text-right  align-items-center">
                <input type="checkbox" name="terms" class="form-check-input d-block" id="exampleCheck1 mb-3" required>
                <label class="form-check-label signup-form-check-label text-white font-14-lh-30-medium "
                       for="exampleCheck1">{{__('I agree to the terms and conditions of')}} <a class="text-warning"
                                                                                               href="{{ url('privacy-policy') }}"
                                                                                               target="_blank">{{__('Privacy Policy')}}</a> {{__('and')}}
                    <a class="text-warning" href="{{ url('cookie-policy') }}"
                       target="_blank">{{__('Cookie Policy')}}</a></label>
            </div>

            <div class="forms-wrapper text-center">
                <button type="submit" class="sign-up-btn btn btn-warning btn-md font-24-lh-28-medium" style="width: 534px;">
                    {{__('Sign Up')}}
                </button>
            </div>
        </form>
    </div>
    <div class="row mt-up mob-mt signup-auth-service mb-3">
        @include('frontend/components/auth-services')
    </div>
</div>
@include('frontend.components.footer')
</div>
@include('frontend.components.cookie')
@include('frontend.components.loader')
<script>

    let inputs = document.querySelectorAll('input[data-rule]');
    let password_min_message = "{{__('Password must be at least 8 characters long')}}";
    let passwords_match = "{{__('Passwords match')}}";
    let passwords_not_match = "{{__('Passwords dont match')}}";
    let validate_interaval = false;

    for (let input of inputs) {
        input.addEventListener('keyup', function () {
            if (validate_interaval)
                clearTimeout(validate_interaval);
            validate_interaval = setTimeout(() => {
                let rule = this.dataset.rule;
                let value = this.value;
                let check;

                switch (rule) {
                    case "first-name":
                        check = /^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z ]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]*$/.test(value);
                        break;
                    case "last-name":
                        check = /^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z ]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]*$/.test(value);
                        break;
                    case "company":
                        check = /^[.@&]?[a-zA-Z0-9 ]+[ !.@&()]?[ a-zA-Z0-9!()]+/.test(value);
                        break;
                    case "email":
                        check = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))+$/.test(value);
                        break;
                }

                this.classList.remove('invalid');
                this.classList.remove('valid');

                // let password = document.getElementById("password").value;
                // let cnfrmPassword = document.getElementById("confirm-password").value;
                // let message = document.getElementById("message");
                //
                // if (password.length != 0 && password.length >= 8) {
                //     if (password == cnfrmPassword) {
                //         let pass = document.querySelector('#password');
                //         let cnfrmp = document.querySelector('#confirm-password');
                //         message.textContent = '';
                //         // message.style.backgroundColor = "#f48a1d";
                //
                //         pass.classList.add('valid')
                //         cnfrmp.classList.add('valid')
                //     } else {
                //         message.textContent = passwords_not_match;
                //         // message.style.backgroundColor = "#f48a1d";
                //
                //         pass.classList.add('invalid')
                //         cnfrmp.classList.add('invalid')
                //     }
                // } else {
                //     message.textContent = password_min_message;
                //     // message.style.backgroundColor = "#f48a1d";
                // }

                if (check) {
                    this.classList.add('valid');
                } else {
                    this.classList.add('invalid');
                }
                validate_interaval = false;
            }, 1000);

        });
    }

    var check = function () {
        let password = document.getElementById("password").value;
        let cnfrmPassword = document.getElementById("confirm_password").value;
        let message = document.getElementById("message");

        let pass = document.querySelector('#password');
        let cnfrmp = document.querySelector('#confirm_password');

        if (password.length != 0 && password.length >= 8) {
            if (password == cnfrmPassword) {

                message.classList.remove('padding-p');
                message.textContent = '';
                // message.style.backgroundColor = "#f48a1d";

                pass.classList.remove('invalid')
                cnfrmp.classList.remove('invalid')

                pass.classList.add('valid')
                cnfrmp.classList.add('valid')
            } else {
                message.classList.add('padding-p');
                message.textContent = passwords_not_match;
                // message.style.backgroundColor = "#f48a1d";

                pass.classList.add('invalid')
                cnfrmp.classList.add('invalid')
            }
        } else {
            pass.classList.add('invalid')
            cnfrmp.classList.add('invalid')

            message.classList.add('padding-p');
            message.textContent = password_min_message;
            // message.style.backgroundColor = "#f48a1d";
        }
    }

    const buttonD = document.querySelector('.btn-warning');
    const password = document.querySelector('.password');
    const cnfrm = document.querySelector('.cnf-password');

    buttonD.disabled = true;

    password.addEventListener("change", stateHandle);
    cnfrm.addEventListener("change", stateHandle);

    function stateHandle() {
        if (password.value.length >= 8 || cnfrm.value >= 8) {
            buttonD.disabled = false;
        } else {
            buttonD.disabled = true;
        }
    }
</script>
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
    const roleSelector = document.querySelector('.role-selector');
    const roleSelectorList = document.querySelector('.role-selector-list');
    const roleSelectorListItems = document.querySelectorAll('.role-selector-list-item');
    const roleSelctorValue = document.querySelector('.role-selector-value');
    const emptyinner = document.querySelector('.sign-up-4k');
    const formRoleValue = document.querySelector('#role');
    const list = document.querySelector('#list-role');
    const iconAr = document.querySelector('#role-icon');

    updateSelector();

    roleSelector.addEventListener('click', roleSelectorClickHandler);
    roleSelectorListItems.forEach(item => {
        item.addEventListener('click', roleSelectorItemClickHandler);
    });

    function roleSelectorClickHandler(event) {
        roleSelectorList.classList.toggle('hidden');

        if (!roleSelectorList.classList.contains('hidden')) {
            emptyinner.addEventListener('click', hideSelectorList);
            iconAr.classList.add('role-rotate-icon')
        }

        // console.log(roleSelectorList.classList.contains('hidden'));
        // console.log(formRoleValue.value);
        if (roleSelectorList.classList.contains('hidden') && formRoleValue.value === '') {
            roleSelector.classList.add('invalid');
        } else {
            roleSelector.classList.remove('invalid');
            roleSelector.classList.add('divvalid');
        }
    }

    function hideSelectorList(event) {
        if (event.target.closest('.role-selector')) {
            return;
        }

        roleSelectorList.classList.add('hidden');
        emptyinner.removeEventListener('click', hideSelectorList)
        iconAr.classList.remove('role-rotate-icon');
    }

    function roleSelectorItemClickHandler(event) {
        roleSelctorValue.textContent = event.currentTarget.textContent;
        roleSelctorValue.style.color = '#000';
        formRoleValue.value = event.currentTarget.textContent;
    };

    function updateSelector() {
        if (formRoleValue.value) {
            roleSelctorValue.textContent = formRoleValue.value;
            roleSelctorValue.style.color = '#000';
        }
    }

    function onFieldInput(type, inputElem) {
        const regex = /\s\s+/g;
        if (regex.test(inputElem.value)) {
            $(`.${type}`)[0].value = inputElem.value.replace(regex, ' ');
        }
    }

    $('navbar-nav li.dropdown').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });

    $(".float-left a.text-warning").click(function () {
        $(this).find('i').toggleClass(" eye-close");
        input = $(this).parent().parent().parent().parent().find("input");
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $(document).ready(() => {
        $('.header-menu-middle-side')[0].setAttribute('style', 'visibility: visible')
    })
    $('.last_name').change(function () {
        $('.last_name-error').hide();
    });
    $('.first_name').change(function () {
        $('.first_name-error').hide();
    });
    $('.email').change(function () {
        $('.email-error').hide();
    });
    $('#role').change(function () {
        $('.working_as-error').hide();
    });
    $('.company').change(function () {
        $('.company-error').hide();
    });
    $('.password').change(function () {
        $('.password-error').hide();
    });
</script>
<script>
    const textShow = document.querySelector('#text');
    const icon = document.querySelector('#icon');
    const wrap = document.querySelector('.float-left');

    function changeText() {
        if (icon.classList.contains('eye-close')) {
            textShow.textContent = ""
        } else {
            textShow.textContent = ""
        }
    }

    wrap.addEventListener('click', changeText);
</script>
</body>
</html>
