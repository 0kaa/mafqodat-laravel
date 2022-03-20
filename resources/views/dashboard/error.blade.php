@extends('dashboard.layouts.app')

@section('title' , __('not_found'))

@section('content')

    <!-- start error
        ================ -->
        <section class="error-pg">
        <div class="container">
            <div class="row" data-scroll data-scroll-speed="1">
                <div class="error_page">
                    <img src="{{ asset('dashboard/app-assets/images/pages/undraw_page_not_found_re_e9o6.svg') }}" alt="Error">
                    <h3>{{ __('not_found') }}</h3>
                </div>

            </div>
        </div>
    </section>
    <!--end error-->
@endsection
