<div class="empty-dashboard-wrapper">
  <div class="empty-dashboard-image">
  </div>

  <div class="empty-dashboard-actions">


    <a class="empty-dashboard-templates-button"
      href="{{url('/dashboard/templates')}}"
    >
        <div class="empty-dashboard-action-icon icon-templates"></div>
        <p class="empty-dashboard-button-title font-24-lh-29-medium">
            {{__('Add a Template')}}
        </p>
        <p class="empty-dashboard-button-text font-16-lh-19-regular">
          {{__('Add a pre-made template to view your data')}}
        </p>
    </a>

    @if(Auth::user() && Auth::user()->company && !(Auth::user()->company->social_account_instagram->isNotEmpty() || Auth::user()->company->social_account_facebook->isNotEmpty() || Auth::user()->company->social_account_twitter->isNotEmpty()))
        <a class="empty-dashboard-templates-button"
          href="{{url('/dashboard/subscribe-plan')}}"
        >
            <div
                class="empty-dashboard-action-icon icon-connections"></div>
            <p class="empty-dashboard-button-title font-24-lh-29-medium">
                {{__('Choose Plan')}}
            </p>
            <p class="empty-dashboard-button-text font-16-lh-19-regular">
                {{__('Compare our subscription plans and find')}}
            </p>
        </a>
    @endif



    </div>
  <div class="empty-dashboard-actions" style="margin-top: 38px;">
   <a class="empty-dashboard-templates-button" href="https://intercom.help/afdal-analytics/ar/">
        <div class="empty-dashboard-action-icon icon-help"></div>
        <p class="empty-dashboard-button-title font-24-lh-29-medium">
            {{__('Knowledge Base')}}
        </p>
        <p class="empty-dashboard-button-text font-16-lh-19-regular">
            {{__('Browse through our extensive learning material and expand your knowledge')}}
        </p>
    </a>
    <a class="empty-dashboard-templates-button" href="https://intercom.help/afdal-analytics/ar/" style="padding: 4px 40px 6px 40px;">
        <div class="empty-dashboard-action-icon">
            <svg width="57" height="50" viewBox="0 0 57 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.1611 17.7589L24.3327 16.5671C25.167 17.1034 26.0607 17.5802 27.0143 17.7589C32.0801 18.8913 36.6091 15.2559 36.9072 10.4288C36.9072 10.1906 36.7284 9.95202 36.4898 9.95202H29.3385C29.1003 9.95202 28.9212 9.77327 28.9212 9.53466V2.38337C28.9212 2.14517 28.683 1.90655 28.4444 1.966C23.6173 2.2042 19.9819 6.7337 21.1143 11.8589C21.2336 12.3357 21.4123 12.8125 21.5911 13.2294L19.5051 16.8647C19.2669 17.342 19.6842 17.8782 20.161 17.7589H20.1611Z" fill="#F58B1E"/>
            <path d="M31.3638 7.98567H38.5151C38.7533 7.98567 38.992 7.74747 38.9325 7.50886C38.6943 3.45661 35.476 0.178785 31.4236 0C31.1854 0 30.9468 0.178753 30.9468 0.417367V7.56866C30.887 7.80685 31.1256 7.98561 31.3638 7.98561L31.3638 7.98567Z" fill="#F58B1E"/>
            <path d="M13.7829 12.3956C13.7829 14.963 11.7019 17.044 9.13449 17.044C6.56712 17.044 4.48608 14.963 4.48608 12.3956C4.48608 9.82823 6.56712 7.74719 9.13449 7.74719C11.7019 7.74719 13.7829 9.82823 13.7829 12.3956Z" fill="#F58B1E"/>
            <path d="M14.0809 37.9026H7.88325C6.27408 37.9026 4.96299 36.7702 4.66534 35.161L2.81757 23.3016C2.69827 22.5267 1.98327 21.9905 1.2084 22.1098C0.433542 22.2291 -0.102685 22.9441 0.0166113 23.719L1.86395 35.5784C2.34076 38.5581 4.8437 40.7035 7.82344 40.7035H14.0211C14.796 40.7035 15.4515 40.048 15.4515 39.2732C15.4515 38.5577 14.8558 37.9022 14.0809 37.9022V37.9026Z" fill="#F58B1E"/>
            <path d="M18.5506 31.9425H14.2598L13.7235 24.4336C15.2729 25.3274 16.9414 25.864 18.7294 25.864H22.6028C23.5565 25.864 24.3908 25.0891 24.3908 24.076C24.3908 23.1224 23.6159 22.2881 22.6028 22.2881H18.7888C17.597 22.2881 16.3453 21.9306 15.3322 21.275L11.8163 19.0103C11.1607 18.5335 10.3859 18.2953 9.49205 18.2953H8.83648C7.58478 18.2953 6.4529 18.8315 5.61857 19.7852C4.78424 20.7388 4.42678 21.9306 4.60551 23.1823L6.33355 34.4457C6.5123 35.4588 7.40605 36.2337 8.41959 36.2337H16.1071C16.4646 36.2337 16.7627 36.4719 16.8221 36.8298L18.8483 47.9741C19.027 48.9871 19.9208 49.7021 20.9343 49.7021C21.0536 49.7021 21.1725 49.7021 21.2918 49.6427C22.4242 49.4639 23.1991 48.3316 23.0198 47.1992L20.5763 33.6711C20.4574 32.6576 19.6231 31.9426 18.5506 31.9426L18.5506 31.9425Z" fill="#F58B1E"/>
            <path d="M52.162 12.3956C52.162 14.963 50.081 17.044 47.5136 17.044C44.9463 17.044 42.8652 14.963 42.8652 12.3956C42.8652 9.82823 44.9463 7.74719 47.5136 7.74719C50.081 7.74719 52.162 9.82823 52.162 12.3956Z" fill="#F58B1E"/>
            <path d="M55.4391 22.1098C54.6643 21.9905 53.9493 22.5272 53.83 23.3016L51.9826 35.161C51.7444 36.7702 50.3734 37.9026 48.7647 37.9026L42.5666 37.9022C41.7918 37.9022 41.1362 38.5577 41.1362 39.3325C41.1362 40.1074 41.7918 40.7629 42.5666 40.7629H48.7643C51.744 40.7629 54.3064 38.6175 54.7238 35.6378L56.5711 23.7784C56.7503 22.9441 56.2136 22.2287 55.4391 22.1097V22.1098Z" fill="#F58B1E"/>
            <path d="M48.168 36.1739C49.2405 36.1739 50.0753 35.399 50.2541 34.3859L51.9821 23.1225C52.1609 21.9307 51.8034 20.679 50.9691 19.7253C50.1347 18.7717 49.0024 18.2355 47.7511 18.2355H47.0956C46.2613 18.2355 45.4269 18.5335 44.7714 18.9505L41.2554 21.2747C40.2423 21.9303 39.0505 22.2878 37.7989 22.2878H33.9254C32.9718 22.2878 32.1375 23.0626 32.1375 24.0757C32.1375 25.0293 32.9123 25.8637 33.9254 25.8637H37.8584C39.6463 25.8637 41.3744 25.3868 42.8642 24.4333L42.328 31.9421H38.0371C37.0241 31.9421 36.1299 32.6571 35.9511 33.6702L33.5076 47.1982C33.3288 48.3306 34.0439 49.4629 35.2356 49.6417C35.3549 49.6417 35.4738 49.7012 35.5931 49.7012C36.6062 49.7012 37.5004 48.9862 37.6792 47.9731L39.7053 36.8289C39.7647 36.4714 40.0628 36.2328 40.4203 36.2328L48.168 36.1739Z" fill="#F58B1E"/>
            <path d="M40.1245 28.9627C40.1245 28.1879 39.4689 27.5323 38.6941 27.5323H17.955C17.1802 27.5323 16.5247 28.1879 16.5247 28.9627C16.5247 29.7376 17.1802 30.3931 17.955 30.3931H26.9538V48.5696C26.9538 49.3444 27.6093 50 28.3842 50C29.159 50 29.8145 49.3444 29.8145 48.5696V30.3335H38.8133C39.4688 30.3335 40.1244 29.7378 40.1244 28.9629L40.1245 28.9627Z" fill="#F58B1E"/>
            </svg>

        </div>
        <p class="empty-dashboard-button-title font-24-lh-29-medium">
            {{__('Marketing Analytics Consulting')}}
        </p>
        <p class="empty-dashboard-button-text font-16-lh-19-regular">
            {{__('Our marketing experts will help you understand your marketing performance, discover the strengths and weaknesses of your advertising campaigns, and increase your ROI.')}}
        </p>
    </a>


 
  </div>
</div>
