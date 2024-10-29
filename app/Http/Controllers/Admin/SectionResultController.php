<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Test;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Result;
use App\Models\Student;

class SectionResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($testId, $sectionId)
    {
        //
        $section = Section::findOrFail($sectionId);
        $test = Test::findOrFail($testId);

        // calculate test ranking

        $students = Student::with('results.testAllocation')
            ->whereHas('results.testAllocation', function ($query) use ($testId) {
                $query->where('test_id', $testId);
            })
            ->where('section_id', $sectionId)
            ->get();

        $studentPercentages = $students->map(function ($student) {
            $obtained = $student->results->sum('obtained_marks');
            $total = $student->results->sum(function ($result) {
                return $result->testAllocation->total_marks;
            });

            // Avoid division by zero
            $percentage = $total > 0 ? ($obtained / $total) * 100 : 0;

            return [
                'id' => $student->id,
                'rollno' => $student->rollno,
                'name' => $student->name,
                'total' => $total,
                'obtained' => $obtained,
                'percentage' => round($percentage, 0),
            ];
        });

        // Sort by percentage descending
        $sortedPercentages = $studentPercentages->sortByDesc('percentage');


        // echo $sortedPercentages['id'];
        $sortedResult = collect();
        $i = 0;
        foreach ($sortedPercentages as $sortedPercentage) {
            $sortedResult->push([
                'id' => $sortedPercentage['id'],
                'rollno' => $sortedPercentage['rollno'],
                'name' => $sortedPercentage['name'],
                'total' => $sortedPercentage['total'],
                'obtained' => $sortedPercentage['obtained'],
                'percentage' => $sortedPercentage['percentage'],
                'position' => ++$i,
            ]);
        }



        // $rankings = Result::select('student_id', DB::raw('SUM(obtained_marks) as total_marks'), DB::raw('SUM(obtained_marks)/test_allocations.total_marks*100 as percentage'))
        //     ->join('test_allocations', 'test_allocations.id', '=', 'results.test_allocation_id')
        //     ->whereHas('testAllocation', function ($query) use ($testId, $sectionId) {
        //         $query->where('test_id', $testId)
        //             ->whereHas('allocation', function ($query) use ($sectionId) {
        //                 $query->where('section_id', $sectionId);
        //             });
        //     })
        //     // ->whereHas('testAllocation.allocation', function ($query) use ($sectionId) {
        //     //     $query->where('section_id', $sectionId);
        //     // })
        //     ->groupBy('student_id', 'test_allocations.total_marks')
        //     ->orderBy('percentage', 'desc')
        //     ->get();
        // // $rankings = Result::select('student_id', DB::raw('SUM(obtained_marks) as total_marks'))
        //     ->whereHas('testAllocation', function ($query) use ($testId, $sectionId) {
        //         $query->where('test_id', $testId)
        //             ->whereHas('allocation', function ($query) use ($sectionId) {
        //                 $query->where('section_id', $sectionId);
        //             });
        //     })
        //     // ->whereHas('testAllocation.allocation', function ($query) use ($sectionId) {
        //     //     $query->where('section_id', $sectionId);
        //     // })
        //     ->groupBy('student_id')
        //     ->orderBy('total_marks', 'desc')
        //     ->get();

        // Create a collection from the rankings
        // $rankingCollection = collect($rankings);

        $pdf = PDF::loadview('admin.section-results.preview', compact('test', 'section', 'sortedResult'))->setPaper('a4', 'portrait');
        $pdf->set_option("isPhpEnabled", true);
        $file = "Report Cards - " . $section->roman() . ".pdf";
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
