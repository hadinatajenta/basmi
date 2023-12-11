<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="/css/styles.css">
    <!--CSS-->
    <style>
        body{
            width: 100%;
            height: 100vh;
        }
        #app{
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex align-items-center justify-content-center">
        <main class=" py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>