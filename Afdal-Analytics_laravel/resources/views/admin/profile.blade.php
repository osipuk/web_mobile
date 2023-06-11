@extends('layout.admin.header')

@section('title', 'Afdal Analytics Customer Support')

@section('content')

<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Profile</h4>
         </div>
      </div>
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
         <!-- Column -->
         <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card rounded-5 shadow">
               <div class="card-body">
                  <center class="m-t-30">
                     <?php if(!empty($details->profile_picture)){ ?>
                         <img src="{{url('images/'.$details->profile_picture)}}" class="img-circle" width="150" />
                      <?php }else{ ?>
                     <img src="{!!asset('public/assets/assets/images/users/5.jpg')!!}" class="img-circle" width="150" />
                  <?php } ?>
                     <h4 class="card-title m-t-10">Afdal Analytics</h4>
                     <h6 class="card-subtitle">Owner</h6>

                  </center>
               </div>
               <div>
                  <!--<hr>-->
               </div>
               <!--<div class="card-body">-->
               <!--   <small class="text-muted">Email address </small>-->
               <!--   <h6>{{$details->email}}</h6>-->
               <!--   <small class="text-muted p-t-30 db">Phone</small>-->
               <!--   <h6>{{$details->mobile}}</h6>-->

               <!--</div>-->
            </div>
         </div>
         <!-- Column -->
         <!-- Column -->
         <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card rounded-5 shadow">
               <!-- Nav tabs -->
               <ul class="nav nav-tabs profile-tab" role="tablist">
                  <li class="nav-item"> <a class="nav-link active font-weight-bold" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>
                  <li class="nav-item"> <a class="nav-link font-weight-bold" data-toggle="tab" href="#change-password" role="tab">Change Password</a> </li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div class="tab-pane active" id="profile" role="tabpanel">
                     <div class="card-body" id="profile-detail-toggle">
                        <div class="row">
                           <div class="col-md-12 col-xs-12 b-r">
                              <strong class="font-weight-bold">{{__('Full Name')}}</strong>
                              <br>
                              <p class="text-muted">{{$details->name}}</p>
                           </div>
                           <div class="col-md-12 col-xs-12 b-r">
                              <strong class="font-weight-bold">Mobile</strong>
                              <br>
                              <p class="text-muted">{{$details->mobile}}</p>
                           </div>
                           <div class="col-md-12 col-xs-12 b-r">
                              <strong class="font-weight-bold">Email</strong>
                              <br>
                              <p class="text-muted">{{$details->email}}</p>
                           </div>
                           <div class="col-12">
                              <div class="text-right">
                                 <button class="btn btn-primary" id="toggle-profile-btn">Edit Profile</button>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="card-body " id="profile-edit-toggle" style="display: none;">
                         <form action="{{ url('update-profile') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                              @csrf
                        <div class="row">
                           <div class="col-md-12 col-xs-12 b-r">
                              <label class="font-weight-bold">{{__('Full Name')}}</label>
                              <div class="form-group">
                                 <input type="text" name="full_name" class="form-control" value="{{$details->name}}">
                              </div>

                           </div>
                           <div class="col-md-12 col-xs-12 b-r">
                              <label class="font-weight-bold">Mobile</label>
                              <div class="form-group">
                                 <input type="text" name="mobile" class="form-control" value="{{$details->mobile}}">
                              </div>
                           </div>
                           <div class="col-md-12 col-xs-12 b-r">
                              <label class="font-weight-bold">Email</label>
                              <div class="form-group">
                                 <input type="email" class="form-control" value="{{$details->email}}" readonly="">
                              </div>
                           </div>

                           <div class="col-md-12 col-xs-12 b-r">
                              <label class="font-weight-bold">Profile Picture</label>
                              <div class="form-group">
                                 <input type="file" name="profile_picture" class="form-control" value="{{$details->profile_picture}}">
                              </div>
                           </div>

                           <div class="col-12">
                              <div class="text-right">
                                 <button type="submit" class="btn btn-primary">Save Change</button>
                                 <button class="btn btn-outline-dark" id="show-detail-toggle">Cancel</button>
                              </div>
                           </div>
                        </div>
                     </form>
                     </div>
                  </div>
                  <div class="tab-pane" id="change-password" role="tabpanel">
                     <div class="card-body">
                        <form action="{{ url('change-password') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                              @csrf
                           <div class="form-group">
                              <label class="col-md-12 font-weight-bold">Old Password</label>
                              <div class="col-md-12">
                                 <input type="password" placeholder="Old Password" class="form-control" name="old_password" required="">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-12 font-weight-bold">New Password</label>
                              <div class="col-md-12">
                                 <input type="password" name="new_password" placeholder="New Password" class="form-control" required="">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-12 font-weight-bold">Confirm Password</label>
                              <div class="col-md-12">
                                 <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required="">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-sm-12 text-right">
                                 <button type="submit" class="btn btn-primary">Update Password</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Column -->
      </div>
   </div>
</div>

@endsection
