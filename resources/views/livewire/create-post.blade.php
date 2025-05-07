<div class="p-4 text-white">
    <h1 class="text-xl font-bold mb-4">Livewire Post Creator</h1>

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="title" class="block font-semibold">Title</label>
            <input
                type="text"
                wire:model.live="title"
                id="title"
                class="text-neutral-900 border p-2 w-full {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }}"
                placeholder="Enter title"
            />
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold">Email</label>
            <input
                type="email"
                wire:model.live="email"
                id="email"
                class="text-neutral-900 border p-2 w-full {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                placeholder="Enter your email"
            />
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Submit
        </button>
    </form>

    <p class="mt-4">
        Live Preview: <strong>{{ $title }}</strong> by <strong>{{ $email }}</strong>
    </p>

    @if ($submitted)
        <p class="mt-2 text-green-600 font-semibold">Form submitted successfully!</p>
    @endif
</div>
