@extends('dashboard.layouts.app')

@section('title', __('edit_station'))

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
                                            href="{{ route('admin.stations.index') }}">{{ __('stations') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('edit_station') }}</a>
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
                                    href="{{ route('admin.stations.create') }}"><i class="mr-1"
                                        data-feather="check-square"></i><span
                                        class="align-middle">{{ __('new_station') }}</span></a></div>
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
                                    <h2 class="card-title">{{ __('edit_station') }} | {{ $station->name }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="update_station_form"
                                        action="{{ route('admin.stations.update', $station->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" value="{{ $station->id }}">
                                                    <label for="selectCountry">{{ __('station_type') }}</label>
                                                    <div class="form-group">
                                                        <select id="selectCity" name="type" class="form-control mb-1"
                                                            required>
                                                            <option value="metro" {{ $station->type == 'metro' ? 'selected' : '' }}>{{ __('metro') }}</option>
                                                            <option value="bus" {{ $station->type == 'bus' ? 'selected' : '' }}>{{ __('bus') }}</option>
                                                        </select>
                                                    </div>
                                                    @error('type')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">{{ __('station_number') }}</label>
                                                    <input type="text" id="" class="form-control"
                                                        name="number" value="{{ old('number', $station->number) }}"
                                                        placeholder="{{ __('station_number') }}" />
                                                    @error('number')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">{{ __('name_ar') }}</label>
                                                    <input type="text" id="" class="form-control"
                                                        name="name_ar" value="{{ old('name_ar', $station->name_ar) }}"
                                                        placeholder="{{ __('name_ar') }}" />
                                                    @error('name_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">{{ __('name_en') }}</label>
                                                    <input type="text" id="" class="form-control"
                                                        name="name_en" value="{{ old('name_en', $station->name_en) }}"
                                                        placeholder="{{ __('name_en') }}" />
                                                    @error('name_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">{{ __('station_details') }}</label>
                                                    <input type="text" id="" class="form-control"
                                                        name="details" value="{{ old('details', $station->details) }}"
                                                        placeholder="{{ __('station_details') }}" />
                                                    @error('details')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label
                                                        for="">{{ __('station_description') }}</label>
                                                    <textarea name="description" class="form-control" id="">{{ old('description', $station->description) }}</textarea>
                                                    @error('description')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" id="pac-input" value="{{ old('location', $station->location) }}" class="form-control"
                                                        placeholder="{{ __('station_location') }}" name="location"
                                                        required>

                                                    @error('location')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div id="map" style="height: 500px;width: 1000px; margin-bottom: 15px;"></div>
                                            <input type="hidden" name="lat" id="latitude" value="{{ $station->lat }}">
                                            <input type="hidden" name="lng" id="longitude" value="{{ $station->lng }}">

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
        <script src="{{ asset('dashboard/assets/js/validation/stationValidation.js') }}"></script>

        <script src="{{ asset('dashboard/assets/js/custom/maps.js') }}"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdarVlRZOccFIGWJiJ2cFY8-Sr26ibiyY&libraries=places&callback=initAutocomplete&language=ar
        async defer"></script>
    @endpush
@endsection
