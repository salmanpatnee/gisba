{{-- Name --}}
<div class="mb-6">
    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Coupon Name <span class="text-red-500">*</span></label>
    <input type="text"
           id="name"
           name="name"
           value="{{ old('name', $coupon?->name) }}"
           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm uppercase @error('name') border-red-400 @enderror"
           placeholder="e.g., ISACA50">
    @error('name')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
    <p class="mt-1 text-xs text-gray-400">The code customers enter at checkout. Stored uppercase.</p>
</div>

{{-- Value --}}
<div class="mb-6">
    <label for="value" class="block text-sm font-medium text-gray-700 mb-1">Discount Percentage <span class="text-red-500">*</span></label>
    <div class="relative w-40">
        <input type="number"
               id="value"
               name="value"
               min="1"
               max="100"
               value="{{ old('value', $coupon?->value) }}"
               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm pr-8 @error('value') border-red-400 @enderror"
               placeholder="50">
        <span class="absolute inset-y-0 right-3 flex items-center text-gray-400 text-sm">%</span>
    </div>
    @error('value')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
    <p class="mt-1 text-xs text-gray-400">Percentage off the base price, from 1 to 100.</p>
</div>

{{-- Expires At --}}
<div class="mb-6">
    <label for="expires_at" class="block text-sm font-medium text-gray-700 mb-1">Expires At</label>
    <input type="datetime-local"
           id="expires_at"
           name="expires_at"
           value="{{ old('expires_at', $coupon?->expires_at?->format('Y-m-d\TH:i')) }}"
           class="w-full sm:w-72 border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('expires_at') border-red-400 @enderror">
    @error('expires_at')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
    <p class="mt-1 text-xs text-gray-400">Leave blank for a coupon that never expires.</p>
</div>
