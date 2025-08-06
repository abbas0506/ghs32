<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'img',
        'name',
        'father_name',
        'bform',
        'birth_date',
        'identification_mark',
        'phone',
        'address',
        //school tag
        'group_id',
        'section_id',
        'rollno',
        'admission_no',
        'admission_date',

        // 'marks',
        'caste',
        'guardian_profession',
        'guardian_income',

        'card_printed',
        'library_banned',

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
    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function testAllocations()
    {
        return $this->hasManyThrough(TestAllocation::class, Result::class);
    }

    public function testRank($sortedPercentages)
    {
        $index = $sortedPercentages->search(function ($ranking) {
            return $ranking['id'] == $this->id;
        });

        //!== will only be false if record could not be found
        if ($index !== false) {
            $ranking = $sortedPercentages->get($index);
            return $ranking['position'];
        } else {
            return '';
        }
        // Find the key (position) of the specific student
        // $index = $sortedPercentages->search(function ($ranking) {
        //     return $ranking['id'] == $this->id;
        // });

        // //!== will only be false if record could not be found
        // if ($index !== false) {
        //     // $ranking = $sortedPercentages->get($index);
        //     return $index + 1;
        // } else {
        //     return '';
        // }
    }
    public function testTotal($sortedPercentages)
    {
        // Find the key (position) of the specific student
        $index = $sortedPercentages->search(function ($ranking) {
            return $ranking['id'] == $this->id;
        });

        //!== will only be false if record could not be found
        if ($index !== false) {
            $ranking = $sortedPercentages->get($index);
            return $ranking['total_marks'];
        } else {
            return '';
        }
    }
    public function testAggregate($sortedPercentages)
    {
        // Find the key (position) of the specific student
        $index = $sortedPercentages->search(function ($ranking) {
            return $ranking['id'] == $this->id;
        });

        //!== will only be false if record could not be found
        if ($index !== false) {
            $ranking = $sortedPercentages->get($index);
            return $ranking['obtained_marks'];
        } else {
            return '';
        }
    }

    public function testPercentage($sortedPercentages)
    {
        // Find the key (position) of the specific student
        $index = $sortedPercentages->search(function ($ranking) {
            return $ranking['id'] == $this->id;
        });

        //!== will only be false if record could not be found
        if ($index !== false) {
            $ranking = $sortedPercentages->get($index);
            return $ranking['percentage'];
        } else {
            return '';
        }
    }

    public function maximumMarks($testId)
    {
        $sumMarks = $this  // Find the student by ID
            ->results()  // Get the student's results
            ->whereHas('testAllocation', function ($query) use ($testId) {
                $query->where('test_id', $testId);  // Filter by test_id in the test_allocations
            })
            ->join('test_allocations', 'results.test_allocation_id', '=', 'test_allocations.id')  // Join test_allocations to results
            ->sum('test_allocations.total_marks');  // Sum the total_marks from the test_allocations


        return $sumMarks;
    }
}
