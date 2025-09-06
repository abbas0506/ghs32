<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Models\Group;
use App\Models\Section;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $groups = Group::all();
        return view('admin.students.edit', compact('section', 'student', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section, Student $student)
    {
        //
        $validated = $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'name' => 'required|string|max:50',
            'father_name' => 'required|string|max:50',
            'bform' => 'required|string|max:15|unique:students,bform,' . $student->id,
            'phone' => 'required|string|max:16',
            'address' => 'nullable|string|max:100',
            'dob' => 'required|date',
            'id_mark' => 'required|string|max:100',
            'caste' => 'required|string|max:50',
            'is_orphan' => 'required|boolean',
            'guardian_relation' => 'nullable|string|max:50',
            'guardian_name' => 'nullable|string|max:50',
            'father_cnic' => 'nullable|string|max:15',
            'mother_cnic' => 'nullable|string|max:15',
            'profession' => 'required|string|max:50',
            'income' => 'required|integer|min:0',

            // 'grade' => 'required|integer|min:1|max:12',
            'group_id' => 'required|exists:groups,id',
        ]);

        try {

            // ✅ If new photo uploaded
            if ($request->hasFile('photo')) {
                if ($student->photo && Storage::disk('public')->exists($student->photo)) {
                    Storage::disk('public')->delete($student->photo);
                }

                $filename = uniqid() . '.' . $request->photo->extension();
                $path = $request->photo->storeAs('uploads', $filename, 'public');

                $validated['photo'] = $path; // full path like "uploads/abc.jpg"
            }
            $student->update($validated);
            return redirect()->route('admin.sections.show', $section)->with('success', 'Student successfully updated');
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
            return redirect()->route('admin.sections.show', $sectionId)->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
