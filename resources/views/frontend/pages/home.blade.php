@extends('frontend.master.layout')
@section('title', 'Home Page')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <form action="{{ route('home') }}" method="get" class="mb-5 d-flex">
                <input type="search" class="form-control col-3" id="form1" name="search"
                    value="{{ request('search') }}" placeholder="search" class="form-control" />

                 <button type="submit"  class="btn btn-primary ml-2 col-1">
                   Search
                </button> 
            </form>
            
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4" id="searchResults">
            @forelse ($blogs as $blog)
    <div class="col">
        <div class="card">
            @forelse ($blog->media as $item)
              <a href="{{route('posts.show',['slug' => $blog->slug])}}">  <img src="{{ asset('storage/banner/' . $item['filename'] . '.' . $item['extension']) }}"
                    class="card-img-top" alt="Hollywood Sign on The Hill" height="233px" /> </a>
            @empty
                <p class="fs-3 text-center"> Given Event doesn't have any image</p>
            @endforelse

            <div class="card-body">
                
                <p class="card-text">
                <div class="row" style="width: 50px">
                    {!! $blog->title !!}

                </div>
                
            </div>
        </div>
    </div>
@empty
<p class="fs-3 text-center"> {{ __('home_no_events') }} </p>
@endforelse
        </div>
    </div>
@endsection
{{-- @section('contentfooter')
    <script>
        $(document).ready(function() {
            $(document).on('change','#form1', function() {
                var keyword = $(this).val();
                console.log(keyword);
                $.ajax({
                    url: "{{ route('home') }}",
                    method: 'GET',
                    data: {
                        // keyword: keyword,
                        listType: "BLOG-LIST",
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success) {
                            $("#searchResults").html(data.html)
                        }
                    }
                });
            });
            // function displayResults(posts) {
            //     var resultsList = $('#searchResults');
            //     resultsList.empty();

            //     if (posts.length > 0) {
            //         posts.forEach(function(post) {
            //             console.log(post);
            //             resultsList.append(
            //                 post
            //             );
            //         });
            //     } else {
            //         resultsList.append('<li>No results found</li>');
            //     }
            // }
        });
    </script>
@endsection --}}
