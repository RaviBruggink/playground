@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800
        });
    </script>
@endpush

<x-layout>
    <section class="bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12 py-16 sm:py-24 space-y-24 sm:space-y-32">

            {{-- Hero Section --}}
            <div class="text-center px-4" data-aos="fade-up">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-light uppercase tracking-wide mb-6">
                    AI-model performance graph
                </h1>
                <p class="text-gray-400 max-w-2xl mx-auto text-base sm:text-lg">
                    A prototyping challenge to explore AI-model performance across various use cases.
                </p>
            </div>

            {{-- Graph --}}
            <section>
                <div class="my-12 bg-gray-50 p-6 rounded-xl shadow-sm border border-gray-200">
                    <h3 class="text-xl font-semibold mb-4 text-neutral-900">Modelvoorkeur per Use Case</h3>

                    <!-- Legenda + model filter -->
                    <div id="modelLegend" class="flex flex-wrap gap-4 mb-6 text-sm font-medium text-gray-700">
                        <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="GPT-4o">
                            <span class="w-3 h-3 rounded-full bg-blue-500"></span> GPT-4o
                        </div>
                        <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="Llama3 (Ollama)">
                            <span class="w-3 h-3 rounded-full bg-fuchsia-500"></span> Llama3 (Ollama)
                        </div>
                        <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="Gemma (Ollama)">
                            <span class="w-3 h-3 rounded-full bg-green-500"></span> Gemma (Ollama)
                        </div>
                        <div class="flex items-center gap-2 cursor-pointer model-toggle"
                            data-model="LLaMa 3.3 (Ollama)">
                            <span class="w-3 h-3 rounded-full bg-orange-500"></span> LLaMa 3.3 (Ollama)
                        </div>
                        <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="Claude 3.5 Sonnet">
                            <span class="w-3 h-3 rounded-full bg-purple-500"></span> Claude 3.5 Sonnet
                        </div>
                        <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="Claude 3.5 Haiku">
                            <span class="w-3 h-3 rounded-full bg-teal-500"></span> Claude 3.5 Haiku
                        </div>
                        <div class="flex items-center gap-2 cursor-pointer model-toggle" data-model="Claude 3.7 Sonnet">
                            <span class="w-3 h-3 rounded-full bg-yellow-500"></span> Claude 3.7 Sonnet
                        </div>
                    </div>

                    <!-- Use Case Filter -->
                    <div id="useCaseLegend" class="flex flex-wrap gap-4 mb-6 text-sm font-medium text-gray-700">
                        @foreach (['Allround', 'Sales', 'Frontend development', 'Backend development', 'Laravel', 'Flutter', 'Python', 'Grammar & Spelling', 'Project management', 'Recruitment', 'Paralegal'] as $useCase)
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
                        'Allround', 'Sales', 'Frontend development', 'Backend development', 'Laravel',
                        'Flutter', 'Python', 'Grammar & Spelling', 'Project management', 'Recruitment', 'Paralegal'
                    ];

                    const models = [{
                            label: 'GPT-4o',
                            color: '#3b82f6',
                            scores: {
                                'Allround': 30,
                                'Sales': 28,
                                'Frontend development': 27,
                                'Backend development': 29,
                                'Laravel': 28,
                                'Flutter': 26,
                                'Python': 29,
                                'Grammar & Spelling': 31,
                                'Project management': 30,
                                'Recruitment': 27,
                                'Paralegal': 28
                            }
                        },
                        {
                            label: 'Llama3 (Ollama)',
                            color: '#d946ef',
                            scores: {
                                'Allround': 24,
                                'Sales': 23,
                                'Frontend development': 25,
                                'Backend development': 24,
                                'Laravel': 23,
                                'Flutter': 22,
                                'Python': 24,
                                'Grammar & Spelling': 22,
                                'Project management': 23,
                                'Recruitment': 21,
                                'Paralegal': 22
                            }
                        },
                        {
                            label: 'Gemma (Ollama)',
                            color: '#10b981',
                            scores: {
                                'Allround': 26,
                                'Sales': 25,
                                'Frontend development': 24,
                                'Backend development': 23,
                                'Laravel': 24,
                                'Flutter': 25,
                                'Python': 26,
                                'Grammar & Spelling': 24,
                                'Project management': 25,
                                'Recruitment': 23,
                                'Paralegal': 24
                            }
                        },
                        {
                            label: 'LLaMa 3.3 (Ollama)',
                            color: '#fb923c',
                            scores: {
                                'Allround': 25,
                                'Sales': 24,
                                'Frontend development': 26,
                                'Backend development': 25,
                                'Laravel': 26,
                                'Flutter': 24,
                                'Python': 25,
                                'Grammar & Spelling': 23,
                                'Project management': 24,
                                'Recruitment': 22,
                                'Paralegal': 23
                            }
                        },
                        {
                            label: 'Claude 3.5 Sonnet',
                            color: '#a78bfa',
                            scores: {
                                'Allround': 28,
                                'Sales': 26,
                                'Frontend development': 27,
                                'Backend development': 28,
                                'Laravel': 27,
                                'Flutter': 26,
                                'Python': 27,
                                'Grammar & Spelling': 30,
                                'Project management': 28,
                                'Recruitment': 26,
                                'Paralegal': 27
                            }
                        },
                        {
                            label: 'Claude 3.5 Haiku',
                            color: '#14b8a6',
                            scores: {
                                'Allround': 22,
                                'Sales': 21,
                                'Frontend development': 23,
                                'Backend development': 22,
                                'Laravel': 21,
                                'Flutter': 20,
                                'Python': 22,
                                'Grammar & Spelling': 24,
                                'Project management': 22,
                                'Recruitment': 20,
                                'Paralegal': 21
                            }
                        },
                        {
                            label: 'Claude 3.7 Sonnet',
                            color: '#fde047',
                            scores: {
                                'Allround': 29,
                                'Sales': 27,
                                'Frontend development': 28,
                                'Backend development': 29,
                                'Laravel': 28,
                                'Flutter': 27,
                                'Python': 29,
                                'Grammar & Spelling': 31,
                                'Project management': 29,
                                'Recruitment': 27,
                                'Paralegal': 28
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

            {{-- Details Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-start px-4">
                <div data-aos="fade-right">
                    <h3 class="text-sm uppercase tracking-widest text-gray-500 mb-4">Categorie</h3>
                    <ul class="text-gray-300 space-y-2 text-base">
                        <li>Data Analytics</li>
                        <li>UX/UI Design</li>
                        <li>Webdevelopment</li>
                    </ul>

                    <h3 class="text-sm uppercase tracking-widest text-gray-500 mt-10 mb-4">Jaar</h3>
                    <p class="text-gray-300 text-base">2025</p>

                    <h3 class="text-sm uppercase tracking-widest text-gray-500 mt-10 mb-4">Prijzen</h3>
                    <ul class="text-gray-300 space-y-2 text-base">
                        <li>Nog geen</li>
                    </ul>
                </div>

                <div data-aos="fade-left" class="space-y-6">
                    <h3 class="text-white text-lg sm:text-xl font-semibold uppercase">Meer info</h3>
                    <p class="text-gray-400 leading-relaxed text-base sm:text-lg">Tijdens mijn afstudeerstage bij Moonly
                        Software heb ik onderzocht hoe A/B-testen toegepast kan worden op AI-modellen binnen diverse
                        use-cases in hun AI-omgeving. De resultaten van deze tests heb ik geanalyseerd en gevisualiseerd
                        in een clustered bar chart. Deze interactieve grafiek stelt gebruikers in staat om snel en
                        overzichtelijk te zien welk taalmodel het beste presteert voor hun specifieke toepassing.</p>
                </div>
            </div>

            {{-- Extra Imagery or Visual --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center px-4" data-aos="fade-up"
                data-aos-delay="200">
                <img src="/images/graph.png" alt="Graph"
                    class="rounded-xl shadow-lg transition-transform duration-500 hover:scale-105 w-full"
                    alt="Mockup">
                <p class="text-gray-400 text-base sm:text-lg leading-relaxed">
                    Door deze aanpak heb ik niet alleen beter inzicht gekregen in wat er technisch nodig is, maar ook in
                    hoe gebruikersdata vertaald kan worden naar iets bruikbaars en visueels. Dit vormt de basis voor
                    verdere iteratie en validatie van de feedbackloop binnen het framework.
                </p>
            </div>

            {{-- Back Link --}}
            <div class="text-center pt-12 sm:pt-16" data-aos="fade-up">
                <a href="{{ route('projects.index') }}"
                    class="relative inline-block text-sm text-gray-300 uppercase font-semibold tracking-wide hover:pr-2 hover:underline transition-all duration-300">
                    ← Terug naar alle projecten
                </a>
            </div>
        </div>
    </section>
</x-layout>
