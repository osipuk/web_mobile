<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{!!asset('public/assets/assets/images/logoicon.png')!!}">
    <title>Afdal Analytics Signin</title>
    
    <!-- page css -->
    <link href="{!!asset('public/assets/dist/css/pages/login-register-lock.css')!!}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{!!asset('public/assets/dist/css/style.min.css')!!}" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Afdal Analytics</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(assets/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal text-center" id="loginform">
                    <h3><img src="{!!asset('public/assets/assets/images/logoicon.png')!!}" alt="Logo" /> <br> Afdal Analytics</h3>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Email" id="email">
                            <input type="hidden" id="csrf" value="{{Session::token()}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Password" id="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember me</label>
                                </div> 
                                <div class="ml-auto">
                                    <a href="{{ url('forgot-password') }}"  class="text-muted"> Forgot Password</a> 
                                </div>
                            </div>   
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button id="to-recover" class="btn btn-primary  btn-block text-uppercase btn-rounded" type="submit">Log In</button>
                        </div>
                    </div>
                   
                </form>
                <form class="form-horizontal" id="recoverform">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Enter OTP</h3>
                           
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Enter OTP">
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <a href="#" class="m-l-5"><b>Resend OTP</b></a>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <a href="{{ url('dashboard') }}" class="btn btn-primary  btn-block text-uppercase btn-rounded">Submit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{!!asset('public/assets/assets/node_modules/jquery/jquery-3.2.1.min.js')!!}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{!!asset('public/assets/assets/node_modules/popper/popper.min.js')!!}"></script>
    <script src="{!!asset('public/assets/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')!!}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
   <!-- SweetAlert2 -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
         $('#to-recover').on("click", function() {
             $("#loginform").slideUp();
             $("#recoverform").fadeIn();
         });
    </script>

    <script type="text/javascript">   
    $("#to-recover").on("click", function(){
        var email = $("#email").val();
        var password = $("#password").val();
        var token = $("#csrf").val();
        if(email){
        if(password){
       $.ajax({
        url:'/crm-superadmin/loging-in',
        type:'POST',
        data:{
            _token:token,
            email:email,
            password:password},
        success:function(result){
             alert(result);
             if(result == 2){
                swal("Afdal Analytics!", "Wrong Credentials!", "error");   
             }else if(result == 3){
                 swal("Afdal Analytics!", "Email/Username does not exist.Please register!", "error");  
             }else{
                swal("Afdal Analytics!", "Otp sent successfully on email!", "success");
                 
             }  
        }
       });
       }else{
         swal("Afdal Analytics!", "Password is mandatory!", "error"); 
          $("#loginform").fadeIn();
        //$("#recoverform").slideUp();
      } 
      }else{
         swal("Afdal Analytics!", "Emaid id is mandatory!", "error");
          $("#loginform").fadeIn(); 
      } 
    }); 
    </script>
</body>

</html>