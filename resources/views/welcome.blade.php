<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
       <div class="bg-primary hover:bg-primary-dark text-end py-5 pr-8 bg-purple-500 bg-blue-500 
            bg-red-500 bg-green-500 bg-gray-500
            bg-purple-400 bg-blue-400 bg-green-400 bg-red-400 bg-red-100 bg-amber-500 bg-amber-400
            bg-blue-300
            text-purple-500 text-blue-500 text-green-500 text-red-500 ">
        </div>
    </body>
</html>
