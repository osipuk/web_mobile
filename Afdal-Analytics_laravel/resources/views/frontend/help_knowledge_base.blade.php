@extends('layout.userhead')
<body class="help_knowledge_base">
@include('layout.usersidenav')

<div class="help_knowledge_base-main-content">
    <header class="help_knowledge_base-header">
        <h2 class="dashboard-pricing-title font-54-lh-114-medium">
            {{__("Help")}}
        </h2>
        @include('tenant.components.user-block')
    </header>
    <div class="support-knowledge-switcher">
        <a href="/dashboard/help" class="support-knowledge-support-link  font-24-lh-32-medium">
            {{__("Support")}}
        </a>
        <a href="/dashboard/knowledge-base" class="support-knowledge-base-link active font-24-lh-32-medium">
            {{__("Knowledge Base")}}
        </a>
    </div>
</div>

</body>

