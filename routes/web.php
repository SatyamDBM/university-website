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
    Route::get('/university/dashboard', [DashboardController::class, 'index'])
        ->name('university.dashboard');


    Route::get('/university/linking', [UniversityLinkingController::class, 'index'])
        ->name('university.linking');

    Route::post('/university/linking', [UniversityLinkingController::class, 'store'])
        ->name('university.linking.store');
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
