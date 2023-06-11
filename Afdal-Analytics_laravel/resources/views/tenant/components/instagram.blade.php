


<div class="container-fluid main-content-wrapper">
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
            <div class="col-lg-4 col-xs-12">
                <div class="card small-card-height">
                    <div class="card-body text-right">
                        <h5 class="font-21-lh-25 card__title">{{__('Total Likes')}}</h5>
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
            <div class="col-lg-4 col-xs-12">
                <div class="card small-card-height">
                    <div class="card-body text-right">
                        <h5 class="font-21-lh-25 card__title">{{__('Total Followers')}} </h5>
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
                        <h5 class="font-21-lh-25 card__title">{{__('Total Impressions')}} </h5>
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
                        @if(empty($followers_by_country) || count($followers_by_country) === 0)
                            <div class='i-icon-wrap'>
                                <div class="i-icon"></div>
                                <span class="info-tooltip" data-tooltip='info tool'>{{__('This data will be available after the mark in 100 followers')}}</span>
                            </div>
                        @endif
                        <h5 class="font-21-lh-25 card__title">{{__('Followers By Country')}}</h5>
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
                                        <th scope="row"> -</th>
                                        <td class="font-13-lh-20-regular"> -</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xs-12">
                <div class="card big-card-height">
                    <div class="card-body text-right">
                        <h5 class="font-21-lh-25 card__title">{{__('Total Followers By Gender & Age')}}</h5>
                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of followers broken down by age and gender')}}</p>
                        <div id="distributionChart"></div>
                    </div>
                </div>

                <div class="card big-card-height">
                    <div class="card-body text-right">
                        <h5 class="font-21-lh-25 card__title">{{__('Profile Trend')}}  </h5>
                        <p class="font-16-lh-19-regular card__title-text">{{__('The number of times your post was shown combined vs. the number of unique views')}}</p>
                        <div id="profileTrendChart"></div>
                    </div>
                </div>

            </div>
        </div>

        @if(!empty($posts) && $posts->count() > 0)
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="card">
                        <div class="card-body text-right">
                            <h5 class="font-21-lh-25 card__title">{{__('Top Performing Posts')}}</h5>
                            <p class="font-16-lh-19-regular mb-2 card__title-text">{{__('The top-performing Post by engagement over a set period')}}</p>
                        </div>
                        <div class="container-flow pl-5 pr-5">
                            <ul class="post-card-info-list">
                                @foreach($posts as $post)
                                    <li class="post-card-item col-lg-6 col-xs-12">
                                        @if($post->media_type == "VIDEO")
                                            <video controls style="width: 100%; height: auto; margin: 10px 10px  25px 10px;">
                                                <source src="{{!empty($post->image) ? $post->image : url('/assets/image_new/svg/colored/image-placeholder.svg')}}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img class="post-card-item-image"
                                                 src="{{!empty($post->image) ? $post->image : url('/assets/image_new/svg/colored/image-placeholder.svg')}}"
                                                 alt="image">
                                        @endif
                                        <div class="post-card-item-message">
                                            <div
                                                class="post-card-item-message-name font-13-lh-16-medium">{{__('Message')}}
                                                <div class="message-orange-line"></div>
                                            </div>
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
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="card">
                        <div class="card-body text-right">
                            <h5 class="font-21-lh-25 card__title">{{__('Top Performing Posts')}}</h5>
                            <p class="font-16-lh-19-regular mb-2 card__title-text">{{__('The top-performing Post by engagement over a set period')}}</p>
                        </div>
                        <div class="container-flow pl-5 pr-5">
                            <p class="text-center dashboard-notposts">
                                {{__("Here will be your list of posts")}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @include('frontend.components.topup')

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
        let divWidth = document.querySelector("#profileTrendChart").clientWidth;
        let offset = 0;
        if (followersData.dates.length > 32 || (followersData.dates.length > 20 && divWidth < 750) || (followersData.dates.length >= 28 && divWidth < 900)) {
            offset = 20;
        }
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
                categories: followersData.dates.map(date => {
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
        divWidth = document.querySelector("#distributionChart").clientWidth;
        offset = 0;
        if (followersData.dates.length > 32 || (followersData.dates.length > 20 && divWidth < 750) || (followersData.dates.length >= 28 && divWidth < 900)) {
            offset = 20;
        }
        if (followersData.followers.length < 17) {
            followersWidth = (followersData.followers.length * 5) + '%';
        }
        ;

        var distributionOptions = {
            series: [{
                name: '{{__('Followers')}}',
                type: 'column',
                data: followersData.followers,
            }],
            chart: {
                height: 300,
                width: '93%',
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
            bar: {},
            labels: followersData.dates.map(date => {
                if (date.length === 10) {
                    return date.slice(5)
                }
                ;
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
    <script>
    window.dispatchEvent(new Event('resize'));
</script>
