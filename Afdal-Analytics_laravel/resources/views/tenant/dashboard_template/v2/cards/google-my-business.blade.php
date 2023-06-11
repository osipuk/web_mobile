@php
    $get_locale=checkLangaugeGlobaly();
@endphp
<div class="bg-white template-selector-container @if($checked) template-prechecked template-active-border @endif">
    <button type="button" class="w-100 border-0 bg-white d-flex flex-row justify-content-between align-items-center template-selector">
        <span style="width: 11%;">
         <svg width="35" height="34" viewBox="0 0 35 34" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_3453_23577)">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M23.72 14.1584C23.72 13.662 23.6755 13.1847 23.5927 12.7266H17V15.4343H20.7673C20.605 16.3093 20.1118 17.0507 19.3705 17.547V19.3034H21.6327C22.9564 18.0847 23.72 16.2902 23.72 14.1584Z" fill="#4285F4" />
               <path fill-rule="evenodd" clip-rule="evenodd" d="M17 20.9981C18.89 20.9981 20.4746 20.3713 21.6327 19.3022L19.3705 17.5459C18.7437 17.9659 17.9418 18.214 17 18.214C15.1768 18.214 13.6337 16.9827 13.0832 15.3281H10.7446V17.1418C11.8964 19.4295 14.2637 20.9981 17 20.9981Z" fill="#34A853" />
               <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0832 15.3291C12.9432 14.9091 12.8636 14.4605 12.8636 13.9991C12.8636 13.5377 12.9432 13.0891 13.0832 12.6691V10.8555H10.7445C10.2705 11.8005 10 12.8696 10 13.9991C10 15.1287 10.2705 16.1977 10.7445 17.1427L13.0832 15.3291Z" fill="#FBBC05" />
               <path fill-rule="evenodd" clip-rule="evenodd" d="M17 9.78409C18.0277 9.78409 18.9505 10.1373 19.6759 10.8309L21.6837 8.82318C20.4714 7.69364 18.8868 7 17 7C14.2637 7 11.8964 8.56864 10.7446 10.8564L13.0832 12.67C13.6337 11.0155 15.1768 9.78409 17 9.78409Z" fill="#EA4335" />
            </g>
            <line x1="25.1213" y1="23" x2="32" y2="29.8787" stroke="#8797AF" stroke-width="3" stroke-linecap="round" />
            <circle cx="17" cy="14" r="11.5" stroke="#8797AF" stroke-width="3" />
            <defs>
               <clipPath id="clip0_3453_23577">
                  <rect width="14" height="14" fill="white" transform="translate(10 7)" />
               </clipPath>
            </defs>
         </svg>
        </span>
        <div style="width: 81%;" class="d-flex flex-column justify-content-start align-items-start template-selector-text-container">
            <p class="m-0 primary-text-color template-selector-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Google my business ')}}</p>
            <p class="m-0 template-selector-secondary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('learn more about your audience and what content resonates with them most.')}}</p>
        </div>
        <div>
            <div class="secondary-bg-color d-flex flex-row align-items-center justify-content-center template-comming-soon-wrapper" style="@if($get_locale=='ar') height: 17px; @endif">
                <span class="text-center text-white template-comming-soon-text">{{__('Coming soon')}}</span>
            </div>
        </div>
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