<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory, Notifiable, SoftDeletes, CanResetPassword;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_otp',
        'email_otp_expiry',
        'is_email_verified',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_otp',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at'   => 'datetime',
            'email_otp_expiry'    => 'datetime',
            'is_email_verified'   => 'boolean',
            'deleted_at'          => 'datetime',
            'password'            => 'hashed',
        ];
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function linkingRequests()
    {
        return $this->hasMany(UniversityLinkingRequest::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUniversity(): bool
    {
        return $this->role === 'university';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isPendingApproval(): bool
    {
        return $this->status === 'pending_approval';
    }

    public function isInactive(): bool
    {
        return $this->status === 'inactive';
    }
}