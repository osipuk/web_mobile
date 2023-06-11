@extends('layout.userhead-pdf')
@section('title', 'User Home')
@section('metahead')
    <meta http-equiv="Content-Type" content="text/html" charset=utf-8"/>
@endsection

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

<div class="page-wrapper chiller-theme toggled">
    @section('content')
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

            .multilevel, .multilevel-2 {
                position: relative;
            }

            .multilevel-item, .multilevel-item-2 {
                display: none;
                position: absolute;
                left: 100%;
            }

            .multilevel-item {
                transform: translateY(45%);
            }

            .multilevel-item-2 {
                transform: translateY(45%);
            }

            .multilevel:hover .multilevel-item {
                display: block !important;
            }

            .multilevel-2:hover .multilevel-item-2 {
                display: block !important;
            }

            .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
                position: relative;
                width: 100%;
                padding-right: 10px !important;
                padding-left: 10px !important;
            }

            .card {
                border-radius: 5px !important;
                margin-bottom: 10px;
                box-shadow: 0px 3px 10px #00000029;
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
            html, body, main, .dashboard-main, .page-wrapper {
                width:100%;
                height:100%;
                margin:auto;
                padding:0;
                overflow-y: visible!important;
                overflow-x: visible!important;
            }
            @media print {
                .pdf{ overflow-y: visible !important; }
                a, a:hover{
                    text-decoration: none!important;
                }
            }
            a, a:hover{
                text-decoration: none;
            }

        </style>
        <main class="dashboard-main">
            <div class="col-12 pdf" id="pdf">
                <div style="">
                    <div style="text-align: right; margin-top: 25vh; margin-bottom: 50vh;">
                        <div
                            style="width: 300px; height: 55px; background-image: url({{url('/assets/image_new/svg/colored/icons/AfdalAnalyticsLogoLight.svg')}}); background-size: cover;"
                            src="{{{url('/assets/image_new/svg/colored/icons/AfdalAnalyticsLogoLight.svg')}}}"></div>
                        <div style="margin-bottom:250px">
                            <h1 class="font-45-lh-54-medium" style="font-size: 60px;">{{__('Page statistics')}}</h1>
                            @if($template_name == 'twitter-overview')
                                <h2 class="font-45-lh-54-medium" style="font-size: 50px;">{{__('Twitter Overview')}}</h2>
                            @elseif($template_name == 'facebook-overview')
                                <h2 class="font-45-lh-54-medium" style="font-size: 50px;">{{__('Facebook overview')}}</h2>
                            @elseif($template_name == 'facebook-engagement')
                                <h2 class="font-45-lh-54-medium" style="font-size: 50px;">{{__('Facebook Engagement')}}</h2>
                            @elseif($template_name == 'facebook-ads-overview')
                                <h2 class="font-45-lh-54-medium" style="font-size: 50px;">{{__('Facebook Ads')}}</h2>
                            @elseif($template_name == 'instagram-overview')
                                <h2 class="font-45-lh-54-medium" style="font-size: 50px;">{{__('Instagram Overview')}}</h2>
                            @elseif($template_name == 'google-ads-overview')
                                <h2 class="font-45-lh-54-medium" style="font-size: 50px;">{{__('Google Ads')}}</h2>
                            @elseif($template_name == 'google-analytics-overview')
                                <h2 class="font-45-lh-54-medium" style="font-size: 50px;">{{__('Google Analytics Overview')}}</h2>
                            @else
                            @endif
                            <h3 class="font-45-lh-54-medium" class="mt-4">{{__('Comparison between')}} @if(!empty($date_from)) {{$date_from}} @endif {{__('-')}} @if(!empty($date_to)) {{$date_to}} @endif</h3>
                        </div>

                        <ul class="mt-5" style="list-style: none; margin-top: 250px;">
                            <li style="margin:5px; font-size: 20px;">
                                <a href="https://www.instagram.com/afdalanalytics/">
                                    <img width="25px" style="margin-left:10px"src="{{{url('/assets/image_new/svg/colored/instaShare.svg')}}}">
                                    <strong>AfdalAnalytics</strong>
                                </a>
                            </li>
                            <li style="margin:5px; font-size: 20px;">
                                <a href="https://www.facebook.com/Afdal.Analytics">
                                    <img width="25px" style="margin-left:10px" src="{{{url('/assets/image_new/svg/colored/facebookShare.svg')}}}">
                                    <strong>AfdalAnalytics</strong>
                                </a>
                            </li>
                            <li style="margin:5px; font-size: 20px;">
                                <a href="https://www.linkedin.com/company/afdalanalytics">
                                    <img width="25px" style="margin-left:10px" src="{{{url('/assets/image_new/svg/colored/linkedinShare.svg')}}}">
                                    <strong>AfdalAnalytics</strong>
                                </a>
                            </li>
                            <li style="margin:5px; font-size: 20px;">
                                <a href="https://twitter.com/afdalanalytics">
                                    <img width="25px" style="margin-left:10px" src="{{{url('/assets/image_new/svg/colored/twiterShare.svg')}}}">
                                    <strong>AfdalAnalytics</strong>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @php
                        $template_name = !empty($template_name) ? $template_name : null;
                    @endphp
                    @if($template_name == 'twitter-overview')
                        @include('tenant.components.twitter-overview-pdf')
                    @elseif($template_name == 'facebook-overview')
                        @include('tenant.components.facebook-overview-pdf')
                    @elseif($template_name == 'facebook-engagement')
                        @include('tenant.components.facebook-engagement-pdf')
                    @elseif($template_name == 'facebook-ads-overview')
                        @include('tenant.components.facebook-ads-pdf')
                    @elseif($template_name == 'instagram-overview')
                        @include('tenant.components.instagram-pdf')
                    @elseif($template_name == 'google-ads-overview')
                        @include('tenant.components.google-ads-pdf')
                    @elseif($template_name == 'google-analytics-overview')
                        @include('tenant.components.google-analytics-overview-pdf')
                    @else
                        @include('tenant.components.empty-dashboard')
                    @endif
                </div>
            </div>
        </main>
</div>

{{--<div class='loader-wrap'>--}}
{{--    <div id="main-loader" class="pdf-preloader">--}}
{{--      <div class="loading"></div>--}}
{{--      <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>--}}
{{--    </div>--}}
{{--</div>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-alpha2/html2canvas.js"
        crossorigin="anonymous"></script>
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.min.js" crossorigin="anonymous"></script>
{{--<script>--}}
{{--    document.body.onload = function () {--}}
{{--        setTimeout(function () {--}}
{{--            const preloader = document.getElementById('main-loader');--}}
{{--            if (!preloader.classList.contains('done')) {--}}
{{--                preloader.classList.add('done');--}}
{{--            }--}}
{{--        }, 2000);--}}
{{--    };--}}
{{--    async function genPdf(){--}}
{{--        var element = document.getElementById('pdf');--}}
{{--        var opt = {--}}
{{--            margin:       1,--}}
{{--            filename:     'myfile.pdf',--}}
{{--            html2canvas:  { scale: 2 },--}}
{{--            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }--}}
{{--        };--}}

{{--        await html2pdf().from(element).set(opt).save();--}}
{{--        window.location.assign('/dashboard');--}}
{{--    }--}}
{{--    genPdf()--}}
{{--</script>--}}
<script>
    // Elements

    const instagramOverviewItem = document.querySelector('#instagram-overview-item');
    const facebookAdsItem = document.querySelector('#facebook-ads-item');
    const facebookEngagementItem = document.querySelector('#facebook-engagement-item');
    const facebookOverviewItem = document.querySelector('#facebook-overview-item');
    const twitterOverviewItem = document.querySelector('#twitter-overview-item');
    const settingsPopUp = document.querySelector('.dashboard-settings-pop-up');
    const settingsButton = document.querySelector('.dashboard-settings-button');
    const showAllDashboardsButton = document.querySelector('.dashboard-mobile-menu-button');
    const dashboardTemplatesList = document.querySelector('.dashboard-templates-list');


    const currentPath = location.pathname;

    // Event listeners
    if (settingsButton) {
        settingsButton.addEventListener('click', settingsButtonHandler);
    }
    ;
    showAllDashboardsButton.addEventListener('click', showAllDashboardsClickHandler);

    // Click handlers

    function settingsButtonHandler() {
        if (settingsPopUp.classList.contains('hidden')) {
            settingsPopUp.classList.remove('hidden');
            setTimeout(() => {
                body.addEventListener('click', hideSettingsPopUp);
            }, 0);

            return;
        }
    }

    function hideSettingsPopUp(event) {
        if (event.target.closest('.dashboard-setting-pop-up')) {
            return;
        }

        body.removeEventListener('click', hideSettingsPopUp);

        settingsPopUp.classList.add('hidden');
    }

    function showAllDashboardsClickHandler() {
        if (dashboardTemplatesList.classList.contains('hidden')) {
            setTimeout(() => {
                body.addEventListener('click', hideAllDashboardsList);
            }, 0);
        }

        dashboardTemplatesList.classList.toggle('hidden');
    }

    function hideAllDashboardsList(event) {
        if (event.target.closest('.dahboard-templates-list')) {
            return;
        }

        body.removeEventListener('click', hideAllDashboardsList);

        dashboardTemplatesList.classList.add('hidden');
    }

    // On page load

    switch (currentPath) {
        case "/dashboard/facebook-overview":
            facebookOverviewItem.classList.add('active');
            break;

        case "/dashboard/facebook-ads-overview":
            facebookAdsItem.classList.add('active');
            break;

        case "/dashboard/facebook-engagement":
            facebookEngagementItem.classList.add('active');
            break;

        case "/dashboard/instagram-overview":
            instagramOverviewItem.classList.add('active');
            break;

        case "/dashboard/twitter-overview":
            twitterOverviewItem.classList.add('active');
            break;

        default:
            break;
    }

</script>
@endsection
