@extends('frontend.master.layout')
@section('title',$post->title)
@section('content')
    <div class="card">
        <div class="card-header">
            {{$post->title}}
        </div>
        <div class="card-body">
            {!! $post->description !!}
        </div>
    </div>
@endsection