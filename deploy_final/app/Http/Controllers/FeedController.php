<?php

namespace App\Http\Controllers;

use App\Gender;
use App\Models\Post;
use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class FeedController extends Controller
{
    /**
     * Return the authenticated member's gender-filtered feed.
     */
    public function index(Request $request): View|JsonResponse
    {
        Gate::authorize('feed.view');

        $validated = $request->validate([
            'city' => ['nullable', 'string', 'max:255'],
            'age' => ['nullable', 'in:all,18-24,25-34,35-44,45+'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:30'],
        ]);

        $viewer = $request->user();
        $targetGender = $viewer->gender?->opposite() ?? Gender::Female;
        $filters = $this->filters($validated);
        $perPage = min(max((int) ($validated['per_page'] ?? 15), 1), 30);

        $posts = Post::query()
            ->published()
            ->whereHas('user', fn (Builder $query) => $query
                ->where('gender', $targetGender->value)
                ->when($filters['city'] !== null, fn (Builder $cityQuery) => $cityQuery->where('city', $filters['city']))
                ->when($filters['min_age'] !== null, fn (Builder $ageQuery) => $ageQuery
                    ->whereDate('birth_date', '<=', now()->subYears($filters['min_age'])->toDateString()))
                ->when($filters['max_age'] !== null, fn (Builder $ageQuery) => $ageQuery
                    ->whereDate('birth_date', '>=', now()->subYears($filters['max_age'] + 1)->addDay()->toDateString())))
            ->with('user:id,username,city,show_location,profile_photo_path')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->cursorPaginate($perPage)
            ->withQueryString();

        $stories = Story::query()
            ->whereHas('user', fn (Builder $query) => $query
                ->where('gender', $targetGender->value)
                ->when($filters['city'] !== null, fn (Builder $cityQuery) => $cityQuery->where('city', $filters['city']))
                ->when($filters['min_age'] !== null, fn (Builder $ageQuery) => $ageQuery
                    ->whereDate('birth_date', '<=', now()->subYears($filters['min_age'])->toDateString()))
                ->when($filters['max_age'] !== null, fn (Builder $ageQuery) => $ageQuery
                    ->whereDate('birth_date', '>=', now()->subYears($filters['max_age'] + 1)->addDay()->toDateString())))
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(fn (Builder $query) => $query
                ->whereNull('expires_at')
                ->orWhere('expires_at', '>', now()))
            ->with('user:id,username,city,show_location,profile_photo_path')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(12)
            ->get();

        $cities = User::query()
            ->where('gender', $targetGender->value)
            ->whereNotNull('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        if ($request->routeIs('feed.api') || $request->expectsJson()) {
            return response()->json([
                'data' => $posts->getCollection()->map(fn (Post $post): array => $this->postPayload($post))->all(),
                'stories' => $stories->map(fn (Story $story): array => $this->storyPayload($story))->all(),
                'meta' => [
                    'per_page' => $posts->perPage(),
                    'next_cursor' => $posts->nextCursor()?->encode(),
                    'next_page_url' => $posts->nextPageUrl(),
                    'filters' => $filters,
                ],
            ]);
        }

        return view('feed.index', [
            'stories' => $stories,
            'posts' => $posts,
            'filters' => $filters,
            'cities' => $cities,
        ]);
    }

    /**
     * Normalize the supported feed filters.
     *
     * @param  array<string, mixed>  $validated
     * @return array{city: ?string, min_age: ?int, max_age: ?int, age: string}
     */
    private function filters(array $validated): array
    {
        $city = isset($validated['city']) ? trim((string) $validated['city']) : '';
        $age = (string) ($validated['age'] ?? 'all');
        $ranges = [
            '18-24' => [18, 24],
            '25-34' => [25, 34],
            '35-44' => [35, 44],
            '45+' => [45, null],
        ];
        [$minAge, $maxAge] = $ranges[$age] ?? [null, null];

        return [
            'city' => $city !== '' ? $city : null,
            'min_age' => $minAge,
            'max_age' => $maxAge,
            'age' => $age,
        ];
    }

    /**
     * Build the privacy-safe API representation of a post.
     *
     * @return array<string, mixed>
     */
    private function postPayload(Post $post): array
    {
        return [
            'id' => $post->getKey(),
            'title' => $post->title,
            'content' => $post->content,
            'image_path' => $post->image_path,
            'published_at' => $post->published_at?->toIso8601String(),
            'likes_count' => 0,
            'comments_count' => 0,
            'user' => $this->userPayload($post->user),
        ];
    }

    /**
     * Build the privacy-safe API representation of a story.
     *
     * @return array<string, mixed>
     */
    private function storyPayload(Story $story): array
    {
        return [
            'id' => $story->getKey(),
            'title' => $story->title,
            'content' => $story->content,
            'image_path' => $story->image_path,
            'published_at' => $story->published_at?->toIso8601String(),
            'expires_at' => $story->expires_at?->toIso8601String(),
            'user' => $this->userPayload($story->user),
        ];
    }

    /**
     * Expose only the public identity fields required by feed cards.
     *
     * @return array<string, mixed>
     */
    private function userPayload(?User $user): array
    {
        if (! $user) {
            return [];
        }

        $payload = [
            'id' => $user->getKey(),
            'username' => $user->username,
            'profile_photo_path' => $user->profile_photo_path,
            'avatar_url' => $user->avatar_url,
        ];

        if ($user->show_location) {
            $payload['city'] = $user->city;
        }

        return $payload;
    }
}
