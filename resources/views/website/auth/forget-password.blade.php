@extends('website.layouts.app')

@section('content')
    <!--form-->
    <div class="signin-account">
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">إستعادة كلمة المرور</li>
                        </ol>
                    </nav>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}
                    </div>
                @endif

                <div class="signin-form">
                    <form method="POST" action="{{ route('website.password.send') }}">
                        @csrf
                        <div class="logo">
                            <img src="{{ asset('website/assets/imgs/logo.png') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الجوال"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row buttons">
                            <div class="col-md-6 right">
                                <button type="submit" class="btn btn-success w-100 m-2">إرسال كود التحقق</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
