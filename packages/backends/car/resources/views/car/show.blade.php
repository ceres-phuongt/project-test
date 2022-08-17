@extends('backend/core::backend')
@section('header')
    <title>{{ __('Car Detail') }}</title>
@endsection
@section('breadscrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Car Detail') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('car.index') }}">{{ __('Car') }}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
<section class="content">
    <!-- Default box -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Car</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ $car->id }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $car->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Model</label>
                        <input type="text" id="model" name="model" class="form-control" value="{{ $car->model }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Make</label>
                        <input type="text" id="make" name="make" class="form-control" value="{{ $car->make }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="engine_size">Engine size</label>
                        <input type="text" id="engine_size" name="engine_size" class="form-control" value="{{ $car->engine_size }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="registration">Registration</label>
                        <input type="text" id="registration" name="registration" class="form-control" value="{{ $car->registration }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" class="form-control" value="{{ $car->price }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select id="inputStatus" class="form-control custom-select" disabled>
                            @switch($car->status)
                                @case('published')
                                    <option value="published">Published</option>
                                    @break

                                @case('pending')
                                    <option value="pending">Pending</option>
                                    @break

                                @default
                                    <option value="draft">Draft</option>
                            @endswitch
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('car.index') }}" class="btn btn-secondary">Cancel</a>
            <a href="{{ route('car.edit', $car->id) }}" class="btn btn-success float-right">Edit</a>
        </div>
    </div>
    <!-- /.card -->
</section>

@section('script')
@endsection
@endsection