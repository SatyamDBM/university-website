<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionProcess extends Model
{

    protected $fillable = [
        'university_id',
        'title'
    ];

    public function dates()
    {
        return $this->hasMany(AdmissionDate::class);
    }

    public function steps()
    {
        return $this->hasMany(AdmissionStep::class);
    }

    public function cutoffs()
    {
        return $this->hasMany(AdmissionCutoff::class);
    }
}
