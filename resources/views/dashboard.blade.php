<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-100 tracking-tight">
                {{ __('System Dashboard') }}
            </h2>
            <div class="flex items-center gap-3">
                @php
                    $allUp = $monitors->every(fn($m) => $m->status === 'up');
                @endphp
                <div
                    class="flex items-center gap-2 px-3 py-1.5 {{ $allUp ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border-rose-500/20' }} rounded-full text-xs font-semibold border">
                    <span
                        class="w-2 h-2 {{ $allUp ? 'bg-emerald-500' : 'bg-rose-500' }} rounded-full animate-pulse"></span>
                    {{ $allUp ? 'All Systems Operational' : 'Issues Detected' }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="dashboardData()">
        <!-- Stat Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div
                class="p-6 bg-slate-800 rounded-2xl border border-slate-700/50 hover:border-sky-500/30 transition-all group">
                <div class="text-sm font-medium text-slate-400 group-hover:text-slate-300">Overall Uptime</div>
                <div class="mt-3 flex items-baseline justify-between">
                    <div class="text-3xl font-bold">99.98%</div>
                    <div class="text-xs font-semibold text-emerald-500 flex items-center gap-1">
                        +0.02%
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="p-6 bg-slate-800 rounded-2xl border border-slate-700/50 hover:border-sky-500/30 transition-all group">
                <div class="text-sm font-medium text-slate-400 group-hover:text-slate-300">Avg Response</div>
                <div class="mt-3 flex items-baseline justify-between">
                    <div class="text-3xl font-bold">
                        {{ round($monitors->where('status', 'up')->avg('last_response_time')) }}ms</div>
                    <div class="text-xs font-semibold text-emerald-500 flex items-center gap-1">
                        -12ms
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="p-6 bg-slate-800 rounded-2xl border border-slate-700/50 hover:border-sky-500/30 transition-all group">
                <div class="text-sm font-medium text-slate-400 group-hover:text-slate-300">Active Monitors</div>
                <div class="mt-3 flex items-baseline justify-between">
                    <div class="text-3xl font-bold">{{ $monitors->count() }}</div>
                </div>
            </div>

            <div
                class="p-6 bg-slate-800 rounded-2xl border border-slate-700/50 hover:border-rose-500/30 transition-all group">
                <div class="text-sm font-medium text-slate-400 group-hover:text-slate-300">Current Incidents</div>
                <div class="mt-3 flex items-baseline justify-between">
                    <div class="text-3xl font-bold">{{ $monitors->where('status', 'down')->count() }}</div>
                    @if($monitors->where('status', 'down')->count() > 0)
                        <div class="text-xs font-semibold text-rose-500">Critical</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            <div class="p-6 bg-slate-800 rounded-2xl border border-slate-700/50">
                <h3 class="text-lg font-semibold mb-6">Response Time History</h3>
                <div class="relative h-64">
                    <canvas id="responseTimeChart"></canvas>
                </div>
            </div>

            <div class="p-6 bg-slate-800 rounded-2xl border border-slate-700/50">
                <h3 class="text-lg font-semibold mb-6">Daily Uptime (%)</h3>
                <div class="relative h-64">
                    <canvas id="uptimeChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Monitors List -->
        <div class="p-6 bg-slate-800 rounded-2xl border border-slate-700/50">
            <h3 class="text-lg font-semibold mb-6">Service Health</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-400 text-sm border-b border-slate-700/50">
                            <th class="pb-4 font-medium">System</th>
                            <th class="pb-4 font-medium">Status</th>
                            <th class="pb-4 font-medium">Last Response</th>
                            <th class="pb-4 font-medium">Last Checked</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @foreach($monitors as $monitor)
                            <tr class="group hover:bg-slate-700/20 transition-colors">
                                <td class="py-4">
                                    <div class="text-sm font-semibold text-slate-100">{{ $monitor->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $monitor->url }}</div>
                                </td>
                                <td class="py-4">
                                    <span
                                        class="px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $monitor->status === 'up' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border-rose-500/20' }}">
                                        {{ ucfirst($monitor->status) }}
                                    </span>
                                </td>
                                <td class="py-4 text-sm text-slate-400">
                                    {{ $monitor->last_response_time ? $monitor->last_response_time . 'ms' : 'N/A' }}
                                </td>
                                <td class="py-4 text-sm text-slate-400">
                                    {{ $monitor->last_checked_at ? $monitor->last_checked_at->diffForHumans() : 'Never' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function dashboardData() {
                return {
                    init() {
                        this.initResponseChart();
                        this.initUptimeChart();
                    },
                    initResponseChart() {
                        const ctx = document.getElementById('responseTimeChart').getContext('2d');
                        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                        gradient.addColorStop(0, 'rgba(56, 189, 248, 0.2)');
                        gradient.addColorStop(1, 'rgba(56, 189, 248, 0)');

                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['1AM', '4AM', '8AM', '12PM', '4PM', '8PM', 'Now'],
                                datasets: [{
                                    data: [35, 42, 38, 55, 45, 40, 48],
                                    borderColor: '#38bdf8',
                                    backgroundColor: gradient,
                                    fill: true,
                                    tension: 0.4,
                                    borderWidth: 3,
                                    pointRadius: 0,
                                    pointHoverRadius: 6
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: {
                                    x: { grid: { display: false }, ticks: { color: '#94a3b8' } },
                                    y: { grid: { color: '#1e293b' }, ticks: { color: '#94a3b8' } }
                                }
                            }
                        });
                    },
                    initUptimeChart() {
                        const ctx = document.getElementById('uptimeChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: Array.from({ length: 30 }, (_, i) => i + 1),
                                datasets: [{
                                    data: Array.from({ length: 30 }, () => 95 + Math.random() * 5),
                                    backgroundColor: '#10b981',
                                    borderRadius: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: {
                                    x: { display: false },
                                    y: { grid: { color: '#1e293b' }, ticks: { color: '#94a3b8' } }
                                }
                            }
                        });
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>