<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use Carbon\Carbon;
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
        if (session('filter_date'))
            $today = session('filter_date') ?? now()->toDateString();
        else
            $today = now()->toDateString();

        $sections = Section::withCount([
            'students',
            'students as present_count' => function ($q) use ($today) {
                $q->whereHas('attendances', function ($q2) use ($today) {
                    $q2->where('date', $today)
                        ->where('status', 1);
                });
            }
        ])
            ->has('students')
            ->get();

        return view('admin.attendance.index', compact('sections', 'today'));
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
        //will auto marks all students present for the date
        //get current date

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $section = Section::findOrFail($id);
        // $attendances = Attendance::whereDate('date', today())
        //     ->whereHas('student', function ($query) use ($id) {
        //         $query->where('section_id', $id);
        //     })
        //     ->get();
        $attendances = $section->attendances()->whereDate('date', today())->get();
        return view('admin.attendance.show', compact('attendances', 'section'));
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
    public function filter(Request $request)
    {
        $request->validate([
            'date' => 'required',
        ]);

        return  redirect()->route('admin.attendance.index')->with('filter_date', $request->date);
    }
}
