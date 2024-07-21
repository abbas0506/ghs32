<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TeacherImport;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Exceptions\EndLessPeriodException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $teachers = Teacher::all();
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'cnic' => 'required',
            'designation' => 'required',
            'bps' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $teacher = Teacher::create($request->all());
            $user = User::create([
                'login_id' => $teacher->cnic,
                'password' => Hash::make('password'),
                'userable_id' => $teacher->id,
                'userable_type' => 'App\Models\Teacher',
            ]);
            $user->assignRole('teacher');
            DB::commit();
            return redirect()->route('admin.teachers.index')->with('success', 'Successfully created');
        } catch (Exception $e) {
            DB::rollback();
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
        $teacher = Teacher::find($id);
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $teacher = Teacher::find($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'cnic' => 'required',
            'designation' => 'required',
            'bps' => 'required',
        ]);

        try {
            $teacher = Teacher::find($id);
            $teacher->update($request->all());
            return redirect()->route('admin.teachers.index')->with('success', 'Successfully updated');
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
        $model = Teacher::findOrFail($id);
        try {
            $model->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
    public function import()
    {
        return view('admin.teachers.import');
    }
    public function postImport(Request $request)
    {
        try {
            Excel::import(new TeacherImport, $request->file('file'));
            return redirect()->route('admin.teachers.index')->with('success', 'Teachers imported successfully');
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
