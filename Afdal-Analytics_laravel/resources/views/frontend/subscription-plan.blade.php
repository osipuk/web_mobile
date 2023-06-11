@section('metahead')

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
{{--        <title>{{__('SignUp')}}</title>--}}
{{--        <meta name="description" content="">--}}
{{--        <meta name="keywords" content="">--}}
        <meta name="_token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="{!!asset('assets/css/bootstrap.min.css')!!}" rel="stylesheet">
        <link href="{!!asset('assets/css/style.css')!!}" rel="stylesheet">
        <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>

@endsection
    @extends('layout.userhead')

    <body class="theme-bg chose-subscription-page">
        <div class="content-wrapper">
            <div class="header-menu">
                {{-- <a class="move-back" href="#">
                    <div class="move-back__icon"></div>
                    <p class="move-back__text font-16-lh-26-medium mb-0">
                        عودة
                    </p>
                </a> --}}
                <h3 class="text-center chose-subscription-title font-45-lh-54-medium text-white">
                  {{__('Choose your subscription')}}
              </h3>
                <div class="logo-wrapper">
                    <a href="/" class="header-logo"></a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 mx-auto">
                    <div class="form-wizard mt-5">
                        <div class="myContainer">
                            <div class="form-container animated text-center">
                                <div class="pricing-card-row mb-4">
                                  <div class="container">
                                      {{-- <div class="row">
                                          <div class="col-12">
                                              <h3 class="text-center subscription-wrapper-title font-45-lh-54-medium text-white">
                                                  {{__('Choose your subscription')}}
                                              </h3>
                                          </div>
                                      </div> --}}
                                      <div class="pay-range-block">
                                          <div class="monthly-wrapper">
                                            <div class="check-mark--orange transparent"></div>
                                            <p class="pay-monthly font-20-lh-39-medium">
                                                {{__('Pay Monthly')}}
                                            </p>
                                          </div>
                                          <div class="radio">
                                            <div class="radio-dot"></div>
                                          </div>
                                          <div class="annually-wrapper">
                                            <div class="check-mark--blue"></div>
                                            <p class="pay-annually font-20-lh-39-medium">{{__('Pay Annually')}}</p>
                                            <p class="two-month-block font-20-lh-39-medium">{{__('2 months for free')}}</p>
                                        </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-12">
                                              <div class="card-group">
                                                <div class="card pricing-card mt-5 mr-0 essentials-card">
                                                  <div class="card-body">
                                                      <div class="text-center">
                                                          <p class="theme-color font-30-lh-36-medium">{{__('Essentials')}}</p>
                                                          <h3 class="font-84-lh-84-medium">{{__('$359')}}</h3>
                                                          <p class="theme-color font-20-lh-32-medium">{{__('per month /')}}</p>
                                                          <p class="theme-color font-20-lh-32-medium">{{__('Everything you need as a marketer to quickly analyze marketing data from all common marketing apps and platforms.')}}</p>
                                                      </div>
                                                      <ul class="plan-benefits-list">
                                                        <li class="benefits-list-item">
                                                          <p class="benefits-list-text">
                                                            {{__('Insights')}}
                                                          </p>
                                                          <div class="check-mark--dark-blue"></div>
                                                        </li>
                                                        <li class="benefits-list-item">
                                                          <p class="benefits-list-text">
                                                            {{__('Dashboards')}}
                                                          </p>
                                                          <div class="check-mark--dark-blue"></div>
                                                        </li>
                                                        <li class="benefits-list-item">
                                                          <p class="benefits-list-text">
                                                            {{__('3 Connections')}}
                                                          </p>
                                                          <div class="check-mark--dark-blue"></div>
                                                        </li>
                                                        <li class="benefits-list-item">
                                                          <p class="benefits-list-text">
                                                            {{__('Learnings Base')}}
                                                          </p>
                                                          <div class="check-mark--dark-blue"></div>
                                                        </li>
                                                        <li class="benefits-list-item">
                                                          <p class="benefits-list-text">
                                                            {{__('Email Support')}}
                                                          </p>
                                                          <div class="check-mark--dark-blue"></div>
                                                        </li>
                                                      </ul>
                                                  </div>
                                                  <div class="text-center card-footer border-0 pt-0">
                                                      <a class="btn choose-btn ml-0 btn-warning font-16-lh-19-semi-bold buttons-interactions" href="{{route('payments', ['plan' => $plans[0]->identifier])}}">{{__('CHOOSE')}}</a>
                                                  </div>
                                                </div>

                                                <div class="card pricing-card mt-5 mr-4 plus-card">
                                                    <div class="card-body ">
                                                        <div class="text-center">
                                                            <p class="font-30-lh-36-medium">{{__('Plus')}}</p>
                                                            <h3 class="font-84-lh-84-medium">{{__('$859')}}</h3>
                                                            <p class="font-20-lh-32-medium">{{__('per month /')}}</p>
                                                            <p class="font-20-lh-32-medium">{{__('Comprehensive data collection and transformation for teams to connect to any platform, anywhere.')}}</p>
                                                        </div>
                                                        <ul class="plan-benefits-list">
                                                          <li class="benefits-list-item">
                                                            <p class="benefits-list-text">
                                                              {{__('Everything In Essential')}}
                                                            </p>
                                                            <div class="check-mark--dark-blue"></div>
                                                          </li>
                                                          <li class="benefits-list-item">
                                                            <p class="benefits-list-text">
                                                              {{__('Proactive Dashboards')}}
                                                            </p>
                                                            <div class="check-mark--dark-blue"></div>
                                                          </li>
                                                          <li class="benefits-list-item">
                                                            <p class="benefits-list-text">
                                                              {{__('5 Connections')}}
                                                            </p>
                                                            <div class="check-mark--dark-blue"></div>
                                                          </li>
                                                          <li class="benefits-list-item">
                                                            <p class="benefits-list-text">
                                                              {{__('Roles & permissions')}}
                                                            </p>
                                                            <div class="check-mark--dark-blue"></div>
                                                          </li>
                                                          <li class="benefits-list-item">
                                                            <p class="benefits-list-text">
                                                              {{__('Phone Support')}}
                                                            </p>
                                                            <div class="check-mark--dark-blue"></div>
                                                          </li>
                                                        </ul>
                                                    </div>
                                                    <div class="text-center card-footer border-0 pt-0">
                                                        <a class="btn choose-btn ml-0 btn-white theme-color font-16-lh-19-semi-bold buttons-interactions" href="{{url('signup/step-2')}}">{{__('CHOOSE')}}</a>
                                                    </div>
                                                </div>

                                                <div class="card pricing-card mt-5 mr-4 enterprise-card">
                                                    <div class="card-body ">
                                                        <div class="text-center">
                                                            <p class="font-30-lh-36-medium">{{__('Enterprise')}}</p>
                                                            <h3 class="font-84-lh-84-medium">{{__('$1759')}}</h3>
                                                            <p class="font-20-lh-32-medium">{{__('per month /')}}</p>
                                                            <p class="font-20-lh-32-medium">{{__('Unified marketing reporting for international brands, or teams. Robust support with enterprise security.')}}</p>
                                                        </div>
                                                        <ul class="plan-benefits-list">
                                                          <li class="benefits-list-item">
                                                            <p class="benefits-list-text">
                                                              {{__('Everything In Plus')}}
                                                            </p>
                                                            <div class="check-mark--orange"></div>
                                                          </li>
                                                          <li class="benefits-list-item">
                                                            <p class="benefits-list-text">
                                                              {{__('Custom Dashboards')}}
                                                            </p>
                                                            <div class="check-mark--orange"></div>
                                                          </li>
                                                          <li class="benefits-list-item">
                                                            <p class="benefits-list-text">
                                                              {{__('Unlimited Connections')}}
                                                            </p>
                                                            <div class="check-mark--orange"></div>
                                                          </li>
                                                          <li class="benefits-list-item">
                                                            <p class="benefits-list-text">
                                                              {{__('2 years Data History')}}
                                                            </p>
                                                            <div class="check-mark--orange"></div>
                                                          </li>
                                                          <li class="benefits-list-item">
                                                            <p class="benefits-list-text">
                                                              {{__('Guided Setup')}}
                                                            </p>
                                                            <div class="check-mark--orange"></div>
                                                          </li>
                                                        </ul>
                                                    </div>
                                                    <div class="text-center card-footer border-0 pt-0">
                                                        <a class="btn choose-btn ml-0 btn-warning font-16-lh-19-semi-bold buttons-interactions" href="{{url('signup/step-2')}}">{{__('CHOOSE')}}</a>
                                                    </div>
                                                </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                                <div class="steps-block">
                                    <div class="steps-block__step">
                                       <div class="steps-block__step-circle orange">
                                           <p class="steps-block__step-text orange-color font-16-lh-34-light">نبذة عنك</p>
                                       </div>
                                    </div>
                                    <div class="chose-platform-page line orange"></div>
                                    <div class="steps-block__step">
                                        <div class="steps-block__step-circle orange">
                                            <p class="steps-block__step-text orange-color font-16-lh-34-light">اتصالات» روابط</p>
                                        </div>
                                    </div>
                                    <div class="chose-platform-page line white"></div>
                                    <div class="steps-block__step">
                                        <div class="steps-block__step-circle white">
                                            <p class="steps-block__step-text white-color font-16-lh-34-light">لوحة المعلومات</p>
                                        </div>
                                    </div>
                                    <div class="chose-platform-page line white"></div>
                                    <div class="steps-block__step">
                                        <div class="steps-block__step-circle white">
                                            <p class="steps-block__step-text white-color font-16-lh-34-light">إنهاء</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a
                          class="font-16-lh-26-medium skip-connection-link"
                          href="{{url('signup/step-2')}}"
                        >
                          {{__('Skip Subscription Choice - Stat your 14-Day Trial instead')}}
                        </a>
                    </div>
                </div>
            </div>
            @extends('layout.language-picker');
        </div>
    <script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('assets/js/popper.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('assets/js/bootstrap.min.js')!!}"></script>

    <script type="text/javascript">
    // this stores
      let paymentPeriod = "annually";

      const monthlyButton = document.querySelector('.monthly-wrapper');
      const annuallyButton = document.querySelector('.annually-wrapper');
      const switchButton = document.querySelector('.radio');

      monthlyButton.addEventListener('click', () => {
        switchPaymentPeriod('monthly');
      });
      annuallyButton.addEventListener('click', () => {
        switchPaymentPeriod('annually')
      });
      switchButton.addEventListener('click', () => {
        switchPaymentPeriod()
      });


      function switchPaymentPeriod(period) {
        if (period) {
          paymentPeriod = period;
          changePaymentPickerVisual();
          return;
        }

        if (paymentPeriod === 'annually') {
          paymentPeriod = 'monthly';
          changePaymentPickerVisual();
        } else {
          paymentPeriod = 'annually';
          changePaymentPickerVisual();
        }
      };

      const payRangeBlock = document.querySelector('.pay-range-block');
      const monthlyCheckBox = document.querySelector('.check-mark--orange');
      const annuallyCheckBox = document.querySelector('.check-mark--blue');
      const twoMonthBlock = document.querySelector('.two-month-block');
      const payannuallyText = document.querySelector('.pay-annually');
      const payMonthlyText = document.querySelector('.pay-monthly');
      const switchElement = document.querySelector('.radio');
      const switchDotElement = document.querySelector('.radio-dot');

      function changePaymentPickerVisual() {
        if (paymentPeriod === 'annually') {
          payRangeBlock.classList.remove('monthly');
          twoMonthBlock.classList.remove('monthly');
          payannuallyText.classList.remove('monthly');
          payMonthlyText.classList.remove('monthly');
          switchElement.classList.remove('monthly');
          switchDotElement.classList.remove('monthly');
          monthlyCheckBox.classList.add('transparent');
          annuallyCheckBox.classList.remove('transparent');
        } else {
          payRangeBlock.classList.add('monthly');
          twoMonthBlock.classList.add('monthly');
          payannuallyText.classList.add('monthly');
          payMonthlyText.classList.add('monthly');
          switchElement.classList.add('monthly');
          switchDotElement.classList.add('monthly');
          monthlyCheckBox.classList.remove('transparent');
          annuallyCheckBox.classList.add('transparent');
        }
      }

      $(".steps li:nth-of-type(1)").addClass("active");
      $(".myContainer .form-container:nth-of-type(1)").addClass("active");

      $(".form-container").on("click", ".next", function () {
          $(".steps li").eq($(this).parents(".form-container").index() + 1).addClass("active");
          $(this).parents(".form-container").removeClass("active").next().addClass("active flipInX");
      });

      $(".form-container").on("click", ".back", function () {
          $(".steps li").eq($(this).parents(".form-container").index() - totalSteps).removeClass("active");
          $(this).parents(".form-container").removeClass("active flipInX").prev().addClass("active flipInY");
      });


      /*=========================================================
      *     If you won't to make steps clickable, Please comment below code
      =================================================================*/
      $(".steps li").on("click", function () {
          var stepVal = $(this).find("span").text();
          $(this).prevAll().addClass("active");
          $(this).addClass("active");
          $(this).nextAll().removeClass("active");
          $(".myContainer .form-container").removeClass("active flipInX");
          $(".myContainer .form-container:nth-of-type(" + stepVal + ")").addClass("active flipInX");
      });
    </script>
    </body>
</html>
