<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class postsController extends Controller
{
    public function index(){
        $posts = BlogPost::all();
        $postCount= BlogPost::count();
        return view('admin.pages.posts', compact('posts','postCount'));
    }

    public function store(Request $request)
    {
        $validated =$request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]); 
        
       
        $post = BlogPost::create($validated);
        return redirect()->back()->with('success', 'post sended successfully');
    }
}
