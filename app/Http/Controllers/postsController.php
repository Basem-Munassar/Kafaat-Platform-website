<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;

class postsController extends Controller
{
    public function index(){
        $posts = BlogPost::latest()->get();
        $postCount = BlogPost::count();
        return view('admin.pages.posts', compact('posts','postCount'));
    }

    public function create()
    {
        return view('admin.pages.add&Edit.addAndEditPost');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'posterName'  => 'nullable|string|max:255',
            'posterEmail' => 'nullable|email|max:255',
            'date'        => 'nullable|date',
        ]);

        $validated['slug'] = $this->uniqueSlug($validated['title']);

        BlogPost::create($validated);
        return redirect()->route('admin.posts.index')->with('success', 'تم نشر المقال بنجاح');
    }

    public function edit(int $id)
    {
        $post = BlogPost::findOrFail($id);
        return view('admin.pages.add&Edit.addAndEditPost', compact('post'));
    }

    public function update(Request $request, int $id)
    {
        $post = BlogPost::findOrFail($id);
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'posterName'  => 'nullable|string|max:255',
            'posterEmail' => 'nullable|email|max:255',
            'date'        => 'nullable|date',
        ]);

        if ($post->title !== $validated['title']) {
            $validated['slug'] = $this->uniqueSlug($validated['title'], $post->id);
        }

        $post->update($validated);
        return redirect()->route('admin.posts.index')->with('success', 'تم تحديث المقال بنجاح');
    }

    public function destroy(int $id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('success', 'تم حذف المقال بنجاح');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'post';
        $slug = $base;
        $i = 1;
        while (BlogPost::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }

    // Kafaa (Expert) Panel Methods
    public function kafaaIndex()
    {
        $posts = BlogPost::where('user_id', Auth::id())->get();
        return view('kafaa.pages.posts', compact('posts'));
    }

    public function kafaaCreate()
    {
        return redirect()->back()->with('error', 'إضافة منشور جديد غير متاحة حالياً');
    }

    public function kafaaStore(Request $request)
    {
        return redirect()->back();
    }

    public function kafaaEdit(int $id)
    {
        return redirect()->back();
    }

    public function kafaaUpdate(Request $request, int $id)
    {
        return redirect()->back();
    }

    public function kafaaDestroy(int $id)
    {
        $post = BlogPost::where('user_id', Auth::id())->findOrFail($id);
        $post->delete();
        return redirect()->back()->with('success', 'تم حذف المنشور بنجاح');
    }
}
