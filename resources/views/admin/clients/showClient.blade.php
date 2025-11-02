@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Client Details</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/clients') }}">Clients</a></li>
                    <li class="breadcrumb-item active">Clients</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection

@section('content')
    <div class="container-fluid mt-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><i class="fas fa-tint text-danger"></i> Details for:
                            <span class="badge badge-danger text-warning">{{ $client->name }}</span>
                        </h4>
                    </div>



                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Client Name</th>
                                    <th class="text-center">Client Phone</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date of Birth</th>
                                    <th class="text-center">Blood Type</th>
                                    <th class="text-center">City</th>
                                    <th class="text-center">Governorate</th>
                                    <th class="text-center">Last Donation Date</th>
                                    <th class="text-center">Donation Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="donationsTableBody">
                                @if ($client)
                                    <tr class="text-center">
                                        <td>{{ $client->id }}</td>

                                        <td>{{ $client->name }}</td>

                                        <td>{{ $client->phone }}</td>

                                        <td>{{ $client->email }}</td>

                                        <td>
                                            <form action="{{ route('admin.clients.updateStatus', $client->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <select name="status" onchange="this.form.submit()"
                                                    class="form-control form-control-sm font-weight-bold
                                                        @if ($client->status == 'active') bg-success text-white
                                                        @elseif($client->status == 'inactive') bg-warning text-dark
                                                        @elseif($client->status == 'banned') bg-danger text-white @endif">
                                                    <option value="active"
                                                        {{ $client->status == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive"
                                                        {{ $client->status == 'inactive' ? 'selected' : '' }}>Deactive
                                                    </option>
                                                    <option value="banned"
                                                        {{ $client->status == 'banned' ? 'selected' : '' }}>Banned</option>
                                                </select>
                                            </form>
                                        </td>

                                        <td>{{ $client->date_of_birth }}</td>

                                        <td>{{ $client->bloodType->name }}</td>

                                        <td>{{ $client->city->name }}</td>

                                        <td>{{ $client->city->governorate->name }}</td>

                                        <td>{{ $client->last_donation_date }}</td>

                                        {{-- {{ !! to print html tag in the cell!! }} --}}
                                        <td>{!! $client->can_donate_badge !!}</td>

                                        <td>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn action-btn"
                                                    aria-label="Delete Client"
                                                    style="background-color:#c0392b;border-color:#6c1a11;"
                                                    data-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="6">No Clients found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            </script>
        @endif
    @endpush

    <link rel="stylesheet" href="{{ asset('adminlte/governorates-custom.css') }}">
@endsection
