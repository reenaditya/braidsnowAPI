@extends('layouts.app')
@section('content')
<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
				<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
				

				<!-- end:: Aside -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					

					<!-- end:: Header -->
					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

						<!-- begin:: Subheader -->
						

						<!-- end:: Subheader -->

						<!-- begin:: Content -->
						<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="row">
								<div class="col-lg-12">

									<!--begin::Portlet-->
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Company Management
												</h3>
											</div>
										</div>

										<!--begin::Form-->
<form class="kt-form" method="post" action="{{ route('company.update',$company->id) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	
	<div class="kt-portlet__body">
		<div class="row">
			<div class="col-md-12">
				
				<div class="form-group validated">
					<label class="form-control-label" for="inputSuccess1">Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="inputSuccess1" name="name" value="{{ old('name',$company->name) }}">
					@error('name')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group validated">
					<label class="form-control-label" for="inputSuccess1">Address</label>
					<textarea name="address" id="address" cols="30" rows="3" class="form-control @error('address') is-invalid @enderror">{{  old('address',$company->address)}}</textarea>
					
					@error('address')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group validated">
					<label class="form-control-label" for="city">City</label>
					<input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city',$company->city) }}">
					@error('city')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-3">
				<div class="form-group validated">
					<label class="form-control-label" for="zipcode">ZipCode</label>
					<input type="number" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" name="zipcode" value="{{ old('zipcode',$company->zipcode) }}">
					@error('zipcode')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-3">
				<div class="form-group validated">
					<label class="form-control-label" for="state">State</label>
					<select name="state"  class="form-control @error('state') is-invalid @enderror">
						<option value="">select state</option>
						@foreach ($states as $state)
							<option value="{{ $state->id }}" {{ old('state',$company->state)==$state->id?'selected':'' }}>{{ $state->name ?? '' }}</option>
						@endforeach
					</select>
					
					@error('state')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-3">
				<div class="form-group validated">
					<label class="form-control-label" for="country">Country</label>
					<select name="country"  class="form-control @error('country') is-invalid @enderror">
						<option value="">select country</option>
						@foreach ($countries as $country)
							<option value="{{ $country->id }}" {{ old('country',$company->country)==$country->id?'selected':'' }}>{{ $country->name ?? '' }}</option>
						@endforeach
					</select>
					
					@error('country')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" for="mobile_number">Mobile Number</label>
					<input type="text" class="form-control @error('phone') is-invalid @enderror" id="mobile_number" name="phone" value="{{ old('phone',$company->phone) }}">
					@error('phone')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" for="phone_number">Phone Number</label>
					<input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number',$company->phone_number) }}">
					@error('phone_number')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" for="email">Email</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$company->email) }}">
					@error('email')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" for="website">Website</label>
					<input type="url" class="form-control @error('website') is-invalid @enderror" id="wensite" name="website" value="{{ old('website',$company->website) }}">
					@error('website')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group validated">
					<label class="form-control-label" for="gst_no">GST No</label>
					<input type="text" class="form-control @error('gst_no') is-invalid @enderror" id="gst_no" name="gst_no" value="{{ old('gst_no',$company->gst_no) }}">
					@error('gst_no')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-4">
				<div class="form-group validated">
					<label class="form-control-label" for="state_code">State Code</label>
					<input type="number" class="form-control @error('state_code') is-invalid @enderror" id="state_code" name="state_code" value="{{ old('state_code',$company->state_code) }}">
					@error('state_code')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-4">
				<div class="form-group validated">
					<label class="form-control-label" for="logo">Pan Card</label>
					<input type="text" class="form-control @error('pan_card') is-invalid @enderror" id="pan_card" name="pan_card" value="{{ old("pan_card",$company->pan_card) }}">
					@error('pan_card')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group validated">
					<label class="form-control-label" for="logo">Logo</label>
					<img src="{{ asset("storage/{$company->logo}") }}" alt="" width="10%">
					<input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" value="{{ old('logo') }}">
					@error('logo')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" for="header_image">Header Image</label>
					<img src="{{ asset("storage/{$company->header_image}") }}" alt="" width="10%">
					<input type="file" class="form-control @error('header_image') is-invalid @enderror" id="header_image" name="header_image" value="{{ old('header_image') }}">
					@error('header_image')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" for="footer_image">Footer Image</label>
					<img src="{{ asset("storage/{$company->footer_image}") }}" alt="" width="10%">
					<input type="file" class="form-control @error('footer_image') is-invalid @enderror" id="footer_image" name="footer_image" value="{{ old('footer_image') }}">
					@error('footer_image')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group validated">
					<label class="form-control-label" for="note">Note</label>
					<textarea  class="form-control @error('note') is-invalid @enderror"id="note" name="note" cols="30" rows="5">{{ old('note',$company->note) }}</textarea>
					
					@error('note')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			
			
		</div>
		
	</div>
		<div class="kt-portlet__foot">
			<div class="kt-form__actions">
				<button type="submit" class="btn btn-primary">Update</button>

				<button type="submit" name="update_and_cancel" class="btn btn-secondary">Update & Close
				</button>
				<a href="{{ route('company.index') }}" class="btn btn-danger">Cancel</a>
			</div>
		</div>
	</form>

										<!--end::Form-->
									</div>

									<!--end::Portlet-->

									<!--begin::Portlet-->
									

									<!--end::Portlet-->

									<!--begin::Portlet-->
									

									<!--end::Portlet-->
								</div>
								
							</div>
						</div>

						<!-- end:: Content -->
					</div>

					<!-- begin:: Footer -->
						@include('layouts.footer-text')

					<!-- end:: Footer -->
				</div>
			</div>
		</div>
@push('script')
	<script>
		@if (Session::has('success'))
			
			Swal.fire({
	  			icon: 'success',
	  			title: 'Success',
	  			text: '{{ Session::get('success') }}',
			});
		@endif
	</script>
@endpush
@endsection