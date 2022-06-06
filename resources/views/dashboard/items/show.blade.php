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
                        <div class="col-md-8">
                            <div class="card">
                                <div class="item_card">
                                    <div>

                                        @if ($item->image)
                                            <img class="card-img-top" src="{{ asset('storage/' . $item->image) }}"
                                                alt="Card image cap" height="100px" />
                                        @else
                                            <img src="https://via.placeholder.com/150">
                                        @endif

                                    </div>

                                    <div class="card-body">
                                        <div>
                                            <h1>{{ __('show_item') }} | #{{ $item->id }}</h1>

                                            <small>{{ $item->date->format('Y-m-d') }} |
                                                {{ $item->time->format('h:i A') }}</small>

                                            <div class="my-2">
                                                <ul>
                                                    <li>{{ __('report_type') }} : {{ __($item->report_type) }}</li>

                                                    @if ($item->report_type == 'found')
                                                        <li>{{ __('informer_name') }} : {{ $item->informer_name }}</li>
                                                        <li>{{ __('informer_phone') }} : {{ $item->informer_phone }}
                                                        </li>
                                                    @endif

                                                    <li>{{ __('category_name') }} : {{ $item->category->name }}</li>

                                                    @if ($item->category->slug == 'other')
                                                        <li>{{ __('type') }} : {{ $item->type }}</li>
                                                        <li>{{ __('details') }} : {{ $item->details }}</li>
                                                    @elseif ($item->category->slug == 'money')
                                                        <li>{{ __('cost') }} : {{ $item->cost }}</li>
                                                    @endif

                                                    <li>{{ __('station_name') }} : {{ $item->station->name }}</li>
                                                    <li>{{ __('station_number') }} : {{ $item->station->number }}</li>
                                                    <li>{{ __('station_location') }} : {{ $item->station->location }}</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <a href="{{ route('admin.items.edit', $item->id) }}"
                                                class="btn btn-primary mr-1">{{ __('update') }}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @if ($item->is_delivered == 1)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="item_card">
                                        <div class="card-body">
                                            <div>

                                                {{ __('is_delivered') }} : <span
                                                    class="badge badge-light-success">{{ __('yes') }}</span>

                                                <ul>
                                                    <li>{{ __('first_name') }} : {{ $item->first_name }}</li>
                                                    <li>{{ __('family_name') }} : {{ $item->surname }}</li>
                                                    <li>{{ __('address') }} : {{ $item->address }}</li>
                                                    <li>{{ __('second_address') }} :
                                                        {{ $item->second_address }}</li>
                                                    <li>{{ __('city') }} : {{ $item->city->name }}</li>
                                                    <li>{{ __('postcode') }} : {{ $item->postcode }}</li>
                                                    <li>{{ __('phone') }} : {{ $item->phone }}</li>
                                                    <li>{{ __('mobile') }} : {{ $item->mobile }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
                <!-- Item Card -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
