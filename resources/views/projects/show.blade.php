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
    <article class="min-h-screen">
        <!-- Hero Image -->
        @if ($project->image)
            <div class="h-[80vh] w-full relative overflow-hidden">
                <img src="{{ asset($project->image) }}" 
                     alt="{{ $project->title }}"
                     class="absolute inset-0 w-full h-full object-cover">
            </div>
        @endif

        <!-- Content -->
        <div class="px-6 md:px-16 py-24">
            <!-- Project Info -->
            <div class="grid grid-cols-12 gap-4 border-t border-b border-white/20 py-8">
                <div class="col-span-4 font-mono uppercase">
                    {{ $project->title }}
                </div>
                <div class="col-span-3 font-mono text-white/60">
                    {{ $project->category ?? 'NARRATIVE' }}
                </div>
                <div class="col-span-3 font-mono text-white/60">
                    {{ $project->duration ?? '02\' 47"' }}
                </div>
                <div class="col-span-2 font-mono text-white/60 text-right">
                    {{ $project->year ?? '2024' }}
                </div>
            </div>

            <!-- Project Description -->
            <div class="max-w-3xl mt-24 mb-32">
                <p class="text-lg leading-relaxed font-mono text-white/80">
                    {{ $project->description }}
                </p>
                @if ($project->extra_text)
                    <p class="mt-8 text-lg leading-relaxed font-mono text-white/80">
                        {{ $project->extra_text }}
                    </p>
                @endif
            </div>

            <!-- Additional Images -->
            @if ($project->image)
                <div class="grid grid-cols-2 gap-8">
                    <img src="{{ asset($project->image) }}" 
                         alt="{{ $project->title }} detail 1"
                         class="w-full aspect-[4/3] object-cover">
                    <img src="{{ asset($project->image) }}" 
                         alt="{{ $project->title }} detail 2"
                         class="w-full aspect-[4/3] object-cover">
                </div>
            @endif

            <!-- Back Link -->
            <div class="mt-24 inline-block">
                <a href="{{ route('projects.index') }}" 
                   class="font-mono text-sm uppercase hover:opacity-50 transition-opacity">
                    ← Back to overview
                </a>
            </div>
        </div>

        <!-- Japanese Text -->
        <div class="fixed bottom-8 left-8 text-5xl font-bold opacity-10 select-none pointer-events-none">
            プロジェクト
        </div>
    </article>
</x-layout>