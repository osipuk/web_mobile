<button type="button" onclick="openAddConnectionModal('googleAnalytics',true,'yes')" class="ga-connection-btn position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper @if(Auth::user() && Auth::user()->company->social_account_google_analytics->isNotEmpty()) active-connection-wrapper @endif">
    <span>
        <svg width="43" height="50" viewBox="0 0 43 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="31.4817" width="11.4078" height="49" rx="5.70388" fill="#F9AB00" />
            <rect x="15.3208" y="18.8477" width="12.3584" height="30.1538" rx="6.1792" fill="#E37400" />
            <rect x="0.110352" y="37.6953" width="11.4078" height="11.3077" rx="5.65385" fill="#E37400" />
        </svg>
    </span>
    <p class="m-0 primary-text-color connector-primary-name">{{__('Google Analytics')}}</p>
    
    <i class="position-absolute connection-active-tick @if(Auth::user() && Auth::user()->company->social_account_google_analytics->isEmpty()) d-none @endif" style="@if($get_locale=='ar') right: auto;left: 10px; @endif">
        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.9993 2.16797C7.04102 2.16797 2.16602 7.04297 2.16602 13.0013C2.16602 18.9596 7.04102 23.8346 12.9993 23.8346C18.9577 23.8346 23.8327 18.9596 23.8327 13.0013C23.8327 7.04297 18.9577 2.16797 12.9993 2.16797ZM17.5494 11.1596L12.3493 16.3596C11.916 16.793 11.266 16.793 10.8327 16.3596L8.44935 13.9763C8.01602 13.543 8.01602 12.893 8.44935 12.4596C8.88268 12.0263 9.53268 12.0263 9.96602 12.4596L11.591 14.0846L16.0327 9.64297C16.466 9.20964 17.116 9.20964 17.5494 9.64297C17.9827 10.0763 17.9827 10.7263 17.5494 11.1596Z" fill="#2DA771" />
        </svg>
    </i>
</button>