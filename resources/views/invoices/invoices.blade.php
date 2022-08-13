@extends('layouts.master')
@section('title')
 قائمة الفواتير
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
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير</span>
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
							msg:'تم حذف الفاتورة بنجاح',
							type: "success"
						})
					}
				</script>
				@endif

				@if(session()->has('archive'))
				<script>
					window.onload = function(){
						notif({
							msg:'تم ارشفت الفاتورة بنجاح',
							type: "success"
						})
					}
				</script>
				@endif

				<div class="row mt-3">
					<a class=" btn btn-primary col-2 m-2"  href="invoices/create">اضافة فاتورة</a>
					<a class=" btn btn-primary col-2 m-2"  href="invoices/export">تصدير اكسيل</a>
				</div>
				<!-- row -->
				<div class="row">

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
													<th class="border-bottom-0">رقم الفاتورة</th>
													<th class="border-bottom-0">تاريخ الفاتورة</th>
													<th class="border-bottom-0">تاريخ الاستحقاق</th>
													<th class="border-bottom-0">المنتج</th>
													<th class="border-bottom-0">القسم</th>
													<th class="border-bottom-0">الخصم</th>
													<th class="border-bottom-0">نسبة الضريبة</th>
													<th class="border-bottom-0">قيمة الضريبة</th>
													<th class="border-bottom-0">الاجمالي</th>
													<th class="border-bottom-0">الحالة</th>
													<th class="border-bottom-0">ملاحظات</th>
													<th class="border-bottom-0">العمليات</th>
												</tr>
											</thead>
											<tbody>

												@php
													$i=1;	
												@endphp
												@foreach ($invoices as $invoice)
												<tr>
													<td>{{$i}}</td>
													<td>
														<a href="{{ url('invoicesDetails') }}/{{ $invoice->id }} ">{{$invoice->invoice_number}}</a>
														
													</td>
													<td>{{$invoice->invoice_date}}</td>
													<td>{{$invoice->due_date}}</td>
													<td>{{$invoice->product}}</td>
													<td>{{$invoice->categories->section_name}}</td>
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
														href="{{ url('invoice/edit') }}/{{ $invoice->id }}" title="تعديل"><i class="las la-pen"></i>تعديل</a>

														<a class=" btn btn-sm btn-danger" data-effect="effect-scale"
														data-toggle="modal"  data-invoice_id = "{{ $invoice->id }}"
														href="#modal_delete" title="حذف"><i class="las la-trash"></i>حذف</a>
													
														<a class="btn btn-sm btn-info mt-1"
														href="{{ url('invoice/edit_status') }}/{{ $invoice->id }}" title=" "><i class="las la-pen"></i> تعديل الحالة</a>

														<a class=" btn btn-sm btn-danger mt-1" data-effect="effect-scale"
														data-toggle="modal"  data-invoice_id = "{{ $invoice->id }}"
														href="#modal_archive" title="نقل الي الارشيف">الارشفة</a>

														<a class="btn btn-sm btn-info mt-1"
														href="{{ url('invoice/print') }}/{{ $invoice->id }}" title=" "><i class="las la-pen"></i> طباعة الفاتورة</a>

														
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
										<h6 class="modal-title">حذف فاتورة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
									<form action="invoices/destroy" method="post" >
										@csrf
										{{method_field('delete')}}
											<div class="form-group">
												<input type="hidden" name="invoice_id" id="invoice_id" value="">
												<label for="">هل انت متاكد من حذف هذة الفاتورة</label>
											</div>
											
											<div class="modal-footer">
												<button class="btn btn-info" type="submit">حذف الفاتورة</button>
												<button class="btn btn-danger" data-dismiss="modal" type="button">اغلاق</button>
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
										<h6 class="modal-title">ارشفة الفاتورة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
									<form action={{ route('archive') }} method="post" >
										@csrf
										
											<div class="form-group">
												<input type="hidden" name="invoice_id" id="invoice_id" value="">
												<label for="">هل انت متاكد من عملية الارشفة</label>
											</div>
											
											<div class="modal-footer">
												<button class="btn btn-info" type="submit">تاكيد </button>
												<button class="btn btn-danger" data-dismiss="modal" type="button">اغلاق</button>
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
