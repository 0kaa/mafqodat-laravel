@extends('dashboard.layouts.app')

@section('title', __('new_item'))

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
                                            href="{{ route('admin.items.index') }}">{{ __('items') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('new_item') }}</a>
                                    </li>
                                </ol>
                            </div>
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
                                    <h2 class="card-title">{{ __('new_item') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="create_item_form"
                                        action="{{ route('admin.items.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="reportType">{{ __('report_type') }}</label>
                                                    <select class="form-control mb-1" name="report_type" id="reportType"
                                                        required>

                                                        <option value="">{{ __('select') }}</option>
                                                        <option value="lost"
                                                            @if (old('report_type') == 'lost') selected="selected" @endif>
                                                            {{ __('add_lost_item') }}</option>
                                                        <option value="found"
                                                            @if (old('report_type') == 'found') selected="selected" @endif>
                                                            {{ __('report_found_item') }}</option>

                                                    </select>
                                                    @error('report_type')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="selectCategory">{{ __('select_category') }}</label>
                                                    <select class="form-control mb-1" name="category_id" id="selectCategory"
                                                        required>

                                                        <option value="">{{ __('select') }}</option>

                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" class="item-category"
                                                                data-slug="{{ $category->slug }}"
                                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('category_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- informer data --}}
                                            <div class="col-6">
                                                <div class="form-group" id="informer_name">
                                                    <label for="first-name-vertical">{{ __('informer_name') }}</label>
                                                    <input type="text" class="form-control" name="informer_name"
                                                        value="{{ old('informer_name') }}"
                                                        placeholder="{{ __('informer_name') }}" />
                                                    @error('informer_name')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group" id="informer_phone">
                                                    <label for="first-name-vertical">{{ __('informer_phone') }}</label>
                                                    <input type="text" class="form-control" name="informer_phone"
                                                        value="{{ old('informer_phone') }}"
                                                        placeholder="{{ __('informer_phone') }}" />
                                                    @error('informer_phone')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group" id="item_details">
                                                    <label for="details-vertical">{{ __('item_details') }}</label>
                                                    <textarea name="details" placeholder="{{ __('write_item_details') }}" class="form-control" id="details-vertical">{{ old('details') }}</textarea>
                                                    @error('details')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{ __('date') }}</label>
                                                    <input type="date" class="form-control" name="date"
                                                        value="{{ old('date') }}" />
                                                    @error('date')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{ __('time') }}</label>
                                                    <input type="time" class="form-control" name="time"
                                                        value="{{ old('time') }}" />
                                                    @error('time')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="images" class="form-label">{{ __('images') }}</label>
                                                    <input type="file" class="form-control dt-full-images images"
                                                        name="images[]" id="images"
                                                        aria-label="{{ __('images') }}" multiple />
                                                    @error('images')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="selectStation">{{ __('select_station') }}</label>
                                                    <select class="form-control mb-1" name="station_id"
                                                        id="selectStation" required>

                                                        <option value="">{{ __('select') }}</option>

                                                        @foreach ($stations as $station)
                                                            <option value="{{ $station->id }}"
                                                                data-lat="{{ $station->lat }}"
                                                                data-lng="{{ $station->lng }}"
                                                                {{ old('station_id') == $station->id ? 'selected' : '' }}>
                                                                {{ $station->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('station_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group" id="storage_id">
                                                    <label for="selectStorage">{{ __('select_storage') }}</label>
                                                    <select class="form-control mb-1" name="storage_id" id="selectStorage"
                                                        required>

                                                        <option value="">{{ __('select') }}</option>

                                                    </select>
                                                    @error('storage_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1">{{ __('add') }}</button>
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

    <!-- Vertical modal -->
    <div class="vertical-modal-ex">
        {{-- <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Vertically Centered
        </button> --}}
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" id="close_modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div style="text-align: center; display: flex;" id="append_qrcode">

                            <ul style="list-style: none;text-align: right;">
                                <li>{{ __('item_type') }} : <span>{{ session('category_name') }}</span></li>
                                <li>{{ __('item_name') }} : <span>{{ session('item_name') }}</span></li>
                                <li>{{ __('station_name') }} :
                                    <span>{{ session('station_name') . ' - ' . session('station_location') }}</span>
                                </li>
                            </ul>

                            <p style="margin: auto;text-align: left;">
                                {!! session('qr_code') !!}
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="print">{{ __('print') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vertical modal end-->

    @push('js')
        <script src="{{ asset('dashboard/assets/js/validation/itemValidation.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"
                integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- <script src="{{ asset('dashboard/assets/js/custom/maps.js') }}"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdarVlRZOccFIGWJiJ2cFY8-Sr26ibiyY&libraries=places&callback=initAutocomplete&language=ar
                                                async defer"></script> --}}


        <script>
            $('#print').click(function(e) {
                e.preventDefault();
                $('#append_qrcode').printThis();
            });

            $("#close_modal").click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.remove_session') }}",
                    data: "data",
                    dataType: "dataType",
                    success: function(response) {

                    }
                });
            });

            $('#informer_name').hide();
            $('#informer_phone').hide();
            $('#storage_id').hide();

            $('#reportType').change(function(e) {
                e.preventDefault();

                var value = $(this).val();

                if (value == 'found') {
                    $('#storage_id').hide();
                    $('#informer_name').show();
                    $('#informer_phone').show();

                } else {

                    $('#storage_id').show();
                    $('#informer_name').hide();
                    $('#informer_phone').hide();
                }

            });

            $('#selectCategory').change(function(e) {
                e.preventDefault();

                var category_id = $(this).val();
                $("#selectStorage").html('');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.get_storages') }}",
                    data: {
                        category_id: category_id,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(result) {

                        $('#selectStorage').html('<option value="">{{ __('select') }}</option>');
                        $.each(result.storages, function(key, value) {
                            $("#selectStorage").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });

                    }
                });

            });
        </script>
    @endpush
@endsection
