@extends('frontend.master.layout')
@section('title', 'Home Page')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <form action="{{ route('home') }}" method="get" class="mb-5 d-flex">

                <input type="search" class="form-control col-3" id="form1" name="search" value="{{ request('search') }}"
                    placeholder="search" class="form-control" />

                <select class="form-control col-3 ml-2 mr-4" type="text" name="category_id">
                    
                    <option value="empty" > Select a category to search </option>
                    @forelse ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }} >
                            {{ $category->name }}
                        </option>
                    @empty
                        <option> No categories to show </option>
                    @endforelse
                </select>

                <button type="submit" class="btn btn-primary ml-2 col-1">
                    Search
                </button>
            </form>

        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4" id="searchResults">
            @forelse ($blogs as $blog)
                <div class="col">
                    <div class="card">
                        @forelse ($blog->media as $item)
                            <a href="{{ route('posts.show', ['slug' => $blog->slug]) }}"> <img
                                    src="{{ asset('storage/banner/' . $item['filename'] . '.' . $item['extension']) }}"
                                    class="card-img-top" alt="Hollywood Sign on The Hill" height="233px" /> </a>
                        @empty
                            <p class="fs-3 text-center"> Given Event doesn't have any image</p>
                        @endforelse

                        <div class="card-body">
                            <span class="badge bg-primary"> {{ $blog->category->name }} </span>
                            <p class="card-text">
                            <div class="row" style="width: 50px">
                                {!! $blog->title !!}

                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <p class="fs-3 text-center"> No Blogs found </p>
            @endforelse
        </div>
    </div>
@endsection
