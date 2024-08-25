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
        'can_borrow_books',

        //school tag
        'section_id',
        'rollno',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
