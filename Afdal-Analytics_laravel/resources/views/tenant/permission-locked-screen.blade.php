@extends('layout.userhead')
@section('metahead')
    <title>{{__("No Permissions")}}</title>
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
@endsection
<body class="locked-page">
  <div class="locked-screen-content-wrapper">
      <header class="locked-header">
          <div class="locked-top">
            <h1 class="locked-screen-title font-54-lh-80-semi-bold">
              {{__('No Permission')}}
            </h1>
              <div class="settings-user-block">
                  @include('tenant.components.user-block')
              </div>
          </div>
          <p class='locked-subtitle font-24-lh-28-medium'>{{__('Your account doesn`t have required permissions')}}</p>
      </header>
      <div class='locked-screen-wrap'>
          <div class='locked-screen-link-wrap'>
              <a class="locked-screen-btn font-18-lh-21-regular"
                 href={{url('dashboard')}}
              >
                  {{__('To dashboard')}}
              </a>
          </div>
          <div class='locked-screen-img'></div>
      </div>
  </div>
</body>
