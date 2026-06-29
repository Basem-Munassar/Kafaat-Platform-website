<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\dashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientPageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\homePageController;
use App\Http\Controllers\jobsController;
use App\Http\Controllers\languagesController;
use App\Http\Controllers\postsController;
use App\Http\Controllers\projectsController;
use App\Http\Controllers\skillsController;
use App\Http\Controllers\KafaaController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CvShareController;

use Illuminate\Auth\Middleware\Authenticate;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Page Route
Route::get('/', [homePageController::class, 'index'])->name('home.index');

// Client public page routes
Route::get('/about', fn () => view('client.pages.about'))->name('client.about');
Route::get('/bestCVs', [ClientPageController::class, 'bestCVs'])->name('client.bestCVs');
Route::get('/services', fn () => view('client.pages.servicesPage'))->name('client.services');
Route::get('/reviews', [ReviewController::class, 'index'])->name('client.reviews');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/contact', [ContactController::class, 'create'])->name('client.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public Kafaa Profile Routes
Route::get('/profile/{id}', [KafaaController::class, 'show'])->name('kafaa.show');
Route::get('/about/{id}', [KafaaController::class, 'about'])->name('kafaa.about');
Route::get('/services/{id}', [KafaaController::class, 'services'])->name('kafaa.services');
Route::get('/skills/{id}', [KafaaController::class, 'skills'])->name('kafaa.skills');
Route::get('/subscribe/{id}', [KafaaController::class, 'subscribe'])->name('kafaa.subscribe');
Route::get('/projects/{id}', [KafaaController::class, 'projects'])->name('kafaa.projects');

// Public temporary CV share link (no navbar, Kafaat logo only)
Route::get('/cv/{token}', [CvShareController::class, 'show'])->name('cv.share.view');

// Auth Routes
Route::get('/login', [authController::class, 'login'])->name('login');
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [authController::class, 'login'])->name('login');
    Route::get('/register', [authController::class, 'register'])->name('register');
    Route::post('/store', [authController::class, 'store'])->name('store');
    Route::post('/check', [authController::class, 'checkUser'])->name('check');
    Route::post('/logout', [authController::class, 'logout'])->name('logout');
});

