
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\University\DashboardController;
use App\Http\Controllers\University\UniversityLinkingController;
use App\Http\Controllers\CmsPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
