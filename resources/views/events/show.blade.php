@extends('layouts.app')

@section('content')

<style>
     html, body {
       height: 100%;
       margin: 0;
       padding: 0;
     }
     #map {
       height: 300px;
     }

   </style>
   <style>
    h2 span{
      color: white;  letter-spacing: -1px;
    }

  h2 span.spacer{
    padding: 5 2px; background: none
  }

  .btn-white{
    background:none;
    border:1px solid #fff;
    font-weight:600;
    color:#fff;
  }
</style>
<aside id="fh5co-hero" class="js-fullheight" style="margin-top:-10px">
  <div class="flexslider js-fullheight">
    <ul class="slides">
      <li style="background-image: url({{$artist_detail->image_url}});">

        <div class="overlay-gradient" style="background:url('http://il5.picdn.net/shutterstock/videos/9122858/thumb/6.jpg')no-repeat center center fixed;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          height:100%;opacity:.8;position:absolute:bottom:0;left:0"
        >

        <div class="container">
          <div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
            <div class="slider-text-inner">
              <h2><strong><small style="color:#fff">{{date('D M d, Y h:ia',strtotime($artist_detail->event->date))}}</small></strong></h2>
              <h2 class="title">
                <span><strong>{{$artist_detail->name}} @  {{$event->name}}</strong></span>
              <h2>

              <p>
                <a href="{{$event->ticket_url}}" class="btn btn-white btn-sm">
                Buy Tickets
                </a>
                <a href="#more" class="btn btn-white btn-sm">
                  Details v
                </a>
              </p>
            </div>
          </div>
        </div>
        </div>
      </li>

      </ul>
    </div>
</aside>

<div id="more">
  <script>

       // This example adds a marker to indicate the position of Bondi Beach in Sydney,
       // Australia.
       function initMap() {
         var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            scrollwheel: false,
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,
            draggable: false,
            center: {lat: {{$venue->lat}}, lng: {{$venue->long}}},
         });
         var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
         var beachMarker = new google.maps.Marker({
           position: {lat: {{$venue->lat}}, lng: {{$venue->long}}},
           map: map,
           icon: image
         });
       }
     </script>

</div>
<div id="fh5co-work-section" class="fh5co-light-grey-section">
<div class="container">
  <div class="row">
    <br><bR><br>

    <div class="col-md-8 ">
      <div class="row">

        <div class="panel panel-default" style="border-top:4px solid #27e1ce">
          <div class="panel-heading">

            <div class="row">
              <div class="col-md-4" style="border:none">
                @if($event->status=='available')
                <a href="{{$event->ticket_url}}" target="_blank" >Buy Tickets</a>
                @elseif(!$event->ticket_url && $event->on_sale_datetime)
                @endif
              </div>
              <div class="col-md-4" style="border:none">
                <a href="{{$artist_detail->facebook_page_url}}">FB</a>
              </div>
              <div class="col-md-4" style="border:none">
                <a href="{{$event->url}}">Festival Website</a>
              </div>
            </div>

          </div>
          <div class="panel-body">
            {{$venue->name}} {{$venue->city}}, {{$venue->region}}
          </div>
          <div id="map"></div>
          <div class="list-group-item" style="border:none">
              {{date('l M d, Y',strtotime($artist_detail->event->date))}}
          </div>

          </div>
          <div class="row hidden">
            <a class="btn btn-info" href="{{$event->url}}">+ Follow Artist</a><br>
            <a class="btn btn-info" href="{{$event->url}}">+ Follow Venue</a>
          </div>

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h2 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <strong>Upcoming Shows for {{$artist_detail->name}}</strong>
                </a>
              </h2>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <script type='text/javascript' src='http://widget.bandsintown.com/javascripts/bit_widget.js'></script>
                <a href="http://www.bandsintown.com/{{$artist_detail->name}}" class="bit-widget-initializer" data-artist="{{$artist_detail->name}}">{{$artist_detail->name}} Tour Dates</a>      </div>
            </div>
          </div>
        </div>
        <img src="{{ $details->image[2]->{'#text'} }}" class="thumbnail">

        <h3> Tags </h3>

        @foreach ($details->tags->tag as $tag)
            <span class="label label-primary"><i class="fa fa-tag"></i> {{ $tag->name }}</span>
        @endforeach

        <h3> Biography </h3>
        <p>{!! $details->bio->summary !!}</p>

        <h3> Top Albums </h3>
        @foreach ($albums as $album)
            <a href="{{$album->url}}"><img src="{{ $album->image[3]->{'#text'} }}" width="150" height="150"></a>
        @endforeach
        <hr>
        <h3> Top Tracks </h3>
        <ul class="list-group">

            @foreach ($tracks as $track)
                <li class="list-group-item"><a href="{{ $track->url }}">{{ $track->name }}</a></li>
            @endforeach
        </ul>

        <div class="hidden">
          <h3> Similar Artists </h3>
          <ul class="list-group">
              @foreach ($details->similar->artist as $artist)
                  <li class="list-group-item"><a href="{{ $artist->url }}">{{ $artist->name }}</a></li>
              @endforeach
          </ul>

        </div>
      </div>


  </div>
</div>
</div></div>
<div id="fh5co-work-section" class="fh5co-white-section">
  <div class="row">
    <!-- content-8  -->
    <section class="col-md-8 col-md-offset-2">
      <div class="row ">
        <h1 class="text-center"><strong>More Events @ {{$event->name}} {{$venue->city}}</strong></h1>
        <hr>
        <?php $venue_link=str_replace(' ', '-', $venue->name);?>
        @foreach($artists as $artist)
        <?php
          $name=str_replace(' ', '-', $artist->name);
          $name_link=str_replace(' ', '-', $artist->name);
        ?>

        <div class="col-md-6 animate-box">
          <a href="{{url('Events/'.$venue_link.'/'.$name_link.'')}}" class="item-grid text-center">
            <div class="image" style="background-image: url({{$artist->image_url}})"></div>
            <div class="v-align">
              <div class="v-align-middle">
                <h2 class="title">{{$artist->name}}</h2>
                <h3 class="category">
                  <strong>{{date('D M d, Y h:i',strtotime($artist->event->date))}}</strong>
                </h3>
              </div>
            </div>
          </a>
        </div>

        @endforeach
        </div>
      </section>
    </div>
  </div>
</div>
</div>
</div>
@stop
