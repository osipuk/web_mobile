@extends('layout.userhead')

@section('content')
    <body class="theme-bg chose-dashboard-page">
    <div class="container-medium">
        @include('frontend.components.registration-header', ["return_route" => "/signup/step-2"])
        <div class="row ">
            <div class="col-lg-12 col-sm-12 col-12 mx-auto px-2">
                <div class="form-wizard mt-5">
                    <div class="myContainer">
                        <div class="form-container animated text-center">
                            <h3 class="main-title font-64-lh-75-semi-bold text-white mb-4">{{__('Your Dashboard')}}</h3>
                            <p class="font-20-lh-30-medium text-white">{{__('Choose what dashboard to use')}}</p>
                            <a href="javascript:void(0);"
                               class="tbBtn f active font-18-lh-22-regular">{{__('Marketing')}}</a>
                            <a href="javascript:void(0);"
                               class="tbBtn s font-18-lh-22-regular disabled-template">{{__('Development')}}</a>
                            <a href="javascript:void(0);"
                               class="tbBtn t font-18-lh-22-regular disabled-template">{{__('Analytics')}}</a>
                            <a href="javascript:void(0);"
                               class="tbBtn fo font-18-lh-22-regular big disabled-template">{{__('Social')}}</a>
                            <div class="row dashboards-wrapper">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="cardImage first">
                                        </div>
                                        <h5 class="dashboard-card-info-title font-24-lh-29-medium mb-3">
                                            {{__('Facebook Engagement')}}
                                        </h5>
                                        <p class="dashboard-card-info-text font-18-lh-22-light">
                                            {{__('Allows you to see valuable insight into how your audience is interacting with your Facebook page')}}
                                        </p>
                                        <a href="javascript:void(0);" class="dashboard-card-chose btn btn-warning next btn-sm ml-2
                                        font-18-lh-22-regular" onclick="chooseTemplates('facebook-engagement')">
                                            {{__('Choose')}}
                                        </a>
                                    </div>
                                </div>
                                {{-- <div class="card">
                                    <div class="card-body text-center">
                                        <div class="cardImage second">
                                        </div>
                                        <h5 class="dashboard-card-info-title font-24-lh-29-medium mb-3">{{__('Facebook Ads')}}</h5>
                                        <p class="dashboard-card-info-text font-18-lh-22-light">
                                            {{__('High-level overview of how all your Facebook Ads campaigns are performing')}}
                                        </p>
                                        <button class="dashboard-card-chose btn btn-warning next btn-sm ml-2 font-18-lh-22-regular">
                                            {{__('Choose')}}
                                        </button>
                                    </div>
                                </div> --}}
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="cardImage third">
                                        </div>
                                        <h5 class="font-24-lh-29-medium mb-3">{{__('Facebook Page Insight')}}</h5>
                                        <p class="dashboard-card-info-text font-18-lh-22-light">
                                            {{__('All the metrics you need to view valuable insights about your audience and how they interact with your Facebook Page')}}
                                        </p>
                                        <a href="javascript:void(0);" class="dashboard-card-chose btn btn-warning next btn-sm ml-2
                                        font-18-lh-22-regular" onclick="chooseTemplates('facebook-overview')">
                                            {{__('Choose')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--deve-->
                        {{--                                <div class="row dev" style="display:none;">--}}
                        {{--                                    <div class="col-lg-4 col-sm-6 col-12">--}}
                        {{--                                        <div class="card">--}}
                        {{--                                            <div class="card-body text-center">--}}
                        {{--                                                <div class="cardImage">--}}
                        {{--                                                    <img--}}
                        {{--                                                        src="https://i.pinimg.com/originals/11/f6/a1/11f6a1db1fc35782d9b1a664702c5c33.png">--}}
                        {{--                                                </div>--}}
                        {{--                                                <h5 class="font-weight-bold">{{__('Facebook Page')}} {{__('Insight')}}</h5>--}}
                        {{--                                                <p>{{__('Design your own dashboard with our Drag & Drop Widgets.Fully customizable, with the ability to save it as a')}}--}}
                        {{--                                                    {{__('template for future use.')}}--}}
                        {{--                                                </p>--}}
                        {{--                                                <button--}}
                        {{--                                                    class="btn btn-warning next btn-sm ml-2">{{__('Select')}}</button>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="col-lg-4 col-sm-6 col-12">--}}
                        {{--                                        <div class="card">--}}
                        {{--                                            <div class="card-body text-center">--}}
                        {{--                                                <div class="cardImage">--}}
                        {{--                                                    <img--}}
                        {{--                                                        src="https://www.vhv.rs/dpng/d/105-1052116_online-reputation-dashboard-hd-png-download.png">--}}
                        {{--                                                </div>--}}
                        {{--                                                <h5 class="font-weight-bold">{{__('Facebook')}} {{__('Ads')}}</h5>--}}
                        {{--                                                <p>{{__('shows you how your advertising is helping you achieve your business goals across Facebook,Instagram and Audience Network')}}--}}
                        {{--                                                </p>--}}
                        {{--                                                <button class="btn btn-warning next btn-sm ml-2">Select</button>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="col-lg-4 col-sm-6 col-12">--}}
                        {{--                                        <div class="card">--}}
                        {{--                                            <div class="card-body text-center">--}}
                        {{--                                                <div class="cardImage">--}}
                        {{--                                                    <img--}}
                        {{--                                                        src="https://as2.ftcdn.net/v2/jpg/02/32/92/69/500_F_232926981_9k5hyZdmf5fBP1gVO4LS1zbXd0hhOBtO.jpg">--}}
                        {{--                                                </div>--}}
                        {{--                                                <h5 class="font-weight-bold">{{__('Facebook')}} {{__('Engagement')}}</h5>--}}
                        {{--                                                <p>{{__('helps media organizations, brands, and public figures understand their audience, the success of posts, and the health of')}} {{__('their Pages over time')}}</p>--}}
                        {{--                                                <button class="btn btn-warning next btn-sm ml-2">Select</button>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        <!--analytics-->
                        {{--                                <div class="row analy" style="display:none;">--}}
                        {{--                                    <div class="col-lg-4 col-sm-6 col-12">--}}
                        {{--                                        <div class="card">--}}
                        {{--                                            <div class="card-body text-center">--}}
                        {{--                                                <div class="cardImage">--}}
                        {{--                                                    <img--}}
                        {{--                                                        src="https://i.pinimg.com/originals/11/f6/a1/11f6a1db1fc35782d9b1a664702c5c33.png">--}}
                        {{--                                                </div>--}}
                        {{--                                                <h5 class="font-weight-bold">{{__('Facebook Page')}} {{__('Insight')}}</h5>--}}
                        {{--                                                <p>{{__('Design your own dashboard with our Drag & Drop Widgets.Fully customizable, with the ability to save it as a')}}--}}
                        {{--                                                    {{__('template for future use.')}}--}}
                        {{--                                                </p>--}}
                        {{--                                                <button--}}
                        {{--                                                    class="btn btn-warning next btn-sm ml-2">{{__('Select')}}</button>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="col-lg-4 col-sm-6 col-12">--}}
                        {{--                                        <div class="card">--}}
                        {{--                                            <div class="card-body text-center">--}}
                        {{--                                                <div class="cardImage">--}}
                        {{--                                                    <img--}}
                        {{--                                                        src="https://www.vhv.rs/dpng/d/105-1052116_online-reputation-dashboard-hd-png-download.png">--}}
                        {{--                                                </div>--}}
                        {{--                                                <h5 class="font-weight-bold">{{__('Facebook')}} {{__('Ads')}}</h5>--}}
                        {{--                                                <p>{{__('shows you how your advertising is helping you achieve your business goals across Facebook,Instagram and Audience Network')}}--}}
                        {{--                                                </p>--}}
                        {{--                                                <button class="btn btn-warning next btn-sm ml-2">Select</button>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="col-lg-4 col-sm-6 col-12">--}}
                        {{--                                        <div class="card">--}}
                        {{--                                            <div class="card-body text-center">--}}
                        {{--                                                <div class="cardImage">--}}
                        {{--                                                    <img--}}
                        {{--                                                        src="https://as2.ftcdn.net/v2/jpg/02/32/92/69/500_F_232926981_9k5hyZdmf5fBP1gVO4LS1zbXd0hhOBtO.jpg">--}}
                        {{--                                                </div>--}}
                        {{--                                                <h5 class="font-weight-bold">{{__('Facebook')}} {{__('Engagement')}}</h5>--}}
                        {{--                                                <p>{{__('helps media organizations, brands, and public figures understand their audience, the success of posts, and the health of')}} {{__('their Pages over time')}}</p>--}}
                        {{--                                                <button class="btn btn-warning next btn-sm ml-2">Select</button>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        <!--Social-->
                            {{--                                <div class="row scs" style="display:none;">--}}
                            {{--                                    <div class="col-lg-4 col-sm-6 col-12">--}}
                            {{--                                        <div class="card">--}}
                            {{--                                            <div class="card-body text-center">--}}
                            {{--                                                <div class="cardImage">--}}
                            {{--                                                    <img--}}
                            {{--                                                        src="https://i.pinimg.com/originals/11/f6/a1/11f6a1db1fc35782d9b1a664702c5c33.png">--}}
                            {{--                                                </div>--}}
                            {{--                                                <h5 class="font-weight-bold">{{__('Facebook Page')}} {{__('Insight')}}</h5>--}}
                            {{--                                                <p>{{__('Design your own dashboard with our Drag & Drop Widgets.Fully customizable, with the ability to save it as a')}}--}}
                            {{--                                                    {{__('template for future use.')}}--}}
                            {{--                                                </p>--}}
                            {{--                                                <button--}}
                            {{--                                                    class="btn btn-warning next btn-sm ml-2">{{__('Select')}}</button>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-lg-4 col-sm-6 col-12">--}}
                            {{--                                        <div class="card">--}}
                            {{--                                            <div class="card-body text-center">--}}
                            {{--                                                <div class="cardImage">--}}
                            {{--                                                    <img--}}
                            {{--                                                        src="https://www.vhv.rs/dpng/d/105-1052116_online-reputation-dashboard-hd-png-download.png">--}}
                            {{--                                                </div>--}}
                            {{--                                                <h5 class="font-weight-bold">{{__('Facebook')}} {{__('Ads')}}</h5>--}}
                            {{--                                                <p>{{__('shows you how your advertising is helping you achieve your business goals across Facebook,Instagram and Audience Network')}}--}}
                            {{--                                                </p>--}}
                            {{--                                                <button class="btn btn-warning next btn-sm ml-2">Select</button>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-lg-4 col-sm-6 col-12">--}}
                            {{--                                        <div class="card">--}}
                            {{--                                            <div class="card-body text-center">--}}
                            {{--                                                <div class="cardImage">--}}
                            {{--                                                    <img--}}
                            {{--                                                        src="https://as2.ftcdn.net/v2/jpg/02/32/92/69/500_F_232926981_9k5hyZdmf5fBP1gVO4LS1zbXd0hhOBtO.jpg">--}}
                            {{--                                                </div>--}}
                            {{--                                                <h5 class="font-weight-bold">{{__('Facebook')}} {{__('Engagement')}}</h5>--}}
                            {{--                                                <p>{{__('helps media organizations, brands, and public figures understand their audience, the success of posts, and the health of')}} {{__('their Pages over time')}}</p>--}}
                            {{--                                                <button class="btn btn-warning next btn-sm ml-2">Select</button>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                        </div>
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
                        <div class="chose-platform-page line white"></div>
                        <div class="steps-block__step">
                            <div class="steps-block__step-circle white">
                                <p class="steps-block__step-text white-color font-16-lh-34-light">{{__('Finalize')}}</p>
                            </div>
                        </div>
                    </div>
                    <a class="font-16-lh-26-medium skip-connection-link"
                       href="{{url('signup/step-4')}}"
                    >{{__('Skip Dashboard')}}
                    </a>
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
        </div>
    </div>
    <script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('assets/js/popper.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('assets/js/bootstrap.min.js')!!}"></script>
    <script>
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
    </script>
    <script type="text/javascript">
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
        let alerted = false;

        $(".submit").on("click", function () {
            return false;
        });

        $(".steps li:nth-of-type(1)").addClass("active");
        $(".myContainer .form-container:nth-of-type(1)").addClass("active");

        // $(".form-container").on("click", ".next", function () {
        //     $(".steps li").eq($(this).parents(".form-container").index() + 1).addClass("active");
        //     $(this).parents(".form-container").removeClass("active").next().addClass("active flipInX");
        // });

        // $(".form-container").on("click", ".back", function () {
        //     $(".steps li").eq($(this).parents(".form-container").index() - totalSteps).removeClass("active");
        //     $(this).parents(".form-container").removeClass("active flipInX").prev().addClass("active flipInY");
        // });


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

        function chooseTemplates(name){
            $.ajax({
                url: '{{url('/create-dashboard')}}',
                method: "post",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: name,
                },
                dataType: 'json',
                success: (response) => {
                    window.location.href = '{{url('/signup/step-4')}}';
                },
                error: () => {
                    if (!alerted) toastr.warning('{{__('error')}}');
                    alerted = true
                }
            });
        }
    </script>
    </body>
    @include('frontend.components.cookie')
@endsection

