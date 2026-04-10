<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionCutoff extends Model
{
    protected $fillable = [
        'admission_process_id',
        'course',
        'exam',
        'cutoff'
    ];

    public function process()
    {
        return $this->belongsTo(AdmissionProcess::class);
    }
}
