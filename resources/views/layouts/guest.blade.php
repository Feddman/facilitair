<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased min-h-screen"
    style="
background: hsla(44, 100%, 91%, 1);

background: linear-gradient(270deg, hsla(44, 100%, 91%, 1) 0%, hsla(0, 0%, 100%, 1) 100%);

background: -moz-linear-gradient(270deg, hsla(44, 100%, 91%, 1) 0%, hsla(0, 0%, 100%, 1) 100%);

background: -webkit-linear-gradient(270deg, hsla(44, 100%, 91%, 1) 0%, hsla(0, 0%, 100%, 1) 100%);

filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#FFF3D3", endColorstr="#FFFFFF", GradientType=1 );
    "
    >
        <x-navigation />
        {{ $slot }}
    </body>
    @livewireScripts
</html>
