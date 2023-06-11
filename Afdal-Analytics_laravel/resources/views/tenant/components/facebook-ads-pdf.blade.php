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
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Impressions')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of times your ads were shown.')}}</p>
                                    </div>
                                    <div class="d-flex-dashbard-data" id="mybasis">
                                        <div class="dashboard-data-1 text-left">
                                            <img src="{{{url('/assets/image/icon/dashnoard-impressions.svg')}}}">
                                        </div>
                                        <div class="dashboard-data-2 text-right">
                                            <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Impressions')}}</p>
                                            <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($total_impression) ? $total_impression : 0}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card small-card-height">
                                <div class="card-body text-right">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Click Through Rate')}}</h5>
                                    <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of clicks that your ad receives is divided by the number of times your ad is shown.')}}</p>
                                    <div class="d-flex-dashbard-data" id="mybasis">
                                        <div class="dashboard-data-1 text-left">
                                            <img src="{{{url('/assets/image_new/svg/colored/click-rate.svg')}}}">
                                        </div>
                                        <div class="dashboard-data-2 text-right">
                                            <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Rate')}}</p>
                                            <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($avg_ctr) ? $avg_ctr : 0}}
                                                %</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card big-card-height">
                                <div class="card-body text-right">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Total Page Impressions And Clicks Over Time')}}  </h5>
                                    <p class="font-16-lh-19-regular card__title-text">{{__('The number of times your ads were shown combined with clicks on the ads.')}}</p>
                                    <div id="impressionsAndClicksChart" style="width: 680px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="card small-card-height">
                                <div class="card-body text-right">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Total Clicks')}}</h5>
                                    <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Includes link clicks as well as clicks on other parts of your ad (ex: someone clicks on your Page\'s name)')}}</p>
                                    <div class="d-flex-dashbard-data" id="mybasis">
                                        <div class="dashboard-data-1 text-left">
                                            <img
                                                src="{{{url('/assets/image_new/svg/colored/click.svg')}}}">
                                        </div>
                                        <div class="dashboard-data-2 text-right">
                                            <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Clicks')}}</p>
                                            <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($total_clicks) ? $total_clicks : 0}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card small-card-height">
                                <div class="card-body text-right">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Cost Per Click')}} </h5>
                                    <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The price you paid for each link click on your Facebook ad')}} </p>
                                    <div class="d-flex-dashbard-data" id="mybasis">
                                        <div class="dashboard-data-1 text-left">
                                            <img
                                                src="{{{url('/assets/image_new/svg/colored/click-cost.svg')}}}">
                                        </div>
                                        <div class="dashboard-data-2 text-right">
                                            <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Cost')}} </p>
                                            <h3 class="font-37-lh-44-bold mb-0 card__total-title-count"> {{!empty($avg_cpc) ? $avg_cpc : 0}} </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card small-card-height">
                                <div class="card-body text-right">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Total Link Clicks')}} </h5>
                                    <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of clicks on links to select destinations or experiences, on or off Facebook-owned properties')}}</p>
                                    <div class="d-flex-dashbard-data" id="mybasis">
                                        <div class="dashboard-data-1 text-left">
                                            <img
                                                src="{{{url('/assets/image_new/svg/colored/total-link-clicks.svg')}}}">
                                        </div>
                                        <div class="dashboard-data-2 text-right">
                                            <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Link Clicks')}}</p>
                                            <h3 class="font-37-lh-44-bold mb-0 card__total-title-count"> {{!empty($total_inline_link_clicks) ? $total_inline_link_clicks : 0}} </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"  style="margin-bottom: 500px;">
                        <div class="col-4">
                            <div class="card small-card-height">
                                <div class="card-body  text-right">
                                    <div class="top-content">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Average Cost To Reach 1000 Users')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of people exposed to your message and how efficiently you reached them')}}</p>
                                    </div>
                                    <div class="d-flex-dashbard-data" id="mybasis">
                                        <div class="dashboard-data-1 text-left">
                                            <img
                                                src="{{{url('/assets/image_new/svg/colored/radio-tower-dollar.svg')}}}">
                                        </div>
                                        <div class="dashboard-data-2 text-right">
                                            <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Cost')}}</p>
                                            <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($avg_cpp) ? round($avg_cpp, 2) : 0}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card small-card-height">
                                <div class="card-body text-right">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Total Spent On Ads')}}</h5>
                                    <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total amount of money you\'ve spent across all your campaigns during a time period.')}}</p>
                                    <div class="d-flex-dashbard-data" id="mybasis">
                                        <div class="dashboard-data-1 text-left">
                                            <img src="{{{url('/assets/image_new/svg/colored/cost.svg')}}}">
                                        </div>
                                        <div class="dashboard-data-2 text-right">
                                            <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Cost')}}</p>
                                            <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($total_spend) ? $total_spend : 0}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="card big-card-height">
                                <div class="card-body text-right">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Spend Vs Revenue')}}  </h5>
                                    <p class="font-16-lh-19-regular card__title-text">{{__('The total ad spend vs the revenue generated according to Facebook pixel conversion value.')}}</p>
                                    <div id="spendVsRevenueChart" style="width: 680px"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 150px; padding-top:5vh;">
                        <div class="col-4">
                            <div class="card small-card-height">
                                <div class="card-body  text-right">
                                    <div class="top-content">
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Average Cost For 1000 Impressions')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('the total amount spent on an ad campaign, divided by impressions, multiplied by 1,000')}}</p>
                                    </div>
                                    <div class="d-flex-dashbard-data" id="mybasis">
                                        <div class="dashboard-data-1 text-left">
                                            <img
                                                src="{{{url('/assets/image_new/svg/colored/eye-dollar.svg')}}}">
                                        </div>
                                        <div class="dashboard-data-2 text-right">
                                            <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Cost')}}</p>
                                            <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($avg_cpm) ? round($avg_cpm, 2) : 0}}</h3>
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
                                            <p class="data-sheet-data">{{!empty($total_clicks) ? $total_clicks : 0}}</p>
                                        </div>
                                        <div class="data-sheet-metric data-sheet-metric--background-light-blue">
                                            <div class="data-sheet-info">
                                                <p class="data-sheet-text">{{__('Link click through rate')}}</p>
                                            </div>
                                            <p class="data-sheet-data">{{!empty($avg_ctr) ? $avg_ctr : 0}}</p>
                                        </div>
                                        <div class="data-sheet-metric">
                                            <div class="data-sheet-info">
                                                <p class="data-sheet-text">{{__('Cost per link click')}}</p>
                                            </div>
                                            <p class="data-sheet-data">{{!empty($avg_cpc) ? $avg_cpc : 0}}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card big-card-height">
                                <div class="card-body text-right">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Return On Advertising Spend')}}  </h5>
                                    <p class="font-16-lh-19-regular card__title-text">{{__('The total revenue generated according to Facebook pixel conversion value.')}}</p>
                                    <div id="advertisingReturnChart" style="width: 680px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
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
                                            @if(!empty($ads_campain))
                                                @foreach($ads_campaign as $campaign)
                                                    <tr>
                                                        <th scope="row">{{$campaign->campaign_name}}</th>
                                                        <td class="font-13-lh-20-regular">{{$campaign->total_clicks}}</td>
                                                        <td class="font-13-lh-20-regular">{{$campaign->total_ctr}}</td>
                                                        <td class="font-13-lh-20-regular">{{$campaign->total_cpc}}</td>
                                                        <td class="font-13-lh-20-regular">{{$campaign->total_impressions}}</td>
                                                        <td class="font-13-lh-20-regular">{{$campaign->total_spend}}$</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th scope="row"> - </th>
                                                    <td class="font-13-lh-20-regular"> - </td>
                                                    <td class="font-13-lh-20-regular"> - </td>
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
                        <div class="col-4">
                            <div class="card big-card-height">
                                <div class="card-body text-right">
                                    <h5 class="font-21-lh-25-bold card__title">{{__('Ads Conversion Funnel')}}</h5>
                                    <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The flow and conversion path of potential customers into paying customers from Facebook Ads.')}}</p>
                                    <div style="position: relative;" id="funnelChart">
                                        <div class="ads-conversion-chart" id="adsConversionChart">
                                        </div>
                                        <div class="tooltip1">
                                            <div class="imm">{{__('Impressions')}}: {{$total_impression}}</div>
                                            <div class="click">{{__('Clicks')}}: {{$total_clicks}}</div>
                                            <div class="reach">{{__('Reach')}}: {{$total_reach}}</div>
                                        </div>
                                    </div>
                                    <div class="ads-conversion-table">
                                        <div class="data-sheet-metric" id="adsConversionImpressions"></div>
                                        <div class="data-sheet-metric data-sheet-metric--background-light-blue"
                                             id="adsConversionReach"></div>
                                        <div class="data-sheet-metric" id="adsConversionClicks"></div>
                                        <div class="ads-conversion-line"></div>
                                        <div class="data-sheet-metric" id="adsConversionConversion"></div>
                                    </div>
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
    var tooltip = document.querySelector('.tooltip1');
    let chart1 = document.querySelector('#funnelChart')
    let rect = chart1.getBoundingClientRect();
    chart1.addEventListener('mousemove', fn, false);

    function fn(e) {
        tooltip.style.left = e.pageX-rect.x + 'px' ;
    }


    // Data
    let impressionsAndClicksGraphData = @if(!empty($graph_data_click_vs_impression)) @json($graph_data_click_vs_impression) @else [] @endif;
    let spendVsRevenueGraphData = @if(!empty($graph_data_spend_vs_revenue)) @json($graph_data_spend_vs_revenue) @else [] @endif;
    let revenueGraphData = @if(!empty($graph_advertising_spend)) @json($graph_advertising_spend) @else [] @endif;
    let totalImpression = @if(!empty($total_impression)) {{$total_impression}} @else 0 @endif;
    let totalReach = @if(!empty($total_reach)) {{$total_reach}} @else 0 @endif;
    let totalClicks = @if(!empty($total_clicks)) {{$total_clicks}} @else 0 @endif;

    let impressionsAndClicksData = {
        impressions: [],
        clicks: [],
        dates: [],
    }

    impressionsAndClicksGraphData.forEach(date => {
        impressionsAndClicksData.impressions.push(date.impressions);
        impressionsAndClicksData.dates.push(date.date);
        impressionsAndClicksData.clicks.push(date.clicks);
    })

    let spendVsRevenueData = {
        spent: [],
        revenue: [],
        dates: [],
    }

    spendVsRevenueGraphData.forEach(date => {
        spendVsRevenueData.spent.push(date.spend);
        spendVsRevenueData.revenue.push(date.converted_product_value);
        spendVsRevenueData.dates.push(date.date);
    })

    let adsConversionData = {
        impressions: totalImpression,
        reach: totalReach,
        clicks: totalClicks,
    };

    let advertisingReturnData = {
        revenue: Object.values(revenueGraphData),
        dates: Object.keys(revenueGraphData),
    };


    // Total Page Impressions And Clicks Over Time
    let divWidth = document.querySelector("#impressionsAndClicksChart").clientWidth;
    let offset = 0;
    let rotate = 0;
    if(impressionsAndClicksData.dates.length>=20||(impressionsAndClicksData.dates.length>15&&divWidth<600)){
        offset = 20;
        rotate = -45;
    }
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
                if (date.length === 10) {
                    return date.slice(5)
                }
                ;
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

    const impressionsAndClicksChart = new ApexCharts(document.querySelector("#impressionsAndClicksChart"), impressionsAndClicksOptions);
    impressionsAndClicksChart.render();

    // Spend Vs Revenue
    divWidth = document.querySelector("#spendVsRevenueChart").clientWidth;
    offset = 0;
    rotate = 0;
    if(spendVsRevenueData.dates.length>=20||(spendVsRevenueData.dates.length>15&&divWidth<600)){
        offset = 20;
        rotate = -45;
    }
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
                if (date.length === 10) {
                    return date.slice(5)
                }
                ;
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

    const spendVsRevenueChart = new ApexCharts(document.querySelector("#spendVsRevenueChart"), spendVsRevenueOptions);
    spendVsRevenueChart.render();

    // Return On Advertising Spend
    divWidth = document.querySelector("#advertisingReturnChart").clientWidth;
    offset = 0;
    rotate = 0;
    if(advertisingReturnData.dates.length>=20||(advertisingReturnData.dates.length>15&&divWidth<600)){
        offset = 20;
        rotate = -45;
    }
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
                if (date.length === 10) {
                    return date.slice(5)
                }
                ;
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

    const advertisingReturnChart = new ApexCharts(document.querySelector("#advertisingReturnChart"), advertisingReturnOptions);
    advertisingReturnChart.render();

    // Ads conversion Funnel

    const pageImpressionsNumber = adsConversionData.impressions;
    const reachNumber = adsConversionData.reach;
    const clicksNumber = adsConversionData.clicks;

    let reachPercent = 0;
    let clicksPercent = 0;
    let immersionPersent = 100;

    if (pageImpressionsNumber > 0) {
        reachPercent = Math.round(
            (reachNumber / pageImpressionsNumber) * 100
        ) / 100 * 100;
        console.log(clicksNumber, pageImpressionsNumber)
        clicksPercent = Math.round(
            (clicksNumber / pageImpressionsNumber) * 100
        ) / 100 * 100;
    }
    ;

    let clicksToReachPercent = 0;

    if (reachPercent > 0) {
        clicksToReachPercent = Math.round(
            (clicksPercent / reachPercent * 100) * 100
        ) / 100;
    }
    ;

    const totalConversion = Math.round(reachPercent * immersionPersent) / 100;

    const impressionsElement = document.querySelector('#adsConversionImpressions');
    const reachElement = document.querySelector('#adsConversionReach');
    const clickElement = document.querySelector('#adsConversionClicks');
    const conversionElement = document.querySelector('#adsConversionConversion');
    const graph = document.querySelector('#adsConversionChart');
    const funnel = document.querySelector('#funnelChart');

    const colorOrange = '#FF9A41';
    const colorBlue = '#356792';
    const colorDarkBlue = '#0B243A';

    impressionsElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: ${colorOrange}"></div>
    <p class="data-sheet-text">${'{{__('Impressions')}}'}</p>
  </div>
  <p class="data-sheet-data">${pageImpressionsNumber}</p>
  `;

    clickElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: ${colorDarkBlue}"></div>
    <p class="data-sheet-text">${'{{__('Clicks')}}'}</p>
  </div>
  <p class="data-sheet-data">${clicksNumber} (${clicksPercent}%)</p>
  `;

    reachElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: ${colorBlue}"></div>
    <p class="data-sheet-text">${'{{__('Reach')}}'}</p>
  </div>
  <p class="data-sheet-data">${reachNumber} (${reachPercent}%)</p>
  `;

    conversionElement.innerHTML = `
  <div class="data-sheet-info">
    <p class="data-sheet-text">${'{{__('Conversion')}}'}</p>
  </div>
  <p class="data-sheet-data">${totalConversion}%</p>
  `;
    if(pageImpressionsNumber > 0) {
        graph.setAttribute('style', `background: linear-gradient(0deg, ${colorBlue} ${reachPercent}%, ${colorDarkBlue} ${clicksPercent}%, ${colorOrange} ${immersionPersent}% 100%)`);
    }
    else{
        funnel.innerHTML += `<p style='margin:0 auto; position: absolute; top: 50%; transform: translate(50%, -50%); right: 50%;' class="data-sheet-text">{{__('No data available')}}</p>`
    }
</script>
