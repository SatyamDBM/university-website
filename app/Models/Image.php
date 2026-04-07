<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'album_id',
        'image_url',
        'thumbnail_url',
        'caption',
        'alt_text',
        'status'
    ];
    protected $dates = ['deleted_at'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
