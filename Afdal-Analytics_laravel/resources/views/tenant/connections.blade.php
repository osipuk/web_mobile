@section('metahead')

    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
@endsection
@extends('layout.userhead')
<style>
    .card {
        border-radius: 6px !important;
        position: relative;
    }

    .image-checkbox label {
        position: inherit !important;
    }

    .image-checkbox label:before {
        left: 25px !important;
        top: 10px !important;
    }

    .modal-title {
        text-align: center;
        width: 100%;
    }

    .input-group > .custom-select:not(:first-child), .input-group > .form-control:not(:first-child) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
    }

    #f20 {
        font-size: 20px;
    }

    .text-war {
        color: #B5BDC9;
        font-size: 14px;
    }

    span.input-group-addon {
        background: #f48a1d;
        color: #ffffff;
        padding: 11px 14px;
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
        cursor: pointer;
    }

    .btn-circle {
        width: 25px !important;
        height: 25px !important;
        line-height: 26px !important;
    }

    span.dotC {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #F58B1E;
    }

    .font-weight-bold {
        font-weight: 700 !important;
        color: #0B243A;
        font-size: 17px;
        margin-bottom: 20px !important;
    }

    .form-check-input:checked {
        background-color: #f48a1d;
        border: 1px solid #f48a1d;
    }

    .form-check-input {
        position: absolute;
        margin-top: 0rem;
        margin-right: -20px;
        margin-left: -1.25rem;
        width: 1.3em;
        height: 1.3em;
        background-color: white;
        border-radius: 50%;
        vertical-align: middle;
        border: 1px solid #ddd;
        appearance: none;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;
    }

    .connect-popover {
        display: block;
        background-color: white;
        box-shadow: 0px 20px 40px #2426721c;
        border-radius: 20px;
        color: black;
        padding: 15px;
        direction: rtl;
    }

    .connect-popover-wrap {
        display: none;
        position: absolute;
        top: -81px;
        left: -4px;
        right: -62px;
        padding-bottom: 15px;
    }

    .connect-btn-container {
        position: relative;
        border-radius: 10px;
        margin-top: 10px;
        margin-right: 35px;
    }

    /*.connect-btn-container.connect-btn-disable:hover .connect-popover-wrap{*/
    /*        display: block;*/
    /*}*/
    .add-new-block.disable-connections:hover .connect-popover-wrap {
        display: block;
    }

    .disabled {
        opacity: 0.5;
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 1020px !important;
            width: 100% !important;
            padding: 0 15px;
        }

        /*
                #facebook2 .modal-dialog {
                    max-width: 800px !important;
                } */
    }
