@extends('layout.userhead')
@section('metahead')

        <link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}"/>
@endsection
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
            <a href="{{url('support')}}" class="help-link font-24-lh-28-medium">{{__('Support')}}</a>
            <div class="help-orange-line"></div>
          </li>

          <li class="help-menu-item help-menu-item-knowladge">
            <a href="{{url('knowledge-base')}}" class="help-link font-24-lh-28-medium">{{__('Knowladge Base')}}</a>
            <div class="help-orange-line"></div>
          </li>
        </ul>
      </div>
    </header>
    <main>
      <div class='help-section'>
        <div class='help-support-ticket-sub'>
          <h3 class='font-24-lh-28-medium'>{{__('All Tickets Submitted')}}</h3>
          <div class='help-support-subtitle-row-wrap'>
            <div class='help-support-subtitle-row-search-wrap'>
              <input class='help-support-subtitle-row-input font-13-lh-20-medium' placeholder="{{__('Search Tickets')}}" type="text">
              <button class='help-support-subtitle-row-btn-search'>
                <div class='help-support-subtitle-row-btn-search-icon'></div>
              </button>
            </div>
            <div class='help-support-subtitle-row-text-wrap'>
              <p class='help-support-subtitle-row-text font-16-lh-19-medium'>{{__('Open Tickets')}}</p>
              <p class='font-26-lh-30-medium'>1</p>
            </div>
            <div class='help-support-subtitle-row-text-wrap'>
              <p class='help-support-subtitle-row-text font-15-lh-18-medium'>{{__('Closed Tickets')}}</p>
              <p class='font-26-lh-30-medium'>24</p>
            </div>

            <div class='help-support-subtitle-row-date-wrap'>
              <div class='help-support-subtitle-row-date-period-block'>
                <p class='help-support-subtitle-row-date-text font-13-lh-15-light' id='help-support-period-name'></p>
                <p class='font-13-lh-15-medium' id='help-support-selected-period'></p>
              </div>
              <div class='help-support-subtitle-row-date-icon'>
                <input class='help-support-subtitle-row-date-input' type="date" id="help-datetime-picker">
              </div>
            </div>
          </div>
          <div class='help-support-sheet-title-wrap'>
            <div class='help-support-sheet-title-wrap-wrap'>
              <p class='help-support-sheet-title-user font-18-lh-21-medium'>{{__('User ID')}}</p>
            <div class='help-support-sheet-title-icon'></div>
          </div>
          <div class='help-support-sheet-title-wrap-wrap'>
            <p class='help-support-sheet-title-ticket font-18-lh-21-medium'>{{__('Ticket Title')}}</p>
            <div class='help-support-sheet-title-icon'></div>
          </div>
          <div class='help-support-sheet-title-wrap-wrap'>
            <p class='help-support-sheet-title-date font-18-lh-21-medium'>{{__('Date Created')}}</p>
            <div class='help-support-sheet-title-icon'></div>
          </div>
          <div class='help-support-sheet-title-wrap-wrap'>
            <p class='help-support-sheet-title-activity font-18-lh-21-medium'>{{__('Last Activity')}}</p>
            <div class='help-support-sheet-title-icon'></div>
          </div>
          <div class='help-support-sheet-title-wrap-wrap'>
            <p class='help-support-sheet-title-status font-18-lh-21-medium'>{{__('Status')}}</p>
            <div class='help-support-sheet-title-icon'></div>
          </div>
        </div>
        <div class='help-support-sheet-wrap'>
          <div class='help-support-sheet-row'>
            <p class='help-support-sheet-row-user font-14-lh-16-light'>DH626EN602</p>
            <p class='help-support-sheet-row-ticket font-13-lh-15-medium'>{{__('Cannot sign in on my account after changing email address')}}</p>
            <p class='help-support-sheet-row-date font-14-lh-16-light'>26-08-2021</p>
            <p class='help-support-sheet-row-activity font-14-lh-16-light'>1 day ago</p>
            <button class='help-support-sheet-row-status font-14-lh-16-light' type='button'>{{__('OPEN')}}</button>
          </div>
          <div class='help-support-sheet-row'>
            <p class='help-support-sheet-row-user font-14-lh-16-light'>DH626EN602</p>
            <p class='help-support-sheet-row-ticket font-13-lh-15-medium'>{{__('Cannot sign in on my account after changing email address')}}</p>
            <p class='help-support-sheet-row-date font-14-lh-16-light'>26-08-2021</p>
            <p class='help-support-sheet-row-activity font-14-lh-16-light'>1 day ago</p>
            <button class='help-support-sheet-row-status btn-suc-green font-14-lh-16-light' type='button'>{{__('SUCCESSFUL')}}</button>
          </div>
          <div class='help-support-sheet-row'>
            <p class='help-support-sheet-row-user font-14-lh-16-light'>DH626EN602</p>
            <p class='help-support-sheet-row-ticket font-13-lh-15-medium'>{{__('Cannot sign in on my account after changing email address')}}</p>
            <p class='help-support-sheet-row-date font-14-lh-16-light'>26-08-2021</p>
            <p class='help-support-sheet-row-activity font-14-lh-16-light'>1 day ago</p>
            <button class='help-support-sheet-row-status btn-suc-green font-14-lh-16-light' type='button'>{{__('SUCCESSFUL')}}</button>
          </div>
          <div class='help-support-sheet-row'>
            <p class='help-support-sheet-row-user font-14-lh-16-light'>DH626EN602</p>
            <p class='help-support-sheet-row-ticket font-13-lh-15-medium'>{{__('Cannot sign in on my account after changing email address')}}</p>
            <p class='help-support-sheet-row-date font-14-lh-16-light'>26-08-2021</p>
            <p class='help-support-sheet-row-activity font-14-lh-16-light'>1 day ago</p>
            <button class='help-support-sheet-row-status btn-suc-green font-14-lh-16-light' type='button'>{{__('SUCCESSFUL')}}</button>
          </div>
          <div class='help-support-sheet-row'>
            <p class='help-support-sheet-row-user font-14-lh-16-light'>DH626EN602</p>
            <p class='help-support-sheet-row-ticket font-13-lh-15-medium'>{{__('Cannot sign in on my account after changing email address')}}</p>
            <p class='help-support-sheet-row-date font-14-lh-16-light'>26-08-2021</p>
            <p class='help-support-sheet-row-activity font-14-lh-16-light'>1 day ago</p>
            <button class='help-support-sheet-row-status btn-suc-green font-14-lh-16-light' type='button'>{{__('SUCCESSFUL')}}</button>
          </div>
        </div>
      </div>
      <button type="button" class="help-support-sheet-add-btn font-18-lh-21-regular">{{__('Open New Ticket')}}</button>
    </main>
  </div>
