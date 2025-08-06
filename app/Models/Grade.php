<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'grade',
        'english_name',          //Nine
        'roman_name',            //IX
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    public function students()
    {
        return $this->hasManyThrough(Student::class, Section::class);
    }
    public function allocations()
    {
        return $this->hasManyThrough(Allocation::class, Section::class);
    }
}
