<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $fillable = [
        'university_id',
        'title',
        'description',
        'badge',
        'priority',
        'is_active'
    ];
}
