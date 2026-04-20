<?php

namespace App\Models;

use App\Traits\HasSearch;

use Illuminate\Database\Eloquent\Model;
use App\Models\University;
use App\Models\User;

class Enquiry extends Model
{
    use HasSearch;

    protected $searchable = [
        'name',
        'email',
        'mobile',
        'course',
        'message'
    ];
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
    public function scopeAssigned($query)
    {
        return $query->whereNotNull('assigned_by');
    }

    public function scopeUnassigned($query)
    {
        return $query->whereNull('assigned_by');
    }
}
