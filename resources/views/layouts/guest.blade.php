<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
		<link rel="shortcut icon" type="image/png" href="{{ url(asset('storage/setting/favicon.png')) }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('js/theme.js') }}"></script>
    </head>
    <body>
        <div x-data="setup()" :class="{ 'dark': isDark }" class="relative min-h-screen overflow-hidden">
    
            <!-- Background Gradient Layer -->
            <div class="absolute inset-0 z-0">
                <!-- Light mode background with blur circles -->
                <div class="dark:hidden relative w-full h-full bg-gradient-to-br from-blue-100 via-white to-indigo-100">
                    <div class="absolute w-72 h-72 bg-purple-300 opacity-30 rounded-full filter blur-3xl top-10 left-10 animate-pulse"></div>
                    <div class="absolute w-80 h-80 bg-pink-200 opacity-20 rounded-full filter blur-3xl bottom-0 right-0 animate-pulse"></div>
                </div>

                <!-- Dark mode background with dark gradients -->
                <div class="hidden dark:block relative w-full h-full bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700">
                    <div class="absolute w-72 h-72 bg-blue-700 opacity-20 rounded-full filter blur-3xl top-10 left-10 animate-pulse"></div>
                    <div class="absolute w-80 h-80 bg-indigo-800 opacity-20 rounded-full filter blur-3xl bottom-0 right-0 animate-pulse"></div>
                </div>
            </div>

            <!-- Main content -->
            <div class="relative z-10 font-sans text-gray-900 dark:text-gray-100 antialiased">
                {{ $slot }}
            </div>
        </div>
    </body>

</html>
