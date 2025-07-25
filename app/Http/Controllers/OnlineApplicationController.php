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
        $validated = $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'name' => 'required|string|max:50',
            'father_name' => 'required|string|max:50',
            'bform' => 'required|string|max:15|unique:applications,bform',
            'gender' => 'required|in:m,f',
            'phone' => 'required|string|max:16',
            'address' => 'nullable|string|max:100',
            'dob' => 'required|date',
            'identification_mark' => 'required|string|max:100',
            'caste' => 'required|string|max:50',
            'father_profession' => 'required|string|max:50',
            'father_income' => 'required|integer|min:0',

            'admission_grade' => 'required|integer|min:1|max:12',
            'group_id' => 'required|exists:groups,id',
            'pass_year' => 'required|digits:4|integer',
            'medium' => 'required|in:en,ur',
            'previous_school' => 'nullable|string|max:100',
            'previous_school_type' => 'nullable|string|max:20',
            'bise' => 'required|string|max:20',
            'rollno' => 'required|string|max:8',
            'obtained_marks' => 'required|integer|min:0',
            'total_marks' => 'required|integer|min:1|gte:obtained_marks',
            'status' => 'nullable|string|in:pending,approved,rejected,admitted',
            'fee_concession' => 'nullable|integer|min:0|max:100',
        ]);

        try {
            // Application::create($data);
            $duplicate = Application::where('rollno', $request->rollno)->where('pass_year', $request->pass_year)->first();
            if ($duplicate) {
                // duplicate record;
                return redirect()->back()->with('warning', 'Application alrady exists');
            } else {
                // not duplicating
                if ($request->hasFile('photo')) {
                    $image = $request->file('photo');
                    $extension = $image->getClientOriginalExtension();
                    $filename = $request->pass_year . '_' . $request->rollno . '.' . $extension;
                    $path = $image->storeAs('uploads', $filename, 'public');

                    $validated['photo'] = $path;
                }
                $application = Application::create($validated);
                return redirect()->route('applied', $application);
                // return back()->with('success', 'Image uploaded');
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
