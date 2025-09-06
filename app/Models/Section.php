<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',    //section label A, B, C
        'grade',
        'incharge_id',
    ];

    public function fullName()
    {
        return $this->grade . "-" . $this->name;
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function incharge()
    {
        return $this->belongsTo(User::class, 'incharge_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

    public function scopeActive($query)
    {
        return true;
    }
    public function  studentRank($sortedPercentages, $specificId)
    {
        $index = $sortedPercentages->search(function ($student) use ($specificId) {
            return $student['id'] === $specificId;
        });

        if ($index !== false) {
            return $index + 1;
        } else {
            return '';
        }
    }
}
