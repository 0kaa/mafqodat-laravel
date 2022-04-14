@extends('dashboard.layouts.app')

@section('title', __('control_panel'))

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">

                    <div class="row match-height">
                        <div class="col-12 pb-1">
                            <h2>{{ __('main_categories') }}</h2>
                        </div>
                        @foreach ($categories as $category)
                            <div class="col-2">
                                <div class="card">
                                    <div class="card-header flex-column align-items-start pb-0">
                                        <div>
                                            <div class="avatar-content">
                                                <img src="{{ asset('storage/' . $category->image) }}" alt="" width="65px">
                                            </div>
                                        </div>
                                        <h2 class="font-weight-bolder mt-1">{{ $category->name }}</h2>
                                    </div>
                                    <div id="gained-chart"></div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="row match-height">
                        {{-- <!-- Greetings Card starts -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card card-congratulations">
                                <div class="card-body text-center">
                                    <img src="{{ url('dashboard') }}/app-assets/images/elements/decore-left.png"
                                        class="congratulations-img-left" alt="card-img-left" />
                                    <img src="{{ url('dashboard') }}/app-assets/images/elements/decore-right.png"
                                        class="congratulations-img-right" alt="card-img-right" />
                                    <div class="avatar avatar-xl bg-primary shadow">
                                        <div class="avatar-content">
                                            <i data-feather="award" class="font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="mb-1 text-white">{{ __('congrats') }} </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Greetings Card ends --> --}}

                        <div class="col-7">
                            <div class="card">
                                <div class="card-header align-items-start">
                                    <div>
                                        <h4 class="card-title">{{ __('latest_items') }}</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="datatables-basic table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('id') }}</th>
                                                <th>{{ __('category_name') }}</th>
                                                <th>{{ __('details') }}</th>
                                                <th>{{ __('station_name') }}</th>
                                                <th>{{ __('actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($latest_items as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->category->name }}</td>
                                                    <td>{{ $item->details }}</td>
                                                    <td>{{ $item->station->name . ' | ' . __($item->station->type) }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Second group">
                                                            <a href="{{ route('admin.items.show', $item->id) }}"
                                                                class="btn btn-sm btn-info"><i data-feather="eye"></i></a>
                                                            <a href="{{ route('admin.items.edit', $item->id) }}"
                                                                class="btn btn-sm btn-primary"><i
                                                                    data-feather="edit"></i></a>
                                                            <a href="{{ route('admin.items.destroy', $item->id) }}"
                                                                data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-danger item-delete"><i
                                                                    data-feather="trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="card">
                                <div class="card-header align-items-start">
                                    <div>
                                        <h4 class="card-title mb-25">{{ __('station_locations') }}</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="map" style="height: 405px; margin-bottom: 15px;"></div>
                                    <input type="hidden" name="lat" id="latitude" value="">
                                    <input type="hidden" name="lng" id="longitude" value="">
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>

    @push('js')
        {{-- Map Scripts --}}
        <script src="https://unpkg.com/@googlemaps/markerwithlabel/dist/index.min.js"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWZCkmkzES9K2-Ci3AhwEmoOdrth04zKs&callback=initMap&libraries=&v=weekly&language=ar"
                async></script>

        <script>
            //map
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 7,
                    center: new google.maps.LatLng(24.774265, 46.738586),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,

                });

                var markers = new Array();

                var stations = @json($stations);

                // Add the markers and infowindows to the map
                // for (var i = 0; i < locations.length; i++) {
                if (stations.length != 0) {

                    $.each(stations, function(i, e) {

                        var marker = new markerWithLabel.MarkerWithLabel({
                            icon: '',
                            clickable: false,
                            position: new google.maps.LatLng(e.lat, e.lng),
                            labelContent: '',
                            labelClass: "maplabel", // the CSS class for the label
                            labelAnchor: new google.maps.Point(-32, -65),
                            map: map,
                        });

                        google.maps.event.addListener(marker, 'click', function() {
                            window.location.href = this.url;
                        })

                        markers.push(marker);

                    });

                } else {

                    var marker = new markerWithLabel.MarkerWithLabel({
                        map: map,
                    });


                    markers.push(marker);

                }

                // }

                function autoCenter() {
                    //  Create a new viewpoint bound
                    var bounds = new google.maps.LatLngBounds();
                    //  Go through each...
                    for (var i = 0; i < markers.length; i++) {
                        bounds.extend(markers[i].position);
                    }
                    //  Fit these bounds to the map
                    map.fitBounds(bounds);
                }

                autoCenter();

            }
        </script>

        <script>
            $(document).ready(function() {

                $('.item-delete').click(function(e) {

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
                            var url = $(this).attr('href');
                            var elem = $(this).closest('tr');

                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: {
                                    _method: 'delete',
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    id: id,
                                },
                                dataType: 'json',
                                success: function(result) {
                                    elem.fadeOut();

                                    Toast2.fire({
                                        title: "{{ __('deleted_successfully') }}",
                                        // showConfirmButton: false,
                                        icon: 'success',
                                        timer: 1000
                                    });
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
