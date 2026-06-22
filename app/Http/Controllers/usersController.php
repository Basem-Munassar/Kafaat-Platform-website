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
        $validated =$request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'role' => 'required|string|in:admin,user',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
        ]); 
        
        if($request->hasFile('profile_image')){
            $imagePath = $request->file('profile_image')->store('users', 'public');
            $validated['profile_image'] = $imagePath;
        }
        $users = User::create($validated);
        return redirect()->route('admin.users.index')->with('success', 'User added successfully');
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
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('users', 'public');
            $validated['profile_image'] = $imagePath;
        }

        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }
}
