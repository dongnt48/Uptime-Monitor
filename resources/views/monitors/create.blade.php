<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 tracking-tight">
            {{ __('Add New Monitor') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('monitors.store') }}" class="space-y-8" x-data="{ expanded: false }">
            @csrf

            <!-- Basic Info -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Basic Configuration
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <x-input-label for="name">
                            {{ __('Display Name') }} <span class="text-rose-500">*</span>
                        </x-input-label>
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')"
                            autofocus placeholder="e.g. Production API" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="protocol">
                            {{ __('Protocol') }} <span class="text-rose-500">*</span>
                        </x-input-label>
                        <select id="protocol" name="protocol"
                            class="mt-1 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm">
                            <option value="https" {{ old('protocol') == 'https' ? 'selected' : '' }}>HTTPS</option>
                            <option value="http" {{ old('protocol') == 'http' ? 'selected' : '' }}>HTTP</option>
                            <option value="tcp" {{ old('protocol') == 'tcp' ? 'selected' : '' }}>TCP</option>
                            <option value="ping" {{ old('protocol') == 'ping' ? 'selected' : '' }}>Ping</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('protocol')" />
                    </div>

                    <div>
                        <x-input-label for="host">
                            {{ __('Host / IP') }} <span class="text-rose-500">*</span>
                        </x-input-label>
                        <x-text-input id="host" name="host" type="text" class="mt-1 block w-full" :value="old('host')"
                            placeholder="api.example.com or 192.168.1.1" />
                        <x-input-error class="mt-2" :messages="$errors->get('host')" />
                    </div>

                    <div>
                        <x-input-label for="port" :value="__('Port (Optional)')" />
                        <x-text-input id="port" name="port" type="number" class="mt-1 block w-full" :value="old('port')"
                            placeholder="e.g. 8080" />
                        <x-input-error class="mt-2" :messages="$errors->get('port')" />
                    </div>

                    <div>
                        <x-input-label for="timeout">
                            {{ __('Timeout (ms)') }} <span class="text-rose-500">*</span>
                        </x-input-label>
                        <x-text-input id="timeout" name="timeout" type="number" class="mt-1 block w-full"
                            :value="old('timeout', 5000)" />
                        <x-input-error class="mt-2" :messages="$errors->get('timeout')" />
                    </div>

                    <div>
                        <x-input-label for="expected_status_code">
                            {{ __('Expected Status Code') }} <span class="text-rose-500">*</span>
                        </x-input-label>
                        <x-text-input id="expected_status_code" name="expected_status_code" type="number"
                            class="mt-1 block w-full" :value="old('expected_status_code', 200)" />
                        <x-input-error class="mt-2" :messages="$errors->get('expected_status_code')" />
                    </div>
                </div>
            </div>

            <!-- Advanced Settings Toggle -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-8">
                <button type="button" @click="expanded = !expanded"
                    class="w-full flex items-center justify-between group">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-500 transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        Advanced Settings
                    </h3>
                    <svg class="w-5 h-5 text-gray-400 transform transition-transform"
                        :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="expanded" x-transition class="mt-8 space-y-6 border-t border-gray-50 pt-8">
                    <div>
                        <x-input-label for="auth_type" :value="__('Authentication')" />
                        <select id="auth_type" name="auth_type"
                            class="mt-1 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm">
                            <option value="none" {{ old('auth_type') == 'none' ? 'selected' : '' }}>None</option>
                            <option value="basic" {{ old('auth_type') == 'basic' ? 'selected' : '' }}>Basic Auth</option>
                            <option value="bearer" {{ old('auth_type') == 'bearer' ? 'selected' : '' }}>Bearer Token
                            </option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('auth_type')" />
                    </div>

                    <div>
                        <x-input-label for="headers" :value="__('Custom Headers (JSON format)')" />
                        <x-text-input id="headers" name="headers" type="text" class="mt-1 block w-full"
                            :value="old('headers')" placeholder='{"X-Custom-Header": "value"}' />
                        <p class="mt-1 text-xs text-gray-400 font-medium italic">Example: {"Authorization":
                            "SecretCode"}</p>
                        <x-input-error class="mt-2" :messages="$errors->get('headers')" />
                    </div>

                    <div>
                        <x-input-label for="body" :value="__('Request Body (Optional)')" />
                        <textarea id="body" name="body" rows="4"
                            class="mt-1 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm"
                            placeholder="Paste your raw body content here for POST checks...">{{ old('body') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('body')" />
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 p-4">
                <a href="{{ route('monitors.index') }}"
                    class="text-sm text-gray-400 hover:text-gray-600 font-medium transition-colors">
                    Cancel
                </a>
                <x-primary-button class="px-8 !py-3">
                    {{ __('Save Monitor Configuration') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>