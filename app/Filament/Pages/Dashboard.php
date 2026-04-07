<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Models\University;
use App\Models\User;
use App\Models\Course;
class Dashboard extends BaseDashboard
{
    protected string $view = 'filament.pages.dashboard';

    public function getViewData(): array
    {
        return [
            'totalUniversities' => User::where('role', 'university')->count(),

            'activeUsers' => User::where('role', 'university')
                                ->where('linking_status', 'approved')
                                ->count(),

            // Aaj register hue users
            'todayUsers' => User::where('role', 'university')
                 ->where('linking_status', 'approved')
                 ->whereDate('created_at', today())->count(),
            'totalCourses' => Course::count(),

            // Aaj active hue users agar updated_at dekhna ho
            // 'todayActiveUsers' => User::where('status', 'active')
            //     ->whereDate('updated_at', today())
            //     ->count(),
        ];
    }
}