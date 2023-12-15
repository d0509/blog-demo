@extends('frontend.master.layout')
{{-- {{ dd($post)}} --}}
@section('title',$post->title)
@section('content')
<div class="container">
    <div class="card">
        {{-- @if (isset($post) &&  $media = $post->media()->first())
        <div class="form-group row">
            <div class="col-sm-10">
                <img src="{{ asset('storage/banner/' . $media->filename.'.'.$media->extension) }}" alt="Old Banner" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
            </div>
        </div>
        @endif --}}
        <div class="card-header">
            <h3>{{$post->title}}</h3>
        </div>
        <div class="card-body">
            {!! $post->description !!}
        </div>
    </div>
</div>
@endsection