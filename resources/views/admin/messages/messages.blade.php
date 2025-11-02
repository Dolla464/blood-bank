@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Clients Messages</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Clients Messages</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection

@section('content')
    <div class="container-fluid mt-2">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card card-dark">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><i class="fas fa-envelope text-danger"></i> Clients Messages</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Client Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="donationsTableBody">
                                @forelse($messages as $message)
                                    <tr class="text-center">
                                        <td>{{ $message->id }}</td>

                                        <td>{{ $message->subject }}</td>

                                        <td>{{ $message->client->name }}</td>

                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.messages.show', $message->id) }}"
                                                class="btn btn-sm btn-primary edit-btn action-btn" aria-label="Show Message"
                                                style="background-color:#27a3ae;border-color:#065860;" data-toggle="tooltip"
                                                title="Show">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn action-btn"
                                                    aria-label="Delete Message"
                                                    style="background-color:#c0392b;border-color:#6c1a11;"
                                                    data-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Messages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-center">
                        {{ $messages->links('pagination::bootstrap-4') }}
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
