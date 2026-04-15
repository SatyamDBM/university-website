<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\models\Enquiry;

class LeadController extends Controller
{
    public function lead()
    {
        $universityId = auth()->user()->id;

        $directLeads = Enquiry::where('id', $universityId)
            ->whereNull('assigned_by')
            ->latest()
            ->get();

        $assignedLeads = Enquiry::where('university_id', $universityId)
            ->whereNotNull('assigned_by')
            ->latest()
            ->get();

        return view('university.leads', compact('directLeads', 'assignedLeads'));
    }
    public function leadByAdmin()
    {
        $universityId = auth()->user()->id;

        $leads = Enquiry::where('user_id', $universityId)
            ->whereNotNull('assigned_by')
            ->latest()
            ->get();

        return view('university.assigned-leads', compact('leads'));
    }
}
