<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Section;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sections = Section::all();
        return view('admission.sections.index', compact('sections'));
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
        $section = Section::findOrFail($id);
        return view('admission.sections.show', compact('section'));
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
    public function clean(Request $request, $sectionId)
    {
        //
        $model = Section::findOrFail($sectionId);
        try {
            $model->students()->delete();
            return redirect()->back()->with('success', 'Successfully cleaned');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    public function refreshSrNo(Request $request, $id)
    {

        // refresh serial no starting from the start value
        $request->validate([
            'startvalue' => 'required',
        ]);

        $srNo = $request->startvalue;

        DB::beginTransaction();
        try {
            $section = Section::findOrFail($id);
            $students = $section->students->sortByDesc('marks');

            foreach ($students as $student) {
                $student->admission_no = $srNo;
                $student->save();
                $srNo++;
            }
            DB::commit();
            return redirect()->back()->with('success', 'Successfully cleaned');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    public function refreshRollNo($id)
    {
        //refresh section rollno

        $srNo = 1;
        DB::beginTransaction();
        try {
            $section = Section::findOrFail($id);
            $students = $section->students->sortByDesc('marks')->sortBy('group_id');

            foreach ($students as $student) {
                $student->rollno = $srNo;
                $student->save();
                $srNo++;
            }
            DB::commit();
            return redirect()->back()->with('success', 'Successfully re-ordered');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}
