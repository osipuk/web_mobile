@extends('layout.admin.header')



@section('title', 'Afdal Analytics Customer Support')



@section('content')



<div class="page-wrapper wrap10">

   <div class="container-fluid">

      <div class="row page-titles">

         <div class="col-md-5 align-self-center">

            <h4 class="text-themecolor">Payment Gateway</h4>

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

         <div class="col-lg-12 col-xlg-12 col-md-12">

            <div class="card rounded-5 shadow">

               <!-- Nav tabs -->

               <ul class="nav nav-tabs profile-tab" role="tablist">

                  <li class="nav-item"> <a class="nav-link active font-weight-bold" data-toggle="tab" href="#stripe" role="tab">Stripe</a> </li>

                  <li class="nav-item"> <a class="nav-link font-weight-bold" data-toggle="tab" href="#paypal" role="tab">PayPal</a> </li>

               </ul>

               <!-- Tab panes -->

               <div class="tab-content">

                  <div class="tab-pane active" id="stripe" role="tabpanel">

                     <div class="card-body">

                         <form action="{{ url('save-payment-gateway-setting') }}" method="post" enctype="multipart/form-data" class="form-horizontal">

                              @csrf   

                           <div class="row">

                              <div class="col-12">

                                 <div class="form-group">

                                    <h4>Stripe Gateway Setting</h4>

                                 </div>

                              </div>

                           </div>

                           <div class="row">

                               <?php

                                 if($stripe_details){

                                   $stripe_id = $stripe_details->id; 

                                   $stripe_username = $stripe_details->username; 

                                   $stripe_password = $stripe_details->password; 

                                   $stripe_api_signature = $stripe_details->api_signature; 

                                   $currency = $stripe_details->currency; 

                                   $stripe_status = $stripe_details->status;  

                                 }else{

                                   $stripe_id = ''; 

                                   $stripe_username = ''; 

                                   $stripe_password = ''; 

                                   $stripe_api_signature = ''; 

                                   $currency = ''; 

                                   $stripe_status = ''; 

                                 }

                                 ?>

                              <div class="col-lg-6 col-sm-6 col-12">

                                 <div class="form-group">

                                    <label class="font-weight-bold">Stripe API Username</label>

                                    <input type="text" class="form-control" name="username" value="{{$stripe_username}}" required="">

                                    <input type="hidden" class="form-control" name="type" value="stripe">

                                    <input type="hidden" class="form-control" name="id" value="{{$stripe_id}}">

                                 </div>

                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">

                                 <div class="form-group">

                                    <label class="font-weight-bold">Stripe API Password</label>

                                    <input type="text" name="password" class="form-control" value="{{$stripe_password}}" required="">

                                 </div>

                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">

                                 <div class="form-group">

                                    <label class="font-weight-bold">Stripe API Signature</label>

                                    <input type="text" name="api_signature" class="form-control" value="{{$stripe_api_signature}}" required="">

                                 </div>

                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">

                                 <div class="form-group">

                                    <label class="font-weight-bold">Stripe Status</label>

                                    <select class="form-control" name="status" required="">

                                       <option value="1"<?php  if($stripe_status == "1"){echo "selected";}?>>Active</option>

                                       <option value="0"<?php  if($stripe_status == "0"){echo "selected";}?>>Inactive</option>

                                    </select>

                                 </div>

                              </div>

                               <div class="col-lg-6 col-sm-6 col-12">

                                 <div class="form-group">

                                    <label class="font-weight-bold">Stripe Currency</label>

                                    <input type="text" name="currency" class="form-control" value="{{$currency}}" required="">

                                 </div>

                              </div>

                           </div>

                           <div class="form-group text-right">

                              <button type="submit" class="btn btn-success ml-0">Save Changes</button>

                           </div>

                        </form>

                     </div>

                  </div>

                  <div class="tab-pane" id="paypal" role="tabpanel">

                     <div class="card-body">

                        <form action="{{ url('save-payment-gateway-setting') }}" method="post" enctype="multipart/form-data" class="form-horizontal">

                              @csrf  

                           <div class="row">

                              <div class="col-12">

                                 <div class="form-group">

                                    <h4>PayPal Gateway Setting</h4>

                                 </div>

                              </div>

                           </div>

                           <div class="row">

                               <?php

                                 if($paypal_details){

                                   $paypal_id = $paypal_details->id; 

                                   $paypal_username = $paypal_details->username; 

                                   $paypal_password = $paypal_details->password; 

                                   $paypal_api_signature = $paypal_details->api_signature; 

                                   $currency = $paypal_details->currency; 

                                   $paypal_status = $paypal_details->status;  

                                 }else{

                                   $paypal_id = ''; 

                                   $paypal_username = ''; 

                                   $paypal_password = ''; 

                                   $paypal_api_signature = ''; 

                                   $currency = ''; 

                                   $paypal_status = ''; 

                                 }

                                 ?>

                              <div class="col-lg-6 col-sm-6 col-12">

                                 <div class="form-group">

                                    <label class="font-weight-bold">PayPal API Username</label>

                                     <input type="text" class="form-control" name="username" value="{{$paypal_username}}" required="">

                                    <input type="hidden" class="form-control" name="type" value="paypal">

                                    <input type="hidden" class="form-control" name="id" value="{{$paypal_id}}">

                                 </div>

                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">

                                 <div class="form-group">

                                    <label class="font-weight-bold">PayPal API Password</label>

                                    <input type="text" name="password"  class="form-control" value="{{$paypal_password}}" required="">

                                 </div>

                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">

                                 <div class="form-group">

                                    <label class="font-weight-bold">PayPal API Signature</label>

                                    <input type="text" name="api_signature" class="form-control" value="{{$paypal_api_signature}}" required="">

                                 </div>

                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">

                                 <div class="form-group">

                                    <label class="font-weight-bold">PayPal Status</label>

                                    <select class="form-control" name="status" required="">

                                       <option value="1"<?php  if($paypal_status == "1"){echo "selected";}?>>Active</option>

                                       <option value="0"<?php  if($paypal_status == "0"){echo "selected";}?>>Inactive</option>

                                    </select>

                                 </div>

                              </div>

                              <div class="col-lg-6 col-sm-6 col-12">

                                 <div class="form-group">

                                    <label class="font-weight-bold">PayPal Currency</label>

                                    <input type="text" name="currency" class="form-control" value="{{$currency}}" required="">

                                 </div>

                              </div>

                           </div>

                           <div class="form-group text-right">

                              <button type="submit" class="btn btn-success ml-0">Save Changes</button>

                           </div>

                        </form>

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

   </div>

</div>



@endsection