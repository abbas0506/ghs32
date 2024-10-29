<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $applications = Application::all();
        return view('admission.applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $groups = Group::all();
        return view('admission.applications.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'father' => 'required',
            'bform' => 'required',
            'phone' => 'required',
            'bise_name' => 'required',
            'rollno' => 'required',
            'obtained' => 'required',
            'total' => 'required',
            'pass_year' => 'required',
            // 'concession' => 'required',
            'group_id' => 'required',
        ]);

        $request->merge([
            'grade_id' => 11,
            'concession' => 0,
        ]);
        try {
            $duplicate = Application::where('rollno', $request->rollno)->where('pass_year', $request->pass_year)->first();
            if ($duplicate) {
                // duplicate record;
                return redirect()->back()->with('warning', 'Application alrady exists');
            } else {
                // not duplicating
                Application::create($request->all());
                return redirect()->route('admission.applications.index')->with('success', 'Successfully submitted!');
            }
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
        $application = Application::findOrFail($id);
        return view('admission.applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $application = Application::findOrFail($id);
        $groups = Group::all();
        return view('admission.applications.edit', compact('application', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'father' => 'required',
            'bform' => 'required',
            'phone' => 'required',
            'bise_name' => 'required',
            'rollno' => 'required',
            'obtained' => 'required',
            'total' => 'required',
            'pass_year' => 'required',
            'objection' => 'nullable',
            // 'concession' => 'required',
            'group_id' => 'required',
        ]);

        try {
            $application = Application::findOrFail($id);

            $application->update($request->all());
            return redirect()->route('admission.applications.index')->with('success', 'Application # ' . $application->rollno . ' successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $application = Application::findOrFail($id);
            $application->delete();
            return redirect()->route('admission.applications.index')->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function congratulate()
    {
        return view('admission.applications.congrats');
    }
}
