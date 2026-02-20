<aside class="w-64 bg-white border-r border-gray-200 min-h-screen hidden lg:block sticky top-0">
    <div class="h-16 flex items-center px-6 border-b border-gray-100">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <x-application-logo class="w-8 h-8 text-emerald-600" />
            <span class="text-xl font-bold text-gray-900 tracking-tight">Pulse</span>
        </a>
    </div>

    <nav class="mt-6 px-3 space-y-1">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
            class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg">
            <svg class="w-5 h-5 me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            {{ __('Dashboard') }}
        </x-nav-link>

        <a href="#"
            class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition-colors group">
            <svg class="w-5 h-5 me-3 text-gray-400 group-hover:text-emerald-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Monitors
        </a>

        <a href="{{ route('profile.edit') }}"
            class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition-colors group">
            <svg class="w-5 h-5 me-3 text-gray-400 group-hover:text-emerald-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Profile
        </a>
    </nav>
</aside>