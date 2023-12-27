<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 100px;
            background: #f3f3f3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;

        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            border: none;
        }

        .post-media img {
            max-width: 100%;
            height: auto;
        }

        .post-media {
            width: 300px;
            max-width: 152px;
        }

        .blog-meta {
            box-sizing: border-box;
        }

        hr.invis {
            border: none;
            height: 1px;
            color: #ccc;
            background-color: #ccc;
            margin: 20px 0;
        }

        .title {
            max-width: 335px;
            margin: 0 auto;
            font-size: 26px;
        }

        .blogs {
            max-width: 900px;
            margin: 0 auto;
        }

        .image-box {
            float: inline-start;
        }

        .blog-box {
            display: inline-block;
            margin: 0 0 0 20px;
        }

        .image {
            width: 200px;
        }

        .two-lines {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Limit the number of lines to 2 */
            -webkit-box-orient: vertical;
        }

        .blog-meta {
            max-width: 400px;
        }

        #category {
            background: #3db081;
            color: white;
            font-size: 12px;
            padding: 4px;
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="2"><h3>Read our latest blogs</h3></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($blogs as $blog)
            {{-- {{ dump($blog->media[0]->filename)}} --}}
                <tr>
                    <td class="post-media">
                        @if ($blog->media->isNotEmpty())
                       
                        {{-- {{dd($blog->media[0]->filename)}} --}}
                            <img width="300px"
                           {{-- {{ dd(public_path() . $image_path);}} --}}
                                src="{{ asset('storage/banner/' . $blog->media[0]->filename . '.' . $blog->media[0]->extension) }}"
                                alt="" class="img-fluid">
                         @else 
                        <img width="300px"
                            src="https://images.pexels.com/photos/1342609/pexels-photo-1342609.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt="">
                        @endif  
                        {{-- <img width="300px"
                            src="https://images.pexels.com/photos/1342609/pexels-photo-1342609.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt=""> --}}
                    </td><!-- end post-media -->
                    <td class="blog-meta">
                        <span class="bg-aqua">
                            <a href="#" title="" id="category"
                                style="text-decoration: none">{{ $blog->category->name }}</a>
                        </span>
                        </h4>
                        <h4><a style="text-decoration: none;color:black;"
                                href="{{ route('posts.show', ['slug' => $blog->slug]) }}"
                                title="">{{ $blog->title }}</a>
                            <p class="two-lines" style="font-size: 14px;
                            font-weight: 100;">{!! Str::limit(strip_tags($blog->description), 200) !!}</p>
                            <small><a href="#" title=""
                                    style="text-decoration: none">{{ $blog->author }}</a></small>
                    </td><!-- end blog-meta -->
                </tr>
                <tr>
                    <td colspan="2">
                        <hr class="invis">
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">
                        <h1 class="fs-3"> No blogs found </h1>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
