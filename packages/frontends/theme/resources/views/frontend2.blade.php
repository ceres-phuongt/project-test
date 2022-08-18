<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @yield('header')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('vendor/frontends/theme/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('vendor/frontends/theme/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('vendor/frontends/theme/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/frontends/theme/lib/toastr/toastr.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        var siteUrl = '{{ url('/') }}';
    </script>
</head>

<body>
@include('frontend/theme::header')

@yield('breadscrumb')
@yield('content')


<!-- Footer Start -->
@include('frontend/theme::footer')
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('vendor/frontends/theme/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('vendor/frontends/theme/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Contact Javascript File -->
<script src="{{ asset('vendor/frontends/theme/mail/jqBootstrapValidation.min.js') }}"></script>
<script src="{{ asset('vendor/frontends/theme/mail/contact.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('vendor/frontends/theme/lib/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('vendor/frontends/theme/js/main.js') }}"></script>
<script src="{{ asset('vendor/frontends/theme/js/cart.js') }}"></script>
@yield('footer')
</body>

</html>
