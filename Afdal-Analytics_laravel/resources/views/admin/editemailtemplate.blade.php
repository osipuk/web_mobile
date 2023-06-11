@extends('layout.admin.header')



@section('title', 'Afdal Analytics Customer Support')



@section('content')

<div class="page-wrapper wrap10">

   <div class="container-fluid">

      <div class="row page-titles">

         <div class="col-md-5 align-self-center">

            <h4 class="text-themecolor">Template</h4>

         </div>

      </div>

      <div class="row">

         <div class="col-12">

            <div class="card rounded-5 shadow">

               <div class="card-body">

                  <form class="form-horizontal">

                     <div class="row">

                        <div class="col-12">

                           <div class="form-group">

                              <label class="font-weight-bold">Template Name</label>

                              <input type="text" class="form-control">

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

                        <button class="btn btn-success ml-0">Submit</button>

                     </div>

                  </form>

               </div>

            </div>

         </div>

      </div>

   </div>

</div>

@endsection