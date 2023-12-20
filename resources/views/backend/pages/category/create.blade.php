@extends('backend.master.layout')
@section('contentHeader')
    @if (isset($category))
        <title> {{ env('APP_NAME') }} | {{ __('headers.edit_category') }} </title>
    @else
        <title> {{ env('APP_NAME') }} | {{ __('headers.create_category') }} </title>
    @endif
@endsection
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container-fluid px-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
                    @if (isset($category))
                        <h1 class="h3 mb-0 text-gray-800 text-center">Update Category</h1>
                    @else
                        <h1 class="h3 mb-0 text-gray-800 text-center">Create Category</h1>
                    @endif
                    <a class="btn btn-primary float-right" href="{{ route('admin.categories.index')}}">Back</a>                </div>
                @if (isset($category))
                    <form action="{{ route('admin.categories.update', ['category' => $category->slug]) }}" method="post">
                        @csrf
                        @method('PATCH')
                    @else
                        <form action="{{ route('admin.categories.store') }}" method="post">
                            @csrf
                @endif


                <form>
                    <div class="form-group row mt-5">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Please enter category"
                                @if (isset($category)) value="{{ old('name', $category->name) }}">
                                        @else
                                        value="{{ old('name') }}"> @endif
                                @error('name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                                </div>
                        </div>

                        <div class="form-group row mt-5">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                            <div name="status" id="status" class="col-sm-10 ">
                                <select class="form-select changeUserStatus" aria-label="Default select example"
                                    name="is_active">
                                    <option value="default"> Please select a status</option>
                                    <option value="1"
                                        @if (isset($category)) {{ $category->is_active == 1 ? 'selected' : '' }} @endif>
                                        Active</option>
                                    <option value="0"
                                        @if (isset($category)) {{ $category->is_active == 0 ? 'selected' : '' }} @endif>
                                        Inactive</option>
                                </select>
                                @error('is_active')
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
