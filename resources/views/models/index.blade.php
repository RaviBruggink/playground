<x-layout>
    <section class="px-6 md:px-16 pt-20 bg-neutral-900 text-neutral-800">

        <!-- =================== Container: Chart & Filters =================== -->
        <div class="my-12 bg-gray-50 p-6 rounded-xl shadow-sm border border-gray-200 relative">

            <!-- Colorblind Mode Toggle -->
            <div class="absolute right-6 top-6">
                <button id="toggleColorblindMode" aria-label="Toggle Colorblind Mode" class="group p-2 bg-neutral-700 text-white rounded-full hover:bg-neutral-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-palette">
                        <path d="M12 22a1 1 0 0 1 0-20 10 9 0 0 1 10 9 5 5 0 0 1-5 5h-2.25a1.75 1.75 0 0 0-1.4 2.8l.3.4a1.75 1.75 0 0 1-1.4 2.8z" />
                        <circle cx="13.5" cy="6.5" r=".5" fill="currentColor" />
                        <circle cx="17.5" cy="10.5" r=".5" fill="currentColor" />
                        <circle cx="6.5" cy="12.5" r=".5" fill="currentColor" />
                        <circle cx="8.5" cy="7.5" r=".5" fill="currentColor" />
                    </svg>
                </button>
            </div>

            <!-- Title & Description -->
            <h3 class="text-xl font-semibold">Modelvoorkeur per Use Case</h3>
            <p class="text-md mb-8 w-2/3">
                De scores in deze grafiek geven aan hoe vaak het antwoord van een AI-model als het beste werd gekozen door gebruikers tijdens tests binnen een specifieke use case.
            </p>

            <!-- Chart Container -->
            <div class="overflow-x-auto">
                <div class="w-full h-[400px] relative">
                    <canvas id="modelChart" class="absolute top-0 left-0 w-full h-full"></canvas>
                </div>
            </div>

            <!-- Model Filters -->
            <div id="modelLegend" class="flex flex-wrap gap-4 mb-6 text-sm font-medium text-gray-700 mt-10">
                @php
                    $models = [
                        ['label' => 'GPT-4o', 'color' => '#3b82f6'],
                        ['label' => 'Gemma (Ollama)', 'color' => '#10b981'],
                        ['label' => 'Llama3', 'color' => '#f97316'],
                        ['label' => 'LLaMa 3.3', 'color' => '#22d3ee'],
                        ['label' => 'Claude 3.5 Sonnet', 'color' => '#c084fc'],
                        ['label' => 'Claude 3.5 Haiku', 'color' => '#ec4899'],
                        ['label' => 'Claude 3.7 Sonnet', 'color' => '#f59e0b'],
                    ];
                @endphp

                @foreach ($models as $model)
                    <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="{{ $model['label'] }}">
                        <span class="w-3 h-3 rounded-full" style="background-color: {{ $model['color'] }};"></span> {{ $model['label'] }}
                    </div>
                @endforeach
            </div>

            <!-- Use Case Filters -->
            <div id="useCaseLegend" class="flex flex-wrap gap-4 mb-6 text-sm font-medium text-gray-700">
                @php
                    $useCases = [
                        'HR & communicatie', 'Technische documentatie', 'Code & reviewondersteuning',
                        'Beleids- en teamtaken', 'Marketing & content', 'Onderzoek & analyse',
                        'Klantenservice & support', 'Testen & validatie'
                    ];
                @endphp

                @foreach ($useCases as $useCase)
                    <div class="cursor-pointer px-3 py-1 rounded-full bg-neutral-200 hover:bg-neutral-300 transition usecase-toggle" data-usecase="{{ $useCase }}">
                        {{ $useCase }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- =================== Scripts =================== -->

        <!-- Chart.js Library -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const models = @json($models);
            const allUseCases = @json($useCases);

            const modelScores = {
                'GPT-4o': {'HR & communicatie': 32, 'Technische documentatie': 33, 'Code & reviewondersteuning': 27, 'Beleids- en teamtaken': 30, 'Marketing & content': 30, 'Onderzoek & analyse': 32, 'Klantenservice & support': 31, 'Testen & validatie': 30},
                'Gemma (Ollama)': {'HR & communicatie': 32, 'Technische documentatie': 23, 'Code & reviewondersteuning': 22, 'Beleids- en teamtaken': 33, 'Marketing & content': 27, 'Onderzoek & analyse': 31, 'Klantenservice & support': 22, 'Testen & validatie': 21},
                'Llama3': {'HR & communicatie': 24, 'Technische documentatie': 25, 'Code & reviewondersteuning': 24, 'Beleids- en teamtaken': 23, 'Marketing & content': 24, 'Onderzoek & analyse': 25, 'Klantenservice & support': 22, 'Testen & validatie': 23},
                'LLaMa 3.3': {'HR & communicatie': 25, 'Technische documentatie': 27, 'Code & reviewondersteuning': 26, 'Beleids- en teamtaken': 24, 'Marketing & content': 25, 'Onderzoek & analyse': 26, 'Klantenservice & support': 24, 'Testen & validatie': 24},
                'Claude 3.5 Sonnet': {'HR & communicatie': 30, 'Technische documentatie': 31, 'Code & reviewondersteuning': 31, 'Beleids- en teamtaken': 32, 'Marketing & content': 30, 'Onderzoek & analyse': 30, 'Klantenservice & support': 31, 'Testen & validatie': 30},
                'Claude 3.5 Haiku': {'HR & communicatie': 28, 'Technische documentatie': 30, 'Code & reviewondersteuning': 29, 'Beleids- en teamtaken': 28, 'Marketing & content': 29, 'Onderzoek & analyse': 28, 'Klantenservice & support': 27, 'Testen & validatie': 28},
                'Claude 3.7 Sonnet': {'HR & communicatie': 31, 'Technische documentatie': 35, 'Code & reviewondersteuning': 33, 'Beleids- en teamtaken': 29, 'Marketing & content': 29, 'Onderzoek & analyse': 30, 'Klantenservice & support': 31, 'Testen & validatie': 31}
            };

            const originalColors = Object.fromEntries(models.map(m => [m.label, m.color]));
            const colorblindColors = {
                'GPT-4o': '#0072B2', 'Gemma (Ollama)': '#009E73', 'Llama3': '#E69F00',
                'LLaMa 3.3': '#56B4E9', 'Claude 3.5 Sonnet': '#CC79A7', 'Claude 3.5 Haiku': '#F0E442', 'Claude 3.7 Sonnet': '#D55E00'
            };

            let visibleModels = new Set(models.map(m => m.label));
            let visibleUseCases = new Set(allUseCases);
            let colorblindMode = false;

            const ctx = document.getElementById('modelChart').getContext('2d');

            function buildDatasets() {
                return models.filter(m => visibleModels.has(m.label)).map(model => ({
                    label: model.label,
                    data: Array.from(visibleUseCases).map(uc => modelScores[model.label][uc]),
                    backgroundColor: model.color,
                    borderRadius: 8,
                    borderSkipped: false
                }));
            }

            const chart = new Chart(ctx, {
                type: 'bar',
                data: { labels: Array.from(visibleUseCases), datasets: buildDatasets() },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, ticks: { color: '#4b5563', stepSize: 5 }, grid: { color: 'rgba(0,0,0,0.05)' } },
                        x: { ticks: { color: '#4b5563' }, grid: { color: 'rgba(0,0,0,0.05)' } }
                    },
                    plugins: { legend: { display: false }, title: { display: false } }
                }
            });

            function updateChart() {
                chart.data.labels = Array.from(visibleUseCases);
                chart.data.datasets = buildDatasets();
                chart.update();
            }

            document.getElementById('modelLegend').addEventListener('click', (e) => {
                const el = e.target.closest('.model-toggle');
                if (!el) return;

                const model = el.dataset.model;

                if (visibleModels.size === models.length) {
                    visibleModels = new Set([model]);
                } else {
                    visibleModels.has(model) ? visibleModels.delete(model) : visibleModels.add(model);
                    if (!visibleModels.size) visibleModels = new Set(models.map(m => m.label));
                }

                updateChart();

                document.querySelectorAll('.model-toggle').forEach(btn => {
                    btn.classList.toggle('line-through', !visibleModels.has(btn.dataset.model));
                    btn.classList.toggle('opacity-50', !visibleModels.has(btn.dataset.model));
                });
            });

            document.getElementById('useCaseLegend').addEventListener('click', (e) => {
                const el = e.target.closest('.usecase-toggle');
                if (!el) return;

                const uc = el.dataset.usecase;

                if (visibleUseCases.size === allUseCases.length) {
                    visibleUseCases = new Set([uc]);
                } else {
                    visibleUseCases.has(uc) ? visibleUseCases.delete(uc) : visibleUseCases.add(uc);
                    if (!visibleUseCases.size) visibleUseCases = new Set(allUseCases);
                }

                updateChart();

                document.querySelectorAll('.usecase-toggle').forEach(btn => {
                    btn.classList.toggle('line-through', !visibleUseCases.has(btn.dataset.usecase));
                    btn.classList.toggle('opacity-50', !visibleUseCases.has(btn.dataset.usecase));
                });
            });

            document.getElementById('toggleColorblindMode').addEventListener('click', () => {
                colorblindMode = !colorblindMode;
                models.forEach(model => {
                    model.color = colorblindMode ? colorblindColors[model.label] : originalColors[model.label];
                });
                document.querySelectorAll('.model-toggle span').forEach(el => {
                    const label = el.parentNode.dataset.model;
                    el.style.backgroundColor = colorblindMode ? colorblindColors[label] : originalColors[label];
                });
                updateChart();
            });
        </script>

    </section>
</x-layout>
