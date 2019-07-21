<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Map Date')</title>
    <link rel="stylesheet" href="{{ secure_asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('/css/bootstrap.min.css') }}">
    @yield('styles')
</head>
<body>
    @include('components.header')
    @yield('content')
    @include('components.footer')
    <script src="{{ secure_asset('/js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>