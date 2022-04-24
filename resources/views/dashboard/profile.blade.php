@extends('dashboard.layouts.app')

@section('title', __('profile_setting'))

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- account setting page -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column nav-left">
                                <!-- general -->
                                <li class="nav-item">
                                    <a class="nav-link active" id="account-pill-general" data-toggle="pill"
                                        href="#account-vertical-general" aria-expanded="true">
                                        <i data-feather="user" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">{{ __('profile_setting') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--/ left menu section -->

                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- general tab -->
                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                            aria-labelledby="account-pill-general" aria-expanded="true">

                                            <!-- form -->
                                            <form class="form form-vertical" id="update_profile"
                                                action="{{ route('admin.update_profile') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">

                                                    <div class="col-12 mb-2">
                                                        <!-- header media -->
                                                        <div class="media">
                                                            <a href="javascript:void(0);" class="mr-25">
                                                                @if (auth()->user()->image)
                                                                    <img src="{{ asset('storage/' . $user->image) }}"
                                                                        id="account-upload-img" class="rounded mr-50"
                                                                        alt="profile image" height="100" width="100" />
                                                                @else
                                                                    <img src="{{ asset('dashboard/app-assets/images/avatars/placeholder.png') }}"
                                                                        id="account-upload-img" class="rounded mr-50"
                                                                        alt="profile image" height="100" width="100" />
                                                                @endif
                                                            </a>
                                                            <!-- upload and reset button -->
                                                            <div class="media-body mt-2 ml-1">
                                                                <label for="account-upload"
                                                                    class="btn btn-primary mb-75 mr-75">{{ __('upload') }}</label>
                                                                <input type="file" id="account-upload" name="image" hidden
                                                                    accept="image/*" />
                                                            </div>
                                                            <!--/ upload and reset button -->
                                                        </div>
                                                        <!--/ header media -->
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="first-name-vertical">{{ __('first_name') }}</label>
                                                            <input type="text" class="form-control" name="first_name"
                                                                value="{{ old('first_name', $user->first_name) }}"
                                                                placeholder="{{ __('write_first_name') }}" />
                                                            @error('first_name')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="first-name-vertical">{{ __('family_name') }}</label>
                                                            <input type="text" class="form-control" name="family_name"
                                                                value="{{ old('family_name', $user->family_name) }}"
                                                                placeholder="{{ __('write_family_name') }}" />
                                                            @error('family_name')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">{{ __('email') }}</label>
                                                            <input type="email" class="form-control" name="email"
                                                                value="{{ old('email', $user->email) }}"
                                                                placeholder="{{ __('write_email') }}" />
                                                            @error('email')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">{{ __('password') }}</label>
                                                            <input type="password" class="form-control" name="password"
                                                                value="{{ old('password') }}"
                                                                placeholder="{{ __('write_password') }}" />
                                                            @error('password')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">{{ __('phone') }}</label>
                                                            <input type="text" class="form-control" name="phone"
                                                                value="{{ old('phone', $user->phone) }}"
                                                                placeholder="{{ __('write_phone') }}" />
                                                            @error('phone')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">{{ __('mobile') }}</label>
                                                            <input type="text" class="form-control" name="mobile"
                                                                value="{{ old('mobile', $user->mobile) }}"
                                                                placeholder="{{ __('write_mobile') }}" />
                                                            @error('mobile')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">{{ __('address') }}</label>
                                                            <input type="text" class="form-control" name="address"
                                                                value="{{ old('address', $user->address) }}"
                                                                placeholder="{{ __('write_address') }}" />
                                                            @error('address')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">{{ __('second_address') }}</label>
                                                            <input type="text" class="form-control" name="second_address"
                                                                value="{{ old('second_address', $user->second_address) }}"
                                                                placeholder="{{ __('second_address') }}" />
                                                            @error('second_address')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="selectCountry">{{ __('select_country') }}</label>
                                                            <select class="form-control form-control-lg mb-1"
                                                                name="country_id" id="selectCountry">

                                                                <option value="">{{ __('select') }}</option>

                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}"
                                                                        {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>
                                                                        {{ $country->name }}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                            @error('country_id')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group" id="city_form_select">
                                                            <label for="selectCountry">{{ __('select_city') }}</label>
                                                            <div class="form-group">
                                                                <select id="selectCity" name="city_id"
                                                                    class="form-control form-control-lg mb-1" >
                                                                    <option value="">{{ __('select') }}</option>
                                                                    @foreach ($cities as $city)
                                                                        <option value="{{ $city->id }}"
                                                                            {{ old('city_id', $user->city_id) == $city->id ? 'selected' : '' }}>
                                                                            {{ $city->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('city_id')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit"
                                                            class="btn btn-primary mr-1">{{ __('update') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ general tab -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ right content section -->
                    </div>
                </section>
                <!-- / account setting page -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @push('js')
        {{-- <script src="{{ asset('dashboard/assets/js/validation/profileValidation.js') }}"></script> --}}


        <script>
            // variables
            var accountUploadImg = $('#account-upload-img'),
                accountUploadBtn = $('#account-upload');

            // Update user photo on click of button
            if (accountUploadBtn) {
                accountUploadBtn.on('change', function(e) {
                    var reader = new FileReader(),
                        files = e.target.files;
                    reader.onload = function() {
                        if (accountUploadImg) {
                            accountUploadImg.attr('src', reader.result);
                        }
                    };
                    reader.readAsDataURL(files[0]);
                });
            }

            $('#update_profile').submit(function() {

                localStorage.setItem('city', $("#selectCity").val());

            })


            window.onload = (() => {
                if ($('#selectCountry').val()) {

                    $('#city_form_select').fadeIn();
                    var idCountry = $('#selectCountry').val();
                    $("#selectCity").html('');


                    $.ajax({
                        url: "{{ route('admin.get_cities') }}",
                        type: "POST",
                        data: {
                            country_id: idCountry,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {

                            var city = localStorage.getItem('city');

                            // $('#selectCity').html('<option value="">{{ __('select') }}</option>');
                            $.each(result.cities, function(key, value) {
                                $("#selectCity").append('<option value="' + value
                                    .id + '" ' + (city == value.id ? 'selected' : '') + '>' +
                                    value.name + '</option>');
                            });
                        }
                    });

                }

            });

            $('#selectCountry').on('change', function() {
                var idCountry = this.value;
                $("#selectCity").html('');
                $.ajax({
                    url: "{{ route('admin.get_cities') }}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#selectCity').html('<option value="">{{ __('select') }}</option>');
                        $.each(result.cities, function(key, value) {
                            $("#selectCity").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        </script>
    @endpush

@endsection
