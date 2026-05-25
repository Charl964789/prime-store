@extends('layouts.app')

@section('content')

<div class="bg-white rounded-2xl shadow-lg p-6">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Products
            </h2>

            <p class="text-gray-500">
                Manage your inventory products
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">

            <!-- SEARCH -->
            <form method="GET" action="/products">

                <input type="text"
                    name="search"
                    placeholder="Search products..."
                    value="{{ request('search') }}"
                    class="border border-gray-300 rounded-xl px-4 py-3 w-full sm:w-64">

            </form>

            <!-- ADD BUTTON -->
            <a href="/products/create"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition text-center">

                Add Product

            </a>

        </div>

    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">

            {{ session('success') }}

        </div>

    @endif

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full">

          <thead class="bg-gray-100">

    <tr>

        <th class="p-4 text-left">ID</th>

        <th class="p-4 text-left">Category</th>

        <th class="p-4 text-left">Name</th>

        <th class="p-4 text-left">Price</th>

        <th class="p-4 text-left">Stock</th>

        <th class="p-4 text-left">Supplier</th>

        <th class="p-4 text-left">Actions</th>
        <th class="p-4 text-left">    Expiry Date</th>

    </tr>

</thead>

            <tbody>

    @foreach($products as $product)

    <tr class="border-b hover:bg-gray-50">

        <td class="p-4">
            {{ $product->id }}
        </td>

        <td class="p-4">
            {{ $product->category->name ?? 'N/A' }}
        </td>

        <td class="p-4 font-semibold">
            {{ $product->name }}
        </td>

        <td class="p-4 text-green-600 font-bold">
            ₦{{ number_format($product->price, 2) }}
        </td>

        <td class="p-4">
            {{ $product->stock }}
        </td>

        <td class="p-4">
            {{ $product->supplier->name ?? 'N/A' }}
        </td>
        <td class="p-4">

    @if($product->expiry_date)

        <span class="
            {{ \Carbon\Carbon::parse($product->expiry_date)->isPast()
                ? 'text-red-600 font-bold'
                : 'text-green-600'
            }}">

            {{ $product->expiry_date }}

        </span>

                   @else

                   N/A

            @endif

           </td>

        <td class="p-4 flex gap-2">

            <!-- EDIT -->
            <a href="/products/{{ $product->id }}/edit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                Edit

            </a>

            <!-- DELETE -->
            <form action="/products/{{ $product->id }}"
                method="POST">

                @csrf
                @method('DELETE')

                <button
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                    Delete

                </button>

            </form>

        </td>

    </tr>

    @endforeach

</tbody>
        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-6">

        {{ $products->links() }}

    </div>

</div>

@endsection