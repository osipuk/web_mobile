@extends('layout.admin.header')
@section('title', 'Afdal Analytics Customer Support')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor">News Feed</h4>
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
                        <h3 class="card-title"><small>Review & Publish news</small> <span class="float-right"><small><a href="{{ url('create-newsfeed') }}"style="font-size: 17px;
    font-weight: 600;">+ New Post</a></small></span></h3>
                     </div>
                  </div>
                  <div class="row">
                     <?php if(!empty($details)) {
                        foreach($details as $val){
                             $base_64 = base64_encode($val['id']);
                             $encryptid = rtrim($base_64, '=');
                        
                        ?>      
                     <div class="col-lg-4 col-sm-6 col-12">
                        <div class="card shadow rounded-5 mt-3">
                           <div class="card-body news-content">
                              <a href="#news-feed-detail1" data-toggle="modal"><img src="{{url('public/images/news_feeds').'/'.$val['image']}}" class="w-100 mb-2"></a>
                              <h4><b><a href="#news-feed-detail1" data-toggle="modal">{{$val['title']}}</a></b></h4>
                              {!! substr($val['description'],200,strlen($val['description']))!!} 
                              <h6 class="m-0 "><a href="#news-feed-detail-" class="news-feed-detail"  data-image="{{url('public/images/news_feeds').'/'.$val['image']}}" data-value="{!!$val['description']!!}" data-toggle="modal">Read full story</a> <span class="float-right"><a href="{{ url('edit-newsfeed',$encryptid) }}"><i class="fas fa-edit"></i></a> / <a href="#delete-confirm11" class="text-danger delete-record" data-id="{{$val['id']}}" data-toggle="modal"><i class="fas fa-trash"></i></a></span></h6>
                           </div>
                        </div>
                     </div>
                     <?php } } ?>                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="news-feed-detail1" class="modal fade news-feed-detail-open">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title w-100">News Post Name</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-6 col-sm-12 col-12">
                  <img width="200" height="100" class="imageID" src="{!!asset('public/assets/assets/images/blog1.jpg')!!}" class="w-100">
               </div>
               <div class="col-lg-6 col-sm-12 col-12">
                 <p class="showData"> </p>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<div id="delete-confirm1" class="modal fade">
<form id="add_form" action="{{asset('delete-newsfeed')}}" method="post" enctype="multipart/form-data">
                                @csrf
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header flex-column">
            <div class="icon-box">
               <i class="material-icons">&#xE5CD;</i>
            </div>
            <h4 class="modal-title w-100">Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <div class="modal-body">
            <p>Do you really want to delete these records? This process cannot be undone.</p>
         </div>
         <div class="modal-footer justify-content-center">
         <input type="hidden" name="deleteId" value="" class="modal-footer" >
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
         </div>
      </div>
   </div>
   </form>
</div>
@endsection

