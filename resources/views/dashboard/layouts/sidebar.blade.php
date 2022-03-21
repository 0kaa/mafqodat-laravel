<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#">

                </a>
                    <!-- <img src="" alt=""> -->
                    <h2 class="brand-text">المفقودات</h2>
                </a>

            </li>

            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>

        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ isActiveRoute('admin.home') }}"><a class="d-flex align-items-center" href="{{ route('admin.home') }}"><i data-feather="home"></i><span class="menu-title text-truncate">الصفحة الرئيسية</span></a>
            </li>
        </ul>
{{--
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li  class="nav-item {{ areActiveRoutes(['admin.categories.create' , 'admin.categories.index' , 'admin.categories.edit']) }}"><a class="d-flex align-items-center" href="#"><i data-feather="tag"></i><span class="menu-title text-truncate">الاقسام</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.categories.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >كل الاقسام</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.categories.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" >اضافة قسم جديد</span></a>
                    </li>
                </ul>
            </li>
        </ul> --}}

    </div>
</div>
<!-- END: Main Menu-->
