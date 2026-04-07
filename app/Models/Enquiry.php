<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\University;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'message',
        'university_id',
    ];
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}