<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="MyFPL offers game predictions, promising player data, and in-depth stats to help you dominate your Fantasy Premier League.">
        <meta name="keywords" content="Fantasy Premier League, FPL, game predictions, player stats, Fantasy Football, player data, FPL analytics, MyFPL">

        <meta name="robots" content="index, follow">
        <meta name="author" content="Illusion">

        <link rel="canonical" href="https://www.myfpl.org/player/{{ $player->id }}">

        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="MyFPL | {{ $player->first_name }} {{ $player->second_name }}">
        <meta property="og:description" content="Gain the edge in your Fantasy Premier League with game predictions, promising player data, and comprehensive stats using MyFPL.">
        <meta property="og:url" content="https://www.myfpl.org/player/{{ $player->id }}">
        <meta property="og:type" content="website">

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="MyFPL | {{ $player->first_name }} {{ $player->second_name }}">
        <meta name="twitter:description" content="Gain the edge in your Fantasy Premier League with game predictions, promising player data, and comprehensive stats using MyFPL.">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <!-- Content Language -->
        <meta http-equiv="Content-Language" content="en">

        <!-- X-UA-Compatible for IE -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>MyFPL | {{ $player->first_name }} {{ $player->second_name }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    </head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TSGKWQ9HGM"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-TSGKWQ9HGM');
    </script>

    <body class="font-sans antialiased">

        <x-header.navigation />

            @livewire('players.player-view-component', ['data' => $player]);

    </body>

</html>
