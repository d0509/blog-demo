 @extends('frontend.master.layout')
 @section('contentHeader')
     <title> {{ env('APP_NAME') }} </title>
     <style>
         .loader-container {
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background-color: rgba(0, 0, 0, 0.5);
             z-index: 9999;
         }

         .loader {
             position: absolute;
             top: 50%;
             left: 50%;
             transform: translate(-50%, -50%);
             border: 5px solid #f3f3f3;
             border-top: 5px solid #007bff;
             border-radius: 50%;
             width: 50px;
             height: 50px;
             animation: spin 2s linear infinite;
         }

         @keyframes spin {
             0% {
                 transform: translate(-50%, -50%) rotate(0deg);
             }

             100% {
                 transform: translate(-50%, -50%) rotate(360deg);
             }
         }
     </style>
 @endsection

 @section('content')
     <x-loader>
     </x-loader>
     <div id="wrapper">
         <div class="collapse top-search" id="collapseExample">
             <div class="card card-block">
                 <div class="newsletter-widget text-center">
                 </div><!-- end newsletter -->
             </div>
         </div><!-- end top-search -->

         <section class="section wb">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                         <div class="page-wrapper">
                             <div class="blog-list clearfix">
                                 <div class="row justify-content-center" id="searchResults">
                                     @forelse ($blogs as $blog)
                                         <div class="col-md-4 mt-2">
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

                                             @foreach ($blog->tags as $tag)
                                                 <span class="bg-aqua mr-1">
                                                     <a href="" title="">
                                                         {{ $tag->name }}
                                                     </a>
                                                 </span>
                                             @endforeach


                                             <h4><a href="{{ route('posts.show', ['slug' => $blog->slug]) }}"
                                                     title="">{{ $blog->title }}</a></h4>
                                             <p>{{ $blog->excerpt }}</p>
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
                                         <input type="text" value="{{ request('q') }}" id="form1" name="q"
                                             class="form-control" placeholder="Search Blog Title">
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
 @section('contentfooter')
     <script>
         $(document).ready(function() {
             // This code ensures that the loader stays visible until the entire page is loaded.
             var loaderContainer = $('.loader-container');
             if (loaderContainer.length) {
                 loaderContainer.hide();
             }
         });
     </script>
 @endsection
