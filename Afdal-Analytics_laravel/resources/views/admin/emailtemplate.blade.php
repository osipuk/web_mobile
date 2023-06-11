@extends('layout.admin.header')

@section('title', 'Afdal Analytics Customer Support')

@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Email Template</h4>
         </div>
        
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="table-responsive mt-3 rounded-5 shadow">
                     <table id="config-table" class="table display no-wrap" width="100%">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th >Name</th>
                              <th>Action</th>
                              
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>1</td>
                              <td>Registration</td>
                              <td><a href="{{ url('edit-email-template') }}"><i class="fas fa-edit"></i></a></td>
                           </tr>

                           <tr>
                              <td>2</td>
                              <td>Registration</td>
                              <td><a href="{{ url('edit-email-template') }}"><i class="fas fa-edit"></i></a></td>
                           </tr>

                           <tr>
                              <td>3</td>
                              <td>Registration</td>
                              <td><a href="{{ url('edit-email-template') }}"><i class="fas fa-edit"></i></a></td>
                           </tr>

                           <tr>
                              <td>4</td>
                              <td>Registration</td>
                              <td><a href="{{ url('edit-email-template') }}"><i class="fas fa-edit"></i></a></td>
                           </tr>

                           <tr>
                              <td>5</td>
                              <td>Registration</td>
                              <td><a href="{{ url('edit-email-template') }}"><i class="fas fa-edit"></i></a></td>
                           </tr>

                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
