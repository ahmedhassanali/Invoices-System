@extends('layouts.master')
@section('title')
        @lang('site.invoices_system')
@stop
@section('css')

    <!--  Owl-carousel css-->
    <link href='/assets/plugins/owl-carousel/owl.carousel.css' rel="stylesheet" />
    <!-- Maps css -->
    <link href='/assets/plugins/jqvmap/jqvmap.min.css' rel="stylesheet">

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                {{-- <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">@lang('site.welcome_back')</h2> --}}
            </div>
        </div>
        <div class="main-dashboard-header-right">
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">

        <div class="col-lg-6 col-md-12 col-xs-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="d-flex   justify-content-between">
            
                            <div>
                                <h4 class=" font-weight-bold m-3 text-white">
                                    @lang('site.welcome_back')
                                </h4>
                                    
                                <h2 class=" font-weight-bold  m-3  text-white">
                                    {{ auth()->user()->name }}
                                </h2>

                                <h6 class=" font-weight-bold mt-4 mx-3 text-white">
                                    <a class=" btn btn-dark " href="invoices/create">@lang('site.add_invoice')</a>
                                </h6>

                            </div>
                        
                            <div  class="img-fluid w-50 w-sm-100 d-flex">
                                <img src="{{ URL::asset('assets/img/media/login.svg') }}"
                                class="" alt="logo">
                            </div>
                    
                        </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-12 col-xs-12">
            <div class="row col-12">
                <div class="col-lg-6 col-md-12">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <div class="pl-3 pt-4 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white"> @lang('site.total_invoices')</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h4 class="tx-20 font-weight-bold mb-1 text-white">
        
                                            {{ number_format(\App\Models\invoices::sum('total'), 1) }}
                                        </h4>
                                        <p class="mb-0 tx-12 text-white op-7">{{ \App\Models\invoices::count() }}</p>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">100%</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card overflow-hidden sales-card bg-danger-gradient">
                        <div class="pl-3 pt-4 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">   @lang('site.unpaid_invoices')</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h3 class="tx-20 font-weight-bold mb-1 text-white">
        
                                            {{ number_format(\App\Models\invoices::where('value_status', 2)->sum('total'), 2) }}
        
                                        </h3>
                                        <p class="mb-0 tx-12 text-white op-7">
                                            {{ \App\Models\invoices::where('value_status', 2)->count() }}
                                        </p>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-down text-white"></i>
                                        <span class="text-white op-7">
        
                                            @php
                                                $count_all = \App\Models\invoices::count();
                                                $count_invoices2 = \App\Models\invoices::where('value_status', 2)->count();
                                                if ($count_invoices2 == 0) {
                                                    echo $count_invoices2 = 0;
                                                } else {
                                                    echo $count_invoices2 =number_format(($count_invoices2 / $count_all) * 100 ,2) ;
                                                }
                                            @endphp
        
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
                    </div>
                </div>
            </div>
            <div class="row col-12">
                <div class="col-lg-6 col-md-12">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <div class="pl-3 pt-4 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">@lang('site.paid_invoices')</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h4 class="tx-20 font-weight-bold mb-1 text-white">
        
                                            {{ number_format(\App\Models\invoices::where('value_status', 1)->sum('total'), 2) }}
        
                                        </h4>
                                        <p class="mb-0 tx-12 text-white op-7">
                                            {{ \App\Models\invoices::where('value_status', 1)->count() }}
                                        </p>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">
                                            @php
                                                $count_all = \App\Models\invoices::count();
                                                $count_invoices1 = \App\Models\invoices::where('value_status', 1)->count();
                                                if ($count_invoices1 == 0) {
                                                    echo $count_invoices1 = 0;
                                                } else {
                                                    echo $count_invoices1 =number_format(($count_invoices1 / $count_all) * 100 ,2) ;
                                                }
                                            @endphp
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card overflow-hidden sales-card bg-warning-gradient">
                        <div class="pl-3 pt-4 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">@lang('site.partially_paid_invoices')</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h4 class="tx-20 font-weight-bold mb-1 text-white">
        
                                            {{ number_format(\App\Models\invoices::where('value_status', 3)->sum('total'), 2) }}
        
                                        </h4>
                                        <p class="mb-0 tx-12 text-white op-7">
                                            {{ \App\Models\invoices::where('value_status', 3)->count() }}
                                        </p>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-down text-white"></i>
                                        <span class="text-white op-7">
                                            @php
                                                $count_all = \App\Models\invoices::count();
                                                $count_invoices3 = \App\Models\invoices::where('value_status', 1)->count();
                                                if ($count_invoices3 == 0) {
                                                    echo $count_invoices3 = 0;
                                                } else {
                                                    echo $count_invoices3 =number_format(($count_invoices3 / $count_all) * 100 ,2) ;
                                                }
                                            @endphp
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                    </div>
                </div>
            </div>
        </div>
    
    </div>



    <!-- row opened -->
    <div class="row row-sm">
       
       

        
        <div class="col-md-12 col-lg-12 col-xl-5 card mx-xl-4">
        
            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">@lang('site.invoice_statistics')</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>

            <div class="card-dashboard-map-one">
                <div class="" style="width: 100%">
                    {!! $chartjs->render() !!}
                </div>
            </div>

        </div>

        <div class="col-lg-12 col-xl-6 card">

            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">@lang('site.invoice_statistics')</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>

            <div class=" card-dashboard-map-one">
                <div class="" style="width: 100%">
                    {!! $chartjs_2->render() !!}
                </div>
            </div>

        </div>

        

    </div>
    <!-- row closed -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src='/assets/plugins/chart.js/Chart.bundle.min.js'></script>
    <!-- Moment js -->
    <script src='/assets/plugins/raphael/raphael.min.js'></script>
    <!--Internal  Flot js-->
    <script src='/assets/plugins/jquery.flot/jquery.flot.js'></script>
    <script src='/assets/plugins/jquery.flot/jquery.flot.pie.js'></script>
    <script src='/assets/plugins/jquery.flot/jquery.flot.resize.js'></script>
    <script src='/assets/plugins/jquery.flot/jquery.flot.categories.js'></script>
    <script src='/assets/js/dashboard.sampledata.js'></script>
    <script src='/assets/js/chart.flot.sampledata.js'></script>
    <!--Internal Apexchart js-->
    <script src='/assets/js/apexcharts.js'></script>
    <!-- Internal Map -->
    <script src='/assets/plugins/jqvmap/jquery.vmap.min.js'></script>
    <script src='/assets/plugins/jqvmap/maps/jquery.vmap.usa.js'></script>
    <script src='/assets/js/modal-popup.js'></script>
    <!--Internal  index js -->
    <script src='/assets/js/index.js'></script>
    <script src='/assets/js/jquery.vmap.sampledata.js'></script>
@endsection
