<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Clas;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $teachers = Teacher::all();
        $students = Student::all();
        $grades = Grade::where('id', '>', 8)->get();

        return view('admin.dashboard', compact('students', 'teachers', 'grades'));
    }
}
