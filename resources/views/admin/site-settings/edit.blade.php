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

            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf
                @method('PUT')

                {{-- Success Stories Region --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">

                    <p class="text-sm text-gray-500 mb-6">
                        Choose which regional <strong>Success Stories</strong> page the navbar links to.
                    </p>

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

                </div>

                {{-- NIS2 Pricing --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6"
                     x-data="{
                         regularPrice: {{ (float) old('regular_price', $settings->regular_price) }},
                         salePrice: {{ (float) old('sale_price', $settings->sale_price) }},
                         get savings() {
                             return Math.max(0, this.regularPrice - this.salePrice);
                         },
                         fmt(n) {
                             return '£' + Number(n).toLocaleString('en-GB', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
                         }
                     }">

                    <p class="text-sm text-gray-500 mb-6">
                        These values are displayed on the <strong>NIS2 Implementation Toolkit</strong> page and the <strong>Pricing</strong> page.
                    </p>

                    <h3 class="text-sm font-medium text-gray-700 mb-4">NIS2 Pricing</h3>

                    {{-- Regular Price --}}
                    <div class="mb-5">
                        <label for="regular_price" class="block text-sm font-medium text-gray-700 mb-1">
                            Regular Price (£ GBP) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            id="regular_price"
                            name="regular_price"
                            value="{{ old('regular_price', $settings->regular_price) }}"
                            step="0.01"
                            min="0"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error('regular_price') border-red-400 @enderror"
                            required
                            x-model.number="regularPrice"
                        >
                        @error('regular_price')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sale Price --}}
                    <div class="mb-6">
                        <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-1">
                            Sale Price (£ GBP) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            id="sale_price"
                            name="sale_price"
                            value="{{ old('sale_price', $settings->sale_price) }}"
                            step="0.01"
                            min="0"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error('sale_price') border-red-400 @enderror"
                            required
                            x-model.number="salePrice"
                        >
                        @error('sale_price')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Live preview --}}
                    <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-600">
                        <p class="font-medium text-gray-700 mb-2">Preview</p>
                        <div class="flex flex-col gap-1">
                            <span>Regular: <strong x-text="fmt(regularPrice)"></strong></span>
                            <span>Sale: <strong x-text="fmt(salePrice)"></strong></span>
                            <span>Customer saves: <strong x-text="fmt(savings)"></strong></span>
                        </div>
                    </div>

                </div>

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
</x-app-layout>
