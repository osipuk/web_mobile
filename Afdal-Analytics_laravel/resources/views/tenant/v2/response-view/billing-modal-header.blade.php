<div class="px-3 px-sm-5">
    <div class="py-4 manage-subscription-header">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
            <button data-bs-dismiss="modal" class=" border-0 bg-transparent d-flex flex-row align-items-center justify-content-between manage-subscription-back-wrapper">
                <span style="@if($get_locale=='ar') transform: scaleX(-1); @endif">
                    <svg width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.9951 7.89544V10.0624H4.16012L10.1201 16.0184L8.58012 17.5584L0.000118256 8.97844L8.58012 0.398438L10.1201 1.93644L4.16212 7.89444L25.9951 7.89544Z" fill="#F58B1E" />
                    </svg>
                </span>
                <p class="m-0 manage-subscription-back @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back')}}</p>
            </button>
            <div class="text-center mt-3 mt-md-0 w-100">
                <p class="m-0 primary-text-color manage-subscription-modal-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{$header}}</p>
            </div>
            <div class="d-none d-md-inline">
                <button type="button" data-bs-dismiss="modal" class="border-0 bg-transparent">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.87015 0.957347C2.34177 0.428968 1.48509 0.428968 0.956715 0.957347C0.428336 1.48573 0.428336 2.3424 0.956715 2.87078L13.0341 14.9482C13.5625 15.4765 14.4192 15.4765 14.9475 14.9482C15.4759 14.4198 15.4759 13.5631 14.9475 13.0347L2.87015 0.957347Z" fill="#F58B1E" />
                        <path d="M15.0405 1.05228C15.1678 1.17738 15.269 1.3266 15.3381 1.49123C15.4071 1.65585 15.4427 1.83259 15.4427 2.01112C15.4427 2.18964 15.4071 2.36638 15.3381 2.53101C15.269 2.69563 15.1678 2.84485 15.0405 2.96995L2.90229 14.9554C2.64315 15.2098 2.29454 15.3523 1.93143 15.3523C1.56832 15.3523 1.21972 15.2098 0.960574 14.9554C0.833886 14.8302 0.733342 14.6811 0.664785 14.5167C0.596227 14.3524 0.561023 14.176 0.561221 13.9979C0.561418 13.8198 0.597012 13.6435 0.665934 13.4793C0.734856 13.3151 0.835731 13.1662 0.962697 13.0413L13.0959 1.04945C13.3556 0.794628 13.705 0.652102 14.0688 0.652632C14.4326 0.653161 14.7816 0.796702 15.0405 1.05228Z" fill="#F58B1E" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>