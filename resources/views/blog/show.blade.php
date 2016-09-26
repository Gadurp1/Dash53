@extends('layouts.app')
@section('content')
<div id="fh5co-work-section" class="fh5co-light-grey-section"  >

<div class="container">

  <div class="row">
    <!-- TODO:: If Role is Admin -->

    <div class="panel-heading">

      <!-- Post Status -->
      @if($post->status==0)

      <a class="btn btn-danger disabled">Draft</a> @else

      <a class="btn btn-success disabled">Published</a> @endif

      <!-- Edit Button -->
      <a class="btn btn-info pull-right btn-sm" href="{{ action('Blog\PostController@edit', [$post->slug]) }}">
        <i class="fa fa-edit"></i> Edit
      </a>

      <!-- Button trigger delete confirm modal -->
      <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-trash"></i>
      </button>
    </div>
    <!-- EndIf Admin -->

    @if($post->img_url)
      <img src="/uploads/{{$post->img_url}}" class="img-responsive col-md-12" style="height:40em" alt="" />
    @endif

    <!-- Blog Content -->
    <div class="col-md-12 ">
      <div class="panel ">

        <div class="panel-body" style="padding:5em">

          <div class="col-md-8 col-xs-12">
            <small>
              <i> {{date('l M d, Y',strtotime($post->created_at))}}</i>
            </small>
            <h1 style="font-size:48px">
              <strong>{{$post->title}}</strong>
            </h1>
            <hr>
            <p style="font-size:16px;font-family:'Helvetica'">{!! $post->content !!}</p>
            <hr>


          </div>
          <div class="col-md-1 pull-right">
            <br><br>
            <div class="row">
              <a href="#" class="btn btn-info btn-lg" style="border-radius:50%"><i class="fa fa-facebook"></i></a>
            </div>
            <br>
            <div class="row">
              <a href="#" class="btn btn-info"><i class="fa fa-linkedin"></i></a>
            </div>
            <br>

            <div class="row">
              <a href="#" class="btn btn-info"><i class="fa fa-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        @if($post->comments > 0)
          @include('blog.comments')
        @endif
      </div>
    </div>
    <br><br><br>

      <div class="col-md-12">
        <!-- Blog Sidebar -->
        @include('blog.sidebar')
      </div>
    </div>
  <br><br><br><Br>
</div>
@endsection
