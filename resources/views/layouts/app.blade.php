<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="{{ asset('roket.gif') }}">
<link rel="shortcut icon" type="image/gif" href="{{ asset('roket.gif') }}">
    <title>{{ config('app.name') }} | {{ $title ?? '' }}</title>
    @vite('resources/css/app.css')
@vite('resources/js/app.js')

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? 'My Shortener' }}">
    <meta property="og:description" content="{{ $description ?? 'Aplikasi Short Link aman & fun!' }}">
    <meta property="og:image" content="{{ $image ?? asset('img.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">

</head>

<body class="bg-gradient-to-b from-blue-50 to-purple-50 min-h-screen flex flex-col font-sans">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-purple-600 hover:text-purple-400 flex items-center space-x-2">
            <span>🚀</span>
            <span>Shortener</span>
        </a>

        {{-- Hamburger Button --}}
        <div class="md:hidden">
            <button id="hamburger" class="text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        {{-- Menu --}}
        <div id="menu" class="hidden md:flex md:items-center md:space-x-4 relative">
            <ul class="flex flex-col md:flex-row md:space-x-4">
                @auth
                    <li>
                        <a href="{{ route('dashboard') }}" class="block px-2 py-1 text-gray-700 hover:text-purple-600 transition">Dashboard</a>
                    </li>

                    @if(auth()->user()->is_admin)
                        <li class="relative">
                            <button id="admin-dropdown-btn" class="block px-2 py-1 text-gray-700 hover:text-purple-600 transition focus:outline-none">
                                Admin ▾
                            </button>
                            {{-- Dropdown menu --}}
                            <div id="admin-dropdown" class="hidden absolute top-full left-0 mt-1 w-48 bg-white shadow-lg rounded-md z-50">
                                <a href="{{ route('admin.links.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-100 transition">Semua Link</a>
                                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-100 transition">Users</a>
                            </div>
                        </li>
                    @endif
                @endauth
            </ul>

            <div class="mt-2 md:mt-0 md:ml-4">
                @guest
                    <a href="{{ route('login') }}" class="block px-4 py-2 border border-gray-300 rounded hover:bg-purple-100 transition">
                        Login
                    </a>
                @else
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
    // Hamburger toggle
    const hamburger = document.getElementById('hamburger');
    const menu = document.getElementById('menu');
    hamburger.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    // Admin dropdown toggle
    const adminBtn = document.getElementById('admin-dropdown-btn');
    const adminDropdown = document.getElementById('admin-dropdown');

    if (adminBtn) {
        adminBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            adminDropdown.classList.toggle('hidden');
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', () => {
            adminDropdown.classList.add('hidden');
        });
    }
</script>


    {{-- Flash Messages --}}
    <div class="container mx-auto px-4 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded mb-4 animate-fadeIn">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded mb-4 animate-fadeIn">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Content --}}
    <main class="container mx-auto px-4 flex-1 mt-4">
        <div class="bg-white shadow-lg rounded-xl p-6 animate-fadeIn">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-white shadow-inner mt-auto py-4">
        <div class="container mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Made with 💜 and Tailwind!
        </div>
    </footer>

    </body>
</html>
