<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/svg+xml" href="/img/reshot-icon-food-addiction-KME7TXCDG4.svg" />
        <title>{{ config('app.name', 'DeliveBoo') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @include('generals.partials.header')
        <div class="cs-container d-flex">
            @yield('content')
        </div>
    </body>
</html>
