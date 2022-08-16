@extends('backend/core::backend')
@section('header')
    <title>List Car</title>
@endsection
@section('breadscrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('List Car') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Car') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <a href="{{ route('car.create') }}" class="btn btn-tool" title="Remove">Add New</a>
            </div>
        </div>
        <div class="card-body p-0">
            @if(!empty($cars) && count($cars) > 0)
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            <input type="checkbox" name="check-all" id="check-all">
                        </th>
                        <th style="width: 1%">
                            #ID
                        </th>
                        <th style="width: 20%">
                            Name
                        </th>
                        <th style="width: 20%">
                            Make
                        </th>
                        <th>
                            Model
                        </th>
                        <th>
                            Engine Size
                        </th>
                        <th>
                            Registration
                        </th>
                        <th>
                            Price
                        </th>
                        <th style="width: 8%" class="text-center">
                            Status
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $item)
                        <tr>
                            <td>
                                <input name="items[]" value="{{ $item->id }}" type="checkbox" id="items[]"/>
                            </td>
                            <td>
                                # {{ $item->id }}
                            </td>
                            <td>
                                <a href="{{ route('car.show', $item->id) }}">
                                    {{ $item->name }}
                                </a>
                                <br />
                                <small>
                                    {{ $item->created_at  }}
                                </small>
                            </td>
                            <td>
                                {{ $item->make }}
                            </td>
                            <td>
                                {{ $item->model }}
                            </td>
                            <td>
                                {{ $item->engine_size }}
                            </td>
                            <td>
                                {{ $item->registration }}
                            </td>
                            <td>
                                {{ $item->price }}
                            </td>
                            <td class="project-state">
                                @switch($item->status)
                                    @case('published')
                                        <span class="badge badge-success">Success</span>
                                        @break

                                    @case('pending')
                                        <span class="badge badge-warning">Pending</span>
                                        @break

                                    @default
                                        <span class="badge badge-error">Draft</span>
                                @endswitch
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('car.edit', $item->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm confirm-delete" href="#" data-id="{{ $item->id }}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                Item not found
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{-- <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul> --}}
            {{ $cars->links() }}
        </div>
    </div>
    <!-- /.card -->
</section>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do you want to delete car?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                <button type="button" class="btn btn-primary action_confirm" data-method="delete" onclick="if ($(this).hasClass('action_confirm')) { $(this).find('form').submit(); }">Yes
                    <form action="{{ route('car.destroy', 1) }}" method="post">
                        @method('DELETE')
                        {!! csrf_field() !!}
                    </form>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(function () {
            var baseUrl = '{{ route('car.index') }}/';
            $("#check-all").change(function () {
                $("input:checkbox").prop('checked', $(this).prop("checked"));
            });

            $('#myModal').on('show', function() {
                var id = $(this).data('id'),
                    removeBtn = $(this).find('.action_confirm');
                });

            $('.confirm-delete').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#myModal').data('id', id).modal('show');
                $('#myModal').find('form').attr('action', baseUrl + id);
            });

            $('.action_confirm').click(function() {
                // handle deletion here
                var id = $('#myModal').data('id');
            });
        });
    </script>
@endsection
