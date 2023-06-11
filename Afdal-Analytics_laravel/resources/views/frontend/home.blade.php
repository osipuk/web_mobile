@section('title', 'Home')
@extends('layout.header')
@section('content')
<div class="navbar-bg-and-screentp-bg">
         <div class="top-bg-second-col">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <div class="text-center">
                        <h3 class="text-white mb-3">{{__('Discover Arabic Analytics')}}</h3>
                        <p class="text-white">{{__('Make insights-driven decisions faster and easier with the intelligent')}}<br>
                           {{__('data and analytics platform for marketing, sales, and ecommerce')}} <br>
                           {{__('teams')}}
                        </p>
                        <div class="row">
                           <div class="col-lg-6 col-sm-6 col-12 mx-auto">
                              <div class="card">
                                 <div class="card-body">
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/yAoLSRbwxL8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="text-center try-top-btn">
                  <button class="btn ml-0 btn-warning">{{__('Free Sign Up')}}</button>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-sm-6 col-12">
               <div class="dashboard-home-detail text-right mt-5">
                  <h3><span class="text-warning">{{__('Beautiful Arabic')}}</span>  <br>
                    {{__('Dashboards')}}
                  </h3>
                  <p>{{__('>Make insights-driven decisions faster and easier with the intelligent')}}<br>
                     {{__('data and analytics platform for marketing, sales, and ecommerce')}}<br>
                     {{__('teams')}}.
                  </p>
                  <button class="btn ml-0 btn-warning mt-3">{{__('See Our Dashboard')}}</button>
               </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
               <div class="dashboard-home-img mt-5 text-center">
                  <img src="{!!asset('assets/image/dashboard.png')!!}" class="img-fluid rounded shadow">
               </div>
            </div>
         </div>
      </div>
      <div class="facebook-insight-home-detail mt-5">
         <div class="container">
            <div class="row">
               <div class="col-lg-6 col-sm-6 col-12">
                  <div class="home-social-media-detail mt-5">
                     <div class="row">
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/fb.png')!!}" height="20" width="20"><br>{{__('Facebo')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/fb.png')!!}" height="20" width="20"><br>{{__('Facebo')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/apple.png')!!}" height="20" width="20"><br>{{__('Apple')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/twitter.png')!!}" height="20" width="20"><br>{{__('Twitter')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/twitter.png')!!}" height="20" width="20"><br>{{__('Twitter')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/youtube.png')!!}" height="20" width="20"><br>{{__('Youtube')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/youtube.png')!!}" height="20" width="20"><br>{{__('Youtube')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/insta.png')!!}" height="20" width="20"><br>{{__('Instagram')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/insta.png')!!}" height="20" width="20"><br>{{__('Instagram')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/google.png')!!}" height="20" width="20"><br>{{__('Google')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/google.png')!!}" height="20" width="20"><br>{{__('Google')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/insta.png')!!}" height="20" width="20"><br>{{__('Instagram')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/google.png')!!}" height="20" width="20"><br>{{__('Google')}}
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                           <a href="#">
                              <div class="icon-details text-center shadow rounded bg-white p-1 mb-2">
                                 <img src="{!!asset('assets/image/google.png')!!}" height="20" width="20"><br>(__('Google'))
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-sm-6 col-12">
                  <div class="dashboard-home-detail text-right mt-5">
                     <h3 class="text-white"><span class="text-warning">{{__('Easily Connect')}}</span>  <br>
                        {{__('Your Data')}}
                     </h3>
                     <p class="text-white">{{__('Connect all your data sources in minutes. Funnel integrates with')}}<br>
                        {{__('500+ marketing apps and platforms Something missing? Well')}}<br>
                        {{__('build it -that is our guarantee.')}}<br>
                        {{__('teams')}}.
                     </p>
                     <button class="btn ml-0 btn-warning mt-3">{{_('See Our Connection')}}</button>
                  </div>
               </div>
            </div>
            <div class="row mt-5">
               <div class="col-12">
                  <h3 class="text-center text-white">{{__('Get Insight.')}} <span class="text-warning">{{__('Drive Growth.')}}</span></h3>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6 col-sm-6 col-12 mx-auto">
                  <div class="insight-video mt-5">
                     <iframe width="100%" height="315" src="https://www.youtube.com/embed/yAoLSRbwxL8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-4 col-sm-6 col-12">
                  <div class="facebook-fles text-right mt-5">
                     <div class="facebook-fles1">
                        <h6 class="font-weight-bold text-white">{{__('Demonstrate clear value')}}</h6>
                        <p class="text-white">{{__('Get actionable suggestions how to improve marketing ROI anddrive business growth')}}
                        </p>
                     </div>
                     <div class="facebook-fles2">
                        <img src="{!!asset('assets/image/document.png')!!}">
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6 col-12">
                  <div class="facebook-fles text-right mt-5">
                     <div class="facebook-fles1">
                        <h6 class="font-weight-bold text-white">{{__('Improve marketing performance')}}</h6>
                        <p class="text-white">{{__('Optimize future campaign results with predictive insights')}}
                        </p>
                     </div>
                     <div class="facebook-fles2">
                        <img src="{!!asset('assets/image/paint.png')!!}">
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6 col-12">
                  <div class="facebook-fles text-right mt-5">
                     <div class="facebook-fles1">
                        <h6 class="font-weight-bold text-white">{{__('Save time and resources')}}</h6>
                        <p class="text-white">{{__('Eliminate manual reporting by automating data integration from all channels')}}
                        </p>
                     </div>
                     <div class="facebook-fles2">
                        <img src="{!!asset('assets/image/phone-desktop.png')!!}">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <div class="text-center">
                     <button class="btn ml-0 btn-warning mt-3">{{__('Explore Our Platform')}}</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="readytohome">
         <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="text-center mt-5">
                  <h3 class="mb-3">{{__('Join Our Newsletter')}}</h3>
                  <p>{{__('Gain first hand updates, resources, and most recent guides on how to')}} <br>
                     {{__('grow your business and product - curated for the Arabic Market')}}
                  </p>
                  <div class="row">
                     <div class="col-lg-5 col-sm-6 col-12 mx-auto text-center">
                        <div class="join-col">
                           <div class="btn-vol-join">
                              <button class="btn join-btn m-0">{{__('JOIN')}}</button>
                           </div>
                           <div class="form-col-join">
                              <div class="form-group m-0">
                                 <input type="text" class="form-control text-right m-0" placeholder="{{__('Your Email')}}">
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
      <div class="home-testimonial mt-5">
         <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="text-center">
                  <h3 class=" mb-3 text-white">{{__('The Latest News')}}</h3>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-10 col-sm-10 col-12 mx-auto">
               <div id="blog-slider" class="owl-carousel">
                  <div class="card item blog-card mt-3 mb-3">
                     <div class="card-body height-250">

                     </div>
                  </div>
                  <div class="card item blog-card mt-3 mb-3">
                     <div class="card-body height-250">

                     </div>
                  </div>
                  <div class="card item blog-card mt-3 mb-3">
                     <div class="card-body height-250">

                     </div>
                  </div>
                  <div class="card item blog-card mt-3 mb-3">
                     <div class="card-body height-250">

                     </div>
                  </div>
                  <div class="card item blog-card mt-3 mb-3">
                     <div class="card-body height-250">

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
@endsection
