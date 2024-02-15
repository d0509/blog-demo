@extends('frontend.master.layout')
@section('contentHeader')
    <title> {{ env('APP_NAME') }} | {{ $post->title }} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            margin: 1px;
            font-size: 30px;
            color: #222;
        }
    </style>
@endsection
@section('content')
    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="blog-title-area">
                            <span class="color-green"><a href=""
                                    title="">{{ $post->category->name }}</a></span>
                            <h3>{{ $post->title }}</h3>
                           
                            <div class="blog-meta big-meta">
                                <small><a href="garden-single.html"
                                        title="">{{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y') }}</a></small>
                                <small><a href="blog-author.html" title="">by {{ $post->author }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end title -->
                            <h2 class="text-center">
                                <div id="social-links">
                                    <ul>
                                        {!! $shareComponent !!}
                                    </ul>
                                </div>
                            </h2>
                            
                        <div class="single-post-media">
                            @foreach ($post->media as $media)
                                <img src="{{ asset('storage/banner/' . $media['filename'] . '.' . $media['extension']) }}"
                                    alt="" class="img-fluid">
                            @endforeach
                        </div><!-- end media -->


                        <div class="blog-content">
                            <div class="pp">
                                {!! $post->description !!}
                            </div>

                        </div><!-- end content -->

                        <div class="blog-title-area">

                        </div><!-- end title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="banner-spot clearfix">
                                    <div class="banner-img">
                                        <img src="upload/banner_01.jpg" alt="" class="img-fluid">
                                    </div><!-- end banner-img -->
                                </div><!-- end banner -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>



    <div class="dmtop">Scroll to Top</div>

    </div>
@endsection
