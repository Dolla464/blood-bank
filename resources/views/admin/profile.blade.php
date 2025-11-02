@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Profile</div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ asset($admin->profile_image ?? 'images/default-profile.png') }}"
                                class="rounded-circle" width="120" alt="Profile Image">
                        </div>
                        <table class="table">
                            <tr>
                                <th>Name:</th>
                                <td>{{ $admin->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $admin->email }}</td>
                            </tr>
                            <tr>
                                <th>Role:</th>
                                <td>{{ $admin->role ?? 'Admin' }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('admin.profile.edit', $admin->id) }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
