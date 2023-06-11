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
                <form class="form-horizontal">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <p><a href="{{ url('login') }}">Go Back</a></p>
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary  btn-block text-uppercase btn-rounded" type="submit">Reset</button>
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
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        
    </script>
</body>

</html>
