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
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('admin.items.create') }}"><i class="mr-1"
                                        data-feather="check-square"></i><span
                                        class="align-middle">{{ __('new_item') }}</span></a></div>
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
                                                    <label for="selectCategory">{{ __('select_category') }}</label>
                                                    <select class="form-control mb-1" name="category_id" id="selectCategory"
                                                        required>

                                                        <option value="">{{ __('select') }}</option>

                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
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

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{ __('details') }}</label>
                                                    <input type="text" class="form-control" name="details"
                                                        value="{{ old('details') }}"
                                                        placeholder="{{ __('details') }}" />
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
                                                    <label for="first-name-vertical">{{ __('storage') }}</label>
                                                    <input type="text" class="form-control" name="storage"
                                                        value="{{ old('storage') }}"
                                                        placeholder="{{ __('storage') }}" />
                                                    @error('storage')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="formFile"
                                                        class="form-label">{{ __('image') }}</label>
                                                    <input class="form-control" type="file" id="formFile" name="image">
                                                    @error('image')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{ __('primary_colour') }}</label>
                                                    <input type="text" class="form-control" name="primary_colour"
                                                        value="{{ old('primary_colour') }}"
                                                        placeholder="{{ __('primary_colour') }}" />
                                                    @error('primary_colour')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{ __('secondary_colour') }}</label>
                                                    <input type="text" class="form-control" name="secondary_colour"
                                                        value="{{ old('secondary_colour') }}"
                                                        placeholder="{{ __('secondary_colour') }}" />
                                                    @error('secondary_colour')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{ __('tertiary_colour') }}</label>
                                                    <input type="text" class="form-control" name="tertiary_colour"
                                                        value="{{ old('tertiary_colour') }}"
                                                        placeholder="{{ __('tertiary_colour') }}" />
                                                    @error('tertiary_colour')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label
                                                        for="description-vertical">{{ __('station_description') }}</label>
                                                    <textarea name="description" class="form-control" id="description-vertical">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="selectStation">{{ __('select_station') }}</label>
                                                    <select class="form-control form-control-lg mb-1" name="station_id"
                                                        id="selectStation" required>

                                                        <option value="">{{ __('select') }}</option>

                                                        @foreach ($stations as $station)
                                                            <option value="{{ $station->id }}"
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
                                                <div class="row" id="appendStation">

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
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" id="close_modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div style="text-align: center">

                            <ul>
                                <li>{{ __('item_type') }} : <span>{{ session('category_name') }}</span></li>
                                <li>{{ __('item_name') }} : <span>{{ session('item_name') }}</span></li>
                                <li>{{ __('station_name') }} : <span>{{ session('station_name') }}</span></li>
                            </ul>

                            <p id="append_qrcode">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <script>

            $('#print').click(function (e) {
                e.preventDefault();
                $('#append_qrcode').printThis();
            });

            $('#selectStation').on('change', function() {

                var id = this.value;
                $("#appendStation").html();

                $.ajax({
                    url: "{{ route('admin.get_stations') }}",
                    type: "get",
                    data: {
                        id: id,
                    },
                    dataType: 'html',
                    success: function(result) {

                        $("#appendStation").html(result);

                    }
                });
            });

            $("#close_modal").click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.remove_session') }}",
                    data: "data",
                    dataType: "dataType",
                    success: function (response) {

                    }
                });
            });
        </script>
    @endpush
@endsection
