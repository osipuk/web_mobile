@extends('layout.userhead')

@section('content')
    <body class="theme-bg chose-platform-page">
    <div class="loader" hidden>
        <div class="loader-background"></div>
        <div class="loader-logo"></div>
        <p class="loader-text font-18-lh-22-regular">{{__('Loading...')}}</p>
    </div>
    <div class="content-wrapper">
        {{-- @include('frontend.components.registration-header', ["return_route" => "/signup"]) --}}

        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 mx-auto px-2">
                <div class="form-wizard mt-5">
                    <div class="myContainer">
                        <div class="form-container animated text-center">
                            <h3 class="font-64-lh-75-semi-bold text-white">{{__('Your Connections')}}</h3>
                            <p class="text-white font-20-lh-30-medium mb-7">{{__('Choose the platform you want to connect with')}}
                            <div class="connections-list">
                                <div class="connections-list__card-item" id="google-analytics">
                                    <div class="connections-list__picked-icon hide-element"></div>
                                    <div class="connections-list__connection-icon google-analytics"></div>
                                    <div
                                        class="connections-list__connection-name font-18-lh-38-medium">{{__('Google Analytics')}}</div>
                                </div>
                                <div class="connections-list__card-item" id="twitter">
                                    <div class="connections-list__picked-icon hide-element"></div>
                                    <div class="connections-list__connection-icon twitter"></div>
                                    <div class="connections-list__connection-name font-18-lh-38-medium">{{__('Twitter')}}</div>
                                </div>
                                
                                <div class="connections-list__card-item" id="facebook">
                                    <div class="connections-list__picked-icon hide-element"></div>
                                    <div class="connections-list__connection-icon facebook"></div>
                                    <div
                                        class="connections-list__connection-name font-18-lh-38-medium">{{__('Facebook Page ')}}</div>
                                </div>
                                <div class="connections-list__card-item" id="facebook-ads">
                                    <div class="connections-list__picked-icon hide-element"></div>
                                    <div class="connections-list__connection-icon facebook"></div>
                                    <div
                                        class="connections-list__connection-name font-18-lh-38-medium">{{__('Facebook Ads')}}</div>
                                </div>

                                <div class="connections-list__card-item" id="google-ads">
                                    <div class="connections-list__picked-icon hide-element"></div>
                                    <div class="connections-list__connection-icon google-ads">

                                    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1274_7760)">
                                        <path d="M17.0148 7.72404C17.4981 6.45545 18.1626 5.28754 19.1493 4.34114C23.0961 0.495097 29.6203 1.46164 32.2985 6.29436C34.3122 9.95917 36.4466 13.5434 38.5207 17.168L48.9112 35.2504C51.7907 40.3046 48.6695 46.6878 42.9507 47.5537C39.447 48.0772 36.1647 46.4663 34.3524 43.3251L25.2104 27.4576C25.15 27.3368 25.0695 27.2361 24.9889 27.1355C24.6667 26.8737 24.5258 26.4911 24.3244 26.1488L17.5988 14.4898C16.8135 13.1206 16.451 11.6305 16.4913 10.0599C16.5517 9.2544 16.6524 8.44895 17.0148 7.72404Z" fill="#3C8BD9"/>
                                        <path d="M17.0149 7.72412C16.8337 8.44903 16.6726 9.17394 16.6323 9.93912C16.5719 11.6306 16.9948 13.2012 17.8405 14.6712L24.4655 26.1287C24.6668 26.471 24.8279 26.8134 25.0293 27.1355L21.3846 33.3979L16.29 42.1774C16.2095 42.1774 16.1893 42.1371 16.1692 42.0767C16.149 41.9156 16.2095 41.7747 16.2497 41.6136C17.0753 38.5931 16.3907 35.915 14.3166 33.6194C13.048 32.23 11.4371 31.4447 9.58453 31.1829C7.16814 30.8406 5.03367 31.4649 3.12069 32.9751C2.77837 33.2368 2.55687 33.6194 2.15414 33.8208C2.07359 33.8208 2.03332 33.7805 2.01318 33.7201L4.89271 28.7062L16.874 7.94562C16.9142 7.86508 16.9747 7.80467 17.0149 7.72412Z" fill="#FABC04"/>
                                        <path d="M2.09376 33.7804L3.24154 32.7535C8.13472 28.8873 15.4846 31.6862 16.5518 37.8077C16.8136 39.2776 16.6726 40.6872 16.2296 42.0967C16.2095 42.2175 16.1894 42.3182 16.1491 42.439C15.9678 42.7612 15.8068 43.1035 15.6054 43.4257C13.8132 46.3858 11.1753 47.8557 7.71186 47.6342C3.74495 47.3523 0.623788 44.3721 0.0801004 40.4254C-0.181675 38.5125 0.20092 36.7203 1.18761 35.0691C1.38898 34.7067 1.63062 34.3845 1.85212 34.0221C1.9528 33.9415 1.91253 33.7804 2.09376 33.7804Z" fill="#34A852"/>
                                        <path d="M2.09377 33.7803C2.01323 33.8608 2.01323 34.0018 1.87227 34.0219C1.85213 33.8809 1.93268 33.8004 2.01323 33.6997L2.09377 33.7803Z" fill="#FABC04"/>
                                        <path d="M16.1491 42.439C16.0685 42.298 16.1491 42.1974 16.2296 42.0967L16.3102 42.1772L16.1491 42.439Z" fill="#E1C025"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_1274_7760">
                                        <rect width="50" height="50" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>

                                    </div>
                                    <div class="connections-list__connection-name font-18-lh-38-medium">{{__('Google Ads')}}</div>
                                </div>

                                <div class="connections-list__card-item" id="instagram">
                                    <div class="connections-list__picked-icon hide-element"></div>
                                    <div class="connections-list__connection-icon instagram"></div>
                                    <div class="connections-list__connection-name font-18-lh-38-medium">{{__('Instagram ')}}</div>
                                </div>

                                
                            </div>
                            <div class="add-connection text-white hidden">
                                <p class="add-connection__title add-connection-ttl font-40-lh-45-bold">اتصال صفحة
                                    الفيسبوك</p>
                                <button id="default-login-btn" class="add-connection__button font-18-lh-22-regular"
                                        style="display: none"
                                        onclick="login()">{{__('Next')}}</button>
                                <button id="google-login-btn" style="background-color: #0b243a; display: none;"
                                        onclick="login()">
                                        <img width="250" src="{{asset('assets/image_new/btn_google_signin_dark_normal_web@2x.png')}}">
                                </button>
                            </div>
                            <div class="steps-block">
                                <div class="steps-block__step">
                                    <div class="steps-block__step-circle orange">
                                        <p class="steps-block__step-text orange-color font-16-lh-34-light">{{__('About you')}}</p>
                                    </div>
                                </div>
                                <div class="chose-platform-page line orange"></div>
                                <div class="steps-block__step">
                                    <div class="steps-block__step-circle orange">
                                        <p class="steps-block__step-text orange-color font-16-lh-34-light">{{__('Connections  ')}}</p>
                                    </div>
                                </div>
                                <div class="chose-platform-page line white"></div>
                                <div class="steps-block__step">
                                    <div class="steps-block__step-circle white">
                                        <p class="steps-block__step-text white-color font-16-lh-34-light">{{__('Dashboard  ')}}</p>
                                    </div>
                                </div>
                                <div class="chose-platform-page line white"></div>
                                <div class="steps-block__step">
                                    <div class="steps-block__step-circle white">
                                        <p class="steps-block__step-text white-color font-16-lh-34-light">{{__('Finalize')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                        <div class="steps">--}}
                    {{--                            <ul>--}}
                    {{--                                <li>--}}
                    {{--                                    <span></span>--}}
                    {{--                                    {{__('About you')}}--}}
                    {{--                                </li>--}}
                    {{--                                <li class="active">--}}
                    {{--                                    <span></span>--}}
                    {{--                                    {{__('Connection')}}--}}
                    {{--                                </li>--}}
                    {{--                                <li>--}}
                    {{--                                    <span></span>--}}
                    {{--                                    {{__('Dashboard')}}--}}
                    {{--                                </li>--}}
                    {{--                                <li>--}}
                    {{--                                    <span></span>--}}
                    {{--                                    {{__('Finish')}}--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    <a class="font-16-lh-26-medium skip-connection-link"
                       href="{{url('signup/step-4')}}"
                    >{{__('Skip Connections for now')}}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="invite-member" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <span class="modal-header-fle1"><img src="{!!asset('assets/image/homelogo.jpg')!!}" height="40"
                                                             width="40" class="rounded"></span>
                    <span class="modal-header-fle2">
                     <h5 class="modal-title text-center font-weight-bold m-0"
                         id="exampleModalLabel">{{__('Invite Members')}}</h5>
                  </span>
                    <span class="modal-header-fle3">
                  <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </span>
                </div>
                <div class="modal-body bg-gray">
                    <div class="row">
                        <div class="col-12">
                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="d-block text-right"><small>{{__('Email')}}</small></label>
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group text-right">
                                            <button class="btn btn-warning btn-sm">{{__('Invite')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>
            <script type="text/javascript" src="{!!asset('assets/js/popper.min.js')!!}"></script>
            <script type="text/javascript" src="{!!asset('assets/js/bootstrap.min.js')!!}"></script>

            <script type="text/javascript">
                twitterUrl = "{{url('twitter/login')}}";
                googleAdsUrl = "{{url('google-ads/login')}}";
                googleAnalyticsUrl = "{{url('google-analytics/login')}}";

                var signUpSuccess = '{{ session()->get('signUpSuccess') }}';

                $(document).ready(function () {
                    if (signUpSuccess) {
                        toastr.success('{{__('You have successfully registered')}}');

                        @php
                            request()->session()->forget('signUpSuccess');
                        @endphp
                    }

                    var connections = $('.connections-list .connections-list__card-item');
                    connections.each(function () {
                        $(this).click(function () {
                            let id = $(this).attr('id');
                            switch (id) {
                                case 'facebook':
                                    $('.add-connection__title').text('{{__("Facebook Page Connection")}}');
                                    $('#default-login-btn').show();
                                    $('#google-login-btn').hide();
                                    break;
                                case 'facebook-ads':
                                    $('.add-connection__title').text('{{__("Facebook Ads Connection")}}');
                                    $('#default-login-btn').show();
                                    $('#google-login-btn').hide();
                                    break;
                                case 'instagram':
                                    $('.add-connection__title').text('{{__("Instagram Page Connection")}}');
                                    $('#default-login-btn').show();
                                    $('#google-login-btn').hide();
                                    break;
                                case 'twitter':
                                    $('.add-connection__title').text('{{__("Twitter Page Connection")}}');
                                    $('#default-login-btn').show();
                                    $('#google-login-btn').hide();
                                    break;
                                case 'google-analytics':
                                    $('.add-connection__title').text('{{__("Google Analytics Connection")}}');
                                    $('#google-login-btn').show();
                                    $('#default-login-btn').hide();
                                    break;
                                
                                case 'google-ads':
                                    $('.add-connection__title').text('{{__("Google Ads Connection")}}');
                                    $('#google-login-btn').show();
                                    $('#default-login-btn').hide();
                                    break;
                            }
                        });
                    });
                })

                window.fbAsyncInit = function () {
                    FB.init({
                        appId: {{env('FACEBOOK_APP_ID')}},
                        cookie: true,
                        xfbml: true,
                        version: 'v12.0'
                    });
                };

                // Loader

                function toggleLoader(loaderStatus) {
                    const loader = document.querySelector('.loader');
                    if (loaderStatus) {
                        loader.removeAttribute('hidden');
                    } else {
                        loader.setAttribute('hidden', '');
                    }
                };

                // Select and loggin

                const list = document.querySelector('.connections-list');
                const addConnection = document.querySelector('.add-connection');
                let currentActive = '';

                for (let item of list.children) {
                    item.addEventListener('click', selectHandler)
                }
                ;

                function selectHandler(event) {
                    for (let item of list.children) {
                        item.children[0].classList.add('hide-element');
                    }
                    ;

                    event.currentTarget.children[0].classList.remove('hide-element');
                    currentActive = event.currentTarget.id;

                    addConnection.classList.remove('hidden')
                };


                function checkConnections() {
                    let result = false;
                    $.ajax({
                        url: '{{url('/check-count-connections')}}',
                        method: "get",
                        async: false,
                        success: function (data) {
                            result = data.status;
                        }
                    })
                    return result;
                };



                function fb_login() {

                    let createConnections = checkConnections();
                    if (!createConnections) {
                        return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                    }

                    FB.login(function (response) {
                        if (response.authResponse && response.status === 'connected') {
                            access_token = response.authResponse.accessToken;
                            user_id = response.authResponse.userID;
                            $.ajax({
                                url: '{{url('facebook/callback')}}',
                                method: "post",
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    id: user_id,
                                    token: access_token,
                                },
                                dataType: 'json',
                                beforeSend: function () {
                                    toggleLoader(true);
                                },
                                success: (response) => {
                                    toggleLoader(false);
                                    if (response.status) {
                                        toastr.success(response.message);
                                        window.location.href = '{{url('/signup/step-3')}}';
                                    } else {
                                        toastr.warning(response.message);
                                    }
                                },
                                error: () => {
                                    toggleLoader(false);
                                }
                            })
                        } else {
                            console.log('User cancelled login or did not fully authorize.');
                        }
                    }, {
                        scope: 'email, read_insights, pages_show_list, pages_read_engagement, public_profile',
                    });
                }

                function instagram_login() {

                    let createConnections = checkConnections();
                    if (!createConnections) {
                        return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                    }

                    FB.login(function (response) {
                        if (response.authResponse && response.status === 'connected') {
                            access_token = response.authResponse.accessToken;
                            user_id = response.authResponse.userID;
                            $.ajax({
                                url: '{{url('instagram/callback')}}',
                                method: "post",
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    id: user_id,
                                    token: access_token,
                                },
                                beforeSend: function () {
                                    toggleLoader(true);
                                },
                                dataType: 'json',
                                success: (response) => {
                                    toggleLoader(false);
                                    if (response.status) {
                                        toastr.success(response.message);
                                        window.location.href = '{{url('/signup/step-4')}}';
                                    } else {
                                        toastr.warning(response.message);
                                    }
                                },
                                error: () => {
                                    toggleLoader(false);
                                    show_notification("error", "Something went wrong.");
                                }
                            })
                        } else {
                            console.log('User cancelled login or did not fully authorize.');
                        }
                    }, {
                        scope: 'email,  public_profile, instagram_basic, instagram_manage_insights, pages_show_list, pages_read_engagement',
                    });
                }

                function facebook_ads_login() {
                    let createConnections = checkConnections();
                    if (!createConnections) {
                        return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                    }
                    FB.login(function (response) {
                        if (response.authResponse) {
                            access_token = response.authResponse.accessToken;
                            user_id = response.authResponse.userID;
                            $.ajax({
                                url: '{{url('/facebook-ads/callback')}}',
                                method: "post",
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    id: user_id,
                                    token: access_token,
                                },
                                dataType: 'json',
                                beforeSend: function () {
                                    toggleLoader(true);
                                },
                                success: (response) => {
                                    toggleLoader(false);
                                    if (response.status) {
                                        toastr.success(response.message);
                                        window.location.href = '{{url('/signup/step-4')}}';
                                    } else {
                                        toastr.warning(response.message);
                                    }
                                },
                                error: () => {
                                    toggleLoader(false);
                                }
                            })
                        } else {
                            console.log('User cancelled login or did not fully authorize.');
                        }
                    }, {
                        scope: 'email,public_profile,ads_read,read_insights,pages_read_engagement,pages_show_list',
                    });
                }

                function googleAdsLogin() {
                    let createConnections = checkConnections();
                    if (!createConnections) {
                        return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                    }
                    var left = (screen.width / 2 - 225);
                    var top = (screen.height / 2 - 350);
                    window.open(googleAdsUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
                }

                function googleAnalyticsLogin() {
                    let createConnections = checkConnections();
                    if (!createConnections) {
                        return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                    }
                    var left = (screen.width / 2 - 225);
                    var top = (screen.height / 2 - 350);
                    window.open(googleAnalyticsUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
                }

                function twitter_login() {
                    let createConnections = checkConnections();
                    if (!createConnections) {
                        return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                    }
                    var left = (screen.width / 2 - 225);
                    var top = (screen.height / 2 - 350);
                    window.open(twitterUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
                };

                function login() {
                    let createConnections = checkConnections();
                    if (!createConnections) {
                        return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                    }
                    switch (currentActive) {
                        case 'facebook':
                            fb_login();
                            break;

                        case 'twitter':
                            twitter_login();
                            break;

                        case 'instagram':
                            instagram_login();
                            break;

                        case 'facebook-ads':
                            facebook_ads_login();
                            break;

                        case 'google-adv':
                            googleAdsLogin();
                            break;

                        case 'google-analytics':
                            googleAnalyticsLogin();
                            break;


                        case 'google-ads':
                            googleAdsLogin();
                            break;


                        default:
                            break;
                    }
                };

                jQuery(window).bind("focus", function (event) {
                    let ConnectionInfo = localStorage.getItem('connectionStatus');
                    let ConnectionType = localStorage.getItem('connectionType');
                    if (ConnectionInfo === 'success') {
                        toastr.success('{{__('Connection connected successfully')}}');
                        window.location.href = '{{url('/signup/step-4')}}';
                    }
                    if (ConnectionInfo === 'error_account_connected') {
                        toastr.warning('{{__('This account is connected')}}');
                    }
                    if (ConnectionInfo === 'error') {
                        toastr.warning('{{__('Error during connecting, please try again')}}');
                    }
                    if (ConnectionInfo === 'no_accounts') {
                        toastr.warning('{{__('No accounts')}}');
                    }
                    if (ConnectionInfo === 'error_no_permissions') {
                        toastr.warning('{{__('No permissions')}}');
                    }
                    localStorage.removeItem('connectionStatus');
                    localStorage.removeItem('connectionType');

                });

                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) {
                        return;
                    }
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));

                $(".facebook-radio-element").click(function () {
                    $(".facebook-connection-show, .fbicon").show();
                    $(".google-connection-show, .googleicon").hide();
                    $(".twitter-connection-show, .twittericon").hide();
                    $(".linkedin-connection-show, .linkicon").hide();
                    $(".instagram-connection-show, .instaicon").hide();
                })

                $(".google-radio-element").click(function () {
                    $(".facebook-connection-show, .fbicon").hide();
                    $(".google-connection-show, .googleicon").show();
                    $(".twitter-connection-show, .twittericon").hide();
                    $(".linkedin-connection-show, .linkicon").hide();
                    $(".instagram-connection-show, .instaicon").hide();
                })

                $(".twitter-radio-element").click(function () {
                    $(".facebook-connection-show, .fbicon").hide();
                    $(".google-connection-show, .googleicon").hide();
                    $(".twitter-connection-show, .twittericon").show();
                    $(".linkedin-connection-show, .linkicon").hide();
                    $(".instagram-connection-show, .instaicon").hide();
                })

                $(".linkedin-radio-element").click(function () {
                    $(".facebook-connection-show, .fbicon").hide();
                    $(".google-connection-show, .googleicon").hide();
                    $(".twitter-connection-show, .twittericon").hide();
                    $(".linkedin-connection-show, .linkicon").show();
                    $(".instagram-connection-show, .instaicon").hide();
                })

                $(".instagram-radio-element").click(function () {
                    $(".facebook-connection-show, .fbicon").hide();
                    $(".google-connection-show, .googleicon").hide();
                    $(".twitter-connection-show, .twittericon").hide();
                    $(".linkedin-connection-show, .linkicon").hide();
                    $(".instagram-connection-show, .instaicon").show();
                })
                var totalSteps = $(".steps li").length;

                $(".submit").on("click", function () {
                    return false;
                });

                $(".steps li:nth-of-type(1)").addClass("active");
                $(".myContainer .form-container:nth-of-type(1)").addClass("active");

                $(".form-container").on("click", ".next", function () {
                    $(".steps li").eq($(this).parents(".form-container").index() + 1).addClass("active");
                    $(this).parents(".form-container").removeClass("active").next().addClass("active flipInX");
                });

                $(".form-container").on("click", ".back", function () {
                    $(".steps li").eq($(this).parents(".form-container").index() - totalSteps).removeClass("active");
                    $(this).parents(".form-container").removeClass("active flipInX").prev().addClass("active flipInY");
                });


                /*=========================================================
                *     If you won't to make steps clickable, Please comment below code
                =================================================================*/
                $(".steps li").on("click", function () {
                    var stepVal = $(this).find("span").text();
                    $(this).prevAll().addClass("active");
                    $(this).addClass("active");
                    $(this).nextAll().removeClass("active");
                    $(".myContainer .form-container").removeClass("active flipInX");
                    $(".myContainer .form-container:nth-of-type(" + stepVal + ")").addClass("active flipInX");
                });
            </script>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    @include('frontend.components.cookie')
    </body>
@endsection
