@extends('spark::layouts.app')
@section('content')
<script src='https://maps.googleapis.com/maps/api/js?key=&sensor=false&extension=.js'></script>

<script>
    google.maps.event.addDomListener(window, 'load', init);
    var map;
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(41.890585,632.780599),
            zoom: 11,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
            },
            disableDoubleClickZoom: true,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            },
            scaleControl: true,
            scrollwheel: false,
            panControl: true,
            streetViewControl: true,
            draggable : true,
            overviewMapControl: false,
            overviewMapControlOptions: {
                opened: false,
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}],
        }
        var mapElement = document.getElementById('sadf');
        var map = new google.maps.Map(mapElement, mapOptions);
        var locations = [
          @foreach($events as $event)
            [
              '{{$event->name}} @ {{$event->title}}',

              '<img src="{{$event->image_url}}">',
              '{{$event->title}}',
              '',
              '',
              {{$event->lat}},
              {{$event->lon}},'https://mapbuildr.com/assets/img/markers/ellipse-blue.png'
            ],
          @endforeach
          ];
        for (i = 0; i < locations.length; i++) {
			if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
			if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
			if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
           if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
           if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
            marker = new google.maps.Marker({
                icon: markericon,
                position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                map: map,
                title: locations[i][0],
                desc: description,
                tel: telephone,
                email: email,
                web: web
            });
if (web.substring(0, 7) != "http://") {
link = "http://" + web;
} else {
link = web;
}
            bindInfoWindow(marker, map, locations[i][0], description, telephone, email, web, link);
     }
 function bindInfoWindow(marker, map, title, desc, telephone, email, web, link) {
      var infoWindowVisible = (function () {
              var currentlyVisible = false;
              return function (visible) {
                  if (visible !== undefined) {
                      currentlyVisible = visible;
                  }
                  return currentlyVisible;
               };
           }());
           iw = new google.maps.InfoWindow();
           google.maps.event.addListener(marker, 'click', function() {
               if (infoWindowVisible()) {
                   iw.close();
                   infoWindowVisible(false);
               } else {
                   var html= "<div style='color:#000;background-color:#fff;padding:5px;width:150px;'><h4>"+title+"</h4><p>"+desc+"<p><p>"+telephone+"<p><a href='mailto:"+email+"' >"+email+"<a><a href='"+link+"'' >"+web+"<a></div>";
                   iw = new google.maps.InfoWindow({content:html});
                   iw.open(map,marker);
                   infoWindowVisible(true);
               }
        });
        google.maps.event.addListener(iw, 'closeclick', function () {
            infoWindowVisible(false);
        });
 }
}
</script>
<style>
    #sadf {
        height:900px;
        width:100%;
    }
    .gm-style-iw * {
        display: block;
        width: 100%;
    }
    .gm-style-iw h4, .gm-style-iw p {
        margin: 0;
        padding: 0;
    }
    .gm-style-iw a {
        color: #4272db;
    }
</style>




<div class="">
  <div class="col-md-7">

<div class="panel panel-default panel-body class">

  <form >
    <div class="row">
          <br><br>
      <div class="form-group col-md-12">
        <input name="search" class="form-control input-sm" id="exampleInputEmail1" placeholder="Location">
      </div>
      <div class="form-group col-md-6">
        <input name="search" class="form-control input-sm" id="exampleInputEmail1" placeholder="Venue , Artist, Neighborhood">
      </div>

      <div class="form-group col-md-6">
        <input name="search" class="form-control input-sm" id="exampleInputEmail1" placeholder="Venue , Artist, Neighborhood">
      </div>
    </div>

  </form>
</div>
    <div id="fh5co-work-section" class="" >
      <div class="row">
        @foreach($events as $event)
        <?php
          $event_link=str_replace(' ', '-', $event->title);
          $name_link=str_replace(' ', '-', $event->name);
        ?>
        <div class="@if($events->count() < 6) col-md-12 @else col-md-12 @endif  animate-box" >
          <a href="{{url('Events/'.$event_link.'/'.$name_link.'')}}" class="item-grid text-center">
            <div class="image" style="background-image: url({{$event->image_url}});height:200px"></div>
            <div class="v-align" style="height:10em">
              <div class="v-align-middle">
                <h3 class="title">{{$event->name}} @ {{$event->title}}</h3>
                <h5 class="category">
                  <strong>{{date('D M d, Y h:i',strtotime($event->date))}}</strong>
                </h5>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
  </div>
  </div>
  <div class="col-md-5 pull-right" style="position:fixed;right:0">
    <div id='sadf'></div>

  </div>
</div>








@stop
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnwQ6wvh-J0HHE-492La6liEN9hX0l-mI&callback=initMap"
async defer></script>
