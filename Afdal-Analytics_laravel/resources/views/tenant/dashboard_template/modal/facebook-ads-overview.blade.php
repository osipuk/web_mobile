@extends('tenant.dashboard_template.modal.index')

@section('header')
    <h4 class="modal-title font-28-lh-42-semi-bold" id="myModalLabel">{{__('Facebook Ads Dashboard Template')}}</h4>
@endsection

@section('content')
    <div class="templates-cards-wrapper">
        <div class="row" style="height: 100%;">
            <div class="col-md-7 col-xs-12 imgCol" style="height: 100%; overflow: auto; box-shadow: 0px 3px 10px rgb(36 38 114 / 11%);">
                <div>
                    <img src="{!!asset('/assets/image/dashboard-template-example/facebook-ads-overview.png')!!}"
                         class="img-fluid w-100">
                </div>
            </div>
            <div class="col-md-4 col-xs-12 text-right">
                <div class="leftCan">
                    <div class="fabS mb-4">
                        <div class="d-flex">
                            <h5 class="overV font-15-lh-20-semi-bold">
                                {{__('Dashboard Overview')}}
                            </h5>
                            <div class="facebook-icon mr-1"></div>
                        </div>
                        <p>{{__('Our Facebook Ads Dashboard Template Gives you the power to measure all your Facebook ads, the best performing campaigns, and many handful insights to optimize your ads on Facebook')}}</p>
                        <p class="mb-0">{{__('Requires use with only one account*')}}</p>
                    </div>
                    @include('tenant.dashboard_template.modal.form')
                </div>
            </div>
        </div>
    </div>
@endsection
