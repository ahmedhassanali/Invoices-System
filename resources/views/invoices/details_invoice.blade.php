@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
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

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

				<!-- row -->
				<div class="">

                    <div class="panel panel-primary tabs-style-3">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu ">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-laptop"></i> تفاصيل الفاتورة</a></li>
                                    <li><a href="#tab12" data-toggle="tab"><i class="fa fa-cube"></i> حالات الفاتورة</a></li>
                                    <li><a href="#tab13" data-toggle="tab"><i class="fa fa-cogs"></i> مرفقات الفاتورة</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                        <div class="tab-pane active" id="tab11">
                                            <table class="table table-striped" style="text-align: center">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">رقم الفاتورة</th>
                                                    <td>{{$invoice->invoice_number}}</td>
                                                    <th scope="row">تاريخ الاصدار</th>
                                                    <td>{{$invoice->invoice_date}}</td>
                                                    <th scope="row">تاريخ الاستحقاق</th>
                                                    <td>{{$invoice->due_date}}</td>
                                                    <th scope="row">القسم</th>
                                                    <td>{{$invoice->categories->section_name}}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <th scope="row">المنتج</th>
                                                    <td>{{$invoice->product}}</td>
                                                    <th scope="row"> مبلغ التحصيل</th>
                                                    <td>{{$invoice->amount_collection}}</td>
                                                    <th scope="row">مبلغ العمولة</th>
                                                    <td>{{$invoice->amount_commission}}</td>
                                                    <th scope="row">discount</th>
                                                    <td>{{$invoice->discount}}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">نسبة الضريبة</th>
                                                    <td>{{ $invoice->rate_vat }}</td>
                                                    <th scope="row">قيمة الضريبة</th>
                                                    <td>{{ $invoice->value_vat }}</td>
                                                    <th scope="row">الاجمالي مع الضريبة</th>
                                                    <td>{{ $invoice->total }}</td>
                                                    <th scope="row">الحالة الحالية</th>
                                                    
                                                    @if ($invoice->value_status == 1)
                                                        <td><span
                                                            class="badge badge-pill badge-success">{{ $invoice->status }}</span>
                                                        </td>
                                                    @elseif($invoice->value_status ==2)
                                                        <td><span
                                                            class="badge badge-pill badge-danger">{{ $invoice->status }}</span>
                                                        </td>   
                                                    @else
                                                        <td><span
                                                                class="badge badge-pill badge-warning">{{ $invoice->status }}</span>
                                                        </td>
                                                    @endif
                                                </tr>
                                                        
                                                <tr>
                                                    <th scope="row">ملاحظات</th>
                                                    <td>{{ $invoice->note }}</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab12">
                                            <table class="table table-striped" style="text-align: center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>رقم الفاتورة</th>
                                                        <th>نوع المنتج</th>
                                                        <th>القسم</th>
                                                        <th>حالة الدفع</th>
                                                        <th>تاريخ الدفع </th>
                                                        <th>ملاحظات</th>
                                                        <th>تاريخ الاضافة </th>
                                                        <th>المستخدم</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach ($details as $x)
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $x->invoice_number }}</td>
                                                            <td>{{ $x->product }}</td>
                                                            <td>{{ $invoice->categories->section_name }}</td>
                                                            @if ($x->value_status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $x->status }}</span>
                                                                </td>
                                                            @elseif($x->value_status ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $x->status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $x->status }}</span>
                                                                </td>
                                                            @endif
                                                            <td>{{ $x->payment_date }}</td>
                                                            <td>{{ $x->note }}</td>
                                                            <td>{{ $x->created_at }}</td>
                                                            <td>{{ $x->user }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>                 
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab13">

                                            <form action="{{ route('attachment.store') }}" method="post" enctype="multipart/form-data" class="col-sm-12 col-md-12 m-5">
                                                @csrf
                                                <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                <h4>اضافة مرفق</h4>
                                                
                                                <input required type="file" name="pic"  accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                                <input type="hidden" name = 'invoice_number' value={{$invoice->invoice_number}}>
                                                <input type="hidden" name = 'invoice_id' value={{$invoice->id}}>
                                                <button type="submit" class="btn btn-primary">حفظ المرفق</button>
                                            </form>
                                           
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th scope="col">م</th>
                                                            <th scope="col">اسم الملف</th>
                                                            <th scope="col">قام بالاضافة</th>
                                                            <th scope="col">تاريخ الاضافة</th>
                                                            <th scope="col">العمليات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($attachments as $attachment)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $attachment->file_name }}</td>
                                                                <td>{{ $attachment->create_by }}</td>
                                                                <td>{{ $attachment->created_at }}</td>
                                                                <td colspan="2">

                                                                    <a class="btn btn-outline-success btn-sm"
                                                                        href="{{ url('View_file') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                        role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                        عرض</a>

                                                                    <a class="btn btn-outline-info btn-sm"
                                                                        href="{{ url('dowenload_file') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                        role="button"><i
                                                                            class="fas fa-download"></i>&nbsp;
                                                                        تحميل</a>

                                                                    
                                                                        <button class="btn btn-outline-danger btn-sm"
                                                                            data-toggle="modal"
                                                                            data-file_name="{{ $attachment->file_name }}"
                                                                            data-invoice_number="{{ $attachment->invoice_number }}"
                                                                            data-id_file="{{ $attachment->id }}"
                                                                            data-target="#delete_file">حذف</button>
                                                                   

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <!-- row closed -->
                         <!-- delete -->
                        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('delete_file') }}" method="post">

                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <p class="text-center">
                                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                                        </p>

                                        <input type="hidden" name="id_file" id="id_file" value="">
                                        <input type="hidden" name="file_name" id="file_name" value="">
                                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                        <button type="submit" class="btn btn-danger">تاكيد</button>
                                    </div>
                                </form>
                            </div>
                        </div>
</div>
                    </div>
                    <!-- Container closed -->
                </div>
                <!-- main-content closed -->
                @endsection
                @section('js')

                <script>
                    $('#delete_file').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget)
                        var id_file = button.data('id_file')
                        var file_name = button.data('file_name')
                        var invoice_number = button.data('invoice_number')
                        var modal = $(this)
                        modal.find('.modal-body #id_file').val(id_file);
                        modal.find('.modal-body #file_name').val(file_name);
                        modal.find('.modal-body #invoice_number').val(invoice_number);
                    })
                </script>

                @endsection