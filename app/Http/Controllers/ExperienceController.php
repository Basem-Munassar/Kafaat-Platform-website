<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class ExperienceController extends Controller
{
    public function kafaaIndex()
    {
        $experiences = Experience::where('user_id', Auth::id())
            ->orderByDesc('start_date')
            ->get();
        return view('kafaa.pages.experiences', compact('experiences'));
    }

    public function kafaaCreate()
    {
        return view('kafaa.pages.add&Edit.addAndEditExperience');
    }

    public function kafaaStore(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['user_id'] = Auth::id();
        $validated['is_current'] = $request->boolean('is_current');
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        Experience::create($validated);
        return redirect()->route('kafaa.experiences.index')->with('success', 'تم إضافة الخبرة بنجاح');
    }

    public function kafaaEdit(int $id)
    {
        $experience = Experience::where('user_id', Auth::id())->findOrFail($id);
        return view('kafaa.pages.add&Edit.addAndEditExperience', compact('experience'));
    }

    public function kafaaUpdate(Request $request, int $id)
    {
        $experience = Experience::where('user_id', Auth::id())->findOrFail($id);

        $validated = $this->validateData($request);
        $validated['is_current'] = $request->boolean('is_current');
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $experience->update($validated);
        return redirect()->route('kafaa.experiences.index')->with('success', 'تم تحديث الخبرة بنجاح');
    }

    public function kafaaDestroy(int $id)
    {
        $experience = Experience::where('user_id', Auth::id())->findOrFail($id);
        $experience->delete();
        return redirect()->back()->with('success', 'تم حذف الخبرة بنجاح');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:2000',
        ]);
    }
}
