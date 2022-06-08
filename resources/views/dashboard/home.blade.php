@extends('dashboard.layouts.app')

@section('title', __('control_panel'))

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        <div class="col-12 text-left">
                            <h1 class="mb-1">{{ __('welcome') . ' ' . auth()->user()->name }} </h1>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('admin.items.index') }}" class="btn btn-lg btn-outline-warning">{{ __('items') }}</a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('admin.reports') }}" class="btn btn-lg btn-outline-warning">{{ __('reports') }}</a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('admin.get_logs') }}" class="btn btn-lg btn-outline-warning">{{ __('employee_logs') }}</a>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>

    @push('js')

    @endpush
@endsection
