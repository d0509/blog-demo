@extends('frontend.master.layout')
@section('title', $post->title)
@section('content')
    <div class="container" style="overflow-x: hidden; overflow-y:auto;">
        <div class="card">
            
            <h1 class="text-center">
                {{ $post->title }}
            </h1>
            @foreach ($post->media as $media)
                 <img src="{{ asset('storage/banner/' . $media['filename'] . '.' . $media['extension']) }}"
                 class="card-img-top mt-3" alt="Hollywood Sign on The Hill"/> 
            @endforeach
            <div class="card-body">
                {!! $post->description !!}
            </div>
        </div>
    </div>
@endsection
