<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ravi Bruggink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        mono: ['Space Mono', 'monospace'],
                        sans: ['Space Grotesk', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap');

        /* Smooth scrolling for the whole page */
        html {
            scroll-behavior: smooth;
        }

        /* Hide scrollbar but keep functionality */
        body {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        
        body::-webkit-scrollbar {
            display: none;
        }

        /* Ensure transitions are smooth */
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom cursor styles */
        .cursor {
            width: 20px;
            height: 20px;
            background: #fff;
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            mix-blend-mode: difference;
            z-index: 9999;
            transform: translate(-50%, -50%);
        }

        /* Hover effect for links and buttons */
        a:hover ~ .cursor,
        button:hover ~ .cursor {
            transform: translate(-50%, -50%) scale(1.5);
        }
    </style>
    @stack('styles')
    @livewireStyles
</head>

<body class="bg-black text-white font-sans" 
      x-data="{ 
          atTop: true, 
          atBottom: false,
          checkScroll() {
              this.atTop = window.pageYOffset < 100;
              this.atBottom = (window.innerHeight + window.pageYOffset) >= document.documentElement.scrollHeight - 100;
          }
      }" 
      x-init="
          checkScroll();
          window.addEventListener('scroll', () => checkScroll());
      ">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-50 mix-blend-difference">
        <div class="mx-auto px-6 md:px-16 py-6 flex justify-between items-center">
            <a class="text-lg uppercase font-mono tracking-wider" href="{{ url('/') }}">
                Ravi Bruggink
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex space-x-8 text-sm uppercase font-mono tracking-wider">
                <a href="{{ url('/projects') }}" class="hover:opacity-50">Work</a>
                <a href="{{ url('about') }}" class="hover:opacity-50">Overview</a>
                <a href="{{ url('contact') }}" class="hover:opacity-50">Info</a>
            </div>

            <!-- Hamburger -->
            <button class="md:hidden" onclick="toggleMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Nav -->
        <div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-95 md:hidden hidden">
            <div class="h-full flex flex-col items-center justify-center space-y-8 text-2xl uppercase font-mono">
                <a href="{{ url('/') }}" class="hover:opacity-50">Work</a>
                <a href="{{ url('about') }}" class="hover:opacity-50">Overview</a>
                <a href="{{ url('contact') }}" class="hover:opacity-50">Info</a>
                <button onclick="toggleMenu()" class="mt-8 text-sm">Close</button>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="pt-24">
        {{ $slot }}
    </main>

    <!-- Scroll Button -->
    <div class="fixed right-8 bottom-32 z-50 mix-blend-difference"
         x-show="!atTop || !atBottom"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-2">
        <button @click="atBottom ? window.scrollTo({top: 0, behavior: 'smooth'}) : window.scrollTo({top: document.documentElement.scrollHeight, behavior: 'smooth'})"
                class="bg-transparent border border-white rounded-full p-3 hover:bg-white hover:text-black transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-6 w-6 transform transition-transform duration-300"
                 :class="atBottom ? 'rotate-180' : ''"
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor">
                <path stroke-linecap="round" 
                      stroke-linejoin="round" 
                      stroke-width="2" 
                      d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </button>
    </div>

    <!-- Custom Cursor -->
    <div class="cursor hidden lg:block"></div>

    <!-- Watermark -->
    <x-watermark />

    <!-- Scripts -->
    <script>
        // Menu Toggle
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Custom cursor
        const cursor = document.querySelector('.cursor');
        let mouseX = 0, mouseY = 0;
        let cursorX = 0, cursorY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        function animate() {
            const easing = 0.2;
            
            cursorX += (mouseX - cursorX) * easing;
            cursorY += (mouseY - cursorY) * easing;
            
            cursor.style.transform = `translate(${cursorX}px, ${cursorY}px)`;
            
            requestAnimationFrame(animate);
        }

        animate();
    </script>

    @livewireScripts
    @stack('scripts')
</body>

</html>
