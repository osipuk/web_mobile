<div class="container-fluid main-content-wrapper">
    @if(!empty($page))

        <div class="container-fluid main-content-wrapper">
            <div class="row">
                <div class="col-12">
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
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body  text-right">
                                        <div class="top-content">
                                            <h5 class="font-21-lh-25 card__title">{{__('Sessions per User')}} </h5>
                                            <p style="max-width: 410px;" class="font-16-lh-19-regular mb-0 card__title-text">{{__('Average number of sessions initiated by each user or visitor to your website/application')}}</p>
                                        </div>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img src="{{{url('/assets/image_new/svg/colored/thumb-up.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Sessions')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$sessionsTotal}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Active Users')}}</h5>
                                        <p style="max-width: 410px;" class="font-16-lh-19-regular mb-0 card__title-text">{{__('Count of both new and returning visitors to your website')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img src="{{{url('/assets/image_new/svg/colored/news-like.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Active Users ')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$activeUsers}}</h3>
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
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text about new users</span>
                                      </div>
                                        <h5 class="font-21-lh-25 card__title">{{__('Users and New Users')}}  </h5>
                                        <p class="font-16-lh-19-regular card__title-text">{{__('Measures website growth and popularity over time')}}</p>
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
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text about Conversions</span>
                                      </div>
                                        <h5 class="font-21-lh-25 card__title">{{__('Conversions')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Total number of conversion events that take place on your website or application at any given period of time')}}</p>
                                        <div id="distributionChart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Top Acquisition Channels (Users)')}} </h5>
                                        <div id="channelPercentageRadialChart"></div>
                                        <div class="impressions-table">
                                            @foreach($channelsUsers as $key => $item)
                                                <div class="data-sheet-metric" id="device{{$item->channel}}">
                                                    <div class="data-sheet-info">
                                                        <div class="data-sheet-bubble" style="background-color: {{ $colorsList[$key] }}"></div>
                                                        <p class="data-sheet-text">{{ $item->channel }}</p>
                                                    </div>
                                                    <p class="data-sheet-data">{{ $item->total_users }} ({{$item->percentage}}%)</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Average Time on Page')}}</h5>
                                        <p style="max-width: 412px" class="font-16-lh-19-regular mb-0 card__title-text">{{__('Measures the average amount of time spent on a single page by all users of a website')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/likes-from-ad.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Time')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$averageTimeOnPage}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Engagement Rate')}} </h5>
                                        <p style="max-width: 400px" class="font-16-lh-19-regular mb-0 card__title-text">{{__('Time your website was in the foreground or your web page was in focus')}} </p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/unique-posts.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Rate ')}} </p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    {{$engagementRate}} </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Total Users')}} </h5>
                                        <p style="max-width: 400px" class="font-16-lh-19-regular mb-0 card__title-text">{{__('Number of distinct users who have logged at least one event, regardless of whether the site or app was in use')}}</p>
                                        <div class="d-flex-dashbard-data mt-3" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/unique-impressions.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Users ')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    {{ $totalUsers }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('What device are people using?')}}</h5>
                                        <div id="devicePercentageChart"></div>
                                        <div class="impressions-table">
                                            @foreach($deviceSessions as $key => $item)
                                            <div class="data-sheet-metric" id="device{{$item->device}}">
                                                <div class="data-sheet-info">
                                                    <div class="data-sheet-bubble" style="background-color: {{ $colorsList[$key] }}"></div>
                                                    <p class="data-sheet-text">{{ $item->device }}</p>
                                                </div>
                                                <p class="data-sheet-data">{{ $item->sessions }} ({{$item->percentage}}%)</p>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Conversions by country')}}</h5>
                                        <div id="countryConversionPercentageChart"></div>
                                        <div class="impressions-table">
                                            @foreach($countryConversions as $key => $item)
                                                <div class="data-sheet-metric" id="countryConversion{{$item->country}}">
                                                    <div class="data-sheet-info">
                                                        <div class="data-sheet-bubble" style="background-color: {{ $colorsList[$key] }}"></div>
                                                        <p class="data-sheet-text">{{ $item->country }}</p>
                                                    </div>
                                                    <p class="data-sheet-data">{{ $item->conversions }} ({{$item->percentage}}%)</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                    <div class="card small-card-height">
                                        <div class="card-body  text-right">
                                            <div class="top-content">
                                                <h5 class="font-21-lh-25 card__title">{{__('User Engagement')}} </h5>
                                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Shows the time that your app screen was in the foreground or your web page was in focus')}}</p>
                                            </div>
                                            <div class="d-flex-dashbard-data" id="mybasis">
                                                <div class="dashboard-data-1 text-left">
                                                    <img src="{{{url('/assets/image_new/svg/colored/thumb-up.svg')}}}">
                                                </div>
                                                <div class="dashboard-data-2 text-right">
                                                    <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Time ')}}</p>
                                                    <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$userEngagement}}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card small-card-height">
                                        <div class="card-body text-right">
                                            <h5 class="font-21-lh-25 card__title">{{__('Page View Per Session')}}</h5>
                                            <p style="max-width: 400px" class="font-16-lh-19-regular mb-0 card__title-text">{{__('Count of a website’s total page views divided by the total number of sessions that have taken place')}}</p>
                                            <div class="d-flex-dashbard-data" id="mybasis">
                                                <div class="dashboard-data-1 text-left">
                                                    <img src="{{{url('/assets/image_new/svg/colored/news-like.svg')}}}">
                                                </div>
                                                <div class="dashboard-data-2 text-right">
                                                    <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Views')}}</p>
                                                    <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{$pageViewsPerSession}}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12">
                                <div class="card">
                                    <div class="card-body text-right">
                                      <div class='i-icon-wrap'>
                                        <div class="i-icon"></div>
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text about country</span>
                                      </div>
                                        <h5 class="font-21-lh-25 card__title">{{__('Country Breakdown')}}</h5>
                                        <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('Number of distinct Users who visited your site during the specified Date Range split by Country')}}</p>
                                        <div class="my-table table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col"
                                                        class="font-13-lh-15-regular">{{__('Country ')}}</th>
                                                    <th scope="col"
                                                        class="font-16-lh-19-regular">{{__('Sessions')}}</th>
                                                </tr>
                                                </thead>
                                                <div class='google-analytics-fifth-section'>
                                                <tbody>
                                                @if(!empty($countriesSessions) && count($countriesSessions)>0)
                                                    @foreach($countriesSessions as $item)
                                                        <tr>
                                                            <th scope="row1"> {{ $item->country }} </th>
                                                            <td class="font-16-lh-19-regular"> {{ $item->sessions }} </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                                </div>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card">
                                    <div class="card-body text-right">
                                      <div class='i-icon-wrap'>
                                        <div class="i-icon"></div>
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text about most popular</span>
                                      </div>
                                        <h5 class="font-21-lh-25 card__title">{{__('Which Page is the most Popular?')}}</h5>
                                        <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('Number of Web Pages your Users Viewed during the specified Date Range split by Page Title')}}</p>
                                        <div class="my-table table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col"
                                                        class="font-13-lh-15-regular">{{__('Page Path')}}</th>
                                                    <th scope="col"
                                                        class="font-13-lh-15-regular">{{__('Page Views')}}</th>
                                                </tr>
                                                </thead>
                                                <div class='google-analytics-fifth-section'>
                                                <tbody>
                                                @if(!empty($mostPopularPages) && count($mostPopularPages)>0)
                                                    @foreach($mostPopularPages as $page)
                                                        <tr>
                                                            <th scope="row1"> {{ $page->page_path }} </th>
                                                            <td class="font-16-lh-19-regular"> {{ $page->views }} </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                                </div>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card">
                                    <div class="card-body text-right">
                                      <div class='i-icon-wrap'>
                                        <div class="i-icon"></div>
                                        <span class="info-tooltip" data-tooltip='info tool'>some info text about top search</span>
                                      </div>
                                        <h5 class="font-21-lh-25 card__title">{{__('Active Users By Page Title')}}</h5>
                                        <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('Number of distinct Users who visited your site during the specified Date Range split by Page Title')}}</p>
                                        <div class="my-table table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col"
                                                        class="font-16-lh-19-semi-bold">{{__('Page Title')}}</th>
                                                    <th scope="col"
                                                        class="font-13-lh-15-regular">{{__('Sessions')}}</th>
                                                    <th scope="col"
                                                        class="font-13-lh-15-regular">{{__('Page Views')}}</th>
                                                </tr>
                                                </thead>
                                                <div class='google-analytics-fifth-section'>
                                                <tbody>
                                                @if(!empty($mostPopularPageTitles) && count($mostPopularPageTitles)>0)
                                                    @foreach($mostPopularPageTitles as $item)
                                                        <tr>
                                                            <th scope="row1"> {{ $item->page_title }}</th>
                                                            <td class="font-13-lh-20-regular"> {{ $item->sessions }} </td>
                                                            <td class="font-13-lh-20-regular"> {{ $item->views }} </td>
                                                        </tr>
                                                    @endforeach
                                                  @endif
                                                </tbody>
                                                </div>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="card">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('What sources are driving the most traffic to your page?')}}</h5>
                                        <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('Use this to analyze where you visitors are coming from and how well they convert')}}</p>
                                        <div class="my-table table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col"
                                                        class="font-13-lh-15-regular">{{__('Source')}}</th>
                                                    <th scope="col"
                                                        class="font-13-lh-15-regular">{{__('Sessions')}}</th>
                                                    <th scope="col"
                                                        class="font-13-lh-15-regular">{{__('Users  ')}}</th>
                                                    <th scope="col" style="width: 270px;"
                                                        class="font-13-lh-15-regular">{{__('New Users ')}}</th>
                                                    <th scope="col" style="width: 150px;"
                                                        class="font-13-lh-15-regular">{{__('Goal Completion')}}</th>
                                                </tr>
                                                </thead>
                                                <div class='google-analy-tbody-list'>
                                                <tbody>
                                                @if(!empty($sources) && count($sources)>0)
                                                    @foreach($sources as $item)
                                                        <tr>
                                                            <th scope="row1"> {{ $item->source }} </th>
                                                            <td class="font-16-lh-19-regular"> {{ $item->sessions }} </td>
                                                            <td class="font-16-lh-19-regular"> {{ $item->users }} </td>
                                                            <td class="font-16-lh-19-regular"> {{ $item->new_users }} </td>
                                                            <td class="font-16-lh-19-regular"> {{ $item->conversions }} </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                                </div>
                                            </table>
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

    function fn(e) {
        tooltip.style.left = e.clientX + 'px' ;
        tooltip.style.top = e.clientY - 50 + 'px';
    }

    let newUsersData = @if(!empty($newUsersPerDay))@json($newUsersPerDay)@endif;
    let returningUsersData = @if(!empty($returningUsersPerDay))@json($returningUsersPerDay)@else 0 @endif;
    let usersDates = @if(!empty($usersDates))@json($usersDates)@endif;

    // Total Page Likes Over Time
    let divWidth = document.querySelector("#likesChart").clientWidth;
    let offset = 0;
    if(usersDates.length>30||(usersDates.length>15&&divWidth<750)){
        offset = 20;
    }

    var usersChartOptions = {
        series: [{
            name: '{{__('new users')}}',
            data: newUsersData
        }, {
            name: '{{__('returning users')}}',
            data: returningUsersData
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
            categories: usersDates.map(date => {
                if (date.length === 10) {
                    return date.slice(5)
                }
                ;
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

    const usersChart = new ApexCharts(document.querySelector("#likesChart"), usersChartOptions);
    usersChart.render();
    
    var devicePercentageData = @json($devicesPercentageList);
    var deviceChartLabels = @json($devicesList);
    var devicesColorsList = @json($colorsList);
    var devicePercentageRadialChartOpt = {
        series: devicePercentageData,
        chart: {
            height: 200,
            type: 'pie'
        },
        labels: deviceChartLabels,
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
        colors: devicesColorsList,
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
                fontFamily: 'NotoSansArabic-Regular'
            }
        },
    };
    const devicePercentageRadialChart = new ApexCharts(document.querySelector("#devicePercentageChart"), devicePercentageRadialChartOpt);
    devicePercentageRadialChart.render();


    var countryConversionPercentageData = @json($countryPercentageList);
    var countryConversionChartLabels = @json($countryList);
    var countryConversionColorsList = @json($colorsList);
    var countryConversionPercentageRadialChartOpt = {
        series: countryConversionPercentageData,
        chart: {
            height: 200,
            type: 'pie'
        },
        labels: countryConversionChartLabels,
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
        colors: countryConversionColorsList,
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
                fontFamily: 'NotoSansArabic-Regular'
            }
        },
    };
    const countryConversionPercentageRadialChart = new ApexCharts(document.querySelector("#countryConversionPercentageChart"), countryConversionPercentageRadialChartOpt);
    countryConversionPercentageRadialChart.render();


    var channelsPercentageData = @json($channelsPercentageList);
    var channelsChartLabels = @json($channelsList);
    var channelsColorsList = @json($colorsList);
    var channelPercentageRadialChartOpt = {
        series: channelsPercentageData,
        chart: {
            height: 200,
            type: 'pie'
        },
        labels: channelsChartLabels,
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
        colors: channelsColorsList,
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
                fontFamily: 'NotoSansArabic-Regular'
            }
        },
    };
    const channelPercentageRadialChart = new ApexCharts(document.querySelector("#channelPercentageRadialChart"), channelPercentageRadialChartOpt);
    channelPercentageRadialChart.render();


    // Conversions
    let conversionsPerDay = @if(!empty($conversionsPerDay))@json($conversionsPerDay)@else [] @endif;
    let conversionsDates = @if(!empty($conversionsDates))@json($conversionsDates)@else [] @endif;

    let distributionColWidth = '30%';
    if (conversionsPerDay.length < 17) {
        distributionColWidth = (conversionsPerDay.length * 5) + '%';
    }

    var distributionOptions = {
        series: [{
            name: '{{__('Engaged Users')}}',
            type: 'column',
            data: conversionsPerDay,
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
        labels: conversionsDates.map(date => {
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
<script>
    window.dispatchEvent(new Event('resize'));
</script>
