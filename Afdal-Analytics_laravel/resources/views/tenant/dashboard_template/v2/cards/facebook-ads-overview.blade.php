@php
    $get_locale=checkLangaugeGlobaly();
@endphp
<div class="bg-white template-selector-container @if($checked) template-prechecked template-active-border @endif">
    <button type="button" onclick="selectTemplate(this,'facebook-ads-overview','{{$checked}}','{{$get_locale}}')" class="w-100 border-0 bg-white d-flex flex-row justify-content-between align-items-center template-selector">
        <span style="width: 11%;">
            <svg width="35" height="34" viewBox="0 0 35 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_3453_23541)">
                    <path d="M34.7083 10.3216V11.7383C34.7083 12.5203 34.0619 13.1549 33.2621 13.1549C32.4624 13.1549 31.816 12.5203 31.816 11.7383V10.3216C31.816 7.97845 29.8694 6.07161 27.4774 6.07161H7.2309C4.83892 6.07161 2.89236 7.97845 2.89236 10.3216V24.4883C2.89236 26.8314 4.83892 28.7383 7.2309 28.7383H11.5694C12.3692 28.7383 13.0156 29.373 13.0156 30.155C13.0156 30.937 12.3692 31.5716 11.5694 31.5716H7.2309C3.24378 31.5716 0 28.394 0 24.4883V10.3216C0 6.41586 3.24378 3.23828 7.2309 3.23828H27.4774C31.4645 3.23828 34.7083 6.41586 34.7083 10.3216ZM13.0156 21.6549H9.73569C9.22085 21.6549 8.74071 21.3829 8.48185 20.9466C8.08415 20.268 7.20053 20.0343 6.50637 20.4295C5.81509 20.8219 5.57792 21.6875 5.97996 22.3647C6.75222 23.6751 8.19261 24.4883 9.73713 24.4883H10.1247C10.1247 25.2703 10.7712 25.9049 11.5709 25.9049C12.3706 25.9049 13.0171 25.2703 13.0171 24.4883C15.4091 24.4883 17.3556 22.5814 17.3556 20.2383C17.3556 18.3116 15.947 16.6824 14.0077 16.3665L9.60987 15.6483C9.07044 15.5604 8.67853 15.1071 8.67853 14.5716C8.67853 13.791 9.32642 13.1549 10.1247 13.1549H13.4046C13.9195 13.1549 14.3996 13.4269 14.6585 13.8633C15.0562 14.5404 15.9384 14.7728 16.634 14.3804C17.3252 13.9879 17.5624 13.1224 17.1604 12.4452C16.3881 11.1348 14.9477 10.3202 13.4032 10.3202H13.0156C13.0156 9.5382 12.3692 8.90353 11.5694 8.90353C10.7697 8.90353 10.1233 9.5382 10.1233 10.3202C7.73128 10.3202 5.78472 12.227 5.78472 14.5702C5.78472 16.4969 7.1933 18.126 9.13263 18.4419L13.5305 19.1602C14.0699 19.248 14.4618 19.7014 14.4618 20.2369C14.4618 21.0174 13.8139 21.6535 13.0156 21.6535V21.6549Z" fill="#8797AF" />
                    <path d="M34.7079 23.5273C34.7079 21.3672 33.8574 19.2956 32.3436 17.7682C30.8298 16.2408 28.7767 15.3828 26.6358 15.3828C24.4951 15.383 22.4421 16.2411 20.9285 17.7685C19.4148 19.2958 18.5645 21.3673 18.5645 23.5273C18.5647 25.4668 19.2507 27.3426 20.4991 28.8174C21.7475 30.2921 23.4765 31.2691 25.375 31.5726V25.8814H23.3271V23.5273H25.375V21.7331C25.375 19.6916 26.5798 18.5648 28.4236 18.5648C29.029 18.5733 29.6329 18.6264 30.2305 18.7239V20.7282H29.2134C29.04 20.705 28.8635 20.7214 28.6972 20.7763C28.5309 20.8312 28.379 20.9231 28.2527 21.0453C28.1264 21.1674 28.0289 21.3167 27.9675 21.482C27.9061 21.6474 27.8823 21.8244 27.898 22.0003V23.528H30.137L29.7793 25.8821H27.8973V31.5733C29.7959 31.2698 31.5248 30.2928 32.7732 28.818C34.0217 27.3433 34.7077 25.4674 34.7079 23.528" fill="#1877F2" />
                </g>
                <defs>
                    <clipPath id="clip0_3453_23541">
                        <rect width="34.7083" height="34" fill="white" />
                    </clipPath>
                </defs>
            </svg>
        </span>
        <div style="width: 81%;" class="d-flex flex-column justify-content-start align-items-start template-selector-text-container">
            <p class="m-0 primary-text-color template-selector-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Facebook Ads')}}</p>
            <p class="m-0 template-selector-secondary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Get a clear picture of how your online advertising efforts impact your business.')}}</p>
        </div>
        <span style="width: 8%;">
            <svg class="template-active-tick @if($checked) d-inline @else d-none @endif" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.9993 2.16797C7.04102 2.16797 2.16602 7.04297 2.16602 13.0013C2.16602 18.9596 7.04102 23.8346 12.9993 23.8346C18.9577 23.8346 23.8327 18.9596 23.8327 13.0013C23.8327 7.04297 18.9577 2.16797 12.9993 2.16797ZM17.5494 11.1596L12.3493 16.3596C11.916 16.793 11.266 16.793 10.8327 16.3596L8.44935 13.9763C8.01602 13.543 8.01602 12.893 8.44935 12.4596C8.88268 12.0263 9.53268 12.0263 9.96602 12.4596L11.591 14.0846L16.0327 9.64297C16.466 9.20964 17.116 9.20964 17.5494 9.64297C17.9827 10.0763 17.9827 10.7263 17.5494 11.1596Z" fill="#2DA771" />
            </svg>
            <svg class="template-draft-tick @if(!$checked) d-inline @else d-none @endif" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.9995 2.16797C7.04114 2.16797 2.16614 7.04297 2.16614 13.0013C2.16614 18.9596 7.04114 23.8346 12.9995 23.8346C18.9578 23.8346 23.8328 18.9596 23.8328 13.0013C23.8328 7.04297 18.9578 2.16797 12.9995 2.16797ZM17.5495 11.1596L12.3495 16.3596C11.9161 16.793 11.2661 16.793 10.8328 16.3596L8.44947 13.9763C8.01614 13.543 8.01614 12.893 8.44947 12.4596C8.8828 12.0263 9.5328 12.0263 9.96614 12.4596L11.5911 14.0846L16.0328 9.64297C16.4661 9.20964 17.1161 9.20964 17.5495 9.64297C17.9828 10.0763 17.9828 10.7263 17.5495 11.1596Z" fill="#D0D8E3" />
            </svg>
        </span>
    </button>
    
    <div class="templates-connection-select-container d-none">
        <div class="d-flex flex-column justify-content-between align-items-start select-connector-text-wrapper">
            <p class="p-0 select-connector-text primary-text-color">Select one of your connectors</p>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-start bg-white account-page-heading-wrapper">
            <div class="d-flex flex-row align-items-start account-page-heading-subwrapper">
                <p class="m-0 account-page-heading">Account</p>
                <p class="m-0 account-page-heading">Pages</p>
            </div>
        </div>
        <div class="d-flex flex-row align-items-start template-connector-wrapper">
            <p class="m-0">Jimbo Brown</p>
            <div class="d-flex flex-column align-items-start p-0" style="gap: 1px;">
                <div class="d-flex flex-row align-items-center p-0" style="gap: 9px;">
                    <input type="radio" name="one" id="one">
                    <p class="m-0 template-connector-page-name">Shnu El Joe</p>
                </div>
                <div class="d-flex flex-row align-items-center p-0" style="gap: 9px;">
                    <input type="radio" name="tewo" id="tewo">
                    <p class="m-0 template-connector-page-name">Rakamy Rakamak</p>
                </div>
                <div class="d-flex flex-row align-items-center p-0" style="gap: 9px;">
                    <input type="radio" name="three" id="three">
                    <p class="m-0 template-connector-page-name">Snapuplabs</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center template-connect-wrapper" >
            <button type="button" class="border-0 d-flex flex-row align-items-center template-connect-button">
                <span class="template-connect-button-text">Connect</span>
            </button>
        </div>
    </div>
</div>

    


    