</style>
@section('title', 'User Home')
<div class="page-wrapper chiller-theme toggled">
    @section('content')
        @include('layout.usersidenav')
        <main class="page-content pb-5">
            <div class="container-fluid">
                <div class="dashboard-static-header">
                    <div class="dashboard-content-wrapper">
                        <div class="container-fluid d-flex" style="justify-content: space-between;">
                            <h1 class="nav-item font-54-lh-50-medium mb-4 page-title">
                                {{__('Connections')}}
                            </h1>
                            <div class="user-block-wrapper">
                                @include('tenant.components.user-block')
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="dashboard-tabs">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link font-22-lh-46-medium active" data-toggle="tab"
                                               href="#my-connection">{{__('My Connections')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link font-22-lh-46-medium" data-toggle="tab"
                                               href="#ads-temp">{{__('Ads')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link font-22-lh-46-medium" data-toggle="tab"
                                               href="#all-temp">{{__('All')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link font-22-lh-46-medium" data-toggle="tab"
                                               href="#social-temp">{{__('Social Media')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link font-22-lh-46-medium" data-toggle="tab"
                                               href="#coming-temp">{{__('Coming Soon')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @include('tenant.components.trial-banner')
                    </div>
                </div>
                <div class="dashboard-content-wrapper row">
                    <div class="col-12">
                        <div class="tab-content">
                            <div class="tab-pane  active" id="my-connection">
                                <div class="home-social-media-detail mt-4">
                                    <div class="row">
                                        @if(Auth::user() && !Auth::user()->company->social_account_facebook->isNotEmpty()
                                            && !Auth::user()->company->social_account_facebook_ads->isNotEmpty()
                                            && !Auth::user()->company->social_account_twitter->isNotEmpty()
                                            && !Auth::user()->company->social_account_instagram->isNotEmpty()
                                            && !Auth::user()->company->social_account_google_ads->isNotEmpty()
                                            && !Auth::user()->company->social_account_google_analytics->isNotEmpty())
                                            {{--  && !Auth::user()->company->social_account_google_analytics_ua->isNotEmpty()--}}
                                            <p class="font-30-lh-63-semi-bold no-my-connections">
                                                {{__('Soon here will be a list of all connections')}}
                                            </p>
                                        @endif


                                        <div class="single-connection-block connection-list my-fb-connection"
                                             @if(Auth::user() && Auth::user()->company->social_account_facebook->isEmpty())
                                             style="display: none;"
                                            @endif>
                                            <a href="#" data-toggle="modal" data-target="#facebook-page"
                                               onclick="setModal('facebook', '#facebook-page' ,'#facebook-page-accounts-list')">
                                                <div class="connection" id="facebook">
                                                    <div class="image-checkbox">
                                                        <!-- checked -->
                                                        <input type="checkbox" id="myCheckbox1"/>
                                                        <label for="myCheckbox1" class="m-0">
                                                            <div
                                                                class="icon-details checked text-center font-18-lh-18-regular rounded pt-3 pb-3 p-1 mb-3 font-weight-bold">
                                                                <img class="connection-block-icon" src="{{url('/assets/image/facebook.svg')}}">
                                                                <br>
                                                                <div class="checked-icon"></div>
                                                                {{__('Facebook Page')}}
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>


                                        <div class="single-connection-block connection-list my-fb-ads-connection"
                                             @if(Auth::user() && Auth::user()->company->social_account_facebook_ads->isEmpty())
                                             style="display: none;"
                                            @endif>
                                            <a href="#" data-toggle="modal" data-target="#facebook-ads-modal"
                                               onclick="setModal('facebookAds', '#facebook-ads-modal' ,'#facebook-ads-accounts-list')"
                                            >
                                                <div class="connection" id="facebook-ads">
                                                    <div class="image-checkbox">
                                                        <!-- checked -->
                                                        <input type="checkbox" id="myCheckbox1"/>
                                                        <label for="myCheckbox1" class="m-0">
                                                            <div
                                                                class="icon-details checked text-center font-18-lh-18-regular rounded pt-3 pb-3 p-1 mb-3 font-weight-bold">
                                                                <img class="connection-block-icon"
                                                                     src="{{url('/assets/image/facebook.svg')}}"
                                                                >
                                                                <br>
                                                                <div class="checked-icon"></div>
                                                                {{__('Facebook Ads')}}
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>


                                        <div class="single-connection-block connection-list my-instagram-connection"
                                             @if(Auth::user() && Auth::user()->company->social_account_instagram->isEmpty())
                                             style="display: none;"
                                            @endif>
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                               onclick="setModal('instagram', '#instagram-modal' ,'#instagram-modal-accounts-list')"
                                               aria-label="Close" data-target="#instagram-modal">
                                                <div class="connection" id="instagram">
                                                    <div class="image-checkbox">
                                                        <!-- checked -->
                                                        <input type="checkbox" id="myCheckbox1"/>
                                                        <label for="myCheckbox1" class="m-0">
                                                            <div
                                                                class="icon-details checked text-center font-18-lh-18-regular rounded pt-3 pb-3 p-1 mb-3 font-weight-bold">
                                                                <img class="connection-block-icon"
                                                                     src="{{url('assets/image/insta.svg')}}"
                                                                >
                                                                <br>
                                                                <div class="checked-icon"></div>
                                                                {{__('Instagram')}}
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>


                                        <div class="single-connection-block connection-list my-twitter-connection"
                                             @if(Auth::user() && Auth::user()->company->social_account_twitter->isEmpty())
                                             style="display: none;"
                                            @endif>
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                               aria-label="Close" data-target="#twitter-modal"
                                               onclick="setModal('twitter', '#twitter-modal' ,'#twitter-modal-accounts-list')">
                                                <div class="connection" id="twitter">
                                                    <div class="image-checkbox">
                                                        <!-- checked -->
                                                        <input type="checkbox" id="myCheckbox1"/>
                                                        <label for="myCheckbox1" class="m-0">
                                                            <div
                                                                class="icon-details checked text-center font-18-lh-18-regular rounded pt-3 pb-3 p-1 mb-3 font-weight-bold">
                                                                <img class="connection-block-icon"
                                                                     src="{{url('/assets/image/twitter.svg')}}"
                                                                >
                                                                <br>
                                                                <div class="checked-icon"></div>
                                                                {{__('Twitter')}}
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>


                                        <div class="single-connection-block connection-list my-ga-connection"
                                             @if(Auth::user() && Auth::user()->company->social_account_google_analytics->isEmpty())
                                             style="display: none;"
                                            @endif>
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                               aria-label="Close" data-target="#google-analytics-modal"
                                               onclick="setModal('googleAnalytics', '#google-analytics-modal' ,'#google-analytics-accounts-list')">
                                                <div class="connection" id="google-analytics">
                                                    <div class="image-checkbox">
                                                        <!-- checked -->
                                                        <input type="checkbox" id="myCheckbox1"/>
                                                        <label for="myCheckbox1" class="m-0">
                                                            <div
                                                                class="icon-details text-center font-18-lh-18-regular rounded p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                                <img class="connection-block-icon"
                                                                     src="{{{url('assets/image/google-analitic.svg')}}}">
                                                                <br>
                                                                <div class="checked-icon"></div>
                                                                {{__('Google Analytics')}}
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="single-connection-block connection-list my-gad-connection"
                                            @if(Auth::user() && Auth::user()->company->social_account_google_ads->isEmpty())
                                            style="display: none;"
                                            @endif>
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                            aria-label="Close" data-target="#google-ads-modal"
                                            onclick="setModal('googleAds', '#google-ads-modal' ,'#google-ads-modal-accounts-list')">
                                                <div class="connection" id="google-adss">
                                                    <div class="image-checkbox">
                                                        <!-- checked -->
                                                        <input type="checkbox" id="myCheckbox1"/>
                                                        <label for="myCheckbox1" class="m-0">
                                                            <div
                                                                class="icon-details checked text-center font-18-lh-18-regular rounded pt-3 pb-3 p-1 mb-3 font-weight-bold">
                                                                <img class="connection-block-icon"
                                                                    src="{{url('assets/image/googlea.svg')}}"
                                                                >
                                                                <br>
                                                                <div class="checked-icon"></div>
                                                                {{__('Google Ads')}}
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ads-temp">
                                <div class="home-social-media-detail mt-4">
                                    <div class="row">

                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-target="#facebook-ads-modal"
                                            onclick="setModal('facebookAds', '#facebook-ads-modal' ,'#facebook-ads-accounts-list')"
                                            >
                                                <div
                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                    <img class="connection-block-icon"
                                                        src="{{{url('/assets/image/facebook.svg')}}}"><br>{{__('Facebook Ads')}}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                            aria-label="Close" data-target="#google-ads-modal"
                                            onclick="setModal('googleAds', '#google-ads-modal' ,'#google-ads-modal-accounts-list')">
                                                <div
                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                    <img class="connection-block-icon"
                                                        src="{{{url('assets/image/googlea.svg')}}}"><br>{{__('Google Ads')}}
                                                </div>
                                            </a>
                                        </div>
                                        {{--                                        <div class="single-connection-block">--}}
                                        {{--                                            <a href="#" data-toggle="modal" data-target="#linkedin2">--}}
                                        {{--                                                <div--}}
                                        {{--                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">--}}
                                        {{--                                                    <img class="connection-block-icon"--}}
                                        {{--                                                         src="{{{url('/assets/image/linkedin.svg')}}}"><br>{{__('LinkedIn Ads')}}--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </a>--}}
                                        {{--                                        </div>--}}

                                        {{--                                        <div class="single-connection-block">--}}
                                        {{--                                            <a href="#" data-toggle="modal" data-target="#twitter2">--}}
                                        {{--                                                <div--}}
                                        {{--                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">--}}
                                        {{--                                                    <img class="connection-block-icon"--}}
                                        {{--                                                         src="{{{url('/assets/image/twitter.svg')}}}"><br>{{__('Twitter Ads')}}--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </a>--}}
                                        {{--                                        </div>--}}

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="all-temp">
                                <div class="home-social-media-detail mt-4">
                                    <div class="row">
                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-target="#facebook-page"
                                            onclick="setModal('facebook', '#facebook-page' ,'#facebook-page-accounts-list')">
                                                <div class="image-checkbox">
                                                    <!-- checked -->
                                                    <input type="checkbox" id="myCheckbox1"/>
                                                    <label for="myCheckbox1" class="m-0">
                                                        <div class="icon-details checked text-center font-18-lh-18-regular rounded pt-3 pb-3 p-1 mb-3 font-weight-bold">
                                                            <img class="connection-block-icon"
                                                                src="{{url('/assets/image/facebook.svg')}}">
                                                            <br>
                                                            {{__('Facebook Page')}}
                                                        </div>
                                                    </label>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-target="#facebook-ads-modal"
                                            onclick="setModal('facebookAds', '#facebook-ads-modal' ,'#facebook-ads-accounts-list')">
                                                <div
                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                    <img class="connection-block-icon"
                                                        src="{{{url('/assets/image/facebook.svg')}}}"><br>{{__('Facebook Ads')}}
                                                </div>
                                            </a>
                                        </div>
                                        {{--                                        <div class="single-connection-block">--}}
                                        {{--                                            <a href="#" data-toggle="modal" data-dismiss="modal"--}}
                                        {{--                                               aria-label="Close" data-target="#twitter1">--}}
                                        {{--                                                <div--}}
                                        {{--                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">--}}
                                        {{--                                                    <img class="connection-block-icon"--}}
                                        {{--                                                         src="{{{url('/assets/image/twitter.svg')}}}"><br>{{__('Twitter Ads')}}--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </a>--}}
                                        {{--                                        </div>--}}
                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                            onclick="setModal('instagram', '#instagram-modal' ,'#instagram-modal-accounts-list')"
                                            aria-label="Close" data-target="#instagram-modal">
                                                <div
                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                    <img class="connection-block-icon"
                                                        src="{{{url('assets/image/insta.svg')}}}"><br>{{__('Instagram Insight')}}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                            aria-label="Close" data-target="#twitter-modal"
                                            onclick="setModal('twitter', '#twitter-modal' ,'#twitter-modal-accounts-list')">
                                                <div
                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                    <img class="connection-block-icon"
                                                        src="{{{url('/assets/image/twitter.svg')}}}"><br>{{__('Twitter')}}
                                                </div>
                                            </a>
                                        </div>

                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                            aria-label="Close" data-target="#google-analytics-modal"
                                            onclick="setModal('googleAnalytics', '#google-analytics-modal' ,'#google-analytics-accounts-list')">
                                                <div
                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                    <img class="connection-block-icon"
                                                        src="{{{url('assets/image/google-analitic.svg')}}}"><br>{{__('Google Analytics')}}
                                                </div>
                                            </a>
                                        </div>

                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                            aria-label="Close" data-target="#google-ads-modal"
                                            onclick="setModal('googleAds', '#google-ads-modal' ,'#google-ads-modal-accounts-list')">
                                                <div
                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                    <img class="connection-block-icon"
                                                        src="{{{url('assets/image/googlea.svg')}}}"><br>{{__('Google Ads')}}
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="social-temp">
                                <div class="home-social-media-detail mt-4">
                                    <div class="row">
                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                            aria-label="Close" data-target="#facebook-page"
                                            onclick="setModal('facebook', '#facebook-page' ,'#facebook-page-accounts-list')">
                                                <div class="image-checkbox facebook3-btn">
                                                    <!-- checked -->
                                                    <input type="checkbox" id="myCheckbox1"/>
                                                    <label for="myCheckbox1" class="m-0">
                                                        <div class="icon-details checked facebook3-btn text-center font-18-lh-18-regular rounded pt-3 pb-3 p-1 mb-3 font-weight-bold">
                                                            <img class="connection-block-icon"
                                                                src="{{url('/assets/image/facebook.svg')}}">
                                                            <br>
                                                            {{__('Facebook Page')}}
                                                        </div>
                                                    </label>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                            aria-label="Close" data-target="#twitter-modal"
                                            onclick="setModal('twitter', '#twitter-modal' ,'#twitter-modal-accounts-list')">
                                                <div
                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                    <img class="connection-block-icon"
                                                        src="{{{url('/assets/image/twitter.svg')}}}"><br>{{__('Twitter')}}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="single-connection-block">
                                            <a href="#" data-toggle="modal" data-dismiss="modal"
                                            onclick="setModal('instagram', '#instagram-modal' ,'#instagram-modal-accounts-list')"
                                            aria-label="Close" data-target="#instagram-modal">
                                                <div
                                                    class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                    <img class="connection-block-icon"
                                                        src="{{{url('assets/image/insta.svg')}}}"><br>{{__('Instagram Insight')}}
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade connections-coming-wrap" id="coming-temp">
                                <div class="home-social-media-detail mt-4">
                                    <div class="row">
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/linkedin.svg')}}}"><br>{{__('LinkedIn Page')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('/assets/image/apple.svg')}}}"><br>{{__('Apple App Store')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/googleplay.svg')}}}"><br>{{__('Google Play')}}
                                                <br>
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/woo.svg')}}}"><br>{{__('Woocommerce')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/google.svg')}}}"><br>{{__('Google Search')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/ama.svg')}}}"><br>{{__('Amazon Ads')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/tiktok.svg')}}}"><br>{{__('TikTok Ads')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/youtube.svg')}}}"><br>{{__('Youtube')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/google-my.svg')}}}"><br>{{__('Google My Business')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/shopify.svg')}}}"><br>{{__('Shopify')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/google-sheet.svg')}}}"><br>{{__('Google Sheets')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/pintrest.svg')}}}"><br>{{__('Pinterest Ads')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/snapchat.svg')}}}"><br>{{__('Snapchat')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/pintrest.svg')}}}"><br>{{__('Pinterest')}}
                                            </div>
                                        </div>
                                        <div class="single-connection-block">
                                            <div
                                                class="icon-details text-center font-18-lh-18-regular rounded bg-white p-1 pt-3 pb-3 mb-3 font-weight-bold">
                                                <img class="connection-block-icon"
                                                    src="{{{url('assets/image/bing.svg')}}}"><br>{{__('Bing Ads')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
</div>
</main>
</div>
<!-- Modal Facebook Page -->
<div class="modal fade tabindex-set9999" id="facebook-page" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            @include('frontend.components.modal.modal_header', ["text" => "Add New Connection"])
            <div class="modal-body add-connection-second">
                <div class="connection-block">
                    <p class="connection-block-header font-24-lh-29-medium">{{__('Connections')}}</p>
                    <div class="forms-wrapper">
                        <div class="connections-input-wrapper">
                            <button class="search-button"
                                    onclick="setModal('facebook', '#facebook-page' ,'#facebook-page-accounts-list')"></button>
                            <input type="text" class="search-input font-15-lh-32-regular"
                                   placeholder="{{__('Search')}}"/>
                        </div>
                        <div class="date-wrapper">
                            <label for="date" class="text font-14-lh-17-light">{{__('Date')}}</label>
                            <select id="date" class="date-select font-15-lh-20-semi-bold"
                                    onchange="setModal('facebook', '#facebook-page' ,'#facebook-page-accounts-list')">
                                <option value="week">{{__('Last week')}}</option>
                                <option value="month">{{__('Last month')}}</option>
                                <option value="6month">{{__('Last 6 month')}}</option>
                                <option value="year">{{__('Last year')}}</option>
                                <option value="all" selected>{{__('All time')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="accounts-block">
                        <form action="/connection/sync" method="post">
                            @csrf
                            <div class="title-wrapper">
                                <h6 class="font-17-lh-20-medium">{{__('Name')}}</h6>
                                <h6 class="font-17-lh-20-medium">{{__('Accounts')}}</h6>
                            </div>
                            <div id="facebook-page-accounts-list" style="max-height: 250px; overflow: scroll;">

                            </div>
                            <div class="add-new-wrap">
                                <div
                                    class="fb-add-new add-new-block {{$enable_connections ?  '' : 'disable-connections'}}"
                                    onclick="fb_login()">
                                    <p class="add-new-text font-13-lh-20-medium {{$enable_connections ?  '' : 'disabled'}}">{{__('Add new')}}</p>
                                    <div class="add-new-icon {{$enable_connections ?  '' : 'disabled'}}"></div>
                                    <span class="connect-popover-wrap">
                                        <span class="connect-popover">{{__("You used all connections")}}. {{__("Upgrade your plan")}}
                                            <a style="color: #FF9A41" href="{{url('/pricing')}}">{{__("now")}}</a>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="connect-block">
                                <input type="hidden" name="account" value="facebook">
                                <input type="submit" class="connect-button font-18-lh-22-regular"
                                       value="{{__('Connect')}}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="left-side-wrapper">
                    <div class="connection-info-block">
                        <img src="{{{url('/assets/image/facebook.svg')}}}">
                        <h6 class="font-18-lh-22-medium title">{{__('Facebook Page')}}</h6>
                        <p class="font-14-lh-17-light text">{{__('Integrate your Facebook Page account to view campaigns, ad sets, page Facebook Page and demographics.')}}</p>
                    </div>
                    <div class="modal-add-connection-help-block">
                        <div class="text-right h-100 p-3">
                            <p class="m-3 font-weight-bold font-17-lh-20-regular"><b>{{__('Need Help?')}}</b></p>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="play-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('Watch Video')}}</b></p>
                            </a>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="search-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('View Demo')}}</b></p>
                            </a>
                            <a href="https://intercom.help/afdal-analytics/ar/articles/6010727-%D8%A5%D8%B6%D8%A7%D9%81%D8%A9-%D9%85%D8%B5%D8%A7%D8%AF%D8%B1-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-%D9%88%D9%84%D9%88%D8%AD%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%B9%D9%84%D9%88%D9%85%D8%A7%D8%AA"
                               class="help-text-link">
                                <div class="help-orange-icon"></div>
                                <p class="text-war font-14-lh-17-regular">
                                    <b>{{__('Read Help Article')}}</b>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Facebook Ads -->
<div class="modal fade tabindex-set9999" id="facebook-ads-modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            @include('frontend.components.modal.modal_header', ["text" => "Add New Connection"])
            <div class="modal-body add-connection-second">
                <div class="connection-block">
                    <p class="connection-block-header font-24-lh-29-medium">{{__('Connections')}}</p>
                    <div class="forms-wrapper">
                        <div class="connections-input-wrapper">
                            <button class="search-button"
                                    onclick="setModal('facebookAds', '#facebook-ads-modal' ,'#facebook-ads-accounts-list')"></button>
                            <input type="text" class="search-input font-15-lh-32-regular"
                                   placeholder="{{__('Search')}}"/>
                        </div>
                        <div class="date-wrapper">
                            <label for="date" class="text font-14-lh-17-light">{{__('Date')}}</label>
                            <select id="date" class="date-select font-15-lh-20-semi-bold"
                                    onchange="setModal('facebookAds', '#facebook-ads-modal' ,'#facebook-ads-accounts-list')">
                                <option value="week">{{__('Last week')}}</option>
                                <option value="month">{{__('Last month')}}</option>
                                <option value="6month">{{__('Last 6 month')}}</option>
                                <option value="year">{{__('Last year')}}</option>
                                <option value="all" selected>{{__('All time')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="accounts-block">
                        <form action="/connection/sync" method="post">
                            @csrf
                            <div class="title-wrapper">
                                <h6 class="font-17-lh-20-medium">{{__('Name')}}</h6>
                                <h6 class="font-17-lh-20-medium">{{__('Accounts')}}</h6>
                            </div>
                            <div id="facebook-ads-accounts-list" style="max-height: 250px; overflow: scroll;">

                            </div>
                            <div class="add-new-wrap">
                                <div
                                    class="fb-add-new add-new-block {{$enable_connections ?  '' : 'disable-connections'}}"
                                    onclick="facebook_ads_login()">
                                    <p class="add-new-text font-13-lh-20-medium {{$enable_connections ?  '' : 'disabled'}}">{{__('Add new')}}</p>
                                    <div class="add-new-icon {{$enable_connections ?  '' : 'disabled'}}"></div>
                                    <span class="connect-popover-wrap"><span class="connect-popover">{{__("You used all connections")}}. {{__("Upgrade your plan")}} <a
                                                style="color: #FF9A41"
                                                href="{{url('/pricing')}}">{{__("now")}}</a></span></span>
                                </div>
                            </div>
                            <div class="connect-block">
                                <input type="hidden" name="account" value="facebookAds">
                                <input type="submit" class="connect-button font-18-lh-22-regular"
                                       value="{{__('Connect')}}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="left-side-wrapper">
                    <div class="connection-info-block">
                        <img src="{{{url('/assets/image/facebook.svg')}}}">
                        <h6 class="font-18-lh-22-medium title">{{__('Facebook Ads')}}</h6>
                        <p class="font-14-lh-17-light text">{{__('Integrate your Facebook Ads account to view campaigns, ad sets, page Facebook Ads and demographics.')}}</p>
                    </div>
                    <div class="modal-add-connection-help-block">
                        <div class="text-right h-100 p-3">
                            <p class="m-3 font-weight-bold font-17-lh-20-regular"><b>{{__('Need Help?')}}</b></p>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="play-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('Watch Video')}}</b></p>
                            </a>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="search-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('View Demo')}}</b></p>
                            </a>
                            <a href="https://intercom.help/afdal-analytics/ar/articles/6010727-%D8%A5%D8%B6%D8%A7%D9%81%D8%A9-%D9%85%D8%B5%D8%A7%D8%AF%D8%B1-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-%D9%88%D9%84%D9%88%D8%AD%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%B9%D9%84%D9%88%D9%85%D8%A7%D8%AA"
                               class="help-text-link">
                                <div class="help-orange-icon"></div>
                                <p class="text-war font-14-lh-17-regular">
                                    <b>{{__('Read Help Article')}}</b>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Instagram-->
<div class="modal fade tabindex-set9999" id="instagram-modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            @include('frontend.components.modal.modal_header', ["text" => "Add New Connection"])
            <div class="modal-body add-connection-second">
                <div class="connection-block">
                    <p class="connection-block-header font-24-lh-29-medium">{{__('Connections')}}</p>
                    <div class="forms-wrapper">
                        <div class="connections-input-wrapper">
                            <button class="search-button"
                                    onclick="setModal('instagram', '#instagram-modal' ,'#instagram-modal-accounts-list')"></button>
                            <input type="text" class="search-input font-15-lh-32-regular"
                                   placeholder="{{__('Search')}}"/>
                        </div>
                        <div class="date-wrapper">
                            <label for="date" class="text font-14-lh-17-light">{{__('Date')}}</label>
                            <select id="date" class="date-select font-15-lh-20-semi-bold"
                                    onchange="setModal('instagram', '#instagram-modal' ,'#instagram-modal-accounts-list')">
                                <option value="week">{{__('Last week')}}</option>
                                <option value="month">{{__('Last month')}}</option>
                                <option value="6month">{{__('Last 6 month')}}</option>
                                <option value="year">{{__('Last year')}}</option>
                                <option value="all" selected>{{__('All time')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="accounts-block">
                        <form action="/connection/sync" method="post">
                            @csrf
                            <div class="title-wrapper">
                                <h6 class="font-17-lh-20-medium">{{__('Name')}}</h6>
                                <h6 class="font-17-lh-20-medium">{{__('Accounts')}}</h6>
                            </div>
                            <div id="instagram-modal-accounts-list" style="max-height: 250px; overflow: scroll;">

                            </div>
                            <div class="add-new-wrap">
                                <div
                                    class="fb-add-new add-new-block {{$enable_connections ?  '' : 'disable-connections'}}"
                                    onclick="instagram_login()">
                                    <p class="add-new-text font-13-lh-20-medium {{$enable_connections ?  '' : 'disabled'}}">{{__('Add new')}}</p>
                                    <div class="add-new-icon {{$enable_connections ?  '' : 'disabled'}}"></div>
                                    <span class="connect-popover-wrap"><span class="connect-popover">{{__("You used all connections")}}. {{__("Upgrade your plan")}} <a
                                                style="color: #FF9A41"
                                                href="{{url('/pricing')}}">{{__("now")}}</a></span></span>
                                </div>
                            </div>
                            <div class="connect-block">
                                <input type="hidden" name="account" value="instagram">
                                <input type="submit" class="connect-button font-18-lh-22-regular"
                                       value="{{__('Connect')}}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="left-side-wrapper">
                    <div class="connection-info-block">
                        <img src="{{{url('/assets/image/insta.svg')}}}">
                        <h6 class="font-18-lh-22-medium title">{{__('Instagram')}}</h6>
                        <p class="font-14-lh-17-light text">{{__('Integrate your Instagram account to view campaigns, ad sets, page Instagram and demographics.')}}</p>
                    </div>
                    <div class="modal-add-connection-help-block">
                        <div class="text-right h-100 p-3">
                            <p class="m-3 font-weight-bold font-17-lh-20-regular"><b>{{__('Need Help?')}}</b></p>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="play-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('Watch Video')}}</b></p>
                            </a>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="search-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('View Demo')}}</b></p>
                            </a>
                            <a href="https://intercom.help/afdal-analytics/ar/articles/6010727-%D8%A5%D8%B6%D8%A7%D9%81%D8%A9-%D9%85%D8%B5%D8%A7%D8%AF%D8%B1-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-%D9%88%D9%84%D9%88%D8%AD%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%B9%D9%84%D9%88%D9%85%D8%A7%D8%AA"
                               class="help-text-link">
                                <div class="help-orange-icon"></div>
                                <p class="text-war font-14-lh-17-regular">
                                    <b>{{__('Read Help Article')}}</b>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Google Analytics-->
<div class="modal fade tabindex-set9999" id="google-analytics-modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            @include('frontend.components.modal.modal_header', ["text" => "Add New Connection"])
            <div class="modal-body add-connection-second">
                <div class="connection-block">
                    {{--                    <p class="connection-block-header font-24-lh-29-medium">{{__('CONNECTIONS')}}</p>--}}
                    <div class="forms-wrapper">
                        <div class="connections-input-wrapper">
                            <button class="search-button" onclick=""></button>
                            <input type="text" class="search-input font-15-lh-32-regular search-input-placeholder"
                                   placeholder="{{__('Search')}}"/>
                        </div>
                        <div class="date-wrapper">
                            <label for="date" class="text font-14-lh-17-light">{{__('Date')}}</label>
                            <select id="date" class="date-select font-15-lh-20-semi-bold" onchange="">
                                <option value="week">{{__('Last week')}}</option>
                                <option value="month">{{__('Last month')}}</option>
                                <option value="6month">{{__('Last 6 month')}}</option>
                                <option value="year">{{__('Last year')}}</option>
                                <option value="all" selected>{{__('All time')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="accounts-block">
                        <form action="/connection/sync" method="post">
                            @csrf
                            <div class="title-wrapper">
                                <h6 class="font-17-lh-20-medium">{{__('Name')}}</h6>
                                <h6 class="font-17-lh-20-medium">{{__('Accounts')}}</h6>
                            </div>
                            <div id="google-analytics-accounts-list" style="max-height: 250px; overflow: scroll;">

                            </div>
                            <div class="add-new-wrap">
                                <div
                                    class="fb-add-new add-new-block {{$enable_connections ?  '' : 'disable-connections'}}"
                                    onclick="googleAnalyticsLogin()">
                                    <p class="add-new-text font-13-lh-20-medium {{$enable_connections ?  '' : 'disabled'}}">{{__('Add new')}}</p>
                                    <div class="add-new-icon {{$enable_connections ?  '' : 'disabled'}}"></div>
                                    <span class="connect-popover-wrap"><span class="connect-popover">{{__("You used all connections")}}. {{__("Upgrade your plan")}} <a
                                                style="color: #FF9A41"
                                                href="{{url('/pricing')}}">{{__("now")}}</a></span></span>
                                </div>
                            </div>
                            <div class="connect-block">
                                <input type="hidden" name="account" value="googleAnalytics">
                                <input type="submit" class="connect-button font-18-lh-22-regular"
                                       value="{{__('Connect')}}">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="left-side-wrapper">
                    <div class="connection-info-block">
                        <img src="{{{url('assets/image/google-analitic.svg')}}}" style="width: 50px; height: 50px;">
                        <h6 class="font-18-lh-22-medium title">{{__('Google Analytics')}}</h6>
                        <p class="font-14-lh-17-light text">{{__('Connect your Google Analytics account to view site performance, visitors, top pages and targets with all available data.')}}</p>
                    </div>
                    <div class="modal-add-connection-help-block">
                        <div class="text-right h-100 p-3">
                            <p class="m-3 font-weight-bold font-17-lh-20-regular"><b>{{__('Need Help?')}}</b></p>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="play-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('Watch Video')}}</b></p>
                            </a>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="search-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('View Demo')}}</b></p>
                            </a>
                            <a href="https://intercom.help/afdal-analytics/ar/articles/6010727-%D8%A5%D8%B6%D8%A7%D9%81%D8%A9-%D9%85%D8%B5%D8%A7%D8%AF%D8%B1-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-%D9%88%D9%84%D9%88%D8%AD%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%B9%D9%84%D9%88%D9%85%D8%A7%D8%AA"
                               class="help-text-link">
                                <div class="help-orange-icon"></div>
                                <p class="text-war font-14-lh-17-regular">
                                    <b>{{__('Read Help Article')}}</b>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Google Analytics-->
<div class="modal fade tabindex-set9999" id="google-analytics-ua-modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            @include('frontend.components.modal.modal_header', ["text" => "Add New Connection"])
            <div class="modal-body add-connection-second">
                <div class="connection-block">
                    <p class="connection-block-header font-24-lh-29-medium">{{__('CONNECTIONS')}}</p>
                    <div class="forms-wrapper">
                        <div class="connections-input-wrapper">
                            <button class="search-button" onclick=""></button>
                            <input type="text" class="search-input font-15-lh-32-regular search-input-placeholder"
                                   placeholder="{{__('Search')}}"/>
                        </div>
                        <div class="date-wrapper">
                            <label for="date" class="text font-14-lh-17-light">{{__('Date')}}</label>
                            <select id="date" class="date-select font-15-lh-20-semi-bold" onchange="">
                                <option value="week">{{__('Last week')}}</option>
                                <option value="month">{{__('Last month')}}</option>
                                <option value="6month">{{__('Last 6 month')}}</option>
                                <option value="year">{{__('Last year')}}</option>
                                <option value="all" selected>{{__('All time')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="accounts-block">
                        <form action="/connection/sync" method="post">
                            @csrf
                            <div class="title-wrapper">
                                <h6 class="font-17-lh-20-medium">{{__('Name')}}</h6>
                                <h6 class="font-17-lh-20-medium">{{__('Accounts')}}</h6>
                            </div>
                            <div id="google-analytics-ua-accounts-list" style="max-height: 250px; overflow: scroll;">

                            </div>
                            <div class="add-new-wrap">
                                <div class="add-new-block {{$enable_connections ?  '' : 'disabled'}}"
                                     {{$enable_connections ?  '' : 'disable-connections'}} onclick="googleAnalyticsLogin()">
                                    <p class="add-new-text font-13-lh-20-medium">{{__('Add new')}}</p>
                                    <div class="add-new-icon"></div>
                                </div>
                            </div>
                            <span class="connect-popover-wrap"><span class="connect-popover">{{__("You used all connections")}}. {{__("Upgrade your plan")}} <a
                                        style="color: #FF9A41"
                                        href="{{url('/pricing')}}">{{__("now")}}</a></span></span>
                            <div class="connect-block">
                                <input type="hidden" name="account" value="google-analytics-ua">
                                <input type="submit" class="connect-button font-18-lh-22-regular"
                                       value="{{__('Connect')}}">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="left-side-wrapper">
                    <div class="connection-info-block">
                        <img src="{{{url('assets/image/google-analitic.svg')}}}" style="width: 50px; height: 50px;">
                        <h6 class="font-18-lh-22-medium title">{{__('Google Analytics')}}</h6>
                        <p class="font-14-lh-17-light text">{{__('Connect your Google Analytics account to view site performance, visitors, top pages and targets with all available data.')}}</p>
                    </div>
                    <div class="modal-add-connection-help-block">
                        <div class="text-right h-100 p-3">
                            <p class="m-3 font-weight-bold font-17-lh-20-regular"><b>{{__('Need Help?')}}</b></p>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="play-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('Watch Video')}}</b></p>
                            </a>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="search-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('View Demo')}}</b></p>
                            </a>
                            <a href="https://intercom.help/afdal-analytics/ar/articles/6010727-%D8%A5%D8%B6%D8%A7%D9%81%D8%A9-%D9%85%D8%B5%D8%A7%D8%AF%D8%B1-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-%D9%88%D9%84%D9%88%D8%AD%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%B9%D9%84%D9%88%D9%85%D8%A7%D8%AA"
                               class="help-text-link">
                                <div class="help-orange-icon"></div>
                                <p class="text-war font-14-lh-17-regular">
                                    <b>{{__('Read Help Article')}}</b>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Google Ads-->
<div class="modal fade tabindex-set9999" id="google-ads-modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            @include('frontend.components.modal.modal_header', ["text" => "Add New Connection"])
            <div class="modal-body add-connection-second">
                <div class="connection-block">
                    {{--                    <p class="connection-block-header font-24-lh-29-medium">{{__('CONNECTIONS')}}</p>--}}
                    <div class="forms-wrapper">
                        <div class="connections-input-wrapper">
                            <button class="search-button"
                                    onclick="setModal('googleAds', '#google-ads-modal' ,'#google-ads-modal-accounts-list')"></button>
                            <input type="text" class="search-input font-15-lh-32-regular search-input-placeholder"
                                   placeholder="{{__('Search')}}"/>
                        </div>
                        <div class="date-wrapper">
                            <label for="date" class="text font-14-lh-17-light">{{__('Date')}}</label>
                            <select id="date" class="date-select font-15-lh-20-semi-bold" onchange="">
                                <option value="week">{{__('Last week')}}</option>
                                <option value="month">{{__('Last month')}}</option>
                                <option value="6month">{{__('Last 6 month')}}</option>
                                <option value="year">{{__('Last year')}}</option>
                                <option value="all" selected>{{__('All time')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="accounts-block">
                        <form action="/connection/sync" method="post">
                            @csrf
                            <div class="title-wrapper">
                                <h6 class="font-17-lh-20-medium">{{__('Name')}}</h6>
                                <h6 class="font-17-lh-20-medium">{{__('Accounts')}}</h6>
                            </div>
                            <div id="google-ads-modal-accounts-list" style="max-height: 250px; overflow: scroll;">

                            </div>
                            <div class="add-new-wrap">
                                <div
                                    class="fb-add-new add-new-block {{$enable_connections ?  '' : 'disable-connections'}}"
                                    onclick="googleAdsLogin()">
                                    <p class="add-new-text font-13-lh-20-medium {{$enable_connections ?  '' : 'disabled'}}">{{__('Add new')}}</p>
                                    <div class="add-new-icon {{$enable_connections ?  '' : 'disabled'}}"></div>
                                    <span class="connect-popover-wrap"><span class="connect-popover">{{__("You used all connections")}}. {{__("Upgrade your plan")}} <a
                                                style="color: #FF9A41"
                                                href="{{url('/pricing')}}">{{__("now")}}</a></span></span>
                                </div>
                            </div>
                            <div class="connect-block">
                                <input type="hidden" name="account" value="google_ads">
                                <input type="submit" class="connect-button font-18-lh-22-regular"
                                       value="{{__('Connect')}}">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="left-side-wrapper">
                    <div class="connection-info-block">
                        <img src="{{{url('assets/image/googlea.svg')}}}" style="width: 50px; height: 50px;">
                        <h6 class="font-18-lh-22-medium title">{{__('Google Ads')}}</h6>
                        <p class="font-14-lh-17-light text">{{__('Connect your Google Ads account to view different ad campaigns, ad sets and campaigns data.')}}</p>
                    </div>
                    <div class="modal-add-connection-help-block">
                        <div class="text-right h-100 p-3">
                            <p class="m-3 font-weight-bold font-17-lh-20-regular"><b>{{__('Need Help?')}}</b></p>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="play-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('Watch Video')}}</b></p>
                            </a>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="search-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('View Demo')}}</b></p>
                            </a>
                            <a href="https://intercom.help/afdal-analytics/ar/articles/6010727-%D8%A5%D8%B6%D8%A7%D9%81%D8%A9-%D9%85%D8%B5%D8%A7%D8%AF%D8%B1-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-%D9%88%D9%84%D9%88%D8%AD%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%B9%D9%84%D9%88%D9%85%D8%A7%D8%AA"
                               class="help-text-link">
                                <div class="help-orange-icon"></div>
                                <p class="text-war font-14-lh-17-regular">
                                    <b>{{__('Read Help Article')}}</b>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Twitter-->
<div class="modal fade tabindex-set9999" id="twitter-modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            @include('frontend.components.modal.modal_header', ["text" => "Add New Connection"])
            <div class="modal-body add-connection-second">
                <div class="connection-block">
                    <p class="connection-block-header font-24-lh-29-medium">{{__('Connections')}}</p>
                    <div class="forms-wrapper">
                        <div class="connections-input-wrapper">
                            <button class="search-button"
                                    onclick="setModal('twitter', '#twitter-modal' ,'#twitter-modal-accounts-list')"></button>
                            <input type="text" class="search-input font-15-lh-32-regular search-input-placeholder"
                                   placeholder="{{__('Search')}}"/>
                        </div>
                        <div class="date-wrapper">
                            <label for="date" class="text font-14-lh-17-light">{{__('Date')}}</label>
                            <select id="date" class="date-select font-15-lh-20-semi-bold"
                                    onchange="setModal('twitter', '#twitter-modal' ,'#twitter-modal-accounts-list')">
                                <option value="week">{{__('Last week')}}</option>
                                <option value="month">{{__('Last month')}}</option>
                                <option value="6month">{{__('Last 6 month')}}</option>
                                <option value="year">{{__('Last year')}}</option>
                                <option value="all" selected>{{__('All time')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="accounts-block">
                        <form action="/connection/sync" method="post">
                            @csrf
                            <div class="title-wrapper">
                                <h6 class="font-17-lh-20-medium">{{__('Name')}}</h6>
                                <h6 class="font-17-lh-20-medium">{{__('Accounts')}}</h6>
                            </div>
                            <div id="twitter-modal-accounts-list" style="max-height: 250px; overflow: scroll;">

                            </div>
                            <div class="add-new-wrap">
                                <div
                                    class="fb-add-new add-new-block {{$enable_connections ?  '' : 'disable-connections'}}"
                                    onclick="twitter_login()">
                                    <p class="add-new-text font-13-lh-20-medium {{$enable_connections ?  '' : 'disabled'}}">{{__('Add new')}}</p>
                                    <div class="add-new-icon {{$enable_connections ?  '' : 'disabled'}}"></div>
                                    <span class="connect-popover-wrap"><span class="connect-popover">{{__("You used all connections")}}. {{__("Upgrade your plan")}} <a
                                                style="color: #FF9A41"
                                                href="{{url('/pricing')}}">{{__("now")}}</a></span></span>
                                </div>
                            </div>
                            <div class="connect-block">
                                <input type="hidden" name="account" value="twitter">
                                <input type="submit" class="connect-button font-18-lh-22-regular"
                                       value="{{__('Connect')}}">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="left-side-wrapper">
                    <div class="connection-info-block">
                        <img src="{{{url('/assets/image/twitter.svg')}}}">
                        <h6 class="font-18-lh-22-medium title">{{__('Twitter')}}</h6>
                        <p class="font-14-lh-17-light text">{{__('Integrate your Twitter account to view campaigns, ad sets, page Twitter and demographics.')}}</p>
                    </div>
                    <div class="modal-add-connection-help-block">
                        <div class="text-right h-100 p-3">
                            <p class="m-3 font-weight-bold font-17-lh-20-regular"><b>{{__('Need Help?')}}</b></p>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="play-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('Watch Video')}}</b></p>
                            </a>
                            <a href="https://www.youtube.com/channel/UCwM5Ouev9h4Ytsq222y1q6w" class="help-text-link">
                                <div class="search-icon"></div>
                                <p class="text-war font-14-lh-17-regular"><b>{{__('View Demo')}}</b></p>
                            </a>
                            <a href="https://intercom.help/afdal-analytics/ar/articles/6010727-%D8%A5%D8%B6%D8%A7%D9%81%D8%A9-%D9%85%D8%B5%D8%A7%D8%AF%D8%B1-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-%D9%88%D9%84%D9%88%D8%AD%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D8%B9%D9%84%D9%88%D9%85%D8%A7%D8%AA"
                               class="help-text-link">
                                <div class="help-orange-icon"></div>
                                <p class="text-war font-14-lh-17-regular">
                                    <b>{{__('Read Help Article')}}</b>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<div class="modal fade" id="connectionAdded" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content order-added-modal">
            @include('frontend.components.modal.modal_header', ["text" => "What's Next"])
            <div class="alert-block">
                <p class="alerts-block-text font-20-lh-24-semi-bold">!Your Facebook account was successfully
                    connected</p>
                <div class="alert-block-icon"></div>
            </div>
            <div class="options-block">
                <div class="options-title font-16-lh-19-light">Choose any one of the following options to proceed next
                </div>
                <div class="features-block">
                    <div class="feature-item">
                        <div class="feature-icon icon-connect"></div>
                        <p class="feature-title font-18-lh-22-medium">Connect Another</p>
                        <p class="feature-text font-14-lh-17-light">Continue to add integrations from our library</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon icon-facebook"></div>
                        <p class="feature-title font-18-lh-22-medium">Facebook Ads</p>
                        <p class="feature-text font-14-lh-17-light">View all available metrics using a pre-made Facebook
                            dashboard</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<div class='loader-wrap'>
    <div id="main-loader" class="preloader done">
        <div class="heartbeat">
            <div class="loading"></div>
            <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>
        </div>
    </div>
</div>

<script>
    document.body.onload = function () {
        setTimeout(function () {
            const preloader = document.getElementById('main-loader');
            if (!preloader.classList.contains('done')) {
                preloader.classList.add('done');
            }
        }, 1000);
    };
</script>
<script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>
{{--<script type="text/javascript" src="{!!asset('js/components/connections.js')!!}"></script>--}}

<script>
    facebookUrl = "{{url('facebook/callback')}}";
    facebookAdsUrl = "{{url('facebook/callback')}}";
    twitterUrl = "{{url('twitter/login')}}";
    instagramUrl = "{{url('instagram/callback')}}";
    googleAnalyticsUrl = "{{url('google-analytics/login')}}";
    googleAdsUrl = "{{url('google-ads/login')}}";
    let arrows;
    let closeArrows;
    let pages;
    ifFbConnected = "{{Auth::user() && Auth::user()->company->social_account_facebook->isNotEmpty()}}"
    ifInstConnected = "{{Auth::user() && Auth::user()->company->social_account_instagram->isNotEmpty()}}"
    ifTwitterConnected = "{{Auth::user() && Auth::user()->company->social_account_twitter->isNotEmpty()}}"

    baseUrl = "{{url('')}}"

    function addPages(pages) {
        let pagesMarkup = '';
        pages.forEach(function (item) {
            let name = item.name !== null && item.name !== "" ? item.name : item.provider_id;
            pagesMarkup = pagesMarkup + '<div class="page-wrap"><label style="cursor: pointer" for="account_form_' + item.id + '">' + name + '</label> <div><input id="account_form_' + item.id + '" type="checkbox" class="form-check-input" name="connect[]" checked value="' + item.id + '" style="position: initial!important; margin-left: 0.75rem;!important"></div></div>';
        })
        return pagesMarkup;
    }

    function addProperties(google_analytics_accounts) {
        let pagesMarkup = '';
        google_analytics_accounts.forEach(function (account) {
            pagesMarkup = pagesMarkup + '<div class="page-wrap"><b>' + account.name + '</b></div>';
            account.properties.forEach(function (property) {
                if (property.profiles.length > 0) {
                    pagesMarkup = pagesMarkup + '<div class="page-wrap"><label>' + property.name + '</label></div>';
                    property.profiles.forEach(function (profile) {
                        pagesMarkup = pagesMarkup + '<div class="page-wrap"><label style="cursor: pointer" for="account_form_' + profile.id + '">' + profile.name + '</label> <div><input id="account_form_' + profile.id + '" type="checkbox" class="form-check-input" name="connect[]" checked value="' + profile.id + '" style="position: initial!important; margin-left: 0.75rem;!important"></div></div>';
                    });
                } else {
                    pagesMarkup = pagesMarkup + '<div class="page-wrap"><label style="cursor: pointer" for="account_form_'+property.id+'">' + property.name + '</label> <div><input id="account_form_'+property.id+'" type="checkbox" class="form-check-input" name="connect[]" checked value="' + property.id + '" style="position: initial!important; margin-left: 0.75rem;!important"></div></div>';
                }
            });
        });
        return pagesMarkup;
    }

    function setModal(provider_name, modal_id, block_id) {
        let date = $(modal_id + ' .date-select').val()
        let search = $(modal_id + ' .search-input').val()
        let data = new Object();
        let connectButtons = document.querySelectorAll('.connect-button');

        data.provider_name = provider_name;
        if (search !== null && search !== '') {
            data.search = search;
        }
        if (date !== null && date !== '') {
            data.date = date;
        }

        $.ajax({
            url: baseUrl + '/search-connects-by-provider',
            method: "post",
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                data: data,
            },
            success: (response) => {
                $(block_id).html('');
                let accounts = response.social_accounts;
                if (accounts.length === 0) {
                    for (let i = 0; i < connectButtons.length; i++) {
                        connectButtons[i].disabled = true;
                        connectButtons[i].classList.add('disabled')
                    }
                } else {
                    for (let i = 0; i < connectButtons.length; i++) {
                        connectButtons[i].disabled = false;
                        connectButtons[i].classList.remove('disabled')
                    }
                }
                if (!jQuery.isEmptyObject(accounts)) {
                    accounts.forEach(function (item) {
                        if (provider_name == 'googleAnalytics' || provider_name == 'google-analytics-ua') {
                            $(block_id).append('<div class="content-wrapper"><div class="arrow-wrap"><div class="arrow"><i class="fas fa-angle-left" style="font-size:24px; padding-left:10px;"></i></div><div class="closeArrow"><i class="fas fa-angle-down" style="font-size:24px; padding-left:10px;"></i></div><span class="connection-name">' + item.full_name + '</span></div>' +
                                '<div class="name-wrapper"><div>' +
                                addProperties(item.google_analytics_account)
                                +
                                '</div></div></div>')
                        } else if (provider_name == 'googleAds') {
                            let name = item.full_name !== null ? item.full_name : item.provider_id;
                            $(block_id).append('<div class="content-wrapper" xmlns="http://www.w3.org/1999/html"><div class="arrow-wrap"><div class="arrow"><i class="fas fa-angle-left" style="font-size:24px; padding-left:10px;"></i></div><div class="closeArrow"><i class="fas fa-angle-down" style="font-size:24px; padding-left:10px;"></i></div><span class="connection-name">' + name + '</span></div>' +
                                '<div class="name-wrapper"><div>' +
                                addPages(item.google_ads_account)
                                +
                                '</div></div></div>')
                        } else if (provider_name !== 'twitter') {
                            $(block_id).append('<div class="content-wrapper"><div class="arrow-wrap"><div class="arrow"><i class="fas fa-angle-left" style="font-size:24px; padding-left:10px;"></i></div><div class="closeArrow"><i class="fas fa-angle-down" style="font-size:24px; padding-left:10px;"></i></div><span class="connection-name">' + item.full_name + '</span></div>' +
                                '<div class="name-wrapper"><div>' +
                                addPages(provider_name === 'facebookAds' ? item.ads_account : item.page)
                                +
                                '</div></div></div>')
                        } else {
                            $(block_id).append('<div class="content-wrapper" style="display: flex; justify-content: space-between;"><span class="connection-name">' + item.full_name +
                                '</span><div><input type="checkbox" name="connect[]" class="form-check-input" checked value="' + item.id + '"></div></div>')
                        }

                    })
                    arrows = document.querySelectorAll('.arrow');
                    content = document.querySelectorAll('.connection-name');
                    closeArrows = document.querySelectorAll('.closeArrow');
                    pages = document.querySelectorAll('.name-wrapper');
                    let opened = false;

                    arrows.forEach(function (ar, index) {
                        ar.addEventListener('click', function () {
                            ar.style.display = 'none';
                            pages[index].style.display = 'block';
                            closeArrows[index].style.display = 'block';
                            opened = true;
                        })
                    });

                    content.forEach(function (arText, index) {
                        arText.addEventListener('click', function () {
                            if (!opened) {
                                arrows[index].style.display = 'none';
                                pages[index].style.display = 'block';
                                closeArrows[index].style.display = 'block';
                                opened = true;
                            } else {
                                arrows[index].style.display = 'block';
                                pages[index].style.display = 'none';
                                closeArrows[index].style.display = 'none';
                                opened = false;
                            }
                        })
                    });

                    closeArrows.forEach(function (arCl, index) {
                        arCl.addEventListener('click', function () {
                            arCl.style.display = 'none';
                            pages[index].style.display = 'none';
                            arrows[index].style.display = 'block';
                            opened = false;
                        })
                    });
                }
            },
        })
    }


</script>

<script>
    function toggleLoader(loaderStatus) {
        const preloader = $('#main-loader');
        if (loaderStatus) {
            preloader.removeClass('done');
        } else {
            preloader.addClass('done');
        }
        ;
    };

    window.fbAsyncInit = function () {
        FB.init({
            appId: {{env('FACEBOOK_APP_ID')}},
            cookie: true,
            xfbml: true,
            version: 'v12.0'
        });
    };

    function checkConnections() {
        let result = false;
        $.ajax({
            url: '{{url('/check-count-connections')}}',
            method: "get",
            async: false,
            success: function (data) {
                result = data.status;
            }
        })
        return result;
    };

    function disableElement(className) {
        return $(className).hasClass("disable-connections");

        // let addNew = document.querySelector(className);
        // //if(addNew.classList.contains('disabled')) return;
        // addNew.classList.add('disabled');
        // addNew.style.pointerEvents = "none";
        // return true;
    }

    function enableElement(className) {
        let addNew = document.querySelector(className);
        //if(addNew.classList.contains('disabled')) return;
        addNew.classList.remove('disabled');
        addNew.style.pointerEvents = "auto";
        return true;
    }

    function fb_login() {
        if (!disableElement('.fb-add-new')) {
            window.setTimeout(function () {
                let createConnections = checkConnections();
                if (!createConnections) {
                    return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                }
                FB.login(function (response) {
                    if (response.authResponse && response.status === 'connected') {
                        access_token = response.authResponse.accessToken;
                        user_id = response.authResponse.userID;
                        $.ajax({
                            url: '{{url('facebook/callback')}}',
                            method: "post",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                id: user_id,
                                token: access_token,
                            },
                            dataType: 'json',
                            beforeSend: function () {
                                toggleLoader(true);
                            },
                            success: (response) => {
                                toggleLoader(false);
                                if (response.status) {
                                    toastr.success(response.message);
                                    setModal('facebook', '#facebook-page', '#facebook-page-accounts-list');
                                    document.querySelector('.no-my-connections').style.display = "none";
                                    document.querySelector('.my-fb-connection').style.display = "block";
                                } else {
                                    toastr.warning(response.message);
                                }
                            },
                            error: () => {
                                toggleLoader(false);
                                toastr.warning('{{__('error')}}');
                            }
                        })
                    } else {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }, {
                    scope: 'email, public_profile, read_insights, pages_show_list, pages_read_engagement, public_profile, pages_manage_posts',
                });
                // window.setTimeout(function(){enableElement('.fb-add-new')}, 1000)
            }, 500);
        }
    }

    function instagram_login() {
        if (!disableElement('.insta-add-new')) {
            window.setTimeout(function () {
                let createConnections = checkConnections();
                if (!createConnections) {
                    return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                }
                FB.login(function (response) {
                    if (response.authResponse) {
                        access_token = response.authResponse.accessToken;
                        user_id = response.authResponse.userID;
                        $.ajax({
                            url: '{{url('instagram/callback')}}',
                            method: "post",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                id: user_id,
                                token: access_token,
                            },
                            beforeSend: function () {
                                toggleLoader(true);
                            },
                            dataType: 'json',
                            success: (response) => {
                                toggleLoader(false);
                                if (response.status) {
                                    toastr.success(response.message);
                                    setModal('instagram', '#instagram-modal', '#instagram-modal-accounts-list')
                                    document.querySelector('.no-my-connections').style.display = "none";
                                    document.querySelector('.my-instagram-connection').style.display = "block";
                                } else {
                                    toastr.warning(response.message);
                                }
                            },
                            error: () => {
                                toggleLoader(false);
                                toastr.warning('{{__('error')}}');
                            }
                        })
                    } else {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }, {
                    scope: 'email,  public_profile, instagram_basic, instagram_manage_insights, pages_show_list, pages_read_engagement',
                });
                // window.setTimeout(function () {
                //     enableElement('.insta-add-new')
                // }, 1000)
            }, 500);
        }
    }

    function facebook_ads_login() {
        if (!disableElement('.fb-ads-add-new')) {
            window.setTimeout(function () {
                let createConnections = checkConnections();
                if (!createConnections) {
                    return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                }
                FB.login(function (response) {
                    if (response.authResponse) {
                        access_token = response.authResponse.accessToken;
                        user_id = response.authResponse.userID;
                        $.ajax({
                            url: '{{url('/facebook-ads/callback')}}',
                            method: "post",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                id: user_id,
                                token: access_token,
                            },
                            dataType: 'json',
                            beforeSend: function () {
                                toggleLoader(true);
                            },
                            success: (response) => {
                                toggleLoader(false);
                                if (response.status) {
                                    setModal('facebookAds', '#facebook-ads-modal', '#facebook-ads-accounts-list')
                                    toastr.success(response.message);
                                    document.querySelector('.no-my-connections').style.display = "none";
                                    document.querySelector('.my-fb-ads-connection').style.display = "block";
                                } else {
                                    toastr.warning(response.message);
                                }
                            },
                            error: () => {
                                toggleLoader(false);
                                toastr.warning(response.message);
                            }
                        })
                    } else {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }, {
                    scope: 'email,public_profile,ads_management,ads_read,read_insights,pages_read_engagement, pages_show_list, pages_manage_ads',
                });
                // window.setTimeout(function () {
                //     enableElement('.fb-ads-add-new')
                // }, 1000)
            }, 500);
        }
    }

    function twitter_login() {
        if (!disableElement('.twitter-add-new')) {
            window.setTimeout(function () {
                let createConnections = checkConnections();
                if (!createConnections) {
                    addNew.classList.remove('disabled');
                    addNew.disabled = false;
                    return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                }
                var left = (screen.width / 2 - 225);
                var top = (screen.height / 2 - 350);
                window.open(twitterUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
                // window.setTimeout(function () {
                //     enableElement('.twitter-add-new')
                // }, 1000)
            }, 500);
        }
    }

    function googleAnalyticsLogin() {
        if (!disableElement('.ga-add-new')) {
            window.setTimeout(function () {
                let createConnections = checkConnections();
                if (!createConnections) {
                    addNew.classList.remove('disabled');
                    addNew.disabled = false;
                    return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                }
                var left = (screen.width / 2 - 225);
                var top = (screen.height / 2 - 350);
                window.open(googleAnalyticsUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
                // window.setTimeout(function () {
                //     enableElement('.ga-add-new')
                // }, 1000)
            }, 500);
        }
    }

    function googleAdsLogin() {
        if (!disableElement('.gads-add-new')) {
            window.setTimeout(function () {

                let createConnections = checkConnections();
                if (!createConnections) {
                    addNew.classList.remove('disabled');
                    addNew.disabled = false;
                    return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
                }
                var left = (screen.width / 2 - 225);
                var top = (screen.height / 2 - 350);
                window.open(googleAdsUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
                // window.setTimeout(function () {
                //     enableElement('.gads-add-new')
                // }, 1000)
            }, 500);
        }
    }

    jQuery(window).bind("focus", function (event) {
        let ConnectionInfo = localStorage.getItem('connectionStatus');
        let ConnectionType = localStorage.getItem('connectionType');
        console.log(ConnectionType);
        if (ConnectionInfo === 'success') {
            switch (ConnectionType) {
                case 'twitter':
                    setModal('twitter', '#twitter-modal', '#twitter-modal-accounts-list');
                    document.querySelector('.no-my-connections').style.display = "none";
                    document.querySelector('.my-twitter-connection').style.display = "block";
                    break;
                case 'google-analytics':
                    setModal('googleAnalytics', '#google-analytics-modal' ,'#google-analytics-accounts-list')
                    document.querySelector('.no-my-connections').style.display="none";
                    document.querySelector('.my-ga-connection').style.display="block";
                    break;
                case 'google-analytics-ua':
                    setModal('google-analytics-ua', '#google-analytics-ua-modal', '#google-analytics-ua-accounts-list')
                    document.querySelector('.no-my-connections').style.display = "none";
                    document.querySelector('.my-ga-ua-connection').style.display = "block";
                    break;
                case 'googleAds':
                    setModal('googleAds', '#google-ads-modal', '#google-ads-modal-accounts-list')
                    document.querySelector('.no-my-connections').style.display = "none";
                    document.querySelector('.my-gad-connection').style.display = "block";
                    break;
            }

            toastr.success('{{__('Connection connected successfully')}}');
        }
        if (ConnectionInfo === 'error_account_connected') {
            toastr.warning('{{__('This account is connected')}}');
        }
        if (ConnectionInfo === 'error') {
            toastr.warning('{{__('Error during connecting, please try again')}}');
        }
        if (ConnectionInfo === 'no_accounts') {
            toastr.warning('{{__('No accounts')}}');
        }
        if (ConnectionInfo === 'error_no_permissions') {
            toastr.warning('{{__('No permissions')}}');
        }
        localStorage.removeItem('connectionStatus');
        localStorage.removeItem('connectionType');
    });

    window.onload = function () {
        let submitButtons = document.querySelectorAll('.connect-button');
        submitButtons.forEach((item) => {
            item.addEventListener('click', function (e) {
                e.target.form.submit()
                e.target.disabled = true;
                e.target.classList.add('disabled')
            })
        })
    }
</script>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

@if(!empty(Session::get('modal_name')) && in_array(Session::get('modal_name'), ['instagram', 'facebook', 'facebookAds', 'twitter']))
    @include('tenant.connection.modal.' . Session::get('modal_name'))
    <script>
        $(function () {
            $('#whats_next').modal();
        });
    </script>
@endif
