<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumni extends Model
{
    use HasFactory;
    protected $fillable = [
        'prefix',
        'name',
        'phone',
        'email',
        'home_address',
        'office_address',
        'job_desc',
        'photo'
    ];
}
