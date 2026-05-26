{{-- Title --}}
<div class="mb-6">
    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
    <input type="text"
           id="title"
           name="title"
           value="{{ old('title', $chapter?->title) }}"
           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('title') border-red-400 @enderror"
           placeholder="Chapter title">
    @error('title')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Slug --}}
<div class="mb-6">
    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug <span class="text-gray-400 font-normal">(auto-generated if blank)</span></label>
    <input type="text"
           id="slug"
           name="slug"
           value="{{ old('slug', $chapter?->slug) }}"
           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('slug') border-red-400 @enderror"
           placeholder="e.g. chapter-1-project-fundamentals">
    @error('slug')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Sort Order --}}
<div class="mb-6">
    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
    <input type="number"
           id="sort_order"
           name="sort_order"
           value="{{ old('sort_order', $chapter?->sort_order ?? 0) }}"
           min="0"
           class="w-32 border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('sort_order') border-red-400 @enderror">
    <p class="mt-1 text-xs text-gray-400">Lower number appears first.</p>
    @error('sort_order')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Section --}}
<div class="mb-6">
    <label for="section" class="block text-sm font-medium text-gray-700 mb-1">Section <span class="text-red-500">*</span></label>
    <select id="section" name="section"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('section') border-red-400 @enderror">
        @foreach([
            1 => 'PMBOK 8th Edition Review Training',
            2 => 'PMP Exam Content Outline Mapping Trainings',
            3 => 'Practical Tips and Others',
        ] as $value => $label)
            <option value="{{ $value }}" {{ old('section', $chapter?->section ?? 1) == $value ? 'selected' : '' }}>
                {{ $value }}. {{ $label }}
            </option>
        @endforeach
    </select>
    @error('section')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Description --}}
<div class="mb-6">
    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
    <textarea id="description"
              name="description"
              rows="4"
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('description') border-red-400 @enderror"
              placeholder="Brief description of this chapter">{{ old('description', $chapter?->description) }}</textarea>
    @error('description')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Featured Image --}}
<div class="mb-6">
    <label for="image_path" class="block text-sm font-medium text-gray-700 mb-1">Cover Image</label>
    @if($chapter?->image_path)
        <div class="mb-3">
            <img src="{{ $chapter->image_url }}" alt="Current image" class="h-32 w-auto rounded-md border border-gray-200 object-cover">
            <p class="text-xs text-gray-500 mt-1">Upload a new image to replace the current one.</p>
        </div>
    @endif
    <input type="file"
           id="image_path"
           name="image_path"
           accept="image/*"
           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 @error('image_path') border-red-400 @enderror">
    <p class="mt-1 text-xs text-gray-400">JPEG, PNG, WebP — max 2 MB.</p>
    @error('image_path')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
