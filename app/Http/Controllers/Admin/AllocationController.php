<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allocation;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use Exception;

class AllocationController extends Controller
{
    //
    public function index()
    {
        $sections = Section::where('grade_id', '>', 8)->get(); //get active sections
        return view('admin.allocations.index', compact('sections'));
    }

    // create

    public function create($sectionId, $lecture_no)
    {
        $section = Section::findOrFail($sectionId);
        $subjects = Subject::all();
        $users = User::whereRelation('roles', 'name', 'teacher')->get();
        return view('admin.allocations.create', compact('section', 'subjects', 'users', 'lecture_no'));
    }

    public function store(Request $request, $sectionId, $lecture_no)
    {
        //
        $request->validate([
            'session_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required|numeric'
        ]);

        try {
            Allocation::create([

                'session_id' => $request->session_id,
                'section_id' => $sectionId,
                'lecture_no' => $lecture_no,
                'subject_id' => $request->subject_id,
                'teacher_id' => $request->teacher_id,
            ]);
            return redirect()->route('admin.section.lecture.allocations.index', [$sectionId, $lecture_no])->with('success', 'Successfully created');
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
    public function edit($sectionId, $lecture_no, $allocation_id)
    {
        //
        $section = Section::findOrFail($sectionId);
        $subjects = Subject::all();
        $users = User::whereRelation('roles', 'name', 'teacher')->get();

        $allocation = Allocation::findOrFail($allocation_id);
        return view('admin.allocations.edit', compact('allocation', 'subjects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sectionId, $lecture_no, $allocationId)
    {
        //
        $request->validate([
            'subject_id' => 'required|numeric',
            'teacher_id' => 'required|numeric',
        ]);

        $model = Allocation::findOrFail($allocationId);
        try {
            $model->update($request->all());
            return redirect()->route('admin.section.lecture.allocations.index', [0, 0])->with('success', 'Successfully updated');
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sectionId, $lecture_no, $id)
    {
        //
        $model = Allocation::findOrFail($id);
        try {
            $model->delete();
            return redirect()->route('admin.section.lecture.allocations.index', [0, 0])->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}
