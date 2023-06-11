@section('metahead')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
@endsection

@extends('layout.userhead')
<body class="dashboard">
@include('layout.usersidenav')
<div class="main-content">
    <div class="header">
        <div class="right-side">
            <h1 class="font-50-lh-114-regular mb-0">
                {{__('Homepage')}}
            </h1>
            <a href="/template" class="add-to-dashboard-wrapper">
                <p class="text font-24-lh-29-regular add-dashboard-text">
                    {{__('Add Dashboard')}}
                </p>
                <div class="add-icon">
                </div>
            </a>
        </div>
        <div class="left-side mt-3">
            <div class="bell-icon"></div>
            <div class="user-icon"></div>
        </div>
    </div>
    <div class="main-photo">
        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1307.64 911">
            <defs>
                <style>.cls-1 {
                        fill: #8797af;
                    }

                    .cls-2 {
                        fill: #d0d8e3;
                    }

                    .cls-3 {
                        fill: #b0bbcb;
                    }

                    .cls-4 {
                        fill: #e4eaf2;
                    }

                    .cls-5 {
                        fill: #fff;
                    }
                </style>
            </defs>
            <path id="Path_43134" data-name="Path 43134" class="cls-1"
                  d="M1337.27,488.16l4-32.36A43.69,43.69,0,1,1,1428,466.62h0L1424,499a5.88,5.88,0,0,1-6.55,5.1l-75.07-9.36a5.88,5.88,0,0,1-5.1-6.55Z"
                  transform="translate(-306.18 -85)"/>
            <circle id="Ellipse_316" data-name="Ellipse 316" class="cls-2" cx="1075.45" cy="380.78" r="32.03"/>
            <path id="Path_43135" data-name="Path 43135" class="cls-1"
                  d="M1339.18,457.11a34.6,34.6,0,0,1,38.57-30l6.48.81a34.58,34.58,0,0,1,30,38.57l-.08.65-13.67-1.7-3-13.65-2.56,13-7.07-.88-1.53-6.89-1.3,6.52-45.9-5.74Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43136" data-name="Path 43136" class="cls-2"
                  d="M1229.94,580a14.7,14.7,0,0,0,22,5.07l29.1,17L1295.76,587l-41.43-23.5a14.84,14.84,0,0,0-24.39,16.54Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43137" data-name="Path 43137" class="cls-3"
                  d="M1321.81,610.67c-21.46,0-59.23-9.6-61.32-10.14l-.66-.17,6-30.09,57.68,11.39,31.34-44.13,36-3.65-1,1.32c-.47.62-46.84,61.67-54.06,71.91C1333.88,609.69,1328.68,610.67,1321.81,610.67Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43138" data-name="Path 43138" class="cls-3"
                  d="M1327.87,723.62l-.85-.41c-.19-.08-18.42-9-27.87-26.27s34.6-90.33,37.68-95.4l.05-23.21,15.82-42.74,20.19-11.4-17.33,40.43Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43139" data-name="Path 43139" class="cls-2"
                  d="M1309.85,973.14h-19.3l-9.18-74.42h28.48Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43140" data-name="Path 43140" class="cls-3"
                  d="M1314.89,991.84h-62.2v-.78a24.22,24.22,0,0,1,24.21-24.22h38Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43141" data-name="Path 43141" class="cls-2"
                  d="M1504.67,956.23l-18.33,6-31.9-67.86,27.06-8.87Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43142" data-name="Path 43142" class="cls-3"
                  d="M1515.16,972.47l-59.11,19.37-.24-.75a24.21,24.21,0,0,1,15.47-30.55h0l36.1-11.83Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43143" data-name="Path 43143" class="cls-3"
                  d="M1467.32,944.06l-55-91.82-46.42-98.09-41.8,86.65L1307.51,953l-58.21.8.23-.91L1338.6,599l69.76,10.44-3.15,46,1.89,2.69c15.76,22.39,32.05,45.53,22.7,70.48l26.5,78.67,58.64,131Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43144" data-name="Path 43144" class="cls-4"
                  d="M1350.28,675.71c-10.1,0-21.64-11.54-15.64-31.24l-.39-.29,14.37-63.49c-12.54-17.93,4-32.74,5.55-34.06l7.89-14.21,34.82-22.08,17.62,146.4-.26.26C1401.51,669.17,1358.77,675.71,1350.28,675.71Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43145" data-name="Path 43145" class="cls-3"
                  d="M1413.12,708.75a16.77,16.77,0,0,1-4.12-.43c-1.35-.34-3.54-2.07-6.93-13.1-13.47-43.85-29.37-175.81-17.82-188.72l.26-.3,19,3.16c1.56-1.16,9.85-6.94,17.49-5.93a11.59,11.59,0,0,1,7.93,4.69l.13.17,6,86,22.14,101.19-.52.24C1455.4,696.27,1427.76,708.75,1413.12,708.75Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43146" data-name="Path 43146" class="cls-2"
                  d="M1400.36,675.14a14.76,14.76,0,0,0,14.26-15.23,15,15,0,0,0-.32-2.59l27.77-19.13-7.51-19.71L1395.73,646a14.84,14.84,0,0,0,4.63,29.1Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43147" data-name="Path 43147" class="cls-3"
                  d="M1432.91,653.52l-24.74-18.14L1442.94,588l-26.68-47.08,11.94-34.14.78,1.47c.36.69,36,68.57,42.21,79.45,6.47,11.32-36,63.14-37.84,65.33Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43148" data-name="Path 43148" class="cls-3"
                  d="M911.6,866.93l-21.06-8.87L876.1,752.52H683.78l-15.65,105.1L649.3,867a4.47,4.47,0,0,0,2,8.48H909.87a4.47,4.47,0,0,0,1.73-8.61Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43149" data-name="Path 43149" class="cls-2"
                  d="M1270.46,766.57H325.72A18.73,18.73,0,0,1,307,747.85V614.63h982.11V747.85a18.71,18.71,0,0,1-18.67,18.71Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43150" data-name="Path 43150" class="cls-1"
                  d="M1290.13,677.59H306.18v-570A22.59,22.59,0,0,1,328.75,85h938.81a22.59,22.59,0,0,1,22.57,22.56Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43151" data-name="Path 43151" class="cls-5"
                  d="M1231.36,636.22H365a17.43,17.43,0,0,1-17.4-17.4V143.77a17.42,17.42,0,0,1,17.4-17.4h866.41a17.41,17.41,0,0,1,17.39,17.4V618.82A17.41,17.41,0,0,1,1231.36,636.22Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43152" data-name="Path 43152" class="cls-2"
                  d="M1026.37,876.62H539.52A2.25,2.25,0,0,1,537.3,875a2.21,2.21,0,0,1,1.57-2.7,2.1,2.1,0,0,1,.56-.07h486.76a2.34,2.34,0,0,1,2.33,1.72,2.21,2.21,0,0,1-1.68,2.63,2.42,2.42,0,0,1-.47,0Z"
                  transform="translate(-306.18 -85)"/>
            <rect id="Rectangle_18816" data-name="Rectangle 18816" class="cls-4" x="674.67" y="118.18"
                  width="209.19"
                  height="159.82"/>
            <rect id="Rectangle_18817" data-name="Rectangle 18817" class="cls-5" x="685.18" y="126.12"
                  width="188.4"
                  height="143.93"/>
            <path id="Path_43153" data-name="Path 43153" class="cls-3"
                  d="M1088.43,317.88h.08a50.23,50.23,0,0,0,1.12-100.25,1.15,1.15,0,0,0-1.24,1.13l-1.1,98a1.16,1.16,0,0,0,1.14,1.16Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43154" data-name="Path 43154" class="cls-4"
                  d="M1051.11,233.82a1.52,1.52,0,0,1,1,.45l33.72,34.49a1.41,1.41,0,0,1,.42,1l-.52,46.88a1.44,1.44,0,0,1-.48,1.06,1.46,1.46,0,0,1-1.11.39A50.56,50.56,0,0,1,1050,234.32a1.47,1.47,0,0,1,1.07-.5Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43155" data-name="Path 43155" class="cls-1"
                  d="M1085.11,217.22a1.51,1.51,0,0,1,1,.42,1.42,1.42,0,0,1,.45,1.08L1086.1,261a1.46,1.46,0,0,1-1.49,1.45,1.43,1.43,0,0,1-1-.44l-29.43-30.09a1.48,1.48,0,0,1,0-2.09s0,0,0-.05a50.68,50.68,0,0,1,30.8-12.57Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43156" data-name="Path 43156" class="cls-1"
                  d="M1070.36,338.19a9,9,0,1,1-8.92-9.12,9,9,0,0,1,8.92,9.12Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43157" data-name="Path 43157" class="cls-3"
                  d="M1095.13,338.48a9,9,0,1,1-8.92-9.12,9,9,0,0,1,8.92,9.12Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43158" data-name="Path 43158" class="cls-4"
                  d="M1119.9,338.77a9,9,0,1,1-8.92-9.13,9,9,0,0,1,8.92,9.13Z"
                  transform="translate(-306.18 -85)"/>
            <rect id="Rectangle_18818" data-name="Rectangle 18818" class="cls-4" x="672.57" y="303.14"
                  width="209.19"
                  height="159.82"/>
            <rect id="Rectangle_18819" data-name="Rectangle 18819" class="cls-5" x="683.07" y="311.08"
                  width="188.4"
                  height="143.93"/>
            <circle id="Ellipse_317" data-name="Ellipse 317" class="cls-3" cx="718.19" cy="350.57" r="7.82"/>
            <path id="Path_43159" data-name="Path 43159" class="cls-3"
                  d="M1146.41,429.48a5.31,5.31,0,0,1,0,10.61h-82.28a5.31,5.31,0,0,1,0-10.61h82.28m0-1.3h-82.28a6.61,6.61,0,0,0-.26,13.21h82.54a6.61,6.61,0,0,0,.26-13.21Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43160" data-name="Path 43160" class="cls-1"
                  d="M1115,441.39H1053a6.61,6.61,0,0,1,0-13.21H1115a6.61,6.61,0,1,1,.26,13.21Z"
                  transform="translate(-306.18 -85)"/>
            <circle id="Ellipse_318" data-name="Ellipse 318" class="cls-3" cx="718.19" cy="383.05" r="7.82"/>
            <path id="Path_43161" data-name="Path 43161" class="cls-3"
                  d="M1146.41,462a5.31,5.31,0,0,1,0,10.61h-82.28a5.31,5.31,0,0,1,0-10.61h82.28m0-1.31h-82.28a6.61,6.61,0,0,0,0,13.21h82.28a6.61,6.61,0,0,0,.26-13.21Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43162" data-name="Path 43162" class="cls-1"
                  d="M1137.76,473.88h-85.33a6.61,6.61,0,0,1,0-13.21h85.33a6.61,6.61,0,0,1,0,13.21Z"
                  transform="translate(-306.18 -85)"/>
            <circle id="Ellipse_319" data-name="Ellipse 319" class="cls-3" cx="718.19" cy="415.54" r="7.82"/>
            <path id="Path_43163" data-name="Path 43163" class="cls-3"
                  d="M1146.41,494.45a5.31,5.31,0,0,1,0,10.61h-82.28a5.31,5.31,0,0,1,0-10.61h82.28m0-1.31h-82.28a6.61,6.61,0,0,0,0,13.21h82.28a6.61,6.61,0,0,0,.26-13.21Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43164" data-name="Path 43164" class="cls-1"
                  d="M1088.32,506.36h-34.65a6.61,6.61,0,0,1,0-13.21h34.65a6.61,6.61,0,0,1,0,13.21Z"
                  transform="translate(-306.18 -85)"/>
            <rect id="Rectangle_18820" data-name="Rectangle 18820" class="cls-4" x="73.85" y="146.45"
                  width="584.44"
                  height="299.53"/>
            <rect id="Rectangle_18821" data-name="Rectangle 18821" class="cls-5" x="93.34" y="161.34"
                  width="545.48"
                  height="269.76"/>
            <path id="Path_43165" data-name="Path 43165" class="cls-2"
                  d="M877.34,474.94H479.7a1.24,1.24,0,0,1-1.24-1.25V283.1a1.24,1.24,0,0,1,2.48,0V472.45H877.33a1.25,1.25,0,1,1,0,2.49h0Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43166" data-name="Path 43166" class="cls-1"
                  d="M564.66,461.25H528.49a3.69,3.69,0,0,1-3.69-3.69V407.7a3.69,3.69,0,0,1,3.69-3.69h36.17a3.7,3.7,0,0,1,3.7,3.69v49.86A3.7,3.7,0,0,1,564.66,461.25Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43167" data-name="Path 43167" class="cls-1"
                  d="M619.33,461.25H583.16a3.69,3.69,0,0,1-3.69-3.69V360.41a3.69,3.69,0,0,1,3.69-3.69h36.17a3.7,3.7,0,0,1,3.7,3.69v97.15a3.7,3.7,0,0,1-3.7,3.69Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43168" data-name="Path 43168" class="cls-1"
                  d="M682.67,461.25H646.49a3.69,3.69,0,0,1-3.69-3.69V407.7a3.69,3.69,0,0,1,3.69-3.69h36.17a3.7,3.7,0,0,1,3.7,3.69v49.86A3.69,3.69,0,0,1,682.67,461.25Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43169" data-name="Path 43169" class="cls-1"
                  d="M746,461.25H709.84a3.62,3.62,0,0,1-3.7-3.52V341.58a3.63,3.63,0,0,1,3.7-3.53H746a3.62,3.62,0,0,1,3.69,3.53V457.73A3.61,3.61,0,0,1,746,461.25Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43170" data-name="Path 43170" class="cls-1"
                  d="M809.34,461.25H773.18a3.71,3.71,0,0,1-3.7-3.69V308.14a3.71,3.71,0,0,1,3.7-3.7h36.16a3.7,3.7,0,0,1,3.69,3.7V457.56A3.69,3.69,0,0,1,809.34,461.25Z"
                  transform="translate(-306.18 -85)"/>
            <circle id="Ellipse_320" data-name="Ellipse 320" class="cls-2" cx="240.39" cy="296.6" r="7.47"/>
            <circle id="Ellipse_321" data-name="Ellipse 321" class="cls-2" cx="294.75" cy="248.07" r="7.47"/>
            <circle id="Ellipse_322" data-name="Ellipse 322" class="cls-2" cx="358.14" cy="296.6" r="7.47"/>
            <circle id="Ellipse_323" data-name="Ellipse 323" class="cls-2" cx="421.54" cy="224.43" r="7.47"/>
            <circle id="Ellipse_324" data-name="Ellipse 324" class="cls-2" cx="484.93" cy="197.05" r="7.47"/>
            <path id="Path_43171" data-name="Path 43171" class="cls-2"
                  d="M667.22,383.28l-66.11-49.52L535.9,382.6l-1.49-2,66.7-50,65.8,49.28,65.38-71.55.26-.11,66-26.57.93,2.31-65.69,26.47Z"
                  transform="translate(-306.18 -85)"/>
            <path id="Path_43172" data-name="Path 43172" class="cls-2"
                  d="M1612.38,996H1062.69a1.44,1.44,0,1,1,0-2.88h549.69a1.44,1.44,0,0,1,0,2.88Z"
                  transform="translate(-306.18 -85)"/>
        </svg>
    </div>
    <div class="footer">
        <a class="left-block user-select-none" href="/template">
            <div class="icon"></div>
            <p class="title font-24-lh-29-medium">
                {{__('Add a Template')}}
            </p>
            <p class="text font-16-lh-19-regular">{{__('Add a pre-made template to view your data')}}
            </p>
        </a>
        @if(Auth::user() && !(Auth::user()->social_account_instagram->isNotEmpty() || Auth::user()->social_account_facebook->isNotEmpty() || Auth::user()->social_account_twitter->isNotEmpty()))
            <a class="center-block user-select-none" href="/dashboard/subscribe-plan">
                <div
                    class="icon icon-connect"></div>
                <p class="title font-24-lh-29-medium">
                    {{__('Choose Plan')}}
                </p>
                <p class="text font-16-lh-19-regular">
                    {{__('Compare our subscription plans and find')}}
                </p>
            </a>
        @endif
        <a class="right-block user-select-none" href="/">
            <div class="icon"></div>
            <p class="title font-24-lh-29-medium">
                {{__('Knowledge Base')}}
            </p>
            <p class="text font-16-lh-19-regular">
                {{__('Browse through our extensive learning material and expand your knowledge')}}
            </p>

        </a>
    </div>
</div>
{{-- <div class="user-panel font-21-lh-28-medium">
    <div class="user-panel-top">
        <div class="menu-close-icon"></div>
        <a href="/" class="home">
            <p class="home-text">الصفحة الرئيسية</p>
            <div class="home-icon"></div>
        </a>
        <a href="#" class="menu">
            <p class="menu-text">نماذج</p>
            <div class="menu-icon"></div>
        </a>
        <a class="connection" href="#">
            <p class="connection-text">اتصالات» روابط</p>
            <div class="connection-icon"></div>
        </a>
        <a class="setting" href="#">
            <p class="setting-text">إعدادات</p>
            <div class="setting-icon"></div>
        </a>
        <a class="help" href="#">
            <p class="help-text">صفحة المساعدة</p>
            <div class="help-icon"></div>
        </a>
    </div>
    <a class="logout" href="#">
        <p class="logout-text">تسجيل الخروج</p>
        <div class="logout-icon"></div>
    </a>
</div> --}}
</body>
