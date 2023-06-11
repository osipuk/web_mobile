@section('metahead')
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
    <title>{{__('Facebook Ads')}}</title>
@endsection
@extends('layout.userhead')
@section('title', 'User Home')
<div class="page-wrapper chiller-theme toggled">
    @section('content')

        @extends('layout.usersidenav')
        <style type="text/css">
            .table thead th {
                vertical-align: bottom !important;
                border-bottom: 2px solid #356792 !important;
            }

            .my-table .table td, .table th {
                padding: 0.75rem !important;
                vertical-align: top !important;
                border-top: 1px solid #dee2e6 !important;
            }

            .my-table .table th {
                padding: 0.75rem !important;
                vertical-align: top !important;
            }

            #mybasis .dashboard-data-1 {

                flex-basis: auto;

            }

            #mybasis .dashboard-data-1 i {

                color: #ff9a41;

                font-size: 36px;

                margin-left: 16px;

            }

            .cont-top-ad {
                max-width: 1050px;
            }

            .top-ad {
                margin: 0 5px;
            }

            .top-ad li {
                display: inline-block;
                padding: 0px 2px;
                font-size: 13px;
                font-weight: 600;
            }

            .top-ad li samp {
                /* font-family: gilroy-font-light; */
                border-bottom: 2px solid #f48a1d;
                padding-bottom: 5px;
                line-height: 30px;
            }

            .dashboard-data-1 img {
                height: 50px;
                transform: translateY(-9px);
                margin-left: 20px;
            }

            .fb {
                color: #007bff;
            }

            .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
                position: relative;
                width: 100%;
                padding-right: 5px !important;
                padding-left: 10px !important;
            }

            .card {
                border-radius: 5px !important;
                margin-bottom: 10px;
            }

            .row {
                dispay: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                margin-right: -10px;
                margin-left: -10px;
            }
        </style>
        <main class="page-content pb-5">
            <div class="container-fluid main-content-wrapper">
                <nav class="navbar navbar-expand-lg bg-transparent user-navbar pl-0 pr-0">
                    <div class="container-fluid">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item font-50-lh-114-regular">
                                {{__('Home')}}
                            </li>
                        </ul>
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"
                                   href="#" id="navbarDropdown"
                                   role="button"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                >
                     <span class="main-notify">
                     <i class="fas notification-icon"></i>
                     <span class="notify-circle"></span>
                     </span>
                                </a>
                                <div class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        {{__('Notification')}}<br>
                                        <span><small>Lorem ipsum dolor sit amet</small></span>
                                    </a>
                                    <a class="dropdown-item" href="#">Notification<br>
                                        <span><small>Lorem ipsum dolor sit amet</small></span></a>
                                    <a class="dropdown-item" href="#">Notification<br>
                                        <span><small>Lorem ipsum dolor sit amet</small></span></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{{url('/assets/image_new/user-avatar.png')}}}" class="rounded-circle"
                                         height="40" width="40">
                                </a>
                                <div class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        {{__('Profile')}}
                                    </a>
                                    <a class="dropdown-item" href="#">{{__('Log Out')}}</a>
                                </div>
                            </li>
                            <!--<li class="nav-item">-->
                            <!--   <a class="nav-link" href="#"><img src="http://afdalanalytics.com/joywebsite-new/public/assets/image/homelogo.jpg" class="rounded" height="40" width="40"></a>-->
                            <!--</li>-->
                        </ul>
                    </div>
                </nav>
                <div class="row mb-5 justify-content-between">
                    <div class="col-lg-9 col-sm-9 col-12">
                        <div class="dashboard-tabs">
                            <ul class="nav nav-pills">
                                @if(Auth::user() && Auth::user()->company->social_account_facebook->isNotEmpty())
                                    <li class="nav-item">
                                        <a class="nav-link font-24-lh-29-medium pr-0"
                                           href="{{url('facebook/overview')}}">
                                            <p class="mb-0">{{__('Page')}}</p>
                                            <div class="nav-icon facebook-gray"></div>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link active font-24-lh-29-medium"
                                      href="{{url('facebook/ads')}}"
                                    >
                                        <p class="mb-0">{{__('Ads')}}</p>
                                        <div class="nav-icon facebook"></div>
                                    </a>
                                </li>
                                @if(Auth::user() && Auth::user()->company->social_account_facebook->isNotEmpty())
                                    <li class="nav-item">
                                        <a class="nav-link font-24-lh-29-medium pr-0"
                                           href="{{url('facebook/overview')}}">
                                            <p class="mb-0">{{__('Page')}}</p>
                                            <div class="nav-icon facebook-gray"></div>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user() && Auth::user()->company->social_account_twitter->isNotEmpty())
                                    <li class="nav-item">
                                        <a class="nav-link font-24-lh-29-medium"
                                           href="{{url('twitterperformance')}}"
                                        >
                                            <p class="mb-0">{{__('Twitter')}}</p>
                                            <div class="nav-icon twitter-gray"></div>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user() && Auth::user()->company->social_account_instagram->isNotEmpty())
                                    <li class="nav-item">
                                        <a class="nav-link font-24-lh-29-medium"
                                          href="{{url('/instagram/overview')}}"
                                        >
                                            <p class="mb-0">{{__('Instagram')}}</p>
                                            <div class="nav-icon insta-gray"></div>
                                        </a>
                                    </li>
                                @endif
                                {{-- <li class="nav-item">
                                    <a class="nav-link font-24-lh-29-medium" href="#">
                                        <p class="mb-0">{{__('Google Play')}}</p>
                                        <div class="nav-icon google-play-gray"></div>
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link font-24-lh-29-medium rounded-circle shadow p-0 d-flex justify-content-center align-items-center plus-icon"
                                       href="/connections"></a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="date-wrapper col-md-3 col-sm-3 col-12 d-flex justify-content-end">

                        <div class="date-info">
                            <p class="date-period font-13-lh-16-light">
                              {{__('Last 30 days')}}
                            </p>
                            <p class="date-range font-13-lh-16-medium ">
                                31/01/2022 - 01/01/2022
                            </p>
                        </div>

                        <a href="#"
                           class="btn btn-white btn-circle text-warning waves-effect waves-light calendar-button mr-2"></a>
                        <a href="#" class="d-flex">
                            <div class="date-picker">
                            </div>
                            <div
                                class="btn btn-white btn-circle text-warning waves-effect waves-light etc-button mr-3"></div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab-pane active " id="ads-page">
                            {{--                   <div class="row"> -->--}}
                            {{--                 <div class="col-md-12 col-xs-12">--}}
                            {{--             <div class="card">--}}
                            {{--                           <div class="card-body text-center">--}}
                            {{--                              <h5 class="font-weight-bold textBlue">{{__('Facebook Engagement Overview')}}</h5>--}}
                            {{--                           </div>--}}
                            {{--                        </div>--}}
                            {{--                     </div>--}}
                            {{--                  </div>--}}
                            <div class="row">
                                <div class="col-lg-4 col-xs-12">
                                    <div class="card small-card-height">
                                        <div class="card-body  text-right">
                                            <div class="top-content">
                                                <h5 class="font-21-lh-25-bold card__title">{{__('Impressions')}} </h5>
                                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of times your ads were shown.')}}</p>
                                            </div>
                                            <div class="d-flex-dashbard-data mt-2 " id="mybasis">
                                                <div class="dashboard-data-1 text-left">
                                                    <img src="{{{url('/assets/image/icon/dashnoard-impressions.svg')}}}">
                                                </div>
                                                <div class="dashboard-data-2 text-right">
                                                    <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Impressions')}}</p>
                                                    <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">111</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card small-card-height">
                                        <div class="card-body text-right">
                                            <h5 class="font-21-lh-25-bold card__title">{{__('Click Through Rate')}}</h5>
                                            <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of clicks that your ad receives is divided by the number of times your ad is shown.')}}</p>
                                            <div class="d-flex-dashbard-data mt-2" id="mybasis">
                                                <div class="dashboard-data-1 text-left">
                                                    <img src="{{{url('/assets/image_new/svg/colored/click-rate.svg')}}}">
                                                </div>
                                                <div class="dashboard-data-2 text-right">
                                                    <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Rate')}}</p>
                                                    <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">222</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-xs-12">
                                    <div class="card big-card-height">
                                        <div class="card-body text-right">
                                            <h5 class="font-21-lh-25-bold card__title">{{__('Total Page Impressions And Clicks Over Time')}}  </h5>
                                            <p class="font-16-lh-19-regular card__title-text">{{__('The number of times your ads were shown combined with clicks on the ads.')}}</p>
                                            <div id="impressionsAndClicksChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-xs-12">
                                    <div class="card small-card-height">
                                        <div class="card-body text-right">
                                            <h5 class="font-21-lh-25-bold card__title">{{__('Total Clicks')}}</h5>
                                            <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Includes link clicks as well as clicks on other parts of your ad (ex: someone clicks on your Page\'s name)')}}</p>
                                            <div class="d-flex-dashbard-data mt-2" id="mybasis">
                                                <div class="dashboard-data-1 text-left">
                                                    <img
                                                        src="{{{url('/assets/image_new/svg/colored/click.svg')}}}">
                                                </div>
                                                <div class="dashboard-data-2 text-right">
                                                    <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Clicks')}}</p>
                                                    <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">333</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <div class="card small-card-height">
                                        <div class="card-body text-right">
                                            <h5 class="font-21-lh-25-bold card__title">{{__('Cost Per Click')}} </h5>
                                            <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The price you paid for each link click on your Facebook ad')}} </p>
                                            <div class="d-flex-dashbard-data mt-2" id="mybasis">
                                                <div class="dashboard-data-1 text-left">
                                                    <img
                                                        src="{{{url('/assets/image_new/svg/colored/click-cost.svg')}}}">
                                                </div>
                                                <div class="dashboard-data-2 text-right">
                                                    <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Cost')}} </p>
                                                    <h3 class="font-37-lh-44-bold mb-0 card__total-title-count"> 444 </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <div class="card small-card-height">
                                        <div class="card-body text-right">
                                            <h5 class="font-21-lh-25-bold card__title">{{__('Total Link Clicks')}} </h5>
                                            <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of clicks on links to select destinations or experiences, on or off Facebook-owned properties')}}</p>
                                            <div class="d-flex-dashbard-data mt-3" id="mybasis">
                                                <div class="dashboard-data-1 text-left">
                                                    <img
                                                        src="{{{url('/assets/image_new/svg/colored/total-link-clicks.svg')}}}">
                                                </div>
                                                <div class="dashboard-data-2 text-right">
                                                    <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Link Clicks')}}</p>
                                                    <h3 class="font-37-lh-44-bold mb-0 card__total-title-count"> 666 </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-8 col-xs-12">
                                <div class="card overflow-auto big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Top Ad Sets')}}</h5>
                                        <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('The top-performing ad campaigns.')}}</p>
                                        <div class="my-table table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col"
                                                        class="font-16-lh-19-semi-bold">{{__('Campaigns')}}</th>
                                                    <th scope="col"
                                                        class="font-16-lh-19-semi-bold">{{__('Clicks (all)')}}</th>
                                                    <th scope="col"
                                                        class="font-16-lh-19-semi-bold">{{__('CTR (all)')}}</th>
                                                    <th scope="col"
                                                        class="font-16-lh-19-semi-bold">{{__('CPC (all)')}}</th>
                                                    <th scope="col"
                                                        class="font-16-lh-19-semi-bold">{{__('Impressions')}}</th>
                                                    <th scope="col"
                                                        class="font-16-lh-19-semi-bold">{{__('Total Spent')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">New York</th>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Roxboro</th>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Milan</th>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Sydney</th>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">London</th>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                    <td class="font-13-lh-20-regular">123,362</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-lg-4 col-xs-12">
                                    <div class="card big-card-height">
                                        <div class="card-body text-right">
                                            <h5 class="font-21-lh-25-bold card__title">{{__('Ads Conversion Funnel')}}</h5>
                                            <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The flow and conversion path of potential customers into paying customers from Facebook Ads.')}}</p>
                                            <div class="ads-conversion-chart" id="adsConversionChart">
                                            </div>
                                            <div class="ads-conversion-table">
                                              <div class="data-sheet-metric" id="adsConversionImpressions"></div>
                                              <div class="data-sheet-metric data-sheet-metric--background-light-blue" id="adsConversionReach"></div>
                                              <div class="data-sheet-metric" id="adsConversionClicks"></div>
                                              <div class="ads-conversion-line"></div>
                                              <div class="data-sheet-metric" id="adsConversionConversion"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body  text-right">
                                        <div class="top-content">
                                            <h5 class="font-21-lh-25-bold card__title">{{__('Average Cost To Reach 1000 Users')}} </h5>
                                            <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of people exposed to your message and how efficiently you reached them')}}</p>
                                        </div>
                                        <div class="d-flex-dashbard-data mt-2 " id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                              <img src="{{{url('/assets/image_new/svg/colored/radio-tower-dollar.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Cost')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">$99</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Total Spent On Ads')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total amount of money you\'ve spent across all your campaigns during a time period.')}}</p>
                                        <div class="d-flex-dashbard-data mt-2" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img src="{{{url('/assets/image_new/svg/colored/cost.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Cost')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">$7.40</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-lg-8 col-xs-12">
                                  <div class="card big-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Spend Vs Revenue')}}  </h5>
                                          <p class="font-16-lh-19-regular card__title-text">{{__('The total ad spend vs the revenue generated according to Facebook pixel conversion value.')}}</p>
                                          <div id="spendVsRevenueChart"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-4 col-xs-12">
                              <div class="card small-card-height">
                                <div class="card-body  text-right">
                                    <div class="top-content">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Average Cost For 1000 Impressions')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('the total amount spent on an ad campaign, divided by impressions, multiplied by 1,000')}}</p>
                                    </div>
                                    <div class="d-flex-dashbard-data mt-2 " id="mybasis">
                                        <div class="dashboard-data-1 text-left">
                                            <img
                                                        src="{{{url('/assets/image_new/svg/colored/eye-dollar.svg')}}}">
                                        </div>
                                        <div class="dashboard-data-2 text-right">
                                            <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Cost')}}</p>
                                            <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">$3.50</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card small-card-height">
                                <div class="card-body text-right">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Link Clicks')}}</h5>
                                    <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of people who performed a link click.')}}</p>
                                    <div class="ads-conversion-table">
                                      <div class="data-sheet-metric">
                                        <div class="data-sheet-info">
                                          <p class="data-sheet-text">{{__('Link clicks')}}</p>
                                        </div>
                                        <p class="data-sheet-data">2000 (100%)</p>
                                      </div>
                                      <div class="data-sheet-metric data-sheet-metric--background-light-blue">
                                        <div class="data-sheet-info">
                                          <p class="data-sheet-text">{{__('Link click through rate')}}</p>
                                        </div>
                                        <p class="data-sheet-data">2000 (100%)</p>
                                      </div>
                                      <div class="data-sheet-metric">
                                        <div class="data-sheet-info">
                                          <p class="data-sheet-text">{{__('Cost per link click')}}</p>
                                        </div>
                                        <p class="data-sheet-data">2000 (100%)</p>
                                      </div>

                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-8 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Return On Advertising Spend')}}  </h5>
                                        <p class="font-16-lh-19-regular card__title-text">{{__('The total revenue generated according to Facebook pixel conversion value.')}}</p>
                                        <div id="advertisingReturnChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            @if(!empty($page))
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="card">
                                            <div class="card-body text-right">
                                                <h5 class="font-21-lh-25-bold card__title">{{__('Top Performing Ads')}}</h5>
                                                <p class="font-16-lh-19-regular mb-2 card__title-text">{{__('The top-performing Post by engagement over a set period')}}</p>
                                            </div>
                                            <div class="container-flow pl-5 pr-5">
                                                <ul class="post-card-info-list">
                                                    @foreach($page->post as $post)
                                                        <li class="post-card-item col-lg-6 col-xs-12">
                                                            <img class="post-card-item-image"
                                                                 src="{{!empty($post->image) ? $post->image : url('/assets/image_new/svg/colored/image-placeholder.svg')}}"
                                                                 alt="image">
                                                            <div class="post-card-item-message">
                                                                <div class="post-card-item-message-name font-13-lh-16-medium">{{__('Message')}}
                                                                    <div class="message-orange-line"></div>
                                                                </div>
                                                                <p class="post-card-item-message-text font-16-lh-19-regular">
                                                                    {{Str::limit($post->text, 200)}}
                                                                </p>
                                                            </div>
                                                            <ul class="post-card-info">
                                                                <li class="post-card-data">
                                                                    <p class="post-card-data-name font-13-lh-16-medium mb-1">
                                                                    {{__('Post Impressions')}}
                                                                    </p>
                                                                    <div class="orange-line"></div>
                                                                    <p class="post-card-data-value">
                                                                        {{$post->impressions}}
                                                                    </p>
                                                                </li>
                                                                <li class="post-card-data">
                                                                    <p class="post-card-data-name font-13-lh-16-medium mb-1">
                                                                    {{__('Post Clicks')}}
                                                                    </p>
                                                                    <div class="orange-line"></div>
                                                                    <p class="post-card-data-value">
                                                                        {{$post->clicks}}
                                                                    </p>
                                                                </li>
                                                                <li class="post-card-data">
                                                                    <p class="post-card-data-name font-13-lh-16-medium mb-1">
                                                                    {{__('Post Engaged Users')}}
                                                                    </p>
                                                                    <div class="orange-line"></div>
                                                                    <p class="post-card-data-value">
                                                                        {{$post->engaged}}
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">

    // Data

  let impressionsAndClicksData = {
    impressions: [1, 2, 3],
    clicks: [10, 20, 30],
    dates: [29, 30, 31],
  }

  let spendVsRevenueData = {
    spent: [1, 2, 3],
    revenue: [10, 20, 30],
    dates: [29, 30, 31],
  }

  let adsConversionData = {
    impressions: 100,
    reach: 50,
    clicks: 20,
  };

  let engagementData = {
    engagedUserCount:  [1, 2, 3, 4, 5],
    dates:  ['1', '2', '3', '4', '5'],
  };

  let distributionData = {
    postCount: [1, 2, 3],
    engagedUsersCount: [1, 2, 3],
    dates: ['1', '2', '3'],
  };

  let uniqueLinkClicksData = {
    clicks: 10,
    clicksRate: 5,
    cost: 2,
  };

  let linkClicksData = {
    clicks: 10,
    clicksRate: 5,
    cost: 2,
  };

  let advertisingReturnData = {
    revenue: [10, 20, 30],
    dates: [29, 30, 31],
  };

  // Total Page Impressions And Clicks Over Time

    var impressionsAndClicksOptions = {
        series: [{
            name: '{{__('Clicks')}}',
            data: impressionsAndClicksData.clicks,
        }, {
            name: '{{__('Impressions')}}',
            data: impressionsAndClicksData.impressions,
        }],
        chart: {
            height: 280,
            type: 'area',
            toolbar: {
                show: false,
            },
            zoom: {
              enabled: false,
            },
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#F58B1E', '#356792'],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                shadeIntensity: 0.5,
                type: 'vertical',
                opacityFrom: [0.8, 0.8],
                opacityTo: [0, 0],
            },
        },
        stroke: {
            curve: 'smooth',
            width: 2,
        },
        xaxis: {
            type: '',
            categories: impressionsAndClicksData.dates.map(date => {
               if(date.length === 10) {
                 return date.slice(5)
                };
                return date;
              }),
            labels: {
                style: {
                    colors: '#B0BBCB',
                },
            },
        },
        yaxis: [
        //   {
        //     labels: {
        //         align: 'left',
        //         offsetX: 28,
        //         style: {
        //             colors: '#B0BBCB',
        //         },
        //     },
        // },
            {
                opposite: true,
                labels: {
                    align: 'right',
                    offsetX: 15,
                    style: {
                        colors: '#B0BBCB',
                    },
                },
            }
        ],
        legend: {
            show: true,
            fontSize: '14px',
            fontFamily: 'NotoSansArabic-Regular',
            fontWeight: 400,
            position: 'top',
            horizontalAlign: 'left',
            inverseOrder: 'true',
        },
        markers: {
            size: [3, 3],
            colors: ['#fff', '#fff'],
            strokeColors: ['#F58B1E', '#356792'],
            hover: {
                sizeOffset: 2,
            }
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
        noData: {
        text: '{{__('No data available')}}',
        align: 'center',
        verticalAlign: 'middle',
        offsetX: 0,
        offsetY: 0,
        style: {
          color: undefined,
          fontSize: '18px',
          fontFamily: undefined
        }
      },
    };

    const impressionsAndClicksChart = new ApexCharts(document.querySelector("#impressionsAndClicksChart"), impressionsAndClicksOptions);
    impressionsAndClicksChart.render();

  // Spend Vs Revenue

    var spendVsRevenueOptions = {
      series: [{
          name: '{{__('Total Spent')}}',
          data: spendVsRevenueData.spent,
      }, {
          name: '{{__('Website Purchases')}}',
          data: spendVsRevenueData.revenue,
      }],
      chart: {
          height: 280,
          type: 'area',
          toolbar: {
              show: false,
          },
          zoom: {
            enabled: false,
          },
      },
      dataLabels: {
          enabled: false
      },
      colors: ['#F58B1E', '#356792'],
      fill: {
          type: 'gradient',
          gradient: {
              shade: 'light',
              shadeIntensity: 0.5,
              type: 'vertical',
              opacityFrom: [0.8, 0.8],
              opacityTo: [0, 0],
          },
      },
      stroke: {
          curve: 'smooth',
          width: 2,
      },
      xaxis: {
          type: '',
          categories: spendVsRevenueData.dates.map(date => {
              if(date.length === 10) {
                return date.slice(5)
              };
              return date;
            }),
          labels: {
              style: {
                  colors: '#B0BBCB',
              },
          },
      },
      yaxis: [
      //   {
      //     labels: {
      //         align: 'left',
      //         offsetX: 28,
      //         style: {
      //             colors: '#B0BBCB',
      //         },
      //     },
      // },
          {
              opposite: true,
              labels: {
                  align: 'right',
                  offsetX: 15,
                  style: {
                      colors: '#B0BBCB',
                  },
              },
          }
      ],
      legend: {
          show: true,
          fontSize: '14px',
          fontFamily: 'NotoSansArabic-Regular',
          fontWeight: 400,
          position: 'top',
          horizontalAlign: 'left',
          inverseOrder: 'true',
      },
      markers: {
          size: [3, 3],
          colors: ['#fff', '#fff'],
          strokeColors: ['#F58B1E', '#356792'],
          hover: {
              sizeOffset: 2,
          }
      },
      tooltip: {
          x: {
              format: 'dd/MM/yy HH:mm'
          },
      },
      noData: {
      text: '{{__('No data available')}}',
      align: 'center',
      verticalAlign: 'middle',
      offsetX: 0,
      offsetY: 0,
      style: {
        color: undefined,
        fontSize: '18px',
        fontFamily: undefined
      }
    },
  };

  const spendVsRevenueChart = new ApexCharts(document.querySelector("#spendVsRevenueChart"), spendVsRevenueOptions);
  spendVsRevenueChart.render();

   // Return On Advertising Spend

   var advertisingReturnOptions = {
      series: [{
          name: '{{__('Website Purchases')}}',
          data: advertisingReturnData.revenue,
      }],
      chart: {
          height: 280,
          type: 'area',
          toolbar: {
              show: false,
          },
          zoom: {
            enabled: false,
          },
      },
      dataLabels: {
          enabled: false
      },
      colors: ['#F58B1E', '#356792'],
      fill: {
          type: 'gradient',
          gradient: {
              shade: 'light',
              shadeIntensity: 0.5,
              type: 'vertical',
              opacityFrom: [0.8, 0.8],
              opacityTo: [0, 0],
          },
      },
      stroke: {
          curve: 'smooth',
          width: 2,
      },
      xaxis: {
          type: '',
          categories: advertisingReturnData.dates.map(date => {
              if(date.length === 10) {
                return date.slice(5)
              };
              return date;
            }),
          labels: {
              style: {
                  colors: '#B0BBCB',
              },
          },
      },
      yaxis: [
      //   {
      //     labels: {
      //         align: 'left',
      //         offsetX: 28,
      //         style: {
      //             colors: '#B0BBCB',
      //         },
      //     },
      // },
          {
              opposite: true,
              labels: {
                  align: 'right',
                  offsetX: 15,
                  style: {
                      colors: '#B0BBCB',
                  },
              },
          }
      ],
      legend: {
          show: true,
          fontSize: '14px',
          fontFamily: 'NotoSansArabic-Regular',
          fontWeight: 400,
          position: 'top',
          horizontalAlign: 'left',
          inverseOrder: 'true',
      },
      markers: {
          size: [3, 3],
          colors: ['#fff', '#fff'],
          strokeColors: ['#F58B1E', '#356792'],
          hover: {
              sizeOffset: 2,
          }
      },
      tooltip: {
          x: {
              format: 'dd/MM/yy HH:mm'
          },
      },
      noData: {
      text: '{{__('No data available')}}',
      align: 'center',
      verticalAlign: 'middle',
      offsetX: 0,
      offsetY: 0,
      style: {
        color: undefined,
        fontSize: '18px',
        fontFamily: undefined
      }
    },
  };

  const advertisingReturnChart = new ApexCharts(document.querySelector("#advertisingReturnChart"), advertisingReturnOptions);
  advertisingReturnChart.render();

  // Ads conversion Funnel

  const pageImpressionsNumber = adsConversionData.impressions;
  const reachNumber = adsConversionData.reach;
  const clicksNumber = adsConversionData.clicks;

  let reachPercent = 0;
  let clicksPercent = 0;

  if (pageImpressionsNumber > 0) {
    reachPercent = Math.round(
      (reachNumber / pageImpressionsNumber * 100) * 100
    ) / 100;
    clicksPercent = Math.round(
      (clicksNumber / pageImpressionsNumber * 100) * 100
    ) / 100;
  };

  let clicksToReachPercent = 0;

  if (reachPercent > 0) {
    clicksToReachPercent = Math.round(
      (clicksPercent / reachPercent * 100) * 100
    ) / 100;
  };

  const totalConversion = Math.round(reachPercent * clicksToReachPercent) / 100;

  const impressionsElement = document.querySelector('#adsConversionImpressions');
  const reachElement = document.querySelector('#adsConversionReach');
  const clickElement = document.querySelector('#adsConversionClicks');
  const conversionElement = document.querySelector('#adsConversionConversion');
  const graph = document.querySelector('#adsConversionChart');

  const colorOrange = '#FF9A41';
  const colorBlue = '#356792';
  const colorDarkBlue = '#0B243A';

  impressionsElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: ${colorOrange}"></div>
    <p class="data-sheet-text">${'{{__('Impressions')}}'}</p>
  </div>
  <p class="data-sheet-data">${pageImpressionsNumber} (100%)</p>
  `;

  reachElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: ${colorBlue}"></div>
    <p class="data-sheet-text">${'{{__('Reach')}}'}</p>
  </div>
  <p class="data-sheet-data">${reachNumber} (${reachPercent}%)</p>
  `;

  clickElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: ${colorDarkBlue}"></div>
    <p class="data-sheet-text">${'{{__('Clicks')}}'}</p>
  </div>
  <p class="data-sheet-data">${clicksNumber} (${clicksToReachPercent}%)</p>
  `;

  conversionElement.innerHTML = `
  <div class="data-sheet-info">
    <p class="data-sheet-text">${'{{__('Conversion')}}'}</p>
  </div>
  <p class="data-sheet-data">${totalConversion}%</p>
  `;

  graph.setAttribute('style',`background: linear-gradient(0deg, ${colorDarkBlue} ${clicksPercent}%, ${colorBlue} ${clicksPercent}% ${reachPercent}%, ${colorOrange} ${reachPercent}% 100%)`);

  // Unique Link Clicks

  const uniqueLinkClicksElement = document.querySelector('#uniqueLinkClicks');
  const uniqueLinkClicksRateElement = document.querySelector('#uniqueLinkClicksRate');
  const costPerUniqueClickElement = document.querySelector('#costPerUniqueClick');

  const totalUniqueCount = Object.values(uniqueLinkClicksData).reduce(
    (sum, current) => {
      return sum + current;
    }, 0);

  function findUniqueLinkClicksPercent (data) {
    if (totalUniqueCount === 0) {
      return 0;
    }
    return Math.round(
      (data / totalUniqueCount * 100) * 100
    ) / 100;
  };

  uniqueLinkClicksElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: #FF9A41"></div>
    <p class="data-sheet-text">${'{{__('Unique link clicks')}}'}</p>
  </div>
  <p class="data-sheet-data">${uniqueLinkClicksData.clicks} (${findUniqueLinkClicksPercent(uniqueLinkClicksData.clicks)}%)</p>
  `;

  uniqueLinkClicksRateElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: #356792"></div>
    <p class="data-sheet-text">${'{{__('Unique link click through rate')}}'}</p>
  </div>
  <p class="data-sheet-data">${uniqueLinkClicksData.clicksRate} (${findUniqueLinkClicksPercent(uniqueLinkClicksData.clicksRate)}%)</p>
  `;

  costPerUniqueClickElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: #545454"></div>
    <p class="data-sheet-text">${'{{__('Cost per unique link click')}}'}</p>
  </div>
  <p class="data-sheet-data">${uniqueLinkClicksData.cost} (${findUniqueLinkClicksPercent(uniqueLinkClicksData.cost)}%)</p>
  `;

  uniqueLinkClicksData = [
    uniqueLinkClicksData.clicks,
    uniqueLinkClicksData.clicksRate,
    uniqueLinkClicksData.cost,
  ];

  if (uniqueLinkClicksData.every(data => data === 0)) {
    uniqueLinkClicksData = [];
  }

  console.log(uniqueLinkClicksData);

  var uniqueLinkClicksChartOpt = {
    series: uniqueLinkClicksData,
    chart: {
        height: 200,
        type: 'pie'
    },
    labels: ['{{__('Unique link clicks')}}', '{{__('Unique link click through rate')}}', '{{__('Cost per unique link click')}}'],
    dataLabels: {
        enabled: false,
    },
    fill: {
        opacity: 1
    },
    stroke: {
        width: 1,
        colors: undefined
    },
    colors: ['#FF9A41', '#356792', '#545454'],
    yaxis: {
        show: false,
    },
    legend: {
      show: false,
    },
    plotOptions: {
        polarArea: {
            rings: {
                strokeWidth: 0
            },
            spokes: {
                strokeWidth: 0
            },
        }
    },
    noData: {
        text: '{{__('No data available')}}',
        align: 'center',
        verticalAlign: 'middle',
        offsetX: 0,
        offsetY: 0,
        style: {
          color: undefined,
          fontSize: '18px',
          fontFamily: undefined
        }
    },
  };

  const uniqueLinkClicksChart = new ApexCharts(document.querySelector("#uniqueLinkClicksChart"), uniqueLinkClicksChartOpt);
  uniqueLinkClicksChart.render();

  // Link Clicks

  const linkClicksElement = document.querySelector('#linkClicks');
  const linkClicksRateElement = document.querySelector('#linkClicksRate');
  const costPerClickElement = document.querySelector('#costPerClick');

  const totalCount = Object.values(linkClicksData).reduce(
    (sum, current) => {
      return sum + current;
    }, 0);

  function findlinkClicksPercent (data) {
    if (totalCount === 0) {
      return 0;
    }
    return Math.round(
      (data / totalCount * 100) * 100
    ) / 100;
  };

  linkClicksElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: #FF9A41"></div>
    <p class="data-sheet-text">${'{{__('Link clicks')}}'}</p>
  </div>
  <p class="data-sheet-data">${linkClicksData.clicks} (${findlinkClicksPercent(linkClicksData.clicks)}%)</p>
  `;

  linkClicksRateElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: #356792"></div>
    <p class="data-sheet-text">${'{{__('Link click through rate')}}'}</p>
  </div>
  <p class="data-sheet-data">${linkClicksData.clicksRate} (${findlinkClicksPercent(linkClicksData.clicksRate)}%)</p>
  `;

  costPerClickElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: #545454"></div>
    <p class="data-sheet-text">${'{{__('Cost per link click')}}'}</p>
  </div>
  <p class="data-sheet-data">${linkClicksData.cost} (${findlinkClicksPercent(linkClicksData.cost)}%)</p>
  `;

  linkClicksData = [
    linkClicksData.clicks,
    linkClicksData.clicksRate,
    linkClicksData.cost,
  ];

  if (linkClicksData.every(data => data === 0)) {
    linkClicksData = [];
  }

  console.log(linkClicksData);

  var linkClicksChartOpt = {
    series: linkClicksData,
    chart: {
        height: 200,
        type: 'pie'
    },
    labels: ['{{__('Link clicks')}}', '{{__('Link click through rate')}}', '{{__('Cost per link click')}}'],
    dataLabels: {
        enabled: false,
    },
    fill: {
        opacity: 1
    },
    stroke: {
        width: 1,
        colors: undefined
    },
    colors: ['#FF9A41', '#356792', '#545454'],
    yaxis: {
        show: false,
    },
    legend: {
      show: false,
    },
    plotOptions: {
        polarArea: {
            rings: {
                strokeWidth: 0
            },
            spokes: {
                strokeWidth: 0
            },
        }
    },
    noData: {
        text: '{{__('No data available')}}',
        align: 'center',
        verticalAlign: 'middle',
        offsetX: 0,
        offsetY: 0,
        style: {
          color: undefined,
          fontSize: '18px',
          fontFamily: undefined
        }
    },
  };

  const linkClicksChart = new ApexCharts(document.querySelector("#linkClicksChart"), linkClicksChartOpt);
  linkClicksChart.render();

</script>
@endsection
