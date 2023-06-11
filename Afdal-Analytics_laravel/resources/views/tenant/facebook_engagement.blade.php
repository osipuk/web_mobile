@section('metahead')
  <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
    <title>{{__('Facebook Engagement ')}}</title>
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
                              <li class="nav-item">
                                  <a class="nav-link font-24-lh-29-medium pr-0"
                                     href="{{url('facebook/overview')}}">
                                      <p class="mb-0">{{__('Page')}}</p>
                                      <div class="nav-icon facebook-gray"></div>
                                  </a>
                              </li>
                              @if(Auth::user() && Auth::user()->social_account_facebook_ads->isNotEmpty())
                                  <li class="nav-item">
                                      <a class="nav-link font-24-lh-29-medium"
                                         href="{{url('facebook/ads')}}"
                                      >
                                          <p class="mb-0">{{__('Ads')}}</p>
                                          <div class="nav-icon facebook-gray"></div>
                                      </a>
                                  </li>
                              @endif
                              <li class="nav-item">
                                  <a class="nav-link active font-24-lh-29-medium"
                                      href="{{url('facebook/engagement')}}"
                                  >
                                      <p class="mb-0">{{__('Engagment')}}</p>
                                      <div class="nav-icon facebook"></div>
                                  </a>
                              </li>
                              @if(Auth::user() && Auth::user()->social_account_twitter->isNotEmpty())
                                  <li class="nav-item">
                                      <a class="nav-link font-24-lh-29-medium"
                                         href="{{url('twitterperformance')}}"
                                      >
                                          <p class="mb-0">{{__('Twitter')}}</p>
                                          <div class="nav-icon twitter-gray"></div>
                                      </a>
                                  </li>
                              @endif
                              @if(Auth::user() && Auth::user()->social_account_instagram->isNotEmpty())
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
                          <div class="row">
                              <div class="col-lg-4 col-xs-12">
                                  <div class="card small-card-height">
                                      <div class="card-body  text-right">
                                          <div class="top-content">
                                              <h5 class="font-21-lh-25-bold card__title">{{__('Total Page Likes')}} </h5>
                                              <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of people who your page reached')}}</p>
                                          </div>
                                          <div class="d-flex-dashbard-data" id="mybasis">
                                              <div class="dashboard-data-1 text-left">
                                                  <img src="{{{url('/assets/image_new/svg/colored/thumb-up.svg')}}}">
                                              </div>
                                              <div class="dashboard-data-2 text-right">
                                                  <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Total Page Likes')}}</p>
                                                  <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$total_likes}}</h3>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="card small-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Likes From News Feed')}}</h5>
                                          <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of people who liked your news feed')}}</p>
                                          <div class="d-flex-dashbard-data" id="mybasis">
                                              <div class="dashboard-data-1 text-left">
                                                  <img src="{{{url('/assets/image_new/svg/colored/news-like.svg')}}}">
                                              </div>
                                              <div class="dashboard-data-2 text-right">
                                                  <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Total likes from news feed')}}</p>
                                                  <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$news_feed_likes}}</h3>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-8 col-xs-12">
                                  <div class="card big-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Page Impressions & Reach')}}  </h5>
                                          <p class="font-16-lh-19-regular card__title-text">{{__('The total number of people who your page reached')}}</p>
                                          <div id="impressionsAndReachChart"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-lg-4 col-xs-12">
                                  <div class="card small-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Likes From Ads')}}</h5>
                                          <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of people who liked your ads')}}</p>
                                          <div class="d-flex-dashbard-data" id="mybasis">
                                              <div class="dashboard-data-1 text-left">
                                                  <img
                                                      src="{{{url('/assets/image_new/svg/colored/likes-from-ad.svg')}}}">
                                              </div>
                                              <div class="dashboard-data-2 text-right">
                                                  <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Total Page Likes')}}</p>
                                                  <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$ads_likes}}</h3>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-4 col-xs-12">
                                  <div class="card small-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Unique Post Impressions')}} </h5>
                                          <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of unique people the page posts were visible too')}} </p>
                                          <div class="d-flex-dashbard-data" id="mybasis">
                                              <div class="dashboard-data-1 text-left">
                                                  <img
                                                      src="{{{url('/assets/image_new/svg/colored/news-like.svg')}}}">
                                              </div>
                                              <div class="dashboard-data-2 text-right">
                                                  <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Post unique Impressions')}} </p>
                                                  <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                      {{$unique_post_impression}} </h3>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-4 col-xs-12">
                                  <div class="card small-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Total Reach')}} </h5>
                                          <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('People who saw any of the content related to your Facebook page')}}</p>
                                          <div class="d-flex-dashbard-data" id="mybasis">
                                              <div class="dashboard-data-1 text-left">
                                                  <img
                                                      src="{{{url('/assets/image_new/svg/colored/radio-tower.svg')}}}">
                                              </div>
                                              <div class="dashboard-data-2 text-right">
                                                  <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Reach')}}</p>
                                                  <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                      {{$unique_page_impression}} </h3>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                                <div class="col-lg-4 col-xs-12">
                                  <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Top Day To Post')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The best day to post according to the page followers')}} </p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/calendar.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Top Weekday for posting')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{__($page_top_day_post)}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="card small-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Top Time For Posting')}}</h5>
                                          <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The best time of day to post according to the page followers')}}</p>
                                          <div class="d-flex-dashbard-data" id="mybasis">
                                              <div class="dashboard-data-1 text-left">
                                                  <img
                                                      src="{{{url('/assets/image_new/svg/colored/clock.svg')}}}">
                                              </div>
                                              <div class="dashboard-data-2 text-right">
                                                  <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Time (pacific Standard Time)')}}</p>
                                                  <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$page_top_time_post}}:00</h3>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-4 col-xs-12">
                                  <div class="card big-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Unique Page Impressions By Type')}} </h5>
                                          <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The impressions on your page broken down by organic, paid, and viral')}}</p>
                                          <div id="pageImpressionsRadialChart"></div>
                                          <div class="impressions-table">
                                            <div class="data-sheet-metric" id="pageImpressionsPaid"></div>
                                            <div class="data-sheet-metric data-sheet-metric--background-light-blue" id="pageImpressionsOrganic"></div>
                                            <div class="data-sheet-metric" id="pageImpressionsViral"></div>
                                            <div class="data-sheet-metric data-sheet-metric--background-light-blue" id="pageImpressionsNonViral"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-4 col-xs-12">
                                  <div class="card big-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Unique Post Impressions By Type')}}</h5>
                                          <p class="font-16-lh-19-regular mb-0 card__title-text">{{__(' ')}}</p>
                                          <div id="postImpressionsRadialChart"></div>
                                          <div class="impressions-table">
                                            <div class="data-sheet-metric" id="impressionsPaid"></div>
                                            <div class="data-sheet-metric data-sheet-metric--background-light-blue" id="impressionsOrganic"></div>
                                            <div class="data-sheet-metric" id="impressionsViral"></div>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-4 col-xs-12">
                              <div class="card small-card-height">
                                  <div class="card-body text-right">
                                      <h5 class="font-21-lh-25-bold card__title">{{__('Post Reach By Fans')}} </h5>
                                      <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Total number of fans reach by a post')}}</p>
                                      <div class="d-flex-dashbard-data" id="mybasis">
                                          <div class="dashboard-data-1 text-left">
                                              <img src="{{{url('/assets/image_new/svg/colored/reach-by-fan.svg')}}}">
                                          </div>
                                          <div class="dashboard-data-2 text-right" style="flex-basis: 70%">
                                              <p class="mb-1 font-13-lh-16-medium card__total-title"> {{__('Post Unique Impression By Fans')}}</p>
                                              <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$page_impression_paid}}</h3>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="card small-card-height">
                                  <div class="card-body text-right">
                                      <h5 class="font-21-lh-25-bold card__title">{{__('Page Engagements')}} </h5>
                                      <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of actions taken on a post')}}</p>
                                      <div class="d-flex-dashbard-data" id="mybasis">
                                          <div class="dashboard-data-1 text-left">
                                              <img
                                                  src="{{{url('/assets/image/icon/page-engagement.svg')}}}">
                                          </div>
                                          <div class="dashboard-data-2 text-right">
                                              <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Engaged users')}}</p>
                                              <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                  {{$page_engagement}}</h3>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                              <div class="col-lg-8 col-xs-12">
                                  <div class="card big-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Post Distribution')}}</h5>
                                          <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total count with total number of engaged users.')}}</p>
                                          <div id="distributionChart"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-8 col-xs-12">
                              <div class="card big-card-height">
                                  <div class="card-body text-right">
                                      <h5 class="font-21-lh-25-bold card__title">{{__('Page Engagement Over Time')}}</h5>
                                      <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total count of an engaged user on the page daily over the set period')}}</p>
                                      <div id="engagementChart"></div>
                                  </div>
                              </div>
                            </div>
                              <div class="col-lg-4 col-xs-12">
                                  <div class="card big-card-height">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Each Post on Average Receives')}}</h5>
                                          <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of likes, comments, and shares on average each post receives')}}</p>
                                          <div id="postAverageChart"></div>
                                          <div class="impressions-table">
                                            <div class="data-sheet-metric" id="averageLikes"></div>
                                            <div class="data-sheet-metric data-sheet-metric--background-light-blue" id="averageComments"></div>
                                            <div class="data-sheet-metric" id="averageShares"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>
                          <div class="row">
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Organic Impressions')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Users who have engaged with your page through organic News Feed entries')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image/icon/dashnoard-impressions.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Impressions')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$page_impression_organic}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Paid Impressions')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of times people saw activity related to your Page via a paid Facebook ad')}} </p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/eye-dollar.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Impressions')}} </p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    {{$page_data->page_impressions_paid}} </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Clicks On Page (CTA)')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of time Page visitors towards the page objective, like visiting your website or call your store')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/press-button.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('CTA')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    0 </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="row">
                              <div class="col-lg-12 col-xs-12">
                                  <div class="card">
                                      <div class="card-body text-right">
                                          <h5 class="font-21-lh-25-bold card__title">{{__('Top Performing Cities')}}</h5>
                                          <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('The total number of people who liked your page & posts')}}</p>
                                          <div class="my-table table-responsive">
                                              <table class="table">
                                                  <thead>
                                                  <tr>
                                                      <th scope="col"
                                                          class="font-16-lh-19-semi-bold">{{__('City')}}</th>
                                                      <th scope="col"
                                                          class="font-16-lh-19-semi-bold">{{__('Reach')}}</th>
                                                      <th scope="col"
                                                          class="font-16-lh-19-semi-bold">{{__('Storytellers')}}</th>
                                                      <th scope="col"
                                                          class="font-16-lh-19-semi-bold">{{__('Page CTA clicks')}}</th>
                                                      <th scope="col"
                                                          class="font-16-lh-19-semi-bold">{{__('Phone Call Clicks')}}</th>
                                                      <th scope="col"
                                                          class="font-16-lh-19-semi-bold">{{__('Direction Clicks')}}</th>
                                                      <th scope="col"
                                                          class="font-16-lh-19-semi-bold">{{__('Website Clicks')}}</th>
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
                                                      <td class="font-13-lh-20-regular">123,362</td>
                                                  </tr>
                                                  <tr>
                                                      <th scope="row">Roxboro</th>
                                                      <td class="font-13-lh-20-regular">123,362</td>
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
                                                      <td class="font-13-lh-20-regular">123,362</td>
                                                  </tr>
                                                  <tr>
                                                      <th scope="row">Sydney</th>
                                                      <td class="font-13-lh-20-regular">123,362</td>
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
                                                      <td class="font-13-lh-20-regular">123,362</td>
                                                  </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @if(!empty($page))
                              <div class="row">
                                  <div class="col-md-12 col-xs-12">
                                      <div class="card">
                                          <div class="card-body text-right">
                                              <h5 class="font-21-lh-25-bold card__title">{{__('Top Performing Posts')}}</h5>
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
                                                                  <div class="message-orange-line"></div></div>
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
    let reachPerDay = @if(!empty($reach_per_day))@json($reach_per_day)@else [] @endif;
    let impressionPerDay = @if(!empty($impression_per_day))@json($impression_per_day)@else [] @endif;
    let impressionDate = @if(!empty($impressionDate))@json($impressionDate)@else [] @endif;

    let uniquePostImpressionPaid = @if(!empty($unique_post_impression_paid)){{$unique_post_impression_paid}}@else 0 @endif;
    let uniquePostImpressionOrganic = @if(!empty($unique_post_impression_organic)){{$unique_post_impression_organic}}@else 0 @endif;
    let uniquePostImpressionViral = @if(!empty($unique_post_impression_viral)){{$unique_post_impression_viral}}@else 0 @endif;

    let uniquePageImpressionPaid = @if(!empty($unique_page_impression_paid)){{$unique_page_impression_paid}}@else 0 @endif;
    let uniquePageImpressionOrganic = @if(!empty($unique_page_impression_organic)){{$unique_page_impression_organic}}@else 0 @endif;
    let uniquePageImpressionViral = @if(!empty($unique_page_impression_viral)){{$unique_page_impression_viral}}@else 0 @endif;
    let uniquePageImpressionNoviral = @if(!empty($unique_page_impression_noviral)){{$unique_page_impression_noviral}}@else 0 @endif;

    let pageEngagementPerDay = @if(!empty($page_engagement_per_day))@json($page_engagement_per_day)@else [] @endif;
    let pageEngagementPerDayDate = @if(!empty($page_engagement_per_day_date))@json($page_engagement_per_day_date)@else [] @endif;

    let postsCreatedPerDay = @if(!empty($posts_created_per_day))@json($posts_created_per_day)@else [] @endif;
    let postsEngagedPerDay = @if(!empty($posts_engaged_per_day))@json($posts_engaged_per_day)@else [] @endif;
    let dateCreatedPostArray = @if(!empty($date_created_post_array))@json($date_created_post_array)@else [] @endif;

    let postsAverageLikes = @if(!empty($posts_average_likes)){{$posts_average_likes}}@else 0 @endif;
    let postsAverageComments = @if(!empty($posts_average_comments)){{$posts_average_comments}}@else 0 @endif;
    let PostsAverageShares = @if(!empty($posts_average_shares)){{$posts_average_shares}}@else 0 @endif;


    // Data
let impressionsAndReachData = {
  reach: reachPerDay,
  impressions: impressionPerDay,
  dates: impressionDate,
};

let postImpressionsData = {
  paid: uniquePostImpressionPaid,
  organic: uniquePostImpressionOrganic,
  viral: uniquePostImpressionViral,
};

let pageImpressionsData = {
    paid: uniquePageImpressionPaid,
    organic: uniquePageImpressionOrganic,
    viral: uniquePageImpressionViral,
    nonViral: uniquePageImpressionNoviral,
};

let engagementData = {
  engagedUserCount:  pageEngagementPerDay,
  dates:  pageEngagementPerDayDate,
};

let distributionData = {
  postCount: postsCreatedPerDay,
  engagedUsersCount: postsEngagedPerDay,
  dates: dateCreatedPostArray,
};

let averagePostData = {
  likes: postsAverageLikes,
  comments: postsAverageComments,
  shares: PostsAverageShares,
};

// Page Impressions & Reach

  var impressionsAndReachOptions = {
      series: [{
          name: '{{__('Reach')}}',
          data: impressionsAndReachData.reach,
      }, {
          name: '{{__('Page Impressions')}}',
          data: impressionsAndReachData.impressions,
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
          categories: impressionsAndReachData.dates.map(date => {
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

  const impressionsAndReachChart = new ApexCharts(document.querySelector("#impressionsAndReachChart"), impressionsAndReachOptions);
  impressionsAndReachChart.render();


// Unique Post Impressions By Type

const impressionsPaidElement = document.querySelector('#impressionsPaid');
const impressionsOrganicElement = document.querySelector('#impressionsOrganic');
const impressionsViralElement = document.querySelector('#impressionsViral');

const totalImpressionsCount = Object.values(postImpressionsData).reduce(
  (sum, current) => {
    return sum + current;
  }, 0);

function findImpressionsPercent (specifiedImpressions) {
  if (totalImpressionsCount === 0) {
    return 0;
  }
  return Math.round(
    (specifiedImpressions / totalImpressionsCount * 100) * 100
  ) / 100;
};

impressionsPaidElement.innerHTML = `
<div class="data-sheet-info">
  <div class="data-sheet-bubble" style="background-color: #FF9A41"></div>
  <p class="data-sheet-text">${'{{__('Paid & unique Impressions')}}'}</p>
</div>
<p class="data-sheet-data">${postImpressionsData.paid} (${findImpressionsPercent(postImpressionsData.paid)}%)</p>
`;

impressionsOrganicElement.innerHTML = `
<div class="data-sheet-info">
  <div class="data-sheet-bubble" style="background-color: #356792"></div>
  <p class="data-sheet-text">${'{{__('Organic & unique Impressions')}}'}</p>
</div>
<p class="data-sheet-data">${postImpressionsData.organic} (${findImpressionsPercent(postImpressionsData.organic)}%)</p>
`;

impressionsViralElement.innerHTML = `
<div class="data-sheet-info">
  <div class="data-sheet-bubble" style="background-color: #545454"></div>
  <p class="data-sheet-text">${'{{__('Viral & unique Impressions')}}'}</p>
</div>
<p class="data-sheet-data">${postImpressionsData.viral} (${findImpressionsPercent(postImpressionsData.viral)}%)</p>
`;

postImpressionsData = [
  postImpressionsData.paid,
  postImpressionsData.organic,
  postImpressionsData.viral,
];

if (postImpressionsData.every(data => data === 0)) {
  postImpressionsData = [];
}

     var postImpressionsRadialChartOpt = {
      series: postImpressionsData,
      chart: {
          height: 200,
          type: 'pie'
      },
      labels: ['{{__('Paid & unique Impressions')}}', '{{__('Organic & unique Impressions')}}', '{{__('Viral & unique Impressions')}}'],
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

  const postImpressionsRadialChart = new ApexCharts(document.querySelector("#postImpressionsRadialChart"), postImpressionsRadialChartOpt);
  postImpressionsRadialChart.render();

   // Unique Page Impressions By Type

const pageImpressionsPaidElement = document.querySelector('#pageImpressionsPaid');
const pageImpressionsOrganicElement = document.querySelector('#pageImpressionsOrganic');
const pageImpressionsViralElement = document.querySelector('#pageImpressionsViral');
const pageImpressionsNonViralElement = document.querySelector('#pageImpressionsNonViral');

const pageTotalImpressionsCount = Object.values(pageImpressionsData).reduce(
  (sum, current) => {
    return sum + current;
  }, 0);

function findPageImpressionsPercent (specifiedImpressions) {
  if (pageTotalImpressionsCount === 0) {
    return 0;
  }
  return Math.round(
    (specifiedImpressions / pageTotalImpressionsCount * 100) * 100
  ) / 100;
};

pageImpressionsPaidElement.innerHTML = `
<div class="data-sheet-info">
  <div class="data-sheet-bubble" style="background-color: #FF9A41"></div>
  <p class="data-sheet-text">${'{{__('Paid & unique Impressions')}}'}</p>
</div>
<p class="data-sheet-data">${pageImpressionsData.paid} (${findPageImpressionsPercent(pageImpressionsData.paid)}%)</p>
`;

pageImpressionsOrganicElement.innerHTML = `
<div class="data-sheet-info">
  <div class="data-sheet-bubble" style="background-color: #356792"></div>
  <p class="data-sheet-text">${'{{__('Organic & unique Impressions')}}'}</p>
</div>
<p class="data-sheet-data">${pageImpressionsData.organic} (${findPageImpressionsPercent(pageImpressionsData.organic)}%)</p>
`;

pageImpressionsViralElement.innerHTML = `
<div class="data-sheet-info">
  <div class="data-sheet-bubble" style="background-color: #545454"></div>
  <p class="data-sheet-text">${'{{__('Viral & unique Impressions')}}'}</p>
</div>
<p class="data-sheet-data">${pageImpressionsData.viral} (${findPageImpressionsPercent(pageImpressionsData.viral)}%)</p>
`;

pageImpressionsNonViralElement.innerHTML = `
<div class="data-sheet-info">
  <div class="data-sheet-bubble" style="background-color: #000000"></div>
  <p class="data-sheet-text">${'{{__('Nonviral & unique Impressions')}}'}</p>
</div>
<p class="data-sheet-data">${pageImpressionsData.nonViral} (${findPageImpressionsPercent(pageImpressionsData.nonViral)}%)</p>
`;

   pageImpressionsData = [
    pageImpressionsData.paid,
    pageImpressionsData.organic,
    pageImpressionsData.viral,
    pageImpressionsData.nonViral,
  ];

  if (pageImpressionsData.every(data => data === 0)) {
    pageImpressionsData = [];
  }

   var pageImpressionsRadialChartOpt = {
      series: pageImpressionsData,
      chart: {
          height: 200,
          type: 'pie'
      },
      labels: ['{{__('Paid & unique Impressions')}}', '{{__('Organic & unique Impressions')}}', '{{__('Viral & unique Impressions')}}', '{{__('Nonviral & unique Impressions')}}'],
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
      colors: ['#FF9A41', '#356792', '#545454', '#000000'],
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

  const pageImpressionsRadialChart = new ApexCharts(document.querySelector("#pageImpressionsRadialChart"), pageImpressionsRadialChartOpt);
  pageImpressionsRadialChart.render();

// Post average receives

const averageLikesElement = document.querySelector('#averageLikes');
const averageCommentsElement = document.querySelector('#averageComments');
const averageSharesElement = document.querySelector('#averageShares');

const averageTotalCount = Object.values(averagePostData).reduce(
  (sum, current) => {
    return sum + current;
  }, 0);

function findAveragePostPercent (specifiedImpressions) {
  if (averageTotalCount === 0) {
    return 0;
  }
  return Math.round(
    (specifiedImpressions / averageTotalCount * 100) * 100
  ) / 100;
};

averageLikesElement.innerHTML = `
<div class="data-sheet-info">
  <div class="data-sheet-bubble" style="background-color: #FF9A41"></div>
  <p class="data-sheet-text">${'{{__('Likes')}}'}</p>
</div>
<p class="data-sheet-data">${averagePostData.likes} (${findAveragePostPercent(averagePostData.likes)}%)</p>
`;

averageCommentsElement.innerHTML = `
<div class="data-sheet-info">
  <div class="data-sheet-bubble" style="background-color: #356792"></div>
  <p class="data-sheet-text">${'{{__('Comments')}}'}</p>
</div>
<p class="data-sheet-data">${averagePostData.comments} (${findAveragePostPercent(averagePostData.comments)}%)</p>
`;

averageSharesElement.innerHTML = `
<div class="data-sheet-info">
  <div class="data-sheet-bubble" style="background-color: #545454"></div>
  <p class="data-sheet-text">${'{{__('Shares')}}'}</p>
</div>
<p class="data-sheet-data">${averagePostData.shares} (${findAveragePostPercent(averagePostData.shares)}%)</p>
`;

averagePostData = [
  averagePostData.likes,
  averagePostData.comments,
  averagePostData.shares,
];

if (averagePostData.every(data => data === 0)) {
  averagePostData = [];
}

var postAverageChartOpt = {
  series: averagePostData,
  chart: {
      height: 200,
      type: 'pie'
  },
  labels: ['{{__('Likes')}}', '{{__('Comments')}}', '{{__('Shares')}}'],
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

const postAverageChart = new ApexCharts(document.querySelector("#postAverageChart"), postAverageChartOpt);
postAverageChart.render();

const postAverageChartDUPLICATE = new ApexCharts(document.querySelector("#postAverageChartDUPLICATE"), postAverageChartOpt);
postAverageChartDUPLICATE.render();

// Page engagement over Time

let engagementColWidth = '85%';

if (engagementData.engagedUserCount.length < 17) {
  engagementColWidth = (engagementData.engagedUserCount.length * 5) + '%';
};

      var engagementOptions = {
      series: [{
          name: '{{__('Engaged Users')}}',
          data: engagementData.engagedUserCount,
      }],
      chart: {
          type: 'bar',
          height: 300,
          toolbar: {
              show: false,
          },
          zoom: {
            enabled: false,
          },
      },
      colors: ['#0B243A'],
      plotOptions: {
          bar: {
              horizontal: false,
              columnWidth: engagementColWidth,
              borderRadius: 8,
          },
      },
      dataLabels: {
          enabled: false
      },
      legend: {
          show: true,
          fontSize: '14px',
          fontFamily: 'NotoSansArabic-Regular',
          fontWeight: 400,
          showForSingleSeries: true,
          position: 'top',
          horizontalAlign: 'left',
          inverseOrder: 'true',
      },
      stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
      },
      xaxis: {
        labels: {
            show: true,
            style: {
              colors: '#B0BBCB',
            },
          },
        categories: engagementData.dates.map(date => {
        if(date.length === 10) {
            return date.slice(5)
          };
          return date;
      }),
      },
      yaxis: [{
          labels: {
            show: true,
            align: 'left',
            offsetX: 26,
            style: {
              colors: '#B0BBCB',
            },
          },
        }
      ],
      fill: {
          opacity: 1
      },
      tooltip: {
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
    }
  };

  const engagementChart = new ApexCharts(document.querySelector("#engagementChart"), engagementOptions);

  engagementChart.render();

// Post Distribution

let distributionColWidth = '85%';

if (distributionData.engagedUsersCount.length < 17) {
  distributionColWidth = (distributionData.engagedUsersCount.length * 5) + '%';
};

console.log(engagementColWidth);

  var distributionOptions = {
      series: [{
          name: '{{__('Engaged Users')}}',
          type: 'column',
          data: distributionData.engagedUsersCount,
      }, {
          name: '{{__('Post Count')}}',
          type: 'column',
          data: distributionData.postCount,
      }],
      chart: {
          height: 300,
          toolbar: {
            show: false,
          },
          zoom: {
            enabled: false,
          },
      },
      colors: ['#356792', '#F58B1E'],
      dataLabels: {
          enabled: false,
      },
      stroke: {
        show: false,
      },
      bar: {

      },
      labels: distributionData.dates.map(date => {
        if(date.length === 10) {
            return date.slice(5)
          };
          return date;
      }),
      legend: {
          show: true,
          fontSize: '14px',
          fontFamily: 'NotoSansArabic-Regular',
          fontWeight: 400,
          position: 'top',
          horizontalAlign: 'left',
      },
      plotOptions: {
          bar: {
              horizontal: false,
              columnWidth: distributionColWidth,
              borderRadius: 8,
          },
      },
      xaxis: {
          labels: {
            style: {
              colors: '#B0BBCB',
            },
          },
      },
      yaxis: [
      //   {
      //     labels: {
      //       style: {
      //         colors: '#B0BBCB',
      //       },
      //     },
      // },
      {
          opposite: true,
          labels: {
            align: 'right',
            offsetX: 18,
            style: {
              colors: '#B0BBCB',
            },
          },
      }],
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
    }
  };

  const distributionChart = new ApexCharts(document.querySelector("#distributionChart"), distributionOptions);
  distributionChart.render();
</script>
@endsection
