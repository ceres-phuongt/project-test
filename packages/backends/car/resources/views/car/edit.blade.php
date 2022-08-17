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
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $car->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Model</label>
                        <input type="text" id="model" name="model" class="form-control" value="{{ old('model', $car->model) }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Make</label>
                        <textarea id="make" name="make" class="form-control">{{ old('make', $car->make) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" class="form-control" value="{{ old('price', $car->price) }}">
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
                        <select id="status" class="form-control custom-select" name="status">
                            <option value="published" @if(old('status', $car->status) == 'published') selected @endif>Published</option>
                            <option value="pending" @if(old('status', $car->status) == 'pending') selected @endif>Pending</option>
                            <option value="draft" @if(old('status', $car->status) == 'draft') selected @endif>Draft</option>
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
            <input type="submit" value="Update Car" class="btn btn-success float-right">
        </div>
    </div>
    </form>
    <!-- /.card -->
</section>

@section('script')
@endsection
@endsection