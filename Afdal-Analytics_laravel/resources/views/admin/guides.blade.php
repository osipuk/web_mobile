@extends('layout.admin.header')
@section('title', 'Afdal Analytics Guides')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Guides</h4>
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
                        <h3 class="card-title"><small>Guides</small> <span class="float-right"><small><a  href="{{asset('add-guides')}}">+ Add Guides</a></small></span></h3>
                     </div>
                  </div>
                  <div class="table-responsive mt-3 rounded-5 shadow">
                     <table id="config-table" class="table display no-wrap" width="100%">
                        <thead>
                           <tr>
                              <th>Sr. Number</th>
                              <th>Title</th>
                              <th>Meta Title</th>
                              <th>Description</th>
                              <th>Blog</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>                           
                           @if(!empty($getData))
                           @foreach($getData as $key=>$list) 
                           <tr>
                              <td>{{++$key}}</td>
                              <td>{{@$list->title}}</td>
                              <td>{{@$list->meta_title}}</td>
                              <td>{{@$list->description}}</td>
                              <td>
                                 @if(!empty($list->image))
                                 <img src="{{asset('public/images/guides-images').'/'.$list->image}}" height="50px" width="100px" >
                                 @else
                                 <img src="{{asset('public/images/knowlage-images/knowlegbase.jpg')}}" height="50px" width="100px" >
                                 @endif
                              </td>
                              <td>
                                 <a href="{{ URL('edit-guides', $list->id) }}"><i class="fas fa-edit"></i></a>/
                                 <a href="{{ URL('delete-guides', $list->id) }}" class="delete-record text-danger" data-value="{{$list}}">
                                 <i class="fa fa-trash" aria-hidden="true"></i>
                                 </a>
                              </td>
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