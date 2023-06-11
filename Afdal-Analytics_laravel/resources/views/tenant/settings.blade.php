@extends('layout.userhead')
@section('title', 'User Home')
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
      Launch demo modal
      </button> -->
      <style>
          .dataCard {
    text-align: right;
}
.dataCard h3 {
    font-size: 18px;
}
.dataCard p {
    margin-bottom: 6px;
}
.dataCard button {
    font-size: 12px!important;
    padding: 6px 14px!important;
}
input.form-control.w-25.m-0 {
    width: 25%;
    flex: 0 0 auto;
    border-radius: 6px 0px 0px 6px;
}
span#basic-addon2 {
    background: #f48a1d;
    border-color: #f48a1d;
    color: #ffffff;
    border-radius: 0px 6px 6px 0px;
}
.p2{padding:2rem;}
.myH{
    color:#0B243A;font-size: 24px;margin-bottom:16px;
}
#shN{
    box-shadow:none;
    border: 1px solid #8797AF;
    border-radius: 10px;
}
.Hhead{
        color: #0B243A;
    margin-bottom: 16px;
    font-size:22px;
}
.Hhead i{
        color: #F58B1E;
    font-size: 24px;
    margin-left: 10px;
}
.modal-dialog .modal-content{padding:16px;}
#myBtn{
    border-radius: 10px;
    background:#E4EAF2;
    padding:10px 22px;
    color: #0B243A;
    font-size:18px;
    text-align:center;
    display: inline-block;
    margin-top: 12px;
}

button.submitBtn {
    border-radius: 6px;
    background: #FCDDC1;
    width: 86px;
    height: 42px;
    padding: 8px 16px;
    text-align: center;
    color: #fff;
    margin-right: 12px;
    font-size: 18px;
}
i.fas.fa-lock {
    color: #fcddc1;
    font-size: 18px;
}
.pyFont {
    font-size: 37px;
    margin-right: 16px;
}
      </style>
