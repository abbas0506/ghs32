<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;

class OnlineApplicationController extends Controller
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
        // echo "Sorry, you are late. Contact admission office";
        // echo $groups;
        return view('admission.online-applications.create', compact('groups'));
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
                $application = Application::create($request->all());
                return redirect()->route('applied', $application);
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
    public function show($id) {}

    public function applied($id)
    {

        $application = Application::findOrFail($id);
        return view('admission.online-applications.success', compact('application'));
    }
}
