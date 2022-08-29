@extends('layouts.master')
@section('title')
    @lang('site.invoice_details')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('site.invoices')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    @lang('site.invoice_details')</span>
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

        <div class="panel panel-primary tabs-style-3 card">
            <div class="tab-menu-heading">
                <div class="tabs-menu ">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-laptop"></i> @lang('site.invoice_details')</a></li>
                        <li><a href="#tab12" class="" data-toggle="tab"><i class="fa fa-cube"  ></i> @lang('site.invoice_status')</a></li>
                        <li><a href="#tab13" class="" data-toggle="tab"><i class="fa fa-cogs"  ></i> @lang('site.invoice_attachments')</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body">
                <div class="tab-content">

                    <div class="tab-pane active table-responsive" id="tab11">
                        <table class="table table-striped" style="text-align: center">
                            <tbody>
                                <tr>
                                    <th scope="row">@lang('site.invoice_number')</th>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <th scope="row">@lang('site.invoice_date')</th>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <th scope="row">@lang('site.invoice_due_date')</th>
                                    <td>{{ $invoice->due_date }}</td>
                                    <th scope="row">@lang('site.category')</th>
                                    <td>{{ $invoice->categories->section_name }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">@lang('site.product')</th>
                                    <td>{{ $invoice->product }}</td>
                                    <th scope="row">@lang('site.total_amount')</th>
                                    <td>{{ $invoice->amount_collection }}</td>
                                    <th scope="row"> @lang('site.commission_amount')</th>
                                    <td>{{ $invoice->amount_commission }}</td>
                                    <th scope="row">@lang('site.discount')</th>
                                    <td>{{ $invoice->discount }}</td>
                                </tr>

                                <tr>
                                    <th scope="row"> @lang('site.VAT_rate')</th>
                                    <td>{{ $invoice->rate_vat }}</td>
                                    <th scope="row">@lang('site.VAT')</th>
                                    <td>{{ $invoice->value_vat }}</td>
                                    <th scope="row"> @lang('site.total_amount')</th>
                                    <td>{{ $invoice->total }}</td>
                                    <th scope="row"> @lang('site.status')</th>

                                    @if ($invoice->value_status == 1)
                                        <td><span class="badge badge-pill badge-success">{{ $invoice->status }}</span>
                                        </td>
                                    @elseif($invoice->value_status == 2)
                                        <td><span class="badge badge-pill badge-danger">{{ $invoice->status }}</span>
                                        </td>
                                    @else
                                        <td><span class="badge badge-pill badge-warning">{{ $invoice->status }}</span>
                                        </td>
                                    @endif
                                </tr>

                                <tr>
                                    <th scope="row">@lang('site.notes')</th>
                                    <td>{{ $invoice->note }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="tab-pane table-responsive" id="tab12">
                        <table class="table table-striped" style="text-align: center">
                            <thead>
                                <tr class="text-dark">
                                    <th>#</th>
                                    <th> @lang('site.invoice_number')</th>
                                    <th> @lang('site.product')</th>
                                    <th>@lang('site.category')</th>
                                    <th> @lang('site.status')</th>
                                    <th> @lang('site.invoice_due_date')</th>
                                    <th>@lang('site.notes')</th>
                                    <th> @lang('site.invoice_date')</th>
                                    <th>@lang('site.user')</th>
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
                                            <td><span class="badge badge-pill badge-success">{{ $x->status }}</span>
                                            </td>
                                        @elseif($x->value_status == 2)
                                            <td><span class="badge badge-pill badge-danger">{{ $x->status }}</span>
                                            </td>
                                        @else
                                            <td><span class="badge badge-pill badge-warning">{{ $x->status }}</span>
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

                    <div class="tab-pane table-responsive" id="tab13">

                        <form action="{{ route('attachment.store') }}" method="post" enctype="multipart/form-data"
                            class="col-sm-12 col-md-12 m-5">
                            @csrf
                            <p class="text-danger">* pdf, jpeg ,.jpg , png </p>
                            <h4>@lang('site.add_attachment')</h4>

                            <input required type="file" name="pic" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                            <input type="hidden" name='invoice_number' value={{ $invoice->invoice_number }}>
                            <input type="hidden" name='invoice_id' value={{ $invoice->id }}>
                            <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                        </form>

                        <div class="table-responsive mt-15">
                            <table class="table center-aligned-table mb-0 table table-hover" style="text-align:center">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('site.file_name')</th>
                                        <th scope="col"> @lang('site.user_add')</th>
                                        <th scope="col"> @lang('site.add_date')</th>
                                        <th scope="col">@lang('site.actions')</th>
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
                                                    role="button"><i class="fas fa-eye"></i>&nbsp;@lang('site.show')</a>

                                                <a class="btn btn-outline-info btn-sm"
                                                    href="{{ url('dowenload_file') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                    role="button"><i class="fas fa-download"></i>&nbsp;
                                                    @lang('site.downlode')</a>


                                                <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                    data-file_name="{{ $attachment->file_name }}"
                                                    data-invoice_number="{{ $attachment->invoice_number }}"
                                                    data-id_file="{{ $attachment->id }}"
                                                    data-target="#delete_file">@lang('site.delete')</button>


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
                    <h5 class="modal-title" id="exampleModalLabel">@lang('site.delete_attachment')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('delete_file') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red">@lang('site.Are_atta_deleted')</h6>
                        </p>

                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">@lang('site.sure')</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site.close')</button>
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
