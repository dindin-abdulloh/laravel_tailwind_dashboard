@extends('layouts.admin')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="main-card">
    <div class="header">
        Dashboard
    </div>

    <div class="body">
        @if(session('status'))
            <div class="alert success">
                {{ session('status') }}
            </div>
        @endif

        <div class="container flex flex-wrap">
            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pr-2 lg:pr-2 xl:pr-2">
                <div class="chart-container">
                    <canvas id="multiAxisLineChart"></canvas>
                </div>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pl-2 lg:pl-2 xl:pl-2">
                <div class="chart-container">
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
@parent
    <script>
         $(document).ready(function () {
            // Kolom kiri: Multi-axis Line Chart
            var multiAxisLineCtx = $('#multiAxisLineChart')[0].getContext('2d');
            var multiAxisLineData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [
                    {
                        label: 'Monthly Sales',
                        data: [50, 75, 120, 90, 110],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        yAxisID: 'y1',
                        borderWidth: 1
                    },
                    {
                        label: 'Monthly Profit',
                        data: [20, 30, 40, 25, 35],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        yAxisID: 'y2',
                        borderWidth: 1
                    }
                ]
            };
            var multiAxisLineOptions = {
                scales: {
                    y1: {
                        type: 'linear',
                        position: 'left',
                        beginAtZero: true
                    },
                    y2: {
                        type: 'linear',
                        position: 'right',
                        beginAtZero: true
                    }
                }
            };
            var multiAxisLineChart = new Chart(multiAxisLineCtx, {
                type: 'line',
                data: multiAxisLineData,
                options: multiAxisLineOptions
            });

            // Kolom kanan: Chart 5 produk terlaris
            var topProductsCtx = $('#topProductsChart')[0].getContext('2d');
            var topProductsData = {
                labels: ['Product A', 'Product B', 'Product C', 'Product D', 'Product E'],
                datasets: [{
                    label: 'Top Products',
                    data: [30, 25, 20, 18, 15],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            };
            var topProductsOptions = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };
            var topProductsChart = new Chart(topProductsCtx, {
                type: 'bar',
                data: topProductsData,
                options: topProductsOptions
            });
        });
    </script>
@endsection
