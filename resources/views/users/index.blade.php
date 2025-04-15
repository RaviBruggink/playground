<x-layout>
    <h2 class="text-2xl font-semibold mt-6 mb-4">Users</h2>

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Created At</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $index => $user)
                    <tr onclick="window.location='{{ route('users.show', $user) }}'"
                        class="hover:bg-gray-50 cursor-pointer transition">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
