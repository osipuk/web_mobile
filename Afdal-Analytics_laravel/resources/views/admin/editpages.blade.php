@extends('layout.admin.header')

@section('title', 'Afdal Analytics Customer Support')

@section('content')

<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Edit Pages</h4>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card rounded-5 shadow">
               <div class="card-body">
                  <form class="form-horizontal">
                     <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                           <div class="form-group">
                              <label class="font-weight-bold">Title</label>
                              <input type="text" class="form-control" value="Privacy Policy">
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group">
                              <label class="font-weight-bold">Description</label>
                              <textarea name="editor1" class="form-control"></textarea> 
                           </div>
                        </div>
                     </div>
                     <div class="form-group text-right">
                        <button class="btn btn-primary ml-0">Save Change</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection