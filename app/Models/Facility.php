<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'university_id',
        'facility_name',
        'facility_type',
        'description',
        'capacity',
        'availability',
        'gender_specific',
        'is_featured',
        'is_top',
        'is_highlight',
        'status'
    ];
    protected $casts = [
        'hostel_details' => 'array',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function images()
    {
        return $this->hasMany(FacilityImage::class);
    }
}
