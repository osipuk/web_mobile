@extends('layout.v2.tenant.head')
@php
$get_locale=checkLangaugeGlobaly();
@endphp
@section('metahead')

<link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}" />
@endsection
@section('title', '__("User Billing")')
@section('content')
<div class="loader d-none">
    <div class="loader-background"></div>
    <div class="loader-logo"></div>
    <p class="loader-text font-18-lh-22-regular">{{__('Loading...')}}</p>
</div>
<div class="page-wrapper chiller-theme toggled">
    @include('layout.v2.tenant.sidebar')
    <div id="main-section" class="w-100 addpaddingforhome">
        @include('layout.v2.tenant.header',['heading'=>__('Settings')])
        <div class="setting-header-tabs-links">
            <div class="mx-3 mx-sm-5 py-2 py-md-0">
                <div class="d-flex flex-row align-items-center setting-options-tabs">
                    <a href="{{url('dashboard/user-profile')}}" class="text-decoration-none setting-options-tab-normal">
                        {{__('Profile')}}
                    </a>
                    <a href="{{url('dashboard/user-billing')}}" class="text-decoration-none primary-text-color setting-options-tab-active">
                        {{__('Billing')}}
                        <div class="setting-active-bottom-line"></div>
                    </a>
                    <a href="{{url('dashboard/user-team')}}" class="text-decoration-none setting-options-tab-normal">
                        {{__('Users')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="mx-3 mx-sm-5 py-4">
            <div class="row">
                <div class="d-none d-md-inline col-12 col-xl-8">
                    <div class="billing-package-container">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <p class="m-0 billing-package-container-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Your Subscription')}}</p>
                            <button type="button" onclick="openManageSubscription()" class="border-0 bg-transparent p-0">
                                <span class="billing-package-container-edit-btn @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Edit Subscription')}}</span>
                            </button>
                        </div>
                        @if($subscription_data || Auth::user()->trial())
                        <div class="d-flex flex-row align-items-start justify-content-start billing-package-selected-wrapper">
                            <div>
                                <svg width="34" height="41" viewBox="0 0 34 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.6202 38.9854C30.0393 39.4598 29.3739 39.8084 28.6629 40.011C27.952 40.2136 27.2096 40.2661 26.4791 40.1654C25.7485 40.0648 25.0444 39.8131 24.4077 39.4249C23.7711 39.0367 23.2146 38.5198 22.7708 37.9043L2.9233 10.6198C2.01677 9.37151 1.61551 7.80028 1.80621 6.24518C1.99691 4.69007 2.76436 3.27574 3.94272 2.30738C4.52371 1.83319 5.18892 1.4847 5.89986 1.2822C6.6108 1.07969 7.35322 1.02722 8.08373 1.12783C8.81424 1.22844 9.51828 1.48014 10.1549 1.86825C10.7916 2.25636 11.3481 2.77312 11.792 3.38847L31.6395 30.6729C32.546 31.9212 32.9473 33.4925 32.7566 35.0476C32.5659 36.6027 31.7986 38.0171 30.6202 38.9854Z" fill="#F2C5A7" />
                                    <path d="M6.61662 40.4973C4.912 40.5478 3.2579 39.8883 2.0174 38.6639C0.776895 37.4394 0.0513167 35.7499 0 33.9663V7.03373C0.051016 5.24995 0.776407 3.56028 2.01698 2.33575C3.25755 1.11122 4.91192 0.451961 6.61662 0.502729C8.32124 0.452281 9.97534 1.11166 11.2158 2.33612C12.4563 3.56058 13.1818 5.25005 13.2331 7.03373V33.9663C13.1818 35.7499 12.4563 37.4394 11.2158 38.6639C9.97534 39.8883 8.32124 40.5478 6.61662 40.4973Z" fill="#FF9A41" />
                                    <path d="M27.3831 40.4997C25.6283 40.4997 23.9453 39.7702 22.7044 38.4718C21.4636 37.1733 20.7665 35.4122 20.7665 33.5759V16.1582C20.7665 14.3219 21.4636 12.5609 22.7044 11.2624C23.9453 9.96392 25.6283 9.23438 27.3831 9.23438C29.1379 9.23438 30.8208 9.96392 32.0616 11.2624C33.3025 12.5609 33.9996 14.3219 33.9996 16.1582V33.5759C33.9996 35.4122 33.3025 37.1733 32.0616 38.4718C30.8208 39.7702 29.1379 40.4997 27.3831 40.4997Z" fill="#FF9A41" />
                                </svg>
                            </div>
                            <div>
                                <p class="m-0 primary-text-color billing-package-name-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__($user_plan_name)}}</p>
                                <p class="m-0 billing-package-name-secondary-text">{{__('Number of connections') . ': ' . UserPlanHelper::subscription_info()->connections}}</p>
                            </div>
                        </div>
                        <p class="m-0 primary-text-color billing-package-name-connection-number @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                            @if($subscription_info)
                            ${{$subscription_info['next_payment_full']}}
                            @elseif(auth()->user()->company->onTrial())
                            {{__('The trial period will end in ')}} {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }} {{__('days')}}
                            @else
                            {{__('No plan')}}
                            @endif
                        </p>
                        @else
                        <div class="d-flex flex-row align-items-start justify-content-start billing-package-selected-wrapper">
                            <div>
                                <svg width="34" height="41" viewBox="0 0 34 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.6202 38.9854C30.0393 39.4598 29.3739 39.8084 28.6629 40.011C27.952 40.2136 27.2096 40.2661 26.4791 40.1654C25.7485 40.0648 25.0444 39.8131 24.4077 39.4249C23.7711 39.0367 23.2146 38.5198 22.7708 37.9043L2.9233 10.6198C2.01677 9.37151 1.61551 7.80028 1.80621 6.24518C1.99691 4.69007 2.76436 3.27574 3.94272 2.30738C4.52371 1.83319 5.18892 1.4847 5.89986 1.2822C6.6108 1.07969 7.35322 1.02722 8.08373 1.12783C8.81424 1.22844 9.51828 1.48014 10.1549 1.86825C10.7916 2.25636 11.3481 2.77312 11.792 3.38847L31.6395 30.6729C32.546 31.9212 32.9473 33.4925 32.7566 35.0476C32.5659 36.6027 31.7986 38.0171 30.6202 38.9854Z" fill="#F2C5A7" />
                                    <path d="M6.61662 40.4973C4.912 40.5478 3.2579 39.8883 2.0174 38.6639C0.776895 37.4394 0.0513167 35.7499 0 33.9663V7.03373C0.051016 5.24995 0.776407 3.56028 2.01698 2.33575C3.25755 1.11122 4.91192 0.451961 6.61662 0.502729C8.32124 0.452281 9.97534 1.11166 11.2158 2.33612C12.4563 3.56058 13.1818 5.25005 13.2331 7.03373V33.9663C13.1818 35.7499 12.4563 37.4394 11.2158 38.6639C9.97534 39.8883 8.32124 40.5478 6.61662 40.4973Z" fill="#FF9A41" />
                                    <path d="M27.3831 40.4997C25.6283 40.4997 23.9453 39.7702 22.7044 38.4718C21.4636 37.1733 20.7665 35.4122 20.7665 33.5759V16.1582C20.7665 14.3219 21.4636 12.5609 22.7044 11.2624C23.9453 9.96392 25.6283 9.23438 27.3831 9.23438C29.1379 9.23438 30.8208 9.96392 32.0616 11.2624C33.3025 12.5609 33.9996 14.3219 33.9996 16.1582V33.5759C33.9996 35.4122 33.3025 37.1733 32.0616 38.4718C30.8208 39.7702 29.1379 40.4997 27.3831 40.4997Z" fill="#FF9A41" />
                                </svg>
                            </div>
                            <div>
                                <p class="m-0 primary-text-color billing-package-name-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('No plan')}}</p>
                                <p class="m-0 billing-package-name-secondary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Number of connections')}}: 0 </p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-xxl-6">
                            <div class="d-flex flex-column align-item-center mt-4 bg-white billing-features-container">
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <p class="m-0 billing-features-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Features')}}</p>
                                    <button type="button" onclick="openManageSubscription()" class="border-0 bg-transparent text-decoration-none billing-features-upgrade @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Upgrade')}}</button>
                                </div>
                                <div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Number of Users')}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                            @if($user_plan_name == 'Essentials Plan' || $user_plan_name == 'Trial')
                                            5
                                            @elseif($user_plan_name == 'Plus Plan' || $user_plan_name == 'Enterprise Plan')
                                            {{__("Unlimited")}}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row billing-feature-row-active">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Minimum Connection")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value ">{{$number_of_links}}</p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Data Guarantee")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value">
                                            &nbsp;
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row billing-feature-row-active">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Data Volume")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                        @if($user_plan_name == 'Essentials Plan')
                                        {{__("10 Gig")}}
                                        @elseif($user_plan_name == 'Plus Plan' || $user_plan_name == 'Enterprise Plan')
                                        &nbsp;
                                        @else
                                        {{__("Unlimited")}}
                                        @endif
                                        
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Roles & Permissions Control")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value">
                                            @if($user_plan_name == 'Essentials Plan' || $user_plan_name == 'Plus Plan')
                                                &nbsp;
                                            @elseif($user_plan_name == 'Enterprise Plan')
                                                &nbsp;
                                            @else
                                                &nbsp;
                                            @endif 
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row billing-feature-row-active">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Custom Dashboards')}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                        @if($user_plan_name == 'Essentials Plan')
                                        -
                                        @elseif($user_plan_name == 'Plus Plan')
                                        {{__('Per Connection')}}
                                        @elseif($user_plan_name == 'Enterprise Plan')
                                        {{__("Unlimited")}}
                                        @else
                                        -
                                        @endif
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Prebuilt Templates")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                        @if($user_plan_name == 'Trial')
                                        -
                                        @else
                                        {{__("Unlimited")}}
                                        @endif 
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row billing-feature-row-active">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Knowledge Base")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value">
                                        @if($user_plan_name == 'Trial')
                                        -
                                        @else
                                        &nbsp;
                                        @endif 
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Guided Setup ")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value">
                                        
                                        &nbsp;
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row billing-feature-row-active">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Live chat and Email Support")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value">
                                        &nbsp;
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Video Support")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value">
                                        &nbsp; 
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between billing-feature-row billing-feature-row-active">
                                        <div class="d-flex flex-row align-items-center justify-content-start p-0 billing-feature-row-sub-wrapper">
                                            <span>
                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.9545 9.02571C5.36109 8.5058 3.29868 6.74368 0 7.56241C0 7.56241 3.88171 9.68478 6.31752 14.5C8.36373 10.2114 11.638 3.72302 15.5713 0.5C9.57113 2.98298 6.61072 7.72832 5.9545 9.02593V9.02571Z" fill="#2DA771" />
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color billing-feature-row-lable @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Monthly team Training')}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color billing-feature-row-value">
                                        &nbsp;
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xxl-6">
                            <div class="mt-4 bg-white billing-history-container">
                                <p class="m-0 billing-history-container-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Billing History')}}</p>
                                <!-- <div class="my-4">
                                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.6666 56H54.1331C54.6181 56 55.0843 55.8108 55.4322 55.4733C55.7806 55.1354 55.9835 54.6754 55.9985 54.1905C56.0135 53.7059 55.8389 53.2342 55.5118 52.8755C49.8152 46.641 46.6594 38.499 46.6664 30.0532V5.59997C46.6648 4.11539 46.0744 2.69161 45.0243 1.64213C43.9747 0.592125 42.5509 0.00170666 41.0665 0H5.59997C4.93289 0 4.31667 0.355828 3.98333 0.933329C3.65 1.51083 3.65 2.2225 3.98333 2.79999C4.31667 3.37748 4.93291 3.73332 5.59997 3.73332H41.0665C41.5615 3.73373 42.036 3.93082 42.386 4.2804C42.7356 4.63039 42.9327 5.10498 42.9331 5.59996V30.0532C42.926 38.0423 45.4706 45.8248 50.1956 52.2664H18.6661C17.1816 52.2647 15.7578 51.6743 14.7083 50.6243C13.6583 49.5747 13.0679 48.1509 13.0662 46.6664V11.1999C13.0662 10.5329 12.7103 9.91664 12.1328 9.5833C11.5553 9.24997 10.8437 9.24997 10.2662 9.5833C9.68868 9.91664 9.33284 10.5329 9.33284 11.1999V46.6664C9.33575 49.141 10.3199 51.5131 12.0699 53.2627C13.8194 55.0126 16.1916 55.9968 18.6661 55.9997L18.6666 56Z" fill="#D0D8E3"/>
                                    <path d="M29.8665 39.2021H37.3331C38.0002 39.2021 38.6164 38.8462 38.9498 38.2687C39.2831 37.6912 39.2831 36.9796 38.9498 36.4021C38.6164 35.8246 38.0002 35.4688 37.3331 35.4688H29.8665C29.1994 35.4688 28.5832 35.8246 28.2499 36.4021C27.9165 36.9796 27.9165 37.6912 28.2499 38.2687C28.5832 38.8462 29.1994 39.2021 29.8665 39.2021Z" fill="#D0D8E3"/>
                                    <path d="M22.3999 46.663H37.3331C38.0002 46.663 38.6164 46.3072 38.9498 45.7297C39.2831 45.1522 39.2831 44.4405 38.9498 43.863C38.6164 43.2855 38.0002 42.9297 37.3331 42.9297H22.3999C21.7328 42.9297 21.1166 43.2855 20.7832 43.863C20.4499 44.4405 20.4499 45.1522 20.7832 45.7297C21.1166 46.3072 21.7328 46.663 22.3999 46.663Z" fill="#D0D8E3"/>
                                    <path d="M31.9571 26.1364H35.4662C36.1333 26.1364 36.7495 25.7806 37.0829 25.2031C37.4162 24.6256 37.4162 23.9139 37.0829 23.3364C36.7495 22.7589 36.1333 22.4031 35.4662 22.4031H31.9571C31.4413 22.4031 31.0238 21.9852 31.0238 21.4697C31.0238 20.9543 31.4413 20.5364 31.9571 20.5364H33.3755C35.043 20.5364 36.5834 19.6468 37.4172 18.2031C38.2509 16.7594 38.2509 14.9802 37.4172 13.5364C36.5834 12.0927 35.043 11.2031 33.3755 11.2031H29.8664C29.1993 11.2031 28.5831 11.559 28.2497 12.1365C27.9164 12.714 27.9164 13.4256 28.2497 14.0031C28.5831 14.5806 29.1993 14.9364 29.8664 14.9364H33.3755C33.8913 14.9364 34.3088 15.3544 34.3088 15.8698C34.3088 16.3852 33.8913 16.8031 33.3755 16.8031H31.9571C30.2896 16.8031 28.7493 17.6927 27.9155 19.1364C27.0817 20.5801 27.0817 22.3593 27.9155 23.8031C28.7492 25.2468 30.2896 26.1364 31.9571 26.1364Z" fill="#D0D8E3"/>
                                    <path d="M33.5998 13.0687C34.0948 13.0687 34.5698 12.872 34.9198 12.522C35.2698 12.172 35.4665 11.697 35.4665 11.202V9.33538C35.4665 8.6683 35.1106 8.05208 34.5331 7.71875C33.9556 7.38542 33.244 7.38542 32.6665 7.71875C32.089 8.05208 31.7331 8.66832 31.7331 9.33538V11.202C31.7331 11.697 31.9298 12.172 32.2798 12.522C32.6298 12.872 33.1048 13.0687 33.5998 13.0687Z" fill="#D0D8E3"/>
                                    <path d="M33.5998 29.865C34.0948 29.865 34.5698 29.6684 34.9198 29.3184C35.2698 28.9684 35.4665 28.4934 35.4665 27.9984V24.2651C35.4665 23.598 35.1106 22.9818 34.5331 22.6484C33.9556 22.3151 33.244 22.3151 32.6665 22.6484C32.089 22.9818 31.7331 23.598 31.7331 24.2651V27.9984C31.7331 28.4934 31.9298 28.9684 32.2798 29.3184C32.6298 29.6684 33.1048 29.865 33.5998 29.865Z" fill="#D0D8E3"/>
                                    <path d="M1.86664 13.0666H11.1999C11.6949 13.0666 12.1699 12.8699 12.5199 12.5199C12.8699 12.1699 13.0666 11.6949 13.0666 11.1999V7.46663C13.0645 5.48701 12.277 3.5891 10.8775 2.18911C9.47749 0.789543 7.57958 0.00202666 5.59996 0C4.11538 0.00166666 2.6916 0.592083 1.64211 1.64213C0.592112 2.6917 0.00169086 4.1155 -1.52588e-05 5.59997V11.1999C-1.52588e-05 11.6949 0.196655 12.1699 0.546649 12.5199C0.896642 12.8699 1.37165 13.0666 1.86664 13.0666ZM9.33327 9.33329H3.7333V5.59997C3.73372 5.10498 3.93039 4.6304 4.28038 4.28041C4.63037 3.93041 5.10496 3.73374 5.59995 3.73333C6.58993 3.73458 7.53871 4.12832 8.23866 4.82793C8.93824 5.52793 9.33198 6.47667 9.33326 7.46664L9.33327 9.33329Z" fill="#D0D8E3"/>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column align-items-start receipt-email-container">
                                    <p class="m-0 primary-text-color receipt-are-sent">Receipts are sent to:</p>
                                    <div class="d-flex flex-row receipt-email-and-change">
                                        <p class="m-0 primary-text-color receipt-sending-email">email@afdalanalytics.com</p>
                                        <button type="button" class="border-0 bg-transparent">
                                            <span class="change-receipt-btn">Change</span>
                                        </button>
                                    </div>
                                    
                                </div>
                                <div class="mt-3">
                                    <a href="#" class="text-decoration-none add-invoice-memo">Add invoice memo</a>
                                </div> -->
                                <div>
                                    @if($billing_history->isNotEmpty())
                                    @php $tablestripe = 1; @endphp
                                    @foreach($billing_history as $item)
                                    <div class="d-flex flex-row justify-content-between payment-invoices-row @if($tablestripe%2 == 0) payment-invoices-row-active @endif">
                                        <p class="m-0 primary-text-color payment-invoices-date">{{ $item->date }}</p>
                                        <div class="d-flex flex-row align-items-center justify-content-between payment-invoices-price-status">
                                            <p class="m-0 payment-invoices-price">${{ $item->amount }}</p>
                                            @if($item->status === 'paid' || 'APPROVED')
                                            <p class="m-0 payment-invoices-status @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('SUCCESSFUL')}}</p>
                                            @else
                                            <p class="m-0 payment-invoices-status-failed @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('FAILED')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    @php $tablestripe++; @endphp
                                    @endforeach
                                    @else
                                    <div class="my-4">
                                        <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.6666 56H54.1331C54.6181 56 55.0843 55.8108 55.4322 55.4733C55.7806 55.1354 55.9835 54.6754 55.9985 54.1905C56.0135 53.7059 55.8389 53.2342 55.5118 52.8755C49.8152 46.641 46.6594 38.499 46.6664 30.0532V5.59997C46.6648 4.11539 46.0744 2.69161 45.0243 1.64213C43.9747 0.592125 42.5509 0.00170666 41.0665 0H5.59997C4.93289 0 4.31667 0.355828 3.98333 0.933329C3.65 1.51083 3.65 2.2225 3.98333 2.79999C4.31667 3.37748 4.93291 3.73332 5.59997 3.73332H41.0665C41.5615 3.73373 42.036 3.93082 42.386 4.2804C42.7356 4.63039 42.9327 5.10498 42.9331 5.59996V30.0532C42.926 38.0423 45.4706 45.8248 50.1956 52.2664H18.6661C17.1816 52.2647 15.7578 51.6743 14.7083 50.6243C13.6583 49.5747 13.0679 48.1509 13.0662 46.6664V11.1999C13.0662 10.5329 12.7103 9.91664 12.1328 9.5833C11.5553 9.24997 10.8437 9.24997 10.2662 9.5833C9.68868 9.91664 9.33284 10.5329 9.33284 11.1999V46.6664C9.33575 49.141 10.3199 51.5131 12.0699 53.2627C13.8194 55.0126 16.1916 55.9968 18.6661 55.9997L18.6666 56Z" fill="#D0D8E3" />
                                            <path d="M29.8665 39.2021H37.3331C38.0002 39.2021 38.6164 38.8462 38.9498 38.2687C39.2831 37.6912 39.2831 36.9796 38.9498 36.4021C38.6164 35.8246 38.0002 35.4688 37.3331 35.4688H29.8665C29.1994 35.4688 28.5832 35.8246 28.2499 36.4021C27.9165 36.9796 27.9165 37.6912 28.2499 38.2687C28.5832 38.8462 29.1994 39.2021 29.8665 39.2021Z" fill="#D0D8E3" />
                                            <path d="M22.3999 46.663H37.3331C38.0002 46.663 38.6164 46.3072 38.9498 45.7297C39.2831 45.1522 39.2831 44.4405 38.9498 43.863C38.6164 43.2855 38.0002 42.9297 37.3331 42.9297H22.3999C21.7328 42.9297 21.1166 43.2855 20.7832 43.863C20.4499 44.4405 20.4499 45.1522 20.7832 45.7297C21.1166 46.3072 21.7328 46.663 22.3999 46.663Z" fill="#D0D8E3" />
                                            <path d="M31.9571 26.1364H35.4662C36.1333 26.1364 36.7495 25.7806 37.0829 25.2031C37.4162 24.6256 37.4162 23.9139 37.0829 23.3364C36.7495 22.7589 36.1333 22.4031 35.4662 22.4031H31.9571C31.4413 22.4031 31.0238 21.9852 31.0238 21.4697C31.0238 20.9543 31.4413 20.5364 31.9571 20.5364H33.3755C35.043 20.5364 36.5834 19.6468 37.4172 18.2031C38.2509 16.7594 38.2509 14.9802 37.4172 13.5364C36.5834 12.0927 35.043 11.2031 33.3755 11.2031H29.8664C29.1993 11.2031 28.5831 11.559 28.2497 12.1365C27.9164 12.714 27.9164 13.4256 28.2497 14.0031C28.5831 14.5806 29.1993 14.9364 29.8664 14.9364H33.3755C33.8913 14.9364 34.3088 15.3544 34.3088 15.8698C34.3088 16.3852 33.8913 16.8031 33.3755 16.8031H31.9571C30.2896 16.8031 28.7493 17.6927 27.9155 19.1364C27.0817 20.5801 27.0817 22.3593 27.9155 23.8031C28.7492 25.2468 30.2896 26.1364 31.9571 26.1364Z" fill="#D0D8E3" />
                                            <path d="M33.5998 13.0687C34.0948 13.0687 34.5698 12.872 34.9198 12.522C35.2698 12.172 35.4665 11.697 35.4665 11.202V9.33538C35.4665 8.6683 35.1106 8.05208 34.5331 7.71875C33.9556 7.38542 33.244 7.38542 32.6665 7.71875C32.089 8.05208 31.7331 8.66832 31.7331 9.33538V11.202C31.7331 11.697 31.9298 12.172 32.2798 12.522C32.6298 12.872 33.1048 13.0687 33.5998 13.0687Z" fill="#D0D8E3" />
                                            <path d="M33.5998 29.865C34.0948 29.865 34.5698 29.6684 34.9198 29.3184C35.2698 28.9684 35.4665 28.4934 35.4665 27.9984V24.2651C35.4665 23.598 35.1106 22.9818 34.5331 22.6484C33.9556 22.3151 33.244 22.3151 32.6665 22.6484C32.089 22.9818 31.7331 23.598 31.7331 24.2651V27.9984C31.7331 28.4934 31.9298 28.9684 32.2798 29.3184C32.6298 29.6684 33.1048 29.865 33.5998 29.865Z" fill="#D0D8E3" />
                                            <path d="M1.86664 13.0666H11.1999C11.6949 13.0666 12.1699 12.8699 12.5199 12.5199C12.8699 12.1699 13.0666 11.6949 13.0666 11.1999V7.46663C13.0645 5.48701 12.277 3.5891 10.8775 2.18911C9.47749 0.789543 7.57958 0.00202666 5.59996 0C4.11538 0.00166666 2.6916 0.592083 1.64211 1.64213C0.592112 2.6917 0.00169086 4.1155 -1.52588e-05 5.59997V11.1999C-1.52588e-05 11.6949 0.196655 12.1699 0.546649 12.5199C0.896642 12.8699 1.37165 13.0666 1.86664 13.0666ZM9.33327 9.33329H3.7333V5.59997C3.73372 5.10498 3.93039 4.6304 4.28038 4.28041C4.63037 3.93041 5.10496 3.73374 5.59995 3.73333C6.58993 3.73458 7.53871 4.12832 8.23866 4.82793C8.93824 5.52793 9.33198 6.47667 9.33326 7.46664L9.33327 9.33329Z" fill="#D0D8E3" />
                                        </svg>
                                    </div>
                                    <div class="d-flex flex-column align-items-start receipt-email-container">
                                        <p class="m-0 primary-text-color receipt-are-sent @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('You have not made any payments')}}</p>
                                    </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-inline d-md-none col-12">
                    <div>
                        <ul class="nav d-flex flex-row align-items-center p-0" style="gap:5px" data-bs-tabs="tabs">
                            <li class="nav-item d-flex flex-row align-items-start subscription-tab-li">
                                <a id="my-report-selector" class="nav-link active @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" data-bs-toggle="tab" href="#your-subscription">
                                    {{__('Your Subscription')}}
                                </a>
                            </li>
                            <li class="nav-item d-flex flex-row align-items-start subscription-tab-li">
                                <a id="add-report-selector" class="nav-link @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" data-bs-toggle="tab" href="#features">
                                    {{__('Features')}}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="your-subscription">
                                <div class="d-flex flex-column justify-content-start mobile-your-subcription" style="@if($get_locale=='ar') border-radius: 10px 0px 10px 10px; @endif">
                                    @if($subscription_data || Auth::user()->trial())
                                    <div class="d-flex flex-row align-items-center mobile-your-subcription-package">
                                        <span>
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.9513 18.5566C16.7056 18.7483 16.4242 18.8893 16.1234 18.9711C15.8227 19.053 15.5087 19.0743 15.1997 19.0336C14.8907 18.9929 14.5929 18.8912 14.3236 18.7342C14.0543 18.5773 13.819 18.3684 13.6312 18.1196L5.23628 7.09116C4.85285 6.58659 4.68312 5.95149 4.76379 5.32291C4.84445 4.69433 5.16906 4.12266 5.66747 3.73124C5.91321 3.53958 6.19458 3.39872 6.49529 3.31686C6.796 3.23501 7.11002 3.2138 7.419 3.25447C7.72799 3.29513 8.02578 3.39687 8.29507 3.55375C8.56435 3.71062 8.79973 3.9195 8.98751 4.16822L17.3825 15.1967C17.7659 15.7013 17.9356 16.3364 17.8549 16.9649C17.7743 17.5935 17.4497 18.1652 16.9513 18.5566Z" fill="#F2C5A7"/>
                                            <path d="M6.79865 19.167C6.07764 19.1874 5.378 18.9209 4.8533 18.426C4.32861 17.931 4.02171 17.2481 4 16.5272V5.64095C4.02158 4.91994 4.3284 4.23698 4.85313 3.74202C5.37785 3.24706 6.07761 2.98058 6.79865 3.0011C7.51965 2.98071 8.2193 3.24723 8.74399 3.74217C9.26869 4.2371 9.57553 4.91999 9.59724 5.64095V16.5272C9.57553 17.2481 9.26869 17.931 8.74399 18.426C8.2193 18.9209 7.51965 19.1874 6.79865 19.167Z" fill="#FF9A41"/>
                                            <path d="M15.5825 19.1688C14.8402 19.1688 14.1284 18.8739 13.6035 18.3491C13.0787 17.8242 12.7838 17.1124 12.7838 16.3702V9.3299C12.7838 8.58766 13.0787 7.87582 13.6035 7.35098C14.1284 6.82613 14.8402 6.53125 15.5825 6.53125C16.3247 6.53125 17.0365 6.82613 17.5614 7.35098C18.0862 7.87582 18.3811 8.58766 18.3811 9.3299V16.3702C18.3811 17.1124 18.0862 17.8242 17.5614 18.3491C17.0365 18.8739 16.3247 19.1688 15.5825 19.1688Z" fill="#FF9A41"/>
                                            </svg>
                                        </span>
                                        <p class="m-0 primary-text-color mobile-your-subcription-package-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__($user_plan_name)}}</p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mobile-your-subcription-package">
                                        <span>
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 10.9948C15.5559 10.9953 14.6279 11.2394 13.8057 11.7035C12.9835 12.1676 12.295 12.8359 11.8067 13.644C11.2347 13.7109 10.6592 13.7445 10.0833 13.7448C6.03167 13.7448 2.75 12.104 2.75 10.0781V7.32812C2.75 9.35396 6.03167 10.9948 10.0833 10.9948C14.135 10.9948 17.4167 9.35396 17.4167 7.32812V10.0781C17.4118 10.4152 17.3236 10.7459 17.16 11.0406C16.9422 11.002 16.721 10.9866 16.5 10.9948ZM10.0833 9.16146C14.135 9.16146 17.4167 7.52062 17.4167 5.49479C17.4167 3.46896 14.135 1.82812 10.0833 1.82812C6.03167 1.82812 2.75 3.46896 2.75 5.49479C2.75 7.52062 6.03167 9.16146 10.0833 9.16146ZM11.0917 15.5415C10.7565 15.5721 10.4199 15.5844 10.0833 15.5781C6.03167 15.5781 2.75 13.9373 2.75 11.9115V14.6615C2.75 16.6873 6.03167 18.3281 10.0833 18.3281C10.4905 18.3379 10.8979 18.3195 11.3025 18.2731C10.9914 17.3973 10.9186 16.4546 11.0917 15.5415ZM17.4167 17.4115V13.7448H15.5833V17.4115H13.75L16.5 20.1615L19.25 17.4115H17.4167Z" fill="#FF9A41"/>
                                            </svg>
                                        </span>
                                        <p class="m-0 primary-text-color mobile-your-subcription-package-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Number of connections') . ' ' . UserPlanHelper::subscription_info()->connections}}</p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mobile-your-subcription-package">
                                        <span>
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.4167 19.2474V17.4141H13.75V15.5807H17.4167V13.7474L20.1667 16.4974L17.4167 19.2474ZM11.9167 16.4974C11.9159 17.1287 12.047 17.7531 12.3017 18.3307H1.83337V15.5807C1.83337 13.5549 5.11504 11.9141 9.16671 11.9141C10.0431 11.9114 10.9178 11.9912 11.7792 12.1524C12.4886 12.283 13.1827 12.4857 13.8509 12.7574C13.253 13.1808 12.7654 13.7414 12.4289 14.3921C12.0924 15.0429 11.9167 15.7648 11.9167 16.4974ZM3.66671 15.5807V16.4974H10.0834C10.0829 15.5732 10.2831 14.66 10.67 13.8207L9.16671 13.7474C6.13254 13.7474 3.66671 14.5724 3.66671 15.5807ZM9.16671 3.66406C9.89191 3.66406 10.6008 3.87911 11.2038 4.28201C11.8068 4.68491 12.2767 5.25756 12.5543 5.92756C12.8318 6.59755 12.9044 7.3348 12.7629 8.04606C12.6214 8.75732 12.2722 9.41066 11.7594 9.92345C11.2466 10.4362 10.5933 10.7855 9.88204 10.9269C9.17077 11.0684 8.43353 10.9958 7.76353 10.7183C7.09354 10.4408 6.52088 9.9708 6.11799 9.36782C5.71509 8.76484 5.50004 8.05593 5.50004 7.33073C5.50004 6.35827 5.88635 5.42564 6.57398 4.738C7.26162 4.05037 8.19425 3.66406 9.16671 3.66406ZM9.16671 5.4974C8.80411 5.4974 8.44965 5.60492 8.14816 5.80637C7.84667 6.00782 7.61169 6.29414 7.47293 6.62914C7.33417 6.96414 7.29786 7.33276 7.3686 7.68839C7.43934 8.04403 7.61395 8.37069 7.87035 8.62709C8.12674 8.88349 8.45341 9.0581 8.80904 9.12884C9.16467 9.19957 9.5333 9.16327 9.86829 9.02451C10.2033 8.88575 10.4896 8.65076 10.6911 8.34927C10.8925 8.04778 11 7.69333 11 7.33073C11 6.8445 10.8069 6.37818 10.4631 6.03437C10.1193 5.69055 9.65294 5.4974 9.16671 5.4974Z" fill="#FF9A41"/>
                                            </svg>
                                        </span>
                                        <p class="m-0 primary-text-color mobile-your-subcription-package-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                            @if($user_plan_name == 'Essentials Plan' || $user_plan_name == 'Trial')
                                            {{__('Users')}} 5
                                            @elseif($user_plan_name == 'Plus Plan' || $user_plan_name == 'Enterprise Plan')
                                            {{__('Users')}} {{__("Unlimited")}}
                                            @endif  
                                        </p>
                                    </div>
                                    @else
                                    <div class="d-flex flex-row align-items-center mobile-your-subcription-package">
                                        <span>
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.9513 18.5566C16.7056 18.7483 16.4242 18.8893 16.1234 18.9711C15.8227 19.053 15.5087 19.0743 15.1997 19.0336C14.8907 18.9929 14.5929 18.8912 14.3236 18.7342C14.0543 18.5773 13.819 18.3684 13.6312 18.1196L5.23628 7.09116C4.85285 6.58659 4.68312 5.95149 4.76379 5.32291C4.84445 4.69433 5.16906 4.12266 5.66747 3.73124C5.91321 3.53958 6.19458 3.39872 6.49529 3.31686C6.796 3.23501 7.11002 3.2138 7.419 3.25447C7.72799 3.29513 8.02578 3.39687 8.29507 3.55375C8.56435 3.71062 8.79973 3.9195 8.98751 4.16822L17.3825 15.1967C17.7659 15.7013 17.9356 16.3364 17.8549 16.9649C17.7743 17.5935 17.4497 18.1652 16.9513 18.5566Z" fill="#F2C5A7"/>
                                            <path d="M6.79865 19.167C6.07764 19.1874 5.378 18.9209 4.8533 18.426C4.32861 17.931 4.02171 17.2481 4 16.5272V5.64095C4.02158 4.91994 4.3284 4.23698 4.85313 3.74202C5.37785 3.24706 6.07761 2.98058 6.79865 3.0011C7.51965 2.98071 8.2193 3.24723 8.74399 3.74217C9.26869 4.2371 9.57553 4.91999 9.59724 5.64095V16.5272C9.57553 17.2481 9.26869 17.931 8.74399 18.426C8.2193 18.9209 7.51965 19.1874 6.79865 19.167Z" fill="#FF9A41"/>
                                            <path d="M15.5825 19.1688C14.8402 19.1688 14.1284 18.8739 13.6035 18.3491C13.0787 17.8242 12.7838 17.1124 12.7838 16.3702V9.3299C12.7838 8.58766 13.0787 7.87582 13.6035 7.35098C14.1284 6.82613 14.8402 6.53125 15.5825 6.53125C16.3247 6.53125 17.0365 6.82613 17.5614 7.35098C18.0862 7.87582 18.3811 8.58766 18.3811 9.3299V16.3702C18.3811 17.1124 18.0862 17.8242 17.5614 18.3491C17.0365 18.8739 16.3247 19.1688 15.5825 19.1688Z" fill="#FF9A41"/>
                                            </svg>
                                        </span>
                                        <p class="m-0 primary-text-color mobile-your-subcription-package-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('No plan')}}</p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mobile-your-subcription-package">
                                        <span>
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 10.9948C15.5559 10.9953 14.6279 11.2394 13.8057 11.7035C12.9835 12.1676 12.295 12.8359 11.8067 13.644C11.2347 13.7109 10.6592 13.7445 10.0833 13.7448C6.03167 13.7448 2.75 12.104 2.75 10.0781V7.32812C2.75 9.35396 6.03167 10.9948 10.0833 10.9948C14.135 10.9948 17.4167 9.35396 17.4167 7.32812V10.0781C17.4118 10.4152 17.3236 10.7459 17.16 11.0406C16.9422 11.002 16.721 10.9866 16.5 10.9948ZM10.0833 9.16146C14.135 9.16146 17.4167 7.52062 17.4167 5.49479C17.4167 3.46896 14.135 1.82812 10.0833 1.82812C6.03167 1.82812 2.75 3.46896 2.75 5.49479C2.75 7.52062 6.03167 9.16146 10.0833 9.16146ZM11.0917 15.5415C10.7565 15.5721 10.4199 15.5844 10.0833 15.5781C6.03167 15.5781 2.75 13.9373 2.75 11.9115V14.6615C2.75 16.6873 6.03167 18.3281 10.0833 18.3281C10.4905 18.3379 10.8979 18.3195 11.3025 18.2731C10.9914 17.3973 10.9186 16.4546 11.0917 15.5415ZM17.4167 17.4115V13.7448H15.5833V17.4115H13.75L16.5 20.1615L19.25 17.4115H17.4167Z" fill="#FF9A41"/>
                                            </svg>
                                        </span>
                                        <p class="m-0 primary-text-color mobile-your-subcription-package-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Number of connections')}}: 0 </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mobile-your-subcription-package">
                                        <span>
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.4167 19.2474V17.4141H13.75V15.5807H17.4167V13.7474L20.1667 16.4974L17.4167 19.2474ZM11.9167 16.4974C11.9159 17.1287 12.047 17.7531 12.3017 18.3307H1.83337V15.5807C1.83337 13.5549 5.11504 11.9141 9.16671 11.9141C10.0431 11.9114 10.9178 11.9912 11.7792 12.1524C12.4886 12.283 13.1827 12.4857 13.8509 12.7574C13.253 13.1808 12.7654 13.7414 12.4289 14.3921C12.0924 15.0429 11.9167 15.7648 11.9167 16.4974ZM3.66671 15.5807V16.4974H10.0834C10.0829 15.5732 10.2831 14.66 10.67 13.8207L9.16671 13.7474C6.13254 13.7474 3.66671 14.5724 3.66671 15.5807ZM9.16671 3.66406C9.89191 3.66406 10.6008 3.87911 11.2038 4.28201C11.8068 4.68491 12.2767 5.25756 12.5543 5.92756C12.8318 6.59755 12.9044 7.3348 12.7629 8.04606C12.6214 8.75732 12.2722 9.41066 11.7594 9.92345C11.2466 10.4362 10.5933 10.7855 9.88204 10.9269C9.17077 11.0684 8.43353 10.9958 7.76353 10.7183C7.09354 10.4408 6.52088 9.9708 6.11799 9.36782C5.71509 8.76484 5.50004 8.05593 5.50004 7.33073C5.50004 6.35827 5.88635 5.42564 6.57398 4.738C7.26162 4.05037 8.19425 3.66406 9.16671 3.66406ZM9.16671 5.4974C8.80411 5.4974 8.44965 5.60492 8.14816 5.80637C7.84667 6.00782 7.61169 6.29414 7.47293 6.62914C7.33417 6.96414 7.29786 7.33276 7.3686 7.68839C7.43934 8.04403 7.61395 8.37069 7.87035 8.62709C8.12674 8.88349 8.45341 9.0581 8.80904 9.12884C9.16467 9.19957 9.5333 9.16327 9.86829 9.02451C10.2033 8.88575 10.4896 8.65076 10.6911 8.34927C10.8925 8.04778 11 7.69333 11 7.33073C11 6.8445 10.8069 6.37818 10.4631 6.03437C10.1193 5.69055 9.65294 5.4974 9.16671 5.4974Z" fill="#FF9A41"/>
                                            </svg>
                                        </span>
                                        <p class="m-0 primary-text-color mobile-your-subcription-package-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                            @if($user_plan_name == 'Essentials Plan' || $user_plan_name == 'Trial')
                                            {{__('Users')}} 5
                                            @elseif($user_plan_name == 'Plus Plan' || $user_plan_name == 'Enterprise Plan')
                                            {{__('Users')}} {{__("Unlimited")}}
                                            @endif  
                                        </p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane" id="features">
                                <div class="d-flex flex-column justify-content-start mobile-feature" style="@if($get_locale=='ar') border-radius: 10px 0px 10px 10px; @endif">
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Number of Users')}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                            @if($user_plan_name == 'Essentials Plan' || $user_plan_name == 'Trial')
                                            5
                                            @elseif($user_plan_name == 'Plus Plan' || $user_plan_name == 'Enterprise Plan')
                                            {{__("Unlimited")}}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row mobile-feature-row-primary" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Minimum Connection")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value">
                                        {{$number_of_links}}
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Data Guarantee")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value">
                                            &nbsp;
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row mobile-feature-row-primary" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Data Volume")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                        @if($user_plan_name == 'Essentials Plan')
                                        {{__("10 Gig")}}
                                        @elseif($user_plan_name == 'Plus Plan' || $user_plan_name == 'Enterprise Plan')
                                        &nbsp;
                                        @else
                                        {{__("Unlimited")}}
                                        @endif
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Roles & Permissions Control")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value ">
                                            &nbsp;
                                            
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row mobile-feature-row-primary" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Custom Dashboards')}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                        @if($user_plan_name == 'Essentials Plan')
                                        -
                                        @elseif($user_plan_name == 'Plus Plan')
                                        {{__('Per Connection')}}
                                        @elseif($user_plan_name == 'Enterprise Plan')
                                        {{__("Unlimited")}}
                                        @else
                                        -
                                        @endif
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Prebuilt Templates")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                           
                                            @if($user_plan_name == 'Trial')
                                            -
                                            @else
                                            {{__("Unlimited")}}
                                            @endif 
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row mobile-feature-row-primary" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Knowledge Base")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value">
                                            &nbsp;
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Guided Setup ")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value">
                                            &nbsp;
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row mobile-feature-row-primary" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Live chat and Email Support")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value">
                                        &nbsp;
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Video Support")}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value">
                                            &nbsp; 
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-between mobile-feature-row mobile-feature-row-primary" style="@if($get_locale=='ar') padding: 1px 1px 1px 10px; @endif">
                                        <div class="d-flex flex-row align-items-center justify-content-between" style="gap: 11px;">
                                            <span>
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="3" fill="#FF9A41"/>
                                                </svg>
                                            </span>
                                            <p class="m-0 primary-text-color mobile-feature-row-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Monthly team Training')}}</p>
                                        </div>
                                        <p class="m-0 primary-text-color mobile-feature-row-value">
                                        &nbsp; 
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row align-items-end justify-content-end mt-2">
                                        <button type="button" onclick="openManageSubscription()" class="border-0 d-flex flex-row align-items-center justify-content-center mobile-feature-upgrade-btn">
                                            <span class="mobile-feature-upgrade-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Upgrade')}}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="d-none d-md-flex flex-row flex-xl-column flex-xxl-row align-items-center align-items-xxl-start bg-white marketing-consultancy-container">
                        <div>
                            <svg width="46" height="40" viewBox="0 0 46 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.1289 14.2042L19.4661 13.2508C20.1336 13.6798 20.8486 14.0612 21.6115 14.2042C25.6641 15.1101 29.2873 12.2018 29.5258 8.34014C29.5258 8.14958 29.3827 7.95869 29.1919 7.95869H23.4708C23.2803 7.95869 23.1369 7.81569 23.1369 7.6248V1.90376C23.1369 1.7132 22.9464 1.52231 22.7555 1.56987C18.8938 1.76043 15.9855 5.38403 16.8914 9.48417C16.9869 9.86562 17.1299 10.2471 17.2729 10.5806L15.604 13.4889C15.4135 13.8706 15.7474 14.2996 16.1288 14.2042H16.1289Z" fill="#447097" />
                                <path d="M25.0911 6.38854H30.8121C31.0027 6.38854 31.1936 6.19798 31.146 6.00709C30.9554 2.76529 28.3808 0.143028 25.1389 0C24.9484 0 24.7575 0.143002 24.7575 0.333893V6.05492C24.7096 6.24548 24.9005 6.38849 25.091 6.38849L25.0911 6.38854Z" fill="#447097" />
                                <path d="M11.0263 9.91404C11.0263 11.9679 9.36151 13.6328 7.30762 13.6328C5.25372 13.6328 3.58889 11.9679 3.58889 9.91404C3.58889 7.86014 5.25372 6.19531 7.30762 6.19531C9.36151 6.19531 11.0263 7.86014 11.0263 9.91404Z" fill="#447097" />
                                <path d="M11.2647 30.3194H6.3066C5.01927 30.3194 3.97039 29.4135 3.73227 28.1261L2.25406 18.6386C2.15861 18.0187 1.58661 17.5897 0.966723 17.6852C0.346833 17.7806 -0.082148 18.3526 0.013289 18.9725L1.49116 28.46C1.87261 30.8438 3.87496 32.5602 6.25876 32.5602H11.2169C11.8368 32.5602 12.3612 32.0357 12.3612 31.4158C12.3612 30.8435 11.8846 30.319 11.2647 30.319V30.3194Z" fill="#447097" />
                                <path d="M14.8405 25.5505H11.4078L10.9788 19.5435C12.2183 20.2585 13.5531 20.6878 14.9835 20.6878H18.0823C18.8452 20.6878 19.5126 20.0679 19.5126 19.2574C19.5126 18.4945 18.8927 17.827 18.0823 17.827H15.031C14.0776 17.827 13.0762 17.541 12.2658 17.0166L9.453 15.2048C8.92855 14.8234 8.30869 14.6328 7.59364 14.6328H7.06919C6.06782 14.6328 5.16232 15.0618 4.49486 15.8247C3.82739 16.5876 3.54142 17.541 3.68441 18.5424L5.06684 27.5532C5.20984 28.3636 5.92484 28.9835 6.73567 28.9835H12.8857C13.1717 28.9835 13.4102 29.1741 13.4577 29.4604L15.0786 38.3758C15.2216 39.1863 15.9366 39.7583 16.7474 39.7583C16.8429 39.7583 16.938 39.7583 17.0334 39.7107C17.9394 39.5677 18.5592 38.6618 18.4159 37.7559L16.4611 26.9335C16.366 26.1227 15.6985 25.5507 14.8405 25.5507L14.8405 25.5505Z" fill="#447097" />
                                <path d="M41.7297 9.91404C41.7297 11.9679 40.0648 13.6328 38.0109 13.6328C35.957 13.6328 34.2922 11.9679 34.2922 9.91404C34.2922 7.86014 35.957 6.19531 38.0109 6.19531C40.0648 6.19531 41.7297 7.86014 41.7297 9.91404Z" fill="#447097" />
                                <path d="M44.3513 17.6852C43.7314 17.5897 43.1594 18.0191 43.064 18.6386L41.5861 28.1261C41.3955 29.4134 40.2988 30.3194 39.0118 30.3194L34.0533 30.319C33.4334 30.319 32.909 30.8435 32.909 31.4634C32.909 32.0832 33.4334 32.6077 34.0533 32.6077H39.0114C41.3952 32.6077 43.4451 30.8913 43.779 28.5075L45.2569 19.02C45.4002 18.3526 44.9709 17.7803 44.3513 17.6851V17.6852Z" fill="#447097" />
                                <path d="M38.5344 28.9367C39.3924 28.9367 40.0602 28.3168 40.2033 27.5063L41.5857 18.4955C41.7287 17.5421 41.4427 16.5407 40.7752 15.7778C40.1078 15.0149 39.2019 14.5859 38.2009 14.5859H37.6765C37.009 14.5859 36.3415 14.8244 35.8171 15.1579L33.0043 17.0173C32.1938 17.5418 31.2404 17.8278 30.2391 17.8278H27.1403C26.3774 17.8278 25.71 18.4476 25.71 19.2581C25.71 20.021 26.3299 20.6885 27.1403 20.6885H30.2867C31.717 20.6885 33.0995 20.307 34.2914 19.5442L33.8624 25.5513H30.4297C29.6193 25.5513 28.9039 26.1233 28.7609 26.9337L26.8061 37.7561C26.6631 38.6621 27.2351 39.5679 28.1885 39.7109C28.284 39.7109 28.3791 39.7585 28.4745 39.7585C29.285 39.7585 30.0003 39.1865 30.1433 38.3761L31.7642 29.4607C31.8118 29.1747 32.0502 28.9838 32.3362 28.9838L38.5344 28.9367Z" fill="#447097" />
                                <path d="M32.0996 23.1677C32.0996 22.5479 31.5751 22.0234 30.9553 22.0234H14.364C13.7441 22.0234 13.2197 22.5479 13.2197 23.1677C13.2197 23.7876 13.7442 24.3121 14.364 24.3121H21.563V38.8532C21.563 39.4731 22.0875 39.9975 22.7073 39.9975C23.3272 39.9975 23.8516 39.4731 23.8516 38.8532V24.2644H31.0506C31.5751 24.2644 32.0995 23.7878 32.0995 23.1679L32.0996 23.1677Z" fill="#447097" />
                            </svg>
                        </div>
                        <div class="d-flex flex-column p-0 marketing-consultancy-text-wrapper">
                            <p class="m-0 marketing-consultancy-text-primary @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                {{__('Marketing Analytics Consulting')}}
                            </p>
                            <p class="m-0 primary-text-color marketing-consultancy-text-secondary @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                {{__('Our marketing experts will help you understand your marketing performance, discover the strengths and weaknesses of your advertising campaigns, and increase your return on investment.')}}
                            </p>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center p-0 marketing-consultancy-cta-wrapper mt-4">
                            <div class="d-flex flex-column align-items-start p-0 marketing-consultancy-price-wrapper">
                                <p class="m-0 primary-text-color marketing-consultancy-price-text">$80/ {{__('mo')}}</p>
                                <p class="m-0 primary-text-color marketing-consultancy-price-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Monthly payment')}}</p>
                            </div>
                            @if($consulting_subscription_info == NULL)
                            <button type="button" onclick="openMarketingConsultancyModal()" class="d-flex flex-row justify-content-center align-items-center marketing-consultancy-cta-btn">
                                <span class="text-white marketing-consultancy-cta-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Start now')}}</span>
                            </button>
                            @endif
                        </div>
                    </div>
                    <!-- payment cards -->
                    <div class="mt-2 bg-white billing-payment-container">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <p class="m-0 billing-payment-title @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Billing & Payment')}}</p>
                            <button type="button" onclick="openManagePaymentMethod()" class="border-0 bg-transparent p-0">
                                <span class="billing-payment-edit-btn @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Edit')}}</span>
                            </button>
                        </div>
                        <div class="d-flex flex-row align-items-center my-4 p-0 choosen-billing-plan-container">
                            <span>
                                <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.33333 16.4974H12V19.1641H9.33333V16.4974ZM28 8.4974V27.1641C28 27.8713 27.719 28.5496 27.219 29.0497C26.7189 29.5498 26.0406 29.8307 25.3333 29.8307H6.66667C5.95942 29.8307 5.28115 29.5498 4.78105 29.0497C4.28095 28.5496 4 27.8713 4 27.1641V8.4974C4 7.79015 4.28095 7.11187 4.78105 6.61178C5.28115 6.11168 5.95942 5.83073 6.66667 5.83073H8V3.16406H10.6667V5.83073H21.3333V3.16406H24V5.83073H25.3333C26.0406 5.83073 26.7189 6.11168 27.219 6.61178C27.719 7.11187 28 7.79015 28 8.4974ZM6.66667 11.1641H25.3333V8.4974H6.66667V11.1641ZM25.3333 27.1641V13.8307H6.66667V27.1641H25.3333ZM20 19.1641V16.4974H22.6667V19.1641H20ZM14.6667 19.1641V16.4974H17.3333V19.1641H14.6667ZM9.33333 21.8307H12V24.4974H9.33333V21.8307ZM20 24.4974V21.8307H22.6667V24.4974H20ZM14.6667 24.4974V21.8307H17.3333V24.4974H14.6667Z" fill="#F58B1E" />
                                </svg>
                            </span>
                            <div class="d-flex flex-column align-items-start" style="gap:4px">
                                @if($subscription_info)
                                <p class="m-0 billing-payment-price-primary @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">${{$subscription_info['only_payment']}}</p>
                                <!-- <p class="m-0 billing-payment-price-secondary">/per connection & profile</p> -->
                                <p class="m-0 billing-payment-price-sub-secondary @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{$subscription_info['only_next_payment']}}</p>
                                @elseif(auth()->user()->company->onTrial())
                                <p class="m-0 billing-payment-price-secondary @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('The trial period will end in ')}} {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }} {{__('days')}}</p>
                                @else
                                <p class="m-0 billing-payment-price-secondary @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('No plan')}}</p>
                                @endif
                            </div>
                        </div>
                        <p class="billing-payment-method-label"> {{__('Payment method')}}</p>
                        @if(!$payment_methods->isEmpty() || $user_company->paypal_method)
                            @if($subscription_info)
                            <div class="d-flex flex-row align-items-center justify-content-start mt-2 billing-payment-method-set-period">
                                <p class="m-0 primary-text-color billing-payment-method-cycle-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                    @if($subscription_info['interval'] == 'month')
                                    {{__('Billing period is set to monthly.')}}
                                    @elseif($subscription_info['interval'] == 'year')
                                    {{__('Billing period is set to monthly.')}}
                                    @endif
                                </p>
                                <p class="m-0">&nbsp;</p>
                                <!-- <button class="border-0 p-0 bg-transparent">
                                        <span class="billing-payment-method-btn-text">Change</span> 
                                    </button> -->
                            </div>
                            @endif
                            <div class="d-none d-md-flex flex-column" style="gap:16px">
                                @foreach($payment_methods as $payment_method)
                                <div class="d-flex flex-row flex-xl-column flex-xxl-row align-items-center justify-content-between" id="{{ $payment_method->id }}">
                                    <div class="d-flex flex-row align-items-center" style="gap:16px">
                                        <span>
                                            <input type="radio" class="payment-method-radio"   name="payment_method_radio" id="" @if(!$isPaypalDefault && ($payment_method == $default_payment_method)) checked onchange="radioSelected('0')" @else onchange="radioSelected('{{ $payment_method->id }}')" @endif>
                                        </span>
                                        <span>
                                            @if($payment_method->card->brand=='visa')
                                            <!-- Visa Card -->
                                            <svg width="32" height="21" viewBox="0 0 32 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M32 2.70574C32 1.16876 31.2012 0.40625 29.6518 0.40625H2.34807C1.57359 0.40625 1.0047 0.612014 0.629436 1.03551C0.205935 1.45919 0 2.00379 0 2.70574V18.2942C0 18.9962 0.205935 19.5286 0.629436 19.9643C1.06525 20.3879 1.622 20.5937 2.34807 20.5937H29.6518C31.2012 20.5937 32 19.8194 32 18.2944V2.70574ZM29.6518 0.769373C30.9346 0.769373 31.5883 1.42293 31.5883 2.70574V18.2942C31.5883 19.589 30.9346 20.2304 29.6518 20.2304H2.34807C1.73078 20.2304 1.25887 20.0489 0.907894 19.6858C0.54477 19.3347 0.363294 18.8506 0.363294 18.294V2.70574C0.363294 1.42293 1.0047 0.769373 2.34807 0.769373H29.6518Z" fill="#315881" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.56601 1.66406C2.0457 1.66406 1.71884 1.74873 1.53736 1.93038C1.38 2.13614 1.30748 2.47498 1.30748 2.97117V6.34772H30.6929V2.97117C30.6929 2.08774 30.2569 1.66406 29.3856 1.66406H2.56601Z" fill="#315881" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.30748 17.9783C1.30748 18.8735 1.73098 19.3336 2.56601 19.3336H29.3856C30.2569 19.3336 30.6929 18.8737 30.6929 17.9783V14.6016H1.30748V17.9783Z" fill="#DFA43B" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0371 7.78594C11.0371 7.9433 11.0128 8.06423 10.9525 8.14907L8.83444 11.8405L8.70119 7.33816H5.3125L6.4501 7.88276C6.7768 8.08852 6.9463 8.35466 6.9463 8.69367L7.26085 13.4745H8.91893L12.8888 7.33816H10.8556C10.9766 7.44711 11.0371 7.61644 11.0371 7.78594ZM24.7376 7.51963L24.8705 7.33798H22.8009C22.8734 7.41051 22.8977 7.44694 22.8977 7.47106C22.8733 7.56769 22.8249 7.62841 22.8009 7.70094L19.7873 13.1955C19.7148 13.2923 19.6419 13.3772 19.5574 13.4741H21.2639L21.1791 13.2925C21.1791 13.1351 21.2639 12.8449 21.4454 12.4333L21.8085 11.7555H23.5634C23.6363 12.3244 23.6847 12.7965 23.7088 13.1476L23.5634 13.4743H25.6814L25.3667 13.0144L24.7376 7.51963ZM23.4788 10.8964H22.2201L23.2971 8.82674L23.4788 10.8964ZM18.2503 7.02344C17.5969 7.02344 17.04 7.20508 16.5438 7.56804C15.9991 7.88275 15.7329 8.28214 15.7329 8.7785C15.7329 9.34739 15.9265 9.84359 16.3138 10.2187L17.488 11.0294C17.9117 11.3322 18.1174 11.5983 18.1174 11.8405C18.1174 12.0704 18.0081 12.2762 17.8027 12.4335C17.5969 12.5909 17.3667 12.6634 17.0765 12.6634C16.6528 12.6634 15.9267 12.361 14.9222 11.8042V12.9297C15.7088 13.4018 16.4715 13.644 17.2095 13.644C17.9117 13.644 18.5047 13.4502 19.0132 13.0145C19.5578 12.615 19.8239 12.1433 19.8239 11.6228C19.8239 11.1868 19.6301 10.7876 19.1945 10.3639L18.0687 9.55299C17.6939 9.25041 17.488 8.9841 17.488 8.7785C17.488 8.3066 17.7663 8.0644 18.3352 8.0644C18.7224 8.0644 19.2913 8.28231 20.0536 8.74224L20.2839 7.56821C19.6421 7.20491 18.9766 7.02344 18.2503 7.02344ZM13.7481 13.4743C13.7239 13.2201 13.6755 12.9903 13.6512 12.7481L15.1883 7.78594L15.5514 7.33816H13.3366C13.3609 7.44711 13.385 7.59232 13.4093 7.70128C13.4093 7.81023 13.4093 7.94347 13.385 8.0644L11.848 12.9781L11.5333 13.4745H13.7481V13.4743Z" fill="#315881" />
                                            </svg>
                                            @else
                                            <!-- master card -->
                                            <svg width="32" height="21" viewBox="0 0 32 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M31.6916 16.6261V16.2422H31.5916L31.4759 16.5057L31.3609 16.2422H31.2606V16.6261H31.3316V16.3369L31.4398 16.5865H31.5134L31.6215 16.3363V16.6261H31.6919H31.6916ZM31.0573 16.6261V16.3079H31.1853V16.2431H30.8583V16.3079H30.9862V16.6261H31.0566H31.0573Z" fill="#F79410" />
                                                <path d="M20.3255 18.2766H11.6729V2.72656H20.3257L20.3255 18.2766Z" fill="#FF5F00" />
                                                <path d="M12.2225 10.4989C12.2225 7.34454 13.6994 4.53466 15.9993 2.72384C14.2584 1.35113 12.1052 0.60611 9.88821 0.609386C4.42697 0.609386 0 5.03699 0 10.4989C0 15.9607 4.42697 20.3884 9.88821 20.3884C12.1052 20.3917 14.2585 19.6466 15.9994 18.2739C13.6997 16.4634 12.2225 13.6534 12.2225 10.4989Z" fill="#EB001B" />
                                                <path d="M32.0002 10.4989C32.0002 15.9607 27.5733 20.3884 22.112 20.3884C19.8948 20.3916 17.7413 19.6466 16 18.2739C18.3005 16.4631 19.7774 13.6534 19.7774 10.4989C19.7774 7.34438 18.3005 4.53466 16 2.72384C17.7412 1.35117 19.8947 0.606167 22.1119 0.609385C27.5731 0.609385 32.0001 5.03699 32.0001 10.4989" fill="#F79E1B" />
                                            </svg>
                                            @endif
                                        </span>
                                        <div class="d-flex flex-column align-items-start">
                                            <p class="m-0 primary-text-color payment-method-card-name">{{ $payment_method->card->brand }}</p>
                                            <p class="m-0 payment-method-card-name-email">{{ $user_company->name }}</p>
                                        </div>
                                    </div>
                                    @if(!$isPaypalDefault && ($payment_method == $default_payment_method))
                                    <div class="d-flex flex-column align-items-center payment-default-badge" style="@if($get_locale=='ar') padding:8px @endif">
                                        <span class="payment-default-badge-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="@if($get_locale=='ar') font-size: 12px; @endif">{{__('Default')}}</span>
                                    </div>
                                    @else
                                    <div>&nbsp;</div>
                                    @endif
                                </div>
                                @endforeach
                                @if($user_company->paypal_method)
                                <div class="d-flex flex-row flex-xl-column flex-xxl-row align-items-center justify-content-between" id="paypal-method">
                                    <div class="d-flex flex-row align-items-center" style="gap:16px">
                                        <span>
                                            <input type="radio" class="payment-method-radio" name="payment_method_radio" id="" @if($isPaypalDefault) checked onchange="radioSelected('0')" @else onchange="radioSelected('paypal-method')" @endif>
                                        </span>
                                        <span>
                                            <!-- Paypal -->
                                            <svg width="22" height="27" viewBox="0 0 22 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.25442 25.8167L6.70432 22.9105L5.70177 22.8874H0.912865L4.23849 1.43743C4.24921 1.372 4.28211 1.31245 4.3315 1.26913C4.38095 1.22624 4.44389 1.20283 4.50887 1.20313H12.5769C15.2558 1.20313 17.1041 1.76963 18.0688 2.88943C18.4957 3.36477 18.7984 3.94159 18.9491 4.56693C19.0971 5.32936 19.0993 6.11365 18.9556 6.87693L18.9448 6.94403V7.53583L19.3969 7.79653C19.7428 7.97511 20.0537 8.2167 20.314 8.50933C20.7156 8.99067 20.9734 9.57886 21.057 10.2044C21.1606 11.0245 21.124 11.8566 20.9488 12.664C20.7781 13.643 20.443 14.5848 19.9582 15.4481C19.5607 16.1363 19.0262 16.7325 18.3889 17.1982C17.7485 17.6506 17.0318 17.9794 16.2746 18.1684C15.4103 18.3849 14.5225 18.4891 13.6324 18.4786H13.0041C12.5545 18.4782 12.1195 18.6409 11.7773 18.9375C11.4351 19.2341 11.2082 19.6452 11.1374 20.0967L11.0898 20.3585L10.2949 25.4867L10.2592 25.6748C10.2573 25.7167 10.2394 25.7561 10.2095 25.7848C10.1863 25.8043 10.1573 25.8151 10.1273 25.8156L6.25442 25.8167Z" fill="#253B80" />
                                                <path d="M19.8274 7.00781C19.8036 7.16475 19.7762 7.32498 19.7452 7.48851C18.681 13.0446 15.0407 14.9685 10.3924 14.9685H8.02172C7.74726 14.9684 7.4818 15.0681 7.27333 15.2497C7.06486 15.4312 6.92714 15.6827 6.88505 15.9585L5.67377 23.7718L5.33526 25.9883C5.32167 26.0762 5.32696 26.1661 5.35076 26.2517C5.37457 26.3373 5.41632 26.4166 5.47316 26.4843C5.52999 26.5519 5.60055 26.6062 5.67999 26.6434C5.75943 26.6807 5.84586 26.7 5.93333 26.7H10.1263C10.3668 26.7002 10.5994 26.6131 10.7824 26.4544C10.9654 26.2957 11.0867 26.0759 11.1246 25.8343L11.1656 25.6143L11.9562 20.5125L12.0071 20.2331C12.0444 19.9912 12.1656 19.7708 12.3486 19.6117C12.5316 19.4525 12.7645 19.3651 13.0053 19.3652H13.6336C17.7012 19.3652 20.8851 17.6855 21.8163 12.8246C22.2046 10.794 22.0034 9.09891 20.9749 7.90651C20.6491 7.53867 20.2603 7.23415 19.8274 7.00781Z" fill="#179BD7" />
                                                <path d="M18.7108 6.56047C18.5486 6.51207 18.3813 6.46844 18.209 6.42957C18.0367 6.39071 17.8593 6.35661 17.6769 6.32727C16.9866 6.2193 16.289 6.16743 15.5907 6.17217H9.26494C9.02422 6.1719 8.79135 6.25926 8.60846 6.41845C8.42557 6.57763 8.30472 6.79814 8.26779 7.04007L6.92348 15.7059L6.88454 15.9589C6.92663 15.683 7.06435 15.4316 7.27282 15.25C7.48129 15.0685 7.74675 14.9687 8.02121 14.9689H10.3886C15.0391 14.9689 18.6773 13.0483 19.7415 7.48887C19.7728 7.32387 19.7999 7.15887 19.8237 7.00817C19.5428 6.85849 19.2502 6.73301 18.9487 6.63307C18.8709 6.60997 18.7908 6.58467 18.7108 6.56047Z" fill="#222D65" />
                                                <path d="M8.26895 7.03999C8.30633 6.79835 8.42733 6.57824 8.61016 6.41931C8.79298 6.26039 9.0256 6.1731 9.2661 6.17319H15.5897C16.288 6.16845 16.9856 6.22031 17.6759 6.32829C17.8583 6.35836 18.0357 6.39246 18.208 6.43059C18.3803 6.46872 18.5476 6.51236 18.7098 6.56149L18.9488 6.63629C19.2501 6.73661 19.5428 6.86207 19.8238 7.01139C20.0276 6.1936 20.0345 5.33787 19.844 4.51677C19.6535 3.69566 19.2711 2.93339 18.7293 2.29459C17.5277 0.900888 15.3571 0.304688 12.5766 0.304688H4.50856C4.23373 0.304425 3.96784 0.404031 3.75883 0.585552C3.54983 0.767072 3.41145 1.01856 3.36866 1.29469L0.00841959 22.9647C-0.00719363 23.0652 -0.00121809 23.168 0.0259355 23.266C0.0530891 23.364 0.100777 23.4548 0.165722 23.5323C0.230666 23.6097 0.311328 23.6719 0.402162 23.7147C0.492997 23.7574 0.591851 23.7796 0.691931 23.7798H5.67334L6.9214 15.7047L8.26895 7.03999Z" fill="#253B80" />
                                            </svg>
                                        </span>
                                        <div class="d-flex flex-column align-items-start">
                                            <p class="m-0 primary-text-color payment-method-card-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('PayPal')}}</p>
                                            <p class="m-0 payment-method-card-name-email">{{ $user_company->name}}</p>
                                        </div>
                                    </div>
                                    @if($isPaypalDefault)
                                    <div class="d-flex flex-column align-items-center payment-default-badge">
                                        <span class="payment-default-badge-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Default')}}</span>
                                    </div>
                                    @else
                                    <div>&nbsp;</div>
                                    @endif
                                </div>
                                @endif
                                <div class="d-flex flex-row" style="gap:36px">
                                    <button id="pay_now" onclick="updatePMReq2()" type="button" class="d-flex flex-row align-items-center justify-content-center billing-paynow-btn" disabled style="opacity: 0.4;">
                                        <span class="text-white billing-paynow-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Save')}}</span>
                                    </button>
                                    <button type="button" onclick="openAddPaymentMethod()" class="border-0 bg-transparent">
                                        <span class="primary-text-color add-payment-method-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add Payment Method')}}</span>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex flex-column d-md-none">
                                @if($default_payment_method && !$user_company->paypal_default)
                                <div class="d-flex flex-row align-items-center" style="gap:10px">
                                    <!-- visa -->
                                    <span>
                                        <svg width="33" height="22" viewBox="0 0 33 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_4770_841545" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="3" y="6" width="27" height="10">
                                        <path d="M16.9361 9.5249C16.9216 10.6668 17.9537 11.304 18.7312 11.6828C19.53 12.0716 19.7983 12.3209 19.7953 12.6684C19.7892 13.2005 19.158 13.4353 18.5673 13.4444C17.5367 13.4604 16.9376 13.1662 16.4612 12.9436L16.09 14.6808C16.5679 14.9011 17.4529 15.0932 18.3706 15.1016C20.5248 15.1016 21.9342 14.0382 21.9418 12.3895C21.9502 10.2971 19.0475 10.1812 19.0673 9.24592C19.0742 8.96236 19.3448 8.65974 19.9378 8.58275C20.2313 8.54388 21.0416 8.51415 21.9601 8.9372L22.3206 7.25643C21.8267 7.07654 21.1917 6.90427 20.4013 6.90427C18.3737 6.90427 16.9475 7.9821 16.9361 9.5249ZM25.7851 7.04909C25.3918 7.04909 25.0602 7.27853 24.9123 7.63069L21.8351 14.9781H23.9877L24.4161 13.7943H27.0466L27.2951 14.9781H29.1924L27.5368 7.04909H25.7851ZM26.0862 9.19103L26.7074 12.1684H25.0061L26.0862 9.19103ZM14.3261 7.04909L12.6293 14.9781H14.6806L16.3766 7.04909H14.3261ZM11.2916 7.04909L9.15649 12.4459L8.29285 7.85708C8.19147 7.34485 7.79129 7.04909 7.3469 7.04909H3.85653L3.80774 7.27929C4.52426 7.43479 5.33835 7.68558 5.83153 7.95389C6.13338 8.11778 6.21951 8.26108 6.31861 8.65059L7.95441 14.9781H10.1223L13.4457 7.04909H11.2916Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask0_4770_841545)">
                                        <path d="M1.14954 7.88527L26.1609 -1.32582L31.8509 14.1248L6.83977 23.3359" fill="url(#paint0_linear_4770_841545)"/>
                                        </g>
                                        <defs>
                                        <linearGradient id="paint0_linear_4770_841545" x1="6.10723" y1="14.8544" x2="27.501" y2="6.97541" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#222357"/>
                                        <stop offset="1" stop-color="#254AA5"/>
                                        </linearGradient>
                                        </defs>
                                        </svg>
                                    </span>
                                    <!-- master card -->
                                    <span>
                                        <svg width="33" height="22" viewBox="0 0 33 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.972 5.23438H20.0311V16.7638H12.972V5.23438Z" fill="#FF5F00"/>
                                        <path d="M13.6992 11.0028C13.6983 9.89259 13.95 8.79675 14.4351 7.79819C14.9203 6.79964 15.6262 5.92452 16.4995 5.23908C15.4179 4.38903 14.1189 3.86043 12.7511 3.7137C11.3833 3.56697 10.0017 3.80803 8.76442 4.40933C7.5271 5.01062 6.48391 5.94789 5.75408 7.11402C5.02424 8.28015 4.63721 9.62808 4.63721 11.0038C4.63721 12.3795 5.02424 13.7274 5.75408 14.8935C6.48391 16.0596 7.5271 16.9969 8.76442 17.5982C10.0017 18.1995 11.3833 18.4406 12.7511 18.2938C14.1189 18.1471 15.4179 17.6185 16.4995 16.7685C15.626 16.0828 14.9198 15.2074 14.4347 14.2084C13.9495 13.2095 13.698 12.1133 13.6992 11.0027V11.0028Z" fill="#EB001B"/>
                                        <path d="M27.6622 15.5429V15.3067H27.7641V15.2578H27.5217V15.3067H27.6174V15.543L27.6622 15.5429ZM28.1327 15.5429V15.2578H28.0594L27.9739 15.4615L27.8883 15.2578H27.815V15.5429H27.8679V15.3271L27.9474 15.5124H28.0024L28.0818 15.3271V15.5429H28.1327Z" fill="#F79E1B"/>
                                        <path d="M28.3628 10.9979C28.3628 12.3736 27.9757 13.7217 27.2457 14.8878C26.5157 16.054 25.4724 16.9913 24.2349 17.5925C22.9974 18.1937 21.6158 18.4346 20.2478 18.2876C18.8799 18.1407 17.5809 17.6118 16.4994 16.7615C17.3723 16.0755 18.0781 15.2001 18.5634 14.2015C19.0487 13.2029 19.3008 12.1071 19.3008 10.9968C19.3008 9.88654 19.0487 8.79075 18.5634 7.79215C18.0781 6.79354 17.3723 5.91818 16.4994 5.23213C17.5809 4.38181 18.8799 3.85295 20.2478 3.70601C21.6158 3.55906 22.9974 3.79997 24.2349 4.40118C25.4724 5.00239 26.5157 5.93965 27.2457 7.10582C27.9757 8.272 28.3628 9.62002 28.3628 10.9958V10.9979Z" fill="#F79E1B"/>
                                        </svg>
                                    </span>
                                    <p class="m-0 mobile-billing-card-name">
                                        {{ ucfirst($default_payment_method->card->brand) }} {{__('card')}}
                                    </p>
                                </div>
                                @elseif($user_company->paypal_method && $user_company->paypal_default)
                                    <div class="d-flex flex-row align-items-center" style="gap:10px">
                                        <span>
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.24585 18.4561L8.52317 16.6948L7.90519 16.6808H4.95325L7.0032 3.68106C7.00981 3.64141 7.03009 3.60532 7.06054 3.57906C7.09102 3.55307 7.12981 3.53888 7.16987 3.53906H12.1431C13.7944 3.53906 14.9337 3.88239 15.5284 4.56104C15.7915 4.84912 15.9781 5.1987 16.071 5.57769C16.1623 6.03976 16.1636 6.51508 16.075 6.97766L16.0683 7.01833V7.37698L16.347 7.53498C16.5603 7.64321 16.7519 7.78963 16.9123 7.96697C17.1599 8.25869 17.3188 8.61516 17.3703 8.99428C17.4342 9.49129 17.4116 9.9956 17.3037 10.4849C17.1984 11.0782 16.9919 11.649 16.693 12.1722C16.448 12.5893 16.1185 12.9506 15.7257 13.2329C15.3309 13.507 14.8892 13.7063 14.4224 13.8209C13.8896 13.952 13.3424 14.0152 12.7938 14.0088H12.4064C12.1293 14.0086 11.8611 14.1072 11.6502 14.2869C11.4393 14.4667 11.2994 14.7158 11.2558 14.9895L11.2264 15.1482L10.7365 18.2561L10.7145 18.3701C10.7133 18.3954 10.7023 18.4193 10.6838 18.4368C10.6695 18.4485 10.6516 18.4551 10.6331 18.4554L8.24585 18.4561Z" fill="#253B80"/>
                                            <path d="M16.6122 7.0625C16.5976 7.15761 16.5807 7.25472 16.5616 7.35383C15.9056 10.7211 13.6616 11.8871 10.7964 11.8871H9.33506C9.16588 11.887 9.00225 11.9474 8.87375 12.0575C8.74524 12.1675 8.66035 12.3199 8.63441 12.4871L7.88776 17.2223L7.67909 18.5656C7.67072 18.6189 7.67398 18.6733 7.68865 18.7252C7.70332 18.7771 7.72906 18.8252 7.7641 18.8662C7.79913 18.9071 7.84262 18.9401 7.89159 18.9626C7.94056 18.9852 7.99383 18.9969 8.04775 18.9969H10.6324C10.7806 18.997 10.924 18.9442 11.0368 18.8481C11.1496 18.7519 11.2244 18.6186 11.2477 18.4723L11.273 18.3389L11.7603 15.247L11.7917 15.0777C11.8147 14.931 11.8894 14.7975 12.0022 14.701C12.115 14.6046 12.2586 14.5516 12.407 14.5517H12.7943C15.3016 14.5517 17.2642 13.5337 17.8382 10.5878C18.0775 9.35712 17.9535 8.32981 17.3196 7.60716C17.1188 7.38423 16.8791 7.19967 16.6122 7.0625Z" fill="#179BD7"/>
                                            <path d="M15.9242 6.7902C15.8243 6.76086 15.7211 6.73442 15.6149 6.71086C15.5087 6.68731 15.3994 6.66664 15.2869 6.64887C14.8614 6.58343 14.4314 6.55199 14.001 6.55487H10.1017C9.95332 6.5547 9.80978 6.60765 9.69704 6.70412C9.5843 6.8006 9.50982 6.93423 9.48705 7.08086L8.6584 12.3327L8.6344 12.4861C8.66034 12.3189 8.74524 12.1665 8.87374 12.0565C9.00224 11.9464 9.16587 11.886 9.33505 11.8861H10.7944C13.661 11.8861 15.9036 10.7221 16.5596 7.35285C16.5789 7.25285 16.5956 7.15286 16.6102 7.06152C16.4371 6.97081 16.2567 6.89476 16.0709 6.8342C16.0229 6.8202 15.9736 6.80486 15.9242 6.7902Z" fill="#222D65"/>
                                            <path d="M9.48775 7.08192C9.51079 6.93547 9.58538 6.80207 9.69807 6.70575C9.81077 6.60944 9.95416 6.55654 10.1024 6.55659H14.0003C14.4308 6.55372 14.8608 6.58515 15.2863 6.65059C15.3987 6.66881 15.5081 6.68948 15.6143 6.71259C15.7205 6.7357 15.8236 6.76214 15.9236 6.79192L16.0709 6.83725C16.2567 6.89805 16.4371 6.97409 16.6103 7.06458C16.7359 6.56896 16.7402 6.05035 16.6228 5.55272C16.5053 5.05509 16.2696 4.59312 15.9356 4.20598C15.195 3.36133 13.857 3 12.143 3H7.1698C7.00039 2.99984 6.83649 3.06021 6.70766 3.17022C6.57882 3.28023 6.49353 3.43264 6.46715 3.59999L4.39586 16.733C4.38623 16.794 4.38992 16.8563 4.40665 16.9157C4.42339 16.975 4.45279 17.0301 4.49282 17.077C4.53285 17.124 4.58257 17.1617 4.63857 17.1876C4.69456 17.2135 4.75549 17.2269 4.81718 17.227H7.88778L8.6571 12.3331L9.48775 7.08192Z" fill="#253B80"/>
                                            </svg>
                                        </span>
                                        <p class="m-0 mobile-billing-card-name">
                                            {{__('PayPal')}}
                                        </p>
                                    </div>
                                @else
                                    <p class="m-0 mobile-billing-card-name">
                                        {{__('No payment method')}}
                                    </p>
                                @endif
                                <div class="w-100">
                                    <button type="button" onclick="openManagePaymentMethod()" class=" mt-3 border-0 d-flex flex-row align-items-center justify-content-center mobile-payment-edit-btn @if($get_locale=='en') float-end @else float-start @endif">
                                        <span>
                                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.3786 8.94975L8.96373 18.3648C8.68452 18.644 8.32892 18.8343 7.94174 18.9117L5 19.5001L5.58835 16.5583C5.66579 16.1711 5.85609 15.8155 6.13529 15.5363L15.5502 6.12132M18.3786 8.94975L19.7928 7.53553C20.1834 7.14501 20.1834 6.51184 19.7928 6.12132L18.3786 4.70711C17.9881 4.31658 17.3549 4.31658 16.9644 4.70711L15.5502 6.12132M18.3786 8.94975L15.5502 6.12132" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        <span class="mobile-payment-edit-btn-text text-white @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                            {{__('Edit')}}
                                        </span>
                                    </button>
                                </div>
                            </div>

                        @else
                        <p class="m-0 mt-2 primary-text-color billing-payment-available-methods-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Available payment methods (and others)')}}:</p>
                        <div class="mt-3 d-flex flex-row align-items-center billing-payment-methods-icons-wrapper">
                            <span>
                                <svg width="56" height="19" viewBox="0 0 56 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24.0526 18.614H19.5252L22.3548 1.22478H26.8825L24.0526 18.614ZM15.7166 1.22478L11.4004 13.1852L10.8897 10.6097L10.8901 10.6106L9.36677 2.79049C9.36677 2.79049 9.18257 1.22478 7.21916 1.22478H0.0837276L0 1.51923C0 1.51923 2.18203 1.97321 4.73572 3.50682L8.66904 18.6145H13.3862L20.589 1.22478H15.7166ZM51.3263 18.614H55.4834L51.8589 1.22432H48.2195C46.539 1.22432 46.1296 2.52023 46.1296 2.52023L39.3775 18.614H44.0969L45.0407 16.031H50.796L51.3263 18.614ZM46.3445 12.4629L48.7233 5.95538L50.0616 12.4629H46.3445ZM39.7314 5.4065L40.3775 1.67226C40.3775 1.67226 38.3839 0.914062 36.3056 0.914062C34.0589 0.914062 28.7236 1.896 28.7236 6.67079C28.7236 11.1632 34.9855 11.219 34.9855 13.5788C34.9855 15.9385 29.3688 15.5157 27.5152 14.0276L26.8421 17.9321C26.8421 17.9321 28.8636 18.9141 31.9522 18.9141C35.0418 18.9141 39.7026 17.3144 39.7026 12.9606C39.7026 8.4393 33.3844 8.01833 33.3844 6.0526C33.3849 4.0864 37.7941 4.33898 39.7314 5.4065Z" fill="#2566AF" />
                                    <path d="M10.8901 10.6124L9.36677 2.79226C9.36677 2.79226 9.18257 1.22656 7.21916 1.22656H0.0837275L0 1.521C0 1.521 3.42957 2.23176 6.71912 4.89475C9.86448 7.44007 10.8901 10.6124 10.8901 10.6124Z" fill="#E6A540" />
                                </svg>
                            </span>
                            <span>
                                <svg width="83" height="21" viewBox="0 0 83 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.1095 5.39063H26.5772C26.4272 5.39053 26.282 5.44403 26.1679 5.54147C26.0538 5.63892 25.9783 5.77391 25.9549 5.92212L24.1219 17.5442C24.1134 17.5981 24.1168 17.6532 24.1317 17.7057C24.1466 17.7582 24.1727 17.8069 24.2083 17.8483C24.2438 17.8898 24.2879 17.923 24.3375 17.9458C24.3871 17.9686 24.441 17.9803 24.4956 17.9802H26.6594C26.8095 17.9803 26.9548 17.9267 27.0689 17.8291C27.183 17.7316 27.2585 17.5964 27.2817 17.4481L27.7761 14.3134C27.7993 14.1652 27.8747 14.0302 27.9886 13.9326C28.1026 13.835 28.2477 13.7814 28.3977 13.7813H29.8325C32.818 13.7813 34.5411 12.3366 34.9911 9.47362C35.1939 8.22109 34.9997 7.23695 34.4132 6.54773C33.769 5.79091 32.6265 5.39063 31.1095 5.39063V5.39063ZM31.6324 9.63532C31.3846 11.2616 30.142 11.2616 28.9405 11.2616H28.2565L28.7363 8.2244C28.7504 8.13554 28.7957 8.05461 28.8641 7.99618C28.9325 7.93774 29.0195 7.90563 29.1095 7.90563H29.4229C30.2414 7.90563 31.0134 7.90563 31.4124 8.37219C31.6503 8.65053 31.7232 9.06406 31.6324 9.63532V9.63532ZM44.6574 9.58297H42.487C42.3971 9.58297 42.3101 9.61508 42.2417 9.67351C42.1733 9.73195 42.128 9.81288 42.1139 9.90173L42.0178 10.5088L41.8661 10.2888C41.3962 9.60683 40.3485 9.37885 39.3027 9.37885C36.9043 9.37885 34.8559 11.1954 34.4569 13.7435C34.2495 15.0146 34.5444 16.23 35.2654 17.0776C35.9268 17.857 36.8732 18.1817 37.9991 18.1817C39.9316 18.1817 41.0032 16.9391 41.0032 16.9391L40.9065 17.5422C40.8978 17.5961 40.901 17.6513 40.9158 17.7038C40.9305 17.7564 40.9565 17.8052 40.9919 17.8467C41.0273 17.8883 41.0713 17.9217 41.1208 17.9446C41.1704 17.9676 41.2243 17.9795 41.2789 17.9796H43.2339C43.3841 17.9797 43.5293 17.9261 43.6434 17.8285C43.7575 17.7309 43.833 17.5958 43.8562 17.4474L45.0292 10.019C45.0379 9.96524 45.0347 9.9102 45.02 9.85774C45.0053 9.80528 44.9794 9.75663 44.944 9.71517C44.9086 9.67371 44.8647 9.64041 44.8152 9.61759C44.7658 9.59476 44.7119 9.58295 44.6574 9.58297V9.58297ZM41.6321 13.8071C41.4227 15.0471 40.4386 15.8794 39.1834 15.8794C38.5532 15.8794 38.0495 15.6773 37.7261 15.2943C37.4053 14.9139 37.2834 14.3724 37.3855 13.7693C37.581 12.54 38.5817 11.6805 39.8176 11.6805C40.434 11.6805 40.935 11.8852 41.265 12.2716C41.5957 12.6619 41.7269 13.2067 41.6321 13.8071V13.8071ZM56.2165 9.58297H54.0355C53.9327 9.58313 53.8314 9.60839 53.7405 9.65654C53.6496 9.7047 53.5719 9.77431 53.514 9.85932L50.5059 14.2902L49.2308 10.0323C49.1917 9.90242 49.1118 9.78861 49.0029 9.70769C48.8941 9.62676 48.7621 9.58303 48.6264 9.58297H46.4832C46.4231 9.58281 46.3637 9.59702 46.3102 9.62442C46.2566 9.65182 46.2104 9.69162 46.1753 9.7405C46.1402 9.78938 46.1173 9.84593 46.1085 9.90544C46.0997 9.96496 46.1053 10.0257 46.1247 10.0827L48.527 17.1326L46.2685 20.321C46.2284 20.3775 46.2046 20.444 46.1997 20.5131C46.1948 20.5823 46.2091 20.6515 46.2409 20.713C46.2727 20.7746 46.3209 20.8263 46.3801 20.8623C46.4393 20.8984 46.5073 20.9174 46.5767 20.9174H48.755C48.8567 20.9175 48.9569 20.893 49.0471 20.8459C49.1372 20.7988 49.2146 20.7306 49.2726 20.647L56.5267 10.1761C56.566 10.1194 56.5891 10.0531 56.5934 9.98429C56.5977 9.91547 56.5831 9.84678 56.5511 9.78568C56.5191 9.72457 56.4711 9.67337 56.4121 9.63764C56.3531 9.60191 56.2855 9.583 56.2165 9.58297V9.58297Z" fill="#253B80" />
                                    <path d="M63.4351 5.38348H58.9021C58.7521 5.38354 58.6072 5.43711 58.4932 5.53454C58.3792 5.63197 58.3038 5.76687 58.2804 5.91497L56.4474 17.537C56.4388 17.5909 56.4421 17.6459 56.4569 17.6984C56.4717 17.7508 56.4977 17.7995 56.5331 17.8409C56.5685 17.8824 56.6124 17.9156 56.662 17.9385C56.7115 17.9613 56.7653 17.9731 56.8198 17.9731H59.146C59.2509 17.9729 59.3523 17.9353 59.432 17.8671C59.5117 17.7988 59.5644 17.7043 59.5807 17.6006L60.1009 14.3063C60.1241 14.1581 60.1995 14.023 60.3135 13.9254C60.4275 13.8279 60.5725 13.7742 60.7226 13.7741H62.1567C65.1429 13.7741 66.8653 12.3294 67.3159 9.46647C67.5194 8.21394 67.3239 7.2298 66.7374 6.54058C66.0939 5.78376 64.952 5.38348 63.4351 5.38348V5.38348ZM63.9579 9.62817C63.7107 11.2545 62.4682 11.2545 61.266 11.2545H60.5827L61.0632 8.21725C61.077 8.12839 61.1221 8.04739 61.1904 7.98892C61.2587 7.93045 61.3457 7.89837 61.4356 7.89848H61.7491C62.5669 7.89848 63.3396 7.89848 63.7386 8.36504C63.9765 8.64338 64.0487 9.05691 63.9579 9.62817V9.62817ZM76.9823 9.57582H74.8132C74.7233 9.57557 74.6362 9.6076 74.5679 9.6661C74.4995 9.72459 74.4544 9.80567 74.4408 9.89458L74.3447 10.5016L74.1923 10.2816C73.7224 9.59968 72.6753 9.3717 71.6295 9.3717C69.2312 9.3717 67.1834 11.1882 66.7844 13.7364C66.5777 15.0074 66.8712 16.2229 67.5923 17.0705C68.255 17.8498 69.2 18.1746 70.326 18.1746C72.2585 18.1746 73.3301 16.932 73.3301 16.932L73.2333 17.535C73.2247 17.5891 73.2279 17.6443 73.2427 17.697C73.2575 17.7497 73.2836 17.7985 73.3191 17.8401C73.3547 17.8817 73.3989 17.9151 73.4486 17.9379C73.4983 17.9608 73.5524 17.9725 73.6071 17.9724H75.5614C75.7115 17.9723 75.8565 17.9187 75.9705 17.8211C76.0845 17.7235 76.1598 17.5885 76.1831 17.4403L77.3567 10.0119C77.3651 9.95792 77.3616 9.90279 77.3466 9.85028C77.3316 9.79778 77.3054 9.74914 77.2698 9.70771C77.2343 9.66628 77.1901 9.63304 77.1405 9.61028C77.0909 9.58751 77.0369 9.57575 76.9823 9.57582V9.57582ZM73.957 13.8C73.7489 15.0399 72.7635 15.8723 71.5083 15.8723C70.8793 15.8723 70.3744 15.6702 70.0509 15.2871C69.7302 14.9067 69.6096 14.3653 69.7103 13.7622C69.9071 12.5329 70.9065 11.6733 72.1425 11.6733C72.7588 11.6733 73.2598 11.8781 73.5899 12.2645C73.9219 12.6548 74.0531 13.1995 73.957 13.8V13.8ZM79.541 5.70224L77.6808 17.537C77.6723 17.5909 77.6755 17.6459 77.6903 17.6984C77.7051 17.7508 77.7311 17.7995 77.7665 17.8409C77.8019 17.8824 77.8459 17.9156 77.8954 17.9385C77.9449 17.9613 77.9987 17.9731 78.0533 17.9731H79.9234C80.2343 17.9731 80.498 17.7478 80.5457 17.4409L82.3801 5.81954C82.3886 5.76567 82.3854 5.7106 82.3706 5.6581C82.3558 5.60561 82.3298 5.55694 82.2944 5.51544C82.259 5.47395 82.2151 5.4406 82.1656 5.41771C82.1161 5.39481 82.0622 5.38291 82.0077 5.38281H79.9135C79.8236 5.38313 79.7367 5.41545 79.6685 5.47398C79.6002 5.53251 79.5551 5.61343 79.541 5.70224V5.70224Z" fill="#179BD7" />
                                    <path d="M5.29969 20.236L5.64629 18.0344L4.87422 18.0165H1.18753L3.74959 1.77136C3.75722 1.72172 3.78243 1.67648 3.82063 1.64388C3.85883 1.61128 3.90747 1.59349 3.95768 1.59375H10.174C12.2377 1.59375 13.6618 2.02319 14.4054 2.87081C14.754 3.26844 14.976 3.68396 15.0834 4.14123C15.196 4.62104 15.198 5.19429 15.088 5.89346L15.0801 5.94449V6.39248L15.4286 6.58997C15.6948 6.72479 15.934 6.90717 16.1344 7.1281C16.4327 7.46807 16.6255 7.90016 16.707 8.41244C16.7912 8.9393 16.7634 9.56623 16.6255 10.276C16.4665 11.0925 16.2093 11.8036 15.8621 12.3854C15.5557 12.9067 15.1437 13.3581 14.6526 13.7109C14.1913 14.0382 13.6433 14.2868 13.0236 14.4458C12.4232 14.6022 11.7386 14.6811 10.9878 14.6811H10.504C10.1581 14.6811 9.82206 14.8057 9.5583 15.029C9.29491 15.2547 9.12019 15.5666 9.06524 15.9091L9.02879 16.1072L8.41644 19.9874L8.38861 20.1299C8.38132 20.175 8.36873 20.1975 8.35017 20.2128C8.33219 20.2275 8.30977 20.2356 8.28655 20.236H5.29969Z" fill="#253B80" />
                                    <path d="M15.7581 5.99219C15.7396 6.11081 15.7183 6.23209 15.6945 6.35668C14.8747 10.5656 12.0701 12.0196 8.48811 12.0196H6.66432C6.22626 12.0196 5.85713 12.3377 5.78887 12.7698L4.8551 18.6918L4.59068 20.3705C4.58014 20.4371 4.58416 20.5051 4.60246 20.57C4.62076 20.6349 4.65291 20.6951 4.69668 20.7463C4.74046 20.7976 4.79482 20.8388 4.85603 20.867C4.91724 20.8953 4.98385 20.9099 5.05126 20.9099H8.28598C8.66903 20.9099 8.99443 20.6316 9.05473 20.2538L9.08654 20.0895L9.69558 16.2245L9.73468 16.0125C9.79432 15.6334 10.1204 15.355 10.5034 15.355H10.9872C14.1212 15.355 16.5746 14.0826 17.2916 10.4006C17.5912 8.86241 17.4361 7.57807 16.6435 6.67479C16.3923 6.39536 16.0923 6.16405 15.7581 5.99219V5.99219Z" fill="#179BD7" />
                                    <path d="M14.9024 5.65386C14.6407 5.57814 14.3744 5.51904 14.1052 5.47691C13.5732 5.39516 13.0356 5.35594 12.4974 5.35961H7.62515C7.43973 5.35947 7.26037 5.42567 7.1195 5.54624C6.97863 5.66681 6.88554 5.8338 6.85707 6.01703L5.82058 12.5819L5.79076 12.7734C5.82305 12.5644 5.92907 12.3739 6.08964 12.2363C6.25022 12.0987 6.45474 12.0231 6.6662 12.0232H8.49C12.072 12.0232 14.8766 10.5686 15.6964 6.36031C15.7209 6.23572 15.7414 6.11444 15.76 5.99582C15.5437 5.88238 15.3182 5.78728 15.086 5.71151C15.0251 5.69131 14.9639 5.67209 14.9024 5.65386V5.65386Z" fill="#222D65" />
                                    <path d="M6.85466 6.01631C6.8829 5.83304 6.97593 5.66597 7.11688 5.54546C7.25782 5.42495 7.43731 5.35899 7.62275 5.35956H12.495C13.0723 5.35956 13.6111 5.39734 14.1028 5.47686C14.4355 5.52916 14.7637 5.60738 15.0843 5.7108C15.3262 5.79099 15.5508 5.88576 15.7583 5.99511C16.0021 4.43971 15.7563 3.38069 14.9153 2.42174C13.9881 1.36603 12.3148 0.914062 10.1735 0.914062H3.95727C3.51987 0.914062 3.14676 1.23217 3.07917 1.66492L0.489935 18.0771C0.477875 18.1533 0.482464 18.2312 0.503385 18.3054C0.524307 18.3797 0.561065 18.4485 0.611131 18.5072C0.661197 18.5659 0.723383 18.6131 0.793411 18.6455C0.86344 18.6778 0.939648 18.6946 1.01679 18.6947H4.85458L5.81817 12.5812L6.85466 6.01631Z" fill="#253B80" />
                                </svg>
                            </span>
                            <span>
                                <svg width="37" height="28" viewBox="0 0 37 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M35.4406 27.4495V27.521H35.5073C35.5199 27.5212 35.5322 27.518 35.5431 27.5119C35.5475 27.5088 35.551 27.5047 35.5533 27.4999C35.5556 27.4951 35.5567 27.4898 35.5565 27.4845C35.5567 27.4793 35.5556 27.4741 35.5533 27.4694C35.5509 27.4648 35.5474 27.4608 35.5431 27.4579C35.5323 27.4514 35.5199 27.4482 35.5073 27.4488H35.4406V27.4495ZM35.5081 27.3989C35.5366 27.3971 35.565 27.4053 35.5882 27.4221C35.5975 27.4297 35.6049 27.4394 35.6097 27.4504C35.6146 27.4614 35.6168 27.4734 35.6162 27.4854C35.6167 27.4958 35.6149 27.5061 35.611 27.5157C35.6071 27.5252 35.6012 27.5339 35.5937 27.541C35.5758 27.5566 35.5534 27.5659 35.5297 27.5677L35.6191 27.6696H35.5503L35.468 27.5684H35.4414V27.6696H35.3838V27.399H35.509L35.5081 27.3989ZM35.4902 27.7629C35.5204 27.7632 35.5503 27.7571 35.578 27.7451C35.6047 27.7336 35.6289 27.7171 35.6495 27.6966C35.6701 27.6761 35.6866 27.6518 35.698 27.6251C35.7214 27.5684 35.7214 27.5047 35.698 27.448C35.6864 27.4214 35.67 27.3971 35.6495 27.3765C35.6289 27.356 35.6047 27.3395 35.578 27.328C35.5501 27.3166 35.5203 27.3109 35.4902 27.3112C35.4596 27.311 35.4292 27.3167 35.4008 27.328C35.3735 27.3393 35.3486 27.3558 35.3276 27.3765C35.296 27.409 35.2746 27.45 35.2661 27.4945C35.2576 27.539 35.2624 27.585 35.2799 27.6269C35.2908 27.6537 35.307 27.678 35.3276 27.6984C35.3487 27.7191 35.3735 27.7356 35.4008 27.7469C35.429 27.7589 35.4595 27.765 35.4902 27.7647V27.7629ZM35.4902 27.2461C35.5688 27.2461 35.6442 27.2769 35.7003 27.332C35.7273 27.3584 35.7488 27.39 35.7636 27.4248C35.7789 27.4605 35.7868 27.499 35.7868 27.5379C35.7868 27.5768 35.7789 27.6153 35.7636 27.651C35.7485 27.6856 35.727 27.7171 35.7003 27.7438C35.6729 27.7701 35.6409 27.7913 35.6061 27.8064C35.5694 27.822 35.53 27.8299 35.4902 27.8296C35.4499 27.8299 35.41 27.822 35.3729 27.8064C35.3376 27.7917 35.3054 27.7704 35.2779 27.7438C35.2512 27.7161 35.23 27.6836 35.2155 27.648C35.2002 27.6122 35.1923 27.5737 35.1923 27.5349C35.1923 27.496 35.2002 27.4575 35.2155 27.4217C35.2303 27.3869 35.2518 27.3554 35.2788 27.3289C35.3059 27.3019 35.3382 27.2806 35.3738 27.2664C35.4109 27.2507 35.4508 27.2428 35.4911 27.2431L35.4902 27.2461ZM8.10869 26.2013C8.10869 25.6854 8.44667 25.2616 8.99905 25.2616C9.52694 25.2616 9.88316 25.6671 9.88316 26.2013C9.88316 26.7354 9.52694 27.141 8.99905 27.141C8.44667 27.141 8.10869 26.7172 8.10869 26.2013ZM10.4849 26.2013V24.7331H9.84668V25.0908C9.64425 24.8265 9.33721 24.6607 8.91966 24.6607C8.09707 24.6607 7.45151 25.3059 7.45151 26.202C7.45151 27.0981 8.09671 27.7433 8.91966 27.7433C9.33703 27.7433 9.64425 27.5773 9.84668 27.3132V27.6696H10.4842V26.2013H10.4849ZM32.0496 26.2013C32.0496 25.6854 32.3876 25.2616 32.9401 25.2616C33.4686 25.2616 33.8243 25.6671 33.8243 26.2013C33.8243 26.7354 33.4686 27.141 32.9401 27.141C32.3878 27.141 32.0496 26.7172 32.0496 26.2013ZM34.4265 26.2013V23.5547H33.7878V25.0908C33.5853 24.8265 33.2783 24.6607 32.8608 24.6607C32.0382 24.6607 31.3926 25.3059 31.3926 26.202C31.3926 27.0981 32.0378 27.7433 32.8608 27.7433C33.2783 27.7433 33.5853 27.5773 33.7878 27.3132V27.6696H34.4265V26.2013ZM18.4061 25.2313C18.8174 25.2313 19.0815 25.4892 19.1489 25.9432H17.626C17.6942 25.5194 17.9515 25.2313 18.4063 25.2313H18.4061ZM18.4189 24.6591C17.5588 24.6591 16.9571 25.285 16.9571 26.2004C16.9571 27.1337 17.5829 27.7417 18.4617 27.7417C18.9037 27.7417 19.3086 27.6313 19.6648 27.3304L19.3521 26.8574C19.106 27.0541 18.7927 27.1644 18.4982 27.1644C18.0869 27.1644 17.7124 26.974 17.6203 26.4456H19.7996C19.8059 26.3662 19.8123 26.286 19.8123 26.2002C19.8059 25.2852 19.2401 24.6589 18.4186 24.6589L18.4189 24.6591ZM26.1241 26.2002C26.1241 25.6843 26.4621 25.2605 27.0145 25.2605C27.5424 25.2605 27.8986 25.6661 27.8986 26.2002C27.8986 26.7344 27.5424 27.1399 27.0145 27.1399C26.4621 27.1399 26.1239 26.7161 26.1239 26.2002H26.1241ZM28.5001 26.2002V24.7331H27.8623V25.0908C27.6591 24.8265 27.3528 24.6607 26.9352 24.6607C26.1127 24.6607 25.4671 25.3059 25.4671 26.202C25.4671 27.0981 26.1123 27.7433 26.9352 27.7433C27.3528 27.7433 27.6591 27.5773 27.8623 27.3132V27.6696H28.5003V26.2013L28.5001 26.2002ZM22.5199 26.2002C22.5199 27.0906 23.1397 27.7415 24.0857 27.7415C24.5277 27.7415 24.8223 27.6431 25.1408 27.3915L24.8342 26.8756C24.5946 27.0478 24.343 27.1399 24.0653 27.1399C23.5558 27.1337 23.1812 26.7653 23.1812 26.2002C23.1812 25.6351 23.5558 25.2669 24.0653 25.2605C24.3423 25.2605 24.5939 25.3526 24.8342 25.5248L25.1408 25.0089C24.8217 24.7573 24.5272 24.6589 24.0857 24.6589C23.1397 24.6589 22.5199 25.3097 22.5199 26.2002ZM30.7476 24.6589C30.3794 24.6589 30.1396 24.8311 29.9738 25.089V24.7331H29.3413V27.668H29.9803V26.0228C29.9803 25.5371 30.1889 25.2673 30.6061 25.2673C30.7428 25.2653 30.8784 25.2904 31.0053 25.3411L31.202 24.7396C31.0607 24.684 30.8765 24.6595 30.7472 24.6595L30.7476 24.6589ZM13.6402 24.9665C13.3332 24.7641 12.9101 24.6595 12.4434 24.6595C11.6998 24.6595 11.2211 25.0159 11.2211 25.599C11.2211 26.0775 11.5775 26.3728 12.2338 26.4649L12.5353 26.5078C12.8853 26.557 13.0505 26.6491 13.0505 26.8148C13.0505 27.0418 12.818 27.1712 12.3815 27.1712C11.9395 27.1712 11.6204 27.0299 11.4053 26.8642L11.1054 27.3618C11.4554 27.6197 11.8974 27.7427 12.3761 27.7427C13.2238 27.7427 13.715 27.3436 13.715 26.7848C13.715 26.2689 13.3284 25.999 12.6896 25.9069L12.3888 25.8633C12.1126 25.8275 11.8912 25.7719 11.8912 25.5752C11.8912 25.3606 12.0999 25.2315 12.45 25.2315C12.8246 25.2315 13.1873 25.3728 13.365 25.4831L13.6413 24.9672L13.6402 24.9665ZM21.8753 24.66C21.5071 24.66 21.2673 24.8322 21.1022 25.0901V24.7331H20.4697V27.668H21.1079V26.0228C21.1079 25.5371 21.3166 25.2673 21.7338 25.2673C21.8704 25.2653 22.0061 25.2904 22.1329 25.3411L22.3296 24.7396C22.1884 24.684 22.0042 24.6595 21.8749 24.6595L21.8753 24.66ZM16.429 24.7331H15.3854V23.8428H14.7402V24.7331H14.1449V25.3165H14.7402V26.6553C14.7402 27.3363 15.0045 27.7418 15.7595 27.7418C16.0365 27.7418 16.3555 27.656 16.5579 27.5149L16.3736 26.9684C16.1831 27.0788 15.9744 27.1344 15.8085 27.1344C15.4895 27.1344 15.3854 26.9377 15.3854 26.6432V25.317H16.429V24.7331ZM6.88715 27.6687V25.8268C6.88715 25.1332 6.44509 24.6664 5.73248 24.6602C5.35785 24.6539 4.97141 24.7705 4.70085 25.1823C4.49842 24.8569 4.1794 24.6602 3.73091 24.6602C3.41743 24.6602 3.1111 24.7523 2.8713 25.096V24.7331H2.23254V27.668H2.87631V26.0407C2.87631 25.5312 3.15885 25.2605 3.59518 25.2605C4.01899 25.2605 4.2334 25.5368 4.2334 26.0343V27.6676H4.8786V26.0403C4.8786 25.5309 5.17312 25.2601 5.59675 25.2601C6.03255 25.2601 6.24052 25.5364 6.24052 26.0339V27.6673L6.88715 27.6687Z" fill="#231F20" />
                                    <path d="M35.8027 17.9057V17.4766H35.6909L35.5616 17.7711L35.4331 17.4766H35.3209V17.9057H35.4003V17.5824L35.5212 17.8614H35.6035L35.7244 17.5817V17.9057H35.803H35.8027ZM35.0936 17.9057V17.5501H35.2367V17.4776H34.8712V17.5501H35.0142V17.9057H35.0929H35.0936Z" fill="#F79410" />
                                    <path d="M23.0997 19.7489H13.4279V2.36719H23.0999L23.0997 19.7489Z" fill="#FF5F00" />
                                    <path d="M14.047 11.0544C14.047 7.52849 15.6979 4.38763 18.2687 2.36352C16.3227 0.829123 13.9159 -0.00364956 11.4378 1.20232e-05C5.33328 1.20232e-05 0.384872 4.94914 0.384872 11.0544C0.384872 17.1596 5.33328 22.1087 11.4378 22.1087C13.916 22.1124 16.3229 21.2796 18.2689 19.7452C15.6983 17.7214 14.047 14.5804 14.047 11.0544Z" fill="#EB001B" />
                                    <path d="M36.1506 11.0544C36.1506 17.1596 31.2022 22.1087 25.0977 22.1087C22.6193 22.1123 20.2121 21.2796 18.2658 19.7452C20.8372 17.7211 22.4881 14.5804 22.4881 11.0544C22.4881 7.52831 20.8372 4.38763 18.2658 2.36352C20.2121 0.829169 22.6192 -0.00358538 25.0975 1.16038e-05C31.202 1.16038e-05 36.1505 4.94914 36.1505 11.0544" fill="#F79E1B" />
                                </svg>

                            </span>

                        </div>
                        <div class="mt-4">
                            <button type="button" onclick="openAddPaymentMethod()" class="border-0 d-flex flex-row align-items-start billing-payment-add-btn">
                                <span class="text-white billing-payment-add-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                    {{__('Add Payment Method')}}
                                </span>
                            </button>
                        </div>
                        @endif
                    </div>
                    <!-- Marketing consultancy mobile -->
                    <div class="d-inline d-md-none">
                        <div class="mt-2 d-flex flex-column justify-content-center align-items-start mobile-marketing-consultancy">
                            <span>
                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_4770_8751)">
                                <path d="M60 48.0232C59.7417 49.2699 59.2603 50.3875 58.2611 51.2433C57.2115 52.1414 55.9892 52.4772 54.6378 52.4772C42.6712 52.4748 30.7033 52.4772 18.7367 52.4666C18.2353 52.4666 17.8737 52.5922 17.5121 52.9608C15.475 55.0364 13.412 57.0873 11.3467 59.1347C11.0943 59.3848 10.8043 59.5949 10.5202 59.8133C10.2583 60.014 9.90492 60.0633 9.60787 59.9213C8.70262 59.4893 8.57934 58.6182 8.93745 57.22C9.32843 55.6938 9.33782 54.0961 8.92923 52.5746C8.52063 51.0532 8.86113 50.2185 9.71237 50.0295C10.5389 49.8463 11.2282 50.4169 11.2458 51.3431C11.2681 52.5535 11.2516 53.7638 11.2516 54.9742C11.2516 55.1644 11.2516 55.3546 11.2516 55.6551C11.4501 55.4802 11.5792 55.378 11.6943 55.263C13.2136 53.7451 14.7447 52.2389 16.2428 50.6998C16.6937 50.2373 17.3113 49.9731 17.9571 49.9743C30.1374 49.9884 42.3189 49.9896 54.4993 49.9696C55.0851 49.9696 55.7262 49.8616 56.2428 49.6057C57.1915 49.1361 57.5097 48.2333 57.5085 47.2061C57.5062 44.8629 57.5085 42.5208 57.5085 40.1776C57.5085 31.0993 57.5085 22.0211 57.5085 12.9417C57.5085 12.2056 57.4205 11.5036 56.9273 10.9072C56.3415 10.1993 55.5665 9.97273 54.6883 9.9739C52.7745 9.97625 50.8607 9.98212 48.948 9.97038C48.0545 9.96451 47.4921 9.44914 47.5132 8.70015C47.532 8.05682 48.0181 7.50623 48.7191 7.50271C51.0215 7.49097 53.3322 7.41818 55.6252 7.58254C57.8561 7.7422 59.4623 9.38927 59.9026 11.6045C59.9084 11.6327 59.9155 11.6609 59.9225 11.6879C59.9812 11.9004 60 12.1234 60 12.3441V48.0232Z" fill="#737F96"/>
                                <path d="M47.4921 28.6418C48.6216 28.758 49.7898 27.9127 49.9037 26.7576C50.0188 25.5812 50.0023 24.3791 49.9061 23.1993C49.8286 22.2449 48.9574 21.4559 48.0016 21.3045C47.5238 21.2282 47.0306 21.2341 46.5434 21.2235C45.455 21.2 45.0088 20.7657 45.0006 19.6915C44.9947 18.9695 45.0065 18.2463 44.9982 17.5244C44.9207 10.7342 40.4509 4.77748 34.1623 3.0811C27.7645 1.3542 21.4982 3.57416 17.66 8.992C15.8236 11.5841 14.9982 14.5202 15.0006 17.6922C15.0018 21.6356 15.0006 25.5801 15.0006 29.5234C15.0006 30.8089 14.5709 31.2116 13.2758 31.2421C11.3819 31.2867 9.68181 30.8382 8.54878 29.2135C8.10613 28.5795 7.69167 27.7918 7.63883 27.0475C7.52964 25.5049 7.4545 23.9001 7.76329 22.4033C8.19889 20.2949 9.74756 19.1339 11.8809 18.7969C12.0723 18.7664 12.2625 18.7359 12.5103 18.696C12.3107 12.8132 14.3243 7.85913 18.84 4.0414C22.0594 1.32016 25.8436 -0.0334184 30.054 0.000626497C35.0828 0.0417152 39.3695 1.91653 42.8061 5.60512C46.2275 9.27962 47.6799 13.6949 47.485 18.6091C48.247 18.8251 48.9773 18.9319 49.6149 19.2325C51.268 20.0132 52.2743 21.3479 52.4293 23.1828C52.5596 24.7313 52.6876 26.3044 52.212 27.8306C51.6543 29.622 49.9436 30.9956 48.0791 31.1552C47.6658 31.1904 47.4768 31.2902 47.4568 31.7704C47.1598 38.9832 41.4618 44.6628 34.2503 44.9575C33.7631 44.9774 33.2746 44.9763 32.7862 44.9739C31.8304 44.9681 31.4594 44.6605 31.2563 43.7225C31.0802 42.9113 30.7068 42.5286 30.0634 42.5004C29.4329 42.4734 28.9292 42.8714 28.8094 43.4912C28.6908 44.1111 29.0043 44.6734 29.5961 44.8788C29.7605 44.9352 29.9378 44.9551 30.1092 44.9904C30.8653 45.1477 31.288 45.6536 31.2246 46.3252C31.1577 47.0354 30.6281 47.4674 29.845 47.4498C28.2247 47.4134 26.7899 46.2477 26.3755 44.6323C25.9739 43.0709 26.6819 41.3487 28.0592 40.5352C29.9765 39.4023 32.333 40.0785 33.3521 42.0695C33.4895 42.3384 33.5999 42.498 33.9497 42.4793C38.591 42.2186 41.9561 40.0245 43.992 35.8428C44.7211 34.346 45.0006 32.7354 45.0018 31.0742C45.0018 29.1219 45.0041 27.1696 45.0018 25.2173C45.0018 24.628 45.1744 24.1349 45.7368 23.8626C46.5328 23.4763 47.4369 24.0316 47.4768 24.9696C47.5191 25.9827 47.4921 26.9994 47.4956 28.0149C47.4956 28.2262 47.4956 28.4375 47.4956 28.6418H47.4921ZM12.4715 21.2998C11.3174 21.2681 10.2196 22.0488 10.1068 23.1641C9.9859 24.3568 9.98473 25.5812 10.1033 26.774C10.2184 27.928 11.4195 28.7815 12.4715 28.6347V21.2998Z" fill="#737F96"/>
                                <path d="M0.00236136 29.9204C0.00236136 24.1997 -0.00116101 18.4801 0.0047096 12.7594C0.00705785 10.624 0.885301 8.96754 2.83317 8.0225C3.47894 7.70905 4.24916 7.53295 4.9689 7.50947C7.01657 7.44139 9.06893 7.4766 11.119 7.48834C11.8575 7.49304 12.3201 7.86401 12.4445 8.48152C12.5631 9.07437 12.2849 9.65782 11.7295 9.8574C11.463 9.95366 11.1565 9.96775 10.8677 9.9701C9.05132 9.97949 7.23613 9.97245 5.41976 9.97597C3.47894 9.97949 2.49502 10.9574 2.49502 12.8956C2.49268 24.2783 2.49385 35.6599 2.49502 47.0426C2.49502 48.8435 3.22885 49.7052 4.98534 49.9858C5.8765 50.1278 6.33088 50.6666 6.20995 51.4391C6.10075 52.14 5.46555 52.5415 4.61666 52.4464C1.83986 52.1341 0.0105802 50.0938 0.00588372 47.2575C-0.00468338 41.4781 0.00236136 35.6998 0.00236136 29.9204Z" fill="#737F96"/>
                                <path d="M29.973 4.99234C36.5715 4.95947 42.0641 10.1226 42.4527 16.7226C42.4703 17.0137 42.5009 17.3095 42.4645 17.596C42.3799 18.2605 41.8668 18.716 41.2516 18.7171C40.6598 18.7171 40.1561 18.298 40.0481 17.6559C39.8943 16.7367 39.8802 15.7799 39.6243 14.8924C38.4889 10.9643 35.887 8.48018 31.8844 7.69715C27.9183 6.92116 24.6155 8.26535 22.0864 11.4069C20.7772 13.0316 20.1139 14.9288 20.0305 17.0196C19.9859 18.1513 19.501 18.7653 18.6908 18.7148C17.8596 18.6643 17.4486 18.0304 17.539 16.8963C17.9805 11.3552 20.8407 7.60089 26.0185 5.66855C27.2572 5.206 29.973 4.99234 29.973 4.99234Z" fill="#737F96"/>
                                <path d="M31.2246 32.471V34.9468H28.7472C28.7472 34.2014 28.7343 33.4688 28.7637 32.7386C28.7672 32.6447 28.9856 32.4886 29.1088 32.4839C29.7875 32.4592 30.4685 32.4721 31.2246 32.4721V32.471Z" fill="#737F96"/>
                                <path d="M26.2193 32.5078V34.9497H23.7936V32.5078H26.2193Z" fill="#737F96"/>
                                <path d="M33.7807 34.9407V32.5H36.2064V34.9407H33.7807Z" fill="#737F96"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_4770_8751">
                                <rect width="60" height="60" fill="white"/>
                                </clipPath>
                                </defs>
                                </svg>
                            </span>
                            <p class="m-0 mobile-consultancy-heading">{{__('Marketing Analytics Consulting')}}</p>
                            <p class="m-0 mobile-consultancy-description">
                            {{__('Our marketing experts will help you understand your marketing performance, discover the strengths and weaknesses of your advertising campaigns, and increase your return on investment.')}}
                            </p>
                            <div class="d-flex flex-row align-items-start" style="gap:4px">
                                <p class="m-0 primary-text-color mobile-consultancy-price">$80/ {{__('mo')}} </p>
                                <p class="m-0 primary-text-color mobile-consultancy-billing-period">{{__('Monthly payment')}}</p>
                            </div>
                            @if($consulting_subscription_info == NULL)
                            <div class="w-100">
                                <button type="button" onclick="openMarketingConsultancyModal()" class="d-flex flex-row align-items-center justify-content-center border-0 mobile-start-consultancy-btn float-end">
                                    <span class="mobile-start-consultancy-btn-text">{{__('Start now')}}</span>
                                </button>
                            </div>
                            @endif
                        </div>
                        <div class="mt-2 mobile-billing-section">
                            <p class="m-0 mobile-billing-history-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Billing History')}}</p>
                            <div>
                                @if($billing_history->isNotEmpty())
                                @foreach($billing_history as $item)
                                    <div class="d-flex flex-row align-item-center justify-content-between mt-3 pb-3" style="@if(!$loop->last) border-bottom: 0.5px solid #B0BBCB; @endif">
                                        <div class="d-flex flex-column jsutify-content-between w-100" style="gap:10px">
                                            <div class="d-flex flex-row align-items-center justify-content-between">
                                                <p class="m-0 mobile-billing-row-status-label primary-text-color @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Status')}}</p>
                                                @if($item->status === 'paid' || 'APPROVED')
                                                <p class="m-0 mobile-billing-row-status-value @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('SUCCESSFUL')}}</p>
                                                @else
                                                <p class="m-0 mobile-billing-row-status-value-failed @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('FAILED')}}</p>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-row align-items-center justify-content-between">
                                                <p class="m-0 mobile-billing-row-status-label primary-text-color @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Amount')}}</p>
                                                <p class="m-0 mobile-billing-row-amount-value">${{ $item->amount }}</p>
                                            </div>
                                            <div class="d-flex flex-row align-items-center justify-content-between">
                                                <p class="m-0 mobile-billing-row-status-label primary-text-color @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Date')}}</p>
                                                <p class="m-0 mobile-billing-row-date-value">{{ $item->date }}</p>
                                            </div>
                                        </div>
                                        @if($item->invoice_pdf !== 'test')
                                        <a href="{{ $item->invoice_pdf }}" class="d-flex flex-column align-items-center justify-content-center @if($get_locale=='ar') pe-3 @else ps-3 @endif text-decoration-none">
                                            <svg width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5 1.5H8H4C2.34315 1.5 1 2.84315 1 4.5V16.5C1 18.1569 2.34315 19.5 4 19.5H12C13.6569 19.5 15 18.1569 15 16.5V7.125M9.5 1.5L15 7.125M9.5 1.5V6.125C9.5 6.67728 9.94772 7.125 10.5 7.125H15" stroke="#F58B1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 11.5H11" stroke="#F58B1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 15.5H11" stroke="#F58B1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        @else
                                        <a href="{{ url('/invoice/' . $item->transaction_id) }}" target="_blank" class="d-flex flex-column align-items-center justify-content-center @if($get_locale=='ar') pe-3 @else ps-3 @endif text-decoration-none">
                                            <svg width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5 1.5H8H4C2.34315 1.5 1 2.84315 1 4.5V16.5C1 18.1569 2.34315 19.5 4 19.5H12C13.6569 19.5 15 18.1569 15 16.5V7.125M9.5 1.5L15 7.125M9.5 1.5V6.125C9.5 6.67728 9.94772 7.125 10.5 7.125H15" stroke="#F58B1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 11.5H11" stroke="#F58B1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 15.5H11" stroke="#F58B1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        @endif
                                    </div>
                                @endforeach
                                @else
                                    <div class="my-4">
                                        <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.6666 56H54.1331C54.6181 56 55.0843 55.8108 55.4322 55.4733C55.7806 55.1354 55.9835 54.6754 55.9985 54.1905C56.0135 53.7059 55.8389 53.2342 55.5118 52.8755C49.8152 46.641 46.6594 38.499 46.6664 30.0532V5.59997C46.6648 4.11539 46.0744 2.69161 45.0243 1.64213C43.9747 0.592125 42.5509 0.00170666 41.0665 0H5.59997C4.93289 0 4.31667 0.355828 3.98333 0.933329C3.65 1.51083 3.65 2.2225 3.98333 2.79999C4.31667 3.37748 4.93291 3.73332 5.59997 3.73332H41.0665C41.5615 3.73373 42.036 3.93082 42.386 4.2804C42.7356 4.63039 42.9327 5.10498 42.9331 5.59996V30.0532C42.926 38.0423 45.4706 45.8248 50.1956 52.2664H18.6661C17.1816 52.2647 15.7578 51.6743 14.7083 50.6243C13.6583 49.5747 13.0679 48.1509 13.0662 46.6664V11.1999C13.0662 10.5329 12.7103 9.91664 12.1328 9.5833C11.5553 9.24997 10.8437 9.24997 10.2662 9.5833C9.68868 9.91664 9.33284 10.5329 9.33284 11.1999V46.6664C9.33575 49.141 10.3199 51.5131 12.0699 53.2627C13.8194 55.0126 16.1916 55.9968 18.6661 55.9997L18.6666 56Z" fill="#D0D8E3" />
                                            <path d="M29.8665 39.2021H37.3331C38.0002 39.2021 38.6164 38.8462 38.9498 38.2687C39.2831 37.6912 39.2831 36.9796 38.9498 36.4021C38.6164 35.8246 38.0002 35.4688 37.3331 35.4688H29.8665C29.1994 35.4688 28.5832 35.8246 28.2499 36.4021C27.9165 36.9796 27.9165 37.6912 28.2499 38.2687C28.5832 38.8462 29.1994 39.2021 29.8665 39.2021Z" fill="#D0D8E3" />
                                            <path d="M22.3999 46.663H37.3331C38.0002 46.663 38.6164 46.3072 38.9498 45.7297C39.2831 45.1522 39.2831 44.4405 38.9498 43.863C38.6164 43.2855 38.0002 42.9297 37.3331 42.9297H22.3999C21.7328 42.9297 21.1166 43.2855 20.7832 43.863C20.4499 44.4405 20.4499 45.1522 20.7832 45.7297C21.1166 46.3072 21.7328 46.663 22.3999 46.663Z" fill="#D0D8E3" />
                                            <path d="M31.9571 26.1364H35.4662C36.1333 26.1364 36.7495 25.7806 37.0829 25.2031C37.4162 24.6256 37.4162 23.9139 37.0829 23.3364C36.7495 22.7589 36.1333 22.4031 35.4662 22.4031H31.9571C31.4413 22.4031 31.0238 21.9852 31.0238 21.4697C31.0238 20.9543 31.4413 20.5364 31.9571 20.5364H33.3755C35.043 20.5364 36.5834 19.6468 37.4172 18.2031C38.2509 16.7594 38.2509 14.9802 37.4172 13.5364C36.5834 12.0927 35.043 11.2031 33.3755 11.2031H29.8664C29.1993 11.2031 28.5831 11.559 28.2497 12.1365C27.9164 12.714 27.9164 13.4256 28.2497 14.0031C28.5831 14.5806 29.1993 14.9364 29.8664 14.9364H33.3755C33.8913 14.9364 34.3088 15.3544 34.3088 15.8698C34.3088 16.3852 33.8913 16.8031 33.3755 16.8031H31.9571C30.2896 16.8031 28.7493 17.6927 27.9155 19.1364C27.0817 20.5801 27.0817 22.3593 27.9155 23.8031C28.7492 25.2468 30.2896 26.1364 31.9571 26.1364Z" fill="#D0D8E3" />
                                            <path d="M33.5998 13.0687C34.0948 13.0687 34.5698 12.872 34.9198 12.522C35.2698 12.172 35.4665 11.697 35.4665 11.202V9.33538C35.4665 8.6683 35.1106 8.05208 34.5331 7.71875C33.9556 7.38542 33.244 7.38542 32.6665 7.71875C32.089 8.05208 31.7331 8.66832 31.7331 9.33538V11.202C31.7331 11.697 31.9298 12.172 32.2798 12.522C32.6298 12.872 33.1048 13.0687 33.5998 13.0687Z" fill="#D0D8E3" />
                                            <path d="M33.5998 29.865C34.0948 29.865 34.5698 29.6684 34.9198 29.3184C35.2698 28.9684 35.4665 28.4934 35.4665 27.9984V24.2651C35.4665 23.598 35.1106 22.9818 34.5331 22.6484C33.9556 22.3151 33.244 22.3151 32.6665 22.6484C32.089 22.9818 31.7331 23.598 31.7331 24.2651V27.9984C31.7331 28.4934 31.9298 28.9684 32.2798 29.3184C32.6298 29.6684 33.1048 29.865 33.5998 29.865Z" fill="#D0D8E3" />
                                            <path d="M1.86664 13.0666H11.1999C11.6949 13.0666 12.1699 12.8699 12.5199 12.5199C12.8699 12.1699 13.0666 11.6949 13.0666 11.1999V7.46663C13.0645 5.48701 12.277 3.5891 10.8775 2.18911C9.47749 0.789543 7.57958 0.00202666 5.59996 0C4.11538 0.00166666 2.6916 0.592083 1.64211 1.64213C0.592112 2.6917 0.00169086 4.1155 -1.52588e-05 5.59997V11.1999C-1.52588e-05 11.6949 0.196655 12.1699 0.546649 12.5199C0.896642 12.8699 1.37165 13.0666 1.86664 13.0666ZM9.33327 9.33329H3.7333V5.59997C3.73372 5.10498 3.93039 4.6304 4.28038 4.28041C4.63037 3.93041 5.10496 3.73374 5.59995 3.73333C6.58993 3.73458 7.53871 4.12832 8.23866 4.82793C8.93824 5.52793 9.33198 6.47667 9.33326 7.46664L9.33327 9.33329Z" fill="#D0D8E3" />
                                        </svg>
                                    </div>
                                    <div class="d-flex flex-column align-items-start receipt-email-container">
                                        <p class="m-0 primary-text-color receipt-are-sent @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('You have not made any payments')}}</p>
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="manageSubscription" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="manageSubscription" tabindex="-1">
    <div class="modal-dialog" style="max-width:1020px;max-height:800px;">
        <div class="modal-content bg-white border-0 custom-modal-content">
            <!-- header -->
            @include('tenant.v2.response-view.billing-modal-header',['get_locale'=>$get_locale,'header'=>__('Manage your subscription')])
            <!-- body -->
            <div class="px-3 px-sm-5">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div>
                            @include('tenant.v2.response-view.subscription-in-modal',['get_locale'=>$get_locale])
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div>
                            <p class="d-none d-md-block m-0  py-3 primary-text-color manage-subscription-available-action @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Available Actions')}}</p>
                            <div class="p-4 my-3 my-md-0 mb-md-5 find-a-better-plan-wrapper">
                                <div class="d-flex flex-row align-items-center justify-content-start" style="gap: 10px;">
                                    <span>
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.88076 0.320312C11.5831 0.32149 13.2495 0.809999 14.6826 1.72803C16.1158 2.64605 17.2559 3.95517 17.9678 5.50045C18.6798 7.04573 18.9338 8.76249 18.6999 10.4476C18.466 12.1326 17.754 13.7155 16.648 15.0087L17.0176 15.3781H18.0994L24.9496 22.2237L22.8949 24.277L16.0457 17.4324V16.3503L15.6761 15.981C14.5858 16.9138 13.2861 17.5694 11.8876 17.8921C10.4891 18.2147 9.03327 18.1947 7.64413 17.834C6.255 17.4732 4.97371 16.7822 3.90938 15.8199C2.84506 14.8576 2.02924 13.6525 1.5314 12.3072C1.03357 10.9619 0.868469 9.51631 1.05017 8.09352C1.23187 6.67074 1.75499 5.31291 2.57496 4.1357C3.39494 2.95849 4.48748 1.99677 5.75954 1.33245C7.0316 0.668127 8.44548 0.320891 9.88076 0.320312ZM9.88076 3.05836C8.66164 3.05836 7.4699 3.41963 6.45625 4.09648C5.44259 4.77334 4.65254 5.73538 4.186 6.86095C3.71947 7.98651 3.5974 9.22506 3.83524 10.42C4.07307 11.6148 4.66014 12.7124 5.52218 13.5739C6.38423 14.4354 7.48254 15.022 8.67823 15.2597C9.87392 15.4974 11.1133 15.3754 12.2396 14.9092C13.3659 14.443 14.3286 13.6534 15.0059 12.6405C15.6832 11.6275 16.0447 10.4365 16.0447 9.21822C16.048 8.40837 15.8908 7.60588 15.5822 6.85705C15.2737 6.10821 14.8197 5.42784 14.2467 4.85518C13.6737 4.28253 12.9928 3.82892 12.2435 3.52053C11.4942 3.21214 10.6911 3.05506 9.88076 3.05836Z" fill="#F58B1E" />
                                        </svg>
                                    </span>
                                    <p class="m-0 primary-text-color find-plan-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Find a Better Plan')}}</p>
                                </div>
                                <p class="m-0 mt-3 primary-text-color find-better-plan-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                    {{__('Not enough connections in your plan? Let us help you find the right plan for your needs, and make the switch quick and easy.')}}
                                </p>
                                <div class="mt-2">
                                    <a href="{{ url('/dashboard/subscribe-plan') }}" class="d-flex flex-row align-items-center justify-content-center find-better-change-btn border-0 text-decoration-none">
                                        <span class="primary-text-color find-better-change-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Change')}}</span>
                                    </a>
                                </div>
                            </div>
                            @if($subscription_data && (empty($ends_at) || $isPaypal))
                            <div class="p-4  mb-5 find-a-better-plan-wrapper">
                                <div class="d-flex flex-row align-items-center justify-content-start" style="gap: 10px;">
                                    <span>
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.71526 1.27441C3.56634 1.12549 3.38955 1.00736 3.19497 0.926763C3.0004 0.846169 2.79186 0.804688 2.58126 0.804688C2.37065 0.804688 2.16211 0.846169 1.96754 0.926763C1.77297 1.00736 1.59618 1.12549 1.44726 1.27441C1.1465 1.57516 0.977539 1.98307 0.977539 2.40841C0.977539 2.83374 1.1465 3.24165 1.44726 3.54241L10.7093 12.8044L1.44726 22.0664C1.1465 22.3672 0.977539 22.7751 0.977539 23.2004C0.977539 23.6257 1.1465 24.0336 1.44726 24.3344C1.74801 24.6352 2.15592 24.8041 2.58126 24.8041C3.00659 24.8041 3.4145 24.6352 3.71526 24.3344L12.9773 15.0724L22.2393 24.3344C22.54 24.6352 22.9479 24.8041 23.3733 24.8041C23.7986 24.8041 24.2065 24.6352 24.5073 24.3344C24.808 24.0336 24.977 23.6257 24.977 23.2004C24.977 22.7751 24.808 22.3672 24.5073 22.0664L15.2453 12.8044L24.5073 3.54241C24.808 3.24165 24.977 2.83374 24.977 2.40841C24.977 1.98307 24.808 1.57516 24.5073 1.27441C24.2065 0.97365 23.7986 0.804688 23.3733 0.804688C22.9479 0.804688 22.54 0.97365 22.2393 1.27441L12.9773 10.5364L3.71526 1.27441Z" fill="#F58B1E" />
                                        </svg>
                                    </span>
                                    <p class="m-0 primary-text-color find-plan-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('End Your Subscription')}}</p>
                                </div>
                                <p class="m-0 mt-3 primary-text-color find-better-plan-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                    {{__('Sometimes you just need to call it quits. We get it and would love to have you back. Make sure to keep an eye out on our offers!')}}
                                </p>
                                <div class="mt-2">
                                    <button type="button" onclick="endSubBlock()" class="end-service-btn border-0">
                                        <span class="primary-text-color find-better-change-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('End Service')}}</span>
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="end-subscription-footer py-4 d-none">
                    <div class="d-block d-md-flex flex-row align-items-center justify-content-between">
                        <div class="d-none d-md-flex flex-column need-help-container">
                            <p class="m-0 primary-text-color need-help-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Need Help?')}}</p>
                            <div class="d-flex flex-column need-help-sub-container">
                                <a href="/" class="d-flex flex-row align-items-center need-help-video-container">
                                    <span>
                                        <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.97949 1.5V17.5L13.7664 9.5L2.97949 1.5Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <p class="m-0 need-help-sub-aticles @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Watch Video')}}</p>
                                </a>
                                <a href="/" class="d-flex flex-row align-items-center need-help-video-container">
                                    <span>
                                        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.90343 0.5C7.03225 0.500861 8.1372 0.827159 9.08754 1.44029C10.0379 2.05341 10.7938 2.92771 11.2659 3.95971C11.7381 4.99172 11.9066 6.13825 11.7516 7.26364C11.5966 8.38903 11.1245 9.44618 10.3913 10.31L10.6367 10.557H11.354L15.8955 15.129L14.5333 16.5L9.99186 11.929V11.207L9.74645 10.96C9.0234 11.5828 8.16152 12.0205 7.23419 12.2359C6.30687 12.4512 5.34157 12.4378 4.42051 12.1967C3.49945 11.9557 2.64991 11.4942 1.94423 10.8515C1.23855 10.2088 0.69764 9.404 0.367562 8.50559C0.0374844 7.60718 -0.0719839 6.64178 0.0484793 5.69161C0.168943 4.74145 0.515769 3.83466 1.05942 3.04846C1.60308 2.26227 2.32746 1.61996 3.17087 1.17623C4.01428 0.732508 4.95175 0.500512 5.90343 0.5V0.5ZM5.90343 2.329C5.09502 2.329 4.30475 2.57028 3.63258 3.02233C2.96041 3.47439 2.43651 4.11691 2.12714 4.86864C1.81777 5.62038 1.73683 6.44756 1.89454 7.2456C2.05226 8.04364 2.44155 8.77668 3.01319 9.35204C3.58482 9.92739 4.31313 10.3192 5.10602 10.478C5.8989 10.6367 6.72075 10.5552 7.46763 10.2438C8.21451 9.93246 8.85288 9.40516 9.30201 8.72862C9.75114 8.05207 9.99087 7.25667 9.99087 6.443C9.9927 5.90222 9.88823 5.36642 9.68347 4.86645C9.47871 4.36649 9.1777 3.91223 8.79778 3.52984C8.41786 3.14745 7.96654 2.84448 7.4698 2.63839C6.97306 2.4323 6.44072 2.32715 5.90343 2.329V2.329Z" fill="#F58B1E" />
                                        </svg>
                                    </span>
                                    <p class="m-0 need-help-sub-aticles @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('View Demo')}}</p>
                                </a>
                                <a href="/" class="d-flex flex-row align-items-center need-help-video-container">
                                    <span>
                                        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.94834 1.948C9.23999 1.94642 10.5031 2.33069 11.5776 3.05214C12.6521 3.77358 13.4897 4.79976 13.9844 6.0007C14.479 7.20163 14.6084 8.52331 14.3563 9.79834C14.1041 11.0734 13.4816 12.2444 12.5677 13.1631C11.6538 14.0818 10.4896 14.7069 9.22252 14.9592C7.95542 15.2114 6.64243 15.0795 5.44986 14.5802C4.25728 14.0809 3.23876 13.2365 2.52328 12.1542C1.8078 11.0718 1.42756 9.80005 1.4307 8.5C1.43491 6.76222 2.12319 5.09694 3.3448 3.86889C4.56641 2.64083 6.22177 1.95011 7.94834 1.948ZM7.94834 0.5C6.37631 0.5 4.83958 0.969192 3.53248 1.84824C2.22538 2.72729 1.20662 3.97672 0.605034 5.43853C0.00344386 6.90034 -0.15396 8.50887 0.152729 10.0607C0.459417 11.6126 1.21642 13.038 2.32802 14.1569C3.43961 15.2757 4.85587 16.0376 6.39769 16.3463C7.93952 16.655 9.53766 16.4965 10.99 15.891C12.4424 15.2855 13.6838 14.2602 14.5571 12.9446C15.4305 11.629 15.8967 10.0823 15.8967 8.5C15.8967 6.37827 15.0593 4.34344 13.5687 2.84315C12.0781 1.34285 10.0564 0.5 7.94834 0.5Z" fill="#F58B1E" />
                                            <path d="M8.1065 10.2935L7.51119 10.325C7.48646 10.3286 7.46126 10.3273 7.43705 10.321C7.41284 10.3148 7.3901 10.3037 7.37015 10.2886C7.3502 10.2734 7.33344 10.2544 7.32085 10.2327C7.30825 10.211 7.30006 10.187 7.29676 10.162C7.22701 9.6303 7.22672 9.09167 7.29592 8.55987C7.34624 8.30769 7.46169 8.0733 7.63064 7.88031C7.7853 7.69791 7.95771 7.5316 8.12157 7.35373C8.28542 7.17585 8.50039 6.98627 8.6902 6.81003C8.78039 6.73214 8.84879 6.63187 8.88859 6.51916C8.9284 6.40646 8.93823 6.28524 8.91712 6.16753C8.896 6.04981 8.84468 5.9397 8.76823 5.84812C8.69179 5.75654 8.59288 5.68667 8.48132 5.64544C8.34503 5.57976 8.19722 5.54175 8.04633 5.53357C7.89544 5.5254 7.74443 5.54722 7.60193 5.59779C7.45942 5.64836 7.3282 5.72669 7.21577 5.8283C7.10335 5.92992 7.01191 6.05283 6.94668 6.19002L6.90263 6.29949C6.86627 6.40326 6.83854 6.5099 6.81974 6.61829C6.82021 6.64764 6.81392 6.6767 6.80136 6.70318C6.7888 6.72967 6.77032 6.75287 6.74735 6.77096C6.72439 6.78905 6.69758 6.80154 6.66902 6.80746C6.64046 6.81337 6.61092 6.81254 6.58273 6.80504L5.39846 6.76036C5.37135 6.76088 5.3444 6.75601 5.31917 6.74602C5.29394 6.73602 5.27092 6.72111 5.25144 6.70212C5.23196 6.68314 5.2164 6.66047 5.20566 6.63541C5.19491 6.61036 5.1892 6.58341 5.18884 6.55612C5.21797 6.02949 5.41649 5.52668 5.75444 5.12356C6.09238 4.72044 6.55142 4.43888 7.06229 4.32137C7.73856 4.11196 8.4621 4.1143 9.13702 4.32809C9.43217 4.433 9.70234 4.5987 9.93028 4.81461C10.1582 5.03053 10.3389 5.29191 10.4609 5.58207C10.591 5.86592 10.643 6.17975 10.6114 6.49074C10.5798 6.80174 10.4658 7.09848 10.2813 7.34996C10.0178 7.70566 9.71767 8.03231 9.3859 8.32446L9.07308 8.64137C8.98811 8.72862 8.9258 8.8356 8.89165 8.95284C8.8575 9.07008 8.85256 9.19399 8.87727 9.31361C8.89058 9.56925 8.90327 9.81292 8.91684 10.0736C8.92045 10.0985 8.91912 10.1238 8.91292 10.1482C8.90672 10.1726 8.89577 10.1954 8.88071 10.2155C8.86565 10.2356 8.84678 10.2525 8.8252 10.2651C8.80361 10.2778 8.77974 10.2861 8.75496 10.2894L8.10806 10.3235L8.1065 10.2935Z" fill="#F58B1E" />
                                            <path d="M9.02098 12.0518C9.02949 12.2151 8.98968 12.3774 8.90659 12.5179C8.8235 12.6585 8.70086 12.7711 8.55418 12.8415C8.4075 12.9119 8.24337 12.937 8.08255 12.9135C7.92172 12.8901 7.77142 12.8191 7.65065 12.7097C7.52988 12.6002 7.44407 12.4572 7.40407 12.2987C7.36407 12.1401 7.37167 11.9732 7.42592 11.819C7.48017 11.6648 7.57862 11.5303 7.70883 11.4324C7.83904 11.3346 7.99516 11.2778 8.15745 11.2692C8.37507 11.2577 8.5883 11.3337 8.75025 11.4805C8.91219 11.6273 9.00958 11.8328 9.02098 12.0518Z" fill="#F58B1E" />
                                        </svg>
                                    </span>
                                    <p class="m-0 need-help-sub-aticles @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Read Help Article')}}</p>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-column" style="gap:23px">
                            <p class="m-0 end-subscription-confirmation text-center @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Are you sure to end the subscription?')}}</p>
                            <div class="d-flex flex-row align-items-center justify-content-center justify-content-md-end end-subscription-confirmation-buttons-container">
                                <button type="button" onclick="endSubBlock()" class="border-0 d-flex flex-row align-items-center justify-content-center end-subscription-back-btn">
                                    <span class="primary-text-color end-subscription-back-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back')}}</span>
                                </button>
                                <button type="button" onclick="cancelSubscription()"  class="border-0 d-flex flex-row align-items-center justify-content-center end-subscription-btn">
                                    <span class="text-white end-subscription-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('End Subscription')}}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="managePaymentMethod" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="managePaymentMethod" tabindex="-1">
    <div class="modal-dialog" style="max-width:1020px;max-height:800px;">
        <div class="modal-content bg-white border-0 custom-modal-content">
            <!-- header -->
            @include('tenant.v2.response-view.billing-modal-header',['get_locale'=>$get_locale,'header'=>__('Manage payment method')])
            <!-- body -->
            <div class="px-3 px-sm-5 pb-5">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div>
                            @include('tenant.v2.response-view.subscription-in-modal',['get_locale'=>$get_locale])
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mt-3 mt-md-0 mobile-edit-payment-container">
                            <p class="d-none d-md-block m-0 py-3 primary-text-color manage-subscription-available-action @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Edit payment method')}}</p>
                            <div class=" d-flex flex-column mobile-edit-payment-sub-container" >
                                <p class="m-0 mb-2 mobile-edit-payment-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Your payment method')}}</p>
                                @if(!$payment_methods->isEmpty() || $user_company->paypal_method)
                                @foreach($payment_methods as $payment_method)
                                <button type="button" id="{{ $payment_method->id }}" class="bg-transparent d-flex flex-row align-items-center justify-content-center payment-method-added-container py-3 {{!$isPaypalDefault && ($payment_method == $default_payment_method) ? 'default-method' : 'additional-method'}}">
                                    <span>
                                        <!-- visa -->
                                        @if($payment_method->card->brand=='visa')
                                        <svg width="60" height="43" viewBox="0 0 60 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_4770_16932)">
                                                <path d="M52 3.95312H8C6.89543 3.95312 6 4.84856 6 5.95312V31.9531C6 33.0577 6.89543 33.9531 8 33.9531H52C53.1046 33.9531 54 33.0577 54 31.9531V5.95312C54 4.84856 53.1046 3.95312 52 3.95312Z" fill="white" />
                                            </g>
                                            <path d="M27.3838 25.0139H24.3218L26.2368 13.1719H29.2988L27.3838 25.0139Z" fill="#00579F" />
                                            <path d="M38.4833 13.4611C37.607 13.1251 36.6757 12.9555 35.7372 12.9611C32.7132 12.9611 30.5843 14.5731 30.5713 16.8791C30.5463 18.5791 32.0962 19.5251 33.2552 20.0921C34.4402 20.6721 34.8423 21.0501 34.8423 21.5661C34.8303 22.3591 33.8852 22.7251 33.0032 22.7251C32.0085 22.7528 31.0221 22.5365 30.1302 22.0951L29.7303 21.9061L29.3022 24.5641C30.3911 24.9862 31.5495 25.1999 32.7173 25.1941C35.9303 25.1941 38.0173 23.6061 38.0463 21.1501C38.0583 19.8021 37.2403 18.7691 35.4763 17.9251C34.4053 17.3831 33.7493 17.0181 33.7493 16.4631C33.7623 15.9631 34.3042 15.4431 35.5132 15.4431C36.298 15.4199 37.0779 15.5748 37.7943 15.8961L38.0713 16.0221L38.4872 13.4651L38.4833 13.4611Z" fill="#00579F" />
                                            <path d="M42.5529 20.814C42.8049 20.134 43.7759 17.501 43.7759 17.501C43.7629 17.526 44.0279 16.808 44.1759 16.367L44.3899 17.387C44.3899 17.387 44.9699 20.222 45.0959 20.814H42.5529ZM46.3329 13.167H43.9649C43.6264 13.1264 43.2841 13.2014 42.9937 13.3798C42.7032 13.5583 42.4816 13.8297 42.3649 14.15L37.8169 25.01H41.0299L41.6729 23.234H45.6039C45.6919 23.65 45.9689 25.01 45.9689 25.01H48.8039L46.3339 13.168L46.3329 13.167Z" fill="#00579F" />
                                            <path d="M21.7675 13.1729L18.7675 21.2479L18.4395 19.6099C17.6936 17.4872 16.1847 15.7178 14.2065 14.6459L16.9535 25.0019H20.1915L25.0045 13.1719L21.7675 13.1729Z" fill="#00579F" />
                                            <path d="M15.9804 13.1687H11.0534L11.0034 13.4077C12.6575 13.7484 14.2018 14.4927 15.4988 15.5744C16.7958 16.6561 17.8052 18.0416 18.4374 19.6077L17.3664 14.1647C17.3019 13.8551 17.1239 13.5808 16.8674 13.3958C16.611 13.2107 16.2946 13.1283 15.9804 13.1647V13.1687Z" fill="#FAA61A" />
                                            <defs>
                                                <filter id="filter0_d_4770_16932" x="0" y="0.953125" width="60" height="42" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset dy="3" />
                                                    <feGaussianBlur stdDeviation="3" />
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4770_16932" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4770_16932" result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                        @else
                                        <!-- master card -->
                                        <svg width="60" height="43" viewBox="0 0 60 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_4770_16924)">
                                                <path d="M52 3.95312H8C6.89543 3.95312 6 4.84856 6 5.95312V31.9531C6 33.0577 6.89543 33.9531 8 33.9531H52C53.1046 33.9531 54 33.0577 54 31.9531V5.95312C54 4.84856 53.1046 3.95312 52 3.95312Z" fill="white" />
                                            </g>
                                            <path d="M34.3847 11.0625H25.5967V26.8505H34.3847V11.0625Z" fill="#FF5A00" />
                                            <path d="M26.1819 18.9579C26.1824 17.439 26.5265 15.94 27.1883 14.5729C27.8502 13.2059 28.8128 12.0063 30.0039 11.0639C28.7451 10.0759 27.2684 9.4031 25.6969 9.10164C24.1253 8.80017 22.5045 8.87875 20.9695 9.33082C19.4345 9.78289 18.0298 10.5954 16.8725 11.7005C15.7152 12.8056 14.8388 14.1714 14.3165 15.6839C13.7942 17.1965 13.641 18.812 13.8697 20.3957C14.0984 21.9795 14.7024 23.4856 15.6313 24.7886C16.5602 26.0916 17.7872 27.1536 19.2099 27.8862C20.6325 28.6187 22.2097 29.0006 23.8099 28.9999C26.0574 29.0012 28.2397 28.2444 30.0039 26.8519C28.8101 25.9119 27.8457 24.7128 27.1835 23.3452C26.5214 21.9776 26.1789 20.4773 26.1819 18.9579Z" fill="#EB001B" />
                                            <path d="M46.2399 18.9565C46.2418 20.8402 45.7134 22.6864 44.715 24.2838C43.7166 25.8813 42.2886 27.1653 40.5945 27.989C38.9004 28.8127 37.0086 29.1427 35.1356 28.9414C33.2627 28.74 31.4842 28.0154 30.0039 26.8505C31.1955 25.9084 32.1583 24.7089 32.8202 23.3418C33.4822 21.9746 33.826 20.4754 33.826 18.9565C33.826 17.4375 33.4822 15.9383 32.8202 14.5711C32.1583 13.204 31.1955 12.0045 30.0039 11.0625C31.4842 9.89751 33.2627 9.17289 35.1356 8.97154C37.0086 8.77019 38.9004 9.10025 40.5945 9.92394C42.2886 10.7476 43.7166 12.0317 44.715 13.6291C45.7134 15.2265 46.2418 17.0727 46.2399 18.9565Z" fill="#F79E1B" />
                                            <defs>
                                                <filter id="filter0_d_4770_16924" x="0" y="0.953125" width="60" height="42" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset dy="3" />
                                                    <feGaussianBlur stdDeviation="3" />
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4770_16924" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4770_16924" result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                        @endif
                                    </span>
                                    <div class="d-none d-md-flex  flex-column align-items-start">
                                        <p class="m-0 primary-text-color card-signed-as-email @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"> {{ $payment_method->card->brand }} {{__('card signed in as')}}</p>
                                        <p class="m-0 card-signed-as-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{ $user_company->name }}</p>
                                    </div>
                                    <p class="d-block d-md-none m-0 mobile-card-signed-as-email @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                        {{__('Your')}} {{ $payment_method->card->brand }} {{__('card signed in as')}} {{ $user_company->name }}
                                    </p>
                                    @if(($payment_method != $default_payment_method) || $isPaypalDefault)
                                    <span role="button" onclick="deletePM(event, '{{ $payment_method->id }}')" class="delete-method d-none">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.87015 0.957347C2.34177 0.428968 1.48509 0.428968 0.956715 0.957347C0.428336 1.48573 0.428336 2.3424 0.956715 2.87078L13.0341 14.9482C13.5625 15.4765 14.4192 15.4765 14.9475 14.9482C15.4759 14.4198 15.4759 13.5631 14.9475 13.0347L2.87015 0.957347Z" fill="#F58B1E"/>
                                        <path d="M15.0405 1.05228C15.1678 1.17738 15.269 1.3266 15.3381 1.49123C15.4071 1.65585 15.4427 1.83259 15.4427 2.01112C15.4427 2.18964 15.4071 2.36638 15.3381 2.53101C15.269 2.69563 15.1678 2.84485 15.0405 2.96995L2.90229 14.9554C2.64315 15.2098 2.29454 15.3523 1.93143 15.3523C1.56832 15.3523 1.21972 15.2098 0.960574 14.9554C0.833886 14.8302 0.733342 14.6811 0.664785 14.5167C0.596227 14.3524 0.561023 14.176 0.561221 13.9979C0.561418 13.8198 0.597012 13.6435 0.665934 13.4793C0.734856 13.3151 0.835731 13.1662 0.962697 13.0413L13.0959 1.04945C13.3556 0.794628 13.705 0.652102 14.0688 0.652632C14.4326 0.653161 14.7816 0.796702 15.0405 1.05228Z" fill="#F58B1E"/>
                                        </svg>
                                    </span>
                                    @else
                                    <span role="button" class="delete-method d-none">
                                        &nbsp;
                                    </span>
                                    @endif
                                </button>
                                @endforeach
                                @if($user_company->paypal_method)
                                <button type="button" id="paypal-method" class="bg-transparent d-flex flex-row align-items-center justify-content-center payment-method-added-container py-3 {{$isPaypalDefault ? 'default-method' : 'additional-method'}}"">
                                    <span>
                                        <!-- paypal -->
                                        <svg width="61" height="42" viewBox="0 0 61 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_4493_5305)">
                                                <path d="M52.0469 3H8.04688C6.94231 3 6.04688 3.89543 6.04688 5V31C6.04688 32.1046 6.94231 33 8.04688 33H52.0469C53.1514 33 54.0469 32.1046 54.0469 31V5C54.0469 3.89543 53.1514 3 52.0469 3Z" fill="white" />
                                            </g>
                                            <path d="M16.1857 12.6137H13.0417C12.9376 12.6137 12.8368 12.6508 12.7576 12.7185C12.6784 12.7861 12.6259 12.8798 12.6097 12.9827L11.3377 21.0447C11.3323 21.0819 11.3349 21.1199 11.3454 21.156C11.3559 21.1921 11.3741 21.2255 11.3986 21.254C11.4232 21.2824 11.4536 21.3053 11.4878 21.3209C11.522 21.3366 11.5591 21.3447 11.5967 21.3447H13.0967C13.2009 21.3448 13.3017 21.3077 13.3809 21.24C13.4601 21.1724 13.5125 21.0786 13.5287 20.9757L13.8717 18.8007C13.8877 18.6979 13.94 18.6042 14.019 18.5365C14.098 18.4689 14.1987 18.4317 14.3027 18.4317H15.3027C15.7348 18.479 16.172 18.4385 16.5881 18.3127C17.0042 18.1869 17.3906 17.9783 17.7241 17.6996C18.0577 17.4209 18.3315 17.0777 18.5292 16.6905C18.7269 16.3034 18.8445 15.8804 18.8747 15.4467C18.9621 15.0998 18.9716 14.7379 18.9024 14.3869C18.8332 14.0359 18.6872 13.7046 18.4747 13.4167C18.1731 13.1265 17.8126 12.9046 17.4177 12.766C17.0227 12.6275 16.6025 12.5755 16.1857 12.6137ZM16.5487 15.5587C16.3767 16.6867 15.5147 16.6867 14.6807 16.6867H14.2067L14.5397 14.5797C14.5495 14.5181 14.581 14.462 14.6284 14.4214C14.6759 14.3809 14.7363 14.3587 14.7987 14.3587H15.0157C15.5837 14.3587 16.1157 14.3587 16.3957 14.6827C16.4837 14.8087 16.543 14.9524 16.5692 15.1038C16.5955 15.2552 16.5882 15.4105 16.5477 15.5587H16.5487Z" fill="#253B80" />
                                            <path d="M25.019 15.5233H23.513C23.4506 15.5232 23.3902 15.5455 23.3428 15.586C23.2953 15.6265 23.2638 15.6826 23.254 15.7443L23.187 16.1653L23.082 16.0123C22.8535 15.7784 22.5744 15.6 22.2662 15.4906C21.958 15.3812 21.6289 15.3438 21.304 15.3813C20.4736 15.3988 19.6771 15.7142 19.0599 16.2701C18.4427 16.826 18.046 17.5852 17.942 18.4093C17.8628 18.8125 17.8719 19.228 17.9687 19.6273C18.0656 20.0267 18.2479 20.4002 18.503 20.7223C18.7416 20.9848 19.0364 21.19 19.3654 21.3226C19.6944 21.4552 20.0491 21.5119 20.403 21.4883C20.7905 21.4921 21.1748 21.4178 21.5329 21.2697C21.891 21.1216 22.2155 20.9027 22.487 20.6263L22.42 21.0443C22.4146 21.0814 22.4172 21.1193 22.4276 21.1553C22.4381 21.1913 22.4562 21.2247 22.4806 21.2531C22.5051 21.2816 22.5354 21.3044 22.5694 21.3202C22.6035 21.3359 22.6405 21.3441 22.678 21.3443H24.033C24.1372 21.3444 24.238 21.3072 24.3172 21.2396C24.3964 21.1719 24.4488 21.0782 24.465 20.9753L25.279 15.8223C25.2845 15.7851 25.2819 15.7471 25.2713 15.7109C25.2607 15.6748 25.2425 15.6414 25.2178 15.613C25.1931 15.5846 25.1625 15.5619 25.1282 15.5464C25.0939 15.5309 25.0567 15.523 25.019 15.5233ZM22.919 18.4533C22.8605 18.8594 22.6552 19.2299 22.3419 19.4949C22.0287 19.7598 21.6292 19.9009 21.219 19.8913C21.0307 19.911 20.8404 19.8846 20.6646 19.8142C20.4888 19.7439 20.3328 19.6318 20.21 19.4877C20.0872 19.3436 20.0014 19.1717 19.9599 18.9869C19.9185 18.8022 19.9226 18.6101 19.972 18.4273C20.0293 18.0221 20.2321 17.6516 20.5426 17.385C20.853 17.1183 21.2498 16.9738 21.659 16.9783C21.8456 16.9689 22.032 17.0007 22.2048 17.0716C22.3777 17.1425 22.5328 17.2506 22.659 17.3883C22.7775 17.5361 22.8622 17.708 22.9073 17.8919C22.9524 18.0759 22.9567 18.2675 22.92 18.4533H22.919Z" fill="#253B80" />
                                            <path d="M32.3961 15.5234H30.8831C30.8116 15.5235 30.7413 15.541 30.6782 15.5745C30.6151 15.608 30.5612 15.6563 30.5211 15.7154L28.4341 18.7894L27.5491 15.8354C27.522 15.7453 27.4666 15.6663 27.3912 15.6101C27.3157 15.5539 27.2241 15.5235 27.1301 15.5234H25.6431C25.6012 15.5233 25.56 15.5331 25.5228 15.5521C25.4855 15.5711 25.4534 15.5987 25.429 15.6327C25.4046 15.6667 25.3888 15.706 25.3827 15.7473C25.3766 15.7887 25.3805 15.8309 25.3941 15.8704L27.0611 20.7614L25.4941 22.9734C25.4661 23.0127 25.4495 23.0588 25.4461 23.1069C25.4427 23.1549 25.4526 23.203 25.4747 23.2457C25.4968 23.2885 25.5303 23.3244 25.5715 23.3494C25.6126 23.3744 25.6599 23.3875 25.7081 23.3874H27.2191C27.2896 23.3875 27.3592 23.3704 27.4217 23.3377C27.4843 23.3049 27.5379 23.2575 27.5781 23.1994L32.6101 15.9354C32.6374 15.8962 32.6536 15.8503 32.6567 15.8025C32.6598 15.7548 32.6498 15.7071 32.6277 15.6647C32.6057 15.6222 32.5725 15.5866 32.5316 15.5617C32.4908 15.5368 32.4439 15.5236 32.3961 15.5234Z" fill="#253B80" />
                                            <path d="M36.8195 12.6139H33.6745C33.5705 12.614 33.47 12.6513 33.391 12.7189C33.312 12.7865 33.2597 12.8801 33.2435 12.9829L31.9715 21.0449C31.9661 21.082 31.9687 21.1198 31.9791 21.1559C31.9896 21.1919 32.0076 21.2253 32.0321 21.2537C32.0566 21.2821 32.0869 21.305 32.1209 21.3207C32.155 21.3365 32.192 21.3447 32.2295 21.3449H33.8435C33.916 21.3443 33.9859 21.3181 34.0408 21.2709C34.0958 21.2236 34.1322 21.1584 34.1435 21.0869L34.5045 18.8019C34.5205 18.699 34.5727 18.6053 34.6518 18.5377C34.7308 18.47 34.8315 18.4328 34.9355 18.4329H35.9275C36.3604 18.481 36.7985 18.441 37.2155 18.3154C37.6326 18.1898 38.0199 17.9812 38.3542 17.7021C38.6885 17.423 38.963 17.0791 39.161 16.6912C39.359 16.3033 39.4765 15.8794 39.5065 15.4449C39.594 15.098 39.6036 14.736 39.5344 14.385C39.4652 14.0339 39.3191 13.7026 39.1065 13.4149C38.8051 13.1251 38.4448 12.9036 38.0502 12.7654C37.6556 12.6272 37.2359 12.5755 36.8195 12.6139ZM37.1825 15.5589C37.0115 16.6869 36.1485 16.6869 35.3145 16.6869H34.8405L35.1735 14.5799C35.1831 14.5183 35.2143 14.4622 35.2616 14.4216C35.309 14.3811 35.3692 14.3588 35.4315 14.3589H35.6485C36.2155 14.3589 36.7485 14.3589 37.0285 14.6829C37.1167 14.8087 37.1761 14.9524 37.2025 15.1038C37.229 15.2552 37.2218 15.4106 37.1815 15.5589H37.1825Z" fill="#179BD7" />
                                            <path d="M45.3862 15.5233H43.8862C43.8239 15.5233 43.7636 15.5456 43.7163 15.5861C43.669 15.6267 43.6377 15.6828 43.6282 15.7443L43.5612 16.1653L43.4552 16.0123C43.2267 15.7784 42.9476 15.5999 42.6394 15.4905C42.3312 15.3812 42.0021 15.3438 41.6772 15.3813C40.8469 15.399 40.0507 15.7146 39.4337 16.2704C38.8167 16.8263 38.4201 17.5854 38.3162 18.4093C38.2369 18.8124 38.2459 19.228 38.3425 19.6273C38.4392 20.0266 38.6213 20.4002 38.8762 20.7223C39.1148 20.9848 39.4096 21.1899 39.7386 21.3226C40.0676 21.4552 40.4223 21.5119 40.7762 21.4883C41.1637 21.4922 41.548 21.4178 41.906 21.2697C42.2641 21.1216 42.5886 20.9028 42.8602 20.6263L42.7932 21.0443C42.7877 21.0815 42.7904 21.1195 42.8009 21.1556C42.8114 21.1917 42.8295 21.2251 42.8541 21.2536C42.8787 21.282 42.9091 21.3049 42.9433 21.3205C42.9774 21.3362 43.0146 21.3443 43.0522 21.3443H44.4082C44.5122 21.3442 44.6127 21.3069 44.6917 21.2393C44.7707 21.1717 44.823 21.0781 44.8392 20.9753L45.6532 15.8223C45.6584 15.7846 45.6554 15.7461 45.6443 15.7096C45.6332 15.6732 45.6142 15.6395 45.5888 15.6111C45.5634 15.5826 45.5322 15.5601 45.4972 15.5449C45.4622 15.5298 45.4243 15.5224 45.3862 15.5233ZM43.2862 18.4533C43.2278 18.8595 43.0226 19.2302 42.7093 19.4952C42.396 19.7602 41.9964 19.9011 41.5862 19.8913C41.3979 19.9111 41.2076 19.8846 41.0318 19.8143C40.856 19.744 40.6999 19.6319 40.5771 19.4877C40.4543 19.3436 40.3685 19.1717 40.3271 18.987C40.2856 18.8022 40.2898 18.6101 40.3392 18.4273C40.3967 18.0222 40.5995 17.6519 40.9099 17.3853C41.2203 17.1187 41.617 16.974 42.0262 16.9783C42.2128 16.9689 42.3991 17.0008 42.572 17.0717C42.7448 17.1425 42.8999 17.2507 43.0262 17.3883C43.1447 17.5361 43.2294 17.708 43.2745 17.892C43.3196 18.0759 43.3239 18.2675 43.2872 18.4533H43.2862Z" fill="#179BD7" />
                                            <path d="M47.1619 12.8382L45.8709 21.0482C45.8655 21.0853 45.8681 21.1232 45.8785 21.1592C45.889 21.1952 45.9071 21.2286 45.9315 21.257C45.956 21.2855 45.9863 21.3083 46.0203 21.3241C46.0544 21.3398 46.0914 21.348 46.1289 21.3482H47.4289C47.5332 21.3485 47.634 21.3114 47.7133 21.2437C47.7925 21.176 47.8449 21.0822 47.8609 20.9792L49.1339 12.9172C49.1394 12.8801 49.1368 12.8422 49.1263 12.8062C49.1159 12.7702 49.0978 12.7368 49.0734 12.7084C49.0489 12.6799 49.0186 12.6571 48.9845 12.6413C48.9505 12.6256 48.9134 12.6174 48.8759 12.6172H47.4229C47.3602 12.6169 47.2995 12.639 47.2516 12.6795C47.2037 12.72 47.1719 12.7763 47.1619 12.8382Z" fill="#179BD7" />
                                            <defs>
                                                <filter id="filter0_d_4493_5305" x="0.046875" y="0" width="60" height="42" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset dy="3" />
                                                    <feGaussianBlur stdDeviation="3" />
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4493_5305" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4493_5305" result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                    </span>
                                    <div class="d-none d-md-flex flex-column align-items-start">
                                        <p class="m-0 primary-text-color card-signed-as-email @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"> {{__('PayPal')}}</p>
                                        <p class="m-0 card-signed-as-name">{{ $user_company->name}}</p>
                                    </div>
                                    <p class="d-block d-md-none m-0 mobile-card-signed-as-email @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                    {{__('Your')}} {{__('PayPal')}} {{__('card signed in as')}} {{ $user_company->name}}
                                    </p>
                                    
                                    @if(!$isPaypalDefault)
                                    <span role="button" onclick="deletePM(event, 'paypal-method')" class="delete-method d-none">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.87015 0.957347C2.34177 0.428968 1.48509 0.428968 0.956715 0.957347C0.428336 1.48573 0.428336 2.3424 0.956715 2.87078L13.0341 14.9482C13.5625 15.4765 14.4192 15.4765 14.9475 14.9482C15.4759 14.4198 15.4759 13.5631 14.9475 13.0347L2.87015 0.957347Z" fill="#F58B1E"/>
                                        <path d="M15.0405 1.05228C15.1678 1.17738 15.269 1.3266 15.3381 1.49123C15.4071 1.65585 15.4427 1.83259 15.4427 2.01112C15.4427 2.18964 15.4071 2.36638 15.3381 2.53101C15.269 2.69563 15.1678 2.84485 15.0405 2.96995L2.90229 14.9554C2.64315 15.2098 2.29454 15.3523 1.93143 15.3523C1.56832 15.3523 1.21972 15.2098 0.960574 14.9554C0.833886 14.8302 0.733342 14.6811 0.664785 14.5167C0.596227 14.3524 0.561023 14.176 0.561221 13.9979C0.561418 13.8198 0.597012 13.6435 0.665934 13.4793C0.734856 13.3151 0.835731 13.1662 0.962697 13.0413L13.0959 1.04945C13.3556 0.794628 13.705 0.652102 14.0688 0.652632C14.4326 0.653161 14.7816 0.796702 15.0405 1.05228Z" fill="#F58B1E"/>
                                        </svg>
                                    </span>
                                    @else
                                    <span role="button" class="delete-method d-none">
                                        &nbsp;
                                    </span>
                                    @endif
                                </button>
                                @endif
                                @else
                                <span class=" @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('No payment methods')}}</span>
                                @endif
                            </div>
                            <div id="edit-add-save-section" class="mt-2 d-flex flex-row align-items-center justify-content-between">
                                <div class="d-flex flex-row align-items-center justify-content-between add-edit-btn-conatiner">
                                    <button type="button" onclick="managePM(event)" class="border-0 bg-transparent">
                                        <span class="payment-edit-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Edit')}}</span>
                                    </button>
                                    <div class="add-edit-btn-divider"></div>
                                    <button type="button" onclick="openAddPaymentMethod('inside')" class="border-0 bg-transparent">
                                        <span class="payment-edit-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add New')}}</span>
                                    </button>
                                </div>
                                <div class="d-flex flex-row align-items-center save-and-lock-container">
                                    <span class="lock-icon-save">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.8254 18.6641C13.221 18.6641 13.6077 18.5468 13.9366 18.327C14.2655 18.1072 14.5218 17.7949 14.6732 17.4294C14.8246 17.064 14.8642 16.6618 14.787 16.2739C14.7098 15.8859 14.5194 15.5296 14.2397 15.2498C13.9599 14.9701 13.6036 14.7797 13.2156 14.7025C12.8277 14.6253 12.4255 14.6649 12.0601 14.8163C11.6946 14.9677 11.3823 15.224 11.1625 15.5529C10.9427 15.8818 10.8254 16.2685 10.8254 16.6641C10.8254 17.1945 11.0362 17.7032 11.4112 18.0783C11.7863 18.4533 12.295 18.6641 12.8254 18.6641ZM18.8254 9.66406C19.3559 9.66406 19.8646 9.87478 20.2397 10.2498C20.6147 10.6249 20.8254 11.1336 20.8254 11.6641V21.6641C20.8254 22.1945 20.6147 22.7032 20.2397 23.0783C19.8646 23.4533 19.3559 23.6641 18.8254 23.6641H6.82544C6.29501 23.6641 5.7863 23.4533 5.41123 23.0783C5.03615 22.7032 4.82544 22.1945 4.82544 21.6641V11.6641C4.82544 11.1336 5.03615 10.6249 5.41123 10.2498C5.7863 9.87478 6.29501 9.66406 6.82544 9.66406H7.82544V7.66406C7.82544 6.33798 8.35222 5.06621 9.28991 4.12853C10.2276 3.19085 11.4994 2.66406 12.8254 2.66406C14.1515 2.66406 15.4233 3.19085 16.361 4.12853C17.2987 5.06621 17.8254 6.33798 17.8254 7.66406V9.66406H18.8254ZM12.8254 4.66406C12.0298 4.66406 11.2667 4.98013 10.7041 5.54274C10.1415 6.10535 9.82544 6.86841 9.82544 7.66406V9.66406H15.8254V7.66406C15.8254 6.86841 15.5094 6.10535 14.9468 5.54274C14.3842 4.98013 13.6211 4.66406 12.8254 4.66406Z" fill="#FCDDC1"/>
                                        </svg>
                                    </span>
                                    <button type="button" id="savePM" disabled onclick="saveDefaultPM()" class="border-0 d-flex flex-row align-items-center justify-content-center cards-save-btn">
                                        <span class="cards-save-btn-text text-white @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Save')}}</span>
                                    </button>
                                </div>
                            </div>
                            <div id="mobile-add-payment-method" class="mt-3 d-flex flex-column d-none" style="gap:10px">
                                <p class="m-0 mb-2 mobile-edit-payment-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Your payment method')}}</p>
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <select onchange="selectPaymentMethod()" class="paymant-method-modal-right-side-first-field w-100 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" name="select" id="payment-selector2">
                                        <option class="paymant-method-modal-right-side-first-field-option @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"
                                                value="paypal">{{__('PayPal')}}
                                        </option>
                                        <option class="paymant-method-modal-right-side-first-field-option @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"
                                                value="card" selected>{{__('Visa/Mastercard')}}
                                        </option>
                                    </select>
                                    <div class="d-flex flex-row align-items-center justify-content-between">
                                        <!-- paypal -->
                                        <span>
                                            <svg width="61" height="43" viewBox="0 0 61 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_4770_1691423)">
                                            <path d="M52.3701 3.04688H8.37012C7.26555 3.04688 6.37012 3.94231 6.37012 5.04688V31.0469C6.37012 32.1514 7.26555 33.0469 8.37012 33.0469H52.3701C53.4747 33.0469 54.3701 32.1514 54.3701 31.0469V5.04688C54.3701 3.94231 53.4747 3.04688 52.3701 3.04688Z" fill="white"/>
                                            </g>
                                            <path d="M16.5095 12.6606H13.3655C13.2613 12.6605 13.1605 12.6977 13.0813 12.7653C13.0021 12.833 12.9497 12.9267 12.9335 13.0296L11.6615 21.0916C11.656 21.1288 11.6586 21.1668 11.6691 21.2029C11.6796 21.239 11.6978 21.2724 11.7224 21.3008C11.7469 21.3293 11.7774 21.3521 11.8115 21.3678C11.8457 21.3835 11.8829 21.3916 11.9205 21.3916H13.4205C13.5246 21.3917 13.6254 21.3546 13.7046 21.2869C13.7838 21.2192 13.8363 21.1255 13.8525 21.0226L14.1955 18.8476C14.2115 18.7448 14.2637 18.6511 14.3427 18.5834C14.4218 18.5157 14.5224 18.4786 14.6265 18.4786H15.6265C16.0586 18.5258 16.4958 18.4853 16.9118 18.3595C17.3279 18.2337 17.7143 18.0252 18.0479 17.7465C18.3814 17.4677 18.6553 17.1245 18.853 16.7374C19.0507 16.3503 19.1682 15.9272 19.1985 15.4936C19.2859 15.1467 19.2953 14.7848 19.2261 14.4338C19.157 14.0828 19.0109 13.7514 18.7985 13.4636C18.4969 13.1734 18.1364 12.9515 17.7414 12.8129C17.3464 12.6743 16.9263 12.6224 16.5095 12.6606ZM16.8725 15.6056C16.7005 16.7336 15.8385 16.7336 15.0045 16.7336H14.5305L14.8635 14.6266C14.8732 14.565 14.9047 14.5088 14.9522 14.4683C14.9997 14.4278 15.06 14.4056 15.1225 14.4056H15.3395C15.9075 14.4056 16.4395 14.4056 16.7195 14.7296C16.8075 14.8556 16.8667 14.9993 16.893 15.1507C16.9192 15.3021 16.9119 15.4574 16.8715 15.6056H16.8725Z" fill="#253B80"/>
                                            <path d="M25.3423 15.5702H23.8363C23.7739 15.5701 23.7135 15.5923 23.666 15.6329C23.6185 15.6734 23.587 15.7295 23.5773 15.7912L23.5103 16.2122L23.4053 16.0592C23.1767 15.8253 22.8976 15.6468 22.5895 15.5375C22.2813 15.4281 21.9521 15.3907 21.6273 15.4282C20.7968 15.4456 20.0004 15.7611 19.3832 16.317C18.766 16.8728 18.3692 17.6321 18.2653 18.4562C18.186 18.8593 18.1951 19.2749 18.292 19.6742C18.3888 20.0735 18.5711 20.4471 18.8263 20.7692C19.0649 21.0316 19.3597 21.2368 19.6887 21.3695C20.0177 21.5021 20.3723 21.5588 20.7263 21.5352C21.1138 21.539 21.498 21.4647 21.8561 21.3166C22.2142 21.1684 22.5387 20.9496 22.8103 20.6732L22.7433 21.0912C22.7378 21.1283 22.7404 21.1661 22.7509 21.2022C22.7613 21.2382 22.7794 21.2716 22.8039 21.3C22.8283 21.3284 22.8586 21.3513 22.8927 21.367C22.9267 21.3828 22.9638 21.391 23.0013 21.3912H24.3563C24.4605 21.3912 24.5612 21.3541 24.6404 21.2864C24.7196 21.2188 24.7721 21.1251 24.7883 21.0222L25.6023 15.8692C25.6078 15.8319 25.6051 15.7939 25.5946 15.7578C25.584 15.7217 25.5657 15.6883 25.541 15.6599C25.5163 15.6315 25.4858 15.6088 25.4515 15.5933C25.4172 15.5778 25.3799 15.5699 25.3423 15.5702ZM23.2423 18.5002C23.1837 18.9062 22.9784 19.2768 22.6652 19.5418C22.3519 19.8067 21.9524 19.9477 21.5423 19.9382C21.354 19.9579 21.1637 19.9314 20.9879 19.8611C20.812 19.7908 20.656 19.6787 20.5332 19.5346C20.4104 19.3904 20.3246 19.2185 20.2832 19.0338C20.2417 18.849 20.2459 18.657 20.2953 18.4742C20.3526 18.069 20.5554 17.6985 20.8658 17.4318C21.1762 17.1652 21.5731 17.0206 21.9823 17.0252C22.1689 17.0157 22.3552 17.0476 22.5281 17.1185C22.7009 17.1893 22.856 17.2975 22.9823 17.4352C23.1007 17.583 23.1855 17.7548 23.2306 17.9388C23.2756 18.1228 23.28 18.3143 23.2433 18.5002H23.2423Z" fill="#253B80"/>
                                            <path d="M32.7193 15.5703H31.2063C31.1349 15.5704 31.0646 15.5879 31.0015 15.6214C30.9384 15.6548 30.8844 15.7032 30.8443 15.7623L28.7573 18.8363L27.8723 15.8823C27.8452 15.7922 27.7899 15.7132 27.7144 15.657C27.6389 15.6008 27.5474 15.5704 27.4533 15.5703H25.9663C25.9245 15.5701 25.8832 15.5799 25.846 15.599C25.8088 15.618 25.7766 15.6456 25.7523 15.6796C25.7279 15.7135 25.712 15.7528 25.7059 15.7942C25.6998 15.8356 25.7037 15.8778 25.7173 15.9173L27.3843 20.8083L25.8173 23.0203C25.7894 23.0595 25.7728 23.1057 25.7694 23.1538C25.7659 23.2018 25.7758 23.2498 25.798 23.2926C25.8201 23.3354 25.8535 23.3713 25.8947 23.3963C25.9359 23.4213 25.9831 23.4344 26.0313 23.4343H27.5423C27.6129 23.4344 27.6824 23.4173 27.745 23.3846C27.8075 23.3518 27.8612 23.3044 27.9013 23.2463L32.9333 15.9823C32.9607 15.9431 32.9768 15.8971 32.9799 15.8494C32.983 15.8017 32.973 15.754 32.951 15.7115C32.9289 15.6691 32.8957 15.6335 32.8549 15.6086C32.814 15.5837 32.7671 15.5705 32.7193 15.5703Z" fill="#253B80"/>
                                            <path d="M37.1432 12.6607H33.9983C33.8943 12.6609 33.7937 12.6981 33.7147 12.7658C33.6357 12.8334 33.5834 12.927 33.5673 13.0297L32.2953 21.0917C32.2898 21.1289 32.2924 21.1667 32.3029 21.2027C32.3133 21.2388 32.3314 21.2721 32.3558 21.3006C32.3803 21.329 32.4106 21.3519 32.4446 21.3676C32.4787 21.3833 32.5157 21.3916 32.5533 21.3917H34.1673C34.2397 21.3912 34.3096 21.365 34.3646 21.3178C34.4195 21.2705 34.4559 21.2053 34.4672 21.1337L34.8282 18.8487C34.8442 18.7459 34.8965 18.6522 34.9755 18.5845C35.0546 18.5169 35.1552 18.4797 35.2592 18.4797H36.2513C36.6841 18.5278 37.1222 18.4879 37.5393 18.3623C37.9563 18.2367 38.3436 18.0281 38.6779 17.749C39.0123 17.4698 39.2867 17.126 39.4847 16.7381C39.6828 16.3502 39.8003 15.9262 39.8302 15.4917C39.9178 15.1448 39.9273 14.7829 39.8581 14.4318C39.789 14.0808 39.6428 13.7495 39.4303 13.4617C39.1288 13.172 38.7686 12.9505 38.374 12.8122C37.9793 12.674 37.5596 12.6224 37.1432 12.6607ZM37.5062 15.6057C37.3352 16.7337 36.4723 16.7337 35.6383 16.7337H35.1643L35.4973 14.6267C35.5068 14.5652 35.5381 14.5091 35.5854 14.4685C35.6327 14.428 35.6929 14.4057 35.7552 14.4057H35.9723C36.5393 14.4057 37.0722 14.4057 37.3522 14.7297C37.4404 14.8556 37.4998 14.9993 37.5263 15.1507C37.5527 15.3021 37.5455 15.4574 37.5052 15.6057H37.5062Z" fill="#179BD7"/>
                                            <path d="M45.7094 15.5702H44.2094C44.1471 15.5702 44.0869 15.5925 44.0396 15.633C43.9922 15.6735 43.961 15.7296 43.9514 15.7912L43.8844 16.2122L43.7784 16.0592C43.5499 15.8253 43.2708 15.6468 42.9626 15.5374C42.6544 15.428 42.3253 15.3907 42.0004 15.4282C41.1702 15.4459 40.3739 15.7615 39.757 16.3173C39.14 16.8732 38.7434 17.6323 38.6394 18.4562C38.5601 18.8593 38.5691 19.2748 38.6658 19.6741C38.7624 20.0734 38.9445 20.447 39.1994 20.7692C39.4381 21.0316 39.7329 21.2368 40.0619 21.3694C40.3908 21.5021 40.7455 21.5587 41.0994 21.5352C41.4869 21.5391 41.8712 21.4647 42.2293 21.3166C42.5874 21.1685 42.9119 20.9497 43.1834 20.6732L43.1164 21.0912C43.111 21.1284 43.1136 21.1664 43.1241 21.2025C43.1346 21.2386 43.1528 21.272 43.1773 21.3004C43.2019 21.3289 43.2323 21.3517 43.2665 21.3674C43.3007 21.3831 43.3378 21.3912 43.3754 21.3912H44.7314C44.8354 21.3911 44.936 21.3538 45.015 21.2862C45.094 21.2185 45.1463 21.1249 45.1624 21.0222L45.9764 15.8692C45.9817 15.8314 45.9786 15.793 45.9675 15.7565C45.9564 15.72 45.9375 15.6864 45.9121 15.658C45.8867 15.6295 45.8554 15.6069 45.8204 15.5918C45.7854 15.5766 45.7476 15.5693 45.7094 15.5702ZM43.6094 18.5002C43.5511 18.9064 43.3458 19.2771 43.0325 19.5421C42.7192 19.8071 42.3197 19.948 41.9094 19.9382C41.7211 19.9579 41.5308 19.9315 41.355 19.8612C41.1792 19.7909 41.0232 19.6788 40.9004 19.5346C40.7776 19.3905 40.6918 19.2186 40.6503 19.0338C40.6088 18.8491 40.613 18.657 40.6624 18.4742C40.7199 18.0691 40.9228 17.6987 41.2332 17.4321C41.5435 17.1655 41.9403 17.0209 42.3494 17.0252C42.536 17.0158 42.7224 17.0477 42.8952 17.1185C43.0681 17.1894 43.2232 17.2975 43.3494 17.4352C43.4679 17.583 43.5526 17.7549 43.5977 17.9388C43.6428 18.1228 43.6471 18.3144 43.6104 18.5002H43.6094Z" fill="#179BD7"/>
                                            <path d="M47.4857 12.8851L46.1947 21.0951C46.1892 21.1322 46.1918 21.17 46.2023 21.2061C46.2127 21.2421 46.2308 21.2755 46.2553 21.3039C46.2797 21.3323 46.31 21.3552 46.3441 21.3709C46.3781 21.3867 46.4151 21.3949 46.4527 21.3951H47.7527C47.8569 21.3953 47.9578 21.3583 48.037 21.2906C48.1163 21.2229 48.1686 21.1291 48.1847 21.0261L49.4577 12.9641C49.4631 12.9269 49.4605 12.8891 49.4501 12.8531C49.4396 12.817 49.4215 12.7837 49.3971 12.7552C49.3726 12.7268 49.3423 12.7039 49.3083 12.6882C49.2742 12.6725 49.2372 12.6642 49.1997 12.6641H47.7467C47.684 12.6637 47.6232 12.6858 47.5753 12.7264C47.5275 12.7669 47.4957 12.8232 47.4857 12.8851Z" fill="#179BD7"/>
                                            <defs>
                                            <filter id="filter0_d_4770_1691423" x="0.370117" y="0.046875" width="60" height="42" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                            <feOffset dy="3"/>
                                            <feGaussianBlur stdDeviation="3"/>
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0"/>
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4770_16914"/>
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4770_16914" result="shape"/>
                                            </filter>
                                            </defs>
                                            </svg>

                                        </span>
                                            <!-- master -->
                                        <span>
                                            <svg width="60" height="43" viewBox="0 0 60 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_4770_1692434)">
                                            <path d="M52 3.95312H8C6.89543 3.95312 6 4.84856 6 5.95312V31.9531C6 33.0577 6.89543 33.9531 8 33.9531H52C53.1046 33.9531 54 33.0577 54 31.9531V5.95312C54 4.84856 53.1046 3.95312 52 3.95312Z" fill="white"/>
                                            </g>
                                            <path d="M34.3847 11.0625H25.5967V26.8505H34.3847V11.0625Z" fill="#FF5A00"/>
                                            <path d="M26.1819 18.9579C26.1824 17.439 26.5265 15.94 27.1883 14.5729C27.8502 13.2059 28.8128 12.0063 30.0039 11.0639C28.7451 10.0759 27.2684 9.4031 25.6969 9.10164C24.1253 8.80017 22.5045 8.87875 20.9695 9.33082C19.4345 9.78289 18.0298 10.5954 16.8725 11.7005C15.7152 12.8056 14.8388 14.1714 14.3165 15.6839C13.7942 17.1965 13.641 18.812 13.8697 20.3957C14.0984 21.9795 14.7024 23.4856 15.6313 24.7886C16.5602 26.0916 17.7872 27.1536 19.2099 27.8862C20.6325 28.6187 22.2097 29.0006 23.8099 28.9999C26.0574 29.0012 28.2397 28.2444 30.0039 26.8519C28.8101 25.9119 27.8457 24.7128 27.1835 23.3452C26.5214 21.9776 26.1789 20.4773 26.1819 18.9579Z" fill="#EB001B"/>
                                            <path d="M46.2399 18.9565C46.2418 20.8402 45.7134 22.6864 44.715 24.2838C43.7166 25.8813 42.2886 27.1653 40.5945 27.989C38.9004 28.8127 37.0086 29.1427 35.1356 28.9414C33.2627 28.74 31.4842 28.0154 30.0039 26.8505C31.1955 25.9084 32.1583 24.7089 32.8202 23.3418C33.4822 21.9746 33.826 20.4754 33.826 18.9565C33.826 17.4375 33.4822 15.9383 32.8202 14.5711C32.1583 13.204 31.1955 12.0045 30.0039 11.0625C31.4842 9.89751 33.2627 9.17289 35.1356 8.97154C37.0086 8.77019 38.9004 9.10025 40.5945 9.92394C42.2886 10.7476 43.7166 12.0317 44.715 13.6291C45.7134 15.2265 46.2418 17.0727 46.2399 18.9565Z" fill="#F79E1B"/>
                                            <defs>
                                            <filter id="filter0_d_4770_1692434" x="0" y="0.953125" width="60" height="42" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                            <feOffset dy="3"/>
                                            <feGaussianBlur stdDeviation="3"/>
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0"/>
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4770_16924"/>
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4770_16924" result="shape"/>
                                            </filter>
                                            </defs>
                                            </svg>

                                        </span>
                                        <!-- visa -->
                                        <span>
                                            <svg width="60" height="43" viewBox="0 0 60 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_4770_1693234)">
                                            <path d="M52 3.95312H8C6.89543 3.95312 6 4.84856 6 5.95312V31.9531C6 33.0577 6.89543 33.9531 8 33.9531H52C53.1046 33.9531 54 33.0577 54 31.9531V5.95312C54 4.84856 53.1046 3.95312 52 3.95312Z" fill="white"/>
                                            </g>
                                            <path d="M27.3838 25.0139H24.3218L26.2368 13.1719H29.2988L27.3838 25.0139Z" fill="#00579F"/>
                                            <path d="M38.4833 13.4611C37.607 13.1251 36.6757 12.9555 35.7372 12.9611C32.7132 12.9611 30.5843 14.5731 30.5713 16.8791C30.5463 18.5791 32.0962 19.5251 33.2552 20.0921C34.4402 20.6721 34.8423 21.0501 34.8423 21.5661C34.8303 22.3591 33.8852 22.7251 33.0032 22.7251C32.0085 22.7528 31.0221 22.5365 30.1302 22.0951L29.7303 21.9061L29.3022 24.5641C30.3911 24.9862 31.5495 25.1999 32.7173 25.1941C35.9303 25.1941 38.0173 23.6061 38.0463 21.1501C38.0583 19.8021 37.2403 18.7691 35.4763 17.9251C34.4053 17.3831 33.7493 17.0181 33.7493 16.4631C33.7623 15.9631 34.3042 15.4431 35.5132 15.4431C36.298 15.4199 37.0779 15.5748 37.7943 15.8961L38.0713 16.0221L38.4872 13.4651L38.4833 13.4611Z" fill="#00579F"/>
                                            <path d="M42.5529 20.814C42.8049 20.134 43.7759 17.501 43.7759 17.501C43.7629 17.526 44.0279 16.808 44.1759 16.367L44.3899 17.387C44.3899 17.387 44.9699 20.222 45.0959 20.814H42.5529ZM46.3329 13.167H43.9649C43.6264 13.1264 43.2841 13.2014 42.9937 13.3798C42.7032 13.5583 42.4816 13.8297 42.3649 14.15L37.8169 25.01H41.0299L41.6729 23.234H45.6039C45.6919 23.65 45.9689 25.01 45.9689 25.01H48.8039L46.3339 13.168L46.3329 13.167Z" fill="#00579F"/>
                                            <path d="M21.7675 13.1729L18.7675 21.2479L18.4395 19.6099C17.6936 17.4872 16.1847 15.7178 14.2065 14.6459L16.9535 25.0019H20.1915L25.0045 13.1719L21.7675 13.1729Z" fill="#00579F"/>
                                            <path d="M15.9804 13.1687H11.0534L11.0034 13.4077C12.6575 13.7484 14.2018 14.4927 15.4988 15.5744C16.7958 16.6561 17.8052 18.0416 18.4374 19.6077L17.3664 14.1647C17.3019 13.8551 17.1239 13.5808 16.8674 13.3958C16.611 13.2107 16.2946 13.1283 15.9804 13.1647V13.1687Z" fill="#FAA61A"/>
                                            <defs>
                                            <filter id="filter0_d_4770_1693234" x="0" y="0.953125" width="60" height="42" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                            <feOffset dy="3"/>
                                            <feGaussianBlur stdDeviation="3"/>
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0"/>
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4770_16932"/>
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4770_16932" result="shape"/>
                                            </filter>
                                            </defs>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="paymant-method-modal-right-side-second-wrap" id="cardMethod2">
                                    <form id="payment-form" action="{{ route('payments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="plan" id="plan" value="{{ request('plan') }}">
                                        <div class="form-group">
                                            <label class="mb-2 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" for="">{{__('Name')}} <span class='user-billing-star'>*</span></label>
                                            <input type="text" name="name" id="card-holder-name" class="form-control" value=""
                                                placeholder="{{__('Name on the card')}}">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label class="mb-2 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" for="">{{__("Card details")}}<span class='user-billing-star'>*</span> </label>
                                            <div id="card-element"></div>
                                        </div>

                                        <div class="py-3 d-flex flex-row align-items-center justify-content-between mt-4">
                                            <button type="button" onclick="closeAddSection()" class="border-0 d-flex flex-row align-items-center mobile-add-card-back-btn">
                                                <svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 6.75C14.4142 6.75 14.75 6.41421 14.75 6C14.75 5.58579 14.4142 5.25 14 5.25V6.75ZM0.46967 5.46967C0.176777 5.76256 0.176777 6.23744 0.46967 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.46967 5.46967ZM14 5.25L1 5.25V6.75L14 6.75V5.25Z" fill="white"/>
                                                </svg>
                                            </button>
                                            <button type="submit" class="d-flex flex-row align-items-center justify-content-center border-0 paymant-method-modal-right-side-btn" style="padding: 9px 13px;" id="card-button"
                                                    data-secret="{{ $intent->client_secret }}">
                                                    <span class="paymant-method-modal-right-side-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" >{{__("confirm")}}</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="paymant-method-modal-right-side-second-wrap mt-3 d-none" id="paypalMethod2">
                                    <div class="d-flex flex-column">
                                        <span class="paypal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Use PayPal payment method by default:")}}</span>
                                        <button class="border-0 paymant-method-modal-right-side-btn paypal ml-auto w-50 mt-3 mr-0 text-white @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"
                                                onclick="setPaypalMethod()">{{__('Add new payment method')}}</button>
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
<div class="modal fade" id="addPaymentMethodModal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="addPaymentMethodModal" tabindex="-1">
    <div class="modal-dialog" style="max-width:1020px;max-height:800px;">
        <div class="modal-content bg-white border-0 custom-modal-content">
            <!-- header -->
            @include('tenant.v2.response-view.billing-modal-header',['get_locale'=>$get_locale,'header'=>__('Add Payment Method')])
            <!-- body -->
            <div class="px-3 px-sm-5 pb-5">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div>
                            @include('tenant.v2.response-view.subscription-in-modal',['get_locale'=>$get_locale])
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div>
                            <p class="m-0 py-3 primary-text-color manage-subscription-available-action @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add Payment Method')}}</p>
                            <div class="d-flex flex-column" style="gap:10px">
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <select onchange="selectPaymentMethod()" class="paymant-method-modal-right-side-first-field w-100 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" name="select" id="payment-selector">
                                        <option class="paymant-method-modal-right-side-first-field-option @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"
                                                value="paypal">{{__('PayPal')}}
                                        </option>
                                        <option class="paymant-method-modal-right-side-first-field-option @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"
                                                value="card" selected>{{__('Visa/Mastercard')}}
                                        </option>
                                    </select>
                                    <div class="d-flex flex-row align-items-center justify-content-between">
                                        <!-- paypal -->
                                        <span>
                                            <svg width="61" height="43" viewBox="0 0 61 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_4770_1691423)">
                                            <path d="M52.3701 3.04688H8.37012C7.26555 3.04688 6.37012 3.94231 6.37012 5.04688V31.0469C6.37012 32.1514 7.26555 33.0469 8.37012 33.0469H52.3701C53.4747 33.0469 54.3701 32.1514 54.3701 31.0469V5.04688C54.3701 3.94231 53.4747 3.04688 52.3701 3.04688Z" fill="white"/>
                                            </g>
                                            <path d="M16.5095 12.6606H13.3655C13.2613 12.6605 13.1605 12.6977 13.0813 12.7653C13.0021 12.833 12.9497 12.9267 12.9335 13.0296L11.6615 21.0916C11.656 21.1288 11.6586 21.1668 11.6691 21.2029C11.6796 21.239 11.6978 21.2724 11.7224 21.3008C11.7469 21.3293 11.7774 21.3521 11.8115 21.3678C11.8457 21.3835 11.8829 21.3916 11.9205 21.3916H13.4205C13.5246 21.3917 13.6254 21.3546 13.7046 21.2869C13.7838 21.2192 13.8363 21.1255 13.8525 21.0226L14.1955 18.8476C14.2115 18.7448 14.2637 18.6511 14.3427 18.5834C14.4218 18.5157 14.5224 18.4786 14.6265 18.4786H15.6265C16.0586 18.5258 16.4958 18.4853 16.9118 18.3595C17.3279 18.2337 17.7143 18.0252 18.0479 17.7465C18.3814 17.4677 18.6553 17.1245 18.853 16.7374C19.0507 16.3503 19.1682 15.9272 19.1985 15.4936C19.2859 15.1467 19.2953 14.7848 19.2261 14.4338C19.157 14.0828 19.0109 13.7514 18.7985 13.4636C18.4969 13.1734 18.1364 12.9515 17.7414 12.8129C17.3464 12.6743 16.9263 12.6224 16.5095 12.6606ZM16.8725 15.6056C16.7005 16.7336 15.8385 16.7336 15.0045 16.7336H14.5305L14.8635 14.6266C14.8732 14.565 14.9047 14.5088 14.9522 14.4683C14.9997 14.4278 15.06 14.4056 15.1225 14.4056H15.3395C15.9075 14.4056 16.4395 14.4056 16.7195 14.7296C16.8075 14.8556 16.8667 14.9993 16.893 15.1507C16.9192 15.3021 16.9119 15.4574 16.8715 15.6056H16.8725Z" fill="#253B80"/>
                                            <path d="M25.3423 15.5702H23.8363C23.7739 15.5701 23.7135 15.5923 23.666 15.6329C23.6185 15.6734 23.587 15.7295 23.5773 15.7912L23.5103 16.2122L23.4053 16.0592C23.1767 15.8253 22.8976 15.6468 22.5895 15.5375C22.2813 15.4281 21.9521 15.3907 21.6273 15.4282C20.7968 15.4456 20.0004 15.7611 19.3832 16.317C18.766 16.8728 18.3692 17.6321 18.2653 18.4562C18.186 18.8593 18.1951 19.2749 18.292 19.6742C18.3888 20.0735 18.5711 20.4471 18.8263 20.7692C19.0649 21.0316 19.3597 21.2368 19.6887 21.3695C20.0177 21.5021 20.3723 21.5588 20.7263 21.5352C21.1138 21.539 21.498 21.4647 21.8561 21.3166C22.2142 21.1684 22.5387 20.9496 22.8103 20.6732L22.7433 21.0912C22.7378 21.1283 22.7404 21.1661 22.7509 21.2022C22.7613 21.2382 22.7794 21.2716 22.8039 21.3C22.8283 21.3284 22.8586 21.3513 22.8927 21.367C22.9267 21.3828 22.9638 21.391 23.0013 21.3912H24.3563C24.4605 21.3912 24.5612 21.3541 24.6404 21.2864C24.7196 21.2188 24.7721 21.1251 24.7883 21.0222L25.6023 15.8692C25.6078 15.8319 25.6051 15.7939 25.5946 15.7578C25.584 15.7217 25.5657 15.6883 25.541 15.6599C25.5163 15.6315 25.4858 15.6088 25.4515 15.5933C25.4172 15.5778 25.3799 15.5699 25.3423 15.5702ZM23.2423 18.5002C23.1837 18.9062 22.9784 19.2768 22.6652 19.5418C22.3519 19.8067 21.9524 19.9477 21.5423 19.9382C21.354 19.9579 21.1637 19.9314 20.9879 19.8611C20.812 19.7908 20.656 19.6787 20.5332 19.5346C20.4104 19.3904 20.3246 19.2185 20.2832 19.0338C20.2417 18.849 20.2459 18.657 20.2953 18.4742C20.3526 18.069 20.5554 17.6985 20.8658 17.4318C21.1762 17.1652 21.5731 17.0206 21.9823 17.0252C22.1689 17.0157 22.3552 17.0476 22.5281 17.1185C22.7009 17.1893 22.856 17.2975 22.9823 17.4352C23.1007 17.583 23.1855 17.7548 23.2306 17.9388C23.2756 18.1228 23.28 18.3143 23.2433 18.5002H23.2423Z" fill="#253B80"/>
                                            <path d="M32.7193 15.5703H31.2063C31.1349 15.5704 31.0646 15.5879 31.0015 15.6214C30.9384 15.6548 30.8844 15.7032 30.8443 15.7623L28.7573 18.8363L27.8723 15.8823C27.8452 15.7922 27.7899 15.7132 27.7144 15.657C27.6389 15.6008 27.5474 15.5704 27.4533 15.5703H25.9663C25.9245 15.5701 25.8832 15.5799 25.846 15.599C25.8088 15.618 25.7766 15.6456 25.7523 15.6796C25.7279 15.7135 25.712 15.7528 25.7059 15.7942C25.6998 15.8356 25.7037 15.8778 25.7173 15.9173L27.3843 20.8083L25.8173 23.0203C25.7894 23.0595 25.7728 23.1057 25.7694 23.1538C25.7659 23.2018 25.7758 23.2498 25.798 23.2926C25.8201 23.3354 25.8535 23.3713 25.8947 23.3963C25.9359 23.4213 25.9831 23.4344 26.0313 23.4343H27.5423C27.6129 23.4344 27.6824 23.4173 27.745 23.3846C27.8075 23.3518 27.8612 23.3044 27.9013 23.2463L32.9333 15.9823C32.9607 15.9431 32.9768 15.8971 32.9799 15.8494C32.983 15.8017 32.973 15.754 32.951 15.7115C32.9289 15.6691 32.8957 15.6335 32.8549 15.6086C32.814 15.5837 32.7671 15.5705 32.7193 15.5703Z" fill="#253B80"/>
                                            <path d="M37.1432 12.6607H33.9983C33.8943 12.6609 33.7937 12.6981 33.7147 12.7658C33.6357 12.8334 33.5834 12.927 33.5673 13.0297L32.2953 21.0917C32.2898 21.1289 32.2924 21.1667 32.3029 21.2027C32.3133 21.2388 32.3314 21.2721 32.3558 21.3006C32.3803 21.329 32.4106 21.3519 32.4446 21.3676C32.4787 21.3833 32.5157 21.3916 32.5533 21.3917H34.1673C34.2397 21.3912 34.3096 21.365 34.3646 21.3178C34.4195 21.2705 34.4559 21.2053 34.4672 21.1337L34.8282 18.8487C34.8442 18.7459 34.8965 18.6522 34.9755 18.5845C35.0546 18.5169 35.1552 18.4797 35.2592 18.4797H36.2513C36.6841 18.5278 37.1222 18.4879 37.5393 18.3623C37.9563 18.2367 38.3436 18.0281 38.6779 17.749C39.0123 17.4698 39.2867 17.126 39.4847 16.7381C39.6828 16.3502 39.8003 15.9262 39.8302 15.4917C39.9178 15.1448 39.9273 14.7829 39.8581 14.4318C39.789 14.0808 39.6428 13.7495 39.4303 13.4617C39.1288 13.172 38.7686 12.9505 38.374 12.8122C37.9793 12.674 37.5596 12.6224 37.1432 12.6607ZM37.5062 15.6057C37.3352 16.7337 36.4723 16.7337 35.6383 16.7337H35.1643L35.4973 14.6267C35.5068 14.5652 35.5381 14.5091 35.5854 14.4685C35.6327 14.428 35.6929 14.4057 35.7552 14.4057H35.9723C36.5393 14.4057 37.0722 14.4057 37.3522 14.7297C37.4404 14.8556 37.4998 14.9993 37.5263 15.1507C37.5527 15.3021 37.5455 15.4574 37.5052 15.6057H37.5062Z" fill="#179BD7"/>
                                            <path d="M45.7094 15.5702H44.2094C44.1471 15.5702 44.0869 15.5925 44.0396 15.633C43.9922 15.6735 43.961 15.7296 43.9514 15.7912L43.8844 16.2122L43.7784 16.0592C43.5499 15.8253 43.2708 15.6468 42.9626 15.5374C42.6544 15.428 42.3253 15.3907 42.0004 15.4282C41.1702 15.4459 40.3739 15.7615 39.757 16.3173C39.14 16.8732 38.7434 17.6323 38.6394 18.4562C38.5601 18.8593 38.5691 19.2748 38.6658 19.6741C38.7624 20.0734 38.9445 20.447 39.1994 20.7692C39.4381 21.0316 39.7329 21.2368 40.0619 21.3694C40.3908 21.5021 40.7455 21.5587 41.0994 21.5352C41.4869 21.5391 41.8712 21.4647 42.2293 21.3166C42.5874 21.1685 42.9119 20.9497 43.1834 20.6732L43.1164 21.0912C43.111 21.1284 43.1136 21.1664 43.1241 21.2025C43.1346 21.2386 43.1528 21.272 43.1773 21.3004C43.2019 21.3289 43.2323 21.3517 43.2665 21.3674C43.3007 21.3831 43.3378 21.3912 43.3754 21.3912H44.7314C44.8354 21.3911 44.936 21.3538 45.015 21.2862C45.094 21.2185 45.1463 21.1249 45.1624 21.0222L45.9764 15.8692C45.9817 15.8314 45.9786 15.793 45.9675 15.7565C45.9564 15.72 45.9375 15.6864 45.9121 15.658C45.8867 15.6295 45.8554 15.6069 45.8204 15.5918C45.7854 15.5766 45.7476 15.5693 45.7094 15.5702ZM43.6094 18.5002C43.5511 18.9064 43.3458 19.2771 43.0325 19.5421C42.7192 19.8071 42.3197 19.948 41.9094 19.9382C41.7211 19.9579 41.5308 19.9315 41.355 19.8612C41.1792 19.7909 41.0232 19.6788 40.9004 19.5346C40.7776 19.3905 40.6918 19.2186 40.6503 19.0338C40.6088 18.8491 40.613 18.657 40.6624 18.4742C40.7199 18.0691 40.9228 17.6987 41.2332 17.4321C41.5435 17.1655 41.9403 17.0209 42.3494 17.0252C42.536 17.0158 42.7224 17.0477 42.8952 17.1185C43.0681 17.1894 43.2232 17.2975 43.3494 17.4352C43.4679 17.583 43.5526 17.7549 43.5977 17.9388C43.6428 18.1228 43.6471 18.3144 43.6104 18.5002H43.6094Z" fill="#179BD7"/>
                                            <path d="M47.4857 12.8851L46.1947 21.0951C46.1892 21.1322 46.1918 21.17 46.2023 21.2061C46.2127 21.2421 46.2308 21.2755 46.2553 21.3039C46.2797 21.3323 46.31 21.3552 46.3441 21.3709C46.3781 21.3867 46.4151 21.3949 46.4527 21.3951H47.7527C47.8569 21.3953 47.9578 21.3583 48.037 21.2906C48.1163 21.2229 48.1686 21.1291 48.1847 21.0261L49.4577 12.9641C49.4631 12.9269 49.4605 12.8891 49.4501 12.8531C49.4396 12.817 49.4215 12.7837 49.3971 12.7552C49.3726 12.7268 49.3423 12.7039 49.3083 12.6882C49.2742 12.6725 49.2372 12.6642 49.1997 12.6641H47.7467C47.684 12.6637 47.6232 12.6858 47.5753 12.7264C47.5275 12.7669 47.4957 12.8232 47.4857 12.8851Z" fill="#179BD7"/>
                                            <defs>
                                            <filter id="filter0_d_4770_1691423" x="0.370117" y="0.046875" width="60" height="42" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                            <feOffset dy="3"/>
                                            <feGaussianBlur stdDeviation="3"/>
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0"/>
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4770_16914"/>
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4770_16914" result="shape"/>
                                            </filter>
                                            </defs>
                                            </svg>

                                        </span>
                                            <!-- master -->
                                        <span>
                                            <svg width="60" height="43" viewBox="0 0 60 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_4770_1692434)">
                                            <path d="M52 3.95312H8C6.89543 3.95312 6 4.84856 6 5.95312V31.9531C6 33.0577 6.89543 33.9531 8 33.9531H52C53.1046 33.9531 54 33.0577 54 31.9531V5.95312C54 4.84856 53.1046 3.95312 52 3.95312Z" fill="white"/>
                                            </g>
                                            <path d="M34.3847 11.0625H25.5967V26.8505H34.3847V11.0625Z" fill="#FF5A00"/>
                                            <path d="M26.1819 18.9579C26.1824 17.439 26.5265 15.94 27.1883 14.5729C27.8502 13.2059 28.8128 12.0063 30.0039 11.0639C28.7451 10.0759 27.2684 9.4031 25.6969 9.10164C24.1253 8.80017 22.5045 8.87875 20.9695 9.33082C19.4345 9.78289 18.0298 10.5954 16.8725 11.7005C15.7152 12.8056 14.8388 14.1714 14.3165 15.6839C13.7942 17.1965 13.641 18.812 13.8697 20.3957C14.0984 21.9795 14.7024 23.4856 15.6313 24.7886C16.5602 26.0916 17.7872 27.1536 19.2099 27.8862C20.6325 28.6187 22.2097 29.0006 23.8099 28.9999C26.0574 29.0012 28.2397 28.2444 30.0039 26.8519C28.8101 25.9119 27.8457 24.7128 27.1835 23.3452C26.5214 21.9776 26.1789 20.4773 26.1819 18.9579Z" fill="#EB001B"/>
                                            <path d="M46.2399 18.9565C46.2418 20.8402 45.7134 22.6864 44.715 24.2838C43.7166 25.8813 42.2886 27.1653 40.5945 27.989C38.9004 28.8127 37.0086 29.1427 35.1356 28.9414C33.2627 28.74 31.4842 28.0154 30.0039 26.8505C31.1955 25.9084 32.1583 24.7089 32.8202 23.3418C33.4822 21.9746 33.826 20.4754 33.826 18.9565C33.826 17.4375 33.4822 15.9383 32.8202 14.5711C32.1583 13.204 31.1955 12.0045 30.0039 11.0625C31.4842 9.89751 33.2627 9.17289 35.1356 8.97154C37.0086 8.77019 38.9004 9.10025 40.5945 9.92394C42.2886 10.7476 43.7166 12.0317 44.715 13.6291C45.7134 15.2265 46.2418 17.0727 46.2399 18.9565Z" fill="#F79E1B"/>
                                            <defs>
                                            <filter id="filter0_d_4770_1692434" x="0" y="0.953125" width="60" height="42" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                            <feOffset dy="3"/>
                                            <feGaussianBlur stdDeviation="3"/>
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0"/>
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4770_16924"/>
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4770_16924" result="shape"/>
                                            </filter>
                                            </defs>
                                            </svg>

                                        </span>
                                        <!-- visa -->
                                        <span>
                                            <svg width="60" height="43" viewBox="0 0 60 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_4770_1693234)">
                                            <path d="M52 3.95312H8C6.89543 3.95312 6 4.84856 6 5.95312V31.9531C6 33.0577 6.89543 33.9531 8 33.9531H52C53.1046 33.9531 54 33.0577 54 31.9531V5.95312C54 4.84856 53.1046 3.95312 52 3.95312Z" fill="white"/>
                                            </g>
                                            <path d="M27.3838 25.0139H24.3218L26.2368 13.1719H29.2988L27.3838 25.0139Z" fill="#00579F"/>
                                            <path d="M38.4833 13.4611C37.607 13.1251 36.6757 12.9555 35.7372 12.9611C32.7132 12.9611 30.5843 14.5731 30.5713 16.8791C30.5463 18.5791 32.0962 19.5251 33.2552 20.0921C34.4402 20.6721 34.8423 21.0501 34.8423 21.5661C34.8303 22.3591 33.8852 22.7251 33.0032 22.7251C32.0085 22.7528 31.0221 22.5365 30.1302 22.0951L29.7303 21.9061L29.3022 24.5641C30.3911 24.9862 31.5495 25.1999 32.7173 25.1941C35.9303 25.1941 38.0173 23.6061 38.0463 21.1501C38.0583 19.8021 37.2403 18.7691 35.4763 17.9251C34.4053 17.3831 33.7493 17.0181 33.7493 16.4631C33.7623 15.9631 34.3042 15.4431 35.5132 15.4431C36.298 15.4199 37.0779 15.5748 37.7943 15.8961L38.0713 16.0221L38.4872 13.4651L38.4833 13.4611Z" fill="#00579F"/>
                                            <path d="M42.5529 20.814C42.8049 20.134 43.7759 17.501 43.7759 17.501C43.7629 17.526 44.0279 16.808 44.1759 16.367L44.3899 17.387C44.3899 17.387 44.9699 20.222 45.0959 20.814H42.5529ZM46.3329 13.167H43.9649C43.6264 13.1264 43.2841 13.2014 42.9937 13.3798C42.7032 13.5583 42.4816 13.8297 42.3649 14.15L37.8169 25.01H41.0299L41.6729 23.234H45.6039C45.6919 23.65 45.9689 25.01 45.9689 25.01H48.8039L46.3339 13.168L46.3329 13.167Z" fill="#00579F"/>
                                            <path d="M21.7675 13.1729L18.7675 21.2479L18.4395 19.6099C17.6936 17.4872 16.1847 15.7178 14.2065 14.6459L16.9535 25.0019H20.1915L25.0045 13.1719L21.7675 13.1729Z" fill="#00579F"/>
                                            <path d="M15.9804 13.1687H11.0534L11.0034 13.4077C12.6575 13.7484 14.2018 14.4927 15.4988 15.5744C16.7958 16.6561 17.8052 18.0416 18.4374 19.6077L17.3664 14.1647C17.3019 13.8551 17.1239 13.5808 16.8674 13.3958C16.611 13.2107 16.2946 13.1283 15.9804 13.1647V13.1687Z" fill="#FAA61A"/>
                                            <defs>
                                            <filter id="filter0_d_4770_1693234" x="0" y="0.953125" width="60" height="42" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                            <feOffset dy="3"/>
                                            <feGaussianBlur stdDeviation="3"/>
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0"/>
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4770_16932"/>
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4770_16932" result="shape"/>
                                            </filter>
                                            </defs>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="paymant-method-modal-right-side-second-wrap" id="cardMethod">
                                    <form id="payment-form" action="{{ route('payments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="plan" id="plan" value="{{ request('plan') }}">
                                        <div class="form-group">
                                            <label class="mb-2 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" for="">{{__('Name')}} <span class='user-billing-star'>*</span></label>
                                            <input type="text" name="name" id="card-holder-name" class="form-control" value=""
                                                placeholder="{{__('Name on the card')}}">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label class="mb-2 @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" for="">{{__("Card details")}}<span class='user-billing-star'>*</span> </label>
                                            <div id="card-element"></div>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="d-flex flex-row align-items-center justify-content-center border-0 paymant-method-modal-right-side-btn" id="card-button"
                                                    data-secret="{{ $intent->client_secret }}">
                                                    <span class="paymant-method-modal-right-side-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Add new payment method")}}</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="paymant-method-modal-right-side-second-wrap mt-3 d-none" id="paypalMethod">
                                    <div class="d-flex flex-column">
                                        <span class="paypal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Use PayPal payment method by default:")}}</span>
                                        <button class="border-0 paymant-method-modal-right-side-btn paypal ml-auto w-50 mt-3 mr-0 text-white @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"
                                                onclick="setPaypalMethod()">{{__('Add new payment method')}}</button>
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
<div class="modal fade" id="marketingConsultancyModal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="marketingConsultancyModal" tabindex="-1">
    <div class="modal-dialog" style="max-width:480px;max-height:370px;">
        <div class="modal-content bg-white border-0 custom-modal-content">
            <div class="d-flex flex-column  marketing-analytics-modal-wrapper">
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <span>&nbsp;</span>
                    <span class="d-none d-sm-inline">
                        <svg width="46" height="40" viewBox="0 0 46 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.4865 14.2042L19.8237 13.2508C20.4912 13.6798 21.2062 14.0612 21.9691 14.2042C26.0217 15.1101 29.6449 12.2018 29.8834 8.34014C29.8834 8.14958 29.7404 7.95869 29.5495 7.95869H23.8284C23.6379 7.95869 23.4945 7.81569 23.4945 7.6248V1.90376C23.4945 1.7132 23.304 1.52231 23.1131 1.56987C19.2514 1.76043 16.3431 5.38403 17.249 9.48417C17.3445 9.86562 17.4875 10.2471 17.6305 10.5806L15.9616 13.4889C15.7711 13.8706 16.105 14.2996 16.4864 14.2042H16.4865Z" fill="#447097"/>
                        <path d="M25.4487 6.38854H31.1697C31.3603 6.38854 31.5512 6.19798 31.5036 6.00709C31.313 2.76529 28.7384 0.143028 25.4965 0C25.306 0 25.1151 0.143002 25.1151 0.333893V6.05492C25.0672 6.24548 25.2581 6.38849 25.4486 6.38849L25.4487 6.38854Z" fill="#447097"/>
                        <path d="M11.384 9.91404C11.384 11.9679 9.71913 13.6328 7.66523 13.6328C5.61133 13.6328 3.9465 11.9679 3.9465 9.91404C3.9465 7.86014 5.61133 6.19531 7.66523 6.19531C9.71913 6.19531 11.384 7.86014 11.384 9.91404Z" fill="#447097"/>
                        <path d="M11.6223 30.3194H6.66421C5.37687 30.3194 4.328 29.4135 4.08987 28.1261L2.61166 18.6386C2.51622 18.0187 1.94422 17.5897 1.32433 17.6852C0.704438 17.7806 0.275457 18.3526 0.370894 18.9725L1.84876 28.46C2.23021 30.8438 4.23256 32.5602 6.61636 32.5602H11.5745C12.1944 32.5602 12.7188 32.0357 12.7188 31.4158C12.7188 30.8435 12.2422 30.319 11.6223 30.319V30.3194Z" fill="#447097"/>
                        <path d="M15.1981 25.5505H11.7654L11.3364 19.5435C12.5759 20.2585 13.9107 20.6878 15.3411 20.6878H18.4399C19.2028 20.6878 19.8702 20.0679 19.8702 19.2574C19.8702 18.4945 19.2503 17.827 18.4399 17.827H15.3886C14.4352 17.827 13.4338 17.541 12.6234 17.0166L9.81061 15.2048C9.28616 14.8234 8.6663 14.6328 7.95124 14.6328H7.42679C6.42543 14.6328 5.51992 15.0618 4.85246 15.8247C4.185 16.5876 3.89903 17.541 4.04201 18.5424L5.42445 27.5532C5.56745 28.3636 6.28244 28.9835 7.09327 28.9835H13.2433C13.5293 28.9835 13.7678 29.1741 13.8153 29.4604L15.4362 38.3758C15.5792 39.1863 16.2942 39.7583 17.105 39.7583C17.2005 39.7583 17.2956 39.7583 17.391 39.7107C18.297 39.5677 18.9168 38.6618 18.7735 37.7559L16.8187 26.9335C16.7236 26.1227 16.0561 25.5507 15.1981 25.5507L15.1981 25.5505Z" fill="#447097"/>
                        <path d="M42.0873 9.91404C42.0873 11.9679 40.4225 13.6328 38.3686 13.6328C36.3147 13.6328 34.6498 11.9679 34.6498 9.91404C34.6498 7.86014 36.3147 6.19531 38.3686 6.19531C40.4225 6.19531 42.0873 7.86014 42.0873 9.91404Z" fill="#447097"/>
                        <path d="M44.7089 17.6852C44.089 17.5897 43.517 18.0191 43.4216 18.6386L41.9437 28.1261C41.7532 29.4134 40.6564 30.3194 39.3694 30.3194L34.4109 30.319C33.791 30.319 33.2666 30.8435 33.2666 31.4634C33.2666 32.0832 33.7911 32.6077 34.4109 32.6077H39.369C41.7528 32.6077 43.8027 30.8913 44.1366 28.5075L45.6145 19.02C45.7578 18.3526 45.3285 17.7803 44.7089 17.6851V17.6852Z" fill="#447097"/>
                        <path d="M38.892 28.9367C39.75 28.9367 40.4178 28.3168 40.5609 27.5063L41.9433 18.4955C42.0863 17.5421 41.8003 16.5407 41.1328 15.7778C40.4654 15.0149 39.5595 14.5859 38.5585 14.5859H38.0341C37.3666 14.5859 36.6991 14.8244 36.1747 15.1579L33.3619 17.0173C32.5515 17.5418 31.598 17.8278 30.5967 17.8278H27.4979C26.735 17.8278 26.0676 18.4476 26.0676 19.2581C26.0676 20.021 26.6875 20.6885 27.4979 20.6885H30.6443C32.0747 20.6885 33.4571 20.307 34.649 19.5442L34.22 25.5513H30.7873C29.9769 25.5513 29.2615 26.1233 29.1185 26.9337L27.1637 37.7561C27.0207 38.6621 27.5927 39.5679 28.5461 39.7109C28.6416 39.7109 28.7367 39.7585 28.8321 39.7585C29.6426 39.7585 30.3579 39.1865 30.5009 38.3761L32.1218 29.4607C32.1694 29.1747 32.4078 28.9838 32.6939 28.9838L38.892 28.9367Z" fill="#447097"/>
                        <path d="M32.4572 23.1677C32.4572 22.5479 31.9327 22.0234 31.3129 22.0234H14.7216C14.1018 22.0234 13.5773 22.5479 13.5773 23.1677C13.5773 23.7876 14.1018 24.3121 14.7216 24.3121H21.9206V38.8532C21.9206 39.4731 22.4451 39.9975 23.0649 39.9975C23.6848 39.9975 24.2092 39.4731 24.2092 38.8532V24.2644H31.4082C31.9327 24.2644 32.4571 23.7878 32.4571 23.1679L32.4572 23.1677Z" fill="#447097"/>
                        </svg>
                    </span>
                    <span class="d-inline d-sm-none">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_4770_1667634)">
                        <path d="M60 48.0232C59.7417 49.2699 59.2603 50.3875 58.2611 51.2433C57.2115 52.1414 55.9892 52.4772 54.6378 52.4772C42.6712 52.4748 30.7033 52.4772 18.7367 52.4666C18.2353 52.4666 17.8737 52.5922 17.5121 52.9608C15.475 55.0364 13.412 57.0873 11.3467 59.1347C11.0943 59.3848 10.8043 59.5949 10.5202 59.8133C10.2583 60.014 9.90492 60.0633 9.60787 59.9213C8.70262 59.4893 8.57934 58.6182 8.93745 57.22C9.32843 55.6938 9.33782 54.0961 8.92923 52.5746C8.52063 51.0532 8.86113 50.2185 9.71237 50.0295C10.5389 49.8463 11.2282 50.4169 11.2458 51.3431C11.2681 52.5535 11.2516 53.7638 11.2516 54.9742C11.2516 55.1644 11.2516 55.3546 11.2516 55.6551C11.4501 55.4802 11.5792 55.378 11.6943 55.263C13.2136 53.7451 14.7447 52.2389 16.2428 50.6998C16.6937 50.2373 17.3113 49.9731 17.9571 49.9743C30.1374 49.9884 42.3189 49.9896 54.4993 49.9696C55.0851 49.9696 55.7262 49.8616 56.2428 49.6057C57.1915 49.1361 57.5097 48.2333 57.5085 47.2061C57.5062 44.8629 57.5085 42.5208 57.5085 40.1776C57.5085 31.0993 57.5085 22.0211 57.5085 12.9417C57.5085 12.2056 57.4205 11.5036 56.9273 10.9072C56.3415 10.1993 55.5665 9.97273 54.6883 9.9739C52.7745 9.97625 50.8607 9.98212 48.948 9.97038C48.0545 9.96451 47.4921 9.44914 47.5132 8.70015C47.532 8.05682 48.0181 7.50623 48.7191 7.50271C51.0215 7.49097 53.3322 7.41818 55.6252 7.58254C57.8561 7.7422 59.4623 9.38927 59.9026 11.6045C59.9084 11.6327 59.9155 11.6609 59.9225 11.6879C59.9812 11.9004 60 12.1234 60 12.3441V48.0232Z" fill="#737F96"/>
                        <path d="M47.4921 28.6418C48.6216 28.758 49.7898 27.9127 49.9037 26.7576C50.0188 25.5812 50.0023 24.3791 49.9061 23.1993C49.8286 22.2449 48.9574 21.4559 48.0016 21.3045C47.5238 21.2282 47.0306 21.2341 46.5434 21.2235C45.455 21.2 45.0088 20.7657 45.0006 19.6915C44.9947 18.9695 45.0065 18.2463 44.9982 17.5244C44.9207 10.7342 40.4509 4.77748 34.1623 3.0811C27.7645 1.3542 21.4982 3.57416 17.66 8.992C15.8236 11.5841 14.9982 14.5202 15.0006 17.6922C15.0018 21.6356 15.0006 25.5801 15.0006 29.5234C15.0006 30.8089 14.5709 31.2116 13.2758 31.2421C11.3819 31.2867 9.68181 30.8382 8.54878 29.2135C8.10613 28.5795 7.69167 27.7918 7.63883 27.0475C7.52964 25.5049 7.4545 23.9001 7.76329 22.4033C8.19889 20.2949 9.74756 19.1339 11.8809 18.7969C12.0723 18.7664 12.2625 18.7359 12.5103 18.696C12.3107 12.8132 14.3243 7.85913 18.84 4.0414C22.0594 1.32016 25.8436 -0.0334184 30.054 0.000626497C35.0828 0.0417152 39.3695 1.91653 42.8061 5.60512C46.2275 9.27962 47.6799 13.6949 47.485 18.6091C48.247 18.8251 48.9773 18.9319 49.6149 19.2325C51.268 20.0132 52.2743 21.3479 52.4293 23.1828C52.5596 24.7313 52.6876 26.3044 52.212 27.8306C51.6543 29.622 49.9436 30.9956 48.0791 31.1552C47.6658 31.1904 47.4768 31.2902 47.4568 31.7704C47.1598 38.9832 41.4618 44.6628 34.2503 44.9575C33.7631 44.9774 33.2746 44.9763 32.7862 44.9739C31.8304 44.9681 31.4594 44.6605 31.2563 43.7225C31.0802 42.9113 30.7068 42.5286 30.0634 42.5004C29.4329 42.4734 28.9292 42.8714 28.8094 43.4912C28.6908 44.1111 29.0043 44.6734 29.5961 44.8788C29.7605 44.9352 29.9378 44.9551 30.1092 44.9904C30.8653 45.1477 31.288 45.6536 31.2246 46.3252C31.1577 47.0354 30.6281 47.4674 29.845 47.4498C28.2247 47.4134 26.7899 46.2477 26.3755 44.6323C25.9739 43.0709 26.6819 41.3487 28.0592 40.5352C29.9765 39.4023 32.333 40.0785 33.3521 42.0695C33.4895 42.3384 33.5999 42.498 33.9497 42.4793C38.591 42.2186 41.9561 40.0245 43.992 35.8428C44.7211 34.346 45.0006 32.7354 45.0018 31.0742C45.0018 29.1219 45.0041 27.1696 45.0018 25.2173C45.0018 24.628 45.1744 24.1349 45.7368 23.8626C46.5328 23.4763 47.4369 24.0316 47.4768 24.9696C47.5191 25.9827 47.4921 26.9994 47.4956 28.0149C47.4956 28.2262 47.4956 28.4375 47.4956 28.6418H47.4921ZM12.4715 21.2998C11.3174 21.2681 10.2196 22.0488 10.1068 23.1641C9.9859 24.3568 9.98473 25.5812 10.1033 26.774C10.2184 27.928 11.4195 28.7815 12.4715 28.6347V21.2998Z" fill="#737F96"/>
                        <path d="M0.00236136 29.9204C0.00236136 24.1997 -0.00116101 18.4801 0.0047096 12.7594C0.00705785 10.624 0.885301 8.96754 2.83317 8.0225C3.47894 7.70905 4.24916 7.53295 4.9689 7.50947C7.01657 7.44139 9.06893 7.4766 11.119 7.48834C11.8575 7.49304 12.3201 7.86401 12.4445 8.48152C12.5631 9.07437 12.2849 9.65782 11.7295 9.8574C11.463 9.95366 11.1565 9.96775 10.8677 9.9701C9.05132 9.97949 7.23613 9.97245 5.41976 9.97597C3.47894 9.97949 2.49502 10.9574 2.49502 12.8956C2.49268 24.2783 2.49385 35.6599 2.49502 47.0426C2.49502 48.8435 3.22885 49.7052 4.98534 49.9858C5.8765 50.1278 6.33088 50.6666 6.20995 51.4391C6.10075 52.14 5.46555 52.5415 4.61666 52.4464C1.83986 52.1341 0.0105802 50.0938 0.00588372 47.2575C-0.00468338 41.4781 0.00236136 35.6998 0.00236136 29.9204Z" fill="#737F96"/>
                        <path d="M29.973 4.99234C36.5715 4.95947 42.0641 10.1226 42.4527 16.7226C42.4703 17.0137 42.5009 17.3095 42.4645 17.596C42.3799 18.2605 41.8668 18.716 41.2516 18.7171C40.6598 18.7171 40.1561 18.298 40.0481 17.6559C39.8943 16.7367 39.8802 15.7799 39.6243 14.8924C38.4889 10.9643 35.887 8.48018 31.8844 7.69715C27.9183 6.92116 24.6155 8.26535 22.0864 11.4069C20.7772 13.0316 20.1139 14.9288 20.0305 17.0196C19.9859 18.1513 19.501 18.7653 18.6908 18.7148C17.8596 18.6643 17.4486 18.0304 17.539 16.8963C17.9805 11.3552 20.8407 7.60089 26.0185 5.66855C27.2572 5.206 29.973 4.99234 29.973 4.99234Z" fill="#737F96"/>
                        <path d="M31.2246 32.471V34.9468H28.7472C28.7472 34.2014 28.7343 33.4688 28.7637 32.7386C28.7672 32.6447 28.9856 32.4886 29.1088 32.4839C29.7875 32.4592 30.4685 32.4721 31.2246 32.4721V32.471Z" fill="#737F96"/>
                        <path d="M26.2193 32.5078V34.9497H23.7936V32.5078H26.2193Z" fill="#737F96"/>
                        <path d="M33.7807 34.9407V32.5H36.2064V34.9407H33.7807Z" fill="#737F96"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_4770_1667634">
                        <rect width="60" height="60" fill="white"/>
                        </clipPath>
                        </defs>
                        </svg>
                    </span>
                    <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.87015 0.957362C2.34177 0.42899 1.48509 0.42899 0.956715 0.957362C0.428336 1.48573 0.428336 2.34239 0.956716 2.87076L13.0341 14.948C13.5625 15.4763 14.4192 15.4763 14.9475 14.948C15.4759 14.4196 15.4759 13.5629 14.9475 13.0346L2.87015 0.957362Z" fill="#F58B1E"/>
                        <path d="M15.0405 1.05226C15.1678 1.17736 15.269 1.32658 15.3381 1.4912C15.4071 1.65583 15.4427 1.83256 15.4427 2.01109C15.4427 2.18961 15.4071 2.36634 15.3381 2.53097C15.269 2.69559 15.1678 2.84481 15.0405 2.96991L2.90229 14.9552C2.64315 15.2095 2.29454 15.352 1.93143 15.352C1.56832 15.352 1.21972 15.2095 0.960575 14.9552C0.833886 14.83 0.733343 14.6809 0.664786 14.5165C0.596228 14.3521 0.561024 14.1758 0.561222 13.9977C0.561418 13.8196 0.597013 13.6433 0.665935 13.4791C0.734856 13.3149 0.835731 13.166 0.962697 13.0411L13.0959 1.04944C13.3556 0.794616 13.705 0.652093 14.0688 0.652622C14.4326 0.653151 14.7816 0.79669 15.0405 1.05226Z" fill="#F58B1E"/>
                        </svg>
                    </button>
                </div>
                <p class="m-0 mt-4 text-center primary-text-color marketing-analytics-consulting-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Marketing Analytics Consulting')}}</p>
                <p class="m-0 mt-2 text-center primary-text-color marketing-analytics-consulting-sub-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Subscribing to the Marketing Analytics Consulting will add $100 to your monthly bill and will be prorated until your billing date.')}}</p>
                <button type="button" onclick="subscribeNewConsultingPlan('consulting')" class="border-0 mt-3 mx-auto bg-tranparent d-flex flex-row align-items-center justify-content-center enable-consulting-btn">
                    <span class="enable-consulting-btn-text text-white @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                    {{__('Enable consulting')}}
                    </span>
                </button>
                <a href="https://intercom.help/afdal-analytics/ar/articles/6359383-%D9%85%D8%A7-%D9%87%D9%8A-%D8%AE%D8%AF%D9%85%D8%A9-%D8%A7%D8%B3%D8%AA%D8%B4%D8%A7%D8%B1%D8%A7%D8%AA-%D8%AA%D8%AD%D9%84%D9%8A%D9%84-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA" target="_blank" class="mt-3 mx-auto bg-white d-flex flex-row align-items-center justify-content-center want-to-know-more-btn text-decoration-none">
                    <span class="primary-text-color want-to-know-more-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('I want to know more')}}</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var manageSubscription = new bootstrap.Modal(document.getElementById('manageSubscription'), {
        keyboard: false
    });
    var managePaymentMethod = new bootstrap.Modal(document.getElementById('managePaymentMethod'), {
        keyboard: false
    });
    var addPaymentMethodModal = new bootstrap.Modal(document.getElementById('addPaymentMethodModal'), {
        keyboard: false
    });
    var marketingConsultancyModal = new bootstrap.Modal(document.getElementById('marketingConsultancyModal'), {
        keyboard: false
    });
    function openManageSubscription(){
        addPaymentMethodModal.hide();
        managePaymentMethod.hide();
        manageSubscription.show();
    }
    function openManagePaymentMethod(){
        addPaymentMethodModal.hide();
        manageSubscription.hide();
        managePaymentMethod.show();
    }
    function openAddPaymentMethod(method_called=null){
        if(method_called=='inside' && window.innerWidth <= 768){
            $('#edit-add-save-section').addClass('d-none');
            $('#mobile-add-payment-method').removeClass('d-none')
        }else{
            manageSubscription.hide();
            managePaymentMethod.hide();
            addPaymentMethodModal.show();
        }
       
    }
    function closeAddSection(){
        $('#edit-add-save-section').removeClass('d-none');
            $('#mobile-add-payment-method').addClass('d-none')
    }
    function openMarketingConsultancyModal(){
        marketingConsultancyModal.show();
    }
