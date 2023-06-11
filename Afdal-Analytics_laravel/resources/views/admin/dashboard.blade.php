@extends('layout.admin.header')

@section('title', 'Afdal Analytics Dashboard')

@section('content')


<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Dashboard</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
               <button id="reportrange" class="btn btn-primary">
                   <i class="fas fa-sort mr-2"></i>
                   <span></span> <i class="fas fa-calendar ml-2"></i>
               </button>
            </div>
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
                  <div class="row">
                     <div class="col-lg-3 col-sm-12 col-12">
                        <h4>User Statistics</h4>
                        <div class="card shadow rounded-5 mt-3 h-75">
                           <div class="card-body">
                              <p >Active Users <span class="float-right"><b>{{@$usercount}}</b></span></p>
                              <p >Newsletter Sign Up <span class="float-right"><b>21,728</b></span></p>
                              <p >24th Sign Ins <span class="float-right"><b>17,354</b></span></p>
                              <p >24th Sign Ups <span class="float-right"><b>1,386</b></span></p>
                              <p >24th Issues <span class="float-right"><b>59</b></span></p>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6 col-sm-12 col-12">
                        <h4>Sales</h4>
                        <div class="card shadow rounded-5 mt-3 h-75">
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table border-0 w-100 table-card-top">
                                 <tbody>
                                    <tr>
                                       <td><span class="badge badge-warning badge-pill m-0 f-12 d-block text-white">Processing</span></td>
                                       <td>
                                          <h5 class="m-0">39$ <small>visa 5347</small></h5>
                                          <p class="m-0">Maonthly Subscription Payment</p>
                                       </td>
                                       <td class="text-right">
                                          <span>DH626EN602</span>
                                          <br>
                                          <span>24-06-2021</span>
                                          <br>
                                          <span>21:47</span>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td><span class="badge badge-success badge-pill m-0 f-12 d-block text-white">Successfull</span></td>
                                       <td>
                                          <h5 class="m-0">39$ <small>visa 5347</small></h5>
                                          <p class="m-0">Maonthly Subscription Payment</p>
                                       </td>
                                       <td class="text-right">
                                          <span>DH626EN602</span>
                                          <br>
                                          <span>24-06-2021</span>
                                          <br>
                                          <span>21:47</span>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td><span class="badge badge-success badge-pill m-0 f-12 d-block text-white">Successfull</span></td>
                                       <td>
                                          <h5 class="m-0">39$ <small>visa 5347</small></h5>
                                          <p class="m-0">Maonthly Subscription Payment</p>
                                       </td>
                                       <td class="text-right">
                                          <span>DH626EN602</span>
                                          <br>
                                          <span>24-06-2021</span>
                                          <br>
                                          <span>21:47</span>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-3 col-sm-12 col-12">
                        <h4>Location</h4>
                        <div class="card shadow rounded-5 mt-3 h-75">
                           <div class="card-body">
                              
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-9 col-sm-12 col-12 mt-3">
                        <h4 class="m-0">New Users</h4>
                        <p class="m-0">This license is valid for 1 data source <span class="float-right"><a href="{{ url('user-management') }}" class="text-warning"><i class="fas fa-history mr-2"></i> Refresh user list</a></span></p>
                        <div class="table-responsive mt-3 rounded-5 shadow">
                           <table id="config-table" class="table display no-wrap" width="100%">
                              <thead>
                                 <tr>
                                    <th>Personal Information</th>
                                    <th>Occupation</th>
                                    <th>Location</th>
                                    <th>License</th>
                                    <th>Date Created</th>
                                    <th>User ID</th>
                                    <th>Status</th>
                                   
                                 </tr>
                              </thead>
                              <tbody>
                                 @if(!empty($users))
                                 @foreach($users as $list)
                                 <tr>
                                    <td>
                                       <h5 class="m-0">{{$list->first_name}} {{$list->last_name}}</h5>
                                       {{$list->email}}
                                    </td>
                                    <td> {{$list->role}}</td>
                                    <td>UAE, Dubai</td>
                                    <td>Trial</td>
                                    <td> {{$list->created_at}}</td>
                                    <td>AFDAL_{{$list->id}}</td>
                                    <td>
                                       <input type="checkbox" checked class="js-switch" data-color="#99d683" />
                                    </td>
                                    
                                 </tr>
                                 @endforeach
                                 @endif
                                
                                
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-12 col-12 mt-3">
                        <h4 class="m-0">User Details</h4>
                           <p class="m-0">Data Overview</p>
                           <div class="card shadow rounded-5 mt-3 h-75">
                              <div class="card-body">
                                 <p class="desktop-cart-tet mb-1"><i class="fas fa-circle mr-2"></i>Desktop (67%)</p>
                                 <p class="mobile-cart-tet mb-1"><i class="fas fa-circle mr-2"></i>Mobile (13%)</p>
                                 <p class="laptop-cart-tet"><i class="fas fa-circle mr-2"></i>Laptop (20%)</p>

                                 <div id="sparkline11" class="text-center w-100"></div>
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