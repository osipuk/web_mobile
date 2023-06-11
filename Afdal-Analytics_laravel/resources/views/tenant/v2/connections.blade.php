@extends('layout.v2.tenant.head')
@php
$get_locale=checkLangaugeGlobaly();
@endphp
@section('metahead')

<link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}" />
@endsection
@section('title', 'User Home')
@section('content')
<div class="loader" hidden>
    <div class="loader-background"></div>
    <div class="loader-logo"></div>
    <p class="loader-text font-18-lh-22-regular">{{__('Loading...')}}</p>
</div>
<div class="page-wrapper chiller-theme toggled">
    @include('layout.v2.tenant.sidebar')
    <div id="main-section" class="w-100 addpaddingforhome">
        @include('layout.v2.tenant.header',['heading'=>__('Connections')])
        <!-- Connections navbar -->
        <div class="mx-3 mx-sm-5 pb-4 pt-1 d-block d-md-none">
            <p class="m-0 primary-text-color template-page-heading-sm">{{__('Connections')}}</p>
        </div>
        <div class="py-2 py-md-0 connection-select-container">
            <div class="d-flex justify-content-between d-sm-block mx-3 mx-sm-5">
                <ul class="nav d-flex flex-row align-items-center connections-navbar" data-bs-tabs="tabs">
                    <li id="connection-item-1" class="connection-item-menu nav-item @if($get_locale=='ar') connections-navbar-li @endif">
                        <a id="my-connections-selector" class="nav-link @if($tab_type=='my') active @endif p-0" data-bs-toggle="tab" href="#my-connections">
                            {{__('My Connections')}}
                            <div class="active-bottom-line"></div>
                        </a>
                    </li>
                    <li id="connection-item-2" class="connection-item-menu nav-item @if($get_locale=='ar') connections-navbar-li @endif">
                        <a id="ads-connections-selector" class="nav-link p-0" data-bs-toggle="tab" href="#ads-connections">
                            {{__('Ads')}}
                            <div class="active-bottom-line"></div>
                        </a>
                    </li>
                    <li id="connection-item-3" class="connection-item-menu nav-item @if($get_locale=='ar') connections-navbar-li @endif">
                        <a id="all-connections-selector" class="nav-link @if($tab_type=='all') active @endif p-0" data-bs-toggle="tab" href="#all-connections">
                            {{__('All')}}
                            <div class="active-bottom-line"></div>
                        </a>
                    </li>
                    <li id="connection-item-4" class="connection-item-menu nav-item @if($get_locale=='ar') connections-navbar-li @endif">
                        <a id="apps-connections-selector" class="nav-link p-0" data-bs-toggle="tab" href="#apps-connections">
                            {{__('Apps')}}
                            <div class="active-bottom-line"></div>
                        </a>
                    </li>
                    <li id="connection-item-5" class="connection-item-menu nav-item @if($get_locale=='ar') connections-navbar-li @endif">
                        <a id="social-media-connections-selector" class="nav-link p-0" data-bs-toggle="tab" href="#social-media-connections">
                            {{__('Social Media')}}
                            <div class="active-bottom-line"></div>
                        </a>
                    </li>
                    <li id="connection-item-6" class="connection-item-menu nav-item @if($get_locale=='ar') connections-navbar-li @endif">
                        <a id="coming-soon-connections-selector" class="nav-link p-0" data-bs-toggle="tab" href="#coming-soon-connections">
                            {{__('Coming Soon')}}
                            <div class="active-bottom-line"></div>
                        </a>
                    </li>
                </ul>
                <div class="d-inline d-sm-none">
                    <span id="show-item-arrow-icon" role="button" class="d-flex align-items-center @if($get_locale=='ar') show-item-arrow-icon @endif" onclick="showMenuItems()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 17L18 12L13 7.00002" stroke="#F58B1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 17L12 12L7 7.00002" stroke="#F58B1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
        <div class="reports-main-container mx-3 mx-sm-5 mt-4">
            <div class="tab-content">
                <div class="tab-pane @if($tab_type=='my') active @else fade @endif" id="my-connections">
                    @php
                    $has_connections=false;
                    if(Auth::user() && !Auth::user()->company->social_account_facebook->isNotEmpty()  && !Auth::user()->company->social_account_facebook_ads->isNotEmpty()
                        && !Auth::user()->company->social_account_twitter->isNotEmpty()
                        && !Auth::user()->company->social_account_instagram->isNotEmpty()
                        && !Auth::user()->company->social_account_google_ads->isNotEmpty()
                        && !Auth::user()->company->social_account_google_analytics->isNotEmpty()){
                        $has_connections=true;
                    }
                    @endphp
                    
                    <div id="empty-connections-container" class="container-fluid d-flex justify-content-center align-items-center empty-connections-container @if(!$has_connections) d-none @endif">
                        <div class="d-flex flex-column align-items-center justify-content-between empty-connections-sub-container">
                            <span>
                                <svg width="115" height="103" viewBox="0 0 115 103" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_4418_8378)">
                                        <path d="M42.604 47.3273C41.0432 48.8939 39.6392 50.3064 38.0433 51.9115C37.3237 51.2631 36.4441 50.5504 35.6574 49.7446C33.6712 47.719 31.893 47.6548 29.9037 49.6483C22.6468 56.9195 15.3995 64.197 8.15548 71.481C6.23972 73.4072 6.25571 75.1535 8.17147 77.0797C14.0627 83.0025 19.9603 88.919 25.8579 94.8354C27.7193 96.7006 29.5231 96.7198 31.3685 94.8707C38.6829 87.545 45.9878 80.2096 53.2894 72.8711C55.1124 71.038 55.0612 69.1857 53.187 67.3527C51.4664 65.6705 51.4408 63.9927 53.1103 62.3191C53.3374 62.0911 53.5612 61.8664 53.7883 61.6385C54.8693 60.5513 55.9535 60.5385 57.041 61.6C58.8672 63.3688 60.5239 65.25 61.0676 67.8471C61.8479 71.5902 60.8437 74.8132 58.1763 77.5163C55.5666 80.1615 52.9344 82.7874 50.3086 85.4198C45.6263 90.1196 40.9473 94.8226 36.2586 99.5191C31.6275 104.158 25.6372 104.158 21.0125 99.5191C15.1693 93.6605 9.32924 87.8018 3.49241 81.9367C-1.15147 77.2723 -1.17066 71.2884 3.45083 66.6432C10.6661 59.3881 17.891 52.1427 25.1159 44.8972C29.7214 40.2809 35.5614 40.2391 40.2597 44.7945C41.1072 45.6163 41.8652 46.5248 42.6008 47.3209L42.604 47.3273Z" fill="#B0BBCB" />
                                        <path d="M72.1017 47.0402C72.7893 48.151 73.4417 49.1461 74.0334 50.1734C75.2871 52.3467 77.0974 52.886 79.269 51.6308C88.2433 46.4431 97.2144 41.249 106.179 36.0388C108.389 34.7547 108.847 33.0116 107.567 30.7804C103.377 23.4676 99.1718 16.1643 94.9597 8.86425C93.6804 6.64599 91.9373 6.17409 89.7369 7.44534C80.7306 12.6555 71.7275 17.8721 62.7276 23.0952C60.6871 24.2797 60.2265 26.1353 61.3875 28.193C61.896 29.0951 62.4045 30.0036 62.7979 30.957C62.9035 31.2106 62.6892 31.8077 62.4461 31.9618C61.1028 32.8221 59.7212 33.6183 58.3139 34.3695C58.0581 34.5075 57.4664 34.4722 57.3193 34.2892C53.8012 29.8431 52.2404 24.1963 56.9227 19.1049C57.6103 18.3569 58.5058 17.7534 59.3918 17.2365C68.4173 11.975 77.4556 6.73588 86.5034 1.51606C91.7006 -1.4855 97.6302 0.0746653 100.653 5.26881C104.97 12.6941 109.253 20.1386 113.506 27.5991C116.462 32.7868 114.926 38.7097 109.796 41.7177C100.717 47.0402 91.6079 52.3146 82.48 57.5473C77.2701 60.536 71.5388 58.9983 68.3981 53.8684C67.816 52.9181 67.3043 51.9198 66.8661 50.8957C66.7606 50.6453 66.9748 50.0418 67.2211 49.8877C68.7371 48.9375 70.3074 48.0707 72.1017 47.037V47.0402Z" fill="#B0BBCB" />
                                        <path d="M59.8138 47.7195C58.6976 45.7838 57.607 43.893 56.4844 41.9508C56.6699 41.7999 56.801 41.6554 56.9609 41.5623C63.754 37.6202 70.528 33.6491 77.3658 29.784C78.1846 29.3218 79.3616 29.1805 80.305 29.3314C81.6067 29.5368 82.4255 30.5577 82.643 31.906C82.8892 33.4405 82.3615 34.6796 81.0151 35.479C78.4437 37.0006 75.8467 38.4837 73.2625 39.9861C69.1591 42.3681 65.0589 44.7533 60.9555 47.1321C60.6165 47.3279 60.2583 47.4948 59.817 47.7228L59.8138 47.7195Z" fill="#5E7E9A" />
                                        <path d="M49.8031 48.386C51.3798 49.9719 52.9246 51.5224 54.5205 53.1307C52.5696 55.0825 50.5643 57.0857 48.5654 59.0889C44.8714 62.7935 41.1838 66.5077 37.4802 70.2027C36.4855 71.1947 35.3182 71.6762 33.8949 71.1979C32.5549 70.7484 31.6497 69.8143 31.5986 68.4339C31.5666 67.5543 31.8001 66.3922 32.3726 65.8079C38.1326 59.9428 43.9855 54.1676 49.7967 48.3828L49.8031 48.386Z" fill="#5E7E9A" />
                                        <path d="M15.5048 27.709C19.1221 28.0653 22.6434 28.3864 26.1615 28.7652C27.5015 28.9096 28.1988 29.7186 28.0324 30.7555C27.8661 31.7956 26.9674 32.29 25.6529 32.1488C22.2148 31.7764 18.7767 31.4361 15.3385 31.0733C14.0112 30.9321 13.3972 30.3093 13.4707 29.2403C13.5411 28.1938 14.2767 27.6705 15.508 27.709H15.5048Z" fill="#5E7E9A" />
                                        <path d="M65.6601 92.9184C65.8456 89.8141 66.0279 86.7066 66.2134 83.6023C66.2294 83.3647 66.271 83.1272 66.3062 82.8896C66.4533 81.8688 67.0322 81.3038 68.0652 81.3166C68.9959 81.3263 69.6963 82.1256 69.6676 83.1882C69.626 84.6232 69.5108 86.0549 69.4181 87.4899C69.2774 89.6792 69.1271 91.8686 68.9863 94.0548C68.9064 95.31 68.2411 96.0194 67.1825 95.9745C66.1495 95.9296 65.5994 95.2394 65.6218 93.997C65.6281 93.6375 65.6537 93.2779 65.6697 92.9216C65.6697 92.9216 65.6665 92.9216 65.6633 92.9216L65.6601 92.9184Z" fill="#5E7E9A" />
                                        <path d="M25.4033 8.12891C26.0078 8.55908 26.5675 8.80947 26.9193 9.23322C29.1901 11.9555 31.4257 14.7099 33.6517 17.4707C34.512 18.5364 34.4672 19.5348 33.5941 20.1897C32.7977 20.7868 31.8063 20.5685 31.0099 19.5958C28.7423 16.819 26.446 14.0614 24.2584 11.2204C23.9066 10.7645 23.8586 9.86885 24.0281 9.27496C24.1496 8.83837 24.85 8.56229 25.4033 8.12891Z" fill="#5E7E9A" />
                                        <path d="M87.2164 65.1708C90.7505 65.4052 94.0159 65.601 97.2749 65.8482C98.6342 65.9509 99.2323 66.5833 99.1619 67.6652C99.0947 68.6989 98.3272 69.3024 97.0287 69.2253C93.4466 69.0135 89.8646 68.7727 86.2857 68.5255C85.2015 68.4517 84.5394 67.7454 84.5714 66.7663C84.6034 65.7647 85.2686 65.1869 86.4104 65.1708C86.7686 65.1644 87.1268 65.1708 87.2164 65.1708Z" fill="#5E7E9A" />
                                        <path d="M43.605 14.0291C43.9408 10.607 44.267 7.18166 44.6156 3.75956C44.7244 2.68735 45.4887 1.97468 46.4003 2.02604C47.3789 2.08062 48.0538 2.87996 47.9546 4.04527C47.638 7.71135 47.2926 11.3742 46.912 15.0339C46.7936 16.1831 45.9717 16.7931 44.945 16.6518C43.9952 16.5202 43.4898 15.7851 43.5602 14.6262C43.573 14.4271 43.605 14.2281 43.6274 14.0291C43.6178 14.0291 43.6114 14.0291 43.6018 14.0291H43.605Z" fill="#5E7E9A" />
                                        <path d="M80.3465 76.7578C80.9574 77.1623 81.4947 77.3806 81.8433 77.769C84.2708 80.4752 86.6695 83.2104 89.0554 85.9583C89.7942 86.809 89.7558 87.756 89.0586 88.4238C88.2974 89.1493 87.3603 89.1107 86.5447 88.1958C84.0981 85.4511 81.6546 82.7031 79.2911 79.8846C78.9297 79.4544 78.7985 78.5812 78.9648 78.0323C79.112 77.5411 79.8156 77.2169 80.3465 76.7578Z" fill="#5E7E9A" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4418_8378">
                                            <rect width="115" height="103" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            <p class="empty-connections-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("You still don't have any Connections")}}</p>
                            <button type="button" id="connections-add-new-report-btn" class="d-flex flex-row align-items-center bg-white text-decoration-none empty-connection-add-button" style="@if($get_locale=='ar') width: 216px; @endif">
                                <span>
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="primary-text-color empty-connection-add-button-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Add New Connection ")}}</span>
                            </button>
                        </div>
                    </div>
                    <div id="not-empty-connections-container" class="row g-3">
                        <div class="col-4 col-md-auto fb-column-container @if(Auth::user() && Auth::user()->company->social_account_facebook->isEmpty()) d-none @endif">
                            @include('tenant.v2.cards.facebook',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto fbAds-column-container @if(Auth::user() && Auth::user()->company->social_account_facebook_ads->isEmpty()) d-none @endif">
                            @include('tenant.v2.cards.facebookAds',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto instagram-column-container @if(Auth::user() && Auth::user()->company->social_account_instagram->isEmpty()) d-none @endif">
                            @include('tenant.v2.cards.instagram',['get_locale'=>$get_locale,'random_id'=>88])
                        </div>
                        <div class="col-4 col-md-auto twitter-column-container @if(Auth::user() && Auth::user()->company->social_account_twitter->isEmpty()) d-none @endif">
                            @include('tenant.v2.cards.twitter',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto ga-column-container @if(Auth::user() && Auth::user()->company->social_account_google_analytics->isEmpty()) d-none @endif">
                            @include('tenant.v2.cards.googleAnalytics',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto gAds-column-container @if(Auth::user() && Auth::user()->company->social_account_google_ads->isEmpty()) d-none @endif">
                            @include('tenant.v2.cards.googleAds',['get_locale'=>$get_locale])
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="ads-connections">
                    <div class="row g-3">
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.facebookAds',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.googleAds',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.twitterAds',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.linkedInAds',['get_locale'=>$get_locale])
                        </div>
                    </div>
                </div>
                <div class="tab-pane @if($tab_type=='all') active @else fade @endif " id="all-connections">
                    <div class="row g-3">
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.facebook',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.facebookAds',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.twitter',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.instagram',['get_locale'=>$get_locale,'random_id'=>99])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.googleAds',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.googleAnalytics',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.twitterAds',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.linkedInAds',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.linkedIn',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.apple',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.google-play',['get_locale'=>$get_locale,'random_id'=>999])
                        </div>                        
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="49" height="50" viewBox="0 0 49 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M48.7226 25.0583C48.7226 23.321 48.5653 21.6505 48.2732 20.0469H24.9944V29.524H38.2966C37.7236 32.5865 35.9822 35.1813 33.3644 36.9185V43.0658H41.3525C46.0262 38.8006 48.7226 32.5197 48.7226 25.0583Z" fill="#4285F4" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.9946 49.0013C31.6681 49.0013 37.2631 46.8075 41.3527 43.0656L33.3646 36.9183C31.1513 38.3883 28.3201 39.257 24.9946 39.257C18.5569 39.257 13.108 34.9472 11.1643 29.1562H2.90662V35.504C6.97367 43.5111 15.3325 49.0013 24.9946 49.0013Z" fill="#34A853" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1641 29.1539C10.6698 27.6839 10.3889 26.1137 10.3889 24.4989C10.3889 22.8841 10.6698 21.3139 11.1641 19.8438V13.4961H2.90645C1.23244 16.8036 0.277466 20.5454 0.277466 24.4989C0.277466 28.4523 1.23244 32.1941 2.90645 35.5016L11.1641 29.1539Z" fill="#FBBC05" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.9946 9.74436C28.6235 9.74436 31.8816 10.9805 34.4432 13.4082L41.5324 6.38117C37.2519 2.42774 31.6569 0 24.9946 0C15.3325 0 6.97367 5.49025 2.90662 13.4973L11.1643 19.8451C13.108 14.0542 18.5569 9.74436 24.9946 9.74436Z" fill="#EA4335" />
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Google my business')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="apps-connections">
                    <div class="row g-3">
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.google-play',['get_locale'=>$get_locale,'random_id'=>888])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.apple',['get_locale'=>$get_locale])
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="social-media-connections">
                    <div class="row g-3">
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.facebook',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.twitter',['get_locale'=>$get_locale])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.instagram',['get_locale'=>$get_locale,'random_id'=>1010])
                        </div>
                        <div class="col-4 col-md-auto">
                            @include('tenant.v2.cards.linkedIn',['get_locale'=>$get_locale])
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="coming-soon-connections">
                    <div class="row g-3">
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M47.4405 12.9554C47.1651 11.938 46.628 11.0105 45.8827 10.2652C45.1374 9.51985 44.2099 8.98278 43.1925 8.70741C39.4675 7.69141 24.4755 7.69141 24.4755 7.69141C24.4755 7.69141 9.48346 7.72241 5.75946 8.73841C4.74186 9.01363 3.81412 9.55063 3.06863 10.2959C2.32314 11.0413 1.78592 11.9689 1.51046 12.9864C0.383459 19.6044 -0.0525408 29.6914 1.54146 36.0434C1.81683 37.0608 2.35391 37.9884 3.09921 38.7337C3.84451 39.479 4.77205 40.016 5.78946 40.2914C9.51446 41.3074 24.5065 41.3074 24.5065 41.3074C24.5065 41.3074 39.4985 41.3074 43.2235 40.2914C44.2409 40.016 45.1684 39.479 45.9137 38.7337C46.659 37.9884 47.1961 37.0608 47.4715 36.0434C48.6595 29.4154 49.0265 19.3374 47.4405 12.9554Z" fill="#FF0000"/>
                                    <path d="M19.7046 31.7039L32.1416 24.5039L19.7046 17.2969V31.7039Z" fill="white"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Youtube')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M36.1688 18.545C39.51 20.9343 43.5163 22.2157 47.6238 22.209V13.997C46.8152 13.9971 46.0088 13.9126 45.2178 13.745V20.212C41.1086 20.2185 37.1008 18.9359 33.7588 16.545V33.314C33.7552 36.0651 33.0051 38.7637 31.5883 41.1219C30.1716 43.4802 28.1413 45.4097 25.7141 46.7048C23.2869 47.9998 20.5537 48.6118 17.806 48.4756C15.0582 48.3393 12.399 47.4599 10.1118 45.931C12.2238 48.0865 14.9296 49.5645 17.8845 50.1769C20.8394 50.7892 23.9097 50.5081 26.7043 49.3695C29.4989 48.2308 31.8913 46.286 33.5769 43.7829C35.2624 41.2798 36.1647 38.3317 36.1688 35.314V18.545ZM39.1368 10.257C37.4401 8.40918 36.3973 6.0552 36.1688 3.557V2.5H33.8888C34.1699 4.08923 34.7824 5.6015 35.6864 6.93846C36.5904 8.27542 37.7657 9.40713 39.1358 10.26L39.1368 10.257ZM15.4188 39.495C14.5274 38.319 14.0333 36.8898 14.0082 35.4143C13.9831 33.9388 14.4282 32.4936 15.2792 31.2879C16.1301 30.0822 17.3427 29.1786 18.7413 28.708C20.14 28.2373 21.6521 28.224 23.0588 28.67V20.27C22.2637 20.1613 21.4612 20.1151 20.6588 20.132V26.67C18.9929 26.1359 17.1867 26.2498 15.6012 26.9892C14.0156 27.7285 12.7673 29.0388 12.1056 30.6583C11.4439 32.2778 11.4175 34.0874 12.0317 35.7255C12.6459 37.3636 13.8555 38.7097 15.4188 39.495Z" fill="#FF004F"/>
                                    <path d="M33.7638 16.545C37.1051 18.934 41.1113 20.2154 45.2188 20.209V13.745C42.8782 13.2446 40.7521 12.0263 39.1368 10.26C37.7666 9.40713 36.5914 8.27542 35.6874 6.93846C34.7834 5.6015 34.1709 4.08923 33.8898 2.5H27.9008V35.314C27.8947 36.7662 27.434 38.18 26.5833 39.357C25.7326 40.5339 24.5346 41.4149 23.1576 41.8761C21.7806 42.3374 20.2937 42.3557 18.9057 41.9287C17.5177 41.5016 16.2983 40.6506 15.4188 39.495C13.8594 38.7077 12.6537 37.3619 12.0419 35.7256C11.43 34.0894 11.4569 32.2827 12.1171 30.6654C12.7774 29.0481 14.0226 27.7388 15.6047 26.9982C17.1868 26.2576 18.9899 26.1401 20.6548 26.669V20.132C17.6928 20.1925 14.8131 21.1182 12.3707 22.795C9.92829 24.4718 8.02976 26.8266 6.90906 29.5691C5.78836 32.3116 5.49444 35.322 6.06352 38.2295C6.6326 41.1369 8.03982 43.8144 10.1118 45.932C12.3991 47.4623 15.0589 48.3428 17.8075 48.4797C20.5561 48.6167 23.2903 48.0048 25.7183 46.7095C28.1464 45.4142 30.1772 43.4839 31.5942 41.1247C33.0111 38.7656 33.761 36.066 33.7638 33.314V16.545Z" fill="black"/>
                                    <path d="M45.2188 13.745V12C43.0683 12.0023 40.9607 11.3993 39.1368 10.26C40.7516 12.0269 42.8779 13.2453 45.2188 13.745ZM33.8898 2.5C33.8351 2.18733 33.7931 1.873 33.7638 1.557V0.5H25.4958V33.314C25.4914 34.4984 25.1846 35.662 24.6044 36.6946C24.0241 37.7271 23.1898 38.5943 22.1804 39.2139C21.171 39.8336 20.0201 40.1851 18.8368 40.2351C17.6534 40.2852 16.4769 40.0322 15.4188 39.5C16.2984 40.6556 17.5179 41.5067 18.906 41.9337C20.2941 42.3608 21.781 42.3423 23.1581 41.8809C24.5352 41.4196 25.7331 40.5385 26.5837 39.3614C27.4344 38.1843 27.895 36.7703 27.9008 35.318V2.5H33.8898ZM20.6558 20.132V18.271C19.9648 18.1767 19.2682 18.1296 18.5708 18.13C15.3143 18.1288 12.1437 19.1746 9.52687 21.113C6.91008 23.0513 4.98574 25.7796 4.03786 28.8951C3.08998 32.0106 3.16879 35.3483 4.26264 38.4156C5.35649 41.4829 7.40744 44.1173 10.1128 45.93C8.04083 43.8124 6.63362 41.1349 6.06453 38.2275C5.49545 35.32 5.78937 32.3096 6.91007 29.5671C8.03077 26.8246 9.9293 24.4698 12.3717 22.793C14.8142 21.1162 17.6938 20.1905 20.6558 20.13V20.132Z" fill="#00F2EA"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('TikTok Ads ')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="49" height="51" viewBox="0 0 49 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M42.7976 41.6636C22.1595 51.4816 9.35055 43.2636 1.15055 38.2736C0.643548 37.9586 -0.219453 38.3466 0.529547 39.2066C3.26055 42.5186 12.2125 50.5006 23.8965 50.5006C35.5805 50.5006 42.5446 44.1206 43.4146 43.0076C44.2845 41.8946 43.6685 41.2956 42.7945 41.6596L42.7976 41.6636ZM48.5975 38.4636C48.0435 37.7416 45.2276 37.6076 43.4556 37.8256C41.6836 38.0436 39.0166 39.1256 39.2486 39.7726C39.3675 40.0166 39.6095 39.9066 40.8295 39.7976C42.0495 39.6886 45.4765 39.2436 46.1905 40.1766C46.9045 41.1096 45.0985 45.5906 44.7675 46.3126C44.4365 47.0346 44.8895 47.2206 45.4895 46.7396C46.5382 45.774 47.3526 44.5817 47.8705 43.2536C48.5845 41.4826 49.0196 39.0136 48.5985 38.4636H48.5975Z" fill="#FF9900"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M28.9208 21.619C28.9208 24.196 28.9858 26.345 27.6838 28.634C27.2611 29.4998 26.613 30.2358 25.8076 30.7646C25.0022 31.2934 24.0693 31.5954 23.1068 31.639C20.5668 31.639 19.0878 29.704 19.0878 26.848C19.0878 21.21 24.1398 20.187 28.9218 20.187L28.9208 21.619ZM35.5908 37.742C35.3772 37.924 35.1131 38.0367 34.8339 38.0649C34.5547 38.0931 34.2735 38.0356 34.0278 37.9C32.5065 36.6702 31.2192 35.1763 30.2278 33.49C26.5998 37.19 24.0278 38.3 19.3278 38.3C13.7638 38.3 9.42776 34.867 9.42776 27.992C9.34999 25.6838 9.98521 23.4076 11.247 21.4732C12.5088 19.5388 14.3359 18.0401 16.4798 17.181C20.0708 15.599 25.0858 15.32 28.9188 14.881V14.025C28.9188 12.453 29.0398 10.592 28.1188 9.234C27.6842 8.66961 27.1198 8.21844 26.4736 7.91882C25.8273 7.6192 25.1183 7.47999 24.4068 7.513C21.8858 7.513 19.6338 8.806 19.0848 11.486C19.0512 11.7845 18.9215 12.064 18.7151 12.2823C18.5087 12.5006 18.2369 12.6458 17.9408 12.696L11.5218 12.008C11.3642 11.9857 11.2128 11.9316 11.0768 11.8489C10.9408 11.7662 10.8231 11.6566 10.7309 11.5269C10.6386 11.3972 10.5737 11.2501 10.5402 11.0945C10.5066 10.939 10.5051 10.7782 10.5358 10.622C12.0158 2.845 19.0398 0.5 25.3288 0.5C28.5478 0.5 32.7528 1.356 35.2928 3.794C38.5118 6.794 38.2048 10.809 38.2048 15.172V25.48C38.2048 28.58 39.4888 29.936 40.6978 31.611C40.812 31.7277 40.9021 31.8657 40.9629 32.0172C41.0238 32.1687 41.0542 32.3307 41.0524 32.4939C41.0507 32.6572 41.0168 32.8185 40.9526 32.9686C40.8885 33.1188 40.7955 33.2548 40.6788 33.369C39.3298 34.495 36.9298 36.588 35.6088 37.76L35.5898 37.741" fill="black"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Amazon Ads')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M49.9985 26.0524C50.0282 24.3337 49.851 22.6177 49.4705 20.9414H25.9985V30.2194H39.7765C39.5155 31.8461 38.9282 33.4033 38.0499 34.7972C37.1715 36.1911 36.0203 37.3929 34.6655 38.3304L34.6185 38.6414L42.0395 44.3904L42.5535 44.4414C47.2755 40.0804 49.9975 33.6634 49.9975 26.0524" fill="#4285F4"/>
                                    <path d="M25.9985 50.4964C32.0881 50.6682 38.0122 48.5011 42.5535 44.4404L34.6645 38.3294C32.106 40.0443 29.0763 40.9182 25.9975 40.8294C22.8365 40.8108 19.7616 39.7972 17.2089 37.9326C14.6563 36.068 12.7557 33.447 11.7765 30.4414L11.4835 30.4664L3.7665 36.4384L3.6665 36.7194C5.74485 40.8614 8.93431 44.3436 12.8783 46.7768C16.8223 49.21 21.3653 50.4982 25.9995 50.4974" fill="#34A853"/>
                                    <path d="M11.7766 30.4403C11.2305 28.849 10.9491 27.1788 10.9436 25.4963C10.9535 23.8165 11.2251 22.1485 11.7486 20.5523L11.7346 20.2213L3.92057 14.1523L3.66457 14.2743C1.9113 17.7553 0.998047 21.5987 0.998047 25.4963C0.998047 29.394 1.9113 33.2373 3.66457 36.7183L11.7766 30.4403Z" fill="#FBBC05"/>
                                    <path d="M25.9985 10.1648C29.5809 10.109 33.0456 11.443 35.6655 13.8868L42.7205 6.99783C38.1953 2.75261 32.2029 0.423285 25.9985 0.497829C21.3644 0.497031 16.8213 1.78524 12.8773 4.21842C8.93334 6.65161 5.74387 10.1339 3.66553 14.2758L11.7485 20.5538C12.7373 17.5484 14.6444 14.9291 17.201 13.0652C19.7576 11.2013 22.8347 10.1868 25.9985 10.1648Z" fill="#EB4335"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Google Search')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.14104 10.6172H45.841C46.453 10.6172 47.059 10.7378 47.6244 10.972C48.1898 11.2063 48.7035 11.5496 49.1362 11.9825C49.5688 12.4153 49.9119 12.9292 50.146 13.4947C50.38 14.0601 50.5003 14.6662 50.5 15.2782V30.8172C50.5003 31.4294 50.3799 32.0356 50.1458 32.6012C49.9116 33.1668 49.5683 33.6807 49.1355 34.1136C48.7026 34.5465 48.1887 34.8898 47.623 35.1239C47.0574 35.3581 46.4512 35.4785 45.839 35.4782H31.245L33.245 40.3842L24.435 35.4782H5.16204C4.54979 35.4786 3.94347 35.3583 3.37774 35.1242C2.812 34.8901 2.29796 34.5468 1.86499 34.114C1.43201 33.6811 1.08861 33.1671 0.854401 32.6014C0.620194 32.0357 0.49978 31.4294 0.500043 30.8172V15.2782C0.497409 14.667 0.615541 14.0612 0.847656 13.4958C1.07977 12.9303 1.4213 12.4163 1.85262 11.9832C2.28395 11.5501 2.79658 11.2065 3.36107 10.9721C3.92557 10.7377 4.53081 10.6171 5.14204 10.6172L5.14104 10.6172Z" fill="#7F54B3"/>
                                    <path d="M3.34778 14.8631C3.49971 14.6682 3.6938 14.5103 3.91549 14.4012C4.13718 14.2921 4.3807 14.2346 4.62778 14.2331C4.8432 14.1912 5.06521 14.1977 5.27784 14.2519C5.49047 14.3062 5.68844 14.4069 5.85751 14.5468C6.02657 14.6867 6.16253 14.8623 6.2556 15.061C6.34868 15.2597 6.39655 15.4766 6.39578 15.6961C7.02578 19.9441 7.71011 23.5417 8.44878 26.4891L12.9008 18.0141C13.0235 17.6937 13.2294 17.4119 13.4973 17.1976C13.7651 16.9834 14.0853 16.8444 14.4248 16.7951C15.3188 16.7341 15.8678 17.3031 16.0918 18.5021C16.5133 20.8754 17.1599 23.2033 18.0228 25.4541C18.5514 20.2914 19.4458 16.5651 20.7058 14.2751C20.8268 14.0182 21.0157 13.7991 21.252 13.6416C21.4883 13.4841 21.7631 13.394 22.0468 13.3811C22.5103 13.3426 22.9702 13.4885 23.3268 13.7871C23.5085 13.924 23.6588 14.0983 23.7675 14.2982C23.8761 14.4982 23.9407 14.7191 23.9568 14.9461C23.9853 15.2839 23.9158 15.6227 23.7568 15.9221C22.7234 18.2492 22.0575 20.7227 21.7828 23.2541C21.3269 25.8099 21.1353 28.4059 21.2108 31.0011C21.2601 31.4622 21.1753 31.9278 20.9668 32.3421C20.8667 32.5474 20.7146 32.723 20.5257 32.8514C20.3368 32.9798 20.1175 33.0565 19.8898 33.0741C19.5828 33.0774 19.279 33.0116 19.0009 32.8814C18.7229 32.7512 18.4778 32.56 18.2838 32.3221C16.099 29.8482 14.5563 26.8748 13.7918 23.6641C12.4704 26.2641 11.4948 28.2154 10.8648 29.5181C9.66478 31.8181 8.64978 32.9941 7.79578 33.0541C7.24678 33.0951 6.77978 32.6271 6.37278 31.6541C5.33878 28.9874 4.22211 23.8444 3.02278 16.2251C2.9791 15.9879 2.98545 15.7443 3.04141 15.5097C3.09738 15.2752 3.20173 15.0549 3.34778 14.8631ZM47.0268 18.0541C46.6937 17.4443 46.2291 16.9164 45.6666 16.5085C45.1041 16.1006 44.4579 15.8231 43.7748 15.6961C43.4133 15.6174 43.0447 15.5765 42.6748 15.5741C40.7238 15.5741 39.1388 16.5901 37.8988 18.6231C36.8438 20.347 36.2952 22.333 36.3158 24.3541C36.2761 25.7585 36.6131 27.1479 37.2918 28.3781C37.6249 28.9878 38.0895 29.5158 38.652 29.9236C39.2145 30.3315 39.8607 30.609 40.5438 30.7361C40.9052 30.8148 41.2739 30.8556 41.6438 30.8581C42.6433 30.8382 43.6179 30.5431 44.4606 30.0052C45.3032 29.4673 45.9811 28.7074 46.4198 27.8091C47.4731 26.0756 48.0213 24.0824 48.0028 22.0541C48.057 20.6558 47.7189 19.2702 47.0268 18.0541ZM44.4658 23.6841C44.2877 24.8268 43.7459 25.8816 42.9208 26.6921C42.7169 26.9223 42.4616 27.1011 42.1756 27.2141C41.8896 27.327 41.5809 27.3709 41.2748 27.3421C40.7868 27.2421 40.3808 26.8141 40.0748 26.0211C39.8401 25.4321 39.7161 24.805 39.7088 24.1711C39.7037 23.6728 39.7513 23.1753 39.8508 22.6871C40.042 21.816 40.4084 20.993 40.9278 20.2681C41.5988 19.2681 42.3098 18.8681 43.0418 19.0081C43.5298 19.1081 43.9358 19.5361 44.2418 20.3291C44.4764 20.918 44.6005 21.5451 44.6078 22.1791C44.6135 22.6827 44.5659 23.1855 44.4658 23.6791V23.6841ZM34.3038 18.0541C33.9684 17.4462 33.503 16.9197 32.941 16.5121C32.3789 16.1045 31.7338 15.8259 31.0518 15.6961C30.6903 15.6174 30.3217 15.5765 29.9518 15.5741C28.0008 15.5741 26.4158 16.5901 25.1758 18.6231C24.1208 20.347 23.5722 22.333 23.5928 24.3541C23.5531 25.7585 23.8901 27.1479 24.5688 28.3781C24.9019 28.9878 25.3665 29.5158 25.929 29.9236C26.4915 30.3315 27.1377 30.609 27.8208 30.7361C28.1822 30.8148 28.5509 30.8556 28.9208 30.8581C29.9203 30.8382 30.8949 30.5431 31.7376 30.0052C32.5802 29.4673 33.2581 28.7074 33.6968 27.8091C34.7497 26.0755 35.2976 24.0823 35.2788 22.0541C35.3231 20.6568 34.9856 19.2739 34.3028 18.0541H34.3038ZM31.7228 23.6841C31.5447 24.8268 31.0029 25.8816 30.1778 26.6921C29.9739 26.9223 29.7186 27.1011 29.4326 27.2141C29.1466 27.327 28.8379 27.3709 28.5318 27.3421C28.0438 27.2421 27.6378 26.8141 27.3318 26.0211C27.0971 25.4321 26.9731 24.805 26.9658 24.1711C26.9607 23.6728 27.0083 23.1753 27.1078 22.6871C27.2989 21.816 27.6654 20.993 28.1848 20.2681C28.8558 19.2681 29.5668 18.8681 30.2988 19.0081C30.7868 19.1081 31.1928 19.5361 31.4988 20.3291C31.7334 20.918 31.8575 21.5451 31.8648 22.1791C31.8807 22.683 31.833 23.187 31.7228 23.6791V23.6841Z" fill="white"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Woocommerce')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M25.5062 0.671875C22.246 0.671875 19.0177 1.31402 16.0057 2.56164C12.9936 3.80927 10.2569 5.63793 7.95155 7.94324C5.64625 10.2485 3.81757 12.9853 2.56995 15.9974C1.32232 19.0094 0.680176 22.2377 0.680176 25.4979C0.680663 30.4921 2.18657 35.3702 5.00136 39.4956C7.81615 43.621 11.8091 46.8021 16.4592 48.6239C16.1307 46.2566 16.1596 43.8535 16.5452 41.4949C16.9962 39.5569 19.4562 29.1549 19.4562 29.1549C18.9507 27.9926 18.6975 26.7363 18.7132 25.4689C18.7132 22.0169 20.7132 19.4399 23.2052 19.4399C25.3232 19.4399 26.3462 21.0299 26.3462 22.9399C26.3462 25.0699 24.9902 28.2549 24.2902 31.2059C24.1505 31.7528 24.1414 32.325 24.2636 32.8761C24.3858 33.4272 24.6359 33.9419 24.9937 34.3785C25.3515 34.8152 25.8069 35.1616 26.3233 35.3897C26.8397 35.6178 27.4024 35.7214 27.9662 35.6919C32.3782 35.6919 35.7662 31.0389 35.7662 24.3239C35.7662 18.3799 31.4952 14.2239 25.3962 14.2239C23.9441 14.1611 22.4943 14.3936 21.1347 14.9072C19.775 15.4208 18.5336 16.2049 17.4857 17.2121C16.4378 18.2193 15.6051 19.4286 15.0379 20.7668C14.4708 22.105 14.181 23.5444 14.1862 24.9979C14.1894 27.0341 14.8362 29.0173 16.0342 30.6639C16.122 30.7575 16.184 30.8724 16.2142 30.9972C16.2443 31.122 16.2416 31.2525 16.2062 31.3759C16.0182 32.1599 15.5992 33.8459 15.5172 34.1909C15.4092 34.6449 15.1572 34.7419 14.6872 34.5229C11.5872 33.0799 9.64818 28.5459 9.64818 24.9049C9.64818 17.0739 15.3382 9.88188 26.0482 9.88188C34.6602 9.88188 41.3482 16.0189 41.3482 24.2199C41.3482 32.7759 35.9532 39.6619 28.4662 39.6619C25.9502 39.6619 23.5852 38.3549 22.7762 36.8109C22.7762 36.8109 21.5312 41.5509 21.2292 42.7109C20.4876 45.0051 19.4502 47.1928 18.1432 49.2189C20.524 49.9549 23.0022 50.3281 25.4942 50.3259C28.7544 50.3259 31.9827 49.6837 34.9947 48.4361C38.0067 47.1885 40.7435 45.3598 43.0488 43.0545C45.3541 40.7492 47.1828 38.0124 48.4304 35.0004C49.678 31.9883 50.3202 28.7601 50.3202 25.4999C50.3207 18.9173 47.707 12.6041 43.0538 7.94819C38.4005 3.29233 32.0887 0.675057 25.5062 0.671875" fill="#E60023"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Pinterest Ads ')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.0449 0.5H10.7269C9.82356 0.502638 8.958 0.862647 8.31926 1.50139C7.68052 2.14013 7.32051 3.00569 7.31787 3.909V47.091C7.32051 47.9943 7.68052 48.8599 8.31926 49.4986C8.958 50.1374 9.82356 50.4974 10.7269 50.5H40.2729C41.1762 50.4974 42.0417 50.1374 42.6805 49.4986C43.3192 48.8599 43.6792 47.9943 43.6819 47.091V14.136L35.7269 8.455L30.0449 0.5Z" fill="#0F9D58"/>
                                    <path d="M16.4082 24.9297V41.4087H34.5902V24.9297H16.4082ZM24.3632 39.1297H18.6812V36.2957H24.3632V39.1297ZM24.3632 34.5847H18.6812V31.7497H24.3632V34.5847ZM24.3632 30.0397H18.6812V27.2047H24.3632V30.0397ZM32.3182 39.1307H26.6362V36.2957H32.3182V39.1307ZM32.3182 34.5857H26.6362V31.7497H32.3182V34.5857ZM32.3182 30.0407H26.6362V27.2047H32.3182V30.0407Z" fill="#F1F1F1"/>
                                    <path d="M31.043 13.1406L43.683 25.7766V14.1376L31.043 13.1406Z" fill="url(#paint0_linear_4418_7968)"/>
                                    <path d="M30.0449 0.5V10.728C30.0448 11.1757 30.1329 11.6191 30.3041 12.0327C30.4754 12.4464 30.7265 12.8222 31.0431 13.1388C31.3597 13.4554 31.7355 13.7065 32.1492 13.8778C32.5629 14.049 33.0062 14.1371 33.4539 14.137H43.6819L30.0449 0.5Z" fill="#87CEAC"/>
                                    <path d="M10.7269 0.5C9.82356 0.502638 8.958 0.862647 8.31926 1.50139C7.68052 2.14013 7.32051 3.00569 7.31787 3.909V4.193C7.32051 3.28969 7.68052 2.42413 8.31926 1.78539C8.958 1.14665 9.82356 0.786638 10.7269 0.784H30.0449V0.5H10.7269Z" fill="white" fill-opacity="0.2"/>
                                    <path d="M40.2729 50.2137H10.7269C9.82356 50.211 8.958 49.851 8.31926 49.2123C7.68052 48.5736 7.32051 47.708 7.31787 46.8047V47.0887C7.32051 47.992 7.68052 48.8576 8.31926 49.4963C8.958 50.135 9.82356 50.4951 10.7269 50.4977H40.2729C41.1762 50.4951 42.0417 50.135 42.6805 49.4963C43.3192 48.8576 43.6792 47.992 43.6819 47.0887V46.8047C43.6792 47.708 43.3192 48.5736 42.6805 49.2123C42.0417 49.851 41.1762 50.211 40.2729 50.2137Z" fill="#263238" fill-opacity="0.2"/>
                                    <path d="M33.4539 14.1356C33.0062 14.1357 32.5629 14.0476 32.1492 13.8763C31.7355 13.7051 31.3597 13.454 31.0431 13.1374C30.7265 12.8208 30.4754 12.4449 30.3041 12.0313C30.1329 11.6176 30.0448 11.1743 30.0449 10.7266V11.0136C30.0448 11.4613 30.1329 11.9046 30.3041 12.3183C30.4754 12.7319 30.7265 13.1078 31.0431 13.4244C31.3597 13.741 31.7355 13.9921 32.1492 14.1633C32.5629 14.3346 33.0062 14.4227 33.4539 14.4226H43.6819V14.1386L33.4539 14.1356Z" fill="#263238" fill-opacity="0.1"/>
                                    <path d="M30.931 0.5H7.84597C5.60497 0.5 3.77197 2.034 3.77197 3.909V47.091C3.77197 48.966 5.60497 50.5 7.84597 50.5H43.153C45.394 50.5 47.227 48.966 47.227 47.091V14.136L30.931 0.5Z" fill="url(#paint1_radial_4418_7968)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_4418_7968" x1="37.363" y1="14.2273" x2="37.363" y2="25.7766" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#263238" stop-opacity="0.2"/>
                                    <stop offset="1" stop-color="#263238" stop-opacity="0.02"/>
                                    </linearGradient>
                                    <radialGradient id="paint1_radial_4418_7968" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(5.16253 1.48845) scale(70.0495 58.5962)">
                                    <stop stop-color="white" stop-opacity="0.102"/>
                                    <stop offset="1" stop-color="white" stop-opacity="0"/>
                                    </radialGradient>
                                    </defs>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Google Sheets ')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="45" height="51" viewBox="0 0 45 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M39.0297 10.235C39.0128 10.1282 38.9606 10.0301 38.8814 9.95648C38.8021 9.88287 38.7005 9.83798 38.5927 9.829C38.4107 9.814 34.5677 9.529 34.5677 9.529C34.5677 9.529 31.8987 6.879 31.6057 6.586C31.4479 6.47914 31.2673 6.41089 31.0783 6.38674C30.8893 6.36259 30.6972 6.38324 30.5177 6.447L29.0237 6.908C28.1317 4.342 26.5587 1.985 23.7907 1.985C23.7147 1.985 23.6357 1.985 23.5567 1.993C23.2679 1.55953 22.8823 1.19905 22.4304 0.939963C21.9786 0.680878 21.4727 0.530268 20.9527 0.5C14.5047 0.5 11.4237 8.561 10.4527 12.658L5.93969 14.058C4.53969 14.497 4.4967 14.541 4.3127 15.858C4.1747 16.858 0.512695 45.158 0.512695 45.158L29.0287 50.501L44.4797 47.158C44.4797 47.158 39.0557 10.487 39.0217 10.236L39.0297 10.235ZM27.4487 7.397L25.0357 8.144C25.0357 7.974 25.0357 7.807 25.0357 7.624C25.0631 6.30094 24.8684 4.98265 24.4597 3.724C25.8827 3.906 26.8377 5.529 27.4487 7.397ZM22.6917 4.043C23.176 5.43821 23.3978 6.91104 23.3457 8.387C23.3457 8.487 23.3457 8.575 23.3457 8.667L18.3627 10.21C19.3227 6.51 21.1207 4.718 22.6937 4.043H22.6917ZM20.7757 2.23C21.0734 2.23624 21.362 2.33362 21.6027 2.509C19.5367 3.481 17.3217 5.93 16.3827 10.821L12.4437 12.041C13.5437 8.31 16.1437 2.229 20.7727 2.229L20.7757 2.23Z" fill="#95BF46"/>
                                    <path d="M41.6579 9.83044C41.5709 9.81544 39.7259 9.53044 39.7259 9.53044C39.7259 9.53044 38.4448 6.88044 38.3038 6.58744C38.2857 6.54364 38.2585 6.50416 38.224 6.4716C38.1896 6.43903 38.1486 6.4141 38.1039 6.39844L37.0688 50.4984L44.4879 47.1564C44.4879 47.1564 41.8879 10.4854 41.8679 10.2344C41.8479 9.98344 41.7459 9.84444 41.6579 9.82844" fill="#5E8E3E"/>
                                    <path d="M23.7916 18.3662L21.8866 24.0332C20.7288 23.4667 19.4604 23.1624 18.1716 23.1422C15.1716 23.1422 15.0206 25.0242 15.0206 25.4992C15.0206 28.0872 21.7676 29.0792 21.7676 35.1422C21.7676 39.9122 18.7426 42.9832 14.6676 42.9832C13.2899 43.0195 11.9199 42.7672 10.6455 42.2426C9.37114 41.7181 8.22053 40.9328 7.26758 39.9372L8.57858 35.6072C8.57858 35.6072 11.1516 37.8162 13.3226 37.8162C13.5827 37.8279 13.8424 37.7865 14.086 37.6943C14.3295 37.6022 14.5516 37.4614 14.7388 37.2804C14.9261 37.0995 15.0744 36.8822 15.1748 36.642C15.2751 36.4018 15.3254 36.1436 15.3226 35.8832C15.3226 32.5072 9.78758 32.3562 9.78758 26.8082C9.78758 22.1392 13.1386 17.6202 19.9046 17.6202C21.2441 17.5517 22.5804 17.808 23.7996 18.3672" fill="white"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Shopify ')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.508892 37.786C0.505608 38.8996 0.581143 40.0121 0.734905 41.115C0.90204 42.282 1.24704 43.4165 1.7579 44.479C2.47876 45.8972 3.50505 47.138 4.7629 48.112C5.6616 48.8277 6.67953 49.3791 7.76989 49.741C9.37078 50.2357 11.0384 50.4805 12.7139 50.467C13.7629 50.474 14.8139 50.5 15.8599 50.495C23.4799 50.463 31.0999 50.55 38.7189 50.448C39.726 50.4262 40.7296 50.3198 41.7189 50.13C43.5878 49.801 45.3272 48.9551 46.7399 47.688C48.4041 46.2425 49.566 44.3057 50.0579 42.157C50.3611 40.7188 50.5059 39.2517 50.4899 37.782V37.489C50.4899 37.375 50.4469 12.53 50.4429 12.202C50.4397 11.3015 50.3571 10.403 50.1959 9.517C50.0159 8.43391 49.6737 7.38413 49.1809 6.403C48.6415 5.37175 47.9391 4.43436 47.1009 3.627C45.8347 2.38817 44.2708 1.4962 42.5599 1.037C40.9893 0.656386 39.3754 0.484238 37.7599 0.524998C37.7547 0.517652 37.7515 0.509003 37.7509 0.5H13.2419C13.2419 0.508 13.2419 0.516998 13.2419 0.524998C12.3227 0.517742 11.4038 0.558799 10.4889 0.647999C9.48639 0.754906 8.49953 0.977038 7.54789 1.31C5.97986 1.90082 4.57327 2.8531 3.44232 4.08952C2.31137 5.32594 1.48794 6.81164 1.03889 8.426C0.660776 9.98378 0.488647 11.5844 0.526897 13.187" fill="#FFFC00"/>
                                    <path d="M25.7723 46.7511C25.6493 46.7511 25.5313 46.751 25.4413 46.7421C25.3703 46.7481 25.2963 46.7511 25.2233 46.7511C22.6293 46.7511 20.8943 45.477 19.3633 44.351C18.3996 43.5107 17.2554 42.9034 16.0193 42.576C15.4381 42.4746 14.8493 42.4227 14.2593 42.4211C13.4378 42.4301 12.6195 42.5264 11.8183 42.7081C11.5144 42.7817 11.2045 42.8278 10.8923 42.8461C10.7318 42.8642 10.5703 42.8209 10.4404 42.7247C10.3105 42.6286 10.2219 42.4869 10.1923 42.328C10.0923 41.966 10.0163 41.6151 9.94531 41.2771C9.76731 40.4331 9.63931 39.918 9.33431 39.869C6.08031 39.347 4.15731 38.579 3.77431 37.649C3.73518 37.5559 3.7122 37.4569 3.70632 37.356C3.69739 37.2246 3.73691 37.0944 3.81743 36.9901C3.89795 36.8859 4.01388 36.8147 4.14331 36.7901C6.86019 36.2685 9.29081 34.7671 10.9733 32.571C11.9199 31.4308 12.7037 30.1647 13.3023 28.8091C13.3023 28.8001 13.3103 28.791 13.3143 28.7831C13.492 28.479 13.6037 28.1409 13.6421 27.7908C13.6806 27.4407 13.6448 27.0864 13.5373 26.7511C13.1183 25.7241 11.7293 25.266 10.8103 24.963C10.5813 24.888 10.3653 24.817 10.1933 24.746C9.37932 24.412 8.03931 23.706 8.21831 22.731C8.34748 22.3692 8.58795 22.0576 8.90523 21.8409C9.22251 21.6243 9.60028 21.5137 9.98432 21.5251C10.1684 21.521 10.3511 21.5589 10.5183 21.636C11.2003 22.0001 11.955 22.2072 12.7273 22.2421C13.1868 22.2759 13.6419 22.1327 13.9993 21.842C13.9763 21.401 13.9483 20.936 13.9213 20.495V20.489C13.7343 17.405 13.5023 13.5661 14.4473 11.3651C15.2999 9.25614 16.7662 7.45186 18.6561 6.18595C20.5461 4.92004 22.7726 4.25084 25.0473 4.26505L25.8193 4.25805H25.9193C28.197 4.24336 30.4267 4.91283 32.3196 6.17976C34.2126 7.4467 35.6815 9.25275 36.5363 11.3641C37.4813 13.5641 37.2483 17.408 37.0613 20.496L37.0523 20.644C37.0263 21.063 37.0033 21.4601 36.9833 21.8441C37.3075 22.1115 37.7171 22.2535 38.1373 22.244C38.8645 22.1874 39.5726 21.9833 40.2183 21.644C40.4325 21.5476 40.6654 21.4998 40.9003 21.504C41.1667 21.5032 41.4305 21.5556 41.6763 21.6581H41.6883C41.9715 21.7322 42.2264 21.8886 42.4208 22.1075C42.6151 22.3264 42.7402 22.5981 42.7803 22.888C42.7883 23.36 42.4503 24.066 40.7883 24.748C40.6183 24.818 40.4013 24.89 40.1713 24.965C39.2523 25.265 37.8643 25.726 37.4453 26.752C37.3376 27.0874 37.3018 27.4417 37.3402 27.7918C37.3786 28.142 37.4904 28.48 37.6683 28.784L37.6803 28.81C37.7963 29.092 40.5943 35.7221 46.8393 36.7901C46.9687 36.8147 47.0847 36.8859 47.1652 36.9901C47.2457 37.0944 47.2852 37.2246 47.2763 37.356C47.2707 37.4593 47.2474 37.5608 47.2073 37.6561C46.8273 38.5811 44.9073 39.349 41.6493 39.871C41.3433 39.92 41.2153 40.433 41.0393 41.271C40.9663 41.618 40.8923 41.958 40.7913 42.315C40.7641 42.463 40.6835 42.5957 40.5647 42.6879C40.4459 42.7801 40.2973 42.8254 40.1473 42.815H40.0963C39.7845 42.8032 39.4745 42.7624 39.1703 42.6931C38.3683 42.5184 37.5501 42.4282 36.7293 42.424C36.1393 42.4258 35.5505 42.4777 34.9693 42.5791C33.7344 42.9059 32.5912 43.5125 31.6283 44.3521C30.0943 45.479 28.3593 46.752 25.7653 46.752" fill="white"/>
                                    <path d="M25.9206 5.11106C28.065 5.09436 30.1649 5.72239 31.9481 6.91369C33.7312 8.10499 35.1152 9.80459 35.9206 11.7921C36.8016 13.8411 36.5756 17.5511 36.3946 20.5331C36.3666 21.0061 36.3386 21.4651 36.3156 21.9021L36.3056 22.0901L36.4266 22.2301C36.6288 22.4251 36.8677 22.5781 37.1295 22.6801C37.3913 22.782 37.6707 22.831 37.9516 22.8241H37.9856C38.7734 22.7656 39.5408 22.5464 40.2406 22.1801C40.3837 22.1179 40.5387 22.0878 40.6946 22.0921C40.8908 22.0909 41.0853 22.129 41.2666 22.2041L41.2926 22.2151C41.7246 22.3721 42.0296 22.6681 42.0346 22.9361C42.0346 23.0871 41.9276 23.6361 40.3976 24.2601C40.2476 24.3211 40.0506 24.3861 39.8226 24.4601C38.8226 24.7881 37.3226 25.2831 36.8156 26.5221C36.6786 26.9229 36.6285 27.3483 36.6685 27.77C36.7085 28.1917 36.8377 28.6001 37.0476 28.9681C37.2286 29.4051 40.0716 36.0501 46.4686 37.1441C46.4666 37.181 46.4578 37.2173 46.4426 37.2511C46.3346 37.5161 45.6426 38.4311 41.3566 39.1181C40.6856 39.2251 40.5206 40.0051 40.3306 40.9131C40.2616 41.2381 40.1916 41.5661 40.0956 41.9051C40.0666 42.0051 40.0606 42.0131 39.9546 42.0131H39.9046C39.6305 42.0013 39.3581 41.9648 39.0906 41.9041C38.267 41.7261 37.4272 41.6343 36.5846 41.6301C35.9745 41.6314 35.3656 41.6849 34.7646 41.7901C33.4671 42.1207 32.265 42.7505 31.2546 43.6291C29.7366 44.7421 28.1676 45.8941 25.7736 45.8941C25.6736 45.8941 25.5666 45.8941 25.4646 45.8851H25.4376H25.4106C25.3516 45.8901 25.2926 45.8931 25.2326 45.8931C22.8396 45.8931 21.2696 44.7421 19.7526 43.6281C18.7418 42.7495 17.5394 42.1197 16.2416 41.7891C15.6406 41.6841 15.0317 41.6305 14.4216 41.6291C13.5783 41.6375 12.7383 41.7354 11.9156 41.9211C11.6482 41.9856 11.376 42.0277 11.1016 42.0471C10.9466 42.0471 10.9436 42.0381 10.9106 41.9211C10.8106 41.5821 10.7436 41.2461 10.6756 40.9211C10.4846 40.0131 10.3196 39.2281 9.64961 39.1211C5.36161 38.4341 4.67161 37.5211 4.56261 37.2521C4.5479 37.2174 4.53911 37.1806 4.53661 37.1431C10.9366 36.0501 13.7766 29.4051 13.9576 28.9661C14.1679 28.5983 14.2974 28.1899 14.3374 27.7681C14.3774 27.3463 14.327 26.9208 14.1896 26.5201C13.6836 25.2821 12.1786 24.7871 11.1836 24.4591C10.9546 24.3841 10.7576 24.3191 10.6076 24.2591C9.31561 23.7291 8.91761 23.1951 8.97661 22.8721C9.04561 22.4991 9.66862 22.1201 10.2126 22.1201C10.3187 22.1167 10.4242 22.1369 10.5216 22.1791C11.263 22.5718 12.0832 22.7929 12.9216 22.8261C13.2249 22.8478 13.5294 22.8056 13.8153 22.7023C14.1013 22.5989 14.3623 22.4367 14.5816 22.2261L14.7026 22.0861L14.6926 21.8991C14.6706 21.4611 14.6426 20.9991 14.6136 20.5311C14.4326 17.5491 14.2076 13.8411 15.0876 11.7921C15.8913 9.80808 17.2722 8.11108 19.0514 6.92081C20.8305 5.73054 22.9261 5.10182 25.0666 5.11607L25.8326 5.10806H25.9326L25.9206 5.11106ZM25.9326 4.03906H25.8086L25.0526 4.04707C23.3173 4.05612 21.6033 4.43093 20.0226 5.14706C18.8325 5.68951 17.7467 6.43649 16.8146 7.35406C15.6696 8.50063 14.759 9.85927 14.1336 11.3541C13.1506 13.6411 13.3836 17.4941 13.5716 20.5911C13.5916 20.9231 13.6126 21.2691 13.6316 21.6061C13.4041 21.7063 13.1571 21.7545 12.9086 21.7471C12.2229 21.7123 11.5535 21.5259 10.9486 21.2011C10.7153 21.0919 10.4602 21.0372 10.2026 21.0411C9.73671 21.0471 9.28118 21.1795 8.88461 21.4241C8.65078 21.5528 8.44695 21.7297 8.28662 21.9432C8.1263 22.1566 8.01313 22.4016 7.95461 22.6621C7.91068 22.9611 7.9453 23.2663 8.05505 23.5479C8.16481 23.8295 8.34593 24.0777 8.58061 24.2681C9.06347 24.6893 9.61836 25.0199 10.2186 25.2441C10.4056 25.3201 10.6266 25.3931 10.8616 25.4701C11.6766 25.7391 12.9096 26.1441 13.2306 26.9301C13.3048 27.1896 13.3247 27.4617 13.2889 27.7293C13.2531 27.9968 13.1624 28.2541 13.0226 28.4851C13.0146 28.5021 13.0066 28.5191 12.9996 28.5371C12.4304 29.8229 11.6853 31.0234 10.7856 32.1041C10.0176 33.047 9.1173 33.8739 8.11261 34.5591C6.98334 35.3266 5.70367 35.8451 4.35861 36.0801C4.10335 36.1282 3.8746 36.2683 3.71573 36.4738C3.55686 36.6793 3.4789 36.9359 3.49661 37.1951C3.506 37.3552 3.54182 37.5126 3.60262 37.6611C3.9191 38.2708 4.44921 38.7426 5.09161 38.9861C6.46577 39.567 7.91222 39.9592 9.3916 40.1521C9.50871 40.4715 9.59673 40.8008 9.6546 41.1361C9.7266 41.4801 9.80161 41.8361 9.90761 42.2091C9.96514 42.4744 10.1158 42.7104 10.3322 42.8744C10.5486 43.0384 10.8166 43.1195 11.0876 43.1031C11.4284 43.086 11.7669 43.0371 12.0986 42.9571C12.8562 42.7849 13.6298 42.6934 14.4066 42.6841C14.9601 42.6855 15.5124 42.734 16.0576 42.8291C17.1982 43.1386 18.2528 43.705 19.1406 44.4851C20.7146 45.6391 22.4956 46.9461 25.2176 46.9461C25.2916 46.9461 25.3666 46.9461 25.4396 46.9381C25.5296 46.9381 25.6396 46.9461 25.7586 46.9461C28.4816 46.9461 30.2586 45.6391 31.8346 44.4861C32.7269 43.7103 33.7849 43.1489 34.9276 42.8451C35.4728 42.7501 36.0252 42.7015 36.5786 42.7001C37.3547 42.704 38.1283 42.7891 38.8866 42.9541C39.219 43.0296 39.5579 43.0728 39.8986 43.0831H39.9496C40.2108 43.0915 40.4667 43.0084 40.6731 42.8481C40.8795 42.6877 41.0233 42.4603 41.0796 42.2051C41.1796 41.8371 41.2586 41.4921 41.3326 41.1421C41.3909 40.8083 41.4785 40.4804 41.5946 40.1621C43.0739 39.9692 44.5203 39.5773 45.8946 38.9971C46.5356 38.7538 47.0651 38.2837 47.3826 37.6761C47.4458 37.5265 47.4827 37.3672 47.4916 37.2051C47.5093 36.9459 47.4314 36.6893 47.2725 36.4838C47.1136 36.2783 46.8849 36.1382 46.6296 36.0901C40.7486 35.0841 38.0986 28.8141 37.9886 28.5471C37.9816 28.5291 37.9736 28.5121 37.9656 28.4951C37.8259 28.2641 37.7355 28.0067 37.6998 27.7392C37.6642 27.4716 37.6842 27.1995 37.7586 26.9401C38.0796 26.1561 39.3116 25.7501 40.1266 25.4811C40.3626 25.4041 40.5846 25.3311 40.7706 25.2551C41.4263 25.0198 42.0245 24.6479 42.5256 24.1641C42.6927 24.0015 42.8259 23.8074 42.9176 23.593C43.0092 23.3786 43.0575 23.1482 43.0596 22.9151C43.0243 22.522 42.8703 22.1489 42.6182 21.8453C42.366 21.5417 42.0275 21.3219 41.6476 21.2151C41.3443 21.088 41.0185 21.0233 40.6896 21.0251C40.3827 21.0211 40.0787 21.0853 39.7996 21.2131C39.2301 21.5134 38.6068 21.698 37.9656 21.7561C37.7562 21.75 37.55 21.7031 37.3586 21.6181C37.3746 21.3321 37.3926 21.0391 37.4106 20.7321L37.4186 20.6011C37.6066 17.5011 37.8416 13.6471 36.8576 11.3581C36.2299 9.85942 35.3158 8.49764 34.1666 7.34906C33.2307 6.43039 32.1408 5.68306 30.9466 5.14106C29.3659 4.42697 27.6531 4.05224 25.9186 4.04106" fill="#020202"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Snapchat')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M25.5062 0.671875C22.246 0.671875 19.0177 1.31402 16.0057 2.56164C12.9936 3.80927 10.2569 5.63793 7.95155 7.94324C5.64625 10.2485 3.81757 12.9853 2.56995 15.9974C1.32232 19.0094 0.680176 22.2377 0.680176 25.4979C0.680663 30.4921 2.18657 35.3702 5.00136 39.4956C7.81615 43.621 11.8091 46.8021 16.4592 48.6239C16.1307 46.2566 16.1596 43.8535 16.5452 41.4949C16.9962 39.5569 19.4562 29.1549 19.4562 29.1549C18.9507 27.9926 18.6975 26.7363 18.7132 25.4689C18.7132 22.0169 20.7132 19.4399 23.2052 19.4399C25.3232 19.4399 26.3462 21.0299 26.3462 22.9399C26.3462 25.0699 24.9902 28.2549 24.2902 31.2059C24.1505 31.7528 24.1414 32.325 24.2636 32.8761C24.3858 33.4272 24.6359 33.9419 24.9937 34.3785C25.3515 34.8152 25.8069 35.1616 26.3233 35.3897C26.8397 35.6178 27.4024 35.7214 27.9662 35.6919C32.3782 35.6919 35.7662 31.0389 35.7662 24.3239C35.7662 18.3799 31.4952 14.2239 25.3962 14.2239C23.9441 14.1611 22.4943 14.3936 21.1347 14.9072C19.775 15.4208 18.5336 16.2049 17.4857 17.2121C16.4378 18.2193 15.6051 19.4286 15.0379 20.7668C14.4708 22.105 14.181 23.5444 14.1862 24.9979C14.1894 27.0341 14.8362 29.0173 16.0342 30.6639C16.122 30.7575 16.184 30.8724 16.2142 30.9972C16.2443 31.122 16.2416 31.2525 16.2062 31.3759C16.0182 32.1599 15.5992 33.8459 15.5172 34.1909C15.4092 34.6449 15.1572 34.7419 14.6872 34.5229C11.5872 33.0799 9.64818 28.5459 9.64818 24.9049C9.64818 17.0739 15.3382 9.88188 26.0482 9.88188C34.6602 9.88188 41.3482 16.0189 41.3482 24.2199C41.3482 32.7759 35.9532 39.6619 28.4662 39.6619C25.9502 39.6619 23.5852 38.3549 22.7762 36.8109C22.7762 36.8109 21.5312 41.5509 21.2292 42.7109C20.4876 45.0051 19.4502 47.1928 18.1432 49.2189C20.524 49.9549 23.0022 50.3281 25.4942 50.3259C28.7544 50.3259 31.9827 49.6837 34.9947 48.4361C38.0067 47.1885 40.7435 45.3598 43.0488 43.0545C45.3541 40.7492 47.1828 38.0124 48.4304 35.0004C49.678 31.9883 50.3202 28.7601 50.3202 25.4999C50.3207 18.9173 47.707 12.6041 43.0538 7.94819C38.4005 3.29233 32.0887 0.675057 25.5062 0.671875" fill="#E60023"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Pinterest')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                        <div class="col-4 col-md-auto">
                            <button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
                                <span>
                                    <svg width="37" height="51" viewBox="0 0 37 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.8128 16.971L18.1748 27.843L25.0748 31.033L11.0128 39.172V4.016L0.986816 0.5V44.9L11.0128 50.5L36.0128 36.112V24.784L13.8128 16.971Z" fill="#008272"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color connector-primary-name">{{__('Bing Ads')}}</p>
                                @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add connection modal -->
    <div class="modal fade" id="addConnectionsmodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="addConnectionsmodal" tabindex="-1">
        <div class="modal-dialog" style="max-width: 1020px;">
            <div class="modal-content bg-white border-0 custom-modal-content">
                <!-- header -->
                <div class="px-3 px-sm-5 pt-5">
                    <button type="button" data-bs-dismiss="modal" class="border-0 bg-white d-flex flex-row align-items-center position-absolute g-9">
                        <span @if($get_locale=='ar' ) style=" transform: rotateY(180deg);" @endif>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.28033 0.46967C6.57322 0.762563 6.57322 1.23744 6.28033 1.53033L2.56066 5.25H11.25C11.6642 5.25 12 5.58579 12 6C12 6.41421 11.6642 6.75 11.25 6.75H2.56066L6.28033 10.4697C6.57322 10.7626 6.57322 11.2374 6.28033 11.5303C5.98744 11.8232 5.51256 11.8232 5.21967 11.5303L0.21967 6.53033C-0.0732233 6.23744 -0.0732233 5.76256 0.21967 5.46967L5.21967 0.46967C5.51256 0.176777 5.98744 0.176777 6.28033 0.46967Z" fill="#F58B1E" />
                            </svg>
                        </span>
                        <p class="m-0 secondary-text-color popup-back @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back ')}}</p>
                    </button>
                    <div class="text-center d-flex flex-column mt-4 mt-sm-0 g-17 g-6-576">
                        <p class="mt-4 mt-sm-0 m-0 primary-text-color connections-popup-heading  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add New Connection')}}</p>
                    </div>
                </div>
                <!-- body -->
                <form id="connection-account-form" onsubmit="syncConnections(event)" method="POST" >
                    @csrf
                    <input id="connections-account-name" type="hidden" name="account" value="">
                    <div class="px-3 px-sm-5 pt-5 pb-3">
                        <div class="d-flex flex-row align-items-center justify-content-start">
                            <div class="position-relative">
                                <input type="text" id="search_input" class="add-connection-popup-input @if($get_locale=='ar') add-connection-popup-input-ar @endif" placeholder="{{__('Search')}}">
                                <button id="search_connection" type="button" class="border-0 secondary-bg-color position-absolute add-connection-popup-input-btn" style="@if($get_locale=='ar') transform: scaleX(-1); left: auto;right:0 @endif">
                                    <svg style="@if($get_locale=='ar') transform: scaleX(-1); @endif" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.2279 11.0904L12.6754 9.50035C12.3391 9.18669 11.9201 8.97588 11.4679 8.89285C11.0124 8.82009 10.5456 8.88269 10.1254 9.07287L9.45035 8.39785C10.2464 7.33614 10.6108 6.01237 10.4704 4.69285C10.3474 3.54101 9.847 2.46218 9.04704 1.62439C8.24707 0.7866 7.19249 0.236917 6.04756 0.0609416C4.90263 -0.115033 3.73165 0.0925941 2.71702 0.65148C1.70238 1.21037 0.901078 2.08912 0.43792 3.15087C-0.0252375 4.21262 -0.124242 5.39775 0.156332 6.52164C0.436907 7.64552 1.0813 8.64505 1.98914 9.36453C2.89698 10.084 4.01729 10.4831 5.17555 10.4995C6.3338 10.5159 7.46498 10.1488 8.39286 9.45535L9.06036 10.1229C8.848 10.5416 8.77195 11.0162 8.84286 11.4803C8.91297 11.9471 9.12812 12.3801 9.45786 12.7179L11.0479 14.3079C11.3107 14.5718 11.635 14.7664 11.9917 14.8741C12.3483 14.9818 12.7261 14.9992 13.0911 14.9249C13.4562 14.8505 13.7971 14.6867 14.0832 14.4481C14.3693 14.2095 14.5917 13.9036 14.7304 13.5579C14.96 12.998 14.96 12.3702 14.7304 11.8103C14.6118 11.5397 14.441 11.295 14.2279 11.0904ZM7.86785 7.91035C7.34302 8.43447 6.67454 8.79117 5.94697 8.93535C5.21939 9.07953 4.4654 9.00473 3.78036 8.72037C3.26928 8.50731 2.81173 8.1837 2.44056 7.77282C2.0694 7.36193 1.79383 6.87396 1.63364 6.34393C1.47346 5.8139 1.43265 5.25497 1.51412 4.70729C1.5956 4.15961 1.79735 3.63677 2.10488 3.17632C2.41241 2.71587 2.81809 2.32923 3.29279 2.04418C3.76749 1.75913 4.29942 1.58273 4.85038 1.52766C5.40135 1.4726 5.95766 1.54025 6.47938 1.72571C7.0011 1.91118 7.47528 2.20988 7.86785 2.60036C8.21879 2.94668 8.49677 3.35981 8.68536 3.81536C8.97041 4.50208 9.04489 5.25803 8.89933 5.98717C8.75377 6.71632 8.39473 7.38573 7.86785 7.91035ZM13.1704 13.2128C13.0997 13.2838 13.0155 13.3399 12.9229 13.3779C12.8331 13.4175 12.736 13.438 12.6379 13.438C12.5397 13.438 12.4426 13.4175 12.3529 13.3779C12.2602 13.3399 12.176 13.2838 12.1054 13.2128L10.5154 11.6228C10.4452 11.5544 10.3891 11.4728 10.3504 11.3828C10.3126 11.2898 10.2922 11.1907 10.2904 11.0904C10.2915 10.9924 10.3119 10.8955 10.3504 10.8054C10.3881 10.7125 10.444 10.6282 10.5149 10.5573C10.5857 10.4865 10.67 10.4306 10.7629 10.3929C10.8526 10.3532 10.9497 10.3327 11.0479 10.3327C11.146 10.3327 11.2431 10.3532 11.3329 10.3929C11.4255 10.4308 11.5097 10.4869 11.5804 10.5579L13.1704 12.1478C13.2413 12.2185 13.2974 12.3027 13.3354 12.3954C13.3738 12.4855 13.3942 12.5824 13.3954 12.6804C13.3935 12.7807 13.3731 12.8799 13.3354 12.9729C13.2966 13.0629 13.2405 13.1444 13.1704 13.2128Z" fill="white" />
                                    </svg>
                                </button>
                            </div>
                            <button id="connection-popup-addnew" type="button" class="border-0 bg-transparent d-flex flex-row align-items-center mx-3 add-connection-btn">
                                <span>
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <p class="m-0 primary-text-color add-connection-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__(' Add new')}}</p>
                            </button>
                            <div class="d-none d-sm-flex flex-row align-items-center ms-5 add-connection-popup-date direction-ltr-important">
                                <p class="m-0 add-connection-date-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Date')}}</p>
                                <select id="date" name="date" class="add-connection-date-select">
                                    <option value="all" selected>{{__('Any')}}</option>
                                    <option value="week">{{__('Last week')}}</option>
                                    <option value="month">{{__('Last month')}}</option>
                                    <option value="6month">{{__('Last 6 month')}}</option>
                                    <option value="year">{{__('Last year')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex d-sm-none flex-row align-items-center @if($get_locale=='en') justify-content-end ms-5 @else justify-content-start me-5 @endif mt-2 add-connection-popup-date direction-ltr-important">
                            <p class="m-0 add-connection-date-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Date')}}</p>
                            <select id="date" name="date" class="add-connection-date-select">
                                <option value="all" selected>{{__('Any')}}</option>
                                <option value="week">{{__('Last week')}}</option>
                                <option value="month">{{__('Last month')}}</option>
                                <option value="6month">{{__('Last 6 month')}}</option>
                                <option value="year">{{__('Last year')}}</option>
                            </select>
                        </div>
                        <div class="mt-4" style="border-bottom: 1px solid #EAF0F4;">
                            <div class="d-flex flex-row">
                                <div class="connection-account-container">
                                    <p class="account-page-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="@if($get_locale=='ar') font-weight: 600; @endif">{{__('Account')}}</p>
                                </div>
                                <div>
                                    <p class="account-page-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="@if($get_locale=='ar') font-weight: 600; @endif">{{__('Pages')}}</p>
                                </div>
                            </div>
                        </div>
                        <div id="connections-accounts-wrapper" class="mt-2 mb-1">
                            <!-- html appended with ajax response -->
                        </div>
                    </div>
                    <div class="connection-popup-footer">
                        <div class="px-3 px-sm-5">
                            <div id="connection-popup-footer-wrapper" class="d-flex flex-column flex-sm-row justify-content-center justify-content-sm-between align-items-center connection-popup-footer-wrapper">
                                <!-- html appended with ajax response -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--success add connection modal -->
    <div class="modal fade" id="successAddConnectionsmodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="successAddConnectionsmodal" tabindex="-1">
        <div class="modal-dialog" style="max-width: 598px;">
            <div class="modal-content bg-white border-0 custom-modal-content">
                <!-- body -->
                <div class="success-add-connections-container">
                    <div class="d-flex flex-column text-center success-add-connections-wrapper">
                        <span>
                            <svg width="69" height="69" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M61.001 0.396836L62.2457 1.64154C62.7748 2.17065 62.7748 3.02851 62.2457 3.55763C61.7166 4.08675 60.8587 4.08675 60.3296 3.55763L59.0849 2.31293C58.5558 1.78382 58.5558 0.925952 59.0849 0.396837C59.614 -0.132278 60.4719 -0.13228 61.001 0.396836ZM21.2871 5.71354C21.9501 3.82175 21.2438 1.72817 19.5377 0.663358H19.5395C19.0728 0.373283 17.691 -0.293349 15.7271 0.239957C13.7633 0.773262 12.6697 2.83982 12.9202 4.87035C13.1526 6.76935 14.8227 8.4125 16.709 8.59628C18.7719 8.79807 20.6132 7.63957 21.2871 5.71354ZM17.2549 2.68307C18.1017 2.7119 18.8314 3.46501 18.826 4.30281V4.30461C18.8206 5.17303 18.0315 5.93876 17.1721 5.90993C16.3307 5.8811 15.5956 5.12258 15.601 4.28839C15.6064 3.41997 16.3956 2.65424 17.2549 2.68307ZM63.6529 30.2778C65.7843 30.8057 67.9751 29.6292 68.7426 27.5482C68.8165 27.3446 69.1606 26.0221 68.7246 24.5357C68.085 22.8619 66.4239 21.7179 64.6565 21.7359C62.5287 21.7575 60.646 23.4187 60.3901 25.4978C60.1217 27.6851 61.5324 29.7535 63.6529 30.2778ZM63.071 26.0888C63.0602 25.2024 63.7935 24.4871 64.7033 24.4943C65.5861 24.5033 66.2888 25.1915 66.2978 26.06C66.3086 26.9482 65.5771 27.6617 64.6655 27.6545C63.7863 27.6473 63.0818 26.9536 63.071 26.0888ZM30.2734 18.7162C29.8108 20.6908 28.9886 22.5143 27.769 24.2084C27.7145 24.1602 27.6636 24.1163 27.6156 24.0749L27.6156 24.0749C27.5135 23.9868 27.4245 23.9101 27.3421 23.8277C26.848 23.3346 26.3551 22.8403 25.8623 22.346L25.8612 22.3449L25.8601 22.3437L25.8599 22.3435C24.6876 21.1678 23.5154 19.9921 22.3263 18.8333C21.9155 18.4333 21.438 18.046 20.9174 17.8262C19.0725 17.0442 17.2113 18.0352 16.4348 20.1522C15.4009 22.9739 14.3682 25.7961 13.3356 28.6181L13.3343 28.6216L13.333 28.6251C12.1874 31.7559 11.0418 34.8865 9.8948 38.0161C9.06405 40.2829 8.23221 42.5493 7.40038 44.8156L7.39973 44.8174L7.39908 44.8192L7.39842 44.8209L7.39777 44.8227L7.39712 44.8245L7.39647 44.8263L7.39582 44.828L7.39516 44.8298L7.39079 44.8417L7.38921 44.846L7.38918 44.8461C5.02082 51.2987 2.6526 57.7509 0.309963 64.2129C0.0595318 64.9012 -0.0719894 65.7336 0.0649368 66.4362C0.479319 68.5532 2.55123 69.5226 4.73844 68.7208C16.0349 64.5841 27.3295 60.442 38.6241 56.2998C39.6661 55.9176 40.709 55.5378 41.7519 55.1581L41.7523 55.158L41.7526 55.1579L41.753 55.1577L41.7533 55.1576L41.7537 55.1575L41.754 55.1574L41.7543 55.1572L41.7547 55.1571L41.755 55.157L41.7554 55.1569L41.7557 55.1567L41.7561 55.1566L41.7564 55.1565C44.2266 54.2571 46.697 53.3576 49.1548 52.4244C51.5762 51.5055 52.1618 48.7741 50.3925 46.8895C50.1069 46.5858 49.8092 46.2932 49.5115 46.0004C49.3924 45.8832 49.2732 45.766 49.1548 45.6481L44.3858 40.9006C44.433 40.8662 44.4729 40.8374 44.5081 40.812C44.5669 40.7694 44.6127 40.7363 44.6578 40.7024C47.6504 38.4197 51.0267 37.1549 54.7796 36.9297C58.1685 36.7261 61.3754 37.4251 64.4076 38.9656C64.7211 39.1259 65.1481 39.1854 65.494 39.1259C66.0778 39.0251 66.4183 38.5926 66.4832 37.9945C66.5606 37.2666 66.1715 36.827 65.5499 36.5171C59.9702 33.7388 54.2517 33.4199 48.3981 35.5406C46.2343 36.3243 44.2795 37.4954 42.5535 38.8809L40.4041 36.7315C40.4374 36.6956 40.4733 36.6559 40.5114 36.6139L40.5115 36.6138L40.5115 36.6138L40.5115 36.6137L40.5119 36.6133L40.512 36.6132L40.5121 36.613L40.5122 36.613C40.6037 36.512 40.7075 36.3974 40.8167 36.2883C41.1986 35.9049 41.5816 35.5225 41.9648 35.14L41.9649 35.1399L41.9649 35.1398L41.965 35.1397L41.9651 35.1396L41.9652 35.1396L41.9653 35.1395L41.9653 35.1394L41.9654 35.1393L41.9655 35.1392L41.9656 35.1392L41.9657 35.1391L41.9719 35.1328L41.9741 35.1307L41.975 35.1298C42.5267 34.579 43.0785 34.0281 43.6273 33.474C44.348 32.7461 44.4254 31.9245 43.8471 31.339C43.2471 30.7318 42.4562 30.8003 41.7175 31.5318L41.5155 31.7315L41.5154 31.7315L41.5154 31.7316L41.5153 31.7316L41.5152 31.7317L41.5152 31.7317L41.5151 31.7318L41.5151 31.7319L41.515 31.7319L41.515 31.732L41.5149 31.732L41.5148 31.7321L41.5148 31.7321L41.5147 31.7322C40.9426 32.2976 40.3705 32.8629 39.8114 33.4398C39.4881 33.7718 39.1754 34.1151 38.8567 34.4649C38.7171 34.6182 38.5763 34.7727 38.4331 34.928C35.5631 32.0578 32.8155 29.3102 30.068 26.5608C29.9936 26.4865 29.9234 26.408 29.8495 26.3254L29.8494 26.3253C29.8141 26.2859 29.7779 26.2455 29.7401 26.2041C29.7614 26.1686 29.7811 26.1343 29.8003 26.101L29.8003 26.1009C29.8395 26.0329 29.8761 25.9691 29.9185 25.9086C32.9488 21.5485 34.0154 16.7505 33.12 11.5202C32.7921 9.60497 32.1489 7.79065 31.2156 6.08624C30.8391 5.39798 30.0842 5.18358 29.4248 5.5169C28.7546 5.85562 28.5078 6.55468 28.8068 7.29158C28.8855 7.48753 28.9774 7.67819 29.069 7.86809L29.1149 7.96361C30.7634 11.4121 31.1454 15.0029 30.2734 18.7162ZM37.1683 53.9216C37.1097 53.8589 37.0561 53.801 37.0057 53.7467L37.0055 53.7465C36.8779 53.6089 36.7719 53.4945 36.6621 53.3847L30.7977 47.5201L30.7591 47.4817L30.7187 47.4416C30.5691 47.2934 30.4191 47.1447 30.295 46.9778C29.8914 46.4355 29.9437 45.7346 30.4031 45.2536C30.8697 44.7635 31.6282 44.6914 32.1813 45.1022C32.3393 45.2196 32.4798 45.3627 32.6197 45.5052L32.6387 45.5244C32.6663 45.5526 32.694 45.5807 32.7218 45.6085L33.8665 46.752L33.869 46.7544L33.8691 46.7546L33.8693 46.7547L33.8694 46.7549L33.8696 46.755L33.8697 46.7552L33.8699 46.7553L33.87 46.7555L33.8701 46.7556L33.8703 46.7558L33.8704 46.7559L33.8706 46.7561L33.8707 46.7562C35.7779 48.6612 37.6846 50.5657 39.5826 52.4802C39.8654 52.7649 40.0888 52.882 40.5086 52.7234C42.087 52.1278 43.6713 51.5485 45.2554 50.9693L45.2584 50.9682C46.136 50.6473 47.0136 50.3265 47.89 50.0029C48.8467 49.6497 48.926 49.2822 48.2125 48.5687L38.9601 39.3156C32.7788 33.1338 26.5976 26.952 20.4147 20.7702C19.6994 20.0549 19.3301 20.136 18.9806 21.0873C18.7059 21.8354 18.4329 22.5841 18.1598 23.3328L18.1598 23.3328L18.1598 23.3328L18.1598 23.3328L18.1597 23.3328L18.1597 23.3329L18.1597 23.3329L18.1597 23.3329L18.1597 23.3329L18.1597 23.333L18.1597 23.333L18.1597 23.333L18.1597 23.333L18.1597 23.3331C17.5496 25.0056 16.9396 26.6781 16.3123 28.3445C16.1394 28.8058 16.179 29.0904 16.5447 29.449C18.7966 31.6625 21.023 33.903 23.2487 36.1428L23.4631 36.3585C23.6955 36.5928 23.9333 36.8594 24.0595 37.1567C24.3063 37.7332 24.0432 38.4161 23.5208 38.7476C22.955 39.1061 22.3118 39.0251 21.7515 38.4683C19.7102 36.4414 17.6762 34.4055 15.6493 32.3641C15.5342 32.2491 15.4533 32.0999 15.3725 31.9512C15.3344 31.8809 15.2963 31.8108 15.2547 31.7444C14.7966 32.6415 14.4749 33.4618 14.1643 34.2539L14.1643 34.254L14.1643 34.254L14.1642 34.2541L14.1642 34.2541L14.1642 34.2542C14.0632 34.5118 13.9633 34.7665 13.8603 35.0199C13.6873 35.4451 13.7864 35.6937 14.0981 36.0036C16.2975 38.1844 18.4871 40.3752 20.6763 42.5655L20.6764 42.5656L20.6765 42.5657L20.6765 42.5657L20.6766 42.5658L20.6767 42.5659L20.6767 42.5659L20.6768 42.566L20.6872 42.5764C21.4496 43.3392 22.2121 44.1021 22.9749 44.8644C23.6427 45.5319 24.3104 46.1994 24.978 46.867L24.9791 46.868L24.9813 46.8702C27.6502 49.5387 30.3189 52.2068 32.9957 54.8693C33.1632 55.0368 33.4731 55.2548 33.6353 55.2026C34.5216 54.9122 35.3965 54.5853 36.3012 54.2472L36.3014 54.2472C36.5864 54.1407 36.8744 54.0331 37.1665 53.9252L37.1683 53.9216ZM12.6125 38.5557L12.6125 38.5558C12.5776 38.6097 12.5362 38.6737 12.5108 38.7422C12.3578 39.1587 12.2045 39.5751 12.0513 39.9915C11.1765 42.3694 10.3015 44.7476 9.45519 47.1363C9.37952 47.3489 9.50924 47.7453 9.6822 47.9201C11.7364 49.991 13.7971 52.055 15.8577 54.1191C17.5887 55.853 19.3198 57.5869 21.0471 59.3249C21.3552 59.6348 21.6074 59.642 21.9857 59.4997C23.4395 58.9515 24.8983 58.4183 26.3568 57.8852L26.358 57.8848C26.8549 57.7032 27.3517 57.5216 27.8483 57.3394C28.742 57.0115 29.6356 56.6836 30.5184 56.3593C27.5222 53.363 24.5383 50.3785 21.5588 47.3986C18.5883 44.4275 15.6223 41.461 12.6531 38.4917L12.6513 38.4935C12.6407 38.5122 12.6272 38.5331 12.6125 38.5557ZM8.23006 50.4443C8.12003 50.7421 8.00938 51.038 7.89915 51.3327C7.59065 52.1575 7.28549 52.9734 7.00674 53.7991C6.94728 53.9738 7.04277 54.2891 7.17969 54.4279C9.62635 56.9016 12.0874 59.3591 14.5539 61.8131C14.6656 61.9248 14.8836 62.0617 14.9971 62.0239C15.9348 61.7066 16.8657 61.3679 17.7943 61.0301L17.7944 61.03L17.7945 61.03L17.7947 61.0299L17.7976 61.0289C18.0437 60.9393 18.2897 60.8499 18.5356 60.7609L15.1355 57.3575L15.124 57.3461C12.8271 55.0471 10.5419 52.7598 8.23006 50.4443ZM5.1073 58.9446C5.33471 58.3234 5.56189 57.7029 5.78833 57.0831L11.8928 63.1878C11.5917 63.2995 11.2868 63.413 10.9792 63.5275L10.9782 63.5279L10.9768 63.5284C10.3081 63.7774 9.62664 64.0311 8.94352 64.2814C8.60229 64.4061 8.26119 64.531 7.9201 64.656L7.91917 64.6564C6.49566 65.178 5.07224 65.6996 3.63943 66.1966C3.41062 66.2759 3.04128 66.2381 2.86472 66.0957C2.72599 65.9858 2.69176 65.5966 2.76743 65.3876C3.53667 63.2348 4.32322 61.0863 5.10696 58.9455L5.10713 58.9451L5.10716 58.945L5.10719 58.9449L5.10721 58.9448L5.1073 58.9446ZM42.429 22.8968C44.8216 22.904 46.7494 20.9816 46.753 18.5871C46.7566 16.171 44.8703 14.2702 42.4615 14.263C40.058 14.2558 38.1285 16.1656 38.1231 18.5547C38.1177 20.9366 40.0562 22.8914 42.429 22.8968ZM42.4867 16.9674C43.3407 16.9908 44.0559 17.7259 44.0523 18.5763C44.0487 19.4267 43.3263 20.1618 42.4741 20.1798C41.6057 20.1979 40.8346 19.4375 40.8364 18.5637C40.84 17.6899 41.6093 16.944 42.4867 16.9674ZM52.8316 23.4551C51.9001 23.4822 51.2858 23.0029 51.2245 22.2048C51.1669 21.4426 51.7704 20.8355 52.664 20.7562C53.8801 20.6499 54.6711 19.9058 54.7576 18.632C54.8548 17.205 55.2945 15.9654 56.3556 14.9763C57.2475 14.1457 58.3104 13.7277 59.5139 13.6593C60.3175 13.6142 60.9607 14.1385 61.0327 14.8682C61.1066 15.6303 60.631 16.2195 59.813 16.3744C58.0348 16.7095 57.6817 17.0951 57.4979 18.913C57.2402 21.4607 55.2602 23.3885 52.8298 23.4569L52.8316 23.4551ZM44.1871 7.36599C46.7346 7.17681 48.7164 5.21475 48.7633 2.83469C48.7813 1.94465 48.3237 1.34108 47.5562 1.24378C46.8932 1.1591 46.2103 1.67619 46.086 2.35544C45.7581 4.15534 45.4086 4.48506 43.6195 4.66883C41.1963 4.91927 39.4397 6.72458 39.2811 9.12626C39.2217 10.0235 39.7225 10.6829 40.5189 10.7514C41.2702 10.8163 41.8827 10.2577 41.9962 9.40372C42.1818 8.0128 42.7637 7.47229 44.1871 7.36599ZM27.0632 40.5568C27.8451 40.546 28.4234 41.1117 28.4234 41.8901C28.4234 42.6594 27.8271 43.263 27.074 43.254C26.3713 43.2468 25.7516 42.6378 25.7264 41.9315C25.7011 41.1856 26.3029 40.5658 27.0632 40.555V40.5568ZM68.5894 7.98705L67.3447 6.74236C66.8157 6.21324 65.9578 6.21324 65.4287 6.74235C64.8996 7.27147 64.8996 8.12934 65.4287 8.65845L66.6734 9.90315C67.2025 10.4323 68.0603 10.4323 68.5894 9.90315C69.1185 9.37403 69.1185 8.51617 68.5894 7.98705ZM59.084 7.9866L60.3287 6.7419C60.8578 6.21279 61.7156 6.21279 62.2447 6.7419C62.7738 7.27102 62.7738 8.12888 62.2447 8.658L61 9.9027C60.4709 10.4318 59.6131 10.4318 59.084 9.9027C58.5549 9.37358 58.5549 8.51572 59.084 7.9866ZM46.8199 26.4802L45.5752 27.7249C45.0461 28.254 45.0461 29.1119 45.5752 29.641C46.1043 30.1701 46.9622 30.1701 47.4913 29.641L48.7359 28.3963C49.265 27.8672 49.265 27.0093 48.7359 26.4802C48.2068 25.9511 47.349 25.9511 46.8199 26.4802ZM65.4268 1.64187L66.6714 0.397176C67.2005 -0.13194 68.0584 -0.131938 68.5875 0.397177C69.1166 0.926292 69.1166 1.78416 68.5875 2.31327L67.3428 3.55797C66.8137 4.08708 65.9559 4.08709 65.4268 3.55797C64.8977 3.02885 64.8977 2.17099 65.4268 1.64187ZM62.2574 48.6249L61.0127 47.3802C60.4836 46.8511 59.6258 46.8511 59.0967 47.3802C58.5676 47.9093 58.5676 48.7672 59.0967 49.2963L60.3413 50.541C60.8704 51.0701 61.7283 51.0701 62.2574 50.541C62.7865 50.0119 62.7865 49.154 62.2574 48.6249ZM67.3594 53.724L68.6041 54.9687C69.1332 55.4978 69.1332 56.3557 68.6041 56.8848C68.075 57.4139 67.2171 57.4139 66.688 56.8848L65.4434 55.6401C64.9143 55.111 64.9143 54.2531 65.4434 53.724C65.9725 53.1949 66.8303 53.1949 67.3594 53.724ZM60.3404 53.7243L59.0957 54.969C58.5666 55.4981 58.5666 56.356 59.0957 56.8851C59.6248 57.4142 60.4827 57.4142 61.0118 56.8851L62.2564 55.6404C62.7855 55.1113 62.7855 54.2534 62.2564 53.7243C61.7273 53.1952 60.8695 53.1952 60.3404 53.7243ZM65.4424 48.6243L66.6871 47.3796C67.2162 46.8505 68.074 46.8505 68.6031 47.3796C69.1322 47.9087 69.1322 48.7666 68.6031 49.2957L67.3584 50.5404C66.8293 51.0695 65.9715 51.0695 65.4424 50.5404C64.9133 50.0113 64.9133 49.1534 65.4424 48.6243Z" fill="url(#paint0_linear_4418_8455)"/>
                            <defs>
                            <linearGradient id="paint0_linear_4418_8455" x1="68.9999" y1="13.0009" x2="0.00189823" y2="69.0027" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F2C5A7"/>
                            <stop offset="1" stop-color="#F58B1E"/>
                            </linearGradient>
                            </defs>
                            </svg>
                        </span>
                        <div class="d-flex flex-column" style="gap: 13px;">
                            <p class="m-0 connection-success-popup-primary-text  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Amazing!')}}</p>
                            <div>
                                <p class="m-0 connection-success-popup-secondary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('You just established a connection.')}}</p>
                                @if($get_locale=='en')
                                <p class="m-0 connection-success-popup-secondary-text">{{__('Now you can choose a report.')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center connection-success-popup-footer">
                    <button id="success_choose_report_btn" type="button" class="border-0 secondary-bg-color connection-success-popup-footer-btn">
                        <span class="connection-success-popup-footer-btn-text text-white @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Choose your Report')}}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--add reports modal -->
    <div class="modal fade" id="addReportsmodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="addReportsmodal" tabindex="-1">
        <div class="modal-dialog" style="max-width: 1020px;">
            <div class="modal-content bg-white border-0 custom-modal-content">
                <!-- header -->
                <div class="px-3 px-sm-5 py-5">
                    <button type="button" data-bs-dismiss="modal" class="border-0 bg-white d-flex flex-row align-items-center position-absolute g-9">
                        <span @if($get_locale=='ar' ) style=" transform: rotateY(180deg);" @endif>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.28033 0.46967C6.57322 0.762563 6.57322 1.23744 6.28033 1.53033L2.56066 5.25H11.25C11.6642 5.25 12 5.58579 12 6C12 6.41421 11.6642 6.75 11.25 6.75H2.56066L6.28033 10.4697C6.57322 10.7626 6.57322 11.2374 6.28033 11.5303C5.98744 11.8232 5.51256 11.8232 5.21967 11.5303L0.21967 6.53033C-0.0732233 6.23744 -0.0732233 5.76256 0.21967 5.46967L5.21967 0.46967C5.51256 0.176777 5.98744 0.176777 6.28033 0.46967Z" fill="#F58B1E" />
                            </svg>
                        </span>
                        <p class="m-0 secondary-text-color popup-back @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back ')}}</p>
                    </button>
                    <div class="text-center d-flex flex-column mt-4 mt-sm-0 g-17 g-6-576">
                        <p class="m-0 primary-text-color connections-popup-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Report')}}</p>
                    </div>
                </div>
                <!-- body -->
                <div id="connections-report-popup-body">
                    <!-- html with ajax response -->
                </div>
            </div>
        </div>
    </div>
    <!--success add report modal -->
    <div class="modal fade" id="successAddReportsmodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="successAddReportsmodal" tabindex="-1">
        <div class="modal-dialog" style="max-width: 598px;">
            <div class="modal-content bg-white border-0 custom-modal-content">
                <!-- body -->
                <div class="success-add-connections-container">
                    <div class="d-flex flex-column text-center success-add-connections-wrapper">
                        <span>
                            <svg width="69" height="69" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M61.001 0.396836L62.2457 1.64154C62.7748 2.17065 62.7748 3.02851 62.2457 3.55763C61.7166 4.08675 60.8587 4.08675 60.3296 3.55763L59.0849 2.31293C58.5558 1.78382 58.5558 0.925952 59.0849 0.396837C59.614 -0.132278 60.4719 -0.13228 61.001 0.396836ZM21.2871 5.71354C21.9501 3.82175 21.2438 1.72817 19.5377 0.663358H19.5395C19.0728 0.373283 17.691 -0.293349 15.7271 0.239957C13.7633 0.773262 12.6697 2.83982 12.9202 4.87035C13.1526 6.76935 14.8227 8.4125 16.709 8.59628C18.7719 8.79807 20.6132 7.63957 21.2871 5.71354ZM17.2549 2.68307C18.1017 2.7119 18.8314 3.46501 18.826 4.30281V4.30461C18.8206 5.17303 18.0315 5.93876 17.1721 5.90993C16.3307 5.8811 15.5956 5.12258 15.601 4.28839C15.6064 3.41997 16.3956 2.65424 17.2549 2.68307ZM63.6529 30.2778C65.7843 30.8057 67.9751 29.6292 68.7426 27.5482C68.8165 27.3446 69.1606 26.0221 68.7246 24.5357C68.085 22.8619 66.4239 21.7179 64.6565 21.7359C62.5287 21.7575 60.646 23.4187 60.3901 25.4978C60.1217 27.6851 61.5324 29.7535 63.6529 30.2778ZM63.071 26.0888C63.0602 25.2024 63.7935 24.4871 64.7033 24.4943C65.5861 24.5033 66.2888 25.1915 66.2978 26.06C66.3086 26.9482 65.5771 27.6617 64.6655 27.6545C63.7863 27.6473 63.0818 26.9536 63.071 26.0888ZM30.2734 18.7162C29.8108 20.6908 28.9886 22.5143 27.769 24.2084C27.7145 24.1602 27.6636 24.1163 27.6156 24.0749L27.6156 24.0749C27.5135 23.9868 27.4245 23.9101 27.3421 23.8277C26.848 23.3346 26.3551 22.8403 25.8623 22.346L25.8612 22.3449L25.8601 22.3437L25.8599 22.3435C24.6876 21.1678 23.5154 19.9921 22.3263 18.8333C21.9155 18.4333 21.438 18.046 20.9174 17.8262C19.0725 17.0442 17.2113 18.0352 16.4348 20.1522C15.4009 22.9739 14.3682 25.7961 13.3356 28.6181L13.3343 28.6216L13.333 28.6251C12.1874 31.7559 11.0418 34.8865 9.8948 38.0161C9.06405 40.2829 8.23221 42.5493 7.40038 44.8156L7.39973 44.8174L7.39908 44.8192L7.39842 44.8209L7.39777 44.8227L7.39712 44.8245L7.39647 44.8263L7.39582 44.828L7.39516 44.8298L7.39079 44.8417L7.38921 44.846L7.38918 44.8461C5.02082 51.2987 2.6526 57.7509 0.309963 64.2129C0.0595318 64.9012 -0.0719894 65.7336 0.0649368 66.4362C0.479319 68.5532 2.55123 69.5226 4.73844 68.7208C16.0349 64.5841 27.3295 60.442 38.6241 56.2998C39.6661 55.9176 40.709 55.5378 41.7519 55.1581L41.7523 55.158L41.7526 55.1579L41.753 55.1577L41.7533 55.1576L41.7537 55.1575L41.754 55.1574L41.7543 55.1572L41.7547 55.1571L41.755 55.157L41.7554 55.1569L41.7557 55.1567L41.7561 55.1566L41.7564 55.1565C44.2266 54.2571 46.697 53.3576 49.1548 52.4244C51.5762 51.5055 52.1618 48.7741 50.3925 46.8895C50.1069 46.5858 49.8092 46.2932 49.5115 46.0004C49.3924 45.8832 49.2732 45.766 49.1548 45.6481L44.3858 40.9006C44.433 40.8662 44.4729 40.8374 44.5081 40.812C44.5669 40.7694 44.6127 40.7363 44.6578 40.7024C47.6504 38.4197 51.0267 37.1549 54.7796 36.9297C58.1685 36.7261 61.3754 37.4251 64.4076 38.9656C64.7211 39.1259 65.1481 39.1854 65.494 39.1259C66.0778 39.0251 66.4183 38.5926 66.4832 37.9945C66.5606 37.2666 66.1715 36.827 65.5499 36.5171C59.9702 33.7388 54.2517 33.4199 48.3981 35.5406C46.2343 36.3243 44.2795 37.4954 42.5535 38.8809L40.4041 36.7315C40.4374 36.6956 40.4733 36.6559 40.5114 36.6139L40.5115 36.6138L40.5115 36.6138L40.5115 36.6137L40.5119 36.6133L40.512 36.6132L40.5121 36.613L40.5122 36.613C40.6037 36.512 40.7075 36.3974 40.8167 36.2883C41.1986 35.9049 41.5816 35.5225 41.9648 35.14L41.9649 35.1399L41.9649 35.1398L41.965 35.1397L41.9651 35.1396L41.9652 35.1396L41.9653 35.1395L41.9653 35.1394L41.9654 35.1393L41.9655 35.1392L41.9656 35.1392L41.9657 35.1391L41.9719 35.1328L41.9741 35.1307L41.975 35.1298C42.5267 34.579 43.0785 34.0281 43.6273 33.474C44.348 32.7461 44.4254 31.9245 43.8471 31.339C43.2471 30.7318 42.4562 30.8003 41.7175 31.5318L41.5155 31.7315L41.5154 31.7315L41.5154 31.7316L41.5153 31.7316L41.5152 31.7317L41.5152 31.7317L41.5151 31.7318L41.5151 31.7319L41.515 31.7319L41.515 31.732L41.5149 31.732L41.5148 31.7321L41.5148 31.7321L41.5147 31.7322C40.9426 32.2976 40.3705 32.8629 39.8114 33.4398C39.4881 33.7718 39.1754 34.1151 38.8567 34.4649C38.7171 34.6182 38.5763 34.7727 38.4331 34.928C35.5631 32.0578 32.8155 29.3102 30.068 26.5608C29.9936 26.4865 29.9234 26.408 29.8495 26.3254L29.8494 26.3253C29.8141 26.2859 29.7779 26.2455 29.7401 26.2041C29.7614 26.1686 29.7811 26.1343 29.8003 26.101L29.8003 26.1009C29.8395 26.0329 29.8761 25.9691 29.9185 25.9086C32.9488 21.5485 34.0154 16.7505 33.12 11.5202C32.7921 9.60497 32.1489 7.79065 31.2156 6.08624C30.8391 5.39798 30.0842 5.18358 29.4248 5.5169C28.7546 5.85562 28.5078 6.55468 28.8068 7.29158C28.8855 7.48753 28.9774 7.67819 29.069 7.86809L29.1149 7.96361C30.7634 11.4121 31.1454 15.0029 30.2734 18.7162ZM37.1683 53.9216C37.1097 53.8589 37.0561 53.801 37.0057 53.7467L37.0055 53.7465C36.8779 53.6089 36.7719 53.4945 36.6621 53.3847L30.7977 47.5201L30.7591 47.4817L30.7187 47.4416C30.5691 47.2934 30.4191 47.1447 30.295 46.9778C29.8914 46.4355 29.9437 45.7346 30.4031 45.2536C30.8697 44.7635 31.6282 44.6914 32.1813 45.1022C32.3393 45.2196 32.4798 45.3627 32.6197 45.5052L32.6387 45.5244C32.6663 45.5526 32.694 45.5807 32.7218 45.6085L33.8665 46.752L33.869 46.7544L33.8691 46.7546L33.8693 46.7547L33.8694 46.7549L33.8696 46.755L33.8697 46.7552L33.8699 46.7553L33.87 46.7555L33.8701 46.7556L33.8703 46.7558L33.8704 46.7559L33.8706 46.7561L33.8707 46.7562C35.7779 48.6612 37.6846 50.5657 39.5826 52.4802C39.8654 52.7649 40.0888 52.882 40.5086 52.7234C42.087 52.1278 43.6713 51.5485 45.2554 50.9693L45.2584 50.9682C46.136 50.6473 47.0136 50.3265 47.89 50.0029C48.8467 49.6497 48.926 49.2822 48.2125 48.5687L38.9601 39.3156C32.7788 33.1338 26.5976 26.952 20.4147 20.7702C19.6994 20.0549 19.3301 20.136 18.9806 21.0873C18.7059 21.8354 18.4329 22.5841 18.1598 23.3328L18.1598 23.3328L18.1598 23.3328L18.1598 23.3328L18.1597 23.3328L18.1597 23.3329L18.1597 23.3329L18.1597 23.3329L18.1597 23.3329L18.1597 23.333L18.1597 23.333L18.1597 23.333L18.1597 23.333L18.1597 23.3331C17.5496 25.0056 16.9396 26.6781 16.3123 28.3445C16.1394 28.8058 16.179 29.0904 16.5447 29.449C18.7966 31.6625 21.023 33.903 23.2487 36.1428L23.4631 36.3585C23.6955 36.5928 23.9333 36.8594 24.0595 37.1567C24.3063 37.7332 24.0432 38.4161 23.5208 38.7476C22.955 39.1061 22.3118 39.0251 21.7515 38.4683C19.7102 36.4414 17.6762 34.4055 15.6493 32.3641C15.5342 32.2491 15.4533 32.0999 15.3725 31.9512C15.3344 31.8809 15.2963 31.8108 15.2547 31.7444C14.7966 32.6415 14.4749 33.4618 14.1643 34.2539L14.1643 34.254L14.1643 34.254L14.1642 34.2541L14.1642 34.2541L14.1642 34.2542C14.0632 34.5118 13.9633 34.7665 13.8603 35.0199C13.6873 35.4451 13.7864 35.6937 14.0981 36.0036C16.2975 38.1844 18.4871 40.3752 20.6763 42.5655L20.6764 42.5656L20.6765 42.5657L20.6765 42.5657L20.6766 42.5658L20.6767 42.5659L20.6767 42.5659L20.6768 42.566L20.6872 42.5764C21.4496 43.3392 22.2121 44.1021 22.9749 44.8644C23.6427 45.5319 24.3104 46.1994 24.978 46.867L24.9791 46.868L24.9813 46.8702C27.6502 49.5387 30.3189 52.2068 32.9957 54.8693C33.1632 55.0368 33.4731 55.2548 33.6353 55.2026C34.5216 54.9122 35.3965 54.5853 36.3012 54.2472L36.3014 54.2472C36.5864 54.1407 36.8744 54.0331 37.1665 53.9252L37.1683 53.9216ZM12.6125 38.5557L12.6125 38.5558C12.5776 38.6097 12.5362 38.6737 12.5108 38.7422C12.3578 39.1587 12.2045 39.5751 12.0513 39.9915C11.1765 42.3694 10.3015 44.7476 9.45519 47.1363C9.37952 47.3489 9.50924 47.7453 9.6822 47.9201C11.7364 49.991 13.7971 52.055 15.8577 54.1191C17.5887 55.853 19.3198 57.5869 21.0471 59.3249C21.3552 59.6348 21.6074 59.642 21.9857 59.4997C23.4395 58.9515 24.8983 58.4183 26.3568 57.8852L26.358 57.8848C26.8549 57.7032 27.3517 57.5216 27.8483 57.3394C28.742 57.0115 29.6356 56.6836 30.5184 56.3593C27.5222 53.363 24.5383 50.3785 21.5588 47.3986C18.5883 44.4275 15.6223 41.461 12.6531 38.4917L12.6513 38.4935C12.6407 38.5122 12.6272 38.5331 12.6125 38.5557ZM8.23006 50.4443C8.12003 50.7421 8.00938 51.038 7.89915 51.3327C7.59065 52.1575 7.28549 52.9734 7.00674 53.7991C6.94728 53.9738 7.04277 54.2891 7.17969 54.4279C9.62635 56.9016 12.0874 59.3591 14.5539 61.8131C14.6656 61.9248 14.8836 62.0617 14.9971 62.0239C15.9348 61.7066 16.8657 61.3679 17.7943 61.0301L17.7944 61.03L17.7945 61.03L17.7947 61.0299L17.7976 61.0289C18.0437 60.9393 18.2897 60.8499 18.5356 60.7609L15.1355 57.3575L15.124 57.3461C12.8271 55.0471 10.5419 52.7598 8.23006 50.4443ZM5.1073 58.9446C5.33471 58.3234 5.56189 57.7029 5.78833 57.0831L11.8928 63.1878C11.5917 63.2995 11.2868 63.413 10.9792 63.5275L10.9782 63.5279L10.9768 63.5284C10.3081 63.7774 9.62664 64.0311 8.94352 64.2814C8.60229 64.4061 8.26119 64.531 7.9201 64.656L7.91917 64.6564C6.49566 65.178 5.07224 65.6996 3.63943 66.1966C3.41062 66.2759 3.04128 66.2381 2.86472 66.0957C2.72599 65.9858 2.69176 65.5966 2.76743 65.3876C3.53667 63.2348 4.32322 61.0863 5.10696 58.9455L5.10713 58.9451L5.10716 58.945L5.10719 58.9449L5.10721 58.9448L5.1073 58.9446ZM42.429 22.8968C44.8216 22.904 46.7494 20.9816 46.753 18.5871C46.7566 16.171 44.8703 14.2702 42.4615 14.263C40.058 14.2558 38.1285 16.1656 38.1231 18.5547C38.1177 20.9366 40.0562 22.8914 42.429 22.8968ZM42.4867 16.9674C43.3407 16.9908 44.0559 17.7259 44.0523 18.5763C44.0487 19.4267 43.3263 20.1618 42.4741 20.1798C41.6057 20.1979 40.8346 19.4375 40.8364 18.5637C40.84 17.6899 41.6093 16.944 42.4867 16.9674ZM52.8316 23.4551C51.9001 23.4822 51.2858 23.0029 51.2245 22.2048C51.1669 21.4426 51.7704 20.8355 52.664 20.7562C53.8801 20.6499 54.6711 19.9058 54.7576 18.632C54.8548 17.205 55.2945 15.9654 56.3556 14.9763C57.2475 14.1457 58.3104 13.7277 59.5139 13.6593C60.3175 13.6142 60.9607 14.1385 61.0327 14.8682C61.1066 15.6303 60.631 16.2195 59.813 16.3744C58.0348 16.7095 57.6817 17.0951 57.4979 18.913C57.2402 21.4607 55.2602 23.3885 52.8298 23.4569L52.8316 23.4551ZM44.1871 7.36599C46.7346 7.17681 48.7164 5.21475 48.7633 2.83469C48.7813 1.94465 48.3237 1.34108 47.5562 1.24378C46.8932 1.1591 46.2103 1.67619 46.086 2.35544C45.7581 4.15534 45.4086 4.48506 43.6195 4.66883C41.1963 4.91927 39.4397 6.72458 39.2811 9.12626C39.2217 10.0235 39.7225 10.6829 40.5189 10.7514C41.2702 10.8163 41.8827 10.2577 41.9962 9.40372C42.1818 8.0128 42.7637 7.47229 44.1871 7.36599ZM27.0632 40.5568C27.8451 40.546 28.4234 41.1117 28.4234 41.8901C28.4234 42.6594 27.8271 43.263 27.074 43.254C26.3713 43.2468 25.7516 42.6378 25.7264 41.9315C25.7011 41.1856 26.3029 40.5658 27.0632 40.555V40.5568ZM68.5894 7.98705L67.3447 6.74236C66.8157 6.21324 65.9578 6.21324 65.4287 6.74235C64.8996 7.27147 64.8996 8.12934 65.4287 8.65845L66.6734 9.90315C67.2025 10.4323 68.0603 10.4323 68.5894 9.90315C69.1185 9.37403 69.1185 8.51617 68.5894 7.98705ZM59.084 7.9866L60.3287 6.7419C60.8578 6.21279 61.7156 6.21279 62.2447 6.7419C62.7738 7.27102 62.7738 8.12888 62.2447 8.658L61 9.9027C60.4709 10.4318 59.6131 10.4318 59.084 9.9027C58.5549 9.37358 58.5549 8.51572 59.084 7.9866ZM46.8199 26.4802L45.5752 27.7249C45.0461 28.254 45.0461 29.1119 45.5752 29.641C46.1043 30.1701 46.9622 30.1701 47.4913 29.641L48.7359 28.3963C49.265 27.8672 49.265 27.0093 48.7359 26.4802C48.2068 25.9511 47.349 25.9511 46.8199 26.4802ZM65.4268 1.64187L66.6714 0.397176C67.2005 -0.13194 68.0584 -0.131938 68.5875 0.397177C69.1166 0.926292 69.1166 1.78416 68.5875 2.31327L67.3428 3.55797C66.8137 4.08708 65.9559 4.08709 65.4268 3.55797C64.8977 3.02885 64.8977 2.17099 65.4268 1.64187ZM62.2574 48.6249L61.0127 47.3802C60.4836 46.8511 59.6258 46.8511 59.0967 47.3802C58.5676 47.9093 58.5676 48.7672 59.0967 49.2963L60.3413 50.541C60.8704 51.0701 61.7283 51.0701 62.2574 50.541C62.7865 50.0119 62.7865 49.154 62.2574 48.6249ZM67.3594 53.724L68.6041 54.9687C69.1332 55.4978 69.1332 56.3557 68.6041 56.8848C68.075 57.4139 67.2171 57.4139 66.688 56.8848L65.4434 55.6401C64.9143 55.111 64.9143 54.2531 65.4434 53.724C65.9725 53.1949 66.8303 53.1949 67.3594 53.724ZM60.3404 53.7243L59.0957 54.969C58.5666 55.4981 58.5666 56.356 59.0957 56.8851C59.6248 57.4142 60.4827 57.4142 61.0118 56.8851L62.2564 55.6404C62.7855 55.1113 62.7855 54.2534 62.2564 53.7243C61.7273 53.1952 60.8695 53.1952 60.3404 53.7243ZM65.4424 48.6243L66.6871 47.3796C67.2162 46.8505 68.074 46.8505 68.6031 47.3796C69.1322 47.9087 69.1322 48.7666 68.6031 49.2957L67.3584 50.5404C66.8293 51.0695 65.9715 51.0695 65.4424 50.5404C64.9133 50.0113 64.9133 49.1534 65.4424 48.6243Z" fill="url(#paint0_linear_4444_2510)"/>
                            <defs>
                            <linearGradient id="paint0_linear_4444_2510" x1="68.9999" y1="13.0009" x2="0.00189823" y2="69.0027" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F2C5A7"/>
                            <stop offset="1" stop-color="#F58B1E"/>
                            </linearGradient>
                            </defs>
                            </svg>
                        </span>
                        <div class="d-flex flex-column" style="gap: 13px;">
                            <p class="m-0 report-success-popup-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Well done!')}}</p>
                            <div>
                                <p class="m-0 report-success-popup-secondary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Your report is all done')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center report-success-popup-footer">
                    <a id="report-redirect-dashboard" href="#" class="border-0 secondary-bg-color d-flex justify-content-center align-items-center report-success-popup-footer-btn text-decoration-none">
                        <span class="report-success-popup-footer-btn-text text-white @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('See your report')}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var addConnectionsmodal = new bootstrap.Modal(document.getElementById('addConnectionsmodal'), {keyboard: false});
    var successAddConnectionsmodal = new bootstrap.Modal(document.getElementById('successAddConnectionsmodal'), {keyboard: false});
    var addReportsmodal = new bootstrap.Modal(document.getElementById('addReportsmodal'), {keyboard: false});
    var successAddReportsmodal = new bootstrap.Modal(document.getElementById('successAddReportsmodal'), {keyboard: false});
    var facebookUrl = "{{url('facebook/callback')}}";
    var facebookAdsUrl = "{{url('facebook/callback')}}";
    var twitterUrl = "{{url('twitter/login')}}";
    var instagramUrl = "{{url('instagram/callback')}}";
    var googleAnalyticsUrl = "{{url('google-analytics/login')}}";
    var googleAdsUrl = "{{url('google-ads/login')}}";

    var provider_name_for_template;
</script>
<script>
    function toggleLoader(loaderStatus) {
        const loader = document.querySelector('.loader');
        if (loaderStatus) {
            loader.removeAttribute('hidden');
        } else {
            loader.setAttribute('hidden', '');
        }
    };
    window.fbAsyncInit = function () {
        FB.init({
            appId: {{env('FACEBOOK_APP_ID')}},
            cookie: true,
            xfbml: true,
            version: 'v12.0'
        });
    };
    jQuery(document).ready(function(){
        jQuery('#connections-add-new-report-btn').on('click', function(){
            jQuery('#all-connections-selector').simulateClick('click');
        });
    });

    jQuery.fn.simulateClick = function() {
        return this.each(function() {
            if('createEvent' in document) {
                var doc = this.ownerDocument,
                    evt = doc.createEvent('MouseEvents');
                evt.initMouseEvent('click', true, true, doc.defaultView, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
                this.dispatchEvent(evt);
            } else {
                this.click(); // IE
            }
        });
    }
</script>
<script>
    function checkConnections() {
        let result = false;
        $.ajax({
            url: "{{url('/check-count-connections')}}",
            method: "get",
            async: false,
            success: function (data) {
                result = data.status;
            }
        })
        return result;
    };
    function openAddConnectionModal(provider_name,openModal,first_time=null){

        let date = $('#date').val()
        let search = $('#search_input').val();
        if(first_time!==null){
            date='all';
            search=null;
        }
        if (search !== null && search !== '') {
            search = search;
        }else{
            search=null;
        }
        if (date !== null && date !== '') {
            date = date;
        }else{
            date=null;
        }
        $.ajax({
            url: "{{url('/v2/search-connects-by-provider')}}",
            method: "post",
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                provider_name: provider_name,
                search:search,
                date:date
            },
            success: (response) => {
                $('#connections-accounts-wrapper').html('');
                $('#connection-popup-footer-wrapper').html('');
                $('#connections-account-name').val("");
                $('#connection-popup-addnew').removeAttr('onclick');
                if(response.success){
                    $('#connections-accounts-wrapper').html(response.html);
                    $('#connection-popup-footer-wrapper').html(response.html2);
                    $('#connections-account-name').val(response.provider_name);
                    if(response.provider_name=='facebook'){
                        $('#connection-popup-addnew').attr('onClick', 'fb_login();');
                        $('#search_connection').attr('onClick', 'openAddConnectionModal("facebook",false);');
                        $('#date').attr('onchange', 'openAddConnectionModal("facebook",false);');
                    }else if(response.provider_name=='facebookAds'){
                        $('#connection-popup-addnew').attr('onClick', 'facebook_ads_login();');
                        $('#search_connection').attr('onClick', 'openAddConnectionModal("facebookAds",false);');
                        $('#date').attr('onchange', 'openAddConnectionModal("facebookAds",false);');
                    }else if(response.provider_name=='twitter'){
                        $('#connection-popup-addnew').attr('onClick', 'twitter_login();');
                        $('#search_connection').attr('onClick', 'openAddConnectionModal("twitter",false);');
                        $('#date').attr('onchange', 'openAddConnectionModal("twitter",false);');
                    }else if(response.provider_name=='instagram'){
                        $('#connection-popup-addnew').attr('onClick', 'instagram_login();');
                        $('#search_connection').attr('onClick', 'openAddConnectionModal("instagram",false);');
                        $('#date').attr('onchange', 'openAddConnectionModal("instagram",false);');
                    }else if(response.provider_name=='googleAnalytics'){
                        $('#connection-popup-addnew').attr('onClick', 'googleAnalyticsLogin();');
                        $('#search_connection').attr('onClick', 'openAddConnectionModal("googleAnalytics",false);');
                        $('#date').attr('onchange', 'openAddConnectionModal("googleAnalytics",false);');
                    }else if(response.provider_name=='googleAds'){
                        $('#connection-popup-addnew').attr('onClick', 'googleAdsLogin();');
                        $('#search_connection').attr('onClick', 'openAddConnectionModal("googleAds",false);');
                        $('#date').attr('onchange', 'openAddConnectionModal("googleAds",false);');
                    }
                    if(openModal){
                        $('#date').val('all')
                        $('#search_input').val('');
                        addConnectionsmodal.show();
                    }
                    
                }
               
            },
        })
    }
    function openReportModal(provider_name){
        $.ajax({
            url: "{{url('/get-report-html')}}"+'/'+provider_name,
            method: "get",
            async: false,
            success: function (data) {
                if(data.success){
                    $('#connections-report-popup-body').html('');
                    $('#connections-report-popup-body').html(data.html);
                    successAddConnectionsmodal.hide();
                    addReportsmodal.show();
                }
            }
        })
    }
    function syncConnections(event){
        event.preventDefault();
        let url = "{{ url('v2/connection/sync') }}";
        var formData = new FormData(document.getElementById("connection-account-form"));
        $.ajax({
            type: 'POST',
            url: url,
            data:formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                toggleLoader(true);
            },
            success: function(data) {
                if(data.success){
                    if(data.social_accounts){
                        $('#success_choose_report_btn').removeAttr('onclick');
                        provider_name_for_template=data.provider_name;
                        if(data.provider_name=='facebook'){
                            $('#success_choose_report_btn').attr('onClick', 'openReportModal("facebook");');
                        }else if(data.provider_name=='facebookAds'){
                            $('#success_choose_report_btn').attr('onClick', 'openReportModal("facebookAds");');
                        }else if(data.provider_name=='twitter'){
                            $('#success_choose_report_btn').attr('onClick', 'openReportModal("twitter");');
                        }else if(data.provider_name=='instagram'){
                            $('#success_choose_report_btn').attr('onClick', 'openReportModal("instagram");');
                        }else if(data.provider_name=='googleAnalytics'){
                            $('#success_choose_report_btn').attr('onClick', 'openReportModal("googleAnalytics");');
                        }else if(data.provider_name=='googleAds'){
                            $('#success_choose_report_btn').attr('onClick', 'openReportModal("googleAds");');
                        }
                        addConnectionsmodal.hide();
                        successAddConnectionsmodal.show();
                        toggleLoader(false);    
                    }else{
                        openAddConnectionModal(data.provider_name,false);
                        if(data.provider_name=='facebook'){
                            $('.fb-connection-btn').removeClass('active-connection-wrapper');
                            $(".fb-connection-btn > .connection-active-tick").addClass('d-none');
                            $(".fb-column-container").addClass('d-none');
                        }else if(data.provider_name=='facebookAds'){
                            $('.fbAds-connection-btn').removeClass('active-connection-wrapper');
                            $(".fbAds-connection-btn > .connection-active-tick").addClass('d-none');
                            $(".fbAds-column-container").addClass('d-none');
                        }else if(data.provider_name=='twitter'){
                            $('.twitter-connection-btn').removeClass('active-connection-wrapper');
                            $(".twitter-connection-btn > .connection-active-tick").addClass('d-none');
                            $(".twitter-column-container").addClass('d-none');
                        }else if(data.provider_name=='instagram'){
                            $('.instagram-connection-btn').removeClass('active-connection-wrapper');
                            $(".instagram-connection-btn > .connection-active-tick").addClass('d-none');
                            $(".instagram-column-container").addClass('d-none');
                        }else if(data.provider_name=='googleAnalytics'){
                            $('.ga-connection-btn').removeClass('active-connection-wrapper');
                            $(".ga-connection-btn > .connection-active-tick").addClass('d-none');
                            $(".ga-column-container").addClass('d-none');
                        }else if(data.provider_name=='googleAds'){
                            $('.gAds-connection-btn').removeClass('active-connection-wrapper');
                            $(".gAds-connection-btn > .connection-active-tick").addClass('d-none');
                            $(".gAds-column-container").addClass('d-none');
                        }
                        toastr.warning("{{__('Account Disconnected')}}");
                        toggleLoader(false);
                    }
                    console.log(data.success,data.has_connections);
                    if(data.has_connections){
                        $('#empty-connections-container').addClass('d-none');
                        $('#not-empty-connections-container').removeClass('d-none');
                    }else{
                        $('#empty-connections-container').removeClass('d-none');
                        $('#not-empty-connections-container').addClass('d-none');
                    }
                }
                else{
                    toastr.warning("{{__('error')}}");
                    toggleLoader(false);
                }
                
            },
            error: function(error) {
                toastr.warning("{{__('error')}}");
                toggleLoader(false);
            }
        });
    }
    let report_name=null;
    function selectReport(report,button,locale){
        report_name=report;
        $(button).addClass('report-options-active').siblings().removeClass('report-options-active');

        if(report=='google-ads'){
            if(locale=='en'){
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/Googlea-Ads-Overview.png')}}");
            }
            else{
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/Googlea-Ads-Overview-ar.png')}}");
            }
        }else if(report=='google-analytics'){
            if(locale=='en'){
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/Google-Analytics-Overview.png')}}");
            }
            else{
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/Google-Analytics-Overview-ar.png')}}");
            }
        }else if(report=='twitter'){
            if(locale=='en'){
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/twitter-overview.png')}}");
            }
            else{
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/twitter-overview-ar.png')}}");
            }
        }else if(report=='instagram'){
            if(locale=='en'){
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/instagram-overview.png')}}");
            }
            else{
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/instagram-overview-ar.png')}}");
            }
        }else if(report=='facebook-ads'){
            if(locale=='en'){
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/fb-ads.svg')}}");
            }
            else{
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/fb-ads-ar.svg')}}");
            }
        }else if(report=='facebook-engagement'){
            if(locale=='en'){
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/facebook-temp.png')}}");
            }
            else{
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/facebook-temp-ar.png')}}");
            }
            
        }else if(report=='facebook-overview'){
            if(locale=='en'){
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/fb-page-insight.svg')}}");
            }
            else{
                $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/fb-page-insight-ar.svg')}}");
            }
            
        }else{
            $("#template-demo-images").attr('src',"{{url('../../assets/v2/dashboard-temp-img/fb-dashboard-img.png')}}");
        }
        if(report=='google-ads'){
            $("#facebook-overview-img").addClass('d-none');
            $("#facebook-engagement-img").addClass('d-none');
            $("#facebook-ads-img").addClass('d-none');
            $("#instagram-img").addClass('d-none');
            $("#twitter-img").addClass('d-none');
            $("#google-analytics-img").addClass('d-none');
            $("#google-ads-img").removeClass('d-none');
        }else if(report=='google-analytics'){
            $("#google-ads-img").addClass('d-none');
            $("#facebook-overview-img").addClass('d-none');
            $("#facebook-engagement-img").addClass('d-none');
            $("#facebook-ads-img").addClass('d-none');
            $("#instagram-img").addClass('d-none');
            $("#twitter-img").addClass('d-none');
            $("#google-analytics-img").removeClass('d-none');
        }else if(report=='twitter'){
            $("#google-ads-img").addClass('d-none');
            $("#google-analytics-img").addClass('d-none');
            $("#facebook-overview-img").addClass('d-none');
            $("#facebook-engagement-img").addClass('d-none');
            $("#facebook-ads-img").addClass('d-none');
            $("#instagram-img").addClass('d-none');
            $("#twitter-img").removeClass('d-none');
        }else if(report=='instagram'){
            $("#google-ads-img").addClass('d-none');
            $("#google-analytics-img").addClass('d-none');
            $("#twitter-img").addClass('d-none');
            $("#facebook-overview-img").addClass('d-none');
            $("#facebook-engagement-img").addClass('d-none');
            $("#facebook-ads-img").addClass('d-none');
            $("#instagram-img").removeClass('d-none');
        }else if(report=='facebook-ads'){
            $("#google-ads-img").addClass('d-none');
            $("#google-analytics-img").addClass('d-none');
            $("#twitter-img").addClass('d-none');
            $("#instagram-img").addClass('d-none');
            $("#facebook-overview-img").addClass('d-none');
            $("#facebook-engagement-img").addClass('d-none');
            $("#facebook-ads-img").removeClass('d-none');
        }else if(report=='facebook-engagement'){
            $("#google-ads-img").addClass('d-none');
            $("#google-analytics-img").addClass('d-none');
            $("#twitter-img").addClass('d-none');
            $("#instagram-img").addClass('d-none');
            $("#facebook-ads-img").addClass('d-none');
            $("#facebook-overview-img").addClass('d-none');
            $("#facebook-engagement-img").removeClass('d-none');
        }else if(report=='facebook-overview'){
            $("#google-ads-img").addClass('d-none');
            $("#google-analytics-img").addClass('d-none');
            $("#twitter-img").addClass('d-none');
            $("#instagram-img").addClass('d-none');
            $("#facebook-ads-img").addClass('d-none');
            $("#facebook-engagement-img").addClass('d-none');
            $("#facebook-overview-img").removeClass('d-none');
        }
        
        $('.active-report-tab').addClass('d-none');
        $('.inactive-report-tab').removeClass('d-none');
        $(button).children('.active-report-tab').removeClass("d-none");
        $(button).children('.inactive-report-tab').addClass("d-none");
        $("#connection-add-report-footer").removeClass('d-none');
    }
    function chooseTemplates(provider){
        if(report_name=='facebook-overview' || report_name=='facebook-engagement'){
            $.ajax({
                url: "{{url('/create-dashboard')}}",
                method: "post",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: report_name,
                },
                dataType: 'json',
                success: (response) => {
                    $('#report-redirect-dashboard').removeAttr('href');
                    if(report_name=='facebook-overview'){
                        $('#report-redirect-dashboard').attr('href', '{{url("/dashboard/facebook-overview")}}');
                    }else{
                        $('#report-redirect-dashboard').attr('href', '{{url("/dashboard/facebook-engagement")}}');
                    }
                    addReportsmodal.hide();
                    successAddReportsmodal.show();
                },
                error: () => {
                    toastr.warning("{{__('error')}}");
                }
            });
        }else if(report_name=='google-ads'){
            $.ajax({
                url: '{{url("/google-ads-report-new")}}',
                method: "post",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: report_name,
                },
                dataType: 'json',
                success: (response) => {
                    if(response.status==true){
                        $('#report-redirect-dashboard').removeAttr('href');
                        $('#report-redirect-dashboard').attr('href', '{{url("/dashboard/google-ads-overview")}}');
                        addReportsmodal.hide();
                        successAddReportsmodal.show();
                    }
                    else{
                        toastr.warning("{{__('error')}}");
                    }
                },
                error: () => {
                     toastr.warning("{{__('error')}}");
                }
            });
        }
        else if(report_name=='google-analytics'){
            $('#report-redirect-dashboard').removeAttr('href');
             $('#report-redirect-dashboard').attr('href', '{{url("/dashboard/google-analytics-overview")}}');
             addReportsmodal.hide();
            successAddReportsmodal.show();
        }
        else if(report_name=='twitter'){
            $('#report-redirect-dashboard').removeAttr('href');
             $('#report-redirect-dashboard').attr('href', '{{url("/dashboard/twitter-overview")}}');
             addReportsmodal.hide();
            successAddReportsmodal.show();
        }
        else if(report_name=='instagram'){
            $('#report-redirect-dashboard').removeAttr('href');
             $('#report-redirect-dashboard').attr('href', '{{url("/dashboard/instagram-overview")}}');
             addReportsmodal.hide();
            successAddReportsmodal.show();
        }
        else if(report_name=='facebook-ads'){
            $('#report-redirect-dashboard').removeAttr('href');
             $('#report-redirect-dashboard').attr('href', '{{url("/dashboard/facebook-ads-overview")}}');
             addReportsmodal.hide();
            successAddReportsmodal.show();
        }
        
    }
    let show_menu=false;
    function showMenuItems(){
        if(!show_menu){
            $('#connection-item-1').css("display", "none");
            $('#connection-item-2').css("display", "none");
            $('#connection-item-3').css("display", "none");
            $('#connection-item-4').css("display", "none");
            $('#connection-item-5').css("display", "block");
            $('#connection-item-6').css("display", "block");
            show_menu=true;
        }else{
            $('#connection-item-1').css("display", "block");
            $('#connection-item-2').css("display", "block");
            $('#connection-item-3').css("display", "block");
            $('#connection-item-4').css("display", "block");
            $('#connection-item-5').css("display", "none");
            $('#connection-item-6').css("display", "none");
            show_menu=false;
        }
        $('#show-item-arrow-icon').toggleClass('show-item-arrow-icon');
        
    }
</script>
<script>
    function fb_login() {
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
                        url: "{{url('facebook/callback')}}",
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
                                openAddConnectionModal('facebook');
                                $('.fb-connection-btn').addClass('active-connection-wrapper');
                                $(".fb-connection-btn > .connection-active-tick").removeClass('d-none');
                                $(".fb-column-container").removeClass('d-none');
                                $('#empty-connections-container').addClass('d-none');
                                $('#not-empty-connections-container').removeClass('d-none');
                            } else {
                                toastr.warning(response.message);
                            }
                        },
                        error: () => {
                            toggleLoader(false);
                            toastr.warning("{{__('error')}}");
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

    function instagram_login() {
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
                        url: "{{url('instagram/callback')}}",
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
                                openAddConnectionModal('instagram');
                                $('.instagram-connection-btn').addClass('active-connection-wrapper');
                                $(".instagram-connection-btn > .connection-active-tick").removeClass('d-none');
                                $(".instagram-column-container").removeClass('d-none');
                                $('#empty-connections-container').addClass('d-none');
                                $('#not-empty-connections-container').removeClass('d-none');
                            } else {
                                toastr.warning(response.message);
                            }
                        },
                        error: () => {
                            toggleLoader(false);
                            toastr.warning("{{__('error')}}");
                        }
                    })
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            }, {
                scope: 'email,  public_profile, instagram_basic, instagram_manage_insights, pages_show_list, pages_read_engagement',
            });
        }, 500);
    }

    function facebook_ads_login() {
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
                        url: "{{url('/facebook-ads/callback')}}",
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
                                openAddConnectionModal('facebookAds',false);
                                $('.fbAds-connection-btn').addClass('active-connection-wrapper');
                                $(".fbAds-connection-btn > .connection-active-tick").removeClass('d-none');
                                $(".fbAds-column-container").removeClass('d-none');

                                $('#empty-connections-container').addClass('d-none');
                                $('#not-empty-connections-container').removeClass('d-none');
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
        }, 500);
    }

    function twitter_login() {
        window.setTimeout(function () {
            let createConnections = checkConnections();
            if (!createConnections) {
                return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
            }
            var left = (screen.width / 2 - 225);
            var top = (screen.height / 2 - 350);
            window.open(twitterUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
        }, 500);
    }

    function googleAnalyticsLogin() {
        window.setTimeout(function () {
            let createConnections = checkConnections();
            if (!createConnections) {
                return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
            }
            var left = (screen.width / 2 - 225);
            var top = (screen.height / 2 - 350);
            window.open(googleAnalyticsUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
        }, 500);
    }

    function googleAdsLogin() {
        window.setTimeout(function () {

            let createConnections = checkConnections();
            if (!createConnections) {
                return toastr.warning('{{__("You used all connections")}}. {{__("Upgrade your plan")}}');
            }
            var left = (screen.width / 2 - 225);
            var top = (screen.height / 2 - 350);
            window.open(googleAdsUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
        }, 500);
    }

    jQuery(window).bind("focus", function (event) {
        let ConnectionInfo = localStorage.getItem('connectionStatus');
        let ConnectionType = localStorage.getItem('connectionType');
        console.log(ConnectionType);
        if (ConnectionInfo === 'success') {
            switch (ConnectionType) {
                case 'twitter':
                    openAddConnectionModal('twitter',false);
                    $('.twitter-connection-btn').addClass('active-connection-wrapper');
                    $(".twitter-connection-btn > .connection-active-tick").removeClass('d-none');
                    $(".twitter-column-container").removeClass('d-none');
                    $('#empty-connections-container').addClass('d-none');
                    $('#not-empty-connections-container').removeClass('d-none');
                    break;
                case 'google-analytics':
                    openAddConnectionModal('googleAnalytics',false);
                    $('.ga-connection-btn').addClass('active-connection-wrapper');
                    $(".ga-connection-btn > .connection-active-tick").removeClass('d-none');
                    $(".ga-column-container").removeClass('d-none');
                    $('#empty-connections-container').addClass('d-none');
                    $('#not-empty-connections-container').removeClass('d-none');
                    break;
                case 'google-analytics-ua':
                    openAddConnectionModal('googleAnalytics',false);
                    $('.ga-connection-btn').addClass('active-connection-wrapper');
                    $(".ga-connection-btn > .connection-active-tick").removeClass('d-none');
                    $(".ga-column-container").removeClass('d-none');
                    $('#empty-connections-container').addClass('d-none');
                    $('#not-empty-connections-container').removeClass('d-none');
                    break;
                case 'googleAds':
                    openAddConnectionModal('googleAds',false);
                    $('.gAds-connection-btn').addClass('active-connection-wrapper');
                    $(".gAds-connection-btn > .connection-active-tick").removeClass('d-none');
                    $(".gAds-column-container").removeClass('d-none');
                    $('#empty-connections-container').addClass('d-none');
                    $('#not-empty-connections-container').removeClass('d-none');
                    break;
            }

            toastr.success("{{__('Connection connected successfully')}}");
        }
        if (ConnectionInfo === 'error_account_connected') {
            toastr.warning("{{__('This account is connected')}}");
        }
        if (ConnectionInfo === 'error') {
            toastr.warning("{{__('Error during connecting, please try again')}}");
        }
        if (ConnectionInfo === 'no_accounts') {
            toastr.warning("{{__('No accounts')}}");
        }
        if (ConnectionInfo === 'error_no_permissions') {
            toastr.warning("{{__('No permissions')}}");
        }
        localStorage.removeItem('connectionStatus');
        localStorage.removeItem('connectionType');
    });
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
@endsection