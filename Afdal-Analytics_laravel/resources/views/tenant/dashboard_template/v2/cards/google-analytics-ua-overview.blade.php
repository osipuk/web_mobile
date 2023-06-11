@php
    $get_locale=checkLangaugeGlobaly();
@endphp
<div class="bg-white template-selector-container @if($checked) template-prechecked template-active-border @endif">
    <button type="button" onclick="selectTemplate(this,'google-analytics-ua-overview','{{$checked}}','{{$get_locale}}')" class="w-100 border-0 bg-white d-flex flex-row justify-content-between align-items-center template-selector">
        <span style="width: 11%;">
         <svg width="25" height="28" viewBox="0 0 25 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="18.3157" width="6.51872" height="28" rx="3.25936" fill="#F9AB00"></rect>
            <rect x="9.08081" y="10.7695" width="7.06195" height="17.2308" rx="3.53097" fill="#E37400"></rect>
            <rect x="0.38916" y="21.5381" width="6.51872" height="6.46154" rx="3.23077" fill="#E37400"></rect>
         </svg>
        </span>
        <div style="width: 81%;" class="d-flex flex-column justify-content-start align-items-start template-selector-text-container">
            <p class="m-0 primary-text-color template-selector-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Google Analytics')}</p>
            <p class="m-0 template-selector-secondary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('learn more about your audience and what content resonates with them most.')}}</p>
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