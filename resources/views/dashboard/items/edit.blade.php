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
                                    <div class="col-6">
                                        <h2 class="card-title">{{ __('edit_item') }} | #{{ $item->id }}</h2>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('admin.items.show', $item->id) }}"
                                            class="btn btn-primary mr-1">{{ __('show_item') }}</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="update_item_form"
                                        action="{{ route('admin.items.update', $item->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="reportType">{{ __('report_type') }}</label>
                                                    <select class="form-control mb-1" name="report_type" id="reportType"
                                                        required>

                                                        <option value="lost"
                                                            {{ old('report_type', $item->report_type == 'lost' ? 'selected' : '') }}>
                                                            {{ __('add_lost_item') }}</option>
                                                        <option value="found"
                                                            {{ old('report_type', $item->report_type == 'found' ? 'selected' : '') }}>
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

                                                        @foreach ($categories as $category)
                                                            <option data-slug="{{ $category->slug }}"
                                                                value="{{ $category->id }}"
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

                                            {{-- informer data --}}
                                            <div class="col-6">
                                                <div class="form-group" id="informer_name">
                                                    <label for="first-name-vertical">{{ __('informer_name') }}</label>
                                                    <input type="text" class="form-control" name="informer_name"
                                                        value="{{ old('informer_name', $item->informer_name) }}"
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
                                                        value="{{ old('informer_phone', $item->informer_phone) }}"
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
                                                    <textarea name="details" placeholder="{{ __('write_item_details') }}" class="form-control" id="details-vertical">{{ old('details', $item->details) }}</textarea>
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
                                                    <label for="images" class="form-label">{{ __('images') }}</label>
                                                    <input type="file" class="form-control dt-full-images images"
                                                        name="images[]" id="images" aria-label="{{ __('images') }}"
                                                        multiple />
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

                                            <div class="row">
                                                @foreach ($itemMedia as $media)
                                                    @if ($item->id == $media->item_id)
                                                        <div class="col-6 py-2">
                                                            <a href="" data-url="{{ route('admin.remove.image') }}"
                                                                data-id="{{ $media->id }}"
                                                                style="color: red;text-decoration: none;"
                                                                class="btn btn-red deleteImage">
                                                                <i class="fa-solid fa-trash"></i> حذف</a> </label>
                                                            <img id="files"
                                                                src="{{ asset('storage/' . $media->media->image) }}"
                                                                style="width: 200px; height: auto;">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group" id="storage_id">
                                                    <label for="selectStorage">{{ __('select_storage') }}</label>
                                                    <select class="form-control mb-1" name="storage_id" id="selectStorage"
                                                        required>

                                                        @foreach ($storages as $storage)
                                                            <option value="{{ $storage->id }}"
                                                                {{ old('storage_id', $item->storage_id) == $storage->id ? 'selected' : '' }}>
                                                                {{ $storage->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('storage_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="form-group">

                                                    <div class="custom-control custom-control-success custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            name="is_delivered" id="is_delivered" value="1"
                                                            {{ $item->is_delivered == 1 ? 'checked' : '' }} />
                                                        <label class="custom-control-label"
                                                            for="is_delivered">{{ __('is_delivered') }}</label>
                                                        @error('is_delivered')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            @if ($item->is_delivered == 1)
                                                <div class="col-12" id="delivered_data">
                                                    <div class="row">

                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('full_name') }}</label>
                                                                <input type="text" class="form-control" name="full_name"
                                                                    value="{{ old('full_name', $item->full_name) }}"
                                                                    placeholder="{{ __('full_name') }}" required />
                                                                @error('full_name')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('phone') }}</label>
                                                                <input type="text" class="form-control" name="phone"
                                                                    value="{{ old('phone', $item->phone) }}"
                                                                    placeholder="{{ __('phone') }}" required />
                                                                @error('phone')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="first-name-vertical">{{ __('delivery_date') }}</label>
                                                                <input type="date" class="form-control" name="delivery_date"
                                                                    value="{{ old('delivery_date', $item->delivery_date->format('Y-m-d')) }}" />
                                                                @error('delivery_date')
                                                                    <span class="alert alert-danger">
                                                                        <small class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-12" id="delivered_data">
                                                    <div class="row">

                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('full_name') }}</label>
                                                                <input type="text" class="form-control" name="full_name"
                                                                    value="{{ old('full_name') }}"
                                                                    placeholder="{{ __('full_name') }}" required />
                                                                @error('full_name')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('phone') }}</label>
                                                                <input type="text" class="form-control" name="phone"
                                                                    value="{{ old('phone') }}"
                                                                    placeholder="{{ __('phone') }}" required />
                                                                @error('phone')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="first-name-vertical">{{ __('delivery_date') }}</label>
                                                                <input type="date" class="form-control" name="delivery_date"
                                                                    value="{{ old('delivery_date') }}" />
                                                                @error('delivery_date')
                                                                    <span class="alert alert-danger">
                                                                        <small class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endif

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

        {{-- <script src="{{ asset('dashboard/assets/js/custom/maps.js') }}"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdarVlRZOccFIGWJiJ2cFY8-Sr26ibiyY&libraries=places&callback=initAutocomplete&language=ar
                                                                async defer"></script> --}}

        <script>
            if ($('#is_delivered').is(':checked')) {
                $('#delivered_data').show();
            } else {
                $('#delivered_data').hide();

            }

            $('#is_delivered').change(function(e) {
                e.preventDefault();

                if ($(this).is(':checked')) {
                    $('#delivered_data').show();
                } else {
                    $('#delivered_data').hide();
                }

            });

            var value = $('#reportType').find(':selected').val();

            if (value == 'found') {

                $('#storage_id').hide();
                $('#informer_name').show();
                $('#informer_phone').show();

            } else {

                $('#storage_id').show();
                $('#informer_name').hide();
                $('#informer_phone').hide();

            }

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

            $(document).ready(function() {

                $('.deleteImage').click(function(e) {

                    e.preventDefault();
                    const Toast2 = Swal.mixin({

                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    const Toast = Swal.mixin({

                        showCancelButton: true,
                        showConfirmButton: true,
                        cancelButtonColor: '#888',
                        confirmButtonColor: '#d6210f',
                        confirmButtonText: "{{ __('delete') }}",
                        cancelButtonText: "{{ __('no') }}",
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'question',
                        title: "{{ __('want_delete') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            var id = $(this).data('id');
                            var url = $(this).data('url');
                            var elem = $(this).closest('img');

                            $.ajax({
                                type: 'get',
                                url: url,
                                data: {
                                    _method: 'delete',
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    id: id,
                                },
                                dataType: 'json',
                                success: function(result) {

                                    setTimeout(function() {
                                        location.reload();
                                    }, 200);
                                } // end of success

                            }); // end of ajax

                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Toast2.fire({
                                title: "{{ __('canceled') }}",
                                // showConfirmButton: false,
                                icon: 'success',
                                timer: 1000
                            });

                        } // end of else confirmed

                    }) // end of then
                });

            });
        </script>
    @endpush
@endsection
