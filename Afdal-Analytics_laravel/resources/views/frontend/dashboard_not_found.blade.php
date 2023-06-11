@extends('layout.userhead')
<head>
{{--  <title>{{__("Not Found")}}</title>--}}
<link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
</head>
<body class="dashboard-not-found">
@include('layout.usersidenav')
<div class="dashboard-not-found-main-content">
    <header class="dashboard-not-found-header">
        @include('tenant.components.user-block')
    </header>
    <div class="dashboard-not-found-error-block">
        <h2 class="dashboard-not-found-error-title font-54-lh-80-semi-bold">
            {{__("Error")}}
        </h2>
        <p class="dashboard-not-found-error-text font-24-lh-32-medium">
            {{__("Oops! Something went wrong, the page was not found. Please return back to the Home Screen and try to find again what you need.")}}
        </p>
        <a href="{{url('/dashboard')}}" class="dashboard-not-found-error-return-link orange-button">
            {{__("Return home")}}
        </a>
    </div>
    <div class="dashboard-not-found-image"></div>
</div>

@include('frontend.components.loader')

</body>
