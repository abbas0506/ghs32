<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'father',
        'bform',
        'phone',
        'group_id',
        'marks',
        'can_borrow_books',

        //school tag
        'section_id',
        'rollno',
        'serial_no',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function bookIssuances()
    {
        return $this->hasMany(BookIssuance::class, 'user_id');
    }
}
