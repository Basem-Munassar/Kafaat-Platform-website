<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class usersController extends Controller
{
    public function index()
    {
        $users = User::all();
        $userCount = User::count();
        return view('admin.pages.users', compact('users', 'userCount'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin,super admin',
            'account_type' => 'required|in:user,kafaa,employee',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        if($request->hasFile('profile_image')){
            $imagePath = $request->file('profile_image')->store('users', 'public');
            $validated['profile_image'] = $imagePath;
        }
        User::create($validated);
        return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
    // public function show(int $id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('admin.pages.userProfile', compact('user'));
    // }
    
    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.add&Edit.addandEditUser', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:user,admin,super admin',
            'account_type' => 'required|in:user,kafaa,employee',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('users', 'public');
            $validated['profile_image'] = $imagePath;
        }

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }
}
