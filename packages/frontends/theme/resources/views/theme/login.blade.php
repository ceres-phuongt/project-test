@extends('frontend/theme::frontend2')
@section('header')
    <title>A new ecommerce website</title>
@endsection

@section('breadscrumb')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            @yield('breadscrums')
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Login</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Login</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
@endsection

@section('content')
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="loginForm" id="loginForm" novalidate="novalidate" action="{{ route('frontend.login') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                                required="required" data-validation-required-message="Please enter your password" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">
                                Login
                            </button>
                        </div>
                    </form>
                    @if (count($errors) >0)
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="text-danger"> {{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if (session('status'))
                        <ul>
                            <li class="text-danger"> {{ session('status') }}</li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
