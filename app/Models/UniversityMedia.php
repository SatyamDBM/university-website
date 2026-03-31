<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityMedia extends Model
{
    protected $fillable = [
        'university_id',
        'type',
        'file_path',
        'video_url',
        'category'
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
