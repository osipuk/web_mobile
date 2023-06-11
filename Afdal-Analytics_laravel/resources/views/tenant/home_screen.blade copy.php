@extends('layout.userhead')

@section('metahead')
    <title>{{__("Dashboard ")}}</title>
    <link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}"/>
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->
@endsection

@section('css')
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

    @if($get_locale == 'en')
        <style type="text/css">
            .w-89-en{
                /* width: 89%; */
                width: 60%;
            }

            .float-right{
                float: left!important;
            }

            .pr-0-en{
                padding-right: 0px;
            }
        </style>
    @endif
@endsection


<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/confetti.css"> -->
@section('title', 'User Home')
<div class="page-wrapper chiller-theme toggled">
    @section('content')
        @include('layout.usersidenav')
        @php
            $template_name = !empty($template_name) ? $template_name : null;
        @endphp

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
                padding: 7px !important;
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
                margin-left: 37px;
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
                padding-bottom: 20px;
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
        </style>
        <header class="dashboard-header pr-0-en">
            <div class="dashboard-header-spacer"></div>
            <div class="dashboard-container">
                <div class="dashboard-header-content-wrapper">
                    <div class="dashboard-top-bar align-items-center mb-4">
                        <h1 class="dashboard-title font-54-lh-50-medium w-89-en">
                            {{__('Dashboards')}}
                        </h1>
                        @include('tenant.components.user-block')
                    </div>
                    <div class="dashboard-menu">
                        <div class="dashboard-templates-picker">
                            <ul class="dashboard-templates-list hidden">

                                @if(Auth::user()->company?->dashboard->isNotEmpty())
                                    @foreach(Auth::user()->company->dashboard as $dashboard)
                                        @if($dashboard->name === 'facebook-overview')
                                            <li class="dashboard-templates-list-item" id="facebook-overview-item">
                                                <a href="{{url('dashboard/facebook-overview')}}"
                                                   class="dashboard-template-link">
                                                    <p class="dashboard-template-name font-24-lh-28-medium">
                                                        {{__('Page')}}
                                                    </p>
                                                    <div class="dashboard-template-icon">
                                                        <svg id="icon_24x_Facebook" width="20" height="20"
                                                             viewBox="0 0 50 50">
                                                            <g id="Boundary" stroke="rgba(0,0,0,0)" stroke-width="1"
                                                               opacity="0">
                                                                <rect width="50" height="50" stroke="none"/>
                                                                <rect x="0.5" y="0.5" width="49" height="49"
                                                                      fill="none"/>
                                                            </g>
                                                            <g class="dashboard-logo-facebook"
                                                               transform="translate(0 0.175)">
                                                                <path class="dashboard-logo-facebook"
                                                                      d="M49.649-1340.425a24.864,24.864,0,0,0-24.825-24.9A24.864,24.864,0,0,0,0-1340.425a24.886,24.886,0,0,0,20.946,24.6v-17.4h-6.3v-7.2h6.3v-5.487c0-6.241,3.706-9.689,9.377-9.689a38.026,38.026,0,0,1,5.557.487v6.128h-3.13c-3.084,0-4.046,1.92-4.046,3.889v4.672h6.885l-1.1,7.2H28.7v17.4a24.886,24.886,0,0,0,20.946-24.6"
                                                                      transform="translate(0 1365.33)" fill="#1877f2"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="dashboard-orange-line"></div>
                                            </li>
                                        @elseif($dashboard->name === 'facebook-ads-overview')
                                            <li class="dashboard-templates-list-item" id="facebook-ads-item">
                                                <a href="{{url('dashboard/facebook-ads-overview')}}"
                                                   class="dashboard-template-link">
                                                    <p class="dashboard-template-name font-24-lh-28-medium">
                                                        {{__('Ads')}}
                                                    </p>
                                                    <div class="dashboard-template-icon">
                                                        <svg id="icon_24x_Facebook" width="20" height="20"
                                                             viewBox="0 0 50 50">
                                                            <g id="Boundary" stroke="rgba(0,0,0,0)" stroke-width="1"
                                                               opacity="0">
                                                                <rect width="50" height="50" stroke="none"/>
                                                                <rect x="0.5" y="0.5" width="49" height="49"
                                                                      fill="none"/>
                                                            </g>
                                                            <g class="dashboard-logo-facebook"
                                                               transform="translate(0 0.175)">
                                                                <path class="dashboard-logo-facebook"
                                                                      d="M49.649-1340.425a24.864,24.864,0,0,0-24.825-24.9A24.864,24.864,0,0,0,0-1340.425a24.886,24.886,0,0,0,20.946,24.6v-17.4h-6.3v-7.2h6.3v-5.487c0-6.241,3.706-9.689,9.377-9.689a38.026,38.026,0,0,1,5.557.487v6.128h-3.13c-3.084,0-4.046,1.92-4.046,3.889v4.672h6.885l-1.1,7.2H28.7v17.4a24.886,24.886,0,0,0,20.946-24.6"
                                                                      transform="translate(0 1365.33)" fill="#1877f2"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="dashboard-orange-line"></div>
                                            </li>
                                        @elseif($dashboard->name === 'facebook-engagement')
                                            <li class="dashboard-templates-list-item" id="facebook-engagement-item">
                                                <a href="{{url('dashboard/facebook-engagement')}}"
                                                   class="dashboard-template-link">
                                                    <p class="dashboard-template-name font-24-lh-28-medium">
                                                        {{__('Engagement')}}
                                                    </p>
                                                    <div class="dashboard-template-icon">
                                                        <svg width="20" height="20" viewBox="0 0 50 50">
                                                            <g id="Boundary" stroke="rgba(0,0,0,0)" stroke-width="1"
                                                               opacity="0">
                                                                <rect width="50" height="50" stroke="none"/>
                                                                <rect x="0.5" y="0.5" width="49" height="49"
                                                                      fill="none"/>
                                                            </g>
                                                            <g class="dashboard-logo-facebook"
                                                               transform="translate(0 0.175)">
                                                                <path class="dashboard-logo-facebook"
                                                                      d="M49.649-1340.425a24.864,24.864,0,0,0-24.825-24.9A24.864,24.864,0,0,0,0-1340.425a24.886,24.886,0,0,0,20.946,24.6v-17.4h-6.3v-7.2h6.3v-5.487c0-6.241,3.706-9.689,9.377-9.689a38.026,38.026,0,0,1,5.557.487v6.128h-3.13c-3.084,0-4.046,1.92-4.046,3.889v4.672h6.885l-1.1,7.2H28.7v17.4a24.886,24.886,0,0,0,20.946-24.6"
                                                                      transform="translate(0 1365.33)" fill="#1877f2"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="dashboard-orange-line"></div>
                                            </li>
                                        @elseif($dashboard->name === 'twitter-overview')
                                            <li class="dashboard-templates-list-item" id="twitter-overview-item">
                                                <a href="{{url('dashboard/twitter-overview')}}"
                                                   class="dashboard-template-link">
                                                    <p class="dashboard-template-name font-24-lh-28-medium">
                                                        {{__('Twitter')}}
                                                    </p>
                                                    <div class="dashboard-template-icon">
                                                        <svg width="20" height="20" viewBox="0 0 24 24">
                                                            <g id="Boundary" transform="translate(0)"
                                                               stroke="rgba(0,0,0,0)" stroke-width="1" opacity="0">
                                                                <rect width="24" height="24" stroke="none"/>
                                                                <rect x="0.5" y="0.5" width="23" height="23"
                                                                      fill="none"/>
                                                            </g>
                                                            <path class="dashboard-logo-twitter" data-name="Path 40865"
                                                                  d="M547.729,589.354a13.915,13.915,0,0,0,14.01-14.01q0-.32-.014-.636a10.014,10.014,0,0,0,2.456-2.55,9.82,9.82,0,0,1-2.828.775,4.942,4.942,0,0,0,2.165-2.723,9.875,9.875,0,0,1-3.127,1.2A4.928,4.928,0,0,0,552,575.9a13.981,13.981,0,0,1-10.15-5.145,4.928,4.928,0,0,0,1.524,6.574,4.888,4.888,0,0,1-2.23-.616c0,.021,0,.041,0,.063a4.925,4.925,0,0,0,3.95,4.827,4.917,4.917,0,0,1-2.224.085,4.929,4.929,0,0,0,4.6,3.42,9.878,9.878,0,0,1-6.116,2.108,10.008,10.008,0,0,1-1.174-.068,13.938,13.938,0,0,0,7.548,2.212"
                                                                  transform="translate(-540.181 -567.602)"
                                                                  fill="#1da1f2"/>
                                                        </svg>

                                                    </div>
                                                </a>
                                                <div class="dashboard-orange-line"></div>
                                            </li>
                                        @elseif($dashboard->name === 'instagram-overview')
                                            <li class="dashboard-templates-list-item" id="instagram-overview-item">
                                                <a href="{{url('dashboard/instagram-overview')}}"
                                                   class="dashboard-template-link">
                                                    <p class="dashboard-template-name font-24-lh-28-medium">
                                                        {{__('Instagram')}}
                                                    </p>
                                                    <div class="dashboard-template-icon">
                                                        <svg width="20" height="20" viewBox="0 0 24 24">
                                                            <defs>
                                                                <radialGradient id="radial-gradient" cx="0.266"
                                                                                cy="1.077" r="0.991"
                                                                                gradientUnits="objectBoundingBox">
                                                                    <stop offset="0" stop-color="#fd5"/>
                                                                    <stop offset="0.1" stop-color="#fd5"/>
                                                                    <stop offset="0.5" stop-color="#ff543e"/>
                                                                    <stop offset="1" stop-color="#c837ab"/>
                                                                </radialGradient>
                                                                <radialGradient id="radial-gradient-2" cx="-0.168"
                                                                                cy="0.072" r="0.443"
                                                                                gradientUnits="objectBoundingBox">
                                                                    <stop offset="0" stop-color="#3771c8"/>
                                                                    <stop offset="0.128" stop-color="#3771c8"/>
                                                                    <stop offset="1" stop-color="#60f"
                                                                          stop-opacity="0"/>
                                                                </radialGradient>
                                                            </defs>
                                                            <g id="Boundary" transform="translate(0)"
                                                               stroke="rgba(0,0,0,0)" stroke-width="1" opacity="0">
                                                                <rect width="24" height="24" stroke="none"/>
                                                                <rect x="0.5" y="0.5" width="23" height="23"
                                                                      fill="none"/>
                                                            </g>
                                                            <g id="Group_57664" data-name="Group 57664"
                                                               transform="translate(-1629.533 -478.042)">
                                                                <path class="dashboard-logo-instagram"
                                                                      data-name="Path 34782"
                                                                      d="M12,0c-5.01,0-6.475.005-6.76.029A5.954,5.954,0,0,0,2.876.623,4.79,4.79,0,0,0,1.5,1.632,5.15,5.15,0,0,0,.107,4.551,21.656,21.656,0,0,0,0,8.093c0,.955,0,2.213,0,3.9C0,17,0,18.462.027,18.746A6.027,6.027,0,0,0,.6,21.064a5.055,5.055,0,0,0,3.276,2.676,8.514,8.514,0,0,0,1.742.231c.3.013,3.326.022,6.357.022s6.062,0,6.351-.018a8.2,8.2,0,0,0,1.805-.236,5.024,5.024,0,0,0,3.276-2.682,5.928,5.928,0,0,0,.566-2.273c.016-.207.023-3.5.023-6.794s-.007-6.582-.024-6.789A5.862,5.862,0,0,0,23.4,2.9,4.756,4.756,0,0,0,22.369,1.5,5.181,5.181,0,0,0,19.447.11,21.626,21.626,0,0,0,15.906,0Z"
                                                                      transform="translate(1629.536 478.042)"
                                                                      fill="url(#radial-gradient)"/>
                                                                <path class="dashboard-logo-instagram"
                                                                      data-name="Path 34783"
                                                                      d="M12,0c-5.01,0-6.475.005-6.76.029A5.954,5.954,0,0,0,2.876.623,4.79,4.79,0,0,0,1.5,1.632,5.15,5.15,0,0,0,.107,4.551,21.656,21.656,0,0,0,0,8.093c0,.955,0,2.213,0,3.9C0,17,0,18.462.027,18.746A6.027,6.027,0,0,0,.6,21.064a5.055,5.055,0,0,0,3.276,2.676,8.514,8.514,0,0,0,1.742.231c.3.013,3.326.022,6.357.022s6.062,0,6.351-.018a8.2,8.2,0,0,0,1.805-.236,5.024,5.024,0,0,0,3.276-2.682,5.928,5.928,0,0,0,.566-2.273c.016-.207.023-3.5.023-6.794s-.007-6.582-.024-6.789A5.862,5.862,0,0,0,23.4,2.9,4.756,4.756,0,0,0,22.369,1.5,5.181,5.181,0,0,0,19.447.11,21.626,21.626,0,0,0,15.906,0Z"
                                                                      transform="translate(1629.536 478.042)"
                                                                      fill="url(#radial-gradient-2)"/>
                                                                <path class="dashboard-logo-instagram-background-fill"
                                                                      data-name="Path 34784"
                                                                      d="M26.861,18c-2.406,0-2.708.011-3.653.054a6.5,6.5,0,0,0-2.15.412,4.532,4.532,0,0,0-2.592,2.591,6.472,6.472,0,0,0-.412,2.15c-.042.945-.053,1.247-.053,3.653s.011,2.707.054,3.652a6.511,6.511,0,0,0,.412,2.15,4.534,4.534,0,0,0,2.591,2.592,6.507,6.507,0,0,0,2.151.412c.945.043,1.247.054,3.653.054s2.707-.011,3.652-.054a6.511,6.511,0,0,0,2.151-.412,4.539,4.539,0,0,0,2.591-2.592,6.567,6.567,0,0,0,.412-2.15c.042-.945.054-1.246.054-3.652s-.011-2.708-.054-3.653a6.564,6.564,0,0,0-.412-2.15,4.533,4.533,0,0,0-2.592-2.591,6.522,6.522,0,0,0-2.152-.412c-.945-.043-1.246-.054-3.653-.054Zm-.795,1.6h.795c2.366,0,2.646.008,3.58.051a4.905,4.905,0,0,1,1.645.305,2.936,2.936,0,0,1,1.681,1.682,4.9,4.9,0,0,1,.305,1.645c.042.934.052,1.215.052,3.579s-.009,2.645-.052,3.579a4.9,4.9,0,0,1-.305,1.645,2.938,2.938,0,0,1-1.681,1.68,4.887,4.887,0,0,1-1.645.305c-.934.042-1.215.052-3.58.052s-2.646-.009-3.58-.052a4.915,4.915,0,0,1-1.645-.305,2.935,2.935,0,0,1-1.682-1.681,4.9,4.9,0,0,1-.305-1.645c-.042-.934-.051-1.215-.051-3.58s.008-2.645.051-3.579a4.905,4.905,0,0,1,.305-1.645,2.936,2.936,0,0,1,1.682-1.682,4.894,4.894,0,0,1,1.645-.305c.817-.037,1.134-.048,2.785-.05Zm5.524,1.471a1.063,1.063,0,1,0,1.063,1.063,1.063,1.063,0,0,0-1.063-1.063ZM26.861,22.31a4.549,4.549,0,1,0,4.549,4.55,4.55,4.55,0,0,0-4.549-4.55Zm0,1.6a2.953,2.953,0,1,1-2.953,2.953A2.953,2.953,0,0,1,26.861,23.907Z"
                                                                      transform="translate(1614.671 463.179)"
                                                                      fill="#fff"/>
                                                            </g>
                                                        </svg>

                                                    </div>
                                                </a>
                                                <div class="dashboard-orange-line"></div>
                                            </li>
                                        @elseif($dashboard->name == 'google-analytics-overview')
                                            <li class="dashboard-templates-list-item"
                                                id="google-analytics-overview-item">
                                                <a href="{{url('dashboard/google-analytics-overview')}}"
                                                   class="dashboard-template-link">
                                                    <p class="dashboard-template-name font-24-lh-28-medium">
                                                        {{__('Google Analytics')}}
                                                    </p>
                                                    <div class="dashboard-template-icon">
                                                        <svg id="icon_24x_Google_" data-name="icon/24x/Google "
                                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24">
                                                            <g id="Boundary" stroke="rgba(0,0,0,0)" stroke-width="1"
                                                               opacity="0">
                                                                <rect width="24" height="24" stroke="none"/>
                                                                <rect x="0.5" y="0.5" width="23" height="23"
                                                                      fill="none"/>
                                                            </g>
                                                            <g id="g6628" transform="translate(1.637)">
                                                                <path class="dashboard-logo-google-analytics"
                                                                      id="path3806"
                                                                      d="M269.9,342.046v18a2.9,2.9,0,0,0,2.864,3.136,2.866,2.866,0,0,0,2.864-3.136V342.182a2.868,2.868,0,0,0-2.864-3A2.912,2.912,0,0,0,269.9,342.046Zm0,0"
                                                                      transform="translate(-254.896 -339.182)"
                                                                      fill="#f8ab00"/>
                                                                <path class="dashboard-logo-google-analytics"
                                                                      id="path3808"
                                                                      d="M222.423,399.876v8.864a2.9,2.9,0,0,0,2.864,3.136,2.866,2.866,0,0,0,2.864-3.136v-8.727a2.868,2.868,0,0,0-2.864-3,2.912,2.912,0,0,0-2.864,2.864Zm0,0"
                                                                      transform="translate(-214.923 -387.876)"
                                                                      fill="#e37300"/>
                                                                <path class="dashboard-logo-google-analytics"
                                                                      id="path3810"
                                                                      d="M180.677,457.707a2.864,2.864,0,1,1-2.864-2.864,2.864,2.864,0,0,1,2.864,2.864"
                                                                      transform="translate(-174.949 -436.571)"
                                                                      fill="#e37300"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="dashboard-orange-line"></div>
                                            </li>
                                        @elseif($dashboard->name == 'google-ads-overview')
                                            <li class="dashboard-templates-list-item" id="google-ads-overview-item">
                                                <a href="{{url('dashboard/google-ads-overview')}}"
                                                   class="dashboard-template-link">
                                                    <p class="dashboard-template-name font-24-lh-28-medium">
                                                        {{__('Google Ads')}}
                                                    </p>
                                                    <div class="dashboard-template-icon">
                                                        <svg id="icon_24x_Google_Ads" data-name="icon/24x/Google Ads"
                                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24">
                                                            <g id="Boundary" stroke="rgba(0,0,0,0)" stroke-width="1"
                                                               opacity="0">
                                                                <rect width="24" height="24" stroke="none"/>
                                                                <rect x="0.5" y="0.5" width="23" height="23"
                                                                      fill="none"/>
                                                            </g>
                                                            <g id="Group_57671" data-name="Group 57671"
                                                               transform="translate(-2029.66 -680.787)">
                                                                <path class="dashboard-logo-google-ads" id="Path_34788"
                                                                      data-name="Path 34788"
                                                                      d="M83.538,2.794A4.337,4.337,0,0,1,84.562,1.17a4.013,4.013,0,0,1,6.312.938c.967,1.759,1.991,3.48,2.987,5.219,1.662,2.89,3.344,5.78,4.987,8.68a4,4,0,1,1-6.988,3.876q-2.189-3.813-4.388-7.616a.876.876,0,0,0-.106-.155,1.572,1.572,0,0,1-.319-.474c-.648-1.141-1.315-2.271-1.962-3.4-.416-.735-.851-1.459-1.266-2.194a4,4,0,0,1-.532-2.126,2.964,2.964,0,0,1,.251-1.121"
                                                                      transform="translate(1954.29 681.789)"
                                                                      fill="#3c8bd9"/>
                                                                <path class="dashboard-logo-google-ads" id="Path_34789"
                                                                      data-name="Path 34789"
                                                                      d="M18.6,28.6a5.559,5.559,0,0,0-.184,1.063A4.175,4.175,0,0,0,19,31.935q1.595,2.74,3.18,5.5c.1.164.174.329.271.483-.58,1.005-1.16,2-1.749,3.006-.812,1.4-1.624,2.813-2.445,4.214-.039,0-.048-.019-.058-.048a.6.6,0,0,1,.039-.222,3.89,3.89,0,0,0-.928-3.837,3.684,3.684,0,0,0-2.271-1.17,3.923,3.923,0,0,0-3.1.86c-.164.126-.271.309-.464.406a.064.064,0,0,1-.068-.048c.464-.8.918-1.6,1.382-2.407q2.871-4.987,5.751-9.965c.019-.039.048-.068.068-.106"
                                                                      transform="translate(2019.227 655.983)"
                                                                      fill="#fabc04"/>
                                                                <path class="dashboard-logo-google-ads" id="Path_34790"
                                                                      data-name="Path 34790"
                                                                      d="M2.407,145.435c.184-.164.358-.338.551-.493a4,4,0,0,1,6.389,2.426,4.248,4.248,0,0,1-.155,2.059,1.012,1.012,0,0,1-.039.164c-.087.155-.164.319-.261.474a3.886,3.886,0,0,1-3.789,2.02,3.968,3.968,0,0,1-3.663-3.46,3.867,3.867,0,0,1,.532-2.571c.1-.174.213-.329.319-.5.048-.039.029-.116.116-.116"
                                                                      transform="translate(2028.258 551.656)"
                                                                      fill="#34a852"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div class="dashboard-orange-line"></div>
                                            </li>
                                        @endif
                                    @endforeach
                                @else
                                    <li class="dashboard-templates-list-item active dashboard-templates-add-connections-item">
                                        <a href="{{url('/dashboard/connections')}}" class="dashboard-template-link">
                                            <p class="dashboard-template-name font-24-lh-28-medium">
                                                {{__('Add Dashboard')}}
                                            </p>
                                        </a>
                                        <div class="dashboard-orange-line"></div>
                                    </li>
                                @endif

                                {{--                    @if(Auth::user() && Auth::user()->company->social_account_facebook->isNotEmpty())--}}
                                {{--                    <li class="dashboard-templates-list-item" id="facebook-overview-item">--}}
                                {{--                      <a href="{{url('dashboard/facebook-overview')}}" class="dashboard-template-link">--}}
                                {{--                        <p class="dashboard-template-name font-24-lh-28-medium">--}}
                                {{--                          {{__('Page')}}--}}
                                {{--                        </p>--}}
                                {{--                        <div class="dashboard-template-icon">--}}
                                {{--                          <svg id="icon_24x_Facebook" width="20" height="20" viewBox="0 0 50 50">--}}
                                {{--                            <g id="Boundary" stroke="rgba(0,0,0,0)" stroke-width="1" opacity="0">--}}
                                {{--                              <rect width="50" height="50" stroke="none"/>--}}
                                {{--                              <rect x="0.5" y="0.5" width="49" height="49" fill="none"/>--}}
                                {{--                            </g>--}}
                                {{--                            <g class="dashboard-logo-facebook" transform="translate(0 0.175)">--}}
                                {{--                              <path class="dashboard-logo-facebook" d="M49.649-1340.425a24.864,24.864,0,0,0-24.825-24.9A24.864,24.864,0,0,0,0-1340.425a24.886,24.886,0,0,0,20.946,24.6v-17.4h-6.3v-7.2h6.3v-5.487c0-6.241,3.706-9.689,9.377-9.689a38.026,38.026,0,0,1,5.557.487v6.128h-3.13c-3.084,0-4.046,1.92-4.046,3.889v4.672h6.885l-1.1,7.2H28.7v17.4a24.886,24.886,0,0,0,20.946-24.6" transform="translate(0 1365.33)" fill="#1877f2"/>--}}
                                {{--                            </g>--}}
                                {{--                          </svg>--}}
                                {{--                        </div>--}}
                                {{--                      </a>--}}
                                {{--                      <div class="dashboard-orange-line"></div>--}}
                                {{--                    </li>--}}
                                {{--                    @endif--}}

                                {{--                    @if(Auth::user() && Auth::user()->company->social_account_facebook_ads->isNotEmpty())--}}
                                {{--                    <li class="dashboard-templates-list-item" id="facebook-ads-item">--}}
                                {{--                      <a href="{{url('dashboard/facebook-ads-overview')}}" class="dashboard-template-link">--}}
                                {{--                        <p class="dashboard-template-name font-24-lh-28-medium">--}}
                                {{--                          {{__('Ads')}}--}}
                                {{--                        </p>--}}
                                {{--                        <div class="dashboard-template-icon">--}}
                                {{--                          <svg id="icon_24x_Facebook" width="20" height="20" viewBox="0 0 50 50">--}}
                                {{--                            <g id="Boundary" stroke="rgba(0,0,0,0)" stroke-width="1" opacity="0">--}}
                                {{--                              <rect width="50" height="50" stroke="none"/>--}}
                                {{--                              <rect x="0.5" y="0.5" width="49" height="49" fill="none"/>--}}
                                {{--                            </g>--}}
                                {{--                            <g class="dashboard-logo-facebook" transform="translate(0 0.175)">--}}
                                {{--                              <path class="dashboard-logo-facebook" d="M49.649-1340.425a24.864,24.864,0,0,0-24.825-24.9A24.864,24.864,0,0,0,0-1340.425a24.886,24.886,0,0,0,20.946,24.6v-17.4h-6.3v-7.2h6.3v-5.487c0-6.241,3.706-9.689,9.377-9.689a38.026,38.026,0,0,1,5.557.487v6.128h-3.13c-3.084,0-4.046,1.92-4.046,3.889v4.672h6.885l-1.1,7.2H28.7v17.4a24.886,24.886,0,0,0,20.946-24.6" transform="translate(0 1365.33)" fill="#1877f2"/>--}}
                                {{--                            </g>--}}
                                {{--                          </svg>--}}
                                {{--                        </div>--}}
                                {{--                      </a>--}}
                                {{--                      <div class="dashboard-orange-line"></div>--}}
                                {{--                    </li>--}}
                                {{--                    @endif--}}

                                {{--                    @if(Auth::user() && Auth::user()->company->social_account_facebook->isNotEmpty())--}}
                                {{--                    <li class="dashboard-templates-list-item" id="facebook-engagement-item">--}}
                                {{--                      <a href="{{url('dashboard/facebook-engagement')}}" class="dashboard-template-link">--}}
                                {{--                        <p class="dashboard-template-name font-24-lh-28-medium">--}}
                                {{--                          {{__('Engagement')}}--}}
                                {{--                        </p>--}}
                                {{--                        <div class="dashboard-template-icon">--}}
                                {{--                          <svg width="20" height="20" viewBox="0 0 50 50">--}}
                                {{--                            <g id="Boundary" stroke="rgba(0,0,0,0)" stroke-width="1" opacity="0">--}}
                                {{--                              <rect width="50" height="50" stroke="none"/>--}}
                                {{--                              <rect x="0.5" y="0.5" width="49" height="49" fill="none"/>--}}
                                {{--                            </g>--}}
                                {{--                            <g class="dashboard-logo-facebook" transform="translate(0 0.175)">--}}
                                {{--                              <path class="dashboard-logo-facebook" d="M49.649-1340.425a24.864,24.864,0,0,0-24.825-24.9A24.864,24.864,0,0,0,0-1340.425a24.886,24.886,0,0,0,20.946,24.6v-17.4h-6.3v-7.2h6.3v-5.487c0-6.241,3.706-9.689,9.377-9.689a38.026,38.026,0,0,1,5.557.487v6.128h-3.13c-3.084,0-4.046,1.92-4.046,3.889v4.672h6.885l-1.1,7.2H28.7v17.4a24.886,24.886,0,0,0,20.946-24.6" transform="translate(0 1365.33)" fill="#1877f2"/>--}}
                                {{--                            </g>--}}
                                {{--                          </svg>--}}
                                {{--                        </div>--}}
                                {{--                      </a>--}}
                                {{--                      <div class="dashboard-orange-line"></div>--}}
                                {{--                    </li>--}}
                                {{--                    @endif--}}

                                {{--                    @if(Auth::user() && Auth::user()->company->social_account_twitter->isNotEmpty())--}}
                                {{--                    <li class="dashboard-templates-list-item" id="twitter-overview-item">--}}
                                {{--                      <a href="{{url('dashboard/twitter-overview')}}" class="dashboard-template-link">--}}
                                {{--                        <p class="dashboard-template-name font-24-lh-28-medium">--}}
                                {{--                          {{__('Twitter')}}--}}
                                {{--                        </p>--}}
                                {{--                        <div class="dashboard-template-icon">--}}
                                {{--                          <svg width="20" height="20" viewBox="0 0 24 24">--}}
                                {{--                            <g id="Boundary" transform="translate(0)" stroke="rgba(0,0,0,0)" stroke-width="1" opacity="0">--}}
                                {{--                              <rect width="24" height="24" stroke="none"/>--}}
                                {{--                              <rect x="0.5" y="0.5" width="23" height="23" fill="none"/>--}}
                                {{--                            </g>--}}
                                {{--                            <path class="dashboard-logo-twitter" data-name="Path 40865" d="M547.729,589.354a13.915,13.915,0,0,0,14.01-14.01q0-.32-.014-.636a10.014,10.014,0,0,0,2.456-2.55,9.82,9.82,0,0,1-2.828.775,4.942,4.942,0,0,0,2.165-2.723,9.875,9.875,0,0,1-3.127,1.2A4.928,4.928,0,0,0,552,575.9a13.981,13.981,0,0,1-10.15-5.145,4.928,4.928,0,0,0,1.524,6.574,4.888,4.888,0,0,1-2.23-.616c0,.021,0,.041,0,.063a4.925,4.925,0,0,0,3.95,4.827,4.917,4.917,0,0,1-2.224.085,4.929,4.929,0,0,0,4.6,3.42,9.878,9.878,0,0,1-6.116,2.108,10.008,10.008,0,0,1-1.174-.068,13.938,13.938,0,0,0,7.548,2.212" transform="translate(-540.181 -567.602)" fill="#1da1f2"/>--}}
                                {{--                          </svg>--}}

                                {{--                        </div>--}}
                                {{--                      </a>--}}
                                {{--                      <div class="dashboard-orange-line"></div>--}}
                                {{--                    </li>--}}
                                {{--                    @endif--}}

                                {{--                    @if(Auth::user() && Auth::user()->company->social_account_instagram->isNotEmpty())--}}
                                {{--                    <li class="dashboard-templates-list-item" id="instagram-overview-item">--}}
                                {{--                      <a href="{{url('dashboard/instagram-overview')}}" class="dashboard-template-link">--}}
                                {{--                        <p class="dashboard-template-name font-24-lh-28-medium">--}}
                                {{--                          {{__('Instagram')}}--}}
                                {{--                        </p>--}}
                                {{--                        <div class="dashboard-template-icon">--}}
                                {{--                          <svg width="20" height="20" viewBox="0 0 24 24">--}}
                                {{--                            <defs>--}}
                                {{--                              <radialGradient id="radial-gradient" cx="0.266" cy="1.077" r="0.991" gradientUnits="objectBoundingBox">--}}
                                {{--                                <stop offset="0" stop-color="#fd5"/>--}}
                                {{--                                <stop offset="0.1" stop-color="#fd5"/>--}}
                                {{--                                <stop offset="0.5" stop-color="#ff543e"/>--}}
                                {{--                                <stop offset="1" stop-color="#c837ab"/>--}}
                                {{--                              </radialGradient>--}}
                                {{--                              <radialGradient id="radial-gradient-2" cx="-0.168" cy="0.072" r="0.443" gradientUnits="objectBoundingBox">--}}
                                {{--                                <stop offset="0" stop-color="#3771c8"/>--}}
                                {{--                                <stop offset="0.128" stop-color="#3771c8"/>--}}
                                {{--                                <stop offset="1" stop-color="#60f" stop-opacity="0"/>--}}
                                {{--                              </radialGradient>--}}
                                {{--                            </defs>--}}
                                {{--                            <g id="Boundary" transform="translate(0)" stroke="rgba(0,0,0,0)" stroke-width="1" opacity="0">--}}
                                {{--                              <rect width="24" height="24" stroke="none"/>--}}
                                {{--                              <rect x="0.5" y="0.5" width="23" height="23" fill="none"/>--}}
                                {{--                            </g>--}}
                                {{--                            <g id="Group_57664" data-name="Group 57664" transform="translate(-1629.533 -478.042)">--}}
                                {{--                              <path class="dashboard-logo-instagram" data-name="Path 34782" d="M12,0c-5.01,0-6.475.005-6.76.029A5.954,5.954,0,0,0,2.876.623,4.79,4.79,0,0,0,1.5,1.632,5.15,5.15,0,0,0,.107,4.551,21.656,21.656,0,0,0,0,8.093c0,.955,0,2.213,0,3.9C0,17,0,18.462.027,18.746A6.027,6.027,0,0,0,.6,21.064a5.055,5.055,0,0,0,3.276,2.676,8.514,8.514,0,0,0,1.742.231c.3.013,3.326.022,6.357.022s6.062,0,6.351-.018a8.2,8.2,0,0,0,1.805-.236,5.024,5.024,0,0,0,3.276-2.682,5.928,5.928,0,0,0,.566-2.273c.016-.207.023-3.5.023-6.794s-.007-6.582-.024-6.789A5.862,5.862,0,0,0,23.4,2.9,4.756,4.756,0,0,0,22.369,1.5,5.181,5.181,0,0,0,19.447.11,21.626,21.626,0,0,0,15.906,0Z" transform="translate(1629.536 478.042)" fill="url(#radial-gradient)"/>--}}
                                {{--                              <path class="dashboard-logo-instagram" data-name="Path 34783" d="M12,0c-5.01,0-6.475.005-6.76.029A5.954,5.954,0,0,0,2.876.623,4.79,4.79,0,0,0,1.5,1.632,5.15,5.15,0,0,0,.107,4.551,21.656,21.656,0,0,0,0,8.093c0,.955,0,2.213,0,3.9C0,17,0,18.462.027,18.746A6.027,6.027,0,0,0,.6,21.064a5.055,5.055,0,0,0,3.276,2.676,8.514,8.514,0,0,0,1.742.231c.3.013,3.326.022,6.357.022s6.062,0,6.351-.018a8.2,8.2,0,0,0,1.805-.236,5.024,5.024,0,0,0,3.276-2.682,5.928,5.928,0,0,0,.566-2.273c.016-.207.023-3.5.023-6.794s-.007-6.582-.024-6.789A5.862,5.862,0,0,0,23.4,2.9,4.756,4.756,0,0,0,22.369,1.5,5.181,5.181,0,0,0,19.447.11,21.626,21.626,0,0,0,15.906,0Z" transform="translate(1629.536 478.042)" fill="url(#radial-gradient-2)"/>--}}
                                {{--                              <path class="dashboard-logo-instagram-background-fill" data-name="Path 34784" d="M26.861,18c-2.406,0-2.708.011-3.653.054a6.5,6.5,0,0,0-2.15.412,4.532,4.532,0,0,0-2.592,2.591,6.472,6.472,0,0,0-.412,2.15c-.042.945-.053,1.247-.053,3.653s.011,2.707.054,3.652a6.511,6.511,0,0,0,.412,2.15,4.534,4.534,0,0,0,2.591,2.592,6.507,6.507,0,0,0,2.151.412c.945.043,1.247.054,3.653.054s2.707-.011,3.652-.054a6.511,6.511,0,0,0,2.151-.412,4.539,4.539,0,0,0,2.591-2.592,6.567,6.567,0,0,0,.412-2.15c.042-.945.054-1.246.054-3.652s-.011-2.708-.054-3.653a6.564,6.564,0,0,0-.412-2.15,4.533,4.533,0,0,0-2.592-2.591,6.522,6.522,0,0,0-2.152-.412c-.945-.043-1.246-.054-3.653-.054Zm-.795,1.6h.795c2.366,0,2.646.008,3.58.051a4.905,4.905,0,0,1,1.645.305,2.936,2.936,0,0,1,1.681,1.682,4.9,4.9,0,0,1,.305,1.645c.042.934.052,1.215.052,3.579s-.009,2.645-.052,3.579a4.9,4.9,0,0,1-.305,1.645,2.938,2.938,0,0,1-1.681,1.68,4.887,4.887,0,0,1-1.645.305c-.934.042-1.215.052-3.58.052s-2.646-.009-3.58-.052a4.915,4.915,0,0,1-1.645-.305,2.935,2.935,0,0,1-1.682-1.681,4.9,4.9,0,0,1-.305-1.645c-.042-.934-.051-1.215-.051-3.58s.008-2.645.051-3.579a4.905,4.905,0,0,1,.305-1.645,2.936,2.936,0,0,1,1.682-1.682,4.894,4.894,0,0,1,1.645-.305c.817-.037,1.134-.048,2.785-.05Zm5.524,1.471a1.063,1.063,0,1,0,1.063,1.063,1.063,1.063,0,0,0-1.063-1.063ZM26.861,22.31a4.549,4.549,0,1,0,4.549,4.55,4.55,4.55,0,0,0-4.549-4.55Zm0,1.6a2.953,2.953,0,1,1-2.953,2.953A2.953,2.953,0,0,1,26.861,23.907Z" transform="translate(1614.671 463.179)" fill="#fff"/>--}}
                                {{--                            </g>--}}
                                {{--                          </svg>--}}

                                {{--                        </div>--}}
                                {{--                      </a>--}}
                                {{--                      <div class="dashboard-orange-line"></div>--}}
                                {{--                    </li>--}}
                                {{--                    @endif--}}

                                <li class="dashboard-templates-list-item dashboard-template-desktop-item">
                                    <p class="dashboard-templates-message font-24-lh-28-medium">
                                        {{__('You have no dashboards')}}
                                    </p>
                                </li>

                                <li class="dashboard-templates-list-item dashboard-template-desktop-item active">
                                    <a href="{{url('/dashboard/connections')}}" class="dashboard-template-add-button">
                                        <p class="dashboard-template-add-button-text font-24-lh-28-medium">
                                            {{__('Add Dashboard')}}
                                        </p>
                                    </a>
                                </li>
                            </ul>

                            <a class="dashboard-add-template-button"
                               href="{{url('/dashboard/templates')}}"
                            ></a>

                            <button class="dashboard-mobile-menu-button font-20-lh-25-medium">
                                {{__('Show list of dashboards')}}
                            </button>
                        </div>
                        @if((Auth::user()->company?->social_account_facebook->isNotEmpty()
                                    || Auth::user()->company?->social_account_facebook_ads->isNotEmpty()
                                    || Auth::user()->company?->social_account_twitter->isNotEmpty()
                                    || Auth::user()->company?->social_account_instagram->isNotEmpty()
                                    || Auth::user()->company?->social_account_google_analytics->isNotEmpty()
                                    || Auth::user()->company?->social_account_google_ads->isNotEmpty()) && !empty($template_name))
                            <div class="dashboard-period-picker">
                                <div class="dashboard-selected-period-block">
                                    <p id="dashboard-period-name" class="dashboard-period-name font-13-lh-15-light"></p>
                                    <p id="dashboard-selected-period"
                                       class="dashboard-selected-period font-13-lh-15-medium"></p>
                                    {{-- <p id='out'></p> --}}
                                </div>

                                <div class="d-flex align-items-center" style="gap: 10px">
                                    <div class="dashboard-calendar-button">
                                        <input class="dashboard-calendar-pop-up" type="date" id="datetime-picker">
                                    </div>

                                    <div class="dashboard-settings-button">
                                        <div class="dashboard-settings-pop-up hidden">
                                            <ul class="dashboard-settings-list">
                                                @if(!empty($template_name))
                                                    <li class="dashboard-settings-item pdf">
                                                        @if(request()->get('date_from'))
                                                            <a href="{{url('/generate-pdf/'.$template_name.'/'.$dashId).'?lang=en&date1='.request()->get('date_from').'&date2='.request()->get('date_to').'&account='.$connect_name}}"
                                                               class="dashboard-settings-link font-17-lh-20-medium"
                                                               id="downloadPdf" tabindex="-1">
                                                                {{__('Download PDF')}}
                                                            </a>
                                                        @else
                                                            <a href="{{url('/generate-pdf/'.$template_name.'/'.$dashId.'?lang=en&account='.$connect_name)}}"
                                                               class="dashboard-settings-link font-17-lh-20-medium"
                                                               id="downloadPdf" tabindex="-1">
                                                                {{__('Download PDF')}}
                                                            </a>
                                                        @endif
                                                    </li>
                                                    <div
                                                        class="pdf-tooltip">{{__('If you`re having trouble with pdf generating, try to restart your browser')}}</div>
                                                @endif
                                                @if(!empty($social_accounts) && count($social_accounts) > 0)
                                                    <li class="dashboard-settings-item multilevel">
                                                        <a href="#" class="dashboard-settings-link font-17-lh-20-medium"
                                                           tabindex="-1">
                                                            {{__('Switch User')}}
                                                        </a>
                                                        @if(!empty($social_accounts))
                                                            <ul class="dashboard-settings-list multilevel-item dashboard-settings-pop-up">
                                                                @foreach($social_accounts as $acc)
                                                                    {{--                                    @if($template_name == 'twitter-overview')--}}
                                                                    <li class="dashboard-settings-item">
                                                                        <a href="{{url('/switch-account') .'/'.$template_name.'/'.$acc->id}}"
                                                                           class="dashboard-settings-link font-17-lh-20-medium"
                                                                           tabindex="-1">
                                                                            {{$acc->full_name}}
                                                                        </a>
                                                                    </li>
                                                                    {{--                                    @else--}}
                                                                    {{--                                    <li class="dashboard-settings-item multilevel-2">--}}
                                                                    {{--                                        <a href="#" class="dashboard-settings-link font-17-lh-20-medium" tabindex="-1">--}}
                                                                    {{--                                            {{$acc->full_name}}--}}
                                                                    {{--                                        </a>--}}
                                                                    {{--                                        <ul class="dashboard-settings-list multilevel-item-2 dashboard-settings-pop-up">--}}
                                                                    {{--                                            @foreach($acc->page as $page)--}}
                                                                    {{--                                                <li class="dashboard-settings-item">--}}
                                                                    {{--                                                    <a href="/switch/{{$template_name}}/{{$page->id}}" class="dashboard-settings-link font-17-lh-20-medium" tabindex="-1">--}}
                                                                    {{--                                                        {{$page->name}}--}}
                                                                    {{--                                                    </a>--}}
                                                                    {{--                                                </li>--}}
                                                                    {{--                                            @endforeach--}}
                                                                    {{--                                        </ul>--}}
                                                                    {{--                                    </li>--}}
                                                                    {{--                                    @endif--}}
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endif
                                                <li class="dashboard-settings-item">
                                                    <a href="#" class="dashboard-settings-link font-17-lh-20-medium"
                                                       tabindex="-1">
                                                        {{__('Refresh data')}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- TODO: List of connections with selection --}}
                    @if(!empty($page))
                        <div class="dashboard-page-picker">
                            <div class="content-wrapper">
                                <div class="">
                                    <div class="page-select font-17-lh-20-medium">
                                        <span style="display: block; position: relative;">{{$page->name != "" ? $page->name : $page->provider_id}}<span
                                                class="active-page"></span></span>
                                    </div>
                                    @if($pages->count() > 0)
                                        @foreach($pages as $item)
                                            @if(!empty(Request::get('date_from')))
                                                <a href="{{url('/switch-account') .'/'.$template_name.'/'.$item->social_account_id.'/'.$item->id.'?date_from='.Request::get('date_from').'&date_to='.Request::get('date_to')}}"
                                                   class="page-select font-17-lh-20-medium">
                                                    {{$item->name != "" ? $item->name : $item->provider_id}}
                                                </a>
                                            @elseif(isset($item->google_analytics_account_id))
                                                <a href="{{url('/switch-account') .'/'.$template_name.'/'.$item->account->social_account_id.'/'.$item->id}}"
                                                   class="page-select font-17-lh-20-medium">
                                                    {{$item->name != "" ? $item->name : $item->provider_id}}
                                                </a>
                                            @else
                                                <a href="{{url('/switch-account') .'/'.$template_name.'/'.$item->social_account_id.'/'.$item->id}}"
                                                   class="page-select font-17-lh-20-medium">
                                                    {{$item->name != "" ? $item->name : $item->provider_id}}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    {{--<div class="wrapper-trial-new">
                        @include('tenant.components.trial-banner')
                    </div>--}}
                </div>
            </div>
            
        </header>
        <!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>

            let df = '{{Request::get('date_from')}}';
            let minDateFrom = @if(!empty($minDateFrom)) "{{$minDateFrom}}"
            @else null @endif;
            let date_from = @if(!empty($date_from)) "{{$date_from}}"
            @else null @endif;
            let date_to = @if(!empty($date_to)) '{{$date_to}}'
            @else null @endif;
            const locale = '{{Lang::getLocale()}}';
            const date = new Date();
            const year = date.getFullYear().toString();
            const month = (date.getMonth() + 1).toString().padStart(2, 0);
            const day = date.getDate().toString().padStart(2, 0);
            const newDate = `${year}/${month}/${day}`;

            const thirtyDaysMs = 1000 * 60 * 60 * 24 * (30 - 1);
            const minusThirty = date - thirtyDaysMs;

            const fullDate = new Date(minusThirty);

            const year1 = fullDate.getFullYear().toString();
            const month1 = (fullDate.getMonth() + 1).toString().padStart(2, 0);
            const day1 = fullDate.getDate().toString().padStart(2, 0);
            const fullDateMinusThirty = `${year1}/${month1}/${day1}`;
            let defaultDate = date_from ? [`${date_from}`, `${date_to}`] : [`${newDate}`, `${fullDateMinusThirty}`];
            const options = {
                mode: "range",
                maxDate: `${newDate}`,
                minDate: `${minDateFrom}`,
                defaultDate: defaultDate,
                dateFormat: "Y/m/d",
                locale: {
                    weekdays: {
                        shorthand: [
                            '{{__("Sun")}}', '{{__("Mon")}}', '{{__("Tue")}}',
                            '{{__("Wed")}}', '{{__("Thu")}}', '{{__("Fri")}}', '{{__("Sat")}}'
                        ],
                        longhand: [
                            '{{__("Sunday")}}', '{{__("Monday")}}', '{{__("Tuesday")}}',
                            '{{__("Wednesday")}}', '{{__("Thursday")}}', '{{__("Friday")}}', '{{__("Saturday")}}'
                        ],
                    },
                    months: {
                        shorthand: [
                            '{{__("Jan")}}', '{{__("Feb")}}', '{{__("Mar")}}', '{{__("Apr")}}', '{{__("May")}}',
                            '{{__("Jun")}}', '{{__("Jul")}}', '{{__("Aug")}}', '{{__("Sep")}}', '{{__("Oct")}}',
                            '{{__("Nov")}}', '{{__("Dec")}}'
                        ],
                        longhand: [
                            '{{__("January")}}', '{{__("February")}}', '{{__("March")}}', '{{__("April")}}', '{{__("May")}}',
                            '{{__("June")}}', '{{__("July")}}', '{{__("August")}}', '{{__("September")}}', '{{__("October")}}',
                            '{{__("November")}}', '{{__("December")}}'
                        ]
                    }
                },
                showMonths: 1,
                shorthandCurrentMonth: true,
                monthSelectorType: "dropdown",
                onChange: [function (selectedDates) {
                    const dateArr = selectedDates.map(date => this.formatDate(date, "Y/m/d"));
                    if (dateArr.length === 2) {
                        setDateText(dateArr[0], dateArr[1], false);
                        switch ("{{$template_name}}") {
                            case 'twitter-overview':
                                window.location.assign('/dashboard/twitter-overview?date_from=' + dateArr[0] + '&date_to=' + dateArr[1])
                                break;
                            case 'facebook-overview':
                                window.location.assign('/dashboard/facebook-overview?date_from=' + dateArr[0] + '&date_to=' + dateArr[1])
                                break;
                            case 'facebook-engagement':
                                window.location.assign('/dashboard/facebook-engagement?date_from=' + dateArr[0] + '&date_to=' + dateArr[1])
                                break;
                            case 'facebook-ads-overview':
                                window.location.assign('/dashboard/facebook-ads-overview?date_from=' + dateArr[0] + '&date_to=' + dateArr[1])
                                break;
                            case 'instagram-overview':
                                window.location.assign('/dashboard/instagram-overview?date_from=' + dateArr[0] + '&date_to=' + dateArr[1])
                                break;
                            case 'google-analytics-overview':
                                window.location.assign('/dashboard/google-analytics-overview?date_from=' + dateArr[0] + '&date_to=' + dateArr[1])
                                break;
                            case 'google-ads-overview':
                                window.location.assign('/dashboard/google-ads-overview?date_from=' + dateArr[0] + '&date_to=' + dateArr[1])
                                break;
                            default:
                                window.location.assign('/dashboard/facebook-overview?date_from=' + dateArr[0] + '&date_to=' + dateArr[1])
                        }
                    } else {
                        setDateText('', '', false)
                        setDateText(date_from, date_to, true)
                    }
                }]
            };
            let calendar = flatpickr('#datetime-picker', options);
            df == '' ? calendar.changeMonth(1) : '';

            if (date_from && date_to) {
                setDateText(date_from, date_to, true)
            }

            function setDateText(from, to, isAppend) {
                if (!!from && !!to) {
                    const start = new Date(from);
                    const end = new Date(to);
                    const days = from && to ? Math.round(((end - start) / 1000 / 60 / 60 / 24)) + 1 : 0;
                    const periodName = `{{ __('Last :days days', ['days' => '${days}']) }}`;
                    const period = from && to ? `{{ __(':from to :to', ['from' => '${from}', 'to' => '${to}']) }}` : '';
                    if (isAppend) {
                        document.querySelector('#dashboard-period-name').append(periodName);
                        document.querySelector('#dashboard-selected-period').append(period);
                    } else {
                        $('#dashboard-period-name').text(periodName);
                        $('#dashboard-selected-period').text(period);
                    }
                } else {
                    document.querySelector('#dashboard-period-name').empty();
                    document.querySelector('#dashboard-selected-period').empty();
                }
            }

        </script> -->
        
        <main class="dashboard-main">

            <div style="@if(auth()->user()->company->onTrial() && !auth()->user()->company->subscriptions()->first()) margin-top: 170px; @endif"
                class="dashboard-main-content-wrapper {{auth()->user()->company->onTrial() ? '' : 'dashboard-main-without-content-wrapper'}} {{auth()->user()->company->onTrial() && Request::path() == 'dashboard/twitter-overview' ? 'dashboard-main-with-ban-twit' : ''}} {{Request::path() == 'dashboard/twitter-overview' ? 'dashboard-main-content-wrap' : ''}}">
                @if($template_name == 'twitter-overview')
                    @include('tenant.components.twitter-overview')
                @elseif($template_name == 'facebook-overview')
                    @include('tenant.components.facebook-overview')
                @elseif($template_name == 'google-analytics-overview')
                    @include('tenant.components.google-analytics-overview')
                @elseif($template_name == 'google-ads-overview')
                    @include('tenant.components.google-ads')
                @elseif($template_name == 'facebook-engagement')
                    @include('tenant.components.facebook-engagement')
                @elseif($template_name == 'facebook-ads-overview')
                    @include('tenant.components.facebook-ads')
                @elseif($template_name == 'instagram-overview')
                    @include('tenant.components.instagram')
                @else
                    @include('tenant.components.empty-dashboard')
                @endif
            </div>
        </main>
    </div>

    @include('frontend.components.loader')

    <script>
        // Elements

        const instagramOverviewItem = document.querySelector('#instagram-overview-item');
        const facebookAdsItem = document.querySelector('#facebook-ads-item');
        const facebookEngagementItem = document.querySelector('#facebook-engagement-item');
        const facebookOverviewItem = document.querySelector('#facebook-overview-item');
        const twitterOverviewItem = document.querySelector('#twitter-overview-item');
        const googleAdsOverviewItem = document.querySelector('#google-ads-overview-item');
        const googleAnalyticsOverviewItem = document.querySelector('#google-analytics-overview-item');
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
                break

            case "/dashboard/google-ads-overview":
                googleAdsOverviewItem.classList.add('active');
                break;

            case "/dashboard/google-analytics-overview":
                googleAnalyticsOverviewItem.classList.add('active');
                break;

            default:
                break;
        }

    </script>

@endsection
@section('js')
<script type="text/javascript">
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#selected-range').html(start.format('D/M/YYYY') + ' - ' + end.format('D/M/YYYY'));
                var start = moment(start);
                var end   = moment(end);
                var diff = end.diff(start, 'days');
                $('#selected-days-count').html('{{__('Last')}} '+diff+' {{__('days')}}');
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            alwaysShowCalendars:true,
            autoApply:true,
            ranges: {
            '{{__('Last 7 Days')}}': [moment().subtract(7, 'days'), moment()],
            '{{__('Last 30 Days')}}': [moment().subtract(29, 'days'), moment()],
            '{{__('Last 90 Days')}}': [moment().subtract(90, 'days'), moment()],
            '{{__('This Month')}}': [moment().startOf('month'), moment().endOf('month')],
            '{{__('Last Month')}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>
@endsection
