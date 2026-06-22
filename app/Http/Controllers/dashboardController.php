<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\Language;
use App\Models\Skill;
use App\Models\Project;
use App\Models\User;
use App\Models\ProfileVisit;
use App\Models\BlogPost;
use App\Models\Review;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class dashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        // ===== Users breakdown =====
        $userCount   = User::count();
        $adminCount  = User::whereIn('role', ['admin', 'super admin'])->count();
        $kafaaCount  = User::where(function ($q) {
            $q->whereIn('account_type', ['kafaa', 'employee'])
              ->orWhereIn('role', ['kafaa', 'employee']);
        })->count();
        $regularUserCount   = max(0, $userCount - $adminCount - $kafaaCount);
        $availableKafaaCount = User::where('is_available', true)
            ->where(function ($q) {
                $q->whereIn('account_type', ['kafaa', 'employee'])
                  ->orWhereIn('role', ['kafaa', 'employee']);
            })->count();

        // ===== Content counts =====
        $projectCount  = Project::count();
        $skillCount    = Skill::count();
        $languageCount = Language::count();
        $jobTitleCount = JobTitle::count();
        $postCount     = BlogPost::count();
        $reviewCount   = Review::count();
        $messageCount  = ContactMessage::count();

        // ===== Visits analytics =====
        $totalVisits     = ProfileVisit::count();
        $visitsToday     = ProfileVisit::whereDate('created_at', today())->count();
        $visitsThisWeek  = ProfileVisit::where('created_at', '>=', now()->startOfWeek())->count();
        $visitsByMembers = ProfileVisit::whereNotNull('visitor_user_id')->count();
        $visitsByGuests  = ProfileVisit::whereNull('visitor_user_id')->count();

        // ===== Live sessions (database session driver) =====
        $onlineWindow   = now()->subMinutes(15)->getTimestamp(); // active within last 15 min
        $activeSessions = DB::table('sessions')->where('last_activity', '>=', $onlineWindow)->count();
        $onlineMembers  = DB::table('sessions')
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', $onlineWindow)
            ->distinct('user_id')->count('user_id');
        $onlineGuests   = DB::table('sessions')
            ->whereNull('user_id')
            ->where('last_activity', '>=', $onlineWindow)->count();

        // ===== Recent activity =====
        $recentUsers    = User::latest()->take(5)->get();
        $recentReviews  = Review::latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentVisits   = DB::table('profile_visits')
            ->leftJoin('users', 'profile_visits.profile_user_id', '=', 'users.id')
            ->select('profile_visits.*', 'users.name as profile_name')
            ->orderByDesc('profile_visits.created_at')
            ->limit(6)->get();

        return view('admin.dashboard', compact(
            'admin',
            'userCount', 'adminCount', 'kafaaCount', 'regularUserCount', 'availableKafaaCount',
            'projectCount', 'skillCount', 'languageCount', 'jobTitleCount', 'postCount', 'reviewCount', 'messageCount',
            'totalVisits', 'visitsToday', 'visitsThisWeek', 'visitsByMembers', 'visitsByGuests',
            'activeSessions', 'onlineMembers', 'onlineGuests',
            'recentUsers', 'recentReviews', 'recentMessages', 'recentVisits'
        ));
    }

    public function kafaaDashboard()
    {
        $user = Auth::user();
        $projectCount = Project::where('user_id', $user->id)->count();
        $skillCount = Skill::where('user_id', $user->id)->count();
        $languageCount = \App\Models\Language::where('user_id', $user->id)->count();
        $jobTitleCount = \App\Models\JobTitle::where('user_id', $user->id)->count();
        $postCount = \App\Models\BlogPost::where('user_id', $user->id)->count();
        $experienceCount = \App\Models\Experience::where('user_id', $user->id)->count();
        $serviceCount = \App\Models\Service::where('user_id', $user->id)->count();
        $myVisits = ProfileVisit::where('profile_user_id', $user->id)->count();

        return view('kafaa.dashboard', compact('user', 'projectCount', 'skillCount', 'languageCount', 'jobTitleCount', 'postCount', 'experienceCount', 'serviceCount', 'myVisits'));
    }

    public function editProfile()
    {
        $user = User::find(Auth::id());
        return view('kafaa.pages.editProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        if (! $user) {
            return back()->with('error', 'User not found.');
        }

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'bio'       => 'nullable|string|max:2000',
            'phone'     => 'nullable|string|max:50',
            'location'  => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
            // keep session avatar in sync if used elsewhere
            session(['user_image' => $validated['profile_image']]);
        }

        $user->update($validated);

        return redirect()->route('kafaa.profile.edit')->with('success', 'تم تحديث ملفك الشخصي بنجاح!');
    }

    public function toggleAvailability(Request $request)
    {
        // Ensure we have an Eloquent User instance
        $user = User::find(Auth::id());
        if (! $user) {
            return back()->with('error', 'User not found.');
        }

        $user->is_available = ! $user->is_available;
        $user->save();

        return back()->with('success', 'تم تحديث حالة التوفر بنجاح!');
    }
}
