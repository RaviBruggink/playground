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
    <div class="px-6 md:px-16">
        <!-- Project List -->
        <div class="border-t border-white/20">
            @foreach ($projects as $index => $project)
                <a href="{{ route('projects.show', $project) }}" 
                   class="group block py-8 border-b border-white/20 hover:opacity-50 transition-opacity">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-1 font-mono text-sm">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="col-span-4 font-mono uppercase">
                            {{ $project->title }}
                        </div>
                        <div class="col-span-3 font-mono text-white/60">
                            {{ $project->category ?? 'NARRATIVE' }}
                        </div>
                        <div class="col-span-2 font-mono text-white/60">
                            {{ $project->duration ?? '02\' 47"' }}
                        </div>
                        <div class="col-span-2 font-mono text-white/60 text-right">
                            {{ $project->year ?? '2024' }}
                        </div>
                    </div>
                </a>
            @endforeach

            <!-- Hardcoded Graph Project -->
            <a href="{{ route('projects.custom.graph') }}" 
               class="group block py-8 border-b border-white/20 hover:opacity-50 transition-opacity">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="col-span-1 font-mono text-sm">
                        {{ str_pad(count($projects) + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>
                    <div class="col-span-4 font-mono uppercase">
                        AI Model Graph
                    </div>
                    <div class="col-span-3 font-mono text-white/60">
                        DATA
                    </div>
                    <div class="col-span-2 font-mono text-white/60">
                        03\' 49"
                    </div>
                    <div class="col-span-2 font-mono text-white/60 text-right">
                        2024
                    </div>
                </div>
            </a>
        </div>

        <!-- Japanese Text -->
        <div class="fixed bottom-8 left-8 text-5xl font-bold opacity-10 select-none pointer-events-none">
            えいかかんとく
        </div>
    </div>
</x-layout>