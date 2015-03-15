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
        <table id="admin-comments-datatable" width="100%" class="table table-striped table-hover table-bordered"></table>
    </div>
</div>

@stop

@section('footer-js')
<script>

    var dataset = [
    @foreach($comments as $comment)
    [ "{{ $comment->content }}",
      "{{ $comment->status }}"
    ],
    @endforeach
    ];


    var columns = [
        { "title": "Content", "class": "text-center" },
        { "title": "Status", "class": "text-center" },
        { "title": "Created at", "class": "text-center" },
        { "title": "Reply", "class": "text-center" },
        { "title": "Action", "class": "text-center"}
    ];

</script>
@stop