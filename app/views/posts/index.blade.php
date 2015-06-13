@extends('layouts.master')
@section('content')
<!-- <h1>Blog</h1> -->

<hr>

    @forelse($posts as $post)
        @include('posts/partials/post')
    @empty
        <p class="text-muted">Get started by creating a new Post</p>
    @endforelse

{{ $posts->links() }}

@stop