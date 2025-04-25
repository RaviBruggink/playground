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

    <section class="px-6 md:px-16 py-20 bg-white text-neutral-800">
        <div class="my-12 bg-gray-50 p-6 rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-xl font-semibold mb-4">Modelvoorkeur per Use Case</h3>

            <!-- Legenda + model filter -->
            <div id="modelLegend" class="flex flex-wrap gap-4 mb-6 text-sm font-medium text-gray-700">
                <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="GPT-4o">
                    <span class="w-3 h-3 rounded-full bg-blue-500"></span> GPT-4o
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="Moonly LLaMA 3">
                    <span class="w-3 h-3 rounded-full bg-fuchsia-500"></span> Moonly LLaMA 3
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="Gemma (Ollama)">
                    <span class="w-3 h-3 rounded-full bg-green-500"></span> Gemma (Ollama)
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="Gemini 1.5 Pro">
                    <span class="w-3 h-3 rounded-full bg-yellow-500"></span> Gemini 1.5 Pro
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="Claude 3 Sonnet">
                    <span class="w-3 h-3 rounded-full bg-purple-500"></span> Claude 3 Sonnet
                </div>
            </div>

            <!-- Use Case Filter -->
            <div id="useCaseLegend" class="flex flex-wrap gap-4 mb-6 text-sm font-medium text-gray-700">
                @foreach (['Sales', 'Bugfixing', 'Code review', 'Documentation', 'Marketing', 'Research', 'Design', 'Testing', 'Deployment', 'Support'] as $useCase)
                    <div class="cursor-pointer px-3 py-1 rounded-full bg-neutral-200 hover:bg-neutral-300 transition usecase-toggle"
                        data-usecase="{{ $useCase }}">
                        {{ $useCase }}
                    </div>
                @endforeach
            </div>

            <!-- Grafiek div -->
            <div class="overflow-x-auto">
                <div class="w-full h-[400px] relative">
                    <canvas id="modelChart" class="!absolute !top-0 !left-0 !w-full !h-full"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafiek script -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('modelChart').getContext('2d');

            const allUseCases = [
                'Sales', 'Bugfixing', 'Code review', 'Documentation', 'Marketing',
                'Research', 'Design', 'Testing', 'Deployment', 'Support'
            ];

            const models = [
                {
                    label: 'GPT-4o',
                    color: '#3b82f6',
                    scores: {
                        Sales: 28, Bugfixing: 32, 'Code review': 30, Documentation: 27,
                        Marketing: 25, Research: 29, Design: 26, Testing: 30,
                        Deployment: 28, Support: 31
                    }
                },
                {
                    label: 'Moonly LLaMA 3',
                    color: '#d946ef',
                    scores: {
                        Sales: 22, Bugfixing: 20, 'Code review': 23, Documentation: 21,
                        Marketing: 24, Research: 22, Design: 23, Testing: 20,
                        Deployment: 21, Support: 22
                    }
                },
                {
                    label: 'Gemma (Ollama)',
                    color: '#10b981',
                    scores: {
                        Sales: 24, Bugfixing: 23, 'Code review': 22, Documentation: 25,
                        Marketing: 26, Research: 24, Design: 22, Testing: 23,
                        Deployment: 25, Support: 24
                    }
                },
                {
                    label: 'Gemini 1.5 Pro',
                    color: '#fde047',
                    scores: {
                        Sales: 27, Bugfixing: 26, 'Code review': 28, Documentation: 25,
                        Marketing: 27, Research: 26, Design: 27, Testing: 28,
                        Deployment: 26, Support: 27
                    }
                },
                {
                    label: 'Claude 3 Sonnet',
                    color: '#a78bfa',
                    scores: {
                        Sales: 23, Bugfixing: 21, 'Code review': 22, Documentation: 24,
                        Marketing: 23, Research: 22, Design: 24, Testing: 23,
                        Deployment: 22, Support: 23
                    }
                }
            ];

            let visibleModels = new Set(models.map(m => m.label));
            let visibleUseCases = new Set(allUseCases);

            function buildDatasets() {
                return models
                    .filter(model => visibleModels.has(model.label))
                    .map(model => ({
                        label: model.label,
                        data: Array.from(visibleUseCases).map(useCase => model.scores[useCase]),
                        backgroundColor: model.color,
                        borderRadius: 8,
                        borderSkipped: false
                    }));
            }

            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Array.from(visibleUseCases),
                    datasets: buildDatasets()
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#4b5563',
                                stepSize: 5
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#4b5563'
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        title: { display: false }
                    }
                }
            });

            function updateChart() {
                chart.data.labels = Array.from(visibleUseCases);
                chart.data.datasets = buildDatasets();
                chart.update();
            }

            // === Model filter behavior ===
            document.querySelectorAll('.model-toggle').forEach(el => {
                el.addEventListener('click', () => {
                    const model = el.dataset.model;

                    if (visibleModels.size === models.length) {
                        visibleModels = new Set([model]);
                    } else {
                        if (visibleModels.has(model)) {
                            visibleModels.delete(model);
                            if (visibleModels.size === 0) {
                                visibleModels = new Set(models.map(m => m.label));
                            }
                        } else {
                            visibleModels.add(model);
                        }
                    }

                    document.querySelectorAll('.model-toggle').forEach(btn => {
                        const label = btn.dataset.model;
                        if (visibleModels.has(label)) {
                            btn.classList.remove('line-through', 'opacity-50');
                        } else {
                            btn.classList.add('line-through', 'opacity-50');
                        }
                    });

                    updateChart();
                });
            });

            // === Use case filter behavior ===
            document.querySelectorAll('.usecase-toggle').forEach(el => {
                el.addEventListener('click', () => {
                    const uc = el.dataset.usecase;

                    if (visibleUseCases.size === allUseCases.length) {
                        visibleUseCases = new Set([uc]);
                    } else {
                        if (visibleUseCases.has(uc)) {
                            visibleUseCases.delete(uc);
                            if (visibleUseCases.size === 0) {
                                visibleUseCases = new Set(allUseCases);
                            }
                        } else {
                            visibleUseCases.add(uc);
                        }
                    }

                    document.querySelectorAll('.usecase-toggle').forEach(btn => {
                        const usecase = btn.dataset.usecase;
                        if (visibleUseCases.has(usecase)) {
                            btn.classList.remove('line-through', 'opacity-50');
                        } else {
                            btn.classList.add('line-through', 'opacity-50');
                        }
                    });

                    updateChart();
                });
            });
        </script>
    </section>
</x-layout>