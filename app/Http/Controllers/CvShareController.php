<?php

namespace App\Http\Controllers;

use App\Models\CvShareLink;
use App\Models\Kafaa;
use App\Models\ProfileVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class CvShareController extends Controller
{
    /** Allowed durations: key => [label, minutes] */
    public const DURATIONS = [
        '1h'  => ['ساعة واحدة', 60],
        '6h'  => ['6 ساعات', 360],
        '24h' => ['يوم واحد', 1440],
        '3d'  => ['3 أيام', 4320],
        '7d'  => ['7 أيام', 10080],
        '30d' => ['30 يومًا', 43200],
    ];

    // ===== Kafaa panel: list + create + revoke =====
    public function index()
    {
        $links = CvShareLink::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
        $durations = self::DURATIONS;

        return view('kafaa.pages.shareLinks', compact('links', 'durations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'duration' => 'required|in:' . implode(',', array_keys(self::DURATIONS)),
        ]);

        $minutes = self::DURATIONS[$request->duration][1];

        $link = CvShareLink::create([
            'user_id'    => Auth::id(),
            'token'      => Str::random(48),
            'expires_at' => now()->addMinutes($minutes),
        ]);

        return redirect()->route('kafaa.shareLinks.index')
            ->with('success', 'تم إنشاء رابط المشاركة بنجاح!')
            ->with('new_link', route('cv.share.view', $link->token));
    }

    public function destroy(int $id)
    {
        $link = CvShareLink::where('user_id', Auth::id())->findOrFail($id);
        $link->delete();

        return redirect()->route('kafaa.shareLinks.index')
            ->with('success', 'تم إلغاء الرابط بنجاح.');
    }

    // ===== Public: open a CV via token =====
    public function show(Request $request, string $token)
    {
        $link = CvShareLink::where('token', $token)->first();

        if (! $link || $link->isExpired()) {
            return response()->view('client.pages.shareExpired', [], $link ? 410 : 404);
        }

        $kafaa = Kafaa::find($link->user_id);

        if (! $kafaa) {
            return response()->view('client.pages.shareExpired', [], 404);
        }

        // Record an anonymous visit (visitor is not the owner)
        ProfileVisit::create([
            'profile_user_id' => $kafaa->id,
            'visitor_user_id' => Auth::check() ? Auth::id() : null,
            'visitor_ip'      => $request->ip(),
        ]);

        return view('client.pages.kafaaProfile', [
            'kafaa'    => $kafaa,
            'cvLayout' => 'client.layout.sharedCvMasterApp',
            'shared'   => true,
        ]);
    }
}
