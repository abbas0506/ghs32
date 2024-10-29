<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    //
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $student = Student::create([
                'rollno' => $row['rollno'],
                'name' => $row['name'],
                'father' => $row['father'],
                'bform' => $row['bform'],
                // 'group_id' => 2,
                'section_id' => session('section_id'),
            ]);
        }
    }
}
