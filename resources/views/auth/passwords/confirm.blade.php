<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bloodbank | Confirm Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>BLOOD</b>bank</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-header">{{ __('Confirm Password') }}</div>

            <div class="card-body login-card-body">
                <p class="login-box-msg">{{ __('Please confirm your password before continuing.') }}</p>

                <form action="{{ route('password.confirm') }}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required
                            autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary btn-block">{{ __('Confirm Password') }}</button>

                            @if (Route::has('website.password.request'))
                                <a class="btn btn-link" href="{{ route('website.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte') }}/js/adminlte.min.js"></script>
</body>

</html>
