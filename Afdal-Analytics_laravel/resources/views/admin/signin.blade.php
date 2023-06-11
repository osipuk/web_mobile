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
    <link rel="icon" type="image/png" sizes="16x16" href="{!!asset('/web_public/assets/assets/images/logoicon.png')!!}">
    <title>Afdal Analytics Signin</title>

    <!-- page css -->
    <link href="{!!asset('/web_public/assets/dist/css/pages/login-register-lock.css')!!}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{!!asset('/web_public/assets/dist/css/style.min.css')!!}" rel="stylesheet">

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
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(/web_public/assets/assets/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body">
                 <form action="{{ url('loging-in') }}" method="post" enctype="multipart/form-data" class="form-horizontal text-center" id="loginform">
                              @csrf
                    <h3><img src="{!!asset('/web_public/assets/assets/images/logoicon.png')!!}" alt="Logo" /> <br> Afdal Analytics</h3>
                    	@if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>

                @endif



                @if ($message = Session::get('error'))

                <div class="alert alert-danger alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>

                @endif
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" name="email" type="text" placeholder="Email" id="email" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" name="password" type="password" placeholder="Password" id="password" required="">
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

            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{!!asset('/web_public/assets/assets/node_modules/jquery/jquery-3.2.1.min.js')!!}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{!!asset('/web_public/assets/assets/node_modules/popper/popper.min.js')!!}"></script>
    <script src="{!!asset('/web_public/assets/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')!!}"></script>
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });

    </script>
</body>

</html>
