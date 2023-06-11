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


app()->setLocale($get_locale);
@endphp

<style>
    .row{
        margin-bottom: 35px;
    }
    .data-sheet-text, .data-sheet-data{
        font-size: 12px!important;
    }
</style>
<div class="container-fluid main-content-wrapper">
    <div class="row">
        <div class="col-12" style="margin-top: 70px; margin-bottom: 50px;">
            <div class="card smallest-card-height d-flex justify-content-center align-items-center">
                <div class="card-body text-right">
                    <p class="font-45-lh-54-medium">{{$connect_name}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="tab-pane active " id="ads-page">
                <div class="row">
                    <div class="col-4">
                        <div class="card small-card-height">
                            <div class="card-body  text-right">
                                <div class="top-content">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Total Followers')}} </h5>
                                    <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Total number of people who follow your account')}}</p>
                                </div>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <img src="{{{url('/assets/image_new/svg/colored/new-followers.svg')}}}">
                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Followers')}}</p>
                                        <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($total_followers) ? $total_followers : 0}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card small-card-height">
                            <div class="card-body text-right">
                                <h5 class="font-21-lh-25-bold card__title">{{__('New Followers')}}</h5>
                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Total number of new people who follow your account')}}</p>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <img src="{{{url('/assets/image_new/svg/colored/new-likes.svg')}}}">
                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('New followers')}}</p>
                                        <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($new_followers) ? $new_followers : 0}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card big-card-height">
                            <div class="card-body text-right">
                                <h5 class="font-21-lh-25-bold card__title">{{__('Followers')}}  </h5>
                                <p class="font-16-lh-19-regular card__title-text">{{__('The total count of followers daily over the set period')}}</p>
                                <div id="followersChart" style="width: 680px"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="card small-card-height">
                            <div class="card-body text-right">
                                <h5 class="font-21-lh-25-bold card__title">{{__('Total Engagements')}}</h5>
                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Total number of times a user interacted with a Tweet')}}</p>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <img
                                            src="{{{url('/assets/image_new/svg/colored/group-likes.svg')}}}">
                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Engaged Users')}}</p>
                                        <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($engagement) ? $engagement : 0}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card small-card-height">
                            <div class="card-body text-right">
                                <h5 class="font-21-lh-25-bold card__title">{{__('Engagement Rate')}} </h5>
                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of engagements divided by impressions')}} </p>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <img
                                            src="{{{url('/assets/image_new/svg/colored/group-percent.svg')}}}">
                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Impressions')}} </p>
                                        <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($engagement_rate) ? $engagement_rate : 0}}%</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card small-card-height">
                            <div class="card-body text-right">
                                <h5 class="font-21-lh-25-bold card__title">{{__('Total Tweets')}} </h5>
                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of tweets posted to account')}}</p>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <img
                                            src="{{{url('/assets/image_new/svg/colored/new-entries.svg')}}}">
                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Tweets')}}</p>
                                        <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($total_tweets) ? $total_tweets : 0}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 700px!important;">
                    <div class="col-6">
                        <div class="card small-card-height">
                            <div class="card-body text-right">
                                <h5 class="font-21-lh-25-bold card__title">{{__('Total Retweets')}} </h5>
                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of times your tweets have been shared')}} </p>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <img
                                            src="{{{url('/assets/image_new/svg/colored/retweet.svg')}}}">
                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Retweets')}} </p>
                                        <h3 class="font-37-lh-44-bold mb-0 card__total-title-count"> {{!empty($total_retweets) ? $total_retweets : 0}} </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card small-card-height">
                            <div class="card-body text-right">
                                <h5 class="font-21-lh-25-bold card__title">{{__('Favorites')}} </h5>
                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of like of all the tweets')}} </p>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <img
                                            src="{{{url('/assets/image_new/svg/colored/heart.svg')}}}">
                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Likes')}} </p>
                                        <h3 class="font-37-lh-44-bold mb-0 card__total-title-count"> {{!empty($total_favorites) ? $total_favorites : 0}} </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 5vh;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-right justify-content-start">

                                <h5 class="font-21-lh-25-bold card__title">{{__('Tweet Performance')}}</h5>
                                <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('The top-performing tweets based on engagement count')}}</p>
                                <div class="my-table table-responsive">
                                    <table class="table table-twitter">
                                        <thead>
                                        <tr>
                                            <th scope="col"
                                                class="font-16-lh-19-semi-bold">{{__('Tweet')}}</th>
                                            <th scope="col"
                                                class="font-16-lh-19-semi-bold">{{__('Engagement')}}</th>
                                            <th scope="col"
                                                class="font-16-lh-19-semi-bold">{{__('Retweets')}}</th>
                                            <th scope="col"
                                                class="font-16-lh-19-semi-bold">{{__('Favorites')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($tweets) && count($tweets)>0)
                                            @foreach($tweets as $tweet)
                                                <tr>
                                                    <th scope="row" class="font-13-lh-20-regular">{{$tweet->text}}</th>
                                                    <td class="font-13-lh-20-regular">{{$tweet->engagement}}</td>
                                                    <td class="font-13-lh-20-regular">{{$tweet->retweet}}</td>
                                                    <td class="font-13-lh-20-regular">{{$tweet->favorites}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th scope="row"> - </th>
                                                <td class="font-13-lh-20-regular"> - </td>
                                                <td class="font-13-lh-20-regular"> - </td>
                                                <td class="font-13-lh-20-regular"> - </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
    let graphData = @if(!empty($new_followers_per_day)) @json($new_followers_per_day) @else [] @endif;
    console.log(graphData);

    // Data

    let followersData = {
        female: Object.values(graphData),
        dates: Object.keys(graphData),
    };

    // Followers chart

    let followersColWidth = '85%';

    if (followersData.female.length < 17) {
        followersColWidth = (followersData.female.length * 5) + '%';
    };
    let divWidth = document.querySelector("#followersChart").clientWidth;
    let offset = 0;
    let rotate = 0;
    if(followersData.dates.length>=20||(followersData.dates.length>15&&divWidth<600)){
        offset = 20;
        rotate = -45;
    }
    var followersOptions = {
        series: [{
            name: '{{__('Female')}}',
            data: followersData.female,
        }],
        chart: {
            height: 280,
            type: 'bar',
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
        colors: ['#F58B1E'],
        stroke: {
            curve: 'smooth',
            width: 2,
        },
        stroke: {
            show: false,
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
                offsetY: offset,
                rotate: rotate,
                rotateAlways: true,
            },
        },
        yaxis: [
            // {
            //   labels: {
            //   align: 'left',
            //     offsetX: 28,
            //     style: {
            //       colors: '#B0BBCB',
            //     },
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
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: followersColWidth,
                borderRadius: 8,
            },
        },
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
                fontFamily: 'NotoSansArabic-Regular'
            }
        },
    };

    const followersChart = new ApexCharts(document.querySelector("#followersChart"), followersOptions);
    followersChart.render();
</script>
