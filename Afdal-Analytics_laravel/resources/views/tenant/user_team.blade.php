@extends('layout.userhead')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/confetti.css">
@section('css')

    @php

        $get_locale = NULL;

        if( null !== session()->get('locale') ):
            if(session()->get('locale') == 'en'):
                $get_locale = 'en';
            else:
                $get_locale = 'ar';
            endif;

        else:
                $get_locale = 'ar';
        endif;

    @endphp 

    @if($get_locale == 'en')
        <style type="text/css">
            .float-left{
                float: right!important;
            }
            .float-right{
                float: left!important;
            }

            .no-en-ml-24 {
                margin-left: 0px!important;
            }

            .text-align-left{
                text-align: right!important;
            }

            .text-align-right{
                text-align: left!important;
            }

            .text-align-left{
                text-align: right!important;
            }

            .mr-20-en{
                margin-right: 20px!important;
            }


            .mb-10-en{
                margin-bottom: 10px!important;
            }

            .w-10-en{
                width: 10%!important;
            }

            .order-2-en{
                order: 2!important;
            }

            .w-200px-en{
                width: 200px!important;
            }

            
        </style>
    @endif


    
@endsection





@section('metahead')
    <title>{{__("User Team")}}</title>
    <link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}"/>
@endsection
<body class="user-team-page">
@include('layout.usersidenav')
<div class="user-billing-content-wrapper">
    @include('tenant.components.settings-header')
    {{-- <div style="margin-top: 20px"> --}}
    {{-- </div> --}}
    <main class="user-team-main">
        {{-- USER-team-PAGE --}}

        <div class='user-team-main-wrap'>
            <div class='user-team-main-latest-item order-2-en'>
                <div class='user-team-main-last-active-wrap'>
                    <h3 class='font-24-lh-28-medium user-team-main-last-active-title'>{{__('Activity')}}</h3>
                    <div class='user-team-main-last-active-sheet-title-wrap'>
                        <h4 class='user-team-main-last-active-sheet-title-date font-18-lh-21-medium'>{{__('Date')}}</h4>
                        <h4 class='user-team-main-last-active-sheet-title-activity font-18-lh-21-medium'>{{__('Activity')}}</h4>
                        <h4 class='user-team-main-last-active-sheet-title-user font-18-lh-21-medium'>{{__('Users')}}</h4>
                    </div>
                    <ul class='user-team-main-last-activity-sheet-list'>
                        @foreach($activities as $activity)
                            <li class='user-team-main-last-active-sheet-item'>
                              <div class='user-team-main-last-active-green-circle'></div>
                              <div class='user-team-main-last-active-grey-line'></div>
                                <p class='user-team-main-last-active-sheet-item-text font-13-lh-15-regular'>{{$activity->date}}</p>
                                <p class='user-team-main-last-active-sheet-item-text-activity font-13-lh-15-regular'>{{$activity->message}}</p>
                                <p class='user-team-main-last-active-sheet-item-text-user font-13-lh-15-regular'>{{$activity->user}}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class='user-team-main-last-active-btn-wrap'>
                    <button id="latest-activity" class='user-team-main-last-active-btn font-18-lh-21-regular float-left mb-10-en'
                    type='button'>{{__('View All')}}</button>
                </div>

                {{--latest-activity-modal --}}
                <div id='latest-activity-modal' class="user-team-modal-latest visually-hidden">
                    <div id='backg-la' class="user-team-modal-background"></div>
                    <div class="latest-activity-modal-content">

                        {{-- Latest Activity --}}
                        <div class='user-team-modal-add-header-wrap'>
                            <div class='user-team-modal-header-month-wrap'>
                                <button id="last-month-activity" type="button" disabled class="user-team-modal-header-month-text">{{__("Last 1 Month")}}</button>
                                <div class='user-team-modal-header-month-icon'>
                                    <input class="activity-calendar-pop-up" type="date" id="datetime-picker">
                                </div>

                            </div>
                            <h3 class='user-team-add-title font-28-lh-42-semi-bold'>{{__('Latest Activity')}}</h3>
                            <button id="latest-activity-close" type="button" class="user-team-add-close"></button>
                        </div>
                        <hr class='user-team-modal-add-header-line'>
                        {{-- Latest Activity info --}}

                        <div id='forma'>
                            <div id='form' class='user-team-modal-latest-activity-wrap user-team-modal-latest-activity-wrap-first'>
                                <div>
                                    <p class='user-team-add-form-text text-ml font-14-lh-16-light'>{{__('Date')}}</p>
                                </div>
                                <div>
                                    <p class='user-team-add-form-text font-14-lh-16-light'>{{__('Activity')}}</p>
                                </div>
                                <div>
                                    <p class='user-team-add-form-text font-14-lh-16-light'>{{__('Users')}}</p>
                                </div>
                            </div>

                            <ul class='user-team-main-last-active-sheet-list'>
                                @foreach($activities as $activity)
                                    <li class='user-team-main-last-active-sheet-item'>
                                        <p class='user-team-main-last-active-sheet-item-text font-13-lh-15-regular'>{{$activity->date}}</p>
                                        <p class='user-team-main-last-active-sheet-item-text-activity font-13-lh-15-regular'>{{$activity->message}}</p>
                                        <p class='user-team-main-last-active-sheet-item-text-user font-13-lh-15-regular'>{{$activity->user}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class='user-team-main-team-details-wrap'>
                <h3 class='font-24-lh-28-medium user-team-main-team-details-title text-align-right'>{{__('Company Details')}}</h3>
                <p class='user-team-main-team-details-subtitle font-18-lh-21-medium text-align-right'>{{__('Users Assigned') . ' ' . $current_user_count . '/' . $max_user_count . ' '}}</p>
                <div class='user-team-main-team-details-info-wrap'>
                    <div class='user-team-main-team-details-infoMar'>
                        <p class='user-team-main-team-details-info font-16-lh-22-regular text-align-right'>{{Auth::user()->company->name}}</p>
                        <p class='user-team-main-team-details-info user-team-main-team-email font-16-lh-22-regular text-align-right'>{{Auth::user()->email}}</p>
                        <p class='user-team-main-team-details-info font-16-lh-22-regular text-align-right'>{{Auth::user()->role}}</p>
                        <p class='user-team-main-team-details-info font-16-lh-22-regular text-align-right'>{{Auth::user()->company_id}}</p>
                        <p class='user-team-main-team-details-info font-16-lh-22-regular text-align-right'>{{Auth::user()->created_at}}</p>
                    </div>
                    <div>
                        <p class='user-team-main-team-details-name font-18-lh-21-medium text-align-right w-200px-en'> {{__('Current team:')}} </p>
                        <p class='user-team-main-team-details-name font-18-lh-21-medium text-align-right w-200px-en'> {{__('Signed in as:')}} </p>
                        <p class='user-team-main-team-details-name font-18-lh-21-medium text-align-right w-200px-en'> {{__('Role')}}: </p>
                        <p class='user-team-main-team-details-name font-18-lh-21-medium text-align-right w-200px-en'> {{__('Company')}} ID: </p>
                        <p class='user-team-main-team-details-name font-18-lh-21-medium text-align-right w-200px-en'> {{__('Joined')}}: </p>
                    </div>
                </div>
            </div>
        </div>

        <section class='user-team-main-user-list-section'>
            <div>
                <div class='user-team-main-user-list'>
                    <div class='user-team-main-user-list-header'>
                        <h3 class='font-24-lh-32-medium w-10-en'>{{__('User List')}}</h3>
                        <div class='user-team-main-user-search-wrap'>
                            @if($get_locale == 'en')
                            <button class='user-team-main-user-list-btn-search' onclick="getCompanyUsers()">
                                <div class='user-team-main-user-list-btn-search-icon'></div>
                            </button>
                            <input class='user-team-main-user-list-input-search search' placeholder='{{__('Search')}}'
                                   name='filter' type="text">
                            @else
                            <input class='user-team-main-user-list-input-search search' placeholder='{{__('Search')}}'
                                   name='filter' type="text">
                            <button class='user-team-main-user-list-btn-search' onclick="getCompanyUsers()">
                                <div class='user-team-main-user-list-btn-search-icon'></div>
                            </button>
                            
                            @endif
                            
                        </div>
                    </div>
                    <div>
                        <div class='user-team-main-user-list-sheet-title-wrap'>
                            <p class='user-team-main-user-list-sheet-title-info font-18-lh-21-medium'>{{__('Personal Information')}}</p>
                            <p class='user-team-main-user-list-sheet-title-email font-18-lh-21-medium'>{{__('Email')}}</p>
                            <p class='user-team-main-user-list-sheet-title-position font-18-lh-21-medium'>{{__('Job Position')}}</p>
                            <p class='user-team-main-user-list-sheet-title-role font-18-lh-21-medium'>{{__('Role')}}</p>
                            <p class='user-team-main-user-list-sheet-title-date font-18-lh-21-medium'>{{__('Date Created')}}</p>
                            <p class='user-team-main-user-list-sheet-title-id font-18-lh-21-medium'>{{__('User ID')}}</p>
                            <p class='user-team-main-user-list-sheet-title-btn font-18-lh-21-medium'></p>
                        </div>

                        <div class='user-team-main-user-list-sheet' id="user-list">
                            {{--                        <div class='user-team-main-user-list-sheet-text-wrap'>--}}
                            {{--                            <p class='user-team-main-user-list-sheet-text-info font-14-lh-16-light'>John Doe</p>--}}
                            {{--                            <p class='user-team-main-user-list-sheet-text-email font-14-lh-16-light'>--}}
                            {{--                                namesurname@email.com</p>--}}
                            {{--                            <p class='user-team-main-user-list-sheet-text-position font-14-lh-16-light'>{{__('Manager')}}</p>--}}
                            {{--                            <p class='user-team-main-user-list-sheet-text-location font-14-lh-16-light'>Dubai</p>--}}
                            {{--                            <p class='user-team-main-user-list-sheet-text-role font-14-lh-16-light'>{{__('Admin')}}</p>--}}
                            {{--                            <p class='user-team-main-user-list-sheet-text-date font-14-lh-16-light'>25-06-2021 21:20</p>--}}
                            {{--                            <p class='user-team-main-user-list-sheet-text-id font-14-lh-16-light'>DH626EN602</p>--}}

                            {{--                            <div class='user-team-main-last-user-list-text-btn '>--}}
                            {{--                                <div class='user-team-main-user-list-sheet-text-del'></div>--}}
                            {{--                                <div class='user-team-main-user-list-sheet-text-set'></div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                        </div>

                    </div>
                </div>
                <div class='user-team-main-user-list-btn-wrap'>
                    <button id='addNewUser' {{!$add_new_user ? 'disabled' : ''}}
                    class='user-team-main-user-list-sheet-btn font-18-lh-21-regular mb-10-en float-left {{!$add_new_user ? 'disabled' : ''}}'>{{__('Add New User')}}
                        <span class="add-user-popover-wrap"><span class="add-user-popover-wrap-content">{{__('You used all limit users. Upgrade your plan')}} <a
                                    style="color: #FF9A41" href="{{url('/pricing')}}">{{__('now')}}</a>.</span></span>
                    </button>
                </div>
            </div>
        </section>
        {{-- USER-team-MODAL --}}
        <div id='modal' class="user-team-modal">
            <div class="user-team-modal-content">
                {{-- <div class='user-team-modal-header-wrap'>
                  <h3 class='user-team-title font-28-lh-42-semi-bold'>{{__('Activity')}}</h3>
                        <button id="close" type="button" class="user-team-modal-close"></button>
                        <div class='user-team-modal-header-month-wrap'>
                          <p class="user-team-modal-header-month-text font-16-lh-26-medium" >{{__('Last 1 Month')}}</p>
                          <div class='user-team-modal-header-month-icon'></div>
                        </div>
                      </div> --}}

                {{-- ADD MORE USERS --}}
                <div class='user-team-modal-add-header-wrap'>
                    <h3 class='user-team-add-title font-28-lh-42-semi-bold'>{{__('Add More Users')}}</h3>
                    <button id="close" type="button" class="user-team-add-close"></button>
                </div>


                {{-- <hr>
                <table class='user-team-modal-table'>
                  <thead>
                    <tr class='user-team-modal-table-head-row'>
                      <th class='user-team-modal-table-head-left font-17-lh-20-medium'>Date</th>
                      <th class='user-team-modal-table-head-midl font-17-lh-20-medium'>Activity</th>
                      <th class='user-team-modal-table-head-right font-17-lh-20-medium'>User</th>
                    </tr>
                  </thead>
          <tbody>
            <tr class='user-team-modal-table-field-wrap'>
              <td class='user-team-modal-table-field field-left font-13-lh-15-regular'>25-06-2021</td>
              <td class='user-team-modal-table-field field-midl font-13-lh-15-regular'>Monthly Base Subscription Payment</td>
              <td class='user-team-modal-table-field field-right font-13-lh-15-regular'>John Doe</td>
            </tr>
            <tr class='user-team-modal-table-field-wrap'>
              <td class='user-team-modal-table-field field-left font-13-lh-15-regular'>25-06-2021</td>
              <td class='user-team-modal-table-field field-midl font-13-lh-15-regular'>Monthly Base Subscription Payment</td>
              <td class='user-team-modal-table-field field-right font-13-lh-15-regular'>John Doe</td>
            </tr>
            <tr class='user-team-modal-table-field-wrap'>
              <td class='user-team-modal-table-field field-left font-13-lh-15-regular'></td>
              <td class='user-team-modal-table-field field-midl font-13-lh-15-regular'></td>
              <td class='user-team-modal-table-field field-right font-13-lh-15-regular'></td>
            </tr>
          </tbody>
          </table> --}}
                {{-- ADD MORE USERS --}}

                <div>
                    <div id='forma'>
                        <div id='form' class='user-team-modal-add-form-wrap user-team-modal-add-form-wrap-first'>
                            <div>
                                <p class='user-team-add-form-text font-14-lh-16-light'>{{__('Role')}}</p>
                                <select class='user-team-add-form-select role' name='role' id="select-role">
                                    <option class=' font-15-lh-20-semi-bold' value="Member"
                                            selected>{{__('Member')}}</option>
                                    <option class=' font-15-lh-20-semi-bold' value="Admin"
                                    >{{__('Admin')}}</option>
                                    <option class=' font-15-lh-20-semi-bold' value="Owner">{{__('Owner')}}</option>
                                </select>
                            </div>
                            <div>
                                <p class='user-team-add-form-text font-14-lh-16-light'>{{__('Email')}}</p>
                                <input type="text" class='user-team-add-form-input email font-15-lh-32-regular'
                                       name='email'
                                       data-rule="email"
                                       placeholder="namesurname@email.com">
                                <div class="center-error"><p class="error-p" id="email-message"></p></div>
                            </div>
                            <div>
                                <p class='user-team-add-form-text font-14-lh-16-light'>{{__('Full Name')}}</p>
                                <input type="text" class='user-team-add-form-input name font-15-lh-32-regular'
                                       name='name'
                                       data-rule="name"
                                       placeholder="{{__('John Doe')}}">
                                <div class="center-error"><p class="error-p" id="name-message"></p></div>
                            </div>
                        </div>
                    </div>
                    <div class='user-team-add-form-btn-wrap'>
                        <button class='user-team-add-form-btn-sub font-18-lh-21-regular mb-4'
                                onclick="addUsers()">{{__('Confirm')}}</button>

{{--                        <button id='add' type='button' class='user-team-add-form-btn-add-wrap'>--}}
{{--                            <div class='user-team-add-form-btn-icon'></div>--}}
{{--                            <p class=' font-13-lh-20-medium'>{{__('Add more users')}}</p>--}}
{{--                        </button>--}}
                    </div>
                </div>

            </div>
        </div>

        <div class='loader-wrap'>
            <div id="main-loader" class="preloader">
                <div class="heartbeat">
                    <div class="loading"></div>
                    <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>
                </div>
            </div>
        </div>

    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let date_from = @if(!empty($date_from)) "{{$date_from}}" @else null @endif;
    let date_to = @if(!empty($date_to)) '{{$date_to}}' @else null @endif;
    const locale = '{{Lang::getLocale()}}';
    const date = new Date();
    const year = date.getFullYear().toString();
    const month = (date.getMonth() + 1).toString().padStart(2, 0);
    const day = date.getDate().toString().padStart(2, 0);
    const newDate = `${year}/${month}/${day}`;

    const thirtyDaysMs = 1000 * 60 * 60 * 24 * (30 - 1);
    const minusThirty = date - thirtyDaysMs;

    const fullDate = new Date(minusThirty);

    const year1 = fullDate.getFullYear().toString();
    const month1 = (fullDate.getMonth() + 1).toString().padStart(2, 0);
    const day1 = fullDate.getDate().toString().padStart(2, 0);
    const fullDateMinusThirty = `${year1}/${month1}/${day1}`;

    const options = {
        mode: "range",
        maxDate: `${newDate}`,
        defaultDate: [`${newDate}`, `${fullDateMinusThirty}`],
        dateFormat: "Y/m/d",
        locale: {
            weekdays: {
                shorthand: [
                    '{{__("Sun")}}', '{{__("Mon")}}', '{{__("Tue")}}',
                    '{{__("Wed")}}', '{{__("Thu")}}', '{{__("Fri")}}', '{{__("Sat")}}'
                ],
                longhand: [
                    '{{__("Sunday")}}', '{{__("Monday")}}', '{{__("Tuesday")}}',
                    '{{__("Wednesday")}}', '{{__("Thursday")}}', '{{__("Friday")}}', '{{__("Saturday")}}'
                ],
            },
            months: {
                shorthand: [
                    '{{__("Jan")}}', '{{__("Feb")}}', '{{__("Mar")}}', '{{__("Apr")}}', '{{__("May")}}',
                    '{{__("Jun")}}', '{{__("Jul")}}', '{{__("Aug")}}', '{{__("Sep")}}', '{{__("Oct")}}',
                    '{{__("Nov")}}', '{{__("Dec")}}'
                ],
                longhand: [
                    '{{__("January")}}', '{{__("February")}}', '{{__("March")}}', '{{__("April")}}', '{{__("May")}}',
                    '{{__("June")}}', '{{__("July")}}', '{{__("August")}}', '{{__("September")}}', '{{__("October")}}',
                    '{{__("November")}}', '{{__("December")}}'
                ]
            }
        },
        onChange: [function(selectedDates){
            const dateArr = selectedDates.map(date => this.formatDate(date, "Y/m/d"));
            if (dateArr.length === 2) {
                $.ajax({
                    url: '{{url('/dashboard/get-activities')}}' + '?date_from='+dateArr[0]+'&date_to='+dateArr[1],
                    method: "get",
                    dataType: 'json',
                    success: (response) => {
                        $('.user-team-main-last-active-sheet-list').html('')
                        let activities = response.activities;
                        if (activities.length > 0) {
                            console.log(activities)
                            activities.forEach(function (item) {
                                $('.user-team-main-last-active-sheet-list').append("" +
                                    "<li class='user-team-main-last-active-sheet-item'>" +
                                    "<p class='user-team-main-last-active-sheet-item-text font-13-lh-15-regular'>" + +item.date+ "</p>" +
                                    "<p class='user-team-main-last-active-sheet-item-text-activity font-13-lh-15-regular'>" + item.message + "</p>" +
                                    "<p class='user-team-main-last-active-sheet-item-text-user font-13-lh-15-regular'>" + item.user + "</p>" +
                                    "</li>");
                            })
                        }
                        else{
                            $('.user-team-main-last-active-sheet-list').append("<li class='user-team-main-last-active-sheet-item'>" + "{{__('No activities on the given dates')}}" + "</li>")
                        }
                        if(response.date_from && response.date_to){
                            setDateText(response.date_from, response.date_to)
                        }
                    }
                })
            }
        }]
    };
    flatpickr('#datetime-picker', options);
    function setDateText(from, to){
        const start = new Date(from);
        const end = new Date(to);
        //const days = from && to ? Math.round(((end - start) / 1000 / 60 / 60 / 24)) + 1 : 0;
        //const periodName = `{{ __('Last :days days', ['days' => '${days}']) }}`;
        const period = from && to ? `{{ __(':from to :to', ['from' => '${from}', 'to' => '${to}']) }}` : '';
        $('#last-month-activity').text(period);
    }
    let name_valid_message = "{{__('Please, enter your name')}}";
    let email_valid_message = "{{__('Please, enter a valid email')}}";


    let inputs = document.querySelectorAll('input[data-rule]');
    let name_message = document.getElementById("name-message");
    let email_message = document.getElementById("email-message");
    let validate_interaval = false;

    for (let input of inputs) {
        input.addEventListener('keyup', function () {
            if(validate_interaval)
                clearTimeout(validate_interaval);
            validate_interaval = setTimeout(()=>{
            let rule = this.dataset.rule;
            let value = this.value;
            let check;

            switch (rule) {
                case "name":
                    check = /^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z ]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]*$/.test(value);
                    if(!check){
                        name_message.classList.add('user-padding-p');
                        name_message.textContent = name_valid_message;
                    }
                    break;
                case "email":
                    // check = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value);
                    check = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))+$/.test(value);
                    if(!check){
                        email_message.classList.add('user-padding-p');
                        email_message.textContent = name_valid_message;
                    }
                    break;
            }

            this.classList.remove('invalid');
            this.classList.remove('valid');

            if (check) {
                this.classList.add('valid');
                email_message.classList.remove('user-padding-p');
                name_message.classList.remove('user-padding-p');

                name_message.textContent = '';
                email_message.textContent = '';
            } else {
                this.classList.add('invalid');
            }
            validate_interaval = false;
        }, 1000);

        });
    }



    const localization = @if(!empty($localization)) "{{$localization}}" @else null @endif;

    document.body.onload = function () {
        const preloader = document.getElementById('main-loader');
        if (!preloader.classList.contains('done')) {
            preloader.classList.add('done');
        }
        getCompanyUsers();
    };
    function getRoleWithLang(role){
        switch (role) {
            case 'Social Media Manager':
                return 'أخصائي سوشال ميديا';
            case 'Marketing Manager':
                return 'مدير التسويق';
            case 'Developer':
                return 'مطور';
            case 'Analyst':
                return 'المحلل';
            default:
                return role;
        }
    }

    function getCompanyUsers() {
        let search = $('.search').val();
        let url_param = search != null && search !== '' ? '?search=' + search : '';
        $.ajax({
            url: '{{url('company-members')}}' + url_param,
            method: "get",
            dataType: 'json',
            success: (response) => {
                $('#user-list').html('')
                let users = response.users;
                if (users.length > 0) {
                    users.forEach(function (item) {
                        let role = item.role;
                        if(localization === 'ar'){
                            role = getRoleWithLang(item.role)
                        }
                        let full_name = item.first_name + ' ' + item.last_name;
                        $('#user-list').append("<div class='user-team-main-user-list-sheet-text-wrap'>" +
                            "<div>" +
                            "<p class='user-team-main-user-list-sheet-text-info font-14-lh-16-light'>" + full_name + "</p>" +
                            "<p class='user-team-main-user-list-sheet-text-info font-14-lh-16-light permission' onclick='managePermissions(" + item.id + ")'>" + "{{__('Manage Permissions')}}" + "</p>" +
                            "</div>" +
                            "<p class='user-team-main-user-list-sheet-text-email font-14-lh-16-light'>" + item.email + "</p>" +
                            "<p class='user-team-main-user-list-sheet-text-position font-14-lh-16-light'>" + role + "</p>" +
                            // "<p class='user-team-main-user-list-sheet-text-location font-14-lh-16-light'>" + (item.country ? item.country : '') + "</p>" +
                            "<p class='user-team-main-user-list-sheet-text-role font-14-lh-16-light'>" +  role  + "</p>" +
                            "<p class='user-team-main-user-list-sheet-text-date font-14-lh-16-light'>" + item.created_at + "</p>" +
                            "<p class='user-team-main-user-list-sheet-text-id font-14-lh-16-light'>" + item.id + "</p>" +
                            "<div class='user-team-main-last-user-list-text-btn '>" +
                            '<div class="user-team-main-user-list-sheet-text-del" onclick="removeMember(' + item.id + ', \'' + full_name + '\')"></div>' +
                            "<div class='user-team-main-user-list-sheet-text-set'></div>" +
                            "</div></div>");
                    })
                }
            }
        })
    }

    function managePermissions(id) {
        window.location.href = '/user-permissions-manage/' + id;
    }

    function removeMember(id, full_name) {
        var result = confirm("Remove " + full_name + " from company");
        if (result) {
            $.ajax({
                url: '{{url('')}}' + '/remove-members/' + id,
                method: "get",
                dataType: 'json',
                success: (response) => {
                    getCompanyUsers();
                    toastr.success('{{__('Member removed successfully')}}');
                }
            })
        }
    }

    let id = 0
    let counter = 0;

    // close modal
    const refs = {
        closeModalBtn: document.querySelector('#close'),
        modalU: document.querySelector('#modal'),
        openModal: document.querySelector('#addNewUser'),
        closeActivity_modalBtn: document.querySelector('#latest-activity-close'),
        activity_modal: document.querySelector('#latest-activity-modal'),
        add: document.querySelector('#add'),
        del: document.querySelector(`#n${id}`),
        openLatestActivityModal: document.querySelector('#latest-activity'),
        form: document.querySelector("#form"),
        forma: document.querySelector('#forma')
    };

    function toggleActivityModal() {
        refs.activity_modal.classList.toggle('visually-hidden');
    };

    function toggleModal(item) {
        //item.classList.toggle('visually-hidden');
        item.style.display='none';
    };

    refs.openModal.onclick = function() {
        refs.modalU.style.display='block';
        //refs.modalU.classList.toggle('visually-hidden');
    }

    refs.closeModalBtn.onclick = function() {
        refs.modalU.style.display = 'none'
    }

    window.onclick = function(e) {
        if(e.target == refs.modalU){
            refs.modalU.style.display = 'none'
        }
    }

    function checkLatestActivity() {
        refs.activity_modal.classList.remove('visually-hidden');
    };


    refs.openLatestActivityModal.addEventListener('click', checkLatestActivity);
    refs.closeActivity_modalBtn.addEventListener('click', toggleActivityModal);
    // refs.modal.addEventListener('click', function(e){
    //     if(e.target == refs.modal){
    //         refs.modal.classList.toggle('visually-hidden');
    //     }
    // })
    refs.activity_modal.addEventListener('click', function(e){
        if(e.target == refs.activity_modal){
            refs.activity_modal.classList.toggle('visually-hidden');
        }
    })
    // refs.backClose.addEventListener('click', toggleModal);


    function clone() {
        let newFormUser = `
    <div id='form${id}' class='user-team-modal-add-form-wrap'>
      <button id='n${id}' class='user-team-modal-add-form-del' type='button'></button>
      <div>
        <p class='user-team-add-form-text font-14-lh-16-light'>{{__('Role')}}</p>
        <select class='user-team-add-form-select role' name='role' id="">
          <option class=' font-15-lh-20-semi-bold' value="Member" selected>{{__('Member')}}</option>
          <option class=' font-15-lh-20-semi-bold' value="Admin">{{__('Admin')}}</option>
          <option class=' font-15-lh-20-semi-bold' value="Owner">{{__('Owner')}}</option>
          </select>
  </div>
  <div>
    <p class='user-team-add-form-text font-14-lh-16-light'>{{__('Email')}}</p>
    <input type="text" class='user-team-add-form-input email font-15-lh-32-regular' name='email'  placeholder="namesurname@email.com">
    </div>
    <div>
      <p class='user-team-add-form-text font-14-lh-16-light'>{{__('Full Name')}}</p>
      <input type="text" class='user-team-add-form-input name font-15-lh-32-regular' name='name' placeholder="{{__('John Doe')}}">
      </div>
      </div>`
        const formRow = document.createElement('div')
        formRow.innerHTML = newFormUser;
        refs.forma.append(formRow);
        const findBtn = document.querySelector(`#n${id}`);
        findBtn.addEventListener('click', remove);
        id++;
        counter++;
    }

    function handleClick(e) {
        if (counter >= 6) {
            refs.add.classList.add('visually-hidden');
        }
    }

    refs.add.addEventListener('click', handleClick)


    function remove(event) {
        event.currentTarget.parentElement.remove();
        counter--;
        if (counter <= 6) {
            refs.add.classList.remove('visually-hidden');
        }
    }

    refs.add.addEventListener('click', clone)

    function checkAbilityAddUser() {
        let result = false;
        $.ajax({
            url: '{{url('/check-add-members')}}',
            method: "get",
            async: false,
            success: function (data) {
                result = data.status;
            }
        })
        return result;
    };

     function addUsers() {
        let submit = document.querySelector('.user-team-add-form-btn-sub');
        submit.disabled = true;
        submit.classList.add('disabled');
        if (checkAbilityAddUser()) {
            let usersList = [];
            let allNameFields = document.querySelectorAll(".user-team-add-form-input.name");
            let allEmailFields = $(".user-team-add-form-input.email");
            let allJobPositionFields = $(".user-team-add-form-select.role");

            allNameFields.forEach((field, index) => {
                usersList.push({
                    name: field.value,
                    email: allEmailFields[index].value,
                    profession: allJobPositionFields[index].value,
                })
            })
            $.ajax({
                url: '{{url('add-members')}}',
                method: "post",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    members: usersList,
                },
                dataType: 'json',
                success: (response) => {
                    allNameFields[0].value = '';
                    allEmailFields[0].value = '';
                    status = response.status;
                    message = response.message;

                    if(status === 'success') {
                        toastr.success(message);
                    } else if(status === 'fail'){
                        toastr.warning(message);
                    } else {
                        toastr.warning('{{__("error")}}');
                    }
                    toggleModal(refs.modalU);
                    submit.disabled = false;
                    submit.classList.remove('disabled');
                }
            })
        } else {
            toggleModal(refs.modalU);
            submit.disabled = false;
            submit.classList.remove('disabled');
            toastr.warning('{{__("You used all limit users. Upgrade your plan.")}}');
        }
    }
</script>

</body>
