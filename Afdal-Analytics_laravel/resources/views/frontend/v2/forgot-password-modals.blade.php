 <!--forgot password Modal -->
 <div class="modal fade" style="overflow: auto !important;" id="forgot_password_model" data-backdrop="static" data-keyboard="false" aria-hidden="true" aria-labelledby="forgot_password_model" tabindex="-1">
     <div class="modal-dialog " style="max-width: 732px;">
         <div class="modal-content forgot-password-modal-content" style="padding: 0px;height:auto">
             <div class="personal-modal-wrapper">
                 <p class="forgot-password-modal-heading text-center primary-text-color " style="@if($get_locale=='ar')  font-family: 'NotoSansArabic-Bold'; @endif">
                     {{__('Forgot Password ')}}
                 </p>
                 <form id="forgot-password-form" class="forgot-password-form mt-5" onsubmit="submitForgotPasswordForm(event)" method="POST">
                     <div class="d-flex flex-column align-items-center g-29 g-14-576">
                         <div class="mb-2">
                             <div class="forgot-modal-line-divider"></div>
                             <p class="forgot-modal-divider-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Reset with Phone number')}}</p>
                         </div>

                         <div class="mb-3 mb-sm-5">
                             <input type="text" id="phone-forgot" name="phone-forgot" class="forgot-modal-input-box px-5 @if($get_locale=='ar') signup-input-box-ar @endif">
                             <p id="forgot-phone-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                         </div>

                         <div class="mb-2">
                             <div class="forgot-modal-line-divider"></div>
                             <p class="forgot-modal-divider-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="@if($get_locale=='ar') width: 150px; @else width: 125px; @endif">{{__('Reset with Email')}}</p>
                         </div>
                         <div class="mb-2">
                             <input type="email" id="email-forgot" name="email-forgot" class="forgot-modal-input-box px-3" placeholder="email@companyexample.com">
                             <p id="forgot-email-error" class="pt-2 mb-0 input-error-msg d-none"></p>
                         </div>
                         <div class="alert alert-warning warning-alert-div @if($get_locale=='en') text-left @else text-right @endif d-none" id="forgot-alert-div" role="alert" style="margin:0 auto">

                         </div>
                         <div class="mt-3 mb-3 mb-sm-5 text-center">
                             <button type="submit" class="forgot-send-button @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
                                 <span class="forgot-send-button-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Send')}}</span>
                             </button>
                         </div>
                         <div class="d-flex g-10 text-center align-items-center justify-content-center">
                             <p class="primary-text-color forgot-back-to  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back to ')}}</p>
                             <a class="forgot-back-signin  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" href="{{url('/login')}}">{{__(' Sign in')}}</a>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!--otp forgot password Modal -->
 <div class="modal fade" style="overflow: auto !important;" id="otp_forgot_password_model" data-backdrop="static" data-keyboard="false" aria-hidden="true" aria-labelledby="otp_forgot_password_model" tabindex="-1">
     <div class="modal-dialog " style="max-width: 577px;margin:auto">
         <div class="modal-content forgot-password-modal-content" style="padding: 0px;height:auto">
             <div class="personal-modal-wrapper">
                 <p class="forgot-password-modal-heading text-center primary-text-color mb-4" style="@if($get_locale=='ar')  font-family: 'NotoSansArabic-Bold'; @endif">
                     {{__('Verification')}}
                 </p>
                 <form method="POST" onsubmit="submitOtpFormModal(event)" class="text-center">
                     <div>
                         <svg width="35" height="43" viewBox="0 0 35 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M34.4791 22.8568C34.4655 19.8932 32.5921 17.3758 29.8116 16.413C29.2241 16.2104 28.1446 16.0898 28.0879 15.8121C28.0085 15.4297 28.0402 14.5261 28.0221 13.8751C27.9722 12.0087 28.1899 10.1286 27.7817 8.27812C26.6931 3.35028 22.0754 -0.355263 16.7547 0.0271276C12.0055 0.368548 7.84821 4.06044 7.13152 8.74245C6.80266 10.8888 7.00905 13.0466 6.99771 15.1998C6.99318 15.9032 6.74596 16.1057 6.1336 16.2241C2.70891 16.8887 0.529362 19.504 0.513486 22.982C0.495342 27.2383 0.495342 31.497 0.513486 35.7533C0.529362 39.7844 3.40292 42.6569 7.41729 42.6705C10.783 42.6842 14.1487 42.6728 17.5144 42.6705C20.9369 42.6705 24.3593 42.6887 27.7794 42.6637C31.5126 42.6364 34.4564 39.7024 34.4814 35.9673C34.5086 31.5971 34.5041 27.2247 34.4814 22.8545L34.4791 22.8568ZM11.189 9.88734C11.5269 6.78953 14.0285 4.33357 17.0518 4.16969C20.2565 3.99671 23.1867 6.13627 23.7016 9.26596C24.0463 11.3577 23.7787 13.5087 23.8127 15.6346C23.8218 16.1854 23.4158 16.0807 23.096 16.0807C21.2045 16.0875 19.3107 16.083 17.4192 16.083C15.5277 16.083 13.6339 16.0739 11.7424 16.0898C11.3024 16.0944 11.0552 16.0124 11.0756 15.4912C11.1482 13.6248 10.9826 11.7538 11.1867 9.88734H11.189ZM30.3718 35.4347C30.3672 37.4559 29.2808 38.5439 27.2827 38.5462C20.7532 38.5484 14.2213 38.5484 7.69172 38.5462C5.70495 38.5462 4.62084 37.44 4.62084 35.421C4.61857 31.3923 4.61857 27.3635 4.62084 23.3348C4.62084 21.3454 5.65959 20.312 7.6645 20.3075C10.944 20.3029 14.2236 20.3075 17.5031 20.3075C20.8099 20.3075 24.1189 20.3029 27.4256 20.3075C29.3081 20.312 30.3672 21.3659 30.3718 23.2619C30.3831 27.318 30.3808 31.3763 30.3718 35.4324V35.4347Z" fill="#F58B1E" />
                             <path d="M19.5422 26.7835C19.5082 25.6795 18.6055 24.7987 17.535 24.7759C16.4215 24.7509 15.4734 25.6317 15.453 26.7835C15.4235 28.5088 15.4235 30.2364 15.453 31.9617C15.4712 33.1726 16.3217 33.9829 17.4988 33.9806C18.6759 33.9806 19.5105 33.1726 19.5468 31.9594C19.5717 31.1104 19.5513 30.2614 19.5513 29.4124C19.5513 28.5361 19.5717 27.6575 19.5445 26.7812L19.5422 26.7835Z" fill="#F58B1E" />
                         </svg>
                     </div>
                     <div>
                         <p class="mt-3 mb-2 forgot-modal-enter-verification @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Enter verification code')}}</p>
                         <p class="mb-4 forgot-modal-code-sent-to @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('a code is sent to')}} <span id="forgot-modal-otp-number">+216 28 *** ***</span></p>
                     </div>
                     <div class="my-4">
                         <div class="text-center" style="@if($get_locale=='ar') unicode-bidi: embed;direction: ltr; @endif">
                             <input id="m1" onkeyup="alter_boxModal(this.id)" class="text-center border-0 forgot-password-otp-modal-input forgot-password-otp-modal-first-input" required="" type="text" id="first" maxlength="1">
                             <input id="m2" onkeyup="alter_boxModal(this.id)" class="text-center border-0 forgot-password-otp-modal-input rounded-0" required="" id="second" maxlength="1">
                             <input id="m3" onkeyup="alter_boxModal(this.id)" class="text-center border-0 forgot-password-otp-modal-input rounded-0" type="text" required="" id="third" maxlength="1">
                             <input id="m4" onkeyup="alter_boxModal(this.id)" class="text-center border-0 forgot-password-otp-modal-input rounded-0" type="text" required="" id="four" maxlength="1">
                             <input id="m5" onkeyup="alter_boxModal(this.id)" class="text-center border-0 forgot-password-otp-modal-input rounded-0" type="text" required="" id="five" maxlength="1">
                             <input id="m6" onkeyup="alter_boxModal(this.id)" class="text-center border-0  forgot-password-otp-modal-input forgot-password-otp-modal-last-input" required="" type="text" id="six" maxlength="1">
                         </div>
                         <p id="otp-modal-error" class="pt-2 mb-0 input-error-msg text-center d-none"></p>
                     </div>
                     <div class="alert alert-warning warning-alert-div @if($get_locale=='en') text-left @else text-right @endif d-none" id="otp-alert-div" role="alert"></div>
                     <div>
                         <button type="submit" class="border-0 forgot-modal-otp-submit">
                             <span class="forgot-modal-otp-submit-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Submit')}}</span>
                         </button>
                     </div>
                     <div class="mt-5 d-flex  justify-content-center align-items-center" style="gap: 6px;">
                         <p class="forgot-modal-didnt-get @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Didn’t get the code? ')}}</p>
                         <button type="button" onclick="resendOtp(this)" class="resend-show border-0 bg-transparent forgot-modal-resend @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Resend')}}</p>
                         <button type="button" class="sent-show d-none border-0 bg-transparent forgot-modal-resend @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Sent')}}</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!--otp forgot new password Modal -->
 <div class="modal fade" style="overflow: auto !important;" id="set_forgot_password_model" data-backdrop="static" data-keyboard="false" aria-hidden="true" aria-labelledby="set_forgot_password_model" tabindex="-1">
     <div class="modal-dialog " style="@if($get_locale=='en') max-width: 624px; @else max-width: 728px; @endif margin:auto">
         <div class="modal-content forgot-password-modal-content" style="padding: 0px;height:auto">
             <div class="personal-modal-wrapper">
                 <p class="forgot-password-modal-heading text-center primary-text-color mb-4" style="@if($get_locale=='ar')  font-family: 'NotoSansArabic-Bold'; @endif">
                     {{__('New Password')}}
                 </p>
                 <form method="POST" onsubmit="resetPasswordFormModal(event)" class="forgot-new-wrapper">
                     <div class="text-center">
                         <p class="forgot-set-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Create a new password')}}</p>
                         <p class="forgot-set-text mt-2  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="direction: ltr;">{{substr(session('forgot_phone'), 0, 6)}} *** ***</p>
                     </div>
                     <div class="my-4" style="@if($get_locale=='ar') text-align: start; @endif" >
                         <label class="primary-text-color  set-forgot-modal-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Password')}}
                             <svg class="ms-1" width="5" height="5" viewBox="0 0 5 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M5 1.90741V3.09259L3.36918 3.01852L4.319 4.37037L3.29749 5L2.49104 3.48148L1.68459 5L0.681003 4.37037L1.6129 3.01852L0 3.09259V1.90741L1.6129 2L0.681003 0.62963L1.68459 0L2.49104 1.51852L3.29749 0L4.319 0.62963L3.36918 2L5 1.90741Z" fill="#EB001B" />
                             </svg>
                         </label>
                         <div class="position-relative">
                             <input type="password" id="password_new" name="password" placeholder="****************" class="d-flex flex-row align-items-center bg-white g-10 set-forgot-modal-input">
                             <span onclick="showPassword2('password')" class="@if(checkLangaugeGlobaly()=='ar') set-forgot-model-eye-ar @else set-forgot-model-eye @endif">
                                 <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M0.666626 5.99935C0.666626 5.99935 3.33329 0.666016 7.99996 0.666016C12.6666 0.666016 15.3333 5.99935 15.3333 5.99935C15.3333 5.99935 12.6666 11.3327 7.99996 11.3327C3.33329 11.3327 0.666626 5.99935 0.666626 5.99935Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                     <path d="M10 6C10 6.39556 9.8827 6.78224 9.66294 7.11114C9.44318 7.44004 9.13082 7.69638 8.76537 7.84776C8.39992 7.99913 7.99778 8.03874 7.60982 7.96157C7.22186 7.8844 6.86549 7.69392 6.58579 7.41421C6.30608 7.13451 6.1156 6.77814 6.03843 6.39018C5.96126 6.00222 6.00087 5.60008 6.15224 5.23463C6.30362 4.86918 6.55996 4.55682 6.88886 4.33706C7.21776 4.1173 7.60444 4 8 4C8.53043 4 9.03914 4.21071 9.41422 4.58579C9.78929 4.96086 10 5.46957 10 6Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                             </span>
                         </div>
                         <div class="position-relative">
                             <input type="password" id="confirm_password_new" name="confirm_password" placeholder="****************" class="d-flex flex-row align-items-center bg-white g-10 set-forgot-modal-input" style="margin-top :12px;">
                             <span onclick="showPassword2('confirm_password')" class="@if(checkLangaugeGlobaly()=='ar') set-forgot-model-eye-ar @else set-forgot-model-eye @endif">
                                 <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M0.666626 5.99935C0.666626 5.99935 3.33329 0.666016 7.99996 0.666016C12.6666 0.666016 15.3333 5.99935 15.3333 5.99935C15.3333 5.99935 12.6666 11.3327 7.99996 11.3327C3.33329 11.3327 0.666626 5.99935 0.666626 5.99935Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                     <path d="M10 6C10 6.39556 9.8827 6.78224 9.66294 7.11114C9.44318 7.44004 9.13082 7.69638 8.76537 7.84776C8.39992 7.99913 7.99778 8.03874 7.60982 7.96157C7.22186 7.8844 6.86549 7.69392 6.58579 7.41421C6.30608 7.13451 6.1156 6.77814 6.03843 6.39018C5.96126 6.00222 6.00087 5.60008 6.15224 5.23463C6.30362 4.86918 6.55996 4.55682 6.88886 4.33706C7.21776 4.1173 7.60444 4 8 4C8.53043 4 9.03914 4.21071 9.41422 4.58579C9.78929 4.96086 10 5.46957 10 6Z" stroke="#F68B1F" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                             </span>
                         </div>
                         <p id="password-error-set" class="pt-2 mb-0 input-error-msg d-none"></p>
                     </div>
                     <div class=" d-flex justify-content-between mb-2">
                         <div class="d-flex align-items-center" style="gap: 5px;">
                             <input class="modal-keep-signed-input signin-signed-input" type="checkbox" id="keep-signed-in-new" name="keep-signed-in-new">
                             <label class="signin-keep-signed primary-text-color @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Keep me signed in')}}</label>
                         </div>
                         <div>
                             <!-- " -->
                             <a href="{{url('/login')}}" class="border-0 p-0 bg-transparent text-decoration-underline secondary-text-color forgot-password-link @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Sign in')}} </a>
                         </div>
                     </div>
                     <div class="mt-4 text-center">
                         <button type="submit" class="border-0 forgot-modal-otp-submit">
                             <span class="forgot-modal-otp-submit-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Submit')}} </span>
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" style="overflow: auto !important;" id="updated_password_model" data-backdrop="static" data-keyboard="false" aria-hidden="true" aria-labelledby="updated_password_model" tabindex="-1">
     <div class="modal-dialog " style="max-width: 452px;margin: auto;">
         <div class="modal-content " style="padding: 0px;height:auto;width: max-content;">
             <div class="updated_password-text-wrapper">
                 <p class="updated_password-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Password Updated')}}</p>
             </div>
             <div class="text-center updated_password-button-wrapper d-flex justify-content-center align-items-center">
                 <a href="{{url('/login')}}" class="d-flex justify-content-center align-items-center @if($get_locale=='en') updated_password-button @else updated_password-button-ar @endif" style="text-decoration: none;">
                     <span class=" @if($get_locale=='ar') updated_password-button-text-ar font-NotoSansArabic-Regular @else updated_password-button-text @endif">{{__('See Your Dashboard ')}}</span>
                 </a>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" style="overflow: auto !important;" id="email_sent_password_model" data-backdrop="static" data-keyboard="false" aria-hidden="true" aria-labelledby="email_sent_password_model" tabindex="-1">
     <div class="modal-dialog " style="max-width: 452px;">
         <div class="modal-content " style="padding: 0px;height:auto;">
             <div class="email_sent_password-text-wrapper">
                 <p id="email-sent-message" class="email-sent-updated_password-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif"></p>
             </div>
             <div class="text-center email_sent_password-button-wrapper d-flex align-items-center justify-content-center">
                 <a href="{{url('/login')}}" class="d-flex justify-content-center align-items-center email_sent_password-button" style="text-decoration: none;">
                     <span class="email_sent_password-button-text @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Back to Sign In')}}</span>
                 </a>
             </div>
         </div>
     </div>
 </div>