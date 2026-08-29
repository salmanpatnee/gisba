{{--
    Reusable course pricing/schedule fields block.
    Expects: $course (slug prefix, e.g. "crisc"), $label, $description, $dateTimeRequired (bool)
--}}
@php($dateTimeRequired = $dateTimeRequired ?? true)

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6"
     x-data="{
         price: {{ (float) old("{$course}_price", $settings->{"{$course}_price"}) }},
         currency: '{{ old("{$course}_currency", $settings->{"{$course}_currency"}) }}',
         capacity: @js(old("{$course}_capacity", $settings->{"{$course}_capacity"})),
         get symbol() {
             return { USD: '$', GBP: '£', EUR: '€' }[this.currency] ?? this.currency + ' ';
         },
         fmt(n) { return this.symbol + Number(n).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); }
     }">

    <h3 class="text-sm font-medium text-gray-700 mb-1">{{ $label }}</h3>
    <p class="text-sm text-gray-500 mb-6">{{ $description }}</p>

    {{-- Price --}}
    <div class="mb-5">
        <label for="{{ $course }}_price" class="block text-sm font-medium text-gray-700 mb-1">
            Price <span class="text-red-500">*</span>
        </label>
        <input
            type="number"
            id="{{ $course }}_price"
            name="{{ $course }}_price"
            value="{{ old("{$course}_price", $settings->{"{$course}_price"}) }}"
            step="0.01"
            min="0"
            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error("{$course}_price") border-red-400 @enderror"
            required
            x-model.number="price"
        >
        @error("{$course}_price")
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Currency --}}
    <div class="mb-5">
        <label for="{{ $course }}_currency" class="block text-sm font-medium text-gray-700 mb-1">
            Currency <span class="text-red-500">*</span>
        </label>
        <select
            id="{{ $course }}_currency"
            name="{{ $course }}_currency"
            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error("{$course}_currency") border-red-400 @enderror"
            required
            x-model="currency"
        >
            @foreach (['USD' => 'US Dollar (USD)', 'GBP' => 'Pound Sterling (GBP)', 'EUR' => 'Euro (EUR)'] as $code => $currencyLabel)
                <option value="{{ $code }}" {{ old("{$course}_currency", $settings->{"{$course}_currency"}) === $code ? 'selected' : '' }}>{{ $currencyLabel }}</option>
            @endforeach
        </select>
        @error("{$course}_currency")
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Date --}}
    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label for="{{ $course }}_date" class="block text-sm font-medium text-gray-700 mb-1">
                Start Date @if($dateTimeRequired)<span class="text-red-500">*</span>@endif
            </label>
            <input
                type="date"
                id="{{ $course }}_date"
                name="{{ $course }}_date"
                value="{{ old("{$course}_date", optional($settings->{"{$course}_date"})->format('Y-m-d')) }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error("{$course}_date") border-red-400 @enderror"
                @if($dateTimeRequired) required @endif
            >
            @error("{$course}_date")
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="{{ $course }}_end_date" class="block text-sm font-medium text-gray-700 mb-1">
                End Date <span class="text-gray-400 font-normal">(optional, for multi-day courses)</span>
            </label>
            <input
                type="date"
                id="{{ $course }}_end_date"
                name="{{ $course }}_end_date"
                value="{{ old("{$course}_end_date", optional($settings->{"{$course}_end_date"})->format('Y-m-d')) }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error("{$course}_end_date") border-red-400 @enderror"
            >
            @error("{$course}_end_date")
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Time --}}
    <div class="grid grid-cols-2 gap-4 mb-5">
        <div>
            <label for="{{ $course }}_time_start" class="block text-sm font-medium text-gray-700 mb-1">
                Start Time @if($dateTimeRequired)<span class="text-red-500">*</span>@endif
            </label>
            <input
                type="text"
                id="{{ $course }}_time_start"
                name="{{ $course }}_time_start"
                value="{{ old("{$course}_time_start", $settings->{"{$course}_time_start"}) }}"
                placeholder="7:00 AM"
                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error("{$course}_time_start") border-red-400 @enderror"
                @if($dateTimeRequired) required @endif
            >
            @error("{$course}_time_start")
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="{{ $course }}_time_end" class="block text-sm font-medium text-gray-700 mb-1">
                End Time @if($dateTimeRequired)<span class="text-red-500">*</span>@endif
            </label>
            <input
                type="text"
                id="{{ $course }}_time_end"
                name="{{ $course }}_time_end"
                value="{{ old("{$course}_time_end", $settings->{"{$course}_time_end"}) }}"
                placeholder="1:00 PM"
                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error("{$course}_time_end") border-red-400 @enderror"
                @if($dateTimeRequired) required @endif
            >
            @error("{$course}_time_end")
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Timezone --}}
    <div class="mb-5">
        <label for="{{ $course }}_timezone" class="block text-sm font-medium text-gray-700 mb-1">
            Timezone <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="{{ $course }}_timezone"
            name="{{ $course }}_timezone"
            value="{{ old("{$course}_timezone", $settings->{"{$course}_timezone"}) }}"
            placeholder="GMT+3"
            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error("{$course}_timezone") border-red-400 @enderror"
            required
        >
        @error("{$course}_timezone")
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Capacity --}}
    <div class="mb-6">
        <label for="{{ $course }}_capacity" class="block text-sm font-medium text-gray-700 mb-1">
            Seat Capacity <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="{{ $course }}_capacity"
            name="{{ $course }}_capacity"
            value="{{ old("{$course}_capacity", $settings->{"{$course}_capacity"}) }}"
            placeholder="e.g. 15 or 15+"
            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error("{$course}_capacity") border-red-400 @enderror"
            required
            x-model="capacity"
        >
        @error("{$course}_capacity")
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Live preview --}}
    <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-600">
        <p class="font-medium text-gray-700 mb-2">Preview</p>
        <div class="flex flex-col gap-1">
            <span>Price: <strong x-text="fmt(price)"></strong></span>
            <span>Seats: <strong x-text="capacity"></strong> participants</span>
        </div>
    </div>

</div>
