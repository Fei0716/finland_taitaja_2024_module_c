<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hall of Fame's Intranet</title>

{{--    bootstrap css--}}
    <link rel="stylesheet" href="{{asset('storage/bootstrap/css/bootstrap.min.css')}}">
    @yield('style')
</head>
<body>
    @include('layout.nav')
    <main class="container" role="main">
       @yield('content')
    </main>
{{--  bootstrap js--}}
    <script src="{{asset('storage/bootstrap/js/bootstrap.min.js')}}"></script>
    @yield('js')
</body>
</html>
