@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cities</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Cities</li>
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
                        <h4 class="mb-0"><i class="fas fa-city text-danger"></i> Cities List</h4>
                        <button id="addCityBtn" class="btn btn-success action-btn" aria-label="Add New City"
                            style="background-color:#27ae60;border-color:#27ae60;" data-toggle="tooltip" title="Add New">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('cities.index') }}" class="mb-4">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="input-group m-auto">
                                        <label class="input-group-text fw-bold w-25" for="governorate_id">
                                            Filter By Governorate:
                                        </label>
                                        <select id="governorate_id" name="governorate_id" class="custom-select w-50"
                                            onchange="this.form.submit()">
                                            <option value=""></option>
                                            @foreach ($governorates as $gov)
                                                <option value="{{ $gov->id }}"
                                                    {{ request('governorate_id') == $gov->id ? 'selected' : '' }}>
                                                    {{ $gov->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if (request('governorate_id'))
                                            <a href="{{ route('cities.index') }}" class="btn btn-outline-danger m-auto">
                                                Reset
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered table-striped text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">City Name</th>
                                    <th class="text-center">Governorate Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="citiesTableBody">
                                @forelse($cities as $city)
                                    <tr class="text-center">
                                        <td>{{ $city->id }}</td>
                                        @if (request('edit') == $city->id && !request('add'))
                                            <td colspan="3">
                                                <form
                                                    action="{{ route('cities.update', $city->id) }}?page={{ request()->query('page', 1) }}"
                                                    method="POST" style="display:inline-flex; align-items:center;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="name" value="{{ $city->name }}"
                                                        class="form-control mr-2" required>
                                                    <select name="governorate_id" class="form-control is-valid mr-2"
                                                        required>
                                                        @foreach ($governorates as $gov)
                                                            <option value="{{ $gov->id }}"
                                                                {{ $gov->id == $city->governorate_id ? 'selected' : '' }}>
                                                                {{ $gov->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button"
                                                        class="btn btn-sm btn-success save-btn action-btn"
                                                        aria-label="Save City" data-toggle="tooltip" title="Save">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <a href="{{ route('cities.index', array_merge(request()->query(), ['edit' => null])) }}"
                                                        class="btn btn-sm btn-secondary ml-2 action-btn"
                                                        aria-label="Cancel Edit"
                                                        style="background-color:#6c757d;border-color:#6c757d;"
                                                        data-toggle="tooltip" title="Cancel">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        @else
                                            <td>{{ $city->name }}</td>
                                            <td>{{ $city->governorate->name }}</td>
                                            <td>
                                                @php
                                                    $query = request()->query();
                                                    unset($query['add']); //  شيل add من اللينك
                                                @endphp

                                                <a href="{{ route('cities.index', array_merge(['edit' => $city->id], $query)) }}"
                                                    class="btn btn-sm btn-primary edit-btn action-btn"
                                                    aria-label="Edit City"
                                                    style="background-color:#3498db;border-color:#3498db;"
                                                    data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('cities.destroy', $city->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger delete-btn action-btn"
                                                        aria-label="Delete City"
                                                        style="background-color:#c0392b;border-color:#c0392b;"
                                                        data-toggle="tooltip" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No cities found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-center">
                            {{ $cities->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                // Save Button Click
                document.querySelectorAll('.save-btn').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Do you want to save the changes?",
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
        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            });
            // Add City Button Click
            document.getElementById('addCityBtn').addEventListener('click', function() {
                const url = new URL(window.location.href);
                url.searchParams.delete('edit'); // يمنع تشغيل edit مع add
                url.searchParams.set('page', {{ $cities->lastPage() }});
                url.searchParams.set('add', 'new');
                window.location.href = url.toString();
            });
            // If 'add=new' in URL and no validation errors, append new city row
            @if (request('add') == 'new' &&
                    !request('edit') &&
                    session('success') == null &&
                    $cities->currentPage() == $cities->lastPage())
                document.addEventListener('DOMContentLoaded', function() {
                    if (document.getElementById('newCityRow')) return;
                    let tbody = document.getElementById('citiesTableBody');
                    let newRow = document.createElement('tr');
                    newRow.id = 'newCityRow';
                    newRow.className = 'text-center bg-warning';
                    newRow.innerHTML = `<td>--</td>
                        <td colspan="3">
                            <form id="createCityForm" action="{{ route('cities.store') }}" method="POST" style="display:inline-flex; align-items:center;">
                                @csrf
                                <input type="text" name="name" class="form-control mr-2" placeholder="City Name" required>
                                <select name="governorate_id" class="form-control mr-2" required>
                                    <option value="" disabled selected>Select Governorate</option>
                                    @foreach ($governorates as $gov)
                                        <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-sm btn-success create-btn action-btn" aria-label="Save City" data-toggle="tooltip" title="Create">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-secondary ml-2 action-btn" aria-label="Cancel Add" style="background-color:#6c757d;border-color:#6c757d;" data-toggle="tooltip" title="Cancel" id="cancelAddBtn">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </td>`;
                    tbody.append(newRow);
                    $('[data-toggle="tooltip"]').tooltip();
                    newRow.querySelector("input[name='name']").focus();
                    // Cancel Add Button Click
                    document.getElementById('cancelAddBtn').addEventListener('click', function() {
                        newRow.remove();
                        const url = new URL(window.location.href);
                        url.searchParams.delete('add');
                        window.history.replaceState({}, '', url.toString());
                    });
                    // Create Button with SweetAlert2
                    document.querySelector('.create-btn').addEventListener('click', function(e) {
                        e.preventDefault();
                        var input = document.getElementById('createCityForm').querySelector(
                            "input[name='name']", "select[name='governorate_id']");
                        if (!input.value.trim()) {
                            input.classList.add('is-invalid');
                            input.focus();
                            Swal.fire({
                                icon: 'warning',
                                title: 'Input Required',
                                text: 'Please fill out all required fields.'
                            });
                            return;
                        } else {
                            input.classList.remove('is-invalid');
                        }
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Do you want to add this city?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, create it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('createCityForm').submit();
                            }
                        });
                    });
                });
            @endif
        </script>
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif
        <script src="{{ asset('adminlte/governorates.js') }}"></script>
    @endpush

@endsection
