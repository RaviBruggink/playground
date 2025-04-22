<x-layout>
    {{-- ABOUT SECTION --}}
    <section class="py-32 px-6 md:px-16 xl:px-32 bg-neutral-900 text-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            {{-- FOTO --}}
            <div class="flex justify-center">
                <img src="{{ asset('images/ravi.jpeg') }}"
                     alt="Foto van Ravi"
                     class="rounded-2xl w-64 h-64 object-cover shadow-xl ring-2 ring-white/10">
            </div>

            {{-- INTRO --}}
            <div>
                <h2 class="text-4xl font-light uppercase tracking-wide mb-6 text-white">
                    Hey, ik ben <span class="underline underline-offset-4 decoration-white/20">Ravi</span>
                </h2>
                <p class="text-lg text-gray-400 leading-relaxed">
                    Ik ben een 25-jarige front-end developer met een passie voor het combineren van design en techniek. 
                    Als ik niet achter mijn laptop zit, ben ik graag buiten – op zoek naar inspiratie in de natuur.
                    <br><br>
                    Met een leergierige houding en creatieve drive werk ik graag aan digitale ervaringen die impact maken.
                </p>
            </div>
        </div>
    </section>

    {{-- SKILLS --}}
    <section class="bg-neutral-900 text-white py-28 px-6 md:px-16 xl:px-32">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-3xl md:text-4xl font-light text-center uppercase tracking-wider mb-20">
                Skills & Tools
            </h3>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8">
                @foreach ([
                    ['React', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg'],
                    ['Laravel', 'images/laravel-svgrepo-com.svg'],
                    ['JavaScript', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg'],
                    ['Git', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg'],
                    ['Jira', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jira/jira-original.svg'],
                    ['Tailwind', 'images/tailwind-svgrepo-com.svg'],
                    ['Figma', 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg'],
                ] as [$name, $url])
                    <div class="bg-neutral-800 border border-white/5 rounded-xl p-6 flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 group">
                        <img src="{{ $url }}"
                             alt="{{ $name }}"
                             class="w-10 h-10 grayscale group-hover:grayscale-0 transition duration-300">
                        <span class="mt-3 text-sm text-gray-400 group-hover:text-white transition duration-200 font-medium">
                            {{ $name }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>