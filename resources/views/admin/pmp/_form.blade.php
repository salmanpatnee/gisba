{{-- Title --}}
<div class="mb-6">
    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
    <input type="text"
           id="title"
           name="title"
           value="{{ old('title', $post?->title) }}"
           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('title') border-red-400 @enderror"
           placeholder="Enter PMP post title">
    @error('title')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Category --}}
<div class="mb-6">
    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
    <select id="category_id"
            name="category_id"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('category_id') border-red-400 @enderror">
        <option value="">— Select a category —</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $post?->category?->id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Body (TinyMCE) --}}
<div class="mb-6">
    <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Body <span class="text-red-500">*</span></label>
    <textarea id="body"
              name="body"
              rows="20"
              class="w-full border-gray-300 rounded-md shadow-sm text-sm @error('body') border-red-400 @enderror">{{ old('body', $post?->body) }}</textarea>
    @error('body')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Featured Image --}}
<div class="mb-6">
    <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
    @if($post?->featured_image)
        <div class="mb-3">
            <img src="{{ $post->image_url }}" alt="Current image" class="h-32 w-auto rounded-md border border-gray-200 object-cover">
            <p class="text-xs text-gray-500 mt-1">Upload a new image to replace the current one.</p>
        </div>
    @endif
    <input type="file"
           id="featured_image"
           name="featured_image"
           accept="image/*"
           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 @error('featured_image') border-red-400 @enderror">
    <p class="mt-1 text-xs text-gray-400">JPEG, PNG, WebP — max 2 MB.</p>
    @error('featured_image')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Downloadable Attachments --}}
<div class="border-t border-gray-100 pt-6 mt-6">
    <h3 class="text-sm font-semibold text-gray-700 mb-4">Downloadable Resources</h3>

    @if($post?->attachments?->count())
        <div class="mb-4 space-y-2">
            @foreach($post->attachments as $attachment)
                <div class="flex items-center justify-between gap-3 bg-gray-50 border border-gray-200 rounded-md px-4 py-2 text-sm">
                    <div class="flex items-center gap-2 min-w-0">
                        <i class="bi {{ $attachment->file_icon }} text-gray-500 flex-shrink-0"></i>
                        <span class="truncate font-medium text-gray-700">{{ $attachment->filename }}</span>
                        <span class="text-xs text-gray-400 flex-shrink-0">{{ $attachment->readable_size }}</span>
                        <span class="text-xs px-1.5 py-0.5 rounded font-semibold flex-shrink-0"
                              style="background-color:{{ $attachment->file_type_color }}22;color:{{ $attachment->file_type_color }}">
                            {{ $attachment->file_type_label }}
                        </span>
                    </div>
                    <label class="flex items-center gap-1.5 cursor-pointer flex-shrink-0">
                        <input type="checkbox"
                               name="delete_attachments[]"
                               value="{{ $attachment->id }}"
                               class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                        <span class="text-xs text-red-600 font-medium">Remove</span>
                    </label>
                </div>
            @endforeach
        </div>
        <p class="text-xs text-gray-400 mb-3">Tick "Remove" on any file above, then save to delete it.</p>
    @endif

    <input type="file"
           id="attachments"
           name="attachments[]"
           multiple
           accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.ppt,.pptx"
           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 @error('attachments') border-red-400 @enderror @error('attachments.*') border-red-400 @enderror">
    <p class="mt-1 text-xs text-gray-400">Images, PDF, Word, PowerPoint — max 10 MB each. Multiple files allowed.</p>
    @error('attachments')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
    @error('attachments.*')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- SEO --}}
<div class="border-t border-gray-100 pt-6 mt-6">
    <h3 class="text-sm font-semibold text-gray-700 mb-4">SEO (optional)</h3>

    <div class="mb-4">
        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
        <input type="text"
               id="meta_title"
               name="meta_title"
               value="{{ old('meta_title', $post?->meta_title) }}"
               maxlength="255"
               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('meta_title') border-red-400 @enderror"
               placeholder="Defaults to post title if left blank">
        @error('meta_title')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
        <textarea id="meta_description"
                  name="meta_description"
                  rows="3"
                  maxlength="500"
                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm @error('meta_description') border-red-400 @enderror"
                  placeholder="Short summary for search engines (max 500 chars)">{{ old('meta_description', $post?->meta_description) }}</textarea>
        @error('meta_description')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
