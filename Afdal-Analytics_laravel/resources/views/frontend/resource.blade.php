@section('title', 'Home')
@extends('layout.header')
@section('content')

<div class="container mt-5">
	<div class="row">
			<div class="col-12">
				<h3 class="text-center mb-3">{{__('Guides that help you grow')}}</h3>
                        <p class="text-center">{{__('Need a manual on how to grow your business?')}} <br>
                          {{__('Download our free marketing and growth resources')}}
                        </p>
			</div>
		</div>
</div>

<div class="resource-all">
	<div class="container">

		<div class="row">
			<div class="col-lg-8 col-sm-10 col-12 mx-auto">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="resource-col text-center resource-col1">
							<h4 class="font-weight-bold">Guide Name</h4>
							<img src="{!!asset('assets/image/re1.jpg')!!}" class="shadow">
							<p>Need a manual how to grow your business?<br>Download our free marketing and growth</p>
							<p class="font-weight-bold m-0"><a href="#"><i class="fas fa-chevron-left mr-2"></i>Get the guide</a></p>
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="resource-col text-center resource-col2">
							<h4 class="font-weight-bold">Guide Name</h4>
							<img src="{!!asset('assets/image/re2.jpg')!!}" class="shadow">
							<p>Need a manual how to grow your business?<br>Download our free marketing and growth</p>
							<p class="font-weight-bold m-0"><a href="#"><i class="fas fa-chevron-left mr-2"></i>Get the guide</a></p>
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="resource-col text-center resource-col3">
							<h4 class="font-weight-bold">Guide Name</h4>
							<img src="{!!asset('assets/image/re3.jpg')!!}" class="shadow">
							<p>Need a manual how to grow your business?<br>Download our free marketing and growth</p>
							<p class="font-weight-bold m-0"><a href="#"><i class="fas fa-chevron-left mr-2"></i>Get the guide</a></p>
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="resource-col text-center resource-col4">
							<h4 class="font-weight-bold">Guide Name</h4>
							<img src="{!!asset('assets/image/re4.jpg')!!}" class="shadow">
							<p>Need a manual how to grow your business?<br>Download our free marketing and growth</p>
							<p class="font-weight-bold m-0"><a href="#"><i class="fas fa-chevron-left mr-2"></i>Get the guide</a></p>
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="resource-col text-center resource-col5">
							<h4 class="font-weight-bold">Guide Name</h4>
							<img src="{!!asset('assets/image/re5.jpg')!!}" class="shadow">
							<p>Need a manual how to grow your business?<br>Download our free marketing and growth</p>
							<p class="font-weight-bold m-0"><a href="#"><i class="fas fa-chevron-left mr-2"></i>Get the guide</a></p>
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="resource-col text-center resource-col6">
							<h4 class="font-weight-bold">Guide Name</h4>
							<img src="{!!asset('assets/image/re1.jpg')!!}" class="shadow">
							<p>Need a manual how to grow your business?<br>Download our free marketing and growth</p>
							<p class="font-weight-bold m-0"><a href="#"><i class="fas fa-chevron-left mr-2"></i>Get the guide</a></p>
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="resource-col text-center resource-col7">
							<h4 class="font-weight-bold">Guide Name</h4>
							<img src="{!!asset('assets/image/re2.jpg')!!}" class="shadow">
							<p>Need a manual how to grow your business?<br>Download our free marketing and growth</p>
							<p class="font-weight-bold m-0"><a href="#"><i class="fas fa-chevron-left mr-2"></i>Get the guide</a></p>
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="resource-col text-center resource-col8">
							<h4 class="font-weight-bold">Guide Name</h4>
							<img src="{!!asset('assets/image/re3.jpg')!!}" class="shadow">
							<p>Need a manual how to grow your business?<br>Download our free marketing and growth</p>
							<p class="font-weight-bold m-0"><a href="#"><i class="fas fa-chevron-left mr-2"></i>Get the guide</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	<div class="readytohome mt-5">
         <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="text-center mt-5">
                  <h3 class="mb-3">{{__('Get Our Latest')}} <br>{{__("Resources In Your Inbox")}}</h3>

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
