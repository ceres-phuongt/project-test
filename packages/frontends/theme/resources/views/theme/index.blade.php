@extends('frontend/theme::frontend2')
@section('header')
    <title>A new ecommerce website</title>
@endsection

@section('breadscrumb')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            @yield('breadscrums')
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
@endsection

@section('content')
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="dropdown ml-4">
                            </div>
                        </div>
                    </div>
                    @if(!empty($listCar) && count($listCar))
                        @foreach($listCar as $car)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1 product-detail">
                            <div class="card product-item border-0 mb-4" data-id="{{ $car->id }}">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <a href="{{ route('frontend.product-detail', $car->id) }}">
                                        <img class="img-fluid w-100" src="{{ asset('vendor/frontends/theme/img/car-pic.jpg') }}" alt="">
                                    </a>
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <a href="{{ route('frontend.product-detail', $car->id) }}">
                                        <h6 class="text-truncate mb-3">{{ $car->name }}</h6>
                                    </a>
                                    <div class="d-flex justify-content-center">
                                        <h6>${{ $car->price }}</h6><h6 class="text-muted ml-2"><del>${{ $car->price }}</del></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="#" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    <a href="" class="btn btn-sm text-dark p-0 add-to-cart"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                    <input type="hidden" class="car-id" name="carId" value="{{ $car->id }}">
                                    <input type="hidden" class="quantity-input" name="quantity" value="1">
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-12 pb-1">
                            {{ $listCar->links('frontend/theme::pagination.default') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
