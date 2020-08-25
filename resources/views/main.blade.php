<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <!-- Extra Content for Head -->
        @stack('extra-head-content')

        <title>@stack('title')</title>

        <!-- Fonts -->
        <link 
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Orbitron:wght@400;700;800&display=swap" 
            rel="stylesheet"
        >

        <!-- Global CSS styles -->
        <style>
            html, 
            body {
                font-size: 14pt;
                height: 100vh;
            }

            * {
                margin: 0;
                padding: 0;
            }

            #root {
                --color-primary-darker: #455A64;
                --color-primary: #607D8B; 
                height: 100vh;
                font-family: 'Montserrat';
            }

            a {
                text-decoration: none;
                color: inherit;
            }

            a:active {
                text-decoration: none;
                color: inherit;
            }

            a:hover {
                text-decoration: none;
                color: inherit;
            }
        </style>

        <!-- Extra CSS styles -->
        @stack('extra-css')
    </head>
    <body>
        <div id="root">@yield('content')</div>
        @stack('scripts')
    </body>

</html>