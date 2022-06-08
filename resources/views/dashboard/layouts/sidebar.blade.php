<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

    <div class="img_menu_01">
        <img src="{{ asset('dashboard/app-assets/images/pages/station_logo.jpg') }}" alt="logo">
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
            <li  class="nav-item {{ areActiveRoutes(['admin.cities.create' , 'admin.cities.index' , 'admin.cities.edit']) }}"><a class="d-flex align-items-center" href="#"><i data-feather='map-pin'></i><span class="menu-title text-truncate">{{ __('cities') }}</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.cities.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('cities') }}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.cities.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('new_city') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li  class="nav-item {{ areActiveRoutes(['admin.stations.create' , 'admin.stations.index' , 'admin.stations.edit']) }}"><a class="d-flex align-items-center" href="#"><i data-feather='compass'></i><span class="menu-title text-truncate">{{ __('stations') }}</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.stations.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('stations') }}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.stations.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('new_station') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li  class="nav-item {{ areActiveRoutes(['admin.categories.create' , 'admin.categories.index' , 'admin.categories.edit']) }}"><a class="d-flex align-items-center" href="#"><i data-feather='inbox'></i><span class="menu-title text-truncate">{{ __('categories') }}</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.categories.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('categories') }}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.categories.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('new_category') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li  class="nav-item {{ areActiveRoutes(['admin.storages.create' , 'admin.storages.index' , 'admin.storages.edit']) }}"><a class="d-flex align-items-center" href="#"><i data-feather='inbox'></i><span class="menu-title text-truncate">{{ __('storages') }}</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.storages.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('storages') }}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.storages.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('new_storage') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li  class="nav-item {{ areActiveRoutes(['admin.items.create' , 'admin.items.index' , 'admin.items.edit']) }}"><a class="d-flex align-items-center" href="#"><i data-feather='package'></i><span class="menu-title text-truncate">{{ __('items') }}</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.items.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('items') }}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.items.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{ __('new_item') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ isActiveRoute('admin.get_logs') }}"><a class="d-flex align-items-center" href="{{ route('admin.get_logs') }}"><i data-feather='archive'></i><span class="menu-title text-truncate">{{ __('employee_logs') }}</span></a>
            </li>
        </ul>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ isActiveRoute('admin.reports') }}"><a class="d-flex align-items-center" href="{{ route('admin.reports') }}"><i data-feather='bar-chart-2'></i><span class="menu-title text-truncate">{{ __('reports') }}</span></a>
            </li>
        </ul>

    </div>
</div>
<!-- END: Main Menu-->
