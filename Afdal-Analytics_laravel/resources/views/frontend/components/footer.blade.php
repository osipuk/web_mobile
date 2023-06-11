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


<footer style="position: relative; z-index: 10" class="footer-component">
  <div class="footer-main-info">
    <div class="footer-content-wrapper">
      <div class="footer-main-info-content">
        <div class="footer-about">
          <a href="/" class="footer-home-link font-30-lh-63-semi-bold">
            {{__('Afdal Analytics')}}
          </a>

          <p class="footer-slogan font-13-lh-20-medium">
            {{__('Empowering digital marketers with insight that helps drive strategy.')}}
          </p>

          <div class="footer-social-links" style="direction: rtl !important;">

            <a class="footer-social-link footer-social-link--twitter"
              href="https://twitter.com/afdalanalytics"
              target="_blanc"
            ></a>

            <a class="footer-social-link footer-social-link--instagram"
              href="https://www.instagram.com/afdalanalytics"
              target="_blanc"
            ></a>

            <a class="footer-social-link footer-social-link--facebook"
              href="https://www.facebook.com/Afdal.Analytics"
              target="_blanc"
            ></a>

            <a class="footer-social-link footer-social-link--linkedin"
              href="https://www.linkedin.com/company/afdalanalytics"
              target="_blanc"
            ></a>
          </div>
        </div>
        @if($get_locale == 'ar')
        <div class="footer-menu">
          <div class="footer-menu-item footer-item-none">
            <h3 class="footer-menu-heading font-20-lh-42-semi-bold">
              {{__('ACCOUNT')}}
            </h3>

            <a href="/signup" class="footer-menu-link font-14-lh-30-regular">
              {{__('Sign Up ')}}
            </a>
            <a href="/login" class="footer-menu-link font-14-lh-30-regular">
              {{__('Sign In ')}}
            </a>
            <a href="/reset-password" class="footer-menu-link font-14-lh-30-regular">
              {{__('Forgot Password')}}
            </a>
          </div>
          <div class="footer-menu-item">
            <h3 class="footer-menu-heading font-20-lh-42-semi-bold">
              {{__('RESOURCES')}}
            </h3>

            <a href="/blog" class="footer-menu-link font-14-lh-30-regular">
              {{__('Blog')}}
            </a>
            <a href="/guides" class="footer-menu-link font-14-lh-30-regular">
              {{__('Guides ')}}
            </a>
            <a href="/glossary" class="footer-menu-link font-14-lh-30-regular">
              {{__('Glossary')}}
            </a>
          </div>

          <div class="footer-menu-item">
            <h3 class="footer-menu-heading font-20-lh-42-semi-bold">
              {{__('PRODUCT')}}
            </h3>

            <a href="/about-afdal" class="footer-menu-link font-14-lh-30-regular">
              {{__('Overview')}}
            </a>
            <a href="/about-connections" class="footer-menu-link font-14-lh-30-regular">
              {{__('Connections')}}
            </a>
            <a href="/about-dashboards" class="footer-menu-link font-14-lh-30-regular">
              {{__('Dashboards')}}
            </a>
          </div>

          <div    class="footer-menu-item">
            <h3 class="footer-menu-heading font-20-lh-42-semi-bold">
              {{__('COMPANY')}}
            </h3>

            <a href="/why-us" class="footer-menu-link font-14-lh-30-regular">
              {{__('About Us')}}
            </a>
            <a href="/pricing" class="footer-menu-link font-14-lh-30-regular">
              {{__('Pricing')}}
            </a>
            <a href="/contact-us" class="footer-menu-link font-14-lh-30-regular">
              {{__('Contact Us')}}
            </a>
            <a target="_blank" href="https://afdalanalytics.tapfiliate.com/publisher/signup/afdal-analytics-affiliate-program/" class="footer-menu-link font-14-lh-30-regular">
              {{__('Affiliate Partners')}}
            </a>
          </div>
        </div>
        @else
        <div class="footer-menu">
          <div  class="footer-menu-item">
            <h3 class="footer-menu-heading font-20-lh-42-semi-bold">
              {{__('COMPANY')}}
            </h3>

            <a href="/why-us" class="footer-menu-link font-14-lh-30-regular">
              {{__('About Us')}}
            </a>
            <a href="/pricing" class="footer-menu-link font-14-lh-30-regular">
              {{__('Pricing')}}
            </a>
            <a href="/contact-us" class="footer-menu-link font-14-lh-30-regular">
              {{__('Contact Us')}}
            </a>
            <a target="_blank" href="https://afdalanalytics.tapfiliate.com/publisher/signup/afdal-analytics-affiliate-program/" class="footer-menu-link font-14-lh-30-regular">
              {{__('Affiliate Partners')}}
            </a>
          </div>
          <div class="footer-menu-item">
            <h3 class="footer-menu-heading font-20-lh-42-semi-bold">
              {{__('PRODUCT')}}
            </h3>

            <a href="/about-afdal" class="footer-menu-link font-14-lh-30-regular">
              {{__('Overview')}}
            </a>
            <a href="/about-connections" class="footer-menu-link font-14-lh-30-regular">
              {{__('Connections')}}
            </a>
            <a href="/about-dashboards" class="footer-menu-link font-14-lh-30-regular">
              {{__('Dashboards')}}
            </a>
          </div>
          <div class="footer-menu-item footer-item-none">
            <h3 class="footer-menu-heading font-20-lh-42-semi-bold">
              {{__('ACCOUNT')}}
            </h3>

            <a href="/signup" class="footer-menu-link font-14-lh-30-regular">
              {{__('Sign Up ')}}
            </a>
            <a href="/login" class="footer-menu-link font-14-lh-30-regular">
              {{__('Sign In ')}}
            </a>
            <a href="/reset-password" class="footer-menu-link font-14-lh-30-regular">
              {{__('Forgot Password')}}
            </a>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>

  <div class="footer-legal-info">
    <div class="footer-content-wrapper">
      <div class="footer-legal-content">
        <div class="footer-copywrite font-13-lh-19-semi-bold">
         {{__('©2022 Afdal Analytics Inc. All Rights Reserved.')}}
{{--          {{__('© ' . date('Y'))}}--}}
        </div>

        <div class="footer-legal-links">
          <a href="{{url('/privacy-policy')}}" class="footer-legal-link font-13-lh-19-semi-bold">
            {{__('Privacy Policy')}}
          </a>
          <a href="{{url('/cookie-policy')}}" class="footer-legal-link font-13-lh-19-semi-bold">
            {{__('Cookie Policy')}}
          </a>
          <a href="https://intercom.help/afdal-analytics/ar/" class="footer-legal-link font-13-lh-19-semi-bold">
            {{__('Help section')}}
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>
@if (env('APP_ENV') == 'staging')
  @extends('layout.language-picker')
@endif
