<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homePageController;
use App\Http\Controllers\jobsController;
use App\Http\Controllers\languagesController;
use App\Http\Controllers\postsController;
use App\Http\Controllers\projectsController;
use App\Http\Controllers\skillsController;
use App\Http\Controllers\usersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Page Route
Route::get('/', [homePageController::class, 'index'])->name('home.index');

// Dashboard Route
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [dashboardController::class, 'index'])->name('dashboard.index');

    // Users Routes
    Route::prefix('admin/users')->name('users.')->group(function () {
        Route::get('/', [usersController::class, 'index'])->name('index');
        Route::post('/store', [usersController::class, 'store'])->name('store');
        Route::get('/create', function () {
            return view('admin.pages.add&Edit.addAndEditUser');
        })->name('create');
        Route::get('/edit/{id}', [usersController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [usersController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [usersController::class, 'destroy'])->name('delete');
    });

    // Projects Routes
    Route::prefix('admin/projects')->name('projects.')->group(function () {
        Route::get('/', [projectsController::class, 'index'])->name('index');
        Route::post('/store', [projectsController::class, 'store'])->name('store');
        Route::get('/create',  [projectsController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [projectsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [projectsController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [projectsController::class, 'destroy'])->name('delete');
    });

    // Jobs Routes
    Route::prefix('admin/jobs')->name('jobsTitles.')->group(function () {
        Route::get('/', [JobsController::class, 'index'])->name('index');
        Route::post('/store', [JobsController::class, 'store'])->name('store');
        Route::get('/create', function () {
            return view('admin.pages.add&Edit.addAndEditJobTitle');
        })->name('create');
    });

    // Skills Routes
    Route::prefix('admin/skills')->name('skills.')->group(function () {
        Route::get('/', [skillsController::class, 'index'])->name('index');
        Route::post('/store', [skillsController::class, 'store'])->name('store');
        Route::get('/create', function () {
            return view('admin.pages.add&Edit.addAndEditSkill');
        })->name('create');
    });

    // Languages Routes
    Route::prefix('admin/languages')->name('languages.')->group(function () {
        Route::get('/', [languagesController::class, 'index'])->name('index');
        Route::post('/store', [languagesController::class, 'store'])->name('store');
        Route::get('/create', function () {
            return view('admin.pages.add&Edit.addAndEditLanguage');
        })->name('create');
        Route::get('/edit/{id}', [languagesController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [languagesController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [languagesController::class, 'destroy'])->name('delete');
    });

    // Posts Routes
    Route::prefix('admin/posts')->name('posts.')->group(function () {
        Route::get('/', [postsController::class, 'index'])->name('index');
        Route::post('/store', [postsController::class, 'store'])->name('store');
        Route::get('/create', function () {
            return view('admin.pages.add&Edit.addAndEditPost');
        })->name('create');
    });
})->middleware('auth')->name('redirectToLogin');

Route::get('/login', function () {
    return view('admin.pages.auth.login');
})->name('login');

// Auth Routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [authController::class, 'login'])->name('login');
    Route::get('/register', [authController::class, 'register'])->name('register');
    Route::post('/store', [authController::class, 'store'])->name('store');
    Route::post('/check', [authController::class, 'checkUser'])->name('check');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
