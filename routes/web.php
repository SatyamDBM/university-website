<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CmsPageController;

/* Website */
use App\Http\Controllers\Website\WebsiteController;

/* University Panel */
use App\Http\Controllers\AdmissionProcessController;
use App\Http\Controllers\University\DashboardController;
use App\Http\Controllers\University\UniversityLinkingController;
use App\Http\Controllers\UniversityOverviewController;
use App\Http\Controllers\UniversityFaqController;
use App\Http\Controllers\University\CourseStreamController;
use App\Http\Controllers\University\NotificationController;

/*
|--------------------------------------------------------------------------
| WEBSITE ROUTES (Public)
|--------------------------------------------------------------------------
*/

Route::controller(WebsiteController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    // Route::prefix('web')->group(function () {
    Route::get('/universities', 'universities')->name('universities');
    Route::get('/universities-details', 'universityDetail')->name('university.detail');
    Route::get('/courses', 'courses')->name('courses');
    Route::get('/courses-details', 'courseDetail')->name('course.detail');
    Route::get('/faq', 'faq')->name('web-faq');
    // });
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blog-detail', 'blogDetail')->name('blog.detail');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::get('/terms-conditions', 'terms')->name('terms');
    Route::get('/privacy-policy', 'privacy')->name('privacy');
    Route::get('/search', 'search')->name('search');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect('/admin');
    }
    if ($user->role === 'university') {
        return redirect()->route('university.dashboard');
    }
    abort(403);
})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| UNIVERSITY PANEL (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:university'])->prefix('university')->name('university.')->group(function () {
    /*
    |---------------- Dashboard ----------------|
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |---------------- Linking ----------------|
    */
    Route::get('/linking', [UniversityLinkingController::class, 'index'])->name('linking');
    Route::post('/linking', [UniversityLinkingController::class, 'store'])->name('linking.store');

    /*
    |---------------- Finance ----------------|
    */
    Route::prefix('finance')->name('finance.')->group(function () {
        Route::get('/', [AdmissionProcessController::class, 'index'])->name('index');
        Route::get('/create', [AdmissionProcessController::class, 'create'])->name('create');
        Route::post('/', [AdmissionProcessController::class, 'storeAll'])->name('store');
        Route::get('/{id}', [AdmissionProcessController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdmissionProcessController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdmissionProcessController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdmissionProcessController::class, 'destroy'])->name('destroy');
    });

    /*
    |---------------- Courses ----------------|
    */
    Route::resource('courses', App\Http\Controllers\CourseController::class);
    Route::post('courses/{course}/toggle-active', [App\Http\Controllers\CourseController::class, 'toggleActive'])->name('courses.toggleActive');
    Route::post('courses/{course}/approve', [App\Http\Controllers\CourseController::class, 'approve'])->name('courses.approve');
    Route::post('courses/{course}/reject', [App\Http\Controllers\CourseController::class, 'reject'])->name('courses.reject');

    /*
    |---------------- Departments ----------------|
    */
    Route::resource('departments', App\Http\Controllers\DepartmentController::class);

    /*
    |---------------- Placements ----------------|
    */
    Route::resource('placements', App\Http\Controllers\PlacementController::class);
    Route::post('/placements/add-recruiter', [App\Http\Controllers\PlacementController::class, 'addRecruiter'])->name('placements.addRecruiter');
    Route::resource('recruiters', App\Http\Controllers\RecruiterController::class);

    /*
    |---------------- Gallery ----------------|
    */
    Route::resource('gallery', App\Http\Controllers\UniversityGalleryController::class)->names([
        'index' => 'gallery.index',
        'create' => 'gallery.create',
        'store' => 'gallery.store',
        'edit' => 'gallery.edit',
        'update' => 'gallery.update',
        'destroy' => 'gallery.destroy',
    ]);

    Route::get('gallery/view/{id}', [App\Http\Controllers\UniversityGalleryController::class, 'showById'])
        ->name('gallery.showById');

    /*
    |---------------- Facilities ----------------|
    */
    Route::resource('facilities', App\Http\Controllers\FacilityController::class);

    /*
    |---------------- Overview ----------------|
    */
    Route::get('/overview', [UniversityOverviewController::class, 'show'])->name('overview.show');
    Route::post('/overview', [UniversityOverviewController::class, 'store'])->name('overview.store');

    /*
    |---------------- FAQ ----------------|
    */
    Route::get('faq', [UniversityFaqController::class, 'index'])->name('faq.index');
    Route::post('faq', [UniversityFaqController::class, 'store'])->name('faq.store');
    Route::get('faq/{id}/edit', [UniversityFaqController::class, 'edit'])->name('faq.edit');
    Route::delete('faq/{id}', [UniversityFaqController::class, 'destroy'])->name('faq.destroy');

    /*
    |---------------- Streams ----------------|
    */
    Route::resource('streams', CourseStreamController::class);

    /*
    |---------------- Notifications ----------------|
    */
    Route::get('/notifications/read/{id}', [NotificationController::class, 'read'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');
});


/*
|--------------------------------------------------------------------------
| PROFILE (Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| CMS PAGES (Dynamic Slug)
|--------------------------------------------------------------------------
*/
Route::get('/{slug}', [CmsPageController::class, 'show'])
    ->where('slug', '^(?!admin|dashboard|university|profile|login|register).*$')
    ->name('cms.page');


require __DIR__ . '/auth.php';
