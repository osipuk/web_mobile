@extends('layout.admin.header')
@section('title', 'Afdal Analytics Customer Support')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor">News Feed</h4>
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
            <div class="card">
               <div class="card-body">
                  <div class="toparea">
                     <div class="texttitle2">
                        <h3 class="card-title"><small>Create a new post</small> <span class="float-right"><small><a href="{{ url('newsfeed') }}">Back</a></small></span></h3>
                     </div>
                  </div>
                  <div class="card shadow rounded-5 mt-3">
                     <div class="card-body">
                        <form action="{{ url('add-newsfeeds') }}" method="post" enctype="multipart/form-data" class="mainform">
                           @csrf
                           <div class="row">
                              <div class="col-lg-12 col-sm-12 col-12">
                                 <div class="form-group">
                                    <label class="control-label font-weight-bold">Post Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Post Title" required="">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-8 col-sm-8 col-12">
                                 <div class="form-group">
                                    <label class="control-label font-weight-bold">Desctiption</label>
                                    <textarea name="editor1" class="form-control" required=""></textarea>
                                 </div>
                              </div>
                              <div class="col-lg-4 col-sm-4 col-12">
                                 <label class="control-label font-weight-bold">Image</label>
                                 <input type="file" name="image" class="dropify"   required=""/>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="text-right">
                                    <div class="form-group text-right">
                                       <button name="btn" value="draft" type="submit" class="btn btn-outline-dark">Save Draft</button>
                                       <button name="btn" value="publish" type="submit" class="btn btn-primary"><i class="fas fa-check-circle mr-2"></i>Publish</button>
                                    </div>
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
   </div>
</div>
@endsection