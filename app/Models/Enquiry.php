<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\University;
use App\Models\User;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'course',
        'message',
        'university_id',
        'user_id',
        'assigned_by',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}