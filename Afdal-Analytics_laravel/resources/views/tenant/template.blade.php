@extends('layout.userhead')
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
@section('title', 'User Home')
<div class="page-wrapper chiller-theme toggled">
   @section('content')
   @include('layout.usersidenav')
   <main class="page-content pb-5">
      <div class="container-fluid">
        <div class="container-fluid d-flex" style="justify-content: space-between;">
          <h1 class="nav-item font-50-lh-114-regular">
            {{__('Templates')}}
          </h1>
          <div class="user-block-wrapper">
            @include('tenant.components.user-block')
          </div>
        </div>

         <div class="row">
            <div class="col-lg-12 col-sm-12 col-12">
               <div class="dashboard-tabs">
                  <ul class="nav nav-pills">
                     <li class="nav-item font-24-lh-29-medium">
                        <a class="nav-link active" data-toggle="tab" href="#my-temp">{{__('My Templates')}}</a>
                     </li>
                     <li class="nav-item font-24-lh-29-medium">
                        <a class="nav-link" data-toggle="tab" href="#ads-temp">{{__('Ads')}}</a>
                     </li>
                     <li class="nav-item font-24-lh-29-medium">
                      <a class="nav-link" data-toggle="tab" href="#all-temp">{{__('All')}}</a>
                   </li>
                     <li class="nav-item font-24-lh-29-medium">
                        <a class="nav-link" data-toggle="tab" href="#app-temp">{{__('App')}}</a>
                     </li>
                     <li class="nav-item font-24-lh-29-medium">
                      <a class="nav-link" data-toggle="tab" href="#social-temp">{{__('Social Media')}}</a>
                   </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="tab-content">
                  <div class="tab-pane active" id="my-temp">
                     <div class="row">
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 mb-3 text-center">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox1" />
                                 <label for="myCheckbox1">
                                 <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                 <div class="text-content">
                                   <h6 class="text-right font-17-lh-20-medium"><b>{{__('Facebook Page Insight')}}</b></h6>
                                   <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('All the metrics you need to view valuable insights about your audience and how they interact with your Facebook Page ')}}</p>
                                   <div class="check-icon-element-shown mr-auto"></div>
                                </div>
                                </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="all-temp">
                     <div class="row">
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox15" />
                                 <label for="myCheckbox1">
                                     <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                       <h6 class="text-right font-17-lh-20-medium"><b>{{__('Facebook Page Insight')}}</b></h6>
                                       <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('All the metrics you need to view valuable insights about your audience and how they interact with your Facebook Page')}}</p>
                                       <div class="check-icon-element-shown mr-auto"></div>
                                    </div>
                                </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox2" />
                                 <label for="myCheckbox2">
                                     <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                       <h6 class="text-right font-17-lh-20-medium"><b>{{__('Instagram Insight')}}</b></h6>
                                       <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Get an insightful look into the engagements, actions, and reach monitored on your Instagram account')}}</p>
                                       <div class="check-icon-element-shown mr-auto"></div>
                                    </div>
                                </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox3" />
                                 <label for="myCheckbox3">
                                     <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                       <h6 class="text-right font-17-lh-20-medium"><b>{{__('Facebook Engagment')}}</b></h6>
                                       <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Allows you to see valuable insight into how your audience is interacting with your Facebook page')}}</p>
                                       <div class="check-icon-element-shown mr-auto"></div>
                                    </div>
                                </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox4" />
                                 <label for="myCheckbox4">
                                     <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                       <h6 class="text-right font-17-lh-20-medium"><b>{{__('Facebook Ads')}}</b></h6>
                                       <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('High-level overview of how all your Facebook Ads campaigns are performing')}}</p>
                                       <div class="check-icon-element-shown mr-auto"></div>
                                    </div>
                                </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox5" />
                                 <label for="myCheckbox5">
                                     <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                       <h6 class="text-right font-17-lh-20-medium"><b>{{__('Twitter Insight')}}</b></h6>
                                       <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Easily monitor and understand how your tweets perform and get detailed metrics about your participants.')}}</p>
                                       <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox16" />
                                 <label for="myCheckbox16">
                                     <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                       <h6 class="text-right font-17-lh-20-medium"><b>{{__('Google Analytics')}}</b></h6>
                                       <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Easily monitor and understand how your tweets perform and get detailed metrics about your participants.')}}</p>
                                       <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox15" />
                                 <label for="myCheckbox15">
                                     <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                       <h6 class="text-right font-17-lh-20-medium"><b>{{__('Google Ads')}}</b></h6>
                                       <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Easily monitor and understand how your tweets perform and get detailed metrics about your participants.')}}</p>
                                       <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div>
                        {{-- <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox6" />
                                 <label for="myCheckbox6">
                                    <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                        <h6 class="text-right font-17-lh-20-medium"><b>{{__('Twitter KPI')}}</b></h6>
                                        <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Relevant KPIs and Metrics Number of Fans, Follower Demographics, Page Views by Sources, Actions on Page')}}</p>
                                        <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div> --}}
                     </div>
                  </div>
                  <div class="tab-pane fade" id="social-temp">
                     <div class="row">
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox7" checked />
                                 <label for="myCheckbox7">
                                     <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                       <h6 class="text-right font-17-lh-20-medium"><b>{{__('Facebook Page Insight')}}</b></h6>
                                       <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('All the metrics you need to view valuable insights about your audience and how they interact with your Facebook Page')}}</p>
                                       <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div>
                        {{-- <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox8" checked />
                                 <label for="myCheckbox8">
                                     <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                       <h6 class="text-right font-17-lh-20-medium"><b>{{__('Facebook Page Insight')}}</b></h6>
                                       <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Relevant KPIs and Metrics Number of Fans, Follower Demographics, Page Views by Sources, Actions on Page')}}</p>
                                       <div class="check-icon-element-shown mr-auto"></div>
                                    </div>
                                </label>
                              </div>
                           </div>
                        </div> --}}
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox9" checked />
                                 <label for="myCheckbox9">
                                    <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                        <h6 class="text-right font-17-lh-20-medium"><b>{{__('Twitter Insight')}}</b></h6>
                                        <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Easily monitor and understand how your tweets perform and get detailed metrics about your participants.')}}</p>
                                        <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox10" checked />
                                 <label for="myCheckbox10">
                                    <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                        <h6 class="text-right font-17-lh-20-medium"><b>{{__('Instagram Insight')}}</b></h6>
                                        <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Get an insightful look into the engagements, actions, and reach monitored on your Instagram account')}}</p>
                                        <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox11" />
                                 <label for="myCheckbox11">
                                    <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                        <h6 class="text-right font-17-lh-20-medium"><b>{{__('Facebook Engagment')}}</b></h6>
                                        <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Allows you to see valuable insight into how your audience is interacting with your Facebook page')}}</p>
                                        <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="ads-temp">
                     <div class="row">
                        <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox12" />
                                 <label for="myCheckbox12">
                                    <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                        <h6 class="text-right font-17-lh-20-medium"><b>{{__('Facebook Ads')}}</b></h6>
                                        <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Relevant KPIs and Metrics Number of Fans, Follower Demographics, Page Views by Sources, Actions on Page')}}</p>
                                        <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div>
                        {{-- <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox13" />
                                 <label for="myCheckbox13">
                                    <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                        <h6 class="text-right font-17-lh-20-medium"><b>{{__('Twitter KPI')}}</b></h6>
                                        <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Relevant KPIs and Metrics Number of Fans, Follower Demographics, Page Views by Sources, Actions on Page')}}</p>
                                        <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div> --}}
                     </div>
                  </div>
                  <div class="tab-pane fade" id="app-temp">
                     <div class="row">
                        {{-- <div class="col-lg-4 col-sm-4 col-12">
                           <div class="card my-template mt-3 text-center mb-3">
                              <div class="card-body image-checkbox p-0">
                                 <input type="checkbox" id="myCheckbox14" />
                                 <label for="myCheckbox12">
                                    <img src="{!!asset('/assets/image_new/svg/colored/image-placeholder.svg')!!}" class="template-card-image img-fluid w-100 border mb-4">
                                     <div class="text-content">
                                       <h6 class="text-right font-17-lh-20-medium"><b>{{__('Google Play Store Performance')}}</b></h6>
                                       <p class="m-0 text-right font-14-lh-17-light template-card-text">{{__('Relevant KPIs and Metrics Number of Fans, Follower Demographics, Page Views by Sources, Actions on Page')}}</p>
                                       <div class="check-icon-element-shown mr-auto"></div>
                                     </div>
                                 </label>
                              </div>
                           </div>
                        </div> --}}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
