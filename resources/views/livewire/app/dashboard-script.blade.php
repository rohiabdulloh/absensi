<script>
const setupDashboard = () => {
    //pengaturan bar chart
    const pieChart = new Chart(document.getElementById('pieChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: [1,2,3,4,5,6,8,9,10],
            datasets: [
                {
                    label: 'Sakit',
                    data: [32, 20, 30, 50, 40, 39, 30, 50, 40, 39],
                    backgroundColor: 'rgb(221, 139, 31)',
                },
                {
                    label: 'Ijin',
                    data: [32, 20, 39, 30, 50, 40, 39,30, 50, 40],
                    backgroundColor: 'rgb(196, 45, 241)',
                },
                {
                    label: 'Tanpa Keterangan',
                    data: [32, 30, 50, 40, 39, 20, 30, 50, 40, 39],
                    backgroundColor: 'rgb(196, 41, 21)',
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