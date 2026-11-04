<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Post;
use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function createLogin(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('admin_auth') === true) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin-login');
    }

    public function storeLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $admin = User::query()
            ->where('email', $credentials['email'])
            ->where('is_admin', true)
            ->first();

        if (! $admin || ! Hash::check($credentials['password'], $admin->password)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Yönetici bilgileri doğrulanamadı.']);
        }

        $request->session()->regenerate();
        $request->session()->put([
            'admin_auth' => true,
            'admin_email' => $admin->email,
            'admin_name' => $admin->name,
        ]);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function dashboard(Request $request): View
    {
        $stats = [
            'total_users' => User::query()->count(),
            'male_users' => User::query()->where('gender', 'male')->count(),
            'female_users' => User::query()->where('gender', 'female')->count(),
            'premium_users' => User::query()->where('is_premium', true)->count(),
            'admin_users' => User::query()->where('is_admin', true)->count(),
            'total_posts' => Post::query()->count(),
            'published_posts' => Post::query()->where('status', 'published')->count(),
            'total_messages' => Message::query()->count(),
            'total_stories' => Story::query()->count(),
            'new_users_today' => User::query()->whereDate('created_at', today())->count(),
            'messages_today' => Message::query()->whereDate('created_at', today())->count(),
            'recent_users' => User::query()->latest()->limit(6)->get(),
            'recent_posts' => Post::query()->with('user')->latest()->limit(5)->get(),
            'gender_distribution' => [
                'Kadın' => User::query()->where('gender', 'female')->count(),
                'Erkek' => User::query()->where('gender', 'male')->count(),
            ],
            'top_cities' => User::query()
                ->whereNotNull('city')
                ->select('city', DB::raw('count(*) as total'))
                ->groupBy('city')
                ->orderByDesc('total')
                ->limit(5)
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users(Request $request): View
    {
        $search = trim((string) $request->string('search'));
        $gender = (string) $request->string('gender');
        $membership = (string) $request->string('membership');

        $users = User::query()
            ->when($search !== '', fn (Builder $query) => $query->where(function (Builder $query) use ($search): void {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            }))
            ->when(in_array($gender, ['male', 'female'], true), fn (Builder $query) => $query->where('gender', $gender))
            ->when($membership === 'premium', fn (Builder $query) => $query->where('is_premium', true))
            ->when($membership === 'free', fn (Builder $query) => $query->where('is_premium', false))
            ->when($membership === 'admin', fn (Builder $query) => $query->where('is_admin', true))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function showUser(Request $request, int $id): View
    {
        $user = User::query()
            ->withCount(['posts', 'stories', 'sentMessages', 'receivedMessages'])
            ->findOrFail($id);

        return view('admin.user-show', compact('user'));
    }

    public function updateUser(Request $request, int $id): RedirectResponse
    {
        $user = User::query()->findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'city' => ['nullable', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'bio' => ['nullable', 'string', 'max:5000'],
            'profile_visibility' => ['required', Rule::in(['public', 'private'])],
            'is_premium' => ['nullable', 'boolean'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $user->forceFill([
            ...$validated,
            'is_premium' => $request->boolean('is_premium'),
            'is_admin' => $request->boolean('is_admin'),
        ])->save();

        return redirect()->route('admin.users.show', $user)->with('success', 'Kullanıcı bilgileri güncellendi.');
    }

    public function destroyUser(Request $request, int $id): RedirectResponse
    {
        $user = User::query()->findOrFail($id);

        if ($user->is_admin) {
            return back()->with('error', 'Yönetici hesapları panelden silinemez.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Kullanıcı başarıyla silindi.');
    }

    public function posts(Request $request): View
    {
        $search = trim((string) $request->string('search'));
        $status = (string) $request->string('status');

        $posts = Post::query()
            ->with('user')
            ->when($search !== '', fn (Builder $query) => $query->where(function (Builder $query) use ($search): void {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('user', fn (Builder $query) => $query->where('name', 'like', "%{$search}%"));
            }))
            ->when(in_array($status, ['published', 'draft'], true), fn (Builder $query) => $query->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.posts', compact('posts'));
    }

    public function destroyPost(Request $request, int $id): RedirectResponse
    {
        $post = Post::query()->findOrFail($id);

        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return back()->with('success', 'Gönderi başarıyla silindi.');
    }

    public function messages(Request $request): View
    {
        $search = trim((string) $request->string('search'));

        $messages = Message::query()
            ->with(['sender', 'recipient'])
            ->when($search !== '', fn (Builder $query) => $query->where(function (Builder $query) use ($search): void {
                $query->where('content', 'like', "%{$search}%")
                    ->orWhereHas('sender', fn (Builder $query) => $query->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('recipient', fn (Builder $query) => $query->where('name', 'like', "%{$search}%"));
            }))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.messages', compact('messages'));
    }

    public function settings(Request $request): View
    {
        $system = [
            'environment' => app()->environment(),
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'database' => config('database.default'),
            'admin_email' => $request->session()->get('admin_email'),
            'registered_users' => User::query()->count(),
            'published_posts' => Post::query()->where('status', 'published')->count(),
        ];

        return view('admin.settings', compact('system'));
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin_auth', 'admin_email', 'admin_name']);
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Oturum güvenli şekilde kapatıldı.');
    }
}
