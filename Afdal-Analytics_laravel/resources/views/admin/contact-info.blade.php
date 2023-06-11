@extends('layout.admin.header')

@section('title', 'Afdal Analytics Contact')

@section('content')


<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Contact</h4> <br>
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
                                       <th>Sr. Number</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Subject </th>
                                       <th>Message</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @if(!empty($getData))
                                  @foreach($getData as $key=>$list) 
                                    <tr>
                                       <td>{{++$key}}</td>
                                       <td>{{@$list->name}}</td>
                                       <td>{{@$list->email}}</td>
                                       <td>{{@$list->subject}}</td>
                                       <td>{{@$list->message}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                     
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