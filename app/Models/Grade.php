<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'grade_no',
        'english_name',          //Nine
        'roman_name',            //IX
    ];

    public function classes()
    {
        return $this->hasMany(Clas::class);
    }
    public function students()
    {
        return $this->hasManyThrough(Student::class, Clas::class);
    }
}
