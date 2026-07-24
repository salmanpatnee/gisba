<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Session — {{ $session->user->name }}</h2>
            <a href="{{ route('admin.user-activity.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Back to User Activity</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm rounded-lg p-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <dt class="text-sm text-gray-500">Member</dt>
                        <dd class="mt-1 font-medium text-gray-900">{{ $session->user->name }}</dd>
                        <dd class="text-sm text-gray-500">{{ $session->user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $session->status->badgeColor() }}">
                                {{ $session->status->label() }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Login</dt>
                        <dd class="mt-1 text-gray-900">{{ $session->login_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Logout</dt>
                        <dd class="mt-1 text-gray-900">{{ $session->logout_at?->format('M d, Y H:i') ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Duration</dt>
                        <dd class="mt-1 text-gray-900">{{ $session->durationForHumans() }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Browser</dt>
                        <dd class="mt-1 text-gray-900">{{ $session->browser ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Platform</dt>
                        <dd class="mt-1 text-gray-900">{{ $session->platform ?? '—' }} ({{ $session->device_type ?? '—' }})</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">IP Address</dt>
                        <dd class="mt-1 text-gray-900">{{ $session->ip_address ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            @if($summary)
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Most Visited Page</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $summary['top_page_label'] }}</p>
                    <p class="text-sm text-gray-500">{{ $summary['top_page_visits'] }} visit(s)</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Longest Single Stay</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $summary['longest_stay_label'] }}</p>
                    <p class="text-sm text-gray-500">{{ $summary['longest_stay_duration'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Top Module of Interest</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $summary['top_module'] }}</p>
                </div>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Page</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Module</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Route</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($activities as $activity)
                        <tr>
                            <td class="px-6 py-4 text-gray-500">{{ $activity->occurred_at->format('M d, Y H:i:s') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $activity->label ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $activity->module ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $activity->route_name ?? '—' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">No page visits recorded for this session.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($activities->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $activities->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
