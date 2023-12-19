@extends('backend.master.layout')
@section('title',$blog->title)
@section('content')
<div class="container-fluid">
    <div class="col-12 grid-margin stretch-card">
        <div class="card mt-5 mb-5">
            <div class="card-body">
                <h1 class="text-center fw-bold "> {!! $blog->title !!}  </h1>
                <span class="badge bg-primary text-end"> {{ $blog->category->name }} </span>
                {!! $blog->description !!}
            </div>
        </div>
    </div>
</div>
@endsection