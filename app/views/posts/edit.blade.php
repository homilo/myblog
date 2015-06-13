@extends('layouts.master')

@section('header-js')
    {{ HTML::style('plugins/froala_editor_1.2.7/css/froala_editor.min.css') }}
    {{ HTML::style('plugins/froala_editor_1.2.7/css/froala_style.min.css') }}
@stop

@section('content')

    {{ Form::model($post, ['route'=> ['posts.update', $post->id], 'method' => 'PUT']) }}

    {{ Form::textField('title', 'Title', null) }}

    {{ Form::textareaField('content', 'Content', null) }}

    {{ Form::selectField('category', $categories, $selected_category, 'Category') }}

    {{ Form::selectTag('tags', 'post-tags', 'Tags') }}

    {{ Form::selectField('status', ['published' =>'Published','draft' =>'Draft'], 'published', 'Status') }}

    {{ cancel_button() }}

    {{ Form::submitField('Submit') }}

    {{ Form::close() }}

    {{-- 
    ----    Update 02/05/2015 Loi 
    ----    Upload image
    --}}
    <img class="img-thumbnail" src="{{ post_image_url($post->image) }}" width="230" height="175" style="width:230px; height:175px; "> 

    {{ Form::open(['action'=> ['PostsController@uploadPostImage', $post->id], 'files' => true]) }}

    {{ Form::fileField('image', 'Upload new Post image. Maximum file size: 2 mb') }}

    <br>

    {{ Form::submitField('Save Post Image', 'btn btn-default') }}
@stop

@section('footer-js')
{{ HTML::script('js/magicsuggest.min.js') }}

{{ HTML::script('plugins/froala_editor_1.2.7/js/froala_editor.min.js') }}
<script>
    var url = 'http://localhost/larabase/public/api/tags'
    var placeholder_tag = {{ json_encode($selected_tags) }}
    var tags = {{ json_encode($tags) }}

    $('#content').editable({
        inlineMode: false,
        // imageUploadURL: '{{ action('PostsController@uploadContentImage', $post->id) }}',
        imageUploadURL: '/myblog/public/uploads/upload_image.php',
        imageErrorCallback: function (data) {
            console.log(data);
        }
    });
    
</script>
@stop