</script>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{'https://www.paypal.com/sdk/js?client-id=' . (env('PAYPAL_MODE') === 'live' ? env('PAYPAL_LIVE_CLIENT_ID') : env('PAYPAL_SANDBOX_CLIENT_ID')) . '&vault=true&intent=subscription'}}" data-sdk-integration-source="button-factory"></script>

<script>
    paypal.Buttons({
        style: {
            shape: 'pill',
            color: 'gold',
            layout: 'horizontal',
            label: 'subscribe',
            tagline: false
        },
        createSubscription: function(data, actions) {
            return actions.subscription.create({
                /* Creates the subscription */
                plan_id: '{{ $paypalPlanId }}',
                start_time: '{{ $nextPaymentDate }}T00:00:00Z'
            });
        },
        onApprove: function(data, actions) {
            updatePMReq(data.subscriptionID, data.orderID);
        }
    }).render('#{{ $paypalPlanId }}');
</script>

<script>
    var noPaymentMethod = '{{ session()->get('noPaymentMethod') }}';
    var paymentMethodAdded = '{{ session()->get('paymentMethodAdded') }}';
    var subscriptionCanceled = '{{ session()->get('subscriptionCanceled') }}';
    var subscriptionCreated = '{{ session()->get('subscriptionCreated') }}';
    var pmUpdated = '{{ session()->get('pmUpdated') }}';

    document.body.onload = function () {
        setTimeout(function () {
            const preloader = document.getElementById('loader');
            if (!preloader.classList.contains('d-done')) {
                preloader.classList.addClass('d-done');
            }
            if (noPaymentMethod) {
                toastr.warning('{{__('Add a new payment method')}}');

                @php
                    request()->session()->forget('noPaymentMethod');
                @endphp
            }
            if (paymentMethodAdded) {
                toastr.success('{{__('A new payment method was added')}}');

                @php
                    request()->session()->forget('paymentMethodAdded');
                @endphp
            }
            if (subscriptionCanceled) {
                toastr.success('{{__('Your subscription has been canceled')}}');

                @php
                    request()->session()->forget('subscriptionCanceled');
                @endphp
            }
            if (subscriptionCreated) {
                toastr.success('{{__('Your subscription has been created')}}');

                @php
                    request()->session()->forget('subscriptionCreated');
                @endphp
            }
            if (pmUpdated) {
                toastr.success('{{__('The new payment method is set')}}');

                @php
                    request()->session()->forget('pmUpdated');
                @endphp
            }
        }, 1000);
    };
