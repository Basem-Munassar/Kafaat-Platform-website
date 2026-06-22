<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

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
        return redirect()->route('admin.languages.index')->with('success', 'Language created successfully');
    }
    public function edit(int $id)
    {
        $language = Language::findOrFail($id);
        return view('admin.pages.add&Edit.addAndEditLanguage', compact('language'));
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
        return redirect()->route('admin.languages.index')->with('success', 'Language updated successfully');
    }
    public function destroy(int $id)
    {
        $language = Language::findOrFail($id);
        $language->delete();
        return redirect()->route('admin.languages.index')->with('success', 'Language deleted successfully');
    }

    // Kafaa (Expert) Panel Methods
    public function kafaaIndex()
    {
        $languages = Language::where('user_id', Auth::id())->get();
        return view('kafaa.pages.languages', compact('languages'));
    }

    public function kafaaCreate()
    {
        return view('kafaa.pages.add&Edit.addAndEditLanguage');
    }

    public function kafaaStore(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required|string|max:255',
            'level' => 'required|string|max:100',
        ]);

        $validated['user_id'] = Auth::id();

        Language::create($validated);
        return redirect()->route('kafaa.languages.index')->with('success', 'تم إضافة اللغة بنجاح');
    }

    public function kafaaEdit(int $id)
    {
        $language = Language::where('user_id', Auth::id())->findOrFail($id);
        return view('kafaa.pages.add&Edit.addAndEditLanguage', compact('language'));
    }

    public function kafaaUpdate(Request $request, int $id)
    {
        $language = Language::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'language' => 'required|string|max:255',
            'level' => 'required|string|max:100',
        ]);

        $language->update($validated);
        return redirect()->route('kafaa.languages.index')->with('success', 'تم تحديث اللغة بنجاح');
    }

    public function kafaaDestroy(int $id)
    {
        $language = Language::where('user_id', Auth::id())->findOrFail($id);
        $language->delete();
        return redirect()->back()->with('success', 'تم حذف اللغة بنجاح');
    }
}
