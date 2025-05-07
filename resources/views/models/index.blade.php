<x-layout>

    <section class="px-6 md:px-16 pt-20 bg-neutral-900 text-neutral-800">
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

            const models = [{
                    label: 'GPT-4o',
                    color: '#3b82f6',
                    scores: {
                        Sales: 20,
                        Bugfixing: 32,
                        'Code review': 30,
                        Documentation: 27,
                        Marketing: 25,
                        Research: 29,
                        Design: 26,
                        Testing: 30,
                        Deployment: 28,
                        Support: 31
                    }
                },
                {
                    label: 'Moonly LLaMA 3',
                    color: '#d946ef',
                    scores: {
                        Sales: 22,
                        Bugfixing: 20,
                        'Code review': 23,
                        Documentation: 21,
                        Marketing: 24,
                        Research: 22,
                        Design: 23,
                        Testing: 20,
                        Deployment: 21,
                        Support: 22
                    }
                },
                {
                    label: 'Gemma (Ollama)',
                    color: '#10b981',
                    scores: {
                        Sales: 24,
                        Bugfixing: 23,
                        'Code review': 22,
                        Documentation: 25,
                        Marketing: 26,
                        Research: 24,
                        Design: 22,
                        Testing: 23,
                        Deployment: 25,
                        Support: 24
                    }
                },
                {
                    label: 'Gemini 1.5 Pro',
                    color: '#fde047',
                    scores: {
                        Sales: 27,
                        Bugfixing: 26,
                        'Code review': 28,
                        Documentation: 25,
                        Marketing: 27,
                        Research: 26,
                        Design: 27,
                        Testing: 28,
                        Deployment: 26,
                        Support: 27
                    }
                },
                {
                    label: 'Claude 3 Sonnet',
                    color: '#a78bfa',
                    scores: {
                        Sales: 23,
                        Bugfixing: 21,
                        'Code review': 22,
                        Documentation: 24,
                        Marketing: 23,
                        Research: 22,
                        Design: 24,
                        Testing: 23,
                        Deployment: 22,
                        Support: 23
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
                        legend: {
                            display: false
                        },
                        title: {
                            display: false
                        }
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

    <section class="px-6 md:px-16">
        <!-- Raw Data Table -->
        <div class="bg-gray-50 p-6 rounded-xl shadow-sm border border-gray-200 text-neutral-900 overflow-x-auto">
          <h3 class="text-xl font-semibold mb-4">Ruwe Data (Tabelweergave)</h3>

          <table class="min-w-full text-sm text-left border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <thead class="bg-neutral-100 text-gray-700 font-semibold uppercase text-xs tracking-wide">
              <tr>
                <th class="px-4 py-3 border border-gray-200">Model</th>
                <script>
                  document.write(
                    allUseCases.map(useCase =>
                      `<th class="px-4 py-3 border border-gray-200">${useCase}</th>`
                    ).join('')
                  );
                </script>
              </tr>
            </thead>
            <tbody id="rawDataTableBody">
              <!-- Rows generated via JS -->
            </tbody>
          </table>
        </div>

        <script>
          function renderRawTable() {
            const tbody = document.getElementById('rawDataTableBody');
            tbody.innerHTML = '';

            models
              .filter(model => visibleModels.has(model.label))
              .forEach(model => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-neutral-50';

                row.innerHTML = `
                  <td class="px-4 py-3 border border-gray-200 font-semibold text-gray-800">${model.label}</td>
                  ${allUseCases.map(uc => {
                    if (!visibleUseCases.has(uc)) {
                      return `<td class="px-4 py-3 border border-gray-200 text-gray-400 italic text-center">-</td>`;
                    }
                    const score = model.scores[uc];
                    return `<td class="px-4 py-3 border border-gray-200 text-center text-sm">${score}</td>`;
                  }).join('')}
                `;
                tbody.appendChild(row);
              });
          }

          // Initial render
          renderRawTable();

          // Sync table with chart filters
          const originalUpdateChart = updateChart;
          updateChart = function () {
            originalUpdateChart();
            renderRawTable();
          };
        </script>
      </section>



    <section class="px-6 md:px-16">
        <!-- Radar Chart Component -->
        <div class="my-12 bg-gray-50 p-6 rounded-xl shadow-sm border border-gray-200 text-neutral-900">
            <h3 class="text-xl font-semibold">Modelvoorkeur per Use Case (Radar Chart)</h3>
            <h4 class="pb-4">Deze radar chart is als winder overzichtelijk ervaren</h4>

            <!-- Legenda + model filter (reuse same buttons as main component) -->
            <div id="modelLegendRadar" class="flex flex-wrap gap-4 mb-6 text-sm font-medium text-gray-700">
                <!-- Same structure as before -->
                <div class="flex items-center gap-2 cursor-pointer model-toggle-radar" data-model="GPT-4o">
                    <span class="w-3 h-3 rounded-full bg-blue-500"></span> GPT-4o
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle-radar" data-model="Moonly LLaMA 3">
                    <span class="w-3 h-3 rounded-full bg-fuchsia-500"></span> Moonly LLaMA 3
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle-radar" data-model="Gemma (Ollama)">
                    <span class="w-3 h-3 rounded-full bg-green-500"></span> Gemma (Ollama)
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle-radar" data-model="Gemini 1.5 Pro">
                    <span class="w-3 h-3 rounded-full bg-yellow-500"></span> Gemini 1.5 Pro
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle-radar" data-model="Claude 3 Sonnet">
                    <span class="w-3 h-3 rounded-full bg-purple-500"></span> Claude 3 Sonnet
                </div>
            </div>

            <!-- Use Case Filter -->
            <div id="useCaseLegendRadar" class="flex flex-wrap gap-4 mb-6 text-sm font-medium text-gray-700">
                @foreach (['Sales', 'Bugfixing', 'Code review', 'Documentation', 'Marketing', 'Research', 'Design', 'Testing', 'Deployment', 'Support'] as $useCase)
                    <div class="cursor-pointer px-3 py-1 rounded-full bg-neutral-200 hover:bg-neutral-300 transition usecase-toggle-radar"
                        data-usecase="{{ $useCase }}">
                        {{ $useCase }}
                    </div>
                @endforeach
            </div>

            <!-- Radar Chart div -->
            <div class="overflow-x-auto">
                <div class="w-full h-[400px] relative">
                    <canvas id="radarModelChart" class="!absolute !top-0 !left-0 !w-full !h-full"></canvas>
                </div>
            </div>
        </div>

        <script>
            const ctxRadar = document.getElementById('radarModelChart').getContext('2d');

            let visibleModelsRadar = new Set(models.map(m => m.label));
            let visibleUseCasesRadar = new Set(allUseCases);

            function buildRadarDatasets() {
                return models
                    .filter(model => visibleModelsRadar.has(model.label))
                    .map(model => ({
                        label: model.label,
                        data: Array.from(visibleUseCasesRadar).map(useCase => model.scores[useCase]),
                        backgroundColor: model.color + '33', // Transparent background
                        borderColor: model.color,
                        pointBackgroundColor: model.color,
                        fill: true,
                        tension: 0.4
                    }));
            }

            const radarChart = new Chart(ctxRadar, {
                type: 'radar',
                data: {
                    labels: Array.from(visibleUseCasesRadar),
                    datasets: buildRadarDatasets()
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            angleLines: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            ticks: {
                                color: '#4b5563',
                                stepSize: 5
                            },
                            pointLabels: {
                                color: '#4b5563'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: false
                        }
                    }
                }
            });

            function updateRadarChart() {
                radarChart.data.labels = Array.from(visibleUseCasesRadar);
                radarChart.data.datasets = buildRadarDatasets();
                radarChart.update();
            }

            // === Model filter behavior for Radar ===
            document.querySelectorAll('.model-toggle-radar').forEach(el => {
                el.addEventListener('click', () => {
                    const model = el.dataset.model;

                    if (visibleModelsRadar.size === models.length) {
                        visibleModelsRadar = new Set([model]);
                    } else {
                        if (visibleModelsRadar.has(model)) {
                            visibleModelsRadar.delete(model);
                            if (visibleModelsRadar.size === 0) {
                                visibleModelsRadar = new Set(models.map(m => m.label));
                            }
                        } else {
                            visibleModelsRadar.add(model);
                        }
                    }

                    document.querySelectorAll('.model-toggle-radar').forEach(btn => {
                        const label = btn.dataset.model;
                        if (visibleModelsRadar.has(label)) {
                            btn.classList.remove('line-through', 'opacity-50');
                        } else {
                            btn.classList.add('line-through', 'opacity-50');
                        }
                    });

                    updateRadarChart();
                });
            });

            // === Use case filter behavior for Radar ===
            document.querySelectorAll('.usecase-toggle-radar').forEach(el => {
                el.addEventListener('click', () => {
                    const uc = el.dataset.usecase;

                    if (visibleUseCasesRadar.size === allUseCases.length) {
                        visibleUseCasesRadar = new Set([uc]);
                    } else {
                        if (visibleUseCasesRadar.has(uc)) {
                            visibleUseCasesRadar.delete(uc);
                            if (visibleUseCasesRadar.size === 0) {
                                visibleUseCasesRadar = new Set(allUseCases);
                            }
                        } else {
                            visibleUseCasesRadar.add(uc);
                        }
                    }

                    document.querySelectorAll('.usecase-toggle-radar').forEach(btn => {
                        const usecase = btn.dataset.usecase;
                        if (visibleUseCasesRadar.has(usecase)) {
                            btn.classList.remove('line-through', 'opacity-50');
                        } else {
                            btn.classList.add('line-through', 'opacity-50');
                        }
                    });

                    updateRadarChart();
                });
            });
        </script>

    </section>

    <section class="px-6 md:px-16">
        <!-- Line Chart Component -->
        <div class="my-12 bg-gray-50 p-6 rounded-xl shadow-sm border border-gray-200 text-neutral-900">
            <h3 class="text-xl font-semibold mb-4">Modelvoorkeur per Use Case (Line Chart)</h3>

            <!-- Legenda + model filter (reuse same buttons) -->
            <div id="modelLegendLine" class="flex flex-wrap gap-4 mb-6 text-sm font-medium text-gray-700">
                <!-- Same buttons again -->
                <div class="flex items-center gap-2 cursor-pointer model-toggle-line" data-model="GPT-4o">
                    <span class="w-3 h-3 rounded-full bg-blue-500"></span> GPT-4o
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle-line" data-model="Moonly LLaMA 3">
                    <span class="w-3 h-3 rounded-full bg-fuchsia-500"></span> Moonly LLaMA 3
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle-line" data-model="Gemma (Ollama)">
                    <span class="w-3 h-3 rounded-full bg-green-500"></span> Gemma (Ollama)
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle-line" data-model="Gemini 1.5 Pro">
                    <span class="w-3 h-3 rounded-full bg-yellow-500"></span> Gemini 1.5 Pro
                </div>
                <div class="flex items-center gap-2 cursor-pointer model-toggle-line" data-model="Claude 3 Sonnet">
                    <span class="w-3 h-3 rounded-full bg-purple-500"></span> Claude 3 Sonnet
                </div>
            </div>

            <!-- Use Case Filter -->
            <div id="useCaseLegendLine" class="flex flex-wrap gap-4 mb-6 text-sm font-medium text-gray-700">
                @foreach (['Sales', 'Bugfixing', 'Code review', 'Documentation', 'Marketing', 'Research', 'Design', 'Testing', 'Deployment', 'Support'] as $useCase)
                    <div class="cursor-pointer px-3 py-1 rounded-full bg-neutral-200 hover:bg-neutral-300 transition usecase-toggle-line"
                        data-usecase="{{ $useCase }}">
                        {{ $useCase }}
                    </div>
                @endforeach
            </div>

            <!-- Line Chart div -->
            <div class="overflow-x-auto">
                <div class="w-full h-[400px] relative">
                    <canvas id="lineModelChart" class="!absolute !top-0 !left-0 !w-full !h-full"></canvas>
                </div>
            </div>
        </div>

        <script>
            const ctxLine = document.getElementById('lineModelChart').getContext('2d');

            let visibleModelsLine = new Set(models.map(m => m.label));
            let visibleUseCasesLine = new Set(allUseCases);

            function buildLineDatasets() {
                return models
                    .filter(model => visibleModelsLine.has(model.label))
                    .map(model => ({
                        label: model.label,
                        data: Array.from(visibleUseCasesLine).map(useCase => model.scores[useCase]),
                        borderColor: model.color,
                        backgroundColor: model.color + '33',
                        tension: 0.4,
                        fill: false,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }));
            }

            const lineChart = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: Array.from(visibleUseCasesLine),
                    datasets: buildLineDatasets()
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#4b5563'
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
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: false
                        }
                    }
                }
            });

            function updateLineChart() {
                lineChart.data.labels = Array.from(visibleUseCasesLine);
                lineChart.data.datasets = buildLineDatasets();
                lineChart.update();
            }

            // === Model filter behavior for Line Chart ===
            document.querySelectorAll('.model-toggle-line').forEach(el => {
                el.addEventListener('click', () => {
                    const model = el.dataset.model;

                    if (visibleModelsLine.size === models.length) {
                        visibleModelsLine = new Set([model]);
                    } else {
                        if (visibleModelsLine.has(model)) {
                            visibleModelsLine.delete(model);
                            if (visibleModelsLine.size === 0) {
                                visibleModelsLine = new Set(models.map(m => m.label));
                            }
                        } else {
                            visibleModelsLine.add(model);
                        }
                    }

                    document.querySelectorAll('.model-toggle-line').forEach(btn => {
                        const label = btn.dataset.model;
                        if (visibleModelsLine.has(label)) {
                            btn.classList.remove('line-through', 'opacity-50');
                        } else {
                            btn.classList.add('line-through', 'opacity-50');
                        }
                    });

                    updateLineChart();
                });
            });

            // === Use case filter behavior for Line Chart ===
            document.querySelectorAll('.usecase-toggle-line').forEach(el => {
                el.addEventListener('click', () => {
                    const uc = el.dataset.usecase;

                    if (visibleUseCasesLine.size === allUseCases.length) {
                        visibleUseCasesLine = new Set([uc]);
                    } else {
                        if (visibleUseCasesLine.has(uc)) {
                            visibleUseCasesLine.delete(uc);
                            if (visibleUseCasesLine.size === 0) {
                                visibleUseCasesLine = new Set(allUseCases);
                            }
                        } else {
                            visibleUseCasesLine.add(uc);
                        }
                    }

                    document.querySelectorAll('.usecase-toggle-line').forEach(btn => {
                        const usecase = btn.dataset.usecase;
                        if (visibleUseCasesLine.has(usecase)) {
                            btn.classList.remove('line-through', 'opacity-50');
                        } else {
                            btn.classList.add('line-through', 'opacity-50');
                        }
                    });

                    updateLineChart();
                });
            });
        </script>
    </section>
</x-layout>
