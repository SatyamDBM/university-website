<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniversityFaq extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'university_id',
        'question',
        'answer',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
