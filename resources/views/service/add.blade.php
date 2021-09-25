@extends('layouts.app')
@section('content')
<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

						<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="row">
								<div class="col-lg-12">

									<!--begin::Portlet-->
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Service Management
												</h3>
											</div>
										</div>

										<!--begin::Form-->
<form class="kt-form" method="post" action="{{ route('services.store') }}" enctype="multipart/form-data">
	@csrf
	
	<div class="kt-portlet__body">
		<div class="row">
			<div class="col-md-12">
				
				<div class="form-group validated">
					<label class="form-control-label" for="inputSuccess1">Title</label>
					<input type="text" class="form-control @error('title') is-invalid @enderror" id="inputSuccess1" name="title" value="{{ old('title') }}">
					@error('title')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" for="image">Image</label>
					<input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
					@error('image')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="form-group validated">
					<label class="form-control-label" for="sorting">Sorting</label>
					<input type="text" class="form-control @error('sorting') is-invalid @enderror" id="sorting" name="sorting" value="{{ old('sorting') }}">
					@error('sorting')
					<div class="invalid-feedback">{{ $message }}</div>
						
					@enderror
				</div>
				
			</div>
			
			
			
		</div>
		
		
	</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
				<button type="submit" class="btn btn-primary">Submit</button>

				<button type="submit" name="update_and_cancel" class="btn btn-secondary">Submit & Close
				</button>
				<a href="{{ route('services.index') }}" class="btn btn-danger">Cancel</a>

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