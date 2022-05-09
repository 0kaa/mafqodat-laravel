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

                                            <div class="col-12">
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

                                            @if ($item->category->slug == 'other')
                                                <div class="col-12">
                                                    <div class="form-group" id="item_type">
                                                        <label for="first-name-vertical">{{ __('type') }}</label>
                                                        <input type="text" class="form-control" name="type"
                                                            value="{{ old('type', $item->type) }}"
                                                            placeholder="{{ __('type') }}" />
                                                        @error('type')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group" id="item_cost">
                                                        <label for="first-name-vertical">{{ __('cost') }}</label>
                                                        <input type="text" class="form-control" name="cost"
                                                            value="{{ old('cost', $item->cost) }}"
                                                            placeholder="{{ __('if_lost_item_money') }}" />
                                                        @error('cost')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group" id="item_details">
                                                        <label for="details-vertical">{{ __('item_details') }}</label>
                                                        <textarea name="details" placeholder="{{ __('write_item_details') }}" class="form-control"
                                                            id="details-vertical">{{ old('details', $item->details) }}</textarea>
                                                        @error('details')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @elseif ($item->category->slug == 'money')
                                                <div class="col-12">
                                                    <div class="form-group" id="item_type">
                                                        <label for="first-name-vertical">{{ __('type') }}</label>
                                                        <input type="text" class="form-control" name="type"
                                                            value="{{ old('type', $item->type) }}"
                                                            placeholder="{{ __('type') }}" />
                                                        @error('type')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group" id="item_cost">
                                                        <label for="first-name-vertical">{{ __('cost') }}</label>
                                                        <input type="text" class="form-control" name="cost"
                                                            value="{{ old('cost', $item->cost) }}"
                                                            placeholder="{{ __('if_lost_item_money') }}" />
                                                        @error('cost')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group" id="item_details">
                                                        <label for="details-vertical">{{ __('item_details') }}</label>
                                                        <textarea name="details" placeholder="{{ __('write_item_details') }}" class="form-control"
                                                            id="details-vertical">{{ old('details', $item->details) }}</textarea>
                                                        @error('details')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-12">
                                                    <div class="form-group" id="item_type">
                                                        <label for="first-name-vertical">{{ __('type') }}</label>
                                                        <input type="text" class="form-control" name="type"
                                                            value="{{ old('type', $item->type) }}"
                                                            placeholder="{{ __('type') }}" />
                                                        @error('type')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group" id="item_cost">
                                                        <label for="first-name-vertical">{{ __('cost') }}</label>
                                                        <input type="text" class="form-control" name="cost"
                                                            value="{{ old('cost', $item->cost) }}"
                                                            placeholder="{{ __('if_lost_item_money') }}" />
                                                        @error('cost')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group" id="item_details">
                                                        <label for="details-vertical">{{ __('item_details') }}</label>
                                                        <textarea name="details" placeholder="{{ __('write_item_details') }}" class="form-control"
                                                            id="details-vertical">{{ old('details', $item->details) }}</textarea>
                                                        @error('details')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif

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

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{ __('primary_colour') }}</label>
                                                    <input type="text" class="form-control" name="primary_colour"
                                                        value="{{ old('primary_colour', $item->primary_colour) }}"
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
                                                        value="{{ old('secondary_colour', $item->secandary_colour) }}"
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
                                                        value="{{ old('tertiary_colour', $item->tertiary_colour) }}"
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
                                                            <label
                                                                for="first-name-vertical">{{ __('station_location') }}</label>
                                                            <input type="text" class="form-control" disabled
                                                                value="{{ $item->station->location }}" />
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label
                                                                for="first-name-vertical">{{ __('station_number') }}</label>
                                                            <input type="text" class="form-control" disabled
                                                                value="{{ $item->station->number }}" />
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label
                                                                for="first-name-vertical">{{ __('station_location') }}</label>
                                                            <input type="text" class="form-control" disabled
                                                                value="{{ $item->station->location }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">{{ __('item_location') }}</label>
                                                    <input type="text" id="pac-input" class="form-control"
                                                        value="{{ old('location', $item->location) }}"
                                                        placeholder="{{ __('item_location') }}" name="location" required>

                                                    @error('location')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div id="map" style="height: 500px;width: 1000px; margin-bottom: 15px;"></div>
                                            <input type="hidden" name="lat" id="latitude" value="{{ $item->lat }}">
                                            <input type="hidden" name="lng" id="longitude" value="{{ $item->lng }}">

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
                                                                    for="first-name-vertical">{{ __('first_name') }}</label>
                                                                <input type="text" class="form-control" name="first_name"
                                                                    value="{{ old('first_name', $item->first_name) }}"
                                                                    placeholder="{{ __('first_name') }}" required />
                                                                @error('first_name')
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
                                                                    for="first-name-vertical">{{ __('family_name') }}</label>
                                                                <input type="text" class="form-control" name="surname"
                                                                    value="{{ old('surname', $item->surname) }}"
                                                                    placeholder="{{ __('family_name') }}" required />
                                                                @error('surname')
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
                                                                    for="first-name-vertical">{{ __('email') }}</label>
                                                                <input type="email" class="form-control" name="email"
                                                                    value="{{ old('email', $item->email) }}"
                                                                    placeholder="{{ __('email') }}" required />
                                                                @error('email')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('address') }}</label>
                                                                <input type="text" class="form-control" name="address"
                                                                    value="{{ old('address', $item->address) }}"
                                                                    placeholder="{{ __('address') }}" required />
                                                                @error('address')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('second_address') }}</label>
                                                                <input type="text" class="form-control"
                                                                    name="second_address"
                                                                    value="{{ old('second_address', $item->second_address) }}"
                                                                    placeholder="{{ __('second_address') }}" />
                                                                @error('second_address')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="selectCountry">{{ __('select_country') }}</label>
                                                                <select class="form-control form-control-lg mb-1"
                                                                    name="country_id" id="selectCountry" required>

                                                                    @foreach ($countries as $country)
                                                                        <option value="{{ $country->id }}"
                                                                            {{ old('country_id', $item->country_id) == $country->id ? 'selected' : '' }}>
                                                                            {{ $country->name }}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                                @error('country_id')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group" id="city_form_select">
                                                                <label for="selectCity">{{ __('select_city') }}</label>
                                                                <div class="form-group">
                                                                    <select id="selectCity" name="city_id"
                                                                        class="form-control form-control-lg mb-1" required>

                                                                        <option value="">

                                                                        </option>

                                                                    </select>
                                                                </div>
                                                                @error('city_id')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('post_code') }}</label>
                                                                <input type="text" class="form-control" name="postcode"
                                                                    value="{{ old('post_code', $item->postcode) }}"
                                                                    placeholder="{{ __('post_code') }}" required />
                                                                @error('post_code')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
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

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('mobile') }}</label>
                                                                <input type="text" class="form-control" name="mobile"
                                                                    value="{{ old('mobile', $item->mobile) }}"
                                                                    placeholder="{{ __('mobile') }}" required />
                                                                @error('mobile')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
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
                                                                    for="first-name-vertical">{{ __('first_name') }}</label>
                                                                <input type="text" class="form-control" name="first_name"
                                                                    value="{{ old('first_name') }}"
                                                                    placeholder="{{ __('first_name') }}" required />
                                                                @error('first_name')
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
                                                                    for="first-name-vertical">{{ __('family_name') }}</label>
                                                                <input type="text" class="form-control" name="surname"
                                                                    value="{{ old('surname') }}"
                                                                    placeholder="{{ __('family_name') }}" required />
                                                                @error('surname')
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
                                                                    for="first-name-vertical">{{ __('email') }}</label>
                                                                <input type="email" class="form-control" name="email"
                                                                    value="{{ old('email') }}"
                                                                    placeholder="{{ __('email') }}" required />
                                                                @error('email')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('address') }}</label>
                                                                <input type="text" class="form-control" name="address"
                                                                    value="{{ old('address') }}"
                                                                    placeholder="{{ __('address') }}" required />
                                                                @error('address')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('second_address') }}</label>
                                                                <input type="text" class="form-control"
                                                                    name="second_address"
                                                                    value="{{ old('second_address') }}"
                                                                    placeholder="{{ __('second_address') }}"
                                                                    />
                                                                @error('second_address')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="selectCountry">{{ __('select_country') }}</label>
                                                                <select class="form-control form-control-lg mb-1"
                                                                    name="country_id" id="selectCountry" required>

                                                                    <option value="">{{ __('select') }}</option>

                                                                    @foreach ($countries as $country)
                                                                        <option value="{{ $country->id }}"
                                                                            {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                                            {{ $country->name }}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                                @error('country_id')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group" id="city_form_select">
                                                                <label for="selectCity">{{ __('select_city') }}</label>
                                                                <div class="form-group">
                                                                    <select id="selectCity" name="city_id"
                                                                        class="form-control form-control-lg mb-1" required>
                                                                        <option value="">{{ __('select') }}</option>
                                                                    </select>
                                                                </div>
                                                                @error('city_id')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('post_code') }}</label>
                                                                <input type="text" class="form-control" name="postcode"
                                                                    value="{{ old('post_code') }}"
                                                                    placeholder="{{ __('post_code') }}" required />
                                                                @error('post_code')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
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

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="first-name-vertical">{{ __('mobile') }}</label>
                                                                <input type="text" class="form-control" name="mobile"
                                                                    value="{{ old('mobile') }}"
                                                                    placeholder="{{ __('mobile') }}" required />
                                                                @error('mobile')
                                                                    <span class="alert alert-danger">
                                                                        <small
                                                                            class="errorTxt">{{ $message }}</small>
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

        <script src="{{ asset('dashboard/assets/js/custom/maps.js') }}"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdarVlRZOccFIGWJiJ2cFY8-Sr26ibiyY&libraries=places&callback=initAutocomplete&language=ar
                                async defer"></script>

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

            var slug = $('#selectCategory').find(':selected').data('slug');

            if (slug == 'other') {

                $('#item_type').show();

                $('#item_details').show();

                $('#item_cost').hide();


            } else if (slug == 'money') {

                $('#item_cost').show();

                $('#item_type').hide();

                $('#item_details').hide();


            } else {

                $('#item_type').hide();
                $('#item_cost').hide();
                $('#item_details').show();

            }


            $('#selectCategory').change(function(e) {
                e.preventDefault();

                var slug = $(this).find(':selected').data('slug');

                if (slug == 'other') {

                    $('#item_type').show();

                    $('#item_details').show();

                    $('#item_cost').hide();


                } else if (slug == 'money') {

                    $('#item_cost').show();

                    $('#item_type').hide();

                    $('#item_details').hide();


                } else {

                    $('#item_type').hide();
                    $('#item_cost').hide();
                    $('#item_details').show();

                }

            });

            $('#update_item_form').submit(function() {

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

                            $.each(result.cities, function(key, value) {
                                $("#selectCity").append('<option value="' + value
                                    .id + '" ' + (city == value.id ? 'selected' : '') + '>' +
                                    value.name + '</option>');
                            });
                        }
                    });

                }

            });

            // $('#city_form_select').hide();
            $('#selectCountry').on('change', function() {
                $('#city_form_select').fadeIn();
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
