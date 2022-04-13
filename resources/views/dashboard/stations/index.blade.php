@extends('dashboard.layouts.app')

@section('title' ,  __('stations'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.stations.index') }}">{{ __('stations') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('stations') }}</a>
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
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ route('admin.stations.create') }}"><i class="mr-1" data-feather="circle"></i><span class="align-middle">{{ __('new_station') }} </span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                    <section id="basic-datatable">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <table class="datatables-basic table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('id') }}</th>
                                                <th>{{ __('station_type') }}</th>
                                                <th>{{ __('station_name') }}</th>
                                                <th>{{ __('station_number') }}</th>
                                                <th>{{ __('station_location') }}</th>
                                                <th>{{ __('actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stations as $station)
                                                <tr>
                                                    <td>{{ $station->id }}</td>
                                                    <td>{{ $station->type }}</td>
                                                    <td>{{ $station->name }}</td>
                                                    <td>{{ $station->number }}</td>
                                                    <td>{{ $station->location }}</td>

                                                    <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Second group">
                                                            <a href="{{ route('admin.stations.edit', $station->id) }}" class="btn btn-sm btn-primary"><i data-feather="edit"></i></a>
                                                            <a href="{{ route('admin.stations.destroy', $station->id) }}" data-id="{{ $station->id }}" class="btn btn-sm btn-danger item-delete"><i data-feather="trash"></i></a>
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
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@push('js')
{{-- <script src="{{ asset('dashboard/app-assets/js/custom/custom-delete.js') }}"></script> --}}

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
@endpush
@endsection


