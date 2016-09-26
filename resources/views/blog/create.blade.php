@extends('spark::layouts.app')
@section('content')

@include('errors.list')

  <!-- Main Container -->
  <div class="container">

    {!! Form::open(
        array(
          'route' => 'admin.post.store',
          'class' => 'form',
          'files' => true,
          'enctype'=>'multipart/form-data'
          )
        )
    !!}

    <!-- Post Form Layout -->
      @include('pages.blog.form',['button_text'=>'Save New Post'])

    {!! Form::close() !!}

  <!-- End Main Container -->
  </div>

@stop
