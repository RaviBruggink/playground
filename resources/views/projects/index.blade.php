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
    <section class="py-32 px-6 md:px-16 xl:px-32 bg-neutral-900 text-white">
        <h1 class="text-5xl font-light uppercase tracking-wide text-center mb-24" data-aos="fade-up">
            Mijn Projecten
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-16">

            {{-- Hardcoded project card --}}
            <a href="{{ route('projects.custom.graph') }}"
               class="group relative overflow-hidden rounded-2xl shadow-xl bg-neutral-800 transition-transform duration-500 hover:scale-[1.015] hover:shadow-2xl"
               data-aos="fade-up" data-aos-delay="{{ count($projects) * 100 }}">

                <img src="{{ asset('images/graph.png') }}" alt="Hardcoded Project"
                     class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-105 group-hover:brightness-95">

                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 md:p-8">
                    <h2 class="text-white text-xl font-semibold uppercase mb-2 tracking-wide">
                        AI-model graph
                    </h2>
                    <p class="text-sm text-gray-300 leading-relaxed">A prototyping challenge to explore AI-model performance across various use cases.</p>
                </div>
            </a>
            
            {{-- Loop over dynamic projects --}}
            @foreach ($projects as $project)
                <a href="{{ route('projects.show', $project) }}"
                   class="group relative overflow-hidden rounded-2xl shadow-xl bg-neutral-800 transition-transform duration-500 hover:scale-[1.015] hover:shadow-2xl"
                   data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                    @if ($project->image)
                        <img src="{{ asset($project->image) }}" alt="{{ $project->title }}"
                             class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-105 group-hover:brightness-95">
                    @endif

                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 md:p-8">
                        <h2 class="text-white text-xl font-semibold uppercase mb-2 tracking-wide">
                            {{ $project->title }}
                        </h2>
                        <p class="text-sm text-gray-300 leading-relaxed">{{ Str::limit($project->description, 90) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</x-layout>