</div>`

<!-- Modal -->
<div class="modal fade" id="tempModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-28-lh-42-semi-bold" id="myModalLabel">{{__('Facebook - Page Overview')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
         <!--modal-->
            <div class="col-md-7 col-xs-12">
                <div class="imgModal">
                    <img src="{!!asset('/assets/image/dashboard.png')!!}" class="img-fluid w-100">
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
                        <p>{{__('Our Facebook Page Performance dashboard template offers an in-depth look into the performance of a Facebook Page.')}}</p>
                        <p class="mb-0">{{__('Requires use with only one account*')}}</p>
                    </div>
                    <p class="font-24-lh-29-medium">{{__('Select one of your connectors')}}</p>
                    <form class="mb-5">
                      <div class="input-container">
                        <input type="radio" name="checkbox-example" id="checkbox-button-1" checked />
                        <label for="checkbox-button-1">
                          <p class="mr-1 mb-0">{{__('Connector 1')}}</p>
                        </label>
                      </div>

                      <div class="input-container">
                        <input type="radio" name="checkbox-example" id="checkbox-button-2" />
                        <label for="checkbox-button-2">
                          <p class="mr-1 mb-0">{{__('Connector 2')}}</p>
                        </label>
                      </div>

                      <div class="input-container">
                        <input type="radio" name="checkbox-example" id="checkbox-button-3" />
                        <label for="checkbox-button-3">
                          <p class="mr-1 mb-0">{{__('Connector 3')}}</p>
                        </label>
                      </div>
                    </form>
                    <div class="text-center mb-3">
                        <a href="javascript:void(0);" class="Add-dash font-18-lh-22-regular">{{__('Add Dashboard')}}</a>
                    </div>
                    <div class="text-center">
                        <p style="margin:0">
                            Can't find what you're <br/>looking for
                        </p>
                        <a href="javascript:void(0);" class="addConn">Add New Connector</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      <!--</div>-->
    </div>
  </div>
</div>
@endsection
