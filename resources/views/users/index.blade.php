@php
    $cell = 'px-6 py-4 text-sm';
    $header = "$cell text-left font-semibold text-gray-400 uppercase tracking-wide";
@endphp

<x-layout>
    <section class="px-6 md:px-16 py-20 bg-neutral-900 text-white">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-600/10 text-green-300 rounded-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-12 gap-6">
            <h2 class="text-3xl md:text-4xl font-light uppercase tracking-wide">
                Gebruikers
            </h2>
            <div>
                <x-button href="{{ route('users.create') }}">
                    + Nieuwe gebruiker
                </x-button>
            </div>
        </div>

        <div class="overflow-x-auto rounded-xl shadow-lg bg-neutral-800">
            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-neutral-800">
                    <tr>
                        @foreach (['#', 'Naam', 'E-mail', 'Aangemaakt op'] as $col)
                            <th class="{{ $header }}">{{ $col }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($users as $i => $user)
                        <tr onclick="window.location='{{ route('users.show', $user) }}'"
                            class="hover:bg-neutral-700 cursor-pointer transition-colors duration-150">
                            <td class="{{ $cell }} text-gray-400">{{ $i + 1 }}</td>
                            <td class="{{ $cell }} text-white font-medium">{{ $user->name }}</td>
                            <td class="{{ $cell }} text-gray-300">{{ $user->email }}</td>
                            <td class="{{ $cell }} text-gray-500">
                                {{ $user->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layout>