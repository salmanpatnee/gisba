<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SessionStatus;
use App\Http\Controllers\Controller;
use App\Models\UserSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserActivityController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $period = $request->input('period', 'Today');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $presence = $request->input('presence', 'All');
        $sortBy = $request->input('sort_by', 'Newest Login');
        [$sortColumn, $sortDirection] = $this->resolveSort($sortBy);

        [$rangeStart, $rangeEnd] = $this->resolveDateRange($period, $dateFrom, $dateTo);
        $onlineCutoff = UserSession::onlineCutoff();

        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();

        $summary = [
            'online_now' => UserSession::query()->active()
                ->where('last_activity_at', '>=', $onlineCutoff)
                ->distinct('user_id')
                ->count('user_id'),
            'todays_logins' => UserSession::query()->forDateRange($todayStart, $todayEnd)->count(),
            'todays_logouts' => UserSession::query()->whereBetween('logout_at', [$todayStart, $todayEnd])->count(),
            'active_sessions' => UserSession::query()->active()->count(),
            'avg_duration_today' => UserSession::formatDuration((int) UserSession::query()
                ->forDateRange($todayStart, $todayEnd)
                ->whereNotNull('duration_seconds')
                ->avg('duration_seconds')),
        ];

        $sessions = UserSession::query()
            ->with('user:id,name,email')
            ->when($search, fn ($query, $value) => $query->whereHas('user', function ($userQuery) use ($value) {
                $userQuery->where('name', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%");
            }))
            ->forDateRange($rangeStart, $rangeEnd)
            ->when($presence === 'Online', fn ($query) => $query->active()
                ->where('last_activity_at', '>=', $onlineCutoff))
            ->when($presence === 'Offline', fn ($query) => $query->where(function ($offlineQuery) use ($onlineCutoff) {
                $offlineQuery->where('status', SessionStatus::Ended)
                    ->orWhere('last_activity_at', '<', $onlineCutoff);
            }))
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(15)
            ->withQueryString();

        $totalLoginsByUser = UserSession::query()
            ->selectRaw('user_id, count(*) as total_logins')
            ->whereIn('user_id', $sessions->pluck('user_id')->unique())
            ->groupBy('user_id')
            ->pluck('total_logins', 'user_id');

        return view('admin.user-activity.index', compact(
            'sessions', 'summary', 'totalLoginsByUser', 'search', 'period', 'dateFrom', 'dateTo', 'presence', 'sortBy'
        ));
    }

    public function show(UserSession $userSession): View
    {
        $userSession->load('user:id,name,email');

        $activities = $userSession->activities()
            ->orderBy('occurred_at')
            ->paginate(25)
            ->withQueryString();

        return view('admin.user-activity.show', [
            'session' => $userSession,
            'activities' => $activities,
            'summary' => $this->buildActivitySummary($userSession),
        ]);
    }

    /**
     * @return array{top_page_label: string, top_page_visits: int, longest_stay_label: string, longest_stay_duration: string, top_module: string}|null
     */
    private function buildActivitySummary(UserSession $session): ?array
    {
        $rows = $session->activities()->orderBy('occurred_at')->get(['label', 'module', 'occurred_at']);

        if ($rows->count() < 2) {
            return null;
        }

        $boundary = $session->logout_at ?? now();

        $withDurations = $rows->map(function ($row, $i) use ($rows, $boundary) {
            $until = $rows->get($i + 1)?->occurred_at ?? $boundary;

            return [
                'label' => $row->label,
                'module' => $row->module,
                'seconds' => $row->occurred_at->diffInSeconds($until),
            ];
        });

        $topPage = $rows->countBy('label')->sortDesc();
        $longestStay = $withDurations->sortByDesc('seconds')->first();
        $topModule = $withDurations->groupBy('module')
            ->map(fn ($group) => $group->sum('seconds'))
            ->sortDesc();

        return [
            'top_page_label' => $topPage->keys()->first(),
            'top_page_visits' => $topPage->first(),
            'longest_stay_label' => $longestStay['label'],
            'longest_stay_duration' => UserSession::formatDuration($longestStay['seconds']),
            'top_module' => $topModule->keys()->first(),
        ];
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function resolveSort(string $sortBy): array
    {
        return match ($sortBy) {
            'Oldest Login' => ['login_at', 'asc'],
            'Newest Logout' => ['logout_at', 'desc'],
            'Longest Duration' => ['duration_seconds', 'desc'],
            'Shortest Duration' => ['duration_seconds', 'asc'],
            default => ['login_at', 'desc'],
        };
    }

    /**
     * @return array{0: Carbon, 1: Carbon}
     */
    private function resolveDateRange(string $period, ?string $dateFrom, ?string $dateTo): array
    {
        return match ($period) {
            'This Week' => [now()->startOfWeek(), now()->endOfWeek()],
            'This Month' => [now()->startOfMonth(), now()->endOfMonth()],
            'Custom Range' => $this->resolveCustomRange($dateFrom, $dateTo),
            default => [now()->startOfDay(), now()->endOfDay()],
        };
    }

    /**
     * @return array{0: Carbon, 1: Carbon}
     */
    private function resolveCustomRange(?string $dateFrom, ?string $dateTo): array
    {
        if (! $dateFrom || ! $dateTo) {
            return [now()->startOfDay(), now()->endOfDay()];
        }

        try {
            return [Carbon::parse($dateFrom)->startOfDay(), Carbon::parse($dateTo)->endOfDay()];
        } catch (\Exception) {
            return [now()->startOfDay(), now()->endOfDay()];
        }
    }
}
