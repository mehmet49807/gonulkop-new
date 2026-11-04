<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscoveryRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DiscoveryController extends Controller
{
    /**
     * Discover members of the opposite gender.
     */
    public function index(DiscoveryRequest $request): View|JsonResponse
    {
        $member = $request->user();
        $filters = $this->filters($request);

        $users = User::query()
            ->whereKeyNot($member->getKey())
            ->where('gender', $member->gender?->opposite()?->value)
            ->when($filters['city'] !== null, fn (Builder $query) => $query->where('city', $filters['city']))
            ->when($filters['min_age'] !== null, fn (Builder $query) => $query
                ->whereDate('birth_date', '<=', now()->subYears($filters['min_age'])->toDateString()))
            ->when($filters['max_age'] !== null, fn (Builder $query) => $query
                ->whereDate('birth_date', '>=', now()->subYears($filters['max_age'] + 1)->addDay()->toDateString()))
            ->when(! $member->isAdmin(), fn (Builder $query) => $query->where('profile_visibility', '!=', 'private'))
            ->orderBy('name')
            ->get()
            ->map(fn (User $user): array => [
                'id' => $user->getKey(),
                'name' => $user->name,
                'username' => $user->username,
                'bio' => $user->bio,
                'city' => $user->show_location ? $user->city : null,
                'birth_date' => $user->birth_date?->toDateString(),
                'age' => $user->age,
                'gender' => $user->gender?->value,
                'profile_photo_path' => $user->profile_photo_path,
                'avatar_path' => $user->profile_photo_path,
                'avatar_url' => $user->avatar_url,
            ]);

        $cities = User::query()
            ->where('gender', $member->gender?->opposite()?->value)
            ->whereNotNull('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        if ($request->expectsJson()) {
            return response()->json([
                'data' => $users,
                'meta' => [
                    'filters' => $filters,
                    'cities' => $cities,
                ],
            ]);
        }

        return view('discovery.index', [
            'users' => $users,
            'cities' => $cities,
            'filters' => $filters,
        ]);
    }

    /**
     * Matches (swipe) view of opposite-gender members.
     */
    public function matches(DiscoveryRequest $request): View|JsonResponse
    {
        $member = $request->user();
        $filters = $this->filters($request);

        $users = User::query()
            ->whereKeyNot($member->getKey())
            ->where('gender', $member->gender?->opposite()?->value)
            ->when($filters['city'] !== null, fn (Builder $query) => $query->where('city', $filters['city']))
            ->when($filters['min_age'] !== null, fn (Builder $query) => $query
                ->whereDate('birth_date', '<=', now()->subYears($filters['min_age'])->toDateString()))
            ->when($filters['max_age'] !== null, fn (Builder $query) => $query
                ->whereDate('birth_date', '>=', now()->subYears($filters['max_age'] + 1)->addDay()->toDateString()))
            ->when(! $member->isAdmin(), fn (Builder $query) => $query->where('profile_visibility', '!=', 'private'))
            ->orderBy('name')
            ->get()
            ->map(fn (User $user): array => [
                'id' => $user->getKey(),
                'name' => $user->name,
                'username' => $user->username,
                'bio' => $user->bio,
                'city' => $user->show_location ? $user->city : null,
                'birth_date' => $user->birth_date?->toDateString(),
                'age' => $user->age,
                'gender' => $user->gender?->value,
                'profile_photo_path' => $user->profile_photo_path,
                'avatar_path' => $user->profile_photo_path,
                'avatar_url' => $user->avatar_url,
            ]);

        if ($request->expectsJson()) {
            return response()->json([
                'data' => $users,
                'meta' => [
                    'filters' => $filters,
                ],
            ]);
        }

        return view('matches', [
            'users' => $users,
            'filters' => $filters,
        ]);
    }

    /**
     * Normalize the supported discovery filters.
     *
     * @return array{city: ?string, min_age: ?int, max_age: ?int, age: string}
     */
    private function filters(DiscoveryRequest $request): array
    {
        $validated = $request->validated();
        $age = $validated['age'] ?? 'all';
        $ranges = [
            '18-24' => [18, 24],
            '25-34' => [25, 34],
            '35-44' => [35, 44],
            '45+' => [45, null],
        ];

        $range = $ranges[$age] ?? [null, null];
        $hasExplicitRange = array_key_exists('min_age', $validated)
            || array_key_exists('max_age', $validated)
            || array_key_exists('age_min', $validated)
            || array_key_exists('age_max', $validated);
        $minAge = $validated['min_age'] ?? $validated['age_min'] ?? ($hasExplicitRange ? null : $range[0]);
        $maxAge = $validated['max_age'] ?? $validated['age_max'] ?? ($hasExplicitRange ? null : $range[1]);

        return [
            'city' => $validated['city'] ?? null,
            'min_age' => $minAge,
            'max_age' => $maxAge,
            'age' => $age,
        ];
    }
}
