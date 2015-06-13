@extends('layouts.master')
@section('content')
<h1>#{{ $key_search }}</h1>
<hr>

    @forelse($posts as $post)
        @include('posts/partials/post')
    @empty
        <p class="text-muted">No result with #{{ $key_search }}</p>
    @endforelse

{{ $posts->links() }}

@stop