<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'slot_name',
        'placement_location',
        'device_type',
        'width',
        'height',
        'max_banner_limit',
        'rotation_type',
        'priority',
        'price',
        'duration',
        'duration_type',
        'status',
        'description',
    ];

    protected $casts = [
        'width' => 'integer',
        'height' => 'integer',
        'max_banner_limit' => 'integer',
        'price' => 'decimal:2',
        'duration' => 'integer',
    ];
}