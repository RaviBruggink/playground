<x-layout title="Home">

    <section class="h-full flex flex-col items-center py-40 text-center px-4">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
            Hey, I'm <span class="text-indigo-600">Ravi</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-600 max-w-2xl mb-8">
            I develop web applications and love exploring frameworks.
        </p>
        <a href="{{ url('/projects') }}"
            class="inline-block px-6 py-3 bg-indigo-600 text-white text-lg rounded-xl hover:bg-indigo-700 transition">
            View My Work
        </a>
    </section>

    <section class="py-20 bg-gray-100 px-6 md:px-16">
        <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center">Featured Projects</h2>

        @if (!isset($projects) || is_null($projects))
            {{-- Fallback: variable not passed or null --}}
            <div class="max-w-xl mx-auto bg-black text-white rounded-2xl p-10 text-center shadow-lg">
                <h3 class="text-2xl font-bold mb-4">Oops! Something went wrong.</h3>
                <p class="text-gray-300">We couldn’t load the projects right now. Try refreshing or check back later.
                </p>
            </div>
        @elseif($projects->isEmpty())
            {{-- No projects found --}}
            <div class="max-w-xl mx-auto bg-black text-white rounded-2xl p-10 text-center shadow-lg">
                <h3 class="text-2xl font-bold mb-4">Nothing here yet 👀</h3>
                <p class="text-gray-300">Looks like I haven’t added any projects to the portfolio yet. Stay tuned — cool
                    stuff is coming soon.</p>
            </div>
        @else
            {{-- Projects loaded --}}
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
                    <img src="{{ $project->image }}" alt="{{ $project->title }}"
                        class="rounded-xl mb-4 w-full h-48 object-cover">
                    <h3 class="text-xl font-semibold mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->description, 100) }}</p>
                    <a href="{{ route('projects.show', $project) }}"
                        class="text-indigo-600 font-semibold hover:underline">View Project →</a>
                </div>
                
                @endforeach
            </div>
        @endif

        <div class="text-center mt-12">
            <a href="{{ url('/projects') }}" class="text-indigo-600 font-bold hover:underline text-lg">
                See All Projects →
            </a>
        </div>
    </section>


    <section class="bg-white py-20 px-6 md:px-16 text-center rounded-lg">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">About Me</h2>
        <p class="text-gray-600 max-w-2xl mx-auto text-lg leading-relaxed">
            Hi, I'm Ravi, a 25-year-old aspiring creative front-end developer with a love for both the digital and
            physical world. When I'm not shaping ideas on a screen, you can often find me outside, drawing inspiration
            from the peace and beauty of nature. I'm passionate about creating and always eager to learn and grow.
        </p>
        <div class="mt-10">
            <a href="{{ url('/about') }}"
                class="inline-block px-6 py-3 border-2 border-indigo-600 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                Learn More
            </a>
        </div>
    </section>

    <section class="bg-indigo-600 text-white py-16 px-6 md:px-16 mt-20 text-center rounded-lg">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Let’s Work Together</h2>
        <p class="text-lg mb-8">Got a project or just want to say hey?</p>
        <a href="{{ url('/contact') }}"
            class="inline-block bg-white text-indigo-600 px-6 py-3 text-lg font-semibold rounded-xl hover:bg-gray-100 transition">
            Contact Me
        </a>
    </section>

</x-layout>
