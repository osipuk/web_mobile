@php
    $get_locale=checkLangaugeGlobaly();
@endphp
@if (count($social_accounts))
<div class="d-flex flex-column justify-content-between align-items-start select-connector-text-wrapper">
    <p class="p-0 select-connector-text primary-text-color @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="@if($get_locale=='ar') font-weight: 600; @endif">{{__('Select one of your connectors')}}</p>
</div>
<div class="d-flex flex-column justify-content-center align-items-start bg-white account-page-heading-wrapper">
    <div class="d-flex flex-row align-items-start account-page-heading-subwrapper">
        <p class="m-0 account-page-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="@if($get_locale=='ar') font-weight: 600; @endif">{{__('Account')}}</p>
        <p class="m-0 account-page-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="@if($get_locale=='ar') font-weight: 600; @endif">{{__('Pages')}}</p>
    </div>
</div>

<form  method="POST" id="dashboardForm" onsubmit="submitaddTemplate(event)">
    @csrf
    <input type="hidden" name="name" value="{{ $type }}">
    @foreach($social_accounts as $account)
        @if(in_array($account->provider_name, ['instagram', 'facebook']) && count($account->page))
        <div class="d-flex flex-row align-items-start template-connector-wrapper">
            <p class="m-0 template-account-name">{{ $account->full_name }}</p>
            <div class="d-flex flex-column align-items-start p-0" style="gap: 1px;">
                @foreach($account->page as $page)
                <label role='button' class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                    <div style="width: 14px;">
                        <input class="template-account-radio" type="radio" name="page_id" id="checkbox-button-{{$page->id}}" value="{{ $page->id }}" @if($page->id == $dashboard_page_id) checked @endif>
                    </div>
                    <p class="m-0 template-connector-page-name">{{ $page->name }}</p>
                </label>
                @endforeach
            </div>
        </div>
        @elseif($account->provider_name == 'facebookAds' && count($account->ads_account))
        <div class="d-flex flex-row align-items-start template-connector-wrapper">
            <p class="m-0 template-account-name">{{ $account->full_name }}</p>
            <div class="d-flex flex-column align-items-start p-0" style="gap: 1px;">
                @foreach($account->ads_account as $account)
                <label role='button' class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                    <div style="width: 14px;">
                        <input class="template-account-radio" type="radio" name="ads_account_id" id="checkbox-button-{{$account->id}}" value="{{ $account->id }}" @if($account->id == $dashboard_page_id) checked @endif>
                    </div>
                    <p class="m-0 template-connector-page-name">{{ $account->name }}</p>
                </label>
                @endforeach
            </div>
        </div>
        @elseif(in_array($account->provider_name, ['googleAnalytics', 'google-analytics-ua']) && count($account->google_analytics_account))
        <div class="d-flex flex-row align-items-start template-connector-wrapper">
            <p class="m-0 template-account-name">{{ $account->full_name }}</p>
            <div class="d-flex flex-column align-items-start p-0" style="gap: 1px;">
                @foreach($account->google_analytics_account as $gaAccount)
                    {{ $gaAccount->name }}
                    @foreach($gaAccount->properties as $property)
                        @if(!empty($propery->profiles))
                            {{ $property->name }}
                            @foreach($propery->profiles as $profile)
                            <label role='button' class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                                <div style="width: 14px;">
                                    <input class="template-account-radio" type="radio" name="google_analytics_profile_id" id="checkbox-button-{{$profile->id}}" value="{{ $profile->id }}" @if($profile->id == $dashboard_page_id) checked @endif>
                                </div>
                                <p class="m-0 template-connector-page-name">{{ $profile->name }}</p>
                            </label>
                            @endforeach
                        @else
                            <label role='button' class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                                <div style="width: 14px;">
                                    <input class="template-account-radio" type="radio" name="google_analytics_property_id" id="checkbox-button-{{$property->id}}" value="{{ $property->id }}" @if($property->id == $dashboard_page_id) checked @endif>
                                </div>
                                <p class="m-0 template-connector-page-name">{{ $property->name }}</p>
                            </label>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
        @elseif($account->provider_name == 'googleAds' && count($account->google_ads_account))
        <div class="d-flex flex-row align-items-start template-connector-wrapper">
            <p class="m-0 template-account-name ">{{ $account->full_name }}</p>
            <div class="d-flex flex-column align-items-start p-0" style="gap: 1px;">
                @foreach($account->google_ads_account as $adsAccount)
                <label role='button' class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                    <div style="width: 14px;">
                        <input class="template-account-radio" type="radio" name="google_ads_account_id" id="checkbox-button-{{$adsAccount->id}}" value="{{ $adsAccount->id }}" @if($adsAccount->id == $dashboard_page_id) checked @endif>
                    </div>
                    <p class="m-0 template-connector-page-name">{{ $adsAccount->name !== "" ?  $adsAccount->name : $adsAccount->provider_id}}</p>
                </label>
                @endforeach
            </div>
        </div>
        @else
        <div class="d-flex flex-row align-items-start template-connector-wrapper">
            <p class="m-0 template-account-name">{{ $account->full_name }}</p>
            <div class="d-flex flex-column align-items-start p-0" style="gap: 1px;">
                <label role='button' class="d-flex flex-row align-items-center p-0" style="gap: 7px;">
                    <div style="width: 14px;">
                        <input class="template-account-radio" type="radio" name="social_account_id" id="checkbox-button-{{$account->id}}" value="{{ $account->id }}" @if($account->id == $social_account_id) checked @endif>
                    </div>
                    <p class="m-0 template-connector-page-name">{{ $account->full_name }}</p>
                </label>
            </div>
        </div>
        @endif
    @endforeach
    <div class="d-flex flex-column justify-content-center align-items-center template-connect-wrapper">
        <button type="submit" class="border-0 d-flex flex-row justify-content-center align-items-center template-connect-button">
            <span class="template-connect-button-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Connect ')}}</span>
        </button>
    </div>
</form>
@else
<div class="d-flex flex-row justify-content-center align-items-center px-2 py-3" style="border-top: 0.5px solid #B6BECA;">
    <a href="{{url('/dashboard/connections?type=all')}}" class="@if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="color: #f58b1e;font-size: 14px;">{{__('Add New Connector')}}</a>
</div>
@endif