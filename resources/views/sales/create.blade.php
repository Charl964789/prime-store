@extends('layouts.app')

@section('content')


<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">
        Sales POS
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- BARCODE -->

<div class="mb-4">

    <label class="block mb-2 font-semibold">

        Scan Barcode

    </label>

    <input type="text"
        id="barcodeInput"
        placeholder="Scan barcode..."
        class="w-full border rounded-xl p-3">

</div>


        <!-- PRODUCTS -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">

            <h2 class="text-xl font-bold mb-4">
                Add Product
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- PRODUCT -->
                <div>

                    <label class="block mb-2 font-semibold">
                        Product
                    </label>

                    <select
                           id="product"
                            class="w-full border rounded-xl p-3 bg-white text-black">
                        @foreach($products as $product)

                            <option
                                value="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}"
                                data-barcode="{{ $product->barcode }}"
                                class="text-black bg-white">
                                {{ $product->name }}
                                -
                                ₦{{ number_format($product->price, 2) }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- QTY -->
                <div>

                    <label class="block mb-2 font-semibold">
                        Quantity
                    </label>

                    <input type="number"
                        id="quantity"
                        min="1"
                        value="1"
                        class="w-full border rounded-xl p-3">

                </div>

                <!-- BUTTON -->
                <div class="flex items-end">

                    <button type="button"
                        onclick="addToCart()"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl w-full">

                        Add To Cart

                    </button>

                </div>

            </div>

        </div>

        <!-- CART -->
        <div class="bg-white rounded-2xl shadow-lg p-6">

            <h2 class="text-xl font-bold mb-4">
                Cart
            </h2>

            <form action="/sales/store"
                method="POST">

                @csrf

                <div id="cartItems">

                    <p class="text-gray-500">
                        No items added
                    </p>

                </div>
                
<!-- PAYMENT METHOD -->

<div class="mt-6">

    <label class="block mb-2 font-semibold">

        Payment Method

    </label>

    <select
        name="payment_method"
        class="w-full border rounded-xl p-3 bg-white text-black">

        <option value="Cash">
            Cash
        </option>

        <option value="Transfer">
            Transfer
        </option>

        <option value="POS">
            POS/Card
        </option>

    </select>

</div>

                <!-- TOTAL -->
                <div class="mt-6 border-t pt-4">

                    <h3 class="text-lg font-bold">

                        Total:
                        ₦<span id="total">0</span>

                    </h3>

                </div>
                <!-- PAYMENT -->

<div class="mt-6 border-t pt-6">

    <div class="mb-4">

        <label class="block mb-2 font-semibold">

            Payment Method

        </label>

        <select
            name="payment_method"
            class="w-full border rounded-xl p-3 bg-white text-black">

            <option value="Cash">

                Cash

            </option>

            <option value="Transfer">

                Transfer

            </option>

            <option value="POS/Card">

                POS/Card

            </option>

            <option value="Mixed">

                Mixed Payment

            </option>

        </select>

    </div>

    <!-- AMOUNT PAID -->
    <div>

        <label class="block mb-2 font-semibold">

            Amount Paid

        </label>

        <input type="number"
            name="amount_paid"
            id="amountPaid"
            class="w-full border rounded-xl p-3">

    </div>

    <!-- BALANCE -->
    <div class="mt-4">

        <h3 class="text-lg font-bold">

            Balance:
            ₦<span id="balance">0</span>

        </h3>

    </div>

</div>

                <button
                    class="mt-6 bg-blue-600 hover:bg-blue-700 text-white w-full py-3 rounded-xl">

                    Complete Sale

                </button>

            </form>

        </div>

    </div>

</div>


<script>
    document.getElementById('amountPaid')
    .addEventListener('input', function () {

    let paid =
        parseFloat(this.value) || 0;

    let total =
        parseFloat(
            document.getElementById('total')
                .innerText
        ) || 0;

    let balance =
        paid - total;

    document.getElementById('balance')
        .innerText = balance.toFixed(2);

});

let cart = [];

function addToCart()
{
    const product = document.getElementById('product');

    const quantity = document.getElementById('quantity').value;

    const selected = product.options[product.selectedIndex];

    const id = selected.value;

    const name = selected.dataset.name;

    const price = parseFloat(selected.dataset.price);

    const subtotal = price * quantity;

    cart.push({
        id,
        name,
        price,
        quantity,
        subtotal
    });

    renderCart();
}

function renderCart()
{
    const cartItems = document.getElementById('cartItems');

    const totalElement = document.getElementById('total');

    cartItems.innerHTML = '';

    let total = 0;

    cart.forEach((item, index) => {

        total += item.subtotal;

        cartItems.innerHTML += `
            <div class="border-b py-3">

                <h4 class="font-semibold">
                    ${item.name}
                </h4>

                <p>
                    ${item.quantity} × ₦${item.price}
                </p>

                <p class="font-bold text-green-600">
                    ₦${item.subtotal}
                </p>

                <input type="hidden"
                    name="products[${index}][product_id]"
                    value="${item.id}">

                <input type="hidden"
                    name="products[${index}][quantity]"
                    value="${item.quantity}">

            </div>
        `;
    });

    totalElement.innerText = total;
}
document.getElementById('barcodeInput')
    .addEventListener('change', function () {

    let barcode = this.value;

    let productSelect = document.getElementById('product');

    for (let option of productSelect.options)
    {
        if (option.dataset.barcode == barcode)
        {
            productSelect.value = option.value;

            addToCart();

            this.value = '';

            break;
        }
    }

});
</script>


@endsection