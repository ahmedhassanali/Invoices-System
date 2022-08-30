@extends('layouts.master')
@section('title')
    @lang('site.archive_invoices')
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('site.invoices')</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/@lang('site.invoices_list')</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: @lang('site.deleted_successfully'),
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('archive'))
        <script>
            window.onload = function() {
                notif({
                    msg: @lang('site.cancel_archive_successfully'),
                    type: "success"
                })
            }
        </script>
    @endif

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
                                    <th class="border-bottom-0"> @lang('site.invoice_number')</th>
                                    <th class="border-bottom-0"> @lang('site.invoice_date')</th>
                                    <th class="border-bottom-0"> @lang('site.invoice_due_date')</th>
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
                                    $i = 1;
                                @endphp
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->invoice_date }}</td>
                                        <td>{{ $invoice->due_date }}</td>
                                        <td>{{ $invoice->product }}</td>
                                        <td>

                                            {{ $invoice->categories->section_name }}

                                        </td>
                                        <td>{{ $invoice->discount }}</td>
                                        <td>{{ $invoice->rate_vat }}</td>
                                        <td>{{ $invoice->value_vat }}</td>
                                        <td>{{ $invoice->total }}</td>
                                        <td>

                                            @if ($invoice->value_status == 1)
                                                <span class="badge badge-pill badge-success">{{ $invoice->status }}</span>
                                            @elseif ($invoice->value_status == 2)
                                                <span class="badge badge-pill badge-danger">{{ $invoice->status }}</span>
                                            @else
                                                <span class="badge badge-pill badge-warning">{{ $invoice->status }}</span>
                                            @endif


                                        </td>
                                        <td>{{ $invoice->note }}</td>
                                        <td class="">

                                            <a class=" btn btn-sm btn-danger" data-effect="effect-scale" data-toggle="modal"
                                                data-invoice_id="{{ $invoice->id }}" href="#modal_delete_archive"
                                                title="حذف"><i class="las la-trash"></i>@lang('site.delete')</a>

                                            <a class=" btn btn-sm btn-danger mt-1" data-effect="effect-scale"
                                                data-toggle="modal" data-invoice_id="{{ $invoice->id }}"
                                                href="#modal_archive" title="نقل الي الفواتير">@lang('site.cancel_archive')</a>

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
        <div class="modal" id="modal_delete_archive">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">@lang('site.delete_invoice')</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action='invoice/destroy_archive' method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="hidden" name="invoice_id" id="invoice_id" value="">
                                <label for="">@lang('site.Are_invoice_deleted')</label>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-info" type="submit">@lang('site.delete')</button>
                                <button class="btn btn-danger" data-dismiss="modal"
                                    type="button">@lang('site.close')</button>
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
                        <h6 class="modal-title">@lang('site.cancel_archive')</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action={{ route('invoice_cancel_archive') }} method="post">
                            @csrf

                            <div class="form-group">
                                <input type="hidden" name="invoice_id" id="invoice_id" value="">
                                <label for="">@lang('site.Are_cancel_invoice_archive')</label>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-info" type="submit"> @lang('site.sure')</button>
                                <button class="btn btn-danger" data-dismiss="modal"
                                    type="button">@lang('site.close')</button>
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
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#modal_delete_archive').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(button.data('invoice_id'));
        })
    </script>
    <script>
        $('#modal_archive').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(button.data('invoice_id'));
        })
    </script>
@endsection
