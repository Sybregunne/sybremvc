<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        @yield('stylesheets')
    </head>
    <body>
        @yield('prescript')
        @yield('header')
        @yield('nav')
        @yield('main')
        @yield('footer')
        <script src="/js/popper.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        @yield('postscript')
    </body>
</html>