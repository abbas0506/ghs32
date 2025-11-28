<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Attendance;
use App\Models\Book;
use App\Models\Clas;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sections = Section::all();
        $teachers = User::whereRelation('roles', 'name', 'teacher')->get();
        $students = Student::all();
        $tests = Test::all();
        $attendances = Attendance::where('date', today())->where('status', 1)->get();
        $applications = Application::all();

        return view('admin.dashboard', compact('sections', 'students', 'teachers', 'tests', 'applications', 'attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
