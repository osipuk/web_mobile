<div class="templates-card">
   <div class="card my-template text-center">
      <div class="card-body image-checkbox p-0">
         <input type="checkbox" id="myCheckbox14" social-account-type="google-play"/>
         <label for="myCheckbox12">
            <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
             <div class="text-content">
               <h6 class="text-right font-22-lh-30-medium"><b>{{__('Google Play Store Performance')}}</b></h6>
               <p class="m-0 text-right font-16-lh-21-regular mb-2 template-card-text">{{__('Relevant KPIs and Metrics Number of Fans, Follower Demographics, Page Views by Sources, Actions on Page')}}</p>
                 @if($checked)
                     <div class="check-icon-element-shown mr-auto"></div>
                 @endif
             </div>
         </label>
      </div>
   </div>
</div>
