@extends('layouts.master')
@section('header-js')
    {{ HTML::style('//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.css') }}
    {{ HTML::script('//cdn.datatables.net/1.10.0/js/jquery.dataTables.min.js') }}
    {{ HTML::script('//cdn.datatables.net/tabletools/2.2.1/js/dataTables.tableTools.min.js') }}
    {{ HTML::script('//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.js') }}
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <p class="panel-title">Comments</p>
    </div>
    <div class="panel-body">
        {{-- <table id="admin-comments-datatable" width="100%" class="table table-striped table-hover table-bordered"></table> --}}



         <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Content</th>
                    <th>Created at</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                <tr>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->created_at }}</td>
                    <td>
                        @if($comment->status == 0)
                            <span class="label label-warning">pending</span>
                        @else
                            <span class="label label-success">confirmed</span>
                        @endif
                    </td>
                    <td class="col-md-2">
                        <a class="btn btn-xs btn-success" data-toggle="modal" data-target="#update{{ $comment->id }}"><i class="fa fa-check"></i> Confirm</a>
                        {{ HTML::updateModal('update' . $comment->id,'admin.comments','comment', $comment->id) }}
                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete{{ $comment->id }}"><i class="fa fa-trash-o"></i> Delete</button>
                        {{ HTML::deleteModal('delete' . $comment->id,'admin.comments','comment', $comment->id) }}
                    </td>
                </tr>
                @empty
                    <p class="text-muted">No comments</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop

@section('footer-js')
<script>
    
</script>
@stop