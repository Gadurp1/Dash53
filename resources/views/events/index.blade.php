@extends('layouts.app')
@section('content')
<style media="screen">
  .search-banner{
    padding-top:2em;
    padding-bottom:2em;
    background:#fff;
    margin-top:-30px;
  }
  .animate-box.image{
    border-top:2px solid #43c8ae;
  }

</style>
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
</head>

  <div id="fh5co-work-section" class="fh5co-light-grey-section"  >
    <div class="container">
      <div class="">
        <h1 class="text-center">Search for all events going on in chicago</h1>
        <p class="text-center lead">Use the filters to find bands in your area that are coming to chicago soon</p>

      </div>
    <div class="navbar  " >
      <div class="container">
        			<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.17/vue.min.js"></script>
        			<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.6.1/lodash.min.js"></script>
        			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-google-maps/0.1.19/vue-google-maps.js"></script>

            <center >
              <div class="navbar-collapse collapse" style="padding-bottom:1em;padding-top:1em;" id="navbar-main">
                <form class="" method="GET" role="search">
                  <div class="row">
                    <div class="col-md-7">
                      <input type="text" class="form-control col-md-8" name="search" autofocus="autofocus" placeholder="Artist, Venue, Event" active>
                    </div>
                    <div class="col-md-2">
                      <select class="form-control">
                        <option>Underground</option>
                        <option>Up And Coming</option>
                        <option>Well Known</option>
                        <option>Everyone Knows Them</option>
                        <option>Chart Toppers</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <select class="form-control" name="rank">
                        <option value="1000">Underground</option>
                        <option value="25000">Up And Coming</option>
                        <option value="100000">This Weekend</option>
                        <option value="50000">Everyone Knows Them</option>
                        <option value="10000000">Chart Toppers</option>
                      </select>
                    </div>
                    <div class="col-md-1">
                      <button type="submit" class="btn btn-success">Search</button>
                    </div>
                  </div>
                </form>
              </div>
            </center>
          </div>
        </div>
        <br><br>
			<div col-lass="row  grid-container">

        @foreach($events as $event)
        <?php
          $event_link=str_replace(' ', '-', $event->title);
          $name_link=str_replace(' ', '-', $event->name);
        ?>

        <div class="@if($events->count() < 6) col-md-12 @else col-md-4 @endif  animate-box" >
          <a href="{{url('Events/'.$event_link.'/'.$name_link.'')}}" class="item-grid text-center">
          <div class="image" style="height:15em;background-image: url({{$event->image_url}})"></div>
          <div class="v-align" style="height:9em">
            <div class="v-align-middle">
              <h2 class="title" ><strong>{{$event->name}} @ {{$event->title}}</strong></h2>
              <h4 class="category hidden">{{date('D M d, Y',strtotime($event->date))}}</h4>

            </div>
          </div>
          </a>
        </div>

        @endforeach
				<div class="col-md-12 text-center animate-box">
          {{$events->appends(Request::except('page'))->render()}}
				</div>
			</div>
		</div>
	</div>


	<div class="fh5co-cta" style="background-image: url(images/slide_2.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="col-md-12 text-center animate-box">
				<h3>Get Updated on Events in Your Area</h3>
				<p><a href="#" class="btn btn-primary btn-outline with-arrow">Get started now! <i class="icon-arrow-right"></i></a></p>
			</div>
		</div>
	</div>

@stop
