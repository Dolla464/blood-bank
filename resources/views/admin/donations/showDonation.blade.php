@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Donation Details</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/donations') }}">Donation Requests</a></li>
                    <li class="breadcrumb-item active">Donation Details</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection

@section('content')
    <div class="container-fluid mt-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><i class="fas fa-tint text-danger"></i> Donation Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Patient Name</th>
                                        <th class="text-center">Patient Age</th>
                                        <th class="text-center">Blood Type</th>
                                        <th class="text-center">Bags Number</th>
                                        <th class="text-center">Latitude</th>
                                        <th class="text-center">Longitude</th>
                                        <th class="text-center">City</th>
                                        <th class="text-center">Client Name</th>
                                        <th class="text-center">Patient Phone</th>
                                        <th class="text-center">Notes</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="donationsTableBody">
                                    @if ($donation)
                                        <tr class="text-center">
                                            <td>{{ $donation->id }}</td>

                                            <td>{{ $donation->patient_name }}</td>

                                            <td>{{ $donation->patient_age }}</td>

                                            <td>{{ $donation->bloodType->name }}</td>

                                            <td>{{ $donation->bags_number }}</td>

                                            <td>{{ $donation->latitude }}</td>

                                            <td>{{ $donation->longitude }}</td>

                                            <td>{{ $donation->city->name }}</td>

                                            <td>{{ $donation->client->name }}</td>

                                            <td>{{ $donation->patient_phone }}</td>

                                            <td>{{ $donation->notes }}</td>
                                            <td>
                                                <!-- Delete Button -->
                                                <form action="{{ route('donations.destroy', $donation->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger delete-btn action-btn"
                                                        aria-label="Delete Donation"
                                                        style="background-color:#c0392b;border-color:#c0392b;"
                                                        data-toggle="tooltip" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="6">No Donations found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Delete Button Click with SweetAlert2
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                button.closest('form').submit();
                            }
                        });
                    });
                });
            });
        </script>
        <script src="{{ asset('adminlte/governorates.js') }}"></script>
    @endpush

    <link rel="stylesheet" href="{{ asset('adminlte/governorates-custom.css') }}">
@endsection
