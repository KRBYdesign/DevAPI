<!DOCTYPE html>
<html lang='en' data-theme="dark">
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>IT Ticketing System {{ isset($title) ? " | " . $title : "" }}</title>

        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    </head>
    <body>

        @yield('main')

    </body>
</html>
