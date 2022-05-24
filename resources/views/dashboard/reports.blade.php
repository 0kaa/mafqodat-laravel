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

                        <!-- Sales Line Chart Card -->
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header align-items-start">
                                    <div>
                                        <h4 class="card-title mb-25">{{ __('items_statistics') }}</h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <canvas class="line-chart-ex chartjs" data-height="450" style="height: 300px;width: 546px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/ Sales Line Chart Card -->

                        <div class="col-lg-6 col-md-12">
                            <div class="card">
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
                                                <td>{{ $item->station->name . ' | ' . __($item->station->type) }}</td>
                                                <td class="text-center">
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
                                        {{ $item->count() }} ,
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
