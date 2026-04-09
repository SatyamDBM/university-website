<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    protected $fillable = [
        'university_id',
        'company_name',
        'logo',
        'industry_type',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function placements()
    {
        return $this->belongsToMany(Placement::class, 'placement_recruiter');
    }
}
