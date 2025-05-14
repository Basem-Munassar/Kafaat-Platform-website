<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use Illuminate\Http\Request;

class jobsController extends Controller
{
    public function index()
    {
        $jobTitles = JobTitle::all();
        $jobTitleCount = JobTitle::count();
        return view('admin.pages.jobsTitle', compact('jobTitles', 'jobTitleCount'));
    }

    public function store(Request $request)
    {
        $validated =$request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]); 
        
        
        $jobTitle = JobTitle::create($validated);
        // dd($jobTitle()); 
        return redirect()->route('jobsTitles.index')->with('success', 'Job created successfully');
    }
}
