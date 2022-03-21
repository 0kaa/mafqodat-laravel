<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#">

                </a>
                    <!-- <img src="" alt=""> -->
                    <h2 class="brand-text">{{ __('mafqodat') }}</h2>
                </a>

            </li>

            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>

        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ isActiveRoute('admin.home') }}"><a class="d-flex align-items-center" href="{{ route('admin.home') }}"><i data-feather="home"></i><span class="menu-title text-truncate">{{ __('home') }}</span></a>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li  class="nav-item {{ areActiveRoutes(['admin.employees.create' , 'admin.employees.index' , 'admin.employees.edit']) }}"><a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate">{{ __('employees') }}</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.employees.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('employees') }}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.employees.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('new_employee') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li  class="nav-item {{ areActiveRoutes(['admin.countries.create' , 'admin.countries.index' , 'admin.countries.edit']) }}"><a class="d-flex align-items-center" href="#"><i data-feather="flag"></i><span class="menu-title text-truncate">{{ __('countries') }}</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.countries.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('countries') }}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.countries.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('new_country') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li  class="nav-item {{ areActiveRoutes(['admin.cities.create' , 'admin.cities.index' , 'admin.cities.edit']) }}"><a class="d-flex align-items-center" href="#"><i data-feather='map-pin'></i><span class="menu-title text-truncate">{{ __('cities') }}</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.cities.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('cities') }}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.cities.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('new_city') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</div>
<!-- END: Main Menu-->
