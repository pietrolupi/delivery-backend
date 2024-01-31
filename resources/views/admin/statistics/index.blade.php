@extends('layouts.admin')

@section('content')



<div class="p-4">
    @include('generals.partials.sessions')

    <h2>Your Statistics:</h2>


    <div class="container">
        <h4 class="pt-3">Search for data relating to the selected month:</h4>
        <form class="d-flex flex-column flex-md-row align-items-center justify-content-center" id="filterForm">
            <div>
                <label for="month" class="form-label m-0">Month:</label>
                <select class="form-select custom" id="month" name="month" >
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="year">Year:</label>
                <select class="form-select custom" id="year" name="year">
                    @for ($year = date('Y'); $year >= 2020; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <button class="btn custom" type="submit">Filter</button>
        </form>


        <div  id="monthlyChartContainer" class="container my-4 p-0">
            <canvas class="bg-light d-none" id="monthlyChart" width="800" height="400"></canvas>
        </div>
        <div class="container my-4 p-0">
            <canvas class="bg-light d-none" id="monthlyChartSales" width="800" height="400"></canvas>
        </div>

    </div>

    <div class="container my-4">
        <!-- Grafico per il numero di ordini -->
        <h4>The total monthly orders for the last 6 months</h4>

            <canvas class="bg-white p-2" id="ordersChart" width="800" height="400"></canvas>

    </div>

    <div class="container my-4">
        <h4>The total monthly sales for the last 6 months</h4>
        <canvas class="bg-white p-2" id="salesChart" width="800" height="400" class="ms-4"></canvas>
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

        var monthlyChart;
        var monthlyChartSales;

        // Funzione per aggiornare il grafico mensile con i dati filtrati
        function updateMonthlyChart(monthlyData) {
            var ctxMonthly = document.getElementById('monthlyChart').getContext('2d');

            // Distruggi il grafico precedente se esiste
            if (monthlyChart) {
                monthlyChart.destroy();
            }

            // Estrai i dati dall'oggetto JSON
            var labels = Object.keys(monthlyData);
            var ordersData = labels.map(function(label) {
                return monthlyData[label].orders;
            });
            var salesData = labels.map(function(label) {
                return monthlyData[label].sales;
            });

            // Crea il nuovo grafico con i dati aggiornati
            monthlyChart = new Chart(ctxMonthly, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'This month\'s orders',
                        data: ordersData,
                        backgroundColor: 'rgba(223, 117, 11, 0.2)',
                        borderColor: 'rgba(223, 117, 11, 1)',
                        borderWidth: 1,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(223, 117, 11, 1)',
                    },]
                },
                options: {
                    scales: {
                        x: {
                            type: 'category',
                            labels: labels,
                            title: {
                                display: true,
                                text: 'Day of the month'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
                            }
                        }
                    }
                }
            });
        }
         // Funzione per aggiornare il grafico mensile con i dati filtrati
         function updateMonthlyChartSales(monthlyData) {
            var ctxMonthly = document.getElementById('monthlyChartSales').getContext('2d');

            // Distruggi il grafico precedente se esiste
            if (monthlyChartSales) {
                monthlyChartSales.destroy();
            }

            // Estrai i dati dall'oggetto JSON
            var labels = Object.keys(monthlyData);
            // var ordersData = labels.map(function(label) {
            //     return monthlyData[label].orders;
            // });
            var salesData = labels.map(function(label) {
                return monthlyData[label].sales;
            });

            // Crea il nuovo grafico con i dati aggiornati
            monthlyChartSales = new Chart(ctxMonthly, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'This month\'s sales',
                        data: salesData,
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
                            labels: labels,
                            title: {
                                display: true,
                                text: 'Day of the month'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
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

            document.getElementById('monthlyChart').classList.remove('d-none');

            // Esegui una richiesta AJAX per ottenere i dati del mese selezionato
            fetch('/get-monthly-data', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                updateMonthlyChart(data.monthlyData);
            })
            .catch(error => {
                console.error('Errore durante la richiesta AJAX:', error);
            });
        });
         // Intercetta l'invio del form e invia una richiesta AJAX
         document.getElementById('filterForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            // Aggiungi il token CSRF ai dati del modulo
            formData.append('_token', '{{ csrf_token() }}');

            document.getElementById('monthlyChartSales').classList.remove('d-none');

            // Esegui una richiesta AJAX per ottenere i dati del mese selezionato
            fetch('/get-monthly-data', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                updateMonthlyChartSales(data.monthlyData);
            })
            .catch(error => {
                console.error('Errore durante la richiesta AJAX:', error);
            });
        });
    </script>
    <style lang="scss" scoped>
        #ordersChart,
        #salesChart {
            max-width: 1000px;
            max-height: 500px;
        }
        #monthlyChart,
        #monthlyChartSales {
            max-width: 1000px;
            max-height: 400px;
        }

        .form-select.custom{
            width: 120px;
            display: inline-block;
            height: 35px;
            margin-right: 10px
        }
        .btn.custom{

            background-color: #df750b;
            color: white;
            border: 1px solid #df750b5d;
            height: 33px
        }
    </style>
</div>
@endsection
