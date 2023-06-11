@extends('layout.userhead')
@section('title', 'User Home')
<div class="page-wrapper chiller-theme toggled">
   @section('content')
   @extends('layout.usersidenav')
   <main class="page-content pb-5">
      <div class="container-fluid">
         <nav class="navbar navbar-expand-lg bg-transparent user-navbar pl-0 pr-0">
            <div class="container-fluid">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item head-list-heading">
                     Latest Activity
                  </li>
               </ul>
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <span class="main-notify">
                     <i class="fas fa-bell notification-icon"></i>
                     <span class="notify-circle"></span>
                     </span>
                     </a>
                     <div class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                        Notification<br>
                        <span><small>Lorem ipsum dolor sit amet</small></span>
                        </a>
                        <a class="dropdown-item" href="#">Notification<br>
                        <span><small>Lorem ipsum dolor sit amet</small></span></a>
                        <a class="dropdown-item" href="#">Notification<br>
                        <span><small>Lorem ipsum dolor sit amet</small></span></a>
                     </div>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img src="{!!asset('public/assets/image/user.jpg')!!}" class="rounded-circle" height="40" width="40">
                     </a>
                     <div class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                        Profile
                        </a>
                        <a class="dropdown-item" href="#">Log Out</a>
                     </div>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"><img src="{!!asset('public/assets/image/homelogo.jpg')!!}" class="rounded" height="40" width="40"></a>
                  </li>
               </ul>
            </div>
         </nav>
         <div class="col-12">
            <div class="card card-table mt-3">
               <!-- <div class="card-header bg-gray text-right"><b>LATEST ACTIVITY</b></div> -->
               <div class="card-body">
                  <div >
                     <div class="table-responsive-card border-0">
                        <div class="card-table4">
                           <h6 class="m-0 text-right"><b>User</b></h6>
                        </div>
                        <div class="card-table5">
                           <h6 class="m-0 text-right"><b>Activity</b></h6>
                        </div>
                        <div class="card-table6">
                           <h6 class="m-0 text-right"><b>Date</b></h6>
                        </div>
                     </div>
                     <div class="table-responsive-card">
                        <div class="card-table4">
                           <p class="m-0 text-right">John Doe</p>
                        </div>
                        <div class="card-table5">
                           <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                        </div>
                        <div class="card-table6">
                           <p class="m-0 text-right">25-06-2021</p>
                        </div>
                     </div>
                     <div class="table-responsive-card">
                        <div class="card-table4">
                           <p class="m-0 text-right">John Doe</p>
                        </div>
                        <div class="card-table5">
                           <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                        </div>
                        <div class="card-table6">
                           <p class="m-0 text-right">25-06-2021</p>
                        </div>
                     </div>
                     <div class="table-responsive-card">
                        <div class="card-table4">
                           <p class="m-0 text-right">John Doe</p>
                        </div>
                        <div class="card-table5">
                           <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                        </div>
                        <div class="card-table6">
                           <p class="m-0 text-right">25-06-2021</p>
                        </div>
                     </div>
                     <div class="table-responsive-card">
                        <div class="card-table4">
                           <p class="m-0 text-right">John Doe</p>
                        </div>
                        <div class="card-table5">
                           <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                        </div>
                        <div class="card-table6">
                           <p class="m-0 text-right">25-06-2021</p>
                        </div>
                     </div>
                     <div class="table-responsive-card">
                        <div class="card-table4">
                           <p class="m-0 text-right">John Doe</p>
                        </div>
                        <div class="card-table5">
                           <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                        </div>
                        <div class="card-table6">
                           <p class="m-0 text-right">25-06-2021</p>
                        </div>
                     </div>
                     <div class="table-responsive-card">
                        <div class="card-table4">
                           <p class="m-0 text-right">John Doe</p>
                        </div>
                        <div class="card-table5">
                           <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                        </div>
                        <div class="card-table6">
                           <p class="m-0 text-right">25-06-2021</p>
                        </div>
                     </div>
                     <div class="table-responsive-card">
                        <div class="card-table4">
                           <p class="m-0 text-right">John Doe</p>
                        </div>
                        <div class="card-table5">
                           <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                        </div>
                        <div class="card-table6">
                           <p class="m-0 text-right">25-06-2021</p>
                        </div>
                     </div>
                     <div class="table-responsive-card">
                        <div class="card-table4">
                           <p class="m-0 text-right">John Doe</p>
                        </div>
                        <div class="card-table5">
                           <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                        </div>
                        <div class="card-table6">
                           <p class="m-0 text-right">25-06-2021</p>
                        </div>
                     </div>
                     <div class="table-responsive-card">
                        <div class="card-table4">
                           <p class="m-0 text-right">John Doe</p>
                        </div>
                        <div class="card-table5">
                           <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                        </div>
                        <div class="card-table6">
                           <p class="m-0 text-right">25-06-2021</p>
                        </div>
                     </div>
                     <div class="table-responsive-card">
                        <div class="card-table4">
                           <p class="m-0 text-right">John Doe</p>
                        </div>
                        <div class="card-table5">
                           <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                        </div>
                        <div class="card-table6">
                           <p class="m-0 text-right">25-06-2021</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
</div>
@endsection