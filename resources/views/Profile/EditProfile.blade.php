@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Admin Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.profile', $admin->id) }}">Admin Profile</a></li>
                    <li class="breadcrumb-item active">Edit Profile</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //control img preview
            document.getElementById('profile_image').addEventListener('change', function(event) {
                const [file] = event.target.files;
                const preview = document.getElementById('profileImagePreview');
                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'inline-block';
                }
            });

            //control update button
            var form = document.getElementById('editProfileForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you want to update your profile?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, update it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }

            //control delete button
            var deleteBtn = document.getElementById('deleteUserBtn');
            var deleteForm = document.getElementById('deleteUserForm');
            if (deleteBtn && deleteForm) {
                deleteBtn.addEventListener('click', function(e) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action will permanently delete the user!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete user!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteForm.submit();
                        }
                    });
                });
            }

            // Enable Bootstrap tooltip
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Edit Profile</span>
                        <div class="ml-auto">
                            <form id="deleteUserForm" method="POST" action="{{ route('admin.delete', $admin->id) }}"
                                style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger rounded-circle" id="deleteUserBtn"
                                    style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;"
                                    data-toggle="tooltip" data-placement="left" title="Delete User">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="editProfileForm" method="POST" action="{{ route('profile.edit', $admin->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $admin->name) }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $admin->email) }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control">
                                <img src="{{ $admin->profile_image ? asset($admin->profile_image) : '' }}"
                                    class="mt-2 rounded-circle" width="80" alt="Profile Image" id="profileImagePreview"
                                    style="{{ $admin->profile_image ? '' : 'display:none;' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password <small>(leave blank to keep current)</small></label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Update Profile</button>
                            <a href="{{ route('admin.profile', $admin->id) }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
