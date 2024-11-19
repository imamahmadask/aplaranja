<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Aplaranja</title>
    <link rel="icon" href="{{ asset('dist/img/AdminLTELogo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <header class="bg-white shadow">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-600">Aplaranja</h1>
                <!-- Laravel Blade Navigation -->
                @if (Route::has('login'))
                    <nav class="flex space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-black">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-black">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-black">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow flex flex-col items-center justify-center text-center px-4">
            <h2 class="text-4xl font-bold text-blue-600 mb-4">Welcome to Aplaranja</h2>
            <p class="text-gray-600 text-lg mb-6">Aplikasi Pendataan Perlengkapan Jalan</p>
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="bg-blue-500 text-white px-6 py-3 rounded-full text-lg font-medium hover:bg-blue-600 transition">
                        Get Started
                    </a>
                @endauth
            @endif
        </main>

        <!-- Footer -->
        <footer class="bg-gray-200 py-4 text-center">
            <p class="text-sm text-gray-500">© 2024 Aplaranja. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
