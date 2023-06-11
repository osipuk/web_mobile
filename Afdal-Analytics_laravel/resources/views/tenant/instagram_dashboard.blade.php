@section('metahead')
  <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
    <title>{{__("Instagram Overview")}}</title>
@endsection
@extends('layout.userhead')


@section('css')

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

    @if($get_locale == 'en')
        <style type="text/css">
            .order-2-en{
                order: 2;
            }


        </style>
    @endif


    
@endsection





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
              </div>

              <div class="row mb-5 justify-content-between">
                  <div class="col-lg-9 col-sm-9 col-12">
                      <div class="dashboard-tabs">
                          <ul class="nav nav-pills">
                              @if(Auth::user() && Auth::user()->social_account_facebook->isNotEmpty())
                                  <li class="nav-item">
                                      <a class="nav-link font-24-lh-29-medium pr-0"
                                         href="{{url('facebook/overview')}}">
                                          <p class="mb-0">{{__('Page')}}</p>
                                          <div class="nav-icon facebook-gray"></div>
                                      </a>
                                  </li>
                              @endif
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
                              @if(Auth::user() && Auth::user()->social_account_facebook->isNotEmpty())
                                  <li class="nav-item">
                                      <a class="nav-link  font-24-lh-29-medium"
                                        href="{{url('facebook/engagement')}}"
                                      >
                                          <p class="mb-0">{{__('Engagment')}}</p>
                                          <div class="nav-icon facebook-gray"></div>
                                      </a>
                                  </li>
                              @endif
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
                              <li class="nav-item">
                                  <a class="nav-link active font-24-lh-29-medium"
                                      href="{{url('/instagram/overview')}}"
                                  >
                                      <p class="mb-0">{{__('Instagram')}}</p>
                                      <div class="nav-icon insta"></div>
                                  </a>
                              </li>
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
                <div class="col-lg-4 col-xs-12">
                    <div class="card small-card-height">
                        <div class="card-body text-right">
                            <h5 class="font-21-lh-25-bold card__title">{{__('Total Likes')}}</h5>
                            <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of people who liked your posts.')}}</p>
                            <div class="d-flex-dashbard-data" id="mybasis">
                                <div class="dashboard-data-1 text-left">
                                    <img
                                        src="{{{url('/assets/image_new/svg/colored/thumb-up.svg')}}}">
                                </div>
                                <div class="dashboard-data-2 text-right">
                                    <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Total Page Likes')}}</p>
                                    <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{0}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="card small-card-height">
                        <div class="card-body text-right">
                            <h5 class="font-21-lh-25-bold card__title">{{__('Total Followers')}} </h5>
                            <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Total number of people who follow your account')}} </p>
                            <div class="d-flex-dashbard-data" id="mybasis">
                                <div class="dashboard-data-1 text-left">
                                    <img
                                        src="{{{url('/assets/image_new/svg/colored/new-followers.svg')}}}">
                                </div>
                                <div class="dashboard-data-2 text-right">
                                    <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Followers')}} </p>
                                    <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                        {{!empty($total_followers) ? $total_followers : 0}} </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="card small-card-height">
                        <div class="card-body text-right">
                            <h5 class="font-21-lh-25-bold card__title">{{__('Total Impressions')}} </h5>
                            <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of people of post views')}}</p>
                            <div class="d-flex-dashbard-data" id="mybasis">
                                <div class="dashboard-data-1 text-left">
                                    <img
                                        src="{{{url('/assets/image/icon/dashnoard-impressions.svg')}}}">
                                </div>
                                <div class="dashboard-data-2 text-right">
                                    <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Total page likes')}}</p>
                                    <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                        {{!empty($page_impression) ? $page_impression : 0}} </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

              <div class="row">
                <div class="col-lg-4 col-xs-12 order-2-en">
                  <div class="card biggest-card-height overflow-auto">
                      <div class="card-body text-right align-top">
                          <h5 class="font-21-lh-25-bold card__title">{{__('Followers By Country')}}</h5>
                          <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('The total number of followers listed by country')}}</p>
                          <div class="my-table table-responsive">
                              <table class="table">
                                  <thead>
                                  <tr>
                                      <th scope="col"
                                          class="font-16-lh-19-semi-bold">{{__('Country')}}</th>
                                      <th scope="col"
                                          class="font-16-lh-19-semi-bold">{{__('Followers')}}</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($followers_by_country as $item)
                                      <tr>
                                          <th scope="row">{{$item->country}}</th>
                                          <td class="font-13-lh-20-regular">{{$item->number_followers}}</td>
                                      </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
                <div class="col-lg-8 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Total Followers By Gender & Age')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of followers broken down by age and gender')}}</p>
                                        <div id="distributionChart"></div>
                                    </div>
                                </div>

                                <div class="card big-card-height">
                                  <div class="card-body text-right">
                                      <h5 class="font-21-lh-25-bold card__title">{{__('Profile Trend')}}  </h5>
                                      <p class="font-16-lh-19-regular card__title-text">{{__('The number of times your post was shown combined vs. the number of unique views')}}</p>
                                      <div id="profileTrendChart"></div>
                                  </div>
                              </div>

                              </div>
                          </div>

              @if(!empty($posts))
              <div class="row">
                  <div class="col-md-12 col-xs-12">
                      <div class="card">
                          <div class="card-body text-right">
                              <h5 class="font-21-lh-25-bold card__title">{{__('Top Performing Posts')}}</h5>
                              <p class="font-16-lh-19-regular mb-2 card__title-text">{{__('The top-performing Post by engagement over a set period')}}</p>
                          </div>
                          <div class="container-flow pl-5 pr-5">
                              <ul class="post-card-info-list">
                                  @foreach($posts as $post)
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
                                                  {{__('Comments')}}
                                                  </p>
                                                  <div class="orange-line"></div>
                                                  <p class="post-card-data-value">
                                                      {{$post->comments_count}}
                                                  </p>
                                              </li>
                                              <li class="post-card-data">
                                                  <p class="post-card-data-name font-13-lh-16-medium mb-1">
                                                  {{__('Engagement')}}
                                                  </p>
                                                  <div class="orange-line"></div>
                                                  <p class="post-card-data-value">
                                                      {{$post->engaged}}
                                                  </p>
                                              </li>
                                              <li class="post-card-data">
                                                  <p class="post-card-data-name font-13-lh-16-medium mb-1">
                                                  {{__('Likes')}}
                                                  </p>
                                                  <div class="orange-line"></div>
                                                  <p class="post-card-data-value">
                                                      {{$post->likes_count}}
                                                  </p>
                                              </li>
                                              <li class="post-card-data">
                                                  <p class="post-card-data-name font-13-lh-16-medium mb-1">
                                                      {{__('Reach')}}
                                                  </p>
                                                  <div class="orange-line"></div>
                                                  <p class="post-card-data-value">
                                                      {{$post->reach}}
                                                  </p>
                                              </li>
                                          </ul>
                                      </li>
                                  @endforeach
                              </ul>
                          </div>
          </div>
          </div>
          </div>
          @else
          @endif
        </main>
      </div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
  // Data

