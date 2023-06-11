@section('title', 'Home')
@extends('layout.header')
@section('content')

<div class="container mt-5">
	<div class="row">
		<div class="col-lg-6 col-sm-8 col-12 mx-auto">
			<div class="card">
				<div class="card-body">
					<h1 class="text-center font-weight-bold">{{__('Contact Us')}}</h1>
					<p class="text-center">{{__('Drop us a message through this form')}}</p>

					<form>
						<div class="form-group">
							<input type="text" class="form-control text-right" placeholder="{{__('Name')}}">
						</div>

						<div class="form-group">
							<input type="email" class="form-control text-right" placeholder="{{__('Email')}}">
						</div>

						<div class="form-group">
							<input type="text" class="form-control text-right" placeholder="{{__('Subject')}}">
						</div>

						<div class="form-group">
							<label class="d-block text-right">{{__('Message to the Afdal Analytics team*')}}</label>
							<textarea class="form-control text-right" rows="3" placeholder="Message"></textarea>
						</div>
						<p class="text-right">*{{__('Afdal Analytics needs the contact information you provide to us to contact you about our products and services. You may
							unsubscribe from these communications at any time. For information on how to unsubscribe, as well as our privacy practices and commitment to protecting
							your privacy, please review our Privacy Policy')}}</p>

						<div class="text-center">
							<button class="btn btn-warning btn-md">{{__('Contact Us')}}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="circle-product text-center mt-5">
				<h3 class="text-white m-0">{{__('Need further help?')}}</h3>
				<p class="text-white">{{__('Reach out to us on the following contact lines:')}}</p>
				<h5 class="text-white m-0">{{__('Email')}}: <a href="mailto:info@afdalanalytics.com" class="text-white">info@afdalanalytics.com</a></h5>
				<h5 class="text-white m-0">{{{'Sales'}}}: <a href="tel:+1 888-457-4595" class="text-white">+1 888-457-4595</a></h5>
			</div>
		</div>
	</div>
</div>


@endsection