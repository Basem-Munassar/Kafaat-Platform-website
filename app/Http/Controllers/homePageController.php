<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\Skill;
use Illuminate\Http\Request;

class homePageController extends Controller
{
    public function index (){
        $skills = Skill::all();
        // $skillCount = Skill::count();
       $jobTitles = JobTitle::all();
        // $jobTitleCount = JobTitle::count();
        // $projects = Project::all();
        // $projectCount = Project::count();
        // $experiences = Experience::all();
        // $experienceCount = Experience::count();
        // $educations = Education::all();
        // $educationCount = Education::count();
        // $users = User::all();
        return view('client.pages.homePage');
    }
}
