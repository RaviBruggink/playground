<x-layout>
    <div class="w-full max-w-xl mx-auto mt-10 sm:mt-20 bg-neutral-800 text-white px-6 py-8 sm:p-10 rounded-2xl shadow-xl">
        <h2 class="text-2xl sm:text-3xl font-light uppercase tracking-wide mb-8 sm:mb-10 text-center">
            Nieuwe Gebruiker
        </h2>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- NAAM --}}
            <div>
                <label class="block text-sm uppercase font-semibold text-gray-400 mb-2">Naam</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full px-4 py-2 bg-neutral-800 text-white border border-white/10 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-white transition duration-200"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm uppercase font-semibold text-gray-400 mb-2">E-mailadres</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 bg-neutral-800 text-white border border-white/10 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-white transition duration-200"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ACTIES --}}
            <div class="flex flex-col sm:flex-row justify-between gap-3 pt-6">
                <x-button href="{{ route('users.index') }}" variant="passive" class="w-full sm:w-auto">
                    Annuleren
                </x-button>

                <x-button type="submit" class="w-full sm:w-auto">
                    Opslaan
                </x-button>
            </div>
        </form>
    </div>
</x-layout>