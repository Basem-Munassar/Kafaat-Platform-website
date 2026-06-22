<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class authController extends Controller
{
    public function login()
    {
        return view('kafaa.pages.auth.login');
    }

    public function register()
    {
        return view('kafaa.pages.auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'account_type' => 'required|string|in:user,kafaa',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'account_type' => $validated['account_type'],
            'phone' => $validated['phone'] ?? null,
            'location' => $validated['location'] ?? null,
            'role' => 'user', // default role
            'is_available' => true,
        ]);

        Auth::login($user);

        return $this->redirectBasedOnRole($user);
    }

    public function checkUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return $this->redirectBasedOnRole($user);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index')->with('success', 'Logged out successfully');
    }

    private function redirectBasedOnRole($user)
    {
        // Consider both role and account_type: a kafaa account keeps role 'user',
        // so relying on role alone would never route it to the kafaa dashboard.
        $roles = array_filter([$user->role, $user->account_type]);

        if (in_array('admin', $roles) || in_array('super admin', $roles)) {
            return redirect()->route('admin.dashboard.index')->with('success', 'Logged in as Admin');
        } elseif (array_intersect($roles, ['employee', 'kafaa'])) {
            return redirect()->route('kafaa.dashboard.index')->with('success', 'Logged in as Kafaa');
        } else {
            return redirect()->route('home.index')->with('success', 'Logged in successfully');
        }
    }
}