<!-- </div> -->

@include('frontend.components.loader')

</body>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>

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
    minDate: `${fullDateMinusThirty}`,
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
          setDateText(dateArr[0], dateArr[1], false);
          // TO DO: add request
        } else setDateText('', '', false);
    }]
  };
  setDateText(fullDateMinusThirty, newDate, true);
  flatpickr('#help-datetime-picker', options);

  function setDateText(from, to, isAppend) {
    const start = new Date(from);
    const end = new Date(to);
    const days = from && to ? ((end - start) / 1000 / 60 / 60 / 24) + 1 : 0;
    const periodName = `{{ __('Last :days days', ['days' => '${days}']) }}`;
    const period = from && to ? `{{ __(':from to :to', ['from' => '${from}', 'to' => '${to}']) }}` : '';
    if (isAppend) {
      document.querySelector('#help-support-period-name').append(periodName);
      document.querySelector('#help-support-selected-period').append(period);
    } else {
      $('#help-support-period-name').text(periodName);
      $('#help-support-selected-period').text(period);
    }
  }

</script>

  <script>
  const currentPath = location.pathname;
  const knowladgeItem = document.querySelector('.settings-menu-item-knowladge');
  const supportItem = document.querySelector('.help-menu-item-support');

  switch (currentPath) {
    case '/support':
      supportItem.classList.add('active');
    break;

    case '/knowledge-base':
      knowladgeItem.classList.add('active');
    break;

    default:
      break;
  }
</script>
