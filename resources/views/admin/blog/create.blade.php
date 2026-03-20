<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.blog.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">&larr; Back</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Blog Post</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('admin.blog._form', ['post' => null])

                    <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.blog.index') }}"
                           class="px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-5 py-2 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700 transition">
                            Publish Post
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @include('admin.blog._tinymce')
</x-app-layout>
