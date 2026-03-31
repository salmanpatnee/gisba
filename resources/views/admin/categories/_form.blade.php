{{-- Name --}}
<div class="mb-6">
    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name <span class="text-red-500">*</span></label>
    <input type="text"
           id="name"
           name="name"
           value="{{ old('name', $category?->name) }}"
           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('name') border-red-400 @enderror"
           placeholder="e.g., Cybersecurity Governance">
    @error('name')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
    <p class="mt-1 text-xs text-gray-400">Choose a clear, descriptive name for this category.</p>
</div>
