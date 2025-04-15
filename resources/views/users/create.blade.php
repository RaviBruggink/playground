<x-layout>
    <div class="max-w-xl mx-auto mt-8 bg-white p-6 shadow rounded">
        <h2 class="text-2xl font-bold mb-6">Create New User</h2>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium text-sm text-gray-700">Name</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded shadow-sm" value="{{ old('name') }}">
                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border-gray-300 rounded shadow-sm" value="{{ old('email') }}">
                @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <x-button href="{{ route('users.index') }}" variant="passive">
                    Cancel
                </x-button>
            
                <x-button type="submit">
                    Create
                </x-button>
            </div>                    
        </form>
    </div>
</x-layout>
