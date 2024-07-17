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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $groups = Group::all();
        return view('applications.create', compact('groups'));
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
            Application::create($request->all());
            return redirect()->back()->with('success', 'Application successfully submitted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }


        return redirect()->route('registration.index')
            ->with('success', 'Registration created successfully.');
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
        //
    }

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
    }
}
