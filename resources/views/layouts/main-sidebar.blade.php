<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        {{-- <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a> --}}
        {{-- <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a> --}}
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon-white.png') }}" class="logo-icon dark-theme"
                alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{ URL::asset('assets/img/faces/6.png') }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">

            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'home')) }}">
                    <img src="{{ asset('assets/img/icons/1.png') }}" style="width: 30px" class=" mx-2 nav-icon">
                    <span class="side-menu__label">@lang('site.dashboard')</span></a>
            </li>


            <li class="slide my-3">
                <a class="side-menu__item" data-toggle="slide" href="">
                    <img src="{{ asset('assets/img/icons/2.png') }}" style="width: 30px" class=" mx-2 nav-icon">
                    <span class="side-menu__label">@lang('site.invoices')</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'invoices/create')) }}">
                            @lang('site.add_invoice')</a>
                    </li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'invoices')) }}"> @lang('site.invoices_list')</a></li>

                    <li><a class="slide-item" href="{{ url('/' . ($page = 'invoice_paid')) }}"> @lang('site.paid_invoices')</a>
                    </li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'invoice_unpaid')) }}"> @lang('site.unpaid_invoices')</a>
                    </li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'invoice_partial')) }}">
                            @lang('site.partially_paid_invoices')</a>
                    </li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'invoice_archive')) }}">
                            @lang('site.invoice_archive')</a>
                    </li>
                </ul>
            </li>

            <li class="slide my-3">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                    <img src="{{ asset('assets/img/icons/3.png') }}" style="width: 30px" class=" mx-2 nav-icon">
                    <span class="side-menu__label">@lang('site.reports')</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'invoice_report')) }}">>@lang('site.invoices_reports')
                        </a>
                    </li>
                </ul>
            </li>

            <li class="slide my-3">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                    <img src="{{ asset('assets/img/icons/4.png') }}" style="width: 30px" class=" mx-2 nav-icon">

                    <span class="side-menu__label">@lang('site.users')</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'users')) }}">@lang('site.users_list')</a></li>
                    <li><a class="slide-item" href="{{ url('/' . ($page = 'roles')) }}">@lang('site.users_roles')</a></li>
                </ul>
            </li>

            <li class="slide my-3">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'categories')) }}">
                    <img src="{{ asset('assets/img/icons/7.png') }}" style="width: 30px" class=" mx-2 nav-icon">

                    <span class="side-menu__label">@lang('site.categories')</span></a>
            </li>

            <li class="slide my-3">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'products')) }}">
                    <img src="{{ asset('assets/img/icons/8.png') }}" style="width: 30px" class=" mx-2 nav-icon">

                    <span class="side-menu__label">@lang('site.products')</span></a>
            </li>

        </ul>
    </div>
</aside>
<!-- main-sidebar -->
