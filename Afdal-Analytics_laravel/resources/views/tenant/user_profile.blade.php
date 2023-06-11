@extends('layout.userhead')
@section('metahead')
    <title>{{__("User Profile")}}</title>
    <link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}"/>
@endsection
<body class="user-profile-page">
  @include('layout.usersidenav')
  <div class="user-billing-content-wrapper">
    @include('tenant.components.settings-header')
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
    <main class="user-profile-main">
      <div class="user-profile-form-block">
        <p class="user-profile-account-name font-24-lh-28-medium">
          {{__('Account')}}
        </p>

        <form action="{{url('/dashboard/update-profile')}}" method="POST" enctype="multipart/form-data" class="user-profile-form">
            @csrf
          <div class="user-profile-image-block">
            <img src="{{url('/assets/' . !empty(Auth::user()->image) && Auth::user()->image !== null && Auth::user()->image !== '' ? 'storage/images/' . Auth::user()->image  : 'assets/image_new/default-avatar.svg')}}" alt="User image" class="user-profile-image" >
            <label class="user-profile-change-image-button">
              <input
                hidden
                type="file"
                name="image"
                id="image-picker"
                accept="image/png, image/jpeg"
              >
            </label>
          </div>

          <div class="user-profile-form-part">
            <div class="user-profile-input-wrapper">
              <p class="user-profile-input-name font-14-lh-16-light">
                {{__('Last Name')}} <span class='user-profile-star'>*</span>
              </p>
              <input class="user-profile-input font-15-lh-32-regular"
                type="text"
                name="last_name"
                maxlength="30"
                placeholder="{{__('Enter your last name')}}"
                 value="{{ $errors->has('last_name') ? old('last_name') :  $user->last_name }}"
              >
                @error('last_name')
                <div class="center-error"><p class="error-p-user-page user-padding-p">{{__($message)}}</p></div>
                {{--                    <div class="tooltip edit-error font-16-lh-19-regular validation-page">{{__($message)}}</div>--}}
                @enderror
            </div>

            <div class="user-profile-input-wrapper">
              <p class="user-profile-input-name font-14-lh-16-light">
                {{__('First Name')}} <span class='user-profile-star'>*</span>
              </p>
              <input class="user-profile-input font-15-lh-32-regular"
                  type="text"
                  name="first_name"
                  maxlength="30"
                  placeholder="{{__('Enter your name')}}"
                 value="{{ $errors->has('first_name') ? old('first_name') :  $user->first_name }}"
                >
                @error('first_name')
                <div class="center-error"><p class="error-p-user-page user-padding-p">{{__($message)}}</p></div>
                {{--                    <div class="tooltip edit-error font-16-lh-19-regular validation-page">{{__($message)}}</div>--}}
                @enderror
            </div>
          </div>

          <div class="user-profile-form-part">
            <div class="user-profile-input-wrapper">
              <p class="user-profile-input-name font-14-lh-16-light">
                {{__('Country')}}
              </p>

              <div class="user-profile-select-input @if($get_locale=='ar') user-profile-select-input-ar @else user-profile-select-input-en @endif hidden " id="country-picker">
                <input class="user-profile-input"
                  type="hidden"
                  name="country"
                  id="country-input"
                  value="{{ $errors->has('country') ? old('country') :  $user->country }}"
                  placeholder="{{__('Pick your country')}}"
                >

                <p class="user-profile-select-value font-15-lh-32-semi-bold"
                  id="country-displayed-value"
                ></p>
                @php
                if($get_locale=='ar'){
                  $country_class='user-profile-select-item-ar';
                }  else{
                  $country_class='user-profile-select-item-en';
                }  
                @endphp
                <div class="user-profile-select-list-wrapper">
                  <ul class="user-profile-select-list" id="countries-list" >
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الجزائر">الجزائر</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="ساموا-الأمريكي">ساموا-الأمريكي</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="النمسا">النمسا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="البحرين">البحرين</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="بلجيكا">بلجيكا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="بلغاريا">بلغاريا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="كندا">كندا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="كرواتيا">كرواتيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="قبرص">قبرص</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="التشيك">التشيك</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الدنمارك">الدنمارك</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="مصر">مصر </li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="إستونيا">إستونيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="فنلندا">فنلندا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="فرنسا">فرنسا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="ألمانيا">ألمانيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="اليونان">اليونان</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="المجر">المجر</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="العراق">العراق</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="إيطاليا">إيطاليا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الأردن">الأردن</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الكويت">الكويت</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="لاتفيا">لاتفيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="لبنان">لبنان</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="ليبيا">ليبيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="ليتوانيا">ليتوانيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="لوكسمبورغ">لوكسمبورغ</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="مالطا">مالطا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="موريتانيا">موريتانيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="المغرب">المغرب</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="هولندا">هولندا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="عُمان">عُمان</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="دولة فلسطين">دولة فلسطين</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="بولندا">بولندا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="البرتغال">البرتغال</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="قطر">قطر</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="رومانيا">رومانيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="السعودية">السعودية</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="سلوفاكيا">سلوفاكيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الصومال">الصومال</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="جنوب أفريقيا">جنوب أفريقيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="إسبانيا">إسبانيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="السويد">السويد</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="سوريا">سوريا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="تونس">تونس</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="تركيا">تركيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الولايات المتحدة">الولايات المتحدة</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="اليمن">اليمن</li>
                      {{-- <li class="user-profile-select-item font-15-lh-20-semi-bold">(Algeria) الجزائر</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(American Samoa) ساموا-الأمريكي</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Austria) النمسا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Bahrain) البحرين</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Belgium) بلجيكا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Bulgaria) بلغاريا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Canada) كندا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Croatia) كرواتيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Cyprus) قبرص</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Czech Republic) التشيك</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Denmark) الدنمارك</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Egypt) مصر </li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Estonia) إستونيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Finland) فنلندا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(France) فرنسا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Germany) ألمانيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Greece) اليونان</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Hungary) المجر</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Iraq) العراق</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Italy) إيطاليا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Jordan) الأردن</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Kuwait) الكويت</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Latvia) لاتفيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Lebanon) لبنان</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Libya) ليبيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Lithuania) ليتوانيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Luxembourg) لوكسمبورغ</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Malta) مالطا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Mauritania) موريتانيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Morocco) المغرب</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Netherlands) هولندا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Oman) عُمان</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Palestine) دولة فلسطين</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Poland) بولندا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Portugal) البرتغال</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Qatar) قطر</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Romania) رومانيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Saudi Arabia) السعودية</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Slovakia) سلوفاكيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Somalia) الصومال</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(South Africa) جنوب أفريقيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Spain) إسبانيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Sweden) السويد</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Syria) سوريا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Tunisia) تونس</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Turkey) تركيا</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(United Arab Emirates) الإمارات العربية المتحدة</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(United States) الولايات المتحدة</li>
                      <li class="user-profile-select-item font-15-lh-20-semi-bold">(Yemen) اليمن</li> --}}
                  </ul>
                </div>
              </div>
            </div>

            <div class="user-profile-input-wrapper">
              <p class="user-profile-input-name font-14-lh-16-light">
                {{__('City')}} 
              </p>
              <input class="user-profile-input font-15-lh-32-regular"
                type="text"
                name="city"
                maxlength="20"
                placeholder="{{__('Enter your city')}}"
                 value="{{ $errors->has('city') ? old('city') :  $user->city }}"
              >
                @error('city')
                <div class="center-error user-prof-center"><p class="error-p-user-page user-padding-p">{{__($message)}}</p></div>
{{--                    <div class="tooltip edit-error font-16-lh-19-regular validation-page">{{__($message)}}</div>--}}
                @enderror
            </div>
          </div>

          <div class="user-profile-form-part">
            <div class="user-profile-input-wrapper">
              <p class="user-profile-input-name font-14-lh-16-light">
                {{__('Street Address')}} 
              </p>
              <input class="user-profile-input font-15-lh-32-regular"
                type="text"
                name="address"
                maxlength="30"
                placeholder="{{__('Enter your address')}}"
                 value="{{ $errors->has('address') ? old('address') :  $user->address }}"
              >
                @error('address')
                <div class="center-error user-prof-center"><p class="error-p-user-page user-padding-p">{{__($message)}}</p></div>
{{--                <div class="tooltip edit-error font-16-lh-19-regular validation-page">{{__($message)}}</div>--}}
                @enderror
            </div>

            <div class="user-profile-input-wrapper">
              <p class="user-profile-input-name font-14-lh-16-light">
                {{__('Postal Code')}} 
              </p>
              <input class="user-profile-input font-15-lh-32-regular"
                type="text"
                name="postal_code"
                maxlength="12"
                placeholder="{{__('Enter your postal code')}}"
                 value="{{ $errors->has('postal_code') ? old('postal_code') :  $user->postal_code }}"
              >
                @error('postal_code')
                <div class="center-error user-prof-center"><p class="error-p-user-page user-padding-p">{{__($message)}}</p></div>
{{--                <div class="tooltip edit-error font-16-lh-19-regular validation-page">{{__($message)}}</div>--}}
                @enderror
            </div>
          </div>

          <div class="user-profile-form-part">
            <div class="user-profile-input-wrapper">
              <p class="user-profile-input-name font-14-lh-16-light">
                {{__('Phone Number')}} 
              </p>
              <input class="user-profile-input font-15-lh-32-regular"
                type="text"
                name="phone"
                maxlength="20"
                placeholder="{{__('Enter your phone')}}"
                 value="{{ $errors->has('phone') ? old('phone') :  $user->phone }}"
              >
                @error('phone')
                <div class="center-error user-prof-center"><p class="error-p-user-page user-padding-p">{{__($message)}}</p></div>
{{--                <div class="tooltip edit-error font-16-lh-19-regular edit-error validation-page">{{__($message)}}</div>--}}
                @enderror
            </div>

            <div class="user-profile-input-wrapper">
              <p class="user-profile-input-name font-14-lh-16-light">
                {{__('Email')}} <span class='user-profile-star'>*</span>
              </p>
              <input class="user-profile-input font-15-lh-32-regular"
                type="text"
                readonly
                disabled
                maxlength="30"
                placeholder="{{__('Enter your email')}}"
                value="{{$user->email}}"
              >
              {{--value="{{ $errors->has('email') ? old('email') :  $user->email }} --}}
                @error('email')
                <div class="center-error"><p class="error-p-user-page user-padding-p">{{__($message)}}</p></div>
                {{--                <div class="tooltip edit-error font-16-lh-19-regular edit-error validation-page">{{__($message)}}</div>--}}
                @enderror
            </div>
          </div>

          <div class="user-profile-form-part">

            <div class="user-profile-input-wrapper">
              <p class="user-profile-input-name font-14-lh-16-light">
                {{__('Timezone')}}
              </p>

              <div class="user-profile-select-input @if($get_locale=='ar') user-profile-select-input-ar @else user-profile-select-input-en @endif hidden" id="timezone-picker">
                <input class="user-profile-input"
                  type="hidden"
                  name="timezone"
                  id="timezone-input"
                   value="{{ $errors->has('timezone') ? old('timezone') :  $user->timezone }}"
                >

                <p class="user-profile-select-value font-15-lh-32-semi-bold"
                  id="timezone-displayed-value"
                ></p>

                <div class="user-profile-select-list-wrapper">
                  <ul class="user-profile-select-list"
                    id="timezones-list"
                  >
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+1:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+2:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+3:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+3:30
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+4:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+5:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+5:30
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+6:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+7:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+8:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+9:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+9:30
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+10:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+11:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT+12:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-11:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-10:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-9:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-8:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-7:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-6:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-5:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-4:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-3:30
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-3:00
                    </li>
                    <li class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}">
                      GMT-1:00
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="user-profile-input-wrapper">
              <p class="user-profile-input-name font-14-lh-16-light">
                {{__('Website')}}
              </p>
              <input class="user-profile-input font-15-lh-32-regular"
                type="text"
                name="website"
                maxlength="30"
                placeholder="{{__('Enter your website')}}"
                 value="{{ $errors->has('website') ? old('website') :  $user->website }}"
              >
                @error('website')
                <div class="center-error"><p class="error-p-user-page user-padding-p">{{__($message)}}</p></div>
                {{--                <div class="tooltip edit-error font-16-lh-19-regular edit-error validation-page">{{__($message)}}</div>--}}
                @enderror
            </div>
          </div>
            <div class="user-profile-submit-button-container">
                <button class="user-profile-submit-button font-20-lh-45-regular" type="submit">
                    {{__('Save')}}
                </button>
            </div>
        </form>
      </div>
    </main>
  </div>

@include('frontend.components.loader')


</body>
<script>
    var success = '{{ session()->get('success') }}';

    // document.body.onload = function () {
        setTimeout(function () {
            if (success) {
                
                toastr.success('{{__('Profile updated successfully')}}');

                @php
                    request()->session()->forget('success');
                @endphp
            }
        }, 1000);
    // };
</script>
<script>
  // Elements

  const countryPicker = document.querySelector('#country-picker');
  const timezonePicker = document.querySelector('#timezone-picker');
  const countryInput = document.querySelector('#country-input');
  const timezoneInput = document.querySelector('#timezone-input');
  const countryDisplayedValue = document
    .querySelector('#country-displayed-value');
  const timezoneDisplayedValue = document
    .querySelector('#timezone-displayed-value');
  const countryList = document.querySelector('#countries-list');
  const timezoneList = document.querySelector('#timezones-list');
  const allDropDownItems = document.querySelectorAll('.user-profile-select-item');
  const imagePicker = document.querySelector('#image-picker');
  const userImage = document.querySelector('.user-profile-image');

  // Event listeners

  imagePicker.addEventListener('change', imageChangeHandler)
  countryPicker.addEventListener('click', selectorClickHandler);
  timezonePicker.addEventListener('click', selectorClickHandler);

  // Handlers

  function imageChangeHandler(event) {
    userImage.src = URL.createObjectURL(event.target.files[0]);
  }

  function selectorClickHandler(event) {
    event.currentTarget.classList.toggle('hidden');

    setTimeout(() => {
      body.addEventListener('click', bodyClickHandler);
    }, 0);

    if (
      event.target.classList.contains('user-profile-select-item')
    ) {

      event.currentTarget.firstElementChild.value = event.target.innerText;

      showSelected();
    }
  }

  function bodyClickHandler(event) {
    if (!event.target.closest('.user-profile-select-input')) {
      countryPicker.classList.add('hidden');
      timezonePicker.classList.add('hidden');

      body.removeEventListener('click', bodyClickHandler);
    }
  }

  // Sets selected values to displayed elements

  function showSelected() {
    if (!countryInput.value.length) {
      countryDisplayedValue.innerText = `{{__('Pick your country')}}`;
    } else {
      countryDisplayedValue.innerText = countryInput.value;
    }

    if (!timezoneInput.value.length) {
      timezoneDisplayedValue.innerText = `{{__('Pick your timezone')}}`;
    } else {
      timezoneDisplayedValue.innerText = timezoneInput.value;
    }

    allDropDownItems.forEach(item => {
      item.classList.remove('active');

      if (countryInput.value === item.innerText) {
        item.classList.add('active');

        return;
      }

      if (timezoneInput.value === item.innerText) {
        item.classList.add('active');
      }
    });
  }

  // Set selected values at page load

  showSelected();

</script>
