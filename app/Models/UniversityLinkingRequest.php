<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityLinkingRequest extends Model
{
    protected $fillable = [
        'user_id',
        'university_id',
        'requested_university_name',
        'document_path',
        'status',
        'remarks',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function documents()
    {
        return $this->hasMany(UniversityDocument::class, 'linking_request_id');
    }
}
