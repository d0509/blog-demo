@extends('frontend.master.layout')
@section('title', $post->title)
@section('content')




    <div class="header-section page-title wb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo d-flex justify-content-center align-items-center">
                        <a href="{{ route('home') }}">
                            <h2><i class="fa fa-leaf bg-green"></i> Bloggify</h2>
                        </a>
                    </div><!-- end logo -->
                </div>
            </div><!-- end row -->
        </div><!-- end header-logo -->
    </div><!-- end header -->

    <header class="header">
        <div class="container">
            <nav class="navbar navbar-inverse navbar-toggleable-md">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Forest Timemenu"
                    aria-controls="Forest Timemenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-md-center" id="Forest Timemenu">
                    <ul class="navbar-nav">
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                @if ($category->name == $post->category->name)
                                    <a class="nav-link" style="color: green"
                                        href="{{ route('home', ['category' => $category->slug]) }}">
                                        {{ $category->name }}
                                    </a>
                                @else
                                    <a class="nav-link color-green-hover"
                                        href="{{ route('home', ['category' => $category->slug]) }}">
                                        {{ $category->name }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div><!-- end container -->
    </header><!-- end header -->

    <div class="page-title wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2><i class="fa fa-leaf bg-green"></i> Blog</h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->

    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="blog-title-area">
                            <span class="color-green"><a href="garden-category.html"
                                    title="">{{ $post->category->name }}</a></span>
                            <h3>{{ $post->title }}</h3>

                            <div class="blog-meta big-meta">
                                <small><a href="garden-single.html"
                                        title="">{{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y') }}</a></small>
                                <small><a href="blog-author.html" title="">by {{ $post->author }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end title -->

                        <div class="single-post-media">
                            @foreach ($post->media as $media)
                                <img src="{{ asset('storage/banner/' . $media['filename'] . '.' . $media['extension']) }}"
                                    alt="" class="img-fluid">
                            @endforeach
                        </div><!-- end media -->

                        {{-- <div class="d-flex">
                            <div class="first">
                                <img src="https://cdn.pixabay.com/photo/2013/12/27/12/21/rail-234318_1280.jpg" style="border-radius: 50% ; width:75px" alt="RANDOM USER IMAGE">
                            </div>
                            <div class="second">
                                <p class="ml-5" >{{$post->author}}</p> 
                                <p class="ml-5" >{{ Carbon\Carbon::parse($post->created_at)->format(config('site.date_format')) }}</p>
                            </div>
                        </div> --}}
                     
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
