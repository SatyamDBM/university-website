<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'city',
        'state',
        'is_verified',
        'email',
        'mobile',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUniversity(): bool
    {
        return $this->role === 'university';
    }


}
