@extends('dashboard.layouts.app')

@section('title' , __('employees'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">{{ __('employees') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('employees') }}</a>
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
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ route('admin.employees.create') }}"><i class="mr-1" data-feather="circle"></i><span class="align-middle">{{ __('new_employee') }}</span></a></div>
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
                                                <th>{{ __('full_name') }}</th>
                                                <th>{{ __('mobile') }}</th>
                                                <th>{{ __('phone') }}</th>
                                                <th>{{ __('email') }}</th>
                                                <th>{{ __('country') }}</th>
                                                <th>{{ __('city') }}</th>
                                                <th>{{ __('actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employees as $employee)
                                                <tr>
                                                    <td>{{ $employee->id }}</td>
                                                    <td>{{ $employee->first_name . ' ' . $employee->family_name }}</td>
                                                    <td>{{ $employee->mobile }}</td>
                                                    <td>{{ $employee->phone }}</td>
                                                    <td>{{ $employee->email }}</td>
                                                    <td>{{ $employee->country }}</td>
                                                    <td>{{ $employee->city }}</td>

                                                    <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Second group">
                                                            <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-sm btn-primary"><i data-feather="edit"></i></a>
                                                            <a href="{{ route('admin.employees.destroy', $employee->id) }}" data-id="{{ $category->id }}" class="btn btn-sm btn-danger item-delete"><i data-feather="trash"></i></a>
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
<script src="{{ asset('dashboard/app-assets/js/custom/custom-delete.js') }}"></script>
@endpush
@endsection


