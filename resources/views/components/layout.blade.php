<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ravi Bruggink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>

    @stack('styles')
</head>

<body class="bg-black text-white font-sans tracking-tight selection:bg-amber-300 selection:text-black">

    <!-- Navigation -->
    <nav class="w-full bg-black border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-lg font-semibold uppercase text-white">
                <span class="text-amber-300">Ravi</span> Bruggink
            </div>

            <!-- Hamburger -->
            <button class="md:hidden text-white focus:outline-none" onclick="toggleMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Desktop Nav -->
            <div class="hidden md:flex space-x-6 text-sm uppercase font-medium text-white">
                <x-nav-link href="{{ url('/') }}" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="{{ url('about') }}" :active="request()->is('about')">About</x-nav-link>
                <x-nav-link href="{{ url('contact') }}" :active="request()->is('contact')">Contact</x-nav-link>
                <x-nav-link href="{{ url('users') }}" :active="request()->is('users')">Users</x-nav-link>
                <x-nav-link href="{{ route('projects.index') }}" :active="request()->is('projects')">Projects</x-nav-link>
            </div>
        </div>

        <!-- Mobile Nav -->
        <div id="mobile-menu" class="md:hidden px-6 pb-4 space-y-2 hidden border-t border-white/10 text-white">
            <x-nav-link href="{{ url('/') }}" :active="request()->is('/')" class="block">Home</x-nav-link>
            <x-nav-link href="{{ url('about') }}" :active="request()->is('about')" class="block">About</x-nav-link>
            <x-nav-link href="{{ url('contact') }}" :active="request()->is('contact')" class="block">Contact</x-nav-link>
            <x-nav-link href="{{ url('users') }}" :active="request()->is('users')" class="block">Users</x-nav-link>
            <x-nav-link href="{{ route('projects.index') }}" :active="request()->is('projects')" class="block">Projects</x-nav-link>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="text-center py-6 text-xs text-gray-500 border-t border-white/10">
        &copy; {{ now()->year }} Ravi Bruggink. All rights reserved.
    </footer>

    <!-- Cursor Dot -->
    <div id="cursor-dot"
         class="fixed top-0 left-0 w-3 h-3 bg-amber-300 rounded-full pointer-events-none z-50 transition-transform duration-150 ease-out">
    </div>

    <!-- Scripts -->
    <script>
        const dot = document.getElementById('cursor-dot');
        window.addEventListener('mousemove', e => {
            dot.style.transform = `translate(${e.clientX - 6}px, ${e.clientY - 6}px)`;
        });
    </script>

    @stack('scripts')
</body>

</html>