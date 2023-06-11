@extends('layout.v2.tenant.head')
@php
$get_locale=checkLangaugeGlobaly();
@endphp
@section('metahead')

<link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}" />
@endsection
@section('title', '__("User Team")')
@section('content')
<div class="loader d-none">
    <div class="loader-background"></div>
    <div class="loader-logo"></div>
    <p class="loader-text font-18-lh-22-regular">{{__('Loading...')}}</p>
</div>
<div class="page-wrapper chiller-theme toggled">
    @include('layout.v2.tenant.sidebar')
    <div id="main-section" class="w-100 addpaddingforhome">
        @include('layout.v2.tenant.header',['heading'=>__('Settings')])
        <div class="setting-header-tabs-links">
            <div class="mx-3 mx-sm-5 py-2 py-md-0">
                <div class="d-flex flex-row align-items-center setting-options-tabs">
                    <a href="{{url('dashboard/user-profile')}}" class="text-decoration-none setting-options-tab-normal">
                        {{__('Profile')}}
                    </a>
                    <a href="{{url('dashboard/user-billing')}}" class="text-decoration-none setting-options-tab-normal">
                        {{__('Billing')}}
                        
                    </a>
                    <a href="{{url('dashboard/user-team')}}" class="text-decoration-none primary-text-color setting-options-tab-active">
                        {{__('Users')}}
                        <div class="setting-active-bottom-line"></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="mx-3 mx-sm-5 py-4">
            <!-- start here -->
        </div>
    </div>
</div>
@endsection
