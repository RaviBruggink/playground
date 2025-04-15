<x-layout>
    <div class="max-w-2xl mx-auto mt-8 bg-white p-6 shadow rounded">
        <h2 class="text-2xl font-bold mb-4">User Details</h2>

        <div class="mb-4">
            <span class="font-semibold text-gray-700">Name:</span>
            <span>{{ $user->name }}</span>
        </div>

        <div class="mb-4">
            <span class="font-semibold text-gray-700">Email:</span>
            <span>{{ $user->email }}</span>
        </div>

        <div class="mb-4">
            <span class="font-semibold text-gray-700">Joined:</span>
            <span>{{ $user->created_at->format('F j, Y') }}</span>
        </div>

        <a href="{{ route('users.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">← Back to users</a>
    </div>
</x-layout>
