<div class="container-fluid main-content-wrapper">
    @if(!empty($page))

        <div class="container-fluid main-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card smallest-card-height d-flex justify-content-center align-items-center">
                        <div class="card-body text-right">
                            <p class="font-45-lh-54-medium" style="font-family: 'Helvetica';color: #0B243A;">{{$connect_name}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-pane active " id="ads-page">
                        <div class="row">
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                      <div class='i-icon-wrap'>
                                        <div class="i-icon"></div>
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text</span>
                                      </div>
                                        <p class="font-21-lh-25 card__title card__title_new">{{__('Total Impressions')}} </p>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text-new">{{__('The number of times your campaign were shown.')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image/icon/dashnoard-impressions.svg')}}}">
                                                    
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Impressions')}}</p>
                                                <h3 class="mb-0 card__total-title-count" style="font-family: 'Helvetica';font-weight: 400;font-size: 42px;color: #0B243A;">
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
                                        <p class="font-21-lh-25 card__title card__title_new">{{__('Click Through Rate')}}</p>
                                        <p style="max-width: 430px;" class="font-16-lh-19-regular mb-0 card__title-text-new">{{__('The number of clicks that your ad receives divided by the number of times your ad is shown.')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <!-- <img src="{{{url('/assets/image_new/svg/colored/press-button.svg')}}}"> -->
                                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: translateY(-9px);">
                                                    <path d="M39.294 55.0002H27.501C27.0325 55.0046 26.5682 54.9113 26.1377 54.7262C25.7073 54.5411 25.3201 54.2683 25.001 53.9252L12.75 43.4252L14.601 41.5002C14.8367 41.2454 15.1229 41.0426 15.4415 40.9048C15.7601 40.7671 16.1039 40.6974 16.451 40.7002H17.001L25.001 45.0002V20.0002C25.001 19.3372 25.2644 18.7013 25.7332 18.2324C26.2021 17.7636 26.838 17.5002 27.501 17.5002C28.1641 17.5002 28.7999 17.7636 29.2688 18.2324C29.7376 18.7013 30.001 19.3372 30.001 20.0002V31.1762L33.027 31.5012L45.377 36.9762C46.0208 37.2711 46.5646 37.7474 46.9419 38.3467C47.3191 38.9459 47.5134 39.6422 47.501 40.3502V46.0932L46.533 47.1442C46.5291 46.2713 46.2666 45.4191 45.7787 44.6952C45.2909 43.9713 44.5995 43.4081 43.7919 43.0768C42.9843 42.7455 42.0966 42.6608 41.2409 42.8335C40.3852 43.0063 39.5999 43.4286 38.984 44.0473C38.3681 44.6659 37.9493 45.4532 37.7805 46.3096C37.6116 47.1661 37.7003 48.0534 38.0353 48.8595C38.3702 49.6656 38.9365 50.3544 39.6626 50.839C40.3887 51.3236 41.2421 51.5822 42.115 51.5822C42.228 51.5822 42.343 51.5822 42.456 51.5692L39.295 55.0002H39.294ZM22.501 34.1502C19.4265 33.0603 16.7914 30.9973 14.9955 28.2742C13.1996 25.5511 12.3409 22.3165 12.5497 19.0613C12.7585 15.806 14.0234 12.7076 16.1525 10.2363C18.2815 7.76495 21.1586 6.05548 24.3471 5.36726C27.5357 4.67903 30.8617 5.0496 33.8205 6.42274C36.7794 7.79589 39.2097 10.0967 40.7426 12.976C42.2755 15.8554 42.8274 19.1561 42.3146 22.3775C41.8018 25.5989 40.2522 28.5652 37.901 30.8262L35.401 29.7002C37.5201 27.9799 39.0185 25.614 39.668 22.963C40.3175 20.312 40.0823 17.5213 38.9985 15.0164C37.9146 12.5114 36.0414 10.4295 33.6644 9.08805C31.2874 7.74658 28.537 7.2191 25.8323 7.58601C23.1277 7.95292 20.6172 9.19409 18.6835 11.1203C16.7498 13.0466 15.4989 15.5523 15.1216 18.2555C14.7442 20.9587 15.2611 23.7111 16.5934 26.0933C17.9256 28.4754 20.0002 30.3567 22.501 31.4502V34.1502ZM22.501 28.6502C20.9737 27.7833 19.7052 26.5247 18.8263 25.0042C17.9475 23.4837 17.49 21.7564 17.501 20.0002C17.501 17.348 18.5546 14.8045 20.4299 12.9291C22.3053 11.0538 24.8488 10.0002 27.501 10.0002C30.1532 10.0002 32.6967 11.0538 34.5721 12.9291C36.4474 14.8045 37.501 17.348 37.501 20.0002C37.5124 21.7563 37.055 23.4837 36.1761 25.004C35.2972 26.5244 34.0285 27.7827 32.501 28.6492V25.6002C33.6332 24.5876 34.4312 23.2551 34.7894 21.779C35.1477 20.3029 35.0493 18.7528 34.5073 17.3339C33.9653 15.9149 33.0053 14.694 31.7542 13.8326C30.5031 12.9712 29.0199 12.51 27.501 12.51C25.9821 12.51 24.4989 12.9712 23.2478 13.8326C21.9968 14.694 21.0367 15.9149 20.4947 17.3339C19.9527 18.7528 19.8544 20.3029 20.2126 21.779C20.5709 23.2551 21.3689 24.5876 22.501 25.6002V28.6522V28.6502Z" fill="#FF9A41"></path>
                                                    <path d="M51.742 44.6368C51.8544 44.5159 51.99 44.419 52.1407 44.3517C52.2914 44.2845 52.4541 44.2483 52.6191 44.2453C52.7842 44.2424 52.9481 44.2727 53.1011 44.3345C53.2541 44.3963 53.3931 44.4883 53.5098 44.605C53.6264 44.7218 53.7184 44.8608 53.7801 45.0139C53.8418 45.1669 53.872 45.3309 53.869 45.4959C53.8659 45.6609 53.8296 45.8236 53.7623 45.9742C53.6949 46.1249 53.5979 46.2604 53.477 46.3728L41.323 58.5268C41.2107 58.6477 41.0751 58.7447 40.9245 58.812C40.7738 58.8794 40.6111 58.9157 40.4461 58.9187C40.2811 58.9218 40.1172 58.8915 39.9641 58.8298C39.8111 58.7681 39.672 58.6762 39.5553 58.5595C39.4386 58.4428 39.3466 58.3038 39.2847 58.1508C39.2229 57.9978 39.1926 57.8339 39.1956 57.6689C39.1985 57.5039 39.2347 57.3412 39.302 57.1905C39.3692 57.0398 39.4662 56.9042 39.587 56.7918L51.742 44.6368Z" fill="#FF9A41"></path>
                                                    <path d="M43.928 48.9777C43.5846 49.3212 43.147 49.5551 42.6705 49.6499C42.1941 49.7447 41.7003 49.6961 41.2515 49.5102C40.8027 49.3244 40.4191 49.0096 40.1492 48.6057C39.8793 48.2018 39.7352 47.7269 39.7352 47.2412C39.7352 46.7554 39.8793 46.2805 40.1492 45.8766C40.4191 45.4727 40.8027 45.1579 41.2515 44.9721C41.7003 44.7862 42.1941 44.7376 42.6705 44.8324C43.147 44.9272 43.5846 45.1611 43.928 45.5047C44.3885 45.9652 44.6472 46.5899 44.6472 47.2412C44.6472 47.8925 44.3885 48.5171 43.928 48.9777Z" fill="#FF9A41"></path>
                                                    <path d="M49.137 57.6598C49.4805 58.0033 49.9181 58.2373 50.3945 58.3321C50.871 58.4269 51.3648 58.3783 51.8136 58.1924C52.2624 58.0065 52.646 57.6917 52.9159 57.2878C53.1858 56.8839 53.3298 56.4091 53.3298 55.9233C53.3298 55.4375 53.1858 54.9627 52.9159 54.5588C52.646 54.1549 52.2624 53.8401 51.8136 53.6542C51.3648 53.4683 50.871 53.4197 50.3945 53.5145C49.9181 53.6093 49.4805 53.8433 49.137 54.1868C48.6765 54.6474 48.4178 55.272 48.4178 55.9233C48.4178 56.5746 48.6765 57.1992 49.137 57.6598Z" fill="#FF9A41"></path>
                                                </svg>
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Rate')}}</p>
                                                <h3 class="mb-0 card__total-title-count" style="font-family: 'Helvetica';font-weight: 400;font-size: 42px;color: #0B243A;">
                                                    {{!empty($data->ctr) ? round($data->ctr, 2) : 0}}%</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                      <div class='i-icon-wrap'>
                                        <div class="i-icon"></div>
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text about impressions</span>
                                      </div>
                                        <p class="font-21-lh-25 card__title card__title_new">{{__('Impressions')}}  </p>
                                        <p class="font-16-lh-19-regular card__title-text-new">{{__('Total number of Impressions. No historical data is available from before the initial connection.')}}</p>
                                        <div id="likesChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                      <div class='i-icon-wrap'>
                                        <div class="i-icon"></div>
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text about engagement</span>
                                      </div>
                                        <p class="font-21-lh-25 card__title card__title_new">{{__('Page Engagement Over Time')}}</p>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text-new">{{__('The total count of an engaged user on the page daily over the set period')}}</p>
                                        <div id="engagementChart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                      <div class='i-icon-wrap'>
                                        <div class="i-icon"></div>
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text about impressions and clicks</span>
                                      </div>
                                        <p class="font-21-lh-25 card__title card__title_new">{{__('Impressions vs. Clicks')}}</p>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text-new">{{__('The total impressions and reach that convert to clicks on the page.')}}</p>
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
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="card">
                                    <div class="card-body text-right card-body-wrap">
                                      <div class='i-icon-wrap'>
                                        <div class="i-icon"></div>
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text about campaigns</span>
                                      </div>
                                        <p class="font-21-lh-25 card__title card__title_new">{{__('Top Campaigns')}}</p>
                                        <p class="font-16-lh-19-regular mb-3 card__title-text-new">{{__('Measures the effectiveness of your ad campaigns')}}</p>
                                        <div class="my-table table-responsive table google-ads-tbody-list">
                                            @if(!empty($campaign_data) && count($campaign_data)>0)
                                            <table>
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
                            <div class="col-lg-6 col-xs-12">
                                <div class="card">
                                    <div class="card-body text-right card-body-wrap">
                                      <div class='i-icon-wrap'>
                                        <div class="i-icon"></div>
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text about ad groups</span>
                                      </div>
                                        <p class="font-21-lh-25 card__title card__title_new">{{__('Top Ad Groups')}}</p>
                                        <p class="font-16-lh-19-regular mb-3 card__title-text-new">{{__('Measures the effectiveness of your ad groups')}}</p>
                                        <div class="my-table table-responsive table google-ads-tbody-list">
                                            @if(!empty($group_data) && count($group_data)>0)
                                            <table class="table">
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
    if(Object.keys(impressionsGraphData).length>30||(Object.keys(impressionsGraphData).length>15&&divWidth<750)){
        offset = 20;
    }

    var likesOptions = {
        series: [{
            name: '{{__('Unique page likes')}}',
            data: Object.values(impressionsGraphData),
            // data: [1, 2, 3],
        }],
        chart: {
            height: 280,
            width: '93%',
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

    let engagementColWidth = '85%';

    if (engagementData.engagedUserCount.length < 17) {
        engagementColWidth = (engagementData.engagedUserCount.length * 5) + '%';
    }
    ;
    let engDivWidth = document.querySelector("#engagementChart").clientWidth;
    offset = 0;
    if(engagementData.dates.length>30||(engagementData.dates.length>15&&engDivWidth<750)){
        offset = 20;
    }
    var engagementOptions = {
        series: [{
            name: '{{__('Engaged Users')}}',
            data: engagementData.engagedUserCount,
        }],
        chart: {
            type: 'bar',
            height: 300,
            width: '93%',
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

<script>
    window.dispatchEvent(new Event('resize'));
</script>