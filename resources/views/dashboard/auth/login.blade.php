@extends('dashboard.layouts-auth.app')

@section('title', __('login'))

@section('content')


    <div class="login_new_page">
        <div class="container">
            <div class="sub_login_new_page">

                <div class="logo_login_new_page">
                    <img src="{{ asset('dashboard/app-assets/images/pages/logo.png') }}" alt="">
                </div>
                <form class="auth-login-form mt-2" id="authValidation" action="{{ route('admin.login.post') }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="login-email" class="form-label">{{ __('email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com"
                            aria-describedby="email" tabindex="1" autofocus />

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong class="errorTxt">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="password">{{ __('password') }}</label>
                            <a href="{{ route('admin.reset') }}">
                                <small>{{ __('forget_password') }}</small>
                            </a>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="password" name="password"
                                tabindex="2"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer"><i class="fa-solid fa-eye"></i></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong class="errorTxt">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="remember" type="checkbox" id="remember-me"
                                tabindex="3" />
                            <label class="custom-control-label" for="remember-me"> {{ __('remember') }} </label>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" tabindex="4">{{ __('login') }}</button>
                </form>
            </div>
        </div>

    </div>

    @push('js')
        <script src="{{ asset('dashboard/assets/js/custom/validation/authValidation.js') }}"></script>
    @endpush

@endsection
