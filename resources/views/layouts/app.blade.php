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
   </head>
   <body>
      <div x-data="setup()" 
            x-init="$refs.loading.classList.add('hidden');" 
            :class="{ 'dark': isDark}"
        >

         <div x-ref="loading"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-100 dark:bg-gray-900"
         >
            <div class="relative w-50 h-50">
               <div class="absolute animate-spin w-50 h-50 border-1 border-t-2 rounded-full border-primary"></div>
                              
            </div>
         </div>

         <div class="flex w-screen h-screen overflow-hidden text-gray bg-gray-100 
            dark:bg-gray-900 dark:text-light">
            @role('superadmin')
               @include('layouts.sidebar-admin') 
            @endif

            @role('siswa')
               @include('layouts.sidebar-student') 
            @endif

            <div class="flex-1 overflow-hidden">
               <div class="flex flex-col h-screen">
                  <header>
                     @if(Auth::user()->hasRole('siswa'))
                        @include('layouts.header-front')
                     @elseif(Auth::user()->hasRole(['superadmin', 'guru']))
                        @include('layouts.header')  
                     @endif            
                  </header>

                  <main class="flex-1 px-4 py-4 overflow-y-auto">            
                     {{ $slot }}
                  </main>

                  @role('siswa')
                     <nav>
                        @include('layouts.bottom-navigation')
                     </nav>
                  @endrole 
               </div> 
            </div> 
            
         </div>   
      </div>
   </body>
</html>
