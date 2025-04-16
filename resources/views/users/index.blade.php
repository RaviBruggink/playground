@php
    $cell = 'px-6 py-4 text-sm';
    $header = "$cell text-left font-medium text-gray-500 uppercase";
@endphp

<x-layout>
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mt-6 mb-4 gap-4">
        <h2 class="text-2xl font-semibold">Users</h2>
        <div class="flex justify-start md:justify-end">
            <x-button href="{{ route('users.create') }}">+ Create User</x-button>
        </div>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    @foreach (['#', 'Name', 'Email', 'Created At'] as $col)
                        <th class="{{ $header }}">{{ $col }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $i => $user)
                    <tr onclick="window.location='{{ route('users.show', $user) }}'" class="hover:bg-gray-50 cursor-pointer transition">
                        <td class="{{ $cell }} text-gray-700">{{ $i + 1 }}</td>
                        <td class="{{ $cell }} text-gray-900 font-medium">{{ $user->name }}</td>
                        <td class="{{ $cell }} text-gray-700">{{ $user->email }}</td>
                        <td class="{{ $cell }} text-gray-500">{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
