<p class="d-none d-md-block m-0 py-3 primary-text-color manage-subscription-your-subscription-heading @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Your Subscription')}}</p>
<div class="p-4 manage-subscription-your-subscription-wrapper">
    <p class="d-block d-md-none m-0 mb-3 mobile-your-subscription-label  @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Your Subscription')}}</p>
    <div class="d-flex flex-row align-items-center justify-content-between">
        <span>
            <svg width="33" height="36" viewBox="0 0 33 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.0345 34.6351C27.9342 35.4825 26.5423 35.8581 25.1651 35.6794C23.7879 35.5007 22.5381 34.7822 21.6905 33.6821L3.1264 9.5731C2.70666 9.02826 2.39844 8.40608 2.21917 7.74208C2.0399 7.07808 1.9931 6.38529 2.0816 5.70323C2.17009 5.02118 2.39213 4.36322 2.73492 3.76695C3.0777 3.17069 3.53452 2.64779 4.0794 2.2281C5.17982 1.38084 6.57179 1.00538 7.94903 1.18428C9.32627 1.36319 10.576 2.08182 11.4234 3.18211L29.9925 27.2911C30.8393 28.392 31.2141 29.7842 31.0345 31.1615C30.8548 32.5388 30.1354 33.7882 29.0345 34.6351Z" fill="#F2C5A7" />
                <path d="M6.26404 35.9513C4.73533 35.9513 3.26919 35.3439 2.18823 34.263C1.10727 33.182 0.5 31.7159 0.5 30.1872V6.42023C0.5 4.89152 1.10727 3.42544 2.18823 2.34448C3.26919 1.26352 4.73533 0.65625 6.26404 0.65625C7.79275 0.65625 9.25876 1.26352 10.3397 2.34448C11.4207 3.42544 12.028 4.89152 12.028 6.42023V30.1883C12.0277 31.7168 11.4203 33.1826 10.3394 34.2633C9.25842 35.3441 7.79257 35.9513 6.26404 35.9513Z" fill="#FF9A41" />
                <path d="M26.3539 35.9499C24.8252 35.9499 23.359 35.3426 22.2781 34.2617C21.1971 33.1807 20.5898 31.7146 20.5898 30.1859V15.6859C20.5898 14.1572 21.1971 12.6911 22.2781 11.6102C23.359 10.5292 24.8252 9.92188 26.3539 9.92188C27.8826 9.92188 29.3486 10.5292 30.4296 11.6102C31.5105 12.6911 32.1178 14.1572 32.1178 15.6859V30.1859C32.1178 31.7146 31.5105 33.1807 30.4296 34.2617C29.3486 35.3426 27.8826 35.9499 26.3539 35.9499Z" fill="#FF9A41" />
            </svg>
        </span>
        <p class="m-0 manage-your-subscription-plan-name @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Afdal Analytics') . ' ' . __($user_plan_name) }}</p>
    </div>
    @if($subscription_info)
    <div class="text-end py-3">
        <p class="m-0 manage-your-subscription-commitment-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Commitment')}}</p>
        <p class="m-0 primary-text-color manage-your-subscription-commitment @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
            @if($subscription_info['interval'] == 'month')
            {{ __('Paid monthly') }}
            @elseif($subscription_info['interval'] == 'year')
            {{ __('Annual plan') }}
            @endif
        </p>
    </div>
    <div class="text-end py-3">
        <p class="m-0 manage-your-subscription-next-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Next regular payment*')}}</p>
        <p class="m-0 primary-text-color manage-your-subscription-next @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">${{$subscription_info['only_payment']}}</p>
        <p class="m-0 primary-text-color manage-your-subscription-next @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{$new_billing_date}}</p>
    </div>
    @elseif(auth()->user()->company->onTrial())
    <div class="text-end py-3">
        <p class="m-0 manage-your-subscription-next-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
            {{__('The trial period will end in ')}} {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }} {{__('days')}}
        </p>
    </div>
    @else
    <div class="text-end py-3">
        <p class="m-0 manage-your-subscription-next-label @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">
            {{__('No plan')}}
        </p>
    </div>
    @endif
    <div class="pt-3 you-subscription-footer">
        <div class="d-flex flex-row align-items-center justify-content-end" style="gap:6px">
            <span>
                <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.8569 8.4003H14.2399V6.0003H11.8569V8.4003ZM13.0479 21.6003C11.1464 21.6138 9.28365 21.0622 7.69602 20.0156C6.10839 18.9689 4.86736 17.4744 4.13032 15.7214C3.39328 13.9685 3.19344 12.0361 3.55614 10.1695C3.91884 8.30279 4.82775 6.58588 6.16759 5.23649C7.50742 3.88709 9.21783 2.966 11.0819 2.59004C12.9459 2.21408 14.8796 2.40018 16.6378 3.12474C18.3959 3.8493 19.8993 5.07968 20.9572 6.65983C22.0151 8.23998 22.5798 10.0987 22.5799 12.0003C22.5855 14.5363 21.5852 16.9711 19.7983 18.7707C18.0115 20.5703 15.5839 21.5879 13.0479 21.6003ZM13.0479 0.000301176C10.671 -0.0165358 8.34259 0.672915 6.35805 1.98122C4.37351 3.28951 2.82222 5.15772 1.90092 7.3489C0.979625 9.54007 0.729824 11.9555 1.1832 14.2888C1.63658 16.6222 2.77271 18.7683 4.44751 20.4551C6.12231 22.1418 8.26031 23.2932 10.5904 23.7631C12.9204 24.2331 15.3376 24.0005 17.5352 23.0948C19.7329 22.1891 21.6121 20.6511 22.9345 18.6759C24.2569 16.7007 24.9628 14.3773 24.9629 12.0003C24.9686 10.43 24.6648 8.87396 24.0691 7.42104C23.4734 5.96812 22.5973 4.64677 21.4908 3.53246C20.3844 2.41814 19.0693 1.53267 17.6207 0.926622C16.172 0.320572 14.6182 0.00580685 13.0479 0.000301176ZM11.8569 18.0003H14.2399V10.8003H11.8569V18.0003Z" fill="#8797AF" />
                </svg>
            </span>
            <p class="m-0 your-subscription-requires @if($get_locale=='ar') font-NotoSansArabic-Regular @endif">{{__('Requires use with only one account*')}}</p>
        </div>
    </div>
</div>