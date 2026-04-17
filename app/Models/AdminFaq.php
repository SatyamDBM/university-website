<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminFaq extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question',
        'answer',
        'is_active',
        'sort_order',
    ];
}