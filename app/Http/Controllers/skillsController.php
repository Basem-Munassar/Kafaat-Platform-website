<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class skillsController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        $skillCount = Skill::count();
        return view('admin.pages.skills', compact('skills', 'skillCount'));
    }
    
    public function create()
    {
        $users = \App\Models\User::orderBy('name')->get();
        return view('admin.pages.add&Edit.addandEditSkill', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:100',
            'category' => 'nullable|string|max:100',
        ]);

        Skill::create($validated);
        return redirect()->route('admin.skills.index')->with('success', 'تم إضافة المهارة بنجاح');
    }

    public function edit(int $id)
    {
        $skill = Skill::findOrFail($id);
        $users = \App\Models\User::orderBy('name')->get();
        return view('admin.pages.add&Edit.addandEditSkill', compact('skill', 'users'));
    }

    public function update(Request $request, int $id)
    {
        $skill = Skill::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:100',
            'category' => 'nullable|string|max:100',
        ]);

        $skill->update($validated);
        return redirect()->route('admin.skills.index')->with('success', 'تم تحديث المهارة بنجاح');
    }

    public function destroy(int $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect()->back()->with('success', 'تم حذف المهارة بنجاح');
    }

    // Kafaa (Expert) Panel Methods
    public function kafaaIndex()
    {
        $skills = Skill::where('user_id', Auth::id())->get();
        return view('kafaa.pages.skills', compact('skills'));
    }

    public function kafaaCreate()
    {
        return view('kafaa.pages.add&Edit.addandEditSkill');
    }

    public function kafaaStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:100',
            'category' => 'nullable|string|max:100',
        ]);

        $validated['user_id'] = Auth::id();

        Skill::create($validated);
        return redirect()->route('kafaa.skills.index')->with('success', 'تم إضافة المهارة بنجاح');
    }

    public function kafaaEdit(int $id)
    {
        $skill = Skill::where('user_id', Auth::id())->findOrFail($id);
        return view('kafaa.pages.add&Edit.addandEditSkill', compact('skill'));
    }

    public function kafaaUpdate(Request $request, int $id)
    {
        $skill = Skill::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:100',
            'category' => 'nullable|string|max:100',
        ]);

        $skill->update($validated);
        return redirect()->route('kafaa.skills.index')->with('success', 'تم تحديث المهارة بنجاح');
    }

    public function kafaaDestroy(int $id)
    {
        $skill = Skill::where('user_id', Auth::id())->findOrFail($id);
        $skill->delete();
        return redirect()->back()->with('success', 'تم حذف المهارة بنجاح');
    }
}
