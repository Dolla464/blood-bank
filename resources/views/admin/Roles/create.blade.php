@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create New Role</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/roles') }}">Roles</a></li>
                    <li class="breadcrumb-item active">New Role</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection

@section('content')
    <div class="container-fluid mt-2">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">New Role Details: </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Role Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter rolename..." value="{{ old('name', $role->name ?? '') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group clearfix">
                                        <label for="name">Permissions:</label>
                                        <div class="mb-2">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                id="selectAllPermissions">Select All</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                id="deselectAllPermissions">Deselect All</button>
                                        </div>
                                        @error('permissions')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                        @error('permissions.*')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                        @foreach ($permissions->groupBy('group') as $group => $permissionList)
                                            <h4 class="text-danger">{{ $group }}</h4>
                                            <div class="row">
                                                @foreach ($permissionList as $permission)
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input permission-checkbox"
                                                                type="checkbox" id="permission_{{ $permission->id }}"
                                                                name="permissions[]" value="{{ $permission->name }}">
                                                            <label for="permission_{{ $permission->id }}"
                                                                class="form-check-label">{{ $permission->name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-footer mt-2">
                                        <button type="submit" class="btn btn-primary save-btn">Create</button>
                                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Save Button Click
                document.querySelectorAll('.save-btn').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Do you want to save this?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, save it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                button.closest('form').submit();
                            }
                        });
                    });
                });
                // Select All Permissions
                document.getElementById('selectAllPermissions').addEventListener('click', function() {
                    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                        checkbox.checked = true;
                    });
                });

                // Deselect All Permissions
                document.getElementById('deselectAllPermissions').addEventListener('click', function() {
                    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                        checkbox.checked = false;
                    });
                });
            });
        </script>
    @endpush
@endsection
