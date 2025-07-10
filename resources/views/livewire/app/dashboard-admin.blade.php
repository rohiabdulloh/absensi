<div>
    <div x-data="setupDashboard()" class="h-full flex flex-col space-y-3">
    
        <!-- Menampilkan card sesuai dengan data $card -->
       <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($widget as $w)
                <div class="relative h-40 {{ $w['color'] }} rounded-md overflow-hidden shadow-lg transform transition-all duration-300 ease-in-out hover:scale-[1.05] hover:shadow-xl group">
                    <div class="absolute inset-y-0 left-0 w-1/2 flex items-center justify-start pl-4 opacity-20 group-hover:opacity-30 transition-opacity duration-300 ease-in-out">
                        <div class="text-9xl text-white">
                            {{ view('components.icon-md', ['name' => $w['icon']]) }}
                        </div>
                    </div>

                    <div class="relative z-10 p-6 text-white text-right">
                        <div class="text-5xl md:text-6xl font-extrabold text-white leading-none drop-shadow-md">
                            {{ $w['data'] }}
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 py-2 px-6 bg-black bg-opacity-30 backdrop-blur-sm text-white text-base font-semibold uppercase text-center 
                                group-hover:bg-opacity-50 transition-all duration-300 ease-in-out">
                        {{ $w['label'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-4">            
            <div class="md:col-span-3">   
                <div class="rounded-md bg-white dark:bg-gray-800">
                    <div class="flex flex-row items-center p-4 space-x-3">
                        <x-fas-house-user class="w-5 h-5"/> <span class="text-lg"> Data siswa Absen</span>
                    </div>
                    <div class="py-8 px-8 md:px-32">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
            <div>   
                <div class="rounded-md bg-white dark:bg-gray-800">
                    <div class="flex flex-col md:flex-row md:items-center p-4 justify-between">
                        <div class="flex flex-row items-center space-x-3">
                            <x-fas-calendar class="w-5 h-5"/> <span class="text-lg"> Siswa Absen Hari Ini </span>
                        </div>
                    </div>
                    <div class="h-60"></div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.app.dashboard-script') 
</div>