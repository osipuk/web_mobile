@extends('layout.admin.header')
@section('title', 'Afdal Analytics Billing')
@section('content')
<style type="text/css">
</style>
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Billing</h4>
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
                  <div class="row">
                     <div class="col-lg-4 col-sm-4 col-12">
                        <div class="card shadow rounded-5 mt-3">
                           <div class="card-body">
                              <p class="m-0"><small>Current Balance</small></p>
                              <h4 class="m-0">$30,182.50 <span class="badge badge-success badge-pill m-0 f-12 float-right"><i class="fas fa-long-arrow-alt-up mr-2"></i>26%</span></h4>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-sm-4 col-12">
                        <div class="card shadow rounded-5 mt-3">
                           <div class="card-body">
                              <p class="m-0"><small>Pending</small></p>
                              <h4 class="m-0">$19,500.00 <span class="badge badge-danger badge-pill m-0 f-12 float-right"><i class="fas fa-long-arrow-alt-down mr-2"></i>13%</span></h4>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4 col-sm-4 col-12">
                        <div class="card shadow rounded-5 mt-3">
                           <div class="card-body">
                              <p class="m-0"><small>Processed</small></p>
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
                              <th>Name</th>
                              <th>Transaction</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Location</th>
                              <th>Date Created</th>
                              <th>Transaction ID</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>John Deo</td>
                              <td>Monthly Base Subscription Payment</td>
                              <td>$39.00</td>
                              <td>
                                 <span class="badge badge-warning badge-pill m-0 f-12 text-white">Processing</span>
                              </td>
                              <td>Libya, Derna</td>
                              <td>25-06-2021</td>
                              <td>DH626EN602</td>
                              <td><a href="#form-details" data-toggle="modal"><i class="fas fa-eye"></i></a> / <a href="#delete-confirm" class="text-danger" data-toggle="modal"><i class="fas fa-trash"></i></a></td>
                           </tr>
                           <tr>
                              <td>John Deo</td>
                              <td>Monthly Base Subscription Payment</td>
                              <td>$39.00</td>
                              <td>
                                 <span class="badge badge-danger badge-pill m-0 f-12 text-white">Failled</span>
                              </td>
                              <td>Libya, Derna</td>
                              <td>25-06-2021</td>
                              <td>DH626EN602</td>
                              <td><a href="#form-details" data-toggle="modal"><i class="fas fa-eye"></i></a> / <a href="#delete-confirm" class="text-danger" data-toggle="modal"><i class="fas fa-trash"></i></a></td>
                           </tr>
                           <tr>
                              <td>John Deo</td>
                              <td>Monthly Base Subscription Payment</td>
                              <td>$39.00</td>
                              <td>
                                 <span class="badge badge-success badge-pill m-0 f-12 text-white">Successfull</span>
                              </td>
                              <td>Libya, Derna</td>
                              <td>25-06-2021</td>
                              <td>DH626EN602</td>
                              <td><a href="#form-details" data-toggle="modal"><i class="fas fa-eye"></i></a> / <a href="#delete-confirm" class="text-danger" data-toggle="modal"><i class="fas fa-trash"></i></a></td>
                           </tr>
                           <tr>
                              <td>John Deo</td>
                              <td>Monthly Base Subscription Payment</td>
                              <td>$39.00</td>
                              <td>
                                 <span class="badge badge-warning badge-pill m-0 f-12 text-white">Processing</span>
                              </td>
                              <td>Libya, Derna</td>
                              <td>25-06-2021</td>
                              <td>DH626EN602</td>
                              <td><a href="#form-details" data-toggle="modal"><i class="fas fa-eye"></i></a> / <a href="#delete-confirm" class="text-danger" data-toggle="modal"><i class="fas fa-trash"></i></a></td>
                           </tr>
                           <tr>
                              <td>John Deo</td>
                              <td>Monthly Base Subscription Payment</td>
                              <td>$39.00</td>
                              <td>
                                 <span class="badge badge-danger badge-pill m-0 f-12 text-white">Failled</span>
                              </td>
                              <td>Libya, Derna</td>
                              <td>25-06-2021</td>
                              <td>DH626EN602</td>
                              <td><a href="#form-details" data-toggle="modal"><i class="fas fa-eye"></i></a> / <a href="#delete-confirm" class="text-danger" data-toggle="modal"><i class="fas fa-trash"></i></a></td>
                           </tr>
                           <tr>
                              <td>John Deo</td>
                              <td>Monthly Base Subscription Payment</td>
                              <td>$39.00</td>
                              <td>
                                 <span class="badge badge-success badge-pill m-0 f-12 text-white">Successfull</span>
                              </td>
                              <td>Libya, Derna</td>
                              <td>25-06-2021</td>
                              <td>DH626EN602</td>
                              <td><a href="#form-details" data-toggle="modal"><i class="fas fa-eye"></i></a> / <a href="#delete-confirm" class="text-danger" data-toggle="modal"><i class="fas fa-trash"></i></a></td>
                           </tr>
                           <tr>
                              <td>John Deo</td>
                              <td>Monthly Base Subscription Payment</td>
                              <td>$39.00</td>
                              <td>
                                 <span class="badge badge-warning badge-pill m-0 f-12 text-white">Processing</span>
                              </td>
                              <td>Libya, Derna</td>
                              <td>25-06-2021</td>
                              <td>DH626EN602</td>
                              <td><a href="#form-details" data-toggle="modal"><i class="fas fa-eye"></i></a> / <a href="#delete-confirm" class="text-danger" data-toggle="modal"><i class="fas fa-trash"></i></a></td>
                           </tr>
                           <tr>
                              <td>John Deo</td>
                              <td>Monthly Base Subscription Payment</td>
                              <td>$39.00</td>
                              <td>
                                 <span class="badge badge-danger badge-pill m-0 f-12 text-white">Failled</span>
                              </td>
                              <td>Libya, Derna</td>
                              <td>25-06-2021</td>
                              <td>DH626EN602</td>
                              <td><a href="#form-details" data-toggle="modal"><i class="fas fa-eye"></i></a> / <a href="#delete-confirm" class="text-danger" data-toggle="modal"><i class="fas fa-trash"></i></a></td>
                           </tr>
                           <tr>
                              <td>John Deo</td>
                              <td>Monthly Base Subscription Payment</td>
                              <td>$39.00</td>
                              <td>
                                 <span class="badge badge-success badge-pill m-0 f-12 text-white">Successfull</span>
                              </td>
                              <td>Libya, Derna</td>
                              <td>25-06-2021</td>
                              <td>DH626EN602</td>
                              <td><a href="#form-details" data-toggle="modal"><i class="fas fa-eye"></i></a> / <a href="#delete-confirm" class="text-danger" data-toggle="modal"><i class="fas fa-trash"></i></a></td>
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
<div id="form-details" class="modal fade">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title w-100">Billing Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-6 col-sm-12 col-12">
                  <p class="detail-tet"><label>Name</label><span>John Deo</span></p>
               </div>
               <div class="col-lg-6 col-sm-12 col-12">
                  <p class="detail-tet"><label>Transaction</label><span>Monthly Base Subscription Payment</span></p>
               </div>
               <div class="col-lg-6 col-sm-12 col-12">
                  <p class="detail-tet"><label>Amount</label><span>$39.00</span></p>
               </div>
               <div class="col-lg-6 col-sm-12 col-12">
                  <p class="detail-tet"><label>Status</label><span class="badge badge-warning badge-pill m-0 f-12  text-white">Processing</span></p>
               </div>
               <div class="col-lg-6 col-sm-12 col-12">
                  <p class="detail-tet"><label>Location</label><span>Libya, Derna</span></p>
               </div>
               <div class="col-lg-6 col-sm-12 col-12">
                  <p class="detail-tet"><label>Date Created</label><span>25-06-2021</span></p>
               </div>
               <div class="col-lg-6 col-sm-12 col-12">
                  <p class="detail-tet"><label>Transaction ID</label><span>DH626EN602</span></p>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
@endsection