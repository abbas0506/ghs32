<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class DashboardController extends Controller
{
    public function index()
    {
        //
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $allocations = $teacher->allocations;
        $tests = Test::all();

        return view('teacher.dashboard', compact('allocations', 'tests', 'teacher'));
    }

    /**
     * Show the form for creating a new resource.
     */
}
