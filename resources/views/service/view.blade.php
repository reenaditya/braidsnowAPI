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
											Service Listing
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												
												&nbsp;
												<a href="{{ route('services.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
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
												<th width="2%">#</th>
												<th width="3%">S.no</th>
												<th width="55%">@sortablelink('title')</th>
												<th width="5%">@sortablelink('sorting')</th>
												<th width="5%">Image</th>
												<th width="10%">Created At</th>
												<th width="10%">Updated At</th>
												<th width="10%">Actions</th>
											</tr>
										</thead>
										<tbody>
											<form action="">
@foreach ($_GET as $key => $value)
	@if (in_array($key, ['title','sorting']))
		@continue
@endif
	<input type="hidden" value="{{ $value }}" name="{{ $key }}">
@endforeach
											<tr>
												<td><input type="checkbox" class="deleteAll"></td>
												<td>
													
												</td>
												<td>
<input type="text" class="form-control" name="title" value="{{ request()->title ?? ''}}">
												</td>
												<td>
<input type="text" class="form-control" name="sort" value="{{ request()->sorting ?? '' }}">
												</td>
												<td>

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
										@forelse ($services as $key => $_service)
											<tr>
												<td><input type="checkbox" class="delete" value="{{ $_service->uuid }}" name="ids[]"></td>
												<td>{{ ++$key }}</td>
												<td>{{ $_service->title ?? '' }}</td>
												<td>{{ $_service->sorting ?? '' }}</td>
												<td>
													<img 
													src="{{ asset('storage/'.$_service->image) }}" 
													style="width:90%" 
													alt="">
												</td>
												<td>{{ $_service->created_at ?? '' }}</td>
												<td>{{ $_service->updated_at->diffForHumans() }}</td>
												<td>
													<a href="{{ route('services.edit',$_service->uuid) }}"><i class="fa fa-edit" title="Edit"></i></a>
													
													<a href="#" onclick="deleteUser('{{ $_service->uuid }}')"><i class="fa fa-trash" title="Delete"></i></a>
<form action="{{ route('services.destroy',$_service->uuid) }}" method="post" id="delete{{ $_service->uuid }}"> 
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
			{{ $services->firstItem()}} to {{ $services->lastItem()}} of  {{ $services->total()}} entries 			
		</div>
		<div class="col-md-1">
							
		</div>
		<div class="col-md-8">
			 <div id="pagination" style="float: right;">	{{ $services->appends($_GET)->links() }}</div>
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
<form action="{{ route('services.destroy.all') }}" method="post" id="deleteAllForm">
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