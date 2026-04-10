<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPartner extends Model
{
    protected $fillable = [
        'university_id',
        'bank_name',
        'interest_rate',
        'amount',
        'logo'
    ];
}
