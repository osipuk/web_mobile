<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>CrmJoy Login</title>
      <meta name="description" content="">
      <meta name="keywords" content="">
      <link rel="icon" type="image/png" href="">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link href="{!!asset('assets/css/bootstrap.min.css')!!}" rel="stylesheet">
      <link href="{!!asset('assets/css/style.css')!!}" rel="stylesheet">
   </head>
   <body class="login-bg">
      <div>
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="text-right">
                     <a class="navbar-brand font-weight-bold text-white" href="{{ url('home') }}">Afdal Analytics<img src="{!!asset('assets/image/logoicon.png')!!}" height="40" class="ml-2"></a>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-5 col-sm-6 col-12 mx-auto">
                  <form class="mt-3">
                     <h3 class="text-center text-white">Forgot Password</h3>
                     <p class="text-center text-white">Back to <a href="{{ url('signin') }}" class="text-white"><u>Signin</u></a></p>
                     <div class="form-group">
                        <label class="d-block text-white">Email</label>
                        <input type="text" class="form-control" placeholder="name@company.com">
                     </div>

                     <div class="form-group text-center mt-5">
                        <button class="btn btn-warning btn-md">Forgot Password</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>
      <script type="text/javascript" src="{!!asset('assets/js/popper.min.js')!!}"></script>
      <script type="text/javascript" src="{!!asset('assets/js/bootstrap.min.js')!!}"></script>
   </body>
</html>
