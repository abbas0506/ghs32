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
                'name' => $row['name'],
                'cnic' => $row['cnic'],
                'clas_id' => session('clas_id'),
                'rollno' => $row['rollno'],
            ]);
        }
    }
}
