<!DOCTYPE html>
<html lang="en">

<head>
    @yield('contentHeader')
    @include('frontend.includes.head')
</head>

<body>
    @include('frontend.includes.header')

    @yield('content')

    @include('frontend.includes.footer')
    @include('frontend.includes.script')

    @yield('contentfooter')
</body>

</html>
