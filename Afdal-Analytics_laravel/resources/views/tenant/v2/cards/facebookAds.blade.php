<button type="button" onclick="openAddConnectionModal('facebookAds',true,'yes')" class="fbAds-connection-btn position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper @if(Auth::user() && Auth::user()->company->social_account_facebook_ads->isNotEmpty()) active-connection-wrapper @endif">
    <span>
        <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M50.3246 25.6499C50.3341 19.0561 47.7241 12.7285 43.0686 8.05896C38.4131 3.38939 32.0934 0.760336 25.4996 0.75C18.9059 0.760601 12.5865 3.38978 7.93118 8.05933C3.27589 12.7289 0.666008 19.0562 0.675563 25.6499C0.668931 31.5719 2.77438 37.3023 6.61362 41.8113C10.4529 46.3203 15.7742 49.3124 21.6216 50.25V32.85H15.3216V25.6499H21.6216V20.163C21.6216 13.922 25.3276 10.474 30.9986 10.474C32.8603 10.5001 34.7177 10.6628 36.5556 10.9609V17.089H33.4256C30.3416 17.089 29.3796 19.0089 29.3796 20.9779V25.6499H36.2646L35.1646 32.85H29.3756V50.25C35.2229 49.3124 40.5443 46.3203 44.3835 41.8113C48.2227 37.3023 50.3282 31.5719 50.3216 25.6499" fill="#1877F2" />
        </svg>
    </span>
    <p class="m-0 primary-text-color connector-primary-name">{{__('Facebook Ads')}}</p>
    <i class="position-absolute connection-active-tick @if(Auth::user() && Auth::user()->company->social_account_facebook_ads->isEmpty()) d-none @endif" style="@if($get_locale=='ar') right: auto;left: 10px; @endif">
        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.9993 2.16797C7.04102 2.16797 2.16602 7.04297 2.16602 13.0013C2.16602 18.9596 7.04102 23.8346 12.9993 23.8346C18.9577 23.8346 23.8327 18.9596 23.8327 13.0013C23.8327 7.04297 18.9577 2.16797 12.9993 2.16797ZM17.5494 11.1596L12.3493 16.3596C11.916 16.793 11.266 16.793 10.8327 16.3596L8.44935 13.9763C8.01602 13.543 8.01602 12.893 8.44935 12.4596C8.88268 12.0263 9.53268 12.0263 9.96602 12.4596L11.591 14.0846L16.0327 9.64297C16.466 9.20964 17.116 9.20964 17.5494 9.64297C17.9827 10.0763 17.9827 10.7263 17.5494 11.1596Z" fill="#2DA771" />
        </svg>
    </i>
</button>