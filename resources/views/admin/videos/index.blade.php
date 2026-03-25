<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Video Resources</h2>
            <a href="{{ route('admin.videos.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                + Upload Video
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Size</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Views</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Uploaded</th>
                            <th class="px-6 py-3 text-right font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($videos as $video)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $video->title }}</div>
                                <div class="text-xs text-gray-400 mt-0.5">{{ $video->mime_type }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $video->readable_size }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ number_format($video->views) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $video->created_at->format('M j, Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <a href="{{ route('admin.videos.edit', $video) }}"
                                   class="text-indigo-600 hover:text-indigo-800 font-medium">Edit</a>
                                <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this video? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">No videos uploaded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($videos->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $videos->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
