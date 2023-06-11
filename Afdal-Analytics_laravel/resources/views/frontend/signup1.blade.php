<!DOCTYPE html>
<html>
   <head>
       <title>اشترك</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>{{__('Signup ')}}</title>
      <meta name="description" content="">
      <meta name="keywords" content="">
      <link rel="icon" type="image/png" href="">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link href="{!!asset('assets/css/bootstrap.min.css')!!}" rel="stylesheet">
      <link href="{!!asset('assets/css/style.css')!!}" rel="stylesheet">
      <style>
         body{
            overflow-x:hidden;
         }
      </style>

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

        <!-- active compaign -->
      <script type="text/javascript">
        (function(e,t,o,n,p,r,i){
            e.visitorGlobalObjectAlias=n;
            e[e.visitorGlobalObjectAlias]=e[e.visitorGlobalObjectAlias]||function(){
                (e[e.visitorGlobalObjectAlias].q=e[e.visitorGlobalObjectAlias].q||[]).push(arguments)};e[e.visitorGlobalObjectAlias].l=(new Date).getTime();r=t.createElement("script");r.src=o;r.async=true;i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)})(window,document,"https://diffuser-cdn.app-us1.com/diffuser/diffuser.js","vgo");
        vgo('setAccount', '254549829');
        vgo('setTrackByDefault', true);
        vgo('process');
      </script>
   </head>
   <body>

      <div class="login-bg">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="text-right">
                     <a class="navbar-brand font-weight-bold text-white" href="{{ url('home') }}">{{__('Afdal Analytics')}}<img src="{!!asset('assets/image/logoicon.png')!!}" height="40" class="ml-2"></a>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-5 col-sm-6 col-12 mx-auto">
                  <form class="mt-3">
                     <h3 class="text-center text-white">{{__('Sign Up')}}</h3>
                     <p class="text-center text-white">{{__('Already an user?')}}<a href="{{ url('login') }}" class="text-white"><u>{{__('Sign in')}}</u></a></p>
                     <div class="row">
                        <div class="col-6">
                           <div class="form-group text-right">
                              <label class="d-block text-white">{{__('First Name')}}</label>
                              <input type="text" class="form-control text-right" placeholder="{{__('First Name')}}">
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group text-right">
                              <label class="d-block text-white">{{__('Last Name')}}</label>
                              <input type="text" class="form-control text-right" placeholder="{{__('Last Name')}}">
                           </div>
                        </div>
                     </div>
                     <div class="form-group text-right">
                        <label class="d-block text-white">{{__('Email')}}</label>
                        <input type="email" class="form-control text-right" placeholder="name@company.com">
                     </div>
                     <div class="form-group text-right">
                        <label class="d-block text-white">{{__('Password')}} <span class="float-left"><a href="#" class="text-warning"><i class="fas fa-eye mr-2"></i>{{__('Show')}}</a></span></label>
                        <input type="text" class="form-control text-right" placeholder="{{__('Password')}}">
                     </div>
                     <div class="row">
                        <div class="col-6">
                           <div class="form-group text-right">
                              <label class="d-block text-white">{{__('Working As')}}</label>
                              <input type="text" class="form-control text-right" placeholder="{{__('Type your company name')}}">
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group text-right">
                              <label class="d-block text-white">{{__('Company')}}</label>
                              <input type="text" class="form-control text-right" placeholder="{{__('Type your company name')}}">
                           </div>
                        </div>
                     </div>
                     <div class="form-group form-check text-right">
                        <label class="form-check-label text-white mr-5" for="exampleCheck1">{{__('I agree to the Afdal Analytics Terms.')}}</label>
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                     </div>

                     <div class="form-group text-center mt-3">
                        <a href="{{ url('signup2') }}" class="btn btn-warning btn-md">{{__('Sign Up')}}</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="bord">
         <div class="container mb-5">
            <div class="row kpx_loginOr">
               <div class="col-lg-5 col-sm-6 col-12 mx-auto">
                  <!-- <hr class="kpx_hrOr"> -->
                  <span class="kpx_spanOr">{{__('Or, sign up with')}}</span>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-2 col-sm-3 col-12 mx-auto">
                  <ul class="nav login-social">
                     <li><a href="#"><i class="fab fa-google"></i></a></li>
                     <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                     <li><a href="#"><i class="fab fa-apple"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>
      <script type="text/javascript" src="{!!asset('assets/js/popper.min.js')!!}"></script>
      <script type="text/javascript" src="{!!asset('assets/js/bootstrap.min.js')!!}"></script>
   </body>
   @include('frontend.components.cookie')
</html>
