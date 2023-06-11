@extends('layout.admin.header')
@section('title', 'Afdal Analytics Customer Support')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">SMTP Setting</h4>
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
         <div class="col-12">
            <div class="card rounded-5 shadow">
               <div class="card-body">
                  <div class="row">
                     <div class="col-12">
                        <div class="email-form">
                           <form action="{{ url('save-smtp-setting') }}" method="post" enctype="multipart/form-data" class="mainform">
                              @csrf
                              <div class="row">
                                 <?php
                                    if($details){
                                    
                                      $id = $details->id; 
                                    
                                      $smtp_server_host = $details->smtp_server_host; 
                                    
                                      $smtp_port_number = $details->smtp_port_number; 
                                    
                                      $smtp_username = $details->smtp_username; 
                                    
                                      $smtp_password = $details->smtp_password; 
                                    
                                      $email_encryption_type = $details->email_encryption_type; 
                                    
                                    }else{
                                    
                                      $id = ''; 
                                    
                                      $smtp_server_host = ''; 
                                    
                                      $smtp_port_number = ''; 
                                    
                                      $smtp_username = ''; 
                                    
                                      $smtp_password = ''; 
                                    
                                      $email_encryption_type = ''; 
                                    
                                    }
                                    
                                    ?>
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">SMTP Server Host</label>
                                       <input type="text" name="smtp_server_host" class="form-control" value="{{$smtp_server_host}}" required="">
                                       <input type="hidden" name="id" class="form-control" value="{{$id}}">
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">SMTP Port Number</label>
                                       <input type="text" name="smtp_port_number" class="form-control" value="{{$smtp_port_number}}" required="">
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">SMTP User Name</label>
                                       <input type="text" name="smtp_username" class="form-control" value="{{$smtp_username}}" required="">
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">SMTP Password</label>
                                       <input type="text" name="smtp_password" class="form-control" value="{{$smtp_password}}" required="">
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">Email Encryption Type</label>
                                       <select name="email_encryption_type" class="form-control" required="">
                                          <option value="SMTP"<?php  if($email_encryption_type === "SMTP"){echo "selected";}?>>SMTP</option>
                                          <option value="TLS"<?php  if($email_encryption_type === "TLS"){echo "selected";}?>>TLS</option>
                                          <option value="None"<?php  if($email_encryption_type === "None"){echo "selected";}?>>None</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="text-right">
                                 <button type="submit" class="btn btn-success">Save Change</button>
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
</div>
@endsection