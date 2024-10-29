<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAllocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'test_id',    //section label A, B, C
        'allocation_id',
        'total_marks',
        'test_date',
        'result_date',
    ];

    protected $dates = ['test_date', 'result_date'];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
    public function appearingStudents()
    {
        return $this->belongsToMany(Student::class, 'results', 'test_allocation_id', 'student_id');
    }

    public function scopeCombined($query)
    {
        return $query->whereHas('test', function ($query) {
            $query->whereNull('user_id');
        });
    }
    public function scopeResultSubmitted($query)
    {
        return $query->whereNotNull('result_date');
    }
    public function scopeResultPending($query)
    {
        return $query->whereNull('result_date');
    }
    public function scopeActive($query)
    {
        return $query->whereHas('test', function ($query) {
            $query->where('is_open', true);
        });
    }
}
