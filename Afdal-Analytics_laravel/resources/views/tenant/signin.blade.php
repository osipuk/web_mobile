<!DOCTYPE html>
<html>

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Login</title>
      {{--
      <meta name="description" content="">
      <meta name="keywords" content=""> --}}
      <link rel="icon" type="image/png" href="">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link href="{!!asset('public/assets/css/bootstrap.min.css')!!}" rel="stylesheet">
      <link href="{!!asset('public/assets/css/style.css')!!}" rel="stylesheet">
   </head>

   <body>
      <nav class="navbar navbar-expand-lg shadow">
         <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#crm-navbar" aria-controls="crm-navbar" aria-expanded="false"
                    aria-label="Toggle navigation">
               <span class="fas fa-align-justify"></span>
            </button>
            <div class="collapse navbar-collapse" id="crm-navbar">

               <ul class="navbar-nav mx-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="{{ url('contactus') }}">Contact Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">Resources</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ url('pricing') }}">Pricing</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">Why Afdal</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ url('product') }}">Product</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ url('home') }}">Home</a>
                  </li>
               </ul>
            </div>
            <a class="navbar-brand font-weight-bold text-white" href="{{ url('home') }}">Afdal Analytics<img src="{!!asset('public/assets/image/logoicon.png')!!}" height="40"
                    class="ml-2"></a>
         </div>
      </nav>
      <div class="login-bg">
         <div class="container">
            <!-- <div class="row">
               <div class="col-12">
                  <div class="text-right">
                     <a class="navbar-brand font-weight-bold text-white" href="{{ url('home') }}">Afdal Analytics<img src="{!!asset('public/assets/image/logoicon.png')!!}" height="40" class="ml-2"></a>
                  </div>
               </div>
            </div> -->
            <div class="row">
               <div class="col-lg-5 col-sm-6 col-12 mx-auto">
                  <form class="mt-3">
                     <h3 class="text-center text-white">Welcome</h3>
                     <p class="text-center text-white">Not an user? <a href="{{ url('signup') }}" class="text-white"><u>Signup</u></a></p>
                     <div class="form-group text-right">
                        <label class="d-block text-white">Email</label>
                        <input type="text" class="form-control text-right" placeholder="البريد الإلكتروني">
                     </div>
                     <div class="form-group text-right">
                        <label class="d-block text-white">Password <span class="float-left"><a href="#" class="text-warning"><i class="fas fa-eye mr-2"></i>Show</a></span></label>
                        <input type="text" class="form-control text-right" placeholder="Password">
                     </div>
                     <div class="row">
                        <!--  <div class="col-6">
                           <div class="text-left">
                              <a href="{{ url('forgotpass') }}" class="text-white"><u>Forgot Password</u></a>
                           </div>
                        </div> -->
                        <div class="col-12">
                           <div class="form-group form-check text-right">
                              <label class="form-check-label text-white mr-5" for="exampleCheck1">I agree to the Afdal Analytics Terms.</label>
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                           </div>
                        </div>
                     </div>
                     <div class="form-group text-center mt-3">
                        <a href="{{ url('userhome') }}" class="btn btn-warning btn-md">Log In</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="container mb-5">
         <div class="row kpx_loginOr">
            <div class="col-lg-5 col-sm-6 col-12 mx-auto">
               <hr class="kpx_hrOr">
               <span class="kpx_spanOr">Or, sign in with</span>
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
      <script type="text/javascript" src="{!!asset('public/assets/js/jquery-3.4.1.min.js')!!}"></script>
      <script type="text/javascript" src="{!!asset('public/assets/js/popper.min.js')!!}"></script>
      <script type="text/javascript" src="{!!asset('public/assets/js/bootstrap.min.js')!!}"></script>
   </body>

</html>