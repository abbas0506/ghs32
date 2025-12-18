<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

class AttendanceRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $teachers = Teacher::all();
        $teachers = Teacher::orderBy('name')->get();
        $teacherChunks = $teachers->chunk(4)->map(function ($chunk) {
            return $chunk->pad(4, null);
        });
        // $teacherChunks = $teachers->chunk(4);
        set_time_limit(0); // 🔥 no timeout
        ini_set('memory_limit', '512M');
        $year = 2026;
        $holidays = [
            '02-05' => 'Kashmir Day',
            '05-01' => 'Labour Day',
            '08-14' => 'Independence Day',
            '12-25' => 'Quaid-e-Azam Day',
        ];

        $holidayMap = [];

        foreach ($holidays as $md => $name) {
            [$month, $day] = explode('-', $md);

            $holidayMap[(int)$month][(int)$day] = $name;
        }

        // Build months data
        $months = collect(range(1, 12))->map(function ($month) use ($year) {
            $date = Carbon::create($year, $month, 1);

            return [
                'name' => $date->format('F'),
                'daysInMonth' => $date->daysInMonth,
                'month' => $month,
                'year' => $year,
            ];
        });

        $pdf = PDF::loadView('admin.attendance-register.pdf', compact(
            'teacherChunks',
            'months',
            'year',
            'holidayMap'
        ))->setPaper('A4', 'portrait');

        return $pdf->stream("Teacher_Attendance_Register_$year.pdf");
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
