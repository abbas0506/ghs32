<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //if attendance for the date has already been created, then show index file
        //showing all classes, on click show class with checkboxes
        $attendanceHasBeenMarked = Attendance::whereDate('date', today())->count();
        if ($attendanceHasBeenMarked) {
            $sections = Section::all();
            return view('teacher.attendance.index', compact('sections'));
        } else {
            //else show create page with sinle button, on press ...will auto mark all as present
            //later on edit page will be used to update absent students
            return view('teacher.attendance.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $sections = Section::all();
        return view('attendance.index', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //will auto marks all students present for the date
        //get current date
        $today = today();
        //start db transaction and mark all as present
        DB::beginTransaction();
        try {
            $students = Student::all();
            foreach ($students as $student) {
                $student->attendances()->create([
                    'date' => today(),
                    'status' => true,
                ]);
            }
            DB::commit();
            return redirect()->route('teacher.attendance.index')->with('success', 'Welcome today!');
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
        $section = Section::findOrFail($id);
        $attendances = Attendance::whereDate('date', today())
            ->whereHas('student', function ($query) use ($id) {
                $query->where('section_id', $id);
            })
            ->get();

        return view('teacher.attendance.show', compact('attendances', 'section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
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
            return redirect()->route('teacher.attendance.index')->with('success', 'Attendance successfully updated');
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
