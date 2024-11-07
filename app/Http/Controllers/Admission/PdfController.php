<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Section;
use App\Models\TestAllocation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PdfController extends Controller
{
    //
    public function printListOfStudents($id)
    {
        $section = Section::findOrFail($id);
        $pdf = PDF::loadview('admission.pdf.students-list', compact('section'))->setPaper('a4', 'landscape');
        $pdf->set_option("isPhpEnabled", true);
        $file = "phone-list.pdf";
        return $pdf->stream($file);
    }

    public function printAttendanceList($id)
    {
        $section = Section::findOrFail($id);
        $pdf = PDF::loadview('admission.pdf.attendance-list', compact('section'))->setPaper('a4', 'landscape');
        $pdf->set_option("isPhpEnabled", true);
        $file = "phone-list.pdf";
        return $pdf->stream($file);
    }
    public function printFee()
    {
        $applications = Application::whereNotNull('fee_paid')->get();
        $pdf = PDF::loadview('admission.pdf.fee-paid', compact('applications'))->setPaper('a4', 'portrait');
        $pdf->set_option("isPhpEnabled", true);
        $file = "phone-list.pdf";
        return $pdf->stream($file);
    }
    public function printListOfSrNo($id)
    {
        $section = Section::findOrFail($id);
        $pdf = PDF::loadview('admission.pdf.serial-no', compact('section'))->setPaper('a4', 'landscape');
        $pdf->set_option("isPhpEnabled", true);
        $file = "serial-no.pdf";
        return $pdf->stream($file);
    }

    public function printObjections()
    {
        $applicationsHavingObjection = Application::whereNotNull('objection')->get();
        $pdf = PDF::loadview('admission.pdf.objections', compact('applicationsHavingObjection'))->setPaper('a4', 'portrait');
        $pdf->set_option("isPhpEnabled", true);
        $file = "objections.pdf";
        return $pdf->stream($file);
    }
}
