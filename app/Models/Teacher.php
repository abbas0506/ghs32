<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'father_name',
        'cnic',
        'dob',
        'blood_group',
        'address',
        'personal_phone',
        'official_phone',
        'joined_at',
        'designation',
        'qualification',
        'bps',
        'posting',
        'photo',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
