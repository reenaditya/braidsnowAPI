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
													Customer Management
												</h3>
											</div>
										</div>

										<!--begin::Form-->
<form class="kt-form" method="post" action="{{ route('user.update',$user->id) }}">
	@csrf
	@method('PUT')
	
	<div class="kt-portlet__body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group validated">
					<label class="form-control-label" >*Category</label>
					<select name="user_type" class="form-control" >
						<option value="customer" {{ old('user_type',$user->user_type)=='customer'?'selected':'' }}>Customer</option>
						<option value="supplier" {{ old('user_type',$user->user_type)=='supplier'?'selected':'' }}>Supplier</option>
					</select>
					
					@error('user_type')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group validated">
					<label class="form-control-label" >*Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" value="{{ old('name',$user->name) }}">
					@error('name')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" >Display Name</label>
					<input type="text" class="form-control @error('display_name') is-invalid @enderror"  name="display_name" value="{{ old('display_name',$user->display_name) }}">
					@error('display_name')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" >*Group</label>
					<select name="group_id"  class="form-control @error('group_id') is-invalid @enderror">
						<option value="">select group</option>
						@foreach ($groups as $group)
							<option value="{{ $group->id }}" {{ old('group_id',$user->group_id)==$group->id?'selected':'' }}>{{ $group->name ?? '' }}</option>
						@endforeach
					</select>
					@error('group_id')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group validated">
					<label class="form-control-label" >*Address</label>
					<textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="5">{{ old('address',$user->address) }}  </textarea>
					@error('address')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group validated">
					<label class="form-control-label" >*City</label>
					<input type="text" class="form-control @error('city') is-invalid @enderror"  name="city" value="{{ old('city',$user->city) }}">
					@error('city')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-3">
				<div class="form-group validated">
					<label class="form-control-label" >*Zip Code</label>
					<input type="text" class="form-control @error('zip_code') is-invalid @enderror"  name="zip_code" value="{{ old('zip_code',$user->zip_code) }}">
					@error('zip_code')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-3">
				<div class="form-group validated">
					<label class="form-control-label" >*State</label>
					<select name="state"  class="form-control @error('state') is-invalid @enderror">
						<option value="">select state</option>
						@foreach ($states as $state)
							<option value="{{ $state->id }}" {{ old('state',$user->state_id)==$state->id?'selected':'' }}>{{ $state->name ?? '' }}</option>
						@endforeach
					</select>
					@error('state')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-3">
				<div class="form-group validated">
					<label class="form-control-label" for="country">*Country</label>
					<select name="country"  class="form-control @error('country') is-invalid @enderror">
						<option value="">select country</option>
						@foreach ($countries as $country)
							<option value="{{ $country->id }}" {{ old('country',$user->country)==$country->id?'selected':'' }}>{{ $country->name ?? '' }}</option>
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
					<label class="form-control-label" >*Mobile</label>
					<input type="text" class="form-control @error('mobile_number') is-invalid @enderror"  name="mobile_number" value="{{ old('mobile_number',$user->mobile_number) }}">
					
					@error('mobile_number')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" >Alternate Mobile</label>
					<input type="text" class="form-control @error('alternate_mobile_number') is-invalid @enderror"  name="alternate_mobile_number" value="{{ old('alternate_mobile_number',$user->alternate_mobile_number) }}">
					
					@error('alternate_mobile_number')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group validated">
					<label class="form-control-label">GST NO.</label>
					<input type="text" class="form-control @error('gst_no') is-invalid @enderror" name="gst_no" value="{{ old('gst_no',$user->gst_no) }}">
					@error('gst_no')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-4">
				<div class="form-group validated">
					<label class="form-control-label" >State Code</label>
					<input type="text" class="form-control @error('state_code') is-invalid @enderror"  name="state_code" value="{{ old('state_code',$user->state_code) }}">
					@error('state_code')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-4">
				<div class="form-group validated">
					<label class="form-control-label" >Pancard</label>
					<input type="text" class="form-control @error('pancard') is-invalid @enderror"  name="pancard" value="{{ old('pancard',$user->pancard) }}">
					@error('district')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label">Shipping Address</label>
					<input type="text" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" value="{{ old('shipping_address',$user->shipping_address) }}">
					@error('shipping_address')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label">Shipping Mobile</label>
					<input type="text" class="form-control @error('shipping_mobile') is-invalid @enderror" name="shipping_mobile" value="{{ old('shipping_mobile',$user->shipping_mobile) }}">
					@error('shipping_mobile')
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
<a href="{{ route('user.index') }}" class="btn btn-danger">Cancel</a>
												

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