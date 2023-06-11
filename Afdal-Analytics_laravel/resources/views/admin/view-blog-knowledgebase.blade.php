@extends('layout.admin.header')
@section('title', 'Afdal Analytics knowledge base')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">knowledge base blog</h4>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="toparea">
                     <div class="texttitle2">
                        <h3 class="card-title"><small>Knowledge Base</small> <span class="float-right"><small><a href="{{asset('knowledge_base')}}"> Back</a></small></span></h3>
                     </div>
                  </div>
                  @if(!empty($getData))
                  @foreach($getData as $list)
                  <div class="row">
                     <div class="col-md-12 col-12">
                        <div class="card shadow rounded-5 mt-3">
                           <div class="card-body">
                              <div class="col-md-3">
                                 <h4> <b>{{$list['title']}} </b></h4>
                              </div>
                              <div class="col-md-9">
                                 <p> {{$list['desciption']}}</p>
                              </div>
                           </div>
                           @endforeach
                           @endif  
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