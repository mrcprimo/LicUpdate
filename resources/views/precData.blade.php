@include('includes.head')

<body>
    @include('components.navbar')
    <div class="container-fluid">
        <h3 class="text-primary fw-bold mb-3">Precipitation Data</h3>
        <div class="card mb-3">
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</body>
@include('scripts.script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('myChart').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'line', // Line chart type
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], // X-axis labels
                datasets: [{
                    label: 'Precipitation Data',
                    data: dataLastYear,
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>