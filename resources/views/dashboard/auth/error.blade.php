@extends('dashboard.layouts-auth.app')

@section('title' , 'غير مسموح لك بالمرور')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Not authorized-->
                <div class="misc-wrapper"><a class="brand-logo" href="javascript:void(0);">
                        <h2 class="brand-text text-primary ml-1">ارزام</h2>
                    </a>
                    <div class="misc-inner p-2 p-sm-3">
                        <div class="w-100 text-center">
                            <h2 class="mb-1">غير مسموح لك بمرور هذه الصفحة! 🔐</h2>
                            <a class="btn btn-primary mb-1 btn-sm-block" href="{{ route('admin.login') }}">العودة إلى تسجيل الدخول</a><img class="img-fluid" src="{{ asset('dashboard/app-assets/images/pages/not-authorized.svg') }}" alt="Not authorized page" />
                        </div>
                    </div>
                </div>
                <!-- / Not authorized-->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
