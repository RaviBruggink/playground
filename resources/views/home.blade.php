<x-layout>
    <h1 class="text-2xl font-bold mb-4">Hello from the home page</h1>

    <h2 class="text-xl font-semibold mt-6 mb-3">Users</h2>
    @foreach ($users as $user)
        <div class="bg-white shadow p-4 rounded mb-3">
            <strong>{{ $user->name }}</strong> – {{ $user->email }}
        </div>
    @endforeach
</x-layout>
