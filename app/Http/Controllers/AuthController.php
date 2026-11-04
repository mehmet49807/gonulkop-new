<?php

namespace App\Http\Controllers;

use App\Gender;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function createLogin(): View
    {
        return view('auth.login');
    }

    public function storeLogin(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->safe()->only(['email', 'password']);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->isAdmin()) {
            $request->session()->put([
                'admin_auth' => true,
                'admin_email' => Auth::user()->email,
                'admin_name' => Auth::user()->name,
            ]);

            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended(route('feed.index'));
    }

    public function createRegister(): View
    {
        return view('auth.register');
    }

    public function storeRegister(RegisterRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('profile_photo');
        $gender = Gender::from($data['gender']);

        $user = new User($data);

        if ($request->hasFile('profile_photo')) {
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->trial_ends_at = $gender === Gender::Male
            ? now()->addDays(User::TRIAL_DAYS)
            : null;
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('feed.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
