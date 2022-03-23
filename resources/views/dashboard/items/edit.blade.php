@extends('dashboard.layouts.app')

@section('title', __('edit_item'))

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
                                    <li class="breadcrumb-item"><a href="#">{{ __('edit_item') }}</a>
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
                                        class="align-middle">{{ __('edit_item') }}</span></a></div>
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
                                    <h2 class="card-title">{{ __('edit_item') }} |
                                        {{ $item->details }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="update_item_form"
                                        action="{{ route('admin.items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="selectCategory">{{ __('select_category') }}</label>
                                                    <select class="form-control mb-1" name="category_id" id="selectCategory"
                                                        required>

                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
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
                                                        value="{{ old('details', $item->details) }}"
                                                        placeholder="{{ __('write_details') }}" />
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
                                                        value="{{ old('date', $item->date->format('Y-m-d')) }}" />
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
                                                        value="{{ old('time', $item->time->format('H:i')) }}" />
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
                                                        value="{{ old('storage', $item->storage) }}"
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

                                                        @foreach ($stations as $station)
                                                            <option value="{{ $station->id }}"
                                                                {{ old('station_id', $item->station_id) == $station->id ? 'selected' : '' }}>
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
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">{{ __('station_location') }}</label>
                                                            <input type="text" class="form-control"  disabled
                                                                value="{{ $item->station->location }}"
                                                            />
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">{{ __('station_number') }}</label>
                                                            <input type="text" class="form-control" disabled
                                                                value="{{ $item->station->number }}"
                                                            />
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="first-name-vertical">{{ __('station_location') }}</label>
                                                            <input type="text" class="form-control" disabled
                                                                value="{{ $item->station->location }}"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
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
        <script src="{{ asset('dashboard/assets/js/validation/itemValidation.js') }}"></script>

        <script>
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
        </script>
    @endpush
@endsection
