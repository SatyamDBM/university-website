<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'package_id',
        'start_date',
        'end_date',
        'total_days',
        'remaining_days',
        'amount',
        'discount',
        'final_amount',
        'payment_status',
        'transaction_id',
        'auto_renew',
        'renewal_date',
        'featured_used',
        'banner_used',
        'lead_used',
        'course_used',
        'city_used',
        'state_used',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'renewal_date' => 'date',
        'auto_renew' => 'boolean',
        'amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_amount' => 'decimal:2',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}