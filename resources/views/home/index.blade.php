@extends('layouts.sidebar')

@section('content')
    <div class="container mt-2">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title text-2xl">Диаграмма успешных сделок</h5>
                <canvas id="routesChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/chart')
                .then(response => response.json())
                .then(data => {
                    var ctx = document.getElementById('routesChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.map(item => getMonthName(item.month)),
                            datasets: [{
                                data: data.map(item => item.count),
                                backgroundColor: ['#3498db', '#95a5a6', '#34495e', '#7f8c8d', '#2980b9', '#bdc3c7', '#2c3e50', '#ecf0f1', '#1abc9c', '#95a5a6', '#3498db', '#7f8c8d'],
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    stepSize: 1
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            title: {
                                display: true,
                                text: 'Number of Accepted Routes by Month',
                                fontSize: 16
                            }
                        }
                    });
                });
        });

        function getMonthName(month) {
            const months = [
                'January', 'February', 'March', 'April',
                'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December'
            ];

            return months[month - 1];
        }
    </script>
@endsection
