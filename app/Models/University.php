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

    public function overview()
    {
        return $this->hasOne(UniversityOverview::class);
    }

    public function profile()
    {
        return $this->hasOne(UniversityProfile::class);
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class);
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

    public function placements()
    {
        return $this->hasMany(Placement::class);
    }
    public function activeSubscription()
    {
        return $this->hasOne(\App\Models\Subscription::class)
            ->where('status', 'active')
            ->where('payment_status', 'paid')
            ->where('end_date', '>=', now())
            ->latestOfMany(); // important
    }

    public function banners()
    {
        return $this->hasMany(UniversityBanner::class);
    }

    public function package()
    {
        return $this->belongsTo(\App\Models\Package::class);
    }
}
