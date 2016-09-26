@extends('layouts.app')
@section('content')
<br><br><br>
<style media="screen">
.sidebar-box {
  max-height: 180px;
  position: relative;
  overflow: hidden;
}
.sidebar-box .read-more {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  text-align: left;
  margin: 0; padding: 30px 0;

  /* "transparent" only works here because == rgba(0,0,0,0) */
  background-image: linear-gradient(to bottom, transparent, white);
}
</style>
<div id="fh5co-work-section" class="fh5co-light-grey-section"  >

  <div class="container">

      <div class="row">
          <div class="col-md-8">

            <!-- Check if posts returns result -->
            @if($posts->count() > 0)

              @foreach($posts as $post)
              <div class="panel panel-default panel-body">

                                @if($post->img_url)
                                <div class="row">
                                  <img src="/uploads/{{$post->img_url}}" class="img-responsive col-md-12"  style="height:30em;padding:0px" alt="" />
                                </div>
                                @else
                                  <div class="row">
                                    <img class="img-responsive col-md-12" style="padding:0px" alt="" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Chicago_skyline,_viewed_from_John_Hancock_Center.jpg/1024px-Chicago_skyline,_viewed_from_John_Hancock_Center.jpg" alt="" />
                                  </div>
                                @endif
                                <!-- Post Snippet Panel  -->
                                <div class="row">
                                    <div class="panel">
                                      <div class="panel-body">
                                        <!-- Post title  -->
                                        <a href="{{url('Blog', [$post->slug]) }}">
                                          <h1><strong>{{$post->title}}</strong></h1>
                                        </a>
                                        <div class="sidebar-box">

                                          <!-- Post Description  -->
                                          <p>{!! $post->content !!} </p>
                                          <p class="read-more">

                                          </p>

                                      </div>
                                      <hr>
                                      <a href="{{url('Blog', [$post->slug]) }}">
                                        Read More
                                      </a>
                                    </div>
                                  </div>

                                </div>

              </div>

              @endforeach

              <!-- If no results render "No Results" -->
              @else
              <div class="panel panel-body">
                <h2 class="text-center">No Results Found</h2>
              </div>

            @endif

            <!-- Render Pagination -->
            {{$posts->appends(Request::except('page'))->render()}}

          </div>
          <div class="col-md-3 pull-right">
            <div class="row">
              <!-- Blog Search Input -->
              {!! Form::open(array('method'=>'GET')) !!}

                <div class="col-md-12">
                  <input type="text" name="search" class="form-control " id="" placeholder="Search All Blogs">
                </div>

              {!! Form::close() !!}
            </div>
            <hr>
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Newsletter</h3>
              </div>
              <div class="panel-body">
                <p>Join the weekly newsletter and never miss out on new tips, tutorials, and more.</p>
                <!-- Blog Search Input -->
                {!! Form::open(array('method'=>'GET')) !!}

                <div class="row">
                  <div class="col-md-12">
                    <input type="text" name="search" class="form-control " id="" placeholder="Enter your email address">
                  </div>

                </div>
                {!! Form::close() !!}
              </div>
              <div class="panel-footer">

              </div>
            </div>
          </div>
      </div>
  </div>

@endsection
