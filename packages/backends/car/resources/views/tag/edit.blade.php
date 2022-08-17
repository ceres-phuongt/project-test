@extends('backend/core::backend')
@section('header')
    <title>{{ __('Edit Tag') }}</title>
@endsection
@section('breadscrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Edit Tag') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('tag.index') }}">{{ __('Tag') }}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
<section class="content">
    <!-- Default box -->
    <form action="{{ route('tag.update', $tag->id) }}" method="post">
    @method('PUT')
    {!! csrf_field() !!}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tag</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ $tag->id }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $tag->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ...">{{ old('description', $tag->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select id="status" class="form-control custom-select" name="status">
                            <option value="published" @if(old('status', $tag->status) == 'published') selected @endif>Published</option>
                            <option value="pending" @if(old('status', $tag->status) == 'pending') selected @endif>Pending</option>
                            <option value="draft" @if(old('status', $tag->status) == 'draft') selected @endif>Draft</option>
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
            <a href="{{ route('tag.index') }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Update Tag" class="btn btn-success float-right">
        </div>
    </div>
    </form>
    <!-- /.card -->
</section>

@section('script')
@endsection
@endsection