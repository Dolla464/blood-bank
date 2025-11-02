@extends('admin.layouts.main')

@section('page_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Create New User</h1>
        </div><!-- /.col -->

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/users') }}">Users</a></li>
                <li class="breadcrumb-item active">New User</li>
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
                    <h3 class="card-title">New User Details: </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter username..."
                                        value="{{ old('name', $user->name ?? '') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter user email..."
                                        value="{{ old('email', $user->email ?? '') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter user password..."
                                        value="{{ old('password', $user->password ?? '') }}">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Password Confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Re-Enter user password..."
                                        value="{{ old('password_confirmation', $user->password ?? '') }}">
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role_name" id="role_name" class="form-control @error('role_name') is-invalid @enderror">
                                        <option value="">-- Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-footer mt-2">
                                    <button type="submit" class="btn btn-primary save-btn">Create</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
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
        });
    </script>
@endpush
@endsection
