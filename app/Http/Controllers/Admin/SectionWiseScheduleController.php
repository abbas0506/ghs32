<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allocation;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class SectionWiseScheduleController extends Controller
{
    //
    public function index()
    {
        $sections = Section::all()->sortByDesc('grade'); //get active sections
        return view('admin.schedule.section-wise.index', compact('sections'));
    }

    public function print()
    {
        $sections = Section::all();
        $pdf = PDF::loadview('admin.schedule.section-wise.pdf', compact('sections'))->setPaper('a4', 'landscape');
        $pdf->set_option("isPhpEnabled", true);
        $file = "schedule.pdf";
        return $pdf->stream($file);
    }


    public function clear()
    {
        $allocations = Allocation::all();
        try {
            foreach ($allocations as $allocation)
                $allocation->delete();
            return redirect('admin/section-wise-schedule')->with('success', 'Successfuly removed all entries!');
        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }
}
