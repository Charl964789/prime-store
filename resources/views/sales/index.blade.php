@extends('layouts.app')

@section('content')

<div class="bg-white rounded-2xl shadow-lg p-6">

    <h2 class="text-3xl font-bold text-gray-800 mb-6">
        Sales History
    </h2>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">

            {{ session('success') }}

        </div>

    @endif

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="bg-gray-100 text-left">

                    <th class="p-4">ID</th>
                    <th class="p-4">Amount</th>
                    <th class="p-4">Payment</th>
                    <th class="p-4">Date</th>
                    <th class="p-4">Receipt</th>
                    <th class="text-left p-4">
                        Payment
                    </th>
                </tr>

            </thead>

            <tbody>

                @foreach($sales as $sale)

                <tr class="border-b">

                    <td class="p-4">
                        {{ $sale->id }}
                    </td>

                    <td class="p-4 text-green-600 font-bold">
                        ₦{{ number_format($sale->total_amount, 2) }}
                    </td>

                    <td class="p-4">
                        {{ $sale->payment_method }}
                    </td>

                  <td class="p-4">
    {{ $sale->created_at->format('d M Y') }}
</td>
<td class="p-4">

    <span class="bg-gray-200 px-3 py-1 rounded-lg">

        {{ $sale->payment_method }}

    </span>

</td>
<td class="p-4">

    <a href="/sales/{{ $sale->id }}/receipt"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

        View Receipt

    </a>

</td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection