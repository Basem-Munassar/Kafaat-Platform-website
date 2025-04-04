<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homePageController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [homePageController::class, 'index']);
