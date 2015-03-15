@extends('layouts.master')
@section('content')

<div class="panel panel-default">
  <div class="panel-body">

    @foreach($post->categories as $category)
       <a href="{{ url("/posts/category/{$category->name}") }}">{{ mb_strtoupper($category->name) }}</a>
    @endforeach

    <h2>{{ $post->title }}</h2>

    <p class="text-muted">
        {{ mb_strtoupper($post->updated_at->diffForHumans()) }} |
        <a href="{{ url("/users/{$post->user->username}") }}">{{ mb_strtoupper($post->user->full_name) }}</a>
    </p>

    <p>{{ $post->content }}</p>

    <ul class="list-inline">
        @foreach($post->tags as $tag)
            <li><a href="{{ url("/posts/tag/{$tag->name}") }}">#{{ $tag->name }}</a></li>
        @endforeach
    </ul>

    @if (Auth::check() && Auth::user()->isOwner($post))
        <a class="btn btn-xs btn-info" href="{{ $post->edit_url }}"><i class="fa fa-edit"></i> Edit</a>
        <button class="btn btn-xs btn-danger pull-right" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o"></i> Delete</button>
        {{ HTML::deleteModal('delete','posts','Post', $post->id) }}
    @endif
    <hr>

    <h3>Comments</h3>
    @foreach($comments as $comment)
        @if($comment->reply_id == 0)
            <div id="list_comments" class="media">
                <a href="{{ URL::to('users/'.$comment->user->username) }}" class="pull-left">
                    <img alt="" width="54" height="54" src="{{ image_url($comment->user->profile->avatar_filename) }}" class="media-object">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $comment->user->full_name }}
                    <small class="pull-right">
                        {{ $comment->created_at->diffForHumans() }} /
                        @if(Auth::check())
                            <a href="javascript:void(0)" class="reply_comment" data-reply="{{ $comment->id }}">
                                 Reply
                            </a>
                        @else
                            <a href="{{ URL::to('login') }}">
                                 Reply
                            </a>
                        @endif
                        
                    </small>
                    </h4>
                    <p>{{ $comment->content }}</p>
                    @if(Auth::check())
                        <!-- Reply -->
                        <div id="reply_{{ $comment->id }}" class="media" style="display: none;">
                            <a href="javascript:void(0)" class="pull-left">
                                <img alt="" width="54" height="54" src="{{ image_url(Auth::user()->profile->avatar_filename) }}" class="media-object">
                            </a>
                            <div class="media-body">
                            {{ Form::open(array('route' => 'comments.store', 'method' =>'post')) }}
                                {{ Form::hidden('user_id', $user_id) }}
                                {{ Form::hidden('post_id', $post->id) }}
                                {{ Form::hidden('reply_id', $comment->id) }}
                                <textarea name="content" class="form-control" rows="1" cols="100%" style="resize: vertical;"></textarea>
                                <button class="btn btn-primary btn-xs pull-right" style="margin-top: 5px;" data-reply="{{ $comment->id }}">Reply</button>
                            {{ Form::close() }}
                            </div>
                        </div>
                        <!-- End Reply -->
                    @endif
                    
                    @foreach($comment->children as $reply)
                        <hr>
                        <!-- Nested media object -->
                        <div class="media">
                            <a href="{{ URL::to('users/'.$reply->user->username) }}" class="pull-left">
                                <img alt="" width="54" height="54" src="{{ image_url($reply->user->profile->avatar_filename) }}" class="media-object">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $reply->user->full_name }}
                                <small class="pull-right">
                                    {{ $reply->created_at->diffForHumans() }} 
                                </small>
                                </h4>
                                <p>
                                    {{ $reply->content }}
                                </p>
                            </div>
                        </div>
                        <!--end media-->
                    @endforeach
                </div>
            </div>
            <br>
        @endif
        

    @endforeach
    <hr>
        


    <div class="post-comment">
        <h3>Leave a Comment</h3>
        {{ Form::open(array('route' => 'comments.store', 'method' =>'post')) }}
            {{ Form::hidden('post_id', $post->id) }}
            {{ Form::hidden('reply_id', 0) }}
            @if( Auth::check() )
                {{ Form::hidden('user_id', $user_id) }}
                <div class="form-group">
                    <label class="control-label">Message
                    <span class="required">
                         *
                    </span>
                    </label>
                    <textarea class="col-md-10 form-control" name="content" rows="8"></textarea>
                </div>
            @else
                <div class="form-group">
                    <label class="control-label">Name
                    <span class="required">
                         *
                    </span>
                    </label>
                    <input class="form-control" name="name" type="text">
                </div>
                <div class="form-group">
                    <label class="control-label">Email
                    <span class="required">
                         *
                    </span>
                    </label>
                    <input class="form-control" name="email" type="email">
                </div>
                <div class="form-group">
                    <label class="control-label">Message
                    <span class="required">
                         *
                    </span>
                    </label>
                    <textarea class="col-md-10 form-control" name="content" rows="8"></textarea>
                </div>
            @endif
            <button class="btn btn-primary" type="submit" style="margin-top:20px;">Post a Comment</button>
        {{ Form::close() }}
    </div>

  </div>
</div>

@stop

@section('footer-js')
    {{ HTML::script('js/core/posts/show.js') }}
@stop