<div class="page-wrapper chiller-theme toggled">
   @section('content')
   @extends('layout.usersidenav')
   <main class="page-content pb-5">
      <div class="container-fluid">
         <nav class="navbar navbar-expand-lg bg-transparent user-navbar pl-0 pr-0">
            <div class="container-fluid">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item head-list-heading">
                     {{__('Settings')}}
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
                              <a class="nav-link active" data-toggle="tab" href="#my-Profile">{{__('Profile')}}</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#billing">{{__('Billing')}}</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#users">{{__('Users')}}</a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="tab-content">
                        <div class="tab-pane active" id="my-{{__('Profile')}}">
                           <div class="row">
                              <div class="col-lg-5 col-sm-5 col-12">
                                 <form class="mt-3" action="{{url('update-tenant-profile')}}" method="post">
                                  @csrf
                                    <div class="card mt-3 text-center">
                                       
                                       <div class="card-body">
                                           <div class="row">
                                               <div class="col-md-12">
                                                   <p class="text-center"><b>{{__('Account')}}</b></p>
                                               </div>
                                               <div class="col-md-12 text-center mb-3">
                                                   <img src="https://afdalanalytics.com/AfdalAnalytics/public/assets/image/user.jpg" class="rounded-circle" height="40" width="40">
                                               </div>
                                           </div>
                                          <div class="row">
                                             <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                   <label class="d-block text-right"><small>{{__('First Name')}}</small></label>
                                                   <input type="text" name="first_name" class="form-control font-weight-bold border" value="{{$userdetails->first_name}}">
                                                </div>
                                             </div>
                                             <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                   <label class="d-block text-right"><small>{{__('Last Name')}}</small></label>
                                                   <input type="text" name="last_name" class="form-control font-weight-bold border" value="{{$userdetails->last_name}}">
                                                </div>
                                             </div>
                                             <!--<div class="col-lg-6 col-sm-6 col-12">-->
                                             <!--   <div class="form-group">-->
                                             <!--      <label class="d-block text-right"><small>{{__('Language')}}</small></label>-->
                                             <!--      <select class="form-control bg-gray font-weight-bold border">-->
                                             <!--         <option selected>{{__('Arabic (AR)')}}</option>-->
                                             <!--         <option>English</option>-->
                                             <!--         <option>Hindi</option>-->
                                             <!--      </select>-->
                                             <!--   </div>-->
                                             <!--</div>-->
                                             <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                   <label class="d-block text-right"><small>{{__('Country')}}</small></label>
                                                   <select class="form-control bg-gray font-weight-bold border" name="country">
                                                      <option selected disabled>Select Country</option>
                                                      <option value="Qatar"<?php if($userdetails->country == 'Qatar'){echo "selected";}?>>Qatar</option>
                                                      <option value="India"<?php if($userdetails->country == 'India'){echo "selected";}?>>India</option>
                                                   </select>
                                                </div>
                                             </div>
                                             <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                   <label class="d-block text-right"><small>{{__('City')}}</small></label>
                                                   <input type="text" name="city" class="form-control font-weight-bold border" value="{{$userdetails->city}}">
                                                </div>
                                             </div>
                                             <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                   <label class="d-block text-right"><small>{{__('Street Address')}}</small></label>
                                                   <input type="text" name="street_address" class="form-control font-weight-bold border" value="{{$userdetails->street_address}}">
                                                </div>
                                             </div>
                                             <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                   <label class="d-block text-right"><small>{{__('Postal Code')}}</small></label>
                                                   <input type="text" name="postal_code" class="form-control font-weight-bold border" value="{{$userdetails->postal_code}}">
                                                </div>
                                             </div>
                                             <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                   <label class="d-block text-right"><small>{{__('Phone Number')}}</small></label>
                                                   <input type="text" name="phone_number" class="form-control font-weight-bold border" value="{{$userdetails->phone_number}}">
                                                </div>
                                             </div>
                                             <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                   <label class="d-block text-right"><small>{{__('Email')}}</small></label>
                                                   <input type="email" name="email" class="form-control font-weight-bold border" value="{{$userdetails->email}}" readonly>
                                                </div>
                                             </div>
                                             <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                   <label class="d-block text-right"><small>{{__('Timezone')}}</small></label>
                                                   <input type="text" name="timezone" class="form-control font-weight-bold border" value="{{$userdetails->timezone}}">
                                                </div>
                                             </div>
                                             <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                   <label class="d-block text-right"><small>{{__('website')}}</small></label>
                                                   <input type="text" name="website_url" class="form-control font-weight-bold border" value="{{$userdetails->website_url}}">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-md mt-3">{{__('Save')}}</button>
                                 </form>
                              </div>
                              <div class="col-lg-7 col-sm-7 col-12">
                                  <img src="https://i.pinimg.com/originals/af/62/54/af62541ac50cef5395ab2e04187a69bb.png" class="img-fluid">
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="billing">
                           <!--<div class="row">-->
                           <!--   <div class="col-lg-4 col-sm-6 col-12">-->
                           <!--      <div class="card my-template mt-3 text-center">-->
                           <!--         <div class="card-header bg-gray text-right"><b>{{__('BILLING & PAYMENT')}}</b></div>-->
                           <!--         <div class="card-body">-->
                           <!--            <div class="payment-setting">-->
                           <!--               <div class="p-setting-1">-->
                           <!--                  <p class="text-center m-0"><b><i class="fab fa-paypal"></i></b></p>-->
                           <!--               </div>-->
                           <!--               <div class="p-setting-2">-->
                           <!--                  <p class="text-right m-0">{{__('PayPal')}}</p>-->
                           <!--               </div>-->
                           <!--            </div>-->
                           <!--            <div class="payment-setting">-->
                           <!--               <div class="p-setting-1">-->
                           <!--                  <p class="text-center m-0"><b><i class="fas fa-calendar-week"></i></b></p>-->
                           <!--               </div>-->
                           <!--               <div class="p-setting-2">-->
                           <!--                  <p class="text-right m-0">{{__('$100/month Next payment on Oct. 13,2021 Annual plan, paid monthly')}}</p>-->
                           <!--               </div>-->
                           <!--            </div>-->
                           <!--         </div>-->
                           <!--      </div>-->
                           <!--      <button class="btn btn-theme-color mt-3 btn-sm" data-toggle="modal" data-target="#exampleModal4">{{__('Edit billing and payment')}}</button>-->
                           <!--   </div>-->
                           <!--   <div class="col-lg-4 col-sm-6 col-12">-->
                           <!--      <div class="card my-template mt-3 text-center">-->
                           <!--         <div class="card-header bg-gray text-right"><b>{{__('YOUR SUBSCRIPTION')}}</b></div>-->
                           <!--         <div class="card-body">-->
                           <!--            <div class="payment-setting">-->
                           <!--               <div class="p-setting-1">-->
                           <!--                  <p class="text-center m-0"><b>L</b></p>-->
                           <!--               </div>-->
                           <!--               <div class="p-setting-2">-->
                           <!--                  <p class="text-right m-0">{{__('SOLO')}}</p>-->
                           <!--               </div>-->
                           <!--            </div>-->
                           <!--            <div class="payment-setting">-->
                           <!--               <div class="p-setting-1">-->
                           <!--                  <p class="text-center m-0"><b><i class="fas fa-boxes"></i></b></p>-->
                           <!--               </div>-->
                           <!--               <div class="p-setting-2">-->
                           <!--                  <p class="text-right m-0">{{__('Data Connections 1')}}</p>-->
                           <!--               </div>-->
                           <!--            </div>-->
                           <!--            <div class="payment-setting">-->
                           <!--               <div class="p-setting-1">-->
                           <!--                  <p class="text-center m-0"><b><i class="fas fa-user"></i></b></p>-->
                           <!--               </div>-->
                           <!--               <div class="p-setting-2">-->
                           <!--                  <p class="text-right m-0">{{__('User 1')}}</p>-->
                           <!--               </div>-->
                           <!--            </div>-->
                           <!--         </div>-->
                           <!--      </div>-->
                           <!--      <button class="btn btn-theme-color mt-3 btn-sm" data-toggle="modal" data-target="#exampleModal">{{__('Edit Subscription')}}</button>-->
                           <!--   </div>-->
                           <!--</div>-->
                           <div class="row">
                              <div class="col-12 col-md-9">
                                 <div class="card card-table mt-5">
                                    <div class="card-body">
                                        <div class="text-right mb-3"><b>{{__('BILLING HISTORY')}}</b></div>
                                       <div class="top-city-scroller dhashbord-table-Team">
                                          <div class="table-responsive-card border-0">
                                             <div class="card-table14">
                                                <h6 class="m-0 text-right"><b>{{__('Name')}}</b></h6>
                                             </div>
                                             <div class="card-table15">
                                                <h6 class="m-0 text-right"><b>{{__('Transaction')}}</b></h6>
                                             </div>
                                             <div class="card-table16">
                                                <h6 class="m-0 text-right"><b>{{__('Amount')}}</b></h6>
                                             </div>
                                             <div class="card-table17">
                                                <h6 class="m-0 text-right"><b>{{__('Date Created')}}</b></h6>
                                             </div>
                                             <div class="card-table18">
                                                <h6 class="m-0 text-right"><b>{{__('Transaction ID')}}</b></h6>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">{{__('Monthly Base Subscription Payment')}}</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">{{__('Monthly Base Subscription Payment')}}</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">{{__('Monthly Base Subscription Payment')}}</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">{{__('Monthly Base Subscription Payment')}}</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table14">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table15">
                                                <p class="m-0 text-right">Monthly Base Subscription Payment</p>
                                             </div>
                                             <div class="card-table16">
                                                <p class="m-0 text-right">$39.00</p>
                                             </div>
                                             <div class="card-table17">
                                                <p class="m-0 text-right">25-06-2021 </p>
                                             </div>
                                             <div class="card-table18">
                                                <p class="m-0 text-right">DH626EN602 <a href="#" class="mr-5"><i class="fas fa-file"></i></a> <span class="badge badge-info mr-3 p-2">{{__('SUCCESSFUL')}}</span></p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!--<button class="btn btn-theme-color btn-sm mt-3">View All Invoice</button>-->
                              </div>
                               <div class="col-md-3 col-12 mt-5">
                                   <div class="dataCard mb-3">
                                       <h3>Your Subscription</h3>
                                       <p>Solo Package</p>
                                       <p>Data Connections 1</p>
                                       <p>Users 1</p>
                                       <button class="btn btn-theme-color mt-3 btn-sm" data-toggle="modal" data-target="#exampleModal">{{__('Edit Subscription')}}</button>
                                   </div>
                                   <div class="dataCard">
                                       <h3>Billing & Payment</h3>
                                       <p>Paypal</p>
                                       <p>$100/month<br/> Next payment on Oct. 13,2021 <br/>Annual plan, paid monthly</p>
                                       <button class="btn btn-theme-color mt-3 btn-sm" data-toggle="modal" data-target="#exampleModal4">{{__('Edit billing and payment')}}</button>
                                   </div>
                               </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="users">
                           <div class="row">
                              <div class="col-lg-5 col-sm-12 col-12">
                                 <div class="card mt-3">
                                    <div class="card-header bg-gray text-right" style="background:#ffffff;border:none;">
                                       <b>Team Details</b>
                                    </div>
                                    <div class="card-body">
                                       <p class="text-right"><b style="color: #f48a1d;">Users Assigned 5/5 </b></p>
                                       <div class="row">
                                          <div class="col-lg-6 col-sm-6 col-12">
                                             <p class="text-right mb-0" style="color:#000000;"><b>: Current team </b></p>
                                             <p class="text-right mb-0" style="color:#000000;"><b>: Signed in as </b></p>
                                             <p class="text-right mb-0" style="color:#000000;"><b>: Role </b></p>
                                             <p class="text-right mb-0" style="color:#000000;"><b>: Team ID </b></p>
                                             <p class="text-right mb-0" style="color:#000000;"><b>: Joined </b></p>
                                          </div>
                                          <div class="col-lg-6 col-sm-6 col-12">
                                             <p class="text-right mb-0" style="color:#000000;">Team Name </p>
                                             <p class="text-right mb-0" style="color:#000000;">user@gmail.com </p>
                                             <p class="text-right mb-0" style="color:#000000;">Owner </p>
                                             <p class="text-right mb-0" style="color:#000000;">MNG623NH </p>
                                             <p class="text-right mb-0" style="color:#000000;">17-06-2020</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-7 col-sm-12 col-12">
                                 <div class="card card-table mt-3">
                                    <div class="card-header bg-gray text-right" style="background:#ffffff;border:none;"><b>Latest Activity</b></div>
                                    <div class="card-body">
                                       <div class="top-city-scroller dhashbord-table-Team" style="height:145px;">
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
                                 <a href="{{ url ('latestactivity')}}" class="btn btn-warning btn-sm mt-3">View All</a>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="card card-table mt-5">
                                    <div class="card-header bg-gray" style="background:#ffffff;border:none;display:flex;align-items: center;">
                                        <span class="float-right ml-3" style="width: 70px;text-align: right;"><b>User List</b></span>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input type="text" class="form-control w-25 m-0" name="" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                       <div class="top-city-scroller dhashbord-table-Team">
                                          <div class="table-responsive-card border-0">
                                             <div class="card-table7">
                                                <h6 class="m-0 text-right"><b>Personal Information</b></h6>
                                             </div>
                                             <div class="card-table8">
                                                <h6 class="m-0 text-right"><b>Email</b></h6>
                                             </div>
                                             <div class="card-table9">
                                                <h6 class="m-0 text-right"><b>Job Position</b></h6>
                                             </div>
                                             <div class="card-table10">
                                                <h6 class="m-0 text-right"><b>Location</b></h6>
                                             </div>
                                             <div class="card-table11">
                                                <h6 class="m-0 text-right"><b>Role</b></h6>
                                             </div>
                                             <div class="card-table12">
                                                <h6 class="m-0 text-right"><b>{{__('Date Created')}}</b></h6>
                                             </div>
                                             <div class="card-table13">
                                                <h6 class="m-0 text-right"><b>User ID</b></h6>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table7">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table8">
                                                <p class="m-0 text-right">namesurname@email.com</p>
                                             </div>
                                             <div class="card-table9">
                                                <p class="m-0 text-right">Manager</p>
                                             </div>
                                             <div class="card-table10">
                                                <p class="m-0 text-right">Dubai</p>
                                             </div>
                                             <div class="card-table11">
                                                <p class="m-0 text-right">Admin</p>
                                             </div>
                                             <div class="card-table12">
                                                <p class="m-0 text-right">25-06-2021 21:20</p>
                                             </div>
                                             <div class="card-table13">
                                                <p class="m-0 text-right">DH626EN602 <span class="ml-3"><a href="#" class="mr-3"><i class="fas fa-trash"></i></a> <a href="#" class="mr-3"><i class="fas fa-cog"></i></a></span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table7">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table8">
                                                <p class="m-0 text-right">namesurname@email.com</p>
                                             </div>
                                             <div class="card-table9">
                                                <p class="m-0 text-right">Manager</p>
                                             </div>
                                             <div class="card-table10">
                                                <p class="m-0 text-right">Dubai</p>
                                             </div>
                                             <div class="card-table11">
                                                <p class="m-0 text-right">Admin</p>
                                             </div>
                                             <div class="card-table12">
                                                <p class="m-0 text-right">25-06-2021 21:20</p>
                                             </div>
                                             <div class="card-table13">
                                                <p class="m-0 text-right">DH626EN602 <span class="ml-3"><a href="#" class="mr-3"><i class="fas fa-trash"></i></a> <a href="#" class="mr-3"><i class="fas fa-cog"></i></a></span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table7">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table8">
                                                <p class="m-0 text-right">namesurname@email.com</p>
                                             </div>
                                             <div class="card-table9">
                                                <p class="m-0 text-right">Manager</p>
                                             </div>
                                             <div class="card-table10">
                                                <p class="m-0 text-right">Dubai</p>
                                             </div>
                                             <div class="card-table11">
                                                <p class="m-0 text-right">Admin</p>
                                             </div>
                                             <div class="card-table12">
                                                <p class="m-0 text-right">25-06-2021 21:20</p>
                                             </div>
                                             <div class="card-table13">
                                                <p class="m-0 text-right">DH626EN602 <span class="ml-3"><a href="#" class="mr-3"><i class="fas fa-trash"></i></a> <a href="#" class="mr-3"><i class="fas fa-cog"></i></a></span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table7">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table8">
                                                <p class="m-0 text-right">namesurname@email.com</p>
                                             </div>
                                             <div class="card-table9">
                                                <p class="m-0 text-right">Manager</p>
                                             </div>
                                             <div class="card-table10">
                                                <p class="m-0 text-right">Dubai</p>
                                             </div>
                                             <div class="card-table11">
                                                <p class="m-0 text-right">Admin</p>
                                             </div>
                                             <div class="card-table12">
                                                <p class="m-0 text-right">25-06-2021 21:20</p>
                                             </div>
                                             <div class="card-table13">
                                                <p class="m-0 text-right">DH626EN602 <span class="ml-3"><a href="#" class="mr-3"><i class="fas fa-trash"></i></a> <a href="#" class="mr-3"><i class="fas fa-cog"></i></a></span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table7">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table8">
                                                <p class="m-0 text-right">namesurname@email.com</p>
                                             </div>
                                             <div class="card-table9">
                                                <p class="m-0 text-right">Manager</p>
                                             </div>
                                             <div class="card-table10">
                                                <p class="m-0 text-right">Dubai</p>
                                             </div>
                                             <div class="card-table11">
                                                <p class="m-0 text-right">Admin</p>
                                             </div>
                                             <div class="card-table12">
                                                <p class="m-0 text-right">25-06-2021 21:20</p>
                                             </div>
                                             <div class="card-table13">
                                                <p class="m-0 text-right">DH626EN602 <span class="ml-3"><a href="#" class="mr-3"><i class="fas fa-trash"></i></a> <a href="#" class="mr-3"><i class="fas fa-cog"></i></a></span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table7">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table8">
                                                <p class="m-0 text-right">namesurname@email.com</p>
                                             </div>
                                             <div class="card-table9">
                                                <p class="m-0 text-right">Manager</p>
                                             </div>
                                             <div class="card-table10">
                                                <p class="m-0 text-right">Dubai</p>
                                             </div>
                                             <div class="card-table11">
                                                <p class="m-0 text-right">Admin</p>
                                             </div>
                                             <div class="card-table12">
                                                <p class="m-0 text-right">25-06-2021 21:20</p>
                                             </div>
                                             <div class="card-table13">
                                                <p class="m-0 text-right">DH626EN602 <span class="ml-3"><a href="#" class="mr-3"><i class="fas fa-trash"></i></a> <a href="#" class="mr-3"><i class="fas fa-cog"></i></a></span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table7">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table8">
                                                <p class="m-0 text-right">namesurname@email.com</p>
                                             </div>
                                             <div class="card-table9">
                                                <p class="m-0 text-right">Manager</p>
                                             </div>
                                             <div class="card-table10">
                                                <p class="m-0 text-right">Dubai</p>
                                             </div>
                                             <div class="card-table11">
                                                <p class="m-0 text-right">Admin</p>
                                             </div>
                                             <div class="card-table12">
                                                <p class="m-0 text-right">25-06-2021 21:20</p>
                                             </div>
                                             <div class="card-table13">
                                                <p class="m-0 text-right">DH626EN602 <span class="ml-3"><a href="#" class="mr-3"><i class="fas fa-trash"></i></a> <a href="#" class="mr-3"><i class="fas fa-cog"></i></a></span></p>
                                             </div>
                                          </div>
                                          <div class="table-responsive-card">
                                             <div class="card-table7">
                                                <p class="m-0 text-right">John Doe</p>
                                             </div>
                                             <div class="card-table8">
                                                <p class="m-0 text-right">namesurname@email.com</p>
                                             </div>
                                             <div class="card-table9">
                                                <p class="m-0 text-right">Manager</p>
                                             </div>
                                             <div class="card-table10">
                                                <p class="m-0 text-right">Dubai</p>
                                             </div>
                                             <div class="card-table11">
                                                <p class="m-0 text-right">Admin</p>
                                             </div>
                                             <div class="card-table12">
                                                <p class="m-0 text-right">25-06-2021 21:20</p>
                                             </div>
                                             <div class="card-table13">
                                                <p class="m-0 text-right">DH626EN602 <span class="ml-3"><a href="#" class="mr-3"><i class="fas fa-trash"></i></a> <a href="#" class="mr-3"><i class="fas fa-cog"></i></a></span></p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <button class="btn btn-warning btn-sm mt-3" data-toggle="modal" data-target="#add-new-user">{{__('Add New User')}}</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
      </div>
   </main>
