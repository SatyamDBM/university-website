<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionCutoff extends Model
{
    protected $fillable = [
        'admission_process_id',
        'course_id',
        'exam',
        'year',
        'cutoff'
    ];

    public function process()
    {
        return $this->belongsTo(AdmissionProcess::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
