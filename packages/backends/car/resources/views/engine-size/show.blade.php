@extends('backend/core::backend')
@section('header')
    <title>{{ __('Engine Size Detail') }}</title>
@endsection
@section('breadscrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Engine Size Detail') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('engine-size.index') }}">{{ __('Engine Size') }}</a></li>
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
                    <h3 class="card-title">Engine Size</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ $engineSize->id }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $engineSize->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ..." disabled>{{ $engineSize->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select id="inputStatus" class="form-control custom-select" disabled>
                            @switch($engineSize->status)
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
            <a href="{{ route('engine-size.index') }}" class="btn btn-secondary">Cancel</a>
            <a href="{{ route('engine-size.edit', $engineSize->id) }}" class="btn btn-success float-right">Edit</a>
        </div>
    </div>
    <!-- /.card -->
</section>

@section('script')
@endsection
@endsection