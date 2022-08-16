@extends('backend/core::backend')
@section('header')
    <title>{{ __('Edit Car') }}</title>
@endsection
@section('breadscrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Edit car') }}</h1>
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
    <form action="{{ route('car.update', $car->id) }}" method="post">
    @method('PUT')
    {!! csrf_field() !!}
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
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $car->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Model</label>
                        <input type="text" id="model" name="model" class="form-control" value="{{ old('model', $car->model) }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Make</label>
                        <input type="text" id="make" name="make" class="form-control" value="{{ old('make', $car->make) }}">
                    </div>
                    <div class="form-group">
                        <label for="engine_size">Engine size</label>
                        <input type="text" id="engine_size" name="engine_size" class="form-control" value="{{ $car->engine_size }}">
                    </div>
                    <div class="form-group">
                        <label for="registration">Registration</label>
                        <input type="text" id="registration" name="registration" class="form-control" value="{{ old('engine_size', $car->engine_size) }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" class="form-control" value="{{ old('price', $car->price) }}">
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select id="status" class="form-control custom-select" name="status">
                            <option value="published" @if(old('status', $car->status) == 'published') selected @endif>Published</option>
                            <option value="pending" @if(old('status', $car->status) == 'pending') selected @endif>Pending</option>
                            <option value="draft" @if(old('status', $car->status) == 'draft') selected @endif>Draft</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

                @if(!empty($errors) && count($errors) > 0)
                <div class="card-body">
                    <div class="alert alert-danger">
                        <strong>Whoops</strong> Something went wrong !
                        <br><br>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('car.index') }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Update Car" class="btn btn-success float-right">
        </div>
    </div>
    </form>
    <!-- /.card -->
</section>

@section('script')
@endsection
@endsection