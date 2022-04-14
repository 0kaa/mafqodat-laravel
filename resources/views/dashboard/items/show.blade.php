@extends('dashboard.layouts.app')

@section('title', __('items'))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">

                </div>
            </div>
            <div class="content-body">
                <!-- Item Card -->
                <section id="card-demo-example">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="item_card">
                                    <div>

                                        @if ($item->image)
                                            <img class="card-img-top" src="{{ asset('storage/' . $item->image) }}"
                                                alt="Card image cap" />
                                        @else
                                            <img src="https://via.placeholder.com/150">
                                        @endif

                                    </div>

                                    <div class="card-body">
                                        <div>
                                            <h2>{{ $item->details }}</h2>

                                            <small>{{ $item->date->format('Y-m-d') }} |
                                                {{ $item->time->format('h:i A') }}</small>

                                            <div class="my-2">
                                                <ul>
                                                    <li>{{ __('category_name') }} : {{ $item->category->name }}</li>
                                                    <li>{{ __('station_name') }} : {{ $item->station->name }}</li>
                                                    <li>{{ __('station_number') }} : {{ $item->station->number }}</li>
                                                    <li>{{ __('station_location') }} : {{ $item->station->location }}
                                                    </li>

                                                    <li>{{ __('primary_colour') }} : {{ $item->primary_colour }}</li>
                                                    <li>{{ __('secondary_colour') }} :
                                                        {{ $item->secondary_colour }}
                                                    </li>
                                                    <li>{{ __('tertiary_colour') }} :
                                                        {{ $item->tertiary_colour }}</li>
                                                </ul>

                                                @if ($item->is_delivered == 1)
                                                    {{ __('is_delivered') }} : <span
                                                        class="badge badge-light-success">{{ __('yes') }}</span>

                                                    <ul>
                                                        <li>{{ __('first_name') }} : {{ $item->first_name }}</li>
                                                        <li>{{ __('family_name') }} : {{ $item->surname }}</li>
                                                        <li>{{ __('address') }} : {{ $item->address }}</li>
                                                        <li>{{ __('second_address') }} :
                                                            {{ $item->second_address }}</li>
                                                        <li>{{ __('city') }} : {{ $item->city }}</li>
                                                        <li>{{ __('postcode') }} : {{ $item->postcode }}</li>
                                                        <li>{{ __('phone') }} : {{ $item->phone }}</li>
                                                        <li>{{ __('mobile') }} : {{ $item->mobile }}</li>
                                                    </ul>
                                                @else
                                                    {{ __('is_delivered') }} : <span
                                                        class="badge badge-light-danger">{{ __('no') }}</span>
                                                @endif
                                            </div>
                                            <p class="card-text">
                                                {{ $item->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <!-- Item Card -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
