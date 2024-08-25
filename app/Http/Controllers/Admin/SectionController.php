<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        //
        $sections = Section::query()->active()->get();
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $grades = Grade::where('id', '>', 5)->get();
        $teachers = Teacher::all();
        return view('admin.sections.create', compact('grades', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'grade_id' => 'required|numeric',
            'name' => 'required',
            'induction_year' => 'required|numeric',
            'incharge_id' => 'nullable|numeric',
        ]);


        try {
            Section::create($request->all());
            return redirect()->route('admin.sections.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
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
        $grades = Grade::where('id', '>', 5)->get();
        $teachers = Teacher::all();
        $section = Section::find($id);
        return view('admin.sections.edit', compact('section', 'grades', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'grade_id' => 'required|numeric',
            'name' => 'required',
            'induction_year' => 'required|numeric',
            'incharge_id' => 'nullable|numeric',
        ]);

        $model = Section::find($id);
        try {
            $model->update($request->all());
            return redirect()->route('admin.sections.index')->with('success', 'Successfully updated');
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $model = Section::findOrFail($id);
        try {
            $model->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    // remove all students
    public function clean(Request $request, $sectionId)
    {
        //
        $model = Section::findOrFail($sectionId);
        try {
            $model->students()->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}
