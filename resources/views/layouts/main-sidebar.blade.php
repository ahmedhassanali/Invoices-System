<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				{{-- <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a> --}}
				{{-- <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a> --}}
				{{-- <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a> --}}
				{{-- <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a> --}}
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.png')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
							<span class="mb-0 text-muted">{{Auth::user()->email}}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					
					<li class="slide mt-3">
						<a class="side-menu__item" href="{{ url('/' . $page='home') }}">
							<img src="{{asset('assets/img/icons/1.png') }}" style="width: 30px" class=" mx-2 nav-icon">
							<span class="side-menu__label">الرئيسية</span></a>
					</li>


					<li class="slide my-3">
						<a class="side-menu__item" data-toggle="slide" href="">
							<img src="{{asset('assets/img/icons/2.png') }}" style="width: 30px" class=" mx-2 nav-icon">
							<span class="side-menu__label">الفواتير</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='invoices') }}">قائمة الفواتير</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='invoice_paid') }}">الفواتير المدفوعة</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='invoice_unpaid') }}">الفواتير الغير مدفوعة</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='invoice_partial') }}">الفواتير المدفوعة جزئيا</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='invoice_archive') }}">ارشيف الفواتير</a></li>
						</ul>
					</li>
					
					<li class="slide my-3">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<img src="{{asset('assets/img/icons/3.png') }}" style="width: 30px" class=" mx-2 nav-icon">
							<span class="side-menu__label">التقارير</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='invoice_report') }}">تقارير فواتير</a></li>
						</ul>
					</li>

					<li class="slide my-3">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<img src="{{asset('assets/img/icons/4.png') }}" style="width: 30px" class=" mx-2 nav-icon">

							<span class="side-menu__label">المستخدمين</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='users') }}">قائمة المستخدمين</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='roles') }}">صلاحيات المستخدمين</a></li>
						</ul>
					</li>

					<li class="slide my-3">
						<a class="side-menu__item" href="{{ url('/' . $page='categories') }}">
							<img src="{{asset('assets/img/icons/7.png') }}" style="width: 30px" class=" mx-2 nav-icon">

							<span class="side-menu__label">الاقسام</span></a>
					</li>

					<li class="slide my-3">
						<a class="side-menu__item" href="{{ url('/' . $page='products') }}">
							<img src="{{asset('assets/img/icons/8.png') }}" style="width: 30px" class=" mx-2 nav-icon">

							<span class="side-menu__label">المنتجات</span></a>
					</li>
					
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
