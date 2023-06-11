 <!-- Modal -->
 @php
 $get_locale=checkLangaugeGlobaly();
 @endphp
 <div class="modal fade" id="personalInfoModal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="personalInfoModal" tabindex="-1">
     <div class="modal-dialog " style="max-width: 575px;">
         <div class="modal-content personal-info-modal-content">
             <div class="personal-modal-wrapper">
                 <p class="demo-dashboard-modal-heading text-center primary-text-color" style="@if($get_locale=='ar')  font-family: 'NotoSansArabic-Bold'; @endif">
                     {{__('Welcome')}}
                 </p>
                 <p class="text-center primary-text-color demo-dashboard-modal-subheading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('your journey just got started!')}}</p>
                 <form id="signup-info-form" onsubmit="submitInfoForm(event)" method="POST">
                     <div class="d-flex flex-column g-29 g-14-576">
                         <div>
                             <label class="primary-text-color demo-dashboard-modal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('First Name')}}
                                 <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                                 </svg>
                             </label>
                             <input type="text" id="first_name" name="first_name" placeholder="{{__('First Name')}}" class="d-flex flex-row align-items-center bg-white g-10 demo-dashboard-modal-input">
                             <p id="first_name-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                         </div>
                         <div>
                             <label class="primary-text-color  demo-dashboard-modal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Last Name')}}
                                 <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                                 </svg>
                             </label>
                             <input type="text" id="last_name" name="last_name" placeholder="{{__('Last Name')}}" class="d-flex flex-row align-items-center bg-white g-10 demo-dashboard-modal-input">
                             <p id="last_name-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                         </div>
                         <div>
                             <label class="primary-text-color demo-dashboard-modal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Company Name')}}
                                 <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                                 </svg>
                             </label>
                             <input name="company" id="company" type="text" placeholder="{{__('Company Name')}}" class="d-flex flex-row align-items-center bg-white g-10 demo-dashboard-modal-input">
                             <p id="company-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                         </div>
                         @if(empty(session('user_phone')))
                         <div>
                             <label class="primary-text-color  demo-dashboard-modal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Phone ')}}
                                 <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                                 </svg>
                             </label>
                             <input type="text" id="phone" name="phone" class="px-5 d-flex flex-row align-items-center bg-white g-10 demo-dashboard-modal-input">
                             <p id="phone-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                         </div>
                         @endif
                         <div>
                             <label class="primary-text-color  demo-dashboard-modal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Password')}}
                                 <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                                 </svg>
                             </label>
                             <div class="position-relative">
                                 <input type="password" id="password" name="password" placeholder="****************" class="d-flex flex-row align-items-center bg-white g-10 demo-dashboard-modal-input">
                                 <span onclick="showPassword('password')" class="@if(checkLangaugeGlobaly()=='ar') signup-eye-icon-ar @else signup-eye-icon @endif">
                                     <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M0.666626 5.99935C0.666626 5.99935 3.33329 0.666016 7.99996 0.666016C12.6666 0.666016 15.3333 5.99935 15.3333 5.99935C15.3333 5.99935 12.6666 11.3327 7.99996 11.3327C3.33329 11.3327 0.666626 5.99935 0.666626 5.99935Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                         <path d="M10 6C10 6.39556 9.8827 6.78224 9.66294 7.11114C9.44318 7.44004 9.13082 7.69638 8.76537 7.84776C8.39992 7.99913 7.99778 8.03874 7.60982 7.96157C7.22186 7.8844 6.86549 7.69392 6.58579 7.41421C6.30608 7.13451 6.1156 6.77814 6.03843 6.39018C5.96126 6.00222 6.00087 5.60008 6.15224 5.23463C6.30362 4.86918 6.55996 4.55682 6.88886 4.33706C7.21776 4.1173 7.60444 4 8 4C8.53043 4 9.03914 4.21071 9.41422 4.58579C9.78929 4.96086 10 5.46957 10 6Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg>
                                 </span>
                             </div>
                             <div class="position-relative">
                                 <input type="password" id="confirm_password" name="confirm_password" placeholder="****************" class="d-flex flex-row align-items-center bg-white g-10 demo-dashboard-modal-input" style="margin-top :12px;">
                                 <span onclick="showPassword('confirm')" class="@if(checkLangaugeGlobaly()=='ar') signup-eye-icon-ar @else signup-eye-icon @endif">
                                     <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M0.666626 5.99935C0.666626 5.99935 3.33329 0.666016 7.99996 0.666016C12.6666 0.666016 15.3333 5.99935 15.3333 5.99935C15.3333 5.99935 12.6666 11.3327 7.99996 11.3327C3.33329 11.3327 0.666626 5.99935 0.666626 5.99935Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                         <path d="M10 6C10 6.39556 9.8827 6.78224 9.66294 7.11114C9.44318 7.44004 9.13082 7.69638 8.76537 7.84776C8.39992 7.99913 7.99778 8.03874 7.60982 7.96157C7.22186 7.8844 6.86549 7.69392 6.58579 7.41421C6.30608 7.13451 6.1156 6.77814 6.03843 6.39018C5.96126 6.00222 6.00087 5.60008 6.15224 5.23463C6.30362 4.86918 6.55996 4.55682 6.88886 4.33706C7.21776 4.1173 7.60444 4 8 4C8.53043 4 9.03914 4.21071 9.41422 4.58579C9.78929 4.96086 10 5.46957 10 6Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg>
                                 </span>
                             </div>
                             <p id="password-error" class="pt-2 mb-0 input-error-msg d-none"></p>

                         </div>
                         <div class="d-flex justify-content-between">
                             <div>
                                 <input class="modal-keep-signed-input" type="checkbox" name="terms">
                                 <label class="modal-keep-signed-label primary-text-color @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Keep me signed in')}}</label>
                             </div>
                             <div>
                                 <a href="{{url('/login')}}" class="text-decoration-underline secondary-text-color modal-signin-link @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Sign In ')}} </a>
                             </div>
                         </div>
                         <div class="alert alert-warning d-none" id="alert-div" role="alert"></div>
                         <div>
                             <button type="submit" class="border-0 d-flex flex-row justify-content-center align-items-center m-auto modal-dashboard-primary-button" style="@if($get_locale=='ar') width: 161px; @endif">
                                 <span class="modal-dashboard-primary-button-text text-center text-white @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Create an account')}}</span>
                             </button>
                         </div>
                         <div class="text-center">
                             <span type="button" data-bs-dismiss="modal" class="text-center modal-skip-to-demo direction-ltr-important @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                 {{__('Skip to demo page')}}
                                 <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M1 1L5.00006 5.00006L1 9.00012" stroke="#7E92AC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                 </svg>
                             </span>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!--passwordless Modal -->
 <div class="modal fade" id="passwordless_model" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="passwordless_model" tabindex="-1">
     <div class="modal-dialog " style="max-width: 575px;">
         <div class="modal-content personal-info-modal-content">
             <div class="personal-modal-wrapper">
                 <p class="demo-dashboard-modal-heading text-center primary-text-color " style="@if($get_locale=='ar')  font-family: 'NotoSansArabic-Bold'; @endif">
                     {{__('Welcome')}}
                 </p>
                 <p class="text-center primary-text-color demo-dashboard-modal-subheading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('your journey just got started!')}}</p>
                 <form id="signup-form" onsubmit="submitPasswordLessForm(event)" method="POST">
                     <div class="d-flex flex-column g-29 g-14-576">
                         <div>
                             <label class="primary-text-color demo-dashboard-modal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Company Name')}}
                                 <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                                 </svg>
                             </label>
                             <input name="company" class="d-flex flex-row align-items-center bg-white g-10 demo-dashboard-modal-input" required id="company_social" type="text" value="" placeholder="{{__('Company Name')}}">
                             <p id="company_social-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                         </div>
                         <div>
                             <label class="primary-text-color  demo-dashboard-modal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Phone ')}}
                                 <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                                 </svg>
                             </label>
                             <input type="text" id="phone_social" name="phone_social" class="px-5 d-flex flex-row align-items-center bg-white g-10 demo-dashboard-modal-input">
                             <p id="phone_social-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                         </div>
                         <div class="d-flex justify-content-between">
                             <div>
                                 <input style="box-sizing: border-box;width: 14px;height: 14px;border: 0.5px solid #8797AF;border-radius: 4px;" type="checkbox" name="terms">
                                 <label style="font-family: 'Gilroy-Light';font-size: 14px;line-height: 16px;color: #0B243A;" class="@if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Keep me signed in')}}</label>
                             </div>
                             <div>
                                 &nbsp;
                             </div>
                         </div>
                         <div class="alert alert-warning d-none" id="alert-div-social" role="alert"></div>
                         <div>
                             <button type="submit" class="border-0 d-flex flex-row justify-content-center align-items-center m-auto modal-dashboard-primary-button" style="@if($get_locale=='ar') width: 161px; @endif">
                                 <span class="modal-dashboard-primary-button-text text-center text-white @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Create an account')}}</span>
                             </button>
                         </div>
                         <div class="text-center">
                             <!-- <span type="button" data-bs-dismiss="modal" class="text-center modal-skip-to-demo direction-ltr-important @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                 {{__('Skip to demo page')}}
                                 <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M1 1L5.00006 5.00006L1 9.00012" stroke="#7E92AC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                 </svg>
                             </span> -->
                         </div>
                     </div>
                 </form>
             </div>

         </div>
     </div>
 </div>
 <!-- otp modal -->
 <div class="modal fade" id="otpModal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="otpModal" tabindex="-1">
     <div class="modal-dialog" style="max-width: 617px;">
         <div class="modal-content opt-modal-content bg-white">
             <div class="otp-modal-wraper">
                 <p class="text-center primary-text-color demo-dashboard-modal-heading " style="@if($get_locale=='ar')  font-family: 'NotoSansArabic-Bold'; @endif">
                     {{__('Last step')}}
                 </p>
                 <form method="POST" onsubmit="submitOtpFormModal(event)">
                     <div class="d-flex flex-column g-32 g-14-576">
                         <div class="text-center">
                             <svg width="35" height="43" viewBox="0 0 35 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M34.4791 22.8568C34.4655 19.8932 32.5921 17.3758 29.8116 16.413C29.2241 16.2104 28.1446 16.0898 28.0879 15.8121C28.0085 15.4297 28.0402 14.5261 28.0221 13.8751C27.9722 12.0087 28.1899 10.1286 27.7817 8.27812C26.6931 3.35028 22.0754 -0.355263 16.7547 0.0271276C12.0055 0.368548 7.84821 4.06044 7.13152 8.74245C6.80266 10.8888 7.00905 13.0466 6.99771 15.1998C6.99318 15.9032 6.74596 16.1057 6.1336 16.2241C2.70891 16.8887 0.529362 19.504 0.513486 22.982C0.495342 27.2383 0.495342 31.497 0.513486 35.7533C0.529362 39.7844 3.40292 42.6569 7.41729 42.6705C10.783 42.6842 14.1487 42.6728 17.5144 42.6705C20.9369 42.6705 24.3593 42.6887 27.7794 42.6637C31.5126 42.6364 34.4564 39.7024 34.4814 35.9673C34.5086 31.5971 34.5041 27.2247 34.4814 22.8545L34.4791 22.8568ZM11.189 9.88734C11.5269 6.78953 14.0285 4.33357 17.0518 4.16969C20.2565 3.99671 23.1867 6.13627 23.7016 9.26596C24.0463 11.3577 23.7787 13.5087 23.8127 15.6346C23.8218 16.1854 23.4158 16.0807 23.096 16.0807C21.2045 16.0875 19.3107 16.083 17.4192 16.083C15.5277 16.083 13.6339 16.0739 11.7424 16.0898C11.3024 16.0944 11.0552 16.0124 11.0756 15.4912C11.1482 13.6248 10.9826 11.7538 11.1867 9.88734H11.189ZM30.3718 35.4347C30.3672 37.4559 29.2808 38.5439 27.2827 38.5462C20.7532 38.5484 14.2213 38.5484 7.69172 38.5462C5.70495 38.5462 4.62084 37.44 4.62084 35.421C4.61857 31.3923 4.61857 27.3635 4.62084 23.3348C4.62084 21.3454 5.65959 20.312 7.6645 20.3075C10.944 20.3029 14.2236 20.3075 17.5031 20.3075C20.8099 20.3075 24.1189 20.3029 27.4256 20.3075C29.3081 20.312 30.3672 21.3659 30.3718 23.2619C30.3831 27.318 30.3808 31.3763 30.3718 35.4324V35.4347Z" fill="#F58B1E" />
                                 <path d="M19.5422 26.7835C19.5082 25.6795 18.6055 24.7987 17.535 24.7759C16.4215 24.7509 15.4734 25.6317 15.453 26.7835C15.4235 28.5088 15.4235 30.2364 15.453 31.9617C15.4712 33.1726 16.3217 33.9829 17.4988 33.9806C18.6759 33.9806 19.5105 33.1726 19.5468 31.9594C19.5717 31.1104 19.5513 30.2614 19.5513 29.4124C19.5513 28.5361 19.5717 27.6575 19.5445 26.7812L19.5422 26.7835Z" fill="#F58B1E" />
                             </svg>
                         </div>
                         <div>
                             <p class="secondary-text-color text-center otp-model-secure-account @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Secure your account ')}}</p>
                             <div class="d-flex g-6 justify-content-center align-items-center">
                                 <p class="m-0 text-center primary-text-color demo-dashboard-modal-subheading  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('a code is sent to')}} </p>
                                 @if(auth()->check())
                                 <span class="direction-ltr-important">{{substr(auth()->user()->phone, 0, 6)}} *** ***</span>
                                 @endif
                             </div>

                         </div>
                         <div>
                             <div class="text-center" style="@if($get_locale=='ar') unicode-bidi: embed;direction: ltr; @endif">
                                 <input id="m1" onkeyup="alter_boxModal(this.id)" class="text-center border-0 otp-modal-input otp-modal-first-input" required="" type="text" id="first" maxlength="1">
                                 <input id="m2" onkeyup="alter_boxModal(this.id)" class="text-center border-0 otp-modal-input rounded-0" required="" id="second" maxlength="1">
                                 <input id="m3" onkeyup="alter_boxModal(this.id)" class="text-center border-0 otp-modal-input rounded-0" type="text" required="" id="third" maxlength="1">
                                 <input id="m4" onkeyup="alter_boxModal(this.id)" class="text-center border-0 otp-modal-input rounded-0" type="text" required="" id="four" maxlength="1">
                                 <input id="m5" onkeyup="alter_boxModal(this.id)" class="text-center border-0 otp-modal-input rounded-0" type="text" required="" id="five" maxlength="1">
                                 <input id="m6" onkeyup="alter_boxModal(this.id)" class="text-center border-0  otp-modal-input otp-modal-last-input" required="" type="text" id="six" maxlength="1">
                             </div>
                             <p id="otp-modal-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                         </div>
                         <div class="alert alert-warning d-none" id="otp-alert-div" role="alert"></div>
                         <div class="d-flex">
                             <button type="submit" class="border-0 secondary-bg-color m-auto otp-modal-submit-button" style="@if($get_locale=='ar') width: 99px;height: 49px; @endif">
                                 <span class="text-white text-center otp-modal-submit-button-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Submit')}}</span>
                             </button>
                         </div>
                         <div class="text-center">
                             <p class="d-inline text-center primary-text-color demo-dashboard-modal-subheading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Didn’t get the code? ')}}</p>
                             <button type="button" onclick="resendOtp(this)" class="border-0 bg-transparent d-inline secondary-text-color text-decoration-underline otp-modal-resend-link @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" href="#">{{__('Resend')}}</button>
                         </div>
                         <div class="text-center direction-ltr-important">
                             <span type="button" data-bs-dismiss="modal" class="text-center text-decoration-none modal-skip-to-demo direction-ltr-important @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                 {{__('Skip to demo page')}}
                                 <svg class="ms-2" width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M1 1L5.00006 5.00006L1 9.00012" stroke="#7E92AC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                 </svg>
                             </span>
                         </div>
                     </div>
                 </form>
             </div>

         </div>
     </div>
 </div>
 <!-- connection modal -->
 <div class="modal fade" id="connectionsmodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="connectionsmodal" tabindex="-1">
     <div class="modal-dialog" style="max-width: 1020px;max-height:553px;">
         <div class="modal-content bg-white border-0 custom-modal-content">
             <!-- header -->
             <div class="px-3 px-sm-5 pt-5">
                 <!-- <button type="button" data-bs-dismiss="modal" class="border-0 bg-white d-flex flex-row align-items-center position-absolute g-9">
                     <span @if($get_locale=='ar' ) style=" transform: rotateY(180deg);" @endif>
                         <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M6.28033 0.46967C6.57322 0.762563 6.57322 1.23744 6.28033 1.53033L2.56066 5.25H11.25C11.6642 5.25 12 5.58579 12 6C12 6.41421 11.6642 6.75 11.25 6.75H2.56066L6.28033 10.4697C6.57322 10.7626 6.57322 11.2374 6.28033 11.5303C5.98744 11.8232 5.51256 11.8232 5.21967 11.5303L0.21967 6.53033C-0.0732233 6.23744 -0.0732233 5.76256 0.21967 5.46967L5.21967 0.46967C5.51256 0.176777 5.98744 0.176777 6.28033 0.46967Z" fill="#F58B1E" />
                         </svg>
                     </span>
                     <p class="m-0 secondary-text-color popup-back @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back ')}}</p>
                 </button> -->
                 <div class="text-center d-flex flex-column mt-4 mt-sm-0 g-17 g-6-576">
                     <p class="m-0 primary-text-color connections-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Your Connections ')}}</p>
                     <p class="m-0 primary-text-color text-center connections-sub-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('choose a channel to get marketing data')}}</p>
                 </div>
             </div>
             <!-- body -->
             <div class="d-flex flex-column g-15 px-3 px-sm-5 py-4 py-sm-5 direction-ltr-important">
                 <div class="row g-2 g-md-2 g-lg-4 g-xl-3">
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button type="button" id="google-analytics-connector-btn" onclick="addConnection('google-analytics')" class="position-relative bg-white pt-4 px-md-1 px-xl-2 d-flex flex-column align-items-center g-14 dashboard-connections">
                             <span>
                                 <svg width="25" height="28" viewBox="0 0 25 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <rect x="18.3157" width="6.51872" height="28" rx="3.25936" fill="#F9AB00" />
                                     <rect x="9.08081" y="10.7695" width="7.06195" height="17.2308" rx="3.53097" fill="#E37400" />
                                     <rect x="0.38916" y="21.5381" width="6.51872" height="6.46154" rx="3.23077" fill="#E37400" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Google Analytics')}}</p>
                             <span class="connection-checked position-absolute check-connection-icon d-none">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M7.00004 0.333008C3.33337 0.333008 0.333374 3.33301 0.333374 6.99967C0.333374 10.6663 3.33337 13.6663 7.00004 13.6663C10.6667 13.6663 13.6667 10.6663 13.6667 6.99967C13.6667 3.33301 10.6667 0.333008 7.00004 0.333008ZM9.80004 5.86634L6.60004 9.06634C6.33337 9.33301 5.93337 9.33301 5.66671 9.06634L4.20004 7.59967C3.93337 7.33301 3.93337 6.93301 4.20004 6.66634C4.46671 6.39967 4.86671 6.39967 5.13337 6.66634L6.13337 7.66634L8.86671 4.93301C9.13337 4.66634 9.53337 4.66634 9.80004 4.93301C10.0667 5.19967 10.0667 5.59967 9.80004 5.86634Z" fill="#2DA771" />
                                 </svg>
                             </span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button type="button" id="google-ads-connector-btn" onclick="addConnection('google-ads')" class=" position-relative bg-white pt-4 px-md-1 px-xl-2 d-flex flex-column align-items-center g-14 dashboard-connections">
                             <span>
                                 <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd" clip-rule="evenodd" d="M27.0747 13.8073C27.0747 12.85 26.988 11.9295 26.8271 11.0459H14V16.2679H21.3297C21.014 17.9554 20.0545 19.3852 18.612 20.3425V23.7298H23.0136C25.5889 21.3795 27.0747 17.9186 27.0747 13.8073Z" fill="#4285F4" />
                                     <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0002 26.9995C17.6775 26.9995 20.7604 25.7906 23.0138 23.7288L18.6122 20.3415C17.3927 21.1515 15.8326 21.6301 14.0002 21.6301C10.4529 21.6301 7.45047 19.2554 6.37949 16.0645H1.82935V19.5622C4.07037 23.9742 8.67622 26.9995 14.0002 26.9995Z" fill="#34A853" />
                                     <path fill-rule="evenodd" clip-rule="evenodd" d="M6.37937 16.0652C6.10698 15.2552 5.95221 14.39 5.95221 13.5002C5.95221 12.6105 6.10698 11.7452 6.37937 10.9352V7.4375H1.82923C0.906822 9.26 0.380615 11.3218 0.380615 13.5002C0.380615 15.6786 0.906822 17.7405 1.82923 19.563L6.37937 16.0652Z" fill="#FBBC05" />
                                     <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0002 5.36932C15.9998 5.36932 17.7951 6.05045 19.2065 7.38818L23.1129 3.51614C20.7542 1.33773 17.6713 0 14.0002 0C8.67622 0 4.07037 3.02523 1.82935 7.43727L6.37949 10.935C7.45047 7.74409 10.4529 5.36932 14.0002 5.36932Z" fill="#EA4335" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Google Ads')}}</p>
                             <span class="connection-checked position-absolute check-connection-icon d-none">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M7.00004 0.333008C3.33337 0.333008 0.333374 3.33301 0.333374 6.99967C0.333374 10.6663 3.33337 13.6663 7.00004 13.6663C10.6667 13.6663 13.6667 10.6663 13.6667 6.99967C13.6667 3.33301 10.6667 0.333008 7.00004 0.333008ZM9.80004 5.86634L6.60004 9.06634C6.33337 9.33301 5.93337 9.33301 5.66671 9.06634L4.20004 7.59967C3.93337 7.33301 3.93337 6.93301 4.20004 6.66634C4.46671 6.39967 4.86671 6.39967 5.13337 6.66634L6.13337 7.66634L8.86671 4.93301C9.13337 4.66634 9.53337 4.66634 9.80004 4.93301C10.0667 5.19967 10.0667 5.59967 9.80004 5.86634Z" fill="#2DA771" />
                                 </svg>
                             </span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button type="button" id="twitter-connector-btn" onclick="addConnection('twitter')" class="position-relative bg-white pt-4 px-md-1 px-xxl-2 d-flex flex-column align-items-center g-14 dashboard-connections">
                             <span>
                                 <svg width="34" height="28" viewBox="0 0 34 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M10.1414 21.9242C7.01985 24.2809 3.67494 25.1701 0 24.9054C0.0992556 25.0262 0.188586 25.0878 0.282878 25.1444C3.99007 27.352 7.9727 28.2566 12.2407 27.9379C15.3524 27.7066 18.3002 26.8791 20.938 25.1829C27.1985 21.1558 30.3747 15.2501 30.5434 7.62504C30.5558 7.11362 30.7097 6.81293 31.0893 6.52253C32.1985 5.67445 33.134 4.65161 34 3.35121C32.6898 3.85492 31.4888 4.24812 30.072 4.39718C31.4839 3.38205 32.5385 2.25128 33.072 0.534551C31.7295 1.28498 30.4442 1.81182 29.0769 2.12535C28.7643 2.19731 28.5608 2.15876 28.3226 1.9326C26.9777 0.650198 25.3672 0 23.5558 0C18.9305 0 15.8908 4.15047 16.5658 8.10819C16.6427 8.55793 16.5434 8.67614 16.0943 8.64016C14.0174 8.47055 12.0124 7.9874 10.0844 7.19072C7.17618 5.99055 4.66501 4.18388 2.56824 1.76556C2.1464 1.27727 2.134 1.28754 1.84615 1.88891C0.506204 4.68245 1.31762 8.29579 3.72457 10.2721C3.87097 10.3929 4.07196 10.47 4.15633 10.7167C3.09181 10.655 2.13399 10.3389 1.12655 9.86089C1.37469 13.5847 3.26055 15.7975 6.63275 16.864C5.60794 17.1724 4.65509 17.1313 3.60298 17.0285C4.82878 20.0636 6.95781 21.6056 10.1414 21.9165V21.9242Z" fill="#28A6D1" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Twitter')}}</p>
                             <span class="connection-checked position-absolute check-connection-icon d-none">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M7.00004 0.333008C3.33337 0.333008 0.333374 3.33301 0.333374 6.99967C0.333374 10.6663 3.33337 13.6663 7.00004 13.6663C10.6667 13.6663 13.6667 10.6663 13.6667 6.99967C13.6667 3.33301 10.6667 0.333008 7.00004 0.333008ZM9.80004 5.86634L6.60004 9.06634C6.33337 9.33301 5.93337 9.33301 5.66671 9.06634L4.20004 7.59967C3.93337 7.33301 3.93337 6.93301 4.20004 6.66634C4.46671 6.39967 4.86671 6.39967 5.13337 6.66634L6.13337 7.66634L8.86671 4.93301C9.13337 4.66634 9.53337 4.66634 9.80004 4.93301C10.0667 5.19967 10.0667 5.59967 9.80004 5.86634Z" fill="#2DA771" />
                                 </svg>
                             </span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button type="button" id="facebook-ads-connector-btn" onclick="addConnection('facebook-ads')" class="position-relative bg-white pt-4 px-md-1 px-xl-2 d-flex flex-column align-items-center g-14 dashboard-connections">
                             <span>
                                 <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M27 13.5821C27 9.97988 25.5776 6.52517 23.0458 3.97802C20.5139 1.43088 17.08 0 13.4994 0C9.91905 0.00030461 6.48542 1.43133 3.95382 3.97844C1.42222 6.52556 -1.28025e-08 9.98008 0 13.5821C0.000344626 16.8165 1.14768 19.9447 3.23569 22.4041C5.32369 24.8635 8.21537 26.4927 11.3907 26.9989V17.508H7.96562V13.5821H11.3907V10.59C11.3907 7.18558 13.4058 5.30651 16.4895 5.30651C17.502 5.32061 18.512 5.40924 19.5116 5.57178V8.91424H17.8105C17.5204 8.8755 17.2253 8.90291 16.9472 8.99444C16.669 9.08597 16.4149 9.23924 16.2036 9.44297C15.9924 9.64669 15.8293 9.89566 15.7267 10.1714C15.624 10.4471 15.5843 10.7424 15.6104 11.0356V13.5832H19.3552L18.7569 17.5091H15.6093V27C18.7846 26.4938 21.6763 24.8646 23.7643 22.4052C25.8523 19.9458 26.9997 16.8176 27 13.5832" fill="#1877F2" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Facebook Ads')}}</p>
                             <span class="connection-checked position-absolute check-connection-icon d-none">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M7.00004 0.333008C3.33337 0.333008 0.333374 3.33301 0.333374 6.99967C0.333374 10.6663 3.33337 13.6663 7.00004 13.6663C10.6667 13.6663 13.6667 10.6663 13.6667 6.99967C13.6667 3.33301 10.6667 0.333008 7.00004 0.333008ZM9.80004 5.86634L6.60004 9.06634C6.33337 9.33301 5.93337 9.33301 5.66671 9.06634L4.20004 7.59967C3.93337 7.33301 3.93337 6.93301 4.20004 6.66634C4.46671 6.39967 4.86671 6.39967 5.13337 6.66634L6.13337 7.66634L8.86671 4.93301C9.13337 4.66634 9.53337 4.66634 9.80004 4.93301C10.0667 5.19967 10.0667 5.59967 9.80004 5.86634Z" fill="#2DA771" />
                                 </svg>
                             </span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button type="button" id="facebook-connector-btn" onclick="addConnection('facebook')" class="position-relative bg-white pt-4 px-md-1 px-xl-2 d-flex flex-column align-items-center g-14 dashboard-connections">
                             <span>
                                 <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M27 13.5821C27 9.97988 25.5776 6.52517 23.0458 3.97802C20.5139 1.43088 17.08 0 13.4994 0C9.91905 0.00030461 6.48542 1.43133 3.95382 3.97844C1.42222 6.52556 -1.28025e-08 9.98008 0 13.5821C0.000344626 16.8165 1.14768 19.9447 3.23569 22.4041C5.32369 24.8635 8.21537 26.4927 11.3907 26.9989V17.508H7.96562V13.5821H11.3907V10.59C11.3907 7.18558 13.4058 5.30651 16.4895 5.30651C17.502 5.32061 18.512 5.40924 19.5116 5.57178V8.91424H17.8105C17.5204 8.8755 17.2253 8.90291 16.9472 8.99444C16.669 9.08597 16.4149 9.23924 16.2036 9.44297C15.9924 9.64669 15.8293 9.89566 15.7267 10.1714C15.624 10.4471 15.5843 10.7424 15.6104 11.0356V13.5832H19.3552L18.7569 17.5091H15.6093V27C18.7846 26.4938 21.6763 24.8646 23.7643 22.4052C25.8523 19.9458 26.9997 16.8176 27 13.5832" fill="#1877F2" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Facebook Page ')}}</p>
                             <span class="connection-checked position-absolute check-connection-icon d-none">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M7.00004 0.333008C3.33337 0.333008 0.333374 3.33301 0.333374 6.99967C0.333374 10.6663 3.33337 13.6663 7.00004 13.6663C10.6667 13.6663 13.6667 10.6663 13.6667 6.99967C13.6667 3.33301 10.6667 0.333008 7.00004 0.333008ZM9.80004 5.86634L6.60004 9.06634C6.33337 9.33301 5.93337 9.33301 5.66671 9.06634L4.20004 7.59967C3.93337 7.33301 3.93337 6.93301 4.20004 6.66634C4.46671 6.39967 4.86671 6.39967 5.13337 6.66634L6.13337 7.66634L8.86671 4.93301C9.13337 4.66634 9.53337 4.66634 9.80004 4.93301C10.0667 5.19967 10.0667 5.59967 9.80004 5.86634Z" fill="#2DA771" />
                                 </svg>
                             </span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button type="button" id="instagram-connector-btn" onclick="addConnection('instagram')" class="position-relative bg-white pt-4 px-md-1 px-xl-2 d-flex flex-column align-items-center g-14 dashboard-connections">
                             <span>
                                 <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M8.92389 13.8839C8.92389 11.4456 10.9187 9.46849 13.38 9.46849C15.8414 9.46849 17.8372 11.4456 17.8372 13.8839C17.8372 16.3222 15.8414 18.2994 13.38 18.2994C10.9187 18.2994 8.92389 16.3222 8.92389 13.8839ZM6.51443 13.8839C6.51443 17.6403 9.58814 20.6852 13.38 20.6852C17.1719 20.6852 20.2456 17.6403 20.2456 13.8839C20.2456 10.1276 17.1719 7.08265 13.38 7.08265C9.58814 7.08265 6.51443 10.1276 6.51443 13.8839ZM18.9129 6.81297C18.9128 7.12733 19.0068 7.43467 19.183 7.69612C19.3592 7.95757 19.6097 8.16139 19.9028 8.28181C20.1959 8.40223 20.5185 8.43383 20.8298 8.37262C21.141 8.31142 21.427 8.16015 21.6515 7.93796C21.8759 7.71576 22.0289 7.43261 22.0909 7.12432C22.1529 6.81602 22.1213 6.49643 22 6.20595C21.8786 5.91547 21.6731 5.66715 21.4093 5.4924C21.1455 5.31765 20.8354 5.22431 20.518 5.22418H20.5174C20.092 5.22438 19.6841 5.39181 19.3833 5.68971C19.0825 5.9876 18.9133 6.3916 18.9129 6.81297ZM7.97833 24.6652C6.67476 24.6064 5.96624 24.3913 5.49538 24.2096C4.87114 23.9689 4.42574 23.6821 3.95745 23.2189C3.48916 22.7556 3.19929 22.3148 2.95734 21.6964C2.77379 21.2302 2.55665 20.5281 2.4974 19.2367C2.43257 17.8406 2.41963 17.4212 2.41963 13.884C2.41963 10.3469 2.43364 9.92868 2.4974 8.53136C2.55676 7.24 2.7755 6.53927 2.95734 6.07166C3.20036 5.45327 3.48981 5.01204 3.95745 4.54814C4.4251 4.08424 4.87007 3.79708 5.49538 3.5574C5.96602 3.37557 6.67476 3.16046 7.97833 3.10176C9.38769 3.03755 9.81105 3.02473 13.38 3.02473C16.949 3.02473 17.3728 3.03861 18.7833 3.10176C20.0869 3.16057 20.7942 3.37726 21.2662 3.5574C21.8905 3.79708 22.3359 4.08488 22.8042 4.54814C23.2725 5.01141 23.5613 5.45327 23.8043 6.07166C23.9878 6.5379 24.205 7.24 24.2642 8.53136C24.3291 9.92868 24.342 10.3469 24.342 13.884C24.342 17.4212 24.3291 17.8394 24.2642 19.2367C24.2049 20.5281 23.9867 21.23 23.8043 21.6964C23.5613 22.3148 23.2718 22.756 22.8042 23.2189C22.3365 23.6817 21.8905 23.9689 21.2662 24.2096C20.7956 24.3914 20.0869 24.6065 18.7833 24.6652C17.3739 24.7295 16.9506 24.7423 13.38 24.7423C9.80945 24.7423 9.38726 24.7295 7.97833 24.6652ZM7.86763 0.718885C6.44426 0.783098 5.47163 1.00668 4.62223 1.3341C3.74256 1.67223 2.99788 2.12585 2.25373 2.86186C1.50958 3.59787 1.05285 4.33675 0.711526 5.20818C0.381007 6.05015 0.155313 7.01314 0.0904932 8.42317C0.0246034 9.83544 0.00952148 10.2869 0.00952148 13.8839C0.00952148 17.4809 0.0246034 17.9324 0.0904932 19.3447C0.155313 20.7548 0.381007 21.7177 0.711526 22.5597C1.05285 23.4306 1.50969 24.1703 2.25373 24.906C2.99777 25.6417 3.74256 26.0947 4.62223 26.4338C5.47324 26.7612 6.44426 26.9848 7.86763 27.049C9.29399 27.1132 9.74901 27.1292 13.38 27.1292C17.011 27.1292 17.4668 27.1142 18.8924 27.049C20.3159 26.9848 21.2879 26.7612 22.1378 26.4338C23.0169 26.0947 23.7621 25.642 24.5063 24.906C25.2504 24.17 25.7062 23.4306 26.0485 22.5597C26.379 21.7177 26.6058 20.7547 26.6695 19.3447C26.7343 17.9314 26.7494 17.4809 26.7494 13.8839C26.7494 10.2869 26.7343 9.83544 26.6695 8.42317C26.6047 7.01303 26.379 6.04962 26.0485 5.20818C25.7062 4.33728 25.2493 3.59904 24.5063 2.86186C23.7633 2.12468 23.0169 1.67223 22.1389 1.3341C21.2879 1.00668 20.3158 0.782039 18.8935 0.718885C17.4678 0.654672 17.0121 0.638672 13.3811 0.638672C9.75008 0.638672 9.29399 0.653613 7.86763 0.718885Z" fill="url(#paint0_radial_2644_7535)" />
                                     <path d="M8.92389 13.8839C8.92389 11.4456 10.9187 9.46849 13.38 9.46849C15.8414 9.46849 17.8372 11.4456 17.8372 13.8839C17.8372 16.3222 15.8414 18.2994 13.38 18.2994C10.9187 18.2994 8.92389 16.3222 8.92389 13.8839ZM6.51443 13.8839C6.51443 17.6403 9.58814 20.6852 13.38 20.6852C17.1719 20.6852 20.2456 17.6403 20.2456 13.8839C20.2456 10.1276 17.1719 7.08265 13.38 7.08265C9.58814 7.08265 6.51443 10.1276 6.51443 13.8839ZM18.9129 6.81297C18.9128 7.12733 19.0068 7.43467 19.183 7.69612C19.3592 7.95757 19.6097 8.16139 19.9028 8.28181C20.1959 8.40223 20.5185 8.43383 20.8298 8.37262C21.141 8.31142 21.427 8.16015 21.6515 7.93796C21.8759 7.71576 22.0289 7.43261 22.0909 7.12432C22.1529 6.81602 22.1213 6.49643 22 6.20595C21.8786 5.91547 21.6731 5.66715 21.4093 5.4924C21.1455 5.31765 20.8354 5.22431 20.518 5.22418H20.5174C20.092 5.22438 19.6841 5.39181 19.3833 5.68971C19.0825 5.9876 18.9133 6.3916 18.9129 6.81297ZM7.97833 24.6652C6.67476 24.6064 5.96624 24.3913 5.49538 24.2096C4.87114 23.9689 4.42574 23.6821 3.95745 23.2189C3.48916 22.7556 3.19929 22.3148 2.95734 21.6964C2.77379 21.2302 2.55665 20.5281 2.4974 19.2367C2.43257 17.8406 2.41963 17.4212 2.41963 13.884C2.41963 10.3469 2.43364 9.92868 2.4974 8.53136C2.55676 7.24 2.7755 6.53927 2.95734 6.07166C3.20036 5.45327 3.48981 5.01204 3.95745 4.54814C4.4251 4.08424 4.87007 3.79708 5.49538 3.5574C5.96602 3.37557 6.67476 3.16046 7.97833 3.10176C9.38769 3.03755 9.81105 3.02473 13.38 3.02473C16.949 3.02473 17.3728 3.03861 18.7833 3.10176C20.0869 3.16057 20.7942 3.37726 21.2662 3.5574C21.8905 3.79708 22.3359 4.08488 22.8042 4.54814C23.2725 5.01141 23.5613 5.45327 23.8043 6.07166C23.9878 6.5379 24.205 7.24 24.2642 8.53136C24.3291 9.92868 24.342 10.3469 24.342 13.884C24.342 17.4212 24.3291 17.8394 24.2642 19.2367C24.2049 20.5281 23.9867 21.23 23.8043 21.6964C23.5613 22.3148 23.2718 22.756 22.8042 23.2189C22.3365 23.6817 21.8905 23.9689 21.2662 24.2096C20.7956 24.3914 20.0869 24.6065 18.7833 24.6652C17.3739 24.7295 16.9506 24.7423 13.38 24.7423C9.80945 24.7423 9.38726 24.7295 7.97833 24.6652ZM7.86763 0.718885C6.44426 0.783098 5.47163 1.00668 4.62223 1.3341C3.74256 1.67223 2.99788 2.12585 2.25373 2.86186C1.50958 3.59787 1.05285 4.33675 0.711526 5.20818C0.381007 6.05015 0.155313 7.01314 0.0904932 8.42317C0.0246034 9.83544 0.00952148 10.2869 0.00952148 13.8839C0.00952148 17.4809 0.0246034 17.9324 0.0904932 19.3447C0.155313 20.7548 0.381007 21.7177 0.711526 22.5597C1.05285 23.4306 1.50969 24.1703 2.25373 24.906C2.99777 25.6417 3.74256 26.0947 4.62223 26.4338C5.47324 26.7612 6.44426 26.9848 7.86763 27.049C9.29399 27.1132 9.74901 27.1292 13.38 27.1292C17.011 27.1292 17.4668 27.1142 18.8924 27.049C20.3159 26.9848 21.2879 26.7612 22.1378 26.4338C23.0169 26.0947 23.7621 25.642 24.5063 24.906C25.2504 24.17 25.7062 23.4306 26.0485 22.5597C26.379 21.7177 26.6058 20.7547 26.6695 19.3447C26.7343 17.9314 26.7494 17.4809 26.7494 13.8839C26.7494 10.2869 26.7343 9.83544 26.6695 8.42317C26.6047 7.01303 26.379 6.04962 26.0485 5.20818C25.7062 4.33728 25.2493 3.59904 24.5063 2.86186C23.7633 2.12468 23.0169 1.67223 22.1389 1.3341C21.2879 1.00668 20.3158 0.782039 18.8935 0.718885C17.4678 0.654672 17.0121 0.638672 13.3811 0.638672C9.75008 0.638672 9.29399 0.653613 7.86763 0.718885Z" fill="url(#paint1_radial_2644_7535)" />
                                     <defs>
                                         <radialGradient id="paint0_radial_2644_7535" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(3.56222 27.2543) scale(34.9081 34.5811)">
                                             <stop offset="0.09" stop-color="#FA8F21" />
                                             <stop offset="0.78" stop-color="#D82D7E" />
                                         </radialGradient>
                                         <radialGradient id="paint1_radial_2644_7535" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(16.2267 28.4411) scale(27.5124 27.2547)">
                                             <stop offset="0.64" stop-color="#8C3AAA" stop-opacity="0" />
                                             <stop offset="1" stop-color="#8C3AAA" />
                                         </radialGradient>
                                     </defs>
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Instagram ')}}</p>
                             <span class="connection-checked position-absolute check-connection-icon d-none">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M7.00004 0.333008C3.33337 0.333008 0.333374 3.33301 0.333374 6.99967C0.333374 10.6663 3.33337 13.6663 7.00004 13.6663C10.6667 13.6663 13.6667 10.6663 13.6667 6.99967C13.6667 3.33301 10.6667 0.333008 7.00004 0.333008ZM9.80004 5.86634L6.60004 9.06634C6.33337 9.33301 5.93337 9.33301 5.66671 9.06634L4.20004 7.59967C3.93337 7.33301 3.93337 6.93301 4.20004 6.66634C4.46671 6.39967 4.86671 6.39967 5.13337 6.66634L6.13337 7.66634L8.86671 4.93301C9.13337 4.66634 9.53337 4.66634 9.80004 4.93301C10.0667 5.19967 10.0667 5.59967 9.80004 5.86634Z" fill="#2DA771" />
                                 </svg>
                             </span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button id="gmb-connector-btn" onclick="addConnection('gmb')" type="button" class="position-relative bg-white pt-4 px-md-1 px-xl-2 d-flex flex-column align-items-center @if($get_locale=='ar') g-14 @else g-6 @endif dashboard-connections">
                             <span>
                                 <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd" clip-rule="evenodd" d="M27.23 13.8073C27.23 12.85 27.1441 11.9295 26.9846 11.0459H14.27V16.2679H21.5355C21.2225 17.9554 20.2714 19.3852 18.8416 20.3425V23.7298H23.2046C25.7573 21.3795 27.23 17.9186 27.23 13.8073Z" fill="#4285F4" />
                                     <path fill-rule="evenodd" clip-rule="evenodd" d="M14.2701 26.9995C17.9151 26.9995 20.971 25.7906 23.2047 23.7288L18.8417 20.3415C17.6329 21.1515 16.0865 21.6301 14.2701 21.6301C10.754 21.6301 7.77787 19.2554 6.71628 16.0645H2.20605V19.5622C4.42742 23.9742 8.99287 26.9995 14.2701 26.9995Z" fill="#34A853" />
                                     <path fill-rule="evenodd" clip-rule="evenodd" d="M6.71615 16.0652C6.44615 15.2552 6.29275 14.39 6.29275 13.5002C6.29275 12.6105 6.44615 11.7452 6.71615 10.9352V7.4375H2.20593C1.29161 9.26 0.77002 11.3218 0.77002 13.5002C0.77002 15.6786 1.29161 17.7405 2.20593 19.563L6.71615 16.0652Z" fill="#FBBC05" />
                                     <path fill-rule="evenodd" clip-rule="evenodd" d="M14.2701 5.36932C16.2522 5.36932 18.0317 6.05045 19.4308 7.38818L23.3029 3.51614C20.9649 1.33773 17.909 0 14.2701 0C8.99287 0 4.42742 3.02523 2.20605 7.43727L6.71628 10.935C7.77787 7.74409 10.754 5.36932 14.2701 5.36932Z" fill="#EA4335" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name gmb-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Google my business')}}</p>
                             <span class="connection-checked position-absolute check-connection-icon d-none">
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M7.00004 0.333008C3.33337 0.333008 0.333374 3.33301 0.333374 6.99967C0.333374 10.6663 3.33337 13.6663 7.00004 13.6663C10.6667 13.6663 13.6667 10.6663 13.6667 6.99967C13.6667 3.33301 10.6667 0.333008 7.00004 0.333008ZM9.80004 5.86634L6.60004 9.06634C6.33337 9.33301 5.93337 9.33301 5.66671 9.06634L4.20004 7.59967C3.93337 7.33301 3.93337 6.93301 4.20004 6.66634C4.46671 6.39967 4.86671 6.39967 5.13337 6.66634L6.13337 7.66634L8.86671 4.93301C9.13337 4.66634 9.53337 4.66634 9.80004 4.93301C10.0667 5.19967 10.0667 5.59967 9.80004 5.86634Z" fill="#2DA771" />
                                 </svg>
                             </span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button onclick="addConnection('linkedin')" type="button" class="col bg-white pt-3 px-md-1 px-xl-2 g-7 d-flex flex-column align-items-center dashboard-connections">
                             <span>
                                 <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <rect x="0.5" width="27" height="27" rx="13.5" fill="#0A66C2" />
                                     <path d="M20.3287 6.0752H7.67117C7.38043 6.0752 7.10161 6.19069 6.89603 6.39627C6.69045 6.60185 6.57495 6.88068 6.57495 7.17141V19.829C6.57495 20.1197 6.69045 20.3985 6.89603 20.6041C7.10161 20.8097 7.38043 20.9252 7.67117 20.9252H20.3287C20.6195 20.9252 20.8983 20.8097 21.1039 20.6041C21.3095 20.3985 21.425 20.1197 21.425 19.829V7.17141C21.425 6.88068 21.3095 6.60185 21.1039 6.39627C20.8983 6.19069 20.6195 6.0752 20.3287 6.0752ZM11.0011 18.7255H8.76842V11.6336H11.0011V18.7255ZM9.8832 10.6509C9.62995 10.6494 9.38279 10.573 9.17292 10.4312C8.96305 10.2895 8.79988 10.0887 8.70399 9.85433C8.60811 9.61992 8.58381 9.36236 8.63417 9.11416C8.68453 8.86595 8.80728 8.63823 8.98693 8.45972C9.16659 8.28122 9.3951 8.15993 9.64362 8.11117C9.89214 8.06241 10.1495 8.08836 10.3833 8.18574C10.6171 8.28313 10.8168 8.44759 10.9572 8.65836C11.0976 8.86913 11.1725 9.11678 11.1723 9.37004C11.1747 9.5396 11.1429 9.7079 11.0788 9.86492C11.0148 10.0219 10.9198 10.1645 10.7995 10.284C10.6792 10.4035 10.5361 10.4976 10.3787 10.5606C10.2212 10.6236 10.0527 10.6543 9.8832 10.6509ZM19.2305 18.7317H16.9988V14.8573C16.9988 13.7147 16.5131 13.362 15.8861 13.362C15.224 13.362 14.5744 13.8611 14.5744 14.8862V18.7317H12.3417V11.6388H14.4888V12.6216H14.5176C14.7332 12.1854 15.488 11.4398 16.64 11.4398C17.8857 11.4398 19.2315 12.1792 19.2315 14.3448L19.2305 18.7317Z" fill="white" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Linkedin')}}</p>
                             <span class="d-flex flex-column text-white text-center secondary-bg-color align-items-center justify-content-center dashboard-connection-coming-soon">{{__('Coming soon')}}</span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button onclick="addConnection('linkedin_ads')" type="button" class="col bg-white pt-3 px-md-1 px-xl-2 g-7 d-flex flex-column align-items-center dashboard-connections">
                             <span>
                                 <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <rect x="0.5" width="27" height="27" rx="13.5" fill="#0A66C2" />
                                     <path d="M20.3287 6.0752H7.67117C7.38043 6.0752 7.10161 6.19069 6.89603 6.39627C6.69045 6.60185 6.57495 6.88068 6.57495 7.17141V19.829C6.57495 20.1197 6.69045 20.3985 6.89603 20.6041C7.10161 20.8097 7.38043 20.9252 7.67117 20.9252H20.3287C20.6195 20.9252 20.8983 20.8097 21.1039 20.6041C21.3095 20.3985 21.425 20.1197 21.425 19.829V7.17141C21.425 6.88068 21.3095 6.60185 21.1039 6.39627C20.8983 6.19069 20.6195 6.0752 20.3287 6.0752ZM11.0011 18.7255H8.76842V11.6336H11.0011V18.7255ZM9.8832 10.6509C9.62995 10.6494 9.38279 10.573 9.17292 10.4312C8.96305 10.2895 8.79988 10.0887 8.70399 9.85433C8.60811 9.61992 8.58381 9.36236 8.63417 9.11416C8.68453 8.86595 8.80728 8.63823 8.98693 8.45972C9.16659 8.28122 9.3951 8.15993 9.64362 8.11117C9.89214 8.06241 10.1495 8.08836 10.3833 8.18574C10.6171 8.28313 10.8168 8.44759 10.9572 8.65836C11.0976 8.86913 11.1725 9.11678 11.1723 9.37004C11.1747 9.5396 11.1429 9.7079 11.0788 9.86492C11.0148 10.0219 10.9198 10.1645 10.7995 10.284C10.6792 10.4035 10.5361 10.4976 10.3787 10.5606C10.2212 10.6236 10.0527 10.6543 9.8832 10.6509ZM19.2305 18.7317H16.9988V14.8573C16.9988 13.7147 16.5131 13.362 15.8861 13.362C15.224 13.362 14.5744 13.8611 14.5744 14.8862V18.7317H12.3417V11.6388H14.4888V12.6216H14.5176C14.7332 12.1854 15.488 11.4398 16.64 11.4398C17.8857 11.4398 19.2315 12.1792 19.2315 14.3448L19.2305 18.7317Z" fill="white" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Linkedin Ads')}}</p>
                             <span class="d-flex flex-column text-white text-center secondary-bg-color align-items-center justify-content-center dashboard-connection-coming-soon">{{__('Coming soon')}}</span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button onclick="addConnection('tiktok')" type="button" class="col bg-white pt-3 g-7 px-md-1 px-xl-2 d-flex flex-column align-items-center dashboard-connections">
                             <span>
                                 <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <rect x="0.5" width="27" height="27" rx="13.5" fill="black" />
                                     <path d="M17.7655 10.8722C18.9809 11.7441 20.4698 12.2571 22.0779 12.2571V9.1516C21.7736 9.15166 21.47 9.11981 21.1723 9.05651V11.501C19.5643 11.501 18.0756 10.988 16.8599 10.1161V16.4535C16.8599 19.6238 14.299 22.1936 11.1402 22.1936C9.96157 22.1936 8.86608 21.836 7.95605 21.2227C8.9947 22.2885 10.4432 22.9497 12.0456 22.9497C15.2047 22.9497 17.7657 20.3798 17.7657 17.2094V10.8722H17.7655ZM18.8827 7.73913C18.2616 7.05812 17.8538 6.17805 17.7655 5.20509V4.80566H16.9073C17.1233 6.04229 17.8602 7.09879 18.8827 7.73913ZM9.95401 18.79C9.60698 18.3333 9.41944 17.7747 9.42028 17.2003C9.42028 15.7504 10.5916 14.5747 12.0367 14.5747C12.306 14.5747 12.5737 14.616 12.8304 14.6978V11.5229C12.5305 11.4816 12.2277 11.4641 11.9252 11.4705V13.9417C11.6683 13.86 11.4005 13.8185 11.1311 13.8187C9.68598 13.8187 8.51472 14.9943 8.51472 16.4444C8.51472 17.4698 9.10019 18.3575 9.95401 18.79Z" fill="#FF004F" />
                                     <path d="M16.8592 10.1161C18.0749 10.9879 19.5637 11.5009 21.1716 11.5009V9.05644C20.2741 8.86458 19.4795 8.39386 18.8821 7.73913C17.8594 7.09873 17.1227 6.04223 16.9066 4.80566H14.6524V17.2093C14.6473 18.6553 13.4779 19.8262 12.0359 19.8262C11.1862 19.8262 10.4312 19.4197 9.95314 18.79C9.09939 18.3575 8.51392 17.4697 8.51392 16.4445C8.51392 14.9945 9.68518 13.8188 11.1303 13.8188C11.4072 13.8188 11.674 13.8621 11.9244 13.9418V11.4706C8.82102 11.5349 6.3252 14.0797 6.3252 17.2094C6.3252 18.7717 6.94671 20.188 7.95545 21.2228C8.86547 21.836 9.96096 22.1937 11.1396 22.1937C14.2985 22.1937 16.8593 19.6237 16.8593 16.4535V10.1161H16.8592Z" fill="white" />
                                     <path d="M21.1719 9.05657V8.39561C20.3625 8.39684 19.569 8.16936 18.8823 7.73919C19.4902 8.40709 20.2907 8.86762 21.1719 9.05657ZM16.9069 4.80579C16.8863 4.68761 16.8705 4.56865 16.8595 4.44924V4.0498H13.747V16.4536C13.742 17.8994 12.5727 19.0702 11.1306 19.0702C10.7072 19.0702 10.3074 18.9694 9.95344 18.7901C10.4315 19.4198 11.1865 19.8262 12.0362 19.8262C13.4781 19.8262 14.6476 18.6555 14.6526 17.2095V4.80579H16.9069ZM11.9248 11.4707V10.7671C11.6647 10.7314 11.4025 10.7135 11.1399 10.7136C7.9808 10.7136 5.41992 13.2835 5.41992 16.4536C5.41992 18.441 6.42639 20.1925 7.9558 21.2228C6.94707 20.188 6.32555 18.7717 6.32555 17.2094C6.32555 14.0798 8.82132 11.5351 11.9248 11.4707Z" fill="#00F2EA" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Tiktok')}}</p>
                             <span class="d-flex flex-column text-white text-center secondary-bg-color align-items-center justify-content-center dashboard-connection-coming-soon">{{__('Coming soon')}}</span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button onclick="addConnection('youtube')" type="button" class="col bg-white pt-3 g-7 px-md-1 px-xl-2 d-flex flex-column align-items-center dashboard-connections">
                             <span>
                                 <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <rect x="0.5" width="27" height="27" rx="13.5" fill="#FF0000" />
                                     <path d="M23.2464 8.86304C23.024 8.03689 22.3726 7.3855 21.5465 7.16307C20.0372 6.75 13.9999 6.75 13.9999 6.75C13.9999 6.75 7.96266 6.75 6.45335 7.14719C5.64309 7.36961 4.97581 8.03689 4.75339 8.86304C4.3562 10.3723 4.3562 13.5022 4.3562 13.5022C4.3562 13.5022 4.3562 16.6479 4.75339 18.1413C4.97581 18.9675 5.6272 19.6189 6.45335 19.8413C7.97855 20.2544 13.9999 20.2544 13.9999 20.2544C13.9999 20.2544 20.0372 20.2544 21.5465 19.8572C22.3726 19.6348 23.024 18.9834 23.2464 18.1572C23.6436 16.6479 23.6436 13.5181 23.6436 13.5181C23.6436 13.5181 23.6595 10.3723 23.2464 8.86304Z" fill="white" />
                                     <path d="M12.0779 16.3934L17.0983 13.5019L12.0779 10.6104V16.3934Z" fill="#FF0000" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Youtube')}}</p>
                             <span class="d-flex flex-column text-white text-center secondary-bg-color align-items-center justify-content-center dashboard-connection-coming-soon">{{__('Coming soon')}}</span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button onclick="addConnection('messenger')" type="button" class="col bg-white pt-3 g-7 px-md-1 px-xl-2 d-flex flex-column align-items-center dashboard-connections">
                             <span>
                                 <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <rect x="0.5" width="27" height="27" rx="13.5" fill="url(#paint0_radial_2644_7475)" />
                                     <path fill-rule="evenodd" clip-rule="evenodd" d="M4.98438 13.2289C4.98438 8.20475 8.92211 4.4834 14.0004 4.4834C19.0786 4.4834 23.0164 8.207 23.0164 13.2312C23.0164 18.2553 19.0786 21.9767 14.0004 21.9767C13.0875 21.9767 12.2129 21.855 11.3902 21.6296C11.2302 21.5867 11.0589 21.598 10.9079 21.6656L9.11821 22.4545C8.64938 22.6619 8.12194 22.3283 8.10616 21.8166L8.05657 20.2118C8.05207 20.0134 7.96191 19.8286 7.8154 19.6979C6.06179 18.1291 4.98438 15.8571 4.98438 13.2289ZM11.2349 11.5858L8.58645 15.7872C8.33175 16.1907 8.82762 16.6438 9.20629 16.3553L12.0508 14.1959C12.2424 14.0494 12.5084 14.0494 12.7022 14.1937L14.8097 15.7737C15.4431 16.2471 16.3447 16.0825 16.7662 15.4131L19.4169 11.2139C19.6693 10.8104 19.1735 10.3551 18.7948 10.6436L15.9502 12.803C15.7587 12.9495 15.4927 12.9495 15.2988 12.8052L13.1914 11.2252C12.558 10.7518 11.6564 10.9164 11.2349 11.5858Z" fill="white" />
                                     <defs>
                                         <radialGradient id="paint0_radial_2644_7475" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(5.6975 26.8551) scale(29.4192 29.4166)">
                                             <stop stop-color="#0099FF" />
                                             <stop offset="0.6098" stop-color="#A033FF" />
                                             <stop offset="0.9348" stop-color="#FF5280" />
                                             <stop offset="1" stop-color="#FF7061" />
                                         </radialGradient>
                                     </defs>
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Messenger')}}</p>
                             <span class="d-flex flex-column text-white text-center secondary-bg-color align-items-center justify-content-center dashboard-connection-coming-soon">{{__('Coming soon')}}</span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button onclick="addConnection('snapchat')" type="button" class="col bg-white pt-3 g-7 px-md-1 px-xl-2 d-flex flex-column align-items-center dashboard-connections">
                             <span>
                                 <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <rect x="0.5" width="27" height="27" rx="13.5" fill="#FFFC00" />
                                     <path d="M21.0403 17.8126C18.4041 16.5365 17.984 14.5663 17.9653 14.4201C17.9426 14.2431 17.917 14.1039 18.1123 13.9239C18.3006 13.7499 19.1361 13.2327 19.3679 13.0709C19.7511 12.803 19.9199 12.5355 19.7955 12.2067C19.7085 11.9792 19.4967 11.8936 19.2736 11.8936C19.2032 11.8938 19.133 11.9016 19.0644 11.917C18.6433 12.0084 18.2345 12.2193 17.9979 12.2763C17.9695 12.2836 17.9403 12.2876 17.9109 12.288C17.7848 12.288 17.7369 12.2319 17.7491 12.0801C17.7787 11.62 17.8413 10.7218 17.7687 9.88283C17.6691 8.72851 17.2968 8.15656 16.8553 7.65073C16.6417 7.40542 15.6501 6.35156 13.7364 6.35156C11.8226 6.35156 10.8323 7.40542 10.62 7.64768C10.1772 8.15352 9.80537 8.72546 9.70664 9.87979C9.63401 10.7188 9.69925 11.6165 9.72621 12.0771C9.73491 12.2215 9.69055 12.285 9.56441 12.285C9.53506 12.2845 9.50586 12.2806 9.47743 12.2733C9.24126 12.2163 8.83241 12.0053 8.41139 11.914C8.34271 11.8986 8.27257 11.8907 8.20219 11.8905C7.97819 11.8905 7.76725 11.9775 7.68026 12.2037C7.55587 12.5325 7.72375 12.8 8.10824 13.0679C8.34006 13.2297 9.17558 13.7464 9.36391 13.9208C9.55876 14.1009 9.53353 14.2401 9.51092 14.4171C9.49222 14.5654 9.07163 16.5357 6.4359 17.8096C6.28149 17.8844 6.01879 18.0427 6.482 18.2985C7.20922 18.7004 7.69331 18.6573 8.06953 18.8996C8.38877 19.1053 8.20001 19.5489 8.43227 19.709C8.71759 19.906 9.56094 19.6951 10.6505 20.0548C11.5638 20.3557 12.1188 21.206 13.7385 21.206C15.3582 21.206 15.9293 20.3518 16.8266 20.0548C17.9139 19.6951 18.759 19.906 19.0448 19.709C19.2766 19.5489 19.0883 19.1053 19.4075 18.8996C19.7837 18.6573 20.2674 18.7004 20.9951 18.2985C21.4574 18.0458 21.1947 17.8875 21.0403 17.8126Z" fill="white" />
                                     <path d="M22.187 17.6631C22.0687 17.3412 21.8434 17.169 21.5868 17.0263C21.5385 16.998 21.4942 16.9754 21.4563 16.958C21.3798 16.9184 21.3015 16.8802 21.2236 16.8397C20.4238 16.4156 19.7992 15.8807 19.366 15.2465C19.243 15.068 19.1363 14.8788 19.0472 14.6811C19.0102 14.5754 19.012 14.5154 19.0385 14.4606C19.0648 14.4184 19.0996 14.3821 19.1407 14.354C19.2781 14.2631 19.4199 14.1709 19.5161 14.1087C19.6874 13.9978 19.8231 13.91 19.9105 13.8478C20.2389 13.6181 20.4686 13.3741 20.6121 13.1014C20.7122 12.913 20.7706 12.7052 20.7833 12.4922C20.796 12.2793 20.7627 12.066 20.6856 11.8671C20.4681 11.2947 19.9275 10.9393 19.2725 10.9393C19.1343 10.9392 18.9965 10.9538 18.8615 10.9828C18.8254 10.9907 18.7893 10.9989 18.754 11.0081C18.7601 10.6166 18.7514 10.2034 18.7166 9.79675C18.5931 8.36711 18.0925 7.61771 17.5706 7.0201C17.2363 6.64562 16.8427 6.32879 16.4054 6.08237C15.6133 5.63004 14.7152 5.40039 13.7362 5.40039C12.7571 5.40039 11.8633 5.63004 11.0704 6.08237C10.632 6.32887 10.2376 6.64633 9.90304 7.02184C9.38111 7.61945 8.8805 8.37015 8.75698 9.79849C8.72218 10.2052 8.71348 10.6205 8.71914 11.0098C8.68391 11.0007 8.64824 10.9924 8.61214 10.9846C8.47707 10.9555 8.33929 10.9409 8.20113 10.9411C7.54567 10.9411 7.00417 11.2964 6.78758 11.8688C6.71015 12.0678 6.67649 12.2812 6.68887 12.4944C6.70126 12.7077 6.7594 12.9157 6.85934 13.1045C7.00331 13.3772 7.23295 13.6212 7.56133 13.8508C7.64832 13.9117 7.78445 13.9996 7.95582 14.1118C8.04846 14.1718 8.18373 14.2597 8.31639 14.3475C8.3628 14.3775 8.40225 14.4171 8.43208 14.4636C8.45991 14.5206 8.46078 14.5819 8.41947 14.695C8.33158 14.8885 8.22664 15.0738 8.10587 15.2487C7.68224 15.8685 7.07594 16.3939 6.30175 16.8145C5.8916 17.032 5.46536 17.1772 5.2853 17.6665C5.1496 18.0358 5.23832 18.4559 5.58323 18.81C5.70981 18.9421 5.85663 19.0533 6.01817 19.1392C6.35429 19.324 6.71169 19.4669 7.08246 19.565C7.15898 19.5848 7.23162 19.6173 7.29732 19.6612C7.42302 19.7712 7.40519 19.9369 7.57264 20.1796C7.6567 20.305 7.7635 20.4136 7.88754 20.4997C8.23897 20.7424 8.63389 20.7576 9.0523 20.7737C9.43026 20.7881 9.85868 20.8046 10.348 20.966C10.5507 21.033 10.7612 21.1626 11.0052 21.3139C11.591 21.6741 12.3931 22.1668 13.7353 22.1668C15.0775 22.1668 15.8852 21.6714 16.4754 21.31C16.7177 21.1613 16.9269 21.033 17.1239 20.9677C17.6132 20.8059 18.0416 20.7898 18.4196 20.7755C18.838 20.7594 19.2329 20.7442 19.5843 20.5015C19.7312 20.399 19.8536 20.2654 19.9427 20.11C20.0632 19.9052 20.0602 19.7621 20.1732 19.662C20.2349 19.6202 20.3031 19.5891 20.3751 19.5698C20.7509 19.4714 21.1132 19.3271 21.4537 19.1401C21.6253 19.048 21.7798 18.9271 21.9104 18.7826L21.9147 18.7774C22.2383 18.4312 22.3197 18.0232 22.187 17.6631ZM20.994 18.3042C20.2663 18.706 19.7827 18.663 19.4064 18.9052C19.0868 19.111 19.276 19.5546 19.0437 19.7147C18.7584 19.9117 17.915 19.7007 16.8255 20.0604C15.9269 20.3575 15.3537 21.2117 13.7375 21.2117C12.1212 21.2117 11.5615 20.3592 10.6481 20.0583C9.56074 19.6986 8.71566 19.9095 8.4299 19.7125C8.19808 19.5524 8.38641 19.1088 8.06717 18.9031C7.69051 18.6608 7.20686 18.7039 6.47964 18.3042C6.01643 18.0484 6.27913 17.8901 6.43354 17.8153C9.06926 16.5392 9.48985 14.5689 9.50855 14.4228C9.53117 14.2457 9.5564 14.1066 9.36154 13.9265C9.17321 13.7525 8.3377 13.2354 8.10587 13.0736C7.72226 12.8057 7.5535 12.5382 7.67789 12.2094C7.76488 11.9819 7.97713 11.8962 8.19982 11.8962C8.2702 11.8964 8.34035 11.9043 8.40903 11.9197C8.83005 12.011 9.23889 12.222 9.47506 12.2789C9.5035 12.2862 9.53269 12.2902 9.56205 12.2907C9.68818 12.2907 9.73254 12.2272 9.72385 12.0828C9.69688 11.6222 9.63164 10.7245 9.70427 9.88548C9.80387 8.73115 10.1757 8.15921 10.6176 7.65337C10.8299 7.41024 11.8272 6.35639 13.7344 6.35639C15.6416 6.35639 16.6415 7.40589 16.8538 7.64815C17.2961 8.15399 17.6684 8.72593 17.7672 9.88026C17.8398 10.7193 17.7772 11.6174 17.7476 12.0776C17.7376 12.2294 17.7833 12.2855 17.9094 12.2855C17.9387 12.285 17.9679 12.2811 17.9964 12.2737C18.233 12.2168 18.6418 12.0058 19.0628 11.9145C19.1315 11.8991 19.2017 11.8912 19.2721 11.891C19.496 11.891 19.707 11.978 19.794 12.2041C19.9184 12.533 19.7505 12.8004 19.3664 13.0684C19.1346 13.2302 18.2991 13.7469 18.1108 13.9213C17.9155 14.1013 17.9411 14.2405 17.9638 14.4175C17.9825 14.5659 18.4026 16.5361 21.0388 17.8101C21.1945 17.8879 21.4572 18.0462 20.994 18.3042Z" fill="black" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Snapchat')}}</p>
                             <span class="d-flex flex-column text-white text-center secondary-bg-color align-items-center justify-content-center dashboard-connection-coming-soon">{{__('Coming soon')}}</span>
                         </button>
                     </div>
                     <div class="col-4 col-sm-3 col-md-2 col-lg-auto">
                         <button onclick="addConnection('pinterest')" type="button" class="col bg-white pt-3 g-7 px-md-1 px-xl-2 d-flex flex-column align-items-center dashboard-connections">
                             <span>
                                 <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <rect x="0.5" width="27" height="27" rx="13.5" fill="#BD081C" />
                                     <path d="M13.9971 5.40039C9.5189 5.40039 5.90039 9.02556 5.90039 13.4971C5.90039 16.929 8.03285 19.8611 11.0449 21.0406C10.9716 20.4009 10.9117 19.4146 11.0716 18.7149C11.2182 18.0818 12.0179 14.6899 12.0179 14.6899C12.0179 14.6899 11.778 14.2034 11.778 13.4904C11.778 12.3642 12.431 11.5245 13.244 11.5245C13.9371 11.5245 14.2703 12.0443 14.2703 12.6641C14.2703 13.3571 13.8305 14.3967 13.5972 15.363C13.404 16.1693 14.0037 16.829 14.7967 16.829C16.2361 16.829 17.3424 15.3096 17.3424 13.1239C17.3424 11.1847 15.9496 9.8319 13.9571 9.8319C11.6514 9.8319 10.2986 11.5578 10.2986 13.3438C10.2986 14.0368 10.5651 14.7832 10.8983 15.1897C10.965 15.2697 10.9716 15.343 10.9516 15.4229C10.8917 15.6762 10.7517 16.2293 10.7251 16.3426C10.6918 16.4892 10.6051 16.5225 10.4518 16.4492C9.45226 15.9694 8.82585 14.49 8.82585 13.3038C8.82585 10.7515 10.6784 8.40581 14.177 8.40581C16.9825 8.40581 19.1683 10.405 19.1683 13.0839C19.1683 15.8761 17.409 18.1218 14.97 18.1218C14.1503 18.1218 13.3773 17.6953 13.1174 17.1889C13.1174 17.1889 12.7109 18.7349 12.611 19.1147C12.431 19.8211 11.9379 20.7008 11.6047 21.2405C12.3644 21.4738 13.1641 21.6004 14.0037 21.6004C18.4752 21.6004 22.1004 17.9752 22.1004 13.5037C22.0937 9.02556 18.4685 5.40039 13.9971 5.40039Z" fill="white" />
                                 </svg>
                             </span>
                             <p class="m-0 dashboard-connection-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Pinterest')}}</p>
                             <span class="d-flex flex-column text-white text-center secondary-bg-color align-items-center justify-content-center dashboard-connection-coming-soon">{{__('Coming soon')}}</span>
                         </button>
                     </div>
                 </div>
             </div>
             <!-- footer -->
             <div id="connection-model-footer" class="px-3 px-sm-5 py-3 py-sm-0 d-flex flex-column flex-sm-row justify-content-between align-items-center connection-footer d-none">
                 <div class="d-flex flex-column flex-sm-row align-items-center g-20">
                     <span id="connection-footer-icon">
                         <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M27 13.5821C27 9.97988 25.5776 6.52517 23.0458 3.97802C20.5139 1.43088 17.08 0 13.4994 0C9.91905 0.00030461 6.48542 1.43133 3.95382 3.97844C1.42222 6.52556 -1.28025e-08 9.98008 0 13.5821C0.000344626 16.8165 1.14768 19.9447 3.23569 22.4041C5.32369 24.8635 8.21537 26.4927 11.3907 26.9989V17.508H7.96562V13.5821H11.3907V10.59C11.3907 7.18558 13.4058 5.30651 16.4895 5.30651C17.502 5.32061 18.512 5.40924 19.5116 5.57178V8.91424H17.8105C17.5204 8.8755 17.2253 8.90291 16.9472 8.99444C16.669 9.08597 16.4149 9.23924 16.2036 9.44297C15.9924 9.64669 15.8293 9.89566 15.7267 10.1714C15.624 10.4471 15.5843 10.7424 15.6104 11.0356V13.5832H19.3552L18.7569 17.5091H15.6093V27C18.7846 26.4938 21.6763 24.8646 23.7643 22.4052C25.8523 19.9458 26.9997 16.8176 27 13.5832" fill="#1877F2" />
                         </svg>
                     </span>
                     <div class="d-flex flex-column text-center @if($get_locale=='en')  text-sm-start @else text-sm-end @endif g-5 g-8-576">
                         <p id="connection-model-footer-heading" class="m-0 selected-connection-heading"></p>
                         <p id="connection-model-footer-subheading" class="m-0 selected-connection-sub-heading"></p>
                     </div>
                 </div>
                 <div class="mt-3 mt-sm-0">
                     <button type="button" onclick="login()" class="border-0 d-flex flex-row align-items-center g-15 secondary-bg-color dashboard-connection-next">
                         <span class="text-white dashboard-connection-next-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Next ')}}</span>
                     </button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- sussess modal -->
 <div class="modal fade" id="successmodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="successmodal" tabindex="-1">
     <div class="modal-dialog" style="max-width: 598px;max-height:448px;">
         <div class="modal-content bg-white border-0 custom-modal-content">
             <!-- body -->
             <div class="text-center p-5 d-flex flex-column g-24">
                 <div>
                     <svg width="69" height="69" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" clip-rule="evenodd" d="M61.001 0.396836L62.2457 1.64154C62.7748 2.17065 62.7748 3.02851 62.2457 3.55763C61.7166 4.08675 60.8587 4.08675 60.3296 3.55763L59.0849 2.31293C58.5558 1.78382 58.5558 0.925952 59.0849 0.396837C59.614 -0.132278 60.4719 -0.13228 61.001 0.396836ZM21.2871 5.71354C21.9501 3.82175 21.2438 1.72817 19.5377 0.663358H19.5395C19.0728 0.373283 17.691 -0.293349 15.7271 0.239957C13.7633 0.773262 12.6697 2.83982 12.9202 4.87035C13.1526 6.76935 14.8227 8.4125 16.709 8.59628C18.7719 8.79807 20.6132 7.63957 21.2871 5.71354ZM17.2549 2.68307C18.1017 2.7119 18.8314 3.46501 18.826 4.30281V4.30461C18.8206 5.17303 18.0315 5.93876 17.1721 5.90993C16.3307 5.8811 15.5956 5.12258 15.601 4.28839C15.6064 3.41997 16.3956 2.65424 17.2549 2.68307ZM63.6529 30.2778C65.7843 30.8057 67.9751 29.6292 68.7426 27.5482C68.8165 27.3446 69.1606 26.0221 68.7246 24.5357C68.085 22.8619 66.4239 21.7179 64.6565 21.7359C62.5287 21.7575 60.646 23.4187 60.3901 25.4978C60.1217 27.6851 61.5324 29.7535 63.6529 30.2778ZM63.071 26.0888C63.0602 25.2024 63.7935 24.4871 64.7033 24.4943C65.5861 24.5033 66.2888 25.1915 66.2978 26.06C66.3086 26.9482 65.5771 27.6617 64.6655 27.6545C63.7863 27.6473 63.0818 26.9536 63.071 26.0888ZM30.2734 18.7162C29.8108 20.6908 28.9886 22.5143 27.769 24.2084C27.7145 24.1602 27.6636 24.1163 27.6156 24.0749L27.6156 24.0749C27.5135 23.9868 27.4245 23.9101 27.3421 23.8277C26.848 23.3346 26.3551 22.8403 25.8623 22.346L25.8612 22.3449L25.8601 22.3437L25.8599 22.3435C24.6876 21.1678 23.5154 19.9921 22.3263 18.8333C21.9155 18.4333 21.438 18.046 20.9174 17.8262C19.0725 17.0442 17.2113 18.0352 16.4348 20.1522C15.4009 22.9739 14.3682 25.7961 13.3356 28.6181L13.3343 28.6216L13.333 28.6251C12.1874 31.7559 11.0418 34.8865 9.8948 38.0161C9.06405 40.2829 8.23221 42.5493 7.40038 44.8156L7.39973 44.8174L7.39908 44.8192L7.39842 44.8209L7.39777 44.8227L7.39712 44.8245L7.39647 44.8263L7.39582 44.828L7.39516 44.8298L7.39079 44.8417L7.38921 44.846L7.38918 44.8461C5.02082 51.2987 2.6526 57.7509 0.309963 64.2129C0.0595318 64.9012 -0.0719894 65.7336 0.0649368 66.4362C0.479319 68.5532 2.55123 69.5226 4.73844 68.7208C16.0349 64.5841 27.3295 60.442 38.6241 56.2998C39.6661 55.9176 40.709 55.5378 41.7519 55.1581L41.7523 55.158L41.7526 55.1579L41.753 55.1577L41.7533 55.1576L41.7537 55.1575L41.754 55.1574L41.7543 55.1572L41.7547 55.1571L41.755 55.157L41.7554 55.1569L41.7557 55.1567L41.7561 55.1566L41.7564 55.1565C44.2266 54.2571 46.697 53.3576 49.1548 52.4244C51.5762 51.5055 52.1618 48.7741 50.3925 46.8895C50.1069 46.5858 49.8092 46.2932 49.5115 46.0004C49.3924 45.8832 49.2732 45.766 49.1548 45.6481L44.3858 40.9006C44.433 40.8662 44.4729 40.8374 44.5081 40.812C44.5669 40.7694 44.6127 40.7363 44.6578 40.7024C47.6504 38.4197 51.0267 37.1549 54.7796 36.9297C58.1685 36.7261 61.3754 37.4251 64.4076 38.9656C64.7211 39.1259 65.1481 39.1854 65.494 39.1259C66.0778 39.0251 66.4183 38.5926 66.4832 37.9945C66.5606 37.2666 66.1715 36.827 65.5499 36.5171C59.9702 33.7388 54.2517 33.4199 48.3981 35.5406C46.2343 36.3243 44.2795 37.4954 42.5535 38.8809L40.4041 36.7315C40.4374 36.6956 40.4733 36.6559 40.5114 36.6139L40.5115 36.6138L40.5115 36.6138L40.5115 36.6137L40.5119 36.6133L40.512 36.6132L40.5121 36.613L40.5122 36.613C40.6037 36.512 40.7075 36.3974 40.8167 36.2883C41.1986 35.9049 41.5816 35.5225 41.9648 35.14L41.9649 35.1399L41.9649 35.1398L41.965 35.1397L41.9651 35.1396L41.9652 35.1396L41.9653 35.1395L41.9653 35.1394L41.9654 35.1393L41.9655 35.1392L41.9656 35.1392L41.9657 35.1391L41.9719 35.1328L41.9741 35.1307L41.975 35.1298C42.5267 34.579 43.0785 34.0281 43.6273 33.474C44.348 32.7461 44.4254 31.9245 43.8471 31.339C43.2471 30.7318 42.4562 30.8003 41.7175 31.5318L41.5155 31.7315L41.5154 31.7315L41.5154 31.7316L41.5153 31.7316L41.5152 31.7317L41.5152 31.7317L41.5151 31.7318L41.5151 31.7319L41.515 31.7319L41.515 31.732L41.5149 31.732L41.5148 31.7321L41.5148 31.7321L41.5147 31.7322C40.9426 32.2976 40.3705 32.8629 39.8114 33.4398C39.4881 33.7718 39.1754 34.1151 38.8567 34.4649C38.7171 34.6182 38.5763 34.7727 38.4331 34.928C35.5631 32.0578 32.8155 29.3102 30.068 26.5608C29.9936 26.4865 29.9234 26.408 29.8495 26.3254L29.8494 26.3253C29.8141 26.2859 29.7779 26.2455 29.7401 26.2041C29.7614 26.1686 29.7811 26.1343 29.8003 26.101L29.8003 26.1009C29.8395 26.0329 29.8761 25.9691 29.9185 25.9086C32.9488 21.5485 34.0154 16.7505 33.12 11.5202C32.7921 9.60497 32.1489 7.79065 31.2156 6.08624C30.8391 5.39798 30.0842 5.18358 29.4248 5.5169C28.7546 5.85562 28.5078 6.55468 28.8068 7.29158C28.8855 7.48753 28.9774 7.67819 29.069 7.86809L29.1149 7.96361C30.7634 11.4121 31.1454 15.0029 30.2734 18.7162ZM37.1683 53.9216C37.1097 53.8589 37.0561 53.801 37.0057 53.7467L37.0055 53.7465C36.8779 53.6089 36.7719 53.4945 36.6621 53.3847L30.7977 47.5201L30.7591 47.4817L30.7187 47.4416C30.5691 47.2934 30.4191 47.1447 30.295 46.9778C29.8914 46.4355 29.9437 45.7346 30.4031 45.2536C30.8697 44.7635 31.6282 44.6914 32.1813 45.1022C32.3393 45.2196 32.4798 45.3627 32.6197 45.5052L32.6387 45.5244C32.6663 45.5526 32.694 45.5807 32.7218 45.6085L33.8665 46.752L33.869 46.7544L33.8691 46.7546L33.8693 46.7547L33.8694 46.7549L33.8696 46.755L33.8697 46.7552L33.8699 46.7553L33.87 46.7555L33.8701 46.7556L33.8703 46.7558L33.8704 46.7559L33.8706 46.7561L33.8707 46.7562C35.7779 48.6612 37.6846 50.5657 39.5826 52.4802C39.8654 52.7649 40.0888 52.882 40.5086 52.7234C42.087 52.1278 43.6713 51.5485 45.2554 50.9693L45.2584 50.9682C46.136 50.6473 47.0136 50.3265 47.89 50.0029C48.8467 49.6497 48.926 49.2822 48.2125 48.5687L38.9601 39.3156C32.7788 33.1338 26.5976 26.952 20.4147 20.7702C19.6994 20.0549 19.3301 20.136 18.9806 21.0873C18.7059 21.8354 18.4329 22.5841 18.1598 23.3328L18.1598 23.3328L18.1598 23.3328L18.1598 23.3328L18.1597 23.3328L18.1597 23.3329L18.1597 23.3329L18.1597 23.3329L18.1597 23.3329L18.1597 23.333L18.1597 23.333L18.1597 23.333L18.1597 23.333L18.1597 23.3331C17.5496 25.0056 16.9396 26.6781 16.3123 28.3445C16.1394 28.8058 16.179 29.0904 16.5447 29.449C18.7966 31.6625 21.023 33.903 23.2487 36.1428L23.4631 36.3585C23.6955 36.5928 23.9333 36.8594 24.0595 37.1567C24.3063 37.7332 24.0432 38.4161 23.5208 38.7476C22.955 39.1061 22.3118 39.0251 21.7515 38.4683C19.7102 36.4414 17.6762 34.4055 15.6493 32.3641C15.5342 32.2491 15.4533 32.0999 15.3725 31.9512C15.3344 31.8809 15.2963 31.8108 15.2547 31.7444C14.7966 32.6415 14.4749 33.4618 14.1643 34.2539L14.1643 34.254L14.1643 34.254L14.1642 34.2541L14.1642 34.2541L14.1642 34.2542C14.0632 34.5118 13.9633 34.7665 13.8603 35.0199C13.6873 35.4451 13.7864 35.6937 14.0981 36.0036C16.2975 38.1844 18.4871 40.3752 20.6763 42.5655L20.6764 42.5656L20.6765 42.5657L20.6765 42.5657L20.6766 42.5658L20.6767 42.5659L20.6767 42.5659L20.6768 42.566L20.6872 42.5764C21.4496 43.3392 22.2121 44.1021 22.9749 44.8644C23.6427 45.5319 24.3104 46.1994 24.978 46.867L24.9791 46.868L24.9813 46.8702C27.6502 49.5387 30.3189 52.2068 32.9957 54.8693C33.1632 55.0368 33.4731 55.2548 33.6353 55.2026C34.5216 54.9122 35.3965 54.5853 36.3012 54.2472L36.3014 54.2472C36.5864 54.1407 36.8744 54.0331 37.1665 53.9252L37.1683 53.9216ZM12.6125 38.5557L12.6125 38.5558C12.5776 38.6097 12.5362 38.6737 12.5108 38.7422C12.3578 39.1587 12.2045 39.5751 12.0513 39.9915C11.1765 42.3694 10.3015 44.7476 9.45519 47.1363C9.37952 47.3489 9.50924 47.7453 9.6822 47.9201C11.7364 49.991 13.7971 52.055 15.8577 54.1191C17.5887 55.853 19.3198 57.5869 21.0471 59.3249C21.3552 59.6348 21.6074 59.642 21.9857 59.4997C23.4395 58.9515 24.8983 58.4183 26.3568 57.8852L26.358 57.8848C26.8549 57.7032 27.3517 57.5216 27.8483 57.3394C28.742 57.0115 29.6356 56.6836 30.5184 56.3593C27.5222 53.363 24.5383 50.3785 21.5588 47.3986C18.5883 44.4275 15.6223 41.461 12.6531 38.4917L12.6513 38.4935C12.6407 38.5122 12.6272 38.5331 12.6125 38.5557ZM8.23006 50.4443C8.12003 50.7421 8.00938 51.038 7.89915 51.3327C7.59065 52.1575 7.28549 52.9734 7.00674 53.7991C6.94728 53.9738 7.04277 54.2891 7.17969 54.4279C9.62635 56.9016 12.0874 59.3591 14.5539 61.8131C14.6656 61.9248 14.8836 62.0617 14.9971 62.0239C15.9348 61.7066 16.8657 61.3679 17.7943 61.0301L17.7944 61.03L17.7945 61.03L17.7947 61.0299L17.7976 61.0289C18.0437 60.9393 18.2897 60.8499 18.5356 60.7609L15.1355 57.3575L15.124 57.3461C12.8271 55.0471 10.5419 52.7598 8.23006 50.4443ZM5.1073 58.9446C5.33471 58.3234 5.56189 57.7029 5.78833 57.0831L11.8928 63.1878C11.5917 63.2995 11.2868 63.413 10.9792 63.5275L10.9782 63.5279L10.9768 63.5284C10.3081 63.7774 9.62664 64.0311 8.94352 64.2814C8.60229 64.4061 8.26119 64.531 7.9201 64.656L7.91917 64.6564C6.49566 65.178 5.07224 65.6996 3.63943 66.1966C3.41062 66.2759 3.04128 66.2381 2.86472 66.0957C2.72599 65.9858 2.69176 65.5966 2.76743 65.3876C3.53667 63.2348 4.32322 61.0863 5.10696 58.9455L5.10713 58.9451L5.10716 58.945L5.10719 58.9449L5.10721 58.9448L5.1073 58.9446ZM42.429 22.8968C44.8216 22.904 46.7494 20.9816 46.753 18.5871C46.7566 16.171 44.8703 14.2702 42.4615 14.263C40.058 14.2558 38.1285 16.1656 38.1231 18.5547C38.1177 20.9366 40.0562 22.8914 42.429 22.8968ZM42.4867 16.9674C43.3407 16.9908 44.0559 17.7259 44.0523 18.5763C44.0487 19.4267 43.3263 20.1618 42.4741 20.1798C41.6057 20.1979 40.8346 19.4375 40.8364 18.5637C40.84 17.6899 41.6093 16.944 42.4867 16.9674ZM52.8316 23.4551C51.9001 23.4822 51.2858 23.0029 51.2245 22.2048C51.1669 21.4426 51.7704 20.8355 52.664 20.7562C53.8801 20.6499 54.6711 19.9058 54.7576 18.632C54.8548 17.205 55.2945 15.9654 56.3556 14.9763C57.2475 14.1457 58.3104 13.7277 59.5139 13.6593C60.3175 13.6142 60.9607 14.1385 61.0327 14.8682C61.1066 15.6303 60.631 16.2195 59.813 16.3744C58.0348 16.7095 57.6817 17.0951 57.4979 18.913C57.2402 21.4607 55.2602 23.3885 52.8298 23.4569L52.8316 23.4551ZM44.1871 7.36599C46.7346 7.17681 48.7164 5.21475 48.7633 2.83469C48.7813 1.94465 48.3237 1.34108 47.5562 1.24378C46.8932 1.1591 46.2103 1.67619 46.086 2.35544C45.7581 4.15534 45.4086 4.48506 43.6195 4.66883C41.1963 4.91927 39.4397 6.72458 39.2811 9.12626C39.2217 10.0235 39.7225 10.6829 40.5189 10.7514C41.2702 10.8163 41.8827 10.2577 41.9962 9.40372C42.1818 8.0128 42.7637 7.47229 44.1871 7.36599ZM27.0632 40.5568C27.8451 40.546 28.4234 41.1117 28.4234 41.8901C28.4234 42.6594 27.8271 43.263 27.074 43.254C26.3713 43.2468 25.7516 42.6378 25.7264 41.9315C25.7011 41.1856 26.3029 40.5658 27.0632 40.555V40.5568ZM68.5894 7.98705L67.3447 6.74236C66.8157 6.21324 65.9578 6.21324 65.4287 6.74235C64.8996 7.27147 64.8996 8.12934 65.4287 8.65845L66.6734 9.90315C67.2025 10.4323 68.0603 10.4323 68.5894 9.90315C69.1185 9.37403 69.1185 8.51617 68.5894 7.98705ZM59.084 7.9866L60.3287 6.7419C60.8578 6.21279 61.7156 6.21279 62.2447 6.7419C62.7738 7.27102 62.7738 8.12888 62.2447 8.658L61 9.9027C60.4709 10.4318 59.6131 10.4318 59.084 9.9027C58.5549 9.37358 58.5549 8.51572 59.084 7.9866ZM46.8199 26.4802L45.5752 27.7249C45.0461 28.254 45.0461 29.1119 45.5752 29.641C46.1043 30.1701 46.9622 30.1701 47.4913 29.641L48.7359 28.3963C49.265 27.8672 49.265 27.0093 48.7359 26.4802C48.2068 25.9511 47.349 25.9511 46.8199 26.4802ZM65.4268 1.64187L66.6714 0.397176C67.2005 -0.13194 68.0584 -0.131938 68.5875 0.397177C69.1166 0.926292 69.1166 1.78416 68.5875 2.31327L67.3428 3.55797C66.8137 4.08708 65.9559 4.08709 65.4268 3.55797C64.8977 3.02885 64.8977 2.17099 65.4268 1.64187ZM62.2574 48.6249L61.0127 47.3802C60.4836 46.8511 59.6258 46.8511 59.0967 47.3802C58.5676 47.9093 58.5676 48.7672 59.0967 49.2963L60.3413 50.541C60.8704 51.0701 61.7283 51.0701 62.2574 50.541C62.7865 50.0119 62.7865 49.154 62.2574 48.6249ZM67.3594 53.724L68.6041 54.9687C69.1332 55.4978 69.1332 56.3557 68.6041 56.8848C68.075 57.4139 67.2171 57.4139 66.688 56.8848L65.4434 55.6401C64.9143 55.111 64.9143 54.2531 65.4434 53.724C65.9725 53.1949 66.8303 53.1949 67.3594 53.724ZM60.3404 53.7243L59.0957 54.969C58.5666 55.4981 58.5666 56.356 59.0957 56.8851C59.6248 57.4142 60.4827 57.4142 61.0118 56.8851L62.2564 55.6404C62.7855 55.1113 62.7855 54.2534 62.2564 53.7243C61.7273 53.1952 60.8695 53.1952 60.3404 53.7243ZM65.4424 48.6243L66.6871 47.3796C67.2162 46.8505 68.074 46.8505 68.6031 47.3796C69.1322 47.9087 69.1322 48.7666 68.6031 49.2957L67.3584 50.5404C66.8293 51.0695 65.9715 51.0695 65.4424 50.5404C64.9133 50.0113 64.9133 49.1534 65.4424 48.6243Z" fill="url(#paint0_linear_2644_2994)" />
                         <defs>
                             <linearGradient id="paint0_linear_2644_2994" x1="68.9999" y1="13.0009" x2="0.00189823" y2="69.0027" gradientUnits="userSpaceOnUse">
                                 <stop stop-color="#F2C5A7" />
                                 <stop offset="1" stop-color="#F58B1E" />
                             </linearGradient>
                         </defs>
                     </svg>
                 </div>
                 <div class="d-flex flex-column g-13">
                     <p id="success-primary-text" class="m-0 primary-text-color sucess-modal-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Congratulation!!')}}</p>
                     <p id="success-secondary-text" class="m-0 sucess-modal-secondary-text primary-text-color text-center"></p>
                 </div>
             </div>
             <!-- footer -->
             <!-- will show on connection success -->
             <div id="connection-success-footer" class="px-3 px-sm-5 py-3 py-md-0 d-flex flex-row justify-content-between align-items-center connection-footer d-none">
                 <div>&nbsp;</div>
                 <div class="d-flex flex-row align-items-center justify-content-between justify-content-sm-end w-100 g-26">
                     <span class="border-0 bg-white p-0">
                         <span class="success-footer-light-btn @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Choose a Report')}}</span>
                     </span>
                     <button type="button" onclick="showReportModal()" class="border-0 d-flex flex-row align-items-center g-15 secondary-bg-color dashboard-connection-next">
                         <span class="text-white dashboard-connection-next-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Next')}}</span>
                     </button>
                 </div>
             </div>
             <!-- will show on report success -->
             <div id="report-success-footer" class="px-3 px-sm-5 py-3 py-md-0 d-flex flex-row justify-content-between align-items-center connection-footer d-none">
                 <div>&nbsp;</div>
                 <!-- will show on report success -->
                 <div class="d-flex flex-row align-items-center justify-content-between justify-content-sm-end w-100 g-26">
                     <span class="border-0 bg-white p-0">
                         <span class="success-footer-light-btn @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('invite team member')}}</span>
                     </span>
                     <button type="button" onclick="showInviteModal()" class="border-0 d-flex flex-row align-items-center g-15 secondary-bg-color dashboard-connection-next">
                         <span class="text-white dashboard-connection-next-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Next')}}</span>
                     </button>
                 </div>
             </div>
             <!-- will show on invitation success -->
             <div id="invite-success-footer" class="px-3 px-sm-5 py-3 py-md-0 d-flex flex-row justify-content-between align-items-center connection-footer d-none">
                 <div>&nbsp;</div>
                 <!-- will show on invitation success -->
                 <div class="d-flex flex-row align-items-center justify-content-between justify-content-sm-end w-100 g-26">
                     <span class="border-0 bg-white p-0">
                         <span class="success-footer-light-btn @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Update account information')}}</span>
                     </span>
                     <button type="button" onclick="showUpdateInfoModal()" class="border-0 d-flex flex-row align-items-center g-15 secondary-bg-color dashboard-connection-next">
                         <span class="text-white dashboard-connection-next-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Next')}}</span>
                     </button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- reports modal -->
 <div class="modal fade" id="reportsmodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="reportsmodal" tabindex="-1">
     <div class="modal-dialog" style="max-width: 1020px;max-height:762px;">
         <div class="modal-content bg-white border-0 custom-modal-content">
             <!-- header -->
             <div class="px-3 px-sm-5 py-5">
                 <!-- <button type="button" data-bs-dismiss="modal" class="border-0 bg-white d-flex flex-row align-items-center position-absolute g-9">
                     <span @if($get_locale=='ar' ) style=" transform: rotateY(180deg);" @endif>
                         <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M6.28033 0.46967C6.57322 0.762563 6.57322 1.23744 6.28033 1.53033L2.56066 5.25H11.25C11.6642 5.25 12 5.58579 12 6C12 6.41421 11.6642 6.75 11.25 6.75H2.56066L6.28033 10.4697C6.57322 10.7626 6.57322 11.2374 6.28033 11.5303C5.98744 11.8232 5.51256 11.8232 5.21967 11.5303L0.21967 6.53033C-0.0732233 6.23744 -0.0732233 5.76256 0.21967 5.46967L5.21967 0.46967C5.51256 0.176777 5.98744 0.176777 6.28033 0.46967Z" fill="#F58B1E" />
                         </svg>
                     </span>
                     <p class="m-0 secondary-text-color popup-back @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back ')}}</p>
                 </button> -->
                 <div class="text-center d-flex flex-column mt-5 mt-sm-0 g-17 g-6-576">
                     <p class="m-0 primary-text-color connections-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Report')}}</p>
                 </div>
             </div>
             <!-- sub header -->
             <div id="all-connections">
                 <!-- data will come through ajxa respose in html -->
             </div>
             <!-- body -->
             <div id="report-templates" class="d-md-flex flex-row px-3 px-sm-5 py-4">
                 <!-- data will come through ajxa respose in html -->
                 
                <div class="d-none d-md-inline" style="height:403px;width: 545px;overflow:hidden">
                    @if($get_locale=='en')
                        <img id="template-demo-images" class="template-img-mobile img-fluid" src="{{url('../../assets/v2/dashboard-temp-img/facebook-temp.png')}}" alt="fb-dashboard-img">
                    @else
                        <img id="template-demo-images" class="template-img-mobile img-fluid" src="{{url('../../assets/v2/dashboard-temp-img/facebook-temp-ar.png')}}" alt="fb-dashboard-img">
                    @endif
                </div>
             </div>
             <!-- footer -->
             <div id="report_modal_footer" class="px-3 px-sm-5 py-4 py-sm-0 d-flex flex-column flex-sm-row justify-content-between align-items-center connection-footer d-none">
                 <div class="d-flex flex-column align-items-center g-5 g-8-576">
                     <div class="w-100">
                         <p class="m-0 report-cant-find @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__("Can't find what you're looking for?")}}</p>
                     </div>
                     <a href="{{ url('/dashboard/subscribe-plan') }}" class="m-0 secondary-text-color text-decoration-underline add-new-connector @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Upgrade and Add New Connector')}}</a>
                 </div>
                 <div class="mt-4 mt-sm-0">
                     <button onclick="chooseTemplates()" type="button" class="border-0 d-flex flex-row align-items-center g-15 secondary-bg-color dashboard-report-add">
                         <span class="text-white dashboard-connection-next-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add Report')}}</span>
                     </button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- invite team members modal -->
 <div class="modal fade" id="invitemodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="invitemodal" tabindex="-1">
     <div class="modal-dialog" style="max-width: 1020px;max-height:373px;">
         <div class="modal-content bg-white border-0 custom-modal-content">
             <!-- header -->
             <div class="px-3 px-sm-5 py-5">
                 <!-- <button type="button" data-bs-dismiss="modal" class="border-0 bg-white d-flex flex-row align-items-center position-absolute g-9">
                     <span @if($get_locale=='ar' ) style=" transform: rotateY(180deg);" @endif>
                         <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M6.28033 0.46967C6.57322 0.762563 6.57322 1.23744 6.28033 1.53033L2.56066 5.25H11.25C11.6642 5.25 12 5.58579 12 6C12 6.41421 11.6642 6.75 11.25 6.75H2.56066L6.28033 10.4697C6.57322 10.7626 6.57322 11.2374 6.28033 11.5303C5.98744 11.8232 5.51256 11.8232 5.21967 11.5303L0.21967 6.53033C-0.0732233 6.23744 -0.0732233 5.76256 0.21967 5.46967L5.21967 0.46967C5.51256 0.176777 5.98744 0.176777 6.28033 0.46967Z" fill="#F58B1E" />
                         </svg>
                     </span>
                     <p class="m-0 secondary-text-color popup-back @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back ')}}</p>
                 </button> -->
                 <div class="text-center d-flex flex-column mt-5 mt-sm-0 g-17  g-6-576">
                     <p class="m-0 primary-text-color connections-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add More Users ')}}</p>
                 </div>
             </div>
             <!-- body -->
             <form id="invite_form" onsubmit="addUsers(event)" method="POST">
                 <div id="apd" class="d-flex flex-column g-15 px-3 px-lg-5 pt-4 pb-5">
                     <div class="invite-modal-row d-flex flex-column g-15">
                         <div class="d-flex flex-column flex-md-row g-17 justify-content-between align-items-center g-21 @if($get_locale=='ar') invite-row-ar  @else invite-row-en @endif ">
                             <div>
                                 <div class="name-div d-flex flex-row justify-content-between align-items-center g-32 g-0-768">
                                     <p class="m-0 primary-text-color invite-memeber-label invite-lable-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Name')}}</p>
                                     <input name="name[]" oninput="onFieldInput('name', this)" onblur="onFieldBlur('name', this)" required type="text" placeholder="{{__('Name')}}" class="bg-white invite-member-textbox invite-input name">
                                 </div>
                                 <p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>
                             </div>
                             <div>
                                 <div class="email-div d-flex flex-row justify-content-between align-items-center g-36 g-0-768">
                                     <p class="m-0 primary-text-color invite-memeber-label invite-lable-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Email ')}}</p>
                                     <input name="email[]" oninput="onFieldInput('email', this)" onblur="onFieldBlur('email', this)" required type="email" placeholder="namesurname@email.com" class="bg-white invite-member-textbox invite-input email">
                                 </div>
                                 <p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>
                             </div>
                             <div>
                                 <div class="job-div d-flex flex-row justify-content-between align-items-center g-10 g-0-768">
                                     <p class="m-0 primary-text-color invite-memeber-label invite-lable-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__(' Job Title')}}</p>
                                     <input name="job_position[]" oninput="onFieldInput('job_position', this)" onblur="onFieldBlur('job_position', this)" required type="text" placeholder="{{__('Manager')}}" class="bg-white invite-member-textbox invite-input job-title">
                                 </div>
                                 <p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>
                             </div>
                         </div>
                         <div class="d-flex flex-column flex-md-row g-17 align-items-center g-21 @if($get_locale=='ar') invite-2nd-row-ar  @else invite-2nd-row-en  @endif">
                             <div>
                                 <div class="location-div d-flex flex-row justify-content-between align-items-center g-14 g-0-768" style="@if($get_locale=='ar') gap:28px @endif">
                                     <p class="m-0 primary-text-color invite-memeber-label invite-lable-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Location')}}</p>
                                     <select name="location[]" oninput="onFieldInput('location', this)" onblur="onFieldBlur('location', this)" required class=" invite-member-textbox invite-location-select-box invite-input location" style="background: #D0D8E3;">
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
                                 <div class="role-div d-flex flex-row justify-content-between align-items-center g-43 g-0-768" style="@if($get_locale=='ar') gap: 56px; @endif">
                                     <p class="m-0 primary-text-color invite-memeber-label invite-lable-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Role ')}}</p>
                                     <select name="role[]" oninput="onFieldInput('role', this)" onblur="onFieldBlur('role', this)" required class="invite-member-textbox invite-role-select-box invite-input role" style="background: #D0D8E3;">
                                         <option value="">{{__('Role ')}}</option>
                                         <option value="Member">{{__('Member')}}</option>
                                         <option value="Admin">{{__('Admin')}}</option>
                                         <option value="Owener">{{__('Owner')}}</option>
                                     </select>
                                 </div>
                                 <p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>
                             </div>
                             <div class="d-none d-md-inline">
                                 <button type="button" onclick="addMoreUsers(event)" class="border-0 bg-white d-flex flex-row justify-content-between align-items-center g-10">
                                     <p class="m-0 primary-text-color invite-memeber-label">
                                         <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                         </svg>
                                     </p>
                                     <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Add new ')}}</p>
                                 </button>
                                 <p class="error-text mb-0 input-error-msg text-center d-none" style="font-size: 14px;">&nbsp;</p>
                             </div>
                             <div class="d-flex flex-row justify-content-between align-items-center d-md-none width-invite-users-number">
                                 <button type="button" onclick="addMoreUsers(event)" class="border-0 bg-white d-flex flex-row justify-content-between align-items-center g-10">
                                     <p class="m-0 primary-text-color invite-memeber-label">
                                         <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                             <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                         </svg>
                                     </p>
                                     <p class="m-0 primary-text-color invite-memeber-label">Add new </p>
                                 </button>
                                 <p class="m-0 number-user ">Users number: <span id="added-members">0</span>/<span id="allowed-members">0</span></p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- footer -->
                 <div class="px-3 px-sm-5 py-3 py-md-0 d-flex flex-column-reverse flex-md-row justify-content-between align-items-center connection-footer">
                     <button type="button" onclick="showUpdateInfoModal()" class="border-0 bg-white mt-4 mt-md-0 p-0">
                         <span class="m-0 success-footer-light-btn @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Skip to Update account information')}}</span>
                     </button>
                     <div class="d-none d-md-inline">
                         <p class="m-0 number-user @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Users number')}}: <span id="added-members">0</span>/<span id="allowed-members">0</span></p>
                     </div>
                     <div class="d-flex flex-column flex-md-row g-10 align-items-center justify-content-center">
                         <button type="button" class="border-0 bg-white p-0">
                             <span class="success-footer-light-btn @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Update account information')}}</span>
                         </button>
                         <button type="submit" style="width: 148px;" disabled class="add-users-btn confirm-btn-invite border-0  g-15 secondary-bg-color dashboard-invite-confirm disable-btn">
                             <span class="text-white dashboard-connection-next-text  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Save and Next')}}</span>
                         </button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- update info modal -->
 <div class="modal fade" id="infomodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="infomodal" tabindex="-1">
     <div class="modal-dialog" style="max-width: 1020px;max-height:547px;">
         <div class="modal-content bg-white border-0 custom-modal-content">
             <!-- header -->
             <div class="px-3 px-sm-5 py-5">
                 <!-- <button type="button" data-bs-dismiss="modal" class="border-0 bg-white d-flex flex-row align-items-center position-absolute g-9">
                     <span @if($get_locale=='ar' ) style=" transform: rotateY(180deg);" @endif>
                         <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M6.28033 0.46967C6.57322 0.762563 6.57322 1.23744 6.28033 1.53033L2.56066 5.25H11.25C11.6642 5.25 12 5.58579 12 6C12 6.41421 11.6642 6.75 11.25 6.75H2.56066L6.28033 10.4697C6.57322 10.7626 6.57322 11.2374 6.28033 11.5303C5.98744 11.8232 5.51256 11.8232 5.21967 11.5303L0.21967 6.53033C-0.0732233 6.23744 -0.0732233 5.76256 0.21967 5.46967L5.21967 0.46967C5.51256 0.176777 5.98744 0.176777 6.28033 0.46967Z" fill="#F58B1E" />
                         </svg>
                     </span>
                     <p class="m-0 secondary-text-color popup-back @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back ')}}</p>
                 </button> -->
                 <div class="text-center d-flex flex-column mt-4 mt-sm-0 g-17 g-6-576">
                     <p class="m-0 primary-text-color connections-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Account')}}</p>
                 </div>
             </div>
             <!-- body -->
             <div class="px-5">
                 <div class="alert alert-warning d-none" id="alert-div-info" role="alert"></div>
             </div>

             <form id="info_form" onsubmit="addInfo(event)" method="POST" enctype="multipart/form-data">
                 @csrf
                 <div class="d-flex flex-column  flex-lg-row g-17 px-5 pt-0 pt-lg-4 pb-5">
                     <div class="d-flex flex-column g-17 justify-content-between align-items-center pb-4 pb-lg-0 info-img-container">
                         <div class="position-relative info-img-wrapper">
                             @if(Auth::user())
                             <img id="profile-image-to-show" src="{{url('/assets/' . !empty(Auth::user()->image) && Auth::user()->image !== null && Auth::user()->image !== '' ? 'storage/images/' . Auth::user()->image  : 'assets/image_new/default-avatar.svg')}}" alt="User image">
                             @endif
                             <label role="button" class="position-absolute info-img-lable">
                                 <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <rect x="0.6" y="0.6" width="31.7191" height="31.7187" rx="15.8593" fill="white" />
                                     <path d="M22.2127 10.7067C21.7595 10.2542 21.1452 10 20.5047 10C19.8643 10 19.25 10.2542 18.7967 10.7067L10.9767 18.5267C10.6662 18.8354 10.42 19.2027 10.2523 19.6072C10.0847 20.0117 9.99893 20.4455 10 20.8833V22.252C10 22.4288 10.0702 22.5984 10.1953 22.7234C10.3203 22.8484 10.4899 22.9187 10.6667 22.9187H12.0353C12.4732 22.9199 12.9069 22.8343 13.3114 22.6667C13.716 22.4992 14.0832 22.2531 14.392 21.9427L22.2127 14.122C22.6651 13.6688 22.9191 13.0547 22.9191 12.4144C22.9191 11.7741 22.6651 11.1599 22.2127 10.7067ZM13.4493 21C13.0733 21.3735 12.5653 21.5838 12.0353 21.5853H11.3333V20.8833C11.3327 20.6206 11.3841 20.3603 11.4847 20.1176C11.5853 19.8749 11.733 19.6546 11.9193 19.4693L17.1254 14.2634L18.6587 15.7967L13.4493 21ZM21.2694 13.1794L19.5987 14.8507L18.0654 13.3207L19.7367 11.6494C19.8374 11.5489 19.9569 11.4693 20.0884 11.415C20.2198 11.3607 20.3607 11.3328 20.5029 11.333C20.6451 11.3331 20.7859 11.3613 20.9173 11.4159C21.0486 11.4705 21.1679 11.5504 21.2684 11.651C21.3689 11.7517 21.4485 11.8712 21.5028 12.0027C21.5571 12.1341 21.5849 12.275 21.5848 12.4172C21.5846 12.5594 21.5565 12.7003 21.5019 12.8316C21.4473 12.9629 21.3674 13.0822 21.2667 13.1827L21.2694 13.1794Z" fill="#0B243A" />
                                     <rect x="0.6" y="0.6" width="31.7191" height="31.7187" rx="15.8593" stroke="#0B243A" stroke-width="1.2" />
                                 </svg>
                                 <input hidden="" type="file" name="image" id="info-profile-img" accept="image/png, image/jpeg">
                             </label>
                         </div>
                     </div>
                     <div class="d-flex flex-column g-17 justify-content-between align-items-center">
                         <div class="d-flex flex-column flex-md-row g-17 align-items-center">
                             <div class="d-flex flex-row justify-content-between align-items-center info-modal-input-wrapper">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('First Name')}}
                                     <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                                     </svg>
                                 </p>
                                 <div>
                                     <input name="first_name" id="info_first_name" type="text" placeholder="{{__('First Name')}}" class="bg-white invite-member-textbox">
                                     <p id="info_first_name-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                             <div class="d-flex flex-row justify-content-between align-items-center @if($get_locale=='ar') info-modal-input-wrapper-ar @else info-modal-input-wrapper @endif ">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Last Name')}}
                                     <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                                     </svg>
                                 </p>
                                 <div>
                                     <input name="last_name" id="info_last_name" type="text" placeholder="{{__('Last Name')}}" class="bg-white invite-member-textbox ">
                                     <p id="info_last_name-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                         </div>
                         <div class="d-flex flex-column flex-md-row g-17 align-items-center">
                             <div class="d-flex flex-row justify-content-between align-items-center info-modal-input-wrapper">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__(' Location')}}</p>
                                 <div>
                                     <select name="location" id="info_location" class="bg-white invite-member-textbox">
                                         <option value="">{{__(' Location')}}</option>
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
                                     <p id="info_location-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                             <div class="d-flex flex-row justify-content-between align-items-center @if($get_locale=='ar') info-modal-input-wrapper-ar @else info-modal-input-wrapper @endif">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('City')}}</p>
                                 <div>
                                     <input name="city" id="info_city" type="text" placeholder="{{__('City')}}" class="bg-white invite-member-textbox">
                                     <p id="info_city-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                         </div>
                         <div class="d-flex flex-column flex-md-row g-17 align-items-center">
                             <div class="d-flex flex-row justify-content-between align-items-center info-modal-input-wrapper">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Street Adress')}}</p>
                                 <div>
                                     <input name="address" id="info_address" type="text" placeholder="Street Name 23B" class="bg-white invite-member-textbox ">
                                     <p id="info_address-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                             <div class="d-flex flex-row justify-content-between align-items-center @if($get_locale=='ar') info-modal-input-wrapper-ar @else info-modal-input-wrapper @endif">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Postal Code')}}</p>
                                 <div>
                                     <input name="postal_code" id="info_postal_code" type="text" placeholder="12345" class="bg-white invite-member-textbox ">
                                     <p id="info_postal_code-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                         </div>
                         <div class="d-flex flex-column flex-md-row g-17 align-items-center">
                             <div class="d-flex flex-row justify-content-between align-items-center info-modal-input-wrapper">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Phone')}}</p>
                                 <input name="phone" type="text" id="info_phone" @if(Auth::check()) @if(Auth::user()->phone_verified) readonly disabled @endif @endif class="@if($get_locale=='ar') pe-5 @else ps-5 @endif px-sm-5 bg-white invite-member-textbox ">
                                 <p id="info_phone-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                             </div>
                             <div class="d-flex flex-row justify-content-between align-items-center @if($get_locale=='ar') info-modal-input-wrapper-ar @else info-modal-input-wrapper @endif">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Email ')}}</p>
                                 <div>
                                     <input name="email" id="info_email" @if(Auth::check()) @if(Auth::user()->email_verified) readonly disabled @endif @endif type="text" placeholder="namesurname@email.com" class="bg-white invite-member-textbox">
                                     <p id="info_email-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                         </div>
                         <div class="d-flex flex-column flex-md-row g-17 align-items-center">
                             <div class="d-flex flex-row justify-content-between align-items-center info-modal-input-wrapper">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Timezone')}}</p>
                                 <div>
                                     <select name="timezone" id="info_timezone" class="bg-white invite-member-textbox ">
                                         <option value="">{{__('Timezone')}}</option>
                                         <option value="GMT">GMT</option>
                                         <option value="GMT+1:00">GMT+1:00</option>
                                         <option value="GMT+2:00">GMT+2:00</option>
                                         <option value="GMT+3:00">GMT+3:00</option>
                                         <option value="GMT+3:30">GMT+3:30</option>
                                         <option value="GMT+4:00">GMT+4:00</option>
                                         <option value="GMT+5:00">GMT+5:00</option>
                                         <option value="GMT+5:30">GMT+5:30</option>
                                         <option value="GMT+6:00">GMT+6:00</option>
                                         <option value="GMT+7:00">GMT+7:00</option>
                                         <option value="GMT+8:00">GMT+8:00</option>
                                         <option value="GMT+9:00">GMT+9:00</option>
                                         <option value="GMT+9:30">GMT+9:30</option>
                                         <option value="GMT+10:00">GMT+10:00</option>
                                         <option value="GMT+11:00">GMT+11:00</option>
                                         <option value="GMT+12:00">GMT+12:00</option>
                                         <option value="GMT-11:00">GMT-11:00</option>
                                         <option value="GMT-10:00">GMT-10:00</option>
                                         <option value="GMT-9:00">GMT-9:00</option>
                                         <option value="GMT-8:00">GMT-8:00</option>
                                         <option value="GMT-7:00">GMT-7:00</option>
                                         <option value="GMT-6:00">GMT-6:00</option>
                                         <option value="GMT-5:00">GMT-5:00</option>
                                         <option value="GMT-4:00">GMT-4:00</option>
                                         <option value="GMT-3:30">GMT-3:30</option>
                                         <option value="GMT-3:00">GMT-3:00</option>
                                         <option value="GMT-1:00">GMT-1:00 </option>
                                     </select>
                                     <p id="info_timezone-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                             <div class="d-flex flex-row justify-content-between align-items-center @if($get_locale=='ar') info-modal-input-wrapper-ar @else info-modal-input-wrapper @endif">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Website')}}</p>
                                 <div>
                                     <input name="website" id="info_website" type="text" placeholder="www.example.com" class="bg-white invite-member-textbox">
                                     <p id="info_website-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                         </div>
                         <div class="d-flex flex-column flex-md-row g-17 align-items-center">
                             <div class="d-flex flex-row justify-content-between align-items-center info-modal-input-wrapper">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Role ')}}
                                     <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                                     </svg>
                                 </p>
                                 <div>
                                     <select name="role" id="info_role" class="bg-white invite-member-textbox">
                                         <option value="">{{__('Role ')}}</option>
                                         <option value="Member">{{__('Member')}}</option>
                                         <option value="Admin">{{__('Admin')}}</option>
                                         <option value="Owener">{{__('Owner')}}</option>
                                     </select>
                                     <p id="info_role-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                             <div class="d-flex flex-row justify-content-between align-items-center @if($get_locale=='ar') info-modal-input-wrapper-ar @else info-modal-input-wrapper @endif">
                                 <p class="m-0 primary-text-color invite-memeber-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__(' Job Title')}}</p>
                                 <div>
                                     <input name="job_title" id="info_job_title" type="text" placeholder="{{__(' Job Title')}}" class="bg-white invite-member-textbox">
                                     <p id="info_job_title-error" style="width: 220px;" class="mb-0 input-error-msg d-none"></p>
                                 </div>
                             </div>
                         </div>
                     </div>

                 </div>
                 <!-- footer -->
                 <div class="px-3 px-md-5 py-3 py-md-0 d-flex flex-row justify-content-center justify-content-md-between align-items-center connection-footer">
                     <div>
                         <p class="m-0 number-user">&nbsp;</p>
                     </div>
                     <div>
                         <button type="submit" class="confirm-btn-invite border-0 g-15 secondary-bg-color dashboard-invite-confirm">
                             <span class="text-white dashboard-connection-next-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__(' Confirm')}}</span>
                         </button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- final sussess modal -->
 <div class="modal fade" id="finalmodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="finalmodal" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered" style="max-width:484px;max-height:523px;">
         <div class="modal-content bg-white border-0 custom-modal-content">
             <!-- body -->
             <div class="text-center px-5 d-flex flex-column g-24">
                 <div class="modal-mascot-container direction-ltr-important ">
                     <img src="{{url('/assets/v2/mascot.png')}}">
                 </div>
                 <div class="d-flex flex-column g-13">
                     <p class="m-0 primary-text-color sucess-modal-primary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__(' Congratulation!!')}}</p>
                     <p id="success-secondary-text" class="m-0  primary-text-color text-center sucess-modal-secondary-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('You just set up first report')}}</p>
                 </div>

             </div>
             <div class="px-5 py-5 d-flex flex-row justify-content-between align-items-center text-center">
                 <a href="{{url('/dashboard')}}" class="border-0 text-decoration-none g-15 secondary-bg-color final-success-primary-btn">
                     <span class="text-white final-success-primary-btn-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('See your report')}}</span>
                 </a>
             </div>
         </div>
     </div>
 </div>
 <!-- email sent modal -->
 <div class="modal fade" id="emailSentmodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="emailSentmodal" tabindex="-1">
     <div class="modal-dialog" style="max-width:620px;max-height:435px;">
         <div class="modal-content bg-white border-0 custom-modal-content">
             <!-- body -->
             <div class="text-center d-flex flex-column" style="padding: 50px 100px;gap: 43px;">
                 <div>
                     <svg width="122" height="70" viewBox="0 0 122 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <g clip-path="url(#clip0_3097_5595)">
                             <path d="M22.4908 60.6103C32.398 52.1056 42.3017 43.6044 52.3491 34.9803C42.3122 26.3632 32.3875 17.848 22.4662 9.3292C22.3366 9.38185 22.2034 9.43099 22.0737 9.48364C22.0737 10.9052 22.0947 12.3267 22.0632 13.7483C22.0492 14.3976 22.0212 15.0751 21.8424 15.6893C21.4955 16.8722 20.3039 17.5988 19.1054 17.4829C17.8298 17.3636 16.6978 16.3948 16.6838 15.1312C16.6593 12.9515 16.5506 10.7227 16.9221 8.59561C17.7912 3.63597 22.0562 0.171597 27.0922 0.0171569C27.4426 0.00662688 27.7931 -0.000393123 28.14 -0.000393123C55.4261 -0.000393123 82.7086 -0.00390313 109.995 -0.000393123C115.35 -0.000393123 119.373 2.69529 120.873 7.37412C121.255 8.56051 121.458 9.85921 121.461 11.1053C121.5 26.9986 121.521 42.8919 121.468 58.7887C121.451 64.4678 117.981 68.7079 112.658 69.782C111.81 69.954 110.92 69.9505 110.047 69.9505C82.7192 69.9575 55.391 69.9048 28.0629 69.9996C22.0317 70.0207 17.4828 65.9175 16.7959 60.9052C16.5191 58.8834 16.6172 56.7985 16.6838 54.7486C16.7223 53.5517 17.8228 52.6251 19.0493 52.4847C20.2444 52.3478 21.4604 53.0568 21.8284 54.2186C22.0106 54.7908 22.0492 55.4226 22.0597 56.0263C22.0912 57.5005 22.0702 58.9747 22.0702 60.4489C22.2104 60.5015 22.3471 60.5577 22.4873 60.6103H22.4908ZM26.3948 5.50329C26.924 5.98416 27.2008 6.24741 27.4917 6.49662C34.6654 12.6462 41.8356 18.7922 49.0093 24.9382C54.953 30.0312 60.9001 35.1242 66.8508 40.2137C68.2 41.3685 69.4266 41.5229 70.6602 40.6735C71.1613 40.3295 71.6099 39.9013 72.076 39.5047C82.7717 30.3436 93.4675 21.179 104.16 12.0143C106.606 9.91888 109.045 7.81288 111.736 5.50329H26.3948ZM26.3667 64.4398H111.733C101.51 55.6577 91.5435 47.1003 81.5487 38.5149C80.2415 39.6521 79.0534 40.6805 77.8689 41.7125C76.6494 42.776 75.4508 43.8641 74.2032 44.8996C71.0492 47.518 66.998 47.504 63.886 44.889C63.2481 44.3555 62.6313 43.8009 62.004 43.2534C60.1957 41.6879 58.3909 40.1189 56.5405 38.5184C46.5001 47.146 36.5578 55.6823 26.3667 64.4398ZM115.893 9.10456C105.691 17.862 95.7559 26.3913 85.747 34.9838C95.805 43.6184 105.719 52.1232 115.893 60.8561V9.10456Z" fill="#F58B1E" />
                             <path d="M15.2329 44.4253C11.2974 44.4253 7.3653 44.4464 3.42975 44.4148C1.33055 44.3972 0.00584528 42.6458 0.675206 40.803C1.13079 39.5464 2.13658 38.9708 3.42975 38.9673C11.3429 38.9532 19.2561 38.9427 27.1658 38.9708C28.918 38.9778 30.0605 40.1326 30.0605 41.7016C30.0605 43.3442 28.904 44.4078 27.0396 44.4148C23.104 44.4323 19.172 44.4183 15.2364 44.4183L15.2329 44.4253Z" fill="#F58B1E" />
                             <path d="M19.2806 30.9996C16.7889 30.9996 14.2937 31.0137 11.802 30.9961C9.81144 30.9821 8.49375 29.8203 8.54632 28.1776C8.59888 26.5876 9.88504 25.5381 11.823 25.5346C16.852 25.5275 21.881 25.5275 26.9134 25.5346C28.8935 25.5381 30.064 26.57 30.0605 28.2583C30.057 29.908 28.8444 30.9786 26.8924 30.9926C24.3551 31.0137 21.8179 30.9961 19.2841 30.9961L19.2806 30.9996Z" fill="#F58B1E" />
                         </g>
                         <defs>
                             <clipPath id="clip0_3097_5595">
                                 <rect width="121" height="70" fill="white" transform="translate(0.5)" />
                             </clipPath>
                         </defs>
                     </svg>
                 </div>
                 <div class="d-flex flex-column g-13">
                     <p class="m-0 primary-text-color verfiy-email-primary  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Verify your email')}}</p>
                     <p class="m-0  primary-text-color text-center @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('We just sent a verifiction link to')}} ************ail.com {{__('Please check your inbox and verify your email.')}} </p>
                 </div>
             </div>
             <!-- footer -->
             <div class="px-5 d-flex flex-row justify-content-center align-items-center connection-footer ">
                @if(env('APP_ENV') == 'local')
                    <a href="{{url('/demo-dashboard')}}" class="border-0 text-decoration-none d-flex flex-row align-items-center justify-content-center g-15 secondary-bg-color verfiy-email-primary-btn">
                        <span class="text-white verfiy-email-primary-btn-text  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Skip to demo page')}}</span>
                    </a>
                @else
                    <button type="button" data-bs-dismiss="modal" class="border-0 text-decoration-none d-flex flex-row align-items-center justify-content-center g-15 secondary-bg-color verfiy-email-primary-btn">
                        <span class="text-white verfiy-email-primary-btn-text  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Skip to demo page')}}</span>
                    </button>
                @endif
             </div>
         </div>
     </div>
 </div>

 <!--add connection option-->
 <div class="modal fade" id="addConnectionOption" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="addConnectionOption" tabindex="-1">
     <div class="modal-dialog" style="max-width: 1020px;max-height:373px;">
         <div class="modal-content bg-white border-0 custom-modal-content">
             <!-- header -->
             <div class="px-5 py-5">
                 <button type="button" data-bs-dismiss="modal" class="border-0 bg-white d-flex flex-row align-items-center position-absolute g-9">
                     <span @if($get_locale=='ar' ) style=" transform: rotateY(180deg);" @endif>
                         <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M6.28033 0.46967C6.57322 0.762563 6.57322 1.23744 6.28033 1.53033L2.56066 5.25H11.25C11.6642 5.25 12 5.58579 12 6C12 6.41421 11.6642 6.75 11.25 6.75H2.56066L6.28033 10.4697C6.57322 10.7626 6.57322 11.2374 6.28033 11.5303C5.98744 11.8232 5.51256 11.8232 5.21967 11.5303L0.21967 6.53033C-0.0732233 6.23744 -0.0732233 5.76256 0.21967 5.46967L5.21967 0.46967C5.51256 0.176777 5.98744 0.176777 6.28033 0.46967Z" fill="#F58B1E" />
                         </svg>
                     </span>
                     <p class="m-0 secondary-text-color popup-back @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back ')}}</p>
                 </button>
                 <div class="text-center d-flex flex-column g-17">
                     <p class="m-0 primary-text-color connections-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__(' Add New Connection')}}</p>
                 </div>
             </div>
             <!-- body -->
             <div class="d-flex flex-column g-15 px-5 pt-4 pb-5">
                 <div class="invite-modal-row d-flex flex-column g-20">
                     <div class="d-flex flex-row justify-content-start align-items-center g-20" style="width: 907px;height: 32px;">
                         <div style="width: 240px;height: 32px;position: relative;" class="d-flex flex-row justify-content-start align-items-center ">
                             <button class="border-0" style="background: #F58B1E;border-radius: 8px 0px 0px 8px;width: 32px;height: 32px;position: absolute;">
                                 <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M14.2279 11.0904L12.6754 9.50035C12.3391 9.18669 11.9201 8.97588 11.4679 8.89285C11.0124 8.82009 10.5456 8.88269 10.1254 9.07287L9.45035 8.39785C10.2464 7.33614 10.6108 6.01237 10.4704 4.69285C10.3474 3.54101 9.847 2.46218 9.04704 1.62439C8.24707 0.7866 7.19249 0.236917 6.04756 0.0609416C4.90263 -0.115033 3.73165 0.0925941 2.71702 0.65148C1.70238 1.21037 0.901078 2.08912 0.43792 3.15087C-0.0252375 4.21262 -0.124242 5.39775 0.156332 6.52164C0.436907 7.64552 1.0813 8.64505 1.98914 9.36453C2.89698 10.084 4.01729 10.4831 5.17555 10.4995C6.3338 10.5159 7.46498 10.1488 8.39286 9.45535L9.06036 10.1229C8.848 10.5416 8.77195 11.0162 8.84286 11.4803C8.91297 11.9471 9.12812 12.3801 9.45786 12.7179L11.0479 14.3079C11.3107 14.5718 11.635 14.7664 11.9917 14.8741C12.3483 14.9818 12.7261 14.9992 13.0911 14.9249C13.4562 14.8505 13.7971 14.6867 14.0832 14.4481C14.3693 14.2095 14.5917 13.9036 14.7304 13.5579C14.96 12.998 14.96 12.3702 14.7304 11.8103C14.6118 11.5397 14.441 11.295 14.2279 11.0904ZM7.86785 7.91035C7.34302 8.43447 6.67454 8.79117 5.94697 8.93535C5.21939 9.07953 4.4654 9.00473 3.78036 8.72037C3.26928 8.50731 2.81173 8.1837 2.44056 7.77282C2.0694 7.36193 1.79383 6.87396 1.63364 6.34393C1.47346 5.8139 1.43265 5.25497 1.51412 4.70729C1.5956 4.15961 1.79735 3.63677 2.10488 3.17632C2.41241 2.71587 2.81809 2.32923 3.29279 2.04418C3.76749 1.75913 4.29942 1.58273 4.85038 1.52766C5.40135 1.4726 5.95766 1.54025 6.47938 1.72571C7.0011 1.91118 7.47528 2.20988 7.86785 2.60036C8.21879 2.94668 8.49677 3.35981 8.68536 3.81536C8.97041 4.50208 9.04489 5.25803 8.89933 5.98717C8.75377 6.71632 8.39473 7.38573 7.86785 7.91035ZM13.1704 13.2128C13.0997 13.2838 13.0155 13.3399 12.9229 13.3779C12.8331 13.4175 12.736 13.438 12.6379 13.438C12.5397 13.438 12.4426 13.4175 12.3529 13.3779C12.2602 13.3399 12.176 13.2838 12.1054 13.2128L10.5154 11.6228C10.4452 11.5544 10.3891 11.4728 10.3504 11.3828C10.3126 11.2898 10.2922 11.1907 10.2904 11.0904C10.2915 10.9924 10.3119 10.8955 10.3504 10.8054C10.3881 10.7125 10.444 10.6282 10.5149 10.5573C10.5857 10.4865 10.67 10.4306 10.7629 10.3929C10.8526 10.3532 10.9497 10.3327 11.0479 10.3327C11.146 10.3327 11.2431 10.3532 11.3329 10.3929C11.4255 10.4308 11.5097 10.4869 11.5804 10.5579L13.1704 12.1478C13.2413 12.2185 13.2974 12.3027 13.3354 12.3954C13.3738 12.4855 13.3942 12.5824 13.3954 12.6804C13.3935 12.7807 13.3731 12.8799 13.3354 12.9729C13.2966 13.0629 13.2405 13.1444 13.1704 13.2128Z" fill="white" />
                                 </svg>
                             </button>
                             <input style="border: 0.5px solid #EAF0F4;border-radius: 8px;height: 32px;padding-left: 32px;">
                         </div>
                         <div class="d-flex g-14 justify-content-between align-items-center ">
                             <span>
                                 <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M16 29C23.1797 29 29 23.1797 29 16C29 8.8203 23.1797 3 16 3C8.8203 3 3 8.8203 3 16C3 23.1797 8.8203 29 16 29Z" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                     <path d="M16 11V21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                     <path d="M11 16H21" stroke="#F58B1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                             </span>
                             <p class="m-0 primary-text-color" style="font-family: 'Gilroy-Medium';font-size: 14px;line-height: 16px;">Add new</p>
                         </div>
                         <div class="d-flex g-14 justify-content-between align-items-center ms-5">
                             <p class="m-0" style="font-family: 'Gilroy-Medium';font-size: 14px;line-height: 16px;color: #1C3B57;">Date</p>
                             <select class="d-flex flex-row align-items-center justify-content-end g-10 px-1" style="background: #D0D8E3;border: 0.5px solid #EAF0F4;border-radius: 8px;width: 87px;height: 32px;">
                                 <option value="">Any</option>
                             </select>
                         </div>
                     </div>
                     <div>
                         <div class="d-flex flex-row">
                             <p class="w-25" style="font-family: 'Gilroy-SemiBold';font-size: 14px;line-height: 16px;color: #041626;">Account</p>
                             <p style="font-family: 'Gilroy-SemiBold';font-size: 14px;line-height: 16px;color: #041626;">Pages</p>
                         </div>
                         <div class="d-flex flex-row py-3" style="border-top:1px solid #EAF0F4;">
                             <p class="w-25" style="font-family: 'Gilroy-Medium';font-size: 12px;line-height: 14px;color: #041626;">Jimbo Brown</p>
                             <div class="d-flex flex-column g-10">
                                 <div class="d-flex flex-row g-10">
                                     <input type="radio">
                                     <p class="m-0" style="font-family: 'Gilroy-Medium';font-size: 10px;line-height: 22px;color: #041626;">Shnu El Joe</p>
                                 </div>
                                 <div class="d-flex flex-row g-10">
                                     <input type="radio">
                                     <p class="m-0" style="font-family: 'Gilroy-Medium';font-size: 10px;line-height: 22px;color: #041626;">Rakamy Rakamak</p>
                                 </div>
                                 <div class="d-flex flex-row g-10">
                                     <input type="radio">
                                     <p class="m-0" style="font-family: 'Gilroy-Medium';font-size: 10px;line-height: 22px;color: #041626;">Snapuplabs</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- footer -->
             <div class="px-5 d-flex flex-row justify-content-between align-items-center connection-footer">
                 <div>
                     sgdg
                 </div>
                 <div>
                     <button type="button" class="confirm-btn-invite border-0  g-15 secondary-bg-color dashboard-invite-confirm">
                         <span class="text-white dashboard-connection-next-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Connect')}}</span>
                     </button>
                 </div>
             </div>
         </div>
     </div>
 </div>