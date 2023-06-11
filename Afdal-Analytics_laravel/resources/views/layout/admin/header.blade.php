<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" type="image/png" sizes="16x16" href="{!!asset('web_public/assets/assets/images/logoicon.png')!!}">
      <!-- Favicon icon -->
      <title>Afdal Analytics</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

      <link rel="stylesheet" href="{!!asset('web_public/assets/assets/node_modules/dropify/dist/css/dropify.min.css')!!}">
      <link rel="stylesheet" type="text/css"
        href="{!!asset('web_public/assets/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')!!}">
      <link rel="stylesheet" type="text/css"
        href="{!!asset('web_public/assets/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')!!}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!--Toaster Popup message CSS -->
    <link href="{!!asset('web_public/assets/assets/node_modules/toast-master/css/jquery.toast.css')!!}" rel="stylesheet">

      <link href="{!!asset('web_public/assets/dist/css/style.min.css')!!}" rel="stylesheet">
      <link href="{!!asset('web_public/assets/dist/css/pages/float-chart.css')!!}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
      <link href="{!!asset('web_public/assets/assets/node_modules/switchery/dist/switchery.min.css')!!}" rel="stylesheet" />

      @yield('metahead')
      <link href="{!!asset('web_public/assets/dist/css/new.css')!!}" rel="stylesheet">
      <style type="text/css">
         .bg-theme-bg{
         background: #030f25 !important;
         }
         .topbar .top-navbar .profile-pic .f-10-logo{
         font-size: 20px;
         white-space: nowrap;
         color: #ffffff;
         }
         .topbar .top-navbar .navbar-header{
         background-color: #f2f5fc;
         }
         .topbar .top-navbar .navbar-header .navbar-brand .light-logo, .topbar .top-navbar .navbar-header .navbar-brand .dark-logo{
         color: #030f25 !important;
         }
      </style>
   </head>
   <body class="skin-blue fixed-layout">
      <!-- ============================================================== -->
      <!-- Preloader - style you can find in spinners.css -->
      <!-- ============================================================== -->
      <div class="preloader">
         <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Afdal Analytics</p>
         </div>
      </div>
      <div id="main-wrapper">
         <header class="topbar bg-theme-bg">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
               <div class="navbar-header">
                  <a class="navbar-brand" href="javascript:void(0)">
                     <!-- Logo icon -->
                     <b>
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="{!!asset('web_public/assets/assets/images/users/1.jpg')!!}" height="40" alt="user-img" class="img-circle dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="{!!asset('web_public/assets/assets/images/users/1.jpg')!!}" height="40" alt="user-img" class="img-circle light-logo" />
                     </b>
                     <!--End Logo icon -->
                     <!-- Logo text -->
                     <span>
                        <!-- dark Logo text -->
                        <p class="dark-logo m-0" >Admin</p>
                        <!-- Light Logo text -->
                        <p class="light-logo m-0" alt="main-wrapper">Admin</p>
                     </span>
                  </a>
               </div>
               <div class="navbar-collapse">
                  <ul class="navbar-nav mr-auto">
                     <!-- This is  -->
                     <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark"
                        href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                     <li class="nav-item"> <a
                        class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark"
                        href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                     <!-- ============================================================== -->
                  </ul>
                  <!-- ============================================================== -->
                  <!-- User profile and search -->
                  <!-- ============================================================== -->
                  <ul class="navbar-nav my-lg-0">
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle text-white waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti-bell"></i>
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                        <ul>
                           <li>
                              <div class="drop-title">Notifications</div>
                           </li>
                           <li>
                              <div class="message-center">
                                 <!-- Message -->
                                 <a href="javascript:void(0)">
                                    <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                    <div class="mail-contnet">
                                       <h5>Luanch Admin</h5>
                                       <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                                    </div>
                                 </a>
                                 <!-- Message -->
                                 <a href="javascript:void(0)">
                                    <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                    <div class="mail-contnet">
                                       <h5>Event today</h5>
                                       <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span>
                                    </div>
                                 </a>
                                 <!-- Message -->
                                 <a href="javascript:void(0)">
                                    <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                    <div class="mail-contnet">
                                       <h5>Settings</h5>
                                       <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span>
                                    </div>
                                 </a>
                                 <!-- Message -->
                                 <a href="javascript:void(0)">
                                    <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                    <div class="mail-contnet">
                                       <h5>Pavan kumar</h5>
                                       <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
                                    </div>
                                 </a>

                                 <a href="javascript:void(0)">
                                    <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                    <div class="mail-contnet">
                                       <h5>Luanch Admin</h5>
                                       <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                                    </div>
                                 </a>

                                 <a href="javascript:void(0)">
                                    <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                    <div class="mail-contnet">
                                       <h5>Luanch Admin</h5>
                                       <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                                    </div>
                                 </a>
                              </div>
                           </li>

                        </ul>
                     </div>
                  </li>
                  <!-- User Profile -->
                  <li class="nav-item dropdown u-pro">
                     <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="hidden-md-down mr-2 f-10-logo">Afdal Analytics</span> <img src="{!!asset('web_public/assets/assets/images/logoicon.png')!!}" alt="user" class=""> &nbsp;<i class="fa fa-angle-down"></i></a>
                     <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <!-- text-->
                        <a href="{{ url('profile') }}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="{{ url('logout-admin') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        <!-- text-->
                     </div>
                  </li>
               </ul>

                  <!-- ============================================================== -->
                  <!-- End User Profile -->
                  <!-- ============================================================== -->
               </div>
            </nav>
         </header>
         <!-- ============================================================== -->
         <!-- End Topbar header -->
         <!-- ============================================================== -->
         <!-- ============================================================== -->
         <!-- Left Sidebar - style you can find in sidebar.scss  -->
         <!-- ============================================================== -->
         <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
               <!-- Sidebar navigation-->
               <nav class="sidebar-nav">
                  <ul id="sidebarnav">
                     <li><a class="waves-effect waves-dark" href="{{ url('user-dashboard') }}" aria-expanded="false"><i class="fas fa-box"></i><span class="hide-menu">Dashboard</span></a>
                     </li>
                     <li><a class="waves-effect waves-dark" href="{{ url('user-management') }}" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">User Management</span></a>
                     </li>
                     <li><a class="waves-effect waves-dark" href="{{ url('billing') }}" aria-expanded="false"><i class="fas fa-wallet"></i><span class="hide-menu">Billing</span></a>
                     </li>
                     <li><a class="waves-effect waves-dark" href="{{ url('customer-support') }}" aria-expanded="false"><i class="fas fa-bell"></i><span class="hide-menu">Customer Support</span></a>
                     </li>
                     <li><a class="waves-effect waves-dark" href="{{ url('subscription') }}" aria-expanded="false"><i class="fas fa-ticket-alt"></i><span class="hide-menu">Subscription</span></a>
                     </li>
                     <li><a class="waves-effect waves-dark" href="{{ url('newsfeed') }}" aria-expanded="false"><i class="fas fa-file"></i><span class="hide-menu">News Feed</span></a></li>
                     <li>
                     <li><a class="waves-effect waves-dark" href="{{ url('knowledge_base') }}" aria-expanded="false"><i class="fas fa-file"></i><span class="hide-menu">Knowledge Base</span></a></li>

                     <li><a class="waves-effect waves-dark" href="{{ url('support') }}" aria-expanded="false"><i class="fas fa-file"></i><span class="hide-menu">Support</span></a></li>
                     <li>
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-cog"></i><span class="hide-menu">Setting</span></a>
                        <ul aria-expanded="false" class="collapse">
                           <li><a href="{{ url('smtp-setting') }}">SMTP Setting</a></li>
                           <li><a href="{{ url('currency-converter') }}">Currency Converter</a></li>
                           <li><a href="{{ url('payment-gateway') }}">Payment Gateway</a></li>
                           <li><a href="{{ url('email-template') }}">Email Template</a></li>
                           <li><a href="{{ url('website-setting') }}">Website Setting</a></li>
                           <li><a href="{{ url('pages') }}">Pages</a></li>
                        </ul>
                     </li>

                     <li><a class="waves-effect waves-dark text-warning" href="{{ url('logout-admin') }}" aria-expanded="false"><i class="fas fa-circle"></i><span class="hide-menu">Sign out</span></a> </li>
                  </ul>
               </nav>
               <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
         </aside>
         <div class="headermain">
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <div class="container-fluid">

            </div>
         </div>
         @yield('content')
      </div>



      <footer class="footer">
   © 2021 Afdal Analytics
</footer>


<div id="delete-confirm" class="modal fade">
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header flex-column">
            <div class="icon-box">
               <i class="material-icons">&#xE5CD;</i>
            </div>
            <h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <div class="modal-body">
            <p>Do you really want to delete these records? This process cannot be undone.</p>
         </div>
         <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger">Delete</button>
         </div>
      </div>
   </div>
</div>

<script src="{!!asset('web_public/assets/assets/node_modules/jquery/jquery-3.2.1.min.js')!!}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{!!asset('web_public/assets/assets/node_modules/popper/popper.min.js')!!}"></script>
<script src="{!!asset('web_public/assets/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')!!}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{!!asset('web_public/assets/dist/js/perfect-scrollbar.jquery.min.js')!!}"></script>
<!--Wave Effects -->
<script src="{!!asset('web_public/assets/dist/js/waves.js')!!}"></script>
<!--Menu sidebar -->
<script src="{!!asset('web_public/assets/dist/js/sidebarmenu.js')!!}"></script>
<!--stickey kit -->
<script src="{!!asset('web_public/assets/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js')!!}"></script>
<script src="{!!asset('web_public/assets/assets/node_modules/sparkline/jquery.sparkline.min.js')!!}"></script>
<!--Custom JavaScript -->
<script src="{!!asset('web_public/assets/dist/js/custom.min.js')!!}"></script>
<!-- Flot Charts JavaScript -->
<script src="{!!asset('web_public/assets/assets/node_modules/sparkline/jquery.charts-sparkline.js')!!}"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<!-- This is data table -->
    <script src="{!!asset('web_public/assets/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')!!}"></script>
    <script src="{!!asset('web_public/assets/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')!!}"></script>
<!-- jQuery file upload -->
<script src="{!!asset('web_public/assets/assets/node_modules/dropify/dist/js/dropify.min.js')!!}"></script>
<script src="{!!asset('web_public/assets/assets/node_modules/switchery/dist/switchery.min.js')!!}"></script>
<!-- Popup message jquery -->
    <script src="{!!asset('web_public/assets/assets/node_modules/toast-master/js/jquery.toast.js')!!}"></script>


<script>

//   $.toast({
//              heading: 'Welcome to Afdal Analytics',
//              text: 'Use the predefined ones, or specify a custom position object.',
//              position: 'top-right',
//              loaderBg: '#030f25',
//              icon: 'info',
//              hideAfter: 3500,
//              stack: 6
//          })

   $(document).ready(function() {
      $("#toggle-profile-btn").click(function() {
         $('#profile-detail-toggle').hide();
      $('#profile-edit-toggle').show();
      });

      $("#show-detail-toggle").click(function() {
         $('#profile-detail-toggle').show();
      $('#profile-edit-toggle').hide();
      });
   });

   $(document).ready(function() {
      $("#message-reply-btn").click(function() {
         $('#hide-on-click-reply-btn').hide();
      $('#show-on-click-ryply-button').show();
      });

      $("#message-send-btn").click(function() {
         $('#hide-on-click-reply-btn').show();
      $('#show-on-click-ryply-button').hide();
      });

   });

   // responsive table
            $('#config-table').DataTable({
                responsive: true
            });
   $(function () {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function () {
                new Switchery($(this)[0], $(this).data());
            });
            });
   $(document).ready(function() {
      $('.dropify').dropify();
    });
</script>
<script>
   CKEDITOR.replace( 'editor1' );
</script>
<script>
   $(function() {

       var start = moment().subtract(29, 'days');
       var end = moment();

       function cb(start, end) {
           $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
       }

       $('#reportrange').daterangepicker({
           startDate: start,
           endDate: end,
           ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
           }
       }, cb);

       cb(start, end);

   });


</script>
</body>
</html>
