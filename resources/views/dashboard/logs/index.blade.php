@extends('dashboard.layouts.app')

@section('title' ,  __('employee_logs'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.get_logs') }}">{{ __('employee_logs') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('employee_logs') }}</a>
                                    </li>
                                </ol>
                            </div>
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
                                                <th>{{ __('log') }}</th>
                                                {{-- <th>{{ __('actions') }}</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logs as $log)
                                                <tr>
                                                    <td>{{ $log->id }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="image">
                                                                @if ($log->image)
                                                                    <img src="{{ asset('storage/'.$log->image) }}" alt="" width="100px">
                                                                @else
                                                                    <img src="https://via.placeholder.com/100" alt="">
                                                                @endif
                                                            </div>
                                                            <div class="text ml-2" style="direction: ltr">
                                                                <h4>{{ $log->message }}</h4>
                                                                <span>{{ $log->date }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Second group">
                                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary"><i data-feather="edit"></i></a>
                                                            <a href="{{ route('admin.categories.destroy', $category->id) }}" data-id="{{ $category->id }}" class="btn btn-sm btn-danger item-delete"><i data-feather="trash"></i></a>
                                                        </div>
                                                    </td> --}}
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


