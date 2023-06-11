<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{__('Signup')}}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
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
    <div class="inner-circle member-circle-h"></div>

    <div class="container circle-content p-0">
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
        <form class="sign-up-form" action="{{url('/register-member')}}" method="post">
            @csrf

            <h3 class="font-64-lh-75-semi-bold mt-3 text-white text-center text-nowrap mt-4 mb-2">{{__('Sign Up')}}</h3>
            {{-- <p class="text-center mb-5 text-white signup-page-link-signin sign-up-sub font-20-lh-30-medium">
                {{__('Already an user?')}}
                <a href="{{ url('login') }}" class="text-white sign-in-link ">
                    <u style="color:#f48a1d">
                        {{__('Sign in')}}
                    </u>
                </a>
            </p> --}}
            <div class="forms-container">
                <input type="hidden" name="token" value="{{$token}}">
                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-16-light">{{__('First Name')}}</label>
                    <input type="text" name="first_name" class="form-input first_name text-right font-14-lh-16-light mb-3"
                           placeholder="{{__('Name')}}" value="{{$user->first_name}}" disabled>
                </div>
                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-16-light">{{__('Last Name')}}</label>
                    <input type="text" name="last_name" class="form-input last_name text-right font-14-lh-16-light mb-3"
                           placeholder="{{__('Surname')}}" value="{{$user->last_name}}" disabled>
                </div>
            </div>
            <div class="forms-wrapper big text-right">
                <label class="d-block text-white font-14-lh-16-light">{{__('Email')}}</label>
                <input type="text" name="email" class="form-input email text-right font-14-lh-16-light mb-3"
                       placeholder="email@companyexample.com" value="{{$user->email}}" disabled>
            </div>
            <div class="forms-container">
                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-16-light">{{__('Company')}}</label>
                    <input type="text" name="company" class="form-input company text-right font-14-lh-16-light mb-3"
                           placeholder="{{__('Company Name')}}"  value="{{$company->name}}" disabled>
                </div>
                <div class="forms-wrapper big-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-16-light">{{__('Role')}}</label>
                    <input name="working_as" type="hidden" id="role" value="{{$user->role}}" disabled>
                    <div class="role-selector font-14-lh-16-light role-selector-part" style="pointer-events: none; opacity: 0.4;">
                        <div class="role-selector-icon role-selector-part"></div>
                        <div class="role-selector-value role-selector-part">{{__('Role Choice Dropdown')}}</div>
                        <ul class="role-selector-list hidden role-selector-part">
                            <li class="role-selector-list-item role-selector-part">{{__('Social Media Manager')}}</li>
                            <li class="role-selector-list-item role-selector-part">{{__('Marketing Manager')}}</li>
                            <li class="role-selector-list-item role-selector-part">{{__('Developer')}}</li>
                            <li class="role-selector-list-item role-selector-part">{{__('Other')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="forms-container">
                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-16-light">{{__('Password')}}</label>
                    <input type="password" name="password" id="password" class="form-input password text-right font-14-lh-16-light mb-4"
                           placeholder="{{__('Password')}}" oninput="onFieldInput('password', this)" onkeyup='check();'>
                    @error('password')
                    <p class="error-p padding-p">{{__($message)}}</p>
                    {{--<div class="tooltip password password-error font-16-lh-19-regular">{{__($message)}}</div>--}}
                    @enderror
                </div>

                <div class="forms-wrapper small text-right">
                    <label class="d-block text-white font-14-lh-16-light">
                        {{__('Confirm Password')}}
                        <span class="float-left">
                            <a href="javascript:void(0);" class="text-warning font-14-lh-16-light">
                                {{__('Show')}}
                                <i class="fas eye-open mr-2"></i>
                            </a>
                        </span>
                    </label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-input cnf-password text-right font-14-lh-16-light mb-4"
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
@include('frontend.components.loader')
<script>
    let password_min_message = "{{__('Password must be at least 8 characters long')}}";
    let passwords_match = "{{__('Passwords match')}}";
    let passwords_not_match = "{{__('Passwords dont match')}}";

    var check = function (){
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

// buttonD.disabled = true;

password.addEventListener("change", stateHandle);
cnfrm.addEventListener("change", stateHandle);

function stateHandle() {
    if (password.value.length >= 8  || cnfrm.value >= 8) {
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
        $(this).find('i').toggleClass("eye-close");
        // fa-eye-slash
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
    $('.last_name').change(function() {
        $('.last_name-error').hide();
    });
    $('.first_name').change(function() {
        $('.first_name-error').hide();
    });
    $('.email').change(function() {
        $('.email-error').hide();
    });
    $('#role').change(function() {
        $('.working_as-error').hide();
    });
    $('.company').change(function() {
        $('.company-error').hide();
    });
    $('.password').change(function() {
        $('.password-error').hide();
    });


</script>
</body>
@include('frontend.components.footer')
@include('frontend.components.cookie')
</html>
