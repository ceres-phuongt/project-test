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
        <div class="col-md-9">
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
                        <label for="registration">Registration</label>
                        <textarea type="text" id="registration" name="registration" class="form-control"  disabled>{{ $car->registration }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" class="form-control" value="{{ $car->price }}" disabled>
                    </div>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-3">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Status</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
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
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Make</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <select id="make_id" class="form-control custom-select" name="make_id">
                        <option selected="" disabled="">Select one</option>
                    </select>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Engine Size</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select id="engine_size_id" class="form-control custom-select" name="engine_size_id">
                            <option selected="" disabled="">Select one</option>
                        </select>
                    </div>
                </div>
            </div>
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