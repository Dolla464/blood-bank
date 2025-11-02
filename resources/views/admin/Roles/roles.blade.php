@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Roles</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection

@section('content')
    <div class="container-fluid mt-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><i class="fas fa-user-cog text-danger"></i> Roles List</h4>
                        <a href="{{ route('admin.roles.create') }}" id="addPostBtn" class="btn btn-success action-btn" aria-label="Add New role"
                            style="background-color:#27ae60;border-color:#27ae60;" data-toggle="tooltip" title="Add New">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">No. of Permissions</th>
                                        <th class="text-center">Guard Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="postsTableBody">
                                    @forelse($roles as $role)
                                        <tr class="text-center">
                                            <td>{{ $role->id }}</td>

                                            <td>{{ $role->name }}</td>

                                            <td>{{ $role->permissions_count }}</td>

                                            <td>{{ $role->guard_name }}</td>

                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                    class="btn btn-sm btn-primary edit-btn action-btn"
                                                    aria-label="Edit Role"
                                                    style="background-color:#3498db;border-color:#3498db;"
                                                    data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger delete-btn action-btn"
                                                        aria-label="Delete Role"
                                                        style="background-color:#c0392b;border-color:#c0392b;"
                                                        data-toggle="tooltip" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No roles found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-center">
                            {{ $roles->links('pagination::bootstrap-4') }}
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
        @if(session('success'))
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
