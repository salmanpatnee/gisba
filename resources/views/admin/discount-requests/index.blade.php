<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pay-What-You-Can-Afford Requests</h2>
            <span class="text-sm text-gray-500">{{ $discountRequests->total() }} total</span>
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
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">PMP %</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">CRISC %</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">PRINCE2 %</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($discountRequests as $discountRequest)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $discountRequest->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $discountRequest->email }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $discountRequest->pmp_discount_percentage !== null ? $discountRequest->pmp_discount_percentage.'%' : '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $discountRequest->crisc_discount_percentage !== null ? $discountRequest->crisc_discount_percentage.'%' : '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $discountRequest->prince2_discount_percentage !== null ? $discountRequest->prince2_discount_percentage.'%' : '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $discountRequest->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">No requests yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($discountRequests->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $discountRequests->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
