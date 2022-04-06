<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
        <title>@lang('Log in') | iDentSoft :: ambitiousit.net</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" />
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}" />
        <!-- Ambitious CSS -->
        <link href="{{ asset('assets/css/frontend.css') }}" rel="stylesheet">
        @if(session('locale') == 'ar')
            <link href="{{ asset('assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
        @else
            <link href="{{ asset('assets/plugins/alertifyjs/css/themes/bootstrap.min.css') }}" rel="stylesheet">
        @endif
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a class="h1"><span class="identColor"><b>iDentSoft</b></span>clinic</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg m-0 p-0">@lang('Sign in to start your session')</p>
                    <p class="text-center m-0">@lang('Or')</p>
                    <p class="text-center"><a href="{{ url('/') }}"><strong> << @lang('Go back')</strong></a></p>

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="@lang('Email')" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="@lang('Password')" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">
                                        @if(session('locale') == 'ar')
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        @endif
                                        @lang('Remember Me')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="social-auth-links text-center mt-2 mb-3">
                            <button type="submit" class="btn btn-block btn-primary"> <i class="fas fa-sign-in-alt mr-2"></i> @lang('Log in')</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        @if(session('locale') == 'ar')
            <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        @else
            <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        @endif
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
        <!-- Custom Js -->
        <script src="{{ asset('assets/js/custom/login.js') }}"></script>
    </body>
</html>
