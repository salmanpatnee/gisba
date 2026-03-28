<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Site Settings</h2>
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-200 transition">
                &larr; Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-5 px-4 py-3 bg-green-50 border border-green-200 text-green-800 text-sm rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p class="text-sm text-gray-500 mb-6">
                    Choose which regional <strong>Success Stories</strong> page the navbar links to.
                </p>

                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    @method('PUT')

                    <fieldset class="mb-6">
                        <legend class="block text-sm font-medium text-gray-700 mb-3">Active Success Stories Region</legend>

                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input
                                    type="radio"
                                    name="success_stories_region"
                                    value="eu"
                                    {{ old('success_stories_region', $settings->success_stories_region) === 'eu' ? 'checked' : '' }}
                                    class="w-4 h-4 text-gray-800 border-gray-300 focus:ring-gray-400"
                                >
                                <span class="text-sm text-gray-700">
                                    <strong>Europe (EU)</strong>
                                    <span class="text-gray-400 ml-1">— /success-stories/eu</span>
                                </span>
                            </label>

                            <label class="flex items-center gap-3 cursor-pointer">
                                <input
                                    type="radio"
                                    name="success_stories_region"
                                    value="me"
                                    {{ old('success_stories_region', $settings->success_stories_region) === 'me' ? 'checked' : '' }}
                                    class="w-4 h-4 text-gray-800 border-gray-300 focus:ring-gray-400"
                                >
                                <span class="text-sm text-gray-700">
                                    <strong>Middle East (ME)</strong>
                                    <span class="text-gray-400 ml-1">— /success-stories/me</span>
                                </span>
                            </label>
                        </div>

                        @error('success_stories_region')
                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </fieldset>

                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="px-5 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                            Save Settings
                        </button>
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
