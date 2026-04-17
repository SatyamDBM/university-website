<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

    protected $fillable = [
        'banner_image',
        'small_heading',
        'heading',
        'description',

        'head_office_title',
        'head_office_address',
        'head_office_phone',
        'head_office_email',
        'head_office_working_hours',
        'head_office_map_iframe',

        'student_support_title',
        'student_support_description',
        'student_support_email',
        'student_support_phone',

        'seo_title',
        'seo_description',
        'seo_keywords',
    ];
    public function regionalOffices()
    {
        return $this->hasMany(ContactRegionalOffice::class);
    }
}