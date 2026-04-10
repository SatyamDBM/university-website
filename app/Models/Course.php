<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'university_id',
        'category_id',
        'subcategory_id',
        'course_name',
        'slug',
        'description',
        'duration',
        'course_type',
        'mode',
        'tuition_fees',
        'hostel_fees',
        'admission_fees',
        'total_fees',
        'min_qualification',
        'min_percentage',
        'required_exams',
        'age_limit',
        'curriculum_file',
        'curriculum_text',
        'seat_availability',
        'admission_status',
        'status',
        'admin_feedback',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }
    public function stream()
    {
        return $this->hasMany(CourseStream::class);
    }
}
