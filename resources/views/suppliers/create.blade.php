@extends('layouts.app')

@section('content')

<div class="p-6 max-w-2xl mx-auto">

    <div class="bg-white rounded-2xl shadow-lg p-6">

        <h1 class="text-3xl font-bold mb-6">

            Add Supplier

        </h1>

        <form action="/suppliers/store"
            method="POST">

            @csrf

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Supplier Name
                </label>

                <input type="text"
                    name="name"
                    class="w-full border rounded-xl p-3">

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Phone
                </label>

                <input type="text"
                    name="phone"
                    class="w-full border rounded-xl p-3">

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input type="email"
                    name="email"
                    class="w-full border rounded-xl p-3">

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Address
                </label>

                <textarea
                    name="address"
                    class="w-full border rounded-xl p-3"></textarea>

            </div>

            <button
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

                Save Supplier

            </button>

        </form>

    </div>

</div>

@endsection