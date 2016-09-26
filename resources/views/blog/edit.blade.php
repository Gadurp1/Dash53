@extends('layouts.app')
@section('content')
@include('errors.list')

<!-- Main Container -->
<div class="container">

  {!! Form::model(
      $post,
      [ 'method'=>'PATCH', 'action' => ['Blog\PostController@update',$post->slug],
      'files' => true,
      'enctype'=>'multipart/form-data']
      )
  !!}
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <img src="{{$post->img_url}}" class="img-responsive "></img>
    </div>

  </div>
  <!-- Post Layout -->
  @include('blog.form',['button_text'=>'Save New Post']) {!! Form::close() !!}

  <!-- End Main Container -->
</div>

@stop
