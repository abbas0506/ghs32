<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Clas;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class ClassStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $clas = Clas::find($id);
        return view('admin.class-students.index', compact('clas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($clasId)
    {
        //
        $clas = Clas::find($clasId);
        return view('admin.class-students.create', compact('clas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $clasId)
    {
        //
        $request->validate([
            'name' => 'required',
            'cnic' => 'required',
            'rollno' => 'required',
        ]);

        try {

            $clas = Clas::find($clasId);
            $clas->students()->create($request->all());
            return redirect()->route('admin.class.students.index', $clas)->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($clasId, string $id)
    {
        //
        $clas = Clas::find($clasId);
        $student = Student::find($id);
        return view('admin.class-students.show', compact('clas', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($clasId, string $id)
    {
        //
        $clas = Clas::find($clasId);
        $student = Student::find($id);
        return view('admin.class-students.edit', compact('clas', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $clasId, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'cnic' => 'required',
            'rollno' => 'required',
        ]);

        try {

            $clas = Clas::find($clasId);
            $clas->students()->find($id)->update($request->all());
            return redirect()->route('admin.class.students.index', $clas)->with('success', 'Successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($clasId, string $id)
    {
        //
        try {
            $student = Student::find($id);
            $student->delete();
            return redirect()->route('admin.class.students.index', $clasId)->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function import($id)
    {

        // save selected class for later usage at students import actually
        session(['clas_id' => $id]);
        $clas = Clas::find($id);
        return view('admin.class-students.import', compact('clas'));
    }
    /**
     * import data from excel
     */
    public function postImport(Request $request)
    {
        try {
            Excel::import(new StudentImport, $request->file('file'));
            return redirect()->route('admin.classes.index')->with('success', 'Students imported successfully');
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
