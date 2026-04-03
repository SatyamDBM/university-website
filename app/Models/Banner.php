<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'slot_name',
        'placement_location',
        'device_type',
        'image_width',
        'image_height',
        'monthly_price',
        'yearly_price',
        'display_priority',
        'status',
    ];

    protected $casts = [
        'monthly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
    ];
}