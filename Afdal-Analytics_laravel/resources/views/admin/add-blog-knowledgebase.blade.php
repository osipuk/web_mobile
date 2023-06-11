@extends('layout.admin.header')
@section('title', 'Afdal Analytics knowledge base')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">knowledge base blog</h4>
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
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-12">
                  <div class="register-box-body">
                     <div class="card shadow rounded-5 mt-3">
                        <div class="card-body">
                           <form id="add_form" action="{{asset('submit-blog-knowledgebase')}}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                       <lable></lable>
                                       <h5>Knowledge Base </h5>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                       <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="Enter title">
                                       <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                       <textarea name="description" id="description" class="form-control" cols="60" rows="5" placeholder="Short Description">{{old('description')}}</textarea>
                                       <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                 </div>
                              </div>
                              <input type="hidden" id="table_id" value="{{@$getData['0']['id']}}" name="table_id">
                              <div class="row">
                                 <!-- /.col -->
                                 <div class="col-md-6">
                                    <input type="hidden" class="form-control" id="knowledge_id" name="knowledge_id" value="{{@$knowledgeId}}" placeholder="Enter title">
                                    <button type="submit" class="btn btn-success btn-block btn-flat mb-3">Submit</button>
                                 </div>
                                 <div class="col-md-6">
                                    <a href="{{asset('knowledge_base')}}" class="btn btn-primary btn-block btn-flat">Back</a>
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
@endsection