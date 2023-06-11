@php
    $get_locale=checkLangaugeGlobaly();
@endphp
@if (!empty($social_accounts))
    @foreach($social_accounts as $account)
        @if(in_array($provider_name, ['instagram', 'facebook']))
            <div class="d-flex flex-row">
                <div class="connection-user-account">
                    <p class="connection-account-title">{{$account['full_name']}}</p>
                </div>
                <div class="d-flex flex-column ">
                    @foreach($account['page'] as $page)
                    <label role='button' for="account_form_{{$page['id']}}" class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                        <div style="width: 14px;height:14px;">
                            <input class="connection-account-radio position-relative" id="account_form_{{$page['id']}}" type="checkbox" name="connect[]" checked value="{{$page['id']}}">
                        </div>
                        <p class="m-0 connection-connector-page-name">{{ !empty($page['name']) ? $page['name'] : $page['provider_id'] }}</p>
                    </label>
                    @endforeach
                </div>
            </div>
        @elseif($provider_name == 'facebookAds')
            <div class="d-flex flex-row">
                <div class="connection-user-account">
                    <p class="connection-account-title">{{$account['full_name']}}</p>
                </div>
                <div class="d-flex flex-column">
                    @foreach($account['ads_account'] as $page)
                    <label role='button' for="account_form_{{$page['id']}}" class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                        <div style="width: 14px;height:14px;">
                            <input class="connection-account-radio position-relative" id="account_form_{{$page['id']}}" type="checkbox" name="connect[]" checked value="{{$page['id']}}">
                        </div>
                        <p class="m-0 connection-connector-page-name">{{ !empty($page['name']) ? $page['name'] : $page['provider_id'] }}</p>
                    </label>
                    @endforeach
                </div>
            </div>
        @elseif(in_array($provider_name, ['googleAnalytics', 'google-analytics-ua']))
            <div class="d-flex flex-row">
                <div class="connection-user-account">
                    <p class="connection-account-title">{{$account['full_name']}}</p>
                </div>
                <div class="d-flex flex-column">
                    @foreach($account['google_analytics_account'] as $page)
                        <p class="mb-1 connection-account-title">{{$page['name']}}</p>
                        @foreach($page['properties'] as $p)
                            @if(count($p['profiles'])>0)
                                <p class="mb-1 connection-account-title">{{$p['name']}}</p>
                                @foreach($p['profiles'] as $p_profile)
                                <label role='button' for="account_form_{{$p_profile['id']}}" class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                                    <div style="width: 14px;height:14px;">
                                        <input class="connection-account-radio position-relative" id="account_form_{{$p_profile['id']}}" type="checkbox" name="connect[]" checked value="{{$p_profile['id']}}">
                                    </div>
                                    <p class="m-0 connection-connector-page-name">{{ $p_profile['name'] }}</p>
                                </label>
                                @endforeach
                            @else
                                <label role='button' for="account_form_{{$p['id']}}" class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                                    <div style="width: 14px;height:14px;">
                                        <input class="connection-account-radio position-relative" id="account_form_{{$p['id']}}" type="checkbox" name="connect[]" checked value="{{$p['id']}}">
                                    </div>
                                    <p class="m-0 connection-connector-page-name">{{ $p['name'] }}</p>
                                </label>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        @elseif($provider_name == 'googleAds')
            <div class="d-flex flex-row">
                <div class="connection-user-account">
                    <p class="connection-account-title">{{!empty($account['full_name']) ? $account['full_name'] : $account['provider_id'] }}</p>
                </div>
                <div class="d-flex flex-column ">
                    @foreach($account['google_ads_account'] as $page)
                        <label role='button' for="account_form_{{$page['id']}}" class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                            <div style="width: 14px;height:14px;">
                                <input class="connection-account-radio position-relative" id="account_form_{{$page['id']}}" type="checkbox" name="connect[]" checked value="{{$page['id']}}">
                            </div>
                            <p class="m-0 connection-connector-page-name">{{ !empty($page['name']) ? $page['name'] : $page['provider_id'] }}</p>
                        </label>
                    @endforeach
                </div>
            </div>
        @else
            <div class="d-flex flex-row">
                <div class="connection-user-account">
                    <p class="connection-account-title">{{ $account['full_name']}}</p>
                </div>
                <div class="d-flex flex-column ">
                    <label role='button' for="account_form_{{$account['id']}}" class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                        <div style="width: 14px;height:14px;">
                            <input class="connection-account-radio position-relative" id="account_form_{{$account['id']}}" type="checkbox" name="connect[]" checked value="{{$account['id']}}">
                        </div>
                        <p class="m-0 connection-connector-page-name">{{ $account['full_name']}}</p>
                    </label>
                </div>
            </div>
        @endif
    @endforeach
@else
    @if($provider_name=='facebook')
    <button type="button" class=" bg-transparent d-flex flex-row justify-content-between align-items-center mx-auto my-3 add-connection-btn no-account-add-connection" onclick="fb_login();">
        <span>
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
        <p class="m-0 primary-text-color add-connection-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add connection')}}</p>
    </button>
    @elseif($provider_name == 'facebookAds')
    <button  type="button" class=" bg-transparent d-flex flex-row justify-content-between align-items-center mx-auto my-3 add-connection-btn no-account-add-connection" onclick="facebook_ads_login();">
        <span>
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
        <p class="m-0 primary-text-color add-connection-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add connection')}}</p>
    </button>
    @elseif($provider_name == 'instagram')
    <button  type="button" class=" bg-transparent d-flex flex-row justify-content-between align-items-center mx-auto my-3 add-connection-btn no-account-add-connection" onclick="instagram_login();">
        <span>
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
        <p class="m-0 primary-text-color add-connection-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add connection')}}</p>
    </button>
    @elseif($provider_name=='googleAnalytics'|| $provider_name=='google-analytics-ua')
    <button type="button" class=" bg-transparent d-flex flex-row justify-content-between align-items-center mx-auto my-3 add-connection-btn no-account-add-connection" onclick="googleAnalyticsLogin();">
        <span>
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
        <p class="m-0 primary-text-color add-connection-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add connection')}}</p>
    </button>
    @elseif($provider_name == 'googleAds')
    <button  type="button" class=" bg-transparent d-flex flex-row justify-content-between align-items-center mx-auto my-3 add-connection-btn no-account-add-connection" onclick="googleAdsLogin();">
        <span>
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
        <p class="m-0 primary-text-color add-connection-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add connection')}}</p>
    </button>
    @else
    <button  type="button" class=" bg-transparent d-flex flex-row justify-content-between align-items-center mx-auto my-3 add-connection-btn no-account-add-connection" onclick="twitter_login();">
        <span>
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
        <p class="m-0 primary-text-color add-connection-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add connection')}}</p>
    </button>
    @endif
@endif