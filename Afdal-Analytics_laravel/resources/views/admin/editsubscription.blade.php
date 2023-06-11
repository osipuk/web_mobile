@extends('layout.admin.header')

@section('title', 'Afdal Analytics Customer Support')

@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Subscription Plan</h4>
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
                           <form action="{{ url('update-subscription-plan') }}" method="post" enctype="multipart/form-data" class="mainform">
                              @csrf
                              <div class="row">
                                 <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">Package Name</label>
                                       <input type="text" name="package_name" value="{{$subscription_details->package_name}}" class="form-control" required="">
                                       <input type="hidden" name="id" value="{{$subscription_details->id}}">
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">Package Ammout</label>
                                       <input type="text" name="package_amount" value="{{$subscription_details->package_amount}}" class="form-control" required="">
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">Package Duration (In Days)</label>
                                       <input type="text" name="package_duration" value="{{$subscription_details->package_duration}}" class="form-control" required="">
                                    </div>
                                 </div>
                                 <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">Package Short Description</label>
                                       <textarea class="form-control" name="package_short_description" value="{{$subscription_details->package_short_description}}" rows="5">{{$subscription_details->package_short_description}}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">Package Long Description</label>
                                       <textarea class="form-control" name="package_long_description" value="{{$subscription_details->package_long_description}}" rows="5">{{$subscription_details->package_long_description}}</textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="text-right">
                                 <button type="submit" class="btn btn-primary">Save Change</button>
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