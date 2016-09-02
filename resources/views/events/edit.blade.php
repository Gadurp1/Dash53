@extends('spark::layouts.app')
@section('content')
{!! Form::model($event,['method'=>'PATCH','action' => ['EventController@update',$event->id]]) !!}
  @include('events.form')
{!! Form::close() !!}
@stop
