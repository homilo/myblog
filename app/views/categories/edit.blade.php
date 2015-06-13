@extends('layouts.master')
@section('content')

<div class="col-md-6">

    {{ Form::model($category, ['route'=> ['admin.categories.update', $category->id], 'method' => 'PUT']) }}

    {{ Form::textField('name', 'Category Name', null) }}

    {{ Form::textField('description', 'Description', null) }}

    {{ cancel_button() }}

    {{ Form::submitField('Save Changes') }}

    {{ Form::close() }}

    {{-- 
    ----	Update 30/04/2015 Loi 
    ----	Upload image
    --}}
    <img class="img-thumbnail" src="{{ cat_image_url($category->image) }}" width="215" height="100" style="width:357px; height:180px; "> 

    {{ Form::open(['action'=> ['CategoriesController@uploadCategoryImage', $category->id], 'files' => true]) }}

    {{ Form::fileField('image', 'Upload new Category image. Maximum file size: 2 mb') }}

    <br>

    {{ Form::submitField('Save Category Picture', 'btn btn-default') }}

    {{ Form::close() }}

</div>
@stop