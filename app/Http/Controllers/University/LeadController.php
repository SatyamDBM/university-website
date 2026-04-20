<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class LeadController extends Controller
{
    public function lead(Request $request)
    {
        $universityId = auth()->user()->id;
        $enquiries = Enquiry::query()
            ->where('user_id', $universityId)
            ->whereNull('assigned_by')
            ->search($request->search)
            ->latest()
            ->paginate(10);
        if ($request->ajax()) {
            return view('university.lead.partials.table_body', compact('enquiries'))->render();
        }
        return view('university.lead.university_lead', compact('enquiries'));
    }
    public function leadByAdmin(Request $request)
    {
        $universityId = auth()->user()->id;
        $search = $request->search;
        $enquiries = Enquiry::where('user_id', $universityId)
            ->whereNotNull('assigned_by')

            // ✅ SEARCH ADDED
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('mobile', 'like', "%$search%")
                        ->orWhere('course', 'like', "%$search%");
                });
            })
            ->latest()
            ->paginate(10);
        if ($request->ajax()) {
            return view('university.lead.partials.table_body', compact('enquiries'))->render();
        }
        return view('university.lead.admin_assign_lead', compact('enquiries'));
    }
}
