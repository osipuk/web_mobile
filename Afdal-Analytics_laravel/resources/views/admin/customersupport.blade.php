@extends('layout.admin.header')
@section('title', 'Afdal Analytics Customer Support')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Customer Support</h4>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="toparea">
                     <div class="texttitle2">
                        <h3 class="card-title"><small>Overview</small></h3>
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
                     <div class="col-lg-4 col-sm-4 col-12">
                        <div class="card shadow rounded-5 mt-3">
                           <div class="card-body">
                              <p class="m-0"><small>New Ticket</small></p>
                              <h4 class="m-0">48 <span class="badge badge-success badge-pill m-0 f-12 float-right"><i class="fas fa-long-arrow-alt-up mr-2"></i>26%</span></h4>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-sm-4 col-12">
                        <div class="card shadow rounded-5 mt-3">
                           <div class="card-body">
                              <p class="m-0"><small>Answered Ticket</small></p>
                              <h4 class="m-0">118 <span class="badge badge-danger badge-pill m-0 f-12 float-right"><i class="fas fa-long-arrow-alt-down mr-2"></i>13%</span></h4>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-sm-4 col-12">
                        <div class="card shadow rounded-5 mt-3">
                           <div class="card-body">
                              <p class="m-0"><small>Resolved Ticket</small></p>
                              <h4 class="m-0">$17,200.00 <span class="badge badge-success badge-pill m-0 f-12 float-right"><i class="fas fa-long-arrow-alt-up mr-2"></i>18%</span></h4>
                           </div>
                        </div>
                     </div>
                  </div>
                  <h4 class="mt-3">Recent Activity</h4>
                  <div class="table-responsive mt-3 rounded-5 shadow">
                     <table id="config-table" class="table display no-wrap" width="100%">
                        <thead>
                           <tr>
                              <th>User ID</th>
                              <th>Category</th>
                              <th>Ticket Title</th>
                              <th>Ticket ID</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if($details){ 
                              foreach($details as $val){
                              
                                  $base_64 = base64_encode($val['id']);
                              
                                  $encryptid = rtrim($base_64, '=');  
                              
                              ?>
                           <tr>
                              <td>{{$val['user_id']}}</td>
                              <td>{{$val['category']}}</td>
                              <td>{{$val['ticket_title']}}</td>
                              <td>{{$val['ticket_id']}}</td>
                              <td>{{$val['date']}}</td>
                              <td>{{$val['time']}}</td>
                              <td><a href="{{ url('customer-message',$encryptid) }}"><i class="fas fa-external-link-square-alt"></i></a></td>
                           </tr>
                           <?php } } ?>
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