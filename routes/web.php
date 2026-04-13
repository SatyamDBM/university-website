<?php

use App\Http\Controllers\AdmissionProcessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\University\DashboardController;
use App\Http\Controllers\University\UniversityLinkingController;
use App\Http\Controllers\CmsPageController;
use App\Http\Controllers\UniversityOverviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityFaqController;
use App\Http\Controllers\University\CourseStreamController;
use App\Http\Controllers\University\NotificationController;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/universities', function () {
    return view('universities.index');
});
/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT HUB
|--------------------------------------------------------------------------
| Login ke baad yahin aata hai
| Role ke basis par redirect hoga
*/
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect('/admin'); // Filament admin panel
    }

    if ($user->role === 'university') {
        return redirect()->route('university.dashboard');
    }

    abort(403);
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| UNIVERSITY DASHBOARD
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // University Finance & Admission Data
    Route::prefix('university/finance')->name('university.finance.')->group(function () {
        Route::get('/', [AdmissionProcessController::class, 'index'])->name('index');
        Route::get('/create', [AdmissionProcessController::class, 'create'])->name('create');
        Route::post('/', [AdmissionProcessController::class, 'storeAll'])->name('store');
        Route::get('/{id}/edit', [AdmissionProcessController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdmissionProcessController::class, 'update'])->name('update');
        Route::get('/{id}', [AdmissionProcessController::class, 'show'])
            ->name('show');
        Route::delete('/{id}', [AdmissionProcessController::class, 'destroy'])->name('destroy');
    });
    // Placement Management
    Route::resource('placements', App\Http\Controllers\PlacementController::class);
    Route::get('/university/dashboard', [DashboardController::class, 'index'])->name('university.dashboard');
    Route::get('/university/linking', [UniversityLinkingController::class, 'index'])->name('university.linking');
    Route::post('/university/linking', [UniversityLinkingController::class, 'store'])->name('university.linking.store');

    // Course Management
    Route::resource('courses', App\Http\Controllers\CourseController::class);
    Route::post('courses/{course}/toggle-active', [App\Http\Controllers\CourseController::class, 'toggleActive'])->name('courses.toggleActive');
    Route::post('courses/{course}/approve', [App\Http\Controllers\CourseController::class, 'approve'])->name('courses.approve');
    Route::post('courses/{course}/reject', [App\Http\Controllers\CourseController::class, 'reject'])->name('courses.reject');

    // Department Management
    Route::resource('departments', App\Http\Controllers\DepartmentController::class);

    // University Campus Gallery
    Route::resource('gallery', App\Http\Controllers\UniversityGalleryController::class)->names([
        'index' => 'university.gallery.index',
        'create' => 'university.gallery.create',
        'store' => 'university.gallery.store',
        'edit' => 'university.gallery.edit',
        'update' => 'university.gallery.update',
        'destroy' => 'university.gallery.destroy',
    ]);
    // Direct gallery show route for robust access (like other working views)
    Route::get('gallery/view/{id}', [App\Http\Controllers\UniversityGalleryController::class, 'showById'])->name('university.gallery.showById');
    // Facilities Management
    Route::resource('facilities', App\Http\Controllers\FacilityController::class);
    Route::post('/placements/add-recruiter', [\App\Http\Controllers\PlacementController::class, 'addRecruiter'])->name('placements.addRecruiter');
    Route::resource('recruiters', App\Http\Controllers\RecruiterController::class);



    Route::get('/overview', [UniversityOverviewController::class, 'show'])->name('universities.overview.show');
    Route::post('/overview', [UniversityOverviewController::class, 'store'])->name('universities.overview.store');

    Route::get('faq', [UniversityFaqController::class, 'index'])->name('university.faq.index');
    Route::post('faq', [UniversityFaqController::class, 'store'])->name('university.faq.store');
    Route::get('faq/{id}/edit', [UniversityFaqController::class, 'edit'])->name('university.faq.edit');
    Route::delete('faq/{id}', [UniversityFaqController::class, 'destroy'])->name('university.faq.destroy');
    Route::resource('streams', CourseStreamController::class);
    // Route::post('/university-admission', [AdmissionProcessController::class, 'storeAll'])->name('university.admission.store');

    Route::get('/notifications/read/{id}', [NotificationController::class, 'read'])
        ->name('notifications.read');

    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])
        ->name('notifications.readAll');
});

/*
|--------------------------------------------------------------------------
| PROFILE (Breeze default)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
// Route::get('/{slug}', [CmsPageController::class, 'show'])->name('cms.page');
Route::get('/{slug}', [CmsPageController::class, 'show'])
    ->where('slug', '^(?!admin|dashboard|university|profile|login|register).*$')
    ->name('cms.page');

// FAQ routes
