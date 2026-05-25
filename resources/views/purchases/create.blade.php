@extends('layouts.app')

@section('content')

<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">

        New Purchase Order

    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- PURCHASE FORM -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">

            <form action="/purchases/store"
                method="POST">

                @csrf

                <!-- SUPPLIER -->
                <div class="mb-6">

                    <label class="block mb-2 font-semibold">

                        Supplier

                    </label>

                    <select
                        name="supplier_id"
                        class="w-full border rounded-xl p-3 bg-white text-black">

                        @foreach($suppliers as $supplier)

                            <option value="{{ $supplier->id }}">

                                {{ $supplier->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- PRODUCT -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

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
                                    data-name="{{ $product->name }}">

                                    {{ $product->name }}

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

                    <!-- COST -->
                    <div>

                        <label class="block mb-2 font-semibold">

                            Cost Price

                        </label>

                        <input type="number"
                            id="cost_price"
                            min="0"
                            class="w-full border rounded-xl p-3">

                    </div>

                </div>

                <!-- ADD BUTTON -->
                <button type="button"
                    onclick="addPurchaseItem()"
                    class="mt-6 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

                    Add Item

                </button>

                <!-- CART -->
                <div id="purchaseItems"
                    class="mt-8">

                    <p class="text-gray-500">

                        No items added

                    </p>

                </div>

                <!-- TOTAL -->
                <div class="mt-6 border-t pt-4">

                    <h2 class="text-2xl font-bold">

                        Total:
                        ₦<span id="total">0</span>

                    </h2>

                </div>

                <!-- SUBMIT -->
                <button
                    type="submit"
                    class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl w-full">

                    Complete Purchase

                </button>

            </form>

        </div>

    </div>

</div>

<script>

let purchaseCart = [];

function addPurchaseItem()
{
    const product =
        document.getElementById('product');

    const quantity =
        document.getElementById('quantity').value;

    const costPrice =
        document.getElementById('cost_price').value;

    const selected =
        product.options[product.selectedIndex];

    const subtotal =
        quantity * costPrice;

    purchaseCart.push({

        id: selected.value,

        name: selected.dataset.name,

        quantity,

        costPrice,

        subtotal

    });

    renderPurchaseCart();
}

function renderPurchaseCart()
{
    const purchaseItems =
        document.getElementById('purchaseItems');

    const totalElement =
        document.getElementById('total');

    purchaseItems.innerHTML = '';

    let total = 0;

    purchaseCart.forEach((item, index) => {

        total += parseFloat(item.subtotal);

        purchaseItems.innerHTML += `

            <div class="border-b py-4">

                <h3 class="font-bold">

                    ${item.name}

                </h3>

                <p>

                    Qty:
                    ${item.quantity}

                </p>

                <p>

                    Cost:
                    ₦${item.costPrice}

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

                <input type="hidden"
                    name="products[${index}][cost_price]"
                    value="${item.costPrice}">

            </div>

        `;
    });

    totalElement.innerText = total;
}

</script>

@endsection