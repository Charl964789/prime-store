<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
 <body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="bg-slate-900 text-white w-64 fixed lg:relative inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition duration-200 z-50">

        <div class="p-6 border-b border-slate-700">

            <h1 class="text-2xl font-bold">

                Prime Store

            </h1>

            <p class="text-sm text-gray-400 mt-1">

                Inventory & POS

            </p>

        </div>

        <!-- NAVIGATION -->
        <nav class="p-4 space-y-2">

            <a href="/dashboard"
                class="block px-4 py-3 rounded-xl hover:bg-slate-800">

                📊 Dashboard

            </a>

            <a href="/products"
                class="block px-4 py-3 rounded-xl hover:bg-slate-800">

                📦 Products

            </a>

            <a href="/sales"
                class="block px-4 py-3 rounded-xl hover:bg-slate-800">

                💰 Sales

            </a>

            <a href="/sales/create"
                class="block px-4 py-3 rounded-xl hover:bg-slate-800">

                🧾 POS

            </a>

            <a href="/purchases"
                class="block px-4 py-3 rounded-xl hover:bg-slate-800">

                🛒 Purchases

            </a>

            <a href="/suppliers"
                class="block px-4 py-3 rounded-xl hover:bg-slate-800">

                🚚 Suppliers

            </a>

        </nav>

    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <header class="bg-white shadow px-6 py-4 flex items-center justify-between">

            <!-- MOBILE BUTTON -->
            <button
                onclick="toggleSidebar()"
                class="lg:hidden bg-slate-900 text-white px-3 py-2 rounded-lg">

                ☰

            </button>

            <h2 class="text-xl font-bold">

                Prime Provision Store

            </h2>

            <!-- USER -->
            <div class="flex items-center gap-4">

                <span class="font-semibold">

                    {{ Auth::user()->name ?? 'Admin' }}

                </span>
                <div class="relative">

    <button
        onclick="toggleNotifications()"
        class="relative bg-white p-2 rounded-lg">

        🔔

        @if(auth()->user()->unreadNotifications->count())

            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full px-2">

                {{ auth()->user()->unreadNotifications->count() }}

            </span>

        @endif

    </button>

    <!-- DROPDOWN -->
    <div id="notificationBox"
        class="hidden absolute right-0 mt-2 w-80 bg-white shadow-xl rounded-2xl p-4 z-50">

        <h3 class="font-bold mb-4">

            Notifications

        </h3>

        @forelse(auth()->user()->unreadNotifications as $notification)

            <div class="border-b py-2">

                <p class="font-semibold">

                    {{ $notification->data['title'] }}

                </p>

                <p class="text-sm text-gray-600">

                    {{ $notification->data['message'] }}

                </p>

            </div>

        @empty

            <p class="text-gray-500">

                No notifications

            </p>

        @endforelse

    </div>

</div>

                <form method="POST"
                    action="{{ route('logout') }}">

                    @csrf

                    <button
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                        Logout

                    </button>

                </form>

            </div>

        </header>

        <!-- CONTENT -->
        <main class="p-6">

            @yield('content')

        </main>

    </div>

</div>

<!-- MOBILE OVERLAY -->
<div id="overlay"
    onclick="toggleSidebar()"
    class="fixed inset-0 bg-black/50 hidden z-40 lg:hidden">
</div>

<script>

function toggleSidebar()
{
    const sidebar =
        document.getElementById('sidebar');

    const overlay =
        document.getElementById('overlay');

    sidebar.classList.toggle('-translate-x-full');

    overlay.classList.toggle('hidden');
}
function toggleNotifications()
{
    document.getElementById(
        'notificationBox'
    ).classList.toggle('hidden');
}

</script>

</body>

  
</html>
