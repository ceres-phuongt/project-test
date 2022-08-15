@extends('backend.core.auth')

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>

        <form action="{{!! route('backend.user.auth.login') !!}" method="post">
            {!! csrf_field() !!}
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="{{ __('Email') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="{{ __('Password') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
</div>
@endsection