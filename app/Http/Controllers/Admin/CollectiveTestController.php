<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Test;
use App\Models\TestAllocation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectiveTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tests = Test::whereNull('user_id')->get();
        return view('admin.tests.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $grades = Grade::where('grade', '>', 5)->get();
        return view('admin.tests.create', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'grades_array' => 'required',
        ]);

        $gradeIdsArray = array();
        $gradeIdsArray = $request->grades_array;

        $grades = Grade::whereIn('id', $gradeIdsArray)->get();

        DB::beginTransaction();
        try {
            $test = Test::create([
                'title' => $request->title,
            ]);

            foreach ($grades as $grade) {
                foreach ($grade->allocations as $allocation) {
                    $test->testAllocations()->create([
                        'allocation_id' => $allocation->id,
                        'total_marks' => 50,
                        'test_date' => now(),
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.tests.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            DB::rollBack();
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
        // $test = Test::findOrFail($id);
        // return view('admin.tests.show', compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $test = Test::findOrFail($id);
        return view('admin.tests.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
        ]);

        $model = Test::findOrFail($id);
        try {
            $model->update($request->all());
            return redirect()->route('admin.tests.index')->with('success', 'Successfully updated');
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
        $model = Test::findOrFail($id);
        try {
            $model->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}
