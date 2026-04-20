<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'subject',
        'message',
        'priority',
        'status',
        'admin_reply',
        'replied_by',
        'replied_at',
        'attachment',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];
}