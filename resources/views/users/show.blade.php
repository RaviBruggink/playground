<x-layout>
    <div class="mx-6 md:mx-16 flex justify-center">
        <div class="w-full mt-20 bg-neutral-800 text-white p-10 shadow-xl rounded-2xl">
            <h2 class="text-3xl font-light uppercase tracking-wide mb-10 border-b border-white/10 pb-4">
                Gebruiker
            </h2>
    
            <div class="mb-6">
                <span class="block text-sm uppercase text-gray-400 mb-1">Naam</span>
                <span class="text-lg font-medium text-white">{{ $user->name }}</span>
            </div>
    
            <div class="mb-6">
                <span class="block text-sm uppercase text-gray-400 mb-1">E-mailadres</span>
                <span class="text-lg text-gray-300">{{ $user->email }}</span>
            </div>
    
            <div class="mb-6">
                <span class="block text-sm uppercase text-gray-400 mb-1">Geregistreerd op</span>
                <span class="text-lg text-gray-400">{{ $user->created_at->format('F j, Y') }}</span>
            </div>
    
            <div class="flex justify-between items-center mt-12 flex-col-reverse sm:flex-row gap-4">
                <a href="{{ route('users.index') }}"
                   class="text-sm text-gray-400 hover:text-white hover:underline transition">
                   ← Terug naar overzicht
                </a>
    
                <form action="{{ route('users.destroy', $user) }}" method="POST"
                      onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm rounded-full font-semibold transition">
                        Verwijder gebruiker
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>