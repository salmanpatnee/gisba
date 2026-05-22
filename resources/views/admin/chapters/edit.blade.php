<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Chapter</h2>
            <a href="{{ route('admin.chapters.index') }}"
               class="text-sm text-gray-600 hover:text-gray-800">← Back to Chapters</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.chapters.update', $chapter) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('admin.chapters._form')

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <button type="submit"
                                class="px-6 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.chapters.show', $chapter) }}" class="text-sm text-gray-500 hover:text-gray-700">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
