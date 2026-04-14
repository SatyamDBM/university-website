<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogDetail extends Model
{
    protected $fillable = [
        'blog_id',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'tags',
        'canonical_url',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}