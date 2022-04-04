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
                                                        <i data-feather="box" class="avatar-icon"></i>
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
                                                        <i data-feather="box" class="avatar-icon"></i>
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
                                                        <i data-feather="compass" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">{{ $stations }}</h4>
                                                    <p class="card-text font-small-3 mb-0">{{ __('total_stations') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="media">
                                                <div class="avatar bg-light-success mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="users" class="avatar-icon"></i>
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
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header align-items-start">
                                    <div>
                                        <h4 class="card-title mb-25">{{ __('items') }}</h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <div id="sales-line-chart"></div>
                                </div>
                            </div>
                        </div>
                        <!--/ Sales Line Chart Card -->

                        <div class="col-6">
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
        <script src="{{ asset('dashboard/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>

        <script>
            $(document).ready(function () {

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

                                var id    = $(this).data('id');
                                var url = $(this).attr('href');
                                var elem  = $(this).closest('tr');

                                $.ajax({
                                    type: 'POST',
                                    url: url,
                                    data: {
                                        _method : 'delete',
                                        _token  : $('meta[name="csrf-token"]').attr('content'),
                                        id      : id,
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

                            } else if (result.dismiss === Swal.DismissReason.cancel)
                            {
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
            $(window).on("load", function() {
                "use strict";

                var $strokeColor = "#ebe9f1";

                var $textMutedColor = "#b9b9c3";
                var $salesStrokeColor2 = "#df87f2";

                var salesLineChartOptions;

                var salesLineChart;


                var $salesLineChart = document.querySelector("#sales-line-chart");

                // Sales Line Chart
                // -----------------------------
                salesLineChartOptions = {
                    chart: {
                        height: 240,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        type: "line",
                        dropShadow: {
                            enabled: true,
                            top: 18,
                            left: 2,
                            blur: 5,
                            opacity: 0.2,
                        },
                        offsetX: -10,
                    },
                    stroke: {
                        curve: "smooth",
                        width: 4,
                    },
                    grid: {
                        borderColor: $strokeColor,
                        padding: {
                            top: -20,
                            bottom: 5,
                            left: 20,
                        },
                    },
                    legend: {
                        show: false,
                    },
                    colors: [$salesStrokeColor2],
                    fill: {
                        type: "gradient",
                        gradient: {
                            shade: "dark",
                            inverseColors: false,
                            gradientToColors: [window.colors.solid.primary],
                            shadeIntensity: 1,
                            type: "horizontal",
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100, 100, 100],
                        },
                    },
                    markers: {
                        size: 0,
                        hover: {
                            size: 5,
                        },
                    },
                    xaxis: {
                        labels: {
                            offsetY: 5,
                            style: {
                                colors: $textMutedColor,
                                fontSize: "0.857rem",
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        categories: [
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
                            "Jan",
                            "Feb",
                        ],
                        axisBorder: {
                            show: false,
                        },
                        tickPlacement: "on",
                    },
                    yaxis: {
                        tickAmount: 5,
                        min: 0,
                        max: 500,
                        labels: {
                            style: {
                                colors: $textMutedColor,
                                fontSize: "0.857rem",
                            },

                        },
                    },
                    tooltip: {
                        x: {
                            show: false
                        },
                    },
                    series: [{
                        name: "{{ __('items') }}",
                        data: [

                            @foreach ($lost_items as $item)
                                {{ $item->count() }} ,
                            @endforeach

                        ],
                    }, ],
                };
                salesLineChart = new ApexCharts($salesLineChart, salesLineChartOptions);
                salesLineChart.render();
            });
        </script>
    @endpush
@endsection
