<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * University Dashboard
     */
    public function index(): View
    {
        if (Auth::user()->role !== 'university') {
            abort(403);
        }

        return view('university.dashboard');
    }
}
