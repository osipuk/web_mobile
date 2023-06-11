<style>
    .dashboard-template-modal .row {
        margin-left:0px !important;
        margin-right:0px !important;
    }

    .dashboard-template-modal .leftCan {
        position: fixed;
        width:250px;
    }
</style>
<div class="modal fade" id="tempModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog dashboard-template-modal" style="margin: auto;">
        <div class="modal-content">
            <div class="modal-header">
                @yield('header')
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body template-modal-body">
                @yield('content')
            </div>
        </div>
    </div>
</div>
