<!DOCTYPE html>
<html>
<head>

    <title>
        Receipt
    </title>

    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-6">

<div class="max-w-md mx-auto bg-white shadow-xl rounded-2xl p-6">

    <!-- HEADER -->
    <div class="text-center border-b pb-4">

        <h1 class="text-2xl font-bold">
            Prime Provision Store
        </h1>

        <p class="text-gray-500 text-sm">
            Sales Receipt
        </p>

    </div>

    <!-- INFO -->
    <div class="mt-4 text-sm">

        <p>
            <strong>Receipt ID:</strong>
            #{{ $sale->id }}
        </p>

        <p>
            <strong>Date:</strong>
            {{ $sale->created_at }}
        </p>

        <p>
            <strong>Cashier:</strong>
            {{ $sale->user->name ?? 'Admin' }}
        </p>
<p>
    <strong>Payment:</strong>

    {{ $sale->payment_method }}
</p>
    </div>

    <!-- ITEMS -->
    <div class="mt-6">

        <table class="w-full text-sm">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-2">
                        Item
                    </th>

                    <th>
                        Qty
                    </th>

                    <th>
                        Price
                    </th>

                    <th class="text-right">
                        Total
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($sale->items as $item)

                <tr class="border-b">

                    <td class="py-2">
                        {{ $item->product->name }}
                    </td>

                    <td class="text-center">
                        {{ $item->quantity }}
                    </td>

                    <td class="text-center">
                        ₦{{ number_format($item->price, 2) }}
                    </td>

                    <td class="text-right">
                        ₦{{ number_format($item->subtotal, 2) }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <!-- TOTAL -->
    <div class="mt-6 border-t pt-4">

        <div class="flex justify-between text-lg font-bold">

            <span>
                Grand Total
            </span>

            <span>
                ₦{{ number_format($sale->total_amount, 2) }}
            </span>

        </div>

    </div>

    <!-- BUTTONS -->
    <div class="mt-6 flex gap-3">

        <button onclick="window.print()"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl w-full">

            Print Receipt

        </button>
        <a href="/sales/{{ $sale->id }}/pdf"
    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl inline-block mt-4">

    Download PDF

</a>

        <a href="/sales/create"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl w-full text-center">

            New Sale

        </a>

    </div>

    <!-- FOOTER -->
    <div class="mt-6 text-center text-xs text-gray-400">

        Thank you for shopping with us.

    </div>

</div>

</body>
</html>