let followersData = {
  followers: @if(!empty($new_followers_per_day))@json($new_followers_per_day)@else [] @endif,
  dates: @if(!empty($dates))@json($dates)@else [] @endif,
}

let profileTrendData = {
  engagement: @if(!empty($impression_per_day))@json($impression_per_day)@else [] @endif,
  reach: @if(!empty($reach_per_day))@json($reach_per_day)@else [] @endif,
  dates: @if(!empty($dates))@json($dates)@else [] @endif,
};


console.log('Followers data:', followersData);
console.log('ProfileTrendData:', profileTrendData);

// Profile Trend
  var profileTrendOptions = {
      series: [{
          name: '{{__('Engagement')}}',
          data: profileTrendData.engagement,
      }, {
          name: '{{__('Reach')}}',
          data: profileTrendData.reach,
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
          categories: followersData.dates.map(date => {
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

  const profileTrendChart = new ApexCharts(document.querySelector("#profileTrendChart"), profileTrendOptions);
  profileTrendChart.render();

// Total Followers By Gender & Age

let followersWidth = '85%';

if (followersData.followers.length < 17) {
  followersWidth = (followersData.followers.length * 5) + '%';
};

  var distributionOptions = {
      series: [{
          name: '{{__('Followers')}}',
          type: 'column',
          data: followersData.followers,
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
      colors: ['#356792'],
      dataLabels: {
          enabled: false,
      },
      stroke: {
        show: false,
      },
      bar: {

      },
      labels: followersData.dates.map(date => {
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
              columnWidth: followersWidth,
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
