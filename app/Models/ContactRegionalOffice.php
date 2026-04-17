<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRegionalOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_us_id',
        'city_name',
        'address',
        'phone',
        'email',
    ];

    public function contactUs()
    {
        return $this->belongsTo(ContactUs::class);
    }
}