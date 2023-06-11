@php
$get_locale=checkLangaugeGlobaly();
@endphp
{{--<div class="invite-modal-row d-flex flex-column g-15">
    <div class="d-flex flex-row g-17 justify-content-between align-items-center g-21" style="width: 907px;height: 32px;">
        <div class="d-flex flex-row justify-content-between align-items-center g-32">
            <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Name')}}</p>
            <input name="name[]" required type="text" placeholder="{{__('Name')}}" class="bg-white invite-member-textbox invite-input name">
        </div>
        <div class="d-flex flex-row justify-content-between align-items-center g-36">
            <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Email ')}}</p>
            <input name="email[]" required type="text" placeholder="namesurname@email.com" class="bg-white invite-member-textbox invite-input email">
        </div>
        <div class="d-flex flex-row justify-content-between align-items-center g-10">
            <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Job Title')}}</p>
            <input name="job_position[]" required type="text" placeholder="{{__('Job Title')}}" class="bg-white invite-member-textbox invite-input job-title">
        </div>
    </div>
    <div class="d-flex flex-row g-17 align-items-center g-21" style="width: 907px;">
        <div class="d-flex flex-row justify-content-between align-items-center g-14">
            <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Location')}}</p>
            <select name="location[]" required class="bg-white invite-member-textbox invite-input location">
                <option value="">{{__('Location')}}</option>
                <option value="الجزائر">الجزائر</option>
                <option value="ساموا-الأمريكي">ساموا-الأمريكي</option>
                <option value="النمسا">النمسا</option>
                <option value="البحرين">البحرين</option>
                <option value="بلجيكا">بلجيكا</option>
                <option value="بلغاريا">بلغاريا</option>
                <option value="كندا">كندا</option>
                <option value="كرواتيا">كرواتيا</option>
                <option value="قبرص">قبرص</option>
                <option value="التشيك">التشيك</option>
                <option value="الدنمارك">الدنمارك</option>
                <option value="مصر">مصر </option>
                <option value="إستونيا">إستونيا</option>
                <option value="فنلندا">فنلندا</option>
                <option value="فرنسا">فرنسا</option>
                <option value="ألمانيا">ألمانيا</option>
                <option value="اليونان">اليونان</option>
                <option value="المجر">المجر</option>
                <option value="العراق">العراق</option>
                <option value="إيطاليا">إيطاليا</option>
                <option value="الأردن">الأردن</option>
                <option value="الكويت">الكويت</option>
                <option value="لاتفيا">لاتفيا</option>
                <option value="لبنان">لبنان</option>
                <option value="ليبيا">ليبيا</option>
                <option value="ليتوانيا">ليتوانيا</option>
                <option value="لوكسمبورغ">لوكسمبورغ</option>
                <option value="مالطا">مالطا</option>
                <option value="موريتانيا">موريتانيا</option>
                <option value="المغرب">المغرب</option>
                <option value="هولندا">هولندا</option>
                <option value="عُمان">عُمان</option>
                <option value="دولة فلسطين">دولة فلسطين</option>
                <option value="بولندا">بولندا</option>
                <option value="البرتغال">البرتغال</option>
                <option value="قطر">قطر</option>
                <option value="رومانيا">رومانيا</option>
                <option value="السعودية">السعودية</option>
                <option value="سلوفاكيا">سلوفاكيا</option>
                <option value="الصومال">الصومال</option>
                <option value="جنوب أفريقيا">جنوب أفريقيا</option>
                <option value="إسبانيا">إسبانيا</option>
                <option value="السويد">السويد</option>
                <option value="سوريا">سوريا</option>
                <option value="تونس">تونس</option>
                <option value="تركيا">تركيا</option>
                <option value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</option>
                <option value="الولايات المتحدة">الولايات المتحدة</option>
                <option value="اليمن">اليمن</option>
            </select>
        </div>
        <div class="d-flex flex-row justify-content-between align-items-center g-43">
            <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Role ')}}</p>
            <select name="role[]" required class="bg-white invite-member-textbox invite-input role">
                <option value="">{{__('Role ')}}</option>
                <option value="Member">{{__('Member')}}</option>
                <option value="Admin">{{__('Admin')}}</option>
                <option value="Owner">{{__('Owner')}}</option>
            </select>
        </div>
        <button type="button" onclick="$(this).closest(\'.invite-modal-row\').remove();window.usersCount--;alerted = false" class="border-0 bg-white d-flex flex-row justify-content-between align-items-center g-10">
            <p class="m-0 primary-text-color invite-memeber-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g id="icon_24x_Trash" data-name="icon/24x/Trash" transform="translate(-140 -705)">
                        <g id="Boundary" transform="translate(140 705)" fill="#0b243a" stroke="rgba(0,0,0,0)" stroke-width="1" opacity="0">
                            <rect width="24" height="24" stroke="none" />
                            <rect x="0.5" y="0.5" width="23" height="23" fill="none" />
                        </g>
                        <g id="Group_57517" data-name="Group 57517" transform="translate(-25 -3)">
                            <path id="Path_1347" data-name="Path 1347" d="M20.684,5.789V4.526A2.526,2.526,0,0,0,18.158,2H10.579A2.526,2.526,0,0,0,8.053,4.526V5.789H4.263a1.263,1.263,0,0,0,0,2.526H5.526V22.211A3.789,3.789,0,0,0,9.316,26H19.421a3.789,3.789,0,0,0,3.789-3.789V8.316h1.263a1.263,1.263,0,1,0,0-2.526ZM18.158,4.526H10.579V5.789h7.579Zm2.526,3.789H8.053V22.211a1.263,1.263,0,0,0,1.263,1.263H19.421a1.263,1.263,0,0,0,1.263-1.263Z" transform="translate(163 706)" fill="#f58b1e" fill-rule="evenodd" />
                            <path id="Path_1348" data-name="Path 1348" d="M9,9h2.526V19.105H9Z" transform="translate(164.579 707.842)" fill="#f58b1e" />
                            <path id="Path_1349" data-name="Path 1349" d="M13,9h2.526V19.105H13Z" transform="translate(165.632 707.842)" fill="#f58b1e" />
                        </g>
                    </g>
                </svg>
            </p>
            <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Remove')}}</p>
        </button>
    </div>
</div>--}}
<div class="invite-modal-row d-flex flex-column g-15">
    <div class="d-flex flex-row g-17 justify-content-between align-items-center g-21" style="width: 907px;height: 32px;">
        <div>
            <div class="name-div d-flex flex-row justify-content-between align-items-center g-32">
                <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Name')}}</p>
                <input name="name[]" oninput="onFieldInput('name', this)" onblur="onFieldBlur('name', this)" required type="text" placeholder="{{__('Name')}}" class="bg-white invite-member-textbox invite-input name">
            </div>
            <p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>
        </div>
        <div>
            <div class="email-div d-flex flex-row justify-content-between align-items-center g-36">
                <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Email ')}}</p>
                <input name="email[]" oninput="onFieldInput('email', this)" onblur="onFieldBlur('email', this)" required type="email" placeholder="namesurname@email.com" class="bg-white invite-member-textbox invite-input email">
            </div>
            <p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>
        </div>
        <div>
            <div class="job-div d-flex flex-row justify-content-between align-items-center g-10">
                <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Job Title')}}</p>
                <input name="job_position[]" oninput="onFieldInput('job_position', this)" onblur="onFieldBlur('job_position', this)" required type="text" placeholder="Manager" class="bg-white invite-member-textbox invite-input job-title">
            </div>
            <p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>
        </div>
    </div>
    <div class="d-flex flex-row g-17 align-items-center g-21" style="width: 907px;/*height: 32px;*/">
        <div>
            <div class="location-div d-flex flex-row justify-content-between align-items-center g-14"  style="@if($get_locale=='ar') gap:28px @endif">
                <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Location')}}</p>
                <select name="location[]" oninput="onFieldInput('job_position', this)" onblur="onFieldBlur('job_position', this)" required class="bg-white invite-member-textbox invite-input location">
                    <option value="">{{__('Location')}}</option>
                    <option value="الجزائر">الجزائر</option>
                    <option value="ساموا-الأمريكي">ساموا-الأمريكي</option>
                    <option value="النمسا">النمسا</option>
                    <option value="البحرين">البحرين</option>
                    <option value="بلجيكا">بلجيكا</option>
                    <option value="بلغاريا">بلغاريا</option>
                    <option value="كندا">كندا</option>
                    <option value="كرواتيا">كرواتيا</option>
                    <option value="قبرص">قبرص</option>
                    <option value="التشيك">التشيك</option>
                    <option value="الدنمارك">الدنمارك</option>
                    <option value="مصر">مصر </option>
                    <option value="إستونيا">إستونيا</option>
                    <option value="فنلندا">فنلندا</option>
                    <option value="فرنسا">فرنسا</option>
                    <option value="ألمانيا">ألمانيا</option>
                    <option value="اليونان">اليونان</option>
                    <option value="المجر">المجر</option>
                    <option value="العراق">العراق</option>
                    <option value="إيطاليا">إيطاليا</option>
                    <option value="الأردن">الأردن</option>
                    <option value="الكويت">الكويت</option>
                    <option value="لاتفيا">لاتفيا</option>
                    <option value="لبنان">لبنان</option>
                    <option value="ليبيا">ليبيا</option>
                    <option value="ليتوانيا">ليتوانيا</option>
                    <option value="لوكسمبورغ">لوكسمبورغ</option>
                    <option value="مالطا">مالطا</option>
                    <option value="موريتانيا">موريتانيا</option>
                    <option value="المغرب">المغرب</option>
                    <option value="هولندا">هولندا</option>
                    <option value="عُمان">عُمان</option>
                    <option value="دولة فلسطين">دولة فلسطين</option>
                    <option value="بولندا">بولندا</option>
                    <option value="البرتغال">البرتغال</option>
                    <option value="قطر">قطر</option>
                    <option value="رومانيا">رومانيا</option>
                    <option value="السعودية">السعودية</option>
                    <option value="سلوفاكيا">سلوفاكيا</option>
                    <option value="الصومال">الصومال</option>
                    <option value="جنوب أفريقيا">جنوب أفريقيا</option>
                    <option value="إسبانيا">إسبانيا</option>
                    <option value="السويد">السويد</option>
                    <option value="سوريا">سوريا</option>
                    <option value="تونس">تونس</option>
                    <option value="تركيا">تركيا</option>
                    <option value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</option>
                    <option value="الولايات المتحدة">الولايات المتحدة</option>
                    <option value="اليمن">اليمن</option>
                </select>
            </div>
            <p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>
        </div>
        <div>
            <div class="role-div d-flex flex-row justify-content-between align-items-center g-43" style="@if($get_locale=='ar') gap: 47px; @endif">
                <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" >{{__('Role ')}}</p>
                <select name="role[]" oninput="onFieldInput('job_position', this)" onblur="onFieldBlur('job_position', this)" required class="bg-white invite-member-textbox invite-input role">
                    <option value="">{{__('Role ')}}</option>
                    <option value="Member">{{__('Member')}}</option>
                    <option value="Admin">{{__('Admin')}}</option>
                    <option value="Owener">{{__('Owner')}}</option>
                </select>
            </div>
            <p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>
        </div>
        <button type="button" onclick="$(this).closest(\'.invite-modal-row\').remove();window.usersCount--;alerted = false" class="border-0 bg-white d-flex flex-row justify-content-between align-items-center g-10">
            <p class="m-0 primary-text-color invite-memeber-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g id="icon_24x_Trash" data-name="icon/24x/Trash" transform="translate(-140 -705)">
                        <g id="Boundary" transform="translate(140 705)" fill="#0b243a" stroke="rgba(0,0,0,0)" stroke-width="1" opacity="0">
                            <rect width="24" height="24" stroke="none" />
                            <rect x="0.5" y="0.5" width="23" height="23" fill="none" />
                        </g>
                        <g id="Group_57517" data-name="Group 57517" transform="translate(-25 -3)">
                            <path id="Path_1347" data-name="Path 1347" d="M20.684,5.789V4.526A2.526,2.526,0,0,0,18.158,2H10.579A2.526,2.526,0,0,0,8.053,4.526V5.789H4.263a1.263,1.263,0,0,0,0,2.526H5.526V22.211A3.789,3.789,0,0,0,9.316,26H19.421a3.789,3.789,0,0,0,3.789-3.789V8.316h1.263a1.263,1.263,0,1,0,0-2.526ZM18.158,4.526H10.579V5.789h7.579Zm2.526,3.789H8.053V22.211a1.263,1.263,0,0,0,1.263,1.263H19.421a1.263,1.263,0,0,0,1.263-1.263Z" transform="translate(163 706)" fill="#f58b1e" fill-rule="evenodd" />
                            <path id="Path_1348" data-name="Path 1348" d="M9,9h2.526V19.105H9Z" transform="translate(164.579 707.842)" fill="#f58b1e" />
                            <path id="Path_1349" data-name="Path 1349" d="M13,9h2.526V19.105H13Z" transform="translate(165.632 707.842)" fill="#f58b1e" />
                        </g>
                    </g>
                </svg>
            </p>
            <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Remove')}}</p>
        </button>
    </div>
