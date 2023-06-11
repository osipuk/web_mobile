@extends('tenant.dashboard_template.modal.index')

@section('header')
    <h4 class="modal-title font-28-lh-42-semi-bold" id="myModalLabel">{{__('Twitter Insight Dashboard Template')}}</h4>
@endsection

@php

$get_locale = NULL;

if( null !== session()->get('locale') ):
    if(session()->get('locale') == 'en'):
        $get_locale = 'en';
    else:
        $get_locale = 'ar';
    endif;

else:
        $get_locale = 'ar';
endif;

@endphp 
@section('content')
    <div class="templates-cards-wrapper">
        <div class="row" style="height: 100%;">
            <div class="col-md-7 col-xs-12 imgCol" style="height: 100%; overflow: auto; box-shadow: 0px 3px 10px rgb(36 38 114 / 11%);">
                <div>
                    @if($get_locale=='ar')
                    <img src="{!!asset('/assets/image/dashboard-template-example/twitter-overview.png')!!}"
                         class="img-fluid w-100">
                         @else
                         <img src="{!!asset('/assets/image/dashboard-template-example/Twitter-Growth-Engagement.png')!!}"
                         class="img-fluid w-100">
                         @endif
                </div>
            </div>
            <div class="col-md-4 col-xs-12 text-right">
                <div class="leftCan">
                    <div class="fabS mb-4">
                        <div class="d-flex">
                            <h5 class="overV font-15-lh-20-semi-bold">
                                {{__('Dashboard Overview')}}
                            </h5>
                            <div class="twitter-icon mr-1"></div>
                        </div>
                        <p>{{__("Our Twitter Insight Dashboard Template Provides you with ready-made data to measure your tweets' performance, followers, and Twitter ads.")}}</p>
                        <p class="mb-0">{{__('Requires use with only one account*')}}</p>
                    </div>
                    @include('tenant.dashboard_template.modal.form')
                </div>
            </div>
        </div>
    </div>
@endsection
