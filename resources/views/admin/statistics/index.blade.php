@extends('layouts.admin')

@section('content')
    @include('generals.partials.sessions')


    <h2>Your Statistics:</h2>

    <div class="container my-4">
        <!-- Grafico per il numero di ordini -->
        <h4>- The total monthly orders for the last 12 months</h4>
        <canvas id="ordersChart" width="800" height="400"></canvas>
    </div>

    <div class="container">
        <h4>- The total monthly sales for the last 12 months</h4>
        <canvas id="salesChart" width="800" height="400" class="ms-4"></canvas>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var monthlyOrders = {!! json_encode($monthlyOrders) !!};

        // Utilizza i dati per inizializzare e aggiornare il grafico
        var ctxOrders = document.getElementById('ordersChart').getContext('2d');
        var ordersChart = new Chart(ctxOrders, {
            type: 'line',
            data: {
                labels: Object.keys(monthlyOrders),
                datasets: [{
                    label: 'Amount of monthly orders',
                    data: Object.values(monthlyOrders),
                    backgroundColor: 'rgba(223, 117, 11, 0.2)',
                    borderColor: 'rgba(223, 117, 11, 1)',
                    borderWidth: 1,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(223, 117, 11, 1)',
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        labels: Object.keys(monthlyOrders),
                        title: {
                            display: true,
                            text: 'Year/Month'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Order Count'
                        },
                        stepSize: 1,
                    }
                }
            }
        });
    </script>
    <script>
        var monthlySales = {!! json_encode($monthlySales) !!};

        var ctxSales = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctxSales, {
            type: 'line',
            data: {
                labels: Object.keys(monthlySales),
                datasets: [{
                    label: 'Amount of monthly sales',
                    data: Object.values(monthlySales),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        labels: Object.keys(monthlySales),
                        title: {
                            display: true,
                            text: 'Year/Month'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Sales'
                        },
                        // Aggiungi altre opzioni se necessario
                    }
                }
            }
        });
    </script>
    <style>
        #ordersChart,
        #salesChart {
            max-width: 1000px;
            max-height: 500px
        }
    </style>

@endsection
