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

<div class="container-fluid main-content-wrapper">
    @if(!empty($page))

        <div class="container-fluid main-content-wrapper">
            <div class="row">
                <div style="margin-top: 70px; margin-bottom: 50px;" class="col-12">
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
                                    <div class="card-body text-right">
                                        <div class='i-icon-wrap'>
                                            <div class="i-icon"></div>
                                            <span class="info-tooltip" data-tooltip='info tool'>some info text</span>
                                        </div>
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Total Impressions')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of times your campaign were shown.')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image/icon/dashnoard-impressions.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Impressions')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    {{!empty($data->impressions) ? $data->impressions : 0}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <div class='i-icon-wrap'>
                                            <div class="i-icon"></div>
                                            <span class="info-tooltip" data-tooltip='info tool'>some info text about clicks</span>
                                        </div>
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Click Through Rate')}}</h5>
                                        <p style="max-width: 430px;" class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of clicks that your ad receives divided by the number of times your ad is shown.')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img src="{{{url('/assets/image_new/svg/colored/press-button.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Rate')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    {{!empty($data->ctr) ? round($data->ctr, 2) : 0}}%</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <div class='i-icon-wrap'>
                                            <div class="i-icon"></div>
                                            <span class="info-tooltip" data-tooltip='info tool'>some info text about impressions</span>
                                        </div>
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Impressions')}}  </h5>
                                        <p class="font-16-lh-19-regular card__title-text">{{__('Total number of Impressions. No historical data is available from before the initial connection.')}}</p>
                                        <div id="likesChart" style="width: 680px !important"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <div class='i-icon-wrap'>
                                            <div class="i-icon"></div>
                                            <span class="info-tooltip" data-tooltip='info tool'>some info text about engagement</span>
                                        </div>
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Page Engagement Over Time')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total count of an engaged user on the page daily over the set period')}}</p>
                                        <div id="engagementChart" style="width: 680px"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <div class='i-icon-wrap'>
                                            <div class="i-icon"></div>
                                            <span class="info-tooltip" data-tooltip='info tool'>some info text about impressions and clicks</span>
                                        </div>
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Impressions vs. Clicks')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total impressions and reach that convert to clicks on the page.')}}</p>
                                        <div style="position: relative;" id="funnelChart">
                                            <div class="impressions-vs-clicks-chart ads-triangle" id="impressionsVsClicksChart">
                                            </div>
                                            <div class="tooltip1">
                                                <div class="imm">{{__('Impressions')}}: {{$data->impressions}}</div>
                                                <div class="reach">{{__('Clicks')}}: {{$data->clicks}}</div>
                                                <div class="clicks">{{__('Conversion')}}: {{$data->conversions}}</div>
                                            </div>
                                        </div>

                                        <div class="impressions-vs-clicks-table">
                                            <div class="data-sheet-metric" id="impressionsVsClicksImpressions"></div>
                                            <div class="data-sheet-metric data-sheet-metric--background-light-blue"
                                                 id="impressionsVsClicksReach"></div>
                                            <div class="data-sheet-metric" id="impressionsVsClicksClicks"></div>
                                            <div class="impressions-vs-clicks-line"></div>
                                            <div class="data-sheet-metric" id="impressionsVsClicksConversion"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 720px!important;">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-right card-body-wrap">
                                        <div class='i-icon-wrap'>
                                            <div class="i-icon"></div>
                                            <span class="info-tooltip" data-tooltip='info tool'>some info text about campaigns</span>
                                        </div>
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Top Campaigns')}}</h5>
                                        <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('Measures the effectiveness of your ad campaigns')}}</p>
                                        <div class="my-table table-responsive table google-ads-tbody-list">
                                            @if(!empty($campaign_data) && count($campaign_data)>0)
                                                <table style="width: 100%;">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('Multiple Dimensions')}}</th>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('Clicks')}}</th>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('Impressions')}}</th>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('CTR')}}</th>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('Costs')}}</th>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('Conversions')}}</th>
                                                    </tr>
                                                    </thead>
                                                    {{-- <div class="google-ads-tbody-list"> --}}
                                                    <tbody class="google-ads-tbody-list">
                                                    @foreach($campaign_data as $campaign)
                                                        <tr>
                                                            <th class="font-16-lh-19-regular" scope="row1">
                                                                {{__('Name')}}: {{Str::limit($campaign->name, 30)}}
                                                                {{__('Device')}}: {{$campaign->device}}
                                                                {{__('Network Type')}}: {{$campaign->network_type}}
                                                            </th>
                                                            <td class="font-16-lh-19-regular">{{$campaign->clicks}}</td>
                                                            <td class="font-16-lh-19-regular">{{$campaign->impressions}}</td>
                                                            <td class="font-16-lh-19-regular">{{round($campaign->ctr, 2)}}%</td>
                                                            <td class="font-16-lh-19-regular">{{$google_ads_account->currency_code . number_format($campaign->cost/1000000, 2, '.', ',')}}</td>
                                                            <td class="font-16-lh-19-regular">{{round($campaign->conversions, 2)}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    {{-- </div> --}}
                                                </table>
                                            @else
                                                <p class="text-center dashboard-notposts">
                                                    {{__("Here will be your list of top campaigns data")}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-6">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body text-right card-body-wrap">--}}
{{--                                        <div class='i-icon-wrap'>--}}
{{--                                            <div class="i-icon"></div>--}}
{{--                                            <span class="info-tooltip" data-tooltip='info tool'>some info text about ad groups</span>--}}
{{--                                        </div>--}}
{{--                                        <h5 class="font-21-lh-25-bold card__title">{{__('Top Ad Groups')}}</h5>--}}
{{--                                        <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('Measures the effectiveness of your ad groups')}}</p>--}}
{{--                                        <div class="my-table table-responsive table google-ads-tbody-list">--}}
{{--                                            @if(!empty($group_data) && count($group_data)>0)--}}
{{--                                                <table class="table">--}}
{{--                                                    <thead>--}}
{{--                                                    <tr>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('Multiple Dimensions')}}</th>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('Clicks')}}</th>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('Impressions')}}</th>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('CTR')}}</th>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('Costs')}}</th>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('Conversions')}}</th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    --}}{{-- <div class="google-ads-tbody-list"> --}}
{{--                                                    <tbody class="google-ads-tbody-list">--}}
{{--                                                    @foreach($group_data as $group)--}}
{{--                                                        <tr>--}}
{{--                                                            <th class='font-16-lh-19-regular' scope="row1">--}}
{{--                                                                {{__('Ad Group')}}: {{Str::limit($group->base_ad_group, 25)}}--}}
{{--                                                                {{__('Campaign')}}: {{Str::limit($group->campaign_resource_name, 25)}}--}}
{{--                                                                {{__('Device')}}: {{$group->device}}--}}
{{--                                                                {{__('Network Type')}}: {{$group->network_type}}--}}
{{--                                                            </th>--}}
{{--                                                            <td class="font-16-lh-19-regular">{{$group->clicks}}</td>--}}
{{--                                                            <td class="font-16-lh-19-regular">{{$group->impressions}}</td>--}}
{{--                                                            <td class="font-16-lh-19-regular">{{round($group->ctr, 2)}}%</td>--}}
{{--                                                            <td class="font-16-lh-19-regular">{{$google_ads_account->currency_code . number_format($group->cost/1000000, 2, '.', ',')}}</td>--}}
{{--                                                            <td class="font-16-lh-19-regular">{{round($campaign->conversions, 2)}}</td>--}}
{{--                                                        </tr>--}}
{{--                                                    @endforeach--}}
{{--                                                    </tbody>--}}
{{--                                                    --}}{{-- </div> --}}
{{--                                                </table>--}}
{{--                                            @else--}}
{{--                                                <p class="text-center dashboard-notposts">--}}
{{--                                                    {{__("Here will be your list of top ad groups data")}}--}}
{{--                                                </p>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">
{{--                            <div class="col-6">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body text-right card-body-wrap">--}}
{{--                                        <div class='i-icon-wrap'>--}}
{{--                                            <div class="i-icon"></div>--}}
{{--                                            <span class="info-tooltip" data-tooltip='info tool'>some info text about campaigns</span>--}}
{{--                                        </div>--}}
{{--                                        <h5 class="font-21-lh-25-bold card__title">{{__('Top Campaigns')}}</h5>--}}
{{--                                        <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('Measures the effectiveness of your ad campaigns')}}</p>--}}
{{--                                        <div class="my-table table-responsive table google-ads-tbody-list">--}}
{{--                                            @if(!empty($campaign_data) && count($campaign_data)>0)--}}
{{--                                                <table>--}}
{{--                                                    <thead>--}}
{{--                                                    <tr>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('Multiple Dimensions')}}</th>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('Clicks')}}</th>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('Impressions')}}</th>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('CTR')}}</th>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('Costs')}}</th>--}}
{{--                                                        <th scope="col"--}}
{{--                                                            class="font-13-lh-15-regular">{{__('Conversions')}}</th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    --}}{{-- <div class="google-ads-tbody-list"> --}}
{{--                                                    <tbody class="google-ads-tbody-list">--}}
{{--                                                    @foreach($campaign_data as $campaign)--}}
{{--                                                        <tr>--}}
{{--                                                            <th class="font-16-lh-19-regular" scope="row1">--}}
{{--                                                                {{__('Name')}}: {{Str::limit($campaign->name, 30)}}--}}
{{--                                                                {{__('Device')}}: {{$campaign->device}}--}}
{{--                                                                {{__('Network Type')}}: {{$campaign->network_type}}--}}
{{--                                                            </th>--}}
{{--                                                            <td class="font-16-lh-19-regular">{{$campaign->clicks}}</td>--}}
{{--                                                            <td class="font-16-lh-19-regular">{{$campaign->impressions}}</td>--}}
{{--                                                            <td class="font-16-lh-19-regular">{{round($campaign->ctr, 2)}}%</td>--}}
{{--                                                            <td class="font-16-lh-19-regular">{{$google_ads_account->currency_code . number_format($campaign->cost/1000000, 2, '.', ',')}}</td>--}}
{{--                                                            <td class="font-16-lh-19-regular">{{round($campaign->conversions, 2)}}</td>--}}
{{--                                                        </tr>--}}
{{--                                                    @endforeach--}}
{{--                                                    </tbody>--}}
{{--                                                    --}}{{-- </div> --}}
{{--                                                </table>--}}
{{--                                            @else--}}
{{--                                                <p class="text-center dashboard-notposts">--}}
{{--                                                    {{__("Here will be your list of top campaigns data")}}--}}
{{--                                                </p>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div style="margin-top: 70px; margin-bottom: 50px;" class="col-12">
                                <div class="card">
                                    <div class="card-body text-right card-body-wrap">
                                        <div class='i-icon-wrap'>
                                            <div class="i-icon"></div>
                                            <span class="info-tooltip" data-tooltip='info tool'>some info text about ad groups</span>
                                        </div>
                                        <h5 class="font-21-lh-25-bold card__title">{{__('Top Ad Groups')}}</h5>
                                        <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('Measures the effectiveness of your ad groups')}}</p>
                                        <div class="my-table table-responsive table google-ads-tbody-list">
                                            @if(!empty($group_data) && count($group_data)>0)
                                                <table style="width: 100%;" class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('Multiple Dimensions')}}</th>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('Clicks')}}</th>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('Impressions')}}</th>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('CTR')}}</th>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('Costs')}}</th>
                                                        <th scope="col"
                                                            class="font-13-lh-15-regular">{{__('Conversions')}}</th>
                                                    </tr>
                                                    </thead>
                                                    {{-- <div class="google-ads-tbody-list"> --}}
                                                    <tbody class="google-ads-tbody-list">
                                                    @foreach($group_data as $group)
                                                        <tr>
                                                            <th class='font-16-lh-19-regular' scope="row1">
                                                                {{__('Ad Group')}}: {{Str::limit($group->base_ad_group, 25)}}
                                                                {{__('Campaign')}}: {{Str::limit($group->campaign_resource_name, 25)}}
                                                                {{__('Device')}}: {{$group->device}}
                                                                {{__('Network Type')}}: {{$group->network_type}}
                                                            </th>
                                                            <td class="font-16-lh-19-regular">{{$group->clicks}}</td>
                                                            <td class="font-16-lh-19-regular">{{$group->impressions}}</td>
                                                            <td class="font-16-lh-19-regular">{{round($group->ctr, 2)}}%</td>
                                                            <td class="font-16-lh-19-regular">{{$google_ads_account->currency_code . number_format($group->cost/1000000, 2, '.', ',')}}</td>
                                                            <td class="font-16-lh-19-regular">{{round($campaign->conversions, 2)}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    {{-- </div> --}}
                                                </table>
                                            @else
                                                <p class="text-center dashboard-notposts">
                                                    {{__("Here will be your list of top ad groups data")}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
</div>
@include('frontend.components.topup')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
    var tooltip = document.querySelector('.tooltip1');
    let chart1 = document.querySelector('#funnelChart')
    let rect = chart1.getBoundingClientRect();
    chart1.addEventListener('mousemove', fn, false);

    function fn(e) {
        tooltip.style.left = e.clientX + 'px' ;
        tooltip.style.top = e.clientY - 50 + 'px';
    }

    let impressionsGraphData = @if(!empty($impressions_per_day))@json($impressions_per_day)@endif;
    let clickGraphData = @if(!empty($clicks_per_day))@json($clicks_per_day)@endif;
    console.log(Object.keys(impressionsGraphData));

    // Data
    let impressions = @if(!empty($data->impressions)) {{$data->impressions}} @else 0 @endif;
    let clicks = @if(!empty($data->clicks)) {{$data->clicks}} @else 0 @endif;
    let conversions = @if(!empty($data->conversions)) {{$data->conversions}} @else 0 @endif;

    let impressionsVsClicksData = {
        impressions: impressions,
        reach: clicks,
        clicks: conversions,
    };

    let engagementData = {
        engagedUserCount:  Object.values(clickGraphData),
        dates:  Object.keys(clickGraphData),
    };

    // Total Page Likes Over Time
    let divWidth = document.querySelector("#likesChart").clientWidth;
    let offset = 0;
    let rotate = 0;
    if(Object.keys(impressionsGraphData).length>=20||(Object.keys(impressionsGraphData).length>15&&divWidth<600)){
        offset = 20;
        rotate = -45;
    }

    var likesOptions = {
        series: [{
            name: '{{__('Unique page likes')}}',
            data: Object.values(impressionsGraphData),
            // data: [1, 2, 3],
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
            categories: Object.keys(impressionsGraphData).map(date => {
                if (date.length === 10) {
                    return date.slice(5)
                }
                return date;
            }),
            // categories: [1, 2, 3],
            labels: {
                style: {
                    colors: '#B0BBCB',
                },
                hideOverlappingLabels: true,
                offsetY: offset,
                rotate: rotate,
            },
            position: 'bottom',
            // offsetY: offset,
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

    const likesChart = new ApexCharts(document.querySelector("#likesChart"), likesOptions);
    likesChart.render();

    // Page Impressions vs. Clicks

    const pageImpressionsNumber = impressionsVsClicksData.impressions;
    const reachNumber = impressionsVsClicksData.reach;
    const clicksNumber = impressionsVsClicksData.clicks;

    let reachPercent = 0;
    let clicksPercent = 0;
    let immersionPersent = 100;

    if (pageImpressionsNumber > 0) {
        reachPercent = Math.round(
            (reachNumber / pageImpressionsNumber) * 100 * 100
        ) / 100;
        clicksPercent = Math.round(
            (clicksNumber / pageImpressionsNumber) * 100 * 100
        ) / 100 ;
    }
    ;

    let clicksToReachPercent = 0;

    if (reachPercent > 0) {
        clicksToReachPercent = Math.round(
            (clicksPercent / reachPercent * 100) * 100
        ) / 100;
    }
    ;

    const totalConversion = Math.round(clicksPercent * immersionPersent) / 100;

    const impressionsElement = document.querySelector('#impressionsVsClicksImpressions');
    const reachElement = document.querySelector('#impressionsVsClicksReach');
    const clickElement = document.querySelector('#impressionsVsClicksClicks');
    const conversionElement = document.querySelector('#impressionsVsClicksConversion');
    const graph = document.querySelector('#impressionsVsClicksChart');
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
    <p class="data-sheet-text">${'{{__('Conversion')}}'}</p>
  </div>
  <p class="data-sheet-data">${clicksNumber} (${clicksPercent}%)</p>
  `;

    reachElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: ${colorBlue}"></div>
    <p class="data-sheet-text">${'{{__('Clicks')}}'}</p>
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
        graph.setAttribute('style', `background: linear-gradient(0deg, ${colorDarkBlue} ${clicksPercent}%, ${colorBlue} ${reachPercent}%, ${colorOrange} ${immersionPersent}% 100%)`);
    }
    else{
        graph.style.display = 'none';
        funnel.innerHTML += `<div style="width: 50%; min-width: 200px; max-width: 300px; height: 150px;"></div> <p style='margin:0 auto; position: absolute; top: 50%; transform: translate(50%, -50%); right: 50%;' class="data-sheet-text">{{__('No data available')}}</p>`
    }

    const impressionsViralElement = document.querySelector('#impressionsViral');

    function findImpressionsPercent(specifiedImpressions) {
        if (totalImpressionsCount === 0) {
            return 0;
        }
        return Math.round(
            (specifiedImpressions / totalImpressionsCount * 100) * 100
        ) / 100;
    };

    function findPageImpressionsPercent(specifiedImpressions) {
        if (pageTotalImpressionsCount === 0) {
            return 0;
        }
        return Math.round(
            (specifiedImpressions / pageTotalImpressionsCount * 100) * 100
        ) / 100;
    };

    function findAveragePostPercent(specifiedImpressions) {
        if (averageTotalCount === 0) {
            return 0;
        }
        return Math.round(
            (specifiedImpressions / averageTotalCount * 100) * 100
        ) / 100;
    };


    // Page engagement over Time
    divWidth = document.querySelector("#engagementChart").clientWidth;
    offset = 0;
    rotate = 0;
    // if(likeDate.length>=20||(likeDate.length>15&&divWidth<600)){
        offset = 20;
        rotate = -45;
    // }
    let engagementColWidth = '85%';

    if (engagementData.engagedUserCount.length < 17) {
        engagementColWidth = (engagementData.engagedUserCount.length * 5) + '%';
    }
    ;
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
                offsetY: offset,
                rotate: rotate,
            },
            categories: engagementData.dates.map(date => {
                if (date.length === 10) {
                    return date.slice(5)
                }
                ;
                return date;
            }),
            // offsetY: offset,
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
        tooltip: {},
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

    const engagementChart = new ApexCharts(document.querySelector("#engagementChart"), engagementOptions);

    engagementChart.render();

</script>
