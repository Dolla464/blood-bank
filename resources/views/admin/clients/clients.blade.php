@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Clients</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Clients</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection

@section('content')
    <div class="container-fluid mt-2">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card card-info">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><i class="fas fa-tint text-danger"></i> Clients List</h4>
                    </div>

                    <div class="row justify-content-center m-3">
                        <div class="col-md-12">
                            <div class="card card-secondary card-outline shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-filter mr-2"></i> Filter Clients By:
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="{{ route('clients.index') }}">
                                        <div class="form-row">

                                            {{-- Blood Type --}}
                                            <div class="form-group col-md-4">
                                                <label for="blood_type_id">
                                                    <i class="fas fa-tint text-danger mr-1"></i> Blood Type
                                                </label>
                                                <select id="blood_type_id" name="blood_type_id" class="form-control"
                                                    onchange="this.form.submit()">
                                                    <option value="">All</option>
                                                    @foreach ($bloodTypes as $bloodType)
                                                        <option value="{{ $bloodType->id }}"
                                                            {{ request('blood_type_id') == $bloodType->id ? 'selected' : '' }}>
                                                            {{ $bloodType->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Governorate --}}
                                            <div class="form-group col-md-4">
                                                <label for="governorate_id">
                                                    <i class="fas fa-map-marker-alt text-primary mr-1"></i> Governorate
                                                </label>
                                                <select id="governorate_id" name="governorate_id" class="form-control"
                                                    onchange="this.form.submit()">
                                                    <option value="">All</option>
                                                    @foreach ($governorates as $governorate)
                                                        <option value="{{ $governorate->id }}"
                                                            {{ request('governorate_id') == $governorate->id ? 'selected' : '' }}>
                                                            {{ $governorate->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- City --}}
                                            @if (request('governorate_id'))
                                                <div class="form-group col-md-4">
                                                    <label for="city_id">
                                                        <i class="fas fa-city text-success mr-1"></i> City
                                                    </label>
                                                    <select id="city_id" name="city_id" class="form-control"
                                                        onchange="this.form.submit()">
                                                        <option value="">All</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}"
                                                                {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                                                {{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="can_donate"
                                                    name="can_donate" value="1" onchange="this.form.submit()"
                                                    {{ request('can_donate') ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold" for="can_donate">
                                                    Show only clients who can donate (after 3 months)
                                                </label>
                                            </div>

                                        </div>

                                        {{-- Reset Button --}}
                                        @if (request()->hasAny(['blood_type_id', 'governorate_id', 'city_id']))
                                            <div class="text-right">
                                                <a href="{{ route('clients.index') }}" class="btn btn-outline-danger">
                                                    <i class="fas fa-undo mr-1"></i> Reset Filters
                                                </a>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Client Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Donation Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="donationsTableBody">
                                @forelse($clients as $client)
                                    <tr class="text-center">
                                        <td>{{ $client->id }}</td>

                                        <td>{{ $client->name }}</td>

                                        <td>{{ $client->email }}</td>

                                        <td>
                                            @if ($client->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @elseif($client->status == 'inactive')
                                                <span class="badge badge-warning">Deactive</span>
                                            @elseif($client->status == 'banned')
                                                <span class="badge badge-danger">Banned</span>
                                            @else
                                                <span class="badge badge-secondary">Unknown</span>
                                            @endif
                                        </td>

                                        <td>{!! $client->can_donate_badge !!}</td>

                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('clients.show', $client->id) }}"
                                                class="btn btn-sm btn-primary edit-btn action-btn" aria-label="Show Client"
                                                style="background-color:#27a3ae;border-color:#065860;" data-toggle="tooltip"
                                                title="Show">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
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
                                @empty
                                    <tr>
                                        <td colspan="6">No Clients found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-center">
                        {{ $clients->links('pagination::bootstrap-4') }}
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
