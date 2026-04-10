<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerPayment extends Model
{
    protected $fillable = [
        'university_banner_id',
        'transaction_id',
        'payment_method',
        'amount',
        'payment_status',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function universityBanner()
    {
        return $this->belongsTo(UniversityBanner::class);
    }
}