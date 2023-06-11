@extends('layout.admin.header')
@section('title', 'Afdal Analytics knowledge base')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Support</h4>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
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
                     <div class="col-md-12">
                        <div class="register-box-body">
                           <div class="card shadow rounded-5 mt-3">
                              <div class="card-body">
                                 <form id="add_form" action="{{asset('submit-support')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="form-group has-feedback">
                                             <lable></lable>
                                             <h5>Department name - <b>{{@$getData['0']['department']}} </b></h5>
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="form-group has-feedback">
                                             <select id="status" class="form-control" name="status" >
                                             <option value="1"@if(@$getData['0']['status']=='1') selected @endif>Open</option>
                                             <option value="2" @if(@$getData['0']['status']=='2') selected @endif>Successful</option>
                                             <option  value="3" @if(@$getData['0']['status']=='3') selected @endif>Open Ticket</option>
                                             <option  value="4" @if(@$getData['0']['status']=='4') selected @endif>Pending Ticket</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="form-group has-feedback">
                                             <textarea name="description" class="form-control sumnote" id="description" cols="60" rows="5" placeholder="Short Description">{!! @$getData['0']['description'] !!}</textarea>
                                             <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                          </div>
                                       </div>
                                    </div>
                                    <input type="hidden" id="table_id" value="{{@$getData['0']['id']}}" name="table_id">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <button type="submit" class="btn btn-success btn-block btn-flat mb-3">Submit</button>
                                       </div>
                                       <!-- /.col -->
                                       <div class="col-md-6">
                                          <a href="{{asset('support')}}" class="btn btn-primary btn-block btn-flat">Back</a>
                                       </div>
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
   </div>
</div>
@endsection