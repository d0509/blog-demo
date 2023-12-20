 @extends('frontend.master.layout')
 @section('contentHeader')
     <title> {{ env('APP_NAME') }} </title>
 @endsection

 @section('content')
     <div id="wrapper">
         <div class="collapse top-search" id="collapseExample">
             <div class="card card-block">
                 <div class="newsletter-widget text-center">
                 </div><!-- end newsletter -->
             </div>
         </div><!-- end top-search -->


         {{-- <div class="header-section page-title wb">
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
                                <a @if (Request::segment(1) == $category->slug) class="nav-link" style="color:green;"
                               @else
                               class="nav-link  color-green-hover" @endif
                                    href="{{ route('home', ['category' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div><!-- end container -->
    </header><!-- end header --> --}}

         <section class="section wb">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                         <div class="page-wrapper">
                             <div class="blog-list clearfix">
                                 <div class="row justify-content-center" id="searchResults">
                                     @forelse ($blogs as $blog)
                                         <div class="col-md-4">
                                             <div class="post-media">
                                                 <a href="{{ route('posts.show', ['slug' => $blog->slug]) }}"
                                                     title="">
                                                     @forelse ($blog->media as $item)
                                                         <img src="{{ asset('storage/banner/' . $item['filename'] . '.' . $item['extension']) }}"
                                                             alt="" class="img-fluid">
                                                     @empty
                                                         <p class="fs-3 text-center">Given Blog doesn't have any image
                                                         </p>
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
                                             <h4><a href="{{ route('posts.show', ['slug' => $blog->slug]) }}"
                                                     title="">{{ $blog->title }}</a></h4>
                                             <p>{{ $blog->excerpt }}</p>
                                             {{-- <small><i class="fa fa-eye"></i> {{ $blog->views }}</small> --}}
                                             <small>{{ $blog->created_at }}</small>
                                             <small><a href="#" title="">{{ $blog->author }}</a></small>
                                         </div><!-- end meta -->

                                         <hr class="invis">
                                     @empty

                                         <h1 class="fs-3"> No blogs found </h1>
                                     @endforelse
                                 </div>

                                 <hr class="invis">
                             </div><!-- end blog-list -->
                         </div><!-- end page-wrapper -->

                         <hr class="invis">


                     </div><!-- end col -->

                     <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                         <div class="sidebar">
                             <div class="widget">
                                 <h2 class="widget-title">Search</h2>
                                 <form action="{{ route('home') }}" method="get" class="form-inline search-form">
                                     <div class="form-group">
                                         <input type="text" value="{{ request('search') }}" id="form1"
                                             name="search" class="form-control" placeholder="Search Blog Title">
                                     </div>
                                     <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                 </form>
                             </div><!-- end widget -->
                         </div><!-- end sidebar -->
                     </div><!-- end col -->
                 </div><!-- end row -->
             </div><!-- end container -->
         </section>


         <div class="dmtop">Scroll to Top</div>

     </div><!-- end wrapper -->
 @endsection
