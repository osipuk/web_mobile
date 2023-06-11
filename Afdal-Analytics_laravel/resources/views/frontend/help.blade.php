@extends('layout.userhead')
<body class="help-page">
@include('layout.usersidenav')
<div class="dashboard-not-found-main-content">
    <header class="dashboard-not-found-header">
        <h2 class="dashboard-pricing-title font-54-lh-114-medium">
            {{__("Help")}}
        </h2>
        @include('tenant.components.user-block')
    </header>
    <div class="support-knowledge-switcher">
        <a href="/dashboard/help" class="support-knowledge-support-link active font-24-lh-32-medium">
            {{__("Support")}}
        </a>
        <a href="/dashboard/knowledge-base" class="support-knowledge-base-link font-24-lh-32-medium">
            {{__("Knowledge Base")}}
        </a>
    </div>


</div>
</body>

