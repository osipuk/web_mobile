<div class="templates-card">
    <div class="card my-template text-center">
        <div class="card-body image-checkbox p-0">
            <input type="checkbox" id="myCheckbox15" social-account-type="googlea-overview"/>
            <label for="myCheckbox15">
                <img src="{!!asset('/assets/image_new/googlea-dashboard.gif')!!}" class="template-card-image img-fluid w-100 border mb-4">
                <div class="text-content">
                    <h6 class="text-right font-22-lh-30-medium"><b>{{__('Google Ads')}}</b></h6>
                    <p class="m-0 text-right font-16-lh-21-regular mb-2 template-card-text">{{__('Monitor the performance of your Google advertising campaigns closely to determine which campaigns are performing best.')}}</p>
                    @if($checked)
                        <div class="check-icon-element-shown mr-auto"></div>
                    @endif
                </div>
            </label>
        </div>
    </div>
</div>
