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
                        <div class="col-12 text-left mb-2">
                            <h1 class="mb-1">{{ __('welcome') . ' ' . auth()->user()->name }} </h1>
                        </div>
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
                                "Jan",
                                "Feb",
                                "Mar",
                                "Apr",
                                "May",
                                "Jun",
                                "July",
                                "Aug",
                                "Sep",
                                "Oct",
                                "Nov",
                                "Dec",
                            ],
                            datasets: [{
                                data: [
                                    @foreach ($lost_items as $item)
                                        {{ $item }},
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
