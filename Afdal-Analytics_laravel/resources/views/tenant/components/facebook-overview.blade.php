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
                                            <h5 class="font-21-lh-25 card__title">{{__('Total Page Likes')}} </h5>
                                            <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of people who liked your page & posts')}}</p>
                                        </div>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img src="{{{url('/assets/image_new/svg/colored/thumb-up.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Total Page Likes')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{number_format($total_likes)}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Likes From News Feed')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of people who liked your news feed')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img src="{{{url('/assets/image_new/svg/colored/news-like.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Total likes from news feed')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{number_format($news_feed_likes)}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Total Page Likes Over Time')}}  </h5>
                                        <p class="font-16-lh-19-regular card__title-text">{{__('The total number of people who liked your page & posts')}}</p>
                                        <div id="likesChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Likes From Ads')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of people who liked your ads')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/likes-from-ad.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Total Page Likes')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{number_format($ads_likes)}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Unique Post Impressions')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of people who saw any of your page posts')}} </p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/unique-posts.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Post unique impressions')}} </p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    {{number_format($unique_post_impression)}} </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Unique Page Impressions')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of people who saw any content related to your Facebook page')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/unique-impressions.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Post unique impressions')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    {{number_format($unique_page_impression)}} </h3>
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
                                        <h5 class="font-21-lh-25 card__title">{{__('Ads Conversion Funnel')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The flow and conversion path of potential customers into paying customer from Facebook')}}</p>
                                        <div style="position: relative;" id="funnelChart">
                                            <div class="impressions-vs-clicks-chart" id="impressionsVsClicksChart">
                                            </div>
                                            <div class="tooltip1">
                                                <div class="imm">{{__('Impressions')}}: {{$page_impression}}</div>
                                                <div class="reach">{{__('Reach')}}: {{$unique_page_impression}}</div>
                                                <div class="click">{{__('Clicks')}}: {{$page_clicks}}</div>
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
                            <div class="col-lg-4 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Unique Page Impressions By Type')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The impressions on your page broken down by organic, paid, and viral')}}</p>
                                        <div id="pageImpressionsRadialChart"></div>
                                        <div class="impressions-table">
                                            <div class="data-sheet-metric" id="pageImpressionsPaid"></div>
                                            <div class="data-sheet-metric data-sheet-metric--background-light-blue"
                                                 id="pageImpressionsOrganic"></div>
                                            <div class="data-sheet-metric" id="pageImpressionsViral"></div>
                                            <div class="data-sheet-metric data-sheet-metric--background-light-blue"
                                                 id="pageImpressionsNonViral"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Unique Post Impressions By Type')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The Impressions on your posts broken down by organic, paid and viral')}}</p>
                                        <div id="postImpressionsRadialChart"></div>
                                        <div class="impressions-table">
                                            <div class="data-sheet-metric" id="impressionsPaid"></div>
                                            <div class="data-sheet-metric data-sheet-metric--background-light-blue"
                                                 id="impressionsOrganic"></div>
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
                                        <h5 class="font-21-lh-25 card__title">{{__('Top Time For Posting')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The best time of day to post according to the page followers')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/clock.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Time (pacific Standard Time)')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{!empty($page_top_time_post) ? $page_top_time_post . ':00' : '-'}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Top Day To Post')}} </h5>
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
                            </div>
                            <div class="col-lg-8 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Post Distribution')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total count of posts with the total number of engaged users')}}</p>
                                        <div id="distributionChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body  text-right">
                                        <div class="top-content">
                                            <h5 class="font-21-lh-25 card__title">{{__('Page Engagements')}} </h5>
                                            <p class="font-16-lh-19-regular mb-0">{{__('The total number of actions taken on a post')}}</p>
                                        </div>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image_new/svg/colored/page-engagements.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Engaged users')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{number_format($page_engagement)}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Post Reach By Fans')}}</h5>
                                        <p>{{__('The total number of fans reach by a post')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img src="{{{url('/assets/image_new/svg/colored/reach-by-fan.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Post Unique Impression By Fans')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{number_format($post_reach_by_fans)}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Each Post on Average Receives')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The average number of likes, comments, shares, and likes that your content receives')}}</p>
                                        <div id="postAverageChart"></div>
                                        <div class="impressions-table">
                                            <div class="data-sheet-metric" id="averageLikes"></div>
                                            <div class="data-sheet-metric data-sheet-metric--background-light-blue"
                                                 id="averageComments"></div>
                                            <div class="data-sheet-metric" id="averageShares"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Paid Impressions')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of times people saw activity related to your Page via a paid Facebook ad')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img src="{{{url('/assets/image_new/svg/colored/eye-dollar.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right" style="flex-basis: 70%">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title"> {{__('Impressions')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">{{number_format($page_impression_paid)}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Organic Impressions')}} </h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Users who have engaged with your page through organic News Feed entries')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img
                                                    src="{{{url('/assets/image/icon/dashnoard-impressions.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Impressions  ')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    {{number_format($page_impression_organic)}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-xs-12">
                                <div class="card big-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Page Engagement Over Time')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total count of an engaged user on the page daily over the set period')}}</p>
                                        <div id="engagementChart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Total Reach')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('People who saw any of the content related to your Facebook page')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img src="{{{url('/assets/image_new/svg/colored/radio-tower.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Reach')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    @if(isset($page_data))
                                                    {{number_format($page_data->page_impressions_paid)}}
                                                    @endif
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card small-card-height">
                                    <div class="card-body text-right">
                                        <h5 class="font-21-lh-25 card__title">{{__('Clicks On Page (CTA)')}}</h5>
                                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of time Page visitors towards the page objective, like visiting your website or call your store')}}</p>
                                        <div class="d-flex-dashbard-data" id="mybasis">
                                            <div class="dashboard-data-1 text-left">
                                                <img src="{{{url('/assets/image_new/svg/colored/press-button.svg')}}}">
                                            </div>
                                            <div class="dashboard-data-2 text-right">
                                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('CTA clicks (logged in)')}}</p>
                                                <h3 class="font-37-lh-44-bold mb-0 card__total-title-count">
                                                    0</h3>
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
                                        <h5 class="font-21-lh-25 card__title">{{__('Top Performing Cities')}}</h5>
                                        <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('The top-performing ad set based on total clicks')}}</p>
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
                                                @if(!empty($cta_data) && count($cta_data)>0)
                                                    @foreach($cta_data as $item)
                                                        <tr>
                                                            <th scope="row1">{{$item?->city}}</th>
                                                            <td class="font-13-lh-20-regular">{{number_format($item?->total_reach)}}</td>
                                                            <td class="font-13-lh-20-regular"> -</td>
                                                            <td class="font-13-lh-20-regular"> -</td>
                                                            <td class="font-13-lh-20-regular"> -</td>
                                                            <td class="font-13-lh-20-regular"> -</td>
                                                            <td class="font-13-lh-20-regular"> -</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <th scope="row"> -</th>
                                                        <td class="font-13-lh-20-regular"> -</td>
                                                        <td class="font-13-lh-20-regular"> -</td>
                                                        <td class="font-13-lh-20-regular"> -</td>
                                                        <td class="font-13-lh-20-regular"> -</td>
                                                        <td class="font-13-lh-20-regular"> -</td>
                                                        <td class="font-13-lh-20-regular"> -</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!empty($page->post) && $page->post->count() > 0)
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="card">
                                        <div class="card-body text-right">
                                            <h5 class="font-21-lh-25 card__title">{{__('Top Performing Posts')}}</h5>
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
                                                                    {{__('Post Impressions')}}
                                                                </p>
                                                                <div class="orange-line"></div>
                                                                <p class="post-card-data-value">
                                                                    {{number_format($post->impressions)}}
                                                                </p>
                                                            </li>
                                                            <li class="post-card-data">
                                                                <p class="post-card-data-name font-13-lh-16-medium mb-1">
                                                                    {{__('Post Clicks')}}
                                                                </p>
                                                                <div class="orange-line"></div>
                                                                <p class="post-card-data-value">
                                                                    {{number_format($post->clicks)}}
                                                                </p>
                                                            </li>
                                                            <li class="post-card-data">
                                                                <p class="post-card-data-name font-13-lh-16-medium mb-1">
                                                                    {{__('Post Engaged Users')}}
                                                                </p>
                                                                <div class="orange-line"></div>
                                                                <p class="post-card-data-value">
                                                                    {{number_format($post->engaged)}}
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
                </div>
            </div>
        </div>
    @endif
