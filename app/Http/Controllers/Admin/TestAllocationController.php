<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allocation;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\TestAllocation;
use Exception;
use Illuminate\Http\Request;

class TestAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $test = Test::findOrFail($id);
        $testAllocations = $test->testAllocations;
        return view('admin.tests.allocations.index', compact('test', 'testAllocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $test = Test::findOrFail($id);
        $alreadyIncludedAllocationIdsArray = TestAllocation::where('test_id', $test->id)->pluck('allocation_id')->toArray();
        $allocations = Allocation::with('section')->whereNotIn('id', $alreadyIncludedAllocationIdsArray)->get();
        return view('admin.tests.allocations.create', compact('test', 'allocations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $testId)
    {
        //
        $request->validate([
            'allocation_id' => 'required|numeric',
        ]);

        $test = Test::findOrFail($testId);
        try {
            $test->testAllocations()->create([
                'allocation_id' => $request->allocation_id,
                'max_marks' => 50,
                'test_date' => now(),
            ]);
            return redirect()->route('admin.test.allocations.index', $test)->with('success', 'Successfully created');
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
    public function edit($testId, $id)
    {
        //
        $test = Test::findOrFail($testId);
        $testAllocation = TestAllocation::findOrFail($id);
        $teachers = Teacher::where('is_active', true)->get();
        return view('admin.tests.allocations.edit', compact('test', 'testAllocation', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $testId, string $id)
    {
        //
        $request->validate([
            'max_marks' => 'required|numeric|min:1',
            'teacher_id' => 'required',
        ]);

        $test = Test::findOrFail($testId);
        try {


            if ($request->unlock) {
                $test->testAllocations()->findOrFail($id)->update([
                    // 'max_marks' => $request->max_marks,
                    'result_date' => null,
                ]);
            } else {
                $test->testAllocations()->findOrFail($id)->update([
                    'teacher_id' => $request->teacher_id,
                    'max_marks' => $request->max_marks,
                ]);
            }
            return redirect()->route('admin.test.allocations.index', $test)->with('success', 'Successfully created');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($testId, string $id)
    {
        //
        $model = TestAllocation::findOrFail($id);
        try {
            $model->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
}
