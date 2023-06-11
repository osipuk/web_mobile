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
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{!empty($seo->title) ? $seo->title : ''}}</title>
        {{--
        <meta name="description" content="{{!empty($seo->description) ? $seo->description : ''}}">
        <meta name="keywords" content="{{!empty($seo->keywords) ? $seo->keywords : ''}}">
        <meta name="author" content="{{!empty($seo->author) ? $seo->author : ''}}"> --}}
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
        <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}" />
    </head>

    <body>
        <div class="privacy-policy">
            <div class="container-1368px">
                <div class="header-menu">

                    <a class="navbar-brand-text" href="/">
                        @if($get_locale == 'en')
                        <img class="" src="{{url('/assets/image_new/svg/colored/afdal-logo-text-en.svg')}}" style="margin-top:10px;" alt="{{__('Afdal Analytics Platform')}}">
                        @else
                        <img class="" src="{{url('/assets/image_new/svg/colored/afdal-logo-text.svg')}}" alt="{{__('Afdal Analytics Platform')}}">
                        @endif
                    </a>


                </div>
                <p class="title font-90-lh-190-bold">
                    Privacy Policy
                </p>
                <p class="text font-18-lh-38-regular">
                    1. Introduction
                    <br>
                    Welcome to Red Castle Capital Partners.
                </p>
                <p class="text font-18-lh-38-regular">
                    Red Castle Capital Partners (“us”, “we”, or “our”) operates <a target="_blank" class="white-no-underline text-orange-hover"
                       href="{{url('/')}}">www.AfdalAnalytics.com</a> (hereinafter
                    referred to as “Service”).
                </p>
                <p class="text font-18-lh-38-regular">
                    Our Privacy Policy governs your visit to <a target="_blank" class="white-no-underline text-orange-hover" href="{{url('/')}}">www.AfdalAnalytics.com</a>, and
                    explains how we collect,
                    safeguard and disclose information that results from your use of our Service.
                </p>
                <p class="text font-18-lh-38-regular">
                    We use your data to provide and improve Service. By using Service, you agree to the collection and
                    use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy,
                    the terms used in this Privacy Policy have the same meanings as in our Terms and Conditions.
                </p>
                <p class="text font-18-lh-38-regular">
                    Our Terms and Conditions (“Terms”) govern all use of our Service and together with the Privacy
                    Policy constitutes your agreement with us (“agreement”).
                </p>
                <p class="text font-18-lh-38-regular">
                    2. Definitions
                    <br>
                    SERVICE means the <a target="_blank" class="white-no-underline text-orange-hover" href="{{url('/')}}">www.AfdalAnalytics.com</a> website operated by Red Castle
                    Capital Partners.
                </p>
                <p class="text font-18-lh-38-regular">
                    PERSONAL DATA means data about a living individual who can be identified from those data (or from
                    those and other information either in our possession or likely to come into our possession).
                </p>
                <p class="text font-18-lh-38-regular">
                    USAGE DATA is data collected automatically either generated by the use of Service or from Service
                    infrastructure itself (for example, the duration of a page visit).
                </p>
                <p class="text font-18-lh-38-regular">
                    COOKIES are small files stored on your device (computer or mobile device).
                </p>
                <p class="text font-18-lh-38-regular">
                    DATA CONTROLLER means a natural or legal person who (either alone or jointly or in common with other
                    persons) determines the purposes for which and the manner in which any personal data are, or are to
                    be, processed. For the purpose of this Privacy Policy, we are a Data Controller of your data.
                </p>
                <p class="text font-18-lh-38-regular">
                    DATA PROCESSORS (OR SERVICE PROVIDERS) means any natural or legal person who processes the data on
                    behalf of the Data Controller. We may use the services of various Service Providers in order to
                    process your data more effectively.
                </p>
                <p class="text font-18-lh-38-regular">
                    DATA SUBJECT is any living individual who is the subject of Personal Data.
                </p>
                <p class="text font-18-lh-38-regular">
                    THE USER is the individual using our Service. The User corresponds to the Data Subject, who is the
                    subject of Personal Data.
                </p>
                <p class="text font-18-lh-38-regular">
                    3. Information Collection and Use
                    <br>
                    We collect several different types of information for various purposes to provide and improve our
                    Service to you.
                </p>
                <p class="text font-18-lh-38-regular">
                    4. Types of Data Collected
                    <br>
                    Personal Data
                </p>
                <p class="text font-18-lh-38-regular">
                    While using our Service, we may ask you to provide us with certain personally identifiable
                    information that can be used to contact or identify you (“Personal Data”). Personally identifiable
                    information may include, but is not limited to:
                </p>
                <p class="text font-18-lh-38-regular">
                    (a) Email address
                </p>
                <p class="text font-18-lh-38-regular">
                    (b) First name and last name
                </p>
                <p class="text font-18-lh-38-regular">
                    (c) Phone number
                </p>
                <p class="text font-18-lh-38-regular">
                    (d) Address, State, Province, ZIP/Postal code, City
                </p>
                <p class="text font-18-lh-38-regular">
                    (e) Cookies and Usage Data
                </p>
                <p class="text font-18-lh-38-regular">
                    We may use your Personal Data to contact you with newsletters, marketing or promotional materials
                    and other information that may be of interest to you. You may opt out of receiving any, or all, of
                    these communications from us by emailing at <a target="_blank" class="white-no-underline text-orange-hover"
                       href="mailto:legal@afdalanalytics.com">legal@afdalanalytics.com</a>.
                </p>
                <p class="text font-18-lh-38-regular">
                    Usage Data
                </p>
                <p class="text font-18-lh-38-regular">
                    We may also collect information that your browser sends whenever you visit our Service or when you
                    access Service by or through a mobile device (“Usage Data”).
                </p>
                <p class="text font-18-lh-38-regular">
                    We may also collect information that your browser sends whenever you visit our Service or when you
                    access Service by or through a mobile device (“Usage Data”).
                </p>
                <p class="text font-18-lh-38-regular">
                    When you access Service with a mobile device, this Usage Data may include information such as the
                    type of mobile device you use, your mobile device unique ID, the IP address of your mobile device,
                    your mobile operating system, the type of mobile Internet browser you use, unique device identifiers
                    and other diagnostic data.
                </p>
                <p class="text font-18-lh-38-regular">
                    Location Data
                </p>
                <p class="text font-18-lh-38-regular">
                    We may use and store information about your location if you give us permission to do so (“Location
                    Data”). We use this data to provide features of our Service, to improve and customize our Service.
                </p>
                <p class="text font-18-lh-38-regular">
                    You can enable or disable location services when you use our Service at any time by way of your
                    device settings.
                </p>
                <p class="text font-18-lh-38-regular">
                    Tracking Cookies Data
                </p>
                <p class="text font-18-lh-38-regular">
                    We use cookies and similar tracking technologies to track the activity on our Service and we hold
                    certain information.
                </p>
                <p class="text font-18-lh-38-regular">
                    Cookies are files with a small amount of data which may include an anonymous unique identifier.
                    Cookies are sent to your browser from a website and stored on your device. Other tracking
                    technologies are also used such as beacons, tags and scripts to collect and track information and to
                    improve and analyze our Service.
                </p>
                <p class="text font-18-lh-38-regular">
                    You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.
                    However, if you do not accept cookies, you may not be able to use some portions of our Service.
                </p>
                <p class="text font-18-lh-38-regular">
                    Examples of Cookies we use:
                </p>
                <p class="text font-18-lh-38-regular">
                    (a) Session Cookies: We use Session Cookies to operate our Service.
                </p>
                <p class="text font-18-lh-38-regular">
                    (b) Preference Cookies: We use Preference Cookies to remember your preferences and various settings.
                </p>
                <p class="text font-18-lh-38-regular">
                    (c) Security Cookies: We use Security Cookies for security purposes
                </p>
                <p class="text font-18-lh-38-regular">
                    (d) Advertising Cookies: Advertising Cookies are used to serve you with advertisements that may be
                    relevant to you and your interests.
                </p>
                <p class="text font-18-lh-38-regular">
                    Other Data
                </p>
                <p class="text font-18-lh-38-regular">
                    While using our Service, we may also collect the following information: sex, age, date of birth,
                    place of birth, passport details, citizenship, registration at place of residence and actual
                    address, telephone number (work, mobile), details of documents on education, qualification,
                    professional training, employment agreements, non-disclosure agreements, information on bonuses and
                    compensation, information on marital status, family members, social security (or other taxpayer
                    identification) number, office location and other data.
                </p>
                <p class="text font-18-lh-38-regular">
                    5. Use of Data
                    <br>
                    Red Castle Capital Partners uses the collected data for various purposes:
                </p>
                <p class="text font-18-lh-38-regular">
                    (a) to provide and maintain our Service;
                </p>
                <p class="text font-18-lh-38-regular">
                    (b) to notify you about changes to our Service;
                </p>
                <p class="text font-18-lh-38-regular">
                    (c) to allow you to participate in interactive features of our Service when you choose to do so;
                </p>
                <p class="text font-18-lh-38-regular">
                    (d) to provide customer support;
                </p>
                <p class="text font-18-lh-38-regular">
                    (e) to gather analysis or valuable information so that we can improve our Service;
                </p>
                <p class="text font-18-lh-38-regular">
                    (f) to monitor the usage of our Service;
                </p>
                <p class="text font-18-lh-38-regular">
                    (g) to detect, prevent and address technical issues;
                </p>
                <p class="text font-18-lh-38-regular">
                    (h) to fulfill any other purpose for which you provide it;
                </p>
                <p class="text font-18-lh-38-regular">
                    (i) to carry out our obligations and enforce our rights arising from any contracts entered into
                    between you and us, including for billing and collection;
                </p>
                <p class="text font-18-lh-38-regular">
                    (j) to provide you with notices about your account and/or subscription, including expiration and
                    renewal notices, email-instructions, etc.;
                </p>
                <p class="text font-18-lh-38-regular">
                    (k) to provide you with news, special offers and general information about other goods, services and
                    events which we offer that are similar to those that you have already purchased or enquired about
                    unless you have opted not to receive such information;
                </p>
                <p class="text font-18-lh-38-regular">
                    (l) in any other way we may describe when you provide the information;
                </p>
                <p class="text font-18-lh-38-regular">
                    (m) for any other purpose with your consent.
                </p>
                <p class="text font-18-lh-38-regular">
                    6. Retention of Data
                    We will retain your Personal Data only for as long as is necessary for the purposes set out in this
                    Privacy Policy. We will retain and use your Personal Data to the extent necessary to comply with our
                    legal obligations (for example, if we are required to retain your data to comply with applicable
                    laws), resolve disputes, and enforce our legal agreements and policies.
                </p>
                <p class="text font-18-lh-38-regular">
                    We will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for
                    a shorter period, except when this data is used to strengthen the security or to improve the
                    functionality of our Service, or we are legally obligated to retain this data for longer time
                    periods.
                </p>
                <p class="text font-18-lh-38-regular">
                    7. Transfer of Data
                    Your information, including Personal Data, may be transferred to – and maintained on – computers
                    located outside of your state, province, country or other governmental jurisdiction where the data
                    protection laws may differ from those of your jurisdiction.
                </p>
                <p class="text font-18-lh-38-regular">
                    If you are located outside United States and choose to provide information to us, please note that
                    we transfer the data, including Personal Data, to United States and process it there.
                </p>
                <p class="text font-18-lh-38-regular">
                    Your consent to this Privacy Policy followed by your submission of such information represents your
                    agreement to that transfer.
                </p>
                <p class="text font-18-lh-38-regular">
                    Red Castle Capital Partners will take all the steps reasonably necessary to ensure that your data is
                    treated securely and in accordance with this Privacy Policy and no transfer of your Personal Data
                    will take place to an organisation or a country unless there are adequate controls in place
                    including the security of your data and other personal information.
                </p>
                <p class="text font-18-lh-38-regular">
                    8. Disclosure of Data
                    <br>
                    We may disclose personal information that we collect, or you provide:
                </p>
                <p class="text font-18-lh-38-regular">
                    (a) Disclosure for Law Enforcement.
                </p>
                <p class="text font-18-lh-38-regular">
                    Under certain circumstances, we may be required to disclose your Personal Data if required to do so
                    by law or in response to valid requests by public authorities.
                </p>
                <p class="text font-18-lh-38-regular">
                    (b) Business Transaction.
                </p>
                <p class="text font-18-lh-38-regular">
                    If we or our subsidiaries are involved in a merger, acquisition or asset sale, your Personal Data
                    may be transferred.
                </p>
                <p class="text font-18-lh-38-regular">
                    (c) Other cases. We may disclose your information also:
                </p>
                <p class="text font-18-lh-38-regular">
                    (i) to our subsidiaries and affiliates;
                </p>
                <p class="text font-18-lh-38-regular">
                    (ii) with your consent in any other cases;
                </p>
                <p class="text font-18-lh-38-regular">
                    (iii) if we believe disclosure is necessary or appropriate to protect the rights, property, or
                    safety of the Company, our customers, or others.
                </p>
                <p class="text font-18-lh-38-regular">
                    9. Security of Data
                    <br>
                    The security of your data is important to us but remember that no method of transmission over the Internet or method of electronic storage is 100% secure. While
                    we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.
                </p>
                <p class="text font-18-lh-38-regular">
                    10. Your Data Protection Rights Under General Data Protection Regulation (GDPR)
                    <br>
                    If you are a resident of the European Union (EU) and European Economic Area (EEA), you have certain data protection rights, covered by GDPR. – See more at <a
                       target="_blank" class="white-no-underline text-orange-hover"
                       href="https://eur-lex.europa.eu/eli/reg/2016/679/oj">https://eur-lex.europa.eu&#8203;/eli&#8203;/reg&#8203;/2016&#8203;/679&#8203;/oj</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    We aim to take reasonable steps to allow you to correct, amend, delete, or limit the use of your Personal Data.
                </p>
                <p class="text font-18-lh-38-regular">
                    If you wish to be informed what Personal Data we hold about you and if you want it to be removed from our systems, please email us at <a target="_blank"
                       class="white-no-underline text-orange-hover" href="mailto:legal@afdalanalytics.com">legal@afdalanalytics.com</a>.
                </p>
                <p class="text font-18-lh-38-regular">
                    In certain circumstances, you have the following data protection rights:
                </p>
                <p class="text font-18-lh-38-regular">
                    (a) the right to access, update or to delete the information we have on you;
                </p>
                <p class="text font-18-lh-38-regular">
                    (b) the right of rectification. You have the right to have your information rectified if that information is inaccurate or incomplete;
                </p>
                <p class="text font-18-lh-38-regular">
                    (c) the right to object. You have the right to object to our processing of your Personal Data;
                </p>
                <p class="text font-18-lh-38-regular">
                    (d) the right of restriction. You have the right to request that we restrict the processing of your personal information;
                </p>
                <p class="text font-18-lh-38-regular">
                    (e) the right to data portability. You have the right to be provided with a copy of your Personal Data in a structured, machine-readable and commonly used
                    format;
                </p>
                <p class="text font-18-lh-38-regular">
                    (f) the right to withdraw consent. You also have the right to withdraw your consent at any time where we rely on your consent to process your personal
                    information;
                </p>
                <p class="text font-18-lh-38-regular">
                    Please note that we may ask you to verify your identity before responding to such requests.
                </p>
                <p class="text font-18-lh-38-regular">
                    Please note, we may not able to provide Service without some necessary data.
                </p>
                <p class="text font-18-lh-38-regular">
                    You have the right to complain to a Data Protection Authority about our collection and use of your Personal Data. For more information, please contact your
                    local data protection authority in the European Economic Area (EEA).
                </p>
                <p class="text font-18-lh-38-regular">
                    11. Service Providers
                    <br>
                    We may employ third party companies and individuals to facilitate our Service (“Service Providers”), provide Service on our behalf, perform Service-related
                    services or assist us in analysing how our Service is used.
                </p>
                <p class="text font-18-lh-38-regular">
                    11. Service Providers
                    We may employ third party companies and individuals to facilitate our Service (“Service Providers”), provide Service on our behalf, perform Service-related
                    services or assist us in analysing how our Service is used.
                </p>
                <p class="text font-18-lh-38-regular">
                    Google Analytics
                </p>
                <p class="text font-18-lh-38-regular">
                    Google Analytics is a web analytics service offered by Google that tracks and reports website traffic. Google uses the data collected to track and monitor the
                    use of our Service. This data is shared with other Google services. Google may use the collected data to contextualise and personalise the ads of its own
                    advertising network.
                </p>
                <p class="text font-18-lh-38-regular">
                    For more information on the privacy practices of Google, please visit the Google Privacy Terms web page: <a target="_blank"
                       class="white-no-underline text-orange-hover" href="https://policies.google.com/privacy?hl=en">https://policies.google.com&#8203;/privacy?hl=en</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    We also encourage you to review the Google's policy for safeguarding your data: <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://support.google.com/analytics/answer/6004245">https://support.google.com&#8203;/analytics&#8203;/answer&#8203;/6004245</a>.
                </p>
                <p class="text font-18-lh-38-regular">
                    13. CI/CD tools
                    <br>
                    We may use third-party Service Providers to automate the development process of our Service.
                </p>
                <p class="text font-18-lh-38-regular">
                    GitHub
                </p>
                <p class="text font-18-lh-38-regular">
                    GitHub is provided by GitHub, Inc
                </p>
                <p class="text font-18-lh-38-regular">
                    GitHub is a development platform to host and review code, manage projects, and build software.
                </p>
                <p class="text font-18-lh-38-regular">
                    For more information on what data GitHub collects for what purpose and how the protection of the data is ensured, please visit GitHub Privacy Policy page: <a
                       target="_blank" class="white-no-underline text-orange-hover"
                       href="https://help.github.com/en/articles/github-privacy-statement">https://help.github.com&#8203;/en&#8203;/articles&#8203;/github-privacy-statement</a>.
                </p>
                <p class="text font-18-lh-38-regular">
                    14. Advertising
                    <br>
                    We may use third-party Service Providers to show advertisements to you to help support and maintain our Service.
                </p>
                <p class="text font-18-lh-38-regular">
                    Google AdSense DoubleClick Cookie
                </p>
                <p class="text font-18-lh-38-regular">
                    Google, as a third party vendor, uses cookies to serve ads on our Service. Google's use of the DoubleClick cookie enables it and its partners to serve ads to
                    our users based on their visit to our Service or other websites on the Internet.
                </p>
                <p class="text font-18-lh-38-regular">
                    You may opt out of the use of the DoubleClick Cookie for interest-based advertising by visiting the Google Ads Settings web page: <a target="_blank"
                       class="white-no-underline text-orange-hover" href="https://adssettings.google.com/">https://adssettings.google.com/</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    AdMob by Google
                </p>
                <p class="text font-18-lh-38-regular">
                    AdMob by Google is provided by Google Inc.
                </p>
                <p class="text font-18-lh-38-regular">
                    You can opt-out from the AdMob by Google service by following the instructions described by Google: <a target="_blank"
                       class="white-no-underline text-orange-hover"
                       href="https://support.google.com/ads/answer/2662922?hl=en">https://support.google.com&#8203;/ads&#8203;/answer&#8203;/2662922?hl=en</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    For more information on how Google uses the collected information, please visit the “How Google uses data when you use our partners' sites or app” page: <a
                       target="_blank" class="white-no-underline text-orange-hover"
                       href="https://www.google.com/policies/privacy/partners">https://www.google.com&#8203;/policies&#8203;/privacy&#8203;/partners</a> or visit the Privacy Policy
                    of Google: <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://www.google.com/policies/privacy">https://www.google.com&#8203;/policies&#8203;/privacy</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    15. Behavioral Remarketing
                    <br>
                    Red Castle Capital Partners uses remarketing services to advertise on third party websites to you after you visited our Service. We and our third-party vendors
                    use cookies to inform, optimise and serve ads based on your past visits to our Service.
                </p>
                <p class="text font-18-lh-38-regular">
                    Google Ads (AdWords)
                </p>
                <p class="text font-18-lh-38-regular">
                    Google Ads (AdWords) remarketing service is provided by Google Inc.
                </p>
                <p class="text font-18-lh-38-regular">
                    You can opt-out of Google Analytics for Display Advertising and customize the Google Display Network ads by visiting the Google Ads Settings page: <a
                       target="_blank" class="white-no-underline text-orange-hover" href="https://www.google.com/settings/ads">https://www.google.com&#8203;/settings&#8203;/ads</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    Google also recommends installing the Google Analytics Opt-out Browser Add-on – <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://tools.google.com/dlpage/gaoptout">https://tools.google.com&#8203;/dlpage&#8203;/gaoptout</a> – for your web browser. Google Analytics Opt-out
                    Browser Add-on provides visitors with the ability to prevent their data from being collected and used by Google Analytics.
                </p>
                <p class="text font-18-lh-38-regular">
                    For more information on the privacy practices of Google, please visit the Google Privacy Terms web page: <a target="_blank"
                       class="white-no-underline text-orange-hover" href="https://policies.google.com/privacy?hl=en">https://policies.google.com&#8203;/privacy?hl=en</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    Twitter
                </p>
                <p class="text font-18-lh-38-regular">
                    Twitter remarketing service is provided by Twitter Inc.
                </p>
                <p class="text font-18-lh-38-regular">
                    You can opt-out from Twitter's interest-based ads by following their instructions: <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://support.twitter.com/articles/20170405">https://support.twitter.com&#8203;/articles&#8203;/20170405</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    You can learn more about the privacy practices and policies of Twitter by visiting their Privacy Policy page: <a target="_blank"
                       class="white-no-underline text-orange-hover" href="https://twitter.com/privacy">https://twitter.com&#8203;/privacy</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    Facebook
                </p>
                <p class="text font-18-lh-38-regular">
                    Facebook remarketing service is provided by Facebook Inc.
                </p>
                <p class="text font-18-lh-38-regular">
                    You can learn more about interest-based advertising from Facebook by visiting this page: <a target="_blank" class="white-no-underline text-orange-hover"
                       href=" https://www.facebook.com/help/516147308587266"> https://www.facebook.com&#8203;/help&#8203;/516147308587266</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    To opt-out from Facebook's interest-based ads, follow these instructions from Facebook: <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://www.facebook.com/help/568137493302217">https://www.facebook.com&#8203;/help&#8203;/568137493302217</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    Facebook adheres to the Self-Regulatory Principles for Online Behavioural Advertising established by the Digital Advertising Alliance. You can also opt-out from
                    Facebook and other participating companies through the Digital Advertising Alliance in the USA <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://optout.aboutads.info">https://optout.aboutads.info</a>, the Digital Advertising Alliance of Canada in Canada <a target="_blank"
                       class="white-no-underline text-orange-hover" href="https://youradchoices.ca">https://youradchoices.ca</a> or the European Interactive Digital Advertising
                    Alliance in Europe <a target="_blank" class="white-no-underline text-orange-hover" href="https://www.youronlinechoices.eu">https://www.youronlinechoices.eu</a>,
                    or opt-out using your mobile device settings.
                </p>
                <p class="text font-18-lh-38-regular">
                    For more information on the privacy practices of Facebook, please visit Facebook's Data Policy: <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://www.facebook.com/privacy/explanation">https://www.facebook.com&#8203;/privacy&#8203;/explanation</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    16. Payments
                    <br>
                    We may provide paid products and/or services within Service. In that case, we use third-party services for payment processing (e.g. payment processors).
                </p>
                <p class="text font-18-lh-38-regular">
                    We will not store or collect your payment card details. That information is provided directly to our third-party payment processors whose use of your personal
                    information is governed by their Privacy Policy. These payment processors adhere to the standards set by PCI-DSS as managed by the PCI Security Standards
                    Council, which is a joint effort of brands like Visa, Mastercard, American Express and Discover. PCI-DSS requirements help ensure the secure handling of payment
                    information.
                </p>
                <p class="text font-18-lh-38-regular">
                    The payment processors we work with are:
                </p>
                <p class="text font-18-lh-38-regular">
                    PayPal or Braintree:
                </p>
                <p class="text font-18-lh-38-regular">
                    Their Privacy Policy can be viewed at <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://www.paypal.com/webapps/mpp/ua/privacy-full">https://www.paypal.com&#8203;/webapps&#8203;/mpp&#8203;/ua&#8203;/privacy-full</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    Stripe:
                </p>
                <p class="text font-18-lh-38-regular">
                    Their Privacy Policy can be viewed at: <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://stripe.com/us/privacy">https://stripe.com&#8203;/us&#8203;/privacy</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    17. Links to Other Sites
                    <br>
                    Our Service may contain links to other sites that are not operated by us. If you click a third party link, you will be directed to that third party's site. We
                    strongly advise you to review the Privacy Policy of every site you visit.
                </p>
                <p class="text font-18-lh-38-regular">
                    We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.
                </p>
                <p class="text font-18-lh-38-regular">
                    18. Children's Privacy
                    <br>
                    Our Services are not intended for use by children under the age of 18 (“Child” or “Children”).
                </p>
                <p class="text font-18-lh-38-regular">
                    We do not knowingly collect personally identifiable information from Children under 18. If you become aware that a Child has provided us with Personal Data,
                    please contact us. If we become aware that we have collected Personal Data from Children without verification of parental consent, we take steps to remove that
                    information from our servers.
                </p>
                <p class="text font-18-lh-38-regular">
                    19. Changes to This Privacy Policy
                    <br>
                    We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.
                </p>
                <p class="text font-18-lh-38-regular">
                    We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update “effective date” at the top of this
                    Privacy Policy.
                </p>
                <p class="text font-18-lh-38-regular">
                    You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.
                </p>
                <p class="text font-18-lh-38-regular">
                    20. Contact Us
                    <br>
                    If you have any questions about this Privacy Policy, please contact us:
                </p>
                <p class="text font-18-lh-38-regular">
                    By email: <a target="_blank" class="white-no-underline text-orange-hover" href="mailto:legal@afdalanalytics.com">legal@afdalanalytics.com</a>.
                </p>
            </div>
        </div>
    </body>
    @include('frontend.components.cookie')
    @include('frontend.components.loader')
    @include('frontend.components.topup')