@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 800 });
    </script>
@endpush

<x-layout>
    <section class="bg-black text-white">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-24 space-y-32">

            {{-- Hero Section --}}
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-5xl md:text-6xl font-light uppercase tracking-wide text-white mb-6">
                    {{ $project->title }}
                </h1>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                    {{ $project->description }}
                </p>
            </div>

            {{-- Main Image --}}
            @if ($project->image)
                <div class="w-full" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset($project->image) }}" alt="{{ $project->title }}"
                         class="w-full rounded-2xl shadow-xl object-cover transition-all duration-500 transform hover:scale-105 hover:brightness-110" />
                </div>
            @endif

            {{-- Details Section --}}
            <div class="grid md:grid-cols-2 gap-16 items-start">
                <div data-aos="fade-right">
                    <h3 class="text-sm uppercase tracking-widest text-gray-500 mb-4">Categorie</h3>
                    <ul class="text-gray-300 space-y-2">
                        <li>Branding</li>
                        <li>UX/UI Design</li>
                        <li>Webontwikkeling</li>
                    </ul>

                    <h3 class="text-sm uppercase tracking-widest text-gray-500 mt-10 mb-4">Jaar</h3>
                    <p class="text-gray-300">2022</p>

                    <h3 class="text-sm uppercase tracking-widest text-gray-500 mt-10 mb-4">Prijzen</h3>
                    <ul class="text-gray-300 space-y-2">
                        <li>1× Awwwards (Honours)</li>
                        <li>1× CSS Design Awards (Site van de dag)</li>
                    </ul>
                </div>

                <div data-aos="fade-left" class="space-y-6">
                    @if ($project->extra_text)
                        <h3 class="text-white text-xl font-semibold uppercase">Meer info</h3>
                        <p class="text-gray-400 leading-relaxed">{{ $project->extra_text }}</p>
                    @endif
                </div>
            </div>

            {{-- Extra Imagery or Visual --}}
            <div class="grid md:grid-cols-2 gap-8 items-center" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset($project->image) }}" class="rounded-xl shadow-lg transition-transform duration-500 hover:scale-105" alt="Mockup">
                <p class="text-gray-400 text-lg leading-relaxed">
                    Een visueel voorbeeld van hoe de branding of website zich vertaalt naar een eindproduct.
                    Denk aan interactie, mobiele weergave of zelfs printmateriaal. Alles draait hier om gevoel en consistentie.
                </p>
            </div>

            {{-- Back Link --}}
            <div class="text-center pt-16" data-aos="fade-up">
                <a href="{{ route('projects.index') }}"
                   class="relative inline-block text-sm text-gray-300 uppercase font-semibold tracking-wide hover:pr-2 hover:underline transition-all duration-300">
                    ← Terug naar alle projecten
                </a>
            </div>
        </div>
    </section>
</x-layout>