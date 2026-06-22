<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();

        return view('client.pages.reviewsPages', compact('reviews'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('reviews', 'public');
        }

        Review::create($validated);

        return redirect()->route('client.reviews')
            ->with('review_success', 'تم إرسال رأيك بنجاح، شكراً لمشاركتك!');
    }

    // ===== Admin moderation =====
    public function adminIndex()
    {
        $reviews = Review::with('profileUser')->latest()->get();
        $reviewCount = $reviews->count();
        $avgRating = round((float) Review::avg('rating'), 1);
        return view('admin.pages.reviews', compact('reviews', 'reviewCount', 'avgRating'));
    }

    public function destroy(int $id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->back()->with('success', 'تم حذف الرأي بنجاح');
    }
}
