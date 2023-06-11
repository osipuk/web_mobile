@php
    $get_locale=checkLangaugeGlobaly();
@endphp
<div class="bg-white template-selector-container @if($checked) template-prechecked template-active-border @endif">
    <button type="button" onclick="selectTemplate(this,'googlea-overview','{{$checked}}','{{$get_locale}}')" class="w-100 border-0 bg-white d-flex flex-row justify-content-between align-items-center template-selector">
        <span style="width: 11%;">
         <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M27.0747 13.8073C27.0747 12.85 26.988 11.9295 26.8271 11.0459H14V16.2679H21.3297C21.014 17.9554 20.0545 19.3852 18.612 20.3425V23.7298H23.0136C25.5889 21.3795 27.0747 17.9186 27.0747 13.8073Z" fill="#4285F4"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0002 26.9995C17.6775 26.9995 20.7604 25.7906 23.0138 23.7288L18.6122 20.3415C17.3927 21.1515 15.8326 21.6301 14.0002 21.6301C10.4529 21.6301 7.45047 19.2554 6.37949 16.0645H1.82935V19.5622C4.07037 23.9742 8.67622 26.9995 14.0002 26.9995Z" fill="#34A853"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.37937 16.0652C6.10698 15.2552 5.95221 14.39 5.95221 13.5002C5.95221 12.6105 6.10698 11.7452 6.37937 10.9352V7.4375H1.82923C0.906822 9.26 0.380615 11.3218 0.380615 13.5002C0.380615 15.6786 0.906822 17.7405 1.82923 19.563L6.37937 16.0652Z" fill="#FBBC05"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0002 5.36932C15.9998 5.36932 17.7951 6.05045 19.2065 7.38818L23.1129 3.51614C20.7542 1.33773 17.6713 0 14.0002 0C8.67622 0 4.07037 3.02523 1.82935 7.43727L6.37949 10.935C7.45047 7.74409 10.4529 5.36932 14.0002 5.36932Z" fill="#EA4335"></path>
         </svg>
        </span>
        <div style="width: 81%;" class="d-flex flex-column justify-content-start align-items-start template-selector-text-container">
            <p class="m-0 primary-text-color template-selector-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Google Ads')}}</p>
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