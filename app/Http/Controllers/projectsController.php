<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

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
            'date' => 'required|date',
            'description' => 'required|string|max:1000',
            'technologies' => 'required|string|max:255',
            'link' => 'required|url',
        ]); 
        
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }
        $project = Project::create($validated);
        // dd($project); 
        return redirect()->route('projects.index')->with('success', 'Project added successfully');
    }
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.pages.add&Edit.addandEditProject', compact('project'));
    }
    public function update(Request $request){
        $project = Project::findOrFail($request->id);

        $validated =$request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date',
            'description' => 'required|string|max:1000',
            'technologies' => 'required|string|max:255',
            'link' => 'required|url',
        ]); 
        
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }
        $project->update($validated);
        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }     
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->back()->with('success', 'Project deleted successfully');
    }

}
