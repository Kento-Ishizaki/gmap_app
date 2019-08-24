<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gmap App')</title>
    <link rel="stylesheet" href="{{ secure_asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('/css/custom.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.10/font-awesome-animation.css"
        type="text/css" media="all" />
    @yield('styles')
</head>

<body>
    @include('components.header')
    @include('components.alert')
    @yield('content')
    @include('components.footer')
    <script src="{{ secure_asset('/js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
