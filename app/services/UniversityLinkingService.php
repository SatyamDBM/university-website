<?php

namespace App\Services;

use App\Models\University;
use App\Models\UniversityLinkingRequest;

class UniversityLinkingService
{
    public function createLinkingRequest($user, $universityId)
    {
        return UniversityLinkingRequest::create([
            'user_id' => $user->id,
            'university_id' => $universityId,
            'status' => 'pending',
        ]);
    }

    public function approve($request)
    {
        $request->update(['status' => 'approved']);

        $request->user->update([
            'university_id' => $request->university_id,
            'linking_status' => 'approved'
        ]);
    }

    public function reject($request, $reason = null)
    {
        $request->update([
            'status' => 'rejected',
            'remarks' => $reason
        ]);
    }
}
