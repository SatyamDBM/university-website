<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityProfile extends Model
{
    protected $fillable = [
        'university_id',
        'description',
        'history',
        'vision_mission',
        'established_year',
        'university_type',
        'naac_grade',
        'ugc_approved',
        'aicte_approved',
        'nirf_ranking',
        'qs_ranking',
        'status',
        'is_live',
        'rejection_reason'
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
