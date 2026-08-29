<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $label }} Enrollments</h2>
            <span class="text-sm text-gray-500">
                @if ($seatsRemaining !== null)
                    {{ $seatsRemaining }} of {{ $capacity }} seats remaining
                @else
                    {{ $totalEnrolled }} enrolled &mdash; capacity: {{ $capacity }}
                @endif
            </span>
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
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Enrolled</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($enrollments as $enrollment)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $enrollment->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $enrollment->email }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $enrollment->currency }} {{ number_format((float) $enrollment->amount, 2) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ ucfirst($enrollment->status) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $enrollment->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">No enrollments yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($enrollments->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $enrollments->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
