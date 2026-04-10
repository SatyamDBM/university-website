<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionDate extends Model
{
    protected $fillable = [
        'admission_process_id',
        'label',
        'value'
    ];

    public function process()
    {
        return $this->belongsTo(AdmissionProcess::class);
    }
}
