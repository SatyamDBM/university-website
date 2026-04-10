<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseStream extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'duration',
        'intake',
        'mode',
        'min_fee',
        'max_fee',
        'min_qualification',
        'min_percentage',
        'entrance_exams',
        'seats',
        'avg_package',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
