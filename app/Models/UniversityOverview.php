<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityOverview extends Model
{
    protected $fillable = [
        'university_id',
        'about',
        'why_choose',
        'established_date',
        'university_type',
        'location',
        'chancellor',
        'campus_area',
        'total_students',
        'faculty',
        'exams',
        'application_fee',
        'website',
        'naac_score',
        'accreditations', // JSON
        'brochure',
    ];

    protected $casts = [
        'accreditations' => 'array',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
