<html lang="en">
    <head>
        <title>تحليلات الحملة</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
        <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>
        <link rel="stylesheet" href="{!!asset('assets/css/intlTelInput.css')!!}"/>
        <script src="{!!asset('assets/js/input-phone/intlTelInput.js')!!}"></script>
        <script type="text/javascript" src="{!!asset('assets/js/custom.js')!!}"></script>


        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script>
            let input
            setTimeout(() => {
                input = document.querySelector(".subscribe .subscribe__input.phone");

                window.intlTelInput(input, {
                    // any initialisation options go here
                });
            }, 50);
        </script>

        <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
    {{--        <style type="text/css">--}}

    {{--            #mc_embed_signup #mce-EMAIL {--}}
    {{--                width: 440px;--}}
    {{--                height: 80px;--}}
    {{--                padding: 3px 35px 0 35px;--}}
    {{--                text-align: right;--}}
    {{--                border: 1px solid #FF9A41;--}}
    {{--                border-radius: 10px;--}}
    {{--                font-family: NotoSansArabic-Regular;--}}
    {{--                font-size: 24px;--}}
    {{--                line-height: 51px;--}}

    {{--            }--}}

    {{--            #mc_embed_signup #mce-EMAIL::placeholder {--}}
    {{--                color: #7E92AC;--}}
    {{--            }--}}

    {{--            #mc_embed_signup #mc-embedded-subscribe {--}}
    {{--                width: 208px;--}}
    {{--                height: 80px;--}}
    {{--                margin-right: 24px;--}}
    {{--                background-color: #FF9A41;--}}
    {{--                border-radius: 10px;--}}
    {{--                border: none;--}}
    {{--                color: #FFFFFF;--}}
    {{--                font-family: NotoSansArabic-Regular;--}}
    {{--                font-size: 24px;--}}
    {{--                line-height: 51px;--}}
    {{--                -webkit-appearance: none;--}}
    {{--            }--}}

    {{--            @media (max-width: 786px) {--}}
    {{--                #mc_embed_signup #mc-embedded-subscribe {--}}
    {{--                    width: 80%;--}}
    {{--                    min-width: 290px;--}}
    {{--                    margin-bottom: 20px;--}}
    {{--                    order: 2;--}}
    {{--                    margin-right: 0;--}}
    {{--                }--}}

    {{--                #mc_embed_signup #mce-EMAIL {--}}
    {{--                    order: 1;--}}
    {{--                    width: 80%;--}}
    {{--                    min-width: 290px;--}}
    {{--                    margin-bottom: 40px;--}}
    {{--                }--}}
    {{--            }--}}


    {{--            /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.--}}
    {{--               We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */--}}
    {{--        </style>--}}
    <!-- Global site tag (gtag.js) - Google Analytics -->

        <!-- Facebook Pixel Code -->

        <script>


            !function(f,b,e,v,n,t,s)



            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?



                n.callMethod.apply(n,arguments):n.queue.push(arguments)};



                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';



                n.queue=[];t=b.createElement(e);t.async=!0;



                t.src=v;s=b.getElementsByTagName(e)[0];



                s.parentNode.insertBefore(t,s)}(window,document,'script',



                'https://connect.facebook.net/en_US/fbevents.js');



            fbq('init', '1016953342554023');



            fbq('track', 'PageView');


        </script>

        <noscript>

            <img height="1" width="1"

                 src="https://www.facebook.com/tr?id=1016953342554023&ev=PageView

&noscript=1"/>

        </noscript>

        <!-- End Facebook Pixel Code -->

        <!-- Global site tag (gtag.js) - Google Ads: 10833262464 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10833262464"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'AW-10833262464');
        </script>

        <script>
            window.intercomSettings = {
                app_id: "wnracdlh"
            };
        </script>

        <script>
            // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/wnracdlh'
            (function () {
                var w = window;
                var ic = w.Intercom;
                if (typeof ic === "function") {
                    ic('reattach_activator');
                    ic('update', w.intercomSettings);
                } else {
                    var d = document;
                    var i = function () {
                        i.c(arguments);
                    };
                    i.q = [];
                    i.c = function (args) {
                        i.q.push(args);
                    };
                    w.Intercom = i;
                    var l = function () {
                        var s = d.createElement('script');
                        s.type = 'text/javascript';
                        s.async = true;
                        s.src = 'https://widget.intercom.io/widget/wnracdlh';
                        var x = d.getElementsByTagName('script')[0];
                        x.parentNode.insertBefore(s, x);
                    };
                    if (document.readyState === 'complete') {
                        l();
                    } else if (w.attachEvent) {
                        w.attachEvent('onload', l);
                    } else {
                        w.addEventListener('load', l, false);
                    }
                }
            })();
        </script>
    </head>
    <body class="home-page" dir="rtl">
        <header class="header" dir="ltr">
            <div class="circle-wrapper-blue-dark"></div>
            <div class="circle-wrapper-orange first">
                <div class="ball first"></div>
            </div>
            <div class="circle-wrapper-orange second">
                <div class="ball second"></div>
            </div>
            <div class="circle-wrapper-orange third">
                <div class="ball third"></div>
            </div>
            <div class="container">
                <div class="header-menu">
                    <a href="{{url("/analytics-campaign")}}" class="header-logo"></a>
                </div>
                <p class="header-title font-90-lh-190-semi-bold">منصة أفضل التحليلات</p>
                <p class="sub-title-text font-24-lh-51-regular">معرفة، أداء، رؤى، قرار</p>
                {{-- <div class="sign-buttons-wrapper">
                    <a href="/login" class="sign-in font-22-lh-32-medium buttons-interactions">تسجيل الدخول</a>
                    <a href="/signup" class="sign-up font-22-lh-32-medium buttons-interactions">اشتراك</a>
                </div> --}}
                <p class="header-text-title font-36-lh-76-medium">نعمل بلغتك الالعربية</p>
                <p class="header-text-info font-24-lh-51-light">و نوفر لك بيئة عمل حصرية تلبي كل احتياجاتك التسويقية</p>
                <p class="header-text-info font-24-lh-51-light">
                  نقدم لك خدمة جمع وتحليل جميع بياناتك التسويقية في كافة مواقع التواصل
                  الاجتماعي والمواقع الالكترونية.
                  نصمم ونبرمج ونحلل ونجتهد لأجلك
                </p>
                <p class="header-text-info font-24-lh-51-light">بفضل تصميم موقعنا ولوحات التحكم بطريقة سهلة، نقدم لك كل
                    ما تحتاجه في مجال التسويق وتحليل البيانات بأعلى مستوى</p>
                <div class="header-features">
                    <div class="feature-item">
                        <div class="feature-item-text font-28-lh-59-semi-bold">
                            اكتشف التحليلات
                            <br>
                            باللغة الالعربية
                        </div>
                        <div class="feature-item-first-image"></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-item-text font-28-lh-59-semi-bold">
                            تحقيق أعلى عائد
                            <br>
                            من استثماراتك
                        </div>
                        <div class="feature-item-second-image"></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-item-text  font-28-lh-59-semi-bold">تحسين أداء
                            <br> إعلاناتك
                        </div>
                        <div class="feature-item-third-image"></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-item-text font-28-lh-59-semi-bold">
                            لوحات تحكم جذابة
                            <br>
                            باللغة الالعربية
                        </div>
                        <div class="feature-item-fourth-image"></div>
                    </div>
                </div>
            </div>
        </header>
        <div class="subscribe container">
            <h3 class="subscribe-title font-36-lh-76-semi-bold">
                كن أول من يشترك في منصة أفضل التحليلات
            </h3>
            <p class="subscribe-text font-24-lh-51-regular">
              اتخذ القرار المثالي لمستقبلك وكن واحداَ من عائلة أفضل التحليلات
            </p>
            <form class="subscribe-form">
                {{--                <p class="error-message font-22-lh-32-medium">تنسيق المدخلات غير صالح ، يرجى ملء الحقول أدناه</p>--}}
                <div class="input-wrapper">
                    <input
                        class="subscribe__input name font-22-lh-32-medium"
                        type="text"
                        value=""
                        name="name"
                        placeholder="الاسم الكامل"
                        maxlength="50"
                        oninput="validateInput('name')"
                    />
                    <div class="tooltip name font-16-lh-19-regular">
                        يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
                    </div>
                </div>
                <div class="input-wrapper">
                    <input class="subscribe__input email font-22-lh-32-medium"
                           type="email"
                           value=""
                           name="email"
                           placeholder="البريد الإلكتروني"
                           maxlength="50"
                           oninput="validateInput('email')"
                    />
                    <div class="tooltip email font-16-lh-19-regular">
                        يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
                    </div>
                </div>
                <div class="input-wrapper">
                    <input class="subscribe__input phone font-22-lh-32-medium"
                           type="tel"
                           id="phone"
                           name="phone"
                           oninput="validateInput('phone')"
                    />
                    <div class="tooltip phone font-16-lh-19-regular">
                        يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
                    </div>
                </div>
                <div class="input-wrapper">
                    <input class="subscribe__input facility-name font-22-lh-32-medium"
                           type="text"
                           value=""
                           name="facitity_name"
                           placeholder="اسم المنشأة"
                           maxlength="50"
                           oninput="validateInput('facilityName')"
                    />
                    <div class="tooltip facility-name font-16-lh-19-regular">
                        يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
                    </div>
                </div>
                <div class="input-wrapper">
                    <select class="subscribe__input country font-22-lh-32-medium placeholder-color"
                            name="country"
                            oninput="validateInput('country')"
                    >
                        <option value="" disabled selected>البلد</option>
                        <option value="Algeria">(Algeria) الجزائر</option>
                        <option value="American Samoa">(American Samoa) ساموا-الأمريكي</option>
                        <option value="Austria">(Austria) النمسا</option>
                        <option value="Bahrain">(Bahrain) البحرين</option>
                        <option value="Belgium">(Belgium) بلجيكا</option>
                        <option value="Bulgaria">(Bulgaria) بلغاريا</option>
                        <option value="Canada">(Canada) كندا</option>
                        <option value="Croatia">(Croatia) كرواتيا</option>
                        <option value="Cyprus">(Cyprus) قبرص</option>
                        <option value="Czech Republic">(Czech Republic) التشيك</option>
                        <option value="Denmark">(Denmark) الدنمارك</option>
                        <option value="Egypt">(Egypt) مصر </option>
                        <option value="Estonia">(Estonia) إستونيا</option>
                        <option value="Finland">(Finland) فنلندا</option>
                        <option value="France">(France) فرنسا</option>
                        <option value="Germany">(Germany) ألمانيا</option>
                        <option value="Greece">(Greece) اليونان</option>
                        <option value="Hungary">(Hungary) المجر</option>
                        <option value="Iraq">(Iraq) العراق</option>
                        <option value="Italy">(Italy) إيطاليا</option>
                        <option value="Jordan">(Jordan) الأردن</option>
                        <option value="Kuwait">(Kuwait) الكويت</option>
                        <option value="Latvia">(Latvia) لاتفيا</option>
                        <option value="Lebanon">(Lebanon) لبنان</option>
                        <option value="Libya">(Libya) ليبيا</option>
                        <option value="Lithuania">(Lithuania) ليتوانيا</option>
                        <option value="Luxembourg">(Luxembourg) لوكسمبورغ</option>
                        <option value="Malta">(Malta) مالطا</option>
                        <option value="Mauritania">(Mauritania) موريتانيا</option>
                        <option value="Morocco">(Morocco) المغرب</option>
                        <option value="Netherlands">(Netherlands) هولندا</option>
                        <option value="Oman">(Oman) عُمان</option>
                        <option value="Palestine">(Palestine) دولة فلسطين</option>
                        <option value="Poland">(Poland) بولندا</option>
                        <option value="Portugal">(Portugal) البرتغال</option>
                        <option value="Qatar">(Qatar) قطر</option>
                        <option value="Romania">(Romania) رومانيا</option>
                        <option value="Saudi Arabia">(Saudi Arabia) السعودية</option>
                        <option value="Slovakia">(Slovakia) سلوفاكيا</option>
                        <option value="Somalia">(Somalia) الصومال</option>
                        <option value="South Africa">(South Africa) جنوب أفريقيا</option>
                        <option value="Spain">(Spain) إسبانيا</option>
                        <option value="Sweden">(Sweden) السويد</option>
                        <option value="Syria">(Syria) سوريا</option>
                        <option value="Tunisia">(Tunisia) تونس</option>
                        <option value="Turkey">(Turkey) تركيا</option>
                        <option value="United Arab Erimates">(United Arab Emirates) الإمارات الالعربية المتحدة</option>
                        <option value="United States of America">(United States) الولايات المتحدة</option>
                        <option value="Yemen">(Yemen) اليمن</option>
                    </select>
                    <div class="tooltip country font-16-lh-19-regular">
                        يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
                    </div>
                </div>
                {{--                <input class="subscribe__input country font-22-lh-32-medium"--}}
                {{--                       type="text" value=""--}}
                {{--                       placeholder="البلد"--}}
                {{--                       oninput="validateInput('country')"--}}
                {{--                />--}}
                <textarea class="subscribe__input textarea font-22-lh-32-medium"
                          placeholder="رسالة إلى فريق أفضل التحليلات"
                          rows="5"
                          maxlength="256"
                          oninput="validateInput('message')"
                ></textarea>
                <p class="subscribe__form-text font-16-lh-25-semi-bold">
                    أفضل التحليلات يحتاج إلى معلومات الاتصال الذي تقدمها لنا للاتصال بك بشأن منتجاتنا وخدماتنا. يمكنك
                    إلغاء الاشتراك من هذه الاتصالات في أي وقت. للحصول على معلومات حول كيفية إلغاء الاشتراك، بالإضافة إلى
                    ممارسات الخصوصية لدينا والتزامنا بحماية خصوصيتك، يرجى مراجعة سياسة الخصوصية الخاصة بنا.
                </p>
                <div class="text-center capcha-wrapper">
                    <div class="g-recaptcha"
                         style="display:inline-block; margin-top:40px"
                         data-callback="capchaResponse"
                         data-sitekey="6Lc-aA0eAAAAAOdimM9103VEQEl51mHFUXEuJ9BZ"
                    >
                    </div>
                </div>
                <button class="subscribe__submit btn font-28-lh-42-semi-bold disabled buttons-interactions"
                        type="submit"
                        disabled
                >
                    تواصل معنا
                </button>
                <p class="font-16-lh-25-semi-bold subscribe__submit-text">
                  بالضغط على "تواصل معنا" ، فإنك توافق على شروط الاستخدام و
                  <a class="subscribe__privacy-policy-link" href="privacy-policy">سياسة الخصوصية</a>
              </p>
                {{-- <div class="textarea-icon-wrapper">
                    <img class="textarea-icon" src="{!!asset('assets/image_new/svg/textarea.svg')!!}">
                </div> --}}
{{--                <div class="modal-window">--}}
{{--                    <div class="modal-body ">--}}
{{--                        <div class="close-icon"></div>--}}
{{--                        <p class="text font-45-lh-54-bold">!شكراً. تم ارسال رسالتك بنجاح</p>--}}
{{--                        <div class="success-icon"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </form>
            {{--            <div id="mc_embed_signup"--}}
            {{--            >--}}
            {{--                <div id="mc_embed_signup">--}}
            {{--                    <form--}}
            {{--                        action="https://shnueljoe.us5.list-manage.com/subscribe/post?u=cb379353ea7ed09988fdc4127&amp;id=c2719b990f"--}}
            {{--                        method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"--}}
            {{--                        target="_blank" novalidate>--}}
            {{--                        <div id="mc_embed_signup_scroll">--}}
            {{--                            <div class="clear">--}}
            {{--                                <input type="submit"--}}
            {{--                                       value="إنضم الآن"--}}
            {{--                                       name="subscribe"--}}
            {{--                                       id="mc-embedded-subscribe"--}}
            {{--                                       class="button">--}}
            {{--                            </div>--}}
            {{--                            <input type="email"--}}
            {{--                                   value=""--}}
            {{--                                   name="EMAIL"--}}
            {{--                                   class="email"--}}
            {{--                                   id="mce-EMAIL"--}}
            {{--                                   placeholder="البريد الإلكتروني"--}}
            {{--                                   required--}}
            {{--                            >--}}
            {{--                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->--}}
            {{--                            <div--}}
            {{--                                style="position: absolute;--}}
            {{--                                left: -5000px;"--}}
            {{--                                aria-hidden="true"--}}
            {{--                            >--}}
            {{--                                <input type="text"--}}
            {{--                                       name="b_cb379353ea7ed09988fdc4127_c2719b990f"--}}
            {{--                                       tabindex="-1"--}}
            {{--                                       value="">--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </form>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        {{--        <footer class="footer">--}}
        {{--            <div class="container">--}}
        {{--                <ul class="footer-list">--}}
        {{--                    <li class="footer-list__item title font-25-semi-bold">عن الشركة</li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            معلومات عنا--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            الأسعار--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            إتصل بنا--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                </ul>--}}
        {{--                <ul class="footer-list">--}}
        {{--                    <li class="footer-list__item title font-25-semi-bold">الحلول</li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            نظرة عامة--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            الارتباطات--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            لوحات التحكم--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                </ul>--}}
        {{--                <ul class="footer-list">--}}
        {{--                    <li class="footer-list__item title font-25-semi-bold">المراجع</li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            المدونة--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            دليل استخدام--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            موسوعات--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                </ul>--}}
        {{--                <ul class="footer-list">--}}
        {{--                    <li class="footer-list__item title font-25-semi-bold">الحساب</li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            إشتراك--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        <a href="#" class="footer-list__item-link">--}}
        {{--                            تسجيل الدخول--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                </ul>--}}
        {{--                <ul class="footer-list-last">--}}
        {{--                    <li class="footer-list__item font-36-lh-76-semi-bold">أفضل التحليلات</li>--}}
        {{--                    <li class="footer-list__item text font-20-lh-45-regular">--}}
        {{--                        تمكين المسوقين الرقميين بتقارير--}}
        {{--                        <br>--}}
        {{--                        تساعدهم على تطوير استراتيجيات فعالة--}}
        {{--                    </li>--}}
        {{--                    <li class="footer-list__item icon-wrapper">--}}
        {{--                        <a class="icon-link-wrapper" href="#">--}}
        {{--                            <div class="icon icon__linkedin"></div>--}}
        {{--                        </a>--}}
        {{--                        <a class="icon-link-wrapper" href="#">--}}
        {{--                            <div class="icon icon__facebook"></div>--}}
        {{--                        </a>--}}
        {{--                        <a class="icon-link-wrapper" href="#">--}}
        {{--                            <div class="icon icon__instagram"></div>--}}
        {{--                        </a>--}}
        {{--                        <a class="icon-link-wrapper" href="#">--}}
        {{--                            <div class="icon icon__twitter"></div>--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--        </footer>--}}
        {{--        <div class="last-block">--}}
        {{--            <div class="container">--}}
        {{--                <ul class="last-block__list font-13-lh-30-semi-bold">--}}
        {{--                    <li class="last-block__list-item">أمن البيانات</li>--}}
        {{--                    <li class="last-block__list-item">Tإشعارات قانونية</li>--}}
        {{--                    <li class="last-block__list-item">إشعارات قانونية</li>--}}
        {{--                </ul>--}}
        {{--                <p class="copyright-text font-13-lh-30-semi-bold">© 2022سياسة الخصوصية</p>--}}
        {{--            </div>--}}

        {{--        </div>--}}
        <div class="footer">
            <div class="circle-wrapper">
                <div class="footer__circles-wrapper first">
                    <div class="footer__ball first"></div>
                    <div class="footer__circles-wrapper second">
                        <div class="footer__ball second"></div>
                        <div class="footer__circles-wrapper third">
                            <div class="footer__circles-wrapper orange">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__content-wrapper">
                <div class="footer__main-content">
                    <p class="footer__main-content-title font-35-lh-74-semi-bold">
                        أفضل التحليلات
                    </p>
                    <p class="footer__main-content-sub-title font-18-lh-28-regular">
                      أفضل التحليلات هي منصة لتحليل البيانات التسويقية باللغة الالعربية؛ تهدف لتطوير مجال التسويق الالكتروني بالعالم العربي ومنح الفرصة لأبنائه لتطوير ونمو أعمالهم
                      .مهمتنا هي توفير مساحة شاملة ومتكاملة لتحليل وقياس كافة البيانات التسويقية مختلفة المصادر، في مكان واحد حيث الوضوح والدقة والاتقان
                    </p>
                    <p class="footer__main-content-contacts font-18-lh-28-regular">
                      تحتاج للمساعدة أكثر؟
                      <br/>
                      تواصل معنا عبر البريد الإلكتروني
                    </p>
                    <a class="footer__main-content-email font-15-lh20-light white-no-underline text-orange-hover" href="mailto:info@afdalanalytics.com">info@afdalanalytics.com</a>
                    <p class="footer__main-content-address font-15-lh20-light">1201 Peachtree Street NE, Floor 1, 2, and
                        3, Atlanta, Georgia, 30361, USA</p>
                </div>
            </div>
            <div class="footer__final-info">
                <div class="footer__final-info-social-block">
                    <a class="icon linkedin" target="_blanc" href="https://www.linkedin.com/company/afdalanalytics"></a>
                    <a class="icon facebook" target="_blanc" href="https://www.facebook.com/Afdal.Analytics"></a>
                    <a class="icon instagram" target="_blanc" href="https://twitter.com/afdalanalytics"></a>
                    <a class="icon twitter" target="_blanc" href="https://www.instagram.com/afdalanalytics"></a>
                </div>
                <a href="/privacy-policy" class="footer__final-info-data-security font-13-lh-20-medium text-orange-hover">
                  {{__('Privacy Policy')}}
                </a>
                <p class="footer__final-info-right-reserved font-13-lh-20-medium">
                    <span>{{__('©2022 Afdal Analytics Inc. All Rights Reserved.')}}</span>
                </p>
            </div>
        </div>
        <div class="cookies-block">
            <div class="icon"></div>
            <div class="main-block">
                <p class="title font-35-lh-42-bold">
                    {{__('We use cookies')}}
                </p>
                <p class="text font-20-lh-23-regular">
                    {{__('To make your browsing experience with Afdal Analytics better.')}}
                </p>
                <button class="accept-btn font-20-lh-23-regular"
                onclick="acceptCookie()"
                >
                    {{__('ACCEPT')}}
                </button>
                <a href="/cookie-policy" class="cookie-policy font-18-lh-22-light">
                    {{__('Cookie Policy')}}
                </a>
            </div>
        </div>
@include('frontend.components.loader')

    </body>

    <script>
        if(localStorage.getItem('acceptCookie') !== null) {
            $('.cookies-block')[0].setAttribute('style','display:none')
        }

        function acceptCookie(){
            localStorage.setItem('acceptCookie','true')
            $('.cookies-block')[0].setAttribute('style','display:none')
        }
    </script>
