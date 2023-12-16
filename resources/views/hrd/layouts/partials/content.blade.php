<style>
    .chart-container {
        position: relative;
        display: flex;
        justify-content: center;
    }

    .chart-legend {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
    }
</style>

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Karyawan</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalPegawai }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Rata-rata Skor</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($rataRataSkor, 2) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Rata-rata Skor Penilaian</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($rataRataSkorNilai, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
      
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Chart Title</h4>
                    </div>
                    <div class="card-body">
                        <!-- Reduce canvas height and width -->
                        <div class="chart-container">
                            <canvas id="myChart4" style="max-height: 300px; max-width: 300px;"></canvas>
                            <div class="chart-legend"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Top 10 Scores</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody id="topScoresTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetchChartData();
        fetchTopScores();
    });

    function fetchChartData() {
        fetch("{{ route('hrd.dashboard.data') }}")
            .then(response => response.json())
            .then(data => createChart(data));
    }

    function createChart(data) {
        var ctx = document.getElementById('myChart4').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.values,
                    backgroundColor: [
                        '#191d21',
                        '#63ed7a',
                        '#ffa426',
                        '#fc544b',
                        '#6777ef',
                        '#ff69b4',
                        '#32cd32',
                        '#ffd700',
                        '#9400d3',
                        '#ffa07a',
                    ],
                                    }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false, // Sembunyikan legenda bawaan
                },
            },
        });

        // Tambahkan label di sebelah kanan
        var legend = myChart.generateLegend();
        document.querySelector('.chart-legend').innerHTML = legend;
    }

    function fetchTopScores() {
        fetch("{{ route('hrd.dashboard.top_scores') }}")
            .then(response => response.json())
            .then(data => populateTopScoresTable(data));
    }

    function populateTopScoresTable(data) {
        var tableBody = document.getElementById('topScoresTableBody');
        tableBody.innerHTML = '';

        data.forEach((item, index) => {
            var row = `<tr>
                            <td>${index + 1}</td>
                            <td>${item.nama_pegawai}</td>
                            <td>${item.total_score}</td>
                    </tr>`;
            tableBody.innerHTML += row;
        });
    }

</script>