</script>

<script>
    ifSubEnd = false;

    function selectPaymentMethod() {
        if ($('#payment-selector').val() === 'card') {
            $('#paypalMethod').addClass('d-none');
            $('#cardMethod').removeClass('d-none');
        } else {
            $('#paypalMethod').removeClass('d-none');
            $('#cardMethod').addClass('d-none');
        }
        if ($('#payment-selector2').val() === 'card') {
            $('#paypalMethod2').addClass('d-none');
            $('#cardMethod2').removeClass('d-none');
        } else {
            $('#paypalMethod2').removeClass('d-none');
            $('#cardMethod2').addClass('d-none');
        }
    }

    function setPaypalMethod() {
        toggleLoader(true);
        $.ajax({
            type: 'POST',
            url: '{{ url('/set-paypal') }}'+'?set_defual=true',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: () => {
                location.reload()
            }
        })
    }

    function addPaymentMethod(event) {
        event.preventDefault();
        $('#current-payment-method').hide();
        $('#add-payment-method').show();
    }

    function backPaymentMethod(event) {
        event.preventDefault();
        $('#current-payment-method').show();
        $('#add-payment-method').hide();

        $('#confirm-paypal').hide();
        $('#current-payment-method-inner').show();
    }

    function endSubBlock() {
       $('.end-subscription-footer').toggleClass('d-none');
    }

    function cancelSubscription() {
        toggleLoader(true);

        $.ajax({
            type: 'POST',
            url: '{{ $isPaypal ? url('/cancel-paypal-subscription') : url('/cancel-subscription') }}',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: res => {
                console.log(res);
                if (res.subscriptionCanceled) {
                    location.reload()
                }
            }
        })
    }

    function cancelConsultingSubscription() {
        toggleLoader(true);

        $.ajax({
            type: 'POST',
            url: '{{ url('/cancel-consulting-subscription')}}',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: res => {
                console.log(res);
                if (res.subscriptionCanceled) {
                    location.reload()
                }
            }
        })
    }
