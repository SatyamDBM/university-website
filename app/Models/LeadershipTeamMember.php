<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadershipTeamMember extends Model
{
    protected $fillable = [
        'about_us_id',
        'image',
        'name',
        'designation',
        'linkedin_url',
        'sort_order',
    ];

    public function aboutUs()
    {
        return $this->belongsTo(AboutUs::class);
    }
}