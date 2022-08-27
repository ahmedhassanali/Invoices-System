@extends('layouts.master')
@section('title')
	@lang('site.products')
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">@lang('site.products')</h4>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				
				@if(session()->has('Add'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong class="m-5">{{session()->get('Add')}}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
				</div>
				@endif

				

				@if(session()->has('delete'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong class="m-5">{{session()->get('delete')}}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
				</div>
				@endif

				<!-- row -->
				<div class="row">

						<!--div-->
						<div class="col-xl-12">
							<div class="card mg-b-20">
								<div class="card-header pb-0">
									<a class="modal-effect btn btn-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modal_add">@lang('site.add_product') </a>
								</div>
								
								<div class="card-body">
									<div class="table-responsive">
										<table id="example1" class="table key-buttons text-md-nowrap">
											<thead>
												<tr>
													<th class="border-bottom-0">#</th>
													<th class="border-bottom-0">@lang('site.product_name') </th>
													<th class="border-bottom-0">@lang('site.category')</th>
													<th class="border-bottom-0">@lang('site.notes')</th>
													<th class="border-bottom-0">@lang('site.actions')</th>
												</tr>
											</thead>
											<tbody>

												<?php $i=0 ?>
												@foreach ($products as $product)
												<?php $i++ ?>
												<tr>

													<td>{{$i}}</td>
													<td>{{$product->product_name}}</td>
													<td>{{$product->categories->section_name}}</td>
													<td>{{$product->description}}</td>

													<td>
													

														<a class="model-effect btn btn-sm btn-info" data-effect="effect-scale"
														data-product_id="{{$product->id}}" data-product_name="{{$product->product_name}}" 
														data-product_description="{{$product->description}}"  data-section_name="{{$product->categories->section_name}}"  data-toggle="modal"
														href="#modal_edit" title=@lang('site.update')><i class="las la-pen"></i>@lang('site.update')</a>

														<a class="model-effect btn btn-sm btn-danger" data-effect="effect-scale"
														data-product_id="{{$product->id}}" data-product_name="{{$product->product_name}}"  data-toggle="modal"
														href="#modal_delete" title=@lang('site.delete')><i class="las la-trash"></i>@lang('site.delete')</a>
													
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!--/div-->

						<!-- Add modal -->
						<div class="modal" id="modal_add">
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">@lang('site.add_product')</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<form action={{route('products.store')}} method="post">
										@csrf

										<div class="modal-body">

											<div class="form-group">
												<label for="">@lang('site.product_name')</label>
												<input type="text" class="form-control" id="product_name" name="product_name" required>
											</div>

											<div class="form-group">
												<label for="">@lang('site.category_name')</label>
												<select  class="form-control" id="section_name" name="section_name" required> 
													<option>
														@foreach ($sections as $section)
															<option value="{{$section->id}}">{{$section->section_name}}</option>
														@endforeach
													</option>
												</select>
											</div>

											<div class="form-group">
												<label for="">@lang('site.notes')</label>
												<textarea class="form-control" id="description" name="description" rows="3"  ></textarea>
											</div>
											
										</div>

										<div class="modal-footer">
											<button class="btn btn-success" type="submit">@lang('site.save')</button>
											<button class="btn btn-secondary" data-dismiss="modal" type="button">@lang('site.close')</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- End Add modal -->

						<!-- Edit modal -->
						<div class="modal" id="modal_edit">
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">@lang('site.update_product')</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<form action='products/update' method="post">
											@csrf
										{{method_field('patch')}}


											<div class="form-group">
												<input type="hidden" name="product_id" id="product_id" value="">
												<label for="">@lang('site.product_name')</label>
												<input type="text" class="form-control" id="product_name" name="product_name" required>
											</div>

											<div class="form-group">
												<label for="">@lang('site.category_name')</label>
												<select  class="form-control custom-select " id="section_name" name="section_name" required > 
													<option>
														@foreach ($sections as $section)
															<option>{{$section->section_name}}</option>
														@endforeach
													</option>
												</select>
											</div>

											<div class="form-group">
												<label for="">@lang('site.notes')</label>
												<textarea class="form-control" id="description" name="description" rows="3"  ></textarea>
											</div>
											
											
											<div class="modal-footer">
												<button class="btn btn-info" type="submit">@lang('site.update_product')</button>
												<button class="btn btn-secondary" data-dismiss="modal" type="button">@lang('site.close')</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- End Edit modal -->

						<!-- Delete modal -->
						<div class="modal" id="modal_delete">
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">@lang('site.delete_product')</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
									<form action="products/destroy" method="post" >
										@csrf
										{{method_field('delete')}}
											<div class="form-group">
												<input type="hidden" name="product_id" id="product_id" value="">
												<label for="">@lang('site.Are_product_deleted')</label>
												<input type="text" class="form-control" id="product_name" name="product_name">
											</div>
											
											<div class="modal-footer">
												<button class="btn btn-info" type="submit">@lang('site.delete')</button>
												<button class="btn btn-secondary" data-dismiss="modal" type="button">@lang('site.close')</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- End Delete modal -->

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection

@section('js')

<script>
	$('#modal_edit').on('show.bs.modal',function(event)
	{
			var button = $(event.relatedTarget)
			var modal = $(this)
			modal.find('.modal-body #product_name').val(button.data('product_name'));
			modal.find('.modal-body #product_id').val(button.data('product_id'));
			modal.find('.modal-body #section_name').val(button.data('section_name'));
			modal.find('.modal-body #description').val(button.data('product_description'));
			
		})
</script>

<script>
	$('#modal_delete').on('show.bs.modal',function(event)
	{
		var button = $(event.relatedTarget)
		var modal = $(this)
		modal.find('.modal-body #product_id').val(button.data('product_id'));
		modal.find('.modal-body #product_name').val(button.data('product_name'));
	})
	
</script>

<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

@endsection