<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-900 tracking-tight">
                {{ __('Monitors') }}
            </h2>
            <a href="{{ route('monitors.create') }}"
                class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Monitor
            </a>
        </div>
    </x-slot>

    <div class="max-w-1xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div
                class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-xl text-sm font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-sm border-b border-gray-50">
                            <th class="px-6 py-4 font-medium uppercase tracking-wider">Monitor</th>
                            <th class="px-6 py-4 font-medium uppercase tracking-wider">Protocol</th>
                            <th class="px-6 py-4 font-medium uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 font-medium uppercase tracking-wider text-center">Last Response</th>
                            <th class="px-6 py-4 font-medium uppercase tracking-wider">Last Check</th>
                            <th class="px-6 py-4 font-medium uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($monitors as $monitor)
                            @php
                                $lastResult = $monitor->results->first();
                            @endphp
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                        <div class="ms-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $monitor->name }}</div>
                                            <div class="text-xs text-gray-400 font-medium">
                                                {{ $monitor->host }}{{ $monitor->port ? ':' . $monitor->port : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-[10px] font-bold uppercase tracking-wider">
                                        {{ $monitor->protocol }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($lastResult)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $lastResult->status === 'up' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-rose-50 text-rose-600 border-rose-100' }}">
                                            <span
                                                class="w-1.5 h-1.5 me-1.5 rounded-full {{ $lastResult->status === 'up' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                            {{ strtoupper($lastResult->status) }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border bg-gray-50 text-gray-400 border-gray-100">
                                            <!-- <span class="w-1.5 h-1.5 me-1.5 rounded-full bg-gray-300"></span> -->
                                            PENDING1
                                            <!-- </span> -->
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">
                                    {{ $lastResult->response_time ?? '—' }}{{ $lastResult && $lastResult->response_time ? 'ms' : '' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-500 font-medium italic">
                                        {{ $lastResult ? $lastResult->checked_at->diffForHumans() : 'No checks yet' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <button class="text-emerald-600 hover:text-emerald-900">Edit</button>
                                    <button class="text-gray-400 hover:text-rose-600">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="h-12 w-12 text-gray-200 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.172 17.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-gray-500 font-medium">No monitors found yet.</p>
                                        <a href="{{ route('monitors.create') }}"
                                            class="mt-4 text-emerald-600 hover:underline">Add your first monitor</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>