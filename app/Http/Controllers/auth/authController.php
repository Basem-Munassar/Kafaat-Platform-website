<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function login()
    {
        return view('admin.pages.auth.login');
    }

    public function register()
    {
        return view('admin.pages.auth.register');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            // 'role' => 'required|string|in:admin,user',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            // 'role' => 'required|string|in:admin,user',
        ]);

        
        $user = User::create($validated);

        // Log in the user immediately after registration
        // Auth::loginUsingId($user->id);
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_image' => $user->profile_image,
            'user_phone' => $user->phone,
            'user_location' => $user->location,
            'user_role' => $user->role,

        ]);

        if ($user) {
            return redirect()->route('dashboard.index')->with('success', 'User registered and logged in successfully');
        } else {
            return redirect()->back()->with('error', 'User registration failed');
        }
    }

    public function checkUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Store user data in the session
            $user = Auth::user();
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_image' => $user->profile_image,
                'user_phone' => $user->phone,
                'user_location' => $user->location,
                'user_role' => $user->role,
            ]);

            return redirect()->route('dashboard.index')->with('success', 'Logged in successfully');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('success', 'Logged out successfully');
    }

}
