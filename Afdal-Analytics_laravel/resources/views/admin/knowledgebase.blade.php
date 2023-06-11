@extends('layout.admin.header')
@section('title', 'Afdal Analytics knowledge base')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">knowledge baset</h4>
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
                        <h3 class="card-title"><small>knowledge baset</small> <span class="float-right"><small><a  href="{{asset('add-knowledge_base')}}">+ Add knowledge base</a></small></span></h3>
                     </div>
                  </div>
                  <div class="table-responsive p-3 rounded-5 shadow">
                     <table id="config-table" class="table display no-wrap" width="100%">
                        <thead>
                           <tr>
                              <th>Sr. Number</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Icon</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if(!empty($getData))
                           @foreach($getData as $key=>$list) 
                           <tr>
                              <td>{{++$key}}</td>
                              <td>{{@$list->title}}</td>
                              <td>{{@$list->description}}</td>
                              <td>
                                 @if(!empty($list->image))
                                 <img src="{{asset('public/images/knowlage-images').'/'.$list->image}}" height="50px" width="100px" class="img-thumbnail" >
                                 @else
                                 <img src="{{asset('public/images/knowlage-images/knowlegbase.jpg')}}" height="50px" width="100px" class="img-thumbnail" >
                                 @endif
                              </td>
                              <td>
                                 <a href="{{ URL('view-blog-knowledgebase', $list->id) }}" class="text-info"><i class="fas fa-eye"></i></a>/
                                 <a href="{{ URL('aad-blog-knowledgebase', $list->id) }}" class="text-success">Add Blog</a>/
                                 <a href="{{ URL('edit-knowledge_base', $list->id) }}"><i class="fas fa-edit"></i></a>/
                                 <a href="{{ URL('delete-knowledge_base', $list->id) }}" data-value="{{$list}}" class="text-danger">
                                 <i class="fa fa-trash"></i>
                                 </a>
                              </td>
                           </tr>
                           @endforeach
                           @endif
                           
                        <tbody id="show-on-click-ryply-button" style="display:none;">
                           <tr>
                              <td colspan="7" style="white-space: normal;">
                                 <form action="{{ url('customer-support-reply') }}" method="post" enctype="multipart/form-data" class="mainform">
                                    @csrf     
                                    <div class="form-group">
                                       <input type="hidden" name="customer_support_id" value="{{@$details->id}}">
                                       <textarea class="form-control" name="reply" rows="5" placeholder="Type your reply here..."></textarea>
                                    </div>
                                    <div class="form-group text-right">
                                       <button class="btn btn-outline-dark mr-2" id="message-send-btn">Send</button>
                                    </div>
                                 </form>
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