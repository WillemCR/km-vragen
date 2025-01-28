<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body class="bg-gray-100 font-sans">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-indigo-600">Uw enquete resultaten</h1>

    <div class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto">
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Eindscore:</h2>
            <p class="text-2xl text-center text-green-600">{{ $averagePercentage }}%</p>
        </div>

        <h2 class="text-xl font-semibold mb-4">Scores per Pilaar:</h2>
        <ul class="space-y-2">
            @foreach ($pillarScores as $pillar => $score)
                <li class="border-b pb-2">
                    <strong>{{ $pillar }}:</strong> {{ $score }}%
                </li>
            @endforeach
        </ul>

        <!-- Chart Container -->
        <div class="mt-6">
            <canvas id="pillarScoresChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('pillarScoresChart').getContext('2d');
        var pillarScores = @json($pillarScores);

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(pillarScores),
                datasets: [{
                    label: 'Score (%)',
                    data: Object.values(pillarScores),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value, index, values) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
</body>
</html>
</x-app-layout>
