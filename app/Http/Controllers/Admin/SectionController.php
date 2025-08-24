<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;

class SectionController extends Controller
{
    public function index()
    {
        //
        $sections = Section::all();
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'grade' => 'required',
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
        $section = Section::findOrFail($id);
        return view('admin.sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

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
        $model = Section::findOrFail($id);
        try {
            $model->delete();
            return redirect()->route('admin.sections.index')->with('success', 'Successfully deleted');
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

    public function export($id)
    {

        // save selected class for later usage at students import actually
        $section = Section::findOrFail($id);
        $exportSections = Section::where('id', '!=', $id)->get();
        return view('admin.sections.export', compact('section', 'exportSections'));
    }
    /**
     * import data from excel
     */
    public function postExport(Request $request)
    {
        $request->validate([
            'student_ids_array' => 'required',
        ]);


        try {
            $studentIdsArray = array();
            $studentIdsArray = $request->student_ids_array;
            $request->validate([
                'student_ids_array' => 'required|array',
                'export_section_id' => 'required|integer|exists:sections,id',
            ]);

            // Get selected student IDs
            $studentIdsArray = $request->student_ids_array;

            // Bulk update
            Student::whereIn('id', $studentIdsArray)
                ->update(['section_id' => $request->export_section_id]);

            return redirect()->back()->with('success', 'Students updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
    public function import($id)
    {

        // save selected class for later usage at students import actually
        session(['section_id' => $id]);
        $section = Section::findOrFail($id);
        return view('admin.sections.import', compact('section'));
    }
    /**
     * import data from excel
     */
    public function postImport(Request $request)
    {
        try {
            Excel::import(new StudentImport, $request->file('file'));
            return redirect()->route('admin.sections.index')->with('success', 'Students imported successfully');
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
