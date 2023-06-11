<div class="templates-card">
    <div class="card my-template text-center">
        <div class="card-body image-checkbox p-0">
            <input type="checkbox" id="myCheckbox5" social-account-type="twitter-overview"/>
            <label for="myCheckbox5">
                <img src="{!!asset('/assets/image_new/Twitter-Dashboard.gif')!!}" class="template-card-image img-fluid w-100 border mb-4">
                <div class="text-content">
                    <h6 class="text-right font-22-lh-30-medium"><b>{{__('Twitter Insight')}}</b></h6>
                    <p class="m-0 text-right font-16-lh-21-regular mb-2 template-card-text">{{__('Easily monitor and understand how your tweets perform and get detailed metrics about your participants.')}}</p>
                    @if($checked)
                        <div class="check-icon-element-shown mr-auto"></div>
                    @endif
                </div>
            </label>
        </div>
    </div>
</div>
