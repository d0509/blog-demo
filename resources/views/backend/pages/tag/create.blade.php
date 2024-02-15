@extends('backend.master.layout')
@section('contentHeader')
    <title> {{ env('APP_NAME') }} | {{ __('headers.create_tag') }} </title>
@endsection
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container-fluid px-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">

                    <h1 class="h3 mb-0 text-gray-800 text-center">Create Tag</h1>
                    <a class="btn btn-primary float-right" href="{{ route('admin.tags.index') }}">Back</a>
                </div>
                    <form action="{{ route('admin.tags.store') }}" method="post">
                        @csrf
                        <form>
                            <div class="form-group row mt-5">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Please enter category" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-5"> Submit</button>
                        </form>
            </div>
        </main>
    </div>
@endsection
