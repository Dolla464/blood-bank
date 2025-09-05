@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Governorates</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Governorates</li>
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
                        <h4 class="mb-0"><i class="fas fa-map-marked-alt text-danger"></i> Governorates List</h4>
                        <button id="addGovernorateBtn" class="btn btn-success action-btn" aria-label="Add New Governorate"
                            style="background-color:#27ae60;border-color:#27ae60;" data-toggle="tooltip" title="Add New">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="governoratesTableBody">
                                @forelse($governorates as $governorate)
                                    <tr class="text-center">
                                        <td>{{ $governorate->id }}</td>
                                        @if (request('edit') == $governorate->id && !request('add'))
                                            <td colspan="2">
                                                <form
                                                    action="{{ route('governorates.update', $governorate->id) }}?page={{ request()->query('page', 1) }}"
                                                    method="POST" style="display:inline-flex; align-items:center;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="name" value="{{ $governorate->name }}"
                                                        class="form-control mr-2" required>
                                                    <button type="button"
                                                        class="btn btn-sm btn-success save-btn action-btn"
                                                        aria-label="Save Governorate" data-toggle="tooltip" title="Save">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <a href="{{ route('governorates.index', array_merge(request()->query(), ['edit' => null])) }}"
                                                        class="btn btn-sm btn-secondary ml-2 action-btn"
                                                        aria-label="Cancel Edit"
                                                        style="background-color:#6c757d;border-color:#6c757d;"
                                                        data-toggle="tooltip" title="Cancel">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        @else
                                            <td>{{ $governorate->name }}</td>
                                            <td>
                                                @php
                                                    $query = request()->query();
                                                    unset($query['add']); // شيل add=new من الرابط
                                                @endphp

                                                <a href="{{ route('governorates.index', array_merge(['edit' => $governorate->id], $query)) }}"
                                                    class="btn btn-sm btn-primary edit-btn action-btn"
                                                    aria-label="Edit Governorate"
                                                    style="background-color:#3498db;border-color:#3498db;"
                                                    data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('governorates.destroy', $governorate->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger delete-btn action-btn"
                                                        aria-label="Delete Governorate"
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
                                        <td colspan="3">No governorates found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-center">
                            {{ $governorates->links('pagination::bootstrap-4') }}
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
                // SweetAlert for Delete
                document.querySelectorAll('.delete-btn').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'You will not be able to recover this governorate!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#c0392b',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                btn.closest('form').submit();
                            }
                        });
                    });
                });
                // SweetAlert for Save (Edit)
                document.querySelectorAll('.save-btn').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Confirm Edit',
                            text: 'Are you sure you want to save changes to this governorate?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#e74c3c',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, save it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                btn.closest('form').submit();
                            }
                        });
                    });
                });
            });
        </script>
        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });

            // Add new governorate row
            document.getElementById('addGovernorateBtn').addEventListener('click', function() {
                // Redirect to last page with ?add=new
                const url = new URL(window.location.href);
                url.searchParams.delete('edit'),
                url.searchParams.set('page', {{ $governorates->lastPage() }});
                url.searchParams.set('add', 'new');
                window.location.href = url.toString();
            });

            // Show new row for adding only if ?add=new is present and on last page
            @if (request('add') == 'new' && !request('edit') && session('success') == null && $governorates->currentPage() == $governorates->lastPage())
                document.addEventListener('DOMContentLoaded', function() {
                    if (document.getElementById('newGovernorateRow')) return;
                    let tbody = document.getElementById('governoratesTableBody');
                    let row = document.createElement('tr');
                    row.id = 'newGovernorateRow';
                    row.className = 'text-center bg-warning';
                    row.innerHTML = `<td>--</td>
    <td colspan="2">
        <form id="createGovernorateForm" action="{{ route('governorates.store') }}" method="POST" style="display:inline-flex; align-items:center;">
            @csrf
            <input type='text' name='name' class='form-control mr-2' required placeholder='Governorate Name'>
            <button type='button' class='btn btn-sm btn-success create-btn action-btn' style='background-color:#27ae60;border-color:#27ae60;' data-toggle='tooltip' title='Create'>
                <i class='fas fa-check'></i>
            </button>
            <button type='button' class='btn btn-sm btn-secondary ml-2 cancel-create-btn action-btn' style='background-color:#6c757d;border-color:#6c757d;' data-toggle='tooltip' title='Cancel'>
                <i class='fas fa-times'></i>
            </button>
        </form>
    </td>`;
                    tbody.appendChild(row);
                    $('[data-toggle="tooltip"]').tooltip();
                    // Focus the input field
                    row.querySelector("input[name='name']").focus();
                    // Cancel button
                    document.querySelector('.cancel-create-btn').onclick = function() {
                        row.remove();
                        // Remove ?add=new from URL
                        const url = new URL(window.location.href);
                        url.searchParams.delete('add');
                        window.history.replaceState({}, '', url.toString());
                    };
                    // Create button with SweetAlert
                    document.querySelector('.create-btn').onclick = function(e) {
                        e.preventDefault();
                        var input = document.getElementById('createGovernorateForm').querySelector(
                            "input[name='name']");
                        if (!input.value.trim()) {
                            input.classList.add('is-invalid');
                            input.focus();
                            Swal.fire({
                                icon: 'warning',
                                title: 'Input Required',
                                text: 'Please enter a governorate name before saving.'
                            });
                            return;
                        } else {
                            input.classList.remove('is-invalid');
                        }
                        Swal.fire({
                            title: 'Create Governorate',
                            text: 'Are you sure you want to create this governorate?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#27ae60',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, create it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('createGovernorateForm').submit();
                            }
                        });
                    };
                });
            @endif
        </script>
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: @json(session('success')),
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif
        <script src="{{ asset('adminlte/governorates.js') }}"></script>
    @endpush

    <link rel="stylesheet" href="{{ asset('adminlte/governorates-custom.css') }}">
@endsection
