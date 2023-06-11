@extends('layout.admin.header')
@section('title', 'Afdal Analytics Customer Support')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Subscription</h4>
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
                        <h3 class="card-title"><small>Subscription</small> <span class="float-right"><small><a  href="{{ url('create-subscription') }}">+ Create Subscription</a></small></span></h3>
                     </div>
                  </div>
                  <div class="table-responsive mt-3 rounded-5 shadow">
                     <table id="config-table" class="table display no-wrap" width="100%">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Package Name</th>
                              <th>Status</th>
                              <th>Package Amt</th>
                              <th>Package Duration (In Days)</th>
                              <th>Package Short Description</th>
                              <th>Package Long Description</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $x = 1; ?> 
                           @foreach($details as $val)
                           <?php  
                              $base_64 = base64_encode($val['id']);
                              
                              $encryptid = rtrim($base_64, '=');  ?>
                           <tr>
                              <td>{{$x++}}</td>
                              <td>{{$val['package_name']}}</td>
                              <td>
                                 <?php if($val['status'] == 1){ ?>
                                 <input type="checkbox" class="js-switch" data-color="#99d683" checked />
                                 <?php }else{ ?>
                                 <input type="checkbox" class="js-switch" data-color="#99d683" />
                                 <?php } ?>
                              </td>
                              <td>{{$val['package_amount']}}</td>
                              <td>{{$val['package_duration']}}</td>
                              <td style="white-space: normal;">{{$val['package_short_description']}}</td>
                              <td style="white-space: normal;">{{$val['package_long_description']}}</td>
                              <?php if($val['package_name'] == "Trial"){ ?>
                              <td></td>
                              <?php }else{ ?>
                              <td><a href="{{ url('edit-subscription',$encryptid) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ url('delete-subscription',$encryptid) }}"><i class="fas fa-trash"></i></a></td>
                              <?php } ?>
                           </tr>
                           @endforeach
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