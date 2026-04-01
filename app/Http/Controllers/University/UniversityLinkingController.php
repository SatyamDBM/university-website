<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UniversityLinkingController extends Controller
{
    public function index()
    {
        return view('university.linking'); // create this view
    }

    public function store(Request $request)
    {
        // Later: save linking request

        auth()->user()->update([
            'linking_status' => 'pending'
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Linking request submitted successfully!');
    }
}
