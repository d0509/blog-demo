@extends('frontend.master.layout')
@section('title', 'Home Page')
@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <input type="search" class="form-control col-3" name="query" id="query" placeholder="Search"
                value="{{ request('search') }}" class="form-control" />

            <button type="submit" class="btn btn-primary ml-2 col-1">
                Search
            </button>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4" id="searchResults">
                <div class="col">
                  
                </div>

        </div>
    </div>
@endsection
@section('contentfooter')
    <script>
        $(document).ready(function() {
            $('#query').on('change', function() {
                var keyword = $(this).val();

                $.ajax({
                    url: "{{ route('home') }}",
                    method: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
                        displayResults(data.posts);
                    }
                });
            });

            function displayResults(posts) {
                var resultsList = $('#searchResults');
                resultsList.empty();

                if (posts.length > 0) {
                    posts.forEach(function(post) {
                        console.log(post);
                        resultsList.append(
                            post
                        );
                    });
                } else {
                    resultsList.append('<li>No results found</li>');
                }
            }
        });
    </script>
@endsection
