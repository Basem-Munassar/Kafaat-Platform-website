<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class skillsController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        $skillCount = Skill::count();
        return view('admin.pages.skills', compact('skills', 'skillCount'));
    }
    
    public function store(Request $request)
    {
        $validated =$request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:100',
            // 'category', 
        ]);         
       
        $skill = Skill::create($validated);
        return redirect()->route('skills.index')->with('success', 'skill created successfully');
    }
}
