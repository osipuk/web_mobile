@extends('layout.admin.header')



@section('title', 'Afdal Analytics Customer Support')



@section('content')

<div class="page-wrapper wrap10">

   <div class="container-fluid">

      <div class="row page-titles">

         <div class="col-md-5 align-self-center">

            <h4 class="text-themecolor">Website Setting</h4>

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

                           <form action="{{ url('add-website-settings') }}" method="post" enctype="multipart/form-data" class="mainform">

                              @csrf       

                              <div class="row">

                                   <?php

                                    if($details){

                                      $id = $details->id; 

                                      $logo = $details->website_logo; 

                                      $copyright_content = $details->copyright_content; 

                                      $address = $details->address; 

                                      $address_google_link = $details->address_google_link; 

                                      $contact_details = $details->contact_details; 

                                    }else{

                                      $id = ''; 

                                      $logo = ''; 

                                      $copyright_content = ''; 

                                      $address = ''; 

                                      $address_google_link = ''; 

                                      $contact_details = ''; 

                                    }

                                 ?>

                                 <div class="col-md-12 col-12">

                                    <div class="form-group">

                                       <label class="control-label font-weight-bold">Change Logo</label>

                                       <?php if(!empty($logo)){ ?>

                                       <input type="file" name="logo" class="dropify" data-default-file="{{url('images/website_settings').'/'.$logo;}}" />

                                       <?php }else{ ?> 

                                       <input type="file" name="logo" class="dropify" data-default-file="{!!asset('public/assets/assets/images/logoicon.png')!!}" />

                                       <?php } ?>

                                    </div>

                                 </div>



                                 

                                 <div class="col-md-4 col-12">

                                    <div class="form-group">

                                       <label class="control-label font-weight-bold">Copyright Content</label>

                                       <input type="text" name="copyright_content" class="form-control" value="{{$copyright_content}}" required="">

                                        <input type="hidden" name="id" class="form-control" value="{{$id}}">

                                    </div>

                                 </div>

                                 



                                 <div class="col-md-4 col-12">

                                    <div class="form-group">

                                       <label class="control-label font-weight-bold">Address</label>

                                       <input type="text" name="address" class="form-control" value="{{$address}}" required="" >

                                    </div>

                                 </div>



                                 <div class="col-md-4 col-12">

                                    <div class="form-group">

                                       <label class="control-label font-weight-bold">Address Google Link</label>

                                       <input type="text" name="address_google_link" value="{{$address_google_link}}" class="form-control" > 

                                    </div>

                                 </div>



                                 <div class="col-md-12 col-12">

                                    <div class="form-group">

                                       <label class="control-label font-weight-bold">Contact Detail</label>

                                       <textarea name="editor1" value="{{$contact_details}}" class="form-control">{{$contact_details}}</textarea>

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