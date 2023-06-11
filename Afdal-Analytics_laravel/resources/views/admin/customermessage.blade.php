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

                  <div class="table-responsive p-3 rounded-5 shadow">

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

                           <tr>

                              <td>{{$details->user_id}}</td>

                              <td>{{$details->category}}</td>

                              <td>{{$details->ticket_title}}</td>

                              <td>{{$details->ticket_id}}</td>

                              <td>{{$details->date}}</td>

                              <td>{{$details->time}}</td>

                              <td><a href="{{ url('customer-support') }}" class="text-danger">Close</a></td>

                           </tr>

                        

                              <tr>

                              <td colspan="7" style="white-space: normal;">

                                 <h4><b>Ticket Message</b></h4>

                                 <p class="m-0">{{$details->ticket_message}}

                                 </p>

                              </td>

                           </tr>

                           <tbody id="show-on-click-ryply-button" style="display:none;">

                              <tr>

                                 <td colspan="7" style="white-space: normal;">

                                 <form action="{{ url('customer-support-reply') }}" method="post" enctype="multipart/form-data" class="mainform">

                                 @csrf     

                                 <div class="form-group">

                                     <input type="hidden" name="customer_support_id" value="{{$details->id}}">

                                    <textarea class="form-control" name="reply" rows="5" placeholder="Type your reply here..."></textarea>

                                 </div>

                                 <div class="form-group text-right">

                                    <button class="btn btn-outline-dark mr-2" id="message-send-btn">Send</button>

                                 </div>

                                 </form>

                              </td>

                              </tr>

                              

                           </tbody>

                           <tbody id="hide-on-click-reply-btn">

                              <tr>

                                 <td colspan="7" style="white-space: normal;">

                                    <div class="form-group text-right mt-3">

                                     

                                     <form action="{{ url('customer-support-resolved') }}" method="post" enctype="multipart/form-data" class="mainform">

                                       @csrf 

                                        <input type="hidden" name="id" value="{{$details->id}}">

                                        <button type="button" class="btn btn-outline-dark mr-2" id="message-reply-btn">Reply</button>

                                       <button class="btn btn-primary" type="submit"><i class="fas fa-check-circle mr-2 text-success"></i>Mark as Resolved</button>

                                      </form>

                                    </div>

                                 </td>

                              </tr>

                           </tbody>

                          

                          

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