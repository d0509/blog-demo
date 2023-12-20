@extends('backend.master.layout')
@section('contentHeader')
        <title> {{ env('APP_NAME') }} | {{ $blog->title }} </title>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="col-12 grid-margin stretch-card">
            <div class="card mt-5 mb-5">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary float-right" href="{{ route('admin.blogs.index') }}">Back</a>
                    </div>
                    <h1 class="text-center fw-bold "> {!! $blog->title !!} </h1>
                    @if (!empty($blog->media()->first()))
                        @foreach ($blog->media as $item)
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('storage/banner/' . $item['filename'] . '.' . $item['extension']) }}"
                            alt="" class="img-fluid mt-5 ">
                        </div>
                            
                        @endforeach

                    @endif
                    <br>
                    <span class="badge bg-primary ml-5 text-end"> {{ $blog->category->name }} </span>
                    <br> <br>
                    {!! $blog->description !!}
                </div>
            </div>
        </div>
    </div>
@endsection
