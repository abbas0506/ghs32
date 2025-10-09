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
        'personal_number',
        'photo',
        'is_active',
    ];

    protected $casts = [
        'dob' => 'date',   // Cast as Carbon date
        'joined_at' => 'date',   // Cast as Carbon date
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
