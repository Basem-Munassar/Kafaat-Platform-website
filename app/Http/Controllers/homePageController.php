<?php

namespace App\Http\Controllers;

use App\Models\Kafaa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class homePageController extends Controller
{
    public function index()
    {
        // Only fetch available kafaa profiles
        $users = Kafaa::where('is_available', true)->get();

        return view('client.pages.homePage', compact('users'));
    }
}
