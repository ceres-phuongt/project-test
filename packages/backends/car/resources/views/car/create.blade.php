@extends('backend/core::backend')
@section('header')
    <title>{{ __('Create Car') }}</title>
@endsection
@section('breadscrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Create Car') }}</h1>
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
    <form action="{{ route('car.store') }}" method="post">
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
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Model</label>
                        <input type="text" id="model" name="model" class="form-control" value="{{ old('model') }}">
                    </div>
                    <div class="form-group">
                        <label for="registration">Registration</label>
                        <textarea id="registration" name="registration" class="form-control">{{ old('registration') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" class="form-control" value="{{ old('price') }}">
                    </div>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

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
                    <select id="status" class="form-control custom-select" name="status">
                        <option disabled>Select one</option>
                        <option value="published" @if(old('status') == 'published') selected @endif>Published</option>
                        <option value="pending" @if(old('status') == 'pending') selected @endif>Pending</option>
                        <option value="draft" @if(old('status') == 'draft') selected @endif>Draft</option>
                    </select>
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
                        @if(!empty($makes) && count($makes) > 0)
                            @foreach($makes as $make)
                                <option value="{{ $make->id }}" @if(old('make_id') == $make->id) selected @endif>{{ $make->name }}</option>
                            @endforeach
                        @endif
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
                            @if(!empty($engineSizes) && count($engineSizes) > 0)
                                @foreach($engineSizes as $engineSize)
                                    <option value="{{ $engineSize->id }}" @if(old('engine_size_id') == $engineSize->id) selected @endif>{{ $engineSize->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('car.index') }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Car" class="btn btn-success float-right">
        </div>
    </div>
    </form>
    <!-- /.card -->
</section>

@section('footer')
    <script src="{{ asset('vendor/backends/core/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#price').inputmask();
        });
    </script>
@endsection
@endsection