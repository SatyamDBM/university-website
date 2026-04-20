<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementRecruiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'placement_id',
        'recruiter_id',
        'company_name',
        'package',
    ];

    public function placement()
    {
        return $this->belongsTo(Placement::class);
    }

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }
}
