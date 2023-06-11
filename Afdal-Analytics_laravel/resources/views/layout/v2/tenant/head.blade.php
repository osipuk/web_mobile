<!DOCTYPE html>
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
<html lang="{{ $get_locale == 'ar' ? 'ar':'en' }}" dir="{{ $get_locale == 'ar' ? 'rtl':'ltr' }}">

<head prefix="og: http://ogp.me/ns#">
    <meta charset="utf-8">
    <title>{{!empty($seo->title) ? $seo->title : ''}}</title>
    <meta name="description" content="{{!empty($seo->description) ? $seo->description : ''}}">
    <meta name="keywords" content="{{!empty($seo->keywords) ? $seo->keywords : ''}}">
    <meta name="author" content="{{!empty($seo->author) ? $seo->author : ''}}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{url('/assets/image_new/favicon.png')}}">

    <script> (function(ss,ex){ window.ldfdr=window.ldfdr||function(){(ldfdr._q=ldfdr._q||[]).push([].slice.call(arguments));}; (function(d,s){ fs=d.getElementsByTagName(s)[0]; function ce(src){ var cs=d.createElement(s); cs.src=src; cs.async=1; fs.parentNode.insertBefore(cs,fs); }; ce('https://sc.lfeeder.com/lftracker_v1_'+ss+(ex?'_'+ex:'')+'.js'); })(document,'script'); })('lAxoEaK9EdD7OYGd'); </script>

    
    @if (!Request::is('blog/*', 'guides/*'))
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://afdalanalytics.com/">
    <meta name="twitter:title" content="تحليل بيانات الحملات التسويقية | وسائل التواصل | منصة أفضل">
    <meta name="twitter:description" content="منصة أفضل التحليلات هي وسيلتك للتعرف على كل ماتبحث عنه لقياس مؤشرات أداء وبيانات مشروعك على شبكة الإنترنت وشبكات التواصل الاجتماعي بطريقة سهلة وواضحة">
    <meta name="twitter:image" content="{{asset('/assets/image/link.png')}}">
    @endif

    @yield('metahead')
    <link rel="preload" href="{{ asset('css/v2/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('css/v2/app.css') }}"></noscript>
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <!-- Google Tag Manager 2nd -->
    <script>
        (function(w,d,s,l,i){
            w[l]=w[l]||[];
            w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'
            });
            var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),
            dl=l!='dataLayer'?'&l='+l:'';
            j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
            f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MBJFWGX');
    </script>
    <!-- End Google Tag Manager -->
   
    <!---<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>-->
    <script src="https://script.tapfiliate.com/tapfiliate.js" type="text/javascript" async></script>
    <script type="text/javascript">
        (function(t, a, p) {
            t.TapfiliateObject = a;
            t[a] = t[a] || function() {
                (t[a].q = t[a].q || []).push(arguments)
            }
        })(window, 'tap');
        tap('create', '32473-e3a646', {
            integration: "javascript"
        });
        tap('detect');
    </script>
    @if(isset(request()->st_id) && isset(request()->amt) & isset(request()->cus))
        @if(DB::table('tapfiliate_conversions')->where([['user_id', Auth::id()], ['subscription_status', 1]])->count() == 0)
            <?php

            DB::table('tapfiliate_conversions')->insert([
                'user_id' => Auth::id(),
                'subscription_id' => request()->st_id,
                'amount' => request()->amt,
                'customer_id' => request()->cus
            ]);

            ?>
            <script type="text/javascript">
                (function(t, a, p) {
                    t.TapfiliateObject = a;
                    t[a] = t[a] || function() {
                        (t[a].q = t[a].q || []).push(arguments)
                    }
                })(window, 'tap');
                tap('conversion', '{{request()->st_id}}', '{{request()->amt}}', {
                    customer_id: '{{request()->cus}}'
                });
            </script>

            <?php
                $given_subscription_id = request()->st_id;
                $get_tapfilliate_id_of_subscription = NULL;

                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://api.tapfiliate.com/1.6/conversions/",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "X-API-Key:0b78bd667348f09f1544fb2204ed476bdb278d8c",
                        "content-type: application/json"
                    ],
                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    //echo "cURL Error #:" . $err;
                } else {
                    $data = (json_decode($response));

                    foreach ($data as $d) {
                        if ($d->external_id == $given_subscription_id) {
                            $get_tapfilliate_id_of_subscription = $d;

                            DB::table('tapfiliate_conversions')->insert([
                                'user_id' => Auth::id(),
                                'subscription_id' => request()->st_id,
                                'tapfiliate_id' => $d->id,
                                'amount' => request()->amt,
                                'customer_id' => request()->cus
                            ]);
                        }
                    } //endforeach

                }
            ?>
        @endif
    @endif


    @yield('css')
        <style type="text/css">
            .addpaddingforhome{
                padding-inline-start: 270px;
            }
            .addpaddingforhome50{
                padding-inline-start: 65px;
            }
        </style>
    @if($get_locale == 'ar')
        <style type="text/css">
           
            .card-pricing-monthly-text {
                direction: rtl !important;
                text-align: right;
            }
            p, a, span, h1, h2, h3, h4, h5, h6, i, label, .form-group {
                direction: rtl;
            }
            .toast-message{
                text-align: initial !important;
            }
        </style>
    @else
        <style type="text/css">

            .card-pricing-monthly-text {
                direction: ltr !important;
                text-align: left;
            }
            .text-right {
                text-align: left!important;
                margin-left: 30px!important;
            }
            .text-left {
                text-align: right!important;
            }
            .dashboard-data-1 img {
                height: 50px;
                transform: translateY(-9px);
                margin-left: 0px!important;
            }
            .ml-25-en{
                margin-left: 25px!important;
            }
            .i-icon {
                right: 15px!important;
                left: unset!important;
            }
            .info-tooltip {
                right: 40px!important;
                left: unset!important;
            }
            p, a, span, h1, h2, h3, h4, h5, h6, i, label, .form-group {
                direction: ltr;
            }
            .homepage-title-w {
                text-align: left;
            }
            .homepage-text-w {
                text-align: left;
            }
            .text-left-en {
                text-align: left !important;
            }
            .benefits-list-item-title {
                margin-left: 65px !important;
            }
            .benefits-list-item-logo-document,
            .benefits-list-item-logo-bucket,
            .benefits-list-item-logo-device {
                top: unset;
                left: -0px;
            }
            .ml-64-en {
                margin-left: 64px;
            }
            .mt-35-en {
                margin-top: 35px !important;
            }
            .ml-15-en {
                margin-left: 15px !important;
            }
            .float-left-en {
                float: left !important;
            }
            .order-1-en {
                order: 1 !important;
            }
            .order-2-en {
                order: 2 !important;
            }
            .order-3-en {
                order: 3 !important;
            }
            .order-4-en {
                order: 4 !important;
            }
            .order-5-en {
                order: 5 !important;
            }
            .order-6-en {
                order: 6 !important;
            }
            .order-7-en {
                order: 7 !important;
            }
            .order-8-en {
                order: 8 !important;
            }
            .order-9-en {
                order: 9 !important;
            }
            .order-10-en {
                order: 10 !important;
            }
            .pr-20-en {
                padding-left: 20px;
            }
            .ml-0-mr-90-en {
                margin-left: 0px !important;
                margin-right: 90px;
            }
            .footer-menu {
                gap: 199px !important;
            }
            .icon-rotate-en {
                transform: rotate(180deg) !important;
            }
            .sidebar-wrapper .sidebar-brand .icon-rotate {
                transform: rotate(360deg) !important;
                margin: 0 5px 100px 0;
            }
        </style>
    @endif

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MBJFWGX" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->


    @yield('content')


    <script type="text/javascript" src="{{ asset('js/v2/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- date range -->
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
 
    <?php

    use App\Models\Plans;

    if (auth()->user()) {
        $subscription = auth()->user()->company->subscriptions()->first();
        $user_plan_name = 'Trial';
        $user_plan_price = 0;

        $provider = \PayPal::setProvider();
        $provider->getAccessToken();

        if ($subscription) {
            if ($subscription->stripe_status === 'active') {
                $user_plan_name = Plans::where('stripe_id', $subscription->stripe_price)->first();
                if ($user_plan_name == true) {
                    $user_plan_name = $user_plan_name->title;
                }
            } elseif ($subscription->paypal_status === 'active') {
                $user_plan_name = Plans::where('stripe_id', $subscription->paypal_plan)->first();
                if ($user_plan_name == true) {
                    $user_plan_name = $user_plan_name->title;
                }

                if (($provider->showPlanDetails($subscription->paypal_plan) != NULL) && ($provider->showPlanDetails($subscription->paypal_plan)['billing_cycles']) != NULL) {
                    $user_plan_price = round($provider->showPlanDetails($subscription->paypal_plan)['billing_cycles'][0]['pricing_scheme']['fixed_price']['value']);
                } else {
                    $user_plan_price = 0;
                }
            }
        }
    }

    ?>

    @if(auth()->user())
    <script>
        window.intercomSettings = {
            api_base: "https://api-iam.intercom.io",
            app_id: "wnracdlh",
            name: "{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}", // Full name
            email: "{{ auth()->user()->email }}", // Email address
            phone:"{{ auth()->user()->phone }}",
            created_at: "{{ strtotime(date(auth()->user()->created_at)) }}", // Signup date as a Unix timestamp
            user_id: "{{ auth()->user()->id }}",
            company: {
                company_id: "{{ auth()->user()->company->id }}",
                name: "{{ auth()->user()->company->name }}",
                created_at: "{{ strtotime(date(auth()->user()->company->created_at)) }}",
                monthly_spend: "{{ $user_plan_price }}",
                plan: "{{ $user_plan_name }}",
                website:"{{auth()->user()->website}}"
            }
        };
        
    </script>
    @else
    <script>
        window.intercomSettings = {
            app_id: "wnracdlh"
        };
    </script>
    @endif


    <script>
        // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/wnracdlh'
        (function() {
            var w = window;
            var ic = w.Intercom;
            if (typeof ic === "function") {
                ic('reattach_activator');
                ic('update', w.intercomSettings);
            } else {
                var d = document;
                var i = function() {
                    i.c(arguments);
                };
                i.q = [];
                i.c = function(args) {
                    i.q.push(args);
                };
                w.Intercom = i;
                var l = function() {
                    setTimeout(function () {
                        var s = d.createElement('script');
                        s.type = 'text/javascript';
                        s.async = true;
                        s.src = 'https://widget.intercom.io/widget/wnracdlh';
                        var x = d.getElementsByTagName('script')[0];
                        x.parentNode.insertBefore(s, x);
                    }, 5000);
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
    <!-- active compaign -->
    @if(auth()->user())
    <script type="text/javascript">
        (function(e,t,o,n,p,r,i){
            e.visitorGlobalObjectAlias=n;
            e[e.visitorGlobalObjectAlias]=e[e.visitorGlobalObjectAlias]||function(){
                (e[e.visitorGlobalObjectAlias].q=e[e.visitorGlobalObjectAlias].q||[]).push(arguments)};e[e.visitorGlobalObjectAlias].l=(new Date).getTime();r=t.createElement("script");r.src=o;r.async=true;i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)})(window,document,"https://diffuser-cdn.app-us1.com/diffuser/diffuser.js","vgo");
        vgo('setAccount', '254549829');
        vgo('setTrackByDefault', true);
        vgo('setEmail',"{{ auth()->user()->email }}");
        vgo('process');
    </script>
    @else
    <script type="text/javascript">
        (function(e,t,o,n,p,r,i){
            e.visitorGlobalObjectAlias=n;
            e[e.visitorGlobalObjectAlias]=e[e.visitorGlobalObjectAlias]||function(){
                (e[e.visitorGlobalObjectAlias].q=e[e.visitorGlobalObjectAlias].q||[]).push(arguments)};e[e.visitorGlobalObjectAlias].l=(new Date).getTime();r=t.createElement("script");r.src=o;r.async=true;i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)})(window,document,"https://diffuser-cdn.app-us1.com/diffuser/diffuser.js","vgo");
        vgo('setAccount', '254549829');
        vgo('setTrackByDefault', true);
        vgo('process');
    </script>
    @endif
 <!-- end active compaign -->

    <script>
        $('input[type="checkbox"]').on('change', function(e) {
            if (e.target.checked) {
                $('#tempModal').modal();
            }
        });
    </script>
    @if($get_locale == 'ar')
    <script>
        toastr.options = {
            "positionClass": "toast-top-center",
            "rtl": true,
        }
    </script>
    @else
    <script>
        toastr.options = {
            "positionClass": "toast-top-center",
            "rtl": false,
        }
    </script>
    @endif
    <script>
        $('#one').click(function() {
            $('.one').show();
            $('.two, .three, .four, .five, .default').hide();
        });
        $('#two').click(function() {
            $('.two').show();
            $('.one, .three, .four, .five, .default').hide();
        });
        $('#three').click(function() {
            $('.three').show();
            $('.two, .one, .four, .five, .default').hide();
        });
        $('#four').click(function() {
            $('.four').show();
            $('.two, .three, .one, .five, .default').hide();
        });
        $('#five').click(function() {
            $('.five').show();
            $('.two, .three, .four, .one, .default').hide();
        });
        $('a.mt32').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
    </script>
    <script>
        $(document).ready(function() {
            const $popups = $('.popup-youtube, .popup-vimeo')

            if ($popups.length) {
                $popups.magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                });
            }
        })

        $('.popup-youtube').click(function() {
            $('.modal, .modal-backdrop').removeClass('show');
            $('.modal, .modal-backdrop').css('display', 'none');
        });
    </script>
    <script>
        $('.dataList').click(function() {
            $(this).find('.dataMore').toggleClass('active');
        });
    </script>
    <script>
        $('#cc').on('input propertychange', function() {
            var node = $('#cc')[0]; // vanilla javascript element
            var cursor = node.selectionStart; // store cursor position
            var lastValue = $('#cc').val(); // get value before formatting

            var formattedValue = formatCardNumber(lastValue);
            $('#cc').val(formattedValue); // set value to formatted

            // keep the cursor at the end on addition of spaces
            if (cursor === lastValue.length) {
                cursor = formattedValue.length;
                // decrement cursor when backspacing
                // i.e. "4444 |" => backspace => "4444|"
                if ($('#cc').attr('data-lastvalue') && $('#cc').attr('data-lastvalue').charAt(cursor - 1) == " ") {
                    cursor--;
                }
            }

            if (lastValue !== formattedValue) {
                // increment cursor when inserting character before a space
                // i.e. "1234| 6" => "5" typed => "1234 5|6"
                if (lastValue.charAt(cursor) == " " && formattedValue.charAt(cursor - 1) == " ") {
                    cursor++;
                }
            }

            // set cursor position
            node.selectionStart = cursor;
            node.selectionEnd = cursor;
            // store last value
            $('#cc').attr('data-lastvalue', formattedValue);
        });

        function formatCardNumber(value) {
            // remove all non digit characters
            var value = value.replace(/\D/g, '');
            var formattedValue;
            var maxLength;
            // american express, 15 digits
            if ((/^3[47]\d{0,13}$/).test(value)) {
                formattedValue = value.replace(/(\d{4})/, '$1 ').replace(/(\d{4}) (\d{6})/, '$1 $2 ');
                maxLength = 17;
            } else if ((/^3(?:0[0-5]|[68]\d)\d{0,11}$/).test(value)) { // diner's club, 14 digits
                formattedValue = value.replace(/(\d{4})/, '$1 ').replace(/(\d{4}) (\d{6})/, '$1 $2 ');
                maxLength = 16;
            } else if ((/^\d{0,16}$/).test(value)) { // regular cc number, 16 digits
                formattedValue = value.replace(/(\d{4})/, '$1 ').replace(/(\d{4}) (\d{4})/, '$1 $2 ').replace(/(\d{4}) (\d{4}) (\d{4})/, '$1 $2 $3 ');
                maxLength = 19;
            }

            $('#cc').attr('maxlength', maxLength);
            return formattedValue;
        }


        var app;

        (function() {
            'use strict';

            app = {
                monthAndSlashRegex: /^\d\d \/ $/, // regex to match "MM / "
                monthRegex: /^\d\d$/, // regex to match "MM"

                el_cardNumber: '.ccFormatMonitor',
                el_expDate: '#inputExpDate',
                el_cvv: '.cvv',
                el_ccUnknown: 'cc_type_unknown',
                el_ccTypePrefix: 'cc_type_',
                el_monthSelect: '#monthSelect',
                el_yearSelect: '#yearSelect',

                cardTypes: {
                    'American Express': {
                        name: 'American Express',
                        code: 'ax',
                        security: 4,
                        pattern: /^3[47]/,
                        valid_length: [15],
                        formats: {
                            length: 15,
                            format: 'xxxx xxxxxxx xxxx'
                        }
                    },
                    'Visa': {
                        name: 'Visa',
                        code: 'vs',
                        security: 3,
                        pattern: /^4/,
                        valid_length: [16],
                        formats: {
                            length: 16,
                            format: 'xxxx xxxx xxxx xxxx'
                        }
                    },
                    'Maestro': {
                        name: 'Maestro',
                        code: 'ma',
                        security: 3,
                        pattern: /^(50(18|20|38)|5612|5893|63(04|90)|67(59|6[1-3])|0604)/,
                        valid_length: [16],
                        formats: {
                            length: 16,
                            format: 'xxxx xxxx xxxx xxxx'
                        }
                    },
                    'Mastercard': {
                        name: 'Mastercard',
                        code: 'mc',
                        security: 3,
                        pattern: /^5[1-5]/,
                        valid_length: [16],
                        formats: {
                            length: 16,
                            format: 'xxxx xxxx xxxx xxxx'
                        }
                    }
                }
            };

            app.addListeners = function() {
                $(app.el_expDate).on('keydown', function(e) {
                    app.removeSlash(e);
                });

                $(app.el_expDate).on('keyup', function(e) {
                    app.addSlash(e);
                });

                $(app.el_expDate).on('blur', function(e) {
                    app.populateDate(e);
                });

                $(app.el_cvv + ', ' + app.el_expDate).on('keypress', function(e) {
                    return e.charCode >= 48 && e.charCode <= 57;
                });
            };

            app.addSlash = function(e) {
                var isMonthEntered = app.monthRegex.exec(e.target.value);
                if (e.key >= 0 && e.key <= 9 && isMonthEntered) {
                    e.target.value = e.target.value + " / ";
                }
            };

            app.removeSlash = function(e) {
                var isMonthAndSlashEntered = app.monthAndSlashRegex.exec(e.target.value);
                if (isMonthAndSlashEntered && e.key === 'Backspace') {
                    e.target.value = e.target.value.slice(0, -3);
                }
            };

            app.populateDate = function(e) {
                var month, year;

                if (e.target.value.length == 7) {
                    month = parseInt(e.target.value.slice(0, -5));
                    year = "20" + e.target.value.slice(5);

                    if (app.checkMonth(month)) {
                        $(app.el_monthSelect).val(month);
                    } else {
                        $(app.el_monthSelect).val(0);
                    }

                    if (app.checkYear(year)) {
                        $(app.el_yearSelect).val(year);
                    } else {
                        $(app.el_yearSelect).val(0);
                    }

                }
            };

            app.checkMonth = function(month) {
                if (month <= 12) {
                    var monthSelectOptions = app.getSelectOptions($(app.el_monthSelect));
                    month = month.toString();
                    if (monthSelectOptions.includes(month)) {
                        return true;
                    }
                }
            };

            app.checkYear = function(year) {
                var yearSelectOptions = app.getSelectOptions($(app.el_yearSelect));
                if (yearSelectOptions.includes(year)) {
                    return true;
                }
            };

            app.getSelectOptions = function(select) {
                var options = select.find('option');
                var optionValues = [];
                for (var i = 0; i < options.length; i++) {
                    optionValues[i] = options[i].value;
                }
                return optionValues;
            };

            app.setMaxLength = function($elem, length) {
                if ($elem.length && app.isInteger(length)) {
                    $elem.attr('maxlength', length);
                } else if ($elem.length) {
                    $elem.attr('maxlength', '');
                }
            };

            app.isInteger = function(x) {
                return (typeof x === 'number') && (x % 1 === 0);
            };

            app.createExpDateField = function() {
                $(app.el_monthSelect + ', ' + app.el_yearSelect).hide();
                $(app.el_monthSelect).parent().prepend('<input type="text" class="ccFormatMonitor">');
            };


            app.isValidLength = function(cc_num, card_type) {
                for (var i in card_type.valid_length) {
                    if (cc_num.length <= card_type.valid_length[i]) {
                        return true;
                    }
                }
                return false;
            };

            app.getCardType = function(cc_num) {
                for (var i in app.cardTypes) {
                    var card_type = app.cardTypes[i];
                    if (cc_num.match(card_type.pattern) && app.isValidLength(cc_num, card_type)) {
                        return card_type;
                    }
                }
            };

            app.getCardFormatString = function(cc_num, card_type) {
                for (var i in card_type.formats) {
                    var format = card_type.formats[i];
                    if (cc_num.length <= format.length) {
                        return format;
                    }
                }
            };

            app.formatCardNumber = function(cc_num, card_type) {
                var numAppendedChars = 0;
                var formattedNumber = '';
                var cardFormatIndex = '';

                if (!card_type) {
                    return cc_num;
                }

                var cardFormatString = app.getCardFormatString(cc_num, card_type);
                for (var i = 0; i < cc_num.length; i++) {
                    cardFormatIndex = i + numAppendedChars;
                    if (!cardFormatString || cardFormatIndex >= cardFormatString.length) {
                        return cc_num;
                    }

                    if (cardFormatString.charAt(cardFormatIndex) !== 'x') {
                        numAppendedChars++;
                        formattedNumber += cardFormatString.charAt(cardFormatIndex) + cc_num.charAt(i);
                    } else {
                        formattedNumber += cc_num.charAt(i);
                    }
                }

                return formattedNumber;
            };

            app.monitorCcFormat = function($elem) {
                var cc_num = $elem.val().replace(/\D/g, '');
                var card_type = app.getCardType(cc_num);
                $elem.val(app.formatCardNumber(cc_num, card_type));
                app.addCardClassIdentifier($elem, card_type);
            };

            app.addCardClassIdentifier = function($elem, card_type) {
                var classIdentifier = app.el_ccUnknown;
                if (card_type) {
                    classIdentifier = app.el_ccTypePrefix + card_type.code;
                    app.setMaxLength($(app.el_cvv), card_type.security);
                } else {
                    app.setMaxLength($(app.el_cvv));
                }

                if (!$elem.hasClass(classIdentifier)) {
                    var classes = '';
                    for (var i in app.cardTypes) {
                        classes += app.el_ccTypePrefix + app.cardTypes[i].code + ' ';
                    }
                    $elem.removeClass(classes + app.el_ccUnknown);
                    $elem.addClass(classIdentifier);
                }
            };


            app.init = function() {

                $(document).find(app.el_cardNumber).each(function() {
                    var $elem = $(this);
                    if ($elem.is('input')) {
                        $elem.on('input', function() {
                            app.monitorCcFormat($elem);
                        });
                    }
                });

                app.addListeners();

            }();

        })();


        // js file
        const img = document.getElementById("image");
            if(img){
                img.addEventListener("error", function(event) {
                event.target.src = "{{url('assets/image_new/svg/colored/not-found-img.svg')}}"
                event.onerror = null
            })
        }
    </script>
       @yield('js')
</body>

</html>