@extends('backend.master.layout')
@section('title',$blog->title)
@section('content')
<div class="container-fluid">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {!! $blog->description !!}
            </div>
        </div>
    </div>
</div>
@endsection