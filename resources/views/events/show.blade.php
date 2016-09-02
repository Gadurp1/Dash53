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
   h2 span             { color: white;  letter-spacing: -1px;
                       background: rgb(0, 0, 0); background: rgba(0, 0, 0, 0.7); padding: 15px; }
   h2 span.spacer      { padding: 5 2px; background: none }
   </style>
<div class="container">
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

<aside id="fh5co-hero" class="js-fullheight" style="margin-top:-10px">
  <div class="flexslider js-fullheight">
    <ul class="slides">
      <li style="background-image: url({{$artist_detail->image_url}});">
        <div class="overlay-gradient" style="background:url('http://il5.picdn.net/shutterstock/videos/9122858/thumb/6.jpg')no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  height:100%;opacity:.8;position:absolute:bottom:0;left:0">
        <div class="container">
          <div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
            <div class="slider-text-inner">
              <h2 class="title">
                <span><strong>{{$artist_detail->name}} @  {{$event->name}}</strong></span>
              <h2>
              <h2><strong><span>{{$event->date}}</span></strong></h2>

              <p>
                <a href="{{$event->ticket_id}}" class="btn btn-success btn-lg">
                Buy Tickets
                </a>
                <a href="#more" class="btn btn-primary btn-lg">
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

</div>
<div id="fh5co-work-section" class="fh5co-light-grey-section">
<div class="container">
  <div class="row">

    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default" style="border-top:4px solid #27e1ce">
        <div class="panel-body">
          {{$venue->name}} {{$venue->city}}, {{$venue->region}}
        </div>
          <div id="map"></div>
        <div class="list-group-item" style="border:none">
            {{date('l M d, Y',strtotime($artist_detail->event->date))}}
          </div>
          <div class="list-group-item" style="border:none">
            @if($event->ticket_url)
            <a href="{{$event->ticket_url}}" target="_blank">Buy Tickets</a>
            @elseif(!$event->ticket_url && $event->on_sale_datetime)
            @endif
          </div>
          <div class="list-group-item" style="border:none">
            {{$artist_detail->facebook_page_url}}
          </div>
          <div class="list-group-item" style="border:none">
            <a href="{{$event->url}}">Festival Website</a>
          </div>
        </div>
        <div class="row hidden">
          <a class="btn btn-info" href="{{$event->url}}">+ Follow Artist</a><br>
          <a class="btn btn-info" href="{{$event->url}}">+ Follow Venue</a>
        </div>
      </div>
        </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-body">
            <strong>Upcoming Shows for {{$artist_detail->name}}</strong>
          </div>
          <hr>
        <script type='text/javascript' src='http://widget.bandsintown.com/javascripts/bit_widget.js'></script>
        <a href="http://www.bandsintown.com/{{$artist_detail->name}}" class="bit-widget-initializer" data-artist="{{$artist_detail->name}}">{{$artist_detail->name}} Tour Dates</a>
        </div>
      </div>
    </div>
</div>

</div>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnwQ6wvh-J0HHE-492La6liEN9hX0l-mI&callback=initMap"
async defer></script>
