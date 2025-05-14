<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class languagesController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        $languageCount = Language::count();
        return view('admin.pages.languages', compact('languages', 'languageCount'));
    }
    
    public function store(Request $request)
    {
        $validated =$request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'language' => 'required|string|max:255',
            'level' => 'required|string|max:100',
            // 'category', 
        ]);         
       
        $languages = Language::create($validated);
        return redirect()->route('languages.index')->with('success', 'Language created successfully');
    }
    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('admin.pages.add&Edit.addandEditLanguage', compact('language'));
    }
    public function update(Request $request)
    {
        $language = Language::findOrFail($request->id);

        $validated =$request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'language' => 'required|string|max:255',
            'level' => 'required|string|max:100',
            // 'category', 
        ]);         
       
        $language->update($validated);
        return redirect()->route('languages.index')->with('success', 'Language updated successfully');
    }
    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        $language->delete();
        return redirect()->route('languages.index')->with('success', 'Language deleted successfully');
    }
    
}
