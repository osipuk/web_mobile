<style>
    .whats-next .col {
        padding-right: 0;
        padding-left: 0;
        margin-bottom: 20px;
    }

    .whats-next .card {
        border-radius: 20px !important;
        box-shadow: 0px 3px 10px #00000029;
        padding: 20px;
        width:385px;
        margin: 0 auto;
    }
    @media (max-width: 960px) {
        .cads-wrapper{
            display: block;
        }
        .cads-wrapper .col div{
            margin: 0 auto;
            height: auto!important;
        }
    }
    @media (max-width: 660px) {
        .checked-icon-modal{
            display: none;
        }
    }
    .whats-next .card h5 {
        font-size: 12px;
        font-weight: bold;
        text-align: center;
    }

    .whats-next .card-text {
        color: #8D9CB4;
        text-align: right;
    }
</style>

<div class="modal fade tabindex-set9999" id="whats_next" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-header__title small-font font-28-lh-42-semi-bold" id="exampleModalLabel"></h5>
                <button class="modal-header__close-icon font-16-lh-19-medium"
                        type="button"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    {{-- {{__('Close')}} --}}
                </button>
            </div>
            <div class="modal-body">
                <div class="connection-block">
                    <div class="container whats-next" style="max-width:768px;">
                        <div class="row">
                            <div class="col-12" style="padding-right:0; padding-left: 0;">
                                <h4 class="text-center">{{__("What's next")}}</h4>
                                <div class="connection-block-header text-center" style="margin-top:20px; margin-bottom:40px; color: #8D9CB4">{{__("Choose any one of the following options to proceed next")}}</div>
                                <div class="alert alert-info text-center" style="font-size:20px; background-color: #DEE4EE;" role="alert"><div class="checked-icon-modal"></div> @yield('message') </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col cads-wrapper">
                                <div class="card h-100" onclick="$('#whats_next').modal('hide')" style="cursor: pointer;">
                                    <img width=40 height=40 src="{!! asset('assets/image/whats-next-modal/connect.svg') !!}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{__("Connect Another")}}</h5>
                                        <p class="card-text">{{__("Continue to add integrations from our library")}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col cads-wrapper">
                                <div class="card h-100" onclick="window.location.href = '{{ url('dashboard/templates') }}'" style="cursor: pointer;">
                                    <img width=40 height=40  src="{!! asset('assets/image/whats-next-modal/dashboard.svg') !!}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{__("Visit Dashboard")}}</h5>
                                        <p class="card-text">@yield('visit_description')</p>
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
