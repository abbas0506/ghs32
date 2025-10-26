<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class TeacherWiseScheduleController extends Controller
{
    //
    public function  index()
    {
        $teachers = Teacher::all()->sortByDesc('bps'); //get active sections
        return view('admin.schedule.teacher-wise.index', compact('teachers'));
    }
    public function print()
    {
        $teachers = Teacher::all();
        $pdf = PDF::loadview('admin.schedule.teacher-wise.pdf', compact('teachers'))->setPaper('a4', 'landscape');
        $pdf->set_option("isPhpEnabled", true);
        $file = "teacher-schedule.pdf";
        return $pdf->stream($file);
    }
}
