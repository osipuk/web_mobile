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
                           <!-- <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#fb-page">Facebook Page Insight</a>
                           </li> -->
                           <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#fb-page-ads">Google Play Store Performance</a>
                           </li>
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
                        <div class="tab-pane active" id="fb-page-ads">
                           <div class="row">
                              <div class="col-lg-3 col-sm-12 col-12">
                                 <div class="row">

                                    <div class="col-lg-12 col-sm-3 col-12">
                                       <div class="card mb-4">
                                          <div class="card-body text-right">
                                             <h5 class="font-weight-bold">Total Installs</h5>
                                             <div class="d-flex-dashbard-data mt-3">
                                                <div class="dashboard-data-2 text-right">
                                                   <h3 class="font-weight-bold m-0">2,687</h3>
                                                </div>

                                                <div class="dashboard-data-1 text-left">
                                                   <span class="alert alert-info">246%<span><i class="fas fa-sort-up mr-3"></i></span></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-3 col-12">
                                       <div class="card mb-4">
                                          <div class="card-body text-right">
                                             <h5 class="font-weight-bold">Mentions</h5>
                                             <div class="d-flex-dashbard-data mt-3">
                                                <div class="dashboard-data-2 text-right">
                                                   <h3 class="font-weight-bold m-0">192</h3>
                                                </div>

                                                <div class="dashboard-data-1 text-left">
                                                   <span class="alert alert-danger">4%<i class="fas fa-sort-up mr-3"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-3 col-12">
                                       <div class="card mb-4">
                                          <div class="card-body text-right">
                                             <h5 class="font-weight-bold">Retweet Count</h5>
                                             <div class="d-flex-dashbard-data mt-3">
                                                <div class="dashboard-data-2 text-right">
                                                   <h3 class="font-weight-bold m-0">281</h3>
                                                </div>

                                                <div class="dashboard-data-1 text-left">
                                                   <span class="alert alert-danger">1%<i class="fas fa-sort-up mr-3"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-3 col-12">
                                       <div class="card mb-4">
                                          <div class="card-body text-right">
                                             <h5 class="font-weight-bold">Impressions</h5>
                                             <div class="d-flex-dashbard-data mt-3">
                                                <div class="dashboard-data-2 text-right">
                                                   <h3 class="font-weight-bold m-0">105K</h3>
                                                </div>

                                                <div class="dashboard-data-1 text-left">
                                                   <span class="alert alert-info">59%<i class="fas fa-sort-up mr-3"></i></span>
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
                                             <h5 class="font-weight-bold text-right">Tweet Daily Impressions</h5>
                                             <canvas id="lineChart"></canvas>
                                             <div class="bottom-charts">
                                                <ul class="text-right mt-3">
                                                   <li><span class="chart-bars bards-3"></span>Impressions</li>
                                                   <li><span class="chart-bars bards-1"></span>Previous Apr - Jun</li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="card mb-3">
                                          <div class="card-body">
                                             <h5 class="font-weight-bold text-right">Tweet Engagements</h5>
                                             <div id="chart"></div>
                                             <div class="bottom-charts">
                                                <ul class="text-right">
                                                   <li><span class="chart-bars bards-2"></span>New unpaid</li>
                                                   <li><span class="chart-bars bards-1"></span>New Paid</li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-lg-4 col-sm-12 col-12">
                                       <div class="row">
                                          <div class="col-lg-12 col-sm-6 col-12">
                                       <div class="card mb-4">
                                          <div class="card-body text-right">
                                             <h5 class="font-weight-bold">Followers Gained</h5>
                                             <div class="d-flex-dashbard-data mt-3">
                                                <div class="dashboard-data-2 text-right">
                                                   <h3 class="font-weight-bold m-0">107</h3>
                                                </div>

                                                <div class="dashboard-data-1 text-left">
                                                   <span class="alert alert-info">8%<i class="fas fa-sort-down mr-3"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                          <div class="col-lg-12 col-sm-6 col-12">
                                       <div class="card mb-4">
                                          <div class="card-body text-right">
                                             <h5 class="font-weight-bold">Tweets</h5>
                                             <div class="d-flex-dashbard-data mt-3">
                                                <div class="dashboard-data-2 text-right">
                                                   <h3 class="font-weight-bold m-0">10</h3>
                                                </div>

                                                <div class="dashboard-data-1 text-left">
                                                   <span class="alert alert-danger">20%<i class="fas fa-sort-down mr-3"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                       </div>
                                    </div>

                                    <div class="col-lg-8 col-sm-12 col-12">
                                       <div class="card card-table mb-3">
                                    <div class="card-body">
                                       <h5 class="font-weight-bold text-right">Top Retweeted Posts</h5>
                                       <div class="top-city-scroller dhashbord-table-Team">
                                          <div class="table-responsive-card border-0">
                                             <div class="card-table50">
                                                <h6 class="m-0 text-right"><b>Campaign</b></h6>
                                             </div>
                                             <div class="card-table110">
                                                <h6 class="m-0 text-right"><b>Reach</b></h6>
                                             </div>
                                             <div class="card-table120">
                                                <h6 class="m-0 text-right"><b>Impressions</b></h6>
                                             </div>
                                             <div class="card-table110">
                                                <h6 class="m-0 text-right"><b>Clicks</b></h6>
                                             </div>
                                             <div class="card-table110">
                                                <h6 class="m-0 text-right"><b>Link Visits</b></h6>
                                             </div>
                                          </div>

                                          <div class="table-responsive-card">
                                             <div class="card-table50">
                                                <p class="m-0">"An example top tweet text goes here"</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">1,592</p>
                                             </div>
                                             <div class="card-table120">
                                                <p class="m-0">87,123</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">648</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">86</p>
                                             </div>
                                          </div>

                                          <div class="table-responsive-card">
                                             <div class="card-table50">
                                                <p class="m-0">"An example top tweet text goes here"</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">1,592</p>
                                             </div>
                                             <div class="card-table120">
                                                <p class="m-0">87,123</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">648</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">86</p>
                                             </div>
                                          </div>

                                          <div class="table-responsive-card">
                                             <div class="card-table50">
                                                <p class="m-0">"An example top tweet text goes here"</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">1,592</p>
                                             </div>
                                             <div class="card-table120">
                                                <p class="m-0">87,123</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">648</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">86</p>
                                             </div>
                                          </div>

                                          <div class="table-responsive-card">
                                             <div class="card-table50">
                                                <p class="m-0">"An example top tweet text goes here"</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">1,592</p>
                                             </div>
                                             <div class="card-table120">
                                                <p class="m-0">87,123</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">648</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">86</p>
                                             </div>
                                          </div>

                                          <div class="table-responsive-card">
                                             <div class="card-table50">
                                                <p class="m-0">"An example top tweet text goes here"</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">1,592</p>
                                             </div>
                                             <div class="card-table120">
                                                <p class="m-0">87,123</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">648</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">86</p>
                                             </div>
                                          </div>

                                          <div class="table-responsive-card">
                                             <div class="card-table50">
                                                <p class="m-0">"An example top tweet text goes here"</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">1,592</p>
                                             </div>
                                             <div class="card-table120">
                                                <p class="m-0">87,123</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">648</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">86</p>
                                             </div>
                                          </div>

                                          <div class="table-responsive-card">
                                             <div class="card-table50">
                                                <p class="m-0">"An example top tweet text goes here"</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">1,592</p>
                                             </div>
                                             <div class="card-table120">
                                                <p class="m-0">87,123</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">648</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">86</p>
                                             </div>
                                          </div>

                                          <div class="table-responsive-card">
                                             <div class="card-table50">
                                                <p class="m-0">"An example top tweet text goes here"</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">1,592</p>
                                             </div>
                                             <div class="card-table120">
                                                <p class="m-0">87,123</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">648</p>
                                             </div>
                                             <div class="card-table110">
                                                <p class="m-0">86</p>
                                             </div>
                                          </div>
                                         
                                       </div>
                                    </div>
                                 </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
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