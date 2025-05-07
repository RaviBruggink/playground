{{-- resources/views/models.blade.php --}}

@php
    $serviceColors = [
        'OpenAI'    => 'bg-red-400 text-white',
        'Anthropic' => 'bg-purple-400 text-white',
        'Ollama'    => 'bg-blue-300 text-white',
    ];

    $labelGradients = [
        'Debugging'         => 'bg-gradient-to-r from-pink-500 to-pink-700 text-white',
        'Algebra'           => 'bg-gradient-to-r from-orange-400 to-orange-600 text-white',
        'Code Translation'  => 'bg-gradient-to-r from-indigo-500 to-indigo-800 text-white',
        'Legal/Medical'     => 'bg-gradient-to-r from-red-500 to-red-700 text-white',
        'Conversational'    => 'bg-gradient-to-r from-pink-400 to-pink-600 text-white',
    ];

    $models = [
        [
            'type'          => 'LLM',
            'service'       => 'OpenAI',
            'labels'        => ['Debugging'],
            'name'          => 'GPT-4o',
            'distributions' => 32,
            'creator'       => 'Aurora',
            'last_update'   => '9 maanden geleden',
        ],
        [
            'type'          => 'LLM',
            'service'       => 'OpenAI',
            'labels'        => ['Algebra'],
            'name'          => 'GPT-3',
            'distributions' => 2,
            'creator'       => 'Aurora',
            'last_update'   => '4 maanden geleden',
        ],
        [
            'type'          => 'LLM',
            'service'       => 'Anthropic',
            'labels'        => ['Code Translation'],
            'name'          => 'Claude 3.5 Haiku',
            'distributions' => 1,
            'creator'       => 'Lars Dekker',
            'last_update'   => '6 maanden geleden',
        ],
        [
            'type'          => 'LLM',
            'service'       => 'Anthropic',
            'labels'        => ['Legal/Medical'],
            'name'          => 'Claude 3.5 Sonnet',
            'distributions' => 1,
            'creator'       => 'Aurora',
            'last_update'   => '2 maanden geleden',
        ],
        [
            'type'          => 'LLM',
            'service'       => 'Ollama',
            'labels'        => ['Conversational'],
            'name'          => 'Gemma',
            'distributions' => 4,
            'creator'       => 'Aurora',
            'last_update'   => '3 maanden geleden',
        ],
    ];
@endphp

<x-layout>
    <div class="p-10 bg-white">
        <h1 class="text-2xl text-neutral-900 font-semibold mb-6">Models</h1>

        <div class="flex justify-end space-x-2 mb-4">
            <button class="px-4 py-2 text-neutral-900 bg-white border border-gray-300 rounded-md text-sm hover:bg-gray-100">
                Test models
            </button>
            <button class="px-4 py-2 bg-gray-900 text-white rounded-md text-sm hover:bg-gray-800">
                Create new +
            </button>
        </div>

        <div class="bg-white border rounded-md shadow-sm overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="border-b bg-gray-50 text-gray-700 font-medium">
                    <tr>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Service</th>
                        <th class="px-4 py-3">Labels</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Distributions</th>
                        <th class="px-4 py-3">Creator</th>
                        <th class="px-4 py-3">Last update</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($models as $model)
                        <tr>
                            {{-- Type --}}
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-black text-white text-xs font-medium rounded">
                                    {{ $model['type'] }}
                                </span>
                            </td>

                            {{-- Service --}}
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs font-medium rounded {{ $serviceColors[$model['service']] }}">
                                    {{ $model['service'] }}
                                </span>
                            </td>

                            {{-- Labels als dropdown --}}
                            <td class="px-4 py-3 space-y-1">
                                @foreach($model['labels'] as $label)
                                    <select
                                        class="label-select pl-3 pr-8 py-1 text-xs font-medium rounded {{ $labelGradients[$label] }}"
                                        onchange="updateLabelGradient(this)"
                                    >
                                        @foreach(array_keys($labelGradients) as $availableLabel)
                                            <option
                                                value="{{ $availableLabel }}"
                                                @selected($availableLabel === $label)
                                            >
                                                {{ $availableLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endforeach
                            </td>

                            {{-- Name, distributions, creator, last update --}}
                            <td class="px-4 py-3 text-neutral-900">{{ $model['name'] }}</td>
                            <td class="px-4 py-3 text-neutral-900">{{ $model['distributions'] }}</td>
                            <td class="px-4 py-3 text-neutral-900">{{ $model['creator'] }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $model['last_update'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        // Mapping van labels -> gradient classes
        const labelGradients = @json($labelGradients);

        // Bij verandering van select: update class
        function updateLabelGradient(selectEl) {
            selectEl.className = [
                'label-select',
                'px-2', 'py-1',
                'text-xs', 'font-medium',
                'rounded', 'w-full',
                labelGradients[ selectEl.value ]
            ].join(' ');
        }

        // Initialisatie bij pageload
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.label-select').forEach(el => updateLabelGradient(el));
        });
    </script>
    @endpush
</x-layout>