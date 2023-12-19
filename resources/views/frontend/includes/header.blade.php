<div class="header-section page-title wb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="logo d-flex justify-content-center align-items-center">
                    <a href="{{route('home')}}"><h2><i class="fa fa-leaf bg-green"></i> Bloggify</h2>
                    </a>
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
                            <a class="nav-link color-green-hover" href="{{ route('home',['category' => $category->slug])}}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div><!-- end container -->
</header>