</div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <span class="modal-header-fle1" data-dismiss="modal" aria-label="Close" style="color:#F58B1E;">
                      <!--<img src="{!!asset('public/assets/image/homelogo.jpg')!!}" height="40" width="40" class="rounded">-->
                      <i class="fas fa-arrow-right"></i> Back
                     </span>
                  <span class="modal-header-fle2">
                     <h5 class="modal-title text-center font-weight-bold m-0" id="exampleModalLabel">{{__('Manage payment method')}}</h5>
                  </span>
                  <span class="modal-header-fle3">
                  <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </span>
               </div>
               <div class="modal-body p2">
                  <div class="row">
                     <div class="col-lg-6 col-sm-6 col-12">
                        <h6 class="font-weight-bold text-right myH"><b>{{__('Available Actions')}}</b></h6>
                        <div class="card" id="shN">
                           <div class="card-body">
                              <div class="base-help-row">
                                 <div class="help-row-col22">
                                    <h6 class="font-weight-bold Hhead"><i class="fas fa-search"></i> <b>{{__('Find a Better Plan')}}</b> </h6>
                                    <p class="m-0">Not enough connections in your plan? Let us help you find the right plan for your needs, and make the switch quick and easy.</p>
                                    <a href="{{ url('upgradeplan') }}" id="myBtn">{{__('Change')}}</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card mt-3">
                           <div class="card-body" id="shN">
                              <div class="base-help-row">
                                 <div class="help-row-col22">
                                    <h6 class="font-weight-bold Hhead"> <i class="fas fa-times"></i> <b>{{__('End Your Subscription')}}</b></h6>
                                    <p class="m-0">Sometimes you just need to call it quits. We get it, and would love to have you back. Make sure to keep an eye out on our offers!</p>
                                    <button id="myBtn">{{__('End Service')}}</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-sm-6 col-12">
                        <h6 class="font-weight-bold text-right myH"<b>{{__('Your Subscription')}}</b></h6>
                        <div class="card" id="shN">
                           <div class="card-body text-right">
                              <h6 class="font-weight-bold text-right Hhead">{{__('Afdal Analytics Sole Plan')}} <img src="{!!asset('public/assets/image/homelogo.jpg')!!}" height="40" width="40" class="rounded float-left"></h6>
                              <p class="m-0" id="f16">{{__('Commitment')}}</p>
                              <p id="f20"><b>{{__('Annual plan, paid monthly')}}</b></p>
                              <p class="m-0" id="f16">{{__('*Next regular payment')}}</p>
                              <p id="f20"><b>(incl tax) $545/mo <br/> October 15, 2021</b></p>
                              <hr>
                              <p id="f17" class="m-0">{{__('*Requires use with only one account')}} <i class="fas fa-info-circle"></i></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <span class="modal-header-fle1"><img src="{!!asset('public/assets/image/homelogo.jpg')!!}" height="40" width="40" class="rounded"></span>
                  <span class="modal-header-fle2">
                     <h5 class="modal-title text-center font-weight-bold m-0" id="exampleModalLabel">{{__('Manage payment method')}}</h5>
                  </span>
                  <span class="modal-header-fle3">
                  <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </span>
               </div>
               <div class="modal-body bg-gray">
                  <p class="text-right"><a href="#" class="text-warning"><i class="fas fa-arrow-right ml-2"></i>{{__('Back')}}</a></p>
                  <div class="row">
                     <div class="col-lg-6 col-sm-6 col-12">
                        <h6 class="font-weight-bold text-right"><b>{{__('Add payment method')}}</b></h6>
                        <div class="card">
                           <div class="card-body text-right">
                              <form>
                                 <div class="form-group mb-1">
                                    <select class="form-control bg-gray">
                                       <option>{{__('Credit/debit card')}}</option>
                                       <option>{{__('Net Banking')}}</option>
                                       <option>{{__('UPI')}}</option>
                                    </select>
                                 </div>

                                 <div class="form-group mb-1">
                                    <label class="m-0">{{__('Credit/debit card number')}}</label>
                                    <input type="text" class="form-control">
                                 </div>

                                 <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="form-group mb-1">
                                          <label class="m-0">{{__('Expiration month')}}</label>
                                          <select class="form-control">
                                             <option>Select</option>
                                             <option>Option 1</option>
                                             <option>Option 2</option>
                                          </select>
                                       </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="form-group mb-1">
                                          <label class="m-0">{{__('Expiration year')}}</label>
                                          <select class="form-control">
                                             <option>Select</option>
                                             <option>Option 1</option>
                                             <option>Option 2</option>
                                          </select>
                                       </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="form-group mb-1">
                                          <label class="m-0">{{__('First Name')}}</label>
                                          <input type="text" class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="form-group mb-1">
                                          <label class="m-0">{{__('Last Name')}}</label>
                                          <input type="text" class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="form-group mb-1">
                                          <label class="m-0">{{__('Country')}}</label>
                                          <select class="form-control bg-gray">
                                             <option>Qatar</option>
                                             <option>Option 1</option>
                                             <option>Option 2</option>
                                          </select>
                                       </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="form-group mb-1">
                                          <label class="m-0">{{__('Postel Code')}}</label>
                                          <input type="text" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group mb-1">
                                    <p class="m-0">{{__('Optional Information')}}</p>
                                    <label class="m-0">{{__('Company Name')}}</label>
                                    <input type="text" class="form-control">
                                 </div>

                                 <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="form-group mb-1">
                                          <label class="m-0">{{__('VAT ID')}}</label>
                                          <input type="text" class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="form-group mb-1 text-left pt-3">
                                          <button class="btn bg-gray font-weight-bold btn-sm m-0">{{__('Save')}}</button><span class="mr-3"><i class="fas fa-lock text-warning mt-2" style="font-size:25px"></i></span>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-sm-6 col-12">
                        <h6 class="font-weight-bold text-right"><b>{{__('YOUR SUBSCRIPTION')}}</b></h6>
                        <div class="card">
                           <div class="card-body text-right">
                              <h6 class="font-weight-bold text-right"><img src="{!!asset('public/assets/image/homelogo.jpg')!!}" height="40" width="40" class="rounded ml-3"> {{__('Afdal Analytics Sole Plan')}}</h6>
                              <p class="m-0">{{__('Commitment')}}</p>
                              <p><b>{{__('Annual plan, paid monthly')}}</b></p>
                              <p class="m-0">{{__('*Next regular payment')}}</p>
                              <p><b>$545/mo (incl tax) October 15, 2021</b></p>
                              <hr>
                              <p class="m-0">{{__('*Requires use with only one account')}} <i class="fas fa-info-circle"></i></p>
                           </div>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <span class="modal-header-fle1"><img src="{!!asset('public/assets/image/homelogo.jpg')!!}" height="40" width="40" class="rounded"></span>
                  <span class="modal-header-fle2">
                     <h5 class="modal-title text-center font-weight-bold m-0" id="exampleModalLabel">{{__('Manage payment method')}}</h5>
                  </span>
                  <span class="modal-header-fle3">
                  <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </span>
               </div>
               <div class="modal-body bg-gray">
                  <p class="text-right"><a href="#" class="text-warning"><i class="fas fa-arrow-right ml-2"></i>{{__('Back')}}</a></p>
                  <div class="row">
                     <div class="col-lg-6 col-sm-6 col-12">
                        <h6 class="font-weight-bold text-right"><b>{{__('Edit payment method')}}</b></h6>
                        <div class="card">
                           <div class="card-body text-right">
                              <p class="text-left text-warning">{{__('Switch PayPal accounts')}} <br>{{__('Edit Payment Details')}} <img src="{!!asset('public/assets/image/paypal.png')!!}" class="float-right" style="height: 30px; margin-top: -10px;"></p>
                              <form>
                                 <h6 class="text-right m-0">{{__('You are signed into PayPal As')}}</h6>
                                 <p class="text-right"><b>seid@gmail.com</b></p>
                                 <div class="form-group mb-1">
                                    <p class="m-0">{{__('Optional Information')}}</p>
                                    <label class="m-0">{{__('Company Name')}}</label>
                                    <input type="text" class="form-control">
                                 </div>

                                 <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="form-group mb-1">
                                          <label class="m-0">{{__('VAT ID')}}</label>
                                          <input type="text" class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                       <div class="form-group mb-1 text-left pt-3">
                                          <button class="btn bg-gray font-weight-bold btn-sm m-0">{{__('Save')}}</button><span class="mr-3"><i class="fas fa-lock text-warning mt-2" style="font-size:25px"></i></span>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-sm-6 col-12">
                        <h6 class="font-weight-bold text-right"><b>{{__('YOUR SUBSCRIPTION')}}</b></h6>
                        <div class="card">
                           <div class="card-body text-right">
                              <h6 class="font-weight-bold text-right">{{__('Afdal Analytics Sole Plan')}} <img src="{!!asset('public/assets/image/homelogo.jpg')!!}" height="40" width="40" class="rounded float-left"></h6>
                              <p class="m-0">{{__('Commitment')}}</p>
                              <p><b>{{__('Annual plan, paid monthly')}}</b></p>
                              <p class="m-0">{{__('*Next regular payment')}}</p>
                              <p><b>$545/mo (incl tax) October 15, 2021</b></p>
                              <hr>
                              <p class="m-0">{{__('*Requires use with only one account')}} <i class="fas fa-info-circle"></i></p>
                           </div>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <span class="modal-header-fle1" data-dismiss="modal" aria-label="Close" style="color:#F58B1E;">
                      <!--<img src="{!!asset('public/assets/image/homelogo.jpg')!!}" height="40" width="40" class="rounded">-->
                      <i class="fas fa-arrow-right"></i> Back
                     </span>
                  <span class="modal-header-fle2">
                     <h5 class="modal-title text-center font-weight-bold m-0" id="exampleModalLabel">{{__('Manage payment method')}}</h5>
                  </span>
                  <span class="modal-header-fle3">
                  <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </span>
               </div>
               <div class="modal-body p2">
                  <div class="row">
                     <div class="col-lg-6 col-sm-6 col-12">
                        <h6 class="font-weight-bold text-right myH"><b>{{__('Edit Payment Method')}}</b></h6>
                        <form class="billingForm">
                            <div class="row">
                                <div class="col-md-6 col-xs-12 form-group">
                                    <select class="form-control bg-gray font-weight-bold border">
                                        <option selected="" disabled="">Select Method</option>
                                        <option>PayPal</option>
                                        <option>Visa Card</option>
                                        <option>Master Card</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <i class="fab fa-cc-paypal pyFont"></i> <i class="fab fa-cc-mastercard pyFont"></i> <i class="fab fa-cc-visa pyFont"></i>
                                </div>
                                <div class="col-12 form-group">
                                    <label class="text-right" style="width:100%;">Card Number</label>
                                    <input id="cc" class="form-control"  type="text" name="creditcard"  placeholder="XXXX XXXX XXXX XXXX">
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label class="text-right" style="width:100%;">Expiration Date</label>
                                    <input type="text" class="form-control"  id="inputExpDate"  placeholder="MM / YY"    maxlength='7'>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label class="text-right" style="width:100%;">Security Code</label>
                                    <input type="password" class="cvv form-control" placeholder="CVV">
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label class="text-right" style="width:100%;">First Name</label>
                                    <input type="text" class="form-control" placeholder="John">
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label class="text-right" style="width:100%;">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Doe">
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label class="text-right" style="width:100%;">Country</label>
                                    <select class="form-control bg-gray font-weight-bold border">
                                        <option selected="" disabled="">Select Country</option>
                                        <option>Qatar</option>
                                        <option>India</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label class="text-right" style="width:100%;">Postal Code</label>
                                    <input type="text" class="form-control" placeholder="117">
                                </div>
                                <div class="col-md-12 form-group">
                                    <h3 class="text-right" style="font-size:15px;">Optional Information</h3>
                                </div>
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label class="text-right" style="width:100%;">Company Name</label>
                                    <input type="text" class="form-control" placeholder="ACME Limited">
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label class="text-right" style="width:100%;">VAT ID</label>
                                    <input type="text" class="form-control" placeholder="XXX-XXX">
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label class="text-right" style="width:100%;">&nbsp;</label>
                                     <i class="fas fa-lock"></i> <button class="submitBtn">Save </button>
                                </div>
                            </div>
                        </form>
                     </div>
                     <div class="col-lg-6 col-sm-6 col-12">
                        <h6 class="font-weight-bold text-right myH"<b>{{__('Your Subscription')}}</b></h6>
                        <div class="card" id="shN">
                           <div class="card-body text-right">
                              <h6 class="font-weight-bold text-right Hhead">{{__('Afdal Analytics Sole Plan')}} <img src="{!!asset('public/assets/image/homelogo.jpg')!!}" height="40" width="40" class="rounded float-left"></h6>
                              <p class="m-0" id="f16">{{__('Commitment')}}</p>
                              <p id="f20"><b>{{__('Annual plan, paid monthly')}}</b></p>
                              <p class="m-0" id="f16">{{__('*Next regular payment')}}</p>
                              <p id="f20"><b>(incl tax) $545/mo <br/> October 15, 2021</b></p>
                              <hr>
                              <p id="f17" class="m-0">{{__('*Requires use with only one account')}} <i class="fas fa-info-circle"></i></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade" id="add-new-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <span class="modal-header-fle1"><img src="{!!asset('public/assets/image/homelogo.jpg')!!}" height="40" width="40" class="rounded"></span>
                  <span class="modal-header-fle2">
                     <h5 class="modal-title text-center font-weight-bold m-0" id="exampleModalLabel">{{__('Add New User')}}</h5>
                  </span>
                  <span class="modal-header-fle3">
                  <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </span>
               </div>
               <div class="modal-body bg-gray">
                  <div class="row">
                     <div class="col-12">
                        <form>
                           <div class="row">
                              <div class="col-lg-6 col-sm-6 col-12">
                                 <div class="form-group">
                                    <label><small>{{__('First Name')}}</small></label>
                                    <input type="text" class="form-control">
                                 </div>
                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">
                                 <div class="form-group">
                                    <label><small>{{__('Last Name')}}</small></label>
                                    <input type="text" class="form-control">
                                 </div>
                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">
                                 <div class="form-group">
                                    <label><small>{{__('Email')}}</small></label>
                                    <input type="text" class="form-control">
                                 </div>
                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">
                                 <div class="form-group">
                                    <label><small>{{__('Job Position')}}</small></label>
                                    <input type="text" class="form-control">
                                 </div>
                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">
                                 <div class="form-group">
                                    <label><small>{{__('Location')}}</small></label>
                                    <input type="text" class="form-control">
                                 </div>
                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">
                                 <div class="form-group">
                                    <label><small>{{__('Role')}}</small></label>
                                    <select class="form-control">
                                       <option>{{__('Admin')}}</option>
                                       <option>{{__('User')}}</option>
                                    </select>
                                 </div>
                              </div>

                              <div class="col-12">
                                 <div class="form-group text-right">
                                    <button class="btn btn-warning btn-sm">{{__('Submit')}}</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection