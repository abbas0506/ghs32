<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clas;
use App\Models\Grade;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        //
        $classes = Clas::query()->active()->get();
        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $grades = Grade::where('id', '>', 5)->get();
        $teachers = Teacher::all();
        return view('admin.classes.create', compact('grades', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'grade_id' => 'required|numeric',
            'section_label' => 'required',
            'induction_year' => 'required|numeric',
            'incharge_id' => 'nullable|numeric',
        ]);


        try {
            Clas::create($request->all());
            return redirect()->route('admin.classes.index')->with('success', 'Successfully created');
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

        $clas = Clas::find($id);
        return view('admin.classes.show', compact('clas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Clas::find($id);
        return view('admin.classes.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'short' => 'required',
        ]);

        $model = Clas::find($id);
        try {
            $model->update($request->all());
            return redirect()->route('admin.classes.index')->with('success', 'Successfully updated');
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
        $model = Clas::findOrFail($id);
        try {
            $model->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}
