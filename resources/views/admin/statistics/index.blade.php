@extends('layouts.admin')

@section('content')
    @include('generals.partials.sessions')


    <h2>Your Statistics:</h2>

    <div class="container my-4">
        <!-- Grafico per il numero di ordini -->
        <h4>The total monthly orders for the last 12 months</h4>
        <canvas id="ordersChart" width="800" height="400"></canvas>
    </div>

    <div class="container my-4">
        <h4>The total monthly sales for the last 12 months</h4>
        <canvas id="salesChart" width="800" height="400" class="ms-4"></canvas>
    </div>

    <div class="container">

        <form id="filterForm">
            <label for="month" class="form-label">Seleziona il mese:</label>
            <select id="month" name="month" class="">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>

            <label for="year">Seleziona l'anno:</label>
            <select id="year" name="year">
                @for ($year = date('Y'); $year >= 2020; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>

            <button type="submit">Filtra</button>
        </form>

        <div id="monthlyChartContainer" class="container my-4">
            <h4>Data relating to the selected month</h4>
            <canvas id="monthlyChart" width="800" height="400"></canvas>
        </div>

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
                    }
                }
            }
        });
    </script>
    <script>
        // Variabile globale per memorizzare l'istanza del grafico mensile
        var monthlyChart;

        // Funzione per aggiornare il grafico mensile con i dati filtrati
        function updateMonthlyChart(monthlyData) {
            var ctxMonthly = document.getElementById('monthlyChart').getContext('2d');

            // Distruggi il grafico precedente se esiste
            if (monthlyChart) {
                monthlyChart.destroy();
            }

            // Crea il nuovo grafico con i dati aggiornati
            monthlyChart = new Chart(ctxMonthly, {
                type: 'line',
                data: {
                    labels: Object.keys(monthlyData),
                    datasets: [{
                        label: 'This month\'s orders',
                        data: Object.values(monthlyData),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'category',
                            labels: Object.keys(monthlyData),
                            title: {
                                display: true,
                                text: 'Day of the month'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Order Count'
                            }
                        }
                    }
                }
            });
        }

        // Intercetta l'invio del form e invia una richiesta AJAX
        document.getElementById('filterForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            // Aggiungi il token CSRF ai dati del modulo
            formData.append('_token', '{{ csrf_token() }}');

            // Esegui una richiesta AJAX per ottenere i dati del mese selezionato
            fetch('/get-monthly-data', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                updateMonthlyChart(data);
            })
            .catch(error => {
                console.error('Errore durante la richiesta AJAX:', error);
            });
        });
    </script>
    <style>
        #ordersChart,
        #salesChart,
        #monthlyChart {
            max-width: 1000px;
            max-height: 500px
        }
    </style>

@endsection
