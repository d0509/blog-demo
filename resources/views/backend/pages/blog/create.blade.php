@extends('backend.master.layout')
@section('title', 'Create Blog')
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container-fluid px-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
                    <h1 class="h3 mb-0 text-gray-800 text-center">Blog</h1>
                </div>

                @if (isset($blog))
                {{dd($blog)}}
                    <form action="{{ route('admin.blogs.update', ['blog' => $blog->slug]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                    @else
                        <form action="{{ route('admin.blogs.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                @endif
                <div class="form-group row mt-5">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter title"
                            @if (isset($blog)) value="{{ old('title', $blog->title) }}">
                                    @else
                                    value="{{ old('title') }}"> @endif
                            @error('title')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Blog</label>
                        <div class="col-sm-10 ">
                            <select class="form-select changeUserStatus" aria-label="Default select example"
                                name="category_id">
                                <option value="default"> Please select a Category for Blog </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if (isset($blog)) {{ $category->id == $blog->category->id ? 'selected' : '' }} @endif>
                                        {{ $category->name }} </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10 ">
                            <textarea {{ old('description') }} name="description" id="summernote" class="form-control " placeholder="Description">
                            @if (isset($blog))
                                {{ old('description', $blog->description) }}@else{{ old('description') }}
                                @endif
                            </textarea>
                            @error('description')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Author</label>
                        <div class="col-sm-10">
                            <input type="text" id="author" name="author" class="form-control"
                                placeholder="Enter author"
                                @if (isset($blog)) value="{{ old('author', $blog->author) }}">
                                        @else
                                        value="{{ old('author') }}"> @endif
                                @error('author')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                                </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Banner</label>
                            <div class="col-sm-10">
                                <input type="file" id="banner" name="banner" class="form-control">
                                @error('author')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        @if (isset($blog) &&  $media = $blog->media()->first())
                        <div class="form-group row mt-5">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Old Banner</label>
                            <input type="hidden" name="old_banner" value="{{$media->id}}">
                            <div class="col-sm-10">
                                <img src="{{ asset('storage/banner/' . $media->filename.'.'.$media->extension) }}" alt="Old Banner" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>
                        @endif
                        <div class="form-group row mt-5">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-select changeUserStatus" aria-label="Default select example"
                                    name="status">
                                    <option value="default"> Please select a status  </option>
                                    <option value="publish"
                                        @if (isset($blog)) {{ $blog->status == 'publish' ? 'selected' : '' }}    @endif>
                                        Publish</option>
                                    <option value="pending"
                                        @if (isset($blog)) {{ $blog->status == 'pending' ? 'selected' : '' }} @endif>
                                        Pending</option>
                                </select>
                                @error('status')
                                    <span class="text-danger"> {{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block mt-4"> Submit</button>
                        </form>
                    </div>
        </main>
    </div>
@endsection
@section('contentfooter')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                tabsize: 2,
                height: 300
            });
        });
    </script>
@endsection
