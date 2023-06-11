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
if(isset(request()->lang)){
    if(request()->lang == 'en'){
        $get_locale = 'en';

    }else{
        $get_locale = 'ar';

    }
}

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
            <div class="col-4">
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
                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($likes) ? $likes : 0}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
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
            <div class="col-4">
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
            <div class="col-4">
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
                                @if(!empty($followers_by_country)&&count($followers_by_country)>0)
                                    @foreach($followers_by_country as $item)
                                        <tr>
                                            <th scope="row">{{$item->country}}</th>
                                            <td class="font-13-lh-20-regular">{{$item->number_followers}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th scope="row"> - </th>
                                        <td class="font-13-lh-20-regular"> - </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card big-card-height">
                    <div class="card-body text-right">
                        <h5 class="font-21-lh-25-bold card__title">{{__('Total Followers By Gender & Age')}}</h5>
                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of followers broken down by age and gender')}}</p>
                        <div id="distributionChart" style="width: 680px"></div>
                    </div>
                </div>

                <div class="card big-card-height">
                    <div class="card-body text-right">
                        <h5 class="font-21-lh-25-bold card__title">{{__('Profile Trend')}}  </h5>
                        <p class="font-16-lh-19-regular card__title-text">{{__('The number of times your post was shown combined vs. the number of unique views')}}</p>
                        <div id="profileTrendChart" style="width: 680px"></div>
                    </div>
                </div>

            </div>
        </div>
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
        let divWidth = document.querySelector("#profileTrendChart").clientWidth;
        let offset = 0;
        let rotate = 0;
        if(followersData.dates.length>=20||(followersData.dates.length>15&&divWidth<600)){
            offset = 20;
            rotate = -45;
        }
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
                    offsetY: offset,
                    rotate: rotate,
                    rotateAlways: true,
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
                    fontFamily: 'NotoSansArabic-Regular'
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
        divWidth = document.querySelector("#distributionChart").clientWidth;
        offset = 0;
        rotate = 0;
        if(followersData.dates.length>=20||(followersData.dates.length>15&&divWidth<600)){
            offset = 20;
            rotate = -45;
        }
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
                    offsetY: offset,
                    rotate: rotate,
                    rotateAlways: true,
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
                    fontFamily: 'NotoSansArabic-Regular'
                }
            }
        };

        const distributionChart = new ApexCharts(document.querySelector("#distributionChart"), distributionOptions);
        distributionChart.render();

    </script>
