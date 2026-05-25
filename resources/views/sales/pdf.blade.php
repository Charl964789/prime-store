<!DOCTYPE html>
<html>

<head>

    <title>
        Receipt
    </title>

    <style>

        body {
            font-family: sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

    </style>

</head>

<body>

    <h1>
        Prime Provision Store
    </h1>

    <p>
        Receipt ID:
        #{{ $sale->id }}
    </p>

    <p>
        Date:
        {{ $sale->created_at }}
    </p>

    <p>
        Payment:
        {{ $sale->payment_method }}
    </p>

    <table>

        <thead>

            <tr>

                <th>
                    Product
                </th>

                <th>
                    Qty
                </th>

                <th>
                    Price
                </th>

                <th>
                    Total
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($sale->items as $item)

            <tr>

                <td>
                    {{ $item->product->name }}
                </td>

                <td>
                    {{ $item->quantity }}
                </td>

                <td>
                    ₦{{ number_format($item->price, 2) }}
                </td>

                <td>
                    ₦{{ number_format($item->subtotal, 2) }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <h2 style="margin-top: 20px;">

        Grand Total:
        ₦{{ number_format($sale->total_amount, 2) }}

    </h2>

</body>

</html>