@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- PAGE HEADER -->
    <div class="mb-8">

        <h1 class="text-4xl font-bold text-slate-800">
            Dashboard
        </h1>

        <p class="text-gray-500 mt-2">
            Welcome back,
            {{ Auth::user()->name }}
        </p>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow-lg p-6">

            <p class="text-gray-500">
                Total Products
            </p>

            <h2 class="text-4xl font-bold mt-3 text-blue-600">

                {{ $totalProducts }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">

            <p class="text-gray-500">
                Categories
            </p>

            <h2 class="text-4xl font-bold mt-3 text-purple-600">

                {{ $totalCategories }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">

            <p class="text-gray-500">
                Total Sales
            </p>

            <h2 class="text-4xl font-bold mt-3 text-green-600">

                {{ $totalSales }}

            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">

            <p class="text-gray-500">
                Revenue
            </p>

            <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mt-3 text-green-700 truncate">

                ₦{{ number_format($revenue, 2) }}

            </h2>

        </div>

    </div>

</div>

@endsection
<!-- LOW STOCK ALERTS -->

<div class="mt-10">

    <div class="bg-white rounded-2xl shadow-lg p-6">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold text-red-600">

                Low Stock Alerts

            </h2>

            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm">

                {{ $lowStockProducts->count() }} Alerts

            </span>

        </div>

        @if($lowStockProducts->count() > 0)

            <div class="space-y-4">

                @foreach($lowStockProducts as $product)

                    <div class="flex justify-between items-center border rounded-xl p-4">

                        <div>

                            <h3 class="font-bold text-lg">

                                {{ $product->name }}

                            </h3>

                            <p class="text-gray-500">

                                Product stock is running low

                            </p>

                        </div>

                        <div>

                            <span class="bg-red-600 text-white px-4 py-2 rounded-lg">

                                {{ $product->stock }} left

                            </span>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="text-center text-gray-500 py-10">

                No low stock alerts

            </div>
            <!-- ANALYTICS -->

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-10">

    <!-- SALES CHART -->

    <div class="bg-white rounded-2xl shadow-lg p-6">

        <h2 class="text-2xl font-bold mb-6">

            Revenue Analytics

        </h2>

        <canvas id="salesChart"></canvas>

    </div>

    <!-- TOP PRODUCTS -->

    <div class="bg-white rounded-2xl shadow-lg p-6">

        <h2 class="text-2xl font-bold mb-6">

            Top Selling Products

        </h2>

        <div class="space-y-4">

            @foreach($topProducts as $item)

                <div class="flex justify-between items-center">

                    <div>

                        <h3 class="font-bold">

                            {{ $item->product->name ?? 'Deleted Product' }}

                        </h3>

                    </div>

                    <span class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                        {{ $item->total_qty }} sold

                    </span>

                </div>

                <!-- EXPIRY ALERTS -->

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

    <!-- EXPIRING SOON -->
    <div class="bg-yellow-100 border-l-4 border-yellow-500 rounded-2xl p-6">

        <h2 class="text-xl font-bold text-yellow-800 mb-4">

            ⚠️ Expiring Soon

        </h2>

        @forelse($expiringProducts as $product)

            <div class="mb-3">

                <p class="font-semibold">

                    {{ $product->name }}

                </p>

                <p class="text-sm text-gray-700">

                    Expires:
                    {{ $product->expiry_date }}

                </p>

            </div>

        @empty

            <p class="text-gray-600">

                No products expiring soon

            </p>

        @endforelse

    </div>

    <!-- EXPIRED -->
    <div class="bg-red-100 border-l-4 border-red-500 rounded-2xl p-6">

        <h2 class="text-xl font-bold text-red-800 mb-4">

            ❌ Expired Products

        </h2>

        @forelse($expiredProducts as $product)

            <div class="mb-3">

                <p class="font-semibold">

                    {{ $product->name }}

                </p>

                <p class="text-sm text-gray-700">

                    Expired:
                    {{ $product->expiry_date }}

                </p>

            </div>

        @empty

            <p class="text-gray-600">

                No expired products

            </p>

        @endforelse

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('salesChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: [

            @foreach($salesByDay as $sale)

                '{{ $sale->date }}',

            @endforeach

        ],

        datasets: [{

            label: 'Revenue',

            data: [

                @foreach($salesByDay as $sale)

                    {{ $sale->total }},

                @endforeach

            ],

            tension: 0.4

        }]
    }

});

</script>

            @endforeach

        </div>

    </div>

</div>

        @endif

    </div>

</div>