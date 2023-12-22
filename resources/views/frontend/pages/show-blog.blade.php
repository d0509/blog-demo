@extends('frontend.master.layout')
@section('contentHeader')
        <title> {{ env('APP_NAME') }} | {{ $post->title }} </title>
@endsection
@section('content')
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
                    <div id="comments-container" class="mt-5"></div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>


    <div class="dmtop">Scroll to Top</div>

    </div>
@endsection
@section('contentfooter')
<script>
    $('#comments-container').comments({
  profilePictureURL: 'https://viima-app.s3.amazonaws.com/media/public/defaults/user-icon.png',
  getComments: function(success, error) {
    var commentsArray = [{
      id: 1,
      created: '2015-10-01',
      content: 'Lorem ipsum dolort sit amet',
      fullname: 'Simon Powell',
      upvote_count: 2,
      user_has_upvoted: false
    }];
    success(commentsArray);
  }
});
</script>
@endsection