@extends('layout.userhead')

@section('content')
    <body class="theme-bg final-register-step">
    <div class="container-medium">
        @include('frontend.components.registration-header', ["return_route" => true])
        <div class="main-content-wrapper">
            <h3 class="font-64-lh-75-semi-bold text-white">{{__('Finalize')}}</h3>
            {{-- <p class="font-22-lh-26-regular text-white">{{__('Choose what dashboard to use')}}</p> --}}
            <form class="add-more-block">
                <div
                    class="final-form-block"
                    data-toggle="modal"
                    data-target="#add-connection"
                >
                    <div class="final-form-icons text-left">
                        <img src="{!!asset('assets/image_new/svg/connectors-active.svg')!!}"
                             class="rounded">
                    </div>
                    <div class="final-form-link" style="margin-inline-start:15px">
                        <span>
                            <a class="font-22-lh-26-regular back"
                            style="font-size: 33px;"
                               href="#"
                            >
                                {{__('Add More Connections')}}
                            </a>
                            <!-- <span class="bottom-line"></span> -->
                        </span>
                    </div>
                </div>

                <div
                    class="final-form-block"
                    data-toggle="modal"
                    data-target="#invite-member"
                >
                    <div class="final-form-icons text-left">
                        <img src="{!!asset('assets/image_new/svg/colored/user-management.svg')!!}"
                             class="rounded">
                    </div>
                    <div class="final-form-link" style="margin-inline-start:15px">
                        <span>
                            <a
                                href="#"
                                class="font-22-lh-26-regular" style="font-size: 33px;"
                            >
                              {{__('Invite Team Members')}}
                            </a>
                            <!-- <span class="bottom-line"></span> -->
                        </span>
                    </div>
                </div>

                <!--<div class="form-group row">-->
                <!--   <div class="col-lg-8 col-sm-10 col-12">-->
                <!--      <div class="final-form-link">-->
            <!--         <span><a href="#">{{__('Choose Favorite Metrics')}}</a></span>-->
                <!--      </div>-->
                <!--   </div>-->
                <!--   <div class="col-lg-4 col-sm-4 col-12">-->
                <!--      <div class="final-form-icons text-center">-->
            <!--         <img src="{!!asset('assets/image_new/svg/colored/user-management.svg')!!}" class="rounded">-->
                <!--      </div>-->
                <!--   </div>-->
                <!--</div>-->
                {{--                    <a class="finish-button font-22-lh-26-regular btn btn-warning btn-sm"--}}
                {{--                       href="{{ env('APP_ENV') === 'production' ? route('dashboard', ['subdomain' => Session::get('subdomain')]) : url('/dashboard') }}"--}}
                {{--                    >--}}
                <a class="finish-button font-22-lh-26-regular btn btn-warning btn-sm"
                   href="{{url('/dashboard')}}"
                >
                    {{__('Finalize')}}
                </a>

            </form>
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
            <div class="chose-platform-page line orange"></div>
            <div class="steps-block__step">
                <div class="steps-block__step-circle orange">
                    <p class="steps-block__step-text orange-color font-16-lh-34-light">{{__('Dashboard  ')}}</p>
                </div>
            </div>
            <div class="chose-platform-page line orange"></div>
            <div class="steps-block__step">
                <div class="steps-block__step-circle orange">
                    <p class="steps-block__step-text orange-color font-16-lh-34-light">{{__('Finalize')}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade add-more-connection-modal add-more-connection-modal"
         id="add-connection"
         tabindex="-1"
         role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="header-text font-24-lh-32-medium">
                        {{__('Add More Connections')}}
                    </p>
                    <div class="close-icon"
                         data-dismiss="modal"
                         aria-label="Close"
                    >
                    </div>
                </div>

                <div class="connections-block">
                    <div class="connection" id="instagram" onclick="instagram_login()">
                        <div id="check-instagram"
                             class="{{ Auth::user() && Auth::user()->company->social_account_instagram->isNotEmpty() ? 'connections-block__picked-icon' : ''}}"></div>
                        <div class="icon instagram"></div>
                        <div class="name font-18-lh-38-regular">{{__('Instagram')}}</div>
                    </div>
                    <div class="connection" id="facebook" onclick="fb_login()">
                        <div id="check-facebook"
                             class="{{Auth::user() && Auth::user()->company->social_account_facebook->isNotEmpty() ? 'connections-block__picked-icon' : ''}}"></div>
                        <div class="icon facebook-page"></div>
                        <div class="name font-18-lh-38-regular">{{__('Facebook Page')}}</div>
                    </div>
                    <div class="connection" id="facebook-ads" onclick="facebook_ads_login()">
                        <div id="check-facebook-ads"
                             class="{{Auth::user() && Auth::user()->company->social_account_facebook_ads->isNotEmpty() ? 'connections-block__picked-icon' : ''}}"></div>
                        <div class="icon facebook-page"></div>
                        <div class="name font-18-lh-38-regular">{{__('Facebook Ads')}}</div>
                    </div>
                    <div class="connection" id="twitter" onclick="twitter_login()">
                        <div id="check-twitter"
                             class="{{Auth::user() && Auth::user()->company->social_account_twitter->isNotEmpty()? 'connections-block__picked-icon' : ''}}"></div>
                        <div class="icon twitter"></div>
                        <div class="name font-18-lh-38-regular">{{__('Twitter')}}</div>
                    </div>
                    <div class="connection" id="google-adv" onclick="googleAdsLogin()">
                        <div id="check-google-adv"
                             class="{{Auth::user() && Auth::user()->company->social_account_google_ads->isNotEmpty()? 'connections-block__picked-icon' : ''}}"></div>
                        <div class="icon google-adv"></div>
                        <div class="name font-18-lh-38-regular">{{__('Google Ads')}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade add-new-user-modal" id="invite-member" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg add-user-modal" role="document">
            <div class="modal-content">
                <div class="users-added-success">
                    <p class="success-text font-40-lh-45-bold">تمت إضافة المستخدمين</p>
                    <div class="success-icon"></div>
                </div>
                <div class="modal-header">
                <!--<span class="modal-header-fle1"><img src="{!!asset('assets/image/homelogo.jpg')!!}" height="40" width="40" class="rounded"></span>-->
                    <span class="modal-header-fle2">
                     <h5 class="modal-title text-right font-24-lh-32-medium m-0"
                         id="exampleModalLabel">{{__('Invite Members')}}</h5>
                  </span>
                    <span class="modal-header-fle3">
                  <button type="button" class="close float-left close-modal-icon-button" data-dismiss="modal"
                          aria-label="Close">
                  <span aria-hidden="true"></span>
                  </button>
                  </span>
                </div>
                <div class="modal-body">
                    <div class=" modal-invite-form">
                        <div class="modal-invite-pading">
                            <div class="modal-form">
                                <div class="row add-new-connect-modal">
                                    <div class="col-md-4 modal-invite-field col-xs-12 px-2 pl-md-3 pr-md-0">
                                        <div class="form-group">
                                            <label class="d-block text-right font-14-lh-16-light input-label"
                                            >{{__('Full Name')}}</label>
                                            <input class="form-control modal-input name font-15-lh-32-regular"
                                                   type="text"
                                                   name="name"
                                                   placeholder="{{__('Name Surname')}}"
                                                   oninput="onFieldInput('name', this)"
                                                   onblur="onFieldBlur('name', this)"
                                            >
                                            {{--                                                <div class="tooltip tooltip-down name font-14-lh-17-regular">--}}
                                            {{--                                                    يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب--}}
                                            {{--                                                </div>--}}

                                            <p class="error-p-signup-4 name-error" id="message"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 modal-invite-field col-xs-12 px-2 pl-md-3 pr-md-0">
                                        <div class="form-group">
                                            <label class="d-block text-right font-14-lh-16-light input-label"
                                            >{{__('Email')}}</label>
                                            <input class="form-control font-15-lh-32-regular modal-input email"
                                                   type="email"
                                                   name="email"
                                                   placeholder="namesurname@gmail.com"
                                                   oninput="onFieldInput('email', this)"
                                                   onblur="onFieldBlur('email', this)"
                                            >
                                            {{--                                                <div class="tooltip tooltip-down name font-14-lh-17-regular">--}}
                                            {{--                                                    يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب--}}
                                            {{--                                                </div>--}}
                                            <p class="error-p-signup-4 email-error" id="message"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 modal-invite-field col-xs-12 px-2 pl-md-3 pr-md-0">
                                        <div class="form-group">
                                            <label class="d-block text-right font-14-lh-16-light input-label"
                                            >{{__('Job Position')}}</label>
                                            <input
                                                class="form-control font-15-lh-32-regular modal-input job-position"
                                                type="text"
                                                name="job_position"
                                                placeholder="{{__('Manager ')}}"
                                                oninput="onFieldInput('jobPosition', this)"
                                                onblur="onFieldBlur('jobPosition', this)"
                                            >
                                            {{--                                                <div class="tooltip tooltip-down name font-14-lh-17-regular left-tooltip-50">--}}
                                            {{--                                                    يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب--}}
                                            {{--                                                </div>--}}
                                            <p class="error-p-signup-4 job-error" id="message"></p>
                                        </div>
                                    </div>
                                    <div class='modal-invite-newadd' id="apd">
                                    </div>
                                    <div class="flex-wrapper mt-0 mt-md-5">
                                        <div class="form-group text-center invBtn-wrapper"
                                             onclick="addMoreUsers(event)">
                                            <a class="invBtn font-13-lh-20-medium">{{__('Invite More Members')}}
                                            </a>
                                            <div class="addIcon"></div>
                                        </div>
                                        <button class="btn btn-warning btn-sm confirm-btn"
                                                disabled
                                                onclick="addUsers()"
                                        >{{__('Confirm ')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='loader-wrap'>
        <div id="main-loader" class="preloader done">
            <div class="heartbeat">
                <div class="loading"></div>
                <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>
            </div>
        </div>
    </div>
    </body>
    @include('frontend.components.cookie')
    <script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('assets/js/popper.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('assets/js/bootstrap.min.js')!!}"></script>

    <script type="text/javascript">
        twitterUrl = "{{url('twitter/login')}}";
        googleAnalyticsUrl = "{{url('google-analytics/login')}}";
        googleAdsUrl = "{{url('google-ads/login')}}";

        ifFbConnected = "{{Auth::user() && Auth::user()->company->social_account_facebook->isNotEmpty()}}"
        ifInstConnected = "{{Auth::user() && Auth::user()->company->social_account_instagram->isNotEmpty()}}"
        ifTwitterConnected = "{{Auth::user() && Auth::user()->company->social_account_twitter->isNotEmpty()}}"

        $('.f').click(function () {
            $('.markt').show();
            $('.dev, .analy, .scs').hide();
        });
        $('.s').click(function () {
            $('.dev').show();
            $('.markt, .analy, .scs').hide();
        });
        $('.t').click(function () {
            $('.analy').show();
            $('.dev, .markt, .scs').hide();
        });
        $('.fo').click(function () {
            $('.scs').show();
            $('.dev, .analy, .markt').hide();
        });

        $('.tbBtn').click(function () {
            $(this).addClass('active').siblings().removeClass('active');
        });

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

        const nameReg = /^([a-zA-Z]+\s)+[a-zA-Z]+$/;
        const arabicNameRegEx = /[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FF]/;
        const allFieldsAreValid = false;
        const emailRegEx = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        const jobRegEx = /^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z0-9+\s]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z0-9-_]*$/;
        let nameField;
        let emailField;
        let jobPositionField;
        let alerted = false;

        $(document).ready(() => {
            nameField = $(".modal-input.name")[0].parentNode;
            emailField = $(".modal-input.email")[0].parentNode;
            jobPositionField = $(".modal-input.job-position")[0].parentNode;
        });

        window.usersCount = {{ $usersCount }};
        window.subscriptionPlanCount = {{ $subscriptionPlanUsersCount }};

        function checkUserAddAbility() {
            return window.usersCount < window.subscriptionPlanCount;
        }

        function addMoreUsers(event) {

            if (!checkUserAddAbility()) {
                if (!alerted) toastr.warning('{{__("You used all limit users. Upgrade your plan.")}}');
                alerted = true
                return;
            }

            $('.confirm-btn')[0].classList.add('disabled')
            $('.confirm-btn')[0].setAttribute('disabled', 'true')

            $("#apd").append('<div class="row mt-5 additional-forms-wrapper">')
            let nameCloneField = nameField.cloneNode(true)
            let emailCloneField = emailField.cloneNode(true)
            let jobPositionCloneField = jobPositionField.cloneNode(true)
            let lastPastedBLock = $(".additional-forms-wrapper")[$(".additional-forms-wrapper").length - 1];

            nameCloneField.querySelector('.modal-input').value = '';
            nameCloneField.querySelector('.modal-input').classList.remove('border-error')
            // nameCloneField.querySelector('.tooltip').classList.remove('show-tooltip')

            emailCloneField.querySelector('.modal-input').value = '';
            emailCloneField.querySelector('.modal-input').classList.remove('border-error')
            // emailCloneField.querySelector('.tooltip').classList.remove('show-tooltip')

            jobPositionCloneField.querySelector('.modal-input').value = '';
            jobPositionCloneField.querySelector('.modal-input').classList.remove('border-error')
            // jobPositionCloneField.querySelector('.tooltip').classList.remove('show-tooltip')

            let wrapperBlock = document.createElement("div");
            wrapperBlock.classList.add('col-md-4')
            wrapperBlock.classList.add('col-xs-12');
            wrapperBlock.classList.add('modal-invite-field');
            wrapperBlock.classList.add('name');

            lastPastedBLock.append(wrapperBlock.cloneNode(true));
            lastPastedBLock.querySelector('.col-md-4.col-xs-12.name').append(nameCloneField);

            wrapperBlock.classList.remove('name');
            wrapperBlock.classList.add('email');

            lastPastedBLock.append(wrapperBlock.cloneNode(true));
            lastPastedBLock.querySelector('.col-md-4.col-xs-12.email').append(emailCloneField);

            wrapperBlock.classList.remove('email');
            wrapperBlock.classList.remove('col-md-4');
            wrapperBlock.classList.add('col-md-3');
            wrapperBlock.classList.add('job-position');

            lastPastedBLock.append(wrapperBlock.cloneNode(true));
            lastPastedBLock.querySelector('.col-md-3.col-xs-12.job-position').append(jobPositionCloneField);

            let deleteButtonBlock = document.createElement('div');
            deleteButtonBlock.classList.add('col-md-0');
            deleteButtonBlock.style.cssText = "padding-top:30px;";
            deleteButtonBlock.classList.add('col-xs-12');
            deleteButtonBlock.innerHTML = '<a href="javascript:;" onclick="$(this).closest(\'.row\').remove();window.usersCount--;alerted = false"><img src="{!! asset('assets/image/trash.svg') !!}"></a>';
            lastPastedBLock.append(deleteButtonBlock);
            window.usersCount++;
        }

        let name_message = "يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب";
        let email_message = "يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب";
        let job_message = "يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب";

        function onFieldInput(inputName, inputElement) {

            inputElement.classList.remove('border-error')
            inputElement.nextSibling.parentNode.querySelector('.error-p-signup-4').textContent = ''

            if (checkAllFieldsValid(inputName, inputElement)) {
                $('.confirm-btn')[0].classList.remove('disabled')
                $('.confirm-btn')[0].removeAttribute('disabled')
            } else {
                $('.confirm-btn')[0].classList.add('disabled')
                $('.confirm-btn')[0].setAttribute('disabled', 'true')
            }
        }

        function onFieldBlur(inputName, inputElement) {
            if (inputElement.value === '') {
                inputElement.nextSibling.parentNode.querySelector('.error-p-signup-4').textContent = ''
                inputElement.classList.add('border-error')
            }

            switch (inputName) {
                case 'name':
                    if (!nameReg.test(inputElement.value) && !arabicNameRegEx.test(inputElement.value)) {
                        inputElement.nextSibling.parentNode.querySelector('.name-error').textContent = name_message;
                        inputElement.classList.add('border-error')
                    }
                    break;
                case 'email':
                    if (!emailRegEx.test(inputElement.value)) {
                        inputElement.nextSibling.parentNode.querySelector('.email-error').textContent = email_message;
                        inputElement.classList.add('border-error')
                    }
                    break;
                case 'jobPosition':
                    if (!jobRegEx.test(inputElement.value)) {
                        inputElement.nextSibling.parentNode.querySelector('.job-error').textContent = job_message;
                        inputElement.classList.add('border-error')
                    }
                    break;
            }
        }

        function checkAllFieldsValid(fieldName, fieldValue) {
            let allFieldsValid = true

            fieldValue.classList.remove('border-error')
            fieldValue.classList.remove('show-tooltip')

            let allEmailsInput = document.querySelectorAll('.modal-input.email');
            let allNamesInput = document.querySelectorAll('.modal-input.name');
            let allJobPositionInput = document.querySelectorAll('.modal-input.job-position');

            allEmailsInput.forEach(emailField => {
                if (emailField.value === '') {
                    allFieldsValid = false
                }
                if (emailField.value !== '' && !emailRegEx.test(emailField.value)) {
                    allFieldsValid = false
                }
            })

            if (!allFieldsValid) {
                return false
            }

            allNamesInput.forEach(nameField => {
                if (nameField.value === '') {
                    allFieldsValid = false
                }
                if (nameField.value !== '' && !nameReg.test(nameField.value) && !arabicNameRegEx.test(nameField.value)) {
                    allFieldsValid = false
                }
            })

            if (!allFieldsValid) {
                return false
            }
            allJobPositionInput.forEach(jobPosition => {
                if (jobPosition.value === '') {
                    allFieldsValid = false
                }
            })

            return allFieldsValid;
        }

        function checkAbilityAddUser() {
            let result = false;
            $.ajax({
                url: '{{url('/check-add-members')}}',
                method: "get",
                async: false,
                success: function (data) {
                    result = data.status;
                }
            })
            return result;
        };

        async function addUsers() {
            let submit = document.querySelector('.confirm-btn');
            submit.disabled = true;

            if (checkAbilityAddUser()) {
                let usersList = [];
                let allNameFields = document.querySelectorAll(".modal-input.name");
                let allEmailFields = $(".modal-input.email");
                let allJobPositionFields = $(".modal-input.job-position");

                allNameFields.forEach((field, index) => {
                    usersList.push({
                        name: field.value,
                        email: allEmailFields[index].value,
                        profession: allJobPositionFields[index].value,
                    })
                })
                await $.ajax({
                    url: '{{url('add-members')}}',
                    method: "post",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        members: usersList,
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        toggleLoader(true);
                    },
                    success: (response) => {
                        toggleLoader(false);
                        allNameFields[0].value = '';
                        allEmailFields[0].value = '';
                        allJobPositionFields[0].value = '';
                        if (response.status === 'fail') {
                            toastr.warning(response.message);
                            $('.close-modal-icon-button').click();
                            $('.users-added-success')[0].classList.remove('show');
                            $('.modal-backdrop').remove();
                        } else {
                            $('.users-added-success')[0].classList.add('show')
                            setTimeout(() => {
                                $('.close-modal-icon-button').click();
                                $('.users-added-success')[0].classList.remove('show');
                                $('.modal-backdrop').remove();
                            }, 2500)
                        }
                    },
                    error: () => {
                        toggleLoader(false);
                        toastr.warning('{{__('error')}}');
                    }
                })
            } else {
                $('.close-modal-icon-button').click();
                $('.users-added-success')[0].classList.remove('show');
                $('.modal-backdrop').remove();
                toastr.warning('{{__("You used all limit users. Upgrade your plan.")}}')
            }
            submit.disabled = false;
        }

        window.fbAsyncInit = function () {
            FB.init({
                appId: {{env('FACEBOOK_APP_ID')}},
                cookie: true,
                xfbml: true,
                version: 'v12.0'
            });
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
            let checkCon = checkConnections();
            if (checkCon) {
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
                                    $('#check-facebook').addClass('connections-block__picked-icon');
                                    toastr.success(response.message);
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
                    scope: 'email, read_insights, pages_show_list, pages_read_engagement, public_profile, pages_manage_posts',
                });
            } else {
                toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
            }
        }

        function instagram_login() {
            let checkCon = checkConnections();
            if (checkCon) {
                FB.login(function (response) {
                    if (response.authResponse) {
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
                                    $('#check-instagram').addClass('connections-block__picked-icon');
                                    toastr.success(response.message);
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
            } else {
                toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
            }
        }

        function facebook_ads_login() {
            let checkCon = checkConnections();
            if (checkCon) {
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
                                    $('#check-facebook-ads').addClass('connections-block__picked-icon');
                                    toastr.success(response.message);
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
                    scope: 'email,public_profile,ads_management,ads_read,read_insights,pages_read_engagement, pages_show_list, pages_manage_ads',
                });
            } else {
                toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
            }
        }

        function twitter_login() {
            let checkCon = checkConnections();
            if (checkCon) {
                var left = (screen.width / 2 - 225);
                var top = (screen.height / 2 - 350);
                window.open(twitterUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
            } else {
                toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
            }
        };

        function googleAnalyticsLogin() {
            let createConnections = checkConnections();
            if (!createConnections) {
                return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
            }
            var left = (screen.width / 2 - 225);
            var top = (screen.height / 2 - 350);
            window.open(googleAnalyticsUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
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

        function toggleLoader(loaderStatus) {
            const preloader = $('#main-loader');
            if (loaderStatus) {
                preloader.removeClass('done');
            } else {
                preloader.addClass('done');
            }
            ;
        };

        jQuery(window).bind("focus", function (event) {
            let ConnectionInfo = localStorage.getItem('connectionStatus');
            let ConnectionType = localStorage.getItem('connectionType');

            if (ConnectionInfo === 'success') {
                if (ConnectionType === 'twitter') {
                    $('#check-twitter').addClass('connections-block__picked-icon');
                    toastr.success('{{__('Connection connected successfully')}}');
                }
                if (ConnectionType === 'googleAds') {
                    $('#check-google-adv').addClass('connections-block__picked-icon');
                    toastr.success('{{__('Connection connected successfully')}}');
                }

            }
            if (ConnectionInfo === 'error_account_connected') {
                toastr.warning('{{__('This account is connected')}}');
            }
            if (ConnectionInfo === 'error') {
                toastr.warning('{{__('error')}}');
            }
            localStorage.removeItem('connectionStatus');
            localStorage.removeItem('connectionType');
        });
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
@endsection

