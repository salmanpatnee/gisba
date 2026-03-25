<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Video</h2>
            <a href="{{ route('admin.videos.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-200 transition">
                &larr; Back to Videos
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.videos.update', $video) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- Title --}}
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Video Title <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $video->title) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error('title') border-red-400 @enderror"
                            required
                        >
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Current video info --}}
                    <div class="mb-4 px-4 py-3 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-600">
                        <span class="font-medium text-gray-700">Current file:</span>
                        {{ $video->mime_type }} &mdash; {{ $video->readable_size }}
                    </div>

                    {{-- Replacement video file --}}
                    <div class="mb-6">
                        <label for="video" class="block text-sm font-medium text-gray-700 mb-1">Replace Video File <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input
                            type="file"
                            id="video"
                            name="video"
                            accept="video/mp4,video/webm,video/ogg"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 @error('video') border-red-400 @enderror"
                        >
                        <p class="mt-1 text-xs text-gray-500">Leave blank to keep the current file. Accepted: MP4, WebM, OGG &mdash; maximum 500 MB.</p>
                        @error('video')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- New file preview --}}
                    <div id="video-preview-wrap" class="mb-6 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-1">New File Preview</label>
                        <video id="video-preview" controls class="w-full rounded border border-gray-200" style="max-height:240px; background:#000;"></video>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="px-5 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.videos.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.getElementById('video').addEventListener('change', function () {
        const file = this.files[0];
        const wrap = document.getElementById('video-preview-wrap');
        const preview = document.getElementById('video-preview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            wrap.classList.remove('hidden');
        } else {
            wrap.classList.add('hidden');
            preview.src = '';
        }
    });
    </script>
    @endpush
</x-app-layout>
