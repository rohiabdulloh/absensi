<script>
const setupDashboard = () => {
    //pengaturan bar chart
    const pieChart = new Chart(document.getElementById('pieChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels:  @json($label),
            datasets: [
                {
                    label: 'Sakit',
                    data: @json($sakit),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'  
                },
                {
                    label: 'Izin',
                    data: @json($izin),
                    backgroundColor: 'rgba(153, 102, 255, 0.6)'
                },
                {
                    label: 'Alfa',
                    data: @json($alfa),
                    backgroundColor: 'rgba(255, 99, 132, 0.6)'
                }
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

};
</script>