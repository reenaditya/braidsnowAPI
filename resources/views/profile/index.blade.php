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
													Profile
												</h3>
											</div>
										</div>

										<!--begin::Form-->
<form class="kt-form" method="post" action="{{ route('profile.update') }}">
	@csrf
	
	<div class="kt-portlet__body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group validated">
					<label class="form-control-label" >Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" value="{{ old('name',auth()->user()->name) }}">
					@error('name')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>		
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group validated">
					<label class="form-control-label" >Email</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror"  name="email" value="{{ old('email',auth()->user()->email) }}">
					@error('email')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>		
			</div>
		</div>
		<div class="row" id="password" style="display: none">
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" >Password</label>
					<input type="password" class="form-control @error('password') is-invalid @enderror"  name="password" value="" autocomplete="new-password">
					@error('password')
					<script>
						$(document).ready(function(){
							alert("ddd");
							$("#password").show();
						});
						
					</script>
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>		
			</div>
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" >Confirm Password</label>
					<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"  name="password_confirmation" value="" autocomplete="new-password">
					@error('password_confirmation')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>		
			</div>
			
		</div>
		
		
		
		
	</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
	<button type="submit" class="btn btn-primary">Update</button>
	<button type="button" id="showpassword" class="btn btn-primary">Show Password Box</button>

	
	
	
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
		$(document).ready(function(){
			$("#showpassword").click(function(){
				if($(this).text() == 'Show Password Box'){
					$(this).text('Hide Password Box');
				}else{
					$(this).text('Show Password Box');
				}
				$("#password").toggle();
			});



			@error('password')
				$("#password").show();
				$("#showpassword").text('Hide Password Box');
			@enderror
		});



	</script>

@endpush
@endsection