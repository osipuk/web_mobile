@extends('layout.userhead')
@section('title', 'User Home')
<div class="page-wrapper chiller-theme toggled">
   @section('content')
   @extends('layout.usersidenav')
   <main class="page-content">
      <div class="container-fluid">
         <nav class="navbar navbar-expand-lg bg-transparent user-navbar pl-0 pr-0">
            <div class="container-fluid">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item head-list-heading">
                     Dashboard
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
                  <div class="col-lg-6 col-sm-6 col-12">
                     <div class="dashboard-tabs">
                        <ul class="nav nav-pills">
                           <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#fb-page">Instagram Insight</a>
                           </li>
                           <!-- <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#fb-page-ads">Facebook Ads</a>
                           </li> -->
                           <li class="nav-item">
                              <a href="#" class="btn btn-white btn-circle text-warning"><i class="fas fa-plus"></i></a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-6 col-sm-6 col-12">
                     <div class="dashboard-button">
                        <p><a href="#" class="btn btn-white btn-circle text-warning"><i class="fas fa-upload"></i></a> <a href="#" class="btn btn-white btn-md text-warning rounded1rem"><i class="fas fa-calendar ml-2"></i>Last 7 Days</a> </p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="tab-content">
                        <div class="tab-pane active" id="fb-page">
                           <div class="row">
                              <div class="col-lg-3 col-sm-12 col-12">
                                 <div class="row">
                                    <div class="col-lg-12 col-sm-3 col-12">
                                       <div class="card mb-4">
                                          <div class="card-body text-right">
                                             <h5 class="font-weight-bold">Total Followers</h5>
                                             <div class="d-flex-dashbard-data mt-3">
                                                <div class="dashboard-data-2 text-right">
                                                   <h3 class="font-weight-bold m-0">2,322</h3>
                                                </div>

                                                <div class="dashboard-data-1 text-left">
                                                   <span class="alert alert-danger">6%<i class="fas fa-sort-down mr-3"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-3 col-12">
                                       <div class="card mb-4">
                                          <div class="card-body text-right">
                                             <h5 class="font-weight-bold">Total Engagment</h5>
                                             <div class="d-flex-dashbard-data mt-3">
                                                <div class="dashboard-data-2 text-right">
                                                   <h3 class="font-weight-bold m-0">1,634</h3>
                                                </div>

                                                <div class="dashboard-data-1 text-left">
                                                   <span class="alert alert-info">5%<i class="fas fa-sort-down mr-3"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-3 col-12">
                                       <div class="card mb-4">
                                          <div class="card-body text-right">
                                             <h5 class="font-weight-bold">Reach</h5>
                                             <div class="d-flex-dashbard-data mt-3">
                                                <div class="dashboard-data-2 text-right">
                                                   <h3 class="font-weight-bold m-0">282K</h3>
                                                </div>

                                                <div class="dashboard-data-1 text-left">
                                                   <span class="alert alert-danger">3%<i class="fas fa-sort-down mr-3"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-3 col-12">
                                       <div class="card mb-4">
                                          <div class="card-body text-right">
                                             <h5 class="font-weight-bold">Engagement Rate</h5>
                                             <div class="d-flex-dashbard-data mt-3">
                                                <div class="dashboard-data-2 text-right">
                                                   <h3 class="font-weight-bold m-0">14.19%</h3>
                                                </div>

                                                <div class="dashboard-data-1 text-left">
                                                   <span class="alert alert-info">3%<i class="fas fa-sort-down mr-3"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-9 col-sm-12 col-12">
                                 <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="card mb-3">
                                          <div class="card-body">
                                             <h5 class="font-weight-bold text-right">Follower Growth</h5>
                                             <div id="areachart22"></div>
                                             <div class="bottom-charts">
                                                <ul class="text-right mt-0">
                                                   <li><span class="chart-bars bards-1"></span>Organic Reach</li>
                                                   <li><span class="chart-bars bards-3"></span>Paid Reach</li>
                                                   <li><span class="chart-bars bards-4"></span>Unfollows</li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="card mb-3">
                                          <div class="card-body">
                                             <h5 class="font-weight-bold text-right">Audience by Gender</h5>
                                             <div id="chart2"></div>
                                           
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="card mb-3">
                                          <div class="card-body">
                                             <h5 class="font-weight-bold text-right">Age Range</h5>
                                             <div id="chart"></div>
                                             <div class="bottom-charts">
                                                <ul class="text-right">
                                                   <li><span class="chart-bars bards-2"></span>Female</li>
                                                   <li><span class="chart-bars bards-1"></span>Mail</li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="card mb-3">
                                          <div class="card-body">
                                             <h5 class="font-weight-bold text-right">Installs By Country</h5>
                                             <div id="chartdiv"></div>
                                             <div class="bottom-charts">
                                                <ul class="text-right">
                                                   <li><span class="chart-bars bards-3"></span>United States</li>
                                                   <li><span class="chart-bars bards-1"></span>China</li>
                                                   <li><span class="chart-bars bards-4"></span>Algeria</li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="fb-page-ads">No data available ...</div>
                     </div>
                  </div>
               </div>
               <div class="row">
            <div class="col-12">
               <div class="bottom-background-dash"></div>
            </div>
         </div>
      </div>

   
   </main>
</div>

@endsection