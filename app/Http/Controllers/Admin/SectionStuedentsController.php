<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Models\Section;
use App\Models\Student;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class SectionStuedentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $section = Section::findOrFail($id);
        return view('admin.students.index', compact('section'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($sectionId)
    {
        //
        $section = Section::findOrFail($sectionId);
        return view('admin.students.create', compact('section'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $sectionId)
    {
        //
        $request->validate([
            'name' => 'required',
            'bform' => 'required',
            'rollno' => 'required',
        ]);

        try {

            $section = Section::findOrFail($sectionId);
            $section->students()->create($request->all());
            return redirect()->route('admin.section.students.index', $section)->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($sectionId, string $id)
    {
        //
        $section = Section::findOrFail($sectionId);
        $student = Student::findOrFail($id);
        return view('admin.students.show', compact('section', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sectionId, string $id)
    {
        //
        $section = Section::findOrFail($sectionId);
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('section', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sectionId, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'bform' => 'required',
            'rollno' => 'required',
        ]);

        try {

            $section = Section::findOrFail($sectionId);
            $section->students()->find($id)->update($request->all());
            return redirect()->route('admin.section.students.index', $section)->with('success', 'Successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sectionId, string $id)
    {
        //
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            return redirect()->route('admin.section.students.index', $sectionId)->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
