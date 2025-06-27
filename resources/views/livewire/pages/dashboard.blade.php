<div>
    <div x-data="setupDashboard()" class="h-full flex flex-col space-y-3">
    
        <!-- Menampilkan card sesuai dengan data $card -->
        <div class="mt-3 grid grid-cols-1 gap-4 md:grid-cols-4">            
            @foreach($widget as $w)
                <div class="h-36 p-4 rounded-md {{$w['color']}} text-right flex flex-row justify-between">  
                    <div class="flex flex-col">  
                        <div class="text-white">
                            {{view('components.icon-md',['name'=>$w['icon']])}}
                        </div>            
                        <h6 class="text-lg leading-none z-20 text-white mt-2">
                            {{$w['label']}}
                        </h6>
                    </div>
                    <div class="text-5xl text-white font-semibold rounded-md px-8 py-4 m-3 {{$w['label-color']}}">{{$w['data']}}</div>                        
                </div>
            @endforeach
        </div>

        <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-4">            
            <div class="md:col-span-3">   
                <div class="rounded-md bg-white dark:bg-gray-800">
                    <div class="flex flex-row items-center p-4 space-x-3">
                        <x-fas-house-user class="w-5 h-5"/> <span class="text-lg"> Pengajuan PKL Tiap Jurusan </span>
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
                            <x-fas-calendar class="w-5 h-5"/> <span class="text-lg"> Data Pengajuan Terbaru </span>
                        </div>
                    </div>
                    <div class="h-60"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
const setupDashboard = () => {
    //pengaturan bar chart
    const pieChart = new Chart(document.getElementById('pieChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ["TKJ", "RPL", "MP", "BDP", "AK", "DKV"],
            datasets: [
                {
                    label: ["Data Pengajuan"],
                    data: [32, 20, 30, 50, 40, 39],
                    backgroundColor: ['rgb(59,130,246)', 'rgb(221, 139, 31)', 'rgb(26, 163, 14)', 'rgb(196, 45, 241)', 'rgb(196, 41, 21)', 'rgb(79, 15, 95)'],
                },
            ],
        },
        options: {
            radius: '80%',
            legend: {
                display: true,
            },
            plugins: {legend:{position: 'bottom'}},
        }
    })

    const barChart = new Chart(document.getElementById('barChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: @json($label),
            datasets: @json($chart),
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            },
            legend: {
                display: false,
            },
        }
    })
};
</script>
</div>