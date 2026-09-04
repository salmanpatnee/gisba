<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Enquiries</h2>
            <span class="text-sm text-gray-500">{{ $enquiries->total() }} total</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Organization</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Heard From</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($enquiries as $enquiry)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $enquiry->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $enquiry->email }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $enquiry->organization ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $enquiry->phone ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $enquiry->service ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $enquiry->heard_from }}</td>
                            <td class="px-6 py-4 text-gray-600 max-w-xs truncate" title="{{ $enquiry->message }}">{{ $enquiry->message }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $enquiry->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-gray-500">No enquiries yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($enquiries->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $enquiries->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
