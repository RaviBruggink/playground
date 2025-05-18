@push('styles')
    {{-- AOS Animation Styles --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@push('scripts')
    {{-- AOS Animation Scripts --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800,
        });
    </script>
@endpush

<x-layout>
    <div class="flex flex-col">
        <!-- Hero Section - Adjusted to consider navbar height -->
        <div class="h-[calc(100vh-4rem)] flex items-center px-6 md:px-16">
            <h1 class="font-mono text-6xl md:text-8xl font-bold max-w-4xl leading-tight">
                Creative Developer
                <span class="block mt-2 text-white/60">Based in Eindhoven</span>
            </h1>
        </div>

        <!-- Featured Project Preview - Full viewport height -->
        <div class="h-screen w-full relative overflow-hidden group">
            <a href="{{ route('projects.index') }}" class="block w-full h-full">
                <img src="{{ asset('storage/images/sea.jpg') }}" 
                     alt="Featured Project - Sea Landscape" 
                     class="absolute inset-0 w-full h-full object-cover grayscale transition-all duration-700 group-hover:grayscale-0 group-hover:scale-105">
                
                <div class="absolute inset-0 bg-black/40 flex items-end p-6 md:p-16 hover:bg-black/30 transition-all duration-700">
                    <div class="font-mono">
                        <div class="text-white/60 text-sm mb-2">FEATURED PROJECT</div>
                        <div class="text-xl text-white group-hover:translate-x-2 transition-transform duration-500">
                            View Latest Work →
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Watermark Overlay -->
        <div class="fixed bottom-8 left-8 w-20 h-20 opacity-10 select-none pointer-events-none mix-blend-difference">
            <img src="{{ asset('storage/images/watermark.svg') }}" alt="Watermark" class="w-full h-full">
        </div>
    </div>
</x-layout>