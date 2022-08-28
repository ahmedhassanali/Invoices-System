@extends('layouts.master')
@section('title')
	 @lang('site.invoice_report')
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">@lang('site.invoices')
							</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/@lang('site.invoice_report')</span>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

				@if(session()->has('delete'))

				<script>
					window.onload = function(){
						notif({
							msg: @lang('site.deleted_successfully'),
							type: "success"
						})
					}
				</script>

				@endif

				@if(session()->has('archive'))

				<script>
					window.onload = function(){
						notif({
							msg:@lang('site.archive_successfully'),
							type: "success"
						})
					}
				</script>

				@endif

				<!-- row -->
				<div class="row">



					<div class="col-xl-12">
						<div class="card mg-b-20">
				
							<div class="card-body pb-0">
				
								<form action="invoice_report" method="POST" role="search" autocomplete="off">
									{{ csrf_field() }}
				
				
									<div class="row">
				
										<div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
											<p class="mg-b-10">@lang('site.invoice_type')</p>
											<select value='%%' class="form-control select2" name="type"
												>
												<option  selected>
													
												</option>
				
												<option value=1>  @lang('site.paid_invoices')</option>
												<option value=2>  @lang('site.unpaid_invoices')</option>
												<option value=3>  @lang('site.partially_paid_invoices')</option>
				
											</select>
										</div><!-- col-4 -->
				
										<div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoice_number">
											<p class="mg-b-10"> @lang('site.invoice_number')</p>
											<input type="text" class="form-control" id="invoice_number" name="invoice_number">
										</div><!-- col-4 -->
				
										<div class="col-lg-3 mg-t-20 mg-lg-t-0">

											<label for="inputName" class="control-label">@lang('site.category')</label>
											<select value="%%"  class="form-control select2"  name="Section"
											onclick="console.log($(this).val())"
												onchange="console.log('change is firing')">
												<!--placeholder-->
												<option value="%%" selected > </option>
												@foreach ($sections as $section)
													<option value="{{ $section->id }}"> {{ $section->section_name }}</option>
												@endforeach
											</select>

										</div>
										
										<div class="col-lg-3 mg-t-20 mg-lg-t-0">
											<label for="inputName"  class="control-label">@lang('site.producte')</label>
											<select id="product"  name="product" class="form-control select2">
												<option selected value="%%" > @lang('site.producte')</option>
											</select>
										</div>

									</div>
			
									<div class="row">
										<div class="col-lg-3" id="start_at">
											<label for="exampleFormControlSelect1"> @lang('site.from_date')</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-calendar-alt"></i>
													</div>
												</div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
													name="start_at" placeholder="YYYY-MM-DD" type="text">
											</div><!-- input-group -->
										</div>

										<div class="col-lg-3" id="end_at">
											<label for="exampleFormControlSelect1"> @lang('site.to_date')</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-calendar-alt"></i>
													</div>
												</div><input class="form-control fc-datepicker" name="end_at"
													value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="text">
											</div><!-- input-group -->
										</div>

										<div class=" col-lg-3 col-sm-2 col-md-2 mt-2">
											<label class="" for=""></label>
											<button class="btn btn-primary btn-block">@lang('site.search')</button>
										</div>
									</div>
										
									</div><br>
												
								</form>
								
							</div>
						</div>
					</div>


						<!--div-->
						<div class="col-xl-12">
							<div class="card mg-b-20">
								<div class="card-header pb-0">
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="example1" class="table key-buttons text-md-nowrap">
											<thead>
												<tr>
													<th class="border-bottom-0">#</th>
													<th class="border-bottom-0"> @lang('site.invoice_number')</th>
													<th class="border-bottom-0"> @lang('site.invoice_date')</th>
													<th class="border-bottom-0"> @lang('site.invoice_due')</th>
													<th class="border-bottom-0">@lang('site.product')</th>
													<th class="border-bottom-0">@lang('site.category')</th>
													<th class="border-bottom-0">@lang('site.discount')</th>
													<th class="border-bottom-0"> @lang('site.VAT_rate')</th>
													<th class="border-bottom-0"> @lang('site.VAT')</th>
													<th class="border-bottom-0">@lang('site.total')</th>
													<th class="border-bottom-0">@lang('site.status')</th>
													<th class="border-bottom-0">@lang('site.notes')</th>
													<th class="border-bottom-0">@lang('site.actions')</th>
												</tr>
											</thead>
											<tbody>

												@php
													$i=1;	
												@endphp
												@foreach ($invoices as $invoice)
												<tr>
													<td>{{$i}}</td>
													<td>{{$invoice->invoice_number}}</td>
													<td>{{$invoice->invoice_date}}</td>
													<td>{{$invoice->due_date}}</td>
													<td>{{$invoice->product}}</td>
													<td>
													
															<a href=" {{ url('invoicesDetails') }}/{{ $invoice->id }} ">{{$invoice->categories->section_name}}</a>
													
													</td>
													<td>{{$invoice->discount}}</td>
													<td>{{$invoice->rate_vat}}</td>
													<td>{{$invoice->value_vat}}</td>
													<td>{{$invoice->total}}</td>
													<td>
													
														@if ($invoice->value_status == 1)
														<span class="badge badge-pill badge-success">{{$invoice->status}}</span>
														@elseif ($invoice->value_status == 2)
														<span class="badge badge-pill badge-danger">{{$invoice->status}}</span>
														@else
														<span class="badge badge-pill badge-warning">{{$invoice->status}}</span>
														@endif
													
													
													</td>
													<td>{{$invoice->note}}</td>
													<td class="">

														<a class=" btn btn-sm btn-info"
														href="{{ url('invoice/edit') }}/{{ $invoice->id }}" title="تعديل"><i class="las la-pen"></i>@lang('site.update')</a>

														<a class=" btn btn-sm btn-danger" data-effect="effect-scale"
														data-toggle="modal"  data-invoice_id = "{{ $invoice->id }}"
														href="#modal_delete" title="حذف"><i class="las la-trash"></i>@lang('site.delete')</a>
													
														<a class="btn btn-sm btn-info mt-1"
														href="{{ url('invoice/edit_status') }}/{{ $invoice->id }}" title=" "><i class="las la-pen"></i>@lang('site.update_status')</a>

														<a class=" btn btn-sm btn-danger mt-1" data-effect="effect-scale"
														data-toggle="modal"  data-invoice_id = "{{ $invoice->id }}"
														href="#modal_archive" title="نقل الي الارشيف">@lang('site.archive')</a>

														<a class="btn btn-sm btn-info mt-1"
														href="{{ url('invoice/print') }}/{{ $invoice->id }}" title=" "><i class="las la-pen"></i> @lang('site.print_invoice')</a>

														
													</td>
												</tr>
												@php
												$i++;
												@endphp

												@endforeach

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!--/div-->

						<!-- Delete modal -->
						<div class="modal" id="modal_delete">
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">@lang('site.delete_invoice')</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
									<form action="invoices/destroy" method="post" >
										@csrf
										{{method_field('delete')}}
											<div class="form-group">
												<input type="hidden" name="invoice_id" id="invoice_id" value="">
												<label for="">@lang('site.Are_invoice_deleted')</label>
											</div>
											
											<div class="modal-footer">
												<button class="btn btn-info" type="submit"> @lang('site.sure')</button>
												<button class="btn btn-danger" data-dismiss="modal" type="button">@lang('site.cancel')</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- End Delete modal -->

							<!-- archive modal -->
						<div class="modal" id="modal_archive">
							<div class="modal-dialog" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">@lang('site.archive_invoice')</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
									<form action={{ route('archive') }} method="post" >
										@csrf
										
											<div class="form-group">
												<input type="hidden" name="invoice_id" id="invoice_id" value="">
												<label for="">@lang('site.Are_invoice_archive')</label>
											</div>
											
											<div class="modal-footer">
												<button class="btn btn-info" type="submit">@lang('site.sure')</button>
												<button class="btn btn-danger" data-dismiss="modal" type="button">@lang('site.close')</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- End archive modal -->

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
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
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<script>
	$('#modal_delete').on('show.bs.modal',function(event)
	{
		var button = $(event.relatedTarget)
		var modal = $(this)
		modal.find('.modal-body #invoice_id').val(button.data('invoice_id'));
	})
</script>
<script>
	$('#modal_archive').on('show.bs.modal',function(event)
	{
		var button = $(event.relatedTarget)
		var modal = $(this)
		modal.find('.modal-body #invoice_id').val(button.data('invoice_id'));
	})
</script>


<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(document).ready(function() {
        $('select[name="Section"]').on('change', function() {
            var SectionId = $(this).val();
            if (SectionId) {
                $.ajax({
                    url: "{{ URL::to('section') }}/" + SectionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="product"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="product"]').append('<option value="' +
                                value + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


@endsection
