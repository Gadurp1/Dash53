@extends('layouts.app')

@section('content')
    <div class="container">
        @include('errors.list')

        <div class="page-header">
            <h3><i style="color: #db1302" class="fa fa-play-circle-o"></i> {{ $details->name }}</h3>
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

        <h3> Top Tracks </h3>
        <ol>
            @foreach ($tracks as $track)
                <li><a href="{{ $track->url }}">{{ $track->name }}</a></li>
            @endforeach
        </ol>

        <h3> Similar Artists </h3>
        <ul class="list-unstyled list-inline">
            @foreach ($details->similar->artist as $artist)
                <li><a href="{{ $artist->url }}">{{ $artist->name }}</a></li>
            @endforeach
        </ul>

    </div>
@stop
