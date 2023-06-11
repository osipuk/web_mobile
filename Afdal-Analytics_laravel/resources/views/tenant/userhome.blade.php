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
                     Home
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
         <div class="row">
            <div class="col-12">
               <div class="text-right">
                  <h5 class="font-weight-bold">Your Overview</h5>
                  <div class="bottom-border-admin ml-auto"></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
               <div class="card home-card mt-3">
                  <div class="card-header bg-gray"><small>Last week</small> <span class="float-right font-weight-bold">ACTIVE DAILY USERS</span></div>
                  <div class="card-body">
                     <h4 class="font-weight-bold text-center"><i class="fas fa-chevron-up text-success"></i> (9%) 34+</h4>
                  </div>
                  <div class="card-footer bg-transparent border-0 text-right">Facebook page name</div>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
               <div class="card home-card mt-3">
                  <div class="card-header bg-gray"><small>Last week</small> <span class="float-right font-weight-bold">TOTAL FOLLOWERS</span></div>
                  <div class="card-body">
                     <h4 class="font-weight-bold text-center">134,363</h4>
                  </div>
                  <div class="card-footer bg-transparent border-0 text-right">Facebook page name</div>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
               <div class="card home-card mt-3">
                  <div class="card-header bg-gray"><small>Last week</small> <span class="float-right font-weight-bold">NEW FOLLOWERS</span></div>
                  <div class="card-body">
                     <h4 class="font-weight-bold text-center">8,925</h4>
                  </div>
                  <div class="card-footer bg-transparent border-0 text-right">Facebook page name</div>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
               <div class="card home-card mt-3">
                  <div class="card-header bg-gray"><small>Last week</small> <span class="float-right font-weight-bold">ORGANIC REACH</span></div>
                  <div class="card-body">
                     <h4 class="font-weight-bold text-center"><i class="fas fa-chevron-up text-success"></i> (13%) 251+</h4>
                  </div>
                  <div class="card-footer bg-transparent border-0 text-right">Facebook page name</div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-6 col-sm-12 col-12">
               <div class="card card-table mt-5">
                  <div class="card-header bg-gray"><small>Last week</small> <span class="float-right font-weight-bold">TOP CITIES</span></div>
                  <div class="card-body">
                     <div class="top-city-scroller">
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                        <div class="table-responsive-card">
                           <div class="card-table1">
                              <p class="m-0 text-right"><b>Rustyfort</b></p>
                           </div>
                           <div class="card-table2">
                              <p class="m-0"><b>1,592</b></p>
                           </div>
                           <div class="card-table3">
                              <p class="m-0"><b>58%</b></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
               <div class="card card-table mt-5">
                  <div class="card-header bg-gray"><small>Last week</small> <span class="float-right font-weight-bold">INFLUENCER MAP</span></div>
                  <div class="card-body">
                     <img src="{!!asset('public/assets/image/map.png')!!}" class="img-fluid w-100 map-img">
                  </div>
                  <div class="card-footer-1">
                     <div class="card-group footer-color">
                        <div class="card bg-transparent">
                           <div class="card-body bg-transparent">
                              <p class="m-0 text-info-p"><i class="fas fa-chevron-up ml-2"></i> 11.4% <span class="float-right text-white"><i class="fas fa-dot-circle ml-2 icon3"></i>BG</span></p>
                           </div>
                        </div>
                        <div class="card bg-transparent">
                           <div class="card-body bg-transparent">
                              <p class="m-0 text-info-p"><i class="fas fa-chevron-up ml-2"></i> 1.2% <span class="float-right text-white"><i class="fas fa-dot-circle ml-2 icon2"></i>UK</span></p>
                           </div>
                        </div>
                        <div class="card bg-transparent">
                           <div class="card-body bg-transparent">
                              <p class="m-0 text-info-p"><i class="fas fa-chevron-up ml-2"></i> 9.1% <span class="float-right text-white"><i class="fas fa-dot-circle ml-2 icon1"></i>USA</span></p>
                           </div>
                        </div>
                     </div>
                     <div class="card-group footer-color footer-color-2">
                        <div class="card bg-transparent">
                           <div class="card-body bg-transparent">
                              <p class="m-0 text-info-p"><i class="fas fa-chevron-up ml-2"></i> 11.4% <span class="float-right text-white"><i class="fas fa-dot-circle ml-2 icon3"></i>BG</span></p>
                           </div>
                        </div>
                        <div class="card bg-transparent">
                           <div class="card-body bg-transparent">
                              <p class="m-0 text-info-p"><i class="fas fa-chevron-up ml-2"></i> 1.2% <span class="float-right text-white"><i class="fas fa-dot-circle ml-2 icon2"></i>UK</span></p>
                           </div>
                        </div>
                        <div class="card bg-transparent">
                           <div class="card-body bg-transparent">
                              <p class="m-0 text-info-p"><i class="fas fa-chevron-up ml-2"></i> 9.1% <span class="float-right text-white"><i class="fas fa-dot-circle ml-2 icon1"></i>USA</span></p>
                           </div>
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