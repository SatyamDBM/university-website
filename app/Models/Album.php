<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'university_id',
        'name',
        'category',
        'description',
        'date',
        'status'
    ];
    protected $dates = ['deleted_at'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
