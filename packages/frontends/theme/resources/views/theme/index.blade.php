@extends('frontend/theme::frontend2')
@section('header')
    <title>A new ecommerce website</title>
@endsection
@section('content')
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
            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4" data-id="{{ $car->id }}">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{ asset('vendor/frontends/theme/img/car-pic.jpg') }}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $car->name }}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>${{ $car->price }}</h6><h6 class="text-muted ml-2"><del>${{ $car->price }}</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="#" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0" data-car_id="{{ $car->id }}"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
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
@endsection
@section('footer')
@endsection
