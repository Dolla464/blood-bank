@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Posts</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Posts</li>
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
                        <h4 class="mb-0"><i class="fas fa-newspaper text-danger"></i> Posts List</h4>
                        <a href="{{ route('posts.create') }}" id="addPostBtn" class="btn btn-success action-btn" aria-label="Add New Post"
                            style="background-color:#27ae60;border-color:#27ae60;" data-toggle="tooltip" title="Add New">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('posts.index') }}" class="mb-4">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="input-group m-auto">
                                        <label class="input-group-text fw-bold w-25" for="category_id">
                                            Filter By Category:
                                        </label>
                                        <select id="category_id" name="category_id" class="custom-select w-50"
                                            onchange="this.form.submit()">
                                            <option value=""></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if (request('category_id'))
                                            <a href="{{ route('posts.index') }}" class="btn btn-outline-danger m-auto">
                                                Reset
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Photo</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Content</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="postsTableBody">
                                    @forelse($posts as $post)
                                        <tr class="text-center">
                                            <td>{{ $post->id }}</td>

                                            <td>
                                                <img src="{{ asset('img/posts/' . $post->photo) }}" class="rounded shadow-sm"
                                                    width="70" height="50" alt="Photo" id="photoPreview"
                                                    style="{{ $post->photo ? '' : 'display:none;' }}">
                                            </td>

                                            <td>{{ $post->title }}</td>
                                            <td class="text-truncate" style="max-width:200px;">
                                                {{ $post->content }}
                                            </td>
                                            <td>{{ $post->category->name }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('posts.edit', $post->id) }}"
                                                    class="btn btn-sm btn-primary edit-btn action-btn"
                                                    aria-label="Edit Post"
                                                    style="background-color:#3498db;border-color:#3498db;"
                                                    data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger delete-btn action-btn"
                                                        aria-label="Delete Post"
                                                        style="background-color:#c0392b;border-color:#c0392b;"
                                                        data-toggle="tooltip" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No posts found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-center">
                            {{ $posts->links('pagination::bootstrap-4') }}
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
