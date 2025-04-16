<x-layout>
    <h1 class="text-2xl font-bold mb-4">My Projects</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($projects as $project)
            <a href="{{ route('projects.show', $project) }}" class="block border rounded p-4 shadow hover:shadow-lg">
                @if ($project->image)
                    <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" class="mb-2 w-full h-48 object-cover">
                @endif
                <h2 class="text-xl font-semibold">{{ $project->title }}</h2>
                <p class="text-gray-600">{{ Str::limit($project->description, 100) }}</p>
            </a>
        @endforeach
    </div>
</x-layout>
