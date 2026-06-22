<?php

namespace App\Http\Controllers;

use App\Models\Kafaa;
use App\Models\ProfileVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
    
class KafaaController extends Controller
{
    private function loadKafaaProfile(Request $request, int $id): Kafaa
    {
        $kafaa = Kafaa::findOrFail($id);

        if (!Auth::check() || Auth::id() !== $kafaa->id) {
            ProfileVisit::create([
                'profile_user_id' => $kafaa->id,
                'visitor_user_id' => Auth::check() ? Auth::id() : null,
                'visitor_ip' => $request->ip(),
            ]);
        }

        return $kafaa;
    }

    public function show(Request $request, int $id)
    {
        $kafaa = $this->loadKafaaProfile($request, $id);
        return view('client.pages.kafaaProfile', compact('kafaa'));
    }

    public function about(Request $request, int $id)
    {
        $kafaa = $this->loadKafaaProfile($request, $id);
        return view('client.pages.kafaaProfile', compact('kafaa'))->with('focus', 'about');
    }

    public function services(Request $request, int $id)
    {
        $kafaa = $this->loadKafaaProfile($request, $id);
        return view('client.pages.kafaaProfile', compact('kafaa'))->with('focus', 'services');
    }

    public function skills(Request $request, int $id)
    {
        $kafaa = $this->loadKafaaProfile($request, $id);
        return view('client.pages.kafaaProfile', compact('kafaa'))->with('focus', 'skills');
    }

    public function subscribe(Request $request, int $id)
    {
        $kafaa = $this->loadKafaaProfile($request, $id);
        return view('client.pages.kafaaProfile', compact('kafaa'))->with('focus', 'subscribe');
    }

    public function projects(Request $request, int $id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Please login to view projects.');
        }

        $kafaa = $this->loadKafaaProfile($request, $id);
        return view('client.pages.kafaaProfile', compact('kafaa'))->with('focus', 'projects');
    }
}
