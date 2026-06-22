<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class ServiceController extends Controller
{
    public function kafaaIndex()
    {
        $services = Service::where('user_id', Auth::id())->latest()->get();
        return view('kafaa.pages.services', compact('services'));
    }

    public function kafaaCreate()
    {
        return view('kafaa.pages.add&Edit.addAndEditService');
    }

    public function kafaaStore(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['user_id'] = Auth::id();

        Service::create($validated);
        return redirect()->route('kafaa.services.index')->with('success', 'تم إضافة الخدمة بنجاح');
    }

    public function kafaaEdit(int $id)
    {
        $service = Service::where('user_id', Auth::id())->findOrFail($id);
        return view('kafaa.pages.add&Edit.addAndEditService', compact('service'));
    }

    public function kafaaUpdate(Request $request, int $id)
    {
        $service = Service::where('user_id', Auth::id())->findOrFail($id);

        $validated = $this->validateData($request);
        $service->update($validated);
        return redirect()->route('kafaa.services.index')->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function kafaaDestroy(int $id)
    {
        $service = Service::where('user_id', Auth::id())->findOrFail($id);
        $service->delete();
        return redirect()->back()->with('success', 'تم حذف الخدمة بنجاح');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'icon'        => 'nullable|string|max:100',
        ]);
    }
}
