<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class jobsController extends Controller
{
    public function index()
    {
        $jobTitles = JobTitle::all();
        $jobTitleCount = JobTitle::count();
        return view('admin.pages.jobsTitle', compact('jobTitles', 'jobTitleCount'));
    }

    public function create()
    {
        $users = \App\Models\User::orderBy('name')->get();
        return view('admin.pages.add&Edit.addAndEditJobTitle', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);
        JobTitle::create($validated);
        return redirect()->route('admin.jobsTitle.index')->with('success', 'تم إضافة المسمى الوظيفي بنجاح');
    }

    public function edit(int $id)
    {
        $jobTitle = JobTitle::findOrFail($id);
        $users = \App\Models\User::orderBy('name')->get();
        return view('admin.pages.add&Edit.addAndEditJobTitle', compact('jobTitle', 'users'));
    }

    public function update(Request $request, int $id)
    {
        $jobTitle = JobTitle::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);
        $jobTitle->update($validated);
        return redirect()->route('admin.jobsTitle.index')->with('success', 'تم تحديث المسمى الوظيفي بنجاح');
    }

    public function destroy(int $id)
    {
        $jobTitle = JobTitle::findOrFail($id);
        $jobTitle->delete();
        return redirect()->back()->with('success', 'تم حذف المسمى الوظيفي بنجاح');
    }

    // Kafaa (Expert) Panel Methods
    public function kafaaIndex()
    {
        $jobTitles = JobTitle::where('user_id', Auth::id())->get();
        return view('kafaa.pages.jobsTitle', compact('jobTitles'));
    }

    public function kafaaCreate()
    {
        return view('kafaa.pages.add&Edit.addAndEditJobTitle');
    }

    public function kafaaStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $validated['user_id'] = Auth::id();

        JobTitle::create($validated);
        return redirect()->route('kafaa.jobsTitle.index')->with('success', 'تم إضافة المسمى الوظيفي بنجاح');
    }

    public function kafaaEdit(int $id)
    {
        $jobTitle = JobTitle::where('user_id', Auth::id())->findOrFail($id);
        return view('kafaa.pages.add&Edit.addAndEditJobTitle', compact('jobTitle'));
    }

    public function kafaaUpdate(Request $request, int $id)
    {
        $jobTitle = JobTitle::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $jobTitle->update($validated);
        return redirect()->route('kafaa.jobsTitle.index')->with('success', 'تم تحديث المسمى الوظيفي بنجاح');
    }

    public function kafaaDestroy(int $id)
    {
        $jobTitle = JobTitle::where('user_id', Auth::id())->findOrFail($id);
        $jobTitle->delete();
        return redirect()->back()->with('success', 'تم حذف المسمى الوظيفي بنجاح');
    }
}
