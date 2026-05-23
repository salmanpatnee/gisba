<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Members</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 px-4 py-3 bg-red-100 border border-red-300 text-red-800 rounded-md text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Member Since</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Expires</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($members as $member)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $member->name }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $member->email }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $member->member_since?->format('M d, Y') ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">
                                @if($member->member_since)
                                    @php $expiry = $member->memberExpiresAt(); @endphp
                                    <span class="{{ $member->isMember() ? ($member->isExpiringWithinDays(14) ? 'text-yellow-600 font-medium' : '') : 'text-red-600' }}">
                                        {{ $expiry->format('M d, Y') }}
                                    </span>
                                    @if(! $member->isMember())
                                        <span class="text-xs text-red-400 ml-1">(expired)</span>
                                    @elseif($member->isExpiringWithinDays(14))
                                        <span class="text-xs text-yellow-500 ml-1">(soon)</span>
                                    @endif
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($member->isMember())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-3">
                                @if($member->isMember())
                                <form action="{{ route('admin.members.revoke', $member) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Revoke membership for {{ $member->name }}?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-800 font-medium">Revoke</button>
                                </form>
                                @endif
                                <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete {{ $member->name }}? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">No members found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($members->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $members->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
