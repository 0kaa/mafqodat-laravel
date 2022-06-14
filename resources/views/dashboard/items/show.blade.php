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

                                        @if ($item->itemMedia->count() > 0)
                                            @foreach ($itemMedia->where('item_id', $item->id) as $media)
                                                @if ($loop->first)
                                                    <img src="{{ asset('storage/' . $media->media->image) }}"
                                                        alt="{{ $media->name }}" width="150" height="150">
                                                @endif
                                            @endforeach
                                        @else
                                            <img src="https://via.placeholder.com/150" alt="">
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

                                                    <li>{{ __('report_number') }} : {{ $item->report_number }}</li>

                                                    <li>{{ __('category_name') }} : {{ $item->category->name }}</li>

                                                    <li>{{ __('storage') }} : {{ $item->storage->name }}</li>

                                                    <li>{{ __('details') }} : {{ $item->details }}</li>

                                                    <li>{{ __('station_name') }} : {{ $item->station->name }}</li>
                                                    <li>{{ __('station_number') }} : {{ $item->station->number }}</li>
                                                    <li>{{ __('station_location') }} : {{ $item->station->location }}
                                                    </li>
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

                                                {{ __('item_status') }} : <span
                                                    class="badge badge-light-success">{{ __('delivered') }}</span>
                                                <ul>
                                                    <li>{{ __('full_name') }} : {{ $item->full_name }}</li>
                                                    <li>{{ __('phone') }} : {{ $item->phone }}</li>
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
