@extends('dashboard.layouts.app')

@section('title', __('edit_employee'))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.employees.index') }}">{{ __('employees') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('edit_employee') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('admin.employees.create') }}"><i class="mr-1"
                                        data-feather="check-square"></i><span
                                        class="align-middle">{{ __('edit_employee') }}</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">{{ __('edit_employee') }} |
                                        {{ $employee->first_name . ' ' . $employee->family_name }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="update_employee_form"
                                        action="{{ route('admin.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-12 mb-2">
                                                <!-- header media -->
                                                <div class="media">
                                                    <a href="javascript:void(0);" class="mr-25">
                                                        @if ($employee->image)
                                                            <img src="{{ asset('storage/' . $employee->image) }}"
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
                                                    <input type="hidden" name="id" value="{{ $employee->id }}">
                                                    <label for="first-name-vertical">{{ __('first_name') }}</label>
                                                    <input type="text" class="form-control" name="first_name"
                                                        value="{{ old('first_name', $employee->first_name) }}"
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
                                                    <label for="first-name-vertical">{{ __('family_name') }}</label>
                                                    <input type="text" class="form-control" name="family_name"
                                                        value="{{ old('family_name', $employee->family_name) }}"
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
                                                        value="{{ old('email', $employee->email) }}"
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
                                                        value="{{ old('phone', $employee->phone) }}"
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
                                                        value="{{ old('mobile', $employee->mobile) }}"
                                                        placeholder="{{ __('write_mobile') }}" />
                                                    @error('mobile')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{ __('address') }}</label>
                                                    <input type="text" class="form-control" name="address"
                                                        value="{{ old('address', $employee->address) }}"
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
                                                    <label for="selectCountry">{{ __('select_country') }}</label>
                                                    <select class="form-control form-control-lg mb-1" name="country_id"
                                                        id="selectCountry" required>

                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}"
                                                                {{ old('country_id', $employee->country_id) == $country->id ? 'selected' : '' }}>
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
                                                            class="form-control form-control-lg mb-1" required>

                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}"
                                                                    {{ old('city_id', $employee->city_id) == $city->id ? 'selected' : '' }}>
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

                                            <div class="demo-inline-spacing col-12">
                                                @foreach ($permissions as $permission)
                                                    <div class="form-group" id="city_form_select">

                                                        <div class="custom-control custom-control-danger custom-checkbox">
                                                            <input type="checkbox" name="permissions[]"
                                                                value="{{ $permission->id }}"
                                                                class="custom-control-input"
                                                                id="permission-{{ $permission->id }}"
                                                                {{ $employee->permissions->contains($permission->id) ? 'checked' : '' }}
                                                                required>
                                                            <label class="custom-control-label"
                                                                for="permission-{{ $permission->id }}">{{ __($permission->name) }}</label>
                                                        </div>
                                                        @error('permissions')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1">{{ __('update') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @push('js')
        <script src="{{ asset('dashboard/assets/js/validation/employeeValidation.js') }}"></script>

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


            $('#update_employee_form').submit(function() {

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