</div>
@include('frontend.components.topup')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
    var tooltip = document.querySelector('.tooltip1');
    let chart1 = document.querySelector('#funnelChart')
    let rect = chart1.getBoundingClientRect();
    chart1.addEventListener('mousemove', fn, false);

    function fn(e) {
        tooltip.style.left = e.clientX + 'px';
        tooltip.style.top = e.clientY - 50 + 'px';
    }

    let likeData = @if(!empty($like_per_day))@json($like_per_day)@endif;
    let unlikeData = @if(!empty($unlike_per_day))@json($unlike_per_day)@else 0 @endif;
    let likeDate = @if(!empty($likeDate))@json($likeDate)@endif;

    // Data

    let impressionsVsClicksData = {
        impressions: {{$page_impression}},
        reach: {{$unique_page_impression}},
        clicks: {{$page_clicks}},
    };

    let postImpressionsData = {
        paid: {{$unique_post_impression_paid}},
        organic: {{$unique_post_impression_organic}},
        viral: {{$unique_post_impression_viral}},
    };

    let pageImpressionsData = {
        paid: {{$unique_page_impression_paid}},
        organic: {{$unique_page_impression_organic}},
        viral: {{$unique_page_impression_viral}},
        nonViral: {{$unique_page_impression_noviral}},
    };

    let engagementData = {
        engagedUserCount:  @json($page_engagement_per_day),
        dates:  @json($page_engagement_per_day_date),
    };

    let distributionData = {
        postCount: @json($posts_created_per_day),
        engagedUsersCount: @json($posts_engaged_per_day),
        dates: @json($date_created_post_array),
    };

    let averagePostData = {
        likes: {{$posts_average_likes}},
        comments: {{$posts_average_comments}},
        shares: {{$posts_average_shares}},
    };

    console.table('averagePostData', averagePostData);
    console.table('distributionData', distributionData);
    console.table('engagementData', engagementData);
    console.table('pageImpressionsData', pageImpressionsData);
    console.table('postImpressionsData', postImpressionsData);
    console.table('impressionsVsClicksData', impressionsVsClicksData);

    // Total Page Likes Over Time
    let divWidth = document.querySelector("#likesChart").clientWidth;
    let offset = 0;
    if (likeDate.length > 30 || (likeDate.length > 15 && divWidth < 750)) {
        offset = 20;
    }
    console.log(likeDate,unlikeData, likeData)

    var likesOptions = {
        series: [{
            name: '{{__('Unique page likes')}}',
            data: likeData,
            // data: [1, 2, 3],
        }, {
            name: '{{__('Unique page unlikes')}}',
            data: unlikeData,
            // data: [ 1, 2, 3],
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
            categories: likeDate.map(date => {
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
        ) / 100;
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
    if (pageImpressionsNumber > 0) {
        graph.setAttribute('style', `background: linear-gradient(0deg, ${colorDarkBlue} ${clicksPercent}%, ${colorBlue} ${reachPercent}%, ${colorOrange} ${immersionPersent}% 100%)`);
    } else {
        graph.style.display = 'none';
        funnel.innerHTML += `<div style="width: 50%; min-width: 200px; max-width: 300px; height: 150px;"></div>    <p style='margin:0 auto; position: absolute; top: 50%; transform: translate(50%, -50%); right: 50%;' class="data-sheet-text">{{__('No data available')}}</p>`
    }
    // Unique Post Impressions By Type

    const impressionsPaidElement = document.querySelector('#impressionsPaid');
    const impressionsOrganicElement = document.querySelector('#impressionsOrganic');
    const impressionsViralElement = document.querySelector('#impressionsViral');

    const totalImpressionsCount = Object.values(postImpressionsData).reduce(
        (sum, current) => {
            return sum + current;
        }, 0);

    function findImpressionsPercent(specifiedImpressions) {
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
    <div class="data-sheet-bubble" style="background-color: #16CE89"></div>
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
        colors: ['#FF9A41', '#356792', '#16CE89'],
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

    function findPageImpressionsPercent(specifiedImpressions) {
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
    <div class="data-sheet-bubble" style="background-color: #F9C292"></div>
    <p class="data-sheet-text">${'{{__('Organic & unique Impressions')}}'}</p>
  </div>
  <p class="data-sheet-data">${pageImpressionsData.organic} (${findPageImpressionsPercent(pageImpressionsData.organic)}%)</p>
  `;

    pageImpressionsViralElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: #356792"></div>
    <p class="data-sheet-text">${'{{__('Viral & unique Impressions')}}'}</p>
  </div>
  <p class="data-sheet-data">${pageImpressionsData.viral} (${findPageImpressionsPercent(pageImpressionsData.viral)}%)</p>
  `;

    pageImpressionsNonViralElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: #16CE89"></div>
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
        colors: ['#FF9A41', '#F9C292', '#356792', '#16CE89'],
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

    function findAveragePostPercent(specifiedImpressions) {
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
    <div class="data-sheet-bubble" style="background-color: #F9C292"></div>
    <p class="data-sheet-text">${'{{__('Comments')}}'}</p>
  </div>
  <p class="data-sheet-data">${averagePostData.comments} (${findAveragePostPercent(averagePostData.comments)}%)</p>
  `;

    averageSharesElement.innerHTML = `
  <div class="data-sheet-info">
    <div class="data-sheet-bubble" style="background-color: #16CE89"></div>
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
        colors: ['#FF9A41', '#F9C292', '#16CE89'],
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

    const postAverageChart = new ApexCharts(document.querySelector("#postAverageChart"), postAverageChartOpt);
    postAverageChart.render();


    // Page engagement over Time

    let engagementColWidth = '85%';

    if (engagementData.engagedUserCount.length < 17) {
        engagementColWidth = (engagementData.engagedUserCount.length * 5) + '%';
    }
    ;
    let engDivWidth = document.querySelector("#engagementChart").clientWidth;
    offset = 0;
    if (engagementData.dates.length > 30 || (engagementData.dates.length > 15 && engDivWidth < 750)) {
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

    // Post Distribution

    let distributionColWidth = '85%';

    if (distributionData.engagedUsersCount.length < 17) {
        distributionColWidth = (distributionData.engagedUsersCount.length * 5) + '%';
    }
    ;

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
        bar: {},
        labels: distributionData.dates.map(date => {
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
