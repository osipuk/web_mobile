<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
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
            margin-left: -1.25rem;
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

        .error-p {
            font-size: 14px;
            display: inline-block;
            color: white;
            border-radius: 10px;
            padding-left: 10px;
            padding-right: 10px;
            margin-bottom: 10px;
            background: #f48a1d;
            white-space: nowrap;
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
<body class="sign-up-page">
@include('frontend.components.header-menu')
<div class="circle-wrapper-block">
    <div class="inner-circle service"></div>

    <div class="container mr-cont circle-content p-0">
        @if ($message = Session::get('success'))
            <div class="w-100 p-2">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="w-100 p-2">
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
        @endif
        <form class="sign-up-form" action="{{url('register-service')}}" method="post">
            @csrf

            <h3 class="font-64-lh-75-semi-bold mt-3 text-white text-center text-nowrap mt-4 mb-2">{{__('Sign Up')}}</h3>
            <p class="text-center mb-5 text-white signup-page-link-signin sign-up-sub signup-rev font-20-lh-30-medium">
                {{__('Already an user?')}}
                <a href="{{ url('login') }}" class="text-white sign-in-link ">
                    <u style="color:#f48a1d; text-decoration: none;">
                        {{__('Sign in')}}
                    </u>
                </a>
            </p>

            <div class="forms-container">
                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-16-light">{{__('Company')}}</label>
                    <input type="text" name="company" data-rule="company" class="form-input company text-right font-14-lh-16-light mb-3"
                           placeholder="{{__('Company Name')}}" value="{{old('company')}}"
                           oninput="onFieldInput('company', this)">

                    @error('company')
                    <div class="tooltip company company-error font-16-lh-19-regular">{{__($message)}}</div>
                    @enderror
                </div>

                <div class="forms-wrapper big-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-16-light">{{__('Role')}}</label>
                    <input name="working_as" type="hidden" id="role" value="{{old('working_as')}}">
                    <div id='select-role' class="role-selector font-14-lh-16-light role-selector-part">
                        <div class="role-selector-value role-selector-part">{{__('Role Choice Dropdown')}}</div>
                        <div id='role-icon' class="role-selector-icon role-selector-part"></div>
                        <ul id='list-role' class="role-selector-list hidden role-selector-part">
                            <li class="role-selector-list-item role-selector-part">{{__('Social Media Manager')}}</li>
                            <li class="role-selector-list-item role-selector-part">{{__('Marketing Manager')}}</li>
                            <li class="role-selector-list-item role-selector-part">{{__('Developer')}}</li>
                            <li class="role-selector-list-item role-selector-part">{{__('Other')}}</li>
                        </ul>
                    </div>
                    @error('working_as')
                    <div class="tooltip working_as working_as-error font-16-lh-19-regular">{{__($message)}}</div>
                    @enderror
                </div>
            </div>
            <div class="forms-container">
                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-16-light">{{__('Password')}}</label>
                    <input type="password" name="password" id="password" class="form-input password text-right font-14-lh-16-light"
                           placeholder="{{__('Password')}}" oninput="onFieldInput('password', this)" onkeyup='check();'>
                    @error('password')
                    <div class="tooltip password password-error font-16-lh-19-regular">{{__($message)}}</div>
                    @enderror
                </div>

                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-16-light">
                        {{__('Confirm Password')}}
                        <span class="float-left">
                            <a href="javascript:void(0);" class="text-warning show-text font-14-lh-16-light">
                                <p id='text'>{{__('Show')}}</p>
                                <i id='icon' class="fas eye-open mr-2"></i>
                            </a>
                        </span>
                    </label>
                    <input type="password" name="confirm-password" id="confirm-password"
                           class="form-input cnf-password text-right font-14-lh-16-light"
                           placeholder="{{__('Confirm Password')}}" onkeyup='check();'>
                    @error('password')
                    <div class="tooltip password password-error font-16-lh-19-regular">{{__($message)}}</div>
                    @enderror
                </div>
            </div>
            <p class="error-p" id="message"></p>
            <div class="forms-wrapper big form-check text-right  align-items-center">
                <input type="checkbox" name="terms" class="form-check-input d-block" id="exampleCheck1 mb-3" required>
                <label class="form-check-label text-white font-14-lh-16-light "
                       for="exampleCheck1">{{__('I agree to the terms and conditions of')}} <a class="text-warning" href="{{ url('privacy-policy') }}" target="_blank">{{__('Privacy Policy')}}</a> {{__('and')}} <a class="text-warning" href="{{ url('cookie-policy') }}" target="_blank">{{__('Cookie Policy')}}</a></label>
            </div>

            <div class="forms-wrapper text-center mt-3">
                <button type="submit" class="sign-up-btn btn btn-warning btn-md font-24-lh-28-medium">
                    {{__('Sign Up')}}
                </button>
            </div>
        </form>
    </div>
</div>
<div class='loader-wrap'>
    <div id="main-loader" class="preloader">
        <div class="loading"></div>
        <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>
    </div>
</div>
<script>
    let inputs = document.querySelectorAll('input[data-rule]');
    let password_min_message = "{{__('Password must be at least 8 characters long')}}";
    let passwords_match = "{{__('Passwords match')}}";
    let passwords_not_match = "{{__('Passwords dont match')}}";

    for(let input of inputs){
        input.addEventListener('blur' , function (){
            let rule = this.dataset.rule;
            let value = this.value;
            let check;


            switch (rule){
                case "company":
                    check = /^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]*$/.test(value);
                    break;
            }

            this.classList.remove('invalid');
            this.classList.remove('valid');


            // if(password.length != 0 && password.length >= 8){
            //     if(password == cnfrmPassword){
            //         let pass = document.querySelector('#password');
            //         let cnfrmp = document.querySelector('#confirm-password');
            //         message.textContent = '';
            //         message.style.backgroundColor = "#f48a1d";
            //
            //         pass.classList.add('valid')
            //         cnfrmp.classList.add('valid')
            //     }else{
            //         message.textContent = passwords_not_match;
            //         message.style.backgroundColor = "#f48a1d";
            //
            //         pass.classList.add('invalid')
            //         cnfrmp.classList.add('invalid')
            //     }
            // }else{
            //     message.textContent = password_min_message;
            //     message.style.backgroundColor = "#f48a1d";
            // }

            if(check){
                this.classList.add('valid');
            }else{
                this.classList.add('invalid');
            }

        });
    }

    var check = function (){
        let password = document.getElementById("password").value;
        let cnfrmPassword = document.getElementById("confirm-password").value;
        let message = document.getElementById("message");

        let pass = document.querySelector('#password');
        let cnfrmp = document.querySelector('#confirm-password');

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
</script>
<script>
    const buttonD = document.querySelector('.btn-warning');
    const password = document.querySelector('.password');
    const cnfrm = document.querySelector('.cnf-password');

    buttonD.disabled = true;

    password.addEventListener("change", stateHandle);
    cnfrm.addEventListener("change", stateHandle);

    function stateHandle() {
        if (password.value.length <= 3 || cnfrm.value <= 3) {
            buttonD.disabled = true;
        } else {
            buttonD.disabled = false;
        }
    }
</script>
<script>
    document.body.onload = function () {
        setTimeout(function () {
            const preloader = document.getElementById('main-loader');
            if (!preloader.classList.contains('done')) {
                preloader.classList.add('done');
            }
        }, 1000);
    };

</script>
<script>
    const wrapSelect = document.querySelector('#select-role');
    const list = document.querySelector('#list-role');
    const iconAr = document.querySelector('#role-icon');

    function rotateIcon() {
        if (list.classList.contains('hidden')) {
            iconAr.classList.add('role-rotate-icon')
        } else {
            iconAr.classList.remove('role-rotate-icon')
        }
    }

    wrapSelect.addEventListener('click', rotateIcon)
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
    const formRoleValue = document.querySelector('#role');

    updateSelector();

    roleSelector.addEventListener('click', roleSelectorClickHandler);
    roleSelectorListItems.forEach(item => {
        item.addEventListener('click', roleSelectorItemClickHandler);
    });

    function roleSelectorClickHandler(event) {
        roleSelectorList.classList.toggle('hidden');

        if (!roleSelectorList.classList.contains('hidden')) {
            body.addEventListener('click', hideSelectorList);
        }

        if(roleSelectorList.classList.contains('hidden') && formRoleValue.value === ''){
            roleSelector.classList.add('invalid');
        }else{
            roleSelector.classList.remove('invalid');
            roleSelector.classList.add('divvalid');
        }
    }

    function hideSelectorList(event) {
        if (event.target.closest('.role-selector')) {
            return;
        }

        roleSelectorList.classList.add('hidden');
        body.removeEventListener('click', hideSelectorList)
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
            textShow.textContent = "{{__('Hide')}}"
        } else {
            textShow.textContent = "{{__('Show')}}"
        }
    }

    wrap.addEventListener('click', changeText);
</script>
</body>
@include('frontend.components.footer')
@include('frontend.components.cookie')
</html>
