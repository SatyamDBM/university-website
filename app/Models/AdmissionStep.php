<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionStep extends Model
{
    protected $fillable = [
        'admission_process_id',
        'step_no',
        'title',
        'description'
    ];

    public function process()
    {
        return $this->belongsTo(AdmissionProcess::class);
    }
}
