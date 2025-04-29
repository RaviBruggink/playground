@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800
        });
    </script>
@endpush

<x-layout title="Home">
    {{-- HERO SECTION --}}
    <section
        class="min-h-screen flex flex-col items-center justify-center text-center bg-neutral-900 text-white px-6 md:px-12 xl:px-32">
        <h1 class="text-5xl md:text-7xl font-light tracking-wide mb-8 leading-tight" data-aos="fade-up">
            Hey, ik ben <span class="underline underline-offset-4 decoration-white/30">Ravi</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-400 max-w-2xl mb-12" data-aos="fade-up" data-aos-delay="200">
            Ik ontwerp & ontwikkel webervaringen — strak, snel, betekenisvol.
        </p>
        <a href="{{ url('/projects') }}"
            class="px-8 py-3 border border-white text-sm uppercase font-medium tracking-wide rounded-full text-white hover:bg-white hover:text-black transition-all duration-300"
            data-aos="fade-up" data-aos-delay="400">
            Bekijk mijn werk
        </a>
    </section>

    {{-- FEATURED PROJECTS --}}
    <section class="py-36 px-6 md:px-16 xl:px-32 bg-neutral-800 text-white">
        <h2 class="text-3xl md:text-4xl font-light tracking-wider text-center uppercase mb-24" data-aos="fade-up">
            Geselecteerde Projecten
        </h2>

        @if (!isset($projects) || is_null($projects))
            <div class="max-w-xl mx-auto text-center text-gray-400">
                <h3 class="text-xl font-semibold mb-4">Oeps! Iets ging mis.</h3>
                <p>We konden de projecten nu niet laden. Probeer het later opnieuw.</p>
            </div>
        @elseif($projects->isEmpty())
            <div class="max-w-xl mx-auto text-center text-gray-400">
                <h3 class="text-xl font-semibold mb-4">Nog niets hier 👀</h3>
                <p>Toffe dingen zijn onderweg. Stay tuned.</p>
            </div>
        @else
            <div class="grid gap-x-10 gap-y-16 md:grid-cols-2 lg:grid-cols-3">
                {{-- Hardcoded project card --}}
                <a href="{{ route('projects.custom.graph') }}"
                    class="group relative overflow-hidden rounded-2xl shadow-xl bg-neutral-800 transition-transform duration-500 hover:scale-[1.015] hover:shadow-2xl"
                    data-aos="fade-up" data-aos-delay="{{ count($projects) * 100 }}">

                    <img src="{{ asset('images/graph.png') }}" alt="Hardcoded Project"
                        class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-105 group-hover:brightness-95">

                    <div
                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 md:p-8">
                        <h2 class="text-white text-xl font-semibold uppercase mb-2 tracking-wide">
                            AI-model graph
                        </h2>
                        <p class="text-sm text-gray-300 leading-relaxed">A prototyping challenge to explore AI-model
                            performance across various use cases.</p>
                    </div>
                </a>
                @foreach ($projects as $project)
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl bg-neutral-700 transition-transform duration-500 hover:scale-[1.015]"
                        data-aos="fade-up">
                        <img src="{{ $project->image }}" alt="{{ $project->title }}"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105 group-hover:brightness-90">
                        <div
                            class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 md:p-8 flex flex-col justify-end">
                            <h3 class="text-white text-lg font-semibold uppercase mb-2 tracking-wide">
                                {{ $project->title }}</h3>
                            <p class="text-sm text-gray-300 leading-relaxed">{{ Str::limit($project->description, 80) }}
                            </p>
                            <a href="{{ route('projects.show', $project) }}"
                                class="mt-4 text-sm font-semibold uppercase text-white hover:underline transition">
                                Bekijk project →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-24" data-aos="fade-up">
            <a href="{{ url('/projects') }}"
                class="text-white font-semibold text-sm uppercase tracking-wide hover:underline">
                Bekijk alle projecten →
            </a>
        </div>
    </section>

    {{-- ABOUT SECTION --}}
    <section class="bg-neutral-900 py-36 px-6 md:px-16 xl:px-32 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-light tracking-wider uppercase mb-8" data-aos="fade-up">
            Over mij
        </h2>
        <p class="text-gray-400 max-w-2xl mx-auto text-lg leading-relaxed mb-10" data-aos="fade-up"
            data-aos-delay="200">
            Ik ben Ravi — een 25-jarige front-end developer die design, code en nieuwsgierigheid combineert.
            Of ik nu wireframes teken of de natuur in trek, ik jaag altijd ideeën na die ertoe doen.
        </p>
        <a href="{{ url('/about') }}"
            class="px-6 py-3 border border-white text-sm uppercase font-semibold tracking-wide rounded-full text-white hover:bg-white hover:text-black transition-all"
            data-aos="fade-up" data-aos-delay="400">
            Meer over mij
        </a>
    </section>

    {{-- CONTACT SECTION --}}
    <section class="bg-neutral-800 text-white py-36 px-6 md:px-16 xl:px-32 text-center">
        <h2 class="text-3xl md:text-4xl font-light tracking-wider uppercase mb-6" data-aos="fade-up">
            Laten we samenwerken
        </h2>
        <p class="text-base mb-12 text-gray-400 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            Heb je een project of gewoon zin om te connecten? Ik sta altijd open voor een goed gesprek of een creatief
            idee.
        </p>
        <a href="{{ url('/contact') }}"
            class="px-8 py-3 bg-white text-black text-sm uppercase font-semibold tracking-wide rounded-full hover:bg-gray-300 transition-all duration-300"
            data-aos="fade-up" data-aos-delay="400">
            Neem contact op
        </a>
    </section>
</x-layout>
