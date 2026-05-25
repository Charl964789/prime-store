 @extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Users Management
        </h1>

        <a href="/users/create"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl">

            Add User

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
                        Email
                    </th>

                    <th class="p-4 text-left">
                        Role
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                <tr class="border-b">

                    <td class="p-4">
                        {{ $user->name }}
                    </td>

                    <td class="p-4">
                        {{ $user->email }}
                    </td>

                    <td class="p-4">

                        <span class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                            {{ ucfirst($user->role) }}

                        </span>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection