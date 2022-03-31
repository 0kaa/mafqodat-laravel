@extends('dashboard.layouts-auth.app')

@section('title' , __('forget_password'))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        <!-- Forgot Password v1 -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="brand-logo">
                                    <h2 class="brand-text text-primary ml-1">{{ __('mafqodat') }}</h2>
                                </a>

                                <h4 class="card-title mb-1">{{ __('forget_password') }} 🔒</h4>
                                <p class="card-text mb-2">{{ __('email_reset_password') }}</p>

                                <form class="auth-forgot-password-form mt-2" action="{{ route('admin.sendLink') }}" method="POST">
                                    @csrf()
                                    <div class="form-group">
                                        <label for="forgot-password-email" class="form-label">{{ __('email') }}</label>
                                        <input type="text" class="form-control" id="forgot-password-email" name="email" placeholder="john@example.com" aria-describedby="forgot-password-email" tabindex="1" autofocus />
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="2">{{ __('send_link') }}</button>
                                </form>

                                <p class="text-center mt-2">
                                    <a href="{{ route('admin.login') }}"> <i data-feather="chevron-left"></i> {{ __('back_login') }} </a>
                                </p>
                            </div>
                        </div>
                        <!-- /Forgot Password v1 -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
