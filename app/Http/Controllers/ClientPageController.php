<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClientPageController extends Controller
{
    public function bestCVs()
    {
        $users = User::where(function ($q) {
            $q->whereIn('account_type', ['kafaa', 'employee'])
              ->orWhereIn('role', ['kafaa', 'employee']);
        })->where('is_available', true)->get();

        $featuredUsers = $users->take(3);

        return view('client.pages.bestCVsPage', compact('users', 'featuredUsers'));
    }
}
