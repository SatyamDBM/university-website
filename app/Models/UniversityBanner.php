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
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'paid_at',
    ];

    public function university()
    {
        return $this->belongsTo(\App\Models\University::class, 'university_id', 'id');
    }

    public function banner()
    {
        return $this->belongsTo(\App\Models\Banner::class);
    }

    public function payments()
    {
        return $this->hasMany(BannerPayment::class);
    }
}
