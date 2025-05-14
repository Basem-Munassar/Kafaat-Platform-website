<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\Language;
use App\Models\Skill;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $projectCount = Language::count();
        $jobTitleCount = JobTitle::count();
        $skillCount = Skill::count();
        $languageCount = Language::count();

        return view('admin.dashboard', compact('projectCount', 'jobTitleCount', 'skillCount', 'languageCount'));
    }
}
