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
      <script src="{{ asset('js/theme.js') }}" defer></script>

      @stack('styles')
   </head>
   <body>
      <div x-data="setup()" 
         x-init="$refs.loading.classList.add('hidden')" 
         :class="{ 'dark': isDark }"
         class="relative min-h-screen"
      >
         <!-- LOADING SCREEN -->
         <div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center bg-white dark:bg-gray-900 transition-opacity duration-500">
            <div class="relative w-16 h-16">
                  <div class="absolute inset-0 border-4 border-blue-300 border-t-blue-600 rounded-full animate-spin"></div>
            </div>
         </div>

         <!-- BACKGROUND EFFECT (Optional aesthetic glow) -->
         <div class="absolute inset-0 z-0">
            <!-- Light Mode -->
            <div class="dark:hidden absolute w-full h-full bg-gradient-to-br from-blue-50 to-indigo-100">
                  <div class="absolute w-72 h-72 bg-indigo-200 opacity-30 rounded-full blur-3xl top-10 left-10 animate-pulse"></div>
                  <div class="absolute w-80 h-80 bg-pink-100 opacity-20 rounded-full blur-3xl bottom-0 right-0 animate-pulse"></div>
            </div>
            <!-- Dark Mode -->
            <div class="hidden dark:block absolute w-full h-full bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700">
                  <div class="absolute w-72 h-72 bg-blue-800 opacity-20 rounded-full blur-3xl top-10 left-10 animate-pulse"></div>
                  <div class="absolute w-80 h-80 bg-indigo-900 opacity-10 rounded-full blur-3xl bottom-0 right-0 animate-pulse"></div>
            </div>
         </div>

         <!-- MAIN LAYOUT -->
         <div class="relative z-10 flex w-screen h-screen overflow-hidden text-gray-800 dark:text-gray-100">
            <!-- Sidebar -->
            @role('superadmin')
                  @include('layouts.sidebar-admin') 
            @endif

            @role('siswa')
                  @include('layouts.sidebar-student') 
            @endif
            
            @role('guru')
                  @include('layouts.sidebar-teacher') 
            @endif

            <!-- Main Content -->
            <div class="flex-1 overflow-hidden backdrop-blur-md bg-white/70 dark:bg-gray-900/80">
                  <div class="flex flex-col h-screen">
                     
                     <!-- Header -->
                     <header class="backdrop-blur bg-white/50 dark:bg-gray-800/50 shadow-sm sticky top-0 z-20">
                        @if(Auth::user()->hasRole(['siswa', 'guru']))
                              @include('layouts.header-front')
                        @elseif(Auth::user()->hasRole('superadmin'))
                              @include('layouts.header')  
                        @endif            
                     </header>

                     <!-- Content -->
                     <main class="flex-1 px-4 py-6 overflow-y-auto">
                        {{ $slot }}
                     </main>

                     <!-- Bottom Nav -->
                     @role('siswa')
                        <nav class="border-t border-gray-200 dark:border-gray-700">
                              @include('layouts.navigation-student')
                        </nav>
                     @endrole 

                     
                     @role('guru')
                        <nav class="border-t border-gray-200 dark:border-gray-700">
                              @include('layouts.navigation-teacher')
                        </nav>
                     @endrole 

                  </div> 
            </div> 
         </div>
      </div>

      
      @stack('scripts')
   </body>
</html>
