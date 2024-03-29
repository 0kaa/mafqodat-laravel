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
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.items.index') }}">{{ __('items') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('items_list') }}</a>
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
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ __('new_item') }}</span></a></div>
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
                                <div class="dropdown drop_01">
                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
                                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="filter"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="form-group">

                                            <input class="form-control" type="text" id="min" name="min"
                                                placeholder="{{ __('date_from') }}">

                                            <input class="form-control" type="text" id="max" name="max"
                                                placeholder="{{ __('date_to') }}">
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="tblItemMafkodat">
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
                                            <th>{{ __('image') }}</th>
                                            <th>{{ __('item_status') }}</th>
                                            <th>{{ __('qr_code') }}</th>
                                            <th>{{ __('deliverd_name') }}</th>
                                            <th>{{ __('deliverd_phone') }}</th>
                                            <th>{{ __('deliverd_date') }}</th>
                                            <th>{{ __('actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->report_number }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->storage ? $item->storage->name : '-' }}</td>
                                                <td>{{ $item->date->format('Y-m-d') }}</td>
                                                <td>{{ $item->time->format('h:i A') }}</td>
                                                <td>{{ $item->station->name }}</td>
                                                <td>{{ $item->station->location }}</td>
                                                <td>
                                                    {{-- check if itemMedia not empty --}}
                                                    @if ($item->itemMedia->count() > 0)
                                                        @foreach ($itemMedia->where('item_id', $item->id) as $media)
                                                            @if ($loop->first)
                                                                <img src="{{ asset('storage/' . $media->media->image) }}"
                                                                    alt="{{ $media->name }}" width="100" height="100">
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <img src="https://via.placeholder.com/100" alt="">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->is_delivered == 1)
                                                        <span class="badge badge-light-success">{{ __('delivered') }}</span>
                                                    @else
                                                        <span class="badge badge-light-danger">{{ __('not_delivered') }}</span>
                                                    @endif
                                                </td>
                                                <td class="my-2">
                                                    {!! QrCode::generate(url('/admin/items') . '/' . $item->id) !!}
                                                </td>
                                                <td>{{ $item->is_delivered == 1 ? $item->full_name : '-' }}
                                                </td>
                                                <td>{{ $item->is_delivered == 1 ? $item->phone : '-' }}</td>
                                                <td>{{ $item->is_delivered == 1 ? $item->delivery_date->format('Y-m-d') : '-' }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.items.show', $item->id) }}"
                                                            class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></a>
                                                        <a href="{{ route('admin.items.edit', $item->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.items.destroy', $item->id) }}"
                                                            data-id="{{ $item->id }}"
                                                            class="btn btn-sm btn-danger item-delete"><i
                                                                class="fa-solid fa-trash"></i></a>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>

        <script>
            $(document).on('click.bs.dropdown', '#station_select', function(e) {
                e.stopPropagation();
            });

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

            var minDate, maxDate;

            // Custom filtering function which will search data in column four between two values
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = minDate.val();
                    var max = maxDate.val();
                    var date = new Date(data[4]);

                    if (
                        (min === null && max === null) ||
                        (min === null && date <= max) ||
                        (min <= date && max === null) ||
                        (min <= date && date <= max)
                    ) {
                        return true;
                    }
                    return false;
                }
            );

            $(document).ready(function() {

                var locale = '{!! config('app.locale') !!}';

                // Create date inputs
                minDate = new DateTime($('#min'), {
                    format: 'YYYY-MM-DD'
                });
                maxDate = new DateTime($('#max'), {
                    format: 'YYYY-MM-DD'
                });

                // DataTables initialisation
                var table = $('#tblItemMafkodat').DataTable({
                    "language": {
                        "url": locale == 'ar' ? "https://cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json" : "https://cdn.datatables.net/plug-ins/1.11.5/i18n/en-GB.json"
                    },
                    scrollX: true,
                    dom: 'Bfrtip',
                    lengthMenu: [10, 25, 50, 75, 100],
                    buttons: [
                        'copy', 'excel', 'print', 'pageLength'
                    ]
                });
                table.draw();
                table.buttons().container()
                    .appendTo('#tblItemMafkodat_wrapper .col-md-6:eq(0)');

                // Refilter the table
                $('#min, #max, #station_select').on('change', function() {

                    table.draw();

                    // var thisValue = $(this).val();
                    // // search datatable use value
                    // table.search(thisValue).draw();

                });
            });
        </script>
    @endpush
@endsection
