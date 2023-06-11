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
                     {{__('Help')}}
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
                        {{__('Notification')}}<br>
                        <span><small>Lorem ipsum dolor sit amet</small></span>
                        </a>
                        <a class="dropdown-item" href="#">{{__('Notification')}}<br>
                        <span><small>Lorem ipsum dolor sit amet</small></span></a>
                        <a class="dropdown-item" href="#">{{__('Notification')}}<br>
                        <span><small>Lorem ipsum dolor sit amet</small></span></a>
                     </div>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img src="{!!asset('public/assets/image/user.jpg')!!}" class="rounded-circle" height="40" width="40">
                     </a>
                     <div class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                        {{__('Profile')}}
                        </a>
                        <a class="dropdown-item" href="#">{{__('Log Out')}}</a>
                     </div>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"><img src="{!!asset('public/assets/image/homelogo.jpg')!!}" class="rounded" height="40" width="40"></a>
                  </li>
               </ul>
            </div>
         </nav>
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
         <div class="row">
            <div class="col-lg-12 col-sm-12 col-12">
               <div class="dashboard-tabs">
                  <ul class="nav nav-pills">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#my-support">{{__('Support')}}</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#knowledge">{{__('Knowledge Base')}}</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="tab-content">
                  <div class="tab-pane active" id="my-support">
                     <div class="row">
                        <div class="col-12">
                           <div class="card card-table mt-5">
                              <div class="card-header bg-gray text-right"><b>{{__('ALL TICKETS SUBMITTED')}}</b></div>
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-lg-3 col-sm-4 col-12">
                                       <div class="{{__('Help')}}-form">
                                          <div class="{{__('Help')}}-form-col2">
                                             <button class="btn bgn-hlp-form waves-effect waves-light"><i class="fas fa-search"></i></button>
                                          </div>
                                          <div class="{{__('Help')}}-form-col1">
                                             <input type="text" class="form-control m-0" placeholder="Search">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 col-12">
                                       <h6 class="font-weight-bold pt-2">1<span class="ml-3"><small>{{__('Open Tickets')}}</small></span></h6>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 col-12">
                                       <h6 class="font-weight-bold pt-2">24<span class="ml-3"><small>{{__('Closed Ticket')}}</small></span></h6>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 col-12">
                                       <div class="row">
                                          <div class="col-lg-4 col-sm-4 col-5">
                                             <p class="font-weight-bold pt-2">{{__('Date')}}</p>
                                          </div>
                                          <div class="col-lg-8 col-sm-8 col-7">
                                             <select class="form-control bg-gray">
                                                <option>{{__('Any')}}</option>
                                                <option>{{__('Open')}}</option>
                                                <option>{{__('Successful')}}</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="top-city-scroller dhashbord-table-Team">
                                    <div class="table-responsive-card border-0">
                                       <div class="card-table34">
                                          <h6 class="m-0 text-right"><b>{{__('User ID')}}</b></h6>
                                       </div>
                                       <div class="card-table35">
                                          <h6 class="m-0 text-right"><b>{{__('Ticket Title')}}</b></h6>
                                       </div>
                                       <div class="card-table36">
                                          <h6 class="m-0 text-right"><b>{{__('Date Created')}}</b></h6>
                                       </div>
                                       <div class="card-table37">
                                          <h6 class="m-0 text-right"><b>{{__('Last Activity')}}</b></h6>
                                       </div>
                                       <div class="card-table38">
                                          <h6 class="m-0 text-right"><b>Status</b></h6>
                                       </div>
                                    </div>
                                    <?php if(!empty($ticketdetails)) {
                                       foreach($ticketdetails as $value) {
                                    ?>      
                                    <div class="table-responsive-card ">
                                       <div class="card-table34">
                                          <p class="m-0 text-right">{{$value['user_id']}}</p>
                                       </div>
                                       <div class="card-table35">
                                          <p class="m-0 text-right"><a href="{{url('ticketdetail',$value['id'])}}" class="theme-color"><u>{{$value['desciption']}}</u></a></p>
                                       </div>
                                       <div class="card-table36">
                                          <p class="m-0 text-right">{{date('d/m/Y h:i A',strtotime($value['created_at']))}}</p>
                                       </div>
                                       <div class="card-table37">
                                          <p class="m-0 text-right">1 day ago</p>
                                       </div>
                                       <div class="card-table38">
                                          <div class="dropdown">
                                            <button class="badge w-100 badge-warning p-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              OPEN
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              <a class="dropdown-item" href="#">OPEN</a>
                                              <a class="dropdown-item" href="#">{{__('SUCCESSFUL')}}</a>
                                            </div>
                                          </div>
                                       </div>
                                    </div>
                                    <?php } } ?>
                                    <!-- <div class="table-responsive-card ">
                                       <div class="card-table34">
                                          <p class="m-0 text-right">DH626EN602</p>
                                       </div>
                                       <div class="card-table35">
                                          <p class="m-0 text-right"><a href="{{ url('ticketdetail') }}" class="theme-color"><u>Cannot sign in on my account after changing email adress</u></a></p>
                                       </div>
                                       <div class="card-table36">
                                          <p class="m-0 text-right">26-08-2021</p>
                                       </div>
                                       <div class="card-table37">
                                          <p class="m-0 text-right">1 day ago</p>
                                       </div>
                                       <div class="card-table38">
                                          <div class="dropdown">
                                            <button class="badge w-100 badge-info p-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{__('SUCCESSFUL')}}L
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              <a class="dropdown-item" href="#">OPEN</a>
                                              <a class="dropdown-item" href="#">{{__('SUCCESSFUL')}}L</a>
                                            </div>
                                          </div>
                                       </div>
                                    </div> -->
                                    <!-- <div class="table-responsive-card ">
                                       <div class="card-table34">
                                          <p class="m-0 text-right">DH626EN602</p>
                                       </div>
                                       <div class="card-table35">
                                          <p class="m-0 text-right"><a href="{{ url('ticketdetail') }}" class="theme-color"><u>Cannot sign in on my account after changing email adress</u></a></p>
                                       </div>
                                       <div class="card-table36">
                                          <p class="m-0 text-right">26-08-2021</p>
                                       </div>
                                       <div class="card-table37">
                                          <p class="m-0 text-right">1 day ago</p>
                                       </div>
                                       <div class="card-table38">
                                          <div class="dropdown">
                                            <button class="badge w-100 badge-info p-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{__('SUCCESSFUL')}}L
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              <a class="dropdown-item" href="#">OPEN</a>
                                              <a class="dropdown-item" href="#">{{__('SUCCESSFUL')}}L</a>
                                            </div>
                                          </div>
                                       </div>
                                    </div> -->
                                    <!-- <div class="table-responsive-card ">
                                       <div class="card-table34">
                                          <p class="m-0 text-right">DH626EN602</p>
                                       </div>
                                       <div class="card-table35">
                                          <p class="m-0 text-right"><a href="{{ url('ticketdetail') }}" class="theme-color"><u>Cannot sign in on my account after changing email adress</u></a></p>
                                       </div>
                                       <div class="card-table36">
                                          <p class="m-0 text-right">26-08-2021</p>
                                       </div>
                                       <div class="card-table37">
                                          <p class="m-0 text-right">1 day ago</p>
                                       </div>
                                       <div class="card-table38">
                                          <div class="dropdown">
                                            <button class="badge w-100 badge-info p-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{__('SUCCESSFUL')}}L
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              <a class="dropdown-item" href="#">OPEN</a>
                                              <a class="dropdown-item" href="#">{{__('SUCCESSFUL')}}L</a>
                                            </div>
                                          </div>
                                       </div>
                                    </div> -->
                                    <!-- <div class="table-responsive-card ">
                                       <div class="card-table34">
                                          <p class="m-0 text-right">DH626EN602</p>
                                       </div>
                                       <div class="card-table35">
                                          <p class="m-0 text-right"><a href="{{ url('ticketdetail') }}" class="theme-color"><u>Cannot sign in on my account after changing email adress</u></a></p>
                                       </div>
                                       <div class="card-table36">
                                          <p class="m-0 text-right">26-08-2021</p>
                                       </div>
                                       <div class="card-table37">
                                          <p class="m-0 text-right">1 day ago</p>
                                       </div>
                                       <div class="card-table38">
                                          <div class="dropdown">
                                            <button class="badge w-100 badge-info p-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{__('SUCCESSFUL')}}L
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              <a class="dropdown-item" href="#">OPEN</a>
                                              <a class="dropdown-item" href="#">{{__('SUCCESSFUL')}}L</a>
                                            </div>
                                          </div>
                                       </div>
                                    </div> -->
                                    <!-- <div class="table-responsive-card ">
                                       <div class="card-table34">
                                          <p class="m-0 text-right">DH626EN602</p>
                                       </div>
                                       <div class="card-table35">
                                          <p class="m-0 text-right"><a href="{{ url('ticketdetail') }}" class="theme-color"><u>Cannot sign in on my account after changing email adress</u></a></p>
                                       </div>
                                       <div class="card-table36">
                                          <p class="m-0 text-right">26-08-2021</p>
                                       </div>
                                       <div class="card-table37">
                                          <p class="m-0 text-right">1 day ago</p>
                                       </div>
                                       <div class="card-table38">
                                          <div class="dropdown">
                                            <button class="badge w-100 badge-info p-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{__('SUCCESSFUL')}}L
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              <a class="dropdown-item" href="#">OPEN</a>
                                              <a class="dropdown-item" href="#">{{__('SUCCESSFUL')}}L</a>
                                            </div>
                                          </div>
                                       </div>
                                    </div> -->
                                    <!-- <div class="table-responsive-card ">
                                       <div class="card-table34">
                                          <p class="m-0 text-right">DH626EN602</p>
                                       </div>
                                       <div class="card-table35">
                                          <p class="m-0 text-right"><a href="{{ url('ticketdetail') }}" class="theme-color"><u>Cannot sign in on my account after changing email adress</u></a></p>
                                       </div>
                                       <div class="card-table36">
                                          <p class="m-0 text-right">26-08-2021</p>
                                       </div>
                                       <div class="card-table37">
                                          <p class="m-0 text-right">1 day ago</p>
                                       </div>
                                       <div class="card-table38">
                                          <div class="dropdown">
                                            <button class="badge w-100 badge-info p-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{__('SUCCESSFUL')}}L
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              <a class="dropdown-item" href="#">OPEN</a>
                                              <a class="dropdown-item" href="#">{{__('SUCCESSFUL')}}L</a>
                                            </div>
                                          </div>
                                       </div>
                                    </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="text-right create-ticket-button-col">
                              <button class="btn btn-warning btn-sm mt-3 create-new-ticket">+ Create New Ticket</button>
                           </div>
                        </div>
                     </div>
                     <div class="create-ticket-new-row mt-3">
                        <div class="row">
                           <form class="mt-3" action="{{url('submit-ticket')}}" method="post">
                              @csrf
                           <div class="col-12">
                              <div class="card">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="form-group">
                                       <label class="d-block text-right"><small>Subject</small></label>
                                       <input type="text" name="title" class="form-control border">
                                    </div>
                                 </div>

                                 <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="form-group">
                                       <label class="d-block text-right"><small>Choose Department</small></label>
                                       <select class="form-control border bg-gray" name="department">
                                          <option>Tech Support</option>
                                          <option>Sales</option>
                                          <option>Billing</option>
                                       </select>
                                    </div>
                                 </div>

                                 <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="form-group">
                                       <label class="d-block text-right"><small>Attachment</small></label>
                                       <div class="upload-btn-wrapper">
                                          <button class="file-upload-button">Choose File</button>
                                          <input type="file" name="image" />
                                          No file chosen
                                       </div>
                                       <label class="d-block text-right"><small>(Alowed File Extensions: .jpg, .gif, jpeg, .png)</small></label>
                                    </div>
                                 </div>

                                 <div class="col-12">
                                    <div class="form-group">
                                       <label class="d-block text-right"><small>Message</small></label>
                                       <textarea class="form-control border" rows="4" name="description"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <button class="btn btn-sm close-ticket">Cancel</button>
                                    <button type="submit" class="btn btn-warning btn-sm submit-ticket">Submit</button>
                                 </div>
                                 </div>
                              </div>
                           </div>
                            
                           </div> </form>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="knowledge">
                     
                     <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <p class="text-right m-0 mt-3 font-weight-bold theme-color"><b>Advice and answers from the Team</b></p>
                            <div class="{{__('Help')}}-form mb-5">
                              <div class="{{__('Help')}}-form-col2">
                                 <button class="btn bgn-hlp-form"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="{{__('Help')}}-form-col1">
                                 <input type="text" class="form-control m-0" placeholder="Search">
                              </div>
                           </div>
                           <!--{{ url('knowledgedetail') }}-->
                           <?php if(!empty($details)){ 
                                foreach($details as $val) {
                              ?>
                            <a href="javascript:void(0);" class="mt32" id="one">
                           <div class="base-{{__('Help')}}-row mt-3">
                              <div class="{{__('Help')}}-row-col1">
                                 <span class="shadow"><i class="fas fa-check-circle"></i></span>
                              </div>
                              <div class="{{__('Help')}}-row-col2">
                                 <h6 class="m-0"><b>{{$val->title}}</b></h6>
                                 <p class="m-0">{{$val->description}}</p>
                              </div>
                           </div>
                           </a>
                           <?php } } ?>
                           <!--{{ url('knowledgedetail') }}-->
                        <!-- <a href="javascript:void(0);" class="mt32" id="two">
                           <div class="base-{{__('Help')}}-row mt-3">
                              <div class="{{__('Help')}}-row-col1">
                                 <span class="shadow"><i class="fas fa-desktop"></i></span>
                              </div>
                              <div class="{{__('Help')}}-row-col2">
                                 <h6 class="m-0"><b>Dashboards & Templates</b></h6>
                                 <p class="m-0">Learn how to visualize data, configure dashboards and use pre configure templates that wow</p>
                              </div>
                           </div>
                        </a> -->
                        <!--{{ url('knowledgedetail') }}-->
                        <!-- <a href="javascript:void(0);" class="mt32" id="three">
                           <div class="base-{{__('Help')}}-row mt-3">
                              <div class="{{__('Help')}}-row-col1">
                                 <span class="shadow"><i class="fas fa-users"></i></span>
                              </div>
                              <div class="{{__('Help')}}-row-col2">
                                 <h6 class="m-0"><b>User Management</b></h6>
                                 <p class="m-0">Bring your sta on board and get them access to the insight to drive performance</p>
                              </div>
                           </div>
                        </a> -->
                        <!--{{ url('knowledgedetail') }}-->
                        <!-- <a href="javascript:void(0);" class="mt32" id="four">
                           <div class="base-{{__('Help')}}-row mt-3">
                              <div class="{{__('Help')}}-row-col1">
                                 <span class="shadow"><i class="fas fa-sync"></i></span>
                              </div>
                              <div class="{{__('Help')}}-row-col2">
                                 <h6 class="m-0"><b>Connections & Data</b></h6>
                                 <p class="m-0">Learn more about setting up connections in Afdal Analytics and how data is collected.</p>
                              </div>
                           </div>
                        </a> -->
                        <!--{{ url('knowledgedetail') }}-->
                        <!-- <a href="javascript:void(0);" class="mt32" id="five">
                           <div class="base-{{__('Help')}}-row mt-3">
                              <div class="{{__('Help')}}-row-col1">
                                 <span class="shadow"><i class="fas fa-cog"></i></span>
                              </div>
                              <div class="{{__('Help')}}-row-col2">
                                 <h6 class="m-0"><b>Managing your Subscription</b></h6>
                                 <p class="m-0">Learn how to administrate your accounts, access invoices and more</p>
                              </div>
                           </div>
                        </a> -->
                        </div>
                        <div class="col-lg-8 col-sm-6 col-12">
                           <div class="default">
                               <img src="https://www.pinclipart.com/picdir/big/51-514779_social-media-vector-graphics-clipart.png" width="100%" height="100%" style="max-width:700px;">
                           </div>
                           <div class="one" style="display:none;">
                               <div class="listFlow">
                                   <a href="javascript:void(0);" class="cc"><i class="fas fa-times"></i></a>
                                   <div class="scrolled">
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>1. Import your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>2. Explore your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>3. Map your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>4. Use your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>5. Leverage your positions</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="two" style="display:none;">
                               <div class="listFlow">
                                   <a href="javascript:void(0);" class="cc"><i class="fas fa-times"></i></a>
                                   <div class="scrolled">
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>1. Import your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>2. Explore your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>3. Map your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>4. Use your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>5. Leverage your positions</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="three" style="display:none;">
                               <div class="listFlow">
                                   <a href="javascript:void(0);" class="cc"><i class="fas fa-times"></i></a>
                                   <div class="scrolled">
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>1. Import your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>2. Explore your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>3. Map your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>4. Use your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>5. Leverage your positions</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="four" style="display:none;">
                               <div class="listFlow">
                                   <a href="javascript:void(0);" class="cc"><i class="fas fa-times"></i></a>
                                   <div class="scrolled">
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>1. Import your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>2. Explore your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>3. Map your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>4. Use your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>5. Leverage your positions</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="five" style="display:none;">
                               <div class="listFlow">
                                   <a href="javascript:void(0);" class="cc"><i class="fas fa-times"></i></a>
                                   <div class="scrolled">
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>1. Import your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>2. Explore your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>3. Map your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>4. Use your data</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
                                           </div>
                                       </div>
                                       <div class="dataList">
                                           <div class="bor-bottom">
                                               <h3 class="f16"><b>5. Leverage your positions</b></h3>
                                               <p class="f12">Easy steps for setting up your Afdal Analytics account and learning your way around</p>
                                               <p class="dtime"><img src="https://icon-library.com/images/user-png-icon/user-png-icon-10.jpg" class="imgFloat"> Written by Jon Doe, 02-11-2021</p>
                                           </div>
                                           <div class="dataMore">
                                                <p>
                                                   Get a walkthrough of Funnel by Mike and Alexandra from our Customer Success team. In just 20 minutes, they'll take you through the basics of Funnel to help you get started. 
                                                </p>
                                                <p>
                                                   This is a great opportunity to learn about the platform if you’re a new Funnel user, or just wanting to brush up on some of the basics of Funnel. We give you a high-level overview of the platform so that you feel more comfortable with the core features of Funnel, and help you get started working with the tool. 
                                                </p>
                                                <h3 class="hh">What we’ll cover</h3>
                                                <p>
                                                    Navigating Through Afdal 
                                                </p>
                                                <p> Importing Your Data </p>
                                                <p>Exploring Your Data</p>
                                                <p>Exporting & Using Your Data</p>
                                                <p>When looking at the Data Source dimension in the Data Explorer you'll see one row for each of your data sources.</p>
                                                <p>Since each row represents a data source, some metrics only have values for some rows. Cost, for instance, is pulled from your ad accounts and not from Google Analytics, which is why rows showing Google Analytics data sources do not show any cost. </p>
                                                <p>The same logic explains why Sessions, which is a metric pulled from Google Analytics, can't be shown on rows for ad platform data sources. Understanding your raw data Analyzing your data per, for example, traffic source, market, or campaign with the data from the various data sources mapped together requires teaching Funnel how to think of your data.</p> 
                                                <p>This is done by creating dimensions, which we cover in another article. However, before creating dimensions it is useful to look into the raw data to understand what data you have available and how it looks. </p>
                                                <p>Hitting the "Fields" button above the table opens up the fields selector which lets you choose what you want as rows in the table. Under the headline "Data Source" you'll find the segmentations your raw data comes with. </p>
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
   </main>
</div>
@endsection