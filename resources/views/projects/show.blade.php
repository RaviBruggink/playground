<x-layout>
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-4">{{ $project->title }}</h1>

        @if ($project->image)
            <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" class="mb-4 w-full rounded shadow">
        @endif

        <p class="mb-4">{{ $project->description }}</p>

        @if ($project->extra_text)
            <div class="bg-gray-100 p-4 rounded">
                <h3 class="font-semibold mb-2">More Info</h3>
                <p>{{ $project->extra_text }}</p>
            </div>
        @endif

        <a href="{{ route('projects.index') }}" class="inline-block mt-6 text-blue-500 hover:underline">← Back to all projects</a>
    </div>
</x-layout>
