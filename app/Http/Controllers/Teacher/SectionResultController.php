<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Allocation;
use App\Models\Section;
use App\Models\Test;
use App\Models\TestAllocation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Exception;

class SectionResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($testId, $sectionId)
    {
        //
        $test = Test::findOrFail($testId);
        $section = Section::findOrFail($sectionId);
        $lectureNos = Allocation::where('section_id', $section->id)->pluck('lecture_no')->unique();

        $pdf = PDF::loadview('teacher.pdf.section-result', compact('test', 'section', 'lectureNos'))->setPaper('a4', 'portrait');
        $pdf->set_option("isPhpEnabled", true);
        $file = "subject result.pdf";
        return $pdf->stream($file);
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
