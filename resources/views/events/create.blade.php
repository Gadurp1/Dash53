@extends('app')
@section('content')
{!! Form::open(array('url' => 'festivals')) !!}
		@include('festivals.form')
{!! Form::close() !!}
@stop
