<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UniversityLinkingRequest;
use App\Models\User;


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
        ]);

        $user = auth()->user();

        // ❌ Prevent multiple active requests
        $exists = UniversityLinkingRequest::where('user_id', $user->id)
            ->where('is_active', true)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already have a pending request.');
        }

        // ✅ Save linking request
        $linking = UniversityLinkingRequest::create([
            'user_id' => $user->id,
            'university_id' => $request->university_id,
            'requested_university_name' => null,
            'status' => 'pending',
            'is_active' => true,
        ]);

        // ✅ Update user status
        $user->update([
            'linking_status' => 'pending',
        ]);

        // ==========================
        // 🔔 SEND NOTIFICATION TO ADMIN
        // ==========================

        $adminId = \App\Models\User::where('role', 'admin')->value('id');

        if ($adminId) {
            sendNotification([
                'user_id' => $adminId,
                'title' => 'New University Linking Request',
                'message' => $user->name . ' has submitted a linking request',
                'type' => 'info',
                'related_type' => 'linking_request',
                'related_id' => $linking->id,
                'action_url' => url('/admin/universities-request/' . $linking->id),
            ]);
        }

        // ==========================
        // 🔔 OPTIONAL: notify user too
        // ==========================

        sendNotification([
            'user_id' => $user->id,
            'title' => 'Request Submitted',
            'message' => 'Your linking request has been submitted successfully',
            'type' => 'success',
            'related_type' => 'linking_request',
            'related_id' => $linking->id,
            'action_url' => route('dashboard'),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Linking request submitted successfully!');
    }
}
