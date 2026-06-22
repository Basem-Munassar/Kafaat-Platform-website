<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class projectsController extends Controller
{
    public function index(){
        $projects = Project::all();
        return view('admin.pages.projects', compact('projects'));
    }

    public function create(){
        return view('admin.pages.add&Edit.addandEditProject');
    }

    public function store(Request $request)
    {
        $validated =$request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'nullable|date',
            'description' => 'required|string|max:1000',
            'technologies' => 'nullable|string|max:255',
            'link' => 'nullable|url',
        ]);
        
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }
        $project = Project::create($validated);
        // dd($project); 
        return redirect()->route('admin.projects.index')->with('success', 'Project added successfully');
    }
    public function edit(int $id)
    {
        $project = Project::findOrFail($id);
        return view('admin.pages.add&Edit.addandEditProject', compact('project'));
    }
    public function update(Request $request){
        $project = Project::findOrFail($request->id);

        $validated =$request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'nullable|date',
            'description' => 'required|string|max:1000',
            'technologies' => 'nullable|string|max:255',
            'link' => 'nullable|url',
        ]);
        
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }
        $project->update($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully');
    }     
    public function destroy(int $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->back()->with('success', 'Project deleted successfully');
    }

    // Kafaa (Expert) Panel Methods
    public function kafaaIndex()
    {
        $projects = Project::where('user_id', Auth::id())->get();
        return view('kafaa.pages.projects', compact('projects'));
    }

    public function kafaaCreate()
    {
        return view('kafaa.pages.add&Edit.addAndEditProject');
    }

    public function kafaaStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'nullable|date',
            'description' => 'required|string|max:1000',
            'technologies' => 'nullable|string|max:255',
            'link' => 'nullable|url',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        Project::create($validated);
        return redirect()->route('kafaa.projects.index')->with('success', 'تم إضافة المشروع بنجاح');
    }

    public function kafaaEdit(int $id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        return view('kafaa.pages.add&Edit.addAndEditProject', compact('project'));
    }

    public function kafaaUpdate(Request $request, int $id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'nullable|date',
            'description' => 'required|string|max:1000',
            'technologies' => 'nullable|string|max:255',
            'link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        $project->update($validated);
        return redirect()->route('kafaa.projects.index')->with('success', 'تم تحديث المشروع بنجاح');
    }

    public function kafaaDestroy(int $id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        $project->delete();
        return redirect()->back()->with('success', 'تم حذف المشروع بنجاح');
    }
}
