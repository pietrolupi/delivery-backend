@extends('layouts.admin')

@section('content')
    @include('generals.partials.sessions')


    <h2>Your Statistics:</h2>

     {{-- <!-- Aggiungi il form per il filtro -->
     <form action="{{ route('admin.statistics.index') }}" method="get">
        <label for="filter_year">Select Year:</label>
        <select name="filter_year" id="filter_year">
            @for ($year = $currentYear; $year >= $currentYear - 10; $year--)
                <option value="{{ $year }}" {{ ($year == $currentYear) ? 'selected' : '' }}>{{ $year }}</option>
            @endfor
        </select>

        <button type="submit">Filter</button>
    </form> --}}

    <!-- Grafico per il numero di ordini -->
    <canvas id="ordersChart" width="800" height="400"></canvas>

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
                    label: 'Order Count',
                    data: Object.values(monthlyOrders),
                    backgroundColor: 'rgba(223, 117, 11, 0.2)',
                    borderColor: 'rgba(223, 117, 11, 1)',
                    borderWidth: 1,
                    pointRadius: 5, // Aggiungi punti per evidenziare ogni mese
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
    <style>
        #ordersChart {
            max-width: 1000px;
            max-height: 500px
        }
    </style>

@endsection
