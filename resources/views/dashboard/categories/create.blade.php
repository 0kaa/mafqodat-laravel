@extends('dashboard.layouts.app')

@section('title' , __('new_category'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ __('categories') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('new_category') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ route('admin.categories.create') }}"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">{{ __('new_category') }}</span></a></div>
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
                                    <h2 class="card-title">{{ __('new_category') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="create_category_form" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{ __('name_ar') }}</label>
                                                    <input type="text" id="first-name-vertical" class="form-control" name="name_ar" value="{{ old('name_ar') }}" placeholder="{{ __('name_ar_required') }}" />
                                                    @error('name_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{ __('name_en') }}</label>
                                                    <input type="text" id="first-name-vertical" class="form-control" name="name_en" value="{{ old('name_en') }}" placeholder="{{ __('name_en_required') }}" />
                                                    @error('name_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="selectStorage">{{ __('select_storage') }}</label>
                                                    <select class="form-control mb-1" name="storage_id" id="selectStorage"
                                                        required>

                                                        <option value="">{{ __('select') }}</option>

                                                        @foreach ($storages as $storage)
                                                            <option value="{{ $storage->id }}" class="item-storage"
                                                                {{ old('storage_id') == $storage->id ? 'selected' : '' }}>
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
                                                    <label for="formFile" class="form-label">{{ __('image') }}</label>
                                                    <input class="form-control" type="file" id="formFile" name="image" required>
                                                    @error('image')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1">{{ __('add') }}</button>
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
        <script src="{{ asset('dashboard/assets/js/validation/categoryValidation.js') }}"></script>
    @endpush
@endsection
