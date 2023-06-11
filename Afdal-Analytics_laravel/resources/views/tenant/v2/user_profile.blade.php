@extends('layout.v2.tenant.head')
@php
$get_locale=checkLangaugeGlobaly();
@endphp
@section('metahead')

<link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}" />
@endsection
@section('title', '__("User Profile")')

@section('content')
<div class="loader" hidden>
    <div class="loader-background"></div>
    <div class="loader-logo"></div>
    <p class="loader-text font-18-lh-22-regular">{{__('Loading...')}}</p>
</div>
<div class="page-wrapper chiller-theme toggled">
    @include('layout.v2.tenant.sidebar')
    <div id="main-section" class="w-100 addpaddingforhome">
        @include('layout.v2.tenant.header',['heading'=>__('Settings')])
        <!-- Settings navbar -->
        <div class="mx-3 mx-sm-5 pb-4 pt-1 d-block d-md-none">
            <p class="m-0 primary-text-color template-page-heading-sm">{{__('Settings')}}</p>
        </div>
        <div class="mx-3 mx-sm-5 py-2 py-md-0">
            <div class="d-flex flex-row align-items-center setting-options-tabs">
                <a href="{{url('dashboard/user-profile')}}" class="text-decoration-none primary-text-color setting-options-tab-active">
                    {{__('Profile')}}
                    <div class="setting-active-bottom-line"></div>
                </a>
                <a href="{{url('dashboard/user-billing')}}" class="text-decoration-none setting-options-tab-normal">
                    {{__('Billing')}}
                </a>
                <a href="{{url('dashboard/user-team')}}" class="text-decoration-none setting-options-tab-normal">
                    {{__('Users')}}
                </a>
            </div>
        </div>
        {{-- page wrapper start --}}
        <div class="mx-3 mx-sm-5 py-4">
            <div class="row">
                <div class="col">
                    {{-- card setting start --}}
                    <div class="card shadow border-0 rounded p-5">
                        <div class="container">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="card__title pb-3">Account</div>
                                    <div class="card__image pb-3 position-relative"><img src="{!! asset('assets/v2/setting-images/profile.png')  !!}" alt="profile image">
                                        <div class="card__edit position-absolute"><img src="{!! asset('assets/v2/setting-images/edit-outline.png')  !!}" alt=""></div>

                                    </div>
                                </div>
                            </div>
                            {{-- form start --}}
                            <div class="row">
                                <div class="row gx-3 gy-1">
                                    <div class="col-md-6">
                                        <label for="formGroupExampleInput" class="form-label">First Name</label>
                                        <input type="text" class="form-control" placeholder="John" aria-label="First name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="formGroupExampleInput" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" placeholder="Doe" aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row gx-3 gy-1">
                                    <div class="col-md-6">

                                        {{-- Php Country start --}}
                                        @php
                                        if($get_locale=='ar'){
                                        $country_class='user-profile-select-item-ar';
                                        } else{
                                        $country_class='user-profile-select-item-en';
                                        }
                                        @endphp
                                        {{-- Php Country end --}}

                                        <label for="formGroupExampleInput" class="form-label">Country</label>
                                        <select class="form-select country" aria-label="Default select example">
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الجزائر">الجزائر</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="ساموا-الأمريكي">ساموا-الأمريكي</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="النمسا">النمسا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="البحرين">البحرين</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="بلجيكا">بلجيكا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="بلغاريا">بلغاريا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="كندا">كندا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="كرواتيا">كرواتيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="قبرص">قبرص</option>
                                            option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="التشيك">التشيك</>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الدنمارك">الدنمارك</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="مصر">مصر </option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="إستونيا">إستونيا</option>
                                            option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="فنلندا">فنلندا</>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="فرنسا">فرنسا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="ألمانيا">ألمانيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="اليونان">اليونان</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="المجر">المجر</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="العراق">العراق</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="إيطاليا">إيطاليا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الأردن">الأردن</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الكويت">الكويت</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="لاتفيا">لاتفيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="لبنان">لبنان</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="ليبيا">ليبيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="ليتوانيا">ليتوانيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="لوكسمبورغ">لوكسمبورغ</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="مالطا">مالطا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="موريتانيا">موريتانيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="المغرب">المغرب</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="هولندا">هولندا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="عُمان">عُمان</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="دولة فلسطين">دولة فلسطين</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="بولندا">بولندا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="البرتغال">البرتغال</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="قطر">قطر</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="رومانيا">رومانيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="السعودية">السعودية</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="سلوفاكيا">سلوفاكيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الصومال">الصومال</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="جنوب أفريقيا">جنوب أفريقيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="إسبانيا">إسبانيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="السويد">السويد</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="سوريا">سوريا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="تونس">تونس</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="تركيا">تركيا</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الإمارات العربية المتحدة">الإمارات
                                                العربية المتحدة</option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="الولايات المتحدة">الولايات المتحدة
                                            </option>
                                            <option class="user-profile-select-item font-15-lh-20-semi-bold {{$country_class}}" data-value="اليمن">اليمن</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="formGroupExampleInput" class="form-label">City</label>
                                        <input type="text" class="form-control" placeholder="City" aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row gx-3 gy-1">
                                    <div class="col-md-6">
                                        <label for="formGroupExampleInput" class="form-label">Street Adress</label>
                                        <input type="text" class="form-control" placeholder="Street Name 23B" aria-label="First name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="formGroupExampleInput" class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" placeholder="12345" aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row gx-3 gy-1">
                                    <div class="col">
                                        <label for="formGroupExampleInput" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" placeholder="+475 268 795" aria-label="First name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="formGroupExampleInput" class="form-label">Email</label>
                                        <input type="text" class="form-control" placeholder="email@company.com" aria-label="Last name">
                                    </div>
                                </div>
                                <div class="row gx-3 gy-1">
                                    <div class="col-md-6">

                                        {{-- Php GMT start --}}
                                        @php
                                        if($get_locale=='ar'){
                                        $country_class='user-profile-select-item-ar';
                                        } else{
                                        $country_class='user-profile-select-item-en';
                                        }
                                        @endphp
                                        {{-- Php end --}}

                                        <label for="formGroupExampleInput" class="form-label">Timezone</label>
                                        <select value="{{ $errors->has('timezone') ? old('timezone') :  $user->timezone }}" class="form-select GMT"
                                                aria-label="Default select example">
                                            <option {{$country_class}} selected>GMT</option>
                                            <option {{$country_class}} value="1">GMT+1:00</option>
                                            <option {{$country_class}} value="2">GMT+2:00</option>
                                            <option {{$country_class}} value="3">GMT+3:00</option>
                                            <option {{$country_class}} value="3">GMT+3:30</option>
                                            <option {{$country_class}} value="3">GMT+4:00</option>
                                            <option {{$country_class}} value="3">GMT+5:00</option>
                                            <option {{$country_class}} value="3">GMT+5:30</option>
                                            <option {{$country_class}} value="3">GMT+6:00</option>
                                            <option {{$country_class}} value="3">GMT+7:00</option>
                                            <option {{$country_class}} value="3">GMT+8:00</option>
                                            <option {{$country_class}} value="3">GMT+9:00</option>
                                            <option {{$country_class}} value="3">GMT+10:00</option>
                                            <option {{$country_class}} value="3">GMT+11:00</option>
                                            <option {{$country_class}} value="3">GMT+12:00</option>
                                            <option {{$country_class}} value="3">GMT-11:00</option>
                                            <option {{$country_class}} value="3">GMT-10:00</option>
                                            <option {{$country_class}} value="3">GMT-9:00</option>
                                            <option {{$country_class}} value="3">GMT-8:00</option>
                                            <option {{$country_class}} value="3">GMT-7:00</option>
                                            <option {{$country_class}} value="3">GMT-6:00</option>
                                            <option {{$country_class}} value="3">GMT-5:00</option>
                                            <option {{$country_class}} value="3">GMT-4:00</option>
                                            <option {{$country_class}} value="3">GMT-3:30</option>
                                            <option {{$country_class}} value="3">GMT-3:00</option>
                                            <option {{$country_class}} value="3">GMT-1:00</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="formGroupExampleInput" class="form-label">Website</label>
                                        <input type="text" class="form-control" placeholder="www.example.com" aria-label="Last name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="button" class="btn btn-primary mt-5 ms-auto">Save</button>
                            </div>
                            {{-- form end --}}
                        </div>
                    </div>
                    {{-- card setting end --}}
                </div>
                <div class="col d-none d-md-block">
                    <img class="setting__background" src="{!! asset('assets/v2/setting-images/setting-background.png')  !!}" alt="">
                </div>
            </div>

        </div>
        {{-- page wrapper end --}}
    </div>
</div>



@endsection
@section('js')
@endsection