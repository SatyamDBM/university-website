<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'banner_image',
        'small_heading',
        'heading',
        'description',

        'founder_section_badge',
        'founder_section_title',
        'founder_image',
        'founder_name',
        'founder_designation',
        'founder_description',
        'founder_button_text',
        'founder_button_link',

        'journey_section_badge',
        'journey_section_title',
        'journey_description',

        'leadership_section_badge',
        'leadership_section_title',
        'leadership_description',

        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    public function leadershipTeamMembers()
    {
        return $this->hasMany(LeadershipTeamMember::class)->orderBy('sort_order');
    }
}