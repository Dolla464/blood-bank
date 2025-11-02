@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Categories</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
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
                        <h4 class="mb-0"><i class="fas fa-tags text-danger"></i> Categories List</h4>
                        <button id="addCategoryBtn" class="btn btn-success action-btn" aria-label="Add New Category"
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
                            <tbody id="categoriesTableBody">
                                @forelse($categories as $category)
                                    <tr class="text-center">
                                        <td>{{ $category->id }}</td>
                                        @if (request('edit') == $category->id && !request('add'))
                                            <td colspan="2">
                                                <form
                                                    action="{{ route('admin.categories.update', $category->id) }}?page={{ request()->query('page', 1) }}"
                                                    method="POST" style="display:inline-flex; align-items:center;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="name" value="{{ $category->name }}"
                                                        class="form-control mr-2" required>
                                                    <button type="button"
                                                        class="btn btn-sm btn-success save-btn action-btn"
                                                        aria-label="Save Category" data-toggle="tooltip" title="Save">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <a href="{{ route('admin.categories.index', array_merge(request()->query(), ['edit' => null])) }}"
                                                        class="btn btn-sm btn-secondary ml-2 action-btn"
                                                        aria-label="Cancel Edit"
                                                        style="background-color:#6c757d;border-color:#6c757d;"
                                                        data-toggle="tooltip" title="Cancel">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        @else
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @php
                                                    $query = request()->query();
                                                    unset($query['add']); // شيل add=new من الرابط
                                                @endphp
                                                <a href="{{ route('admin.categories.index', array_merge(['edit' => $category->id], $query)) }}"
                                                    class="btn btn-sm btn-primary edit-btn action-btn"
                                                    aria-label="Edit Category"
                                                    style="background-color:#3498db;border-color:#3498db;"
                                                    data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger delete-btn action-btn"
                                                        aria-label="Delete Category"
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
                                        <td colspan="3">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-center">
                            {{ $categories->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('adminlte/governorates-custom.css') }}">
@endsection

@push('styles')
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@push('scripts')
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Add Category Button Click
            document.getElementById('addCategoryBtn').addEventListener('click', function() {
                const url = new URL(window.location.href);
                url.searchParams.delete('edit'),
                url.searchParams.set('page', {{ $categories->lastPage() }});
                url.searchParams.set('add', 'new');
                window.location.href = url.toString();
            });

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

            // Save Button Click (for editing existing categories)
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

            // If 'add=new' in URL and no validation errors, append new category row
            @if (request('add') == 'new' && !request('edit') &&  session('success') == null && $categories->currentPage() == $categories->lastPage())
                if (document.getElementById('newCategoryRow')) return;
                let tbody = document.getElementById('categoriesTableBody');
                let newRow = document.createElement('tr');
                newRow.id = 'newCategoryRow';
                newRow.className = 'text-center bg-warning';
                newRow.innerHTML = `<td>--</td>
                    <td colspan="2">
                        <form id="createCategoryForm" action="{{ route('admin.categories.store') }}" method="POST" style="display:inline-flex; align-items:center;">
                            @csrf
                            <input type="text" name="name" class="form-control mr-2" placeholder="Category Name" required>
                            <button type="button" class="btn btn-sm btn-success create-btn action-btn" aria-label="Save Category" data-toggle="tooltip" title="Create">
                                <i class="fas fa-check"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary ml-2 action-btn" aria-label="Cancel Add" style="background-color:#6c757d;border-color:#6c757d;" data-toggle="tooltip" title="Cancel" id="cancelAddBtn">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </td>`;
                tbody.append(newRow);

                // Initialize tooltips for the new row
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
                    var input = document.getElementById('createCategoryForm').querySelector(
                        "input[name='name']");
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
                        // Show confirmation before submitting
                        Swal.fire({
                            title: 'Create Category?',
                            text: "Do you want to create this category?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, create it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Actually submit the form
                                document.getElementById('createCategoryForm').submit();
                            }
                        });
                    }
                });
            @endif
        });

        // Success message display (only once)
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    </script>
    <script src="{{ asset('adminlte/governorates.js') }}"></script>
@endpush
