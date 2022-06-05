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


                        <!-- Statistics Card -->
                        <div class="col-xl-12 col-md-12 col-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('statistics') }}</h4>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="media">
                                                <div class="avatar bg-light-primary mr-2">
                                                    <div class="avatar-content">
                                                        <a href="{{ route('admin.items.index') }}"
                                                            class="text-primary"><i data-feather="box"
                                                                class="avatar-icon"></i></a>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0 item-count">{{ $items }}
                                                    </h4>
                                                    <p class="card-text font-small-3 mb-0">{{ __('total_items') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="media">
                                                <div class="avatar bg-light-info mr-2">
                                                    <div class="avatar-content">
                                                        <a href="{{ route('admin.items.index') }}"
                                                            class="text-info"><i data-feather="box"
                                                                class="avatar-icon"></i></a>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">{{ $delivered_items }}</h4>
                                                    <p class="card-text font-small-3 mb-0">
                                                        {{ __('total_delivered_items') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="media">
                                                <div class="avatar bg-light-danger mr-2">
                                                    <div class="avatar-content">
                                                        <a href="{{ route('admin.stations.index') }}"
                                                            class="text-danger"><i data-feather="compass"
                                                                class="avatar-icon"></i></a>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">{{ $stations_count }}</h4>
                                                    <p class="card-text font-small-3 mb-0">{{ __('total_stations') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="media">
                                                <div class="avatar bg-light-success mr-2">
                                                    <div class="avatar-content">
                                                        <a href="{{ route('admin.employees.index') }}"
                                                            class="text-success"><i data-feather="users"
                                                                class="avatar-icon"></i></a>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">{{ $employees }}</h4>
                                                    <p class="card-text font-small-3 mb-0">{{ __('total_employees') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->

                        <div class="col-lg-12 col-md-12">
                            <div class="card">

                                <div class="row">
                                    <div class="col-lg-12">
                                        {{-- export pdf button --}}
                                        <input type="button" class="btn btn-primary mr-1 mb-2" id="btnExport"
                                            value="{{ __('export_pdf') }}" onclick="Export()" />

                                        {{-- export excel button --}}
                                        <input type="button" class="btn btn-primary mr-1 mb-2" id="exportExcel"
                                            value="{{ __('export_excel') }}" />
                                    </div>
                                </div>

                                <table class="datatables-basic table export_table" id="tblLatestItems">
                                    <thead>
                                        <tr>
                                            <th>{{ __('id') }}</th>
                                            <th>{{ __('report_number') }}</th>
                                            <th>{{ __('category_name') }}</th>
                                            <th>{{ __('storage') }}</th>
                                            <th>{{ __('date') }}</th>
                                            <th>{{ __('time') }}</th>
                                            <th>{{ __('station_name') }}</th>
                                            <th>{{ __('station_location') }}</th>
                                            <th class="noExl">{{ __('image') }}</th>
                                            <th>{{ __('is_delivered') }}</th>
                                            <th class="noExl">{{ __('qr_code') }}</th>
                                            <th>{{ __('deliverd_name') }}</th>
                                            <th>{{ __('deliverd_phone') }}</th>
                                            <th class="noExl">{{ __('actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latest_items as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->report_number }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->storage->name }}</td>
                                                <td>{{ $item->date->format('Y-m-d') }}</td>
                                                <td>{{ $item->time->format('h:i A') }}</td>
                                                <td>{{ $item->station->name}}</td>
                                                <td>{{ $item->station->location }}</td>
                                                <td class="noExl">
                                                    @if ($item->media())
                                                        <img src="{{ asset('storage/' . $item->media[0]->image) }}"
                                                            style="width: 50px; height: auto;">
                                                    @else
                                                        <img src="https://via.placeholder.com/50">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->is_delivered == 1)
                                                        <span class="badge badge-light-success">{{ __('yes') }}</span>
                                                    @else
                                                        <span class="badge badge-light-danger">{{ __('no') }}</span>
                                                    @endif
                                                </td>
                                                <td class="my-2 noExl">
                                                    {!! QrCode::generate(url('/admin/items') . '/' . $item->id) !!}
                                                </td>
                                                <td>{{ $item->is_delivered == 1 ? $item->first_name . ' ' . $item->surname : '-' }}</td>
                                                <td>{{ $item->is_delivered == 1 ? $item->phone : '-' }}</td>
                                                <td class="text-center noExl">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.items.show', $item->id) }}"
                                                            class="btn btn-sm btn-info"><i data-feather="eye"></i></a>
                                                        <a href="{{ route('admin.items.edit', $item->id) }}"
                                                            class="btn btn-sm btn-primary"><i data-feather="edit"></i></a>
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

                        <!-- Sales Line Chart Card -->
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header align-items-start">
                                    <div>
                                        <h4 class="card-title mb-25">{{ __('items_statistics') }}</h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <canvas class="line-chart-ex chartjs" data-height="450"
                                        style="height: 300px;width: 546px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/ Sales Line Chart Card -->


                    </div>
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>

    @push('js')
        {{-- Chart Scripts --}}

        <script src="{{ asset('dashboard/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('dashboard/app-assets/vendors/js/charts/chart.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"
        integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="{{ asset('dashboard/app-assets/js/custom/export.js') }}"></script>
        <script>
            function Export() {
                // print this
                $('#tblLatestItems').printThis();
            }

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

        <script>
            $(window).on('load', function() {
                'use strict';

                var lineChartEx = $('.line-chart-ex');

                // Color Variables
                var warningColorShade = '#ffe802',
                    tooltipShadow = 'rgba(0, 0, 0, 0.25)',
                    lineChartPrimary = '#666ee8',
                    lineChartDanger = '#ff4961',
                    labelColor = '#6e6b7b',
                    grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout

                // Detect Dark Layout
                if ($('html').hasClass('dark-layout')) {
                    labelColor = '#b4b7bd';
                }

                // Line Chart
                // --------------------------------------------------------------------
                if (lineChartEx.length) {
                    var lineExample = new Chart(lineChartEx, {
                        type: 'line',
                        plugins: [
                            // to add spacing between legends and chart
                            {
                                beforeInit: function(chart) {
                                    chart.legend.afterFit = function() {
                                        this.height += 20;
                                    };
                                }
                            }
                        ],
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            backgroundColor: false,
                            hover: {
                                mode: 'label'
                            },
                            tooltips: {
                                // Updated default tooltip UI
                                shadowOffsetX: 1,
                                shadowOffsetY: 1,
                                shadowBlur: 8,
                                shadowColor: tooltipShadow,
                                backgroundColor: window.colors.solid.white,
                                titleFontColor: window.colors.solid.black,
                                bodyFontColor: window.colors.solid.black
                            },
                            layout: {
                                padding: {
                                    top: -15,
                                    bottom: -25,
                                    left: -15
                                }
                            },
                            scales: {
                                xAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true
                                    },
                                    gridLines: {
                                        display: true,
                                        color: grid_line_color,
                                        zeroLineColor: grid_line_color
                                    },
                                    ticks: {
                                        fontColor: labelColor
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true
                                    },
                                    ticks: {
                                        stepSize: 100,
                                        min: 0,
                                        max: 500,
                                        fontColor: labelColor
                                    },
                                    gridLines: {
                                        display: true,
                                        color: grid_line_color,
                                        zeroLineColor: grid_line_color
                                    }
                                }]
                            },
                            legend: {
                                position: 'top',
                                align: 'start',
                                labels: {
                                    usePointStyle: true,
                                    padding: 25,
                                    boxWidth: 9
                                }
                            }
                        },
                        data: {
                            labels: [
                                "Apr",
                                "May",
                                "Jun",
                                "July",
                                "Aug",
                                "Sep",
                                "Oct",
                                "Nov",
                                "Dec",
                                "Jan",
                                "Feb",
                                "Mar",
                            ],
                            datasets: [{
                                data: [
                                    @foreach ($lost_items as $item)
                                        {{ $item->count() }},
                                    @endforeach
                                ],
                                label: "{{ __('items') }}",
                                borderColor: lineChartDanger,
                                lineTension: 0.5,
                                pointStyle: 'circle',
                                backgroundColor: lineChartDanger,
                                fill: false,
                                pointRadius: 1,
                                pointHoverRadius: 5,
                                pointHoverBorderWidth: 5,
                                pointBorderColor: 'transparent',
                                pointHoverBorderColor: window.colors.solid.white,
                                pointHoverBackgroundColor: lineChartDanger,
                                pointShadowOffsetX: 1,
                                pointShadowOffsetY: 1,
                                pointShadowBlur: 5,
                                pointShadowColor: tooltipShadow
                            }, ]
                        }
                    });
                }



            });
        </script>
    @endpush
@endsection
