@php
    $get_locale=checkLangaugeGlobaly();
@endphp
<div class="bg-white template-selector-container @if($checked) template-prechecked template-active-border @endif">
    <button type="button" onclick="selectTemplate(this,'twitter-overview','{{$checked}}','{{$get_locale}}')" class="w-100 border-0 bg-white d-flex flex-row justify-content-between align-items-center template-selector">
      <span style="width: 11%;">
         <svg width="35" height="34" viewBox="0 0 35 34" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_3453_23566)">
               <path d="M9.91667 0H5.66667C4.16377 0 2.72243 0.597022 1.65973 1.65973C0.597022 2.72243 0 4.16377 0 5.66667L0 9.91667C0 11.4196 0.597022 12.8609 1.65973 13.9236C2.72243 14.9863 4.16377 15.5833 5.66667 15.5833H9.91667C11.4196 15.5833 12.8609 14.9863 13.9236 13.9236C14.9863 12.8609 15.5833 11.4196 15.5833 9.91667V5.66667C15.5833 4.16377 14.9863 2.72243 13.9236 1.65973C12.8609 0.597022 11.4196 0 9.91667 0V0ZM12.75 9.91667C12.75 10.6681 12.4515 11.3888 11.9201 11.9201C11.3888 12.4515 10.6681 12.75 9.91667 12.75H5.66667C4.91522 12.75 4.19455 12.4515 3.6632 11.9201C3.13184 11.3888 2.83333 10.6681 2.83333 9.91667V5.66667C2.83333 4.91522 3.13184 4.19455 3.6632 3.6632C4.19455 3.13184 4.91522 2.83333 5.66667 2.83333H9.91667C10.6681 2.83333 11.3888 3.13184 11.9201 3.6632C12.4515 4.19455 12.75 4.91522 12.75 5.66667V9.91667Z" fill="#8797AF" />
               <path d="M9.91667 18.418H5.66667C4.16377 18.418 2.72243 19.015 1.65973 20.0777C0.597022 21.1404 0 22.5817 0 24.0846L0 28.3346C0 29.8375 0.597022 31.2789 1.65973 32.3416C2.72243 33.4043 4.16377 34.0013 5.66667 34.0013H9.91667C11.4196 34.0013 12.8609 33.4043 13.9236 32.3416C14.9863 31.2789 15.5833 29.8375 15.5833 28.3346V24.0846C15.5833 22.5817 14.9863 21.1404 13.9236 20.0777C12.8609 19.015 11.4196 18.418 9.91667 18.418ZM12.75 28.3346C12.75 29.0861 12.4515 29.8068 11.9201 30.3381C11.3888 30.8695 10.6681 31.168 9.91667 31.168H5.66667C4.91522 31.168 4.19455 30.8695 3.6632 30.3381C3.13184 29.8068 2.83333 29.0861 2.83333 28.3346V24.0846C2.83333 23.3332 3.13184 22.6125 3.6632 22.0812C4.19455 21.5498 4.91522 21.2513 5.66667 21.2513H9.91667C10.6681 21.2513 11.3888 21.5498 11.9201 22.0812C12.4515 22.6125 12.75 23.3332 12.75 24.0846V28.3346Z" fill="#8797AF" />
               <path d="M28.3337 18.418H24.0837C22.5808 18.418 21.1394 19.015 20.0767 20.0777C19.014 21.1404 18.417 22.5817 18.417 24.0846V28.3346C18.417 29.8375 19.014 31.2789 20.0767 32.3416C21.1394 33.4043 22.5808 34.0013 24.0837 34.0013H28.3337C29.8366 34.0013 31.2779 33.4043 32.3406 32.3416C33.4033 31.2789 34.0003 29.8375 34.0003 28.3346V24.0846C34.0003 22.5817 33.4033 21.1404 32.3406 20.0777C31.2779 19.015 29.8366 18.418 28.3337 18.418ZM31.167 28.3346C31.167 29.0861 30.8685 29.8068 30.3371 30.3381C29.8058 30.8695 29.0851 31.168 28.3337 31.168H24.0837C23.3322 31.168 22.6115 30.8695 22.0802 30.3381C21.5488 29.8068 21.2503 29.0861 21.2503 28.3346V24.0846C21.2503 23.3332 21.5488 22.6125 22.0802 22.0812C22.6115 21.5498 23.3322 21.2513 24.0837 21.2513H28.3337C29.0851 21.2513 29.8058 21.5498 30.3371 22.0812C30.8685 22.6125 31.167 23.3332 31.167 24.0846V28.3346Z" fill="#8797AF" />
               <path d="M23.0707 11.9621C21.5099 13.1404 19.8375 13.585 18 13.4527C18.0496 13.5131 18.0943 13.5439 18.1414 13.5722C19.995 14.676 21.9864 15.1283 24.1203 14.969C25.6762 14.8533 27.1501 14.4395 28.469 13.5915C31.5993 11.5779 33.1873 8.62504 33.2717 4.81252C33.2779 4.55681 33.3548 4.40647 33.5447 4.26127C34.0993 3.83722 34.567 3.3258 35 2.67561C34.3449 2.92746 33.7444 3.12406 33.036 3.19859C33.7419 2.69103 34.2692 2.12564 34.536 1.26728C33.8648 1.64249 33.2221 1.90591 32.5385 2.06267C32.3821 2.09865 32.2804 2.07938 32.1613 1.9663C31.4888 1.3251 30.6836 1 29.7779 1C27.4653 1 25.9454 3.07523 26.2829 5.05409C26.3213 5.27896 26.2717 5.33807 26.0471 5.32008C25.0087 5.23527 24.0062 4.9937 23.0422 4.59536C21.5881 3.99528 20.3325 3.09194 19.2841 1.88278C19.0732 1.63863 19.067 1.64377 18.9231 1.94446C18.2531 3.34122 18.6588 5.1479 19.8623 6.13604C19.9355 6.19644 20.036 6.23499 20.0782 6.35834C19.5459 6.3275 19.067 6.16945 18.5633 5.93045C18.6873 7.79237 19.6303 8.89874 21.3164 9.432C20.804 9.5862 20.3275 9.56564 19.8015 9.51424C20.4144 11.0318 21.4789 11.8028 23.0707 11.9583V11.9621Z" fill="#28A6D1" />
            </g>
            <defs>
               <clipPath id="clip0_3453_23566">
                  <rect width="35" height="34" fill="white" />
               </clipPath>
            </defs>
         </svg> 
      </span>
        <div style="width: 81%;" class="d-flex flex-column justify-content-start align-items-start template-selector-text-container">
            <p class="m-0 primary-text-color template-selector-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Twitter Insight')}}</p>
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