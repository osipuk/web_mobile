@extends('layout.userhead')
@section('metahead')

    <link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}"/>

<style>
    .card {
        border-radius: 6px!important;
        position:relative;
    }
    .image-checkbox label{position:inherit!important;}
    .image-checkbox label:before{bottom:10px;top: inherit!important;}
    .modal-title{font-size:18px;text-align:center;width:100%;}
    @media (min-width: 576px){
        .modal-dialog {
            max-width: 1000px!important;
            width:100%!important;
        }
    }
</style>
@endsection
@section('title', 'User Home')
<div class="template page-wrapper chiller-theme toggled">
   @section('content')
   @include('layout.usersidenav')
   <main class="page-content pb-5">
      <div class="container-fluid">

        <div class="dashboard-static-header">
          <div class="dashboard-content-wrapper">
            <div class="container-fluid d-flex" style="justify-content: space-between;">
              <h1 class="nav-item font-54-lh-50-medium mb-4 page-title1">
                {{__('Templates')}}
              </h1>
              <div class="user-block-wrapper">
                @include('tenant.components.user-block')
              </div>
            </div>
             <div class="templates-cards-wrapper">
                <div class="col-lg-12 col-sm-12 col-12">
                   <div class="dashboard-tabs">
                      <ul class="nav nav-pills">
                         <li class="nav-item font-22-lh-46-medium">
                            <a class="nav-link active" data-toggle="tab" href="#my-temp">{{__('My Templates')}}</a>
                         </li>
                         <li class="nav-item font-22-lh-46-medium">
                            <a class="nav-link" data-toggle="tab" href="#ads-temp">{{__('Ads')}}</a>
                         </li>
                         <li class="nav-item font-22-lh-46-medium">
                          <a class="nav-link" data-toggle="tab" href="#all-temp">{{__('All')}}</a>
                       </li>
                         {{-- <li class="nav-item font-22-lh-46-medium">
                            <a class="nav-link" data-toggle="tab" href="#app-temp">{{__('App')}}</a>
                         </li> --}}
                         <li class="nav-item font-22-lh-46-medium">
                          <a class="nav-link" data-toggle="tab" href="#social-temp">{{__('Social Media')}}</a>
                       </li>
                      </ul>
                   </div>
                   @include('tenant.components.trial-banner')
                </div>
                
             </div>
          </div>
        </div>

         <div class="dashboard-content-wrapper templates-cards-wrapper">
            <div class="col-12">
               <div class="tab-content">
                  <div class="tab-pane active" id="my-temp">
                     <div class="templates-cards-wrapper">
                         @if(!empty($user_dashboard_types))
                           @foreach($user_dashboard_types as $type)
                              @include('tenant.dashboard_template.cards.' . $type, ['checked' => false])
                           @endforeach
                         @else
                             <p class="font-30-lh-63-semi-bold">
                                 {{__('Soon here will be a list of all your templates')}}
                             </p>
                         @endif
                     </div>
                  </div>
                  <div class="tab-pane fade" id="all-temp">
                     <div class="templates-cards-wrapper">
                         @include('tenant.dashboard_template.cards.facebook-overview', ['checked' => in_array('facebook-overview', $user_dashboard_types)])
                         @include('tenant.dashboard_template.cards.instagram-overview', ['checked' => in_array('instagram-overview', $user_dashboard_types)])
                         @include('tenant.dashboard_template.cards.facebook-engagement', ['checked' => in_array('facebook-engagement', $user_dashboard_types)])
                         @include('tenant.dashboard_template.cards.facebook-ads-overview', ['checked' => in_array('facebook-ads-overview', $user_dashboard_types)])
                         @include('tenant.dashboard_template.cards.twitter-overview', ['checked' => in_array('twitter-overview', $user_dashboard_types)])
                         @include('tenant.dashboard_template.cards.google-ads-overview', ['checked' => in_array('google-ads', $user_dashboard_types)])
                         @include('tenant.dashboard_template.cards.google-analytics-overview', ['checked' => in_array('google-analytics', $user_dashboard_types)])
                         {{--@include('tenant.dashboard_template.cards.google-analytics-ua-overview', ['checked' => in_array('google-analytics-ua', $user_dashboard_types)])--}}
                     </div>
                  </div>
                  <div class="tab-pane fade" id="social-temp">
                     <div class="templates-cards-wrapper">
                         @include('tenant.dashboard_template.cards.facebook-overview', ['checked' => in_array('facebook-overview', $user_dashboard_types)])
                         @include('tenant.dashboard_template.cards.twitter-overview', ['checked' => in_array('twitter-overview', $user_dashboard_types)])
                         @include('tenant.dashboard_template.cards.instagram-overview', ['checked' => in_array('instagram-overview', $user_dashboard_types)])
                         @include('tenant.dashboard_template.cards.facebook-engagement', ['checked' => in_array('facebook-engagement', $user_dashboard_types)])
                     </div>
                  </div>
                  <div class="tab-pane fade" id="ads-temp">
                     <div class="templates-cards-wrapper">
                         @include('tenant.dashboard_template.cards.facebook-ads-overview', ['checked' => in_array('facebook-ads-overview', $user_dashboard_types)])
                         @include('tenant.dashboard_template.cards.google-ads-overview', ['checked' => in_array('google-ads', $user_dashboard_types)])
                     </div>
                  </div>
                   {{--
                  <div class="tab-pane fade" id="app-temp">
                     <div class="templates-cards-wrapper">
                         @include('tenant.dashboard_template.cards.google-play', ['checked' => in_array('google-play', $user_dashboard_types)])
                     </div>
                  </div>
                  --}}
               </div>
            </div>
         </div>
      </div>
   </main>
@include('frontend.components.loader')
</div>

@endsection
<script type="text/javascript" src="{!!asset('assets/js/jquery-3.4.1.min.js')!!}"></script>

<script>


$(document).ready(function(){
    $('input[type="checkbox"]').off('change');
    $('input[type="checkbox"]').on('change', function (e) {
        let url = "{{ url('dashboard/template') }}" + "/" + $(this).attr('social-account-type');
        $.get(url, function(data) {
            $('#tempModal').remove();
            $(body).append(data)
            $('#tempModal').modal();
        });
    });
});
</script>
