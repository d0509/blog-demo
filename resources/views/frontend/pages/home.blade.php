 @extends('frontend.master.layout')
@section('title', 'Home Page')
{{-- @section('content')
    @if (Auth::user()->hasRole(config('site.roles.user')))
        <div class="container mt-5">
            <div class="row mb-5">
                <form action="{{ route('home') }}" method="get" class="mb-5 d-flex">
                    <input type="search" class="form-control col-3" id="form1" name="search"
                        value="{{ request('search') }}" placeholder="search" class="form-control" />

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
    @else
        <h3 class="text-center">Admin can not access this page</h3>
    @endif

@endsection --}}
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
<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Forest Time - Stylish Magazine Blog Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset('asssets/front-assets/images/favicon.ico')}}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('asssets/front-assets/images/apple-touch-icon.png')}}">
    
    <!-- Design fonts -->
    <link href="{{ asset('assets/front-assets/https://fonts.googleapis.com/css?family=Droid+Sans:400,700')}}" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/front-assets/css/bootstrap.css')}}" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="{{ asset('assets/front-assets/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/front-assets/style.css')}}" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="{{ asset('assets/front-assets/css/responsive.css')}}" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="{{ asset('assets/front-assets/css/colors.css')}}" rel="stylesheet">

    <!-- Version Garden CSS for this template -->
    <link href="{{ asset('assets/front-assets/css/version/garden.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div id="wrapper">
        <div class="collapse top-search" id="collapseExample">
            <div class="card card-block">
                <div class="newsletter-widget text-center">
                    <form action="{{ route('home') }}" method="get" class="form-inline">
                        <input type="text" value="{{ request('search') }}" id="form1" name="search" class="form-control" placeholder="What you are looking for?">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end top-search -->

        <div class="topbar-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 hidden-xs-down">
                        <div class="topsocial">
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Flickr"><i class="fa fa-flickr"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google+"><i class="fa fa-google-plus"></i></a>
                        </div><!-- end social -->
                    </div><!-- end col -->

                    <div class="col-lg-4 hidden-md-down">
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="topsearch text-right">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search"></i> Search</a>
                        </div><!-- end search -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end topbar -->

        <div class="header-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo">
                            <a href="garden-index.html"><img src="{{ asset('assets/front-assets/images/version/garden-logo.png')}}" alt=""></a>
                        </div><!-- end logo -->
                    </div>
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end header -->

        <header class="header">
            <div class="container">
                <nav class="navbar navbar-inverse navbar-toggleable-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Forest Timemenu" aria-controls="Forest Timemenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-md-center" id="Forest Timemenu">
                        <ul class="navbar-nav">
                            @foreach ($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link color-green-hover" href="#">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </nav>
            </div><!-- end container -->
        </header><!-- end header -->

        {{-- <section class="section first-section">
            <div class="container-fluid">
                <div class="masonry-blog clearfix">
                    <div class="left-side">
                        <div class="masonry-box post-media">
                             <img src="upload/garden_cat_01.jpg" alt="" class="img-fluid">
                             <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        <span class="bg-aqua"><a href="blog-category-01.html" title="">Gardening</a></span>
                                        <h4><a href="garden-single.html" title="">How to choose high quality soil for your gardens</a></h4>
                                        <small><a href="garden-single.html" title="">21 July, 2017</a></small>
                                        <small><a href="#" title="">by Amanda</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                            </div><!-- end shadow -->
                        </div><!-- end post-media -->
                    </div><!-- end left-side -->

                    <div class="center-side">
                        <div class="masonry-box post-media">
                             <img src="upload/garden_cat_02.jpg" alt="" class="img-fluid">
                             <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        <span class="bg-aqua"><a href="blog-category-01.html" title="">Outdoor</a></span>
                                        <h4><a href="garden-single.html" title="">You can create a garden with furniture in your home</a></h4>
                                        <small><a href="garden-single.html" title="">19 July, 2017</a></small>
                                        <small><a href="#" title="">by Amanda</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                            </div><!-- end shadow -->
                        </div><!-- end post-media -->
                    </div><!-- end left-side -->

                    <div class="right-side hidden-md-down">
                        <div class="masonry-box post-media">
                             <img src="upload/garden_cat_03.jpg" alt="" class="img-fluid">
                             <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        <span class="bg-aqua"><a href="blog-category-01.html" title="">Indoor</a></span>
                                        <h4><a href="garden-single.html" title="">The success of the 10 companies in the vegetable sector</a></h4>
                                        <small><a href="garden-single.html" title="">03 July, 2017</a></small>
                                        <small><a href="#" title="">by Jessica</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                             </div><!-- end shadow -->
                        </div><!-- end post-media -->
                    </div><!-- end right-side -->
                </div><!-- end masonry -->
            </div>
        </section> --}}

        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-list clearfix">
                                <div class="row" id="searchResults">
                                    @forelse ($blogs as $blog)
                                        <div class="col-md-4">
                                            <div class="post-media">
                                                <a href="{{ route('posts.show', ['slug' => $blog->slug]) }}" title="">
                                                    @forelse ($blog->media as $item)
                                                        <img src="{{ asset('storage/banner/' . $item['filename'] . '.' . $item['extension']) }}"
                                                             alt="" class="img-fluid">
                                                    @empty
                                                        <p class="fs-3 text-center">Given Blog doesn't have any image</p>
                                                    @endforelse
                                                    <div class="hovereffect"></div>
                                                </a>
                                            </div><!-- end media -->
                                        </div><!-- end col -->
                                
                                        <div class="blog-meta big-meta col-md-8">
                                            <span class="bg-aqua">
                                                <a href="" title="">
                                                    {{ $blog->category->name }}
                                                </a>
                                            </span>
                                            <h4><a href="{{ route('posts.show', ['slug' => $blog->slug]) }}" title="">{{ $blog->title }}</a></h4>
                                            <p>{{ $blog->excerpt }}</p>
                                            <small><i class="fa fa-eye"></i> {{ $blog->views }}</small>
                                            <small>{{ $blog->created_at }}</small>
                                            <small><a href="#" title="">{{ $blog->author }}</a></small>
                                        </div><!-- end meta -->
                                
                                        <hr class="invis">
                                    @empty
                                        <p class="fs-3 text-center">{{ __('home_no_blogs') }}</p>
                                    @endforelse
                                </div>

                                <hr class="invis">
                            </div><!-- end blog-list -->
                        </div><!-- end page-wrapper -->

                        <hr class="invis">

                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-start">
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            <div class="widget">
                                <h2 class="widget-title">Search</h2>
                                <form  action="{{ route('home') }}" method="get" class="form-inline search-form">
                                    <div class="form-group">
                                        <input type="text" value="{{ request('search') }}" id="form1" name="search" class="form-control" placeholder="Search on the site">
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </form>
                            </div><!-- end widget -->
                        </div><!-- end sidebar -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

        {{-- <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="widget">
                            <div class="footer-text text-center">
                                <a href="index.html"><img src="images/version/garden-footer-logo.png" alt="" class="img-fluid"></a>
                                <p>Forest Time is a personal blog for handcrafted, cameramade photography content, fashion styles from independent creatives around the world.</p>
                                <div class="social">
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>              
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google Plus"><i class="fa fa-google-plus"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                                </div>

                                <hr class="invis">

                                <div class="newsletter-widget text-center">
                                    <form class="form-inline">
                                        <input type="text" class="form-control" placeholder="Enter your email address">
                                        <button type="submit" class="btn btn-primary">Subscribe <i class="fa fa-envelope-open-o"></i></button>
                                    </form>
                                </div><!-- end newsletter -->
                            </div><!-- end footer-text -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <br>
                        <br>
                        <div class="copyright">&copy; Forest Time. Design: <a href="http://html.design">HTML Design</a>.</div>
                    </div>
                </div>
            </div><!-- end container -->
        </footer><!-- end footer --> --}}

        <div class="dmtop">Scroll to Top</div>
        
    </div><!-- end wrapper -->

    {{-- <!-- Core JavaScript
    ================================================== -->
    <script src="{{ asset('assets/front-assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/front-assets/js/tether.min.js')}}"></script>
    <script src="{{ asset('assets/front-assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/front-assets/js/custom.js')}}"></script> --}}

</body>
</html>