@extends('podcastapp::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('podcastapp.name') !!}</p>
@endsection
