 @extends('layouts.app')

@section('content')

<div class="p-6 max-w-2xl mx-auto">

    <div class="bg-white rounded-2xl shadow-lg p-6">

        <h1 class="text-3xl font-bold mb-6">
            Create User
        </h1>

        <form action="/users/store" method="POST">

            @csrf

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Name
                </label>

                <input type="text"
                    name="name"
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

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Password
                </label>

                <input type="password"
                    name="password"
                    class="w-full border rounded-xl p-3">

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Role
                </label>

                <select name="role"
                    class="w-full border rounded-xl p-3">

                    <option value="admin">
                        Admin
                    </option>

                    <option value="cashier">
                        Cashier
                    </option>

                </select>

            </div>

            <button
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

                Create User

            </button>

        </form>

    </div>

</div>

@endsection