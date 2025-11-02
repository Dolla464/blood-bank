@extends('admin.layouts.main')

@section('page_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create New Post</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/posts') }}">Posts</a></li>
                    <li class="breadcrumb-item active">New Posts</li>
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
                        <h3 class="card-title">New Post Details: </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                            @csrf

                            @include('admin.posts._form')

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
            // Show filename when user selects an image
            document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                let fileName = e.target.files[0]?.name;
                e.target.nextElementSibling.innerText = fileName;

                // Show preview
                if (e.target.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let preview = document.getElementById('photoPreview');
                        preview.src = e.target.result;
                        preview.style.display = "block";
                        preview.classList.add("mt-2");
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let fileInput = document.getElementById('customFile');
                let preview = document.getElementById('photoPreview');

                fileInput.addEventListener('change', function() {
                    let file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.src = "";
                        preview.style.display = 'none';
                    }
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
    @endpush
@endsection