// Admin Routes
Route::middleware([Authenticate::class, 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard.index');

    // Users Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [usersController::class, 'index'])->name('index');
        Route::post('/store', [usersController::class, 'store'])->name('store');
        Route::get('/create', function () {
            return view('admin.pages.add&Edit.addAndEditUser');
        })->name('create');
        Route::get('/edit/{id}', [usersController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [usersController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [usersController::class, 'destroy'])->name('delete');
    });

    // Projects Routes
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [projectsController::class, 'index'])->name('index');
        Route::post('/store', [projectsController::class, 'store'])->name('store');
        Route::get('/create',  [projectsController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [projectsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [projectsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [projectsController::class, 'destroy'])->name('delete');
    });

    // Skills Routes
    Route::prefix('skills')->name('skills.')->group(function () {
        Route::get('/', [skillsController::class, 'index'])->name('index');
        Route::post('/store', [skillsController::class, 'store'])->name('store');
        Route::get('/create', [skillsController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [skillsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [skillsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [skillsController::class, 'destroy'])->name('delete');
    });

    // Languages Routes
    Route::prefix('languages')->name('languages.')->group(function () {
        Route::get('/', [languagesController::class, 'index'])->name('index');
        Route::post('/store', [languagesController::class, 'store'])->name('store');
        Route::get('/create', function () {
            return view('admin.pages.add&Edit.addAndEditLanguage');
        })->name('create');
        Route::get('/edit/{id}', [languagesController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [languagesController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [languagesController::class, 'destroy'])->name('delete');
    });

    // Job Titles Routes
    Route::prefix('jobsTitle')->name('jobsTitle.')->group(function () {
        Route::get('/', [jobsController::class, 'index'])->name('index');
        Route::post('/store', [jobsController::class, 'store'])->name('store');
        Route::get('/create', [jobsController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [jobsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [jobsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [jobsController::class, 'destroy'])->name('delete');
    });

    // Posts Routes
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [postsController::class, 'index'])->name('index');
        Route::post('/store', [postsController::class, 'store'])->name('store');
        Route::get('/create', [postsController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [postsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [postsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [postsController::class, 'destroy'])->name('delete');
    });

    // Reviews moderation
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'adminIndex'])->name('index');
        Route::delete('/delete/{id}', [ReviewController::class, 'destroy'])->name('delete');
    });

    // Contact messages inbox
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [ContactController::class, 'adminIndex'])->name('index');
        Route::delete('/delete/{id}', [ContactController::class, 'destroy'])->name('delete');
    });
});

// Kafaa (Expert) Routes
Route::middleware([Authenticate::class, 'role:kafaa,employee'])->prefix('kafaa')->name('kafaa.')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'kafaaDashboard'])->name('dashboard.index');
    Route::post('/toggle-availability', [dashboardController::class, 'toggleAvailability'])->name('toggleAvailability');

    // Profile
    Route::get('/profile/edit', [dashboardController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [dashboardController::class, 'updateProfile'])->name('profile.update');

    // CV Share Links
    Route::prefix('share-links')->name('shareLinks.')->group(function () {
        Route::get('/', [CvShareController::class, 'index'])->name('index');
        Route::post('/', [CvShareController::class, 'store'])->name('store');
        Route::delete('/{id}', [CvShareController::class, 'destroy'])->name('delete');
    });

    // Experiences CRUD
    Route::prefix('experiences')->name('experiences.')->group(function () {
        Route::get('/', [ExperienceController::class, 'kafaaIndex'])->name('index');
        Route::post('/store', [ExperienceController::class, 'kafaaStore'])->name('store');
        Route::get('/create', [ExperienceController::class, 'kafaaCreate'])->name('create');
        Route::get('/edit/{id}', [ExperienceController::class, 'kafaaEdit'])->name('edit');
        Route::put('/update/{id}', [ExperienceController::class, 'kafaaUpdate'])->name('update');
        Route::delete('/delete/{id}', [ExperienceController::class, 'kafaaDestroy'])->name('delete');
    });

    // Services CRUD
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'kafaaIndex'])->name('index');
        Route::post('/store', [ServiceController::class, 'kafaaStore'])->name('store');
        Route::get('/create', [ServiceController::class, 'kafaaCreate'])->name('create');
        Route::get('/edit/{id}', [ServiceController::class, 'kafaaEdit'])->name('edit');
        Route::put('/update/{id}', [ServiceController::class, 'kafaaUpdate'])->name('update');
        Route::delete('/delete/{id}', [ServiceController::class, 'kafaaDestroy'])->name('delete');
    });

    // Projects CRUD
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [projectsController::class, 'kafaaIndex'])->name('index');
        Route::post('/store', [projectsController::class, 'kafaaStore'])->name('store');
        Route::get('/create', [projectsController::class, 'kafaaCreate'])->name('create');
        Route::get('/edit/{id}', [projectsController::class, 'kafaaEdit'])->name('edit');
        Route::put('/update/{id}', [projectsController::class, 'kafaaUpdate'])->name('update');
        Route::delete('/delete/{id}', [projectsController::class, 'kafaaDestroy'])->name('delete');
    });

    // Skills CRUD
    Route::prefix('skills')->name('skills.')->group(function () {
        Route::get('/', [skillsController::class, 'kafaaIndex'])->name('index');
        Route::post('/store', [skillsController::class, 'kafaaStore'])->name('store');
        Route::get('/create', [skillsController::class, 'kafaaCreate'])->name('create');
        Route::get('/edit/{id}', [skillsController::class, 'kafaaEdit'])->name('edit');
        Route::put('/update/{id}', [skillsController::class, 'kafaaUpdate'])->name('update');
        Route::delete('/delete/{id}', [skillsController::class, 'kafaaDestroy'])->name('delete');
    });

    // Languages CRUD
    Route::prefix('languages')->name('languages.')->group(function () {
        Route::get('/', [languagesController::class, 'kafaaIndex'])->name('index');
        Route::post('/store', [languagesController::class, 'kafaaStore'])->name('store');
        Route::get('/create', [languagesController::class, 'kafaaCreate'])->name('create');
        Route::get('/edit/{id}', [languagesController::class, 'kafaaEdit'])->name('edit');
        Route::put('/update/{id}', [languagesController::class, 'kafaaUpdate'])->name('update');
        Route::delete('/delete/{id}', [languagesController::class, 'kafaaDestroy'])->name('delete');
    });

    // Job Titles CRUD
    Route::prefix('jobsTitle')->name('jobsTitle.')->group(function () {
        Route::get('/', [jobsController::class, 'kafaaIndex'])->name('index');
        Route::post('/store', [jobsController::class, 'kafaaStore'])->name('store');
        Route::get('/create', [jobsController::class, 'kafaaCreate'])->name('create');
        Route::get('/edit/{id}', [jobsController::class, 'kafaaEdit'])->name('edit');
        Route::put('/update/{id}', [jobsController::class, 'kafaaUpdate'])->name('update');
        Route::delete('/delete/{id}', [jobsController::class, 'kafaaDestroy'])->name('delete');
    });

    // Posts CRUD
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [postsController::class, 'kafaaIndex'])->name('index');
        Route::post('/store', [postsController::class, 'kafaaStore'])->name('store');
        Route::get('/create', [postsController::class, 'kafaaCreate'])->name('create');
        Route::get('/edit/{id}', [postsController::class, 'kafaaEdit'])->name('edit');
        Route::put('/update/{id}', [postsController::class, 'kafaaUpdate'])->name('update');
        Route::delete('/delete/{id}', [postsController::class, 'kafaaDestroy'])->name('delete');
    });
});
