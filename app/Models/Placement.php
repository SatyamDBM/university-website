<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    protected $fillable = [
        'university_id',
        'academic_year',
        'highest_package',
        'average_package',
        'median_package',
        'placement_rate',
        'total_students_placed',
        'total_students_eligible',
        'status',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function recruiters()
    {
        return $this->belongsToMany(Recruiter::class, 'placement_recruiter');
    }
}
