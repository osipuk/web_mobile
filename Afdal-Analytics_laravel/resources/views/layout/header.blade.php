!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Home</title>
      <meta name="description"
            content="Afdal Analytics platform is built to help you understand what’s going on with your business. Track KPIs & marketing campaigns across different channels in one place. 14-day free trial.">
      <meta name="keywords" content="Data Analytics Platform | Marketing reports | Afdal Analytics">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="icon" href="{{asset('image/logoicon.png')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/owl.carousel.min.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/owl.theme.default.min.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

      <script src="https://script.tapfiliate.com/tapfiliate.js" type="text/javascript" async></script>
      <script type="text/javascript">
         (function(t,a,p){t.TapfiliateObject=a;t[a]=t[a]||function(){
         (t[a].q=t[a].q||[]).push(arguments)}})(window,'tap');

         tap('create', '32473-e3a646', { integration: "stripe" });
         tap('detect');
      </script>

      <script type="text/javascript">
         (function(e,t,o,n,p,r,i){e.visitorGlobalObjectAlias=n;e[e.visitorGlobalObjectAlias]=e[e.visitorGlobalObjectAlias]||function(){(e[e.visitorGlobalObjectAlias].q=e[e.visitorGlobalObjectAlias].q||[]).push(arguments)};e[e.visitorGlobalObjectAlias].l=(new Date).getTime();r=t.createElement("script");r.src=o;r.async=true;i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)})(window,document,"https://diffuser-cdn.app-us1.com/diffuser/diffuser.js","vgo");
         vgo('setAccount', '254549829');
         vgo('setTrackByDefault', true);

         vgo('process');
      </script>
   </head>

   <body>

      <nav class="navbar navbar-expand-lg shadow">
         <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#crm-navbar" aria-controls="crm-navbar" aria-expanded="false"
                    aria-label="Toggle navigation">
               <span class="fas fa-align-justify"></span>
            </button>
            <div class="collapse navbar-collapse" id="crm-navbar">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                     <a class="nav-link signin-free text-white" href="#">Try For Free</a>
                  </li>
                  <li class="nav-item active">
                     <a class="nav-link signin-btn" href="{{ url('login') }}">Sign In</a>
                  </li>
               </ul>
               <ul class="navbar-nav mx-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="/contact-us">{{ __('Contact Us') }}</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{url('resource')}}">{{ __('Resources') }}</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ url('pricing') }}">{{ __('Pricing') }}</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">{{ __('Why Afda') }}</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ url('product') }}">{{ __('Product') }}</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ url('home') }}"> {{ __('Home') }}</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @php $locale = session()->get('locale'); @endphp
                        @switch($locale)
                        @case('ar')
                        Arabic
                        @break
                        @case('en')
                        English
                        @break
                        @default
                        Arabic
                        @endswitch
                        <span class="caret"></span>
                     </a>

                     <div class="dropdown languages">
                        <ul class="dropdown-menu languages" aria-labelledby="languages">
                           <li><a href="lang/en"> English </a></li>
                           <li> <a href="lang/ar"> Arabic </a></li>
                        </ul>
                     </div>
                  </li>
               </ul>
            </div>
            <a class="navbar-brand font-weight-bold text-white" href="{{ url('home') }}">Afdal Analytics<img src="{{asset('assets/image/logoicon.png')}}" height="40"
                    class="ml-2"></a>
         </div>
      </nav>


      @yield('content')


      <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="card-group">
                     <div class="card footer-col-card">
                        <div class="card-body">
                           <h5 class="font-weight-bold mb-3">Afdal Analytics</h5>
                           <p class="theme-color"><small>Ready to help launch your project <br> along with our well-designed pages.</small></p>
                           <ul class="social-media-footer">
                              <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                              <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                              <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                           </ul>
                        </div>
                     </div>

                     <div class="card footer-col-card">
                        <div class="card-body text-right">
                           <h5 class="font-weight-bold mb-3">Company</h5>
                           <ul>
                              <li><a href="#">About Us</a></li>
                              <li><a href="#">Pricing</a></li>
                              <li><a href="#">Contact</a></li>
                           </ul>
                        </div>
                     </div>

                     <div class="card footer-col-card">
                        <div class="card-body text-right">
                           <h5 class="font-weight-bold mb-3">Product</h5>
                           <ul>
                              <li><a href="#">Overview</a></li>
                              <li><a href="#">Connections</a></li>
                              <li><a href="#">Dashboard</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card footer-col-card">
                        <div class="card-body text-right">
                           <h5 class="font-weight-bold mb-3">Resources</h5>
                           <ul>
                              <li><a href="#">Blog</a></li>
                              <li><a href="#">Guides</a></li>
                              <li><a href="#">Glassary</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card footer-col-card">
                        <div class="card-body text-right">
                           <h5 class="font-weight-bold mb-3">Account</h5>
                           <ul>
                              <li><a href="{{url('/signup')}}">Sign Up</a></li>
                              <li><a href="{{url('/signup')}}">Sign In</a></li>
                              <li><a href="{{url('/forgotpass')}}">Forgot Password</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="copyright-bg">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <p class="m-0 text-white"><i class="fas fa-copyright"></i> 2020 RCCP Inc. All Rights Reserved.</p>
               </div>
               <div class="col-lg-6">
                  <p class="m-0 text-right"><a href="{{ url('privacypolicy') }}" class="text-white">Privacy Policy</a> <a href="#" class="text-white">Data Security</a> <a href="#"
                        class="text-white">Legal Notice</a></p>
               </div>
            </div>
         </div>
      </div>

      <script type="text/javascript" src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('assets/js/popper.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>

   </body>

</html>