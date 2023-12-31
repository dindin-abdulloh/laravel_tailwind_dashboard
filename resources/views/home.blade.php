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
                    <canvas id="salesChart"></canvas>
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
            // Kolom kiri: Chart trafik penjualan
            var salesCtx = $('#salesChart')[0].getContext('2d');
            var salesData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Monthly Sales',
                    data: [50, 75, 120, 90, 110],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };
            var salesOptions = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };
            var salesChart = new Chart(salesCtx, {
                type: 'bar',
                data: salesData,
                options: salesOptions
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
