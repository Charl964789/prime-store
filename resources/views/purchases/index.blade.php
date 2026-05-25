@extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">

            Purchases

        </h1>

        <a href="/purchases/create"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl">

            New Purchase

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">
                        Supplier
                    </th>

                    <th class="p-4 text-left">
                        Date
                    </th>

                    <th class="p-4 text-left">
                        Total
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($purchases as $purchase)

                <tr class="border-b">

                    <td class="p-4">

                        {{ $purchase->supplier->name }}

                    </td>

                    <td class="p-4">

                        {{ $purchase->purchase_date }}

                    </td>

                    <td class="p-4 font-bold text-green-600">

                        ₦{{ number_format($purchase->total_amount, 2) }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection