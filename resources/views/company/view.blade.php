@extends('layouts.app')
@section('content')

<div class="kt-grid kt-grid--hor kt-grid--root">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
		<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

						<!-- begin:: Subheader -->
						

						<!-- end:: Subheader -->

						<!-- begin:: Content -->
						<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Company Listing
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												
												&nbsp;
												<a href="{{ route('company.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
													<i class="la la-plus"></i>
													New Record
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
									<div class="row">
										<div class="col-md-2">
											<button type="button" class="btn btn-danger" id="multipleDelete">Delete All Selected </button>
										</div>
										<div class="col-md-1" style="float: left;">
										<form action="" id="pagination">
										@foreach ($_GET as $key => $value)
											@if ($key == 'pagination')
												@continue
											@endif
									<input type="hidden" value="{{ $value }}" name="{{ $key }}">
										@endforeach
					<select name="pagination" class="form-control">
						<option value="10" {{ request()->pagination == 10 ?'selected':'' }}>10</option>
						<option value="20" {{ request()->pagination == 20 ?'selected':'' }}>20</option>
						<option value="30" {{ request()->pagination == 50 ?'selected':'' }}>50</option>
						<option value="100" {{ request()->pagination == 100 ?'selected':'' }}>100</option>
					</select>
										</form>
										</div>
										<div class="col-md-6"></div>
										<div class="col-md-3">
	<form action="">
		@foreach ($_GET as $key => $value)
			@if ($key == 'search')
				@continue
			@endif
			<input type="hidden" value="{{ $value }}" name="{{ $key }}">
		@endforeach
											<div class="input-group">
	<input type="text" class="form-control" placeholder="Search for..." name="search" value="{{ request()->search }}">
      <span class="input-group-btn">
        <button class="btn btn-search" type="submit">
        	<i class="fa fa-search fa-fw"></i> 
        </button>
      </span>
											</div>
	</form>
										</div>
									</div>
									<br>
	
									<!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" >
										<thead>
											<tr>
												<th>#</th>
												<th>Record ID</th>
												<th>@sortablelink('name')</th>
												<th>@sortablelink('address')</th>
												<th>@sortablelink('city')</th>
												<th>@sortablelink('zipcode')</th>
												<th>@sortablelink('phone',"Mobile Number")</th>
												<th>@sortablelink('gst_no','GST')</th>
												<th>Created At</th>
												<th>Updated At</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<form action="">
@foreach ($_GET as $key => $value)
	@if (in_array($key, ['name','address','city','zipcode','mobile_number','gst_no']))
		@continue
@endif
	<input type="hidden" value="{{ $value }}" name="{{ $key }}">
@endforeach
											<tr>
												<td><input type="checkbox" class="form-control deleteAll"></td>
												<td>
													
												</td>
												<td>
<input type="text" class="form-control" name="name" value="{{ request()->name ?? ''}}">
												</td>
												<td>
<input type="text" class="form-control" name="address" value="{{ request()->address ?? '' }}">
												</td>
												<td>
<input type="text" class="form-control" name="city" value="{{ request()->city ?? '' }}">
												</td>
												<td>
<input type="text" class="form-control" name="zipcode" value="{{ request()->zipcode ?? '' }}">
												</td>
												<td>
<input type="text" class="form-control" name="mobile_number" value="{{ request()->mobile_number ?? '' }}">
												</td>
												<td>
<input type="text" class="form-control" name="gst_no" value="{{ request()->gst_no ?? '' }}">
												</td>
												<td>
													
												</td>
												<td>
													
												</td>
												<td>
													<button type="submit" class="btn btn-primary">Filter</button>
												</td>		
											</tr>
											</form>
										@forelse ($companies as $key => $_company)
											<tr>
												<td><input type="checkbox" class="form-control delete" value="{{ $_company->id }}" name="ids[]"></td>
												<td>{{ ++$key }}</td>
												<td>{{ $_company->name ?? '' }}</td>
												<td>{{ $_company->address ?? '' }}</td>
												<td>{{ $_company->city ?? '' }}</td>
												<td>{{ $_company->zipcode ?? '' }}</td>
												<td>{{ $_company->phone ?? '' }}</td>
												<td>{{ $_company->gst_no ??'' }}</td>
												<td>{{ $_company->created_at ?? '' }}</td>
												<td>{{ $_company->updated_at->diffForHumans() }}</td>
												<td>
													<a href="{{ route('company.edit',$_company->id) }}"><i class="fa fa-edit" title="Edit"></i></a>
													
													<a href="#" onclick="deleteUser('{{ $_company->id }}')"><i class="fa fa-trash" title="Delete"></i></a>
<form action="{{ route('company.destroy',$_company->id) }}" method="post" id="delete{{ $_company->id }}"> 
	@method('DELETE')
	@csrf
	
	
</form>
												</td>
											</tr>
										@empty
											<tr>
												<td colspan="11" style="text-align: center">No data found</td>
											</tr>
										@endforelse
										</tbody>
									</table>
									  <div class="dataTables_info" id="kt_table_1_info" role="status" aria-live="polite">

	</div>
	<div class="row">
		<div class="col-md-3">
			{{ $companies->firstItem()}} to {{ $companies->lastItem()}} of  {{ $companies->total()}} entries 			
		</div>
		<div class="col-md-1">
							
		</div>
		<div class="col-md-8">
			 <div id="pagination" style="float: right;">	{{ $companies->appends($_GET)->links() }}</div>
		</div>
	</div>
				
				 
										
									

									<!--end: Datatable -->
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
<form action="{{ route('company.destroy.all') }}" method="post" id="deleteAllForm">
	@csrf
	<input type="hidden" name="ids" id="ids">
</form>
@push('script')
	<script>
	var ids = [];
		function deleteUser(id){
			event.preventDefault();
			Swal.fire({
  				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.value) {
				    $(`#delete${id}`).submit();
				}
			});
		}

		@if (Session::has('success'))
			
			Swal.fire({
	  			icon: 'success',
	  			title: 'Success',
	  			text: '{{ Session::get('success') }}',
			});
		@endif

		$("#multipleDelete").click(function(){
			$(".delete").each(function(){
				if($(this).is('checked',false)){
					console.log(this);
				}
			});
		});
$(document).ready(function(){
    	$('.deleteAll').on('click',function(){

	        if(this.checked){
	            $('.delete').each(function(){
	                this.checked = true;
	            });
	        }else{
	             $('.delete').each(function(){
	                this.checked = false;
	            });
	        }
    	});
    
	    $('.delete').on('click',function(){
	        if($('.delete:checked').length == $('.delete').length){
	            $('.deleteAll').prop('checked',true);
	        }else{
	            $('.deleteAll').prop('checked',false);
	        }
	    });

	    $("#multipleDelete").click(function(){
	    	if($('.delete:checked').length == 0){
	    		Swal.fire({
		  			icon: 'warning',
		  			title: 'Warning',
		  			text: 'Please Check Atleat One Checkbox',
				});
	    	}else{
	    		$('.delete').each(function(){
	    			this.checked?ids.push(this.value):'';
	    		});
	    		$("#ids").val(JSON.stringify(ids));
	    		Swal.fire({
	  				title: 'Are you sure?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					  if (result.value) {
					    $("#deleteAllForm").submit();
					}
				});
	    		
	    	}
	    });

	    $("SELECT[name=pagination]").change(function(){
	    	$("#pagination").submit();
	    });

});
	</script>
@endpush
@endsection