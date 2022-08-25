<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/logo.png') }}"
                        class="logo-1" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img
                        src="{{ URL::asset('assets/img/brand/logo-white.png') }}" class="dark-logo-1" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/favicon.png') }}"
                        class="logo-2" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/favicon.png') }}"
                        class="dark-logo-2" alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>
           
        </div>

        <div class="main-header-right">
			
            <div class="nav nav-item  navbar-nav-right ml-auto">

              
                <div class="dropdown nav-item main-header-notification">
                    <a class="new nav-link" href="#">
                        <img src="{{ URL::asset('assets/img/flags/languages.png') }}"
                        class="logo-1 header-icon" alt="logo"></a>
                    <div class="dropdown-menu">
                        <div class="menu-header-content bg-primary text-right">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a class="mx-2 my-5" style="color: aliceblue" rel="alternate"
                                        hreflang="{{ $localeCode }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </div>


                    </div>
                </div>

                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#">
                        <img src="{{ URL::asset('assets/img/icons/full-screen.png') }}"
                        class="logo-1  header-icon  " alt="logo">
                    </a>
                </div>

                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href=""><img alt=""
                            src="{{ URL::asset('assets/img/faces/6.png') }}"></a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user"><img alt=""
                                        src="{{ URL::asset('assets/img/faces/6.png	') }}" class=""></div>
                                <div class="mr-3 my-auto">
                                    <h6>{{ Auth::user()->name }}</h6><span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                       
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                class="bx bx-log-out"></i>تسجيل خروج</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- /main-header -->
