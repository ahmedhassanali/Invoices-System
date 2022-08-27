@extends('layouts.master')
@section('title')
	@lang('site.categories')
@endsection

@section('css')
    <!-- Internal Data table css -->
    <link href='/assets/plugins/datatable/css/dataTables.bootstrap4.min.css' rel="stylesheet" />
    <link href='/assets/plugins/datatable/css/buttons.bootstrap4.min.css' rel="stylesheet">
    <link href='/assets/plugins/datatable/css/responsive.bootstrap4.min.css' rel="stylesheet" />
    <link href='/assets/plugins/datatable/css/jquery.dataTables.min.css' rel="stylesheet" />
    <link href='/assets/plugins/datatable/css/responsive.dataTables.min.css' rel="stylesheet" />
    <link href='/assets/plugins/select2/css/select2.min.css' rel="stylesheet" />
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('site.categories')</h4>
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
            <strong class="m-5">{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong class="m-5">{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <a class="modal-effect btn btn-primary btn-block" data-effect="effect-scale" data-toggle="modal"
                    href="#modal_add">@lang('site.add_new_category')</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">@lang('site.category_name')</th>
                                <th class="border-bottom-0">@lang('site.description')</th>
                                <th class="border-bottom-0">@lang('site.actions')</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 0; ?>
                            @foreach ($sections as $section)
                                <?php $i++; ?>
                                <tr>

                                    <td>{{ $i }}</td>
                                    <td>{{ $section->section_name }}</td>
                                    <td>{{ $section->description }}</td>
                                    <td>


                                        <a class="model-effect btn btn-sm btn-info" data-effect="effect-scale"
                                            data-section_id="{{ $section->id }}"
                                            data-section_name="{{ $section->section_name }}"
                                            data-section_description="{{ $section->description }}" data-toggle="modal"
                                            href="#modal_edit" title=@lang('site.update')><i class="las la-pen"></i>@lang('site.update')</a>

                                        <a class="model-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-section_id="{{ $section->id }}"
                                            data-section_name="{{ $section->section_name }}" data-toggle="modal"
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
                    <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">اسم القسم</label>
                            <input type="text" class="form-control" id="section_name" name="section_name" required>
                        </div>
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">حفظ القسم</button>
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
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
                    <h6 class="modal-title">تعديل قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="categories/update" method="post">
                        @csrf
                        {{ method_field('patch') }}


                        <div class="form-group">
                            <input type="hidden" name="section_id" id="section_id" value="">
                            <label for="">اسم القسم</label>
                            <input type="text" class="form-control" id="section_name" name="section_name" required>
                        </div>
                        <div class="form-group">
                            <label for="">ملاحظات</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-info" type="submit">تعديل القسم</button>
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
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
                    <h6 class="modal-title">حذف قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="categories/destroy" method="post">
                        @csrf
                        {{ method_field('delete') }}
                        <div class="form-group">
                            <input type="hidden" name="section_id" id="section_id" value="">
                            <label for="">هل انت متاكد من حذف هذا القسم</label>
                            <input type="text" class="form-control" id="section_name" name="section_name">
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger" type="submit">حذف القسم</button>
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
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
    <!-- Internal Data tables -->
    <script src='/assets/plugins/datatable/js/jquery.dataTables.min.js'></script>
    <script src='/assets/plugins/datatable/js/dataTables.dataTables.min.js'></script>
    <script src='/assets/plugins/datatable/js/dataTables.responsive.min.js'></script>
    <script src='/assets/plugins/datatable/js/responsive.dataTables.min.js'></script>
    <script src='/assets/plugins/datatable/js/jquery.dataTables.js'></script>
    <script src='/assets/plugins/datatable/js/dataTables.bootstrap4.js'></script>
    <script src='/assets/plugins/datatable/js/dataTables.buttons.min.js'></script>
    <script src='/assets/plugins/datatable/js/buttons.bootstrap4.min.js'></script>
    <script src='/assets/plugins/datatable/js/jszip.min.js'></script>
    <script src='/assets/plugins/datatable/js/pdfmake.min.js'></script>
    <script src='/assets/plugins/datatable/js/vfs_fonts.js'></script>
    <script src='/assets/plugins/datatable/js/buttons.html5.min.js'></script>
    <script src='/assets/plugins/datatable/js/buttons.print.min.js'></script>
    <script src='/assets/plugins/datatable/js/buttons.colVis.min.js'></script>
    <script src='/assets/plugins/datatable/js/dataTables.responsive.min.js'></script>
    <script src='/assets/plugins/datatable/js/responsive.bootstrap4.min.js'></script>
    <!--Internal  Datatable js -->
    <script src='/assets/js/table-data.js'></script>
    <!-- Internal Modal js-->
    <script src='/assets/js/modal.js'></script>

    <script>
        $('#modal_edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-body #section_id').val(button.data('section_id'));
            modal.find('.modal-body #section_name').val(button.data('section_name'));
            modal.find('.modal-body #description').val(button.data('section_description'));

        })
    </script>

    <script>
        $('#modal_delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-body #section_id').val(button.data('section_id'));
            modal.find('.modal-body #section_name').val(button.data('section_name'));
        })
    </script>
@endsection
