<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Upload Resources — {{ $chapter->title }}</h2>
            <a href="{{ route('admin.chapters.show', $chapter) }}"
               class="text-sm text-gray-600 hover:text-gray-800">← Back to Chapter</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-6 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-md text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <p class="text-sm text-gray-500 mb-6">Upload one or more files below. Leave sections blank to skip. Submit once to upload all.</p>

                <form action="{{ route('admin.chapters.resources.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">

                    {{-- Tutorial --}}
                    <div class="mb-6 p-4 border border-gray-200 rounded-md">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">
                            <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>Tutorial (MP4)
                        </h3>
                        <input type="file"
                               name="tutorial"
                               accept="video/mp4"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        <p class="mt-1 text-xs text-gray-400">MP4 format — max 500 MB.</p>
                        @error('tutorial')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Takeaway --}}
                    <div class="mb-6 p-4 border border-gray-200 rounded-md">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2"></span>Takeaway (MP4)
                        </h3>
                        <input type="file"
                               name="takeaway"
                               accept="video/mp4"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        <p class="mt-1 text-xs text-gray-400">MP4 format — max 500 MB.</p>
                        @error('takeaway')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Domain Summary in Poetry --}}
                    <div class="mb-6 p-4 border border-gray-200 rounded-md">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">
                            <span class="inline-block w-2 h-2 rounded-full bg-purple-500 mr-2"></span>Domain Summary in Poetry (MP4)
                        </h3>
                        <input type="file"
                               name="domain_summary"
                               accept="video/mp4"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        <p class="mt-1 text-xs text-gray-400">MP4 format — max 500 MB.</p>
                        @error('domain_summary')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Quizzes --}}
                    <div class="mb-6 p-4 border border-gray-200 rounded-md">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">
                            <span class="inline-block w-2 h-2 rounded-full bg-orange-500 mr-2"></span>Quiz (MP4)
                        </h3>
                        <input type="file"
                               name="quiz"
                               accept="video/mp4"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        <p class="mt-1 text-xs text-gray-400">MP4 format — max 500 MB.</p>
                        @error('quiz')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <button type="submit"
                                class="px-6 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                            Upload
                        </button>
                        <a href="{{ route('admin.chapters.show', $chapter) }}" class="text-sm text-gray-500 hover:text-gray-700">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
