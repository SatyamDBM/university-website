<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'city',
        'state',
        'is_verified',
        'email',
        'mobile',
        'user_id',
    ];
    // public function user()
    // {
    //     return $this->belongsTo(\App\Models\User::class);
    // }
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUniversity(): bool
    {
        return $this->role === 'university';
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }



    public function profile()
    {
        return $this->hasOne(UniversityProfile::class);
    }

    public function facilities()
    {
        return $this->hasMany(UniversityFacility::class);
    }

    public function media()
    {
        return $this->hasMany(UniversityMedia::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function admissionProcess()
    {
        return $this->hasOne(AdmissionProcess::class);
    }

    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }

    public function loanPartners()
    {
        return $this->hasMany(LoanPartner::class);
    }
    public function faqs()
    {
        return $this->hasMany(\App\Models\UniversityFaq::class);
    }

    public function recruiters()
    {
        return $this->hasMany(Recruiter::class);
    }
}
