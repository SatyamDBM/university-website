<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_name',
        'title',
        'slug',
        'short_description',
        'featured_image',
        'status',
        'publish_type',
        'publish_date',
        'created_by',
    ];

    public function detail()
    {
        return $this->hasOne(BlogDetail::class);
    }
}