</script>


<script>
    const stripe = Stripe('{{ config('cashier.key') }}')

    const elements = stripe.elements()
    const cardElement = elements.create('card')

    cardElement.mount('#card-element')

    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')

    let isEditing = false;
    let selectedPM = null;
    let selectedPM2 = null;

    function toggleLoader(loaderStatus) {
        const preloader = $('.loader');
        if (loaderStatus) {
            preloader.removeClass('d-none');
        } else {
            preloader.addClass('d-none');
        };
    };

    function managePM(event) {
        event.preventDefault();
        isEditing = !isEditing;
        if (isEditing) {
            $('.delete-method').removeClass('d-none');
            const additionalMethods = $('.additional-method');
            $.each(additionalMethods, (i, item) => {
                $(`#${item.id}`).attr('onclick', `selectPM('${item.id}')`).addClass('selectable-PM');
            })

        } else {
            setTimeout(() => $('.delete-method').addClass('d-none'), 300);
            $('.additional-method').removeClass('selectable-PM').removeClass('selected-PM').removeAttr('onclick');
            $('#savePM').removeClass('secondary-bg-color').attr('disabled', 'true');
            $('.lock-icon-save').removeClass('d-none');
            selectedPM = null;
        }
    }

    function selectPM(id) {
        $('.additional-method').removeClass('selected-PM');
        $(`#${id}`).addClass('selected-PM');
        selectedPM = id;

        $('#savePM').addClass('secondary-bg-color').removeAttr('disabled');
        $('.lock-icon-save').addClass('d-none');
    }
    function radioSelected(id){
        selectedPM2=id;
        if(selectedPM2=='0'){
            $('#pay_now').css({'opacity': '0.4'}).addAttr('disabled');
        }else{
            $('#pay_now').css({'opacity': '1'}).removeAttr('disabled');
        }
    } 
    function updatePMReq2() {
        $.ajax({
            type: 'POST',
            url: '{{ url('/update-payment-method') }}',
            data: {
                _token: '{{ csrf_token() }}',
                pm_id: selectedPM2,
                subscriptionID: null,
                orderID: null
            },
            success: res => {

                setTimeout(() => {
                    selectedPM2 = null;

                    toggleLoader(true);
                    location.reload();
                }, 300)
            }
        })
    }

    function updatePMReq(subscriptionID = null, orderID = null) {
        $.ajax({
            type: 'POST',
            url: '{{ url('/update-payment-method') }}',
            data: {
                _token: '{{ csrf_token() }}',
                pm_id: selectedPM,
                subscriptionID: subscriptionID,
                orderID: orderID
            },
            success: res => {

                setTimeout(() => {
                    isEditing = !isEditing;

                    $('.default-method').removeClass('default-method');
                    $(`#${selectedPM}`).addClass('default-method').css({'opacity': '1'});
                    $('.paymant-method-modal-right-side-info').css({'width': '405px'});
                    $('.additional-method .paymant-method-modal-right-side-info').removeClass('selectable-PM').removeClass('selected-PM').removeAttr('onclick');
                    $('.delete-method').css({'pointer-events': 'all'}).hide();
                    selectedPM = null;

                    toggleLoader(true);
                    location.reload();
                }, 300)
            }
        })
    }

    function saveDefaultPM() {
        event.preventDefault();

        $('#savePM').removeClass('secondary-bg-color').attr('disabled', 'true');
        $('.delete-method').addClass('d-none');

        $(`#${selectedPM}`).css({'opacity': '.6'});

        if ('{{ json_encode($subscription_info) }}' !== 'null' && !+'{{ $user_company->paypal_default }}' && selectedPM === 'paypal-method') {
            $('#confirm-paypal').show();
            $('#current-payment-method-inner').hide();
            return;
        }

        updatePMReq();
    }

    function deletePM(event, id) {
        event.preventDefault();

        $('#savePM').removeClass('secondary-bg-color').attr('disabled', 'true');
        $('.lock-icon-save').addClass('d-none');;

        $('.delete-method').css({'pointer-events': 'none'});
        $(`#${id}`).css({'opacity': '.6'});

        $.ajax({
            type: 'POST',
            url: '{{ url('/delete-payment-method') }}',
            data: {
                _token: '{{ csrf_token() }}',
                pm_id: id
            },
            success: res => {
                $(`#${id}`).css({'opacity': '0'});

                setTimeout(() => {
                    $(`#${id}`).removeClass('d-none');
                    $(`#${id}`).css({'display': 'none !important'});
                    if (res.paymentMethods.length < 2) {
                        isEditing = !isEditing;

                        if (isEditing) {
                            $('.delete-method').removeClass('d-none');
                        } else {
                            setTimeout(() => $('.delete-method').addClass('d-none'), 300);
                        }
                    } else {
                        $('.delete-method').css({'pointer-events': 'all'});
                    }
                    selectedPM = null;
                }, 300)
            }
        })
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        const {setupIntent, error} = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        )

        if (error) {
            toastr.error(error.message);
        } else {
            let token = document.createElement('input')

            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)

            form.appendChild(token)

            form.submit();

            toggleLoader(true);

            $('#current-payment-method').show();
            $('#add-payment-method').hide();
        }
    })



    function subscribeNewConsultingPlan(plan) {
        if ('{{auth()->user()}}') {
            toggleLoader(true);

            $.ajax({
                type: 'POST',
                url: '{{ url('/subscribe-consulting-plan') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    plan: plan, //currentPeriod === 'year' ? plan + '_yearly' : plan
                },
                success: function (data) {
                    window.location.replace('{{ url('/dashboard/user-billing') }}');
                },
                error: function(error){

                    // window.location.replace('{{ url('/dashboard/user-billing') }}');
                }
            })
        } else window.location.replace('{{ url('/login') }}');
    }




</script>
@endsection