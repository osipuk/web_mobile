@if(auth()->user()->company->onTrial() && !auth()->user()->company->subscriptions()->first())
<div class="trial-banner-new align-items-center justify-content-between">
    <!-- <img src="{{url('assets/image_new/svg/close-white.svg')}}" alt="" style="cursor: pointer; height: 18px" onclick="hideBanner()"> -->


    <!-- <span>{{__('Hello, we would like to inform you that your trial will end in')}}. {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }}​​ {{__('Save your progress and business growth')}} <a target="_blank" class="white-no-underline text-darkblue-hover" href="{{url('/dashboard/subscribe-plan')}}">{{__('Renew your subscription with us!')}}</a>؜</span> -->
    <span>
        <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M31.0252 13.2772L29.7143 11.7647C29.1429 11.0924 28.7731 10.2521 28.7058 9.34447L28.5377 7.36132C28.3696 5.31088 26.7227 3.66368 24.6722 3.49585L22.6891 3.32773C21.8152 3.26044 20.9411 2.92444 20.2689 2.31926L18.7563 1.00832C17.1765 -0.336108 14.8571 -0.336108 13.2772 1.00832L11.7647 2.31926C11.0924 2.89067 10.2521 3.26045 9.34447 3.32773L7.36132 3.49585C5.31088 3.66397 3.66368 5.31088 3.49585 7.36132L3.32773 9.34447C3.26044 10.2184 2.92444 11.0924 2.31926 11.7647L1.00832 13.2772C-0.336108 14.8571 -0.336108 17.1765 1.00832 18.7563L2.31926 20.2689C2.89067 20.9411 3.26045 21.7815 3.32773 22.6891L3.49585 24.6722C3.66397 26.7227 5.31088 28.3699 7.36132 28.5377L9.34447 28.7058C10.2184 28.7731 11.0924 29.1091 11.7647 29.7143L13.2772 30.9917C14.8571 32.3361 17.1765 32.3361 18.7563 30.9917L20.2689 29.7143C20.9411 29.1429 21.7814 28.7731 22.6891 28.7058L24.6722 28.5377C26.7227 28.3696 28.3699 26.7227 28.5377 24.6722L28.7058 22.6891C28.7731 21.8152 29.1091 20.9411 29.7143 20.2689L31.0252 18.7563C32.3699 17.1765 32.3699 14.8233 31.0252 13.2772V13.2772ZM16.0671 24.8404C11.1932 24.8404 7.22667 20.8741 7.22667 15.9999C7.22667 11.126 11.1932 7.15951 16.0671 7.15951C20.941 7.15951 24.9075 11.1258 24.9075 15.9999C24.9075 20.8739 20.941 24.8404 16.0671 24.8404V24.8404Z" fill="#836305"/>
        <path d="M21.0421 13.7142L18.5883 13.2437C18.3529 13.2101 18.1177 13.042 18.0169 12.8404L16.8068 10.6215C16.4706 10.0501 15.664 10.0501 15.3277 10.6215L14.1176 12.8063C13.9833 13.008 13.7814 13.1761 13.5462 13.2096L11.0925 13.6802C10.4538 13.8146 10.1849 14.5878 10.6219 15.092L12.3362 16.9408C12.5043 17.1089 12.5716 17.3778 12.5716 17.613L12.2691 20.1005C12.2018 20.7727 12.874 21.2433 13.4457 20.9744L15.7313 19.9324C15.9667 19.8316 16.2019 19.8316 16.4373 19.9324L18.7229 20.9744C19.3279 21.2433 20.0003 20.7727 19.8995 20.1005L19.5971 17.613C19.5635 17.3776 19.6306 17.1089 19.8325 16.9408L21.5467 15.092C21.9498 14.6216 21.7144 13.8151 21.0422 13.7142H21.0421Z" fill="#836305"/>
        </svg>

        {{__('Your trial will expire on ')}} {{ date('d/m/Y',strtotime(auth()->user()->company->trialEndsAt())) }}.{{__(' Subscribe now and keep your business growing')}}
    </span>
    <a href="{{ url('/dashboard/subscribe-plan') }}" class="choose-plan-btn">{{__('Choose Plan')}}</a>
</div>
@if(Request::path() == 'dashboard/twitter-overview')
<script>
    function hideBanner() {
        $('.trial-banner').hide();
        document.querySelector('.dashboard-main-content-wrapper').classList.add('addmargin-twit');
    }
</script>
@else
<script>
    function hideBanner() {
        $('.trial-banner').hide();
        document.querySelector('.dashboard-main-content-wrapper').classList.add('addmargin');
    }
</script>
@endif
@endif