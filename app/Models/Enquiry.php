<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'organization',
        'email',
        'phone',
        'service',
        'heard_from',
        'message',
    ];
}
