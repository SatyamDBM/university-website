<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSeat extends Model
{
    protected $table = 'course_seats';

    protected $fillable = [
        'course_id',
        'category',
        'seats',
    ];

    /**
     * Relationship: Seat belongs to Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
