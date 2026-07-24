<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Activity</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Online Now</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $summary['online_now'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Today's Logins</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $summary['todays_logins'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Today's Logouts</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $summary['todays_logouts'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Active Sessions</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $summary['active_sessions'] }}</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Avg. Duration Today</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $summary['avg_duration_today'] }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('admin.user-activity.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
                    <div>
                        <x-input-label for="search" value="Search" />
                        <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" value="{{ $search }}" placeholder="Name or email" />
                    </div>
                    <div>
                        <x-input-label for="period" value="Period" />
                        <select id="period" name="period" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                            @foreach(['Today', 'This Week', 'This Month', 'Custom Range'] as $option)
                                <option value="{{ $option }}" @selected($period === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="date_from" value="From" />
                        <x-text-input id="date_from" name="date_from" type="date" class="mt-1 block w-full" value="{{ $dateFrom }}" />
                    </div>
                    <div>
                        <x-input-label for="date_to" value="To" />
                        <x-text-input id="date_to" name="date_to" type="date" class="mt-1 block w-full" value="{{ $dateTo }}" />
                    </div>
                    <div>
                        <x-input-label for="presence" value="Presence" />
                        <select id="presence" name="presence" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                            @foreach(['All', 'Online', 'Offline'] as $option)
                                <option value="{{ $option }}" @selected($presence === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="sort_by" value="Sort By" />
                        <select id="sort_by" name="sort_by" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                            @foreach(['Newest Login', 'Oldest Login', 'Newest Logout', 'Longest Duration', 'Shortest Duration'] as $option)
                                <option value="{{ $option }}" @selected($sortBy === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="lg:col-span-5">
                        <x-primary-button type="submit">Filter</x-primary-button>
                        <a href="{{ route('admin.user-activity.index') }}" class="ml-2 text-sm text-gray-500 hover:text-gray-700">Reset</a>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Member</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Login</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Logout</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Total Logins</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Presence</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($sessions as $userSession)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $userSession->user->name }}</div>
                                <div class="text-gray-500">{{ $userSession->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $userSession->login_at->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $userSession->logout_at?->format('M d, Y H:i') ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $userSession->durationForHumans() }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $totalLoginsByUser[$userSession->user_id] ?? 1 }}</td>
                            <td class="px-6 py-4">
                                @if($userSession->isCurrentlyOnline())
                                    <span class="inline-flex items-center gap-1.5 text-green-700">
                                        <span class="h-2 w-2 rounded-full bg-green-500"></span> Online
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-gray-500">
                                        <span class="h-2 w-2 rounded-full bg-gray-300"></span> Offline
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $userSession->status->badgeColor() }}">
                                    {{ $userSession->status->label() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.user-activity.show', $userSession) }}" class="text-blue-600 hover:text-blue-800 font-medium">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-gray-500">No sessions found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($sessions->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $sessions->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
