@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800,
        });
    </script>
@endpush

<x-layout>
    <div class="min-h-screen px-6 md:px-16">
        <!-- Overview Section -->
        <div class="grid grid-cols-12 gap-4 border-t border-white/20 py-16">
            <div class="col-span-4 font-mono uppercase">
                Overview
            </div>
            <div class="col-span-8">
                <p class="font-mono text-lg leading-relaxed text-white/80 max-w-2xl">
                    I'm Ravi — a 25-year-old front-end developer combining design, code, and curiosity.
                    Whether I'm sketching wireframes or exploring nature, I'm always chasing ideas that matter.
                </p>
            </div>
        </div>

        <!-- Skills Section -->
        <div class="grid grid-cols-12 gap-4 border-t border-white/20 py-16">
            <div class="col-span-4 font-mono uppercase">
                Skills & Tools
            </div>
            <div class="col-span-8 grid grid-cols-3 gap-8">
                @foreach ([
                    ['name' => 'React',      'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg'],
                    ['name' => 'Laravel',    'icon' => asset('storage/images/laravel-svgrepo-com.svg')],
                    ['name' => 'JavaScript', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg'],
                    ['name' => 'Git',        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg'],
                    ['name' => 'Jira',       'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jira/jira-original.svg'],
                    ['name' => 'Tailwind',   'icon' => asset('storage/images/tailwind-svgrepo-com.svg')],
                    ['name' => 'Figma',      'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg'],
                ] as $skill)
                    <div class="flex items-center gap-4 group">
                        <img src="{{ $skill['icon'] }}" 
                             alt="{{ $skill['name'] }}" 
                             class="w-6 h-6 grayscale group-hover:grayscale-0 transition duration-300 invert">
                        <span class="font-mono text-white/60 group-hover:text-white transition-colors">
                            {{ $skill['name'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Profile Image -->
        <div class="grid grid-cols-12 gap-4 border-t border-white/20 py-16">
            <div class="col-span-4 font-mono uppercase">
                Profile
            </div>
            <div class="col-span-8">
                <img src="{{ asset('storage/images/ravi.jpeg') }}"
                     alt="Foto van Ravi"
                     class="w-64 h-64 object-cover grayscale hover:grayscale-0 transition-all duration-500">
            </div>
        </div>
    </div>
</x-layout>