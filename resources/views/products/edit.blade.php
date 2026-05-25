
@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">

    <h2 class="text-3xl font-bold text-gray-800 mb-6">
        Edit Product
    </h2>

    @if($errors->any())

        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">

            <ul class="list-disc pl-5">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="/products/{{ $product->id }}"
    method="POST">

        @csrf
@method('PUT')
        <div>

            <label class="block mb-2 font-semibold">
                Category
            </label>

            <select name="category_id"
                class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500">

                <option value="">
<option
    value="{{ $category->id }}"
    {{ $product->category_id == $category->id ? 'selected' : '' }}>

    {{ $category->name }}

</option>

                @endforeach

            </select>

        </div>
        <div class="mb-4">

    <label class="block mb-2 font-semibold">

        Supplier

    </label>

    <select
        name="supplier_id"
        class="w-full border rounded-xl p-3 bg-white text-black">

        <option value="">
          
  <option
    value="{{ $supplier->id }}"
    {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>

    {{ $supplier->name }}

</option>

            </option>
        @endforeach

    </select>

</div>

        <div>

            <label class="block mb-2 font-semibold">
                Product Name
            </label>

            <input type="text"
                name="name"
                value="{{ $product->name }}"
                class="w-full border border-gray-300 rounded-xl p-3">

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <label class="block mb-2 font-semibold">
                    Price
                </label>

                <input type="number"
                    step="0.01"
                    name="price"
                    value="{{ $product->price }}"
                    class="w-full border border-gray-300 rounded-xl p-3">

            </div>

            <div>

                <label class="block mb-2 font-semibold">
                    Stock
                </label>

                <input type="number"
                    name="stock"
                    value="{{ $product->stock }}"
                    class="w-full border border-gray-300 rounded-xl p-3">

            </div>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Description
            </label>

            <textarea name="description"
                rows="4"
                class="w-full border border-gray-300 rounded-xl p-3"></textarea>

        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition">

            Save Product

        </button>

    </form>

</div>
<div class="mb-4">

    <label class="block mb-2 font-semibold">
        Barcode
    </label>

    <input type="text"
        name="barcode"
        class="w-full border rounded-xl p-3">

</div>

@endsection