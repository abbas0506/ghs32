<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Profile;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        //
        $grades = Grade::where('id', '>', 8)->get();
        return view('admin.sections.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
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
}
