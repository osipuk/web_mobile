<div class="templates-card">
   <div class="card my-template text-center">
      <div class="card-body image-checkbox p-0">
         <input type="checkbox" id="myCheckbox1" social-account-type="facebook-overview"/>
         <label for="myCheckbox1">
         <img src="{!!asset('/assets/image_new/Facebook-page-insight-Dashboard.gif')!!}" class="template-card-image img-fluid w-100 border mb-4">
         <div class="text-content">
           <h6 class="text-right font-22-lh-30-medium"><b>{{__('Facebook Page Insight')}}</b></h6>
           <p class="m-0 text-right font-16-lh-21-regular mb-2 template-card-text">{{__('All the metrics you need to view valuable insights about your audience and how they interact with your Facebook Page')}}</p>
             @if($checked)
                <div class="check-icon-element-shown mr-auto"></div>
             @endif
            </div>
        </label>
      </div>
   </div>
</div>
