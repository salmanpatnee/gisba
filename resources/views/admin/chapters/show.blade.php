<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $chapter->title }}</h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.chapters.resources.create', $chapter) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                    + Upload Resources
                </a>
                <a href="{{ route('admin.chapters.edit', $chapter) }}"
                   class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Edit</a>
                <a href="{{ route('admin.chapters.index') }}"
                   class="text-sm text-gray-600 hover:text-gray-800">← Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Chapter Details --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex gap-6">
                    @if($chapter->image_path)
                    <img src="{{ $chapter->image_url }}" alt="{{ $chapter->title }}"
                         class="h-28 w-44 rounded-md object-cover border border-gray-200 flex-shrink-0">
                    @endif
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Slug: <span class="font-mono">{{ $chapter->slug }}</span></p>
                        <p class="text-xs text-gray-400 mb-3">Sort Order: {{ $chapter->sort_order }}</p>
                        @if($chapter->description)
                        <p class="text-sm text-gray-600">{{ $chapter->description }}</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Resources --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">Resources</h3>
                </div>

                @if($chapter->resources->isEmpty())
                <p class="px-6 py-8 text-center text-gray-500 text-sm">No resources uploaded yet.</p>
                @else
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">File</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">MIME</th>
                            <th class="px-6 py-3 text-right font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($chapter->resources as $resource)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900 max-w-xs truncate">{{ $resource->file_name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-semibold
                                    {{ $resource->resource_type === 'video' ? 'bg-blue-100 text-blue-700' :
                                       ($resource->resource_type === 'document' ? 'bg-green-100 text-green-700' :
                                       ($resource->resource_type === 'checklist' ? 'bg-yellow-100 text-yellow-700' :
                                       'bg-purple-100 text-purple-700')) }}">
                                    {{ ucfirst($resource->resource_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-xs">{{ $resource->file_type }}</td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.chapters.resources.destroy', $resource) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this resource?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
