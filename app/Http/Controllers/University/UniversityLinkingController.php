<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UniversityLinkingRequest;


class UniversityLinkingController extends Controller
{
    public function index()
    {
        $status = auth()->user()->linking_status ?? 'not_linked';
        return view('university.linking', compact('status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            // 'document' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $user = auth()->user();

        // ❌ Prevent multiple active requests
        $exists = UniversityLinkingRequest::where('user_id', $user->id)
            ->where('is_active', true)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already have a pending request.');
        }

        // ✅ Upload file
        // $path = $request->file('document')->store('documents');

        // ✅ Save linking request
        UniversityLinkingRequest::create([
            'user_id' => $user->id,
            'university_id' => $request->university_id,
            'requested_university_name' => null,
            // 'document_path' => $path,
            'status' => 'pending',
            'is_active' => true,
        ]);

        // ✅ Only update status (NOT university_id yet)
        $user->update([
            'linking_status' => 'pending',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Linking request submitted successfully!');
    }
}
