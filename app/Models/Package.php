<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'duration',
        'duration_type',
        'featured_listing',
        'homepage_visibility',
        'lead_access',
        'lead_limit',
        'banner_limit',
        'course_limit',
        'city_limit',
        'state_limit',
        'support_type',
        'priority_rank',
        'status',
    ];

    protected $casts = [
        'featured_listing' => 'boolean',
        'homepage_visibility' => 'boolean',
        'lead_access' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}