<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniversityBanner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'university_id',
        'banner_id',
        'campaign_name',
        'banner_image',
        'redirect_url',
        'start_date',
        'end_date',
        'price',
        'payment_status',
        'approval_status',
        'live_status',
        'rejection_reason',
        'status',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    public function payments()
    {
        return $this->hasMany(BannerPayment::class);
    }
}