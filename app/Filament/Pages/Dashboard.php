<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Models\University;
use App\Models\User;
use App\Models\Course;
use App\Models\Banner;
use App\Models\Package;
class Dashboard extends BaseDashboard
{
    protected string $view = 'filament.pages.dashboard';

    public function getViewData(): array
    {
        return [
            'totalUniversities' => User::where('role', 'university')->count(),
            'currentMonthUniversities' => User::where('role', 'university')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),

            'activeUniversities' => User::where('role', 'university')
                                ->where('linking_status', 'approved')
                                ->count(),

            // Aaj register hue users
            'todayUniversities' => User::where('role', 'university')
                 ->where('linking_status', 'approved')
                 ->whereDate('created_at', today())->count(),
            'totalCourses' => Course::count(),
            'totalBanners'=>Banner::count(),
            'totalpackages'=>Package::count(),

            // Aaj active hue users agar updated_at dekhna ho
            // 'todayActiveUsers' => User::where('status', 'active')
            //     ->whereDate('updated_at', today())
            //     ->count(),
        ];
    }
}