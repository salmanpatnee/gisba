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

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Website Mode --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">

                    <p class="text-sm text-gray-500 mb-6">
                        Choose the public site's <strong>Website Mode</strong>. Controls what the site root (<code>/</code>) shows and whether the PMP nav link is visible. Takes effect immediately, no deploy required.
                    </p>

                    <fieldset class="mb-6">
                        <legend class="block text-sm font-medium text-gray-700 mb-3">Active Website Mode</legend>

                        <div class="flex flex-col gap-3">
                            @foreach (\App\Enums\WebsiteMode::cases() as $mode)
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input
                                        type="radio"
                                        name="website_mode"
                                        value="{{ $mode->value }}"
                                        {{ old('website_mode', $settings->website_mode) === $mode->value ? 'checked' : '' }}
                                        class="w-4 h-4 mt-0.5 text-gray-800 border-gray-300 focus:ring-gray-400"
                                    >
                                    <span class="text-sm text-gray-700">
                                        <strong>{{ $mode->label() }}</strong>
                                        <span class="block text-gray-400">{{ $mode->description() }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        @error('website_mode')
                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </fieldset>

                </div>

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

                {{-- Membership Pricing --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6"
                     x-data="{
                         price: {{ (float) old('membership_price', $settings->membership_price) }},
                         was: {{ (float) old('membership_regular_price', $settings->membership_regular_price) }},
                         currency: '{{ old('membership_currency', $settings->membership_currency) }}',
                         get symbol() {
                             return { USD: '$', GBP: '£', EUR: '€' }[this.currency] ?? this.currency + ' ';
                         },
                         get discount() {
                             if (this.was <= 0 || this.price >= this.was) return 0;
                             return Math.round((this.was - this.price) / this.was * 100);
                         },
                         fmt(n) { return this.symbol + Number(n).toLocaleString('en-US', { maximumFractionDigits: 0 }); }
                     }">

                    <h3 class="text-sm font-medium text-gray-700 mb-1">Membership Pricing</h3>
                    <p class="text-sm text-gray-500 mb-6">
                        <strong>This is the amount PayPal actually charges.</strong> The members paywall and the
                        checkout both read these values, so they can never disagree.
                    </p>

                    {{-- Price charged --}}
                    <div class="mb-5">
                        <label for="membership_price" class="block text-sm font-medium text-gray-700 mb-1">
                            Price charged <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            id="membership_price"
                            name="membership_price"
                            value="{{ old('membership_price', $settings->membership_price) }}"
                            step="0.01"
                            min="1"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error('membership_price') border-red-400 @enderror"
                            required
                            x-model.number="price"
                        >
                        @error('membership_price')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- "Was" price --}}
                    <div class="mb-5">
                        <label for="membership_regular_price" class="block text-sm font-medium text-gray-700 mb-1">
                            Shown as "was" <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            id="membership_regular_price"
                            name="membership_regular_price"
                            value="{{ old('membership_regular_price', $settings->membership_regular_price) }}"
                            step="0.01"
                            min="0"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error('membership_regular_price') border-red-400 @enderror"
                            required
                            x-model.number="was"
                        >
                        <p class="mt-1 text-xs text-gray-400">Set equal to the price charged to hide the discount badge.</p>
                        @error('membership_regular_price')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Currency --}}
                    <div class="mb-6">
                        <label for="membership_currency" class="block text-sm font-medium text-gray-700 mb-1">
                            Currency <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="membership_currency"
                            name="membership_currency"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error('membership_currency') border-red-400 @enderror"
                            required
                            x-model="currency"
                        >
                            @foreach (['USD' => 'US Dollar (USD)', 'GBP' => 'Pound Sterling (GBP)', 'EUR' => 'Euro (EUR)'] as $code => $label)
                                <option value="{{ $code }}" {{ old('membership_currency', $settings->membership_currency) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('membership_currency')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Live preview --}}
                    <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-600">
                        <p class="font-medium text-gray-700 mb-2">Preview</p>
                        <div class="flex flex-col gap-1">
                            <span>Paywall shows: <strong x-text="fmt(price)"></strong><template x-if="discount > 0"><span> was <s x-text="fmt(was)"></s> — <span x-text="discount"></span>% OFF</span></template></span>
                            <span>PayPal charges: <strong x-text="fmt(price)"></strong> <span x-text="currency"></span></span>
                        </div>
                    </div>

                </div>

                {{-- CRISC Course --}}
                @include('admin.site-settings._course-pricing-fields', [
                    'course' => 'crisc',
                    'label' => 'CRISC Online Course',
                    'description' => 'These values are shown on the CRISC course landing and pricing pages, and are the exact amount PayPal charges at checkout.',
                    'dateTimeRequired' => true,
                ])

                {{-- CISSP Course --}}
                @include('admin.site-settings._course-pricing-fields', [
                    'course' => 'cissp',
                    'label' => 'CISSP Live Online Training',
                    'description' => 'These values are shown on the CISSP course landing and pricing pages, and are the exact amount PayPal charges at checkout.',
                    'dateTimeRequired' => false,
                ])

                {{-- PRINCE2 Course --}}
                @include('admin.site-settings._course-pricing-fields', [
                    'course' => 'prince2',
                    'label' => 'PRINCE2 Live Online Training',
                    'description' => 'These values are shown on the PRINCE2 course landing and pricing pages, and are the exact amount PayPal charges at checkout.',
                    'dateTimeRequired' => false,
                ])

                {{-- NIS2 Toolkit ZIP --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">

                    <h3 class="text-sm font-medium text-gray-700 mb-1">NIS2 Toolkit ZIP</h3>
                    <p class="text-sm text-gray-500 mb-4">
                        Upload the ZIP file that customers can download from the payment success page.
                    </p>

                    @if ($settings->toolkit_zip_path)
                        <div class="mb-3 flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Current file: <strong>{{ basename($settings->toolkit_zip_path) }}</strong></span>
                        </div>
                    @endif

                    <div>
                        <label for="toolkit_zip" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ $settings->toolkit_zip_path ? 'Replace ZIP file' : 'Upload ZIP file' }}
                        </label>
                        <input
                            type="file"
                            id="toolkit_zip"
                            name="toolkit_zip"
                            accept=".zip"
                            class="block w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 @error('toolkit_zip') border border-red-400 rounded-md @enderror"
                        >
                        @error('toolkit_zip')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-400">Accepted: .zip — Max 50 MB</p>
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
