<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'designation',
        'bps',
        'phone',
        'email',
        'cnic',
        'qualification',
        'image',

        //bise tag will be in separate model
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function bookIssuances()
    {
        return $this->hasMany(BookIssuance::class, 'user_id');
    }
}
