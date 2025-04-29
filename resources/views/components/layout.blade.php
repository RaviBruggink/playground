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

<!-- Scroll to top button -->
<button id="scrollToTop"
    class="fixed bottom-6 right-6 z-40 w-10 h-10 bg-white text-black rounded-full shadow-md opacity-0 scale-90 transition-all duration-300 hover:scale-105 hover:shadow-lg"
    aria-label="Scroll to top" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
    ↑
</button>


<body class="bg-neutral-900 text-white font-sans tracking-tight selection:bg-amber-300 selection:text-black">

    <!-- Navigation -->
    <nav class="w-full bg-black border-b border-white/10 sticky top-0 z-50">
        <div class="mx-auto px-6 md:px-16 py-4 flex justify-between items-center">
            <div class="text-lg uppercase text-white">
                <img src="images/watermark.svg" alt="Watermark" class="inline h-10 align-middle" />
            </div>

            <!-- Hamburger -->
            <button class="md:hidden text-white focus:outline-none" onclick="toggleMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Desktop Nav -->
            <div class="hidden md:flex space-x-6 text-sm uppercase font-medium text-white">
                <x-nav-link href="{{ url('/') }}" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="{{ url('about') }}" :active="request()->is('about')">About</x-nav-link>
                <x-nav-link href="{{ url('contact') }}" :active="request()->is('contact')">Contact</x-nav-link>
                <x-nav-link href="{{ url('users') }}" :active="request()->is('users')">Users</x-nav-link>
                <x-nav-link href="{{ route('projects.index') }}" :active="request()->is('projects')">Projects</x-nav-link>
                <x-nav-link href="{{ url('models') }}" :active="request()->is('models')">Models</x-nav-link>
            </div>
        </div>

        <!-- Mobile Nav -->
        <div id="mobile-menu" class="md:hidden px-6 pb-4 space-y-2 hidden border-t border-white/10 text-white">
            <x-nav-link href="{{ url('/') }}" :active="request()->is('/')" class="block">Home</x-nav-link>
            <x-nav-link href="{{ url('about') }}" :active="request()->is('about')" class="block">About</x-nav-link>
            <x-nav-link href="{{ url('contact') }}" :active="request()->is('contact')" class="block">Contact</x-nav-link>
            <x-nav-link href="{{ url('users') }}" :active="request()->is('users')" class="block">Users</x-nav-link>
            <x-nav-link href="{{ route('projects.index') }}" :active="request()->is('projects')" class="block">Projects</x-nav-link>
            <x-nav-link href="{{ url('models') }}" :active="request()->is('models')">Models</x-nav-link>
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
    <div id="cursor"
        class="fixed top-0 left-0 z-50 w-5 h-5 rounded-full pointer-events-none mix-blend-difference bg-white opacity-90 animate-cursor-pulse">
    </div>

    <!-- Scripts -->
    <script>
        const cursor = document.getElementById('cursor');
        let mouseX = 0,
            mouseY = 0;
        let currentX = 0,
            currentY = 0;
        let isClicked = false;

        const lerp = (a, b, n) => (1 - n) * a + n * b;

        const animate = () => {
            currentX = lerp(currentX, mouseX, 0.15);
            currentY = lerp(currentY, mouseY, 0.15);
            cursor.style.transform = `translate3d(${currentX}px, ${currentY}px, 0) scale(${isClicked ? 1.5 : 1})`;
            requestAnimationFrame(animate);
        };

        window.addEventListener('mousemove', e => {
            mouseX = e.clientX - 8;
            mouseY = e.clientY - 8;
        });

        window.addEventListener('mousedown', () => {
            isClicked = true;
            cursor.classList.add('scale-[1.5]', 'opacity-70');
        });

        window.addEventListener('mouseup', () => {
            isClicked = false;
            cursor.classList.remove('scale-[1.5]', 'opacity-70');
        });

        // Hover effects on interactive elements
        const interactive = document.querySelectorAll('a, button, input, textarea, .group, label');
        interactive.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.classList.add('scale-[1.8]', 'opacity-70');
            });
            el.addEventListener('mouseleave', () => {
                cursor.classList.remove('scale-[1.8]', 'opacity-70');
            });
        });

        animate();

        const scrollBtn = document.getElementById('scrollToTop');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                scrollBtn.classList.add('opacity-100', 'scale-100');
                scrollBtn.classList.remove('opacity-0', 'scale-90');
            } else {
                scrollBtn.classList.add('opacity-0', 'scale-90');
                scrollBtn.classList.remove('opacity-100', 'scale-100');
            }
        });
    </script>


    @stack('scripts')
</body>

</html>
