<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'age',
        'cin',
        'phone',
        'address',
        'school',
        'sector',
        'startDate',
        'endDate',
        'image',
    ];
}
