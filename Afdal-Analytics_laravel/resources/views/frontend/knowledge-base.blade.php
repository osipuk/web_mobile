@extends('layout.userhead')
<head>
{{--  <title>{{__("Knowledge Base")}}</title>--}}
<link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}"/>
</head>
<body class="help-section-page">
@include('layout.usersidenav')
<div class="help-section-content-wrapper">
    <header class="help-header">
        <div class="help-top-bar">
            <h1 class="help-title font-54-lh-50-medium">
                {{__('Help')}}
            </h1>
            <div class="settings-user-block">
                @include('tenant.components.user-block')
            </div>
        </div>

        <div class="help-menu">
            <ul class="help-menu-list">
                <li class="help-menu-item help-menu-item-support">
                    <a href="{{url('support')}}"
                       class="help-link font-24-lh-28-medium"
                    >
                        {{__('Support')}}
                    </a>
                    <div class="help-orange-line"></div>
                </li>

                <li class="help-menu-item help-menu-item-knowladge">
                    <a href="{{url('knowledge-base')}}"
                       class="help-link font-24-lh-28-medium"
                    >
                        {{__('Knowladge Base')}}
                    </a>
                    <div class="help-orange-line"></div>
                </li>
                </li>
            </ul>
        </div>
    </header>
    <div class='help-knowladge-wrap'>
        <div>
            <label class='help-knowladge-label font-14-lh-16-light'>{{__('Advice and answers from the Team')}}</label>
            <div class='help-knowladge-search-wrap'>
                <input class='help-knowladge-input-search font-13-lh-20-medium' placeholder="{{__('Search')}}" type="text">
                <button class='help-knowladge-btn-search'><div class='help-knowladge-btn-search-icon'></div></button>
            </div>
            <div class='help-knowladge-content-wrap'>
                <ul class='help-knowladge-list'>
                    <li class='help-knowladge-item'>
                        <div class='help-knowladge-item-icon-wrap'>
                            <div class='help-knowladge-item-icon-Basics'></div>
                        </div>
                        <div class='help-knowladge-item-text-wrap'>
                            <h4 class='help-knowladge-item-text-title font-22-lh-25-medium'>{{__('Getting Started & The Basics')}}</h4>
                            <p class='help-knowladge-item-text font-14-lh-16-light'>{{__('Easy steps for setting up your Afdal Analytics account and learning your way around.')}}</p>
                        </div>
                    </li>
                    <li class='help-knowladge-item'>
                        <div class='help-knowladge-item-icon-wrap'>
                            <div class='help-knowladge-item-icon-Templates'></div>
                        </div>
                        <div class='help-knowladge-item-text-wrap'>
                            <h4 class='help-knowladge-item-text-title font-22-lh-25-medium'>{{__('Dashboards & Templates')}}</h4>
                            <p class='help-knowladge-item-text font-14-lh-16-light'>{{__('Learn how to visualize data, configure dashboards and use pre-configured templates that wow.')}}</p>
                        </div></li>
                    <li class='help-knowladge-item'>
                        <div class='help-knowladge-item-icon-wrap'>
                            <div class='help-knowladge-item-icon-Subscription'></div>
                        </div>
                        <div class='help-knowladge-item-text-wrap'>
                            <h4 class='help-knowladge-item-text-title font-22-lh-25-medium'>{{__('Managing Your Subscription')}}</h4>
                            <p class='help-knowladge-item-text font-14-lh-16-light'>{{__('Learn how to administrate your accounts, access invoices and more.')}}</p>
                        </div>
                    </li>
                    <li class='help-knowladge-item'>
                        <div class='help-knowladge-item-icon-wrap'>
                            <div class='help-knowladge-item-icon-Connections'></div>
                        </div>
                        <div class='help-knowladge-item-text-wrap'>
                            <h4 class='help-knowladge-item-text-title font-22-lh-25-medium'>{{__('Connections & Data')}}</h4>
                            <p class='help-knowladge-item-text font-14-lh-16-light'>{{__('Learn more about setting up connections in Afdal Analytics and how data is collected.')}}</p>
                        </div></li>
                    <li class='help-knowladge-item'>
                        <div class='help-knowladge-item-icon-wrap'>
                            <div class='help-knowladge-item-icon-User-Management'></div>
                        </div>
                        <div class='help-knowladge-item-text-wrap'>
                            <h4 class='help-knowladge-item-text-title font-22-lh-25-medium'>{{__('User Management')}}</h4>
                            <p class='help-knowladge-item-text font-14-lh-16-light'>{{__('Bring your staff on board and get them access to the insight to drive performance.')}}</p>
                        </div></li>
                </ul>
                {{-- <div class='help-knowladge-img'></div> --}}
            </div>
        </div>
        {{-- DETAILS INFO --}}

        <div id='modal' class='help-knowladge-details-wrap'>
            <div id='close' class='help-knowladge-details-close'></div>
            <div class='help-help-knowladge-details-scroll'>
                <ol class='help-help-knowladge-details-list'>
                    <li class='font-22-lh-25-medium'>{{__('Import your data')}}
                        <p class='help-knowladge-details-text font-16-lh-19-light'>{{__('Easy steps for setting up your Afdal Analytics account and learning your way around')}}</p>
                        <div class='help-knowladge-details-date-wrap'>
                            <p class='font-14-lh-16-light'>Jon Doe, 02-11-2021 {{__('Written by')}}</p>
                            <div class='help-knowladge-details-item-img'></div>
                        </div>
                    </li>
                    <hr class='help-knowladge-details-line'>
                    <li class='font-22-lh-25-medium'>{{__('Explore your data')}}
                        <p class='help-knowladge-details-text font-16-lh-19-light'>{{__('Easy steps for setting up your Afdal Analytics account and learning your way around')}}</p>
                        <div class='help-knowladge-details-date-wrap'>
                            <p class='font-14-lh-16-light'>Jon Doe, 02-11-2021 {{__('Written by')}}</p>
                            <div class='help-knowladge-details-item-img'></div>
                        </div>
                    </li>
                    <hr class='help-knowladge-details-line'>
                    <li class='font-22-lh-25-medium'>{{__('Map your data')}}
                        <p class='help-knowladge-details-text font-16-lh-19-light'>{{__('Easy steps for setting up your Afdal Analytics account and learning your way around')}}</p>
                        <div class='help-knowladge-details-date-wrap'>
                            <p class='font-14-lh-16-light'>Jon Doe, 02-11-2021 {{__('Written by')}}</p>
                            <div class='help-knowladge-details-item-img'></div>
                        </div>
                    </li>
                    <hr class='help-knowladge-details-line'>
                    <li class='font-22-lh-25-medium'>{{__('Use your data')}}
                        <p class='help-knowladge-details-text font-16-lh-19-light'>{{__('Easy steps for setting up your Afdal Analytics account and learning your way around')}}</p>
                        <div class='help-knowladge-details-date-wrap'>
                            <p class='font-14-lh-16-light'>Jon Doe, 02-11-2021 {{__('Written by')}}</p>
                            <div class='help-knowladge-details-item-img'></div>
                        </div>
                    </li>
                    <hr class='help-knowladge-details-line'>
                    <li class='font-22-lh-25-medium'>{{__('Leverage your positions')}}
                        <p class='help-knowladge-details-text font-16-lh-19-light'>{{__('Easy steps for setting up your Afdal Analytics account and learning your way around')}}</p>
                        <div class='help-knowladge-details-date-wrap'>
                            <p class='font-14-lh-16-light'>Jon Doe, 02-11-2021 {{__('Written by')}}</p>
                            <div class='help-knowladge-details-item-img'></div>
                        </div>
                    </li>
                </ol>
                {{-- <p class='font-18-lh-20-light'>Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. What we’ll cover Navigating Through Afdal Importing Your Data Exploring Your Data Exporting & Using Your Data When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources. Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data. This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table.
                   Under the headline "Data Source" you'll find the segmentations your raw data comes with.</p> --}}
            </div>
        </div>
    </div>
</div>
</body>

<script>
    const refs = {
        closeModalBtn: document.querySelector('#close'),
        // backClose: document.querySelector('#back'),
        modal: document.querySelector('#modal'),
    };
    function toggleModal() {
        refs.modal.classList.toggle('visually-hidden');
    };

    refs.closeModalBtn.addEventListener('click', toggleModal);
    // refs.backClose.addEventListener('click', toggleModal);
</script>
<script>
    const currentPath = location.pathname;
    const knowladgeItem = document.querySelector('.settings-menu-item-knowladge');
    // const supportItem = document.querySelector('.help-menu-item-support');

    switch (currentPath) {
        case '/knowledge-base':
            knowladgeItem.classList.add('active');
            break;

        // case '/support':
        //   supportItem.classList.add('active');
        // break;


        default:
            break;
    }
</script>
