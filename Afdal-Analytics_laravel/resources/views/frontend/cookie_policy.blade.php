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
<html lang="en">

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
                <h1 class="title font-90-lh-190-bold">
                    Cookies Policy
                </h1>
                <p class="text font-18-lh-38-regular">
                    Your Rights
                    <br>
                    When using our website and submitting personal data to us, you may have certain rights under the General Data Protection Regulation (GDPR) and other laws.
                    Depending on the legal basis for processing your personal data, you may have some or all of the following rights:
                </p>
                <p class="text font-18-lh-38-regular">
                    You have the right to be informed about the personal data we collect from you, and how we process it.
                    <br>
                    The right of access
                    <br>

                    You have the right to get confirmation that your personal data is being processed and have the ability to access your personal data.
                    <br>
                    The right to rectification
                    <br>
                    You have the right to have your personal data corrected if it is inaccurate or incomplete.
                    <br>
                    The right to erasure (right to be forgotten)
                    <br>
                    You have the right to request the removal or deletion of your personal data if there is no compelling reason for us to continue processing it.
                    <br>
                    The right to restrict processing
                    <br>
                    You have a right to ‘block’ or restrict the processing of your personal data. When your personal data is restricted, we are permitted to store your data, but
                    not to process it further.
                    <br>
                    The right to data portability
                    <br>
                    You have the right to request and get your personal data that you provided to us and use it for your own purposes. We will provide your data to you within 30
                    days of your request. To request your personal data, please contact us using the information at the top of this privacy notice.
                    <br>
                    The right to object
                    <br>
                    You have the right to object to us processing your personal data for the following reasons:
                    <br>
                    Processing was based on legitimate interests or the performance of a task in the public interest/exercise of official authority (including profiling);
                    <br>
                    Direct marketing (including profiling);
                    <br>
                    Processing for purposes of scientific/historical research and statistics.
                    <br>
                    Rights in relation to automated decision-making and profiling.
                    <br>
                    AUTOMATED INDIVIDUAL DECISION-MAKING AND PROFILING
                    <br>
                    You will have the right not to be subject to a decision based solely on automated processing, including profiling, which produces legal effects concerning you
                    or similarly significantly affects you.
                </p>
                <p class="text font-18-lh-38-regular">
                    FILING A COMPLAINT WITH AUTHORITIES
                    <br>
                    You have the right to file a complaint with supervisory authorities if your information has not been processed in compliance with the General Data Protection
                    Regulation. If the supervisory authorities fail to address your complaint properly, you may have the right to a judicial remedy.
                </p>
                <p class="text font-18-lh-38-regular">
                    For details about your rights under the law, visit <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://goo.gl/F41vAV">https://goo.gl&#8203;/F41vAV</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    DEFINITIONS
                    <br>
                    ‘Non-personal data’ (NPD) is information that is in no way personally identifiable.
                    <br>
                    ‘Personal data’ (PD) means any information relating to an identified or identifiable natural person (‘data subject’); an identifiable natural person is one who
                    can be identified, directly or indirectly, by reference to an identifier such as a name, an identification number, location data, an online identifier or to one
                    or more factors specific to the physical, physiological, genetic, mental, economic, cultural or social identity of that natural person. Personal Data is in many
                    ways the same as Personally Identifiable Information (PII). However, Personal Data is broader in scope and covers more data.
                </p>
                <p class="text font-18-lh-38-regular">
                    A “visitor” is someone who merely browses our website. A “member” is someone who has registered with us to use or buy our services and products. The term “user”
                    is a collective identifier that refers to either a visitor or a member.
                </p>
                <p class="text font-18-lh-38-regular">
                    Information We Collect
                    <br>
                    Generally, you control the amount and type of information that you provide to us when using our website.
                </p>
                <p class="text font-18-lh-38-regular">
                    UR LEGAL BASIS FOR COLLECTING AND PROCESSING PERSONAL DATA
                    <br>
                    Our legal basis for collecting and processing your Personal Data when you buy our products or services is based on and the necessity for the performance of a
                    contract or to take steps to enter into a contract. Our legal basis for collecting and processing your Personal Data when you sign up for our newsletter,
                    conference, workshop, services, and product information through our website opt-in forms is based on consent.
                </p>
                <p class="text font-18-lh-38-regular">
                    WHAT HAPPENS IF YOU DON’T GIVE US YOUR PERSONAL DATA
                    <br>
                    Not much. In the worst case, we may not be able to provide you with a full functionality of all our products and services, but this should be an exception. You
                    can access and use most parts of our website without giving us your Personal Data.
                </p>
                <p class="text font-18-lh-38-regular">
                    We Collect Your Personal Data In The Following Ways
                    <br>
                    AUTOMATIC INFORMATION
                    <br>
                    We automatically receive information from your web browser or mobile device. This information may include the name of the website from which you entered our
                    website, if any, as well as the name of the website you’ll visit when you leave our website, your Internet service provider’s name, your web browser type, the
                    type of mobile device, your computer operating system, and data about your browsing activity when using our website. We use all this information to analyze
                    trends among our users to help improve our website.
                </p>
                <p class="text font-18-lh-38-regular">
                    WHEN ENTERING AND USING OUR WEBSITE
                    <br>
                    When you enter and use our website and agree to accept cookies, some of these cookies may contain your Personal Data.
                </p>
                <p class="text font-18-lh-38-regular">
                    AT USER AND MEMBER REGISTRATION OR WHEN BUYING PRODUCTS OR SERVICES
                    <br>
                    When you register as a user, member, or when buying our products or services, we may collect some or all of the following information: your first and last name,
                    email address, physical address, company name, credit card or other payment information, phone number, user name, password, and other information listed.
                </p>
                <p class="text font-18-lh-38-regular">
                    OUR USE OF COOKIES
                    <br>
                    Our website uses cookies. A cookie is a small piece of data or a text file that is downloaded to your computer or mobile device when you access certain
                    websites. Cookies may contain text that can be read by the web server that delivered the cookie to you. The text contained in the cookie generally consists of a
                    sequence of letters and numbers that uniquely identifies your computer or mobile device; it may contain other information as well.
                </p>
                <p class="text font-18-lh-38-regular">
                    By agreeing to accept our use of cookies, you are giving us, and third parties we partner with, permission to place, store, and access some or all the cookies
                    described below on your computer.
                </p>
                <p class="text font-18-lh-38-regular">
                    STRICTLY NECESSARY COOKIES
                    <br>
                    These cookies are necessary for proper functioning of the website, such as displaying content, logging in, validating your session, responding to your request
                    for services, and other functions. Most web browsers can be set to disable the use of cookies. However, if you disable these cookies, you may not be able to
                    access features on our website correctly or at all.
                </p>
                <p class="text font-18-lh-38-regular">
                    PERFORMANCE COOKIES
                    <br>
                    These cookies collect information about the use of the website, such as pages visited, traffic sources, users’ interests, content management, and other website
                    measurements.
                </p>
                <p class="text font-18-lh-38-regular">
                    FUNCTIONAL COOKIES
                    <br>
                    These cookies enable the website to remember a user’s choices – such as their language, user name, and other personal choices – while using the website. They
                    can also be used to deliver services, such as letting a user make a blog post, listen to audio, or watch videos on the website.
                </p>
                <p class="text font-18-lh-38-regular">
                    MEDIA COOKIES
                    <br>
                    These cookies can be used to improve a website’s performance and provide special features and content such as the author images. They can be placed by third
                    parties who provide services to us or by our company.
                </p>
                <p class="text font-18-lh-38-regular">
                    ADVERTISING OR TARGETING COOKIES
                    <br>
                    These cookies are usually placed and used by advertising companies to develop a profile of your browsing interests and serve advertisements on other websites
                    that are related to your interests. You will see less advertising if you disable these cookies.
                </p>
                <p class="text font-18-lh-38-regular">
                    SESSION COOKIES
                    <br>
                    These cookies allow websites to link the actions of a user during a browser session. They may be used for a variety of purposes, such as remembering what a user
                    has put in their shopping cart as they browse a website. Session cookies also permit users to be recognized as they navigate a website so that any item or page
                    changes they make are remembered from page to page. Session cookies expire after a browser session; thus, they are not stored long term.
                </p>
                <p class="text font-18-lh-38-regular">
                    PERSISTENT COOKIES
                    <br>
                    These cookies are stored on a user’s device in between browser sessions, which allows the user’s preferences or actions across a site (or, in some cases, across
                    different sites) to be remembered. Persistent cookies may be used for a variety of purposes, including remembering users’ choices and preferences when using a
                    website or to target advertising to them.
                </p>
                <p class="text font-18-lh-38-regular">
                    WE MAY ALSO USE COOKIES FOR:
                    <br>
                    Identifying the areas of our website that you have visited
                    <br>
                    Personalizing content that you see on our website
                    <br>
                    Our website analytics
                    <br>
                    Remarketing our products or services to you
                    <br>
                    Remembering your preferences, settings, and login details
                    <br>
                    Targeted advertising and serving ads relevant to your interests
                    <br>
                    Allowing you to post comments
                    <br>
                    Allowing you to share content with social networks
                    <br>
                    Most web browsers can be set to disable the use of cookies. However, if you disable cookies, you may not be able to access features on our website correctly or
                    at all.
                </p>
                <p class="text font-18-lh-38-regular">
                    WEB BEACONS
                    <br>
                    We may also use a technology called web beacons to collect general information about your use of our website and your use of special promotions or newsletters.
                    The information we collect by web beacons allows us to statistically monitor the number of people who open our emails. Web beacons also help us to understand
                    the behavior of our customers, members, and visitors.
                </p>
                <p class="text font-18-lh-38-regular">
                    GOOGLE ANALYTICS PRIVACY NOTICE
                    <br>
                    Our website uses Google Analytics to collect information about the use of our website. Google Analytics collects information from users such as age, gender,
                    interests, demographics, how often they visit our website, what pages they visit, and what other websites they have used before coming to our website.
                </p>
                <p class="text font-18-lh-38-regular">
                    We use the information we get from Google Analytics to analyze traffic, remarket our products and services to users, improve our marketing, advertising, and to
                    improve our website. We have enabled Google Analytics advertising features such as remarketing with Google Analytics, Google Display Network Impression
                    Reporting, and Google Analytics Demographics and Interest Reporting. Google Analytics collects only the IP address assigned to you on the date you visit our
                    website, not your name or other identifying information.
                </p>
                <p class="text font-18-lh-38-regular">
                    We do not combine the information collected using Google Analytics with Personal Data. Although Google Analytics plants a permanent cookie on your web browser
                    to identify you as a unique user the next time you visit our website, the cookie cannot be used by anyone but Google. Google also uses specific identifiers to
                    help collect information about the use of our website. For more information on how Google collects and processes your data, visit <a target="_blank"
                       class="white-no-underline text-orange-hover"
                       href="https://www.google.com/policies/privacy/partners">https://www.google.com&#8203;/policies&#8203;/privacy&#8203;/partners</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    You can prevent Google Analytics from using your information by opting out at this link: <a target="_blank" class="white-no-underline text-orange-hover"
                       href="https://tools.google.com/dlpage/gaoptout">https://tools.google.com&#8203;/dlpage&#8203;/gaoptout</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    HOTJAR DISCLOSURE
                    <br>
                    We use <a target="_blank" class="white-no-underline text-orange-hover" href="{{url('https://www.gravatar.com')}}">Hotjar.com</a> to better understand our users’
                    needs and to optimize this service and experience. Hotjar is a technology service that helps us better understand our users experience like how much time they
                    spend on which pages, which links they choose to click, what users do and don’t like, etc.) and this enables us to build and maintain our service with user
                    feedback.
                </p>
                <p class="text font-18-lh-38-regular">
                    Hotjar uses cookies and other technologies to collect data on our users’ behavior and their devices (in particular device’s IP address (captured and stored only
                    in anonymized form), device screen size, device type (unique device identifiers), browser information, geographic location (country only), preferred language
                    used to display our website). Hotjar stores this information in a pseudonymized user profile.

                </p>
                <p class="text font-18-lh-38-regular">
                    Neither Hotjar nor we use this information to identify individual users or to match it with further data on an individual user. For further details, please see
                    Hotjar’s privacy policy by clicking on this link. You can opt-out to the creation of a user profile, Hotjar’s storing of data about your usage of our website
                    and Hotjar’s use of tracking cookies on other websites by following this opt-out link.
                </p>
                <p class="text font-18-lh-38-regular">
                    GRAVATAR DISCLOSURE
                    <br>
                    We use a service from www.en.gravatar.com that allows you to have an image that represents you when you are online. It is a picture that appears next to your
                    name when you interact with different websites that are Gravatar-enabled. To make this happen, a tracking mechanism is used that may follow you from website to
                    website.
                </p>
                <p class="text font-18-lh-38-regular">
                    WE USE YOUR INFORMATION TO:
                    Provide our products and services you have requested or purchased from us
                    Personalize and customize our content
                    Make improvements to our website
                    Contact you with updates to our website
                    Resolve problems and disputes
                    Contact you with marketing and advertising that we believe may be of interest to you
                    COMMUNICATIONS AND EMAILS
                    When we communicate with you about our website, we will use the email address you provided when you registered as a member or user. We may also send you emails
                    with promotional information about our website or offers from us or our affiliates unless you have opted out of receiving such information. You can change your
                    contact preferences at any time through your account or by sending us an email with your request to: <a target="_blank"
                       class="white-no-underline text-orange-hover" href="mailto:privacy@smashingmagazine.com">privacy@smashingmagazine.com</a>
                </p>
                <p class="text font-18-lh-38-regular">
                    SHARING INFORMATION WITH AFFILIATES AND OTHER THIRD PARTIES
                    We would never sell or rent your Personal Data to third parties for marketing purposes. However, for data aggregation purposes we may use your NPD, which might
                    be sold to other parties at our discretion. Any such data aggregation would not contain any of your Personal Data.
                </p>
                <p class="text font-18-lh-38-regular">
                    We provide your Personal Data to third-party service providers we hire to provide services to us. These third-party service providers may include but are not
                    limited to: payment processors (e.g. PayPal or Stripe), web analytics companies, advertising networks, call centers, data management services, conference
                    service providers (e.g. Tito), help desk providers, accountants, law firms, auditors, shopping cart and email service providers (Mailchimp or Mandrill), and
                    shipping companies (such as Deutsche Post, USPS, DHL etc.).
                </p>
                <p class="text font-18-lh-38-regular">
                    LEGALLY REQUIRED RELEASES OF INFORMATION
                    <br>
                    We may be legally required to disclose your Personal Data if such disclosure is
                </p>
                <p class="text font-18-lh-38-regular">
                    required by subpoena, law, or other legal process;
                    <br>
                    necessary to assist law enforcement officials or government enforcement agencies;
                    <br>
                    necessary to investigate violations of or otherwise enforce our Legal Terms;
                    <br>
                    necessary to protect us from legal action or claims from third parties, including you and/or other users or members;
                    <br>
                    necessary to protect the legal rights, personal/real property, or personal safety of our company, users, employees, and affiliates.
                    <br>
                    DISCLOSURES TO SUCCESSORS
                    <br>
                    If our business is sold or merges in whole or in part with another business that would become responsible for providing the website to you, we retain the right
                    to transfer your Personal Data to the new business. The new business would retain the right to use your Personal Data according to the terms of this privacy
                    notice as well as to any changes to this privacy notice as instituted by the new business.
                </p>
                <p class="text font-18-lh-38-regular">
                    We also retain the right to transfer your Personal Data if our company files for bankruptcy and some or all of our assets are sold to another individual or
                    business.
                </p>
                <p class="text font-18-lh-38-regular">
                    COMMUNITY DISCUSSION BOARDS
                    <br>
                    Our website may offer the ability for users to communicate with each other through online community discussion boards or other mechanisms. We do not filter or
                    monitor what is posted on such discussion boards. If you choose to post on these discussion boards, you should use care when exposing any Personal Data, as such
                    information is not protected by our privacy notice nor are we liable if you choose to disclose your Personal Data through such postings. Also, Personal Data you
                    post on our website for publication may be available worldwide by means of the Internet. We cannot prevent the use or misuse of such information by others.
                </p>
                <p class="text font-18-lh-38-regular">
                    Retaining And Destroying Your Personal Data
                    <br>
                    We retain information that we collect from you (including your Personal Data) only for as long as we need it for legal, business, or tax purposes. Your
                    information may be retained in electronic form, paper form, or a combination of both. When your information is no longer needed, we will destroy, delete, or
                    erase it.
                </p>
                <p class="text font-18-lh-38-regular">
                    UPDATING YOUR PERSONAL DATA
                    <br>
                    You can update your Personal Data using services found on our website. If no such services exist, you can contact us using the contact information found at the
                    top of this notice and we will help you. However, we may keep your Personal Data as needed to enforce our agreements and to comply with any legal obligations.
                </p>
                <p class="text font-18-lh-38-regular">
                    REVOKING YOUR CONSENT FOR USING YOUR PERSONAL DATA
                    <br>
                    You have the right to revoke your consent for us to use your Personal Data at any time. Such an optout will not affect disclosures otherwise permitted by law
                    including but not limited to:
                </p>
                <p class="text font-18-lh-38-regular">
                    disclosures to affiliates and business partners,
                    <br>
                    disclosures to third-party service providers that provide certain services for our business, such as credit card processing, computer system services, shipping,
                    data management services,
                    <br>
                    disclosures to third parties as necessary to fulfill your requests,
                    <br>
                    disclosures to governmental agencies or law enforcement departments, or as otherwise required to be made under applicable law,
                    <br>
                    previously completed disclosures to third parties,
                    <br>
                    disclosures to third parties in connection with subsequent contests or promotions you may choose to enter, or third-party offers you may choose to accept. If
                    you want to revoke your consent for us to use your Personal Data, send us an email with your request to: <a target="_blank"
                       class="white-no-underline text-orange-hover" href="mailto:privacy@smashingmagazine.com">privacy@smashingmagazine.com</a>
                    <br>
                    PROTECTING THE PRIVACY RIGHTS OF THIRD PARTIES
                    <br>
                    If any postings you make on our website contain information about third parties, you must make sure you have permission to include that information in your
                    posting. While we are not legally liable for the actions of our users, we will remove any postings about which we are notified, if such postings violate the
                    privacy rights of others.
                </p>
                <p class="text font-18-lh-38-regular">
                    DO NOT TRACK SETTINGS
                    <br>
                    Some web browsers have settings that enable you to request that our website not track your movement within our website. Our website does not obey such settings
                    when transmitted to and detected by our website. You can turn off tracking features and other security settings in your browser by referring to your browser’s
                    user manual.
                </p>
                <p class="text font-18-lh-38-regular">
                    LINKS TO OTHER WEBSITES
                    <br>
                    Our website may contain links to other websites. These websites are not under our control and are not subject to our privacy notice. These websites will likely
                    have their own privacy notices. We have no responsibility for these websites and we provide links to these websites solely for your convenience. You acknowledge
                    that your use of and access to these websites are solely at your risk. It is your responsibility to check the privacy notices of these websites to see how they
                    treat your Personal Data.
                </p>
                <p class="text font-18-lh-38-regular">
                    PROTECTING CHILDREN’S PRIVACY
                    <br>
                    Even though our website is not designed for use by anyone under the age of 16, we realize that a child under the age of 16 may attempt to access our website. We
                    do not knowingly collect Personal Data from children under the age of 16. If you are a parent or guardian and believe that your child is using our website,
                    please contact us. Before we remove any information, we may ask for proof of identification to prevent malicious removal of account information. If we discover
                    that a child is accessing our website, we will delete his/her information within a reasonable period of time. You acknowledge that we do not verify the age of
                    our users nor do we have any liability to do so.
                </p>
                <p class="text font-18-lh-38-regular">
                    OUR EMAIL POLICY
                    <br>
                    You can always opt out of receiving further email correspondence from us or our affiliates. We will not sell, rent, or trade your email address to any
                    unaffiliated third party without your permission except in the sale or transfer of our business, or if our company files for bankruptcy.
                </p>
                <p class="text font-18-lh-38-regular">
                    OUR SECURITY POLICY
                    <br>
                    We have built our website using industry-standard security measures and authentication tools to protect the security of your Personal Data. We and the third
                    parties who provide services for us, also maintain technical and physical safeguards to protect your Personal Data. When we collect your credit card information
                    through our website, we will encrypt it before it travels over the Internet using industry-standard technology for conducting secure online transactions.
                    Unfortunately, we cannot guarantee against the loss or misuse of your Personal Data or secure data transmission over the Internet because of its nature.
                </p>
                <p class="text font-18-lh-38-regular">
                    We strongly urge you to protect any password you may have for our website and to not share it with anyone. You should always log out of our website when you
                    finish using it, especially if you are sharing or using a computer in a public place.
                </p>
                <p class="text font-18-lh-38-regular">
                    USE OF YOUR CREDIT CARD
                    <br>
                    You may have to provide a credit card to buy products and services from our website. We use third-party billing services and have no control over these
                    services. We use our commercially reasonable efforts to make sure your credit card number is kept strictly confidential by using only third-party billing
                    services that use industry-standard encryption technology to protect your credit card number from unauthorized use. However, you understand and agree that we
                    are in no way responsible for any misuse of your credit card number.
                </p>
                <p class="text font-18-lh-38-regular">
                    TRANSFERRING PERSONAL DATA FROM THE EUROPEAN UNION
                    <br>
                    Personal Data (PD) that we collect from you may be stored, processed, and transferred between any of the countries in which we operate, more specifically
                    Germany. The European Union has not found the United States and some other countries to have an adequate level of protection of Personal Data under Article 45
                    of the GDPR. Our company relies on derogations for specific situations as defined in Article 49 of the GDPR. For European Union customers and users, with your
                    consent, your Personal Data may be transferred outside the European Union to the United States and other countries. We will use your Personal Data to provide
                    the goods, services, and/or information you request from us to perform a contract with you or to satisfy a legitimate interest of our company in a manner that
                    does not outweigh your freedoms and rights. Wherever we transfer, process or store your Personal Data, we will take reasonable steps to protect it. We will use
                    the information we collect from you in accordance with our privacy notice. By using our website, services, or products, you agree to the transfers of your
                    Personal Data described within this section.
                </p>
                <p class="text font-18-lh-38-regular">
                    CHANGES TO OUR PRIVACY NOTICE
                    <br>
                    We reserve the right to change this privacy notice at any time. If our company decides to change this privacy notice, we will post those changes on our website
                    so that our users and customers are always aware of what information we collect, use, and disclose. If at any time we decide to disclose or use your Personal
                    Data in a method different from that specified at the time it was collected, we will provide advance notice by email (sent to the email address on file in your
                    account). Otherwise we will use and disclose our users’ and customers’ Personal Data in agreement with the privacy notice in effect when the information was
                    collected. In all cases, your continued use of our website, services, and products after any change to this privacy notice will constitute your acceptance of
                    such change.
                </p>
                <p class="text font-18-lh-38-regular">
                    QUESTIONS ABOUT OUR PRIVACY NOTICE
                    <br>
                    If you have any questions about our privacy notice, please contact us using the information at the top of this privacy notice.
                </p>
                <p class="text font-18-lh-38-regular">
                    Copyright © Orion Systems. This document or any portion of it may not be copied or duplicated without a license from <a target="_blank"
                       class="white-no-underline text-orange-hover" href="https://www.DisclaimerTemplate.com">https://www.DisclaimerTemplate.com</a>
                </p>

            </div>
        </div>
    </body>
    @include('frontend.components.cookie')
    @include('frontend.components.loader')
    @include('frontend.components.topup')