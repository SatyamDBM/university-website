<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityFacility extends Model
{
    protected $fillable = [
        'university_id',
        'facility_name',
        'description'
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
