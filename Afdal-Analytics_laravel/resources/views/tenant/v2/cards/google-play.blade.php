<button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
    <span>
        <svg width="45" height="50" viewBox="0 0 45 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.3809 0.755037C0.830041 1.34708 0.513428 2.25831 0.513428 3.44239V45.5597C0.513428 46.7438 0.830041 47.655 1.40149 48.2264L1.55079 48.3526L25.1501 24.7533V24.223L1.53019 0.628906L1.3809 0.755037Z" fill="url(#paint0_linear_4418_6839{{$random_id}})" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M33.0011 32.6507L25.1295 24.7766V24.2257L33.0037 16.3516L33.1736 16.4571L42.4866 21.7494C45.1534 23.2527 45.1534 25.729 42.4866 27.2528L33.1736 32.5452C33.171 32.5452 33.0011 32.6507 33.0011 32.6507Z" fill="url(#paint1_linear_4418_6839{{$random_id}})" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M33.171 32.5401L25.1296 24.4961L1.38098 48.2447C2.24845 49.1765 3.70796 49.282 5.33993 48.3708L33.171 32.5401Z" fill="url(#paint2_linear_4418_6839{{$random_id}})" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M33.171 16.4569L5.33993 0.646805C3.71053 -0.285017 2.24845 -0.158886 1.38098 0.772935L25.127 24.4983L33.171 16.4569Z" fill="url(#paint3_linear_4418_6839{{$random_id}})" />
            <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M33.001 32.3711L5.36044 48.0756C3.81599 48.9637 2.43885 48.9019 1.55079 48.0962L1.40149 48.2455L1.55079 48.3716C2.43885 49.1748 3.81599 49.2391 5.36044 48.3511L33.1915 32.541L33.001 32.3711Z" fill="black" />
            <path opacity="0.12" fill-rule="evenodd" clip-rule="evenodd" d="M42.484 26.9724L32.9805 32.3702L33.1504 32.5401L42.4634 27.2478C43.7968 26.4859 44.4532 25.4923 44.4532 24.4961C44.3682 25.4073 43.6913 26.2748 42.484 26.9724Z" fill="black" />
            <path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd" d="M5.33985 0.921312L42.484 22.0237C43.6912 22.7007 44.3682 23.5888 44.4738 24.5C44.4738 23.5064 43.8174 22.5102 42.484 21.7483L5.33985 0.645884C2.67309 -0.877979 0.513428 0.391049 0.513428 3.43877V3.7142C0.513428 0.666477 2.67309 -0.581958 5.33985 0.921312Z" fill="white" />
            <defs>
                <linearGradient id="paint0_linear_4418_6839{{$random_id}}" x1="23.0309" y1="2.98967" x2="-14.771" y2="13.062" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#00A0FF" />
                    <stop offset="0.007" stop-color="#00A1FF" />
                    <stop offset="0.26" stop-color="#00BEFF" />
                    <stop offset="0.512" stop-color="#00D2FF" />
                    <stop offset="0.76" stop-color="#00DFFF" />
                    <stop offset="1" stop-color="#00E3FF" />
                </linearGradient>
                <linearGradient id="paint1_linear_4418_6839{{$random_id}}" x1="45.9568" y1="24.5023" x2="-0.134652" y2="24.5023" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFE000" />
                    <stop offset="0.409" stop-color="#FFBD00" />
                    <stop offset="0.775" stop-color="#FFA500" />
                    <stop offset="1" stop-color="#FF9C00" />
                </linearGradient>
                <linearGradient id="paint2_linear_4418_6839{{$random_id}}" x1="28.7983" y1="28.8721" x2="-1.54926" y2="79.949" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FF3A44" />
                    <stop offset="1" stop-color="#C31162" />
                </linearGradient>
                <linearGradient id="paint3_linear_4418_6839{{$random_id}}" x1="-4.59712" y1="-13.2579" x2="8.94185" y2="9.55385" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#32A071" />
                    <stop offset="0.069" stop-color="#2DA771" />
                    <stop offset="0.476" stop-color="#15CF74" />
                    <stop offset="0.801" stop-color="#06E775" />
                    <stop offset="1" stop-color="#00F076" />
                </linearGradient>
            </defs>
        </svg>
    </span>
    <p class="m-0 primary-text-color connector-primary-name">{{__('Google Play')}}</p>
    @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
</button>