</div>





// $.ajax({
        //     url: '{{url('/get-add-user-html')}}',
        //     method: "get",
        //     async: false,
        //     success: function (data) {
        //         if(data.success==true){
        //             $("#apd").append(data.html);
        //             window.usersCount++;
        //         }else{
        //             toastr.warning('{{__("error")}}')
        //         }
        //     }
        // })
        


        let html_to_apend_invite='<div class="invite-modal-row d-flex flex-column g-15">';
        html_to_apend_invite+='<div class="d-flex flex-row g-17 justify-content-between align-items-center g-21" style="width: 907px;height: 32px;">';
        html_to_apend_invite+='<div>';
        html_to_apend_invite+='<div class="name-div d-flex flex-row justify-content-between align-items-center g-32">';
        html_to_apend_invite+='<p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Name')}}</p>';
        html_to_apend_invite+='<input name="name[]" oninput="onFieldInput('name', this)" onblur="onFieldBlur('name', this)" required type="text" placeholder="{{__('Name')}}" class="bg-white invite-member-textbox invite-input name">';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='<p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='<div>';
        html_to_apend_invite+='<div class="email-div d-flex flex-row justify-content-between align-items-center g-36">';
        html_to_apend_invite+='<p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Email ')}}</p>';
        html_to_apend_invite+='<input name="email[]" oninput="onFieldInput('email', this)" onblur="onFieldBlur('email', this)" required type="email" placeholder="namesurname@email.com" class="bg-white invite-member-textbox invite-input email">';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='<p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='<div>';
        html_to_apend_invite+='<div class="job-div d-flex flex-row justify-content-between align-items-center g-10">';
        html_to_apend_invite+='<p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Job Title')}}</p>';
        html_to_apend_invite+='<input name="job_position[]" oninput="onFieldInput('job_position', this)" onblur="onFieldBlur('job_position', this)" required type="text" placeholder="Manager" class="bg-white invite-member-textbox invite-input job-title">';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='<p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='<div class="d-flex flex-row g-17 align-items-center g-21" style="width: 907px;/*height: 32px;*/">';
        html_to_apend_invite+='<div>';
        html_to_apend_invite+='<div class="location-div d-flex flex-row justify-content-between align-items-center g-14"  style="@if($get_locale=='ar') gap:28px @endif">';
        html_to_apend_invite+='<p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Location')}}</p>';
        html_to_apend_invite+='<select name="location[]" oninput="onFieldInput('job_position', this)" onblur="onFieldBlur('job_position', this)" required class="bg-white invite-member-textbox invite-input location">';
        html_to_apend_invite+='<option value="">{{__('Location')}}</option>';
        html_to_apend_invite+='<option value="الجزائر">الجزائر</option>';
        html_to_apend_invite+='<option value="ساموا-الأمريكي">ساموا-الأمريكي</option>';
        html_to_apend_invite+='<option value="النمسا">النمسا</option>';
        html_to_apend_invite+='<option value="البحرين">البحرين</option>';
        html_to_apend_invite+='<option value="بلجيكا">بلجيكا</option>';
        html_to_apend_invite+='<option value="بلغاريا">بلغاريا</option>';
        html_to_apend_invite+='<option value="كندا">كندا</option>';
        html_to_apend_invite+='<option value="كرواتيا">كرواتيا</option>';
        html_to_apend_invite+='<option value="قبرص">قبرص</option>';
        html_to_apend_invite+='<option value="التشيك">التشيك</option>';
        html_to_apend_invite+='<option value="الدنمارك">الدنمارك</option>';
        html_to_apend_invite+='<option value="مصر">مصر </option>';
        html_to_apend_invite+='<option value="إستونيا">إستونيا</option>';
        html_to_apend_invite+='<option value="فنلندا">فنلندا</option>';
        html_to_apend_invite+='<option value="فرنسا">فرنسا</option>';
        html_to_apend_invite+='<option value="ألمانيا">ألمانيا</option>';
        html_to_apend_invite+='<option value="اليونان">اليونان</option>';
        html_to_apend_invite+='<option value="المجر">المجر</option>';
        html_to_apend_invite+='<option value="العراق">العراق</option>';
        html_to_apend_invite+='<option value="إيطاليا">إيطاليا</option>';
        html_to_apend_invite+='<option value="الأردن">الأردن</option>';
        html_to_apend_invite+='<option value="الكويت">الكويت</option>';
        html_to_apend_invite+='<option value="لاتفيا">لاتفيا</option>';
        html_to_apend_invite+='<option value="لبنان">لبنان</option>';
        html_to_apend_invite+='<option value="ليبيا">ليبيا</option>';
        html_to_apend_invite+='<option value="ليتوانيا">ليتوانيا</option>';
        html_to_apend_invite+='<option value="لوكسمبورغ">لوكسمبورغ</option>';
        html_to_apend_invite+='<option value="مالطا">مالطا</option>';
        html_to_apend_invite+='<option value="موريتانيا">موريتانيا</option>';
        html_to_apend_invite+='<option value="المغرب">المغرب</option>';
        html_to_apend_invite+='<option value="هولندا">هولندا</option>';
        html_to_apend_invite+='<option value="عُمان">عُمان</option>';
        html_to_apend_invite+='<option value="دولة فلسطين">دولة فلسطين</option>';
        html_to_apend_invite+='<option value="بولندا">بولندا</option>';
        html_to_apend_invite+='<option value="البرتغال">البرتغال</option>';
        html_to_apend_invite+='<option value="قطر">قطر</option>';
        html_to_apend_invite+='<option value="رومانيا">رومانيا</option>';
        html_to_apend_invite+='<option value="السعودية">السعودية</option>';
        html_to_apend_invite+='<option value="سلوفاكيا">سلوفاكيا</option>';
        html_to_apend_invite+='<option value="الصومال">الصومال</option>';
        html_to_apend_invite+='<option value="جنوب أفريقيا">جنوب أفريقيا</option>';
        html_to_apend_invite+='<option value="إسبانيا">إسبانيا</option>';
        html_to_apend_invite+='<option value="السويد">السويد</option>';
        html_to_apend_invite+='<option value="سوريا">سوريا</option>';
        html_to_apend_invite+='<option value="تونس">تونس</option>';
        html_to_apend_invite+='<option value="تركيا">تركيا</option>';
        html_to_apend_invite+='<option value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</option>';
        html_to_apend_invite+='<option value="الولايات المتحدة">الولايات المتحدة</option>';
        html_to_apend_invite+='<option value="اليمن">اليمن</option>';
        html_to_apend_invite+='</select>';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='<p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='<div>
        html_to_apend_invite+='<div class="role-div d-flex flex-row justify-content-between align-items-center g-43" style="@if($get_locale=='ar') gap: 47px; @endif">';
        html_to_apend_invite+='<p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" >{{__('Role ')}}</p>';
        html_to_apend_invite+='<select name="role[]" oninput="onFieldInput('job_position', this)" onblur="onFieldBlur('job_position', this)" required class="bg-white invite-member-textbox invite-input role">';
        html_to_apend_invite+='<option value="">{{__('Role ')}}</option>';
        html_to_apend_invite+='<option value="Member">{{__('Member')}}</option>';
        html_to_apend_invite+='<option value="Admin">{{__('Admin')}}</option>';
        html_to_apend_invite+='<option value="Owener">{{__('Owner')}}</option>';
        html_to_apend_invite+='</select>';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='<p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='<button type="button" onclick="$(this).closest(\'.invite-modal-row\').remove();window.usersCount--;alerted = false" class="border-0 bg-white d-flex flex-row justify-content-between align-items-center g-10">';
        html_to_apend_invite+='<p class="m-0 primary-text-color invite-memeber-label">';
        html_to_apend_invite+='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">';
        html_to_apend_invite+='<g id="icon_24x_Trash" data-name="icon/24x/Trash" transform="translate(-140 -705)">';
        html_to_apend_invite+='<g id="Boundary" transform="translate(140 705)" fill="#0b243a" stroke="rgba(0,0,0,0)" stroke-width="1" opacity="0">';
        html_to_apend_invite+='<rect width="24" height="24" stroke="none" />';
        html_to_apend_invite+='<rect x="0.5" y="0.5" width="23" height="23" fill="none" />';
        html_to_apend_invite+='</g>';
        html_to_apend_invite+='<g id="Group_57517" data-name="Group 57517" transform="translate(-25 -3)">';
        html_to_apend_invite+='<path id="Path_1347" data-name="Path 1347" d="M20.684,5.789V4.526A2.526,2.526,0,0,0,18.158,2H10.579A2.526,2.526,0,0,0,8.053,4.526V5.789H4.263a1.263,1.263,0,0,0,0,2.526H5.526V22.211A3.789,3.789,0,0,0,9.316,26H19.421a3.789,3.789,0,0,0,3.789-3.789V8.316h1.263a1.263,1.263,0,1,0,0-2.526ZM18.158,4.526H10.579V5.789h7.579Zm2.526,3.789H8.053V22.211a1.263,1.263,0,0,0,1.263,1.263H19.421a1.263,1.263,0,0,0,1.263-1.263Z" transform="translate(163 706)" fill="#f58b1e" fill-rule="evenodd" />';
        html_to_apend_invite+='<path id="Path_1348" data-name="Path 1348" d="M9,9h2.526V19.105H9Z" transform="translate(164.579 707.842)" fill="#f58b1e" />';
        html_to_apend_invite+='<path id="Path_1349" data-name="Path 1349" d="M13,9h2.526V19.105H13Z" transform="translate(165.632 707.842)" fill="#f58b1e" />';
        html_to_apend_invite+='</g>';
        html_to_apend_invite+='</g>';
        html_to_apend_invite+='</svg>';
        html_to_apend_invite+='</p>';
        html_to_apend_invite+='<p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Remove')}}</p>';
        html_to_apend_invite+='</button>';
        html_to_apend_invite+='</div>';
        html_to_apend_invite+='</div>';
        $("#apd").append(html_to_apend_invite);
        window.usersCount++;