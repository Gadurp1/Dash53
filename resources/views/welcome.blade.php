@extends('layouts.app')
@section('content')
<style media="screen">
  div.blog-item:hover{
  border-left:4px solid #27e1ce;
  }
  .jumbotron {
  background: url('http://az616578.vo.msecnd.net/files/2016/04/24/6359707218968182761485027386_lollapalooza-crowd-at-cage-the-elephant-lollapalooza-2014-by-joshua-mellin.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>

<div class="jumbotron" >
  <div class="container text-center">
    <h1 style="color:#fff;background:#000"><strong>What are you looking to do tonight?</strong></h1>
    <form class="" action="index.html" method="post">
      <div class="form-group">
        <label for=""></label>
        <input type="text" class="form-control" style="background:#fff;" id="" placeholder="" active>
      </div>
    </form>
  </div>
  <p></p>
</div>
  <div id="fh5co-work-section" class="fh5co-light-grey-section" >
    <div class="container">

<div col-lass="row">
  <div class="col-md-8 animate-box" >
    <a href="" class="item-grid text-center" style="border-left:2px solid turquoise">
    <div class="image" style="height:15em;background-image: url({{$events->last()->image_url}})"></div>
    <div class="v-align" style="height:10em">
      <div class="v-align-middle">
        <h2 class="title" style="line-height:15px">  <strong>{{$events->last()->name}} @   {{$events->last()->title}}</strong></h2>
        <h3 class="category">{{date('D M d, Y',strtotime($events->last()->date))}}</h3>

      </div>
    </div>
    </a>
  </div>

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
    <p><a href="#" class="btn btn-primary with-arrow">Load More <i class="icon-arrow-right"></i></a></p>
  </div>
</div>
</div>
</div>

</div>
@stop
