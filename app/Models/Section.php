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
        'starts_at',
        'ends_at',
    ];

    protected $dates = ['starts_at', 'ends_at'];
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

    public function roman()
    {
        return $this->grade->roman_name . "-" . $this->name;
    }
    public function scopeActive($query)
    {
        $duration = ($this->grade < 9 ? 3 : 2);

        return $query->where('starts_at', '>=', date('y') - $duration);
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
