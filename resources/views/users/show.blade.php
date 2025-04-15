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

        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline">← Back to users</a>

            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">
                    Delete User
                </button>
            </form>
        </div>
    </div>
</x-layout>
