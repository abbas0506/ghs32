<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //if attendance for the date has already been created, then show index file
        //showing all classes, on click show class with checkboxes
        $section = Section::findOrFail($id);
        $present = $section->attendances()->whereDate('date', today())->where('status', 1)->count();
        return view('teacher.section-attendance.index', compact('section', 'present'));
        // if (!$section->attendanceMarked()) {
        //     // create attendance
        //     return view('teacher.section-attendance.create', compact('section'));
        // } else {
        //     // echo "attendance not marked";
        //     //mark all the students present for today

        // }

        // $attendances = Attendance::whereDate('date', today())
        //     ->whereHas('student', function ($query) use ($id) {
        //         $query->where('section_id', $id);
        //     })->get();

        // return view('teacher.section-attendance.index', compact('attendances', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $section = Section::findOrFail($id);
        return view('teacher.section-attendance.create', compact('section'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {

        $request->validate([
            'student_ids_array' => 'required',
        ]);

        $section = Section::findOrFail($id);

        $today = today();
        DB::beginTransaction();
        try {

            $student_ids_array = array();
            $student_ids_array = $request->student_ids_array;
            $presentStudents = Student::whereIn('id', $student_ids_array)->get();

            foreach ($presentStudents as $student) {
                $exists = $student->attendances()
                    ->whereDate('date', today())->exists();
                if ($exists) {
                    return back()->with('warning', 'Attendance already marked for this date.');
                }
                $student->attendances()->create([
                    'date' => today(),
                    'status' => true,
                ]);
            }
            $absentStudents = Student::whereNotIn('id', $student_ids_array)->get();
            foreach ($absentStudents as $student) {
                $student->attendances()->create([
                    'date' => today(),
                    'status' => false,
                ]);
            }
            DB::commit();
            return redirect()->route('teacher.section.attendance.index', $section);
        } catch (Exception $ex) {
            Db::rollBack();
            return back()->with('warning', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $section = Section::findOrFail($id);
        // $attendances = Attendance::whereDate('date', today())
        //     ->whereHas('student', function ($query) use ($id) {
        //         $query->where('section_id', $id);
        //     })->get();
        $absence = $section->attendances()->whereDate('date', today())->get();
        $attendances = $section->attendances()->whereDate('date', today())->get();
        return view('teacher.section-attendance.edit', compact('section', 'attendances'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'attendance_ids_array' => 'required',
        ]);

        $section = Section::findOrFail($id);

        DB::beginTransaction();
        try {
            $attendance_ids_array = array();
            $attendance_ids_array = $request->attendance_ids_array;
            $absentees = Attendance::whereNotIn('id', $attendance_ids_array)->get();
            foreach ($absentees as $attendance) {
                $attendance->update([
                    'status' => 0
                ]);
            }
            // present
            $attendances = Attendance::whereIn('id', $attendance_ids_array)->get();
            foreach ($attendances as $attendance) {
                $attendance->update([
                    'status' => 1
                ]);
            }

            DB::commit();
            return redirect()->route('teacher.section.attendance.index', $section)->with('success', 'Attendance successfully updated');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
