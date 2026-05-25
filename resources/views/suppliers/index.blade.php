@extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">

            Suppliers

        </h1>

        <a href="/suppliers/create"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl">

            Add Supplier

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">
                        Name
                    </th>

                    <th class="p-4 text-left">
                        Phone
                    </th>

                    <th class="p-4 text-left">
                        Email
                    </th>

                    <th class="p-4 text-left">
                        Address
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($suppliers as $supplier)

                <tr class="border-b">

                    <td class="p-4">
                        {{ $supplier->name }}
                    </td>

                    <td class="p-4">
                        {{ $supplier->phone }}
                    </td>

                    <td class="p-4">
                        {{ $supplier->email }}
                    </td>

                    <td class="p-4">
                        {{ $supplier->address }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection