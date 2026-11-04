<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Publish a new post.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        Gate::forUser($request->user())->authorize('create', Post::class);

        $data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('post-images', 'public');
        }

        $post = $request->user()->posts()->create([
            ...$data,
            'slug' => $this->uniqueSlug($data['title']),
            'status' => 'published',
            'published_at' => now(),
        ]);

        return redirect()
            ->route('profile.index')
            ->with('status', 'Gönderiniz yayımlandı.');
    }

    /**
     * Delete a post owned by the member.
     */
    public function destroy(Post $post): RedirectResponse
    {
        Gate::authorize('delete', $post);

        if ($post->image_path !== null) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return redirect()
            ->route('profile.index')
            ->with('status', 'Gönderiniz silindi.');
    }

    /**
     * Return a post visible to the authenticated user.
     */
    public function show(Post $post): JsonResponse
    {
        Gate::authorize('view', $post);

        return response()->json([
            'data' => $post->load('user:id,name,gender,profile_photo_path'),
        ]);
    }

    /**
     * Generate a unique, URL-safe slug for a post.
     */
    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'gonderi';

        do {
            $slug = $base.'-'.Str::lower(Str::random(8));
        } while (Post::query()->where('slug', $slug)->exists());

        return $slug;
    }
}
